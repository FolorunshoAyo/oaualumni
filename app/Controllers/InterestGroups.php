<?php
namespace App\Controllers;

use App\Models\ModAdmin;
use App\Models\ModInterestGroupMembers;
use App\Models\ModInterestGroups;

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


    /*club script starts here*/
    public function login()
    {
        //dd();
        if (!userLoggedIn()) {
            $data['title'] = 'Login' . PROJECT;
            $data['description'] = 'Login';
            echo view('header/header',$data);
            echo view('css/allCSS');
            echo view('css/owl');
            echo view('header/navbar');
            echo view('users/login',$data);
            echo view('content/subscribed');
            echo view('footer/footer');
            echo view('footer/endfooter');
        }
        else{
            return redirect()->to(site_url('user'));
        }

    }
    
    public function index(){
        $data = [];

        $filter = $this->request->getGet('filter');

        $data['title'] = 'Interest Groups' . PROJECT;
        $data['description'] = 'Interest Groups Description here';

        $tableInterestGroups = new ModInterestGroups();

        if($filter == "newest"){
            $tableInterestGroups->select('interest_groups.*, admin.aName')
            ->join('admin', 'interest_groups.admin_id = admin.aId')
            ->orderBy('group_id', 'desc');
        }elseif($filter == "oldest"){
            $tableInterestGroups->select('interest_groups.*, admin.aName')
            ->join('admin', 'interest_groups.admin_id = admin.aId')
            ->orderBy('group_id', 'asc');
        }elseif($filter == "popular"){
            $tableInterestGroups->select('interest_groups.*, admin.aName, COUNT(igm.member_id) AS num_members')
            ->join('interest_group_members igm', 'interest_groups.group_id = igm.group_id', 'left')
            ->join('admin', 'interest_groups.admin_id = admin.aId', 'left')
            ->orderBy('num_members', 'desc');
        }else{
            $tableInterestGroups->select('interest_groups.*, admin.aName')
            ->join('admin', 'interest_groups.admin_id = admin.aId');
        }

        $groups = $tableInterestGroups->paginate(5);
        $totalGroups = $tableInterestGroups->countAllResults();
        $memberModel = new ModInterestGroupMembers();

        foreach ($groups as &$group) {
            $memberCount = $memberModel->where(['group_id' => $group['group_id']])->countAllResults();
            $group['member_count'] = $memberCount;
        }

        $data['filter'] = $filter;
        $data['groups'] = $groups;
        $data['totalGroups'] = $totalGroups;
        $data['pager'] = $tableInterestGroups->pager;

        echo view('header/header',$data);
        echo view('css/allCSS');
        echo view('header/navbar');
        echo view('users/groups',$data);
        echo view('content/subscribed');
        echo view('footer/footer');
        echo view('footer/endfooter');
    }

    public function read($id)
    {
        if (!empty($id) && isset($id)) {
            $tableInterestGroup  = new ModInterestGroups();
            $memberModel  = new ModInterestGroupMembers();

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