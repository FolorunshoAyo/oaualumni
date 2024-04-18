<?php
namespace App\Models;
use CodeIgniter\Model;

class ModSubscribers extends Model
{

    protected $DBGroup = 'default';
    protected $table      = 'subscribe';
    protected $primaryKey = 'sb_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'sb_email','user_id','sb_date','sb_updated','sb_deleted',
        'sb_status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'sb_date';
    protected $updatedField  = 'sb_updated';
    protected $deletedField  = 'sb_deleted';

    /* protected $validationRules    = [
         'c_name'     => 'required',
         'c_slug'        => 'required',
         'admin_id'        => 'required',
     ];*/
    protected $validationMessages = [

    ];
    protected $skipValidation     = false;

}