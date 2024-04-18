
<!-- Begin page -->
<div id="wrapper">
    <div id="cover"></div>
    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <a href="<?php echo site_url('');?>" class="logo">
                                <span>
                                        <img src="<?php echo base_url('assets/images/MachineSells.png')?>" alt="" height="100" class="img-fluid kksxx" style="background: white;">
                                </span>
                <i>
                   <!-- <img src="<?php /*echo base_url('assets/images/sindh.png')*/?>" alt="ss" height="28" class="kksxx">-->
                </i>
            </a>
        </div>

        <nav class="navbar-custom">

            <ul class="list-inline float-right mb-0">
                <!--<li class="list-inline-item dropdown notification-list">
                    <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <i class="dripicons-bell noti-icon"></i>
                        <span class="badge badge-pink noti-icon-badge">4</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                        <div class="dropdown-item noti-title">
                            <h5><span class="badge badge-danger float-right">5</span>Notification</h5>
                        </div>

                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-success"><i class="icon-bubble"></i></div>
                            <p class="notify-details">Robert S. Taylor commented on Admin<small class="text-muted">1 min ago</small></p>
                        </a>

                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-info"><i class="icon-user"></i></div>
                            <p class="notify-details">New user registered.<small class="text-muted">1 min ago</small></p>
                        </a>

                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-danger"><i class="icon-like"></i></div>
                            <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">1 min ago</small></p>
                        </a>

                        <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">
                            View All
                        </a>

                    </div>
                </li>-->

                <li class="list-inline-item dropdown notification-list">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        <img src="<?php echo base_url('assets/images/MachineSells.png')?>" alt="user" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="text-overflow"><small>Welcome ! <?php echo $this->session->userdata('aName')?></small> </h5>
                        </div>



                        <!-- item-->
                        <a href="<?php echo site_url('admin/logout'); ?>" class="dropdown-item notify-item">
                            <i class="zmdi zmdi-power"></i> <span>Logout</span>
                        </a>

                    </div>
                </li>

            </ul>

            <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                    <button class="button-menu-mobile open-left waves-light waves-effect">
                        <i class="dripicons-menu"></i>
                    </button>
                </li>
               <!-- <li class="hide-phone app-search">
                    <form role="search" class="">
                        <input type="text" placeholder="Search..." class="form-control">
                        <a href=""><i class="fa fa-search"></i></a>
                    </form>
                </li>-->
            </ul>

        </nav>

    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="slimscroll-menu" id="remove-scroll">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu" id="side-menu">
                    <li>
                        <a href="<?php echo site_url('admin'); ?>">
                            <i class="fa fa-home"></i> <span> Dashboard </span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);"><i class="fa fa-align-justify"></i> <span> Categories </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="<?php echo site_url('admin/active-categories')?>">Active Categories</a></li>
                            <li><a href="<?php echo site_url('admin/deleted-categories')?>">Deleted Categories</a></li>
                            <li><a href="<?php echo site_url('admin/disabled-categories')?>">Disabled Categories</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);"><i class="fa fa-cubes"></i> <span> Sub Categories </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="<?php echo site_url('admin/active-sub-categories')?>">Active Sub Categories</a></li>
                            <li><a href="<?php echo site_url('admin/deleted-sub-categories')?>">Deleted Sub Categories</a></li>
                            <li><a href="<?php echo site_url('admin/disabled-sub-categories')?>">Disabled Sub Categories</a></li>
                            <li><a href="<?php echo site_url('admin/sub-categories-content')?>">Sub Categories Content</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);"><i class="fa fa-sticky-note"></i> <span> Content </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="<?php echo site_url('admin/all-partners')?>">Partners</a></li>
                            <li><a href="<?php echo site_url('admin/all-cities')?>">Cities</a></li>
                            <li><a href="<?php echo site_url('admin/all-banners')?>">Banners</a></li>
                            <li><a href="<?php echo site_url('admin/advertisements')?>">Advertisements</a></li>
                            <li><a href="<?php echo site_url('admin/manufacturers')?>">Manufacturers</a></li>
                            <li>
                                <a href="<?php echo site_url('admin/all-news-letters')?>">
                                    Newsletter
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('admin/contact')?>">
                                    Contact Form
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);"><i class="fa fa-users"></i> <span> Users </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="<?php echo site_url('admin/new-user')?>">Add User</a></li>
                            <li><a href="<?php echo site_url('admin/active-users')?>">Active Users</a></li>
                            <li><a href="<?php echo site_url('admin/pending-users')?>">Pending Users</a></li>
                            <li><a href="<?php echo site_url('admin/suspended-users')?>">Suspended Users</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);"><i class="fa fa-cog"></i> <span> Products </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                               <!-- <a href="<?php /*echo site_url('admin/user-machines')*/?>">
                                    User Machines
                                </a>-->
                                <a href="<?php echo site_url('admin/active-machines')?>">
                                    Active Machines
                                </a>
                                <a href="<?php echo site_url('admin/featured-machines')?>">
                                    Featured Machines
                                </a>
                                <a href="<?php echo site_url('admin/pending-machines')?>">
                                    Pending Machines
                                </a>
                                <a href="<?php echo site_url('admin/deletedmachines')?>">
                                    Deleted Machines
                                </a>
                                <a href="<?php echo site_url('admin/validation')?>">
                                    Machines Validation
                                </a>
                                <a href="<?php echo site_url('admin/valuation')?>">
                                    Machine Valuation
                                </a>
                                <a href="<?php echo site_url('admin/advertise-with-us')?>">
                                    Advertise with us
                                </a>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);"><i class="fa fa-image"></i> <span> Image Compress </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li>
                                <a href="<?php echo site_url('admin/compress-images')?>">Compress Images</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('admin/compressed-images')?>">Compressed Images</a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
            <!-- Sidebar -->
            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->
