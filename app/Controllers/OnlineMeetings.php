<?php
namespace App\Controllers;

use App\Models\ModOnlineMeeting;

class OnlineMeetings extends BaseController
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

        $data['title'] = 'Online Meetings' . PROJECT;
        $data['description'] = 'Online Meetings Description here';

        $tableOnlineMeetings = new ModOnlineMeeting();

        if($filter == "newest"){
            $tableOnlineMeetings->select('online_meeting.*, admin.aName')
            ->join('admin', 'online_meeting.admin_id = admin.aId')
            ->orderBy('id', 'desc');
        }elseif($filter == "oldest"){
            $tableOnlineMeetings->select('online_meeting.*, admin.aName')
            ->join('admin', 'online_meeting.admin_id = admin.aId')
            ->orderBy('group_id', 'asc');
        }else{
            $tableOnlineMeetings->select('online_meeting.*, admin.aName')
            ->join('admin', 'online_meeting.admin_id = admin.aId');
        }

        $meetings = $tableOnlineMeetings->paginate(5);
        $totalMeetings = $tableOnlineMeetings->countAllResults();

        $data['filter'] = $filter;
        $data['meetings'] = $meetings;
        $data['totalMeetings'] = $totalMeetings;
        $data['pager'] = $tableOnlineMeetings->pager;

        echo view('header/header',$data);
        echo view('css/allCSS');
        echo view('header/navbar');
        echo view('users/onlineMeetings',$data);
        echo view('content/subscribed');
        echo view('footer/footer');
        echo view('footer/endfooter');
    }

    public function read($id)
    {
        if (!empty($id) && isset($id)) {
            $tableOnlineMeetings  = new ModOnlineMeeting();
            $userLoggedIn = userLoggedIn();

            $checkOnlineMeeting = $tableOnlineMeetings->select()
            ->where([
                'id'=>$id,
            ])
            ->findAll();

            $checkOtherMeetings = $tableOnlineMeetings->select()
            ->where('id !=', $id)
            ->orderBy('RAND()')
            ->limit(5)
            ->findAll();

            if($userLoggedIn){
                $data['userData'] = getUserData(getUserId());
            }

            if (count($checkOnlineMeeting) == 1) {
                $data['checkOnlineMeeting'] = $checkOnlineMeeting;
                $data['title'] =  $checkOnlineMeeting[0]['name'] . '  ' . PROJECT;
                $data['description'] = $checkOnlineMeeting[0]['name'] . '  ' . PROJECT;
                $data['otherMeetings'] = $checkOtherMeetings;
                $data['userLoggedIn'] =  $userLoggedIn;

                echo view('header/header',$data);
                echo view('css/allCSS');
                echo view('header/navbar');
                echo view('users/readmeeting',$data);
                echo view('content/subscribed');
                echo view('footer/footer');
                // if(!$userLoggedIn){
                //     echo "<script>
                //     $('.joinMeeting').click(function() {
                //         $('#confirmationModal').modal('show');
                //     });
                //     </script>";
                // }
                echo view('footer/endfooter');
            }
            else{
                customFlash('alert-info','Online Meeting Does not exist.');
                return redirect()->to(site_url('online-meetings'));
            }

        }
        else{
            customFlash('alert-info','Something went wrong, please check your required things and try again.');
            return redirect()->to(site_url('online-meetings'));
        }

    }

    public function joinmeeting($id){
        if (!empty($id) && isset($id)) {
            $parameters = array('name', 'email', 'meeting_number', 'meeting_pwd');
            $isEmpty = false;

            foreach ($parameters as $param) {
                if (empty($this->request->getGet($param))) {
                    $isEmpty = true;
                    break;
                }
            }

            // dd($isEmpty);

            if($isEmpty){
                customFlash('alert-info','Something went wrong, please check your required things and try again.');
                return redirect()->to(site_url('online-meeting/read/' . $id));
            }

            if (userLoggedIn() || isAdmin()) {
                $tableOnlineMeetings  = new ModOnlineMeeting();
                $checkOnlineMeeting = $tableOnlineMeetings->select()
                ->where([
                    'id'=>$id,
                ])
                ->findAll();

                if (count($checkOnlineMeeting) == 1) {
                    $data['checkOnlineMeeting'] = $checkOnlineMeeting;
                    $data['title'] =  'Zoom Meeting (' . $checkOnlineMeeting[0]['name'] . ') ' . PROJECT;
                    $data['description'] = $checkOnlineMeeting[0]['name'] . ' ' . PROJECT;
                    $data['meetingDetails'] = array(
                        "meeting_topic" => $checkOnlineMeeting[0]['name'],
                        "name" =>  $this->request->getGet('name'),
                        "email" =>  $this->request->getGet('email'),
                        "meeting_number" =>  $this->request->getGet('meeting_number'),
                        "meeting_password" =>  $this->request->getGet('meeting_pwd'),
                        "role" =>  $this->request->getGet('role')
                    );
                    echo view('header/header',$data);
                    echo view('header/zoomHeader');
                    echo view('users/startMeeting',$data);
                    echo view('footer/zoomFooter');
                }
                else{
                    customFlash('alert-info','Online Meeting Does not exist.');
                    return redirect()->to(site_url('online-meetings'));
                }
                
            }else{
                customFlash('alert-info','Kindly login before joining a meeting.');
                return redirect()->to(site_url('online-meeting/read/' . $id));
            }

        }
        else{
            customFlash('alert-info','Something went wrong, please check your required things and try again.');
            return redirect()->to(site_url('online-meetings'));
        }
    }

    public function thankyou(){

        $parameters = array('who', 'topic', 'id');
        $isEmpty = false;
        $isAdmin = isAdmin();

        foreach ($parameters as $param) {
            if (empty($this->request->getGet($param))) {
                $isEmpty = true;
                break;
            }
        }

        if($isEmpty){
            customFlash('alert-info','Something went wrong, please check your required things and try again.');
            return $isAdmin? redirect()->to(site_url('admin/all-zoom-meetings')) : redirect()->to(site_url('online-meetings'));
        }

        if($isAdmin){
            return redirect()->to(site_url('admin/all-zoom-meetings'));
        }

        $data['meetingDetails'] = array(
            "who" => $this->request->getGet('who'),
            "topic" =>  $this->request->getGet('topic'),
            "id" =>  $this->request->getGet('id'),
        );

        echo view('header/header',$data);
        echo view('css/allCSS');
        echo view('header/navbar');
        echo view('users/meetingthankyou',$data);
        echo view('content/subscribed');
        echo view('footer/footer');
        echo view('footer/endfooter');
    }
}//class here