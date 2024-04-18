<?php


namespace App\Models;
use CodeIgniter\Model;


class ModHomeSection extends Model
{
    protected $DBGroup = 'default';
    protected $table      = 'home_section';
    protected $primaryKey = 'hs_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'hs_title', 'hs_body','hs_button_text',
        'hs_button_url','hs_status', 'hs_date', 'admin_id','hs_dp','hs_update',
        'hs_deleted'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'hs_date';
    protected $updatedField  = 'hs_update';
    protected $deletedField  = 'hs_deleted';

    protected $validationMessages = [

    ];
    protected $skipValidation     = false;
}