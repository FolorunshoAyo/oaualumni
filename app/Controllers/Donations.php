<?php
namespace App\Controllers;

use App\Models\ModUsers;
use App\Models\ModProjects;
use App\Models\ModDonations;
use App\Libraries\PayPalLib;

class Donations extends BaseController
{
    protected $validator;
    protected $request;
    protected $session;
    protected $paypal_lib;

    function __construct()
    {
        $this->validator = \Config\Services::validation();
        $this->request = \Config\Services::request();
        $this->session = \Config\Services::session(); 
        $this->paypal_lib = new PayPalLib();
    }

    protected $helpers = ['url', 'custom_helper','form','text'];
    
    public function index(){
        $data = [];

        $filter = $this->request->getGet('filter');

        $data['title'] = 'Donations' . PROJECT;
        $data['description'] = 'Donation Description here';

        $tableProjects = new ModProjects();

        if($filter == "newest"){
            $tableProjects->select('projects.*, admin.aName')
            ->join('admin', 'projects.admin_id = admin.aId')
            ->orderBy('project_id', 'desc');
        }elseif($filter == "oldest"){
            $tableProjects->select('projects.*, admin.aName')
            ->join('admin', 'projects.admin_id = admin.aId')
            ->orderBy('project_id', 'asc');
        }elseif($filter == "popular"){
            $tableProjects->select('projects.*, admin.aName, COUNT(don.donation_id) AS num_contributors')
            ->join('donations don', 'projects.project_id = don.project_id', 'left')
            ->join('admin', 'projects.admin_id = admin.aId', 'left')
            ->orderBy('num_members', 'desc');
        }else{
            $tableProjects->select('projects.*, admin.aName')
            ->join('admin', 'projects.admin_id = admin.aId');
        }

        $projects = $tableProjects->paginate(5);
        $totalProjects = $tableProjects->countAllResults();
        $donationsModel = new ModDonations();

        foreach ($projects as &$project) {
            $contributorsCount = $donationsModel->where(['project_id' => $project['project_id']])->countAllResults();
            $project['contributors_count'] = $contributorsCount;
        }

        $data['filter'] = $filter;
        $data['projects'] = $projects;
        $data['totalProjects'] = $totalProjects;
        $data['pager'] = $tableProjects->pager;

        echo view('header/header',$data);
        echo view('css/allCSS');
        echo view('header/navbar');
        echo view('users/donations',$data);
        echo view('content/subscribed');
        echo view('footer/footer');
        echo view('footer/endfooter');
    }

    public function read($id)
    {
        if (!empty($id) && isset($id)) {
            $tableProjects  = new ModProjects();
            $donationsModel  = new ModDonations();
            $data['userLoggedIn'] = userLoggedIn();
            
            $checkProject = $tableProjects->select()
                ->where([
                    'project_id'=>$id,
                ])
                ->findAll();

            $checkOtherProject = $tableProjects->select()
            ->where('project_id !=', $id)
            ->orderBy('RAND()')
            ->limit(5)
            ->findAll();

            $donations = $donationsModel->select("donations.*, users.u_dp, users.u_first_name, users.u_last_name, users.u_email, users.u_mobile")
                ->join('users', 'donations.user_id = users.u_id', 'left')
                ->where([
                    'project_id'=>$id,
                ])
                ->findAll();

            foreach ($checkOtherProject as &$project) {
                $contributorsCountCount = $donationsModel->where(['project_id' => $project['project_id']])->countAllResults();
                $project['contributors'] = $contributorsCountCount;
            }

            if (count($checkProject) == 1) {
                $data['checkProject'] = $checkProject;
                $data['title'] =  $checkProject[0]['project_name'] . '  ' . PROJECT;
                $data['description'] = $checkProject[0]['project_name'] . '  ' . PROJECT;
                $data['contributors'] = array();
                $data['otherProjects'] = $checkOtherProject;

                if($data['userLoggedIn']){
                    $tableUser =  new ModUsers();
                    $data['userData'] = $tableUser->where('u_id',getUserId())->findAll();
                }

                foreach ($donations as $donation) {
                    $item = array(
                        'donation_id' => $donation['donation_id'],
                        'u_dp' => $donation['u_dp'],
                        'first_name' => $donation['user_id']? $donation['u_first_name'] : $donation['first_name'],
                        'last_name' => $donation['user_id']? $donation['u_last_name'] : $donation['last_name'],
                        'email' => $donation['user_id']? $donation['u_email'] : $donation['email'],
                        'phone' => $donation['user_id']? $donation['u_mobile'] : $donation['phone'],
                        'amount' => $donation['amount']
                    );
                    $data['contributors'][] = $item;
                }

                // dd($data['contributors']);

                echo view('header/header',$data);
                echo view('css/allCSS');
                echo view('header/navbar');
                echo view('users/readdonation',$data);
                echo view('content/subscribed');
                echo view('footer/footer');
                echo view('js/donation');
                echo view('footer/endfooter');
            }
            else{
                customFlash('alert-info','Donation does not exist.');
                return redirect()->to(site_url('donations'));
            }

        }
        else{
            customFlash('alert-info','Something went wrong, please check your required things and try again.');
            return redirect()->to(site_url('donations'));
        }

    }

