<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class PayPal extends BaseConfig
{
    public $sandbox = true; // Set to false for live environment
    public $business = 'sb-ffffb30675153@business.example.com';
    public $ipnLogFile = 'ipn_log.txt';
    public $ipnLog = true;
    public $buttonPath = 'assets/images';
    public $currencyCode = 'USD';
}
