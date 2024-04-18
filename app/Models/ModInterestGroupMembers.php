<?php

namespace App\Models;

use CodeIgniter\Model;

class ModInterestGroupMembers extends Model
{
    protected $DBGroup = 'default';
    protected $table      = 'interest_group_members';
    protected $primaryKey = 'member_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'user_id', 'group_id'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'joined_at';
    // protected $updatedField  = '';
    protected $deletedField  = 'deleted_at';

    protected $validationMessages = [];
    protected $skipValidation = false;

}//class here