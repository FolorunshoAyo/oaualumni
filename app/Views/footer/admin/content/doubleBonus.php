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
									<th>user ID (Who received)</th>
									<th>Down Tree</th>
									<th>Level</th>
									<th>Deposit ID</th>
									<th>total</th>
									<th>View Detail</th>
								</tr>
								</thead>
								<tbody>
                                <?php /*var_dump($userMonthlyProfit);
                                    exit;
                                */?>
								<?php foreach ($userMonthlyProfit as $skzMyMonthBonus): ?>
									<tr>
										<td scope="row">
											<?php echo $skzMyMonthBonus['user_id']?>
										</td>
										<td>
											<?php echo $skzMyMonthBonus['bh_users']?>
										</td>
										<td>
											<?php echo $skzMyMonthBonus['bh_level']?>
										</td>
										<th>
											<?php echo $skzMyMonthBonus['deposit_id']?>
										</th>
										<th>
											<?php //echo $skzMyMonthBonus['total']-1?>
										</th>
										<th>
											<a href="
											<?php echo site_url(
													'admin/doubleDetail/'.
                                                    $skzMyMonthBonus['user_id'].'/'.
                                                    $skzMyMonthBonus['bh_users'].'/'.
                                                    $skzMyMonthBonus['bh_level'].'/'.$skzMyMonthBonus['deposit_id']
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
				<?php /*echo $pager->links(); */?>
			</div>
			<!-- End Panel -->











		</div>
		<!-- End Row -->






	</div>
	<!-- END CONTAINER -->
	<!-- //////////////////////////////////////////////////////////////////////////// -->




</div>
