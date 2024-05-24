<?php

namespace App\Controllers;

use App\Models\ModEvents;
use App\Models\ModHomeSection;
use App\Models\ModHowITWorks;
use App\Models\ModNewEvents;
use App\Models\Settings;
use App\Models\Sliders;
use App\Models\ModOnlineMeeting;

class Home extends BaseController
{
    protected $helpers = ['url', 'file', 'custom_helper','form','filesystem','text'];
    public function index()
    {
        $tablePClip = new ModNewEvents();
        $tableHowITWorks = new ModHowITWorks();
        $tableWhatWeDo = new ModHomeSection();//What We Do Section
        $talbeCalendar = new ModEvents();
        $talbleWebsiteSetting = new Settings();
        $tableSliders = new Sliders();
        $tableOnlineMeeting = new ModOnlineMeeting();
        $db      = \Config\Database::connect();
        $builder = $db->table('events');
        $calendarQuery = $builder->select('*')
            ->where('ev_status',1)
            ->where('DATE(start_date) >',date('Y-m-d'))
            ->join('newsevents','newsevents.ne_id=events.events_id')
            ->limit(5)->get();
        $data['upcomingevents'] = $calendarQuery->getResult();

        $data['websiteSetting'] = $talbleWebsiteSetting->findAll();

        $data['newshome']= $tablePClip->where('ne_category','news')->findAll(3);
        $data['eventshome']= $tablePClip->where('ne_category','events')->findAll(3);
        $data['onlinemeetings']= $tableOnlineMeeting->findAll(3);
        $data['howItWorks']= $tableHowITWorks->where('hi_set_featured', 1)->findAll();
        $data['whatWeDo']= $tableWhatWeDo->where('hs_status',1)->findAll();
        $data['sliders']= $tableSliders->where('sl_status',1)->findAll();

        $data['calendar']= $talbeCalendar->where('ev_status',1)->findAll();
        $data['title'] = 'Home' . PROJECT;
        $data['description'] = 'Home Description here';
        $data['calendarData'] = hasCalendarData();

        // dd($data['upcomingevents']);

        echo view('header/header',$data);
        echo view('css/allCSS',$data);
        echo view('css/owl');
        echo view('css/quickEvents');   
        echo view('header/homenavbar');
        echo view('header/Homebanner',$data);
        echo view('content/upcomingEvents');
        echo view('content/MainHome',$data);
        echo view('content/subscribed');
        echo view('footer/footer');
        echo "<script>
        var upcomingEvents = $('.upcoming-event-content');
        upcomingEvents.owlCarousel({
            nav: !0,
            loop: !0,
            items: 1,
            dots: !1,
            autoPlay: !1,
            navText: ['<i class=\'fas fa-chevron-left\'></i>', '<i class=\'fas fa-chevron-right\'></i>']
        })
        </script>";
        // echo view('js/eventsCalendar',$data);
        echo view('js/quickEvents');
        echo view('footer/endfooter');
    }


}//class here
