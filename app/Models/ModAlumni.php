<?php


namespace App\Models;
use CodeIgniter\Model;


class ModAlumni extends Model
{
    protected $DBGroup = 'default';
    protected $table      = 'alumni';
    protected $primaryKey = 'al_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'al_full_name', 'al_batch_year','al_major',
        'al_occupation','al_company', 'al_location', 'al_bio','al_profile_image','al_featured', 
        'admin_id', 'al_created_at', 'al_updated_at', 'al_deleted_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'al_created_at';
    protected $updatedField  = 'al_updated_at';
    protected $deletedField  = 'al_deleted_at';

    protected $validationMessages = [

    ];
    protected $skipValidation     = false;
}