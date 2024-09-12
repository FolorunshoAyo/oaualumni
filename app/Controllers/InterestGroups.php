<?php
namespace App\Controllers;

use App\Models\ModUsers;
use App\Models\ModInterestGroups;
use App\Models\ModInterestGroupMembers;

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
            $isMember = false;

            $checkInterestGroup = $tableInterestGroup->select()
                ->where([
                    'group_id'=>$id,
                ])
                ->findAll();

            $members = $memberModel->select('interest_group_members.*, users.u_first_name, users.u_last_name')
            ->join('users','interest_group_members.user_id = users.u_id')
            ->where(['group_id' => $id])
            ->orderBy('member_id','desc')
            ->findAll();

            $checkOtherGroups = $tableInterestGroup->select()
            ->where('group_id !=', $id)
            ->orderBy('RAND()')
            ->limit(5)
            ->findAll();

            if(userLoggedIn()){
                // Check if user is part of group
                $checkMembership = $memberModel->select()
                ->where('group_id', $id)
                ->where('user_id', getUserId())
                ->countAllResults();

                if($checkMembership == 1){
                    $isMember = true;
                }else{
                    $isMember = false;
                }
            }

            foreach ($checkOtherGroups as &$group) {
                $membersCountCount = $memberModel->where(['group_id' => $group['group_id']])->countAllResults();
                $project['members'] = $membersCountCount;
            }

            if (count($checkInterestGroup) == 1) {
                $data['checkInterestGroup'] = $checkInterestGroup;
                $data['title'] =  $checkInterestGroup[0]['group_name'] . '  ' . PROJECT;
                $data['description'] = $checkInterestGroup[0]['group_name'] . '  ' . PROJECT;
                $data['members'] = $members;
                $data['otherGroups'] = $checkOtherGroups;
                $data['isMember'] =  $isMember;

                echo view('header/header',$data);
                echo view('css/allCSS');
                echo view('header/navbar');
                echo view('users/readgroup',$data);
                echo view('content/subscribed');
                echo view('footer/footer');
                if(!$isMember){
                    echo "<script>
                    $('.joinGroupBtn').click(function() {
                        $('#confirmationModal').modal('show');
                    });
                    </script>";
                }
                echo view('footer/endfooter');
            }
            else{
                customFlash('alert-info','Interest Group Does not exist.');
                return redirect()->to(site_url('interest-groups'));
            }

        }
        else{
            customFlash('alert-info','Something went wrong, please check your required things and try again.');
            return redirect()->to(site_url('interest-groups'));
        }

    }

    public function joingroup($id){
        if (userLoggedIn()) {
            $groupModel = new ModInterestGroups();
            $memberModel = new ModInterestGroupMembers();
            $group_name = $groupModel->where(['group_id' => $id])->findAll()[0]['group_name'];
            

            $newInterestGroupMember = [
                'user_id'=> getUserId(),
                'group_id'=> $id,
            ];

            $isInserted = $memberModel->insert($newInterestGroupMember);
            if ($isInserted) {
                customFlash('alert-success','You have successfully joined ' . $group_name);
                return redirect()->to(site_url('interest-group/read/' . $id));
            }
            else{
                customFlash('alert-info','OOps..! something went wrong please try again.');
                return redirect()->to(site_url('interest-group/read/' . $id));
            }
        }else{
            customFlash('alert-info','Kindly login before joining a group.');
            return redirect()->to(site_url('interest-group/read/' . $id));
        }
    }
}//class here