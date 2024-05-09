<?php
if (!function_exists('userdashboardFooter'))
{
    function userdashboardFooter()
    {
        $currentYear  = date('Y');
        echo "<div class='dashboard-copyright bg-white py-4 text-center w-100'>© ".$currentYear." Club All right reserved</div>";
    }
}

if (!function_exists('userLoggedIn'))
{
    function userLoggedIn()
    {
        $myCi = \Config\Services::session();
        $userDAta = $myCi->has('u_id');
        if ($userDAta && !empty($userDAta))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}

if (!function_exists('getSessionData'))
{
    function getSessionData($sessionKey)
    {
        $myCi = \Config\Services::session();
        $sessionUserId =$myCi->has('u_id');
        if ($sessionUserId && !empty($sessionUserId))
        {
            return  $myCi->get($sessionKey);
        }
        else{
            return  '';
        }
    }
}

if (!function_exists('getSessionAdminData'))
{
    function getSessionAdminData($sessionKey)
    {
        $myCi = \Config\Services::session();
        $sessionUserId =$myCi->has('aId');
        if ($sessionUserId && !empty($sessionUserId))
        {
            return  $myCi->get($sessionKey);
        }
        else{
            return  '';
        }
    }
}


if ( ! function_exists('checkFlash'))
{
    function checkFlash()
    {
        $session  = \Config\Services::session();
        if ($session->has('class') && $session->has('error'))
        {

            $data['class'] = $session->getFlashdata('class');
            $data['message'] = $session->getFlashdata('error');
            //return helper('',$data);
            return view('errors/my_error',$data);

        }

    }
}

if ( ! function_exists('customFlash'))
{
    function customFlash($class,$string,$Url=null)
    {
        $session  = \Config\Services::session();
        $session->setFlashdata('class',$class);
        $session->setFlashdata('error',$string);

    }
}

if (!function_exists('getUserId'))
{
    function getUserId()
    {
        $session  = \Config\Services::session();
        $currentUserId = $session->has('u_id');
        if ($currentUserId && !empty($currentUserId))
        {
            return $session->get('u_id');
        }
        else
        {
            return FALSE;
        }
    }
}

if (!function_exists('getUserIP'))
{
    function getUserIP()
    {
        $myCi = \Config\Services::request();
        //$userIp = $myCi->getIPAddress();
        $userIP = false;
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $userIP = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $userIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $userIP = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $userIP = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $userIP = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $userIP = $_SERVER['REMOTE_ADDR'];
        if ($myCi->isValidIP($userIP)) {
            return $userIP;
        }
        else{
            return false;
        }

    }
}

if (!function_exists('getTrackData'))
{
    function getTrackData($section,$id=null)
    {
        $myCi = \Config\Services::request();
        //$db  = db_connect();
        //$mViewsTable = $db->table('machine_views');
        //$agent = $myCi->load->library('user_agent');
        $agent = $myCi->getUserAgent();
        if ($agent->isBrowser())
        {
            $currentAgent = $agent->getBrowser().' '.$agent->getVersion();
        }
        elseif ($agent->isRobot())
        {
            $currentAgent = $agent->robot();
        }
        elseif ($agent->isMobile())
        {
            $currentAgent = $agent->getMobile();
        }
        else
        {
            $currentAgent = 'Unidentified';
        }
        $mViewData = [];
        $userIP = null;
        $getloc = false;
        if (getUserIP()) {
            $getloc = json_decode(file_get_contents("http://ip-api.com/json/".getUserIP()));
            //var_dump($getloc);
            //d();
            if ($getloc && $getloc->status =='success') {
                $mViewData['tr_country'] = $getloc->country;
                $mViewData['tr_countryCode'] = $getloc->countryCode;
                $mViewData['tr_region'] = $getloc->region;
                $mViewData['tr_regionName'] = $getloc->regionName;
                $mViewData['tr_city'] = $getloc->city;
                $mViewData['tr_zip'] = $getloc->zip;
                $mViewData['tr_lat'] = $getloc->lat;
                $mViewData['tr_lon'] = $getloc->lon;
                $mViewData['tr_timezone'] = $getloc->timezone;
                $mViewData['tr_isp'] = $getloc->isp;
                $mViewData['tr_org'] = $getloc->org;
            }
            if (isUserLoggedIn()) {
                $mViewData['user_id'] = getUserId();
            }
            $mViewData['tr_ip_address'] = getUserIP();
            $mViewData['tr_date'] = date('Y-m-d H:i:s');
            $mViewData['tr_updated'] = date('Y-m-d H:i:s');
            $mViewData['tr_platform'] =  $agent->getPlatform();
                $mViewData['section_id'] = $id;
            $mViewData['tr_section'] = $section;
            $mViewData['tr_user_agent'] =  $currentAgent;


        }
        $mViewData['tr_user_agent'] =  $currentAgent;
        return $mViewData;


    }
}

if (!function_exists('getCalendarData')){
    function hasCalendarData(){
        $db      = \Config\Database::connect();
        $builder = $db->table('events');
        $calendarQuery = $builder->select('*')
            ->where('ev_status',1)
            ->where('ev_delete',null)
            ->join('newsevents','newsevents.ne_id=events.events_id')
            ->get();
        $calendarData = $calendarQuery->getResult();

        // Fetch Online Meeting Events for calendar
        $online_meetings_builder = $db->table('online_meeting');
        $onlineMeetingsQuery = $online_meetings_builder->select("*")
        ->where('deleted_at',null)
        ->get();
        $onlineMeetingsData = $onlineMeetingsQuery->getResult();

        if(count($calendarData) > 0 || count($onlineMeetingsData) > 0){
            return true;
        }else{
            return false;
        }
    }
}

if (!function_exists('lastQuery'))
{
    function lastQuery()
    {
        $db  = db_connect();
        echo $db->showLastQuery();
    }
}
if (!function_exists('affectedRows'))
{
    function affectedRows()
    {
        $db  = db_connect();
        echo $db->affectedRows();
    }
}

if (!function_exists('isUserLoggedIn'))
{
    function isUserLoggedIn()
    {
        $myCi = \Config\Services::session();
        if ($myCi->has('u_id'))
        {
            return TRUE;
        }
        else
        {
            return 0;
        }

    }
}

if (!function_exists('getUserAgent'))
{
    function getUserAgent()
    {
        $myCi = \Config\Services::request();
        //$db  = db_connect();
        //$mViewsTable = $db->table('machine_views');
        //$agent = $myCi->load->library('user_agent');
        $agent = $myCi->getUserAgent();
        if ($agent->isBrowser())
        {
            $currentAgent = $agent->getBrowser().' '.$agent->getVersion();
        }
        elseif ($agent->isRobot())
        {
            $currentAgent = $agent->robot();
        }
        elseif ($agent->isMobile())
        {
            $currentAgent = $agent->getMobile();
        }
        else
        {
            $currentAgent = 'Unidentified';
        }
        return $currentAgent;
    }
}
if (!function_exists('validation_errors'))
{
    function validation_errors()
    {
        $validation = \Config\Services::validation();
        return  $validation->listErrors();
    }
}




if (!function_exists('getUserSession'))
{
    function getUserSession($key)
    {
        $myCi = \Config\Services::session();
        if ($myCi->has($key))
        {
            return $myCi->get($key);
        }
        else
        {
            return FALSE;
        }

    }
}





if (!function_exists('timeago'))
{
    function timeago($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $interval = $now->diff($ago);

        if ($interval->y > 0) {
            $result = $interval->y . " year" . ($interval->y > 1 ? "s" : "") . " ago";
        } elseif ($interval->m > 0) {
            $result = $interval->m . " month" . ($interval->m > 1 ? "s" : "") . " ago";
        } elseif ($interval->d > 0) {
            $result = $interval->d . " day" . ($interval->d > 1 ? "s" : "") . " ago";
        } elseif ($interval->h > 0) {
            $result = $interval->h . " hour" . ($interval->h > 1 ? "s" : "") . " ago";
        } elseif ($interval->i > 0) {
            $result = $interval->i . " minute" . ($interval->i > 1 ? "s" : "") . " ago";
        } else {
            $result = "Just now";
        }
        
        return $result;
    }
}




if (!function_exists('getUserData')) {
    function getUserData($userId)
    {
        $db = db_connect();
        $mViewsTable = $db->table('users');
        $userInfo = $mViewsTable->select('*')
            ->where('u_id', $userId)
            ->get()
            ->getResultArray();
        if (count($userInfo) === 1) {
            return $userInfo;
        } else {
            return false;
        }
    }
}

if (!function_exists('getUserInfo'))
{
    function getUserInfo($userId)
    {
        $db = db_connect();
        $mViewsTable = $db->table('users');
        $query = $mViewsTable->select('*')
            //->join('plans','plans.pl_id = user_plans.plan_id')
            ->where(array('users.u_status'=>1,'users.u_id'=>$userId))
            ->get()
            ->getResultArray();


        //$CI->db->cache_off();
        if (count($query) === 1) {
            return $query;
        }
        else{
            return false;
        }
    }

}




if (!function_exists('isAdmin'))
{
    function isAdmin()
    {
        $myCi = \Config\Services::session();
        if ($myCi->has('aId'))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }

    }
}



