<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">All Deposits</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li class="active">Deposits</li>
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
						<form action="<?php echo site_url('admin/deposits')?>" method="get">
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
										echo form_input('fudd',$filters['fudd'],array('class'=>'form-control datepicker','placeholder'=>'Select From Date'));
										?>
									</div>

								</div>
							</div>
							<div class="col-md-3">
								<div class="srlef">
									<div class="form-group">
										<span>To Date</span><span class="red">*</span>
										<?php
										echo form_input('tudd',$filters['tudd'],array('class'=>'form-control datepicker','placeholder'=>'Select To Date'));
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
										<a href="<?php echo site_url('admin/deposits')?>" class="btn btn-primary">Restore Filter</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Start Panel -->
			<div class="col-md-12" id="PrintDiv">
				<div class="form-group">
					<?php echo checkFlash(); ?>
				</div>
				<div class="panel panel-default">
					<div class="pull-right">
						<a href="javascript:void(0)" onclick="printdiv('PrintDiv');" class="btn btn-success waves-effect waves-light">Print Now</a>
						<a href="javascript:void(0)" id="exportasCSV" class="btn btn-success waves-effect waves-light">Export</a>
					</div>
					<div class="panel-title">
						All Deposits
					</div>
					<div class="panel-body table-responsive">
						<?php
						$userAllDepsit = 0;
							if ($userDeposits):
						?>
							<table class="table table-hover">
								<thead>
								<tr>
									<!--<td class="text-center"><i class="fa fa-trash"></i></td>-->
								<tr>
									<th>#ID</th>
									<th>Deposit ID</th>
									<th>Bank Transactions ID</th>
									<th>User Name</th>
									<th>Payment Type</th>
									<th>Currency</th>
									<th>Amount</th>
									<!--<th>Prof</th>-->
									<th>Deposit Date</th>
									<th>Status</th>
									<th>WithDraw Status</th>
									<td>Edit</td>
								</tr>

								</thead>
								<tbody>
								<?php foreach($userDeposits as $mydepposit):?>
									<tr>
										<th scope="row">
											<?php echo $mydepposit['ud_id']?>
										</th>
										<th>
											<?php echo $mydepposit['ud_trasaction_id']?>
										</th>
										<th>
											<?php echo $mydepposit['ud_bank_tr_id']?>
										</th>
										<th>
											<?php echo $mydepposit['user_name'].'('.$mydepposit['u_ref_id'].')'?>
										</th>
										<td>
											<?php echo $mydepposit['ud_type']?>
										</td>
										<td>
											<?php echo $mydepposit['ud_currency']?>
										</td>
										<td>
											<?php $userAllDepsit+=$mydepposit['ud_amount'];?>
											<?php echo number_format((float)$mydepposit['ud_amount'], 2, '.', '')  . ' ('.$mydepposit['ud_currency'].')'?>
										</td>
										<!--<td>
										<?php /*echo $mydepposit->ud_proff*/?>
											<a href="javascript:void(0)" class="showProf" data-text="<?php /*echo base_url('assets/images/prof/' . $mydepposit->ud_proff); ;*/?>">
												<img src="<?php /*echo base_url('assets/images/prof/'.$mydepposit->ud_proff); */?>" class="img-responsive imgProf">
											</a>
										</td>-->
										<td>
											<?php echo $mydepposit['ud_date']?>
										</td>
										<?php if ($mydepposit['ud_status'] == 0): ?>
											<td>
												<a  href="<?php echo site_url('admin/approvedeposit/'.$mydepposit['ud_id']); ?>" class="btn btn-primary">
													Approve Now
												</a>
											</td>
										<?php elseif($mydepposit['ud_status'] == 2): ?>
                                            <td>
                                                <a  href="javascript:void(0)" class="btn btn-success">
                                                    Withdrawn
                                                </a>
                                            </td>
										<?php else: ?>
											<td>
												<a  href="javascript:void(0)" class="btn btn-success">
													Approved
												</a>
											</td>
										<?php endif; ?>
										<td>
											<?php
											$checkDepositYear = checkDepositYear($mydepposit['ud_date']);
											?>
											<?php if ($checkDepositYear == 1): ?>
											<button class="btn btn-success disabled">
												Finalized (Matured)
											</button>
											<?php else: ?>
											<button class="btn btn-info disabled">
												Now Yet Finalized
											</button>
											<?php endif; ?>
										<td>
											<a href="<?php echo site_url('admin/editDeposit/'.$mydepposit['ud_id'])?>" class="btn btn-info">Edit</a>
										</td>
									</tr>
								<?php endforeach;?>
								<tr>
									<td>
										Total Deposit on this page <strong><?php echo $userAllDepsit;?></strong>
									</td>
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
