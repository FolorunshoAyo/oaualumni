<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Canceled Profit</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li class="active">Canceled Profit</li>
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
						Canceled Profit
					</div>
					<div class="panel-body table-responsive">
						<?php
						$usrCountBlns = 0;
						if ($canceledProfit):?>
							<table class="table table-hover">
								<thead>
								<tr>
									<!--<td class="text-center"><i class="fa fa-trash"></i></td>-->
									<th>user ID (Who received)</th>
									<th>um_profit_month</th>
									<th>um_date</th>
									<th>um_updated_date</th>
									<th>um_profit</th>
									<th>um_commission</th>
									<th>um_currency</th>
								</tr>
								</thead>
								<tbody>

								<?php foreach ($canceledProfit as $myMonthProfit): ?>
									<tr>
										<td scope="row">
											<?php echo $myMonthProfit['user_name'].'('.$myMonthProfit['u_ref_id'].')'?>
										</td>
										<td>
											<?php echo $myMonthProfit['um_profit_month']?>
										</td>
										<td>
											<?php echo $myMonthProfit['um_date']?>
										</td>
										<td>
											<?php echo $myMonthProfit['um_date']?>
										</td>

										<td>
											<?php
												//echo $myMonthProfit->um_profit;
											echo number_format((float)$myMonthProfit['um_profit'], 2, '.', '');
											?>
										</td>
										<td>
											<?php
												//echo $myMonthProfit->um_commission;
												echo number_format((float)$myMonthProfit['um_commission'], 2, '.', '');
											?>
										</td>
										<td>
											<?php echo $myMonthProfit['um_currency']?>
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
