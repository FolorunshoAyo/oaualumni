<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Edit Profit</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('admin/profits')?>">Profit</a></li>
			<li class="active">Edit Profit</li>
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
						<form action="<?php echo site_url('admin/updateprofit')?>" class="fieldset-form" method="post">
							<fieldset>
								<legend>Edit today's profit</legend>
								<div class="form-group">
									<span>Currency</span><span class="red">*</span>
									<?php
									$plansCurrency = array('USD'=>'USD');
									echo form_dropdown('currency',$plansCurrency,$dailyProfit[0]['dp_currency'],array('class'=>'form-control'));
									?>
								</div>
								<div class="form-group">
									<span>Profit</span><span class="red">*</span>
									<?php
									echo form_input('profit',$dailyProfit[0]['dp_percentage'],array('class'=>'form-control','placeholder'=>'Please Add today\'s profit'));
									?>
									<input type="hidden" value="<?php echo $dailyProfit[0]['dp_id'] ?>" name="xeew">
									<input type="hidden" value="<?php echo $dailyProfit[0]['dp_percentage'] ?>" name="dimgo">
								</div>
								<div class="form-group">
									<span>Date</span><span class="red">*</span>
									<?php
									echo form_input('todayDate',$dailyProfit[0]['dp_date'],array('class'=>'form-control datepicker','placeholder'=>'Please select a date'));
									?>
								</div>

								<div class="form-group">
									<span>Status</span><span class="red">*</span>
									<?php
									$plansStatus = array('1'=>'Active','0'=>'Disable');
									echo form_dropdown('status',$plansStatus,$dailyProfit[0]['dp_status'],array('class'=>'form-control'));
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
