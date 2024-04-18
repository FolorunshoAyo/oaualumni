<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">New Admin</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('admin/all')?>">Admin</a></li>
			<li class="active">New Admin</li>
		</ol>


	</div>
	<!-- End Page Header -->



	<!-- //////////////////////////////////////////////////////////////////////////// -->
	<!-- START CONTAINER -->
	<div class="container-padding">
		<!-- Start Row -->
		<div class="row">
			<div class="col-md-2">

			</div>
			<div class="col-md-8 offset-2">
				<div class="panel panel-default">


					<div class="panel-body">
						<?php  echo checkFlash();?>
						<div class="cierrors">
							<?php echo validation_errors(); ?>
						</div>
						<!--<form action="<?php /*echo site_url('admin/addadmin')*/?>" class="fieldset-form" method="post" id="newAdmin">-->
                            <?php echo form_open('admin/addadmin',['class'=>'fieldset-form','id'=>'newAdmin'])?>
							<fieldset>
								<legend>Add New Admin</legend>
								<div class="form-group">
									<span>Name</span><span class="red">*</span>
									<?php
									echo form_input('name',set_value('name'),array('class'=>'form-control','placeholder'=>'Please Add Name'));
									?>
								</div>
								<div class="form-group">
									<span>Email</span>
									<?php
									echo form_input('email',set_value('email'),array('class'=>'form-control','placeholder'=>'Please Add Email'));
									?>
								</div>
								<div class="form-group">
									<span>Password</span>
									<?php
									echo form_password('password',set_value('password'),array('class'=>'form-control','placeholder'=>'Please Add Password'));
									?>
								</div>
								<div class="form-group">
									<span>Status</span><span class="red">*</span>
									<?php
									$plansStatus = array('1'=>'Active','0'=>'Disable');
									echo form_dropdown('status',$plansStatus,set_value('status'),array('class'=>'form-control'));
									?>
								</div>
								<button type="submit" class="btn btn-default">Submit</button>
							</fieldset>
						</form>

					</div>

				</div>
			</div>


		</div>
		<!-- End Row -->



	</div>
	<!-- END CONTAINER -->
	<!-- //////////////////////////////////////////////////////////////////////////// -->


</div>
