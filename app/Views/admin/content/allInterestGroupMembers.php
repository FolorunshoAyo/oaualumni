<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid skzMconWhite">
            
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left"><?php echo 'Interest Group (' . $group[0]['group_name'] . ')' ?> Members</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>">Admin</a></li>
                            <li class="breadcrumb-item active">Interest Group Members <?php echo '(' . $group[0]['group_name'] . ')' ?></li>
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

                        <?php if ($allMembers):?>
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Date</th>
                                    <th>Remove</th>
                                </tr>
                                </thead>


                                <tbody>
                                <?php foreach($allMembers as $member):?>
                                    <tr class="gmi<?php echo $member['group_id']?>">
                                        <td data-title="Order #">
                                            <?php echo $member['group_id']?>
                                        </td>
                                        <td data-title="Order #">
                                            <div style="display: flex; align-items: center; width: fit-content;">
                                                <?php if($member['u_dp']): ?>
                                                    <img src="<?php echo base_url('public/assets/images/interest_groups/'.$group['group_image']);?>" alt="Group Image" style="width: 50px; height: 50px; margin-inline-end: 5px; border-radius: 50%;">
                                                <?php endif; ?>
                                                <div style="display: inline-block; vertical-align: bottom;">
                                                    <h6 style="margin:0;line-height:1;"><?php echo $member['u_last_name'] . " " . $member['u_first_name'] ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-title="Order #">   
                                            <?php 
                                                echo $member['u_email'];
                                            ?>
                                        </td>
                                        <td data-title="Order #">   
                                            <?php 
                                                echo $member['u_mobile'];
                                            ?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php echo $member['created_at']?>
                                        </td>
                                        <td data-title="Order #">
                                            <a  href="<?php echo site_url('admin/delete-interest-group-member/'. $member['group_id'] . '/member/' . $member['user_id']); ?>" class="btn btn-danger albumDrop">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <?php no_data('alert-info','This interest group does not have any members') ?>
                        <?php endif?>
                    </div>
                </div>
            </div> <!-- end row -->



            <!-- end row -->


        </div> <!-- container -->

    </div>
</div>