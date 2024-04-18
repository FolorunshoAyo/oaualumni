<?php


namespace App\Models;


use CodeIgniter\Model;

class ModContact extends Model
{
    protected $DBGroup = 'default';
    protected $table      = 'contact';
    protected $primaryKey = 'con_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'con_name','con_subject',
        'con_email','con_phone', 'con_message', 'con_date','con_status',
        'con_updated','con_deleted', 'user_id'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'con_date';
    protected $updatedField  = 'con_updated';
    protected $deletedField  = 'con_deleted';

    protected $validationRules    = [

    ];
    protected $validationMessages = [

    ];
    protected $skipValidation     = false;




}//class here