    public function donate($id){
        if (!empty($id) && isset($id)) {
            $tableProjects  = new ModProjects();

            $checkProject = $tableProjects->select()
                ->where([
                    'project_id'=>$id,
                ])
                ->findAll();

            if (count($checkProject) == 1) {
                // Set variables for paypal form
                $returnURL = site_url().'donation/success'; //payment success url
                $cancelURL = site_url().'donation/cancel'; //payment cancel url
                $notifyURL = site_url().'donation/ipn'; //ipn url
                
                // Get current user ID from the session
                $userID = getUserId();
                
                $isGuest = $userID === false? true : false; // Check if user is guest or not
                $donation_amount = $this->request->getPost("amount");

                if(($checkProject[0]['current_amount'] + $donation_amount) > $checkProject[0]['target_amount']){
                    customFlash('alert-info','Donation amount is more than target amount.');
                    return redirect()->to(site_url('donation/read/' . $id));
                }

                if($isGuest){
                    $guestData = [
                        "first_name" => $this->request->getPost("first_name"),
                        "last_name" => $this->request->getPost("last_name"),
                        "email" => $this->request->getPost("email"),
                        "phone" => $this->request->getPost("phone")
                    ];
                }

                // Add fields to paypal form
                $this->paypal_lib->add_field('return', $returnURL);
                $this->paypal_lib->add_field('cancel_return', $cancelURL);
                $this->paypal_lib->add_field('notify_url', $notifyURL);
                $this->paypal_lib->add_field('item_name', $checkProject[0]['project_name']);
                $this->paypal_lib->add_field('custom', $isGuest? json_encode($guestData) : $userID);
                $this->paypal_lib->add_field('item_number',  $checkProject[0]['project_id']);
                $this->paypal_lib->add_field('amount',  $donation_amount);
                
                // Render paypal form
                $this->paypal_lib->paypal_auto_form();
            }else{
                customFlash('alert-info','Donation does not exist.');
                return redirect()->to(site_url('donations'));
            }
        }else{
            customFlash('alert-info','Something went wrong, please check your required things and try again.');
            return redirect()->to(site_url('donations'));
        }
	}

