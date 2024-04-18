<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">All Queries</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li class="active">Queries</li>
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
				<div class="panel panel-default">
					<div class="panel-title">
						All Queries
					</div>
					<div class="panel-body table-responsive">
						<?php if ($allMessages):?>
							<table class="table table-hover">
								<thead>
								<tr>
									<!--<td class="text-center"><i class="fa fa-trash"></i></td>-->
									<td>Id</td>
									<td>First Name</td>
									<td>Last Name</td>
									<td>Email</td>
									<td>Phone</td>
									<td>Message</td>
									<td>Date</td>
								</tr>
								</thead>
								<tbody>
								<?php foreach($allMessages as $message):?>
									<tr>
<!--										<td class="text-center"><div class="checkbox margin-t-0"><input id="checkbox1" type="checkbox"><label for="checkbox1"></label></div></td>-->
										<td># <b><?php echo $message['con_id']?></b></td>
                                       <!-- <?php /*if(isset($message['user_id']) && !empty($message['user_id'])): */?>
                                            <td><?php /*echo $message['con_name']*/?></td>
                                            <td><?php /*echo $message['last_name']*/?></td>
                                            <td><?php /*echo $message['con_email']*/?></td>
                                            <td><?php /*echo $message['con_phone']*/?></td>
                                            <td><?php /*echo $message['con_subject']*/?></td>
                                        <?php /*else: */?>

                                        --><?php /*endif;  */?>
                                        <td><?php echo $message['con_name']?></td>
                                        <td><?php echo $message['con_email']?></td>
                                        <td><?php echo $message['con_phone']?></td>
                                        <td><?php echo $message['con_subject']?></td>
										<td><?php echo $message['con_message']?></td>
										<td><?php echo $message['con_date']?></td>
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
