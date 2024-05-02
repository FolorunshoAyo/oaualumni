<?php


namespace App\Controllers;


use App\Models\Events;
use App\Models\ModAdmin;
use App\Models\ModContact;
use App\Models\ModCountries;
use App\Models\ModEvents;
use App\Models\ModGallery;
use App\Models\ModGalleryImages;
use App\Models\ModHomeSection;
use App\Models\ModHowITWorks;
use App\Models\ModAlumni;
use App\Models\ModInterestGroupMembers;
use App\Models\ModInterestGroups;
use App\Models\ModProjects;
use App\Models\ModDonations;
use App\Models\ModUsers;
use App\Models\ModNewEvents;
use App\Models\Settings;
use App\Models\Sliders;
use CodeIgniter\Database\MySQLi\Utils;
use CodeIgniter\I18n\Time;
use CodeIgniter\Model;
use Config\Services;

class Admin extends BaseController
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
    /*club code starts here*/
    public function users()
    {
        if (isAdmin()){
            $request = $this->request;
            $filters = $this->filterWhereForModels();//filtering for models
            $tableUsers = new ModUsers();

            $pageRange = $request->getGet('ppg');
            if (isset($pageRange) && !empty($pageRange)) {
                $perPage = $pageRange;
            }
            else{
                $perPage = 20;
            }
            $filters['u_status']=1;
            $tableUsers->where($filters)->orderBy('u_id','desc');
            $data = [
                'skzUsers' => $tableUsers->paginate($perPage),
                'pager' => $tableUsers->pager,
                'filters' => $this->filterWhereForview()
            ];

            $data['AllUsers'] = $tableUsers->where(['u_status'=>1])->findAll();
            $data['title'] =  'Admin ' .PROJECT;
            $data['description'] = 'Admin Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/datePicker');
            echo view('css/bootstrapSelect');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/users',$data);
            echo view('admin/footer/footer');
            echo view('admin/js/datePicker');
            echo view('js/bootstrapSelect');
            echo view('admin/endfooter/endfooter');
        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }
    
    public function logIn(){

        if (!isAdmin()){
            $data['title'] =  'Admin Login ' . PROJECT;
            $data['description'] = 'Admin Description here';
            echo view('admin/content/login',$data);
        }
        else{
            return redirect()->to(site_url('admin'));
        }
    }
    public function logout(){
        if (isAdmin()){
            $session =  $this->session;
            $session->destroy();
            // redirect('admin/login');
            return redirect()->to(base_url());
        }
        else{
            return redirect()->to(site_url('admin/login'));
        }
    }
    public function checkUser()
    {
        //die();
        $validation = $this->validator;
        $request = $this->request;
        $session =  $this->session;
        $tableAdmin =  new ModAdmin();
        $data['email'] = $request->getPost('username'); //$this->input->post('username');
        $data['password'] = $request->getPost('password'); //$this->input->post('password');
        //var_dump($data);
        //die();
        if (!$this->validate($validation->getRuleGroup('adminLogin'))){
            customFlash('alert-warning','Please check required fields and try again.');
            return redirect()->to(site_url('admin/login'));
        }
        else{
            $data['password'] = hash('md5',$data['password']);
            $checkAdmin = $tableAdmin->checkAdmin($data);
            if ($checkAdmin){
                //var_dump($data);
                $sessionAdmin['aId'] = $checkAdmin[0]['aId'];
                $sessionAdmin['aName'] = $checkAdmin[0]['aName'];
                $sessionAdmin['aDate'] = $checkAdmin[0]['aDate'];
                $sessionAdmin['email'] = $checkAdmin[0]['email'];
                $sessionAdmin['aDp'] = $checkAdmin[0]['aDp'];
                $sessionAdmin['aSuperAdmin'] = $checkAdmin[0]['aSuperAdmin'];
                $session->set($sessionAdmin);
                if (isAdmin()){
                    //redirect('admin');
                    return redirect()->to(site_url('admin'));

                }
                else{
                    customFlash('alert-warning','You can not login right now please try again.');
                    return redirect()->to(site_url('admin/login'));

                }
            }
            else{
                customFlash('alert-warning','UserName or Password Invalid.');
                return redirect()->to(site_url('admin/login'));

            }
        }
    }


    public function editUser($id)
    {
        if (isAdmin() && isSuperAdmin()){
            if (!empty($id) && isset($id)) {
                $tableUsers = new ModUsers();
                $data['userData'] = $tableUsers->getUserInfo($id);
                // $data['userInfo'] = $this->modAdmin->getUserInfo($id);
                if (count($data['userData']) === 1) {
                    $data['title'] =  'Edit User ' .PROJECT;
                    $data['description'] = 'Edit User Description here';
                    echo view('admin/header/header',$data);
                    echo view('admin/css/css');
                    echo view('css/phone');
                    echo view('admin/navbar/navbartop');
                    echo view('admin/navbar/navbar_left');
                    echo view('admin/content/editUser',$data);
                    echo view('admin/footer/footer');
                    echo view('js/phone');
                    echo view('admin/endfooter/endfooter');

                }
                else{
                    customFlash('alert-warning','The User is not available please try again.');
                    return redirect()->to(site_url('admin/users'));
                }
            }
            else{
                customFlash('alert-warning','Something went wrong.');
                return redirect()->to(site_url('admin/users'));
            }
        }
        else{
            customFlash('alert-warning','Please login first.','admin/login');
            return redirect()->to(site_url('admin/login'));
        }

    }

    public function updateUser()
    {
        if (isAdmin()) {
            $validation = $this->validator;
            $request = $this->request;
            $tableUsers = new ModUsers();

            if (!$this->validate($validation->getRuleGroup('userUpdateAdmin'))) {
                customFlash('alert-info','Please check your required fields and try again.');
                return redirect()->back();
            }
            else{
                $userId = $request->getPost('xyp');
                if (isset($userId) && !empty($userId)) {
                    $checkUser = $tableUsers->where('u_id',$userId)->findAll();
                    if (count($checkUser) == 1) {
                        $data['u_first_name'] = $request->getPost('first_name');
                        $data['u_last_name'] = $request->getPost('last_name');
                        $data['u_occupation'] = $request->getPost('occupation');
                        $data['u_address'] = $request->getPost('address');
                        $data['u_hobbies'] = $request->getPost('hobbies');
                        $password = $request->getPost('password');
                        $old_pic = $request->getPost('xceep');

                        if (isset($password) && !empty($password)) {
                            $data['password'] = hash('md5',$password);
                        }
                        $profilePic = $this->request->getFile('dp');
                        if (!empty($profilePic) && $profilePic->getSize() > 0) {
                            $profileFileName = $profilePic->getRandomName();
                            $profilePic->move('./public/assets/images/users',$profileFileName);
                            $data['u_dp'] = $profileFileName;
                        }//checking image if selected.
                        $updateUserSKZ = $tableUsers->update($userId,$data);
                        if ($updateUserSKZ){
                            if (!empty($old_pic)){
                                if (file_exists('./public/assets/images/users/'.$old_pic))
                                {
                                    unlink('./public/assets/images/users/'.$old_pic);
                                }
                            }
                            customFlash('alert-success','Your profile is updated');
                            return redirect()->to(site_url('admin/users'));
                        }
                        else{
                            customFlash('alert-info','You can\'t update your profile right now please contact admin');
                            return redirect()->to(site_url('admin/users'));
                        }
                    }
                    else{
                        customFlash('alert-success','The user id not exist. ');
                        return redirect()->to(site_url('admin/users'));
                    }

                }
                else{
                    customFlash('alert-success','The user id is required; please check it and try again later.');
                    return redirect()->to(site_url('admin/users'));
                }
            }
        }
        else{
            customFlash('alert-warning','Login now before accessing dashboard.');
            return redirect()->to(site_url('admin/login'));
        }
    }
    public function pendingusers()
    {
        if (isAdmin()){
            $request = $this->request;
            $filters = $this->filterWhereForModels();//filtering for models
            $tableUsers = new ModUsers();

            $pageRange = $request->getGet('ppg');
            if (isset($pageRange) && !empty($pageRange)) {
                $perPage = $pageRange;
            }
            else{
                $perPage = 20;
            }
            $filters['u_status'] = 0;
            $tableUsers->where($filters)->orderBy('u_id','desc');
            $data = [
                'skzUsers' => $tableUsers->paginate($perPage),
                'pager' => $tableUsers->pager,
                'filters' => $this->filterWhereForview()
            ];

            $data['AllUsers'] = $tableUsers->where(['u_status'=>1])->findAll();
            $data['title'] =  'Pending Users ' .PROJECT;
            $data['description'] = 'Pending Users Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/datePicker');
            echo view('css/bootstrapSelect');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/pendingusers',$data);
            echo view('admin/footer/footer');
            echo view('admin/js/datePicker');
            echo view('js/bootstrapSelect');
            echo view('admin/endfooter/endfooter');
        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }


    public function ApproveUser($userId,$Status)
    {
        if (isAdmin()){
            $tableUsers = new ModUsers();
            if (!empty($userId) && isset($userId) && isset($Status) && !empty($Status)) {
                $isUserExist = $tableUsers->where(['u_id'=>$userId])->findAll();
                if (count($isUserExist) === 1) {
                    switch ($Status) {
                        case 2:
                            $userData['u_status'] = 0;
                            $myError = 'You have disabled the user';
                            break;
                        case 1:
                            $userData['u_status'] = 1;
                            $myError = 'You have successfully Approved';
                            break;
                        default:
                            $myError = 'Something went wrong; please try again.';
                            break;
                    }
                    //var_dump($userData);
                    //die();
                    $machinStaus = $tableUsers->update($userId,$userData);
                    if ($machinStaus) {
                        customFlash('alert-success',$myError);
                        return redirect()->to(site_url('admin/users'));
                    }
                    else{
                        customFlash('alert-info','You can\'t change the status right now.');
                        return redirect()->to(site_url('admin/users'));
                    }

                }
                else{
                    customFlash('alert-warning','The user is not available; please try again.');
                    return redirect()->to(site_url('admin/users'));
                }
            }
            else{
                customFlash('alert-warning','Something went wrong; please get in touch with the developer.');
                return redirect()->to(site_url('admin/users'));
            }
        }
        else{
            customFlash('alert-warning','Please log in first.');
            return redirect()->to(site_url('admin/login'));
        }

    }
    public function queries()
    {
        if (isAdmin()){
            $tableContact = new ModContact();
            $tableContact->orderBy('con_id','desc');
            $tableContact->join('users','users.u_id = contact.user_id','left');
            $data = [
                'allMessages' => $tableContact->paginate(20),
                'pager' => $tableContact->pager,
            ];

            $data['title'] =  'All Messages ' .PROJECT;
            $data['description'] = 'All Messages Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/allMessage',$data);
            echo view('admin/footer/footer');
            //echo view('admin/footer/homeJs');
            echo view('admin/endfooter/endfooter');
        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }
    public function index()
    {
        if (isAdmin()){
            $data['title'] =  'Admin' . PROJECT;
            $tableUsers =  new ModUsers();
            $tableNewEvent = new ModNewEvents();
            $tableHowITWorks = new ModHowITWorks();
            $tableEventsCalendar = new ModEvents();
            $tableGallery = new ModGallery();
            $tableGalleryImages = new ModGalleryImages();
            $tableSliders = new Sliders();
            $data['totalNews'] =  $tableNewEvent->
                where('ne_category','news')
                ->where('ne_status',1)
                ->findAll();
            $data['totalEvents'] =  $tableNewEvent->where('ne_category','events')
                ->where('ne_status',1)
                ->findAll();
            $data['totalEventsCalendar'] =  $tableEventsCalendar
                ->where('ev_status',1)
                ->findAll();
            $data['totalHowitWorks'] =  $tableHowITWorks
                ->where('hi_status',1)
                ->findAll();
            $data['totalGallery'] =  $tableGallery
                ->where('gl_status',1)
                ->findAll();
            $data['totalGalleryImages'] =  $tableGalleryImages
                ->where('gi_status',1)
                ->findAll();
            $data['sliders'] =  $tableSliders
                ->where('sl_status',1)
                ->findAll();

            $data['NewsEvents'] = $tableNewEvent->
                where('ne_status',1)
                ->findAll(3);
            $data['howItWorks'] = $tableHowITWorks->where('hi_status',1)->findAll(3);
            $data['users'] = $tableUsers->getAllUsers(1);
            $data['pendingUsers'] = $tableUsers->getAllUsers(0);

            $data['title'] =  'Admin Home ' .PROJECT;
            $data['description'] = 'Admin Home Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/homenew',$data);
            echo view('admin/footer/footer');
            echo view('admin/footer/homeJs');
            echo view('admin/endfooter/endfooter');
        }
        else{
            customFlash('alert-warning','Please login with your account.','');
            return redirect()->to(site_url('admin/login'));
        }
    }
    /*newsEvents starts here*/
    public function newNewsEvents()
    {
        if (isAdmin()){

            $data['title'] =  'New News / Event ' .PROJECT;
            $data['description'] = 'New News / Event Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/quill');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/newNewsEvents',$data);
            echo view('admin/footer/footer');
            echo view('admin/css/quilljs');
            echo view('admin/endfooter/endfooter');

        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function addNewsEvents()
    {
        if (isAdmin()){

            $tableNewEvents =  new ModNewEvents();
            $validation = $this->validator;
            $request = $this->request;
            $session =  $this->session;
            if (!$this->validate($validation->getRuleGroup('newsEvent')))
            {
                $this->newNewsEvents();
            }
            else
            {
                $newNewsEvent = [
                    'ne_title'=>$request->getPost('title'),
                    'ne_description'=> base64_encode($request->getPost('description')),
                    'ne_category'=>$request->getPost('category'),
                    'admin_id'=> getAdminId()
                ];

                $messageImage = $request->getFile('image');
                if (!empty($messageImage) && $messageImage->getSize() > 0)
                {
                    $newNewsEvent['ne_dp'] = $messageImage->getRandomName();
                    $messageImage->move('./public/assets/images/newsEvents',$newNewsEvent['ne_dp']);
                }
                else
                {
                    customFlash('alert-danger','Please select your image and try again.');
                    return redirect()->to(site_url('admin/new-news-and-event'));
                }
                //dd($newNewsEvent);
                $checkNewsEvent = $tableNewEvents->
                where(['ne_title'=>$newNewsEvent['ne_title']])
                    ->findAll();
                if (count($checkNewsEvent) > 0) {
                    customFlash('alert-success',$newNewsEvent['ne_title'].'already exist.');
                    return redirect()->to(site_url('admin/new-news-and-event'));

                }
                else{
                    $NewsEvents = $tableNewEvents->insert($newNewsEvent);
                    if ($NewsEvents) {
                        customFlash('alert-success','You have successfully inserted');
                        return redirect()->to(site_url('admin/new-news-and-event'));

                    }
                    else{
                        customFlash('alert-info','OOps..! something went wrong please try again.');
                        return redirect()->to(site_url('admin/new-news-and-event'));
                    }
                }

            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }
    public function allNewsEvents()
    {
        if (isAdmin()){
            $request = $this->request;
            $tableNewEvents =  new ModNewEvents();
            $tableUsers = new ModUsers();
            $filters = $this->filterWhereForModels();//filtering for models
            $pageRange = $request->getGet('ppg');
            if (isset($pageRange) && !empty($pageRange)) {
                $perPage = $pageRange;
            }
            else{
                $perPage = 20;
            }
            //dd($filters);
            $filters['ne_status'] = 1;
            $tableNewEvents
                ->where($filters)
                ->orderBy('ne_id','desc');
            $data = [
                'allEvents' => $tableNewEvents->paginate($perPage),
                'pager' => $tableNewEvents->pager,
                'filters' => $this->filterWhereForview()
            ];
            /*lastQuery();
            dd();*/
            $data['AllUsers'] = $tableUsers->where(['u_status'=>1])->findAll();
            $data['title'] =  'All News/Events ' .PROJECT;
            $data['description'] = 'All News/Events Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/datePicker');
            echo view('css/bootstrapSelect');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/allNewsEvents',$data);
            echo view('admin/footer/footer');
            echo view('admin/js/datePicker');
            echo view('js/bootstrapSelect');
            echo view('admin/endfooter/endfooter');

        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }
    public function editNewsEvents($id)
    {
        if (isAdmin()){
            if (!empty($id) && isset($id)) {
                $tableNewsEvent = new ModNewEvents();
                $isEvents = $tableNewsEvent->where('ne_id',$id)->findAll();
                if (count($isEvents) === 1) {
                    $data['events'] = $isEvents  ;
                    $data['title'] =  'Edit News/Events ' .PROJECT;
                    $data['description'] = 'Edit News/Events Description here';
                    echo view('admin/header/header',$data);
                    echo view('admin/css/css');
                    echo view('admin/css/quill');
                    echo view('admin/navbar/navbartop');
                    echo view('admin/navbar/navbar_left');
                    echo view('admin/content/editNewsEvents',$data);
                    echo view('admin/footer/footer');
                    echo view('admin/css/quilljs');
                    echo view('admin/endfooter/endfooter');
                }
                else{
                    customFlash('alert-danger','The News/event is not available please try again.');
                    return redirect()->to(site_url('admin/edit-news-and-events/'.$id));
                }
            }
            else{
                customFlash('alert-danger','Some thing went wrong.');
                return redirect()->to(site_url('admin/all-news-and-events'));
            }
        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }

    public function updateNewsEvents()
    {
        if (isAdmin()){
            $tableNewEvents =  new ModNewEvents();
            $validation = $this->validator;
            $request = $this->request;
            $session =  $this->session;
            $addStatus = $validation->getRuleGroup('newsEvent');
            $addStatus['status'] = 'required|integer';
            if (!$this->validate($addStatus))
            {
                customFlash('alert-info','Please check the required fields and try again');
                return redirect()->to(site_url('admin/all-news-and-events'));
            }
            else
            {

                $oldImage = $request->getPost('dimgo');
                $eventId = $request->getPost('xeew');

                $editNewEvent = [
                    'ne_title'=>$request->getPost('title'),
                    'ne_description'=>base64_encode($request->getPost('description')),
                    'ne_category'=>$request->getPost('category'),
                    'ne_status'=>$request->getPost('status'),
                    'admin_id'=>getAdminId(),
                ];

                if (!empty($eventId) && isset($eventId)) {
                    $checkNewsEvent = $tableNewEvents->where([
                        'ne_title'=>$editNewEvent['ne_title'],
                        'ne_id !='=>$eventId
                    ])->findAll();
                    //lastQuery();
                    //dd();
                    if (count($checkNewsEvent) > 0) {
                        customFlash('alert-info','New/Event already exist.');
                        return redirect()->to(site_url('admin/all-news-and-events'));
                    }
                    else{
                        //dd();
                        $NewEventImage = $request->getFile('image');
                        if (!empty($NewEventImage) && $NewEventImage->getSize() > 0)
                        {

                            $editNewEvent['ne_dp'] = $NewEventImage->getRandomName();
                            $NewEventImage->move('./public/assets/images/newsEvents',$editNewEvent['ne_dp']);
                        }//checking image if selected.


                        $isUpdated = $tableNewEvents->update($eventId,$editNewEvent);
                        if ($isUpdated) {
                            if (isset($editNewEvent['ne_dp']) && !empty($editNewEvent['ne_dp'])) {
                                $imagePath = realpath(APPPATH . '../public/assets/images/newsEvents/');
                                if (file_exists($imagePath.'/'.$oldImage))
                                {
                                    unlink($imagePath.'/'.$oldImage);
                                }
                            }
                            customFlash('alert-success','You have successfully updated');
                            return redirect()->to(site_url('admin/all-news-and-events'));
                        }
                        else{
                            customFlash('alert-success','OOps..! something went wrong please try again.');
                            return redirect()->to(site_url('admin/all-news-and-events'));
                        }
                    }

                }
                else{
                    customFlash('alert-info','Something went wrong please try again');
                    return redirect()->to(site_url('admin/all-news-and-events'));

                }

            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }

    private function filterWhereForview()
    {
        $request = $this->request;
        $user = $request->getGet('user');
        $fup = $request->getGet('fup');
        $tup = $request->getGet('tup');
        $query = $request->getGet('q');
        $page = $request->getGet('ppg');

        $fnev = $request->getGet('fnev');
        $tnev = $request->getGet('tnev');

        $glr = $request->getGet('glr');

        $fgl = $request->getGet('fgl');
        $tgl = $request->getGet('tgl');

        $serachKey =   $request->getGet('s');

        $filters = [];
        if (isset($user) && !empty($user))
        {
            $filters['user'] = $user ;
        }
        else{
            $filters['user'] = '' ;
        }
        if (isset($page) && !empty($page))
        {
            $filters['page'] = $page ;
        }
        else{
            $filters['page'] = '' ;
        }
        if (isset($fud) && !empty($fud))
        {
            $filters['fud'] = $fud ;
        }
        else{
            $filters['fud'] = '' ;
        }
        if (isset($tud) && !empty($tud))
        {
            $filters['tud'] = $tud;
        }
        else{
            $filters['tud'] = '' ;
        }

        if (isset($fnev) && !empty($fnev))
        {
            $filters['fnev'] = $fnev ;
        }
        else{
            $filters['fnev'] = '' ;
        }
        if (isset($tnev) && !empty($tnev))
        {
            $filters['tnev'] = $tnev;
        }
        else{
            $filters['tnev'] = '' ;
        }
        if (isset($glr) && !empty($glr))
        {
            $filters['glr'] = $glr;
        }
        else{
            $filters['glr'] = '' ;
        }

        if (isset($fgl) && !empty($fgl))
        {
            $filters['fgl'] = $fgl;
        }
        else{
            $filters['fgl'] = '' ;
        }
        if (isset($tgl) && !empty($tgl))
        {
            $filters['tgl'] = $tgl;
        }
        else{
            $filters['tgl'] = '' ;
        }
        if (isset($serachKey) && !empty($serachKey))
        {
            $filters['s'] = $serachKey ;
        }
        else{
            $filters['s'] = '' ;
        }

        return $filters;
    }
    private function filterWhereForModels()
    {
        $filters = array();
        $request = $this->request;
        if (!empty($_GET)) {
            $filters = false;
            $user = $request->getGet('user');//$this->input->get('user',TRUE);
            $fud = $request->getGet('fud');//$this->input->get('fud',TRUE);
            $tud = $request->getGet('tud');//$this->input->get('tud',TRUE);

            $fnevx = $request->getGet('fnevx');//from news and events
            $tnev = $request->getGet('tnev');//to news and events

            $glry = $request->getGet('glry');//to news and events


            if (isset($user) && !empty($user)) {
                $filters['users.u_id'] = $user;
            }
            if (isset($fud) && !empty($fud)) {
                $filters['users.u_date  >='] = $fud;
            }
            if (isset($tud) && !empty($tud)) {
                $filters['users.u_date <='] = $tud;
            }

            if (isset($fnevx) && !empty($fnevx)) {
                $filters['newsevents.ne_date  >='] = $fnevx;
            }
            if (isset($tnev) && !empty($tnev)) {
                $filters['newsevents.ne_date <='] = $tnev;
            }
            if (isset($glry) && !empty($glry)) {
                $filters['gallery.gl_id'] = $glry;
            }


        }
        return $filters;
    }
    /*private methods here*/

    /*club code ends here*/
    /*Admin starts Code here*/
    public function newadmin()
    {
        if (isAdmin() && isSuperAdmin()){
            $tableUsers = new ModUsers();
            $data['AllUsers'] = $tableUsers->where('u_status',1)->findAll();
            $data['title'] =  'New Admin ' .PROJECT;
            $data['description'] = 'New Admin Description here';
           echo view('admin/header/header',$data);
           echo view('admin/css/css');
            //echo view('admin/css/datePicker');
           echo view('css/bootstrapSelect');
           echo view('css/formValidation');
           echo view('admin/navbar/navbartop');
           echo view('admin/navbar/navbar_left');
           echo view('admin/content/newadmin',$data);
           echo view('admin/footer/footer');
           echo view('js/formValidation');
           echo view('admin/js/newadmin');
            //echo view('admin/js/datePicker');
           echo view('js/bootstrapSelect');
           echo view('admin/endfooter/endfooter');
        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function addadmin()
    {
        if (isAdmin() && isSuperAdmin()) {
            $validation = $this->validator;
            $request = $this->request;
            if (!$this->validate($validation->getRuleGroup('newAdmin')))
            {
                $this->newadmin();
            }
            else {
                $data['aName'] = $request->getPost('name');//$this->input->post('name', TRUE);
                $data['email'] = $request->getPost('email');//$this->input->post('email', TRUE);
                $data['password'] = $request->getPost('password');//$this->input->post('password', TRUE);
                $data['aStatus'] = $request->getPost('status');//$this->input->post('status', TRUE);
                $data['aSuperAdmin'] = 0;
                $tableAdmin = new ModAdmin();
                $data['aDate'] = date('Y-m-d H:i:s');
                //$data['admin_id'] = getAdminId();
                $isAdmin = $tableAdmin->where(['email'=>$data['email']])->findAll();
                //$isAdmin = $this->modAdmin->chackAdmin($data);
                if (count($isAdmin) > 0){
                    if ($isAdmin[0]['aStatus'] == 0){
                        customFlash('alert-warning','This email <strong> ' . $isAdmin[0]['email'] . ' </strong> already registered but its not activated.');
                        return redirect()->to(site_url('admin/newadmin'));
                    }
                    else{
                        //echo $user[0]['uStatus'];
                        customFlash('alert-warning','This email <strong> ' . $isAdmin[0]['email'] . ' </strong> address is already available.');
                        return redirect()->to(site_url('admin/newadmin'));
                    }
                }
                else{
                    $data['password'] = hash('md5',$data['password']);
                    //$data['u_link'] = random_string('alnum', 20);
                    //echo $data['u_ref_id'] = '5stark'.random_string('numeric', 7).date('s'); ;//random_string('alnum', 5).date('m').date('d').date('His');
                    //die();
                    //$newAdmin = $this->modAdmin->addNewAdmin($data);//userId
                    $newAdmin = $tableAdmin->insert($data);//userId
                    if ($newAdmin){
                        customFlash('alert-success','You have successfully created the admin.');
                        return redirect()->to(site_url('admin/newadmin'));
                    }
                    else{
                        customFlash('alert-warning','We can\'t register you right now please try again.');
                        return redirect()->to(site_url('admin/newadmin'));
                    }

                }

            }
        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }


    public function all()
    {
        if (isAdmin() && isSuperAdmin()){
            $request = $this->request;
            $tableAdmin = new ModAdmin();
            $tableAdmin->fatchAdmins();
            $data = [
                'allAdmins' => $tableAdmin->paginate(20),
                'pager' => $tableAdmin->pager
            ];


            $data['title'] =  'All Admin ' .PROJECT;
            $data['description'] = 'All Admin Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/all',$data);
            echo view('admin/footer/footer');
            //echo view('admin/footer/homeJs');
            echo view('admin/endfooter/endfooter');


        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }

    public function editadmin($id)
    {
        if (isAdmin() && isSuperAdmin()){
            if (!empty($id) && isset($id)) {
                $tableAdmin = new ModAdmin();
                $isAdmin = $tableAdmin->where(['aId'=>$id])->findAll();
                //$isAdmin = $this->modAdmin->checkAdminById($id);
                if (count($isAdmin) === 1) {
                    $data['admins'] = $isAdmin  ;
                    $data['title'] =  'Edit Admin ' .PROJECT;
                    $data['description'] = 'Edit Admin Description here';
                    echo view('admin/header/header',$data);
                    echo view('admin/css/css');
                    //echo view('admin/css/datePicker');
                    echo view('css/bootstrapSelect');
                    echo view('css/formValidation');
                    echo view('admin/navbar/navbartop');
                    echo view('admin/navbar/navbar_left');
                    echo view('admin/content/editadmin',$data);
                    echo view('admin/footer/footer');
                    echo view('js/formValidation');
                    echo view('admin/js/editadmin');
                    //echo view('admin/js/datePicker');
                    echo view('js/bootstrapSelect');
                    echo view('admin/endfooter/endfooter');
                }
                else{
                    customFlash('alert-warning','The Plan is not available please try again.');
                    return redirect()->to(site_url('admin/all'));
                }
            }
            else{
                customFlash('alert-warning','Some thing went wrong.');
                return redirect()->to(site_url('admin/all'));
            }
        }
        else{
            customFlash('alert-warning','Please login first.');
            return redirect()->to(site_url('admin/login'));
        }

    }

    public function updateadmin()
    {
        if (isAdmin() && isSuperAdmin()){
            $validation = $this->validator;
            $request = $this->request;
            //$this->form_validation->set_rules('xeew', 'Admin Id', 'trim|required|integer');
            $adminAdd = $validation->getRuleGroup('newAdmin');
            $adminAdd['xeew'] = 'trim|required|integer';
            //var_dump($adminAdd);
            //dd();
            if (!$this->validate($adminAdd))
            {
                customFlash('alert-danger','Please check the required fields and try again');
                return redirect()->to(site_url('admin/all'));
            }
            else
            {
                $tableAdmin = new ModAdmin();
                $AdminId = $request->getPost('xeew');//$this->input->post('xeew',TRUE);
                $data['aName'] = $request->getPost('name');//$this->input->post('name', TRUE);
                $data['email'] = $request->getPost('email');//$this->input->post('email', TRUE);
                $data['password'] = $request->getPost('password');//$this->input->post('password', TRUE);
                $data['aStatus'] = $request->getPost('status');//$this->input->post('status', TRUE);
                $data['aSuperAdmin'] = 0;

                $data['aUpdateDate'] =  date('Y-m-d h:i:sa');
                if (!empty($AdminId) && isset($AdminId)) {
                    $myWhere = array(
                        'email'=>$data['email'],
                        'aId !='=>$AdminId,
                    );
                    $checkAdmin = $tableAdmin->where($myWhere)->findAll();
                    //$checkPlan = $this->modAdmin->chackAdmin($data,$AdminId);
                    if (count($checkAdmin) > 0) {
                        customFlash('alert-danger','Admin already exist.');
                        return redirect()->to(site_url('admin/editadmin/'.$AdminId));
                    }
                    else{
                        $data['password'] = hash('md5',$data['password']);
                        $isUpdated = $tableAdmin->update($AdminId,$data);
                        //$story = $this->modAdmin->updateAdmin($data,$AdminId);
                        if ($isUpdated) {
                            customFlash('alert-success','You have successfully updated your plan');
                            return redirect()->to(site_url('admin/all'));
                        }
                        else{
                            customFlash('alert-danger','OOps..! something went wrong please try again.');
                            return redirect()->to(site_url('admin/all'));
                        }
                    }

                }
                else{
                    customFlash('alert-danger','Something went wrong please try again');
                    return redirect()->to(site_url('admin/all'));
                }

            }
        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }
    /*Admin code ends here*/


    /*What We do starts here*/
    public function newHomeSection()
    {
        if (isAdmin()){
            $data['title'] =  'What We Do ' .PROJECT;
            $data['description'] = 'What We Do Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/quill');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/newHomeSection',$data);
            echo view('admin/footer/footer');
            echo view('admin/css/quilljs');
            echo view('admin/endfooter/endfooter');
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function addHomeSection()
    {
        if (isAdmin()){
            $tableHomeSection =  new ModHomeSection();
            $validation = $this->validator;
            $request = $this->request;
            if (!$this->validate($validation->getRuleGroup('homeSection')))
            {
                $this->newHomeSection();
            }
            else
            {
                $newHomeSection = [
                    'hs_title'=>$request->getPost('title'),
                    'hs_body'=> base64_encode($request->getPost('text')),
                    'hs_button_text'=>$request->getPost('buttonText'),
                    'hs_button_url'=>$request->getPost('buttonUrl'),
                    'admin_id'=> getAdminId()
                ];

                $messageImage = $request->getFile('image');
                if (!empty($messageImage) && $messageImage->getSize() > 0)
                {
                    $newHomeSection['hs_dp'] = $messageImage->getRandomName();
                    $messageImage->move('./public/assets/images/homeSection',$newHomeSection['hs_dp']);
                }
                else
                {
                    customFlash('alert-danger','Please select your image and try again.');
                    return redirect()->to(site_url('admin/new-about-section'));
                }

                $checkMessage = $tableHomeSection->where(['hs_title'=>$newHomeSection['hs_title']])->findAll();
                if (count($checkMessage) > 0) {
                    customFlash('alert-info','Home section already exist.');
                    return redirect()->to(site_url('admin/new-about-section'));
                }
                else{
                    $isInserted = $tableHomeSection->insert($newHomeSection);
                    if ($isInserted) {
                        customFlash('alert-success','You have successfully inserted.');
                        return redirect()->to(site_url('admin/new-about-section'));
                    }
                    else{
                        customFlash('alert-info','OOps..! something went wrong please try again.');
                        return redirect()->to(site_url('admin/new-about-section'));
                    }
                }

            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }


    public function allHomeSection()
    {
        if (isAdmin()){
            $tableHomeSection =  new ModHomeSection();
            $tableHomeSection->select('home_section.*')
                ->orderBy('hs_id','desc');
            $data = [
                'allHomeSection' => $tableHomeSection->paginate(20),
                'pager' => $tableHomeSection->pager
            ];

            $data['title'] =  'All We Do ' .PROJECT;
            $data['description'] = 'All What We Do Description here';



            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/datePicker');
            echo view('css/bootstrapSelect');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/allHomeSection',$data);
            echo view('admin/footer/footer');
            echo view('admin/js/datePicker');
            echo view('js/bootstrapSelect');
            echo view('admin/endfooter/endfooter');

        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }

    public function editHomeSection($id)
    {
        if (isAdmin()){

            if (!empty($id) && isset($id)) {
                $tableHomeSection =  new ModHomeSection();
                $isHomeSection = $tableHomeSection->where(['hs_id'=>$id])->findAll();
                if (count($isHomeSection) === 1) {
                    $data['homeSection'] = $isHomeSection  ;
                    $data['title'] =  'Edit We Do ' .PROJECT;
                    $data['description'] = 'Edit What We Do Description here';
                    echo view('admin/header/header',$data);
                    echo view('admin/css/css');
                    echo view('admin/css/quill');
                    echo view('admin/navbar/navbartop');
                    echo view('admin/navbar/navbar_left');
                    echo view('admin/content/editHomeSection',$data);
                    echo view('admin/footer/footer');
                    echo view('admin/css/quilljs');
                    echo view('admin/endfooter/endfooter');

                }
                else{
                    customFlash('alert-info','The message is not available please try again.');
                    return redirect()->to(site_url('admin/all-about-sections'));
                }
            }
            else{
                customFlash('alert-info','Some thing went wrong.');
                return redirect()->to(site_url('admin/all-about-sections'));
            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }


    public function updateHomeSection()
    {
        if (isAdmin()){
            $tableHomeSection =  new ModHomeSection();
            $validation = $this->validator;
            $request = $this->request;
            $addStatus = $validation->getRuleGroup('homeSection');
            $addStatus['status'] = 'required|integer';
            if (!$this->validate($addStatus))
            {
                customFlash('alert-info','Please check the required fields and try again');
                return redirect()->to(site_url('admin/all-about-sections'));
            }
            else
            {
                $oldImage = $request->getPost('dimgo');
                $hmSectionId = $request->getPost('xeew');

                $editHomeSection = [
                    'hs_title'=>$request->getPost('title'),
                    'hs_body'=> base64_encode($request->getPost('text')),
                    'hs_button_text'=>$request->getPost('buttonText'),
                    'hs_button_url'=>$request->getPost('buttonUrl'),
                    'admin_id'=> getAdminId()
                ];

                if (!empty($hmSectionId) && isset($hmSectionId)) {

                    $checkMessage = $tableHomeSection->where([
                        'hs_title'=>$editHomeSection['hs_title'],
                        'hs_id !='=>$hmSectionId
                    ])->findAll();
                    if (count($checkMessage) > 0) {
                        customFlash('alert-info','Home section already exist.');
                        return redirect()->to(site_url('admin/edit-message/'.$hmSectionId));
                    }
                    else{
                        $messageImage = $request->getFile('image');
                        if (!empty($messageImage) && $messageImage->getSize() > 0)
                        {

                            $editHomeSection['hs_dp'] = $messageImage->getRandomName();
                            $messageImage->move('./public/assets/images/homeSection',$editHomeSection['hs_dp']);
                        }//checking image if selected.


                        $isUpdated = $tableHomeSection->update($hmSectionId,$editHomeSection);
                        if ($isUpdated) {
                            if (isset($editMessage['hs_dp']) && !empty($editMessage['hs_dp'])) {
                                $imagePath = realpath(APPPATH . '../public/assets/images/homeSection/');
                                if (file_exists($imagePath.'/'.$oldImage))
                                {
                                    unlink($imagePath.'/'.$oldImage);
                                }
                            }
                            customFlash('alert-success','You have successfully updated');
                            return redirect()->to(site_url('admin/all-about-sections'));
                        }
                        else{
                            customFlash('alert-success','OOps..! something went wrong please try again.');
                            return redirect()->to(site_url('admin/all-about-sections'));
                        }
                    }

                }
                else{
                    customFlash('alert-info','Something went wrong please try again');
                    return redirect()->to(site_url('admin/all-about-sections'));

                }

            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }
    /*What We do ends here*/


    /*How it works starts here*/
    public function newHowWorks()
    {
        if (isAdmin()){
            $data['title'] =  'How it works ' .PROJECT;
            $data['description'] = 'How it works Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/quill');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/newHowWorks',$data);
            echo view('admin/footer/footer');
            echo view('admin/css/quilljs');
            echo view('admin/endfooter/endfooter');
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function addHowWorks()
    {
        if (isAdmin()){
            $tableHowITWorks =  new ModHowITWorks();
            $validation = $this->validator;
            $request = $this->request;
            if (!$this->validate($validation->getRuleGroup('howItWorks')))
            {
                $this->newHowWorks();
            }
            else
            {
                $newHIWSection = [
                    'hi_name'=>$request->getPost('name'),
                    'hi_post'=> $request->getPost('post'),
                    'hi_facebook'=>$request->getPost('smfacebook'),
                    'hi_twitter'=>$request->getPost('smtwitter'),
                    'hi_linkedin'=>$request->getPost('smlinkedin'),
                    'hi_set_featured'=>$request->getPost('is_featured') !== null ? 1 : 0,
                    'admin_id'=> getAdminId()
                ];

                $messageImage = $request->getFile('image');
                if (!empty($messageImage) && $messageImage->getSize() > 0)
                {
                    $newHIWSection['hi_dp'] = $messageImage->getRandomName();
                    $messageImage->move('./public/assets/images/howitworks',$newHIWSection['hi_dp']);
                }
                else
                {
                    customFlash('alert-danger','Please select your image and try again.');
                    return redirect()->to(site_url('admin/new-how-it-works'));
                }

                $checkMessage = $tableHowITWorks->where(['hi_title'=>$newHIWSection['hi_title']])->findAll();
                if (count($checkMessage) > 0) {
                    customFlash('alert-info','The Section is already exist.');
                    return redirect()->to(site_url('admin/new-how-it-works'));
                }
                else{
                    $isInserted = $tableHowITWorks->insert($newHIWSection);
                    if ($isInserted) {
                        customFlash('alert-success','You have successfully inserted.');
                        return redirect()->to(site_url('admin/new-how-it-works'));
                    }
                    else{
                        customFlash('alert-info','OOps..! something went wrong please try again.');
                        return redirect()->to(site_url('admin/new-how-it-works'));
                    }
                }

            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }


    public function allHowWorks()
    {
        if (isAdmin()){
            $tableHowITWorks =  new ModHowITWorks();
            $tableHowITWorks->select('how_it_works.*')
                ->orderBy('hi_id','desc');
            $data = [
                'allHowITWorks' => $tableHowITWorks->paginate(20),
                'pager' => $tableHowITWorks->pager
            ];
            $data['title'] =  'All Executives ' .PROJECT;
            $data['description'] = 'All posted executives';

            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/datePicker');
            echo view('css/bootstrapSelect');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/allHowWorks',$data);
            echo view('admin/footer/footer');
            echo view('admin/js/datePicker');
            echo view('js/bootstrapSelect');
            echo view('admin/endfooter/endfooter');

        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }

    public function editHowWorks($id)
    {
        if (isAdmin()){

            if (!empty($id) && isset($id)) {
                $tableHowITWorks =  new ModHowITWorks();
                $isHIT = $tableHowITWorks->where(['hi_id'=>$id])->findAll();
                if (count($isHIT) === 1) {
                    $data['HIT'] = $isHIT  ;
                    $data['title'] =  'Edit Executive ' .PROJECT;
                    $data['description'] = 'Edit Executives here';
                    echo view('admin/header/header',$data);
                    echo view('admin/css/css');
                    echo view('admin/css/quill');
                    echo view('admin/navbar/navbartop');
                    echo view('admin/navbar/navbar_left');
                    echo view('admin/content/editHowWorks',$data);
                    echo view('admin/footer/footer');
                    echo view('admin/css/quilljs');
                    echo view('admin/endfooter/endfooter');

                }
                else{
                    customFlash('alert-info','The How, It Works section is not available; please try again.');
                    return redirect()->to(site_url('admin/all-how-it-works'));
                }
            }
            else{
                customFlash('alert-info','Something went wrong, and please try again later.');
                return redirect()->to(site_url('admin/all-how-it-works'));
            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }

    public function updateHowWorks()
    {
        if (isAdmin()){
            $tableHowITWorks =  new ModHowITWorks();
            $validation = $this->validator;
            $request = $this->request;
            $addStatus = $validation->getRuleGroup('howItWorks');
            $addStatus['status'] = 'required|integer';
            $addStatus['is_featured'] = 'required|integer';
            if (!$this->validate($addStatus))
            {
                customFlash('alert-info','Please check the required fields and try again');
                return redirect()->to(site_url('admin/all-how-it-works'));
            }
            else
            {
                $oldImage = $request->getPost('dimgo');
                $hmSectionId = $request->getPost('xeew');
                //HIW that means how it works
                $editHIW = [
                    'hi_name'=>$request->getPost('name'),
                    'hi_post'=> $request->getPost('post'),
                    'hi_facebook'=>$request->getPost('smfacebook'),
                    'hi_twitter'=>$request->getPost('smtwitter'),
                    'hi_linkedin'=>$request->getPost('smlinkedin'),
                    'hi_set_featured'=>$request->getPost('is_featured')? "1" : 0,
                    'admin_id'=> getAdminId()
                ];

                if (!empty($hmSectionId) && isset($hmSectionId)) {

                    $checkMessage = $tableHowITWorks->where([
                        'hi_post'=>$editHIW['hi_post'],
                        'hi_id !='=>$hmSectionId
                    ])->findAll();
                    if (count($checkMessage) > 0) {
                        customFlash('alert-info','Home section already exist.');
                        return redirect()->to(site_url('admin/edit-how-it-works/'.$hmSectionId));
                    }
                    else{
                        $messageImage = $request->getFile('image');
                        if (!empty($messageImage) && $messageImage->getSize() > 0)
                        {

                            $editHIW['hi_dp'] = $messageImage->getRandomName();
                            $messageImage->move('./public/assets/images/howitworks',$editHIW['hi_dp']);
                        }//checking image if selected.


                        $isUpdated = $tableHowITWorks->update($hmSectionId,$editHIW);
                        if ($isUpdated) {
                            if (isset($editHIW['hi_dp']) && !empty($editHIW['hi_dp'])) {
                                $imagePath = realpath(APPPATH . '../public/assets/images/howitworks/');
                                if (file_exists($imagePath.'/'.$oldImage))
                                {
                                    unlink($imagePath.'/'.$oldImage);
                                }
                            }
                            //dd();
                            customFlash('alert-success','You have successfully updated.');
                            return redirect()->to(site_url('admin/all-how-it-works'));
                        }
                        else{
                            customFlash('alert-success','Oops..! something went wrong; please try again.');
                            return redirect()->to(site_url('admin/all-how-it-works'));
                        }
                    }

                }
                else{
                    customFlash('alert-info','Something went wrong please try again');
                    return redirect()->to(site_url('admin/all-how-it-works'));

                }

            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }

    /*How it works ends here*/

    /*Alumni starts here*/
    public function newAlumni()
    {
        if (isAdmin()){
            $data['title'] =  'Alumni ' .PROJECT;
            $data['description'] = 'Alumni Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/quill');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/newAlumni',$data);
            echo view('admin/footer/footer');
            echo view('admin/css/quilljs');
            echo view('admin/endfooter/endfooter');
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function addAlumni()
    {
        if (isAdmin()){
            $tableAlumni =  new ModAlumni();
            $validation = $this->validator;
            $request = $this->request;

            if (!$this->validate($validation->getRuleGroup('alumni')))
            {
                $this->newAlumni();
            }
            else
            {
                $newAlumni = [
                    'al_full_name'=>$request->getPost('name'),
                    'al_batch_year'=> $request->getPost('year'),
                    'al_major'=>$request->getPost('major'),
                    'al_occupation'=>$request->getPost('occupation'),
                    'al_company'=>$request->getPost('company'),
                    'al_location'=>$request->getPost('location'),
                    'al_bio'=>$request->getPost('bio'),
                    'al_featured'=>$request->getPost('al_featured') !== null? 1 : 0,
                    'admin_id'=> getAdminId(),
                ];

                // dd($newAlumni);

                $messageImage = $request->getFile('image');
                if (!empty($messageImage) && $messageImage->getSize() > 0)
                {
                    $newAlumni['al_profile_image'] = $messageImage->getRandomName();
                    $messageImage->move('./public/assets/images/alumni',$newAlumni['al_profile_image']);
                }
                else
                {
                    customFlash('alert-danger','Please select your image and try again.');
                    return redirect()->to(site_url('admin/new-alumni'));
                }

                $checkIfFeatured = $tableAlumni->where(['al_featured'=>1])->findAll();
                if (count($checkIfFeatured) == 1) {
                    customFlash('alert-info','You can only have a single featured alumni');
                    return redirect()->to(site_url('admin/new-alumni'));
                }else{
                    $isInserted = $tableAlumni->insert($newAlumni);
                    if ($isInserted) {
                        customFlash('alert-success','You have successfully inserted.');
                        return redirect()->to(site_url('admin/new-alumni'));
                    }
                    else{
                        customFlash('alert-info','OOps..! something went wrong please try again.');
                        return redirect()->to(site_url('admin/new-alumni'));
                    }
                }

            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function allAlumni()
    {
        if (isAdmin()){
            $tableAlumni =  new ModAlumni();
            $tableAlumni->select('alumni.*')
                ->orderBy('al_id','desc');
            $data = [
                'allAlumni' => $tableAlumni->paginate(20),
                'pager' => $tableAlumni->pager
            ];
            $data['title'] =  'All Alumni ' .PROJECT;
            $data['description'] = 'All posted Alumni';

            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/datePicker');
            echo view('css/bootstrapSelect');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/allAlumni',$data);
            echo view('admin/footer/footer');
            echo view('admin/js/datePicker');
            echo view('js/bootstrapSelect');
            echo view('admin/endfooter/endfooter');

        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }

    public function editAlumni($id)
    {
        if (isAdmin()){

            if (!empty($id) && isset($id)) {
                $tableAlumni =  new ModAlumni();
                $isAlumni = $tableAlumni->where(['al_id'=>$id])->findAll();
                if (count($isAlumni) === 1) {
                    $data['interestGroup'] = $isAlumni;
                    $data['title'] =  'Edit Alumni ' .PROJECT;
                    $data['description'] = 'Edit Alumni here';
                    echo view('admin/header/header',$data);
                    echo view('admin/css/css');
                    echo view('admin/css/quill');
                    echo view('admin/navbar/navbartop');
                    echo view('admin/navbar/navbar_left');
                    echo view('admin/content/editAlumni',$data);
                    echo view('admin/footer/footer');
                    echo view('admin/css/quilljs');
                    echo view('admin/endfooter/endfooter');

                }
                else{
                    customFlash('alert-info','This Alumni is not available; please try again.');
                    return redirect()->to(site_url('admin/all-alumni'));
                }
            }
            else{
                customFlash('alert-info','Something went wrong, and please try again later.');
                return redirect()->to(site_url('admin/all-alumni'));
            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }

    public function updateAlumni()
    {
        if (isAdmin()){
            $tableAlumni =  new ModAlumni();
            $validation = $this->validator;
            $request = $this->request;
            $addStatus = $validation->getRuleGroup('alumni');
            
            if (!$this->validate($addStatus))
            {
                customFlash('alert-info','Please check the required fields and try again');
                return redirect()->to(site_url('admin/all-how-it-works'));
            }
            else
            {
                $oldImage = $request->getPost('dimgo');
                $hmSectionId = $request->getPost('xeew');

                $editAlumni = [
                    'al_full_name'=>$request->getPost('name'),
                    'al_batch_year'=> $request->getPost('year'),
                    'al_major'=>$request->getPost('major'),
                    'al_occupation'=>$request->getPost('occupation'),
                    'al_company'=>$request->getPost('company'),
                    'al_location'=>$request->getPost('location'),
                    'al_bio'=>$request->getPost('bio'),
                    'al_featured'=>$request->getPost('al_featured'),
                    'admin_id'=> getAdminId(),
                ];

                if (!empty($hmSectionId) && isset($hmSectionId)) {

                    $messageImage = $request->getFile('image');
                    if (!empty($messageImage) && $messageImage->getSize() > 0)
                    {

                        $editAlumni['al_profile_image'] = $messageImage->getRandomName();
                        $messageImage->move('./public/assets/images/alumni',$editAlumni['al_profile_image']);
                    }//checking image if selected.


                    $isUpdated = $tableAlumni->update($hmSectionId,$editAlumni);
                    if ($isUpdated) {
                        if (isset($editAlumni['al_profile_image']) && !empty($editAlumni['al_profile_image'])) {
                            $imagePath = realpath(APPPATH . '../public/assets/images/alumni/');
                            if (file_exists($imagePath.'/'.$oldImage))
                            {
                                unlink($imagePath.'/'.$oldImage);
                            }
                        }
                        //dd();
                        customFlash('alert-success','You have successfully updated.');
                        return redirect()->to(site_url('admin/all-alumni'));
                    }
                    else{
                        customFlash('alert-success','Oops..! something went wrong; please try again.');
                        return redirect()->to(site_url('admin/all-alumni'));
                    }

                }
                else{
                    customFlash('alert-info','Something went wrong please try again');
                    return redirect()->to(site_url('admin/all-alumni'));

                }

            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function newInterestGroup()
    {
        if (isAdmin()){
            $data['title'] =  'Interest Group ' .PROJECT;
            $data['description'] = 'Interest Group Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/quill');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/newInterestGroup',$data);
            echo view('admin/footer/footer');
            echo view('admin/css/quilljs');
            echo view('admin/endfooter/endfooter');
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function addInterestGroup()
    {
        if (isAdmin()){
            $tableInterestGroup =  new ModInterestGroups();
            $validation = $this->validator;
            $request = $this->request;

            if (!$this->validate($validation->getRuleGroup('interestGroups')))
            {
                $this->newInterestGroup();
            }
            else
            {
                $newInterestGroup = [
                    'group_name'=>$request->getPost('name'),
                    'description'=> $request->getPost('desc'),
                    'short_description'=>$request->getPost('short_desc'),
                    'group_location'=>$request->getPost('location'),
                    'admin_id'=> getAdminId(),
                ];

                $messageImage = $request->getFile('image');
                if (!empty($messageImage) && $messageImage->getSize() > 0)
                {
                    $newInterestGroup['group_image'] = $messageImage->getRandomName();
                    $messageImage->move('./public/assets/images/interest_groups',$newInterestGroup['group_image']);
                }
                else
                {
                    customFlash('alert-danger','Please select your image and try again.');
                    return redirect()->to(site_url('admin/new-interest-group'));
                }

                $checkMessage = $tableInterestGroup->where(['group_name'=>$newInterestGroup['group_name']])->findAll();
                if (count($checkMessage) == 1) {
                    customFlash('alert-info','Interest Group already exist.');
                    return redirect()->to(site_url('admin/new-interest-group'));
                }else{
                    $isInserted = $tableInterestGroup->insert($newInterestGroup);
                    if ($isInserted) {
                        customFlash('alert-success','You have successfully inserted.');
                        return redirect()->to(site_url('admin/new-interest-group'));
                    }
                    else{
                        customFlash('alert-info','OOps..! something went wrong please try again.');
                        return redirect()->to(site_url('admin/new-interest-group'));
                    }
                }

            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function allInterestGroups()
    {
        if (isAdmin()){
            $tableInterestGroup =  new ModInterestGroups();
            $tableInterestGroup->select('interest_groups.*')
                ->orderBy('group_id','desc');
            $allGroups = $tableInterestGroup->paginate(20);
            $memberModel = new ModInterestGroupMembers();

            foreach ($allGroups as &$group) {
                // Retrieve the count of members for the current group
                $memberCount = $memberModel->where(['group_id' => $group['group_id']])->countAllResults();
    
                // Add the count of members to the current group data
                $group['member_count'] = $memberCount;
            }

            $data = [
                'allGroups' => $allGroups,
                'pager' => $tableInterestGroup->pager
            ];

            $data['title'] =  'All Interest Groups ' .PROJECT;
            $data['description'] = 'All posted Interest Group';

            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/datePicker');
            echo view('css/bootstrapSelect');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/allInterestGroups',$data);
            echo view('admin/footer/footer');
            echo view('admin/js/datePicker');
            echo view('js/bootstrapSelect');
            echo view('admin/endfooter/endfooter');

        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }

    public function viewInterestGroupMembers($group_id)
    {
        if (isAdmin()){
            $groupModel = new ModInterestGroups();
            $memberModel = new ModInterestGroupMembers();

            // Retrieve the count of members for the current group
            $group = $groupModel->where(['group_id' => $group_id])->findAll();
            $memberModel->select('interest_group_members.*, users.*')
            ->join('users','interest_group_members.user_id = users.u_id', 'left')
            ->where(['group_id' => $group_id])
            ->orderBy('member_id','desc');
            
            $data = [
                'group' => $group,
                'allMembers' => $memberModel->paginate(20),
                'pager' => $memberModel->pager
            ];

            $data['title'] =  'Interest Group (' . $group[0]['group_name'] . ')' . PROJECT;
            $data['description'] = 'All Interest Group Members';

            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/datePicker');
            echo view('css/bootstrapSelect');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/allInterestGroupMembers',$data);
            echo view('admin/footer/footer');
            echo view('admin/js/datePicker');
            echo view('js/bootstrapSelect');
            echo view('admin/endfooter/endfooter');

        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }

    public function deleteInterestGroupMember($group_id, $member_id){
        if (isAdmin()){
            if ((!empty($group_id) && isset($group_id)) && (!empty($member_id) && isset($member_id))) {
                $tableInterestGroup = new ModInterestGroups();
                $tableInterestGroupMembers = new ModInterestGroupMembers();
                $isInterestGroup = $tableInterestGroup->where(['group_id'=>$group_id])->findAll();
                //$isnews = $this->modAdmin->checkAlbumById($id);
                if (count($isInterestGroup) === 1) {
                    $hasMember = $tableInterestGroupMembers
                    ->where(['group_id'=>$group_id])
                    ->where(['user_id'=>$member_id])
                    ->findAll();

                    if(count($hasMember) == 1){
                        $isDeleted = $tableInterestGroupMembers
                        ->where(['group_id'=>$group_id])
                        ->where(['user_id'=>$member_id])
                        ->delete();
                    }

                    if ($isDeleted) {
                        customFlash('alert-success','This member has been deleted from this group associated.');
                        return redirect()->to(site_url('admin/view-group-members/' . $group_id));
                    }
                    else{
                        customFlash('alert-warning','You can\'t delete the interest group member right now; please try again.');
                        return redirect()->to(site_url('admin/view-group-members/' . $group_id));
                    }


                }
                else{
                    customFlash('alert-warning','The interest group is not available; please try again.');
                    return redirect()->to(site_url('admin/all-interest-groups'));
                }
            }
            else{
                customFlash('alert-warning','Something went wrong.');
                return redirect()->to(site_url('admin/all-interest-groups'));
            }
        }
        else{
            customFlash('alert-warning','Please login first.');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function editInterestGroup($id)
    {
        if (isAdmin()){

            if (!empty($id) && isset($id)) {
                $tableInterestGroup =  new ModInterestGroups();
                $isInterestGroup = $tableInterestGroup->where(['group_id'=>$id])->findAll();
                if (count($isInterestGroup) === 1) {
                    $data['interestGroup'] = $isInterestGroup;
                    $data['title'] =  'Edit Interest Group ' .PROJECT;
                    $data['description'] = 'Edit Interest Group here';
                    echo view('admin/header/header',$data);
                    echo view('admin/css/css');
                    echo view('admin/css/quill');
                    echo view('admin/navbar/navbartop');
                    echo view('admin/navbar/navbar_left');
                    echo view('admin/content/editInterestGroup',$data);
                    echo view('admin/footer/footer');
                    echo view('admin/css/quilljs');
                    echo view('admin/endfooter/endfooter');

                }
                else{
                    customFlash('alert-info','This Alumni is not available; please try again.');
                    return redirect()->to(site_url('admin/all-alumni'));
                }
            }
            else{
                customFlash('alert-info','Something went wrong, and please try again later.');
                return redirect()->to(site_url('admin/all-alumni'));
            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }

    public function updateInterestGroup()
    {
        if (isAdmin()){
            $tableInterestGroup =  new ModInterestGroups();
            $validation = $this->validator;
            $request = $this->request;
            $addStatus = $validation->getRuleGroup('interestGroups');
            
            if (!$this->validate($addStatus))
            {
                customFlash('alert-info','Please check the required fields and try again');
                return redirect()->to(site_url('admin/all-how-it-works'));
            }
            else
            {
                $oldImage = $request->getPost('dimgo');
                $hmSectionId = $request->getPost('xeew');

                $editInterestGroup = [
                    'group_name'=>$request->getPost('name'),
                    'description'=> $request->getPost('desc'),
                    'short_description'=>$request->getPost('short_desc'),
                    'group_location'=>$request->getPost('location'),
                    'admin_id'=> getAdminId(),
                ];

                if (!empty($hmSectionId) && isset($hmSectionId)) {

                    $messageImage = $request->getFile('image');
                    if (!empty($messageImage) && $messageImage->getSize() > 0)
                    {

                        $editInterestGroup['group_image'] = $messageImage->getRandomName();
                        $messageImage->move('./public/assets/images/interest_groups',$editInterestGroup['group_image']);
                    }//checking image if selected.


                    $isUpdated = $tableInterestGroup->update($hmSectionId,$editInterestGroup);
                    if ($isUpdated) {
                        if (isset($editInterestGroup['group_image']) && !empty($editInterestGroup['group_image'])) {
                            $imagePath = realpath(APPPATH . '../public/assets/images/interest_groups/');
                            if (file_exists($imagePath.'/'.$oldImage))
                            {
                                unlink($imagePath.'/'.$oldImage);
                            }
                        }
                        //dd();
                        customFlash('alert-success','You have successfully updated.');
                        return redirect()->to(site_url('admin/all-interest-groups'));
                    }
                    else{
                        customFlash('alert-success','Oops..! something went wrong; please try again.');
                        return redirect()->to(site_url('admin/all-interest-groups'));
                    }

                }
                else{
                    customFlash('alert-info','Something went wrong please try again');
                    return redirect()->to(site_url('admin/all-interest-groups'));

                }

            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function deleteInterestGroup($id)
    {
        if (isAdmin()){
            if (!empty($id) && isset($id)) {
                $tableInterestGroup = new ModInterestGroups();
                $tableInterestGroupMembers = new ModInterestGroupMembers();
                $isInterestGroup = $tableInterestGroup->where(['group_id'=>$id])->findAll();
                //$isnews = $this->modAdmin->checkAlbumById($id);
                if (count($isInterestGroup) === 1) {
                    $hasMembers = $tableInterestGroupMembers->where(['group_id'=>$id])->findAll();

                    if(count($hasMembers) > 0){
                        $tableInterestGroupMembers->where(['group_id'=>$id])->delete();
                    }

                    $isDeleted = $tableInterestGroup->delete($id);
                    //$events = $this->modAdmin->deleteAlbum($id);
                    if ($isDeleted) {
                        customFlash('alert-success','This Interest Group and it\'s associated members has been deleted.');
                        return redirect()->to(site_url('admin/all-interest-groups'));
                    }
                    else{
                        customFlash('alert-warning','You can\'t delete the interest group right now; please try again.');
                        return redirect()->to(site_url('admin/all-interest-groups'));
                    }


                }
                else{
                    customFlash('alert-warning','The interest group is not available; please try again.');
                    return redirect()->to(site_url('admin/all-interest-groups'));
                }
            }
            else{
                customFlash('alert-warning','Something went wrong.');
                return redirect()->to(site_url('admin/all-interest-groups'));
            }
        }
        else{
            customFlash('alert-warning','Please login first.');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function newDonation()
    {
        if (isAdmin()){
            $data['title'] =  'Add New Donation ' .PROJECT;
            $data['description'] = 'New Donation Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/quill');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/newDonation',$data);
            echo view('admin/footer/footer');
            echo view('admin/css/quilljs');
            echo view('admin/endfooter/endfooter');
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function addDonation()
    {
        if (isAdmin()){
            $tableProjects =  new ModProjects();
            $validation = $this->validator;
            $request = $this->request;

            if (!$this->validate($validation->getRuleGroup('donations')))
            {
                $this->newDonation();
            }
            else
            {
                $newProject = [
                    'project_name'=>$request->getPost('name'),
                    'description'=> $request->getPost('desc'),
                    'short_description'=>$request->getPost('short_desc'),
                    'target_amount'=>$request->getPost('target_amount'),
                    'project_location'=>$request->getPost('location'),
                    'admin_id'=> getAdminId(),
                ];

                $messageImage = $request->getFile('image');
                if (!empty($messageImage) && $messageImage->getSize() > 0)
                {
                    $newProject['project_image'] = $messageImage->getRandomName();
                    $messageImage->move('./public/assets/images/project',$newProject['project_image']);
                }
                else
                {
                    customFlash('alert-danger','Please select your image and try again.');
                    return redirect()->to(site_url('admin/new-donation'));
                }

                $checkMessage = $tableProjects->where(['project_name'=>$newProject['project_name']])->findAll();
                if (count($checkMessage) == 1) {
                    customFlash('alert-info','Donation already exist.');
                    return redirect()->to(site_url('admin/new-donation'));
                }else{
                    $isInserted = $tableProjects->insert($newProject);
                    if ($isInserted) {
                        customFlash('alert-success','You have successfully inserted.');
                        return redirect()->to(site_url('admin/new-donation'));
                    }
                    else{
                        customFlash('alert-info','OOps..! something went wrong please try again.');
                        return redirect()->to(site_url('admin/new-donation'));
                    }
                }

            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function allDonations()
    {
        if (isAdmin()){
            $tableProjects =  new ModProjects();
            $tableProjects->select('projects.*')
                ->orderBy('project_id','desc');
            $allProjects = $tableProjects->paginate(20);
            $donationsModel = new ModDonations();

            foreach ($allProjects as &$project) {
                // Retrieve the count of members for the current group
                $contributions = $donationsModel->where(['project_id' => $project['project_id']])->countAllResults();
    
                // Add the count of members to the current group data
                $project['contributors'] = $contributions;
            }

            $data = [
                'allProjects' => $allProjects,
                'pager' => $tableProjects->pager
            ];

            $data['title'] =  'All Donation Causes' .PROJECT;
            $data['description'] = 'All Donations Causes';

            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/datePicker');
            echo view('css/bootstrapSelect');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/allDonations',$data);
            echo view('admin/footer/footer');
            echo view('admin/js/datePicker');
            echo view('js/bootstrapSelect');
            echo view('admin/endfooter/endfooter');

        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }

    public function viewAllContributions($project_id)
    {
        if (isAdmin()){
            $projectModel = new ModProjects();
            $donationsModel = new ModDonations();

            // Retrieve the count of members for the current group
            $project = $projectModel->where(['project_id' => $project_id])->findAll();
            $donations = $donationsModel->select('donations.*, users.u_dp, users.u_email, users.u_mobile, users.u_last_name, users.u_first_name')
            ->join('users','donations.user_id = users.u_id')
            ->where(['project_id' => $project_id])
            ->orderBy('donation_id','desc')
            ->findAll()
            ->paginate(20);

            $data['contributors'] = array();

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
            
            $data = [
                'project' => $project,
                'allContributors' => $data['contributors'],
                'pager' => $donationsModel->pager
            ];

            $data['title'] =  'Contributors (' . $project[0]['project_name'] . ')' . PROJECT;
            $data['description'] = 'All Contributors to the cause';

            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/datePicker');
            echo view('css/bootstrapSelect');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/allDonationContributors',$data);
            echo view('admin/footer/footer');
            echo view('admin/js/datePicker');
            echo view('js/bootstrapSelect');
            echo view('admin/endfooter/endfooter');

        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }

    public function editDonation($id)
    {
        if (isAdmin()){
            if (!empty($id) && isset($id)) {
                $tableProjects =  new ModProjects();
                $isProject = $tableProjects->where(['project_id'=>$id])->findAll();
                if (count($isProject) === 1) {
                    $data['project'] = $isProject;
                    $data['title'] =  'Edit Donation Cause ' .PROJECT;
                    $data['description'] = 'Edit Donation Cause here';
                    echo view('admin/header/header',$data);
                    echo view('admin/css/css');
                    echo view('admin/css/quill');
                    echo view('admin/navbar/navbartop');
                    echo view('admin/navbar/navbar_left');
                    echo view('admin/content/editDonation',$data);
                    echo view('admin/footer/footer');
                    echo view('admin/css/quilljs');
                    echo view('admin/endfooter/endfooter');

                }else{
                    customFlash('alert-info','This Donation Cause is not available; please try again.');
                    return redirect()->to(site_url('admin/all-donation-causes'));
                }
            }
            else{
                customFlash('alert-info','Something went wrong, and please try again later.');
                return redirect()->to(site_url('admin/all-donation-causes'));
            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }

    public function updateDonation()
    {
        if (isAdmin()){
            $tableProjects =  new ModProjects();
            $validation = $this->validator;
            $request = $this->request;
            $addStatus = $validation->getRuleGroup('donations');
            
            if (!$this->validate($addStatus))
            {
                customFlash('alert-info','Please check the required fields and try again');
                return redirect()->to(site_url('admin/all-how-it-works'));
            }
            else
            {
                $oldImage = $request->getPost('dimgo');
                $hmSectionId = $request->getPost('xeew');

                $isProject = $tableProjects->where(['project_id' => $hmSectionId])->findAll();

                if($isProject){
                    if($isProject[0]['status'] === "2"){
                        customFlash('alert-success','Oops..! Unable to update this donation because it has been completed.');
                        return redirect()->to(site_url('admin/all-donation-causes'));
                    }
                }

                $editProject = [
                    'project_name'=>$request->getPost('name'),
                    'description'=> $request->getPost('desc'),
                    'short_description'=>$request->getPost('short_desc'),
                    'target_amount'=>$request->getPost('target_amount'),
                    'project_location'=>$request->getPost('location'),
                    'status'=>$request->getPost('status'),
                    'admin_id'=> getAdminId(),
                ];

                if (!empty($hmSectionId) && isset($hmSectionId)) {

                    $messageImage = $request->getFile('image');
                    if (!empty($messageImage) && $messageImage->getSize() > 0)
                    {

                        $editProject['project_image'] = $messageImage->getRandomName();
                        $messageImage->move('./public/assets/images/project',$editProject['group_image']);
                    }//checking image if selected.

                    if($isProject){
                        if($isProject[0]['current_amount'] > $request->getPost('target_amount')){
                            customFlash('alert-success','The set target amount cannot be less than the donated amount');
                            return redirect()->to(site_url('admin/all-donation-causes'));
                        }else{
                            $isUpdated = $tableProjects->update($hmSectionId,$editProject);
                            if ($isUpdated) {
                                if (isset($editProject['project_image']) && !empty($editProject['project_image'])) {
                                    $imagePath = realpath(APPPATH . '../public/assets/images/interest_groups/');
                                    if (file_exists($imagePath.'/'.$oldImage))
                                    {
                                        unlink($imagePath.'/'.$oldImage);
                                    }
                                }
                                //dd();
                                customFlash('alert-success','You have successfully updated.');
                                return redirect()->to(site_url('admin/all-donation-causes'));
                            }
                            else{
                                customFlash('alert-success','Oops..! something went wrong; please try again.');
                                return redirect()->to(site_url('admin/all-donation-causes'));
                            } 
                        }  
                    }else{
                        customFlash('alert-info','Something went wrong please try again');
                        return redirect()->to(site_url('admin/all-donation-causes'));
                    }
                }
                else{
                    customFlash('alert-info','Something went wrong please try again');
                    return redirect()->to(site_url('admin/all-donation-causes'));

                }

            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function deleteDonation($id)
    {
        if (isAdmin()){
            if (!empty($id) && isset($id)) {
                $tableProjects = new ModProjects();
                $tableDonations = new ModDonations();
                $isProject = $tableProjects->where(['project_id'=>$id])->findAll();
                //$isnews = $this->modAdmin->checkAlbumById($id);
                if (count($isProject) === 1) {
                    $hasContributors = $tableDonations->where(['project_id'=>$id])->findAll();

                    if(count($hasContributors) > 0){
                        $tableDonations->where(['project_id'=>$id])->delete();
                    }

                    $isDeleted = $tableProjects->delete($id);
                    //$events = $this->modAdmin->deleteAlbum($id);
                    if ($isDeleted) {
                        customFlash('alert-success','This Interest Group and it\'s associated contributors has been deleted.');
                        return redirect()->to(site_url('admin/all-donation-causes'));
                    }
                    else{
                        customFlash('alert-warning','You can\'t delete the interest group right now; please try again.');
                        return redirect()->to(site_url('admin/all-donation-causes'));
                    }


                }
                else{
                    customFlash('alert-warning','The interest group is not available; please try again.');
                    return redirect()->to(site_url('admin/all-donation-causes'));
                }
            }
            else{
                customFlash('alert-warning','Something went wrong.');
                return redirect()->to(site_url('admin/all-donation-causes'));
            }
        }
        else{
            customFlash('alert-warning','Please login first.');
            return redirect()->to(site_url('admin/login'));
        }
    }

    /*Alumnis ends here*/

    /*Gallery starts here*/
    public function newAlbum()
    {
        if (isAdmin()){
            $data['title'] =  'New Album ' .PROJECT;
            $data['description'] = 'New Album Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/datePicker');
            echo view('css/bootstrapSelect');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/newAlbum',$data);
            echo view('admin/footer/footer');
            echo view('admin/js/datePicker');
            echo view('js/bootstrapSelect');
            echo view('admin/endfooter/endfooter');

        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }
    public function addAlbum()
    {

        if (isAdmin()){
            $validation = $this->validator;
            $request = $this->request;
            if (!$this->validate($validation->getRuleGroup('addNewAlbum'))) {
                customFlash('alert-warning','Please check required fields and try again.');
                return redirect()->to(site_url('admin/new-album'));
            }
            else{
                $data['gl_name'] = strtolower($request->getPost('album'));
                $data['admin_id'] = getAdminId();
                $tableGallery = new ModGallery();
                $checkLanguage = $tableGallery->checkAlbums($data);
                if (count($checkLanguage) > 0) {
                    customFlash('alert-warning','This ' . $data['gl_name'] . ' album already exist');
                    return redirect()->to(site_url('admin/new-album'));
                }
                else{
                    $isAlbum = $tableGallery->insert($data);
                    //$addlanguage = $this->modAdmin->addAlbum($data);
                    if ($isAlbum) {
                        customFlash('alert-success','You have successfully inserted the album');
                        return redirect()->to(site_url('admin/new-album'));
                    }
                    else{
                        customFlash('alert-warning','Something went wrong please try again');
                        return redirect()->to(site_url('admin/new-album'));
                    }

                }
            }
        }
        else{
            customFlash('alert-warning','Please login with access the admin panel.');
            return redirect()->to(site_url('admin/login'));
        }

    }
    public function allAlbums()
    {
        if (isAdmin()){
            $tableGallery = new ModGallery();
            $tableGallery->fatchAllAlbums();
            $data = [
                'allAlbums' => $tableGallery->paginate(20),
                'pager' => $tableGallery->pager
            ];
            $data['title'] =  'All Album ' .PROJECT;
            $data['description'] = 'All Album Description here';

            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/quill');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/allAlbums',$data);
            echo view('admin/footer/footer');
            echo view('admin/css/quilljs');
            echo view('admin/endfooter/endfooter');
        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }
    public function deleteAlbum($id)
    {
        if (isAdmin()){
            if (!empty($id) && isset($id)) {
                $tableGallery = new ModGallery();
                $tableGalleryImages = new ModGalleryImages();
                $isGallery = $tableGallery->where(['gl_id'=>$id])->findAll();
                //$isnews = $this->modAdmin->checkAlbumById($id);
                if (count($isGallery) === 1) {
                    // $allAlbumImage = $this->modAdmin->getAllAlbumImages($id);
                    $allAlbumImage = $tableGalleryImages->where(['gallery_id'=>$id])->findAll();
                    //var_dump($allTenderImage->num_rows());
                    //die();
                    $isDeleted = $tableGallery->delete($id);
                    //$events = $this->modAdmin->deleteAlbum($id);
                    if ($isDeleted) {
                        if (count($allAlbumImage) > 0) {
                            foreach ($allAlbumImage as $album) {
                                $imagePath = realpath(APPPATH . '../public/assets/images/galleryImages/'.$album['gi_name']);
                                if (file_exists($imagePath))
                                {
                                    unlink($imagePath);
                                }

                            }
                        }
                        customFlash('alert-success','Your album has been deleted.');
                        return redirect()->to(site_url('admin/all-albums'));
                    }
                    else{
                        customFlash('alert-warning','You can\'t delete the album right now; please try again.');
                        return redirect()->to(site_url('admin/all-albums'));
                    }


                }
                else{
                    customFlash('alert-warning','The album is not available; please try again.');
                    return redirect()->to(site_url('admin/all-albums'));
                }
            }
            else{
                customFlash('alert-warning','Some thing went wrong.');
                return redirect()->to(site_url('admin/all-albums'));
            }
        }
        else{
            customFlash('alert-warning','Please login first.');
            return redirect()->to(site_url('admin/login'));
        }
    }
    public function editAlbum($id)
    {
        if (isAdmin()){
            if (!empty($id) && isset($id)) {
                $tableGallery = new ModGallery();
                $tableGallery->fatchAllAlbums();
                $isGallery = $tableGallery->where(['gl_id'=>$id])->findAll();
                if (count($isGallery) === 1) {
                    $data['album'] = $isGallery  ;
                    $data['description'] = 'Edit Album Description here';
                    $data['title'] =  'Edit Album ' . PROJECT;
                    echo view('admin/header/header',$data);
                    echo view('admin/css/css');
                    echo view('admin/navbar/navbartop');
                    echo view('admin/navbar/navbar_left');
                    echo view('admin/content/editAlbum',$data);
                    echo view('admin/footer/footer');
                    echo view('admin/endfooter/endfooter');
                }
                else{
                    customFlash('alert-warning','The Album is not available; please try again.');
                    return redirect()->to(site_url('admin/all-albums'));
                }
            }
            else{
                customFlash('alert-warning','Something went wrong.');
                return redirect()->to(site_url('admin/all-albums'));
            }
        }
        else{
            customFlash('alert-warning','Please log in first.');
            return redirect()->to(site_url('admin/login'));
        }

    }
    public function updateAlbum()
    {
        if (isAdmin()){
            $validation = $this->validator;
            $request = $this->request;
            $formVal = $validation->getRuleGroup('addNewAlbum');
            $formVal['status']='required|integer';
            if (!$this->validate($formVal))
            {
                customFlash('alert-danger','Please check the required field and try again.');
                return redirect()->to(site_url('admin/all-albums'));
            }
            else
            {
                $data['gl_name'] = $request->getPost('album');
                $data['gl_status'] = $request->getPost('status');
                $galleryId = $request->getPost('xdi');

                $data['admin_id'] = getAdminId();
                $tableGallery = new ModGallery();
                $checkAlbums = $tableGallery->checkAlbums($data,$galleryId);
                if (count($checkAlbums) > 0) {
                    customFlash('alert-danger', $data['gl_name']. ' album already exists.');
                    return redirect()->to(site_url('admin/all-albums'));
                }
                else{
                    $updateAlbum = $tableGallery->update($galleryId,$data);
                    if ($updateAlbum) {
                        customFlash('alert-success','You have successfully update');
                        return redirect()->to(site_url('admin/all-albums'));
                    }
                    else{
                        customFlash('alert-danger','Your can\'t update your tender right now. Please try again.');
                        return redirect()->to(site_url('admin/all-albums'));
                    }
                }

            }
        }
        else{
            customFlash('alert-warning','Please login first.');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function newGalleryImage()
    {
        if (isAdmin()){
            $tableGallery = new ModGallery();
            $data['AllAlbums'] = $tableGallery->getAllAlbums();
            $data['title'] =  'New Gallery Images ' .PROJECT;
            $data['description'] = 'New Gallery Images Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/newGalleryImage',$data);
            echo view('admin/footer/footer');
            echo view('admin/endfooter/endfooter');

        }
        else{
            customFlash('alert-warning','Please login first.');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function uploadGalleryImages()
    {
        if (isAdmin()){
            $validation = $this->validator;
            $request = $this->request;
            if (!$this->validate($validation->getRuleGroup('galleryImages')))
            {
                $this->newGalleryImage();
            }
            else
            {
                $data['gallery_id'] = $request->getPost('album');
                $tableGalleryImages = new ModGalleryImages();
                $GalleryImages = null;
                $uploadFiles = $this->request->getFiles();
                if ($uploadFiles) {
                    if (count($uploadFiles['galleryImages']) > 0) {

                        foreach($uploadFiles['galleryImages'] as $img)
                        {
                            if ($img->isValid()  &&    !$img->hasMoved() )
                            {
                                $newName = $img->getRandomName();
                                $img->move('./public/assets/images/galleryImages',$newName);
                                $GalleryImages[] = [
                                    'gallery_id'=>$data['gallery_id'],
                                    'gi_date'=>date('Y-m-d h:i:sa'),
                                    'gi_name'=>$newName,
                                    'admin_id'=>getAdminId(),
                                ];
                            }
                        }//images foreach here
                        $isGlAdded = $tableGalleryImages->addGalleryImages($GalleryImages);
                        if ($isGlAdded) {
                            customFlash('alert-success','You have successfully uploaded the Images');
                            return redirect()->to(site_url('admin/new-gallery-images'));
                        }
                        else{
                            customFlash('alert-danger','You can\'t upload your files right now please try again.');
                            return redirect()->to(site_url('admin/new-gallery-images'));
                        }
                    }
                    else{
                        customFlash('alert-danger','Please upload at least one image/file.');
                        return redirect()->to(site_url('admin/new-gallery-images'));
                    }
                }
                else{
                    customFlash('alert-danger','Please upload at least one image/file.');
                    return redirect()->to(site_url('admin/new-gallery-images'));
                }

            }

        }
        else{
            customFlash('alert-warning','Please login first.');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function viewGalleryImages()
    {
        if (isAdmin()){
            $request = $this->request;
            $filters = $this->filterWhereForModels();//filtering for models
            $pageRange = $request->getGet('ppg');
            if (isset($pageRange) && !empty($pageRange)) {
                $perPage = $pageRange;
            }
            else{
                $perPage = 20;
            }

            //$filters['gi_deleted'] = '  NULL';

            $gralleryImages = new ModGalleryImages();
            $tableModGallery = new ModGallery();
            $data["galleryImages"] = $gralleryImages->where($filters)->fatchGalleryImages();
            $data = [
                'galleryImages' => $gralleryImages->paginate(20),
                'pager' => $gralleryImages->pager,
                'filters' => $this->filterWhereForview()
            ];
            //lastQuery();
            //dd();
            $data['title'] =  'View Gallery Images ' .PROJECT;
            $data['description'] = 'View Gallery Images Description here';
            $data['AllGalleries'] = $tableModGallery->where(['gl_status'=>1])->findAll();
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/datePicker');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/viewGalleryImages',$data);
            echo view('admin/footer/footer');
            echo view('admin/js/datePicker');

            echo view('admin/endfooter/endfooter');
        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }

    public function deleteGalleryImage($id,$pictureId)
    {
        if (isAdmin()){
            $tableGlImgaes = new ModGalleryImages();
            if (!empty($id) && isset($id) && !empty($pictureId) && isset($pictureId)) {
                $isGlImgaes =  $tableGlImgaes->where(['gi_id'=>$id])->findAll();
                $imagePath = realpath(APPPATH . '../public/assets/images/galleryImages/'.$isGlImgaes[0]['gi_name']);
                if (count($isGlImgaes) === 1) {
                    $isDeleted = $tableGlImgaes->delete($id);
                    if ($isDeleted) {
                        $status = $this->deleteImage($imagePath);
                        if ($status) {
                            customFlash('alert-success','Your Gallery file has been deleted.');
                            return redirect()->to(site_url('admin/view-album-images'));
                        }
                        else{
                            customFlash('alert-warning','Your Gallery file has been deleted, but the image still exists in your folder.');
                            return redirect()->to(site_url('admin/view-album-images'));
                        }
                    }
                    else{
                        customFlash('alert-warning','You can\'t delete the Gallery file right now; please try again.');
                        return redirect()->to(site_url('admin/view-album-images'));
                    }

                }
                else{
                    customFlash('alert-warning','The image is not available; please check and try again later.');
                    return redirect()->to(site_url('admin/view-album-images'));
                }
            }
            else{
                customFlash('alert-warning','Something went wrong; please try again later.');
                return redirect()->to(site_url('admin/view-album-images'));
            }
        }
        else{
            customFlash('alert-warning','Please login first.');
            return redirect()->to(site_url('admin/login'));
        }

    }
    private function deleteImage($image)
    {
        if (file_exists($image))
        {
            if (unlink($image)) {
                return true;
            }
            else{
                return false;
            }

        }
        else{
            return false;
        }
    }

    /*Gallery ends here*/

    public function settings()
    {
        if (isAdmin()){
            $data['title'] =  'Website settingss' .PROJECT;
            $data['description'] = 'Website settings Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/settings',$data);
            echo view('admin/footer/footer');
            echo view('admin/endfooter/endfooter');

        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }
    public function addsettings()
    {

        if (isAdmin()){
            $validation = $this->validator;
            $request = $this->request;
            if (!$this->validate($validation->getRuleGroup('websiteSettings'))) {
               $this->settings();
            }
            else{
                $data['st_email'] = $request->getPost('email');
                $data['st_phone'] = $request->getPost('phone');
                $data['st_address'] = $request->getPost('address');
                $data['st_what_we_do'] = $request->getPost('wwdo');
                $data['st_how_it_works'] = $request->getPost('hiw');
                $data['st_recent_news'] = $request->getPost('rnews');
                $data['st_recent_events'] = $request->getPost('revent');
                $data['st_calendar'] = $request->getPost('ecal');
                $data['st_footer_cotnent'] = $request->getPost('footer_content');

                $data['admin_id'] = getAdminId();
                $tableSettings = new Settings();
                $checkSettings = $tableSettings->where('st_status',1)->findAll();
                if (count($checkSettings) == 1) {
                    customFlash('alert-warning','The setting already exists; please update settings. ');
                    return redirect()->to(site_url('admin/settings'));
                }
                else{

                    $favicon= $this->request->getFile('favicon');
                    if (!empty($favicon) && $favicon->getSize() > 0) {
                        $profileFileName = $favicon->getRandomName();
                        $favicon->move('./public/assets/images',$profileFileName);
                        $data['st_fav_icon'] = $profileFileName;
                    }
                    else{
                        customFlash('alert-warning','Favicon is required; please upload a favicon');
                        return redirect()->to(site_url('admin/settings'));
                    }
                    $logoPic = $this->request->getFile('logo');
                    if (!empty($logoPic) && $logoPic->getSize() > 0) {
                        $profileFileName = $logoPic->getRandomName();
                        $logoPic->move('./public/assets/images',$profileFileName);
                        $data['st_logo'] = $profileFileName;
                    }else{
                        customFlash('alert-warning','The logo is required, please upload a logo');
                        return redirect()->to(site_url('admin/settings'));
                    }

                    $isAlbum = $tableSettings->insert($data);
                    if ($isAlbum) {
                        customFlash('alert-success','You have successfully inserted the settings.');
                        return redirect()->to(site_url('admin/allsettings'));
                    }
                    else{
                        customFlash('alert-warning','Something went wrong please try again');
                        return redirect()->to(site_url('admin/settings'));
                    }

                }
            }
        }
        else{
            customFlash('alert-warning','Please login with access the admin panel.');
            return redirect()->to(site_url('admin/login'));
        }

    }
    public function allsettings()
    {
        if (isAdmin()){
            $tableSettings = new Settings();
            $data['websiteSettings'] = $tableSettings->where('st_status',1)->findAll();
            $data['title'] =  'All website settings' .PROJECT;
            $data['description'] = 'All website settings Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/allsettings',$data);
            echo view('admin/footer/footer');
            echo view('admin/endfooter/endfooter');

        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }
    public function updatesetting()
    {

        if (isAdmin()){
            $validation = $this->validator;
            $request = $this->request;
            if (!$this->validate($validation->getRuleGroup('websiteSettings'))) {
                $this->settings();
            }
            else{
                $data['st_email'] = $request->getPost('email');
                $data['st_phone'] = $request->getPost('phone');
                $data['st_address'] = $request->getPost('address');
                $data['st_what_we_do'] = $request->getPost('wwdo');
                $data['st_how_it_works'] = $request->getPost('hiw');
                $data['st_recent_news'] = $request->getPost('rnews');
                $data['st_recent_events'] = $request->getPost('revent');
                $data['st_calendar'] = $request->getPost('ecal');
                $data['st_footer_cotnent'] = $request->getPost('footer_content');
                $settingID = $request->getPost('xmp');//setting id
                $favOld = $request->getPost('st_fav_icon');
                $logoOld = $request->getPost('st_logo');

                $data['admin_id'] = getAdminId();
                $tableSettings = new Settings();
                $checkSettings = $tableSettings->where('st_status',1)->findAll();
                if (count($checkSettings) == 1) {
                    $favicon= $this->request->getFile('favicon');
                    if (!empty($favicon) && $favicon->getSize() > 0) {
                        $profileFileName = $favicon->getRandomName();
                        $favicon->move('./public/assets/images',$profileFileName);
                        $data['st_fav_icon'] = $profileFileName;
                    }

                    $logoPic = $this->request->getFile('logo');
                    if (!empty($logoPic) && $logoPic->getSize() > 0) {
                        $profileFileName = $logoPic->getRandomName();
                        $logoPic->move('./public/assets/images',$profileFileName);
                        $data['st_logo'] = $profileFileName;
                    }


                    $isAlbum = $tableSettings->update($settingID,$data);
                    if ($isAlbum) {
                        if (!empty($favOld)){
                            if (file_exists('./public/assets/images'.$favOld))
                            {
                                unlink('./public/assets/images'.$favOld);
                            }
                        }
                        if (!empty($logoOld)){
                            if (file_exists('./public/assets/images'.$logoOld))
                            {
                                unlink('./public/assets/images'.$logoOld);
                            }
                        }
                        customFlash('alert-success','You have successfully updated the settings.');
                        return redirect()->to(site_url('admin/allsettings'));
                    }
                    else{
                        customFlash('alert-warning','Something went wrong please try again');
                        return redirect()->to(site_url('admin/allsettings'));
                    }

                }
                else{

                    customFlash('alert-warning','The setting id does not exist; please update settings.');
                    return redirect()->to(site_url('admin/allsettings'));

                }
            }
        }
        else{
            customFlash('alert-warning','Please login with access the admin panel.');
            return redirect()->to(site_url('admin/login'));
        }

    }
    public function deletesettings($id)
    {
        if (isAdmin()){
            if (!empty($id) && isset($id)) {
                $tableGallery = new ModGallery();
                $tableGalleryImages = new ModGalleryImages();
                $isGallery = $tableGallery->where(['gl_id'=>$id])->findAll();
                //$isnews = $this->modAdmin->checkAlbumById($id);
                if (count($isGallery) === 1) {
                    // $allAlbumImage = $this->modAdmin->getAllAlbumImages($id);
                    $allAlbumImage = $tableGalleryImages->where(['gallery_id'=>$id])->findAll();
                    //var_dump($allTenderImage->num_rows());
                    //die();
                    $isDeleted = $tableGallery->delete($id);
                    //$events = $this->modAdmin->deleteAlbum($id);
                    if ($isDeleted) {
                        if (count($allAlbumImage) > 0) {
                            foreach ($allAlbumImage as $album) {
                                $imagePath = realpath(APPPATH . '../public/assets/images/galleryImages/'.$album['gi_name']);
                                if (file_exists($imagePath))
                                {
                                    unlink($imagePath);

                                }

                            }
                        }
                        customFlash('alert-success','Your album has been deleted.');
                        return redirect()->to(site_url('admin/all-albums'));
                    }
                    else{
                        customFlash('alert-warning','You can\'t delete the album right now; please try again.');
                        return redirect()->to(site_url('admin/all-albums'));
                    }


                }
                else{
                    customFlash('alert-warning','The album is not available; please try again.');
                    return redirect()->to(site_url('admin/all-albums'));
                }
            }
            else{
                customFlash('alert-warning','Some thing went wrong.');
                return redirect()->to(site_url('admin/all-albums'));
            }
        }
        else{
            customFlash('alert-warning','Please login first.');
            return redirect()->to(site_url('admin/login'));
        }
    }
    public function editsettings($id)
    {
        if (isAdmin()){
            if (!empty($id) && isset($id)) {
                $tableGallery = new ModGallery();
                $tableGallery->fatchAllAlbums();
                $isGallery = $tableGallery->where(['gl_id'=>$id])->findAll();
                if (count($isGallery) === 1) {
                    $data['album'] = $isGallery  ;
                    $data['title'] =  'Edit website settings' .PROJECT;
                    $data['description'] = 'Edit website settings Description here';
                    echo view('admin/header/header',$data);
                    echo view('admin/css/css');
                    echo view('admin/navbar/navbartop');
                    echo view('admin/navbar/navbar_left');
                    echo view('admin/content/editAlbum',$data);
                    echo view('admin/footer/footer');
                    echo view('admin/endfooter/endfooter');
                }
                else{
                    customFlash('alert-warning','The Album is not available; please try again.');
                    return redirect()->to(site_url('admin/all-albums'));
                }
            }
            else{
                customFlash('alert-warning','Something went wrong.');
                return redirect()->to(site_url('admin/all-albums'));
            }
        }
        else{
            customFlash('alert-warning','Please log in first.');
            return redirect()->to(site_url('admin/login'));
        }

    }
    public function updatesettings()
    {
        if (isAdmin()){
            $validation = $this->validator;
            $request = $this->request;
            $formVal = $validation->getRuleGroup('addNewAlbum');
            $formVal['status']='required|integer';
            if (!$this->validate($formVal))
            {
                customFlash('alert-danger','Please check the required field and try again.');
                return redirect()->to(site_url('admin/all-albums'));
            }
            else
            {
                $data['gl_name'] = $request->getPost('album');
                $data['gl_status'] = $request->getPost('status');
                $galleryId = $request->getPost('xdi');

                $data['admin_id'] = getAdminId();
                $tableGallery = new ModGallery();
                $checkAlbums = $tableGallery->checkAlbums($data,$galleryId);
                if (count($checkAlbums) > 0) {
                    customFlash('alert-danger', $data['gl_name']. ' album already exists.');
                    return redirect()->to(site_url('admin/all-albums'));
                }
                else{
                    $updateAlbum = $tableGallery->update($galleryId,$data);
                    if ($updateAlbum) {
                        customFlash('alert-success','You have successfully update');
                        return redirect()->to(site_url('admin/all-albums'));
                    }
                    else{
                        customFlash('alert-danger','Your can\'t update your tender right now. Please try again.');
                        return redirect()->to(site_url('admin/all-albums'));
                    }
                }

            }
        }
        else{
            customFlash('alert-warning','Please login first.');
            return redirect()->to(site_url('admin/login'));
        }
    }

    /*Slider code starts here*/
    public function newslider()
    {
        if (isAdmin()){
            $data['title'] =  'New Slider ' .PROJECT;
            $data['description'] = 'New Slider Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            //echo view('admin/css/quill');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/newslider',$data);
            echo view('admin/footer/footer');
            //echo view('admin/css/quilljs');
            echo view('admin/endfooter/endfooter');
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function addslider()
    {
        if (isAdmin()){
            $tableSliders =  new Sliders();
            $validation = $this->validator;
            $request = $this->request;
            if (!$this->validate($validation->getRuleGroup('sliders')))
            {
                $this->newslider();
            }
            else
            {
                $newSlider = [
                    'sl_title'=>$request->getPost('title'),
                    'sl_description'=> base64_encode($request->getPost('text')),
                    'sl_button_text'=>$request->getPost('buttonText'),
                    'sl_button_url'=>$request->getPost('buttonUrl'),
                    'admin_id'=> getAdminId()
                ];

                $messageImage = $request->getFile('image');
                if (!empty($messageImage) && $messageImage->getSize() > 0)
                {
                    $newSlider['sl_dp'] = $messageImage->getRandomName();
                    $messageImage->move('./public/assets/images/sliders',$newSlider['sl_dp']);
                }
                else
                {
                    customFlash('alert-danger','Please select your image and try again.');
                    return redirect()->to(site_url('admin/new-slider'));
                }

                $checkMessage = $tableSliders->where(['sl_title'=>$newSlider['sl_title']])->findAll();
                if (count($checkMessage) > 0) {
                    customFlash('alert-info','The Slider is already exist.');
                    return redirect()->to(site_url('admin/new-slider'));
                }
                else{
                    $isInserted = $tableSliders->insert($newSlider);
                    if ($isInserted) {
                        customFlash('alert-success','You have successfully inserted.');
                        return redirect()->to(site_url('admin/new-slider'));
                    }
                    else{
                        customFlash('alert-info','OOps..! something went wrong please try again.');
                        return redirect()->to(site_url('admin/new-slider'));
                    }
                }

            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }


    public function allslider()
    {
        if (isAdmin()){
            $tableSliders =  new Sliders();
            $tableSliders->select('sliders.*')
                ->orderBy('sl_id','desc');
            $data = [
                'sliders' => $tableSliders->paginate(20),
                'pager' => $tableSliders->pager
            ];
            $data['title'] =  'All sliders ' .PROJECT;
            $data['description'] = 'All sliders Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/datePicker');
            echo view('css/bootstrapSelect');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/allslider',$data);
            echo view('admin/footer/footer');
            echo view('admin/js/datePicker');
            echo view('js/bootstrapSelect');
            echo view('admin/endfooter/endfooter');

        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }

    public function editslider($id)
    {
        if (isAdmin()){

            if (!empty($id) && isset($id)) {
                $tableSliders =  new Sliders();
                $isHIT = $tableSliders->where(['sl_id'=>$id])->findAll();
                if (count($isHIT) === 1) {
                    $data['HIT'] = $isHIT  ;
                    $data['title'] =  'Edit Slider | ' . PROJECT;
                    $data['description'] = 'Edit sliders Description here';
                    echo view('admin/header/header',$data);
                    echo view('admin/css/css');
                    //echo view('admin/css/quill');
                    echo view('admin/navbar/navbartop');
                    echo view('admin/navbar/navbar_left');
                    echo view('admin/content/editslider',$data);
                    echo view('admin/footer/footer');
                    //echo view('admin/css/quilljs');
                    echo view('admin/endfooter/endfooter');

                }
                else{
                    customFlash('alert-info','The Slider is not available; please try again.');
                    return redirect()->to(site_url('admin/all-slider'));
                }
            }
            else{
                customFlash('alert-info','Something went wrong, and please try again later.');
                return redirect()->to(site_url('admin/all-slider'));
            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }

    public function updateslider()
    {
        if (isAdmin()){
            $tableSliders =  new Sliders();
            $validation = $this->validator;
            $request = $this->request;
            $addStatus = $validation->getRuleGroup('sliders');
            $addStatus['status'] = 'required|integer';
            if (!$this->validate($addStatus))
            {
                customFlash('alert-info','Please check the required fields and try again');
                return redirect()->to(site_url('admin/all-slider'));
            }
            else
            {
                $oldImage = $request->getPost('dimgo');
                $sliderId = $request->getPost('xeew');
                $editSlider = [
                    'sl_title'=>$request->getPost('title'),
                    'sl_description'=> base64_encode($request->getPost('text')),
                    'sl_button_text'=>$request->getPost('buttonText'),
                    'sl_button_url'=>$request->getPost('buttonUrl'),
                    'admin_id'=> getAdminId()
                ];

                if (!empty($sliderId) && isset($sliderId)) {

                    $checkMessage = $tableSliders->where([
                        'sl_title'=>$editSlider['sl_title'],
                        'sl_id !='=>$sliderId
                    ])->findAll();
                    if (count($checkMessage) > 0) {
                        customFlash('alert-info','Slider already exist.');
                        return redirect()->to(site_url('admin/edit-slider/'.$sliderId));
                    }
                    else{
                        $messageImage = $request->getFile('image');
                        if (!empty($messageImage) && $messageImage->getSize() > 0)
                        {

                            $editSlider['sl_dp'] = $messageImage->getRandomName();
                            $messageImage->move('./public/assets/images/sliders',$editSlider['sl_dp']);
                        }//checking image if selected.


                        $isUpdated = $tableSliders->update($sliderId,$editSlider);
                        if ($isUpdated) {
                            if (isset($editSlider['sl_dp']) && !empty($editSlider['sl_dp'])) {
                                $imagePath = realpath(APPPATH . '../public/assets/images/sliders/');
                                if (file_exists($imagePath.'/'.$oldImage))
                                {
                                    unlink($imagePath.'/'.$oldImage);
                                }
                            }
                            //dd();
                            customFlash('alert-success','You have successfully updated.');
                            return redirect()->to(site_url('admin/all-slider'));
                        }
                        else{
                            customFlash('alert-success','Oops..! something went wrong; please try again.');
                            return redirect()->to(site_url('admin/all-slider'));
                        }
                    }

                }
                else{
                    customFlash('alert-info','Something went wrong please try again');
                    return redirect()->to(site_url('admin/all-slider'));

                }

            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }
    }
    /*Slider code ends here*/

    /*Calendar code starts here*/
    public function newCalendar()
    {
        if (isAdmin()){
            $tableNewEvents = new ModNewEvents();
            $data['allEvents'] = $tableNewEvents->where('ne_category','events')
                ->where('ne_status',1)
                ->findAll();
            $data['title'] =  'New Calendar ' . PROJECT;
            $data['description'] = 'New Calendar Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/datePicker');
            echo view('css/bootstrapSelect');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/newCalendar',$data);
            echo view('admin/footer/footer');
            echo view('admin/js/datePicker');
            echo view('js/bootstrapSelect');
            echo view('admin/endfooter/endfooter');

        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }
    public function addCalendar()
    {

        if (isAdmin()){
            $validation = $this->validator;
            $request = $this->request;
            if (!$this->validate($validation->getRuleGroup('addNewCalendar'))) {
                customFlash('alert-warning','Please check required fields and try again.');
                return redirect()->to(site_url('admin/new-calendar'));
            }
            else{
                $data['title'] = $request->getPost('title');
                $data['start_date'] = $request->getPost('stdate');
                $data['end_date'] = $request->getPost('endate');
                $data['events_id'] = $request->getPost('eventId');
                $data['admin_id'] = getAdminId();
                $tableEventsCalendar = new ModEvents();
                $checkLanguage = $tableEventsCalendar->checkCalendar($data);
                if (count($checkLanguage) > 0) {
                    customFlash('alert-warning','This ' . $data['title'] . ' calendar is already exist.');
                    return redirect()->to(site_url('admin/new-calendar'));
                }
                else{
                    //var_dump($data);
                    //dd();
                    $isAlbum = $tableEventsCalendar->insert($data);
                    //$addlanguage = $this->modAdmin->addAlbum($data);
                    if ($isAlbum) {
                        customFlash('alert-success','You have successfully inserted the calendar');
                        return redirect()->to(site_url('admin/new-calendar'));
                    }
                    else{
                        customFlash('alert-warning','Something went wrong please try again');
                        return redirect()->to(site_url('admin/new-calendar'));
                    }

                }
            }
        }
        else{
            customFlash('alert-warning','Please login with access the admin panel.');
            return redirect()->to(site_url('admin/login'));
        }

    }
    public function allCalendar()
    {
        if (isAdmin()){
            $tableEventsCalender = new ModEvents();
            $tableEventsCalender->fatchAllCalendar();
            $data = [
                'allEvents' => $tableEventsCalender->paginate(20),
                'pager' => $tableEventsCalender->pager
            ];

            $data['title'] =  'All Calendar ' . PROJECT;
            $data['description'] = 'All Calendar Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/quill');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/allCalendar',$data);
            echo view('admin/footer/footer');
            echo view('admin/css/quilljs');
            echo view('admin/endfooter/endfooter');
        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }
    public function deleteCalendar($id)
    {
        if (isAdmin()){
            if (!empty($id) && isset($id)) {
                $tableCalendarEvent = new ModEvents();
                $isCalendarEvent = $tableCalendarEvent->where(['ev_id'=>$id])->findAll();
                //$isnews = $this->modAdmin->checkAlbumById($id);
                if (count($isCalendarEvent) === 1) {
                    // $allAlbumImage = $this->modAdmin->getAllAlbumImages($id);
                    //var_dump($allTenderImage->num_rows());
                    //die();
                    $isDeleted = $tableCalendarEvent->delete($id);
                    //$events = $this->modAdmin->deleteAlbum($id);
                    if ($isDeleted) {
                        customFlash('alert-success','Your Calendar has been deleted.');
                        return redirect()->to(site_url('admin/all-calendar'));
                    }
                    else{
                        customFlash('alert-warning','You can\'t delete the calendar right now; please try again.');
                        return redirect()->to(site_url('admin/all-calendar'));
                    }


                }
                else{
                    customFlash('alert-warning','The calendar is not available; please try again.');
                    return redirect()->to(site_url('admin/all-calendar'));
                }
            }
            else{
                customFlash('alert-warning','Some thing went wrong.');
                return redirect()->to(site_url('admin/all-calendar'));
            }
        }
        else{
            customFlash('alert-warning','Please login first.');
            return redirect()->to(site_url('admin/login'));
        }
    }
    public function editCalendar($id)
    {
        if (isAdmin()){
            if (!empty($id) && isset($id)) {
                $tableCalendar = new ModEvents();
                $tableNewEvents = new ModNewEvents();
                $data['allEvents'] = $tableNewEvents->where('ne_category',
                    'events')
                    ->where('ne_status',1)
                    ->findAll();
                $isCalenar = $tableCalendar->where(['ev_id'=>$id])->findAll();
                if (count($isCalenar) === 1) {
                    $data['calendar'] = $isCalenar  ;
                    $data['title'] =  'Edit Calendar ' . PROJECT;
                    $data['description'] = 'Edit Calendar Description here';

                    echo view('admin/header/header',$data);
                    echo view('admin/css/css');
                    echo view('admin/navbar/navbartop');
                    echo view('admin/navbar/navbar_left');
                    echo view('admin/content/editCalendar',$data);
                    echo view('admin/footer/footer');
                    echo view('admin/endfooter/endfooter');
                }
                else{
                    customFlash('alert-warning','The Album is not available; please try again.');
                    return redirect()->to(site_url('admin/all-albums'));
                }
            }
            else{
                customFlash('alert-warning','Something went wrong.');
                return redirect()->to(site_url('admin/all-albums'));
            }
        }
        else{
            customFlash('alert-warning','Please log in first.');
            return redirect()->to(site_url('admin/login'));
        }

    }
    public function updateCalendar()
    {
        if (isAdmin()){
            $validation = $this->validator;
            $request = $this->request;
            $formVal = $validation->getRuleGroup('addNewCalendar');
            $formVal['status']='required|integer';
            /*$data['title'] = $request->getPost('title');
            $data['start_date'] = $request->getPost('stdate');
            $data['end_date'] = $request->getPost('endate');
            $data['events_id'] = $request->getPost('eventId');
            $ev_status = $request->getPost('status');

            var_dump($formVal);
            echo '<br><br>';
            var_dump($data);
            echo '<br><br>';
            var_dump($ev_status);
            dd();*/
            if (!$this->validate($formVal))
            {
                customFlash('alert-danger','Please check the required field and try again.');
                return redirect()->to(site_url('admin/all-calendar'));
            }
            else
            {
                $data['title'] = $request->getPost('title');
                $data['start_date'] = $request->getPost('stdate');
                $data['end_date'] = $request->getPost('endate');
                $data['events_id'] = $request->getPost('eventId');
                $ev_status = $request->getPost('status');
                if (isset($ev_status) && !empty($ev_status) && $ev_status == 7) {
                    $data['ev_status'] = 0;
                }
                else{
                    $data['ev_status'] = $ev_status;
                }
                $calendarId = $request->getPost('xdi');

                $data['admin_id'] = getAdminId();
                $tableEventsCalendar = new ModEvents();
                $checkAlbums = $tableEventsCalendar->checkCalendar($data,$calendarId);
                if (count($checkAlbums) > 0) {
                    customFlash('alert-danger', $data['gl_name']. ' calendar already exists.');
                    return redirect()->to(site_url('admin/all-calendar'));
                }
                else{
                    $updateAlbum = $tableEventsCalendar->update($calendarId,$data);
                    if ($updateAlbum) {
                        customFlash('alert-success','You have successfully update');
                        return redirect()->to(site_url('admin/all-calendar'));
                    }
                    else{
                        customFlash('alert-danger','Your can\'t update your tender right now. Please try again.');
                        return redirect()->to(site_url('admin/all-calendar'));
                    }
                }

            }
        }
        else{
            customFlash('alert-warning','Please login first.');
            return redirect()->to(site_url('admin/login'));
        }
    }
    /*Calendar code ends here*/

    public function deletenewsevent($id)
    {
        if (isAdmin()){
            if (!empty($id) && isset($id)) {
                $tableNewEvents = new ModNewEvents();
                $isNewsEvent = $tableNewEvents->where(['ne_id'=>$id])->findAll();
                if (count($isNewsEvent) === 1) {
                    $isDeleted = $tableNewEvents->delete($id);
                    if ($isDeleted) {

                        customFlash('alert-success','Your album has been deleted.');
                        return redirect()->to(site_url('admin/all-news-and-events'));
                    }
                    else{
                        customFlash('alert-warning','You can\'t delete the album right now; please try again.');
                        return redirect()->to(site_url('admin/all-news-and-events'));
                    }


                }
                else{
                    customFlash('alert-warning','The album is not available; please try again.');
                    return redirect()->to(site_url('admin/all-news-and-events'));
                }
            }
            else{
                customFlash('alert-warning','Some thing went wrong.');
                return redirect()->to(site_url('admin/all-news-and-events'));
            }
        }
        else{
            customFlash('alert-warning','Please login first.');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function newCountry()
    {
        if (isAdmin()){
            $data['title'] =  'New Album ' .PROJECT;
            $data['description'] = 'New Album Description here';
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/newCountry',$data);
            echo view('admin/footer/footer');
            echo view('admin/endfooter/endfooter');

        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }

    public function addCountry()
    {
        if (isAdmin()) {
            $validation = $this->validator;
            $request = $this->request;
            if (!$this->validate($validation->getRuleGroup('country'))) {
                $this->newCountry();
            }
            else{
                $mycountry = [
                    'co_name'=>$request->getPost('country_name'),
                    'co_slug'=>$request->getPost('country_slug'),
                    'co_status'=>$request->getPost('status'),
                    'admin_id'=>getAdminId(),
                ];
                $countries = new ModCountries();
                $checkManuf = $countries->where('co_slug',$mycountry['co_slug'])->findAll();
                if (count($checkManuf) > 0) {
                    customFlash('alert-danger','Country Already exist');
                    return redirect()->to(site_url('admin/newCountry'));
                }
                else{
                    $ifInserted = $countries->insert($mycountry);
                    $db = db_connect();
                    // echo $db->getLastQuery();
                    if ($ifInserted) {
                        customFlash('alert-success','You have successfully inserted the Country.');
                        return redirect()->to(site_url('admin/newCountry'));
                    }
                    else{
                        customFlash('alert-danger','You can\'t add the Country right now, please try again.');
                        return redirect()->to(site_url('admin/newCountry'));
                    }
                }
            }
        }
        else{
            customFlash('alert-danger','Please Login Before Accessing the admin panel.');
            return redirect()->to(site_url('admin/login'));
        }
    }


    public function countries()
    {
        if (isAdmin()){
            $request = $this->request;
            $countries = new ModCountries();
            $countries->select('*');
            $searchKey =   $request->getGet('s');
            if (isset($searchKey) && !empty($searchKey)) {
                $countries->like('co_name',$searchKey);
            }
            $data = [
                'countries' => $countries->paginate(50),
                'pager' => $countries->pager
            ];
            $data['title'] =  'All Countries ' .PROJECT;
            $data['description'] = 'All Countries Description here';
            $data['filtrs'] = $this->filterWhereForview();
            echo view('admin/header/header',$data);
            echo view('admin/css/css');
            echo view('admin/css/quill');
            echo view('admin/navbar/navbartop');
            echo view('admin/navbar/navbar_left');
            echo view('admin/content/countries',$data);
            echo view('admin/footer/footer');
            echo view('admin/css/quilljs');
            echo view('admin/endfooter/endfooter');
        }
        else{
            customFlash('alert-danger','Please login first to access the admin panel');
            return redirect()->to(site_url('admin/login'));
        }

    }

    public function deleteCountry($id)
    {
        if (isAdmin()){
            if (!empty($id) && isset($id)) {
                $tableCountries = new ModCountries();
                $isNewsEvent = $tableCountries->where(['co_id'=>$id])->findAll();
                if (count($isNewsEvent) === 1) {
                    $isDeleted = $tableCountries->delete($id);
                    if ($isDeleted) {

                        customFlash('alert-success','Your country has been deleted.');
                        return redirect()->to(site_url('admin/countries'));
                    }
                    else{
                        customFlash('alert-warning','You can\'t delete the country right now; please try again.');
                        return redirect()->to(site_url('admin/countriess'));
                    }


                }
                else{
                    customFlash('alert-warning','The country is not available; please try again.');
                    return redirect()->to(site_url('admin/countries'));
                }
            }
            else{
                customFlash('alert-warning','Some thing went wrong.');
                return redirect()->to(site_url('admin/countries'));
            }
        }
        else{
            customFlash('alert-warning','Please login first.');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function editCountry($id)
    {
        if (isAdmin()) {
            $country = new ModCountries();
            $data['country'] = $country->where('co_id',$id)->findAll();
            if (count($data['country']) === 1) {
                echo view('admin/header/header',$data);
                echo view('admin/css/css');
                echo view('admin/navbar/navbartop');
                echo view('admin/navbar/navbar_left');
                echo view('admin/content/editCountry',$data);
                echo view('admin/footer/footer');
                echo view('admin/endfooter/endfooter');

            }
            else{
                customFlash('alert-danger','country not found.');
                return redirect()->to(site_url('admin/categories'));
            }
        }
        else{
            customFlash('alert-danger','Please Login Before Accessing the admin panel.');
            return redirect()->to(site_url('admin/login'));
        }
    }

    public function updateCountry()
    {
        if (isAdmin()) {
            $validation = $this->validator;
            $request = $this->request;
            $session =  $this->session;
            $addNewRules = $validation->getRuleGroup('country');
            //var_dump($myarray);
            //die();
            $addNewRules['xkuzj'] = 'required|integer';
            if (!$this->validate($addNewRules)) {
                //$this->newCategory();
                customFlash('alert-danger','Please check your required fields and try again.');
                return redirect()->to(site_url('admin/countries'));
            }
            else{
                $mycountry = [
                    'co_name'=>$request->getPost('country_name'),
                    'co_slug'=>$request->getPost('country_slug'),
                    'co_status'=>$request->getPost('status'),
                    'admin_id'=>getAdminId(),
                ];
                $countries = new ModCountries();
                $checkAdmin = $countries->where(array(
                    'co_slug'=>$mycountry['co_slug'],
                    'co_id !='=>$request->getPost('xkuzj'),
                ))
                    ->findAll();
                if (count($checkAdmin) > 0) {
                    customFlash('alert-danger','Your Country Already exist');
                    return redirect()->to(site_url('admin/countries'));
                }
                else{

                    //die();
                    $ifupdated = $countries->update($request->getPost('xkuzj'),$mycountry);
                    //$db = db_connect();
                    // echo $db->getLastQuery();
                    if ($ifupdated) {
                        customFlash('alert-success','You have successfully updated the  country.');
                        return redirect()->to(site_url('admin/countries'));
                    }
                    else{
                        customFlash('alert-danger','You can\'t add the country right now, please try again.');
                        return redirect()->to(site_url('admin/countries'));
                    }
                }
            }
        }
        else{
            customFlash('alert-danger','Please Login Before Accessing the admin panel.');
            return redirect()->to(site_url('admin/login'));
        }
    }

}//class here
