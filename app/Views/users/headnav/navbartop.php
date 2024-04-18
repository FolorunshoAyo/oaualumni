

</head>

<body>

<div id="page-wrapper">
    <div class="row">
        <div class="full-row top-bar py-2 bg-secondary">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="dashboard-top-left d-flex flex-wrap">
                            <a class="float-start dashboard-logo me-4" href="<?php echo base_url(); ?>">
                                <img src="<?php echo site_url('public/assets/images/'.getwebsiteSetting('st_logo'))?>" alt="" style="width: 100px">
                            </a>


                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="dashboard-top-right d-flex flex-wrap justify-content-md-end mt-2 mt-lg-0">

                            <div class="dropdown dropdown-select">
                                <button class="dropdown-toggle text-white" type="button" data-bs-toggle="dropdown">
                                    <img src="<?php echo base_url('public/assets/images/users/'.getUserSession('u_dp'))?>" alt="">
                                    Hi, <?php echo getUserSession('user_name'); ?></button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?php echo site_url('user/profile'); ?>">Profile</a></li>
                                    <li><a class="dropdown-item" href="<?php echo site_url('user/logout'); ?>">sign out</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-lg-none">
                        <div class="collaps-dashboard text-white py-3">
                            <span>Open Dashboard Navigation</span>
                            <i class="fas fa-chevron-down fa-1x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="full-row dashboard py-0 bg-gray">
            <div class="container-fluid">
                <div class="row">