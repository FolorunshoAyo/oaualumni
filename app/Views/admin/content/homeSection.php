



<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Pages</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active">Pages</li>
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
                                    <th>Name</th>
                                    <th>Message</th>
                                    <th>Language</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>


                                <tbody>
                                <?php foreach($allHomeSection as $homeSection):?>
                                    <tr class="gmi<?php echo $homeSection->hs_id?>">
                                        <td data-title="Order #">
                                            <?php echo $homeSection->hs_id?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php echo $homeSection->hs_title?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php echo base64_decode($homeSection->hs_body)?>
                                        </td>

                                        <td data-title="Order #">
                                            <?php echo strtoupper($homeSection->language)?>
                                        </td>

                                        <td data-title="Order #">
                                            <?php if($homeSection->hs_status == 0): ?>
                                                <button class="btn btn-danger">Disabled</button>
                                            <?php else: ?>
                                                <button class="btn btn-success">active</button>
                                            <?php endif;?>
                                        </td>

                                        <td data-title="Order #">
                                            <?php echo $homeSection->sl_date?>
                                        </td>
                                        <td data-title="Order #">
                                            <a  href="<?php echo site_url('admin/edit-slide/'.$homeSection->sl_id); ?>" class="btn btn-primary skzslimnew">
                                                Edit
                                            </a>
                                        </td>
                                        <td data-title="Order #">
                                            <a  href="javascript:void(0)" class="btn btn-danger slidemyDrop" data-text="<?php echo site_url('admin/delete-slide/'.$homeSection->sl_id.'/'.$homeSection->sl_dp); ?>">
                                                Delete
                                            </a>
                                        </td>
                                        </td>

                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <?php no_data('alert-info','s not available')?>
                        <?php endif?>
                    </div>
                </div>
            </div> <!-- end row -->



            <!-- end row -->


        </div> <!-- container -->

    </div>
</div>
