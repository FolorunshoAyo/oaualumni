<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid skzMconWhite">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Our Alumni</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>">Admin</a></li>
                            <li class="breadcrumb-item active">Our Alumni</li>
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

                        <?php if ($allAlumni):?>
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Profile</th>
                                    <th>Major</th>
                                    <th>Occupation</th>
                                    <th>Company</th>
                                    <th>Location</th>
                                    <th>Batch Year</th>
                                    <th>Is Featured</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <!--<th>Delete</th>-->
                                </tr>
                                </thead>


                                <tbody>
                                <?php foreach($allAlumni as $myAl):?>
                                    <tr class="gmi<?php echo $myAl['al_id']?>">
                                        <td data-title="Order #">
                                            <?php echo $myAl['al_id']?>
                                        </td>
                                        <td data-title="Order #">
                                            <div style="display: flex; align-items: center; width: fit-content;">
                                                <img src="<?php echo base_url('public/assets/images/alumni/'.$myAl['al_profile_image']);?>" alt="Profile Image" style="width: 50px; height: 50px; margin-inline-end: 5px; border-radius: 50%;">
                                                <div style="display: inline-block; vertical-align: bottom;">
                                                    <h6 style="margin:0;line-height:1;"><?php echo $myAl['al_full_name']?></h6>
                                                    <p style="margin:0;"><?php echo $myAl['al_bio']?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-title="Order #">   
                                            <?php 
                                                echo $myAl['al_major'];
                                            ?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php 
                                                echo $myAl['al_occupation'];
                                            ?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php 
                                                echo $myAl['al_company'];
                                            ?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php 
                                                echo $myAl['al_location'];
                                            ?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php 
                                                echo $myAl['al_batch_year'];
                                            ?>
                                        </td>

                                        <td data-title="Order #">
                                            <?php if($myAl['al_featured'] == 0): ?>
                                                <button class="btn btn-danger">No</button>
                                            <?php else: ?>
                                                <button class="btn btn-success">Yes</button>
                                            <?php endif;?>
                                        </td>

                                        <td data-title="Order #">
                                            <?php echo $myAl['al_created_at']?>
                                        </td>

                                        <td data-title="Order #">
                                            <a  href="<?php echo site_url('admin/edit-alumni/'.$myAl['al_id']); ?>" class="btn btn-primary skzslimnew">
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
                    <?php echo $pager->links(); ?>
                </div>
            </div> <!-- end row -->



            <!-- end row -->


        </div> <!-- container -->

    </div>
</div>
