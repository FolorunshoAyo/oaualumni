<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">User Plans</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li class="active">User Plans</li>
		</ol>

	</div>
	<!-- End Page Header -->




	<!-- //////////////////////////////////////////////////////////////////////////// -->
	<!-- START CONTAINER -->
	<div class="container-padding">


		<!-- Start Row -->
		<div class="row" id="PrintDiv">
			<div class="row">
				<div class="col-md-12">
					<!--<div class="row">
						<form action="<?php /*echo site_url('admin/userplans')*/?>" method="get">
							<div class="col-md-2">
								<div class="input-group">
									<input type="text" name="usr" placeholder="Search by 5stark500" value="<?php /*if(!empty($searchTerm)){ echo $searchTerm;} */?>" class="form-control">
								</div>
							</div>
							<div class="col-md-2">
								<div class="input-group-append">
									<button class="btn btn-primary skzgsadmn" type="submit">Search</button>
								</div>

							</div>
						</form>
					</div>-->
					<div class="row">
						<form action="<?php echo site_url('admin/userplans')?>" method="get">
							<div class="col-md-3">
								<div class="srlef">
									<div class="form-group">
										<label>Users</label>
										<?php if ($AllUsers && count($AllUsers) >  0):
											$userOption = array();
											$userOption[''] = 'Select User';
											foreach ($AllUsers as $myUser):
												$userOption[$myUser['u_id']] = $myUser['u_ref_id'] . ' ('.$myUser['user_name'].')' ;
											endforeach;
											echo form_dropdown('user',$userOption,$filters['user'],array('class'=>'form-control','id'=>'userID','onchange'=>'this.form.submit()'));
											?>
										<?php else: ?>
											<?php no_data('alert-info','Makers not available')?>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="srlef">
									<div class="form-group">
										<span>From Date</span><span class="red">*</span>
										<?php
										echo form_input('fup',$filters['fup'],array('class'=>'form-control datepicker','placeholder'=>'Select From Date'));
										?>
									</div>

								</div>
							</div>
							<div class="col-md-3">
								<div class="srlef">
									<div class="form-group">
										<span>To Date</span><span class="red">*</span>
										<?php
										echo form_input('tup',$filters['tup'],array('class'=>'form-control datepicker','placeholder'=>'Select To Date'));
										?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="srlef">
										<div class="form-group">
											<span>Per Page</span><span class="red">*</span>
											<?php
											$profitPrPage = array();
											$profitPrPage['20'] = '20';
											$profitPrPage['50'] = '50';
											$profitPrPage['75'] = '75';
											$profitPrPage['100'] = '100';
											$profitPrPage['150'] = '150';
											$profitPrPage['200'] = '200';
											$profitPrPage['300'] = '300';
											$profitPrPage['500'] = '500';
											$profitPrPage['700'] = '700';
											$profitPrPage['1000'] = '1000';
											echo form_dropdown('ppg',$profitPrPage,$filters['page'],array('class'=>'form-control datepicker','onchange'=>'this.form.submit()'));
											?>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<button class="btn btn-primary">Filter Now</button>
										<a href="<?php echo site_url('admin/userplans')?>" class="btn btn-primary">Restore Filter</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Start Panel -->
			<div class="col-md-12">
				<div class="form-group">
					<?php echo checkFlash(); ?>
				</div>
				<div class="panel panel-default">
					<div class="pull-right">
						<a href="javascript:void(0)" onclick="printdiv('PrintDiv');" class="btn btn-success waves-effect waves-light">Print Now</a>
						<a href="javascript:void(0)" id="exportasCSV" class="btn btn-success waves-effect waves-light">Export</a>
					</div>
					<div class="panel-title">
						All User Plans
					</div>
					<div class="panel-body table-responsive">
						<?php if (count($userPlans) > 0):?>
							<table class="table table-hover dataTable">
								<thead>
								<tr>
									<!--<td class="text-center"><i class="fa fa-trash"></i></td>-->
									<td>Plan ID</td>
									<td>Plan Name</td>
									<td>User Name</td>
									<td>Status</td>
									<td>Admin</td>
									<td>Date</td>
									<td>Status</td>
									<td>Cancel</td>
									<td>Edit</td>
								</tr>
								</thead>
								<tbody>
								<?php foreach($userPlans as $myplan):?>
									<tr>
										<!--										<td class="text-center"><div class="checkbox margin-t-0"><input id="checkbox1" type="checkbox"><label for="checkbox1"></label></div></td>-->
										<td># <b><?php echo$myplan['up_id']?></b></td>
										<td><?php echo $myplan['pl_name']?></td>
										<td><?php echo $myplan['user_name'] . ' (' . $myplan['u_ref_id'].')'?></td>
										<td>
											<?php if ($myplan['up_status']==1): ?>
												<button class="btn btn-success">
													Active
												</button>
											<?php else: ?>
												<button class="btn btn-info">
													Pending
												</button>
											<?php endif; ?>
										</td>
										<td>
											<?php
											$skzAdmin = getAdminData($myplan['admin_id']);
											if ($skzAdmin != false) {
												echo $skzAdmin[0]['aName'];
											}
											else{
												echo 'N/A';
											}

											?>
										</td>
										<td><?php echo $myplan['up_date']?></td>
										<?php if ($myplan['up_status'] == 0): ?>
											<td>
												<a  href="<?php echo site_url('admin/approveuserplan/'.$myplan['up_id']); ?>" class="btn btn-primary">
													Approve Now
												</a>
											</td>
										<?php else: ?>
											<td>
												<a  href="javascript:void(0)" class="btn btn-success">
													Approved
												</a>
											</td>
										<?php endif; ?>
										<?php if ($myplan['up_status'] == 0): ?>
											<td>
												<a  href="<?php echo site_url('admin/canceluserplan/'.$myplan['up_id']); ?>" class="btn btn-primary">
													Cancel
												</a>
											</td>
										<?php elseif($myplan['up_status'] == 2): ?>
											<td>
												<a  href="javascript:void(0)" class="btn btn-success">
													Cancelled
												</a>
											</td>
										<?php else: ?>
											<td>

											</td>

										<?php endif; ?>
										<td>
											<a  href="<?php echo site_url('admin/edituserplan/'.$myplan['up_id']); ?>" class="btn btn-primary">
												Edit Plan
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
