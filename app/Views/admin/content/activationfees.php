<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Activation Charges</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li class="active">Activation Charges</li>
		</ol>

	</div>
	<!-- End Page Header -->




	<!-- //////////////////////////////////////////////////////////////////////////// -->
	<!-- START CONTAINER -->
	<div class="container-padding">


		<!-- Start Row -->
		<div class="row">
			<div class="row">
				<form action="<?php echo site_url('admin/activationfees')?>" method="get">
					<div class="col-md-3">
						<div class="srlef">
							<div class="form-group">
								<label>Plans</label>
								<?php if ($AllPlans->num_rows() >  0):
									$planOption = array();
									$planOption[''] = 'Select Plan';
									foreach ($AllPlans->result() as $myPlan):
										$planOption[$myPlan->pl_id] = $myPlan->pl_name ;
									endforeach;
									echo form_dropdown('plns',$planOption,$filters['plns'],array('class'=>'form-control','id'=>'userID','onchange'=>'this.form.submit()'));
									?>
								<?php else: ?>
									<?php no_data('alert-info','Makers not available')?>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="srlef">
							<div class="form-group">
								<span>From Date</span><span class="red">*</span>
								<?php
								echo form_input('fupl',$filters['fupl'],array('class'=>'form-control datepicker','placeholder'=>'Select From Date'));
								?>
							</div>

						</div>
					</div>
					<div class="col-md-3">
						<div class="srlef">
							<div class="form-group">
								<span>To Date</span><span class="red">*</span>
								<?php
								echo form_input('tupl',$filters['tupl'],array('class'=>'form-control datepicker','placeholder'=>'Select To Date'));
								?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="srlef">
								<div class="form-group">
									<span>Per Page</span><span class="red">*</span>
									<?php
									$profitPrPage = array();
									$profitPrPage['20'] = '20';
									$profitPrPage['50'] = '50';
									$profitPrPage['75'] = '75';
									$profitPrPage['100'] = '100';
									$profitPrPage['150'] = '150';
									$profitPrPage['200'] = '200';
									$profitPrPage['300'] = '300';
									$profitPrPage['500'] = '500';
									$profitPrPage['700'] = '700';
									$profitPrPage['1000'] = '1000';
									echo form_dropdown('page',$profitPrPage,$filters['page'],array('class'=>'form-control datepicker','onchange'=>'this.form.submit()'));
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<button class="btn btn-primary">Filter Now</button>
								<a href="<?php echo site_url('admin/activationfees')?>" class="btn btn-primary">Restore Filter</a>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- Start Panel -->
			<div class="col-md-12" id="PrintDiv">
				<div class="form-group">
					<?php echo checkFlash(); ?>
				</div>
				<div class="panel panel-default">
					<div class="pull-right">
						<a href="javascript:void(0)" onclick="printdiv('PrintDiv');" class="btn btn-success waves-effect waves-light">Print Now</a>
						<a href="javascript:void(0)" id="exportasCSV" class="btn btn-success waves-effect waves-light">Export</a>
					</div>
					<div class="panel-title">
						All Activation Charges
					</div>
					<div class="panel-body table-responsive">
						<?php if ($activationCharges):?>
							<table class="table table-hover">
								<thead>
								<tr>
									<!--<td class="text-center"><i class="fa fa-trash"></i></td>-->
									<td>#ID</td>
									<td>User (Receiver) </td>
									<td>Package</td>
									<td>Package Date</td>
									<td>User Date(Registered)</td>
									<td>Status</td>
								</tr>
								</thead>
								<tbody>
								<?php foreach($activationCharges as $userActivation):?>
									<tr>
										<!--										<td class="text-center"><div class="checkbox margin-t-0"><input id="checkbox1" type="checkbox"><label for="checkbox1"></label></div></td>-->
										<td># <b><?php echo $userActivation->up_id?></b></td>
										<td><?php echo $userActivation->u_ref_id . ' ( '.$userActivation->user_name.')'; ?></td>
										<td><?php echo $userActivation->pl_name?></td>
										<td><?php if(!empty($userActivation->up_date)){ echo $userActivation->up_date;}else{ echo 'N/A';}?></td>
										<td><?php echo $userActivation->u_date?></td>
										<td>
											<?php if ($userActivation->up_status == 1): ?>
												<button class="btn btn-success">
													Active
												</button>
											<?php else: ?>
												<a  href="<?php echo site_url('admin/approvecashbox/'.$userActivation->cb_id); ?>" class="btn btn-info">
													Disabled
												</a>
											<?php endif; ?>
										</td>
									</tr>
								<?php endforeach;?>
								</tbody>
							</table>
						<?php endif; ?>
					</div>

				</div>
				<?php echo $links; ?>
			</div>
			<!-- End Panel -->











		</div>
		<!-- End Row -->






	</div>
	<!-- END CONTAINER -->
	<!-- //////////////////////////////////////////////////////////////////////////// -->




</div>
