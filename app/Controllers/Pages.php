<?php


namespace App\Controllers;

use App\Models\ModAlumni;
use App\Models\ModContact;
use App\Models\ModGallery;
use App\Models\ModHowITWorks;
use App\Models\ModGalleryImages;

class Pages extends BaseController
{
    protected $validator;
    protected $request;
    protected $session;
    
    function __construct()
    {
        $this->validator = \Config\Services::validation();
        $this->request = \Config\Services::request();
        $this->session = \Config\Services::session();
    }


    protected $helpers = ['url', 'custom_helper','form','text'];

    public function about()
    {
      $data['title'] = 'About' . PROJECT;
      $data['description'] = 'About page description';
       echo view('header/header',$data);
       echo view('css/allCSS');
       echo view('header/navbar');
       echo view('content/about');
       echo view('footer/footer');
       echo view('footer/endfooter');
    }



    public function faq()
    {
        $data['title'] = 'FAQ' . PROJECT;
        //$data['description'] = 'FAQ';
        echo view('header/header',$data);
        echo view('css/allCSS');
        echo view('css/phone');
        echo view('header/navbar');
        echo view('users/faq',$data);
        echo view('content/subscribed');
        echo view('footer/footer');
        echo view('js/phone');
        echo view('footer/endfooter');
    }

    public function executives()
    {
        $tableHowITWorks = new ModHowITWorks();
        $data['executives']= $tableHowITWorks->findAll();

        // Custom sorting for "Chairman" and "Vice Chairperson"
        usort($data['executives'], function($a, $b) {
            // Define the order for specific posts
            $priority = ['Chairman' => 1, 'Vice Chairperson' => 2];
            
            // Get the priority value or assign a default value (999) for other posts
            $postA = isset($priority[$a['hi_post']]) ? $priority[$a['hi_post']] : 999;
            $postB = isset($priority[$b['hi_post']]) ? $priority[$b['hi_post']] : 999;

            return $postA - $postB; // Sort by priority
        });
        
        // dd($data['executives']);

        $data['title'] = 'Executives' . PROJECT;
        //$data['description'] = 'FAQ';
        echo view('header/header',$data);
        echo view('css/allCSS');
        echo view('css/phone');
        echo view('header/navbar');
        echo view('users/executives',$data);
        echo view('content/subscribed');
        echo view('footer/footer');
        echo view('footer/endfooter');
    }

    public function terms()
    {
        $data['title'] = 'Terms' . PROJECT;
        //$data['description'] = 'FAQ';
        echo view('header/header',$data);
        echo view('css/allCSS');
        echo view('css/phone');
        echo view('header/navbar');
        echo view('users/terms',$data);
        echo view('content/subscribed');
        echo view('footer/footer');
        echo view('js/phone');
        echo view('footer/endfooter');
    }



    public function contact()
    {
        $data['title'] = 'Contact' . PROJECT;
        $data['description'] = 'Contact';
        echo view('header/header',$data);
        echo view('css/allCSS');
        echo view('css/phone');
        echo view('header/navbar');
        echo view('users/contact',$data);
        echo view('content/subscribed');
        echo view('footer/footer');
        echo view('js/phone');
        echo view('footer/endfooter');

    }

    public function alumni()
    {
        $search_query = $this->request->getGet('q');

        $tableAlumni =  new ModAlumni();

        if(isset($search_query) && !empty($search_query)){
            $tableAlumni->select('alumni.*')
            ->like('al_name',$search_query)
            ->or_like('batch_year', $search_query)
            ->or_like('major', $search_query)
            ->or_like('occupation', $search_query)
            ->or_like('company', $search_query)
            ->or_like('location', $search_query)
            ->or_like('bio', $search_query)
            ->orderBy('al_id','desc');
        }else{
            $tableAlumni->select('alumni.*')
            ->orderBy('al_id','desc');
        }
       
        $data = [
            'allAlumni' => $tableAlumni->paginate(20),
            'pager' => $tableAlumni->pager
        ];

        $totalAlumni = $tableAlumni->countAllResults();
        $data['totalAlumni'] = $totalAlumni;
        $data['title'] = 'All Alumni' . PROJECT;
        $data['description'] = 'Contact';
        echo view('header/header',$data);
        echo view('css/allCSS');
        echo view('header/navbar');
        echo view('users/alumni',$data);
        echo view('content/subscribed');
        echo view('footer/footer');
        echo view('footer/endfooter');

    }

    public function cashapp(){
        echo view('content/cashapp');
    }

