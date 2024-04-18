<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">All Admins</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li class="active">Admins</li>
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
						All Admins
					</div>
					<div class="panel-body table-responsive">
						<?php if ($allAdmins):?>
							<table class="table table-hover">
								<thead>
								<tr>
									<!--<td class="text-center"><i class="fa fa-trash"></i></td>-->
									<td>aId</td>
									<td>Admin</td>
									<td>Date</td>
									<td>Update Date</td>
									<td>Email</td>
									<td>Status</td>
									<td>Picture</td>
									<td>Super Admin</td>
									<td>Edit</td>
								</tr>
								</thead>
								<tbody>
								<?php foreach($allAdmins as $myAdmin):?>
									<tr>
										<!--										<td class="text-center"><div class="checkbox margin-t-0"><input id="checkbox1" type="checkbox"><label for="checkbox1"></label></div></td>-->
										<td># <b><?php echo $myAdmin['aId']?></b></td>

										<td><?php if(!empty($myAdmin['aName'])){ echo $myAdmin['aName'];}else{ echo 'N/A';}?></td>
										<td><?php echo timeago($myAdmin['aDate'])?></td>
										<td><?php echo timeago($myAdmin['aUpdateDate'])?></td>
										<td><?php echo $myAdmin['email']?></td>
										<td>
											<?php if ($myAdmin['aStatus'] ==1): ?>
												<button class="btn btn-success">
													Active
												</button>
											<?php else: ?>
												<a  href="<?php echo site_url('admin/approveadmin/'.$myAdmin['aId']); ?>" class="btn btn-info">
													Active Now
												</a>
											<?php endif; ?>
										</td>
										<td><?php echo $myAdmin['aDp']?></td>
										<td><?php if ($myAdmin['aSuperAdmin'] == 1) {
												echo 'Yes';
											}else{
												echo 'No';
											}?></td>

										<td>
											<a  href="<?php echo site_url('admin/editadmin/'.$myAdmin['aId']); ?>" class="btn btn-primary">
												Edit
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
