

</head>

<body>

<!--	Page Loader
=============================================================
<div class="page-loader position-fixed z-index-9999 w-100 bg-white vh-100">
<div class="d-flex justify-content-center y-middle position-relative">
  <div class="spinner-border" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>
</div>
-->


<div id="page-wrapper" class="bg-white">
    <!--============== Header One Section Start ==============-->
    <header id="header" class="fixed-header-bg-white">
        <div class="top-header bg-secondary py-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="d-flex h-100 align-items-center justify-content-start">
                            <div class="me-3"><a href="callto:012345678102" class="text-white"><i class="fas fa-phone-alt text-primary me-1"></i>(012) 345 678 102</a></div>
                            <div class="me-3"><a href="mailto:office@example.com" class="text-white"><i class="fas fa-envelope text-primary me-1"></i>office@example.com</a></div>
                            <div class="dropdown hover-dropdown">
                                <button class="dropdown-toggle text-white" type="button" data-bs-toggle="dropdown">Help and Support</button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">How It Work</a></li>
                                    <li><a class="dropdown-item" href="#l">General Support</a></li>
                                    <li><a class="dropdown-item" href="#">Help Center</a></li>
                                    <li><a class="dropdown-item" href="#l">Support Article</a></li>
                                    <li><a class="dropdown-item" href="#">Terms & Condition</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="main-nav bg-white">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <nav class="navbar navbar-expand-lg navbar-light secondary-nav hover-primary-nav">
                            <a class="navbar-brand" href="<?php echo base_url()?>"><img class="nav-logo" src="assets/images/logo/logo.png" alt=""></a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto">
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
                                    </li>
                                    <li class="nav-item"> <a class="nav-link" href="<?php echo site_url('contact')?>">Contact</a> </li>
                                    <li class="nav-item"> <a class="nav-link" href="<?php echo site_url('news')?>">
                                            News
                                        </a> </li>
                                    <li class="nav-item"> <a class="nav-link" href="<?php echo site_url('events')?>">
                                            Events</a> </li>
                                </ul>
                                <a href="<?php echo site_url('login')?>" class="hover-text-primary text-secondary me-3">Login / Register</a>
                                <!--<a class="btn btn-primary d-none d-xl-block" href="dashboard-submit-property.html">Submit Peoperty</a>-->
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--============== Header One Section End ==============-->