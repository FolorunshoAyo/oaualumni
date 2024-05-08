<?php

namespace App\Models;

use CodeIgniter\Model;

class ModOnlineMeeting extends Model
{
    protected $DBGroup = 'default';
    protected $table      = 'online_meeting';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'name', 'duration', 'timezone', 'start_time', 'host_video',
        'participant_video', 'join_before_host', 'auto_recording', 'admin_id', 
        'password', 'meeting_id', 'meeting_url'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationMessages = [];
    protected $skipValidation = false;

}//class here