<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Canceled Bonus</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li class="active">Canceled Bonus</li>
		</ol>

	</div>
	<!-- End Page Header -->




	<!-- //////////////////////////////////////////////////////////////////////////// -->
	<!-- START CONTAINER -->
	<div class="container-padding">


		<!-- Start Row -->
		<div class="row">

			<!-- Start Panel -->
			<div class="col-md-12">
				<div class="form-group">
					<?php echo checkFlash(); ?>
				</div>
				<div class="panel panel-default">
					<div class="panel-title">
						Canceled Bonus
					</div>
					<div class="panel-body table-responsive">
						<?php
						$usrCountBlns = 0;
						if ($canceledBonus):?>
							<table class="table table-hover">
								<thead>
								<tr>
									<!--<td class="text-center"><i class="fa fa-trash"></i></td>-->
									<th>ID</th>
									<th>user ID (Who received)</th>
									<th>Down Tree</th>
									<th>Level</th>
									<th>Date</th>
									<th>Deposit ID</th>
									<th>Investment</th>
									<th>Bonus</th>
									<th>Service Charges</th>
									<th>Net Bonus</th>
									<th>Status</th>
								</tr>
								</thead>
								<tbody>

								<?php foreach ($canceledBonus as $myMonthBonus): ?>
									<tr>
										<td scope="row">
											<?php echo $myMonthBonus['bh_id']?>
										</td>
										<td>
											<?php echo $myMonthBonus['user_id']?>
										</td>
										<td>
											<?php echo $myMonthBonus['bh_users']?>
										</td>
										<td>
											<?php echo $myMonthBonus['bh_level']?>
										</td>
										<td>
											<?php echo $myMonthBonus['bh_last_bonus_date']?>
										</td>
										<td>
											<?php echo $myMonthBonus['deposit_id']?>
										</td>
										<td>
											<?php
												//echo $myMonthBonus->ud_amount;
												echo number_format((float)$myMonthBonus['ud_amount'], 2, '.', '');
											?>
										</td>
										<td>
											<?php
											$mylevels = getLevelPercentage($myMonthBonus['bh_level']);
											$ActualBonus = $myMonthBonus['ud_amount']*$mylevels/100;
											//echo $ActualBonus;
											echo number_format((float)$ActualBonus, 2, '.', '');
											?>
										</td>
										<td>
											<?php echo MONTHLYBONUSCHARGES?>
										</td>
										<td>
											<?php
											$usrCountBlns+=$ActualBonus - $ActualBonus*MONTHLYBONUSCHARGES/100;
											//echo $ActualBonus - $ActualBonus*MONTHLYBONUSCHARGES/100;
											echo number_format((float)$ActualBonus - $ActualBonus*MONTHLYBONUSCHARGES/100, 2, '.', '');
											?>
										</td>
										<!--<th>
											<?php /*echo $myMonthBonus->total-1*/?>
										</th>-->
										<td>
											<?php
												if ($myMonthBonus['bh_status'] == 0) {
													echo 'Pending';
												}
												else if($myMonthBonus['bh_status'] == 1){
													echo 'Not yet finalized';

												}
												else if($myMonthBonus['bh_status'] == 2){
													echo 'Finalized';
												}
												else if($myMonthBonus['bh_status'] == 3){
													echo 'Canceled';
												}
											?>
											<!--<a href="
											<?php /*echo site_url(
													'admin/cancelDoubleBonus/'.
													$myMonthBonus->bh_id.'/'
											);
											*/?>"
											   class="btn btn-info">Canceled</a>-->
										</td>
									</tr>
								<?php endforeach;?>
								</tbody>
							</table>
							<?php echo $pager->links();?>
						<?php endif; ?>
					</div>

				</div>
			</div>
			<!-- End Panel -->











		</div>
		<!-- End Row -->






	</div>
	<!-- END CONTAINER -->
	<!-- //////////////////////////////////////////////////////////////////////////// -->




</div>
