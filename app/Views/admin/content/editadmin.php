<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Layouts</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('admin/cashbox')?>">New Admin</a></li>
			<li class="active">New Cash Box</li>
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

					<div class="panel-title">
						Fieldset
					</div>

					<div class="panel-body">
						<?php  checkFlash();?>
						<div class="cierrors">
							<?php echo validation_errors(); ?>
						</div>
						<!--<form action="<?php /*echo site_url('admin/updateadmin')*/?>" class="fieldset-form" method="post" id="newAdmin">-->
                            <?php echo form_open('admin/updateadmin',['class'=>'fieldset-form','id'=>'newAdmin']); ?>
							<fieldset>
								<legend>Add New Admin</legend>
								<div class="form-group">
									<span>Name</span><span class="red">*</span>
									<input type="hidden" value="<?php echo $admins[0]['aId'] ?>" name="xeew">
									<?php
									echo form_input('name',$admins[0]['aName'],array('class'=>'form-control','placeholder'=>'Please Add Name'));
									?>
								</div>
								<div class="form-group">
									<span>Email</span>
									<?php
									echo form_input('email',$admins[0]['email'],array('class'=>'form-control','placeholder'=>'Please Add Email'));
									?>
								</div>
								<div class="form-group">
									<span>Password</span>
									<?php
									echo form_password('password','',array('class'=>'form-control','placeholder'=>'Please Add Password'));
									?>
								</div>
								<div class="form-group">
									<span>Status</span><span class="red">*</span>
									<?php
									$plansStatus = array('1'=>'Active','0'=>'Disable');
									echo form_dropdown('status',$plansStatus,$admins[0]['aStatus'],array('class'=>'form-control'));
									?>
								</div>
								<button type="submit" class="btn btn-default">Update</button>
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
