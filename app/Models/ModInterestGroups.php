<?php

namespace App\Models;

use CodeIgniter\Model;

class ModInterestGroups extends Model
{
    protected $DBGroup = 'default';
    protected $table      = 'interest_groups';
    protected $primaryKey = 'group_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'group_name', 'description', 'short_description', 'group_image', 'group_location',
        'admin_id'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationMessages = [];
    protected $skipValidation = false;



}//class here