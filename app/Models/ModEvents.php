<?php

namespace App\Models;

use CodeIgniter\Model;

class ModEvents extends Model
{

    protected $DBGroup = 'default';
    protected $table      = 'events';
    protected $primaryKey = 'ev_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'title', 'start_date','end_date',
        'events_id',
        'ev_date','ev_update','ev_delete','ev_status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'ev_date';
    protected $updatedField  = 'ev_update';
    protected $deletedField  = 'ev_delete';

    protected $validationMessages = [

    ];
    protected $skipValidation     = false;

    public function checkCalendar($data,$calendarId = null)
    {
        if (!empty($calendarId) && isset($calendarId)) {
            $where = array(
                'title'=>$data['title'],
                'ev_id !='=>$calendarId
            );
            return $this->where($where)->findAll();
        }
        else{
            $where = array(
                'title'=>$data['title']
            );
            return $this->where($where)->findAll();
        }
    }

    public function fatchAllCalendar()
    {
        return $this->select('events.*')
            //->where('gl_deleted IS NULL')
            ->orderBy('ev_id','desc')
            ->where('ev_status', 1);
    }

}//class here