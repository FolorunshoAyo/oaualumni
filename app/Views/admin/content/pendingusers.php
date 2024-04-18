<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Pending Users</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li class="active">Users</li>
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
					<div class="row">
						<form action="<?php echo site_url('admin/pendingusers')?>" method="get">
							<div class="col-md-3">
								<div class="srlef">
									<div class="form-group">
										<label>Users</label>
										<?php if (count($AllUsers) >  0):
											$userOption = array();
											$userOption[''] = 'Select User';
											foreach ($AllUsers as $myUser):
												$userOption[$myUser['u_id']] = ' ('.$myUser['user_name'].')' ;
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
										echo form_input('fud',$filters['fud'],array('class'=>'form-control datepicker','placeholder'=>'Select From Date'));
										?>
									</div>

								</div>
							</div>
							<div class="col-md-3">
								<div class="srlef">
									<div class="form-group">
										<span>To Date</span><span class="red">*</span>
										<?php
										echo form_input('tud',$filters['tud'],array('class'=>'form-control datepicker','placeholder'=>'Select To Date'));
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
										<a href="<?php echo site_url('admin/pendingusers')?>" class="btn btn-primary">Restore Filter</a>
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

					<div class="panel-title">
						All Users
					</div>
					<div class="panel-body table-responsive">
						<?php if ($skzUsers):?>
							<table class="table table-hover dataTable">
								<thead>
								<tr>
									<!--<td class="text-center"><i class="fa fa-trash"></i></td>-->
									<td>User ID</td>
									<td>user_name</td>
                                    <td>First Name</td>
                                    <td>Last Name</td>
                                    <td>Email</td>
                                    <td>Address</td>
                                    <td>Occupation</td>
                                    <td>Hobbies</td>
									<td>Join Date</td>
									<td>Status</td>
									<td>Approve</td>
									<!--<td>Edit</td>-->
								</tr>
								</thead>
								<tbody>
								<?php foreach($skzUsers as $myuser):?>
									<tr>
										<!--										<td class="text-center"><div class="checkbox margin-t-0"><input id="checkbox1" type="checkbox"><label for="checkbox1"></label></div></td>-->
										<td># <b><?php echo $myuser['u_id']?></b></td>
										<td><?php echo $myuser['user_name']?></td>
										<td><?php echo $myuser['u_first_name']?></td>
										<td><?php echo $myuser['u_first_name']?></td>
										<td><?php echo $myuser['u_email']?></td>
										<td><?php echo $myuser['u_address']?></td>
										<td><?php echo $myuser['u_occupation']?></td>
										<td><?php echo $myuser['u_hobbies']?></td>
										<td><?php echo $myuser['u_date'];?></td>
										<td>
											<?php if ($myuser['u_status']==1): ?>
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
											<?php
												if ($myuser['u_status'] == 0):
											?>
												<a href="<?php echo site_url('admin/approveuser/').$myuser['u_id'].'/1'?>" class="btn btn-info">
													Approve Now
												</a>
											<?php else: ?>
													<a href="javascript:void(0)" class="btn btn-success">
														Approved
													</a>
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
