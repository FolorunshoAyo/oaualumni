<?php

namespace App\Models;

use CodeIgniter\Model;

class ModProjects extends Model
{
    protected $DBGroup = 'default';
    protected $table      = 'projects';
    protected $primaryKey = 'project_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'project_name', 'description', 'short_description', 'project_image', 'project_location',
        'target_amount', 'current_amount', 'admin_id', 'status'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationMessages = [];
    protected $skipValidation = false;

}//class here
