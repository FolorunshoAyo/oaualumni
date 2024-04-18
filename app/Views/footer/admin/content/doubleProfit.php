<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Double Profit</h1>
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
						User Profit
					</div>
					<div class="panel-body table-responsive">
						<?php
						$usrCountBlns = 0;
						if (count($userMonthlyProfit) > 0):?>
							<table class="table table-hover">
								<thead>
								<tr>
									<!--<td class="text-center"><i class="fa fa-trash"></i></td>-->
									<th>user ID (Who received)</th>
									<th>Profit</th>
									<th>Commission</th>
									<th>Total</th>
								</tr>
								</thead>
								<tbody>

								<?php foreach ($userMonthlyProfit as $myMonthBonus): ?>
									<tr>
										<td scope="row">
											<?php echo $myMonthBonus['user_id']?>
										</td>
										<td>
											<?php echo $myMonthBonus['profit']?>
										</td>
										<td>
											<?php echo $myMonthBonus['um_commission']?>
										</td>
										<th>
											<?php echo $myMonthBonus['total']-1?>
										</th>
										<!--<th>
											<?php /*echo $myMonthBonus->total-1*/?>
										</th>-->
										<th>
											<a href="
											<?php
											echo site_url(
												'admin/doubleProfitDetail/'.
												$myMonthBonus['user_id'].'/'.
												$myMonthBonus['um_profit'].'/'.
												$myMonthBonus['um_commission']
											);
											?>"
											   class="btn btn-primary">Detail</a>
										</th>
									</tr>
								<?php endforeach;?>
								</tbody>
							</table>
						<?php endif; ?>
					</div>

				</div>
				<?php /*echo $links; */?>
			</div>
			<!-- End Panel -->











		</div>
		<!-- End Row -->






	</div>
	<!-- END CONTAINER -->
	<!-- //////////////////////////////////////////////////////////////////////////// -->




</div>
