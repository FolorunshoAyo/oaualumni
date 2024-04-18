<?php


namespace App\Models;


use CodeIgniter\Model;

class ModUsers extends Model
{
    protected $DBGroup = 'default';
    protected $table      = 'users';
    protected $primaryKey = 'u_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'user_name','u_email',
        'password','u_mobile', 'u_dp',
        'u_news_letter','u_agree', 'u_first_name','u_last_name',
        'u_link','u_date','u_status','uRememberMe',
        'u_view','u_occupation','u_update',
        'u_phone','u_delete','country_id','u_spouse','u_emergency_phone',
        'u_address','u_hobbies'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'u_date';
    protected $updatedField  = 'u_update';
    protected $deletedField  = 'u_delete';

    protected $validationRules    = [

    ];
    protected $validationMessages = [

    ];
    protected $skipValidation     = false;

    /*club script starts here*/

    /*club script ends here*/

    public function checkEmailForLink($email)
    {
      /* $data = ['u_link'=>random_string('alnum',20)];
        $this->where('u_email',$email)->update($data);
        $this->where([])->findAll();*/
        $this->set('u_link',random_string('alnum',20))
            ->where('u_email','shakzee171@gmail.com')
            ->update();
        return $this->where('u_email',$email)->findAll();
        //$returnType = $this->update($userId,$data);
        /*$this->db->where('u_email',$email);
        $this->db->update('users',);
        return $this->db->get_where('users',array('u_email'=>$email))->result_array();*/
    }

    public function updateUser($userId,$data)
    {
        return $this->update($userId,$data);
    }
    public function checkPmPassword($PMPassword,$userID)
    {
        return $this->where([
            'u_perfect_password'=>$PMPassword,
            'u_id'=>$userID
            ]

        )->findAll();
    }

    public function checkUserByRefId($userID)
    {
        return $this->where(array('u_ref_id'=>$userID,'u_status'=>1))->findAll();
    }
    public function getAllUsers($status)
    {
        return $this->where(['u_status'=>$status])->findAll();
        //return $this->get_where('users',array('u_status'=>$status))
            //->num_rows();
    }

    /*public function getUserPlans($filters=null)
    {

        $filters['users.u_status'] = 1;
        return $this->select(
            '
							users.u_id,
							users.user_name,user_plans.admin_id,users.u_ref_id,
							user_plans.up_status,user_plans.up_date,user_plans.up_id
							'
        )
            ->where($filters)
            //->like('users.u_ref_id',$search)
            ->join('user_plans','user_plans.user_id = users.u_id')
            //->join('plans','plans.pl_id = user_plans.plan_id')

            //->join('admin','admin.aId=user_plans.admin_id')
            ->orderBy('users.u_id','desc');
    }*/
    public function getAlLUserByPlans()
    {
        $mywhere['users.u_status'] = 1;
        //$mywhere['user_plans.up_status'] = 1;
        //$mywhere['users.u_id'] = 1676;//testing
        return $this->select(
            'users.u_id,users.u_ref_id,user_plans.up_id,users.user_name'
        )
            //->from('users')
            ->where($mywhere)
            //->limit(100)
            ->join('user_plans','user_plans.user_id=users.u_id')
            //->join('user_plans','user_plans.user_id=users.u_id')
            ->findAll();
    }


    public function getAlLUserByPlansByID($userId)
    {
        $mywhere['users.u_status'] = 1;
        $mywhere['user_plans.up_status'] = 1;
        $mywhere['users.u_id'] = $userId;
        //$mywhere['users.u_id'] = 538;//testing
        return $this->select(
            'users.u_id,users.u_ref_id,user_plans.up_id,users.user_name'
        )
            //->from('users')
            ->where($mywhere)
            ->join('user_plans','user_plans.user_id=users.u_id')
            //->join('user_plans','user_plans.user_id=users.u_id')
            ->findAll();
    }
    public function getAlLUserByPlansByIDMp($userId)
    {
        $mywhere['users.u_status'] = 1;
        //$mywhere['user_plans.up_status'] = 1;
        $mywhere['users.u_id'] = $userId;
        //$mywhere['users.u_id'] = 538;//testing
        return $this->select(
            'users.u_id,users.u_ref_id,user_plans.up_id,users.user_name'
        )
            //->from('users')
            ->where($mywhere)
            ->join('user_plans','user_plans.user_id=users.u_id')
            //->join('user_plans','user_plans.user_id=users.u_id')
            ->findAll();
    }

    public function getUserData($userId)
    {
        return $this->where(['u_id'=>$userId])->findAll();
        //return $this->get_where('users',array('u_id'=>$userId))->result_array();
    }

    public function checkLink($value)
    {
        return $this->where('u_link',$value)->findAll();
       // return $this->db->get_where('users',array('u_link'=>$value));
    }

    public function getUserInfo($userId)
    {
        return
            $this
                ->where('u_id',$userId)
                ->findAll();
    }



}//class here