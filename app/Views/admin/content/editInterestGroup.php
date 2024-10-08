<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left"> Edit Interest Group (<?= $interestGroup[0]['group_name'] ?>)</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin/all-interest-groups')?>"> Interest Groups </a></li>
                            <li class="breadcrumb-item active">Edit Interest Group</li>
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
                        <span>Group Name</span><span class="red">*</span>
                        <?php
                        $form =  array(
                            'id'=>'ctadx',
                        );
                        echo form_open_multipart('admin/update-interest-group',$form);
                        echo form_input('name',$interestGroup[0]['group_name'],array('class'=>'form-control','placeholder'=>'Please Add Title'));
                        ?>
                        <input type="hidden" value="<?php echo $interestGroup[0]['group_id'] ?>" name="xeew">
                        <input type="hidden" value="<?php echo $interestGroup[0]['group_image'] ?>" name="dimgo">
                    </div>
                    <div class="form-group">
                        <span>Meta Description</span><span class="red">*</span>
                        <?php
                        echo form_textarea('short_desc',$interestGroup[0]['short_description'],
                            array('placeholder'=>'Enter a brief description to show on listings page','class'=>'form-control', 'maxlength' => '255', 'rows' => '2')
                        );
                        ?>

                    </div>
                    <div class="form-group">
                        <span>Description/Content</span><span class="red">*</span>
                        <?php
                        echo form_textarea('desc',$interestGroup[0]['description'],
                            array('id'=>'elm1','placeholder'=>'Enter group description','class'=>'form-control')
                        );
                        ?>
                    </div>
                    <div class="form-group">
                        <span>Location</span><span class="red">*</span>
                        <?php
                        echo form_input('location',$interestGroup[0]['group_location'],array('class'=>'form-control','placeholder'=>'Please Add Location'));
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
                                        <img src="<?php echo base_url('public/assets/images/interest_groups/'.$interestGroup[0]['group_image']); ?>" class="img-fluid img-responsive">
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
                    <div class="portlet">
                        <div class="portlet-heading portlet-default">
                            <h3 class="portlet-title text-dark">
                                Edit Interest Group
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
