<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">All Plans</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li class="active">All Plans</li>
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
						All Plans
					</div>
					<div class="panel-body table-responsive">
						<?php if ($allPlans):?>
							<table class="table table-hover">
								<thead>
								<tr>
									<!--<td class="text-center"><i class="fa fa-trash"></i></td>-->
									<td>Plan ID</td>
									<td>Plan Name</td>
									<td>Return (ROI)</td>
									<td>Activation Charges</td>
									<td>Minimum Amount</td>
									<td>Maximum Amount</td>
									<td>Commission</td>
									<td>Status</td>
									<td>Date</td>
									<td>Edit</td>
								</tr>
								</thead>
								<tbody>
								<?php foreach($allPlans as $myplan):?>
									<tr>
										<!--										<td class="text-center"><div class="checkbox margin-t-0"><input id="checkbox1" type="checkbox"><label for="checkbox1"></label></div></td>-->
										<td># <b><?php echo$myplan['pl_id']?></b></td>
										<td><?php echo $myplan['pl_name']?></td>

										<td><?php echo $myplan['pl_return']?></td>
										<td><?php echo $myplan['pl_charges']?></td>
										<td><?php echo $myplan['pl_minAmount']?></td>
										<td><?php echo $myplan['pl_maxAmount']?></td>
										<td><?php echo $myplan['pl_commission']?></td>
										<td>
											<?php if ($myplan['pl_status']==1): ?>
												<button class="btn btn-success">
													Active
												</button>
											<?php else: ?>
												<button class="btn btn-danger">
													Disabled
												</button>
											<?php endif; ?>
										</td>
										<td><?php echo $myplan['pl_date']?></td>
										<td>
											<?php if(isSuperAdmin()): ?>
												<a  href="<?php echo site_url('admin/editplan/'.$myplan['pl_id']); ?>" class="btn btn-primary">
													Edit
												</a>
											<?php else:?>
												Not Allowed
											<?php endif; ?>
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
