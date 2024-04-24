<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid skzMconWhite">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">All Donation Causes</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>">Admin</a></li>
                            <li class="breadcrumb-item active">All Donations Causes</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <?php echo checkFlash(); ?>
                    </div>
                    <div class="card-box table-responsive">

                        <?php if ($allProjects):?>
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Amount Contributed</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>


                                <tbody>
                                <?php foreach($allProjects as $project):?>
                                    <tr class="gmi<?php echo $project['project_id']?>">
                                        <td data-title="Order #">
                                            <?php echo $project['project_id']?>
                                        </td>
                                        <td data-title="Order #">
                                            <div style="display: flex; align-items: center; width: fit-content;">
                                                <img src="<?php echo base_url('public/assets/images/project/'.$project['project_image']);?>" alt="<?php echo $project['group_name']?>" style="width: 50px; height: 50px; margin-inline-end: 5px; border-radius: 50%;">
                                                <div style="display: inline-block; vertical-align: bottom;">
                                                    <h6 style="margin:0;line-height:1;"><?php echo $project['project_name']?></h6>
                                                    <p style="margin:0;">
                                                        <?php
                                                            echo word_limiter($project['short_description'], 4);
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-title="Order #">   
                                            <?php 
                                                echo $project['description'];
                                            ?>
                                        </td>
                                        <td data-title="Order #">   
                                            <?php 
                                                echo "$" . number_format($project['current_amount'], 2) . " of $" . number_format($project['target_amount'], 2);
                                            ?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php if($project['status'] == 0): ?>
                                                <button class="btn btn-danger">Inactive</button>
                                            <?php elseif($project['status'] == 1): ?>
                                                <button class="btn btn-success">Active</button>
                                            <?php else: ?>
                                                <button class="btn btn-primary">Completed</button>
                                            <?php endif;?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php echo $group['created_at']; ?>
                                        </td>

                                        <td data-title="Order #">
                                            <a  href="<?php echo site_url('admin/edit-donation/'.$project['project_id']); ?>" class="btn btn-primary skzslimnew">
                                                Edit
                                            </a><br><br>
                                            <?php if($group['contributors'] > 0): ?>
                                            <a  href="<?php echo site_url('admin/view-contributors/'.$project['project_id']); ?>" class="btn btn-primary skzslimnew">
                                                View Contributors
                                            </a>
                                            <?php endif; ?>
                                        </td>
                                        <!-- <td data-title="Order #">
                                            <a  href="<?php echo site_url('admin/delete-donation/'.$project['project_id']); ?>" class="btn btn-danger albumDrop">
                                                Delete
                                            </a>
                                        </td> -->
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <?php no_data('alert-info','No Donations has been created')?>
                        <?php endif?>
                    </div>
                </div>
            </div> <!-- end row -->



            <!-- end row -->


        </div> <!-- container -->

    </div>
</div>
