<?php

namespace App\Models;

use CodeIgniter\Model;

class ModDonations extends Model
{
    protected $DBGroup = 'default';
    protected $table      = 'donations';
    protected $primaryKey = 'donation_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'user_id', 'project_id', 'amount', 'first_name', 'last_name', 'email', 'phone',
        'trx_id', 'donation_date'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationMessages = [];
    protected $skipValidation = false;

}//class here