<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid skzMconWhite">
            
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left"><?php echo 'Contributors to (' . $project[0]['project_name'] . ')' ?></h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>">Admin</a></li>
                            <li class="breadcrumb-item active">Interest Group Members <?php echo '(' . $project[0]['project_name'] . ')' ?></li>
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

                        <?php if ($allContributors):?>
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Amount Contributed</th>
                                    <th>Donated at</th>
                                </tr>
                                </thead>


                                <tbody>
                                <?php foreach($allContributors as $contributor):?>
                                    <tr class="gmi<?php echo $contributor['donation_id']?>">
                                        <td data-title="Order #">
                                            <?php echo $contributor['donation_id']?>
                                        </td>
                                        <td data-title="Order #">
                                            <div style="display: flex; align-items: center; width: fit-content;">
                                                <?php if($contributor['u_dp'] !== null): ?>
                                                    <img src="<?php echo base_url('public/assets/images/users/'.$contributor['u_dp']);?>" alt="Group Image" style="width: 50px; height: 50px; margin-inline-end: 5px; border-radius: 50%;">
                                                <?php endif; ?>
                                                <div style="display: inline-block; vertical-align: bottom;">
                                                    <h6 style="margin:0;line-height:1;"><?php echo $contributor['last_name'] . " " . $contributor['first_name'] ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-title="Order #">   
                                            <?php 
                                                echo $contributor['email'];
                                            ?>
                                        </td>
                                        <td data-title="Order #">   
                                            <?php 
                                                echo $contributor['phone'];
                                            ?>
                                        </td>
                                        <td data-title="Order #">   
                                            <?php 
                                                echo $contributor['amount'];
                                            ?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php echo $contributor['donation_date']?>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <?php no_data('alert-info','This Donation does not have any contributors') ?>
                        <?php endif?>
                    </div>
                    <?php echo $pager->links(); ?>
                </div>
            </div> <!-- end row -->



            <!-- end row -->


        </div> <!-- container -->

    </div>
</div>