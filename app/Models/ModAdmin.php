<?php


namespace App\Models;


use CodeIgniter\Model;

class ModAdmin extends Model
{
    protected $DBGroup = 'default';
    protected $table      = 'admin';
    protected $primaryKey = 'aId';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'aName', 'aDate','email',
        'password','uLink', 'aStatus', 'aDp',
        'aSuperAdmin','aUpdateDate', 'a_delete'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'aDate';
    protected $updatedField  = 'aUpdateDate';
    protected $deletedField  = 'a_delete';

    protected $validationRules    = [

    ];
    protected $validationMessages = [

    ];
    protected $skipValidation     = false;

    public function checkAdmin($data)
    {
        return $this->where(['email'=>$data['email'],'password'=>$data['password']])->findAll();
        //return  $this->get_where('admin',array())->result_array();

    }
    public function fatchAdmins()
    {
        return $this->select('aId,aName,aDate,email,uLink,aStatus,aDp,aSuperAdmin,aUpdateDate')
            //->from('admin')
            ->orderBy('aId','desc')
            ;
    }
}//class here
