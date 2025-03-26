<?php namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
    /*club script starts here*/
    public $login = [
        'email'=> 'trim|required',
        'password'=> 'trim|required',
    ];
    public $register = [
        'first_name'=> 'trim|required|alpha_space',
        'last_name'=> 'trim|required|alpha_space',
        'conf_password'=> 'trim|required|matches[password]',
        'occupation'=> 'trim|required',
        'dob' => 'required|valid_date[Y-m-d]',
        'address'=> 'trim|required',
        'hobbies'=> 'trim|required',
        'email'=> 'trim|required|valid_email',
        'password'=> 'trim|required',
        'realPhone'=> 'trim|required',
        'emergencyPhone'=> 'trim|required',
        'spouse'=> 'trim|required',
        'country'=> 'trim|required',

        /*'accept'=> 'trim|required',*/
        /*'agreeTermCon'=> 'required'*/
    ];
    public $userQuery = [
        'name'=> 'trim|required',
        'email'=> 'trim|required|valid_email',
        'relPhone'=> 'trim|required',
        'subject'=> 'trim|required',
         'message'=> 'trim|required',
        /*'agreeTermCon'=> 'required'*/
    ];
    public $profile = [
        'first_name'=> 'trim|required|alpha_space',
        'last_name'=> 'trim|required|alpha_space',
        'occupation'=> 'trim|required',
        'dob' => 'required|valid_date[Y-m-d]',
        'address'=> 'trim|required',
        'hobbies'=> 'trim|required',
        'email'=> 'trim|required|valid_email',
        'realPhone'=> 'trim|required',
        'emergencyPhone'=> 'trim|required',
        'spouse'=> 'trim|required',
        'country'=> 'trim|required',

        /*'agreeTermCon'=> 'required'*/
    ];
    public $userUpdateAdmin = [
        'first_name'=> 'trim|required|alpha_space',
        'last_name'=> 'trim|required|alpha_space',
        'occupation'=> 'trim|required',
        'address'=> 'trim|required',
        'hobbies'=> 'trim|required'
    ];
    public $news = [
        'title'=> 'required',
        'short_desc'=> 'required',
        'description'=> 'required',
        'category'=> 'required'
    ];

    public $events = [
        'title'=> 'required',
        'description'=> 'required',
        'short_desc'=> 'required',
        'location'=> 'required',
        'category'=> 'required'
    ];

    /*club script ends here*/
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];


    public $register_errors = [
        'User Name' => [
            'required'    => 'User name is required.',
        ],
        'email'    => [
            'required' => 'Email is required'
        ],
        'password'    => [
            'required' => 'Password is required'
        ],
        'Confirm Password'    => [
            'required' => 'Your password and confirm password must be the same.'
        ],
        'Phone'    => [
            'required' => 'Phone number is required.'
        ],
        'accept'    => [
            'required' => 'You have to accept our terms and condition.'
        ]
    ];


    public $addNewAlbum = [
        'album'=> 'required',
    ];
    public $country = [
        'country_name'=> 'required',
        'country_slug'=> 'required',
        'status'=> 'required'
    ];

    public $websiteSettings = [
        'email'=> 'trim|required|valid_email',
        'phone'=> 'required',
        'address'=> 'required',
        'footer_content'=> 'required',
        'footer_content'=> 'required',
        'footer_content'=> 'required',
        'footer_content'=> 'required',
        'footer_content'=> 'required',
        'footer_content'=> 'required',
    ];
    public $galleryImages = [
        'album'=> 'required|integer'
    ];

    public $adminLogin = [
        'username'=> 'trim|required',
        'password'=> 'trim|required',
    ];


    public $newAdmin = [
        'name'=> 'trim|required',
        'email'=> 'trim|required|valid_email',
        'password'=> 'trim|required',
        'status'=> 'trim|required|integer'

    ];
    public $homeSection = [
        'title'=> 'required',
        'text'=> 'required'
    ];
    public $howItWorks = [
        'name'=> 'required',
        'post'=> 'required'
    ];
    public $alumni = [
        'name'=> 'required',
        'year'=> 'required',
        'major'=> 'required',
        'occupation'=> 'required',
        'company'=> 'required',
        'location'=> 'required',
        'bio'=> 'required',
    ];
    public $interestGroups = [
        'name'=> 'required',
        'desc'=> 'required',
        'short_desc'=> 'required',
        'location'=> 'required',
    ];
    public $donations = [
        'name'=> 'required',
        'desc'=> 'required',
        'short_desc'=> 'required',
        'target_amount'=> 'required',
        'location'=> 'required',
    ];
    public $zoomMeeting = [
        'name'=> 'required',
        'duration'=> 'required',
        'short_desc'=> 'required',
        'timezone'=> 'required',
        'password'=> 'required',
        'stdate'=> 'required',
        'auto_recording' => 'required'
    ];
    public $sliders= [
        'title'=> 'required',
        'text'=> 'required'
    ];
    public $addNewCalendar = [
        'title'=> 'required',
        'stdate'=> 'required',
        'endate'=> 'required',
        'eventId'=> 'required',
    ];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
}
