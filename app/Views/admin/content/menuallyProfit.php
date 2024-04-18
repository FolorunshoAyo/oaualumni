<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Manually Bonus</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li class="active">Manually Bonus</li>
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
						Manually Bonus
					</div>

					<div class="panel-body">
						<?php  checkFlash();?>
						<div class="cierrors">
							<?php echo validation_errors(); ?>
						</div>
                            <?php echo form_open('admin/distributeManuallyProfit',['class'=>'fieldset-form'])?>
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
