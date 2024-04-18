

<!--<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <ol class="breadcrumb float-left">
                            <li class="breadcrumb-item"><a href="<?php /*echo site_url('admin')*/?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">Machine <?php /*echo $this->uri->segment(2);*/?></li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php /*checkFlash();*/?>
                            </div>
                            <section class="rightsec brewords">
                                <div class="erresnd">

                                </div>
                                <?php /*if ($vvMachines):*/?>
                                    <table id="datatable" class="table table-bordered">
                                        <thead>
                                        <th>Id</th>
                                        <th>Person Name</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Location</th>
                                        <th>Condition</th>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Category</th>
                                        <th>Manufacturer</th>
                                        </thead>
                                        <tbody>
                                        <?php /*foreach($vvMachines as $vvMachine):*/?>
                                            <tr class="gmi<?php /*echo $vvMachine->vv_id*/?>">
                                                <td data-title="Order #">
                                                    <?php /*echo $vvMachine->vv_id*/?>
                                                </td>
                                                <td class="brewords" data-title="Order #">
                                                    <span class="brewords">
                                                        <?php /*echo $vvMachine->vv_person_name*/?>
                                                   </span>
                                                </td>
                                                <td data-title="Order #">
                                                    <?php /*echo $vvMachine->vv_person_contact*/?>
                                                </td>
                                                <td data-title="Order #">
                                                    <?php /*echo $vvMachine->vv_email*/?>
                                                </td>
                                                <td data-title="Order #">
                                                    <?php /*echo $vvMachine->vv_location*/?>
                                                </td>
                                                <td data-title="Order #">
                                                    <?php
/*                                                        echo  $vvMachine->vv_machine_condition;
                                                    */?>
                                                </td>
                                                <td data-title="Order #">
                                                    <?php
/*                                                    echo  $vvMachine->vv_product_name;
                                                    */?>
                                                </td>
                                                <td data-title="Order #">
                                                    <?php
/*                                                    echo  $vvMachine->vv_category;
                                                    */?>
                                                </td>
                                                <td data-title="Order #">
                                                    <?php
/*                                                    echo  $vvMachine->vv_sub_category;
                                                    */?>
                                                </td>
                                                <td data-title="Order #">
                                                    <?php
/*                                                    echo  $vvMachine->vv_manufacturer_name;
                                                    */?>
                                                </td>
                                            </tr>
                                        <?php /*endforeach;*/?>
                                        </tbody>
                                    </table>
                                    <h1> <?php /*echo $links;*/?></h1>
                                <?php /*else: */?>
                                    <?php /*no_data('alert-info','The ' . $this->uri->segment(2) . 'is not available'); */?>
                                <?php /*endif*/?>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->




<div class="content-page">
	<!-- Start content -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<ol class="breadcrumb float-left">
							<li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
							<li class="breadcrumb-item active">Machine <?php echo $this->uri->segment(2);?></li>
						</ol>

						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<?php checkFlash();?>
							</div>
							<!-- class = rightsec brewords -->
							<section>
								<div class="container erresnd">
									<div class="row">
										<?php if ($vvMachines):?>
											<table id="dtHorizontalVerticalExample" class="table table-striped table-bordered table-sm " cellspacing="0"
												   width="100%">
												<thead>
												<tr>
													<th>ID</th>
													<th>Person Name</th>
													<th>Contact</th>
													<th>Email</th>
													<th>Location</th>
													<th>Condition</th>
													<th>Product</th>
													<th>Category</th>
													<th>Sub Category</th>
												</tr>
												</thead>
												<tbody>
												<?php foreach($vvMachines as $vvMachine):?>
													<tr class="gmi<?php echo $vvMachine->vv_id?>">
														<td data-title="Order #">
															<?php echo $vvMachine->vv_id?>
														</td>
														<td class="brewords" data-title="Order #">
                                                    <span class="brewords">
                                                        <?php echo $vvMachine->vv_person_name?>
                                                   </span>
														</td>
														<td data-title="Order #">
															<?php echo $vvMachine->vv_person_contact?>
														</td>
														<td data-title="Order #">
															<?php echo $vvMachine->vv_email?>
														</td>
														<td data-title="Order #">
															<?php echo $vvMachine->vv_location?>
														</td>
														<td data-title="Order #">
															<?php
															echo  $vvMachine->vv_machine_condition;
															?>
														</td>
														<td data-title="Order #">
															<?php
															echo  $vvMachine->vv_product_name;
															?>
														</td>
														<td data-title="Order #">
															<?php
															echo  $vvMachine->vv_category;
															?>
														</td>
														<td data-title="Order #">
															<?php
															echo  $vvMachine->vv_sub_category;
															?>
														</td>
													</tr>
												<?php endforeach;?>
												</tbody>
											</table>
											<h1> <?php echo $links;?></h1>
										<?php else: ?>
											<?php no_data('alert-info','The ' . $this->uri->segment(2) . 'is not available'); ?>
										<?php endif?>
									</div>
								</div>
							</section>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
