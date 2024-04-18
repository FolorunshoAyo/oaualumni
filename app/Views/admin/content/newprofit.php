<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Layouts</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('admin/profits')?>">Profit</a></li>
			<li class="active">New Profit</li>
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
						<?php  echo checkFlash();?>
						<div class="cierrors">
							<?php echo validation_errors(); ?>
						</div>
						<!--<form action="<?php /*echo site_url('admin/addprofit')*/?>" class="fieldset-form" method="post">-->
                        <?php echo form_open('admin/addprofit','class="fieldset-form"')?>
							<fieldset>
								<legend>Add today's profit</legend>
								<div class="form-group">
									<span>Currency</span><span class="red">*</span>
									<?php
									$plansCurrency = array('USD'=>'USD');
									echo form_dropdown('currency',$plansCurrency,set_value('currency'),array('class'=>'form-control'));
									?>
								</div>
								<div class="form-group">
									<span>Profit</span><span class="red">*</span>
									<?php
									echo form_input('profit',set_value('profit'),array('class'=>'form-control','placeholder'=>'Please Add today\'s profit'));
									?>
								</div>
								<div class="form-group">
									<span>Date</span><span class="red">*</span>
									<?php
									echo form_input('todayDate',set_value('todayDate'),array('class'=>'form-control datepicker','placeholder'=>'Please select a date'));
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
