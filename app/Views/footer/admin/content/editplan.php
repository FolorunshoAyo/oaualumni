<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Layouts</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('admin/plans')?>">Plans</a></li>
			<li class="active">Edit Plan</li>
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
						<!--<form action="<?php /*echo site_url('admin/updateplan')*/?>" class="fieldset-form" method="post">-->
                        <?php echo form_open('admin/updateplan'); ?>
							<fieldset>
								<legend>Create Your Plan</legend>
								<div class="form-group">
									<input type="hidden" value="<?php echo $plans[0]['pl_id'] ?>" name="xeew">
									<span>Plan Name</span><span class="red">*</span>
									<?php
									echo form_input('planName',$plans[0]['pl_name'],array('class'=>'form-control','placeholder'=>'Please Add Plan Name'));
									?>
								</div>
								<div class="form-group">
									<span>Return (ROI)</span><span class="red">*</span>
									<?php
									echo form_input('return',$plans[0]['pl_return'],array('class'=>'form-control','placeholder'=>'Please Add Return (ROI)'));
									?>
								</div>
								<div class="form-group">
									<span>Activation Charges</span><span class="red">*</span>
									<?php
									echo form_input('charges',$plans[0]['pl_charges'],array('class'=>'form-control','placeholder'=>'Please Add Activation Charges'));
									?>
								</div>
								<div class="form-group">
									<span>Minimum Amount</span><span class="red">*</span>
									<?php
									echo form_input('minAmount',$plans[0]['pl_minAmount'],array('class'=>'form-control','placeholder'=>'Please Add Minimum Amount'));
									?>
								</div>
								<div class="form-group">
									<span>Maximum Amount</span><span class="red">*</span>
									<?php
									echo form_input('maxAmount',$plans[0]['pl_maxAmount'],array('class'=>'form-control','placeholder'=>'Please Add Maximum Amount'));
									?>
								</div>
								<div class="form-group">
									<span>Commission</span><span class="red">*</span>
									<?php
									echo form_input('commission',$plans[0]['pl_commission'],array('class'=>'form-control','placeholder'=>'Please Add Commission'));
									?>
								</div>
								<div class="form-group">
									<span>Status</span><span class="red">*</span>
									<?php
									$plansStatus = array('1'=>'Active','0'=>'Disable');
									echo form_dropdown('status',$plansStatus,$plans[0]['pl_status'],array('class'=>'form-control'));
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
