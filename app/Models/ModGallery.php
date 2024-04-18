<?php

namespace App\Models;
use CodeIgniter\Model;
class ModGallery extends Model
{
    protected $DBGroup = 'default';
    protected $table      = 'gallery';
    protected $primaryKey = 'gl_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'gl_name', 'gl_date','gl_status',
        'admin_id',
        'gl_update','gl_deleted'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'gl_date';
    protected $updatedField  = 'gl_update';
    protected $deletedField  = 'gl_deleted';

    protected $validationMessages = [

    ];
    protected $skipValidation     = false;
    public function checkAlbums($data,$galleryId = null)
    {
        if (!empty($galleryId) && isset($galleryId)) {
            $where = array(
                'gl_name'=>$data['gl_name'],
                'gl_id !='=>$galleryId
            );
            return $this->where($where)->findAll();
        }
        else{
            $where = array(
                'gl_name'=>$data['gl_name']
            );
            return $this->where($where)->findAll();
        }
    }


    public function fatchAllAlbums()
    {
        return $this->select('gallery.*')
            //->where('gl_deleted IS NULL')
            ->orderBy('gl_id','desc');
    }

    public function getAllAlbums()
    {
        // return $this->db->get_where('product');
        return $this->select('gallery.*')
            //->from('gallery')
            ->findAll();
    }

}//class here

