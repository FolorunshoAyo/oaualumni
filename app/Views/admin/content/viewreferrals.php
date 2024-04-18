<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">All Users</h1>
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
		<div class="row">
			<div class="col-lg-12">
				<?php
				//echo  var_dump($finalLevels[7]->result());
				checkFlash();
				?>
				<div class="card m-b-20">
					<div class="card-body">

						<h4 class="mt-0 header-title">Referral Partners</h4>
						<!--<p class="text-muted m-b-30 font-14">Example of custom tabs</p>-->

						<!-- Nav tabs -->
						<ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">

							<?php
							$levlActive = 0;
							if(!empty($comessionLevel) || $comessionLevel != 0): ?>
								<?php for($commskz=1; $commskz<=$comessionLevel; $commskz++):?>
									<?php $levlActive = $commskz?>
									<li class="nav-item">
										<a class="nav-link <?php if($levlActive == 1){ echo 'active';}?>" data-toggle="tab" href="#level<?php echo $commskz;?>" role="tab" aria-selected="false">
											<span class="d-none d-md-block"><?php echo $commskz;?>st Level Referrals</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
										</a>
									</li>
								<?php endfor;?>
							<?php else: ?>
								Commission level is not available.
							<?php endif; ?>

							<!--<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#level2" role="tab" aria-selected="false">
									<span class="d-none d-md-block">2st Level Referrals(Numbers)</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#level3" role="tab" aria-selected="false">
									<span class="d-none d-md-block">3st Level Referrals(Numbers)</span><span class="d-block d-md-none"><i class="mdi mdi-email h5"></i></span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link " data-toggle="tab" href="#level4" role="tab" aria-selected="true">
									<span class="d-none d-md-block">4st Level Referrals(Numbers)</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link " data-toggle="tab" href="#level5" role="tab" aria-selected="true">
									<span class="d-none d-md-block">5st Level Referrals(Numbers)</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link " data-toggle="tab" href="#level6" role="tab" aria-selected="true">
									<span class="d-none d-md-block">6st Level Referrals(Numbers)</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span>
								</a>
							</li>-->
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
							<?php
							$levltabActive=0;
							if(!empty($comessionLevel) || $comessionLevel != 0): ?>
								<?php for($frotabcommskz=1; $frotabcommskz<=$comessionLevel; $frotabcommskz++):?>
									<?php $levltabActive = $frotabcommskz?>
									<div class="tab-pane p-3 <?php if($levltabActive == 1){ echo 'active';}?>" id="level<?php echo $frotabcommskz;?>" role="tabpanel">
										<?php
										if (!empty($LevelsData[$frotabcommskz-1]) && $LevelsData[$frotabcommskz-1] != false):
											if($LevelsData[$frotabcommskz-1]->num_rows() > 0)://data if

												//var_dump($LevelsData[$frotabcommskz-1]);

												?>
												<!--<h1><?php /*echo $frotabcommskz;*/?>st Level Referrals</h1>-->
												<table class="table table-bordered mb-0">
													<thead>
													<tr>
														<td>uw_id</td>
														<td>User Name  </td>

														<td>5stark ID </td>
														<td>Parent ID </td>
														<td>Total USD </td>
														<!--<td>Profit/Bonus</td>-->
														<td>User Created At</td>
													</tr>
													</thead>
													<tbody>
													<?php
													foreach($LevelsData[$frotabcommskz-1]->result() as $mylevel1):
														//$secondLevelids[] = $mylevel1->u_ref_id
														?>
														<tr>
															<td># <b><?php echo $mylevel1->u_id ?></b></td>
															<td><?php echo $mylevel1->user_name ?></td>
															<td><?php echo $mylevel1->u_ref_id ?></td>
															<td><?php echo $mylevel1->u_who_refer ?></td>
															<td>
																<a target="_blank" href="<?php echo site_url('user/deposithistory/'.$mylevel1->u_id )?>" class="cckDepot" data-id="">
																	<?php echo userDepositedAmount($mylevel1->u_id); ?>
																</a>
															</td>

															<!--<td>
																						<?php
															/*																						$mylevels = getLevelPercentage($levltabActive);
																																					echo userDepositedAmount($mylevel1->u_id)*$mylevels/100
																																					*/?>

																					</td>-->
															<td><?php echo $mylevel1->u_date ?></td>
														</tr>
													<?php endforeach;?>
													</tbody>
												</table>
											<?php else: ?>
												The data is not available
											<?php endif; ?>
										<?php else: ?>
											The data is not available
										<?php endif;//main if ?>
										<!--<p class="font-14 mb-0">
										</p>-->
										<?php /*echo $frotabcommskz;*/?><!--st Level Referrals-->
									</div>
									<!--<li class="nav-item">
													<a class="nav-link <?php /*if($levlActive == 1){ echo 'active';}*/?>" data-toggle="tab" href="#level<?php /*echo $commskz;*/?>" role="tab" aria-selected="false">
														<span class="d-none d-md-block"><?php /*echo $commskz;*/?>st Level Referrals(Numbers)</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
													</a>
												</li>-->
								<?php endfor;?>
							<?php else: ?>

							<?php endif; ?>


							<!--<div class="tab-pane p-3" id="level2" role="tabpanel">
								2
							</div>-->
							<!--<div class="tab-pane p-3" id="level3" role="tabpanel">
								<p class="font-14 mb-0">
									3st Level Referrals
								</p>
							</div>
							<div class="tab-pane p-3 " id="level4" role="tabpanel">
								<p class="font-14 mb-0">
									4st Level Referrals
								</p>
							</div>
							<div class="tab-pane p-3 " id="level5" role="tabpanel">
								<p class="font-14 mb-0">
									5st Level Referrals
								</p>
							</div>
							<div class="tab-pane p-3 " id="level6" role="tabpanel">
								<p class="font-14 mb-0">
									6st Level Referrals
								</p>
							</div>-->
						</div>

					</div>
				</div>
			</div>

		</div>
		<!-- End Row -->

	</div>
	<!-- END CONTAINER -->
	<!-- //////////////////////////////////////////////////////////////////////////// -->
</div>
