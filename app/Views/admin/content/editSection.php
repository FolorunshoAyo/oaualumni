


<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left"> Edit section</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">New page</li>
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
                        <span>Page Name</span><span class="red">*</span>
                        <?php
                        $form =  array(
                            'id'=>'ctadx',
                        );
                        echo form_open_multipart('admin/update-section',$form);
                        echo form_input('sectionName',$section[0]['ss_title'],array('class'=>'form-control','placeholder'=>'Please Add section name'));
                        ?>
                        <input type="hidden" value="<?php echo $section[0]['ss_id'] ?>" name="xeew">
                    </div>
                    <div class="form-group">
                        <span>Message</span><span class="red">*</span>
                        <?php
                        echo form_textarea('sectionBody',base64_decode($section[0]['ss_body']),
                            array('id'=>'elm1','placeholder'=>'Enter the Detail','class'=>'form-control')
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
                                    if ($Mylanguages->num_rows() >  0):
                                        $languagesOptions = array() ;
                                        foreach ($Mylanguages->result() as $language) {
                                            $languagesOptions[$language->id]=$language->language;
                                        }
                                        ?>
                                        <label>Select Language:</label><span class="red">*</span>
                                        <?php  echo  form_dropdown('language',$languagesOptions,$section[0]['language_id'],array('class'=>'form-control'));
                                        ?>
                                    <?php else: ?>
                                        Please add the language first to <a href="<?php echo site_url('admin/new-language skzmsubmbtn')?>">insert</a>  the about us section
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    if (!empty($section[0]['ss_status']) || $section[0]['ss_status'] == 0):
                                        $status = array() ;
                                        $status['0'] = 'Disable';
                                        $status['1']= 'Active';
                                        ?>
                                        <label>Status:</label> </label><span class="red">*</span>
                                        <?php  echo  form_dropdown('status',$status,$section[0]['ss_status'],array('class'=>'form-control'));
                                        ?>
                                    <?php else: ?>
                                        The status is not available please try again.
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <?php echo form_submit('maker','Update','class="btn btn-primary skzmsubmbtn"'); ?>
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
                                <a data-toggle="collapse" data-parent="#accordion1" href="#bg-defaultx"><i class="mdi mdi-minus"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div id="bg-defaultx" class="panel-collapse collapse in show">
                            <div class="portlet-body">
                                <div class="form-group">
                                    <?php
                                    echo form_input('buttonText',$section[0]['ss_button_text'],array('class'=>'form-control','placeholder'=>'Button text'));
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    echo form_input('buttonUrl',$section[0]['ss_button_url'],array('class'=>'form-control','placeholder'=>'Button URL'));
                                    ?>
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

