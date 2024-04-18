<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left"> Edit Alumni (<?= $alumni[0]['al_full_name'] ?>)</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">Edit Alumni</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md- m_cont_top">
                    <?php  echo checkFlash();?>
                    <div class="cierrors">
                        <?php echo getListErrors(); ?>
                    </div>
                    <div class="form-group">
                        <span>Name</span><span class="red">*</span>
                        <?php
                        $form =  array(
                            'id'=>'ctadx',
                        );
                        echo form_open_multipart('admin/update-alumni',$form);
                        echo form_input('name',$alumni[0]['al_full_name'],array('class'=>'form-control','placeholder'=>'Please Add Title'));
                        ?>
                        <input type="hidden" value="<?php echo $alumni[0]['al_id'] ?>" name="xeew">
                        <input type="hidden" value="<?php echo $alumni[0]['al_profile_image'] ?>" name="dimgo">
                    </div>
                    <div class="form-group">
                        <span>Batch Year</span><span class="red">*</span>
                        <?php
                        echo form_input('year',$alumni[0]['al_batch_year'],array('class'=>'form-control','placeholder'=>'Please Add Post'));
                        ?>

                    </div>
                    <div class="form-group">
                        <span>Major</span><span class="red">*</span>
                        <?php
                        echo form_input('major',$alumni[0]['al_major'],array('class'=>'form-control','placeholder'=>'Please Add Major'));
                        ?>

                    </div>
                    <div class="form-group">
                        <span>Occupation</span><span class="red">*</span>
                        <?php
                        echo form_input('occupation',$alumni[0]['al_occupation'],array('class'=>'form-control','placeholder'=>'Please Add Current Occupation'));
                        ?>
                    </div>
                    <div class="form-group">
                        <span>Company</span><span class="red">*</span>
                        <?php
                        echo form_input('company',$alumni[0]['al_company'],array('class'=>'form-control','placeholder'=>'Please Add Current Company'));
                        ?>
                    </div>
                    <div class="form-group">
                        <span>Location</span><span class="red">*</span>
                        <?php
                        echo form_input('location',$alumni[0]['al_location'],array('class'=>'form-control','placeholder'=>'Please Add Location'));
                        ?>

                    </div>
                    <div class="form-group">
                        <span>Bio</span><span class="red">*</span>
                        <?php
                        echo form_textarea('bio',$alumni[0]['al_bio'],
                            array('placeholder'=>'Enter a brief bio text','class'=>'form-control')
                        );
                        ?>

                    </div>
                    <!-- <div class="form-group">
                        <span>Description/Content</span><span class="red">*</span>
                        <?php
                        // echo form_textarea('text',base64_decode($alumni[0]['hi_body']),
                        //     array('id'=>'elm1','placeholder'=>'Enter the text','class'=>'form-control')
                        // );
                        ?>
                    </div> -->  
                    <div class="portlet">
                        <div class="portlet-heading portlet-default">
                            <h3 class="portlet-title text-dark">
                                Featured Image
                            </h3>
                            <div class="portlet-widgets">
                                <a data-toggle="collapse" data-parent="#accordion12" href="#accordion12"><i class="mdi mdi-minus"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div id="accordion12" class="panel-collapse collapse in show">
                            <div class="portlet-body">
                                <div class="form-group">
                                    <?php echo form_upload('image','',
                                        array('class'=>'tp_3','id'=>'fileID','style'=>'display: none')
                                    )?>
                                    <a style="display: none"   class="btn btn-default xiy" href="javascript:void(0)" onclick="document.getElementById('fileID').click(); return false;" >
                                        Add image
                                    </a>
                                    <div class="previmg">
                                        <img src="<?php echo base_url('public/assets/images/alumni/'.$alumni[0]['al_profile_image']); ?>" class="img-fluid img-responsive">
                                        <a href="javascript:void(0)" class="cntimg">Remove Image</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group d-flex align-items-center">
                        <?php
                            // echo form_checkbox('is_featured', '', FALSE, 'class="form-controll"style="vertical-align: middle;"');
                        ?>
                        <span>Set Featured</span>
                    </div> -->
                    <div class="form-group">
                        <?php
                        if (!empty($alumni[0]['al_featured']) || $alumni[0]['al_featured'] == 0):
                            $status = array() ;
                            $status['0'] = 'No';
                            $status['1']= 'Yes';
                            ?>
                            <label>Set Featured:</label> </label><span class="red">*</span>
                            <?php  echo  form_dropdown('al_featured',$status,$alumni[0]['al_featured'],array('class'=>'form-control'));
                            ?>
                        <?php else: ?>
                            The set featured checkbox is not available please try again.
                        <?php endif; ?>
                    </div>
                    <div class="portlet">
                        <div class="portlet-heading portlet-default">
                            <h3 class="portlet-title text-dark">
                                Edit Alumni
                            </h3>
                            <div class="portlet-widgets">
                                <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default"><i class="mdi mdi-minus"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div id="bg-default" class="panel-collapse collapse in show">
                            <div class="portlet-body">
                                <div class="form-group">
                                    <?php echo form_submit('slide','Update','class="btn btn-primary skzmsubmbtn"'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cf_r">

                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
