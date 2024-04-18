<?php
namespace App\Models;
use CodeIgniter\Model;

class ModGalleryImages extends Model
{
    protected $DBGroup = 'default';
    protected $table      = 'gallery_images';
    protected $primaryKey = 'gi_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'gallery_id', 'gi_name','gi_date',
        'gi_status','admin_id', 'language_id',
        'gi_update','gi_deleted'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'gi_date';
    protected $updatedField  = 'gi_update';
    protected $deletedField  = 'gi_deleted';

    protected $validationMessages = [

    ];
    protected $skipValidation     = false;
    public function addGalleryImages($GalleryImages)
    {
        return $this->insertBatch($GalleryImages);
    }
    public function fatchGalleryImages()
    {
        return $this->select('gallery.gl_id,gallery.gl_name,gallery_images.*')
            //->from('gallery_images')
            ->join('gallery','gallery.gl_id  = gallery_images.gallery_id')
            ->where('gallery.gl_deleted IS NULL')
            ->orderBy('gallery_images.gi_id','desc');

    }
}//class here