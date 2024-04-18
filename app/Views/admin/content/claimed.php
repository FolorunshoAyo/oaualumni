<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">All Claimed</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li class="active">Claimed</li>
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
						All Claimed
					</div>
					<div class="panel-body table-responsive">
						<?php if ($allPromotions):?>
							<table class="table table-hover">
								<thead>
								<tr>
									<!--<td class="text-center"><i class="fa fa-trash"></i></td>-->
									<td>ID</td>
									<td>User</td>
									<td>Promotion</td>
									<td>Direct Deposit</td>
									<td>Level 1</td>
									<td>Any Level</td>
									<td>Date</td>
									<td>Status</td>
								</tr>
								</thead>
								<tbody>
								<?php foreach($allPromotions as $myPromotion):?>
									<tr>
                                        <?php //var_dump($myPromotion) ;?>
										<!--										<td class="text-center"><div class="checkbox margin-t-0"><input id="checkbox1" type="checkbox"><label for="checkbox1"></label></div></td>-->
										<td># <b><?php echo $myPromotion['cpr_id']?></b></td>
										<td><?php echo $myPromotion['user_name'].'(5stark'.$myPromotion['user_id'].')'?></td>
										<td><a href="<?php echo site_url('promotion/'.$myPromotion['pr_url'])?>" target="_blank"><?php echo $myPromotion['pr_title']?></a> </td>
										<td><?php echo $myPromotion['cpr_direct_deposit']?></td>
										<td><?php echo $myPromotion['cpr_level1']?></td>
										<td><?php echo $myPromotion['cpr_any_level']?></td>
										<td><?php echo $myPromotion['cpr_date']?></td>
										<td>
											<?php if ($myPromotion['cpr_status'] == 1): ?>
												<button class="btn btn-success">
													Active
												</button>
											<?php else: ?>
												<button class="btn btn-danger">
													Pending
												</button>
											<?php endif; ?>
										</td>
										<td>
											<?php if(isAdmin()): ?>
												<?php if ($myPromotion['cpr_status'] == 1): ?>
													<button class="btn btn-success">
														Activated
													</button>
												<?php else: ?>
													<a class="btn btn-primary" href="<?php echo site_url('admin/approveClaimPro/'.$myPromotion['cpr_id'])?>">Approve</a>
												<?php endif; ?>
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
