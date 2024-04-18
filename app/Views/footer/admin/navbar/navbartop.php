</head>
<body>

<!-- Start Page Loading -->
<!--<div class="loading"><img src="<?php /*echo base_url('assets/admin/img/loading.gif')*/?>" alt="loading-img"></div>-->
<!-- End Page Loading -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START TOP -->
<div id="top" class="clearfix">

	<!-- Start App Logo -->
	<div class="applogo">
		<a href="<?php echo base_url()?>" class="logo">Club</a>
	</div>
	<!-- End App Logo -->

	<!-- Start Sidebar Show Hide Button -->
	<a href="#" class="sidebar-open-button"><i class="fa fa-bars"></i></a>
	<a href="#" class="sidebar-open-button-mobile"><i class="fa fa-bars"></i></a>
	<!-- End Sidebar Show Hide Button -->




	<!-- End Top Menu -->

	<!-- Start Sidepanel Show-Hide Button -->
	<!--<a href="#sidepanel" class="sidepanel-open-button"><i class="fa fa-outdent"></i></a>-->
	<!-- End Sidepanel Show-Hide Button -->

	<!-- Start Top Right -->
	<ul class="top-right">





		<li class="dropdown link">
			<a href="#" data-toggle="dropdown" class="dropdown-toggle profilebox"><img src="<?php echo base_url('public/assets/admin/img/profileimg.png')?>" alt="img"><b>
                    <?php echo getSessionAdminData('aName')?></b><span class="caret"></span></a>
			<ul class="dropdown-menu dropdown-menu-list dropdown-menu-right">
				<li role="presentation" class="dropdown-header">Profile</li>
				<li class="divider"></li>
				<li><a href="<?php echo site_url('admin/logout'); ?>"><i class="fa falist fa-power-off"></i> Logout</a></li>
			</ul>
		</li>

	</ul>
	<!-- End Top Right -->

</div>
<!-- END TOP -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
