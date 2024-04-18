

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit City</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">Edit City</li>
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
                        echo form_open_multipart('admin/update-city',$form);
                        echo form_input('mycity',$cities[0]['ci_title'],array('class'=>'form-control','placeholder'=>'Please add category'));
                        ?>
                        <input type="hidden" value="<?php echo $cities[0]['ci_id'] ?>" name="xeew">
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
                                    <?php  echo  form_dropdown('status',$status,$cities[0]['ci_status'],array('class'=>'form-control'));
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php echo form_submit('maker','Update','class="btn btn-primary skzmsubmbtn"'); ?>
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
