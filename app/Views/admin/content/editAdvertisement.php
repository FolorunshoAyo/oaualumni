

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Banner</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">Edit Banner</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-8 m_cont_top">
                    <?php  checkFlash();?>
                    <div class="cierrors">
                        <?php echo validation_errors(); ?>
                    </div>

                    <div class="form-group">
                        <span>Name</span><span class="red">*</span>
                        <?php
                        $form =  array(
                            'id'=>'ctadx',
                        );
                        echo form_open_multipart('admin/update-advertisement',$form);
                        echo form_input('advertisement_title',$advertisement[0]['ad_title'],array('class'=>'form-control','placeholder'=>'Please add title'));
                        ?>

                    </div>
                    <div class="form-group">
                        <span>Message</span><span class="red">*</span>
                        <?php
                        echo form_input('advertisement_url',$advertisement[0]['ad_url'],array('class'=>'form-control','placeholder'=>'Please add URL'));
                        ?>
                    </div>
                    <div class="cf_r">

                    </div>
                </div>
                <div class="col-md-4 m_cont_top dhpnl">
                    <div class="portlet">
                        <div class="portlet-heading portlet-default">
                            <h3 class="portlet-title text-dark">
                                Publish
                            </h3>
                            <div class="portlet-widgets">
                                <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default"><i class="mdi mdi-minus"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div id="bg-default" class="panel-collapse collapse in show">
                            <div class="portlet-body">
                                <div class="form-group">
                                    <?php
                                    if (!empty($advertisement[0]['ad_status']) || $advertisement[0]['ad_status'] == 0):
                                        $status = array() ;
                                        $status['0'] = 'Disable';
                                        $status['1']= 'Active';
                                        ?>
                                        <label>Status:</label> <span class="red">*</span>
                                        <?php  echo  form_dropdown('status',$status,$advertisement[0]['ad_status'],array('class'=>'form-control'));
                                        ?>
                                    <?php else: ?>
                                        The status is not available please try again.
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <?php echo form_submit('banner','update','class="btn btn-primary skzmsubmbtn"'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <input type="hidden" value="<?php echo $advertisement[0]['ad_id'] ?>" name="xeew">
                                    <input type="hidden" value="<?php echo $advertisement[0]['ad_dp'] ?>" name="dimgo">
                                    <div class="gmiivd">
                                        <?php
                                        $addImage=null;
                                        $ResmoveImage=null;
                                        if (file_exists(realpath(APPPATH . '../assets/images/advertisements/').'/'.$advertisement[0]['ad_dp'])) {
                                            $addImage = "dispnn";

                                        }
                                        else{
                                            $ResmoveImage = "dispnn";
                                        }
                                        ?>
                                        <a  class="btn btn-default xiy <?php echo $addImage;?>" href="javascript:void(0)" onclick="document.getElementById('fileID').click(); return false;" >
                                            Add image
                                        </a>

                                        <div class="previmg">
                                            <img src="<?php echo base_url('assets/images/advertisements/'.$advertisement[0]['ad_dp']); ?>" class="img-fluid">
                                            <br>
                                            <a href="javascript:void(0)" class="cntimg <?php echo $ResmoveImage;?>">Remove Image</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

