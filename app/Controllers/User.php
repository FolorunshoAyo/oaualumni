<?php
namespace App\Controllers;
use App\Models\ModCountries;
use App\Models\ModEvents;
use App\Models\ModGallery;
use App\Models\ModGalleryImages;
use App\Models\ModSubscribers;
use App\Models\ModUsers;
class User extends BaseController
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

    public function getBirthdayUsers(){
        $tableUsers = new ModUsers();

        $currentMonth = date('m');
        $birthdayUsers = $tableUsers->where('MONTH(u_dob)', $currentMonth)->findAll();

        $data = "";

        if (count($birthdayUsers) > 0) {
            $data =[
                'status' => 'success',
                'data' => $birthdayUsers
            ];
        } else {
            $data = [
                'status' => 'success',
                'message' => 'No users have birthdays this month.',
                'data' => []
            ];
        }

        echo json_encode($data);
    }

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

    public function checkuser()//actual login system
    {
        if (isUserLoggedIn()) {
            return redirect()->to(site_url('user'));
        } else {
            $validation = $this->validator;
            $request = $this->request;
            $session =  $this->session;
            $tableUser =  new ModUsers();
            if (!$this->validate($validation->getRuleGroup('login')))
            {
                $this->login();
            }
            else
            {
                $loginUser = [
                    'u_email'=>$request->getPost('email'),
                    'u_password'=>md5($request->getPost('password')),
                ];
                $user = $tableUser->where('u_email',$loginUser['u_email'])
                    ->findAll();
                if (count($user) == 1){
                    if ($loginUser['u_password'] === $user[0]['password']
                    ){
                        switch ($user[0]['u_status']){
                            case 0:
                                $session->set('activationLink',$user[0]['u_email']);
                                customFlash('alert-warning','Your account is not activated, Please ' .anchor('user/sendLink','Activate',''). ' your account and try again.');
                                return redirect()->to(site_url('login'));
                                break;
                            case 1:
                                $userdata['u_id'] = $user[0]['u_id'];
                                $userdata['user_name'] = $user[0]['user_name'];
                                $userdata['u_first_name'] = $user[0]['u_first_name'];
                                $userdata['u_last_name'] = $user[0]['u_last_name'];
                                $userdata['user_name'] = $user[0]['user_name'];
                                $userdata['u_mobile'] = $user[0]['u_mobile'];

                                $userdata['u_date'] = $user[0]['u_date'];
                                $userdata['u_email'] = $user[0]['u_email'];
                                $userdata['u_dp'] = $user[0]['u_dp'];

                                $session->set($userdata);
                                if (userLoggedIn()){
                                    return redirect()->to(site_url('user'));
                                }
                                else{
                                    customFlash('alert-warning','Something went wrong please try again.');
                                    return redirect()->to(site_url('login'));
                                }
                                break;
                            case 2:
                                customFlash('alert-warning','Your account is blocked due to some reasons, please contact with Admin.');
                                return redirect()->to(site_url('login'));
                                break;
                            default:
                                customFlash('alert-warning','Something went wrong please try again');
                                return redirect()->to(site_url('login'));
                                break;
                        }
                    }
                    else{
                        customFlash('alert-warning','Your password is invalid please check your password and try again.');
                        return redirect()->to(site_url('login'));
                    }
                }
                else{
                    customFlash('alert-warning','Please check your email/referral ID OR password and try again.');
                    return redirect()->to(site_url('login'));
                }
            }
        }

    }
    public function register()
    {
        if (!userLoggedIn()) {
            $tableCountries = new ModCountries();
            $data['countries'] = $tableCountries->where('co_status',1)->findAll();
            $data['ref'] = '';
            $request = $this->request;
            $data['title'] = 'Register' . PROJECT;
            $data['description'] = 'Register';

            $data['days'] = array_combine(range(1, 31), range(1, 31));

            $data['months'] = [
                1  => 'January',
                2  => 'February',
                3  => 'March',
                4  => 'April',
                5  => 'May',
                6  => 'June',
                7  => 'July',
                8  => 'August',
                9  => 'September',
                10 => 'October',
                11 => 'November',
                12 => 'December',
            ];

            echo view('header/header',$data);
            echo view('css/allCSS');
            echo view('css/phone');
            echo view('css/formValidation');
            echo view('header/navbar');
            echo view('users/register',$data);
            echo view('content/subscribed');
            echo view('footer/footer');
            echo view('js/phone');
            echo view('js/formValidation');
            echo view('js/userRegister');
            echo view('footer/endfooter');

        }
        else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }

    }
    public function index()
    {
        if (userLoggedIn()) {
            $tableUsers = new ModUsers();
            $tableGallery = new ModGallery();
            $tableEvents = new ModEvents();
            // $db      = \Config\Database::connect();
            // $builder = $db->table('events');
            // $calendarQuery = $builder->select('*')
            //     ->where('ev_status',1)
            //     ->where('ev_delete', null)
            //     ->join('newsevents','newsevents.ne_id=events.events_id')
            //     ->limit(10)->get();
            // $calendarData = $calendarQuery->getResult();
            // $data = array();

            // if (count($calendarData) > 0) {
            //     foreach ($calendarData as $key => $value) {
            //         $data['calendarData'][$key]['title'] = $value->title;
            //         $data['calendarData'][$key]['start'] = $value->start_date;
            //         $data['calendarData'][$key]['end'] = $value->end_date;
            //         $data['calendarData'][$key]['backgroundColor'] = "#DA9F37";
            //     }
            // }else{
            //     $data['calendarData'] = array();
            // }

            $data['countUsers']  = $tableUsers->where('u_status',1)->findAll();
            $data['countGallery']  = $tableGallery->where('gl_status',1)->findAll();
            $data['countEvents']  = $tableEvents->where('ev_status',1)->findAll();
            $filters['u_status'] = 1;
            $filters['u_id !='] = getUserId();
            $data['usersHome'] = $tableUsers->where($filters)->orderBy('u_id','desc')->findAll(6);
            $data['title'] = 'User' . PROJECT;
            $data['calendarData'] = hasCalendarData();


            helper('html');
            echo view('users/headnav/header',$data);
            echo view('users/css/allCSS');
            //echo view('css/phone');
            echo view('css/quickEvents');
            echo view('users/headnav/navbartop');
            echo view('users/headnav/navbarleft');
            echo view('users/content/home',$data);
            echo view('users/footer/footer');
            // echo view('js/eventsCalendar',$data);
            echo view('js/quickEvents');
            //echo view('js/phone');
            echo view('users/footer/endfooter');
        }
        else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }
    }

    public function newuser()
    {
        $validation = $this->validator;
        $request = $this->request;
        $session =  $this->session;
        $tableUser =  new ModUsers();
        if (!$this->validate($validation->getRuleGroup('register'))){
            $this->register();
        }
        else{
            $newUser['u_first_name'] = $request->getPost('first_name');
            $newUser['u_last_name'] = $request->getPost('last_name');
            $newUser['u_occupation'] = $request->getPost('occupation');
            $newUser['u_dob'] = date("Y")."-".$request->getPost('month')."-".$request->getPost('day');
            $newUser['u_address'] = $request->getPost('address');
            $newUser['u_hobbies'] = $request->getPost('hobbies');
            $newUser['country_id'] = $request->getPost('country');
            $newUser['u_spouse'] = $request->getPost('spouse') ?? null;
            $newUser['u_mobile'] = $request->getPost('realPhone');
            $newUser['u_emergency_phone'] = $request->getPost('emergencyPhone');

            $newUser['u_email'] = $request->getPost('email');
            $newUser['password'] = $request->getPost('password');
            $newUser['u_agree'] = $request->getPost('accept');
            //var_dump($newUser);
            //dd();
            $user = $tableUser->where(['u_email'=>$newUser['u_email']])->findAll();

            if ($user && count($user) == 1){
                if ($user[0]['u_status'] == 0){
                    customFlash('alert-warning','This email <strong> ' . $user[0]['u_email'] . ' </strong> already registered but its not verified.');
                    return redirect()->to(site_url('register'));
                }
                else if ($user[0]['u_status'] == 2){
                    customFlash('alert-warning','This email <strong> ' . $user[0]['u_email'] . ' </strong> address is blocked due to some reasons, please contact with admin.');
                    return redirect()->to(site_url('register'));
                }
                else if ($user[0]['u_status'] == 3){
                    customFlash('alert-warning','This email <strong> ' . $user[0]['u_email'] . ' </strong> address is permanently blocked due to some reasons.');
                    return redirect()->to(site_url('register'));
                }
                else{
                    customFlash('alert-warning','This email <strong> ' . $user[0]['u_email'] . ' </strong> address is already active Please login Now.');
                    return redirect()->to(site_url('login'));
                }
            }
            else{
                $newUser['password'] = hash('md5',$newUser['password']);
                $newUser['u_link'] = random_string('alnum', 20);
                $newUser['user_name'] = 'user'.random_string('numeric', 3).date('is');
                //var_dump($newUser);
                //dd();
                $userImage = $request->getFile('dp');
                if (!empty($userImage) && $userImage->getSize() > 0) {
                    $userProfilePicture = $userImage->getRandomName();
                    $userImage->move('./public/assets/images/users',$userProfilePicture);
                    $newUser['u_dp'] = $userProfilePicture;
                }
                // else{
                //     customFlash('alert-warning','A profile picture is required.');
                //     return redirect()->to(site_url('register'));
                // }


                $isUserExist = $tableUser->insert($newUser);//userId
                if ($isUserExist){
                    if (getUserAgent()) {
                        //$this->sendActivateEmail($newUser);
                        if ($this->sendActivateEmail($newUser)){
                            customFlash('alert-success','Thank you for registering with us. Kindly check your registered email for confirmation.');
                            return redirect()->to(site_url('register'));

                        }
                        else{
                            $session->set('activationLink','activationLink');
                            //$this->session->userdata('activationLink');
                            customFlash('alert-info','We can\'t send you the activate link right now on this email: <strong> ' . $newUser['u_email'] . ' </strong> Please ' . anchor('user/sendLink','Click Here') . ' to resend.');
                            return redirect()->to(site_url('register'));

                        }
                    }
                    else{
                        customFlash('alert-info','We can\'t send you the activation link right now on this email: <strong> ' . $newUser['u_email'] . ' Please contact admin so we can activate the link manually.');
                        return redirect()->to(site_url('register'));

                    }

                }
                else{
                    customFlash('alert-warning','We can\'t register you right now please try again.');
                    return redirect()->to(site_url('register'));

                }
                /*echo $data['u_who_refer'];
                echo '<br>';
                var_dump($checkUserById->num_rows());
                die();*/

            }

        }
    }

    public function confirm($value)
    {
        if (empty($value))
        {
            customFlash('alert-warning','Oops we can\'t create your account please tray again.');
            return redirect()->to(site_url('register'));
        }
        else
        {
            $tableUser =  new ModUsers();
            $ch_link = $tableUser->where(['u_link'=>$value])->findAll();
            if(count($ch_link) == 1)
            {
                $data['u_status'] = 1;
                $data['u_link']	= $value.'ok';
                $ac_acc = $tableUser->update($ch_link[0]['u_id'],$data);
                //lastQuery();
                //dd();
                if ($ac_acc)
                {
                    customFlash('alert-success','Your account is activated please login now.');
                    return redirect()->to(site_url('login'));
                }
                else
                {
                    customFlash('alert-warning','Oops we can\'t activate your account..! please tray again.');
                    return redirect()->to(site_url('register'));
                }

            }
            else
            {
                customFlash('alert-warning','The link is expired or check your email and try again');
                return redirect()->to(site_url('register'));
            }

        }

    }

    public function profile()
    {
        if (userLoggedIn()) {
            $tableCountries = new ModCountries();
            $data['countries'] = $tableCountries->where('co_status',1)->findAll();
            $data['title'] = 'Profile' . PROJECT;
            $tableUser =  new ModUsers();
            $data['userData'] = $tableUser->where('u_id',getUserId())->findAll();

            $data['days'] = array_combine(range(1, 31), range(1, 31));

            $data['months'] = [
                1  => 'January',
                2  => 'February',
                3  => 'March',
                4  => 'April',
                5  => 'May',
                6  => 'June',
                7  => 'July',
                8  => 'August',
                9  => 'September',
                10 => 'October',
                11 => 'November',
                12 => 'December',
            ];


            $dob = explode("-", $data['userData'][0]['u_dob']);

            $data['selectedDay'] = (int) $dob[2];
            $data['selectedMonth'] = (int) $dob[1];

            helper('html');
            echo view('users/headnav/header',$data);
            echo view('users/css/allCSS');
            echo view('css/formValidation');
            echo view('css/phone');
            echo view('users/headnav/navbartop');
            echo view('users/headnav/navbarleft');
            echo view('users/content/profile',$data);
            echo view('users/footer/footer');
            echo view('js/formValidation');
            echo view('js/userRegister');
            echo view('js/phone');
            echo view('users/footer/endfooter');


        }
        else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }

    }

    public function newpassword()
    {
        if (userLoggedIn()) {
            $data['title'] = 'Terms' . PROJECT;
            helper('html');
            echo view('users/headnav/header',$data);
            echo view('users/css/allCSS');
            //echo view('css/phone');
            echo view('users/headnav/navbartop');
            echo view('users/headnav/navbarleft');
            echo view('users/content/newpassword',$data);
            echo view('users/footer/footer');
            //echo view('js/phone');
            echo view('users/footer/endfooter');


        }
        else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }

    }
    public function updateUserPassword()
    {
        //var_dump('hi');
        //die();
        $validation = $this->validator;
        $request = $this->request;
        $session =  $this->session;
        $tableUser = new ModUsers();
        if (userLoggedIn()) {
            $oldPassword = $request->getPost('old_password');
            $password = $request->getPost('user_password');
            $confpass = $request->getPost('confirm_password');

            if (empty($oldPassword) || empty($password) || empty($confpass)) {
                customFlash('alert-info', 'Please check required fields.');
                return redirect()->to(site_url('user/newpassword'));
            }
            else{
                if ($password != $confpass){
                    customFlash('alert-info', 'Your password and confirm password are not the same; please confirm and try again.');
                    return redirect()->to(site_url('user/newpassword'));
                }
                else{
                    $oldPassword = hash('md5',$oldPassword);
                    $checkOldPassword['u_id']  = getUserId();
                    $checkOldPassword['password']  = $oldPassword;

                    //$userOldPassword = $this->modUser->checkOldPassword($checkOldPassword);
                    $userOldPassword = $tableUser->
                    where($checkOldPassword)
                        ->findAll();
                    //var_dump($userOldPassword);
                    //die();
                    if (count($userOldPassword) == 1) {
                        $password = hash('md5',$password);
                        $userId  = getUserId();
                        $mydata['password']  = $password;
                        $returnType = $tableUser->update($userId,$mydata);
                        //$returnType = $this->modUser->updatePassword($mydata,$userId);
                        if ($returnType)
                        {
                            customFlash('alert-success', 'You have successfully changed your password.');
                            return redirect()->to(site_url('user/newpassword'));
                        }
                        else
                        {
                            customFlash('alert-info', 'We can\'t update your password right now.');
                            return redirect()->to(site_url('user/newpassword'));

                        }
                    }else{
                        customFlash('alert-info', 'Your old password is invalid; please try again.');
                        return redirect()->to(site_url('user/newpassword'));
                    }
                }

            }//else if the fields are empty
        }
        else{
            customFlash('alert-info', 'Login before accessing your profile');
            return redirect()->to(site_url('login'));
        }

    }


    public function updateprofile()
    {
        if (userLoggedIn()) {
            $validation = $this->validator;
            $request = $this->request;
            $session =  $this->session;
            $tableUser = new ModUsers();
            //$this->form_validation->set_rules('user_name', 'User Name', 'trim|required');
            //$this->form_validation->set_rules('relPhone', 'Mobile', 'trim|required');
            //$this->form_validation->set_rules('pin', 'Security Pin', 'trim|required');
            $regValidation = $validation->getRuleGroup('profile');
            //unset($regValidation);
            //var_dump($regValidation);
            //dd();
            if (!$this->validate($regValidation)) {
                $this->profile();
            }
            else{

                $newUser['u_first_name'] = $request->getPost('first_name');
                $newUser['u_last_name'] = $request->getPost('last_name');
                $newUser['u_occupation'] = $request->getPost('occupation');
                $newUser['u_dob'] = date("Y")."-".$request->getPost('month')."-".$request->getPost('day');
                $newUser['u_address'] = $request->getPost('address');
                $newUser['u_hobbies'] = $request->getPost('hobbies');
                $newUser['u_mobile'] = $request->getPost('realPhone');
                $newUser['u_emergency_phone'] = $request->getPost('emergencyPhone');
                $newUser['country_id'] = $request->getPost('country');
                $newUser['u_spouse'] = $request->getPost('spouse');

                $old_pic = $request->getPost('xceep');

                $user = $tableUser->where('u_email',getUserSession('u_email'))->findAll();

                if (count($user) == 1) {
                    $profilePic = $this->request->getFile('dp');
                    if (!empty($profilePic) && $profilePic->getSize() > 0) {
                        $profileFileName = $profilePic->getRandomName();
                        $profilePic->move('./public/assets/images/users',$profileFileName);
                        $newUser['u_dp'] = $profileFileName;
                    }//checking image if selected.

                    $userId = getUserId(); //userId
                    //dd($newUser);
                    //$updateUserSKZ = $this->modUser->updateUserProfile($data,);
                    $updateUserSKZ = $tableUser->update($userId,$newUser);
                    if ($updateUserSKZ){
                        if (!empty($old_pic)){
                            if (file_exists('./public/assets/images/users/'.$old_pic))
                            {
                                unlink('./public/assets/images/users/'.$old_pic);
                            }
                        }
                        // $session->set($newUser);
                        customFlash('alert-success','Your profile was updated successfully');
                        return redirect()->to(site_url('user/profile'));
                    }
                    else{
                        customFlash('alert-warning','You can\'t update your profile right now please contact admin');
                        return redirect()->to(site_url('user/profile'));
                    }
                }
                else{
                    customFlash('alert-success','Your email does not exist, and please try again.');
                    return redirect()->to(site_url('user/profile'));
                }


            }//if all thing working fine

        }
        else{
            customFlash('alert-warning','Login now before accessing dashboard.');
            return redirect()->to(site_url('login'));
        }
    }
    public function logout()
    {
        $session =  $this->session;
        //$session =  $this->session;
        $session->destroy();
        return redirect()->to(base_url());
    }

    /*club script ends here*/








    public function browserEmail($data)
    {
        //var_dump($Userdata);
        $broserData['ub_ip_address'] = $data['tr_ip_address'];
        $broserData['ub_platform'] = $data['tr_platform'];
        $broserData['user_id'] = $data['section_id'];
        $broserData['ub_browser'] = $data['tr_user_agent'];

        $tableBrowserData = new ModUserBrowser();
        //
        $checkBroser = $tableBrowserData->where($broserData)->findAll();
        //var_dump($checkBroser);
        //dd();

        $broserData['ub_code'] = random_string('numeric', 6);
        $broserData['ub_link'] =  random_string('alnum', 10);
        $isInserted = $tableBrowserData->insert($broserData);
        $data['ub_code'] = $broserData['ub_code'];

        $skzData['userData'] = $data;
        //var_dump($broserData);
        $msg = view('emails/userBrowser',$skzData);
        //dd();
        $email = \Config\Services::email();
        $email->setFrom(EMAIL, PROJECT);
        $email->setTo($data['u_email']);
        $email->setSubject('['.PROJECT.'] Login Attempted from new device.'.'('. $broserData['ub_platform'].')');
        $email->setMessage($msg);//your message here

        if ($email->send()) {

            $returnData['status'] = true;
            $returnData['message'] = 'We sent you the code at your email address; if you have not received the code, 
                        please check your spam/junk folder OR '.
                anchor('login/again/'.$broserData['user_id'].'/'.$broserData['ub_link']
                    ,'click to generate a new code');
            $returnData['url'] = site_url('login/newdevice/'.$broserData['ub_link']);
            return $returnData;
            //customFlash('alert-info','Please check your email address we already sent you the code to login.');
            //return redirect()->to(site_url('login/newdevice/'.$broserData['ub_link']));
        }
        else{
            //customFlash('alert-info','Please check your email address we already sent you the code to login.');
            //return redirect()->to(site_url('login/newdevice/'.$broserData['ub_link']));
            $returnData['status'] = false;
            $returnData['message'] = 'We cannot send you the email right now, try again, and if you face the same issues, then contact the admin.';
            $returnData['url'] = site_url('login/newdevice/'.$broserData['ub_link']);

            return $returnData;
       }
        //echo view('emails/userBrowser');
    }

    public function newdevice($link)
    {
        if (!userLoggedIn()) {
            if (isset($link) && !empty  ($link)) {
                $tableBrowserData = new ModUserBrowser();
                $ifLink = $tableBrowserData->where('ub_link',$link)->findAll();
                if (count($ifLink) == 1) {
                    $data['title'] = 'New Device' . PROJECT;
                    $data['description'] = 'New Device';
                    $data['userLink'] = $link;
                    echo view('header/header',$data);
                    echo view('css/allCSS');
                    echo view('css/formValidation');
                    echo view('header/navbar');
                    echo view('users/newdevice',$data);
                    echo view('footer/footer');
                    echo view('js/formValidation');
                    echo view('users/js/newdevice');
                    echo view('footer/endfooter');
                }else{
                    customFlash('alert-info','The login link is expired OR not exist.');
                    return redirect()->to(site_url('login'));
                }

            }
            else{
                customFlash('alert-info','Please check your email for link.');
                return redirect()->to(site_url('login'));
            }


        }
        else{
            return redirect()->to(site_url('user'));
        }

    }

    public function again($userId, $link)
    {
        if (!userLoggedIn()) {
            if (isset($userId) && !empty  ($userId) & isset($link) && !empty  ($link)) {
                $tableBrowserData = new ModUserBrowser();
                $ifLink = $tableBrowserData
                    ->where('user_id',$userId)
                    ->where('ub_link',$link)
                    ->join('users','users.u_id=user_browsers.user_id')
                    ->findAll();
                if (count($ifLink) == 1) {
                    if ($ifLink[0]['ub_status'] == 0) {
                        $skzData['userData'] = array('user_name'=>$ifLink[0]['user_name'],'ub_code'=>$ifLink[0]['ub_code']);
                        //var_dump($broserData);
                        $msg = view('emails/userBrowser',$skzData);

                        $email = \Config\Services::email();
                        $email->setFrom(EMAIL, PROJECT);
                        $email->setTo($ifLink[0]['u_email']);
                        $email->setSubject('['.PROJECT.'] Login Attempted from new device.'.'('. $ifLink[0]['ub_platform'].')');
                        $email->setMessage($msg);//your message here
                        if ($email->send()) {
                            $skzMessage  = 'We sent you the code at your email address; if you have not received the code, 
                        please check your spam/junk folder OR '.
                                anchor('login/again/'.$ifLink[0]['user_id'].'/'.$ifLink[0]['ub_link']
                                    ,'click to generate a new code');
                            customFlash('alert-info',$skzMessage);
                            return redirect()->to(site_url('login/newdevice/'.$ifLink[0]['ub_link']));
                        }
                        else{
                            customFlash('alert-info','We cannot send you the email right now, try again, and if you face the same issues, then contact the admin.');
                            return redirect()->to(site_url('login/newdevice/'.$ifLink[0]['ub_link']));
                        }
                    }
                    else{
                        customFlash('alert-info','Something went wrong please try again.');
                        return redirect()->to(site_url('login'));
                    }
                }else{
                    customFlash('alert-info','The login link is expired OR not exist.');
                    return redirect()->to(site_url('login'));
                }

            }
            else{
                customFlash('alert-info','Please check your email for link.');
                return redirect()->to(site_url('login'));
            }


        }
        else{
            return redirect()->to(site_url('user'));
        }

    }

    public function checkcode()//actual login system
    {
        if (isUserLoggedIn()) {
            return redirect()->to(site_url('user'));
        } else {
            //$validation = $this->validator;
            $request = $this->request;
            $session =  $this->session;
            $tableUserBrowser =  new ModUserBrowser();
            $userCode = [
                //'ub_code'=>$request->getPost('deviceCode'),
                'ub_link'=>$request->getPost('xyp'),
            ];
            $ubCode = $request->getPost('deviceCode');
                $isSave = $request->getPost('saveDevice');
            $isDevice = $tableUserBrowser->checkNewDevice($userCode);
            if (count($isDevice) == 1){
                //var_dump($isDevice);
                if ($isDevice[0]['ub_code'] == $ubCode) {
                    switch ($isDevice[0]['u_status']){
                        case 0:
                            $session->set('activationLink',$isDevice[0]['u_email']);
                            customFlash('alert-warning','Your account is not activated, Please ' .anchor('user/sendLink','Activate',''). ' your account and try again.');
                            return redirect()->to(site_url('login'));
                            break;
                        case 1:
                            $userdata['u_id'] = $isDevice[0]['u_id'];
                            //$userdata['user_name'] = $isDevice[0]['user_name'];
                            $userdata['u_first_name'] = $isDevice[0]['u_first_name'];
                            $userdata['u_last_name'] = $isDevice[0]['u_last_name'];
                            $userdata['user_name'] = $isDevice[0]['user_name'];
                            $userdata['u_ref_id'] = $isDevice[0]['u_ref_id'];
                            $userdata['u_who_refer'] = $isDevice[0]['u_who_refer'];
                            $userdata['u_nic'] = $isDevice[0]['u_nic'];
                            $userdata['u_city'] = $isDevice[0]['u_city'];
                            $userdata['u_country'] = $isDevice[0]['u_country'];
                            $userdata['u_mobile'] = $isDevice[0]['u_mobile'];

                            $userdata['u_date'] = $isDevice[0]['u_date'];
                            $userdata['u_email'] = $isDevice[0]['u_email'];
                            $userdata['u_dp'] = $isDevice[0]['u_dp'];
                            $userdata['u_perfect'] = $isDevice[0]['u_perfect'];//perfect Id
                            //$userdata['u_address'] = $user[0]['u_address'];
                            //$userdata['u_trusted'] = $user[0]['u_trusted'];
                            //$this->session->set_userdata($userdata);
                            $trackData = getTrackData('login',$isDevice[0]['u_id']);
                            $session->set($userdata);
                            if (userLoggedIn()){
                                $tableTrack = new ModTracking();
                                $tableTrack->insert($trackData);
                                if ($isSave == 'yes') {
                                    $tableUserBrowser->update($isDevice[0]['ub_id'],['ub_status'=>1]);
                                }
                                else{
                                    $tableUserBrowser->delete($isDevice[0]['ub_id']);
                                }
                                return redirect()->to(site_url('user'));
                            }
                            else{
                                customFlash('alert-warning','Something went wrong please try again.');
                                return redirect()->to(site_url('login'));
                            }
                            break;
                        case 2:
                            customFlash('alert-warning','Your account is blocked due to some reasons, please contact with Admin.');
                            return redirect()->to(site_url('login'));
                            break;
                        default:
                            customFlash('alert-warning','Something went wrong please try again');
                            return redirect()->to(site_url('login'));
                            break;
                    }
                }
                else{
                    customFlash('alert-info','The code is invalid please try again.');
                    return redirect()->to(site_url('login/newdevice/'.$ubCode));
                }
                //echo 'found.';
            }
            else{
                customFlash('alert-warning','Something went wrong please try again.');
                return redirect()->to(site_url('login'));
                //echo 'else here';
            }
        }

    }

    public function recover($value = null)
    {
        if (empty($value))
        {
            customFlash('alert-warning','Please check your email and click on the link');
            return redirect()->to(site_url('login'));
        }
        else
        {
            $tableUser = new ModUsers();
            $ch_link = $tableUser->checkLink($value);
            //$ch_link = $this->modUser->checkLink($value);
            if(count($ch_link) == 1)
            {
                $data['link'] = $value;
                $data['title'] = 'Login' . PROJECT;
                $data['description'] = 'Login';
                echo view('header/header',$data);
                echo view('css/allCSS');
                echo view('header/navbar');
                echo view('users/recover',$data);
                echo view('content/subscribed');
                echo view('footer/footer');
                echo view('footer/endfooter');

            }
            else
            {
                customFlash('alert-warning','The link is expired or check your email and try again');
                return redirect()->to(site_url('login'));
            }

        }
    }

    public function recoverAccount()
    {
        $request = $this->request;
        $data['password'] = $request->getPost('password');//$this->input->post('password',true);
        $confirmPassword = $request->getPost('confirmPassword');//$this->input->post('confirmPassword',true);
        $link = $request->getPost('xepe');//$this->input->post('xepe',true);//user link
        if (!empty($link) && isset($link))
        {
            $tableUser = new ModUsers();
            $ch_link = $tableUser->checkLink($link);
            if(count($ch_link) == 1)
            {
                if (!empty($data['password']) && !empty($confirmPassword)) {
                    if ($data['password'] != $confirmPassword) {
                        customFlash('alert-info','Your confirm password not matched with you password.');
                        return redirect()->to(site_url('user/recover/'.$link));
                    }
                    else{
                        $data['password'] = hash('md5',$data['password']);
                        $data['u_link']	= $link.'ok';
                        $ac_acc = $tableUser->update($ch_link[0]['u_id'],$data);
                        //$ac_acc = $this->modUser->recoverAccount($data,$link);
                        if ($ac_acc)
                        {
                            customFlash('alert-success','You have successfully changed your password, you can login now.');
                            return redirect()->to(site_url('login'));
                        }
                        else
                        {
                            customFlash('alert-info','Oops you can\'t change your password please try again.','login');
                            return redirect()->to(site_url('login'));
                        }
                    }

                }
                else{
                    customFlash('alert-info','Please check the required field and try again');
                    return redirect()->to(site_url('user/recover/'.$link));
                }

            }
            else
            {
                customFlash('alert-info','The link is expired or check your email and try again');
                return redirect()->to(site_url('login'));
            }


        }
        else
        {
            customFlash('alert-info','The link is expired or check your email and try again');
            return redirect()->to(site_url('login'));
        }

    }

    public function query(){
        if (isUserLoggedIn()) {
            $request = $this->request;
            if ($request->isAJAX())
            {
                $key = $request->getPost('key',TRUE);
                if (!empty($key))
                {
                    $tableUsers = new ModUsers();
                    $finUser  = $tableUsers->where(['u_ref_id'=>$key,'u_status'=>1])
                        ->findAll();
                    //$finUser  = $this->modUser->findUser($key);
                    if (count($finUser) == 1 )
                    {
                        $user_qieru['return'] = TRUE;
                        $user_qieru['words'] = $finUser;
                        echo json_encode($user_qieru);
                    }
                    else
                    {
                        $user_qieru['return'] = FALSE;
                        $user_qieru['message'] = 'User not found.';
                        echo json_encode($user_qieru);
                    }

                }
                else
                {
                    $user_qieru['return'] = FALSE;
                    $user_qieru['message'] = 'Please check required fields and try again.';
                    echo json_encode($user_qieru);
                }

            }
            else
            {
                //customFlash('alert-danger','OOps..! something went wrong please try again.','admin/new-partner');
                customFlash('alert-danger','Something went wrong please tray again.','pagenotfound');
            }
        }
        else{
            $user_qieru['return'] = FALSE;
            $user_qieru['message'] = 'User is not logged in.';
            echo json_encode($user_qieru);

        }

    }



    public function newdeposit()
    {
        if (userLoggedIn()) {
            $request = $this->request;
            //$filters = $this->filterforCompany();
            $sKey = $request->getGet('s');
            $tableDeposit = new ModUserDeposit();
            $mywhere['users.u_status'] = 1;
            $mywhere['user_plans.up_status'] = 1;
            $mywhere['user_deposit.user_id'] = getUserId();
            $checkUserPlan = $tableDeposit->select(
                'user_deposit.*'
            )
                ->where($mywhere)
                ->join('user_plans','user_plans.up_id = user_deposit.user_plan_id')
                ->join('users','users.u_id = user_plans.user_id')
                ->orderBy('ud_id','desc')
            ->findAll();
            if (count($checkUserPlan) == 0) {
                customFlash('alert-info','Please purchase a plan before deposit.');
                return redirect()->to(site_url('user/plans'));
            }
           /* $data = [
                'userDeposits' => $tableDeposit->paginate(20),
                'pager' => $tableDeposit->pager
            ];*/

            //dd($data['userDeposits']);

            $isUserPlan = isUserPlan(getUserId());
            //var_dump($isUserPlan);
            //die();
            //echo
            $data['noPlan'] = "";
            //echo
            $data['emptyCash'] = "";
            //selplanz


            $data['cashboxAmount'] = 0;

            $userCashBox = cashBoxAfterDeposit(getUserId());
            if ($userCashBox != false) {
                $data['cashboxAmount'] = $userCashBox;
            }

            if ($isUserPlan == false) {
                $data['noPlan'] = 'noPlan';
            }
            else{
                if ($data['cashboxAmount'] == 0) {
                    echo $data['emptyCash'] = "nocash";
                }
            }

            $data['title'] = 'User Deposits'.PROJECT;
            $data['description'] = 'User Deposits';
            $data['adepo'] = 'active';
            $bradCrum[] = ['text'=>'Home','link'=>base_url()];
            $bradCrum[] = ['text'=>'Dashboard','link'=>site_url('user')];
            $bradCrum[] = ['text'=>'New Deposit','link'=>''];
            $data['bradcrum'] = $bradCrum;
            echo view('users/header/header',$data);
            echo view('users/css/allCSS');
            echo view('css/formValidation');
            echo view('users/header/leftBar');
            echo view('users/header/topBar');
            echo view('users/header/stats',$data);
            echo view('users/content/newdeposit',$data);
            echo view('users/footer/footer');
            echo view('js/formValidation');
            echo view('users/js/deposits');
            echo view('users/footer/endfooter');
        }
        else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }

    }
    public function deposits()
    {
        if (userLoggedIn()) {
            $request = $this->request;
            //$filters = $this->filterforCompany();
            $sKey = $request->getGet('s');
            $filters = $this->filterWhereForModels();
            $filtrs = $this->filterWhereForview();
            $tableDeposit = new ModUserDeposit();
            $filters['users.u_status'] = 1;
            $filters['user_deposit.user_id'] = getUserId();
            $tableDeposit->select(
                'user_deposit.*'
            )
                ->where($filters)
                ->join('user_plans','user_plans.up_id = user_deposit.user_plan_id')
                ->join('users','users.u_id = user_plans.user_id')
                ->orderBy('ud_id','desc');
            if (isset($filtrs) && $filtrs['pp']) {
                $perPage = $filtrs['pp'];
            }
            else{
                $perPage = 20;
            }
            $data = [
                'userDeposits' => $tableDeposit->paginate($perPage),
                'pager' => $tableDeposit->pager,
                'filtrs' => $filtrs,
            ];


            $isUserPlan = isUserPlan(getUserId());
            //var_dump($isUserPlan);
            //die();
            //echo
            $data['noPlan'] = "";
            //echo
            $data['emptyCash'] = "";
            //selplanz


            $data['cashboxAmount'] = 0;

            $userCashBox = cashBoxAfterDeposit(getUserId());
            if ($userCashBox != false) {
                $data['cashboxAmount'] = $userCashBox;
            }

            if ($isUserPlan == false) {
                $data['noPlan'] = 'noPlan';
            }
            else{
                if ($data['cashboxAmount'] == 0) {
                    echo $data['emptyCash'] = "nocash";
                }
            }

            $data['title'] = 'User Deposits'.PROJECT;
            $data['description'] = 'User Deposits';
            $data['adepo'] = 'active';
            $bradCrum[] = ['text'=>'Home','link'=>base_url()];
            $bradCrum[] = ['text'=>'Dashboard','link'=>site_url('user')];
            $bradCrum[] = ['text'=>'Deposits','link'=>''];
            $data['bradcrum'] = $bradCrum;
            echo view('users/header/header',$data);
            echo view('users/css/allCSS');
            echo view('css/formValidation');
            echo view('users/header/leftBar');
            echo view('users/header/topBar');
            echo view('users/header/stats',$data);
            echo view('users/content/deposits',$data);
            echo view('users/footer/footer');
            echo view('js/formValidation');
            echo view('users/js/deposits');
            echo view('users/footer/endfooter');
        }
        else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }

    }

    public function directdeposit()
    {
        if (userLoggedIn()) {
            //$redirectURL = null;
            /*$this->form_validation->set_rules('deposit_type', 'Deposit Mode', 'trim|required');
            $this->form_validation->set_rules('dep_currency', 'Currency', 'trim|required');
            $this->form_validation->set_rules('dep_amount', 'Amount', 'trim|required');
            $this->form_validation->set_rules('pin', 'Security Pin', 'trim|required|integer');*/
            $validation = $this->validator;
            $request = $this->request;
            $formVal = $validation->getRuleGroup('newDeposit');
            if (!$this->validate($formVal)) {
                //dd('if here');
                $this->newdeposit();

            }
            else{
                //$image_path = realpath(APPPATH . '../assets/images/prof/');
                $checkPin = checkSecurityPin(getUserId());
                $securityPin = $request->getPost('pin');//$this->input->post('pin',true);
                if ($checkPin) {
                    if ($checkPin == $securityPin) {
                        $userId = getUserId();
                        $userCurrentPlan = getUserPlanId($userId);//userPlanId primary key of user_plans table
                        //echo $userCurrentPlan;
                        //die();
                        if ($userCurrentPlan == false) {
                            //dd('Package not exist');
                            customFlash('alert-info','You don\'t have a plan to deposit the amount, please select a plan to deposit.');
                            return redirect()->to(site_url('user/plans'));
                        }
                        else{
                            //dd('working..');
                            $deposit['ud_type'] = $request->getPost('deposit_type');//$this->input->post('deposit_type',true);
                            $deposit['ud_currency'] = $request->getPost('dep_currency');//$this->input->post('dep_currency',true);
                            $deposit['ud_amount'] = $request->getPost('dep_amount');//$this->input->post('dep_amount',true);
                            //$deposit['cb_bank_transaction_id'] = $this->input->post('bank_trasac',true);
                            $deposit['ud_date'] = date('Y-m-d H:i:s');
                            $deposit['user_id'] = $userId; //userId
                            $deposit['ud_status'] = 1; //userId
                            $deposit['ud_trasaction_id'] = random_string('alnum', 5).date('m').date('d').date('s'); //userId

                            $deposit['user_plan_id'] = $userCurrentPlan; //userId// primary key of user_plans table

                            $withDrwa['uw_fund_type'] = 'Direct Deposit';
                            $withDrwa['uw_currency'] = $deposit['ud_currency'];
                            $withDrwa['uw_amount'] = $deposit['ud_amount'];
                            $withDrwa['user_id'] = $userId;
                            $withDrwa['uw_status'] = 1;
                            $withDrwa['uw_date'] = date('Y-m-d H:i:s');

                            $tableUserDeposit = new ModUserDeposit();
                            $tablePlans = new ModPlans();
                            $checkUserCashBox = cashBoxAfterDeposit($userId);
                            //$checkUserAmnt = $this->modUser->checkDepositAmount($userId);
                            $checkUserAmnt = $tableUserDeposit->checkDepositAmount($userId);
                            //var_dump($checkUserAmnt);
                            //echo '<br>';
                            //die();
                            //$getUserPlanInfo = $this->modUser->getUserPlanInfo($userId);
                            $getUserPlanInfo = $tablePlans->getUserPlanInfo($userId);
                            //var_dump($getUserPlanInfo);
                            //die($deposit['ud_trasaction_id']);
                            if ($deposit['ud_amount'] < 100) {
                                customFlash('alert-info','The minimum limit of your deposit is 100$');
                                return redirect()->to(site_url('user/deposits'));
                            }
                            else{
                                if (count($checkUserAmnt) === 1) {
                                    if (count($getUserPlanInfo) === 1) {
                                        //var_dump($checkUserAmnt[0]['ud_amount']+$deposit['ud_amount']);
                                        //dd();
                                        if ($checkUserAmnt[0]['ud_amount']+$deposit['ud_amount'] > $getUserPlanInfo[0]['pl_maxAmount']) {
                                            $crnPreio = $checkUserAmnt[0]['ud_amount']+$deposit['ud_amount'];//current and prious amount.
                                            //$newPlnData = $this->modUser->getPlanDataForUpgrate($crnPreio);
                                            $newPlnData = $tablePlans->getPlanDataForUpgrate($crnPreio);
                                            if (count($newPlnData) === 1) {
                                                $upgradePlanData['up_id'] = $userCurrentPlan;//primary key of user_plans table
                                                $upgradePlanData['plan_id'] = $newPlnData[0]['pl_id'];
                                                $upgradePlanData['up_upgrade_date'] = date('Y-m-d H:i:s');
                                                $upgradePlanData['old_plan_id'] = $getUserPlanInfo[0]['plan_id'];

                                                $newDepositAmount['ud_amount'] = $deposit['ud_amount'];
                                                $newDepositAmount['ud_currency'] = $deposit['ud_currency'];
                                                $newDepositAmount['ud_type'] = $deposit['ud_type'];
                                                $newDepositAmount['ud_date'] = $deposit['ud_date'];
                                                $newDepositAmount['user_id'] = $userId;
                                                $newDepositAmount['user_plan_id'] = $userCurrentPlan;//primary key of user_plans table
                                                $newDepositAmount['ud_status'] = 1;
                                                $newDepositAmount['ud_trasaction_id'] = $deposit['ud_trasaction_id'];

                                                //var_dump($newDepositAmount);
                                                //die();
                                                if ($checkUserCashBox != false && $deposit['ud_amount'] <= $checkUserCashBox) {
                                                    //$upgrdNow = $this->modUser->upgradeUserPlan($newDepositAmount,$withDrwa,$upgradePlanData,$userCurrentPlan);//primary key of user_plans table
                                                    $trackData =  getTrackData('deposit');
                                                    $upgrdNow = $tableUserDeposit->upgradeUserPlan(
                                                                $newDepositAmount,$withDrwa,$upgradePlanData,$userCurrentPlan,$trackData
                                                              );//primary key of user_plans table
                                                    if ($upgrdNow){
                                                        customFlash('alert-success','We have successfully received your deposit');
                                                        return redirect()->to(site_url('user/deposits'));
                                                    }
                                                    else{
                                                        customFlash('alert-info','Something went wrong please try again or contact the admin if you face the problem twice.');
                                                        return redirect()->to(site_url('user/deposits'));
                                                    }
                                                }else{
                                                    customFlash('alert-info','Your cash box is not sufficient for this transaction.');
                                                    return redirect()->to(site_url('user/deposits'));
                                                }

                                            }
                                            else{
                                                customFlash('alert-info','New plan data is not available,please contact admin');
                                                return redirect()->to(site_url('user/deposits'));
                                            }
                                            //var_dump($newPlnData);
                                            //echo ;
                                            //customFlash('alert-info','The maximum limit of your plan is: <strong>'. $getUserPlanInfo[0]['pl_maxAmount']. '</strong> so you can\'t deposit the amount, please upgrade your package.' ,'user/deposits');
                                        }
                                        else{
                                            if ($checkUserCashBox != false && $deposit['ud_amount'] <= $checkUserCashBox) {
                                                $trackData =  getTrackData('deposit');
                                                //$addUserPlan = $this->modUser->addDirectDeposit($deposit,$withDrwa,$trackData);
                                                $addUserPlan = $tableUserDeposit->addDirectDeposit($deposit,$withDrwa,$trackData);
                                                if ($addUserPlan){
                                                    customFlash('alert-success','We have successfully received your deposit');
                                                    return redirect()->to(site_url('user/deposits'));
                                                }
                                                else{
                                                    customFlash('alert-info','Something went wrong please try again or contact the admin if you face the problem twice.');
                                                    return redirect()->to(site_url('user/deposits'));
                                                }
                                            }else{
                                                customFlash('alert-info','Your cash box is not sufficient for this transaction.');
                                                return redirect()->to(site_url('user/deposits'));
                                            }
                                        }
                                    }
                                    else{
                                        customFlash('alert-info','Your plan information is exist, please contact the admin.');
                                        return redirect()->to(site_url('user/deposits'));
                                    }
                                }
                                else{
                                    customFlash('alert-success','The amount is not found, please contact the admin.');
                                    return redirect()->to(site_url('user/deposits'));
                                }
                            }
                            /*echo '<br>';
                            echo $checkUserAmnt[0]['ud_amount']+$deposit['ud_amount'];
                            echo '<br>';
                            var_dump($checkUserAmnt[0]);
                            die();*/
                            /*echo $deposit['ud_amount'];
                            echo '<br>';
                            echo $checkUserCashBox;
                            die();*/

                        }


                        //$currentPlan = $this->modUser->checkCashBoxRequest($deposit);
                        /*if ($currentPlan->num_rows() > 0) {
                            customFlash('alert-info','We have already received your request, please wait once the admin approve your request.','user/deposits');
                        }
                        else{
                            //$myProff = $this->deposiProf($image_path);//image upload system
                            //$deposit['cb_prof'] = $myProff;
                            $addCashBoxRequest = $this->modUser->addCashBoxRequest($deposit);
                            if ($addCashBoxRequest){
                                customFlash('alert-success','We have successfully received your deposit request, once admin confirms your payment it will available in your amount.','user/cashbox');
                            }
                            else{
                                customFlash('alert-warning','Something went wrong please try again or contact the admin if you face the problem twice.','user/cashrequest');
                            }
                        }*/
                    }else{
                        customFlash('alert-info','Your security pin is invalid please check your security pin and try again.');
                        return redirect()->to(site_url('user/deposits'));
                    }

                }else{
                    customFlash('alert-info','Please set your security pin before deposit.');
                    return redirect()->to(site_url('user/profile'));
                }

            }//else if everything is fine..
        }
        else{
            customFlash('alert-warning','Login now before accessing dashboard.');
            return redirect()->to(site_url('login'));
        }
    }

    public function cashbox()
    {
        if (userLoggedIn()) {
            $request = $this->request;
            $tableCashBox = new ModUserCashBox();
            //$mywhere['users.u_status'] = 1;
            $filters = $this->filterWhereForModels();
            $filtrs = $this->filterWhereForview();
            //$mywhere['user_cash_box.user_id'] = getUserId();
            //$fkltrs = $request->getGet('cbs');
            if (isset($filtrs) && $filtrs['cbs'] == 7) {
                $filters['user_cash_box.cb_status'] = 0;
            }
            $filters['user_cash_box.user_id'] = getUserId();
            $tableCashBox->select('user_cash_box.*,users.user_name,users.u_ref_id')
                    ->join('users','users.u_id = user_cash_box.user_id')
                    ->where($filters)
                    ->orderBy('cb_id','desc');
            if (isset($filtrs) && $filtrs['pp']) {
                $perPage = $filtrs['pp'];
            }
            else{
                $perPage = 20;
            }

            //dd($data['filtrs']);

            $data = [
                'MyCashBox' => $tableCashBox->paginate($perPage),
                'pager' => $tableCashBox->pager,
                'filtrs' => $filtrs,
            ];
           /* echo lastQuery();
            dd();*/
            //var_dump($data['filtrs']);
            //dd();

            $data['title'] = 'User Cash Box' . PROJECT;
            $data['acash'] = 'active';
            $data['description'] = 'User Cash Box';
            $bradCrum[] = ['text'=>'Home','link'=>base_url()];
            $bradCrum[] = ['text'=>'Dashboard','link'=>site_url('user')];
            $bradCrum[] = ['text'=>'cash Box','link'=>''];
            $data['bradcrum'] = $bradCrum;

            echo view('users/header/header',$data);
            echo view('users/css/allCSS');
            echo view('users/header/leftBar');
            //echo view('users/css/c3');
            echo view('users/header/topBar');
            echo view('users/header/stats',$data);
            echo view('users/content/cashbox',$data);
            echo view('users/footer/footer');
            echo view('users/footer/endfooter');

        }
        else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }

    }



    public function monthlyprofit()
    {
        if (userLoggedIn()) {
            $tableserProfit = new ModUserMonthlyProfit();
            $mywhere['users.u_status'] = 1;
            $mywhere['user_monthly_profit.um_status'] = 1;
            $mywhere['user_monthly_profit.user_id'] = getUserId();
            $tableserProfit->select(
                'user_monthly_profit.*,
			        users.user_name,users.u_ref_id
			'
            )
                //->from('user_monthly_profit')
                ->where($mywhere)
                ->join('users','users.u_id = user_monthly_profit.user_id')
                ->orderBy('um_id','desc');
            /*echo count($skxz);
            echo '<br><br><br>';
            lastQuery();
            dd();*/
            $data = [
                'userMonthlyProfit' => $tableserProfit->paginate(20),
                'pager' => $tableserProfit->pager
            ];

            $data['title'] = 'Monthly Profit' . PROJECT;
            $data['description'] = 'Monthly Profit';
            $data['aprof'] = 'active';
            $bradCrum[] = ['text'=>'Home','link'=>base_url()];
            $bradCrum[] = ['text'=>'Dashboard','link'=>site_url('user')];
            $bradCrum[] = ['text'=>'Monthly Profit','link'=>''];
            $data['bradcrum'] = $bradCrum;
            echo view('users/header/header',$data);
            echo view('users/css/allCSS');
            echo view('users/header/leftBar');
            echo view('users/header/topBar');
            echo view('users/header/stats',$data);
            echo view('users/content/monthlyprofit',$data);
            echo view('users/footer/footer');
            echo view('users/footer/endfooter');

        }
        else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }

    }

    public function monthlybonus()
    {
        if (userLoggedIn()) {
            $tableUsrMnthlyBons = new ModUserMonthlyBonus();
            $filters = $this->filterWhereForModels();
            $filtrs = $this->filterWhereForview();
            $filters['users.u_status'] = 1;
            $filters['usermonthlybonus.bn_status'] = 1;
            $filters['usermonthlybonus.user_id'] = getUserId();
            $tableUsrMnthlyBons->select(
                'usermonthlybonus.*,
			        users.user_name,users.u_ref_id
			'
            )
                ->where($filters)
                ->join('users','users.u_id = usermonthlybonus.user_id')
                ->orderBy('bn_id','desc');
            if (isset($filtrs) && $filtrs['pp']) {
                $perPage = $filtrs['pp'];
            }
            else{
                $perPage = 20;
            }
            $data = [
                'userMonthlyBonus' => $tableUsrMnthlyBons->paginate($perPage),
                'pager' => $tableUsrMnthlyBons->pager,
                'filtrs' => $filtrs,
            ];

            $data['title'] = 'Monthly Bonus' . PROJECT;
            $data['description'] = 'Monthly Bonus';
            $data['abonu'] = 'active';
            $bradCrum[] = ['text'=>'Home','link'=>base_url()];
            $bradCrum[] = ['text'=>'Dashboard','link'=>site_url('user')];
            $bradCrum[] = ['text'=>'Monthly Bonus','link'=>''];
            $data['bradcrum'] = $bradCrum;
            echo view('users/header/header',$data);
            echo view('users/css/allCSS');
            echo view('users/header/leftBar');
            echo view('users/header/topBar');
            echo view('users/header/stats',$data);
            echo view('users/content/monthlybonus',$data);
            echo view('users/footer/footer');
            echo view('users/footer/endfooter');
        }
        else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }

    }

    public function canceledBonus()
    {
        if (userLoggedIn()) {
            $tableBonusHistory = new ModBonusHistory();
            $mywhere['bh_status'] = 3;
            $mywhere['bonus_history.user_id'] = getUserId();
            $tableBonusHistory->select('bonus_history.*,user_deposit.ud_amount')
                ->where($mywhere)
                ->join('user_deposit','user_deposit.ud_id = bonus_history.deposit_id','right');

            $data = [
                'canceledBonus' => $tableBonusHistory->paginate(20),
                'pager' => $tableBonusHistory->pager
            ];
            $data['abonu'] = 'active';
            $data['title'] = 'Canceled Bonus' . PROJECT;
            $data['description'] = 'Canceled Bonus';
            $bradCrum[] = ['text'=>'Home','link'=>base_url()];
            $bradCrum[] = ['text'=>'Dashboard','link'=>site_url('user')];
            $bradCrum[] = ['text'=>'Canceled Bonus','link'=>''];
            $data['bradcrum'] = $bradCrum;
            echo view('users/header/header',$data);
            echo view('users/css/allCSS');
            echo view('users/header/leftBar');
            echo view('users/header/topBar');
            echo view('users/header/stats',$data);
            echo view('users/content/canceledBonus',$data);
            echo view('users/footer/footer');
            echo view('users/footer/endfooter');

        }
        else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }

    }

    public function canceledProfit()
    {
        if (userLoggedIn()) {
            $tableUsrMonPrft = new ModUserMonthlyProfit();
            $mywhere['user_monthly_profit.um_cancel'] = 'yes';
            $mywhere['user_id'] = getUserId();
            $tableUsrMonPrft->select('user_monthly_profit.*,
                                        users.user_name,users.u_ref_id')
                //->from('user_monthly_profit')
                ->where($mywhere)
                //->where('user_monthly_profit.um_cancel','yes')
                //->where(array(''=>'','user_id'=>$currUserId))
                ->join('users','users.u_id = user_monthly_profit.user_id');

            $data = [
                'canceledProfit' => $tableUsrMonPrft->paginate(20),
                'pager' => $tableUsrMonPrft->pager
            ];
            $data['aprof'] = 'active';
            $data['title'] = 'Canceled profit ' . PROJECT;
            $data['description'] = 'Canceled profit';
            $bradCrum[] = ['text'=>'Home','link'=>base_url()];
            $bradCrum[] = ['text'=>'Dashboard','link'=>site_url('user')];
            $bradCrum[] = ['text'=>'Canceled Profit','link'=>''];
            $data['bradcrum'] = $bradCrum;
            echo view('users/header/header',$data);
            echo view('users/css/allCSS');
            echo view('users/header/leftBar');
            echo view('users/header/topBar');
            echo view('users/header/stats',$data);
            echo view('users/content/canceledProfit',$data);
            echo view('users/footer/footer');
            echo view('users/footer/endfooter');

        }
        else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }

    }

    public function withdrawals()
    {
        if (userLoggedIn()) {

            $userLoanWith = calculateUserLoan(getUserId());
            if ($userLoanWith != 0) {
                customFlash('alert-info','You have to pay the loan before using the withdrawal functionality.');
                return redirect()->to(site_url('user/loanrequest'));
            }
            /*customFlash('alert-info','We are currently improving a number of our security services; these enhancements will be accessible very shortly.');
            return redirect()->to(site_url('user'));*/
            //calculateUserLoan(getUserId());
            //dd();
            $userPlan = new ModUserPlans();
            $checkUserPlan = $userPlan->where('user_id',getUserId())->findAll();
            if (count($checkUserPlan) == 1 && $checkUserPlan[0]['up_status'] != 1) {
                customFlash('alert-info','Before you withdraw your money, please activate the plan.');
                return redirect()->to(site_url('user/plans'));
            } elseif (count($checkUserPlan) == 0) {
                customFlash('alert-info','To withdraw your money, you\'ll need to activate at least one plan.');
                return redirect()->to(site_url('user/plans'));
            }
            $tableUserWithdraw = new ModUserWithdraw();
            $mywhere['user_withdraw.user_id'] = getUserId();
            $tableUserWithdraw->select('user_withdraw.*,users.user_name,users.u_ref_id')
                //->from('user_withdraw')
                ->join('users','users.u_id = user_withdraw.user_id')
                ->where($mywhere)
                ->orderBy('uw_id','desc');

            $data = [
                'Mywithdraws' => $tableUserWithdraw->paginate(20),
                'pager' => $tableUserWithdraw->pager
            ];
            $data['awith'] = 'active';
            $data['title'] = 'User withdrawals ' . PROJECT;
            $data['description'] = 'User withdrawals';
            $bradCrum[] = ['text'=>'Home','link'=>base_url()];
            $bradCrum[] = ['text'=>'Dashboard','link'=>site_url('user')];
            $bradCrum[] = ['text'=>'WITHDRAWAL','link'=>''];
            $data['bradcrum'] = $bradCrum;
            echo view('users/header/header',$data);
            echo view('users/css/allCSS');
            //echo view('css/bootstrapSelect');
            echo view('css/formValidation');
            echo view('users/header/leftBar');
            echo view('users/header/topBar');
            echo view('users/header/stats',$data);
            echo view('users/content/withdrawals',$data);
            echo view('users/footer/footer');
            echo view('js/formValidation');
            echo view('users/js/withdrawals');
            //echo view('js/bootstrapSelect');
            echo view('users/footer/endfooter');
        }
        else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }

    }

    public function transactions()
    {
        if (userLoggedIn()) {
            $tableUserWithdraw = new ModUserWithdraw();
            $filters = $this->filterWhereForModels();
            $filtrs = $this->filterWhereForview();
            $filters['user_withdraw.user_id'] = getUserId();
            if (isset($fkltrs) && $fkltrs['wist'] == 7) {
                $filters['user_withdraw.uw_status'] = 0;
            }
            $tableUserWithdraw->select('user_withdraw.*,users.user_name,users.u_ref_id')
                //->from('user_withdraw')
                ->join('users','users.u_id = user_withdraw.user_id')
                ->where($filters)
                ->orderBy('uw_id','desc');

            if (isset($filtrs) && $filtrs['pp']) {
                $perPage = $filtrs['pp'];
            }
            else{
                $perPage = 20;
            }
            $data = [
                'Mywithdraws' => $tableUserWithdraw->paginate($perPage),
                'pager' => $tableUserWithdraw->pager,
                'filtrs' => $filtrs,
            ];
            $data['awith'] = 'active';
            $data['title'] = 'User Transactions ' . PROJECT;
            $data['description'] = 'User Transactions';
            $bradCrum[] = ['text'=>'Home','link'=>base_url()];
            $bradCrum[] = ['text'=>'Dashboard','link'=>site_url('user')];
            $bradCrum[] = ['text'=>'User Transactions','link'=>''];
            $data['bradcrum'] = $bradCrum;
            echo view('users/header/header',$data);
            echo view('users/css/allCSS');
            echo view('css/bootstrapSelect');
            echo view('users/header/leftBar');
            echo view('users/header/topBar');
            echo view('users/header/stats',$data);
            echo view('users/content/transactions',$data);
            echo view('users/footer/footer');
            echo view('js/bootstrapSelect');
            echo view('users/footer/endfooter');


        }
        else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }

    }

    public function confirmwithdraw()
    {
        if (userLoggedIn()) {
            $validation = $this->validator;
            $request = $this->request;
            $session =  $this->session;
            $tableUser = new ModUsers();
            $tableUserWithdraw = new ModUserWithdraw();
            if (!$this->validate($validation->getRuleGroup('withdraw')))
            {
                $this->withdrawals();
            }
            else {
                $confrimData['uw_receiver_id'] = $request->getPost('userId');//this is receiver id
                $confrimData['uw_fund_type'] = $request->getPost('fund_type');
                // = $this->input->post('fund_type', TRUE) . PerfectMoneyCharges.'% (Perfect Money)';
                $confrimData['uw_currency'] = $request->getPost('with_currency');
                $confrimData['uw_amount'] = $request->getPost('with_amount');
                $confrimData['my_comment'] = $request->getPost('my_comment');
                $securityPin  = $request->getPost('pin');
                $confrimData['uw_status'] = 0;
                $confrimData['uw_date'] = date('Y-m-d H:i:s');
                $confrimData['user_id'] = getUserId();
                $confrimData['user_pin'] = $securityPin;
                $availableAmount = cashBoxAfterDeposit(getUserId());
                if (isset($confrimData['uw_fund_type']) && $confrimData['uw_fund_type'] == 'Fund transfer') {
                    if (isset($confrimData['uw_receiver_id']) && empty($confrimData['uw_receiver_id'])) {
                        customFlash('alert-info','Please check your required fields and try again.');
                        return redirect()->to(site_url('user/withdrawals'));
                        //dd();
                    }

                }
                //dd($data);
                /*echo $availableAmount;
                echo '<br>';
                echo  $data['uw_amount'];
                die();*/
                /*if (!isset($confrimData['uw_amount']) && empty($confrimData['uw_amount'])) {
                    customFlash('alert-info','Please check your required fields and try again.');
                    return redirect()->to(site_url('user/withdrawals'));
                }*/
                //$availableAmount = $this->modUser->UserCashBox();
                $perfectPercentage = $confrimData['uw_amount']*PerfectMoneyCharges/100;
                //echo $data['uw_amount']+$perfectPercentage;
                //var_dump($perfectPercentage);
                //echo 'working..';
                //dd();
                $checkPin = checkSecurityPin(getUserId());
                if ($checkPin) {
                    if ($checkPin == $securityPin) {
                        if ($confrimData['uw_fund_type']!='loan' && $confrimData['uw_amount'] < 25) {
                            customFlash('alert-info','Your withdraw must be greater than  25$');
                            return redirect()->to(site_url('user/withdrawals'));
                        }
                        else{
                            if ($availableAmount != false) {
                                $tableUserWithdraw = new ModUserWithdraw();
                                $mywhere['user_withdraw.user_id'] = getUserId();
                                $tableUserWithdraw->select('user_withdraw.*,users.user_name,users.u_ref_id')
                                    //->from('user_withdraw')
                                    ->join('users','users.u_id = user_withdraw.user_id')
                                    ->where($mywhere)
                                    ->orderBy('uw_id','desc');

                                $data = [
                                    'Mywithdraws' => $tableUserWithdraw->paginate(20),
                                    'pager' => $tableUserWithdraw->pager
                                ];
                                $data['awith'] = 'active';
                                $data['title'] = 'User withdrawals ' . PROJECT;
                                $data['description'] = 'User withdrawals';
                                $bradCrum[] = ['text'=>'Home','link'=>base_url()];
                                $bradCrum[] = ['text'=>'Dashboard','link'=>site_url('user')];
                                $bradCrum[] = ['text'=>'Withdrawa','link'=>''];
                                $data['bradcrum'] = $bradCrum;
                                $data['confirmForm'] = $confrimData;
                                $revData = $tableUser->where('u_ref_id',$confrimData['uw_receiver_id'])
                                    ->where('u_status',1)
                                    ->findAll();
                                //lastQuery();
                                $data['recvrUsrInfor'] = $revData;
                                //var_dump($data);
                                //dd();
                                echo view('users/header/header',$data);
                                echo view('users/css/allCSS');
                                echo view('css/bootstrapSelect');
                                echo view('users/header/leftBar');
                                echo view('users/header/topBar');
                                echo view('users/header/stats',$data);
                                echo view('users/content/withdraConfirm',$data);
                                echo view('users/footer/footer');
                                echo view('js/bootstrapSelect');
                                echo view('users/footer/endfooter');
                                //echo 'working here..';
                                //echo $data['uw_fund_type'];
                                //die();

                            }//available limit

                            else{
                                customFlash('alert-info','Your Cash box is empty OR not finalized yet.');
                                return redirect()->to(site_url('user/withdrawals'));
                            }
                        }
                    }
                    else{
                        customFlash('alert-info','Your security pin is invalid please try again.');
                        return redirect()->to(site_url('user/withdrawals'));

                    }
                }
                else{
                    customFlash('alert-info','Please set your security pin before withdraw');
                    return redirect()->to(site_url('user/profile'));
                }

            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('login'));

        }

    }

    public function withdraw()
    {
        if (userLoggedIn()) {
            $validation = $this->validator;
            $request = $this->request;
            $session =  $this->session;
            $tableUser = new ModUsers();
            $tableUserWithdraw = new ModUserWithdraw();
            if (!$this->validate($validation->getRuleGroup('withdraw')))
            {
                $this->withdrawals();
            }
            else {
                $data['uw_receiver_id'] = $request->getPost('userId');//this is receiver id
                $data['uw_fund_type'] = $request->getPost('fund_type');
                // = $this->input->post('fund_type', TRUE) . PerfectMoneyCharges.'% (Perfect Money)';
                $data['uw_currency'] = $request->getPost('with_currency');
                $data['uw_amount'] = $request->getPost('with_amount');
                $securityPin  = $request->getPost('pin');
                $data['uw_status'] = 0;
                $data['uw_date'] = date('Y-m-d H:i:s');
                $data['user_id'] = getUserId();
                $trasactionIdLoan = $request->getPost('my_comment');
                //var_dump($trasactionIdLoan);
                //dd();
                $availableAmount = cashBoxAfterDeposit(getUserId());
                //dd($data);
                /*echo $availableAmount;
                echo '<br>';
                echo  $data['uw_amount'];
                die();*/
                //$availableAmount = $this->modUser->UserCashBox();
                $perfectPercentage = $data['uw_amount']*PerfectMoneyCharges/100;
                //echo $data['uw_amount']+$perfectPercentage;
                //var_dump($perfectPercentage);
                //echo 'working..';
                //dd();
                $checkPin = checkSecurityPin(getUserId());
                if ($checkPin) {
                    if ($checkPin == $securityPin) {
                        if ($data['uw_fund_type'] !='loan' && $data['uw_amount'] < 25) {
                            customFlash('alert-info','Your withdraw must be greater than  25$');
                            return redirect()->to(site_url('user/withdrawals'));
                        }
                        else{
                            if ($availableAmount != false) {
                                //echo $data['uw_fund_type'];
                                //die();
                                if ($data['uw_fund_type'] == 'Fund transfer') {
                                    if ($data['uw_receiver_id'] == getSessionData('u_ref_id')) {
                                        customFlash('alert-info','You can\'t transfer the amount to your account.');
                                        return redirect()->to(site_url('user/withdrawals'));
                                    }
                                    else{
                                        $checkUserById = $tableUser->checkUserByRefId($data['uw_receiver_id']);
                                        if (empty($data['uw_receiver_id']) || count($checkUserById) == 0) {
                                            customFlash('alert-info','Your receiver ID is empty OR invalid, check your receiver ID and try again.');
                                            return redirect()->to(site_url('user/withdrawals'));
                                        }
                                        else{
                                            $result = $checkUserById;
                                            if ($result[0]['u_status'] != 1) {//checking if user is active
                                                customFlash('alert-info','The account of the user is not activated, please contact the user before sending the amount or contact the admin.');
                                                return redirect()->to(site_url('user/withdrawals'));
                                            }
                                            else{
                                                $data['uw_status'] = 1;
                                                $data['uw_receiver_id'] = $result[0]['u_id'];
                                                //$cashbox['cb_date'] = date('Y-m-d',strtotime($isWithdraw[0]['uw_date']));
                                                $cashbox['cb_inserted_date'] = date('Y-m-d H:i:s');;
                                                $cashbox['cb_status'] = 1;
                                                $cashbox['user_id'] = $data['uw_receiver_id'];
                                                $cashbox['sender_id'] = getUserId();
                                                $cashbox['cb_currency'] = $data['uw_currency'];
                                                $cashbox['cb_amount'] = $data['uw_amount'];

                                                $cashbox['cb_type'] = $data['uw_fund_type'];
                                                //var_dump($data);
                                                //echo '<br>';
                                                //echo $data['uw_receiver_id'];
                                                //var_dump($cashbox);
                                                //die();
                                                $trackData = getTrackData('withdraw');
                                                if ($data['uw_amount'] <= $availableAmount) {
                                                    $UserWithDraw = $tableUserWithdraw->addUserWithDrawTrasaction($cashbox,$data,$trackData);
                                                    //$UserWithDraw = $this->modUser->addUserWithDrawTrasaction($cashbox,$data,$trackData);
                                                    if ($UserWithDraw) {
                                                        customFlash('alert-success','You have successfully sent the amount.');
                                                        return redirect()->to(site_url('user/withdrawals'));
                                                    }
                                                    else{
                                                        customFlash('alert-danger','OOps..! something went wrong please try again.');
                                                        return redirect()->to(site_url('user/withdrawals'));
                                                    }
                                                }
                                                else{
                                                    customFlash('alert-info','You don\'t have enough amount to withdraw, your available amount  is: <strong>'.$availableAmount.'</strong>');
                                                    return redirect()->to(site_url('user/withdrawals'));
                                                }
                                            }



                                        }
                                    }
                                    /*var_dump($data);
                                    echo '<br>';
                                    die();*/

                                    //die();
                                }
                                elseif($data['uw_fund_type'] == 'loan'){
                                    if ($data['uw_amount'] <= $availableAmount) { //$data['uw_amount']+$perfectPercentage <= $availableAmount
                                        $tableLoan = new ModLoan();

                                        $data['uw_fund_type'] = $data['uw_fund_type'];

                                        $loadData['user_plan_id'] = getUserPlanId($data['user_id']);
                                        $loadData['user_id'] = $data['user_id'];
                                        $loadData['ul_amount'] = $data['uw_amount'];
                                        $loadData['ul_status'] = 0;//not active
                                        $loadData['ul_trasaction_id'] = $trasactionIdLoan;//not active
                                        $checkPenddingLoan = $tableLoan->where('user_id',$data['user_id'])->where('ul_status',0)
                                             ->findAll();
                                        if (count($checkPenddingLoan) > 0) {
                                            customFlash('alert-info','Your request is already in a pending state, and please wait until the admin approves it.');
                                            return redirect()->to(site_url('user/withdrawals'));
                                        }
                                        else{
                                            $userToBePaid = calculateUserLoan($data['user_id']);
                                            /*var_dump($userToBePaid);
                                            echo '<br><br>';
                                            var_dump($data);
                                            echo '<br><br>';
                                            var_dump($loadData);*/
                                            if ($loadData['ul_amount'] < $userToBePaid || $loadData['ul_amount'] > $userToBePaid) {
                                                customFlash('alert-info','You have to pay <strong>' . $userToBePaid . '$</strong>.');
                                                return redirect()->to(site_url('user/withdrawals'));
                                            }
                                            else{
                                                //echo 'all thing are working fine.';
                                                //dd();
                                                if (!empty($loadData['ul_trasaction_id'])) {
                                                    $checkIfLoanIDExist = $tableLoan->where(
                                                        'ul_trasaction_id', $loadData['ul_trasaction_id'])
                                                        ->findAll();
                                                    if (count($checkIfLoanIDExist) == 0) {
                                                        $trackData = getTrackData('withdraw(Loan)');
                                                        $userload = $tableLoan->addUserLoan($data,$trackData,$loadData);//$data is the withdraw data
                                                        if ($userload) {
                                                            customFlash('alert-success','We have successfully paid the loan, and it\'s pending approval; once the admin approves this, you can withdraw.');
                                                            return redirect()->to(site_url('user/loan'));
                                                        }
                                                        else{
                                                            customFlash('alert-danger','OOps..! something went wrong please try again.');
                                                            return redirect()->to(site_url('user/loan'));
                                                        }
                                                    }
                                                    else{
                                                        customFlash('alert-info','The PM Transaction id is already exist. ');
                                                        return redirect()->to(site_url('user/withdrawals'));
                                                    }

                                                }
                                                else{
                                                    customFlash('alert-info','The PM Transaction id is required');
                                                    return redirect()->to(site_url('user/withdrawals'));
                                                }
                                            }

                                        }
                                    }
                                    else{
                                        customFlash('alert-info','You don\'t have enough amount to withdraw (We charge 1$% if you select Cash as a Fund Type) , your available amount  is: <strong>'.$availableAmount.'</strong>');
                                        return redirect()->to(site_url('user/withdrawals'));
                                    }

                                }
                                else{
                                    //return redirect()->to(site_url('user/withdrawals'));//remove this comment
                                    //var_dump($data['uw_fund_type']);
                                    $perfectMoneyAccount = getSessionData('u_perfect');
                                    $planExist = getUserPlan(getUserId());
                                    //var_dump($planExist);
                                    if ($planExist == false) {
                                        customFlash('alert-info','You can\'t withdraw your amount through perfect money if you do not have any plan.');
                                        return redirect()->to(site_url('user/plans'));
                                    }

                                    //echo 'pm here';
                                    //die();
                                    if (!empty($perfectMoneyAccount)) {
                                        $totalCashboxAfterDate = getCashBoxAfterDate(getUserId());
                                        $totalWithdrawlAfterDate = getWithdrawlAfterDate(getUserId());
                                        $reminAfterDate = $totalCashboxAfterDate - $totalWithdrawlAfterDate;
                                        /*echo $totalCashboxAfterDate.'Cashbox After Date';
                                        echo '<br><br>';
                                        echo $totalWithdrawlAfterDate.'Withdrawl After Date';
                                        echo '<br><br>';
                                        echo $reminAfterDate.'Remaining After Date';
                                        echo '<br><br>';
                                        echo $data['uw_amount'].'Amount Current withdrawl';
                                        echo '<br><br>';
                                        dd();*/
                                        if ($data['uw_amount'] <= $availableAmount && $data['uw_amount'] <=$reminAfterDate) { //$availableAmount
                                            //$data['uw_amount'] = $data['uw_amount'];//+$perfectPercentage;
                                            $data['perfect_money_transfer'] = $data['uw_amount']-$perfectPercentage;
                                            $data['uw_fund_type'] = $data['uw_fund_type'] .  ' ( With ' . PerfectMoneyCharges.'$ % Perfect Money Charges)';
                                            $data['uw_current_pm_id'] = $perfectMoneyAccount;
                                            //var_dump($data);
                                            //die();
                                            $trackData = getTrackData('withdraw');
                                            $UserWithDraw = $tableUserWithdraw->addUserWithDraw($data,$trackData);
                                            //$UserWithDraw = $this->modUser->addUserWithDraw($data);
                                            if ($UserWithDraw) {
                                                customFlash('alert-success','We have successfully received your withdraw request, its pending for admin approval.');
                                                return redirect()->to(site_url('user/withdrawals'));
                                            }
                                            else{
                                                customFlash('alert-danger','OOps..! something went wrong please try again.');
                                                return redirect()->to(site_url('user/withdrawals'));
                                            }
                                        }
                                        else{
                                            customFlash('alert-info','You don\'t have enough amount to withdraw (We charge 1$% if you select Cash as a Fund Type) , your available amount  is: <strong>'.$availableAmount.'</strong>');
                                            return redirect()->to(site_url('user/withdrawals'));
                                        }
                                    }
                                    else{
                                        customFlash('alert-danger','Please add your perfect money account before withdraw');
                                        return redirect()->to(site_url('user/withdrawals'));
                                    }

                                }//else perfect money
                            }//available limit

                            else{
                                customFlash('alert-info','Your Cash box is empty OR not finalized yet.');
                                return redirect()->to(site_url('user/withdrawals'));
                            }
                        }
                    }
                    else{
                        customFlash('alert-info','Your security pin is invalid please try again.');
                        return redirect()->to(site_url('user/withdrawals'));

                    }
                }
                else{
                    customFlash('alert-info','Please set your security pin before withdraw');
                    return redirect()->to(site_url('user/profile'));
                }

            }
        }
        else{
            customFlash('alert-info','Please login first to access the admin panel');
            return redirect()->to(site_url('login'));

        }

    }

    /*public function profile()
    {
        if (userLoggedIn()) {
            $tableUser = new ModUsers();
            $data['userInfo'] = $tableUser->where('u_id',getUserSession('u_id'))->findAll();
            //$data['AllCities'] = $this->modUser->getAllActiveCities();
            //$data['userInfo'] = $this->modUser->getUserInfo(getUserSession('u_id'));
            $data['title'] = 'Profile ' . PROJECT;
            $data['aprofi'] = 'active';
            $data['description'] = 'Profile';
            $bradCrum[] = ['text'=>'Home','link'=>base_url()];
            $bradCrum[] = ['text'=>'Dashboard','link'=>site_url('user')];
            $bradCrum[] = ['text'=>'Profile','link'=>''];
            $data['bradcrum'] = $bradCrum;
            echo view('users/header/header',$data);
            echo view('users/css/allCSS');
            echo view('css/phone');
            echo view('css/bootstrapSelect');
            echo view('css/formValidation');
            echo view('users/header/leftBar');
            echo view('users/header/topBar');
            echo view('users/header/stats',$data);
            echo view('users/content/profile',$data);
            echo view('users/footer/footer');
            echo view('js/phone');
            echo view('js/bootstrapSelect');
            echo view('js/formValidation');
            echo view('js/profile');
            echo view('users/footer/endfooter');
        }
        else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }

    }*/

    public function updateUserPin()
    {
        if (userLoggedIn()) {
            $request = $this->request;
            $old_pin = $request->getPost('old_pin');
            $new_pin = $request->getPost('new_pin');
            $tableUser = new ModUsers();
            //dd();
            if (empty($old_pin) || empty($new_pin)) {
                customFlash('alert-info', 'Please check required fields before changing your pin.');
                //echo 'if here';
                return redirect()->to(site_url('user/profile'));
            } else {
                if (is_numeric($new_pin) && strlen($new_pin) == 4) {
                    $checkPin = checkSecurityPin(getUserId());
                    //var_dump($checkPin);
                    if ($checkPin) {
                        if ($checkPin == $old_pin) {
                            //$checkOldPassword['u_id']  = getUserId();
                            //$checkOldPassword['u_pin']  = $new_pin;
                            $userId = getUserId();
                            $mydata['u_pin'] = $new_pin;
                            $returnType = $tableUser->update($userId,$mydata);
                            if ($returnType) {
                                $trackData = getTrackData('Pin Changed',$userId);
                                $tableTrack = new ModTracking();
                                $tableTrack->insert($trackData);
                                customFlash('alert-success', 'You have successfully changed your security pin.');
                                return redirect()->to(site_url('user/profile'));
                            } else {
                                customFlash('alert-info', 'We can\'t update your security pin right now.');
                                return redirect()->to(site_url('user/profile'));
                            }

                        } else {
                            customFlash('alert-info', 'Your security pin is invalid please enter your valid pin and try again.');
                            return redirect()->to(site_url('user/profile'));
                        }

                    }
                    else {
                        customFlash('alert-info', 'Please create a security pin before changing your password.');
                        return redirect()->to(site_url('user/profile'));
                    }
                }
                else{
                    customFlash('alert-info','The pin must contain at least 4 digits.');
                    return redirect()->to(site_url('user/profile'));
                }

            }//main else here
        }
        else{
            customFlash('alert-info', 'Please login before changing your security pin.');
            return redirect()->to(site_url('login'));
        }
    }






    public function pm()
    {
        if (userLoggedIn()) {
            $validation = $this->validator;
            $request = $this->request;
            $session =  $this->session;
            $tableUser = new ModUsers();
            if (getSessionData('u_email')==='shakzee171@gmail.com') {
                //$pmData = $this->modUser->getperfectMoneyCredentials(getUserId());
                $pmData = $tableUser->where(['u_id'=>getUserId(),'u_status'=>1])->findAll();
                if (isset($pmData) && count($pmData) === 1) {
                    if (empty($pmData[0]['u_perfect']) || empty($pmData[0]['u_perfect_password'])) {
                        customFlash('alert-info','You have to set the perfect money id and password to view your Perfect money detail.');
                        return redirect()->to(site_url('user/profile'));
                    }
                    else{
                        $data['prData'] = array();
                        // trying to open URL to process PerfectMoney Spend request
                        if (getSessionData('pmPassword')) {
                            $pmPasswordAPI = getSessionData('pmPassword');
                            $f=fopen('https://perfectmoney.com/acct/balance.asp?AccountID='.$pmData[0]['u_perfect'].'&PassPhrase='.$pmPasswordAPI, 'rb');
                            if($f===false){
                                echo 'error openning url';
                            }
                            /*echo 'var dump here:';
                            echo '<br>';
                            var_dump($f);
                            echo '<br>';
                            echo '<br>';*/

                            // getting data
                            $out=array(); $out="";
                            while(!feof($f)) $out.=fgets($f);

                            fclose($f);

                            // searching for hidden fields
                            if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $out, $result, PREG_SET_ORDER)){
                                echo 'Ivalid output';
                                exit;
                            }

                            // putting data to array
                            $ar="";
                            $getUSCurrencyID = '';
                            $myArry = array();
                            foreach($result as $item){
                                $myArry[] = $item;
                                if (isset($item[1]) && $item[1] !='ERROR') {
                                    if (substr($item[1], 0, 1) === 'U') {
                                        $getUSCurrencyID = $item[1];
                                    }
                                }

                                //var_dump($item[1]);
                                //echo '<br>';
                                /*$key=$item[1];
                                $ar[$key]=$item[2];*/
                                /*if (substr('_abcdef', 0, 1) === 'U') {
                                    $getUSCurrencyID = '';
                                }*/
                            }

                            $checkPmvalet['users.u_status'] = 1;
                            $checkPmvalet['users.u_id'] = getUserId();
                            $returnQuery = $tableUser->select('users.u_perfect_valet')->where($checkPmvalet)->findAll();
                            //$returnQuery = $this->modUser->checkPerfectValet(getUserId());
                            if ($returnQuery && count($returnQuery) == 1) {
                                if (empty($returnQuery[0]['u_perfect_valet'])) {
                                    if (isset($getUSCurrencyID) && !empty($getUSCurrencyID)) {
                                        $pmvalData['u_perfect_valet'] = $getUSCurrencyID;
                                        $tableUser->update(getUserId(),$pmvalData);
                                        //$this->modUser->updateUser($pmvalData,getUserId());
                                    }
                                }
                            }
                            $data['prData'] = $myArry;

                        }else{
                            $pmPassword = $request->getPost('pmpassword');
                            if (isset($pmPassword) && !empty($pmPassword)) {
                                $pmPasswordAPI = $pmPassword;
                                $pmPassword = hash('md5',$pmPassword);
                                $isPmMatched = $tableUser->checkPmPassword($pmPassword,getUserId());
                                //lastQuery();
                                //dd();
                                if ($isPmMatched && count($isPmMatched) === 1) {//echo 'checking if the password matched with database';
                                    //$this->session->set_userdata('pmPassword',$pmPasswordAPI);
                                    $session->set('pmPassword',$pmPasswordAPI);
                                    //redirect('user/pm');
                                    return redirect()->to(site_url('user/pm'));
                                }
                                else{
                                    customFlash('alert-info','Your PM password is invalid,please check your PM password and try again.');
                                    return redirect()->to(site_url('user/pm'));
                                }
                            }

                        }

                        /*echo $getUSCurrencyID;
                                echo '<br>';
                                var_dump($myArry);
                                die();*/

                        //die();
                        $data['title'] = 'User' . PROJECT;
                        //$data['description'] = 'User  Dashboard';
                        $data['adash'] = 'active';
                        echo view('users/header/header',$data);
                        echo view('users/css/allCSS');
                        echo view('users/css/c3');
                        echo view('users/header/topBar');
                        echo view('users/header/leftBar');
                        echo view('users/content/pm',$data);
                        echo view('users/footer/footer');
                        //echo view('users/js/copyToclicp');
                        echo view('users/js/peity');
                        echo view('users/js/c3');
                        echo view('users/js/knob');
                        echo view('users/js/appandDashboard');
                        echo view('users/footer/endfooter');

                    }
                }
                else{
                    customFlash('alert-info','You have to set the perfect money id and password to view your Perfect money detail.');
                    return redirect()->to(site_url('user/profile'));
                }
            }
            else{
                customFlash('alert-info','We are doing some work on this page, please visit this page after a few hours.');
                return redirect()->to(site_url('user/profile'));
            }

        }
        else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }
    }

    public function buyCash()
    {
        if (userLoggedIn()) {
            $data['title'] = 'Buy Cash' . PROJECT;
            $tableUser = new ModUsers();
            //$data['userData'] = $this->modUser->getUserData(getUserId());
            $data['userData'] = $tableUser->getUserData(getUserId());
            if ($data['userData'] && count($data['userData']) == 1) {
                if (!empty($data['userData'][0]['u_perfect']) || !empty($data['userData'][0]['u_perfect_password'])) {
                    if (!empty($data['userData'][0]['u_perfect_valet'])) {
                        $data['u_perfect_valet'] =  $data['userData'][0]['u_perfect_valet'];
                        $data['adash'] = 'active';
                        echo view('users/header/header',$data);
                        echo view('users/css/allCSS');
                        echo view('css/formValidation');
                        echo view('users/header/topBar');
                        echo view('users/header/leftBar');
                        echo view('users/content/buyCash',$data);
                        echo view('users/footer/footer');
                        echo view('js/formValidation');
                        echo view('users/js/buyCash');
                        echo view('users/js/peity');
                        echo view('users/js/appandDashboard');
                        echo view('users/footer/endfooter');
                    }
                    else{
                        customFlash('alert-info','Your perfect money wallet is not found.');
                        return redirect()->to(site_url('user/pm'));
                    }

                }
                else{
                    customFlash('alert-info','Please add your perfect money account and password, i.e., 7987123');
                    return redirect()->to(site_url('user/profile'));
                }

            }
            else{
                customFlash('alert-info','Kindly login before accessing your dashboard.');
                return redirect()->to(site_url('user/profile'));
            }

        }
        else{
            customFlash('alert-info','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }
    }


    public function transferCash()
    {
        if (userLoggedIn()) {
            $redirectURL = null;
            $validation = $this->validator;
            $request = $this->request;
            if (!$this->validate($validation->getRuleGroup('newCashFromPM'))) {
                $this->buyCash();
                //customFlash('alert-warning','Please check your required fields and tray again.','user/plans');
            }
            else{
                $checkPin = checkSecurityPin(getUserId());
                $securityPin = $request->getPost('pin'); //$this->input->post('pin',true);
                if ($checkPin) {
                    if ($checkPin == $securityPin) {
                        //$image_path = realpath(APPPATH . '../assets/images/prof/');
                        //$userId = getUserId();
                        $deposit['cb_type'] = $request->getPost('deposit_type');//$this->input->post('deposit_type',true);
                        $deposit['cb_currency'] = $request->getPost('dep_currency');//$this->input->post('dep_currency',true);
                        $deposit['frm_wallet'] = $request->getPost('fromAccount');//$this->input->post('fromAccount',true);
                        $deposit['to_wallet'] = $request->getPost('toAccount');//$this->input->post('toAccount',true);
                        $deposit['cb_amount'] = $request->getPost('dep_amount');//$this->input->post('dep_amount',true);
                        $u_perfect_password = $request->getPost('pmPass');//$this->input->post('pmPass',true);
                        //$deposit['cb_bank_transaction_id'] = $this->input->post('bank_trasac',true);
                        $deposit['cb_inserted_date'] = date('Y-m-d H:i:s');
                        $deposit['user_id'] = getUserId(); //userId
                        $deposit['cb_status'] = 0; //userId
                        $checkPmPassword = hash('md5',$u_perfect_password);
                        $tabledUsers = new ModUsers();
                        $tabledUserCashBox = new ModUserCashBox();
                        $isPmPasword = $tabledUsers->checkPmPassword($checkPmPassword,getUserId());
                        if ($isPmPasword && count($isPmPasword) == 1) {
                            if (!empty($isPmPasword[0]['u_perfect_password'])) {
                                if ($isPmPasword[0]['u_perfect_password'] == $checkPmPassword) {
                                    //echo 'ok matched';
                                    /*

                                    This script demonstrates transfer proccess between two
                                    PerfectMoney accounts using PerfectMoney API interface.

                                    */
                                    //var_dump($isPmPasword[0]['u_perfect']);
                                    //die();
                                    // trying to open URL to process PerfectMoney Spend request
                                    if (!empty($isPmPasword[0]['u_perfect']) && isset($isPmPasword[0]['u_perfect'])) {
                                        $pmentID = random_string('alnum', 5).date('m').date('d').date('s');
                                        /*echo 'https://perfectmoney.com/acct/confirm.asp?
                                    AccountID='.$isPmPasword[0]['u_perfect'].'&PassPhrase='.$deposit['u_perfect_password'].'&Payer_Account='.$deposit['frm_wallet'].'
                                    &Payee_Account='.$deposit['to_wallet'].'&Amount='.$deposit['cb_amount'].'&PAY_IN=1&PAYMENT_ID=1223';*/
                                        $params = array('AccountID' => $isPmPasword[0]['u_perfect'],
                                            'PassPhrase' => $u_perfect_password,
                                            'Payer_Account' => $deposit['frm_wallet'],
                                            'Payee_Account' => $deposit['to_wallet'],
                                            'Amount' => $deposit['cb_amount'],
                                            'PAY_IN' => 1,
                                            'PAYMENT_ID' => $pmentID,
                                        );

                                        $query = http_build_query($params);
                                        echo 'https://perfectmoney.com/acct/confirm.asp?'.$query;
                                        echo '<br><br>';

                                        //die();
                                        $f=fopen('https://perfectmoney.com/acct/confirm.asp?'.$query, 'rb'
                                        );

                                        if($f===false){
                                            //echo 'error openning url';
                                            customFlash('alert-info','We can\'t proceed with your request right now; please try again later; if it happed more than twice, please contact the admin.','user/buyCash');
                                            return redirect()->to(site_url('login'));
                                        }

                                        // getting data
                                        $out=array(); $out="";
                                        while(!feof($f)) $out.=fgets($f);

                                        fclose($f);

                                        // searching for hidden fields
                                        if(!preg_match_all("/<input name='(.*)' type='hidden' value='(.*)'>/", $out, $result, PREG_SET_ORDER)){
                                            echo 'Ivalid output';
                                            exit;
                                        }

                                        $ar="";
                                        $skzData[] = array();
                                        //var_dump($result);
                                        foreach($result as $item){
                                            //var_dump($item);
                                            $skzData[]=array(
                                                $item[1]=>$item[2]
                                            );
                                            /*$key = $item[1];
                                            $ar[$key] = $item[2];*/
                                        }
                                        if ($skzData && count($skzData) == 2) {
                                            customFlash('alert-info','This is Error: '. $skzData[1]['ERROR'] . '. Please check the form and try again.');
                                            return redirect()->to(site_url('user/buyCash'));
                                        }
                                        else if ($skzData && count($skzData) == 7) {
                                            //customFlash('alert-info','Your Perfect money id is not exist please, add/create your id.','user/buyCash');
                                            $trackData = getTrackData('cashBox');
                                            $addCashBoxRequest = $tabledUserCashBox->addCashBoxRequest($deposit,$trackData);
                                            if ($addCashBoxRequest){
                                                customFlash('alert-success','We have successfully received your deposit request, once admin confirms your payment it will available in your amount(Cash Box).');
                                                return redirect()->to(site_url('user/cashbox'));
                                            }
                                            else{
                                                customFlash('alert-warning','We have received your payment but can\'t add it to your cash box; please contact the admin.');
                                                return redirect()->to(site_url('user/buyCash'));
                                            }
                                        }
                                        else{
                                            customFlash('alert-info','Something went wrong please try again.');
                                            return redirect()->to(site_url('user/buyCash'));
                                        }
                                        /*echo '<pre>';
                                        var_dump($skzData);
                                        echo '</pre>';*/
                                    }
                                    else{
                                        customFlash('alert-info','Your Perfect money id is not exist please, add/create your id.');
                                        return redirect()->to(site_url('user/buyCash'));
                                    }


                                }
                                else{
                                    customFlash('alert-info','Your perfect money password is not matched.');
                                    return redirect()->to(site_url('user/buyCash'));
                                }

                            }
                            else{
                                customFlash('alert-info','Your Perfect money password is not exist; please create/add your perfect money password.');
                                return redirect()->to(site_url('user/profile'));
                            }
                        }
                        else{
                            customFlash('alert-info','Perfect money password not matched or does not exist, please check your Perfect money password and try again.');
                            //echo 'Perfect money password not matched or does not exist, please check your Perfect money password and try again.';
                            return redirect()->to(site_url('user/buyCash'));
                        }

                       /* echo '<br>';
                        var_dump($deposit);
                        die();*/
                        /*$currentPlan = $this->modUser->checkCashBoxRequest($deposit);
                        if ($currentPlan->num_rows() > 0) {
                            customFlash('alert-info','We have already received your request, please wait once the admin approve your request.');
                            return redirect()->to(site_url('user/buyCash'));
                        }
                        else{
                            $addCashBoxRequest = $this->modUser->addCashBoxRequest($deposit);
                            if ($addCashBoxRequest){
                                customFlash('alert-success','We have successfully received your deposit request, once admin confirms your payment it will available in your amount(Cash Box).');
                                return redirect()->to(site_url('user/cashbox'));
                            }
                            else{
                                customFlash('alert-warning','Something went wrong please try again or contact the admin if you face the problem twice.');
                                return redirect()->to(site_url('user/buyCash'));
                            }
                        }*/
                    }else{
                        customFlash('alert-info','Your security pin is invalid please try again.');
                        return redirect()->to(site_url('user/buyCash'));
                    }

                }else{
                    customFlash('alert-info','Please set your security pin before withdraw');
                    return redirect()->to(site_url('user/profile'));
                }




            }//else if everything is fine..
        }
        else{
            customFlash('alert-warning','Login now before accessing dashboard.');
            return redirect()->to(site_url('login'));
        }
    }

    public function cashrequest()
    {
        if (userLoggedIn()) {
            $data['title'] = 'Cash Request ' . PROJECT;
            $data['description'] = 'Cash Request page description';
            $data['acash'] = 'active';
            $bradCrum[] = ['text'=>'Home','link'=>base_url()];
            $bradCrum[] = ['text'=>'Dashboard','link'=>site_url('user')];
            $bradCrum[] = ['text'=>'cash Request','link'=>''];
            $data['bradcrum'] = $bradCrum;
            echo view('users/header/header',$data);
            echo view('users/css/allCSS');
            echo view('css/formValidation');
            echo view('users/header/leftBar');
            echo view('users/header/topBar');
            echo view('users/header/stats',$data);
            echo view('users/content/cashrequest',$data);
            echo view('users/footer/footer');
            echo view('js/formValidation');
            echo view('users/js/cashrequest');
            echo view('users/footer/endfooter');
        }
        else{
            customFlash('alert-info','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }
    }

    public function depositrequest()
    {

       // echo 'working..';
       // dd();
        if (userLoggedIn()) {
            $validation = $this->validator;
            $request = $this->request;
            $tableUsrCashBox = new ModUserCashBox();
            if (!$this->validate($validation->getRuleGroup('depositRequest'))) {
                $this->cashrequest();
            }
            else{
                $checkPin = checkSecurityPin(getUserId());
                $securityPin = $request->getPost('pin');
                if ($checkPin) {
                    if ($checkPin == $securityPin) {

                        $deposit['cb_type'] = $request->getPost('deposit_type');
                        $deposit['cb_currency'] = $request->getPost('dep_currency');
                        $deposit['cb_amount'] = $request->getPost('dep_amount');
                        $deposit['cb_bank_transaction_id'] = $request->getPost('bank_trasac');
                        $deposit['cb_bank_transaction_id'] = strip_tags($deposit['cb_bank_transaction_id']);
                        $deposit['cb_inserted_date'] = date('Y-m-d H:i:s');//check this further
                        $deposit['user_id'] = getUserId(); //userId
                        $deposit['cb_status'] = 0; //userId
                        if ($deposit['cb_amount'] < 25) {
                            customFlash('alert-info','Minimum values is 25');
                            return redirect()->to(site_url('user/cashrequest'));
                        }

                        //$currentPlan = $this->modUser->checkCashBoxRequest($deposit);
                        $currentPlan = $tableUsrCashBox->checkCashBoxRequest($deposit);
                        if (count($currentPlan) > 0) {
                            //dd($currentPlan);
                            if ($currentPlan[0]['cb_status'] == 0) {
                                customFlash('alert-info','The Transaction id already exists; You must have the unique Transaction id.');
                                return redirect()->to(site_url('user/cashrequest'));
                            }
                            else if($currentPlan[0]['cb_bank_transaction_id'] == $deposit['cb_bank_transaction_id']){
                                customFlash('alert-info','The Transaction id already exists; You must have the unique Transaction id.');
                                return redirect()->to(site_url('user/cashrequest'));
                            }
                        }
                        else{
                            //$myProff = $this->deposiProf($image_path);//image upload system
                            $cashBoxProfFile = $request->getFile('prof_image');
                            if (!empty($cashBoxProfFile) && $cashBoxProfFile->getSize() > 0) {
                                $deposiProfName = $cashBoxProfFile->getRandomName();
                                $cashBoxProfFile->move('./public/assets/images/prof',$deposiProfName);
                                $deposit['cb_prof'] = $deposiProfName;
                            }
                            //$deposit['cb_prof'] = $myProff;
                            $trackData = getTrackData('cashbox');
                            $addCashBoxRequest = $tableUsrCashBox->addCashBoxRequest($deposit,$trackData);
                            if ($addCashBoxRequest){
                                customFlash('alert-success','We have successfully received your deposit request, once admin confirms your payment it will available in your amount.');
                                return redirect()->to(site_url('user/cashbox'));
                            }
                            else{
                                customFlash('alert-warning','Something went wrong please try again or contact the admin if you face the problem twice.');
                                return redirect()->to(site_url('user/cashrequest'));
                            }
                        }
                    }else{
                        customFlash('alert-info','Your security pin is invalid please try again.');
                        return redirect()->to(site_url('user/cashrequest'));
                    }

                }else{
                    customFlash('alert-info','Please set your security pin before withdraw');
                    return redirect()->to(site_url('user/profile'));
                }

            }//else if everything is fine..
        }
        else{
            customFlash('alert-warning','Login now before accessing dashboard.');
            return redirect()->to(site_url('login'));
        }
    }

    public function referrals()
    {
        if (userLoggedIn()) {

            $userFralId[] = getSessionData('u_ref_id');
            $children = array();
            $currUserId = getUserId();
            $tableUserPlans = new ModUserPlans();
            //$userPlan = $this->modUser->getUserPlans($currUserId);//retrun type array
            $userPlan = $tableUserPlans->getUserPlansById($currUserId);//retrun type array
            $comessionLevel = 0 ;
            if (count($userPlan) === 1) {
                $comessionLevel = $userPlan[0]['pl_commission'];
                //echo '<br>';
            }
            $myLevelsData = array();
            for ($i=1;$i<=$comessionLevel;$i++) {
                /*echo 'Level'.$i;
                echo '<br>';*/
                $okLevel = $this->generateLevels($userFralId);

                if (
                    $okLevel['returnLevelData'] != false &&
                    !empty($okLevel['anotherLevel']) && count($okLevel['anotherLevel']) > 0
                ) {//anotherLevel
                    $myLevelsData[] = $okLevel['returnLevelData'];
                    $userFralId = $okLevel['anotherLevel'];
                    //$children = $okLevel['childs'];
                    //var_dump($userFralId);
                    //echo '<br>';
                }
                //$myLevelsData[] =
            }
            //die();
            $data['comessionLevel'] = $comessionLevel;
            $data['LevelsData'] = $myLevelsData;
            $data['title'] = 'Referrals ' . PROJECT;
            $data['description'] = 'Referrals';
            $data['arefe'] = 'active';
            $bradCrum[] = ['text'=>'Home','link'=>base_url()];
            $bradCrum[] = ['text'=>'Dashboard','link'=>site_url('user')];
            $bradCrum[] = ['text'=>'Referrals','link'=>''];
            $data['bradcrum'] = $bradCrum;
            echo view('users/header/header',$data);
            echo view('users/css/allCSS');
            echo view('css/bootstrapSelect');
            echo view('users/header/leftBar');
            echo view('users/header/topBar');
            echo view('users/header/stats',$data);
            echo view('users/content/referrals',$data);
            echo view('users/footer/footer');
            echo view('js/bootstrapSelect');
            echo view('users/footer/endfooter');
        }
        else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }
    }

    public function deposithistory($userId = null)
    {
        if (userLoggedIn()) {
            if (empty($userId))
            {
                customFlash('alert-info','Please check your user ID and try again.');
                return redirect()->to(site_url('user/referrals'));
            }
            else
            {
                $CurrentUserId = getUserId();
                $userInof = getUserInfo($userId);//jiski infor chahye
                //$CurrentUserId = getUserInfo($CurrentUserId);//jo login ha user
                if (count($userInof) === 1) {
                    $tableUserDeposit = new ModUserDeposit();
                    //$AllDeposits = $this->modUser->checkdeposithistory($userInof[0]['u_ref_id']);
                    $AllDeposits = $tableUserDeposit->checkdeposithistory($userInof[0]['u_ref_id']);
                    if(count($AllDeposits) > 0)
                    {
                        $data['deposits'] = $AllDeposits;
                        $data['title'] = 'User Deposits ' . PROJECT;
                        $data['description'] = 'User Deposits';
                        $data['adash'] = 'active';
                        $bradCrum[] = ['text'=>'Home','link'=>base_url()];
                        $bradCrum[] = ['text'=>'Dashboard','link'=>site_url('user')];
                        $bradCrum[] = ['text'=>'Deposits','link'=>site_url('user/deposits')];
                        $bradCrum[] = ['text'=>'Deposits History','link'=>''];
                        $data['bradcrum'] = $bradCrum;
                        echo view('users/header/header',$data);
                        echo view('users/css/allCSS');
                        echo view('users/header/leftBar');
                        echo view('users/header/topBar');
                        echo view('users/header/stats',$data);
                        echo view('users/content/deposithistory',$data);
                        echo view('users/footer/footer');
                        echo view('users/footer/endfooter');


                    }
                    else
                    {
                        customFlash('alert-warning','The data is not available.');
                        return redirect()->to(site_url('user/referrals'));
                    }
                }
                else{
                    customFlash('alert-warning','User is not exist');
                    return redirect()->to(site_url('user/referrals'));
                }


            }
        }else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }
    }

    public function restorepin()
    {
        if (userLoggedIn()) {
            $userdata = getUserData(getUserId());
            //var_dump($email[0]['u_email']);
            //die();
            $checkPin = checkSecurityPin(getUserId());
            //$userdata = $this->modUser->checkEmailForLink($email);
            if ($checkPin){
                $data['user_name'] = $userdata[0]['user_name'];
                $data['u_id'] = $userdata[0]['u_id'];
                $data['u_email'] = $userdata[0]['u_email'];
                $data['u_link'] = $userdata[0]['u_link'];
                $data['u_pin'] = $userdata[0]['u_pin'];
                if (restoreUserPin($data)){
                    customFlash('alert-info','We have just sent you the security pin  on this email:   <strong> ' . $userdata[0]['u_email'] . ' </strong> Please check your inbox/Junk/Spam folder.');
                    return redirect()->to(site_url('user'));
                }
                else{
                    customFlash('alert-warning','WE can\'t send you the security pin right now on this email: <strong> ' . $userdata[0]['u_email'] . ' </strong> ');
                    return redirect()->to(site_url('user'));
                }
            }
            else{
                customFlash('alert-warning','This is your first time to set your pin, please set your pin here now.');
                return redirect()->to(site_url('user/profile'));
            }
        }
        else{
            customFlash('alert-warning','Please login first before restore your pin');
            return redirect()->to(site_url('login'));
        }
    }

    public function texteupdate()
    {
        $tableUser = new ModUsers();
        $data = ['u_link'=>random_string('alnum',20)];
        //dd($data);
        $isupdated = $tableUser->set('u_link',random_string('alnum',20))
            ->where('u_email','shakzee171@gmail.com')
            ->update();
        //$isupdated = $tableUser->where('u_email','shakzee171@gmail.com')->update($data);
        var_dump($isupdated);
    }
    public function resendLink()
    {
        //$email = $this->input->post('email',true);
        $request = $this->request;
        $session =  $this->session;
        $tableUser = new ModUsers();
        $email = $request->getPost('email');//$this->input->post('email',true);
        if (isset($email) && !empty($email)){
            $session->set('activationLink',$email);
            $userdata = $tableUser->checkEmailForLink($email);
            //$userdata = $this->modUser->checkEmailForLink($email);
            if (count($userdata) == 1){
                $data['user_name'] = $userdata[0]['user_name'];
                $data['u_id'] = $userdata[0]['u_id'];
                $data['u_email'] = $userdata[0]['u_email'];
                $data['u_link'] = $userdata[0]['u_link'];
                if (ResendActivationLinkUser($data)){
                    customFlash('alert-info','We have just sent you an activation link on this email:   <strong> ' . $userdata[0]['u_email'] . ' </strong> Please check your inbox OR Junk folder to activate your account.','login');
                    return redirect()->to(site_url('login'));
                }
                else{
                    customFlash('alert-warning','WE can\'t send you the activate link right now on this email: <strong> ' . $userdata[0]['u_email'] . ' </strong> Please' . anchor('user/sendLink','Click Here') . ' to resend.','login');
                    return redirect()->to(site_url('user/forgot'));
                }
            }
            else{
                customFlash('alert-warning','This email: <strong>' . $email .'</strong>  is not exist please check your email and try again.');
                return redirect()->to(site_url('user/forgot'));
            }
        }
        else if($session->has('activationLink') && !empty($session->has('activationLink'))){
            $email = $session->get('activationLink');
            $userdata = $tableUser->checkEmailForLink($email);
            if (count($userdata) == 1){
                $data['user_name'] = $userdata[0]['user_name'];
                $data['u_id'] = $userdata[0]['u_id'];
                $data['u_email'] = $userdata[0]['u_email'];
                $data['u_link'] = $userdata[0]['u_link'];
                if (ResendActivationLinkUser($data)){
                    customFlash('alert-info','We have just sent you an activation link on this email:   <strong> ' . $userdata[0]['uEmail'] . ' </strong> Please check your inbox OR Junk folder to activate your account . ');
                    return redirect()->to(site_url('login'));
                }
                else{
                    customFlash('alert-warning','WE can\'t send you the activate link right now on this email: <strong> ' . $userdata[0]['uEmail'] . '  </strong> Please ' . anchor('user/sendLink',' Click Here ') . ' to resend.');
                    return redirect()->to(site_url('login'));
                }
            }
            else{
                customFlash('alert-warning','This email: <strong>' . $email .'</strong>  is not exist please check your email and tr again.');
                return redirect()->to(site_url('login'));
            }
        }
        else{
            customFlash('alert-warning','Something went wrong.');
            return redirect()->to(site_url('login'));
        }
    }
    /*Ticket System starts here*/
    public function newticket()
    {
        if (userLoggedIn()) {
            $data['title'] = 'New Ticket ' . PROJECT;
            $tableTicketCategories =new ModTicketCategories();
            $data['TicketCategories'] = $tableTicketCategories->where('tic_status',1)
                ->orderBy('tic_name','asc')
                ->findAll();
            $data['description'] = 'New Ticket';
            $data['userTick'] = 'active';
            $bradCrum[] = ['text'=>'Home','link'=>base_url()];
            $bradCrum[] = ['text'=>'Dashboard','link'=>site_url('user')];
            $bradCrum[] = ['text'=>'New Ticket','link'=>''];
            $data['bradcrum'] = $bradCrum;
            echo view('users/header/header',$data);
            echo view('users/css/allCSS');
            echo view('css/formValidation');
            echo view('users/css/uploadImgaes');
            echo view('users/header/leftBar');
            echo view('users/header/topBar');
            echo view('users/header/stats',$data);
            echo view('users/content/newticket',$data);
            echo view('users/footer/footer');
            echo view('js/formValidation');
            echo view('users/js/uploadImgaes');
            echo view('users/js/newticket');
            echo view('users/footer/endfooter');
        }
        else{
            customFlash('alert-info','Kindly login before accessing your dashboard.');
        }
    }

    public function openticket()
    {

        // echo 'working..';
        // dd();
        if (userLoggedIn()) {
            $validation = $this->validator;
            $request = $this->request;
            $tableUserTicket = new ModUserTickets();
            $tableTicketMedia = new ModUserTicketMedia();
            if (!$this->validate($validation->getRuleGroup('openTicket'))) {
                $this->cashrequest();
            }
            else{
                $checkPin = checkSecurityPin(getUserId());
                $securityPin = $request->getPost('pin');
                if ($checkPin) {
                    if ($checkPin == $securityPin) {
                        $userTicket['ticket_category_id'] = $request->getPost('category');
                        $userTicket['ut_title'] = $request->getPost('title');
                        $userTicket['ut_detail'] = $request->getPost('detail');
                        $userTicket['ut_ticket_number'] = random_string('alnum', 9).date('d')
                            .date('m').date('s');
                        $userTicket['user_id'] = getUserId(); //userId
                        $checkUserTicket = $tableUserTicket->where('ut_ticket_number',$userTicket['ut_ticket_number'])
                            ->findAll();
                        if (count($checkUserTicket) > 0) {
                            customFlash('alert-info','Ticket already exist.');
                            return redirect()->to(site_url('user/newticket'));
                        }
                        $userTickeId = $tableUserTicket->insert($userTicket,'ut_id');
                        if ($userTickeId) {
                            $uploadFiles = $this->request->getFiles();
                            $userTicketImages = array();
                            if ($uploadFiles) {
                                foreach($uploadFiles['images'] as $img)
                                {
                                    if ($img->isValid()  &&   ! $img->hasMoved()  )
                                    {
                                        $newName = $img->getRandomName();
                                        $img->move('./public/assets/images/usertickets',$newName);
                                        $userTicketImages[] = [
                                            'user_ticket_id'=>$userTickeId,
                                            'utm_pic_name'=>$newName,
                                            'utm_date'=>date('Y-m-d H:i:s'),
                                            'utm_updated'=>date('Y-m-d H:i:s'),
                                        ];

                                    }
                                }//images foreach here
                                $tableTicketMedia->insertBatch($userTicketImages);
                            }//images check here
                            customFlash('alert-success','You\'ve submitted a ticket successfully; a representative will examine it and contact you within 48 hours.');
                            return redirect()->to(site_url('user/newticket'));
                        }
                        else{
                            customFlash('alert-info','There was an error, please try again later.');
                            return redirect()->to(site_url('user/newticket'));
                        }

                        //var_dump($userTicket);

                    }else{
                        customFlash('alert-info','Your security pin is invalid please try again.');
                        return redirect()->to(site_url('user/newticket'));
                    }

                }else{
                    customFlash('alert-info','Please set your security pin before withdraw');
                    return redirect()->to(site_url('user/profile'));
                }

            }//else if everything is fine..
        }
        else{
            customFlash('alert-warning','Login now before accessing dashboard.');
            return redirect()->to(site_url('login'));
        }
    }
    /*Ticket System starts here*/

    public function calendar()
    {
        if (userLoggedIn()) {
            $db      = \Config\Database::connect();
            $builder = $db->table('events');
            $calendarQuery = $builder->select('*')
                ->where('ev_status',1)
                ->where('ev_delete',null)
                ->join('newsevents','newsevents.ne_id=events.events_id')
                ->get();
            $calendarData = $calendarQuery->getResult();

            $data = array();
            if (count($calendarData) > 0) {
                foreach ($calendarData as $key => $value) {
                    $data['calendarData'][$key]['title'] = $value->title;
                    $data['calendarData'][$key]['start'] = $value->start_date;
                    $data['calendarData'][$key]['end'] = $value->end_date;
                    $data['calendarData'][$key]['backgroundColor'] = "#DA9F37";
                }
            }else{
                $data['calendarData'] = array();
            }

            $data['title'] = 'Profile' . PROJECT;
            echo view('users/headnav/header',$data);
            echo view('users/css/allCSS');
            echo view('users/headnav/navbartop');
            echo view('users/headnav/navbarleft');
            echo view('users/content/calendar',$data);
            echo view('users/footer/footer');
            echo view('js/eventsCalendar',$data);
            echo view('users/footer/endfooter');


        }
        else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }

    }
    public function albums()
    {
        if (userLoggedIn()) {
            $tableModGallery= new ModGallery();
            $tableModGallery->select('gallery.*')
                ->where([
                    'gallery.gl_status'=>1
                ])
                ->orderBy('gallery.gl_id','desc');
            $data = [
                'galleries' => $tableModGallery->paginate(5),
                'pager' => $tableModGallery->pager
            ];

            $data['title'] = 'Profile' . PROJECT;
            echo view('users/headnav/header',$data);
            echo view('users/css/allCSS');
            //echo view('css/phone');
            echo view('users/headnav/navbartop');
            echo view('users/headnav/navbarleft');
            echo view('users/content/albums',$data);
            echo view('users/footer/footer');
            //echo view('js/phone');
            echo view('users/footer/endfooter');


        }
        else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }

    }

    public function galleryimages($gallery_id)
    {
        if (userLoggedIn()) {
            if (!empty($gallery_id) && isset($gallery_id)) {
                $tableGalImages = new ModGalleryImages();
                $checkGallery = $tableGalImages->select()
                    ->where([
                        'gallery_images.gi_status'=>1,
                        'gallery_images.gallery_id'=>$gallery_id,
                    ])
                    ->join('gallery','gallery.gl_id = gallery_images.gallery_id')
                    ->orderBy('gallery_images.gi_id','desc')
                    ->findAll();
                if (count($checkGallery) > 0) {
                    $data['galleries'] = $checkGallery;
                    $data['title'] = 'Gallery ' . PROJECT;
                    $data['description'] = 'Gallery Description here';


                    echo view('users/headnav/header',$data);
                    echo view('users/css/allCSS');
                    echo view('css/lightGalleryCss');//extra css
                    echo view('users/headnav/navbartop');
                    echo view('users/headnav/navbarleft');
                    echo view('users/content/galleryImages',$data);
                    echo view('users/footer/footer');
                    echo view('js/lightGalleryJs');
                    echo view('users/footer/endfooter');

                    /*echo view('header/header',$data);
                    echo view('css/allCSS');
                    echo view('css/lightGalleryCss');//extra css
                    echo view('header/navbar');
                    echo view('content/photoGalleries',$data);
                    echo view('content/subscribed');
                    echo view('footer/footer');
                    echo view('js/lightGalleryJs');
                    echo view('footer/endfooter');*/

                }
                else{
                    customFlash('alert-info','Photos not available in the gallery');
                    return redirect()->to(site_url('photo-galleries'));
                }
            }
            else{
                customFlash('alert-info','Something went wrong, please check your required things and try again.');
                return redirect()->to(site_url('photo-galleries'));
            }
        }
        else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }
    }



    public function sendLink()
    {
        $request = $this->request;
        $session =  $this->session;
        $tableUser =  new ModUsers();
        $email = $request->getPost('email');
        if (isset($email) && !empty($email)){
            //$this->session->userdata('activationLink',$email);
            $session->set('activationLink',$email);
            $userdata = $this->modUser->checkEmailForLink($email);
            if (count($userdata) == 1){
                $data['user_name'] = $userdata[0]['user_name'];
                //$data['u_company_name'] = $userdata[0]['u_company_name'];
                $data['u_id'] = $userdata[0]['u_id'];
                $data['u_email'] = $userdata[0]['u_email'];
                $data['u_link'] = $userdata[0]['u_link'];
                if (sendActivationLink($data)){
                    customFlash('alert-warning','We have just sent you an activation link on this email:   <strong> ' . $userdata[0]['u_email'] . ' </strong> Please check your inbox OR Junk folder to activate your account.','register');
                }
                else{
                    customFlash('alert-warning','WE can\'t send you the activate link right now on this email: <strong> ' . $userdata[0]['u_email'] . ' </strong> Please' . anchor('user/sendLink','Click Here') . ' to resend.','register');
                }
            }
            else{
                customFlash('alert-warning','This email: <strong>' . $email .'</strong> does not exist please check your email.','register');
            }
        }

        else if($session->has('activationLink') &&
                !empty($session->has('activationLink'))
                ){
            $email = $session->get('activationLink');
            $isEmailExist = $tableUser->where('u_email',$email)->findAll();
            if (count($isEmailExist) == 1) {
                $setLink = array('u_link'=>random_string('alnum',20));
                $isUserUpdated = $tableUser->updateUser($isEmailExist[0]['u_id'],$setLink);
                if ($isUserUpdated) {
                    $userdata = $tableUser->where('u_email',$email)->findAll();
                    if (count($userdata) == 1){
                        $data['user_name'] = $userdata[0]['user_name'];
                        $data['u_id'] = $userdata[0]['u_id'];
                        $data['u_email'] = $userdata[0]['u_email'];
                        $data['u_link'] = $userdata[0]['u_link'];
                        if ($this->sendActivateEmail($data)){
                            customFlash('alert-info','We have just sent you an activation link on this email:   <strong> ' . $userdata[0]['u_email'] . ' </strong> Please check your inbox OR Junk folder to activate your account . ');
                            return redirect()->to(site_url('register'));
                        }
                        else{
                            customFlash('alert-info','WE can\'t send you the activation link right now on this email: <strong> ' . $userdata[0]['u_email'] . '  </strong> Please ' . anchor('user/sendLink',' Click Here ') . ' to resend.');
                            return redirect()->to(site_url('register'));
                        }
                    }
                    else{
                        customFlash('alert-info','This email: <strong>' . $email .'</strong>  is not exist please check your email and tr again.');
                        return redirect()->to(site_url('register'));
                    }
                }
                else{
                    customFlash('alert-info','We can\'t send you the link right now, please contact the admin');
                    return redirect()->to(site_url('login'));
                }
            }
            else{
                customFlash('alert-info','The email is not exist.');
                return redirect()->to(site_url('login'));
            }
        }
        else{
            customFlash('alert-info','Something went wrong.');
            return redirect()->to(site_url('register'));
        }


    }





    private function sendActivateEmail($data)
    {
        $msg = view('emails/signup',$data);
        $to = [$data['u_email']];
        $subject = 'Account Activation';
        $htmlContent = $msg;

        $emailController = new \App\Controllers\SendGridEmailController();
        $emailSent = $emailController->sendEmail(
            $subject,
            $to,
            [],
            '',
            $htmlContent
        );

        if ($emailSent) {
            return true;
        }else{
            return false;
        }
        //var_dump($data);
        // $message = view('emails/signup',$data);        
        // $email = \Config\Services::email();
        // $emailConfig = new \Config\Email();
        // $email->initialize($emailConfig);
        // $email->setFrom(EMAIL, PROJECT);
        // $email->setTo($data['u_email']);
        // $email->setSubject('Account activation');
        // $email->setMessage($message);//your message here
        // if ($email->send()) {
        //     return true;
        // }
        // else{
        //     return false;
        // }
    }

    public function sendBirthdayWishes()
    {
        // Get today's date in the format YYYY-MM-DD
        $today = date('Y-m-d');
        $tableUser =  new ModUsers();
        
        // Fetch users who have a birthday today
        $users = $tableUser->where('DATE(u_dob)', $today)->findAll();

        if (!empty($users)) {
            $emailController = new \App\Controllers\SendGridEmailController();
            $subject = "Happy Birthday from Great Ife Alumni";
    
            // Send birthday wishes email to each user
            foreach ($users as $user) {
                $userData = [
                    'u_email' => $user['u_email'],
                    'u_first_name' => $user['u_first_name'],
                    'u_last_name' => $user['u_last_name'],
                ];

                // Create the email content using the template
                $msg = view('emails/birthday', $userData);

                // Send the email
                $emailSent = $emailController->sendEmail(
                    $subject,
                    [$user['u_email']],
                    [],
                    '',
                    $msg
                );
                
                // Log or handle the result as needed
                if (!$emailSent) {
                    // Handle failure to send the email (e.g., log error, retry, etc.)
                    log_message('error', 'Failed to send birthday email to ' . $user['u_email']);
                }
            }
        } else {
            log_message('info', 'No users with birthdays today');
        }
    }

    public function forgot()
    {
        //dd();
        if (!userLoggedIn()) {
            $data['title'] = 'Login' . PROJECT;
            $data['description'] = 'Login';
            echo view('header/header',$data);
            echo view('css/allCSS');
            echo view('css/owl');
            echo view('header/navbar');
            echo view('users/content/forgot',$data);
            echo view('content/subscribed');
            echo view('footer/footer');
            echo view('footer/endfooter');
        }
        else{
            return redirect()->to(site_url('user'));
        }

    }
    /*	Filters here*/

    private function filterWhereForview()
    {
        $request = $this->request;
        $user = $request->getGet('user');

        $plns = $request->getGet('plns');

        $deposit = $request->getGet('deposit');
        $query = $request->getGet('q');
        $fromDate = $request->getGet('fromDate');

        $toDate = $request->getGet('toDate');
        $page = $request->getGet('pp');

        $fdp = $request->getGet('fdp');
        $mdp =$request->getGet('mdp');

        $fup = $request->getGet('fup');
        $tup = $request->getGet('tup');

        $fudd = $request->getGet('fudd');
        $tudd = $request->getGet('tudd');

        $fcbd = $request->getGet('fcbd');
        $tcbd = $request->getGet('tcbd');

        $fwid = $request->getGet('fwid');
        $twid = $request->getGet('twid');

        $fud = $request->getGet('fud');
        $tud = $request->getGet('tud');

        $fbnd = $request->getGet('fbnd');
        $tbnd = $request->getGet('tbnd');

        $fupl = $request->getGet('fupl');
        $tupl = $request->getGet('tupl');

        $fbns = $request->getGet('fbns');
        $tbns = $request->getGet('tbns');

        $cbs = $request->getGet('cbs');
        $pst= $request->getGet('pst');

        $dps = $request->getGet('dps');

        $wist = $request->getGet('wist');

        $filters = array();
        if (isset($user) && !empty($user))
        {
            $filters['user'] = $user ;
        }
        else{
            $filters['user'] = '' ;
        }
        if (isset($deposit) && !empty($deposit))
        {
            $filters['deposit'] = $deposit ;
        }
        else{
            $filters['deposit'] = '' ;
        }
        if (isset($fromDate) && !empty($fromDate))
        {
            $filters['fromDate'] = $fromDate ;
        }
        else{
            $filters['fromDate'] = '' ;
        }
        if (isset($toDate) && !empty($toDate))
        {
            $filters['toDate'] = $toDate ;
        }
        else{
            $filters['toDate'] = '' ;
        }
        if (isset($page) && !empty($page))
        {
            $filters['pp'] = $page ;
        }
        else{
            $filters['pp'] = '' ;
        }

        if (isset($fdp) && !empty($fdp))
        {
            $filters['fdp'] = $fdp ;
        }
        else{
            $filters['fdp'] = '' ;
        }
        if (isset($mdp) && !empty($mdp))
        {
            $filters['mdp'] = $mdp ;
        }
        else{
            $filters['mdp'] = '' ;
        }
        if (isset($fup) && !empty($fup))
        {
            $filters['fup'] = $fup ;
        }
        else{
            $filters['fup'] = '' ;
        }
        if (isset($tup) && !empty($tup))
        {
            $filters['tup'] = $tup ;
        }
        else{
            $filters['tup'] = '' ;
        }

        if (isset($fudd) && !empty($fudd))
        {
            $filters['fudd'] = $fudd ;
        }
        else{
            $filters['fudd'] = '' ;
        }

        if (isset($tudd) && !empty($tudd))
        {
            $filters['tudd'] = $tudd ;
        }
        else{
            $filters['tudd'] = '' ;
        }
        if (isset($fcbd) && !empty($fcbd))
        {
            $filters['fcbd'] = $fcbd ;
        }
        else{
            $filters['fcbd'] = '' ;
        }

        if (isset($tcbd) && !empty($tcbd))
        {
            $filters['tcbd'] = $tcbd ;
        }
        else{
            $filters['tcbd'] = '' ;
        }

        if (isset($fwid) && !empty($fwid))
        {
            $filters['fwid'] = $fwid ;
        }
        else{
            $filters['fwid'] = '' ;
        }

        if (isset($twid) && !empty($twid))
        {
            $filters['twid'] = $twid ;
        }
        else{
            $filters['twid'] = '' ;
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

        if (isset($fbnd) && !empty($fbnd))
        {
            $filters['fbnd'] = $fbnd;
        }
        else{
            $filters['fbnd'] = '' ;
        }

        if (isset($tbnd) && !empty($tbnd))
        {
            $filters['tbnd'] = $tbnd;
        }
        else{
            $filters['tbnd'] = '' ;
        }
        if (isset($fupl) && !empty($fupl))
        {
            $filters['fupl'] = $fupl;
        }
        else{
            $filters['fupl'] = '' ;
        }
        if (isset($tupl) && !empty($tupl))
        {
            $filters['tupl'] = $tupl;
        }
        else{
            $filters['tupl'] = '' ;
        }
        if (isset($plns) && !empty($plns))
        {
            $filters['plns'] = $plns;
        }
        else{
            $filters['plns'] = '' ;
        }

        if (isset($fbns) && !empty($fbns))
        {
            $filters['fbns'] = $fbns;
        }
        else{
            $filters['fbns'] = '' ;
        }
        if (isset($tbns) && !empty($tbns))
        {
            $filters['tbns'] = $tbns;
        }
        else{
            $filters['tbns'] = '' ;
        }
        if (isset($cbs) && !empty($cbs))
        {
            $filters['cbs'] = $cbs;
        }
        else{
            $filters['cbs'] = '' ;
        }
        if (isset($pst) && !empty($pst))
        {
            $filters['pst'] = $pst;
        }
        else{
            $filters['pst'] = '' ;
        }
        if (isset($dps) && !empty($dps))
        {
            $filters['dps'] = $dps;
        }
        else{
            $filters['dps'] = '' ;
        }
        if (isset($wist) && !empty($wist))
        {
            $filters['wist'] = $wist;
        }
        else{
            $filters['wist'] = '' ;
        }


        return $filters;
    }
    private function filterWhereForModels()
    {
        $filters = array();
        $request = $this->request;
        if (!empty($_GET)) {
            $filters = false;
            $user = $request->getGet('user');
            $cbs = $request->getGet('cbs');
            $deposit = $request->getGet('deposit');
            $fromDate = $request->getGet('fromDate');
            $toDate = $request->getGet('toDate');

            $fdp = $request->getGet('fdp');
            $mdp = $request->getGet('mdp');

            $fup = $request->getGet('fup');
            $tup = $request->getGet('tup');

            $fudd = $request->getGet('fudd');
            $tudd =$request->getGet('tudd');

            $fcbd = $request->getGet('fcbd');
            $tcbd = $request->getGet('tcbd');

            $fwid = $request->getGet('fwid');
            $twid = $request->getGet('twid');

            $fud = $request->getGet('fud');
            $tud = $request->getGet('tud');

            $fbnd = $request->getGet('fbnd');
            $tbnd = $request->getGet('tbnd');

            $fupl = $request->getGet('fupl');
            $tupl = $request->getGet('tupl');

            $plns = $request->getGet('plns');

            $fbns = $request->getGet('fbns');
            $tbns = $request->getGet('tbns');

            $pst = $request->getGet('pst');
            $dps = $request->getGet('dps');

            $wist = $request->getGet('wist');

            if (isset($user) && !empty($user)) {
                $filters['users.u_id'] = $user;
            }
            if (isset($deposit) && !empty($deposit)) {
                $filters['user_deposit.ud_id'] = $deposit;
            }
            /*if (isset($user) && !empty($user) && isset($deposit) && !empty($deposit)) {
                $filters['user_deposit.ud_id'] = $deposit;
                $filters['users.u_id'] = $user;
            }*/
            if (isset($fromDate) && !empty($fromDate)) {
                $filters['user_profit.pr_insertion_date >='] = $fromDate;
            }
            if (isset($toDate) && !empty($toDate)) {
                $filters['user_profit.pr_insertion_date <='] = $toDate;
            }
            if (isset($fdp) && !empty($fdp)) {
                $filters['daily_profit.dp_insert_date >='] = $fdp;
            }
            if (isset($mdp) && !empty($mdp)) {
                $filters['daily_profit.dp_insert_date <='] = $mdp;
            }
            if (isset($fup) && !empty($fup)) {
                $filters['user_plans.up_date >='] = $fup;
            }
            if (isset($tup) && !empty($tup)) {
                $filters['user_plans.up_date <='] = $tup;
            }

            if (isset($fudd) && !empty($fudd)) {
                $filters['user_deposit.ud_date >='] = $fudd;
            }
            if (isset($tudd) && !empty($tudd)) {
                $filters['user_deposit.ud_date <='] = $tudd;
            }

            if (isset($fcbd) && !empty($fcbd)) {
                $filters['user_cash_box.cb_inserted_date >='] = $fcbd;
            }
            if (isset($tcbd) && !empty($tcbd)) {
                $filters['user_cash_box.cb_inserted_date <='] = $tcbd;
            }
            if (isset($fwid) && !empty($fwid)) {
                $filters['user_withdraw.uw_date  >='] = $fwid;
            }
            if (isset($twid) && !empty($twid)) {
                $filters['user_withdraw.uw_date <='] = $twid;
            }

            if (isset($fud) && !empty($fud)) {
                $filters['users.u_date  >='] = $fud;
            }
            if (isset($tud) && !empty($tud)) {
                $filters['users.u_date <='] = $tud;
            }

            if (isset($fbnd) && !empty($fbnd)) {
                $filters['usermonthlybonus.bn_date  >='] = $fbnd;
            }
            if (isset($tbnd) && !empty($tbnd)) {
                $filters['usermonthlybonus.bn_date <='] = $tbnd;
            }

            if (isset($fupl) && !empty($fupl)) {
                $filters['user_plans.up_date  >='] = $fupl;
            }
            if (isset($tupl) && !empty($tupl)) {
                $filters['user_plans.up_date <='] = $tupl;
            }

            if (isset($plns) && !empty($plns)) {
                $filters['user_plans.plan_id'] = $plns;
            }


            if (isset($fbns) && !empty($fbns)) {
                $filters['usermonthlybonus.bn_date  >='] = $fbns;
            }
            if (isset($tbns) && !empty($tbns)) {
                $filters['usermonthlybonus.bn_date <='] = $tbns;
            }
            if (isset($cbs) && !empty($cbs)) {
                $filters['user_cash_box.cb_status'] = $cbs;
            }
            if (isset($pst) && !empty($pst)) {
                $filters['user_profit.pr_status'] = $pst;
            }
            if (isset($dps) && !empty($dps)) {
                $filters['user_deposit.ud_status'] = $dps;
            }
            if (isset($wist) && !empty($wist)) {
                $filters['user_withdraw.uw_status'] = $wist;
            }

            /*if (isset($man) && !empty($man)) {
                $filters['machine_listing.mac_manufacturer'] = $deposit;
            }*/
        }
        return $filters;
    }

    /*	Filters here*/

    /*email testing*/
    public function emailTesting()
    {
        $message = 'shakzee.com'; //view('emails/signup',$data);
        $email = \Config\Services::email();
        $email->setFrom(EMAIL, PROJECT);
        $email->setTo('shakzee171@gmail.com');
        $email->setSubject('Account activation');
        $email->setMessage($message);//your message here
        if ($email->send()) {
            echo  'email sent';
        }
        else{
            echo $email->printDebugger();
            echo 'email not sent.';
        }
    }


    /*Search system here*/
    public function search()
    {
        if (userLoggedIn()) {
            $tableUsers = new ModUsers();
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
            $filters['u_status'] = 1;
            $filters['u_id !='] = getUserId();
            $tableUsers->where($filters)->orderBy('u_id','desc');
            $data = [
                'allUsers' => $tableUsers->paginate($perPage),
                'pager' => $tableUsers->pager,
                'filters' => $this->filterWhereForview()
            ];

            $data['title'] = 'User Search' . PROJECT;
           /* $data['allUsers'] = $tableUsers
                ->where('u_status',1)
                ->where('u_id !='.getUserId())
                ->find();*/

            $data['description'] = 'User Search';
            echo view('users/headnav/header',$data);
            echo view('users/css/allCSS');
            echo view('users/headnav/navbartop');
            echo view('users/headnav/navbarleft');
            echo view('users/content/search',$data);
            echo view('users/footer/footer');
            echo view('users/footer/endfooter');

        }
        else{
            customFlash('alert-warning','Kindly login before accessing your dashboard.');
            return redirect()->to(site_url('login'));
        }



    }
    public function subscribe()//User Login system
    {
        $request = $this->request;
        $session =  $this->session;
        if ($request->isAJAX()) {
            $email = $request->getPost('userEmail');
            if (!empty($email))
            {
                $subscirTable =  new ModSubscribers();
                $isSubcribe = $subscirTable->where('sb_email',$email)->findAll();
                if (count($isSubcribe) == 1)
                {
                    if ($isSubcribe[0]['sb_status'] == 1) {
                        $data['return'] = FALSE;
                        $data['message'] = 'You have already subscribed to our newsletter.';
                        echo json_encode($data);
                    }
                    else if ($isSubcribe[0]['sb_status'] == 0){
                        $appData['sb_email'] = $email;
                        $appData['sb_status'] = 1;
                        $isupdated = $subscirTable->update($isSubcribe[0]['sb_id'],$appData);
                        if ($isupdated)
                        {
                            $data['return'] = TRUE;
                            $data['message'] = 'Thank you for subscribing to our newsletter.';
                            echo json_encode($data);
                        }
                        else
                        {
                            $data['return'] = FALSE;
                            $data['message'] = 'You can\'t subscribe to our newsletter right now, and please try again.';
                            echo json_encode($data);
                        }
                    }

                }
                else
                {
                    $appData['sb_email'] = $email;
                    $appData['sb_status'] = 1;
                    $isInserted = $subscirTable->insert($appData);
                    if ($isInserted)
                    {
                        //send email here
                        $data['return'] = TRUE;
                        $data['message'] = 'Thank you for subscribing to our newsletter.';
                        echo json_encode($data);
                    }
                    else
                    {
                        $data['return'] = FALSE;
                        $data['message'] = 'You can\'t subscribe to our newsletter right now, and please try again.';
                        echo json_encode($data);
                    }
                }

            }
            else
            {
                $data['return'] = FALSE;
                $data['message'] = 'Please enter your email address.';
                echo json_encode($data);
            }
        }else{
            customFlash('alert-warning','Oops! Something goes wrong, and please try again.');
            return redirect()->to(site_url('user/login'));

        }
    }
    /*Search system here*/
}//class here