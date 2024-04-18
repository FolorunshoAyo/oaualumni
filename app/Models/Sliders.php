<?php

namespace App\Models;

use CodeIgniter\Model;

class Sliders extends Model
{



    protected $DBGroup = 'default';
    protected $table      = 'sliders';
    protected $primaryKey = 'sl_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'sl_title', 'sl_description','sl_button_text',
        'sl_button_url','sl_dp', 'admin_id', 'sl_date','sl_updated','sl_deleted',
        'sl_status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'sl_date';
    protected $updatedField  = 'sl_updated';
    protected $deletedField  = 'sl_deleted';

    protected $validationMessages = [

    ];
    protected $skipValidation     = false;

}//class here