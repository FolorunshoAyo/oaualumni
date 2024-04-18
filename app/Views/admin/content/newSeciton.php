<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left"> Add new section</h4>
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
                    <?php  echo checkFlash();?>
                    <div class="cierrors">
                        <?php echo getListErrors(); ?>
                    </div>
                    <div class="form-group">
                        <span>Page Name</span><span class="red">*</span>
                        <?php
                        $form =  array(
                            'id'=>'ctadx',
                        );
                        echo form_open_multipart('admin/add-section',$form);
                        echo form_input('sectionName','',array('class'=>'form-control','placeholder'=>'Please Add section name'));
                        ?>

                    </div>
                    <div class="form-group">
                        <span>Message</span><span class="red">*</span>
                        <?php
                        echo form_textarea('sectionBody','',
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

                                </div>
                                <div class="form-group">
                                    <?php echo form_submit('maker','Add','class="btn btn-primary skzmsubmbtn"'); ?>
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
                                          echo form_input('buttonText','',array('class'=>'form-control','placeholder'=>'Button text'));
                                        ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    echo form_input('buttonUrl','',array('class'=>'form-control','placeholder'=>'Button URL'));
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
