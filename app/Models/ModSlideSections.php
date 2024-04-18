<?php


namespace App\Models;
use CodeIgniter\Model;

class ModSlideSections extends Model
{
    protected $DBGroup = 'default';
    protected $table      = 'slide_section';
    protected $primaryKey = 'ss_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'ss_title', 'ss_body','ss_button_text',
        'ss_button_url','ss_status', 'ss_date', 'admin_id','language_id','ss_update',
        'ss_deleted'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'ss_date';
    protected $updatedField  = 'ss_update';
    protected $deletedField  = 'ss_deleted';

    protected $validationMessages = [

    ];
    protected $skipValidation     = false;
}