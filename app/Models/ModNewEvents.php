<?php
namespace App\Models;
use CodeIgniter\Model;

class ModNewEvents  extends Model
{
    protected $DBGroup = 'default';
    protected $table      = 'newsevents';
    protected $primaryKey = 'ne_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'ne_title', 'ne_short_description', 'ne_description','ne_date',
        'ne_status','ne_category', 'admin_id','ne_dp', 'ne_location',
        'ne_update','ne_deleted'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'ne_date';
    protected $updatedField  = 'ne_update';
    protected $deletedField  = 'ne_deleted';

    protected $validationMessages = [

    ];
    protected $skipValidation     = false;
}