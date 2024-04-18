<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Profit</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li class="active">User Profit</li>
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
						User Profit List
					</div>
					<div class="panel-body table-responsive">
						<?php if ($dailyProfit):?>
							<table class="table table-hover">
								<thead>
								<tr>
									<th>ID</th>
									<th>Current Profit</th>
									<th>Old Profit</th>
									<th>New Profit</th>
									<th>Admin</th>
									<th>Profit Date</th>
									<th>History Date</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($dailyProfit as $myDailyProfit): ?>
									<tr>
										<td scope="row">
											<?php echo $myDailyProfit['ph_id']?>
										</td>
										<td>
											<?php echo $myDailyProfit['dp_percentage']?>
										</td>
										<td>
											<?php echo $myDailyProfit['old_value']?>
										</td>
										<td>
											<?php echo $myDailyProfit['new_values']?>
										</td>
										<td>
											<?php
												$myAdmin = getAdminData($myDailyProfit['admin_id']);
												if (!empty($myAdmin) && $myAdmin != false) {
													echo $myAdmin[0]['aName'];
												}
											?>
										</td>
										<td>
											<?php echo $myDailyProfit['dp_date']?>
										</td>
										<td>
											<?php echo $myDailyProfit['ph_date']?>
										</td>
									</tr>
								<?php endforeach;?>
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
