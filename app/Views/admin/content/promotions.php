<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">All Promotions</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li class="active">All Promotions</li>
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
						All Promotions
					</div>
					<div class="panel-body table-responsive">
						<?php if ($allPromotions):?>
							<table class="table table-hover">
								<thead>
								<tr>
									<!--<td class="text-center"><i class="fa fa-trash"></i></td>-->
									<td>ID</td>
									<td>Title</td>
									<td>From Date</td>
									<td>To Date</td>
									<td>Direct Deposit</td>
									<td>First Level</td>
									<td>Date</td>
									<td>Admin</td>
									<td>Status</td>
									<td>Edit</td>
                                    <td>Get Winner's List</td>
								</tr>
								</thead>
								<tbody>
								<?php foreach($allPromotions as $myPromotion):?>
									<tr>
										<!--										<td class="text-center"><div class="checkbox margin-t-0"><input id="checkbox1" type="checkbox"><label for="checkbox1"></label></div></td>-->
										<td># <b><?php echo $myPromotion['pr_id']?></b></td>
										<td><?php echo $myPromotion['pr_title']?></td>
										<td><?php echo $myPromotion['pr_from_date']?></td>
										<td><?php echo $myPromotion['pr_to_date']?></td>
										<td><?php echo $myPromotion['pr_direct_deposit']?></td>
										<td><?php echo $myPromotion['pr_level_1']?></td>
										<!--<td><?php /*echo base64_decode($myPromotion['promotion'])*/?></td>-->
										<td><?php echo $myPromotion['pr_created']?></td>
										<td><?php echo $myPromotion['admin_id'];?></td>
										<td>
											<?php if ($myPromotion['pr_status']==1): ?>
												<button class="btn btn-success">
													Active
												</button>
											<?php else: ?>
												<button class="btn btn-danger">
													Disabled
												</button>
											<?php endif; ?>
										</td>
										<td>
											<?php if(isSuperAdmin()): ?>
												<a  href="<?php echo site_url('admin/editPromotion/'.$myPromotion['pr_id']); ?>" class="btn btn-primary">
													Edit
												</a>
											<?php else:?>
												Not Allowed
											<?php endif; ?>
										</td>
                                        <td>
                                            <a target="_blank"  href="<?php echo site_url('admin/getwinners/'.$myPromotion['pr_id']); ?>" class="btn btn-primary">
                                                Get Winners
                                            </a>
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