    public function success(){
		// dd($this->request->getPost());

		// Get the transaction data
		$data['item_name']= $this->request->getPost("item_name");
		$data['item_number']= $this->request->getPost("item_number");
		$data['txn_id'] = $this->request->getPost("txn_id");
		$data['payment_amt'] = $this->request->getPost("payment_gross");
		$data['currency_code'] = $this->request->getPost("mc_currency");
		$data['status'] = $this->request->getPost("payment_status");
        $data['custom_data'] = isJson($this->request->getPost("custom"))? json_decode($this->request->getPost("custom")) : $this->request->getPost("custom"); // user id or guest data
        $data['email'] = isJson($this->request->getPost("custom"))? $data['custom_data']->email : getUserData($data['custom_data'])[0]['u_email']; 

        // dd(isJson($this->request->getPost("custom")));

        if(isJson($this->request->getPost("custom"))){
            $contributor = [
                'first_name' => $data['custom_data']->first_name,
                'last_name' => $data['custom_data']->last_name,
                'email' => $data['custom_data']->email,
                'phone' => $data['custom_data']->phone,
                'project_id' => $data['item_number'],
                'amount' => $data['payment_amt'],
                'trx_id' => $data['txn_id'],
                'donation_date' => date('Y-m-d')
            ];
        }else{
            // Restore user session
            $user = getUserData($data['custom_data']);

            $userdata['u_id'] = $user[0]['u_id'];
            $userdata['user_name'] = $user[0]['user_name'];
            $userdata['u_first_name'] = $user[0]['u_first_name'];
            $userdata['u_last_name'] = $user[0]['u_last_name'];
            $userdata['user_name'] = $user[0]['user_name'];
            $userdata['u_mobile'] = $user[0]['u_mobile'];

            $userdata['u_date'] = $user[0]['u_date'];
            $userdata['u_email'] = $user[0]['u_email'];
            $userdata['u_dp'] = $user[0]['u_dp'];

            $this->session->set($userdata);

            $contributor = [
                'user_id' => $data['custom_data'],
                'project_id' => $data['item_number'],
                'amount' => $data['payment_amt'],
                'trx_id' => $data['txn_id'],
                'donation_date' => date('Y-m-d')
            ];
        }

        $tableProjects =  new ModProjects();
        $tableDonations = new ModDonations();

        // CHECK IF CONTRIBUTION HAS ALREADY BEEN RECORDED
        $isContributed = $tableDonations->where(['trx_id'=>$data['txn_id']])->findAll();
        if(count($isContributed) === 1){
            // Pass the transaction data to view
            customFlash('alert-success','Your contribution was successfully recorded.');
            return redirect()->to(site_url('donations'));
        };

        $isProject = $tableProjects->where(['project_id'=>$data['item_number']])->findAll();
        if (count($isProject) === 1) {
            $updatedAmount = $isProject[0]['current_amount'] += $data['payment_amt'];

            $editProject = [
                'current_amount' => $updatedAmount,
            ];

            $isProjectUpdated = $tableProjects->update($data['item_number'],$editProject);

            if($isProjectUpdated){
                if($updatedAmount >= $isProject[0]['target_amount']){
                    // Update project to completed.
                    $tableProjects->update($data['item_number'],['status'=>'2']);
                }
                // Add contributor
                $tableDonations->insert($contributor);

                // Pass the transaction data to view
                echo view('header/header',$data);
                echo view('css/allCSS');
                echo view('header/navbar');
                echo view('users/donationthanks',$data);
                echo view('content/subscribed');
                echo view('footer/footer');
                echo view('footer/endfooter');

            }else{
                customFlash('alert-success','Oops..! something went wrong; please try again.');
                return redirect()->to(site_url('donation/read/' . $data['item_number']));
            } 
        }else{
            customFlash('alert-info','Donation does not exist.');
            return redirect()->to(site_url('donations'));
        }
	}
	 
	public function cancel(){
        $data['title'] =  'Cancelled Donation' . PROJECT;
        $data['description'] = 'Cancelled Donation Description Here ' . PROJECT;

		// Load payment failed view
        echo view('header/header',$data);
        echo view('css/allCSS');
        echo view('header/navbar');
        echo view('users/donationcancel',$data);
        echo view('content/subscribed');
        echo view('footer/footer');
        echo view('footer/endfooter');
	}
	 
	public function ipn(){
		// Paypal posts the transaction data
		$paypalInfo = $this->request->getPost();
		
		if(!empty($paypalInfo)){
			// Validate and get the ipn response
			$ipnCheck = $this->paypal_lib->validate_ipn($paypalInfo);

			// Check whether the transaction is valid
			if($ipnCheck){
				// Insert the transaction data in the database
				$paymentData['custom_data']	= $paypalInfo["custom"]; // Could be guest data or user-id
				$paymentData['product_id']	= $paypalInfo["item_number"];
				$paymentData['txn_id']	= $paypalInfo["txn_id"];
				$paymentData['payment_gross']	= $paypalInfo["mc_gross"];
				$paymentData['currency_code']	= $paypalInfo["mc_currency"];
				$paymentData['payer_email']	= $paypalInfo["payer_email"];
				$paymentData['payment_status'] = $paypalInfo["payment_status"];

                // dd($paymentData);

                $tableProjects =  new ModProjects();
                $isProject = $tableProjects->where(['project_id'=>$paymentData['product_id']])->findAll();
                $updatedAmount = $isProject[0]['current_amount'] += $paymentData['payment_gross'];

                if (count($isProject) === 1) {
                    $editProject = [
                        'current_amount' => $updatedAmount,
                    ];

                    $isProjectUpdated = $tableProjects->update($paymentData['product_id'],$editProject);

                    if($isProjectUpdated){
                        if($updatedAmount >= $isProject[0]['target_amount']){
                            // Update project to completed.
                            $tableProjects->update($paymentData['product_id'],['status'=>'2']);
                        }

                        $paymentData['item_name'] = $isProject[0]['project_name'];

                        $this->session->set('paymentData', $paymentData);
                        return redirect()->to(site_url('donation/success'));
                    }else{
                        customFlash('alert-success','Oops..! something went wrong; please try again.');
                        return redirect()->to(site_url('donation/read/' . $paymentData['product_id']));
                    } 
                }else{
                    customFlash('alert-info','Donation does not exist.');
                    return redirect()->to(site_url('donations'));
                }
			}
		}
    }
}//class here