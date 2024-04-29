<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid skzMconWhite">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Our Interest Groups</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>">Admin</a></li>
                            <li class="breadcrumb-item active">Our Interest Groups</li>
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

                        <?php if ($allGroups):?>
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Members</th>
                                    <th>Location</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>


                                <tbody>
                                <?php foreach($allGroups as $group):?>
                                    <tr class="gmi<?php echo $group['group_id']?>">
                                        <td data-title="Order #">
                                            <?php echo $group['group_id']?>
                                        </td>
                                        <td data-title="Order #">
                                            <div style="display: flex; align-items: center; width: fit-content;">
                                                <img src="<?php echo base_url('public/assets/images/interest_groups/'.$group['group_image']);?>" alt="<?php echo $group['group_name']?>" style="width: 50px; height: 50px; margin-inline-end: 5px; border-radius: 50%;">
                                                <div style="display: inline-block; vertical-align: bottom;">
                                                    <h6 style="margin:0;line-height:1;"><?php echo $group['group_name']?></h6>
                                                    <p style="margin:0;">
                                                        <?php
                                                            echo word_limiter($group['short_description'], 2);
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-title="Order #">   
                                            <?php 
                                                echo $group['description'];
                                            ?>
                                        </td>
                                        <td data-title="Order #">   
                                            <?php 
                                                echo $group['member_count'];
                                            ?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php 
                                                echo $group['group_location'];
                                            ?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php echo $group['created_at']?>
                                        </td>

                                        <td data-title="Order #">
                                            <a  href="<?php echo site_url('admin/edit-interest-group/'.$group['group_id']); ?>" class="btn btn-primary skzslimnew">
                                                Edit
                                            </a><br><br>
                                            <?php if($group['member_count'] > 0): ?>
                                            <a  href="<?php echo site_url('admin/view-group-members/'.$group['group_id']); ?>" class="btn btn-primary skzslimnew">
                                                View Members
                                            </a>
                                            <?php endif; ?>
                                        </td>
                                        <td data-title="Order #">
                                            <a  href="<?php echo site_url('admin/delete-interest-group/'.$group['group_id']); ?>" class="btn btn-danger albumDrop">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <?php no_data('alert-info','No Interest Groups has been created')?>
                        <?php endif?>
                    </div>
                </div>
                <?php echo $pager->links(); ?>
            </div> <!-- end row -->



            <!-- end row -->


        </div> <!-- container -->

    </div>
</div>
