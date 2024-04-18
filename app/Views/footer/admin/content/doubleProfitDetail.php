<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Double Bonus</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li class="active">Double Profit</li>
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
						User Double Profit
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
									<th>Month</th>
									<th>Date</th>
									<th>Updated Date</th>
									<th>Profit</th>
									<th>Status</th>
									<th>Commission</th>
									<th>Currency</th>
									<th>Canceled</th>
									<th>Reverse Now</th>
								</tr>
								</thead>
								<tbody>

								<?php foreach ($detailDoubleBonus as $myMonthBonus): ?>
									<tr>
										<td scope="row">
											<?php echo $myMonthBonus['um_id']?>
										</td>
										<td>
											<?php echo $myMonthBonus['user_id']?>
										</td>
										<td>
											<?php echo $myMonthBonus['um_profit_month']?>
										</td>
										<td>
											<?php echo $myMonthBonus['um_date']?>
										</td>
										<td>
											<?php echo $myMonthBonus['um_updated_date']?>
										</td>
										<th>
											<?php echo $myMonthBonus['um_profit']?>
										</th>
										<th>
											<?php echo $myMonthBonus['um_status']?>
										</th>
										<th>
											<?php echo $myMonthBonus['um_commission']?>
										</th>
										<th>
											<?php echo $myMonthBonus['um_currency']?>
										</th>
										<th>
											<?php echo $myMonthBonus['um_cancel']?>
										</th>

										<!--<th>
											<?php /*echo $myMonthBonus->total-1*/?>
										</th>-->
										<th>
											<a href="
											<?php echo site_url(
												'admin/cancelDoubleProfit/'.
												$myMonthBonus['um_id']
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
