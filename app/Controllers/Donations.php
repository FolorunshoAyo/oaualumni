<?php
namespace App\Controllers;

use App\Models\ModProjects;
use App\Models\ModDonations;

class InterestGroups extends BaseController
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

        $data['title'] = 'Interest Groups' . PROJECT;
        $data['description'] = 'Interest Groups Description here';

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
            $memberCount = $donationsModel->where(['project_id' => $project['project_id']])->countAllResults();
            $project['member_count'] = $memberCount;
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
            $tableInterestGroup  = new ModProjects();
            $memberModel  = new ModDonations();
            
            $checkInterestGroup = $tableInterestGroup->select()
                ->where([
                    'group_id'=>$id,
                ])
                ->findAll();

            $members = $memberModel->select()
                ->where([
                    'group_id'=>$id,
                ])
                ->findAll();

            if (count($checkInterestGroup) == 1) {
                $data['checkInterestGroup'] = $checkInterestGroup;
                $data['title'] =  $checkInterestGroup[0]['group_name'] . '  ' . PROJECT;
                $data['description'] = $checkInterestGroup[0]['group_name'] . '  ' . PROJECT;
                $data['members'] = $members;

                echo view('header/header',$data);
                echo view('css/allCSS');
                echo view('header/navbar');
                echo view('users/readgroup',$data);
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