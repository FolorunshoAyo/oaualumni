<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid skzMconWhite">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Donations</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">Create a New Donation</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-12 m_cont_top">
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
                        echo form_open_multipart('admin/add-donation',$form);
                        echo form_input('name','',array('class'=>'form-control','placeholder'=>'Please Add Project Name'));
                        ?>

                    </div>
                    <div class="form-group">
                        <span>Meta Description</span><span class="red">*</span>
                        <?php
                        echo form_textarea('short_desc','',
                            array('placeholder'=>'Enter a brief description to show on listings page (255 characters max)','class'=>'form-control', 'maxlength' => '255', 'rows' => '2')
                        );
                        ?>

                    </div>
                    <div class="form-group">
                        <span>Target Amount (in $USD)</span><span class="red">*</span>
                        <?php
                        echo form_input('target_amount','',array('class'=>'form-control','placeholder'=>'Enter a target amount in dollars'), 'number');
                        ?>

                    </div>
                    <div class="form-group">
                        <span>Location</span><span class="red">*</span>
                        <?php
                        echo form_input('location','',array('class'=>'form-control','placeholder'=>'Please Add Location'));
                        ?>

                    </div>
                    <div class="form-group">
                        <span>Description/Content</span><span class="red">*</span>
                        <?php
                        echo form_textarea('desc','',
                            array('id'=>'elm1','placeholder'=>'Enter group description','class'=>'form-control')
                        );
                        ?>
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
                    <div class="portlet">
                        <div class="portlet-heading portlet-default">
                            <h3 class="portlet-title text-dark">
                                Publish Donation
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
                                    <?php echo form_submit('slide','Add Donation','class="btn btn-primary skzmsubmbtn"'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-4 m_cont_top dhpnl">
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
                                    <?php echo form_submit('slide','Add','class="btn btn-primary skzmsubmbtn"'); ?>
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
                </div> -->
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

