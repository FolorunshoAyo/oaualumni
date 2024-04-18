<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid skzMconWhite">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">What We Do</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active">What We Do</li>
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

                        <?php if ($allHomeSection):?>
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <!--<th>Delete</th>-->
                                </tr>
                                </thead>


                                <tbody>
                                <?php foreach($allHomeSection as $homeSection):?>
                                    <tr class="gmi<?php echo $homeSection['hs_id']?>">
                                        <td data-title="Order #">
                                            <?php echo $homeSection['hs_id']?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php echo $homeSection['hs_title']?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php echo base64_decode($homeSection['hs_body'])?>
                                        </td>


                                        <td data-title="Order #">
                                            <?php if($homeSection['hs_status'] == 0): ?>
                                                <button class="btn btn-danger">Disabled</button>
                                            <?php else: ?>
                                                <button class="btn btn-success">active</button>
                                            <?php endif;?>
                                        </td>

                                        <td data-title="Order #">
                                            <?php echo $homeSection['hs_date']?>
                                        </td>
                                        <td data-title="Order #">
                                            <a  href="<?php echo site_url('admin/edit-about-section/'.$homeSection['hs_id']); ?>" class="btn btn-primary skzslimnew">
                                                Edit
                                            </a>
                                        </td>

                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <?php no_data('alert-info','What We Do section is  not available')?>
                        <?php endif?>
                    </div>
                </div>
            </div> <!-- end row -->



            <!-- end row -->


        </div> <!-- container -->

    </div>
</div>
