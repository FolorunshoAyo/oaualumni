<?php namespace App\Models;
use CodeIgniter\Model;

class ModCountries extends Model
{
    protected $DBGroup = 'default';
    protected $table      = 'countries';
    protected $primaryKey = 'co_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'co_name','co_slug','co_date','co_updated','co_deleted',
        'co_status','admin_id'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'co_date';
    protected $updatedField  = 'co_updated';
    protected $deletedField  = 'co_deleted';

    protected $validationRules    = [
        'co_name'     => 'required',
        'co_slug'        => 'required',
        'admin_id'        => 'required',
    ];
    protected $validationMessages = [

    ];
    protected $skipValidation     = false;
}