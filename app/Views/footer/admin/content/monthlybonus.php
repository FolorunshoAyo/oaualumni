<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Monthly Bonus</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li class="active">Monthly Bonus</li>
		</ol>

	</div>
	<!-- End Page Header -->




	<!-- //////////////////////////////////////////////////////////////////////////// -->
	<!-- START CONTAINER -->
	<div class="container-padding">


		<!-- Start Row -->
		<div class="row">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<form action="<?php echo site_url('admin/monthlybonus')?>" method="get">
							<div class="col-md-3">
								<div class="srlef">
									<div class="form-group">
										<label>Users</label>
										<?php if (count($AllUsers) >  0):
											$userOption = array();
											$userOption[''] = 'Select User';
											foreach ($AllUsers as $myUser):
												$userOption[$myUser['u_id']] = $myUser['u_ref_id'] . ' ('.$myUser['user_name'].')' ;
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
										echo form_input('fbnd',$filters['fbnd'],array('class'=>'form-control datepicker','placeholder'=>'Select From Date'));
										?>
									</div>

								</div>
							</div>
							<div class="col-md-3">
								<div class="srlef">
									<div class="form-group">
										<span>To Date</span><span class="red">*</span>
										<?php
										echo form_input('tbnd',$filters['tbnd'],array('class'=>'form-control datepicker','placeholder'=>'Select To Date'));
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
											echo form_dropdown('ppg',$profitPrPage,$filters['page'],array('class'=>'form-control datepicker','onchange'=>'this.form.submit()'));
											?>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<button class="btn btn-primary">Filter Now</button>
										<a href="<?php echo site_url('admin/monthlybonus')?>" class="btn btn-primary">Restore Filter</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Start Panel -->
			<div class="col-md-12">
				<div class="form-group">
					<?php echo checkFlash(); ?>
				</div>
				<div class="panel panel-default">
					<div class="panel-title">
						User Bonus
					</div>
					<div class="panel-body table-responsive">
						<?php
						$usrCountBlns = 0;
							if ($userMonthlyProfit):?>
							<table class="table table-hover">
								<thead>
								<tr>
									<!--<td class="text-center"><i class="fa fa-trash"></i></td>-->
									<th>ID</th>
									<th>User Name</th>
									<th>Reffrals</th>
									<th>Down Tree</th>
									<th>Investment</th>
									<th>Bonus</th>
									<th>Service Charges</th>
									<th>Net Bonus</th>
									<th>Insertion Date</th>
									<th>Month</th>
									<th>Level</th>
									<!--<th>um_profit</th>
									<th>um_commission</th>-->

									<th>Status</th>
								</tr>
								</thead>
								<tbody>

								<?php foreach ($userMonthlyProfit as $myMonthBonus): ?>
									<tr>
										<td scope="row">
											<?php echo $myMonthBonus['bn_id']?>
										</td>
										<td>
											<?php echo $myMonthBonus['user_name'].'('.$myMonthBonus['u_ref_id'].')'?>
										</td>
										<td>
											<?php echo anchor('admin/viewreferrals/'.$myMonthBonus['user_id'].'/'.$myMonthBonus['u_ref_id'],
													getAllRefrralsForAdmin($myMonthBonus['user_id'],$myMonthBonus['u_ref_id']),
													array('target'=>'__blank')); ?>
										</td>
										<th>
											<?php
											$myuser = getUserInfo($myMonthBonus['bn_users']);
											echo $myuser[0]['u_ref_id'].'('.$myuser[0]['user_name'].')';
											?>

										</th>
										<td>
											<?php  echo number_format((float)$myMonthBonus['bn_amount'], 2, '.', '');?>
										</td>
										<th>
											<?php
											$mylevels = getLevelPercentage($myMonthBonus['bn_level']);
											$ActualBonus = $myMonthBonus['bn_amount']*$mylevels/100;
											//echo $ActualBonus;
											echo number_format((float)$ActualBonus, 2, '.', '');
											?>

										</th>
										<th>
											<?php echo MONTHLYBONUSCHARGES?>
										</th>
										<th>
											<?php
											$usrCountBlns+=$ActualBonus - $ActualBonus*MONTHLYBONUSCHARGES/100;
												//echo $ActualBonus - $ActualBonus*MONTHLYBONUSCHARGES/100;
											echo number_format((float)$ActualBonus - $ActualBonus*MONTHLYBONUSCHARGES/100, 2, '.', '');
											?>
										</th>
										<td>
											<?php echo $myMonthBonus['bn_date']?>
										</td>
										<td>
											<?php echo date('Y/M',strtotime($myMonthBonus['bn_month']))?>
										</td>
										<td>
											<?php echo $myMonthBonus['bn_level']?>
										</td>
										<!--<td>
															<?php /*echo $myMonthBonus->um_profit*/?>
														</td>
														<td>
															<?php /*echo $myMonthBonus->um_commission*/?>
														</td>-->
										<td>
											<?php if ($myMonthBonus['bn_status'] == 1): ?>
												<button class="btn btn-success">
													Finalized
												</button>
											<?php elseif($myMonthBonus['bn_status'] == 0): ?>
												<button class="btn btn-info">
													Not yet finalized
												</button>
											<?php endif; ?>
										</td>

									</tr>
								<?php endforeach;?>
								<tr>

									<td>
										Total Net Bonus: <?php  echo number_format((float)$usrCountBlns, 2, '.', '');?>
									</td>
									<?php if (isset($totalUserBonus)): ?>
										<td>Total Received Bonus in CashBox <?php echo number_format((float)$totalUserBonus, 2, '.', ''); //echo $totalUserBonus;?></td>
									<?php endif; ?>
								</tr>
								</tbody>
							</table>
						<?php endif; ?>
					</div>

				</div>
				<?php echo $pager->links(); ?>
			</div>
			<!-- End Panel -->











		</div>
		<!-- End Row -->






	</div>
	<!-- END CONTAINER -->
	<!-- //////////////////////////////////////////////////////////////////////////// -->




</div>
