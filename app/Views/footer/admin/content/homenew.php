
<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START CONTENT -->
<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Dashboard</h1>
	</div>
	<!-- End Page Header -->


	<!-- //////////////////////////////////////////////////////////////////////////// -->
	<!-- START CONTAINER -->
	<div class="container-widget">

		<!-- Start Top Stats -->
		<?php if(isAdmin()): ?>
		<div class="col-md-12">
			<ul class="topstats clearfix">
				<li class="arrow"></li>
					<li class="col-xs-6 col-lg-2">
					<span class="title">
						<i class="fa fa-users"></i>
						<a href="<?php echo site_url('admin/users'); ?>">Active Users</a>
					</span>
					<h3>
						<?php
							echo count($users);
						?></h3>
					<span class="diff">
						<b class="">
						<?php
							echo count($pendingUsers);
						?>
						</b> Pending Users
					</span>
				</li>
			</ul>
		</div>
		<?php endif; ?>

		<!-- End Top Stats -->









	</div>
	<!-- END CONTAINER -->
	<!-- //////////////////////////////////////////////////////////////////////////// -->




</div>
<!-- End Content -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
