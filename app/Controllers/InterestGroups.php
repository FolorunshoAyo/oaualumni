<?php
namespace App\Controllers;

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

        $data['title'] = 'Interest Groups' . PROJECT;
        $data['description'] = 'Interest Groups Description here';

        $tableInterestGroups = new ModInterestGroups();
        $groups = $tableInterestGroups->paginate(5);
        $totalGroups = $tableInterestGroups->countAllResults();
        $memberModel = new ModInterestGroupMembers();

        foreach ($groups as &$group) {
            $memberCount = $memberModel->where(['group_id' => $group['group_id']])->countAllResults();
            $group['member_count'] = $memberCount;
        }

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
}//class here