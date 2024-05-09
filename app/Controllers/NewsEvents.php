<?php

namespace App\Controllers;
use App\Models\ModEvents;
use App\Models\ModNewEvents;
class NewsEvents extends BaseController
{
    protected $helpers = ['url', 'file', 'custom_helper','form','filesystem','text'];
    public function index()
    {
        $tablePClip = new ModNewEvents();
        $filters = filterWhereForModels();
        //dd($filters);
        $tablePClip
            ->where('newsevents.ne_status',1)
            ->where('newsevents.ne_category','news')
            ->orderBy('newsevents.ne_id','desc');
        if ($filters && count($filters) == 1) {
            $tablePClip->like('newsevents.ne_title',$filters['newsevents.ne_title']);
        }
        $data = [
            'news' => $tablePClip->paginate(5),
            'pager' => $tablePClip->pager,
            'filtrs' => filterForView(),
        ];
        /*var_dump($tablePClip->paginate(5));
        echo '<br><br><br><br>';
        lastQuery();
        dd();*/
        $data['title'] = 'News' . PROJECT;
        $data['description'] = 'News Description here';
        echo view('header/header',$data);
        echo view('css/allCSS');
        echo view('header/navbar');
        echo view('newsEvents/news',$data);
        echo view('content/subscribed');
        echo view('footer/footer');
        echo view('footer/endfooter');
    }

