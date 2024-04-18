<?php

namespace App\Controllers;

class FullCalendar extends BaseController
{

    public function index() {

        $db      = \Config\Database::connect();
        $builder = $db->table('events');
        $query = $builder->select('*')
            ->limit(10)->get();

        $data = $query->getResult();

        foreach ($data as $key => $value) {
            $data['data'][$key]['title'] = $value->title;
            $data['data'][$key]['start'] = $value->start_date;
            $data['data'][$key]['end'] = $value->end_date;
            $data['data'][$key]['backgroundColor'] = "#00a65a";
        }
        return view('fullCalendar',$data);
    }


}//class here