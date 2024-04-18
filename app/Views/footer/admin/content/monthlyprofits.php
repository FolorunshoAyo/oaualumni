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


		<!-- Start Row -->
		<div class="row" id="PrintDiv">

			<!-- Start Panel -->
			<div class="col-md-12">
				<div class="row">
					<form action="<?php echo site_url('admin/monthlyprofits')?>" method="get">
						<div class="col-md-3">
							<div class="srlef">
								<div class="form-group">
									<span>From Date</span><span class="red">*</span>
									<?php
									echo form_input('fdp',$filters['fdp'],array('class'=>'form-control datepicker','placeholder'=>'Select From Date'));
									?>
								</div>

							</div>
						</div>
						<div class="col-md-3">
							<div class="srlef">
								<div class="form-group">
									<span>To Date</span><span class="red">*</span>
									<?php
									echo form_input('mdp',$filters['mdp'],array('class'=>'form-control datepicker','placeholder'=>'Select To Date'));
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
									<a href="<?php echo site_url('admin/monthlyprofits')?>" class="btn btn-primary">Restore Filter</a>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="form-group">
					<?php echo checkFlash(); ?>
				</div>

				<div class="panel panel-default">
					<div class="pull-right">
						<a href="javascript:void(0)" onclick="printdiv('PrintDiv');" class="btn btn-success waves-effect waves-light">Print Now</a>
						<a href="javascript:void(0)" id="exportasCSV" class="btn btn-success waves-effect waves-light">Export</a>
					</div>
					<div class="panel-title">
						Monthly Profit History
					</div>
					<div class="panel-body table-responsive">
						<?php
						$countProfit = 0;
						if ($DailyProfit):?>
							<table class="table table-hover dataTable">
								<thead>
								<tr>
									<td>ID</td>
									<td>Percentage</td>
									<td>Date</td>
									<td>Currency</td>
<!--									<td>Distributed Profit</td>
									<td>Not Distributed Profit</td>
									<td>Finalized Not Distributed Profit</td>-->
									<td>Status</td>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($DailyProfit as $myProfit): ?>
									<tr>
										<td scope="row">
											<?php echo $myProfit['dp_id']?>
										</td>
										<td>
											<?php
											$countProfit+=$myProfit['dp_percentage'];
												echo $myProfit['dp_percentage'];
											?>
										</td>
										<td>
											<?php echo $myProfit['dp_date']?>
										</td>
										<td>
											<?php echo $myProfit['dp_currency']?>
										</td>

										<td>
											<?php if ($myProfit['dp_status'] == 1): ?>
												<button class="btn btn-info">
													Active
												</button>
											<?php elseif($myProfit['dp_status'] == 2): ?>
												<button class="btn btn-success">
													Disablbed
												</button>
											<?php elseif($myProfit['dp_status'] == 3): ?>
												<button class="btn btn-info">
													Error here
												</button>
											<?php endif; ?>
										</td>
									</tr>
								<?php endforeach;?>
								<tr>
									<td>Total</td>
									<td>
										<?php echo $countProfit;?>
									</td>
									<td></td>
									<td></td>
									<td></td>
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
