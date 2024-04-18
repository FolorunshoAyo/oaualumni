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
            ->join('newsevents','newsevents.ne_id=events.events_id')
            ->limit(10)->get();
        $calendarData = $calendarQuery->getResult();
        $data = array();
        if (count($data) > 0) {
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

}//class starts here