if (!function_exists('isSuperAdmin'))
{
    function isSuperAdmin()
    {
        $myCi = \Config\Services::session();
        if ($myCi->has('aSuperAdmin') == 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }

    }
}





if (!function_exists('getAdminId'))
{
    function getAdminId()
    {
        $myCi = \Config\Services::session();
        if ($myCi->has('aId'))
        {
            return $myCi->get('aId');
        }
        else
        {
            return 0;
        }

    }
}

if (!function_exists('getAdminData'))
{
    function getAdminData($adminId)
    {
        $db  = db_connect();
        $tableAdmin = $db->table('admin');
        $query = $tableAdmin->select('admin.*')
            //->from('admin')
            ->where(['aStatus'=>1,'aId'=>$adminId])
            ->get()->getResultArray();
        if (count($query) === 1)
        {
            return $query;
        }
        else
        {
            return false;
        }

    }
}

if (!function_exists('no_data'))
{
    function no_data($class,$error)
    {
        //$CI = & get_instance();
        $data['error'] = $error;
        $data['class'] = $class;

        echo view('errors/no_data',$data);
    }
}


if (!function_exists('dateDiffInDays')) {//cash box distributed by admin.
    function dateDiffInDays($date1)
    {
        $date1 = date('Y-m-d',strtotime($date1));
        // Calulating the difference in timestamps
        $date2 = date( 'Y-m-d');
        $diff = strtotime($date2) - strtotime($date1);

        // 1 day = 24 hours
        // 24 * 60 * 60 = 86400 seconds
        return abs(round($diff / 86400));

    }
}




