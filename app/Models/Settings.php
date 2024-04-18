<?php

namespace App\Models;

use CodeIgniter\Model;

class Settings extends Model
{
    protected $DBGroup = 'default';
    protected $table      = 'settings';
    protected $primaryKey = 'st_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'st_email','st_phone',
        'st_address','st_footer_cotnent', 'st_date', 'st_updated','st_deleted',
        'st_status','st_fav_icon','st_logo','st_what_we_do','st_how_it_works','st_recent_news','st_recent_events','st_calendar'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'st_date';
    protected $updatedField  = 'st_updated';
    protected $deletedField  = 'st_deleted';

    protected $validationRules    = [

    ];
    protected $validationMessages = [

    ];
    protected $skipValidation     = false;
}//class here