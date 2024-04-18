<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left"> Edit Slider</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">Edit Slider</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-8 m_cont_top">
                    <?php  echo checkFlash();?>
                    <div class="cierrors">
                        <?php echo getListErrors(); ?>
                    </div>
                    <div class="form-group">
                        <span>Slider Title</span><span class="red">*</span>
                        <?php
                        $form =  array(
                            'id'=>'ctadx',
                        );
                        echo form_open_multipart('admin/update-slider',$form);
                        echo form_input('title',$HIT[0]['sl_title'],array('class'=>'form-control','placeholder'=>'Please Add Title'));
                        ?>
                        <input type="hidden" value="<?php echo $HIT[0]['sl_id'] ?>" name="xeew">
                        <input type="hidden" value="<?php echo $HIT[0]['sl_dp'] ?>" name="dimgo">
                    </div>
                    <div class="form-group">
                        <span>Slider Description/Content</span><span class="red">*</span>
                        <?php
                        echo form_textarea('text',base64_decode($HIT[0]['sl_description']),
                            array('id'=>'elm1','placeholder'=>'Enter the text','class'=>'form-control')
                        );
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
                                    if (!empty($HIT[0]['sl_status']) || $HIT[0]['sl_status'] == 0):
                                        $status = array() ;
                                        $status['0'] = 'Disable';
                                        $status['1']= 'Active';
                                        ?>
                                        <label>Status:</label> </label><span class="red">*</span>
                                        <?php  echo  form_dropdown('status',$status,$HIT[0]['sl_status'],array('class'=>'form-control'));
                                        ?>
                                    <?php else: ?>
                                        The status is not available please try again.
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <?php echo form_submit('slide','Update','class="btn btn-primary skzmsubmbtn"'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="portlet">
                        <div class="portlet-heading portlet-default">
                            <h3 class="portlet-title text-dark">
                                Button Setting
                            </h3>
                            <div class="portlet-widgets">
                                <a data-toggle="collapse" data-parent="#accordion1" href="#bg-defaultsnd"><i class="mdi mdi-minus"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div id="bg-defaultsnd" class="panel-collapse collapse in show">
                            <div class="portlet-body">
                                <div class="form-group">
                                    <?php
                                    echo form_input('buttonText',$HIT[0]['sl_button_text'],array('class'=>'form-control','placeholder'=>'Button text'));
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    echo form_input('buttonUrl',$HIT[0]['sl_button_url'],array('class'=>'form-control','placeholder'=>'Button URL'));
                                    ?>
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
                                    <a style="display: none"   class="btn btn-default xiy" href="javascript:void(0)" onclick="document.getElementById('fileID').click(); return false;" >
                                        Add image
                                    </a>
                                    <div class="previmg">
                                        <img src="<?php echo base_url('public/assets/images/sliders/'.$HIT[0]['sl_dp']); ?>" class="img-fluid img-responsive">
                                        <a href="javascript:void(0)" class="cntimg">Remove Image</a>
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
