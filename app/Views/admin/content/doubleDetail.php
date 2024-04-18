<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Double Bonus</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li class="active">Double Bonus</li>
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
						User Double Bonus
						<p>Note: Make sure you have remain at least one entry. i.e if two entry exist cancel only one entry, if three entries exist cancel two entries.</p>
					</div>
					<div class="panel-body table-responsive">
						<?php
						$usrCountBlns = 0;
						if (count($detailDoubleBonus) > 0):?>
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
									<th>View Detail</th>
								</tr>
								</thead>
								<tbody>

								<?php foreach ($detailDoubleBonus as $myMonthBonus): ?>
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
										<th>
											<?php echo $myMonthBonus['deposit_id']?>
										</th>
										<th>
											<?php echo $myMonthBonus['ud_amount']?>
										</th>
										<th>
											<?php
											$mylevels = getLevelPercentage($myMonthBonus['bh_level']);
											$ActualBonus = $myMonthBonus['ud_amount']*$mylevels/100;
											echo $ActualBonus;
											?>
										</th>
										<th>
											<?php echo MONTHLYBONUSCHARGES?>
										</th>
										<th>
											<?php
											$usrCountBlns+=$ActualBonus - $ActualBonus*MONTHLYBONUSCHARGES/100;
											echo $ActualBonus - $ActualBonus*MONTHLYBONUSCHARGES/100
											?>
										</th>
										<!--<th>
											<?php /*echo $myMonthBonus->total-1*/?>
										</th>-->
										<th>
											<a href="
											<?php echo site_url(
												'admin/cancelDoubleBonus/'.
												$myMonthBonus['bh_id'].'/'
											);
											?>"
											   class="btn btn-primary">Cancel</a>
										</th>
									</tr>
								<?php endforeach;?>
								</tbody>
							</table>
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
