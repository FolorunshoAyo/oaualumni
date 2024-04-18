<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Layouts</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('admin/profits')?>">User Profit</a></li>
			<li class="active">Manually Profit Distribute</li>
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
						<!--<form action="<?php /*echo site_url('admin/DistributeProfitManually')*/?>" class="fieldset-form" method="post" id="newcashbox">-->
                            <?php echo form_open('admin/DistributeProfitManually',['class'=>'fieldset-form','id'=>'newcashbox']); ?>
							<fieldset>
								<legend>Manually Profit Distribute</legend>
								<div class="form-group">
									<span>User ID</span><span class="red">*</span>
									<?php
									/*										echo form_input('userId',set_value('userId'),array('class'=>'form-control','placeholder'=>'Please type User ID','id'=>'userID'));
																		*/?>
									<?php if (count($AllUsers) >  0):
										$userOption = array();
										$userOption[''] = 'Select User';
										foreach ($AllUsers as $myUser):
											$userOption[$myUser['u_id']] = $myUser['u_ref_id'] . ' ('.$myUser['user_name'].')' ;
										endforeach;
										echo form_dropdown('userId',$userOption,set_value('userId'),array('class'=>'form-control','id'=>'userID'));
										?>
									<?php else: ?>
										<?php no_data('alert-info','Cities not available')?>
									<?php endif; ?>
								</div>
								<div class="form-group">
									<span>Deposit ID</span><span class="red">*</span>
									<?php
									echo form_input('depositID',set_value('fromDate'),array('class'=>'form-control','placeholder'=>'Enter Deposit ID'));
									?>
								</div>
								<div class="form-group">
									<span>From Date</span><span class="red">*</span>
									<?php
									echo form_input('fromDate',set_value('fromDate'),array('class'=>'form-control datepicker','placeholder'=>'Select From Date'));
									?>
								</div>
								<div class="form-group">
									<span>To Date</span><span class="red">*</span>
									<?php
									echo form_input('toDate',set_value('toDate'),array('class'=>'form-control datepicker','placeholder'=>'Select To Date'));
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
