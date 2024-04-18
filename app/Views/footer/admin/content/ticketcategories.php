<div class="content">

    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">All Categories</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
            <li class="active">All Categories</li>
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
                <div class="form-group">
                    <?php echo checkFlash(); ?>
                </div>
                <div class="panel panel-default">
                    <div class="panel-title">
                        All Categories
                    </div>
                    <div class="panel-body table-responsive">
                        <?php if ($allTicCategories):?>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <!--<td class="text-center"><i class="fa fa-trash"></i></td>-->
                                    <td>ID</td>
                                    <td>Title</td>
                                    <td>Date</td>
                                    <td>Admin</td>
                                    <td>Status</td>
                                    <td>Edit</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($allTicCategories as $tic_Category):?>
                                    <tr>
                                        <!--										<td class="text-center"><div class="checkbox margin-t-0"><input id="checkbox1" type="checkbox"><label for="checkbox1"></label></div></td>-->
                                        <td># <b><?php echo $tic_Category['tic_id']?></b></td>
                                        <td><?php echo $tic_Category['tic_name']?></td>
                                        <!--<td><?php /*echo base64_decode($myPromotion['promotion'])*/?></td>-->
                                        <td><?php echo $tic_Category['tic_date']?></td>
                                        <td><?php
                                                $adminData = getAdminData($tic_Category['admin_id']);
                                                echo $adminData[0]['aName'];
                                                ?>
                                        </td>
                                        <td>
                                            <?php if ($tic_Category['tic_status']==1): ?>
                                                <button class="btn btn-success">
                                                    Active
                                                </button>
                                            <?php else: ?>
                                                <button class="btn btn-danger">
                                                    Disabled
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(isSuperAdmin()): ?>
                                                <a  href="<?php echo site_url('admin/editticcategory/'.$tic_Category['tic_id']); ?>" class="btn btn-primary">
                                                    Edit
                                                </a>
                                            <?php else:?>
                                                Not Allowed
                                            <?php endif; ?>
                                        </td>

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
