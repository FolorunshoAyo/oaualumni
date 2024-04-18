<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Layouts</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('admin/cashbox')?>">Cash Box</a></li>
			<li class="active">Reverse Cash</li>
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
                        <?php
                            $myFormAttr = [
                                    'class'=>'fieldset-form',
                                    'id'=>'reverscashbox',
                            ] ;
                            echo form_open('admin/addreverseamount',$myFormAttr);
                        ?>
						<!--<form action="<?php /*echo site_url('admin/addreverseamount')*/?>" class="" method="post" id="">-->
							<fieldset>
								<legend>Reverse Cash From Cash Box</legend>
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
								<!--<div class="form-group">
									<span>Date</span><span class="red">*</span>
									<?php
/*									echo form_input('mydate',set_value('return'),array('class'=>'form-control datepicker','placeholder'=>'Select a Date'));
									*/?>
								</div>-->
								<div class="form-group">
									<span>Currency</span><span class="red">*</span>
									<?php
									$CurrencyOptions = array('USD'=>'USD(Dollar)');
									echo form_dropdown('currency',$CurrencyOptions, set_value('currency'),array('class'=>'form-control'));
									?>
								</div>
								<div class="form-group">
									<span>Amount</span><span class="red">*</span>
									<?php
									echo form_input('amount',set_value('minAmount'),array('class'=>'form-control','placeholder'=>'Please Add Minimum Amount'));
									?>
								</div>
								<div class="form-group">
									<span>Reverse Cash Reason</span>
									<?php
										//echo form_input('bank_transaction',set_value('maxAmount'),array('class'=>'form-control','placeholder'=>'Please Add Maximum Amount'));
										echo form_textarea('reason',set_value('reason'),array('class'=>'form-control','placeholder'=>'Reverse Cash Reason i.e Bonus retuned.'))
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
