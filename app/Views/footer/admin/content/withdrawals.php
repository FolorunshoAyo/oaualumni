<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">All Withdrawals</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li class="active">Withdrawals</li>
		</ol>

	</div>
	<!-- End Page Header -->




	<!-- //////////////////////////////////////////////////////////////////////////// -->
	<!-- START CONTAINER -->
	<div class="container-padding">


		<!-- Start Row -->
		<div class="row">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<form action="<?php echo site_url('admin/withdrawals')?>" method="get">
									<div class="col-md-3">
										<div class="srlef">
											<div class="form-group">
												<label>Users</label>
												<?php if (count($AllUsers) >  0):
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
												echo form_input('fwid',$filters['fwid'],array('class'=>'form-control datepicker','placeholder'=>'Select From Date'));
												?>
											</div>

										</div>
									</div>
									<div class="col-md-3">
										<div class="srlef">
											<div class="form-group">
												<span>To Date</span><span class="red">*</span>
												<?php
												echo form_input('twid',$filters['twid'],array('class'=>'form-control datepicker','placeholder'=>'Select To Date'));
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
												<a href="<?php echo site_url('admin/withdrawals')?>" class="btn btn-primary">Restore Filter</a>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Start Panel -->
			<div class="col-md-12" id="PrintDiv">
				<div class="form-group">
					<?php  echo checkFlash();?>
					<div class="cierrors">
						<?php echo validation_errors(); ?>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="pull-right">
						<a href="javascript:void(0)" onclick="printdiv('PrintDiv');" class="btn btn-success waves-effect waves-light">Print Now</a>
						<a href="javascript:void(0)" id="exportasCSV" class="btn btn-success waves-effect waves-light">Export</a>
					</div>
					<div class="panel-title">
						All Withdrawals
					</div>
					<div class="panel-body table-responsive">
						<?php
							$totalUsrWithdrw = 0;
						if ($Mywithdraws):
						?>
							<table class="table table-hover">
								<thead>
								<tr>
									<!--<td class="text-center"><i class="fa fa-trash"></i></td>-->
									<td>ID</td>
									<td>User ID</td>
									<td>Amount</td>
									<td>Cash Box</td>
									<td>Type</td>
									<td>Currency</td>
									<td>Amount</td>
									<td>After Withdraw</td>
									<td>PERFECT MONEY</td>
									<td>Status</td>
									<td>Cancel</td>
									<td>Admin</td>
									<td>Perfect Prof</td>
									<td>Receiver ID</td>
									<td>Date</td>
									<td>Action</td>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($Mywithdraws as $currentWithdraw): ?>
									<tr>
										<!--										<td class="text-center"><div class="checkbox margin-t-0"><input id="checkbox1" type="checkbox"><label for="checkbox1"></label></div></td>-->
										<td># <b><?php echo $currentWithdraw['uw_id']?></b></td>
										<td><?php echo $currentWithdraw['u_ref_id'] . ' ( '.$currentWithdraw['user_name'].')'; ?></td>
										<td>
											<?php
											$actualUserDeposit = userDepositedAmount($currentWithdraw['user_id']);
											if ($actualUserDeposit != false) {
												echo $actualUserDeposit;
											}
											else{
												'N/A';
											}
											?>
										</td>
										<td>
											<?php
												$actualUser = userCashBox($currentWithdraw['user_id']);
												if ($actualUser != false) {
													//echo $actualUser;
													echo number_format((float)$actualUser, 2, '.', '');
												}
												else{
													'N/A';
												}
											?>
										</td>
										<td><?php echo $currentWithdraw['uw_fund_type'];?></td>
										<td><?php echo $currentWithdraw['uw_currency']?></td>
										<td><?php
												//echo $currentWithdraw->uw_amount;
											$totalUsrWithdrw+=$currentWithdraw['uw_amount'];
											echo number_format((float)$currentWithdraw['uw_amount'], 2, '.', '');
											?>
										</td>
										<td>
											<?php
											$cashBoxaftrwithDraw = cashBoxAfterDeposit($currentWithdraw['user_id']);
											if ($cashBoxaftrwithDraw != false) {
												//echo $cashBoxaftrwithDraw;
												echo number_format((float)$cashBoxaftrwithDraw, 2, '.', '');
											}
											else{
												echo 'N/A';
											}
											?>
										</td>
										<td>
											<?php echo $currentWithdraw['u_perfect'];?>
										</td>
										<?php if ($currentWithdraw['uw_status'] == 0): ?>
											<td>
												<a  href="<?php echo site_url('admin/approvewithdraw/'.$currentWithdraw['uw_id']); ?>" class="btn btn-primary">
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
										<?php if ($currentWithdraw['uw_status'] == 0): ?>
											<td>
												<a  href="<?php echo site_url('admin/cancelwithdraw/'.$currentWithdraw['uw_id']); ?>" class="btn btn-warning">
													Cancel Now
												</a>
											</td>
										<?php else: ?>
											<td>
												N/A
											</td>
										<?php endif; ?>
										<td>
											<?php
											$skzAdmin = getAdminData($currentWithdraw['admin_id']);
											if ($skzAdmin != false) {
												echo $skzAdmin[0]['aName'];
											}
											else{
												echo 'N/A';
											}

											?>
										</td>
											<?php
											if (strpos($currentWithdraw['uw_fund_type'], 'Perfect Money') !== false && isset($currentWithdraw['perfect_money_prof'])):
												?>
											<td>
												<img src="<?php echo base_url('public/assets/images/perfectProf/'.$currentWithdraw['perfect_money_prof'])?>" class="img-fluid showProf" style="width: 30%;" data-text="<?php echo base_url('assets/images/perfectProf/'.$currentWithdraw['perfect_money_prof'])?>">
											</td>
											<?php else: ?>
												<td>
													N/A
												</td>
											<?php endif; ?>
											<?php
												if (!empty($currentWithdraw['uw_receiver_id']) && isset($currentWithdraw['uw_receiver_id'])):
													$skzUserInfor = getUserData($currentWithdraw['uw_receiver_id']);
													if ($skzUserInfor != false):
												?>
													<td>
														<?php echo $skzUserInfor[0]['u_ref_id'] . ' ( '.$skzUserInfor[0]['user_name'].')';?>
													</td>

													<?php else: ?>
														<td>
															<?php echo 'Something went wrong, Please contact Developer.'; ?>
														</td>

													<?php endif; ?>

												<?php else: ?>
													<td>
														N/A
													</td>
												<?php endif; ?>
										<td><?php echo $currentWithdraw['uw_date']?></td>
										<td>
                                            <a target="_blank" class="btn btn-primary"
                                               href="<?php echo site_url('admin/withftDetail/'.$currentWithdraw['user_id'].'?snd='.$currentWithdraw['uw_receiver_id']);
                                               ?>">
                                                View Transaction History
                                            </a>
                                        </td>
									</tr>
								<?php endforeach;?>
								<tr>
									<td>Total Amount for this page : <strong><?php echo $totalUsrWithdrw;?></strong></td>
								</tr>
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
