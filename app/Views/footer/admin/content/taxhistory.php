<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Tax History</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li class="active">Tax History</li>
		</ol>

	</div>
	<!-- End Page Header -->




	<!-- //////////////////////////////////////////////////////////////////////////// -->
	<!-- START CONTAINER -->
	<div class="container-padding">


		<!-- Start Row -->
		<div class="row">
			<div class="row">
				<form action="<?php echo site_url('admin/taxhistory')?>" method="get">
					<div class="col-md-3">
						<div class="srlef">
							<div class="form-group">
								<label>Users</label>
								<?php if ($AllUsers->num_rows() >  0):
									$userOption = array();
									$userOption[''] = 'Select User';
									foreach ($AllUsers->result() as $myUser):
										$userOption[$myUser->u_id] = $myUser->u_ref_id . ' ('.$myUser->user_name.')' ;
									endforeach;
									echo form_dropdown('user',$userOption,$filters['user'],array('class'=>'form-control','id'=>'userID','onchange'=>'this.form.submit()'));
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
								echo form_input('fbns',$filters['fbns'],array('class'=>'form-control datepicker','placeholder'=>'Select From Date'));
								?>
							</div>

						</div>
					</div>
					<div class="col-md-3">
						<div class="srlef">
							<div class="form-group">
								<span>To Date</span><span class="red">*</span>
								<?php
								echo form_input('tbns',$filters['tbns'],array('class'=>'form-control datepicker','placeholder'=>'Select To Date'));
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
								<a href="<?php echo site_url('admin/taxhistory')?>" class="btn btn-primary">Restore Filter</a>
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
						Tax History
					</div>
					<div class="panel-body table-responsive">
						<?php
						$TotalInvestment =  0;
						$TotalBonus =  0;
						$TotalNetBonus =  0;
						$TotalBonusTax =  0;
						if ($userMonthlyBonus):?>

							<table class="table table-hover">
								<thead>
								<tr>
									<!--<td class="text-center"><i class="fa fa-trash"></i></td>-->
									<th>ID</th>
									<th>User</th>
									<th>Received</th>
									<th>Investment</th>
									<th>Bonus</th>
									<th>Level</th>
									<th>Net Bonus</th>
									<th>Service Charges</th>
									<th>Tax</th>
									<th>Insertion Date</th>
									<th>Month</th>
									<th>Status</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($userMonthlyBonus as $myMonthBonus): ?>
									<tr>
										<td scope="row">
											<?php echo $myMonthBonus->bn_id?>
										</td>
										<td>
											<?php
											$myuser = getUserInfo($myMonthBonus->bn_users);
											echo $myuser[0]['u_ref_id'].'('.$myuser[0]['user_name'].')';
											?>
										</td>
										<td>
											<?php
											$myuser = getUserInfo($myMonthBonus->user_id);
											echo $myuser[0]['u_ref_id'].'('.$myuser[0]['user_name'].')';
											?>
										</td>
										<td>
											<?php
												$TotalInvestment+=$myMonthBonus->bn_amount;
												echo $myMonthBonus->bn_amount;
											?>
										</td>
										<td>
											<?php
											$mylevels = getLevelPercentage($myMonthBonus->bn_level);
											$ActualBonus = $myMonthBonus->bn_amount*$mylevels/100;
											$TotalBonus+=$ActualBonus;
											echo $ActualBonus;
											?>
										</td>
										<td>
											<?php echo $myMonthBonus->bn_level?>
										</td>
										<td>
											<?php
												echo $ActualBonus - $ActualBonus*MONTHLYBONUSCHARGES/100;
												$TotalNetBonus+=$ActualBonus;

											?>
										</td>
										<td>
											<?php echo MONTHLYBONUSCHARGES?>
										</td>

										<td>
											<?php
													echo $ActualBonus*MONTHLYBONUSCHARGES/100;
													$TotalBonusTax+=$ActualBonus*MONTHLYBONUSCHARGES/100;
											?>
										</td>
										<td>
											<?php echo $myMonthBonus->bn_date?>
										</td>

										<td>
											<?php echo date('Y/M',strtotime($myMonthBonus->bn_month))?>
										</td>

										<!--<td>
															<?php /*echo $myMonthBonus->um_profit*/?>
														</td>
														<td>
															<?php /*echo $myMonthBonus->um_commission*/?>
														</td>-->
										<td>
											<?php if ($myMonthBonus->bn_status == 1): ?>
												<button class="btn btn-success">
													Finalized
												</button>
											<?php elseif($myMonthBonus->bn_status == 0): ?>
												<button class="btn btn-info">
													Not yet finalized
												</button>
											<?php endif; ?>
										</td>

									</tr>
								<?php endforeach;?>
								<tr>
									<td>

									</td>
									<td></td>

									<td>

									</td>
									<td>
										<?php echo $TotalInvestment;?>
									</td>
									<td>
										<?php echo $TotalBonus;?>
									</td>
									<td>

									</td>
									<td>
										<?php echo $TotalNetBonus;?>
									</td>
									<td>

									</td>
									<td>
										<?php echo $TotalBonusTax;?>
									</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
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
