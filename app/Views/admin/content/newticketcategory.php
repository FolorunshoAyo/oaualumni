<div class="content">

    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">Promotions</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
            <li class="active">New Ticket Category</li>
        </ol>


    </div>
    <!-- End Page Header -->



    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START CONTAINER -->
    <div class="container-padding">
        <!-- Start Row -->
        <div class="row">
            <div class="form-group" style="margin-left:50px;">
                <h1>New Ticket Category</h1>
            </div>
            <div class="col-md-10 col-md-offset-1 m_cont_top">
                <div class="sinerror">
                    <?php echo validation_errors(); ?>
                </div>
                <div class="form-group">
                    <?php echo checkFlash();?>
                </div>
                <?php
                $farr = array('id' => 'x_b_s' );
                echo form_open_multipart('admin/addticketCategory',$farr);
                ?>
                <div class="form-group">
                    <span class="">Status<span class="red">*</span></span>
                    <?php
                    $englishStatus = array(
                        '1'=>'Active',
                        '2'=>'Pending',
                    );
                    echo form_dropdown('status',$englishStatus, set_value('status'),array('class'=>'form-control'));
                    ?>
                </div>
                <div class="row">
                    <div  class="col-md-6">
                        <div class="form-group">
                            <span class="">Title<span class="red">*</span></span>
                            <?php
                            $catname = array(
                                'name' =>'cat_name',
                                'class' =>'form-control',
                                'placeholder' =>'Category Name',
                                'id' =>'b_name',
                                'value' =>set_value('cat_name'),
                            );
                            echo form_input($catname);
                            ?>
                        </div>
                    </div>
                    <div  class="col-md-6">
                        <div class="form-group">
                            <span class="">Slug/URL<span class="red">*</span></span>
                            <span class="edturl pull-right">Edit</span>
                            <?php
                            $bUrl = array(
                                'name' =>'cat_url',
                                'class' =>'form-control',
                                'placeholder' =>'Category URL',
                                'id' =>'b_url',
                                'readonly' =>'readonly',
                                'value' =>set_value('cat_url'),
                            );
                            echo form_input($bUrl);
                            ?>
                        </div>
                    </div>
                </div>




                <div class="control-group">
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
        <!-- End Row -->



    </div>
    <!-- END CONTAINER -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->


</div>
