<?php

namespace App\Models;

use CodeIgniter\Model;

class ModHowITWorks extends Model
{
    protected $DBGroup = 'default';
    protected $table      = 'how_it_works';
    protected $primaryKey = 'hi_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'hi_name', 'hi_post','hi_facebook',
        'hi_twitter', 'hi_linkedin', 'hi_dp', 'admin_id', 'hi_updated','hi_deleted','hi_status', 'hi_set_featured',
        'hi_date'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'hi_date';
    protected $updatedField  = 'hi_updated';
    protected $deletedField  = 'hi_deleted';

    protected $validationMessages = [];
    protected $skipValidation = false;



}//class here