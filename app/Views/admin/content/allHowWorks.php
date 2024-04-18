<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid skzMconWhite">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Our Leaders</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>">Admin</a></li>
                            <li class="breadcrumb-item active">Our Leaders</li>
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

                        <?php if ($allHowITWorks):?>
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Post</th>
                                    <th>Status</th>
                                    <th>Is Featured</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <!--<th>Delete</th>-->
                                </tr>
                                </thead>


                                <tbody>
                                <?php foreach($allHowITWorks as $myHIT):?>
                                    <tr class="gmi<?php echo $myHIT['hi_id']?>">
                                        <td data-title="Order #">
                                            <?php echo $myHIT['hi_id']?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php echo $myHIT['hi_name']?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php 
                                                // echo base64_decode($myHIT['hi_post'])
                                                echo $myHIT['hi_post'];
                                            ?>
                                        </td>

                                        <td data-title="Order #">
                                            <?php if($myHIT['hi_status'] == 0): ?>
                                                <button class="btn btn-danger">Disabled</button>
                                            <?php else: ?>
                                                <button class="btn btn-success">active</button>
                                            <?php endif;?>
                                        </td>

                                        <td data-title="Order #">
                                            <?php if($myHIT['hi_set_featured'] == 0): ?>
                                                <button class="btn btn-danger">No</button>
                                            <?php else: ?>
                                                <button class="btn btn-success">Yes</button>
                                            <?php endif;?>
                                        </td>

                                        <td data-title="Order #">
                                            <?php echo $myHIT['hi_date']?>
                                        </td>

                                        <td data-title="Order #">
                                            <a  href="<?php echo site_url('admin/edit-how-it-works/'.$myHIT['hi_id']); ?>" class="btn btn-primary skzslimnew">
                                                Edit
                                            </a>
                                        </td>

                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <?php no_data('alert-info','No Alumni has been created')?>
                        <?php endif?>
                    </div>
                </div>
            </div> <!-- end row -->



            <!-- end row -->


        </div> <!-- container -->

    </div>
</div>
