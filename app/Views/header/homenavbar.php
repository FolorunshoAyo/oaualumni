

</head>

<body>

<!--	Page Loader
=============================================================
-->
<!--<div class="page-loader position-fixed z-index-9999 w-100 bg-white vh-100">
<div class="d-flex justify-content-center y-middle position-relative">
  <div class="spinner-border" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>
</div>-->



<div id="page-wrapper" class="bg-white">
    <!--============== Header Section Start ==============-->
    <header id="header" class="nav-on-banner transparent-header-modern fixed-header-bg-secondary">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="top-header py-3">
                        <div class="row">
                            <div class="col-md-7 col-xl-6 offset-md-2">
                                <div class="d-flex h-100 align-items-center justify-content-start mx-xl-ms-30">
                                    <div class="me-3"><a href="callto:<?php echo getwebsiteSetting('st_phone');?>" class="text-white">
                                            <i class="fas fa-phone-alt text-primary me-1"></i>
                                        <?php echo getwebsiteSetting('st_phone');?>
                                        </a></div>
                                    <div class="me-3"><a href="mailto:<?php echo getwebsiteSetting('st_email');?>" class="text-white">
                                            <i class="fas fa-envelope text-primary me-1"></i>
                                            <?php echo getwebsiteSetting('st_email');?>
                                        </a>
                                    </div>
                                   <!-- <div class="dropdown hover-dropdown">
                                        <button class="dropdown-toggle text-white" type="button" data-bs-toggle="dropdown">Help and Support</button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">How It Work</a></li>
                                            <li><a class="dropdown-item" href="#l">General Support</a></li>
                                            <li><a class="dropdown-item" href="#">Help Center</a></li>
                                            <li><a class="dropdown-item" href="#l">Support Article</a></li>
                                            <li><a class="dropdown-item" href="#">Terms & Condition</a></li>
                                        </ul>
                                    </div>-->
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="main-nav hover-bg-primary-nav hover-text-white-nav nav-logo-with-bg">
                        <div class="row">
                            <div class="col">
                                <nav class="navbar navbar-expand-lg navbar-light white-nav p-0">
                                    <a class="navbar-brand" href="<?php echo base_url(); ?>">
                                        <img class="nav-logo" src="<?php echo base_url('public/assets/images/'.getwebsiteSetting('st_logo'))?>" alt="" style="width: 80px;">
                                    </a>
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav me-auto">
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo base_url('about'); ?>">About</a>
                                            </li>
                                            <li class="nav-item"> 
                                                <a class="nav-link" href="<?php echo site_url('events')?>">Events</a>
                                            </li>
                                            <li class="nav-item"> <a class="nav-link" href="<?php echo site_url('news')?>">
                                                    News
                                                </a> 
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo site_url('galleries')?>">
                                                    Gallery
                                                </a>
                                            </li>
                                            <li class="nav-item dropdown"> 
                                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Pages
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo site_url('executives'); ?>">Executives</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo site_url('alumni'); ?>">Alumni Directory</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo site_url('interest-groups'); ?>">Interest Groups</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="<?php echo site_url('donations'); ?>">Donations</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-item"> <a class="nav-link" href="<?php echo site_url('contact')?>">Contact</a> </li>
                                        </ul>
                                        <a href="<?php echo site_url('login')?>" class="text-white hover-text-primary me-3"> Login </a>

                                          <span class="lrgspan">/</span>

                                        <a href="<?php echo site_url('register')?>" class="text-white hover-text-primary me-3"> Register </a>
                                        <!--<a class="btn btn-primary d-none d-xl-block" href="dashboard-submit-property.html">Submit Peoperty</a>-->
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--============== Header Section End ==============-->