if (!function_exists('ResendActivationLinkUser'))
{
    function ResendActivationLinkUser($data)
    {

        $msg = view('emails/ResendActivationLinkUser',$data);
        $email = \Config\Services::email();
        $email->setFrom(EMAIL, PROJECT);
        $email->setTo($data['u_email']);
        $email->setSubject('Recover Account');
        $email->setMessage($msg);//your message here
        if ($email->send()) {
            return true;
        }
        else{
            return false;
        }
    }
}

if (!function_exists('filterWhereForModels'))
{
    function filterWhereForModels()
    {
        $request = \Config\Services::request();
        $filters = array();
        if (!empty($_GET)) {
            //$filters = "";
            $srch =   $request->getGet('sn');//search news
            $stn =   $request->getGet('stn');
            $ss =   $request->getGet('ss');
            $sr =   $request->getGet('sr');

            if (isset($srch) && !empty($srch)) {
                $filters['newsevents.ne_title'] = $srch;
            }
            // These ones are useless.
            if (isset($stn) && !empty($stn)) {
                $filters['tenders.tn_name'] = $stn;
            }
            if (isset($ss) && !empty($ss)) {
                $filters['stories.st_name'] = $ss;
            }
            if (isset($sr) && !empty($sr)) {
                $filters['resource.r_title'] = $sr;
            }
            // These ones are useless
        }
        return $filters;
    }
}

if (!function_exists('filterForView'))
{
    function filterForView()
    {
        $request = \Config\Services::request();
        $srch =   $request->getGet('sn');
        $stn =   $request->getGet('stn');
        $ss =   $request->getGet('ss');
        $sr =   $request->getGet('sr');
        $filters = [];
        if (isset($srch) && !empty($srch))
        {
            $filters['sn'] = $srch ;
        }
        else{
            $filters['sn'] = '' ;
        }
        if (isset($stn) && !empty($stn))
        {
            $filters['stn'] = $stn ;
        }
        else{
            $filters['stn'] = '' ;
        }
        if (isset($ss) && !empty($ss))
        {
            $filters['ss'] = $ss ;
        }
        else{
            $filters['ss'] = '' ;
        }
        if (isset($sr) && !empty($sr))
        {
            $filters['sr'] = $sr ;
        }
        else{
            $filters['sr'] = '' ;
        }
        //$ordr
        return $filters;
    }
}

if (!function_exists('getListErrors'))
{
    function getListErrors()
    {
        $validation = \Config\Services::validation();
        return $validation->listErrors();
    }
}

if (!function_exists('AlbumImagesCount'))
{
    function AlbumImagesCount($gallery_id)
    {
        $db  = db_connect();
        $tablePrograms = $db->table('gallery_images');
        $pci_images = $tablePrograms
            //->from('gallery_images')
            ->where('gallery_id',$gallery_id)
            ->get()
            ->getResultArray();
        if (count($pci_images) > 0){
            return count($pci_images);
        }
        else {
            return 0;
        }
    }
}

if (!function_exists('getSingleImage'))
{
    function getSingleImage($galleryId)
    {
        $db  = db_connect();
        $gallery_imagesTable = $db->table('gallery_images');
        $return  = $gallery_imagesTable->select('gi_name')
            ->where('gi_status',1)
            ->where('gallery_id',$galleryId)
            ->get()
            ->getResultArray();
        if (count($return) > 0){
            return base_url('public/assets/images/galleryImages/'.$return[0]['gi_name']);
        }
        else {
            return false;
        }
    }
}




if (!function_exists('getwebsiteSetting'))
{
    function getwebsiteSetting($columnKey)
    {
        $db  = db_connect();
        $settingsTable = $db->table('settings');
        $return  = $settingsTable->select($columnKey)
            ->get()
            ->getResultArray();
        if (count($return) > 0){
            return $return[0][$columnKey];
        }
        else {
            return false;
        }
    }
}

if (!function_exists('getNewsEventName'))
{
    function getNewsEventName($id,$category)
    {
        $db  = db_connect();
        $tableNewsEvent = $db->table('newsevents');
        $newsEvents = $tableNewsEvent
            //->from('gallery_images')
            ->where('ne_id',$id)
            ->where('ne_category',$category)
            ->get()
            ->getResultArray();
        if (count($newsEvents) > 0){
            return $newsEvents[0]['ne_title'];
        }
        else {
            return 0;
        }
    }
}

