

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Add new Advertisement</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">Add Advertisement</li>
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
                        echo form_open_multipart('admin/add-advertisement',$form);
                        echo form_input('advertisement_title','',array('class'=>'form-control','placeholder'=>'Please add title'));
                        ?>

                    </div>
                    <div class="form-group">
                        <span>URL</span><span class="red">*</span>
                        <?php
                        echo form_input('advertisement_url','',array('class'=>'form-control','placeholder'=>'Please add URL'));
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
                                    $status = array() ;
                                    $status['1']= 'Active';
                                    $status['0'] = 'Disable';
                                    ?>
                                    <label>Status:</label> <span class="red">*</span>
                                    <?php  echo  form_dropdown('status',$status,'',array('class'=>'form-control'));
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php echo form_submit('advertisement','Add','class="btn btn-primary skzmsubmbtn"'); ?>
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
                                    <a  class="btn btn-default xiy" href="javascript:void(0)" onclick="document.getElementById('fileID').click(); return false;" >
                                        Add image
                                    </a>
                                    <div class="previmg">
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

