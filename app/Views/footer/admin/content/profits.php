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
		<div class="row">
			<div class="col-md-12">
				<!--<div class="row">
					<form action="<?php /*echo site_url('admin/profits')*/?>" method="get">
						<div class="col-md-2">
							<div class="input-group">
								<input type="text" name="usr" placeholder="Search by 5stark500" value="" class="form-control">
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
					<form action="<?php echo site_url('admin/profits')?>" method="get">
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
									<label>Deposit ID</label>
									<?php if (count($allDeposits) >  0):
										$DepositOption = array();
										$DepositOption[''] = 'Select Deposit Id';
										foreach ($allDeposits as $myDeposit):
											$DepositOption[$myDeposit['ud_id']] = '<strong>'.$myDeposit['ud_id'].'</strong>';
										endforeach;
										echo form_dropdown('deposit',$DepositOption,$filters['deposit'],array('class'=>'form-control','id'=>'','onchange'=>'this.form.submit()'));
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
									echo form_input('fromDate',$filters['fromDate'],array('class'=>'form-control datepicker','placeholder'=>'Select From Date'));
									?>
								</div>

							</div>
						</div>
						<div class="col-md-3">
							<div class="srlef">
								<div class="form-group">
									<span>To Date</span><span class="red">*</span>
									<?php
									echo form_input('toDate',$filters['toDate'],array('class'=>'form-control datepicker','onchange'=>'this.form.submit()'));
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
											echo form_dropdown('ppg',$profitPrPage,$filters['page'],array('class'=>'form-control datepicker','placeholder'=>'Select To Date'));
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<button class="btn btn-primary">Filter Now</button>
									<a href="<?php echo site_url('admin/profits')?>" class="btn btn-primary">Restore Filter</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!-- Start Row -->
		<div class="row" id="PrintDiv">

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
						User Profit List
					</div>
					<div class="panel-body table-responsive">
						<?php
							$withrwnProfit = 0;
							$nyfProfit = 0;
							if ($userProfit):
							?>
							<table class="table table-hover dataTable">
								<tr>
									<th>Deposit ID</th>
									<th>Transaction ID</th>
									<th>User Name</th>
									<th>Currency</th>
									<th>Amount</th>
									<th>Daily Profit Date</th>
									<th>Deposit Date</th>
									<th>Percentage</th>
									<th>Profit</th>
									<th>Status</th>
									<!--<th>Edit</th>-->
								</tr>

								<?php foreach ($userProfit as $myProfit): ?>
									<tr>
										<td scope="row">
											<?php echo $myProfit['ud_id']?>
										</td>
										<td scope="row">
											<?php echo $myProfit['ud_trasaction_id']?>
										</td>
										<td>
											<?php echo $myProfit['user_name'].'('.$myProfit['u_ref_id'].')'?>
										</td>
										<td>
											<?php echo $myProfit['ud_currency']?>
										</td>
										<td>
											<?php
												//echo $myProfit->ud_amount;
											    echo number_format((float)$myProfit['ud_amount'], 2, '.', '');
												//echo $myProfit->ud_amount;
											?>
										</td>
										<td>
											<?php echo $myProfit['dp_date']?>
										</td>
										<td>
											<?php echo $myProfit['ud_date']?>
										</td>
										<td>
											<?php echo $myProfit['dp_percentage']?>
										</td>
										<td>
											<?php
												//echo $myProfit->ud_amount*$myProfit->dp_percentage/100;
											echo number_format((float)$myProfit['ud_amount']*$myProfit['dp_percentage']/100, 2, '.', '');
											if ($myProfit['pr_status'] == 1) {
												$nyfProfit+=$myProfit['ud_amount']*$myProfit['dp_percentage']/100;
											}
											if ($myProfit['pr_status'] == 3) {
												$withrwnProfit+= $myProfit['ud_amount']*$myProfit['dp_percentage']/100;
											}
											?>
										</td>
										<td>
											<?php if ($myProfit['pr_status'] == 1): ?>
												<button class="btn btn-primary">
													Not yet finalized
												</button>
											<?php elseif($myProfit['pr_status'] == 2): ?>
												<button class="btn btn-info">
													Finalized
												</button>
											<?php elseif($myProfit['pr_status'] == 3): ?>
												<button class="btn  btn-success">
													Withdrawn
												</button>
											<?php endif; ?>
										</td>
										<!--<td>
											<a class="btn btn-primary" href="<?php /*echo site_url('admin/editprofit/'.$myProfit->dp_id);*/?>">
												Edit
											</a>
										</td>-->
									</tr>
								<?php endforeach;?>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td>
										Withdrawn:<?php echo number_format((float)$withrwnProfit, 2, '.', ''); ?>
										Not Finalized:<?php echo number_format((float)$nyfProfit, 2, '.', '') ;?>
									</td>
									<td></td>
								</tr>
							</table>
						<?php endif; ?>
						<?php echo $pager->links(); ?>
					</div>

				</div>

			</div>
			<!-- End Panel -->











		</div>
		<!-- End Row -->






	</div>
	<!-- END CONTAINER -->
	<!-- //////////////////////////////////////////////////////////////////////////// -->




</div>
