<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Edit User Deposits</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('admin/userplans')?>">User Plan</a></li>
			<li class="active">Edit plan</li>
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

						<form action="<?php echo site_url('admin/updateuserplan')?>" class="fieldset-form" method="post">
							<fieldset>
								<legend>Edit user deposit</legend>
								<div class="form-group">
									<span class="">Current Plan<span class="red">*</span></span>
									<?php
									$actPlns[''] = 'Select Plan';
										foreach($activePlans->result() as $actPlans){
											$actPlns[$actPlans->pl_id] = $actPlans->pl_name;
										}
									$UserDepositMode = array('new'=>'New-Investment');
									echo form_dropdown('',$actPlns, $userPlan[0]['plan_id'],array('class'=>'form-control disabled','disabled'=>'disabled'));
									?>
									<input type="hidden" value="<?php echo $userPlan[0]['up_id'] ?>" name="xeew">
									<input type="hidden" value="<?php echo $userPlan[0]['plan_id'] ?>" name="xeey">
								</div>
								<div class="form-group">
									<span class="">Upgrade Plan</span>
									<?php
									//$UserCurrency = array('USD'=>'USD');
									echo form_dropdown('upgradePlan',$actPlns, '',array('class'=>'form-control'));
									?>
								</div>
								<div class="form-group">
									<span>User Name and ID</span><span class="red">*</span>
									<?php
									echo form_input('',$userPlan[0]['user_name'].'('.$userPlan[0]['u_ref_id'].')',array('class'=>'form-control disabled','placeholder'=>'Please Add Your Amount','disabled'=>'disabled'));
									?>
								</div>

								<div class="form-group">
									<span>Purchase Date</span>
									<?php
									echo form_input('oldDate',$userPlan[0]['up_date'],array('class'=>'form-control datepicker','placeholder'=>'Select Date'));
									?>
								</div>


								<!--<div class="form-group">
									<span>Your  Bank Transaction Id</span><span class="red">*</span>
									<?php
/*									echo form_input('banktr',$userPlan[0]['ud_bank_tr_id'],array('class'=>'form-control','placeholder'=>'Please Add Your Bank Transaction ID'));
									*/?>
								</div>-->

								<div class="form-group">
									<span>Status</span><span class="red">*</span>
									<?php
									$plansStatus = array('1'=>'Active','0'=>'Disable');
									echo form_dropdown('status',$plansStatus,$userPlan[0]['up_status'],array('class'=>'form-control'));
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
