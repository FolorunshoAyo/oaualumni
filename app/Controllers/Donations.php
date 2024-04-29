<?php
namespace App\Controllers;

use App\Models\ModProjects;
use App\Models\ModDonations;

class Donations extends BaseController
{
    protected $validator;
    protected $request;
    protected $session;

    function __construct()
    {
        $this->validator = \Config\Services::validation();
        $this->request = \Config\Services::request();
        $this->session = \Config\Services::session();
    }

    protected $helpers = ['url', 'custom_helper','form','text'];
    
    public function index(){
        $data = [];

        $filter = $this->request->getGet('filter');

        $data['title'] = 'Donations' . PROJECT;
        $data['description'] = 'Donation Description here';

        $tableProjects = new ModProjects();

        if($filter == "newest"){
            $tableProjects->select('projects.*, admin.aName')
            ->join('admin', 'projects.admin_id = admin.aId')
            ->orderBy('project_id', 'desc');
        }elseif($filter == "oldest"){
            $tableProjects->select('projects.*, admin.aName')
            ->join('admin', 'projects.admin_id = admin.aId')
            ->orderBy('project_id', 'asc');
        }elseif($filter == "popular"){
            $tableProjects->select('projects.*, admin.aName, COUNT(don.donation_id) AS num_contributors')
            ->join('donations don', 'projects.project_id = don.project_id', 'left')
            ->join('admin', 'projects.admin_id = admin.aId', 'left')
            ->orderBy('num_members', 'desc');
        }else{
            $tableProjects->select('projects.*, admin.aName')
            ->join('admin', 'projects.admin_id = admin.aId');
        }

        $projects = $tableProjects->paginate(5);
        $totalProjects = $tableProjects->countAllResults();
        $donationsModel = new ModDonations();

        foreach ($projects as &$project) {
            $contributorsCount = $donationsModel->where(['project_id' => $project['project_id']])->countAllResults();
            $project['contributors_count'] = $contributorsCount;
        }

        $data['filter'] = $filter;
        $data['projects'] = $projects;
        $data['totalProjects'] = $totalProjects;
        $data['pager'] = $tableProjects->pager;

        echo view('header/header',$data);
        echo view('css/allCSS');
        echo view('header/navbar');
        echo view('users/donations',$data);
        echo view('content/subscribed');
        echo view('footer/footer');
        echo view('footer/endfooter');
    }

    public function read($id)
    {
        if (!empty($id) && isset($id)) {
            $tableProjects  = new ModProjects();
            $donationsModel  = new ModDonations();
            
            $checkProject = $tableProjects->select()
                ->where([
                    'project_id'=>$id,
                ])
                ->findAll();

            $checkOtherProject = $tableProjects->select()
            ->where('project_id !=', $id)
            ->orderBy('RAND()')
            ->limit(5)
            ->findAll();

            $donations = $donationsModel->select("donations.*, users.u_dp, users.u_first_name, users.u_last_name, users.u_email, users.u_mobile")
                ->join('users', 'donations.user_id = users.u_id')
                ->where([
                    'project_id'=>$id,
                ])
                ->findAll();

            foreach ($checkOtherProject as &$project) {
                $contributorsCountCount = $donationsModel->where(['project_id' => $project['project_id']])->countAllResults();
                $project['contributors'] = $contributorsCountCount;
            }

            if (count($checkProject) == 1) {
                $data['checkProject'] = $checkProject;
                $data['title'] =  $checkProject[0]['project_name'] . '  ' . PROJECT;
                $data['description'] = $checkProject[0]['project_name'] . '  ' . PROJECT;
                $data['contributors'] = array();
                $data['otherProjects'] = $checkOtherProject;

                foreach ($donations as $donation) {
                    $item = array(
                        'donation_id' => $donation['donation_id'],
                        'u_dp' => $donation['u_dp'],
                        'first_name' => $donation['user_id']? $donation['u_first_name'] : $donation['first_name'],
                        'last_name' => $donation['user_id']? $donation['u_last_name'] : $donation['last_name'],
                        'email' => $donation['user_id']? $donation['u_email'] : $donation['email'],
                        'phone' => $donation['user_id']? $donation['u_mobile'] : $donation['phone'],
                        'amount' => $donation['amount']
                    );
                    $data['contributors'][] = $item;
                }

                echo view('header/header',$data);
                echo view('css/allCSS');
                echo view('header/navbar');
                echo view('users/readdonation',$data);
                echo view('content/subscribed');
                echo view('footer/footer');
                echo view('footer/endfooter');
            }
            else{
                customFlash('alert-info','News not exist.');
                return redirect()->to(site_url('news'));
            }

        }
        else{
            customFlash('alert-info','Something went wrong, please check your required things and try again.');
            return redirect()->to(site_url('news'));
        }

    }
}//class here