    public function readnrews($id)
    {
        if (!empty($id) && isset($id)) {
            $tableNewEvent  = new ModNewEvents();
            $checkNewEnt = $tableNewEvent->select()
                ->where([
                    'ne_id'=>$id,
                ])
                ->findAll();

            if (count($checkNewEnt) == 1) {
                $data['checkNewEnt'] = $checkNewEnt;
                $data['filtrs'] = filterForView();
                $data['title'] =  $checkNewEnt[0]['ne_title'] . '  ' . PROJECT;
                $data['description'] = $checkNewEnt[0]['ne_title'] . '  ' . PROJECT;
                echo view('header/header',$data);
                echo view('css/allCSS');
                echo view('header/navbar');
                echo view('newsEvents/readnrews',$data);
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
    
    public function events()
    {
        $tablePClip = new ModNewEvents();
        $tableCalendar = new ModEvents();
        $filters = filterWhereForModels();

        $db      = \Config\Database::connect();
        $builder = $db->table('events');
        $calendarQuery = $builder->select('*')
            ->where('ev_status',1)
            ->where('ev_delete',null)
            ->join('newsevents','newsevents.ne_id=events.events_id')
            ->limit(10)->get();
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
        //var_dump($data);
        //dd();
       /* $calendarQuery = $tableCalendar->where('ev_status',1)->
        join('newsevents','newsevents.ne_id=events.events_id')
        ->findAll();*/
        //dd($filters);

        $tablePClip
            ->where('newsevents.ne_status',1)
            ->where('newsevents.ne_category','events')
            ->orderBy('newsevents.ne_id','desc');
        if ($filters && count($filters) == 1) {
            $tablePClip->like('newsevents.ne_title',$filters['newsevents.ne_title']);
        }
        $data['news'] = $tablePClip->paginate(5);
        $data['pager'] = $tablePClip->pager;
        $data['filtrs'] = filterForView();
/*        $data = [
            'news' => $tablePClip->paginate(5),
            'pager' => $tablePClip->pager,
            'filtrs' => filterForView(),
        ];*/
        /*var_dump($data['news']);
        echo '<br><br><br><br>';
        lastQuery();
        dd();*/
        $data['title'] = 'Events' . PROJECT;
        $data['description'] = 'Events Description here';

        /*var_dump($data);
        dd();*/
        echo view('header/header',$data);
        echo view('css/allCSS');
        echo view('header/navbar');
        echo view('newsEvents/events',$data);
        echo view('content/subscribed');
        echo view('footer/footer');
        echo view('js/eventsCalendar',$data);
        echo view('footer/endfooter');
    }

    public function readevent($id){
        if (!empty($id) && isset($id)) {
            $tableNewEvent  = new ModNewEvents();
            $checkNewEnt = $tableNewEvent->select()
                ->where([
                    'ne_id'=>$id,
                ])
                ->findAll();

            if (count($checkNewEnt) == 1) {
                $data['checkNewEnt'] = $checkNewEnt;
                $data['filtrs'] = filterForView();
                $data['title'] =  $checkNewEnt[0]['ne_title'] . '  ' . PROJECT;
                $data['description'] = $checkNewEnt[0]['ne_title'] . '  ' . PROJECT;
                echo view('header/header',$data);
                echo view('css/allCSS');
                echo view('header/navbar');
                echo view('newsEvents/readnrews',$data);
                echo view('content/subscribed');
                echo view('footer/footer');
                echo view('footer/endfooter');
            }
            else{
                customFlash('alert-info','Event does not exist.');
                return redirect()->to(site_url('news'));
            }

        }
        else{
            customFlash('alert-info','Something went wrong, please check your required things and try again.');
            return redirect()->to(site_url('news'));
        }
    }

    public function fetchevents()
    {
        // This function returns all events and online meetings... for quickevents calendar
        /* Result should be something like - "{
        "title": "International Music Awards Ceremony",
        "image": "event_1.jpg",
        "day": "3",
        "month": "5",
        "year": "2024",
        "duration": 2,
        "time": "9:00 - 16:30",
        "color": "1",
        "location": "Viderer , 43st Wardour Street, London UK",
        "description": "<a href=\"http://google.com\">Lorem ipsum</a> dolor sit amet, consectetur adipiscing elit. Nullam non ornare eros. Ut pharetra ornare lorem, sit amet bibendum quam imperdiet ut. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non ornare eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non ornare eros. Ut pharetra ornare lorem, sit amet bibendum quam imperdiet ut. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non ornare eros."
        }"*/

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
                $startTimestamp = strtotime($value->start_date); 
                $endTimestamp = strtotime($value->end_date);

                $day = date('j', $startTimestamp);
                $month = date('n', $startTimestamp);
                $year = date('Y', $startTimestamp);

                $duration = ceil(($endTimestamp - $startTimestamp) / (60 * 60 * 24));

                $startTime = date('H:i', $startTimestamp);
                $endTime = date('H:i', $endTimestamp);

                $data['calendarData'][$key]['color'] = rand(1, 5);
                $data['calendarData'][$key]['day'] = $day;
                $data['calendarData'][$key]['description'] = base64_decode($value->ne_description) . "<br> <a href='#'>Read More</a>";
                $data['calendarData'][$key]['duration'] = $duration;
                $data['calendarData'][$key]['image'] = base_url('public/assets/images/newsEvents/'.$value->ne_dp);
                $data['calendarData'][$key]['location'] = $value->ne_location;
                $data['calendarData'][$key]['month'] = $month;
                $data['calendarData'][$key]['time'] = "$startTime - $endTime";
                $data['calendarData'][$key]['title'] = $value->ne_title;
                $data['calendarData'][$key]['year'] = $year;
            }
        }else{
            $data['calendarData'] = array();
        }

        // Fetch Online Meeting Events for calendar
        $online_meetings_builder = $db->table('online_meeting');
        $onlineMeetingsQuery = $online_meetings_builder->select("*")
        ->where('deleted_at',null)
        ->get();
        $onlineMeetingsData = $onlineMeetingsQuery->getResult();

        if(count($onlineMeetingsData) > 0){
            foreach ($onlineMeetingsData as $online_meeting) {
                $meetingData = array();

                $startDatetime = $online_meeting->start_time; 
                $durationMinutes = $online_meeting->duration;

                $startDateTimeObj = new \DateTime($startDatetime);

                $endDateTimeObj = clone $startDateTimeObj;
                $endDateTimeObj->modify("+" . $durationMinutes . " minutes");

                $startTimestamp = $startDateTimeObj->getTimestamp();
                $endTimestamp = $endDateTimeObj->getTimestamp();

                $day = date('j', $startTimestamp);
                $month = date('n', $startTimestamp);
                $year = date('Y', $startTimestamp);

                $startTime = date('H:i', $startTimestamp);
                $endTime = date('H:i', $endTimestamp);

                $meetingData['color'] = rand(1, 5);
                $meetingData['day'] = $day;
                $meetingData['description'] = $online_meeting->short_description . "<br> <a href='#'>Read More</a>";
                $meetingData['duration'] = "1";
                $meetingData['image'] = base_url('public/assets/images/zoom-placeholder.jpg');
                $meetingData['location'] = "Online";
                $meetingData['month'] = $month;
                $meetingData['time'] = "$startTime - $endTime";
                $meetingData['title'] = $online_meeting->name;
                $meetingData['year'] = $year;

                array_push($data['calendarData'], $meetingData);
            }

        }

        echo json_encode($data['calendarData']);
    }
}//class starts here