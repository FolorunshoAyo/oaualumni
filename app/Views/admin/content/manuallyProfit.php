<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Manually Profit</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li class="active">Manually Profit</li>
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
						Manually Profit
					</div>

					<div class="panel-body">
						<?php  checkFlash();?>
						<div class="cierrors">
							<?php echo validation_errors(); ?>
						</div>
						<form action="<?php echo site_url('admin/manuallyProfitDistribute')?>" class="fieldset-form" method="post"><!--this is bonus-->
							<fieldset>
								<div class="form-group">
									<span>Date</span><span class="red">*</span>
									<?php
									echo form_input('todayDate',set_value('todayDate'),array('class'=>'form-control datepicker','placeholder'=>'Please select a date'));
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