    public function cashappPayment() {
        $request = $this->request;
    
        $json = $request->getBody();
        
        $data = json_decode($json, true);
        
        // Validate the required fields
        if (!isset($data['amount']) || !isset($data['sourceId']) || !isset($data['idempotencyKey'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Missing required fields',
            ])->setStatusCode(400); // Bad Request
        }
    
        // Define your parameters
        $url = 'https://connect.squareupsandbox.com/v2/payments';
        $method = 'POST';
        
        // Prepare the data for the payment request
        $paymentData = [
            'idempotency_key' => $data['idempotencyKey'], // Unique key
            'amount_money' => [
                'amount' => (int) $data['amount'], // Amount in cents
                'currency' => 'USD'
            ],
            'source_id' => $data['sourceId'] // Payment token
        ];
    
        $headers = [
            'Square-Version' => date("Y-m-d"),
            'Authorization' => 'Bearer ' . getenv("SQUAREUP_SANDBOX_ACCESS_TOKEN"), // Your access token
            'Content-Type' => 'application/json'
        ];
    
        $response = make_curl_request($url, $method, $paymentData, $headers);
    
        // Return a success response
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Payment processed successfully',
            'data' => json_decode($response)
        ])->setStatusCode(200); // OK
    }
    


    public function userQuery()
    {

        $validation = $this->validator;
        $request = $this->request;
        $session =  $this->session;
        customFlash('alert-warning','Please check your required fields and try again','contact');
        //dd();
        if (!$this->validate($validation->getRuleGroup('userQuery'))){
            customFlash('alert-warning','Please check your required fields and try again','contact');
            return redirect()->to(site_url('contact'));

        }
        else{
            $myUser = [
                'u_email'=>$request->getPost('email'),
            ];

            $ModCotnact = new ModContact();
            if (isUserLoggedIn()) {
                $newContact = [
                    'user_id'=>session('u_id'),
                    'con_message'=>$request->getPost('message'),
                ];
            }

            $newContact = [
                'con_name'=>$request->getPost('name'),
                'con_email'=>$request->getPost('email'),
                'con_phone'=>$request->getPost('relPhone'),
                'con_message'=>$request->getPost('message'),
                'con_subject'=>$request->getPost('subject'),
            ];
            $ifQueryInserted = $ModCotnact->insert($newContact);

            if ($ifQueryInserted){
                /*if (getUserAgent()) {
                    $message =  view('emails/contactForm',$newContact);
                    $email = \Config\Services::email();
                    $email->setFrom(EMAIL, '5Stark');
                    $email->setTo('shakzee171@gmail.com');
                    $email->setSubject('New Message | 5stark.com');
                    $email->setMessage($message);//your message here
                    $email->send();

                }*/
                customFlash('alert-success','Thanks for being in touch with us. Over the next 24 hours, our representative will email you.','contact');
                return redirect()->to(site_url('contact'));
            }
            else{
                customFlash('alert-warning','Something went wrong, please try again.','contact');
                return redirect()->to(site_url('contact'));

            }

        }
    }
    /*FrontGallery starts here*/
    public function gallery()
    {
        $tableModGallery= new ModGallery();
        $tableModGallery->select('gallery.*')
            ->where([
                'gallery.gl_status'=>1
            ])
            ->orderBy('gallery.gl_id','desc');
        $data = [
            'galleries' => $tableModGallery->paginate(5),
            'pager' => $tableModGallery->pager
        ];

        $data['title'] =  'Gallery ' . PROJECT;
        $data['description'] = 'Gallery Description here';
        echo view('header/header',$data);
        echo view('css/allCSS');
        echo view('header/navbar');
        echo view('content/gallery',$data);
        echo view('footer/footer');
        echo view('footer/endfooter');

    }

    public function galleryImages($gallery_id)
    {
        if (!empty($gallery_id) && isset($gallery_id)) {
            $tableGalImages = new ModGalleryImages();
            $checkGallery = $tableGalImages->select()
                ->where([
                    'gallery_images.gi_status'=>1,
                    'gallery_images.gallery_id'=>$gallery_id,
                ])
                ->join('gallery','gallery.gl_id = gallery_images.gallery_id')
                ->orderBy('gallery_images.gi_id','desc')
                ->findAll();
            if (count($checkGallery) > 0) {
                $data['galleries'] = $checkGallery;
                $data['title'] = 'Gallery ' . PROJECT;
                $data['description'] = 'Gallery Description here';

                echo view('header/header',$data);
                echo view('css/allCSS');
                echo view('css/lightGalleryCss');//extra css
                echo view('header/navbar');
                echo view('content/photoGalleries',$data);
                echo view('content/subscribed');
                echo view('footer/footer');
                echo view('js/lightGalleryJs');
                echo view('footer/endfooter');

            }
            else{
                customFlash('alert-info','Photos not available in the gallery');
                return redirect()->to(site_url('photo-galleries'));
            }
        }
        else{
            customFlash('alert-info','Something went wrong, please check your required things and try again.');
            return redirect()->to(site_url('photo-galleries'));
        }
    }
    /*FrontGallery ends here*/

}//class hre