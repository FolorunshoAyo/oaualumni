<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid skzMconWhite">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">New Zoom Meeting</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">Create a New Zoom Meeting</li>
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
                        <span>Meeting Name</span><span class="red">*</span>
                        <?php
                        $form =  array(
                            'id'=>'ctadx',
                        );
                        echo form_open_multipart('admin/add-zoom-meeting',$form);
                        echo form_input('name','',array('class'=>'form-control','placeholder'=>'Please Add Meeting Name'));
                        ?>

                    </div>
                    <div class="form-group">
                        <span>Short Description</span><span class="red">*</span>
                        <?php
                        echo form_textarea('short_desc','',
                            array('placeholder'=>'Enter a brief description to show on listings page (255 characters max)','class'=>'form-control', 'maxlength' => '255', 'rows' => '2')
                        );
                        ?>

                    </div>
                    <div class="form-group">
                        <span>Duration (minutes)</span><span class="red">*</span>
                        <?php
                        echo form_input('duration','',array('class'=>'form-control','placeholder'=>'Please Add Meeting Duration in Minutes'), 'number');
                        ?>

                    </div>
                    <div class="form-group">
                        <span>Timezone</span><span class="red">*</span>
                        <?php
                            echo form_dropdown('timezone',$timezones,array_search("UTC",$timezones), array('class'=>'form-control'));
                        ?>
                    </div>
                    <div class="form-group">
                        <span>Meeting Password</span><span class="red">*</span>
                        <?php
                            echo form_input('password','',array('class'=>'form-control','placeholder'=>'Please Meeting Password'));
                        ?>

                    </div>
                    <div class="form-group">
                        <span>Start Date</span><span class="red">*</span>
                        <?php
                        echo form_input('stdate','',array('class'=>'form-control datetimeInput','placeholder'=>'Select Start Date'), 'datetime-local');
                        ?>
                    </div>
                </div>
                <div class="col-md-4 m_cont_top">
                    <div class="portlet">
                        <div class="portlet-heading portlet-default">
                            <h3 class="portlet-title text-dark">
                                Extra Configurations
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
                                        echo form_checkbox('host_video', '', FALSE, 'style="vertical-align: middle;"');
                                    ?>
                                    <span>Enable Host Video</span>
                                </div>
                                <div class="form-group">
                                    <?php
                                        echo form_checkbox('participant_video', '', FALSE, 'style="vertical-align: middle;"');
                                    ?>
                                    <span>Enable Participant Video</span>
                                </div>
                                <div class="form-group">
                                    <?php
                                        echo form_checkbox('join_before_host', '', FALSE, 'style="vertical-align: middle;"');
                                    ?>
                                    <span>Allow Join Before Host</span>
                                </div>
                                <div class="form-group">
                                    <span>Auto Recording</span><span class="red">*</span>
                                    <?php
                                        $recording_types = array() ;
                                        $recording_types['none'] = 'None';
                                        $recording_types['local']= 'Local';
                                        $recording_types['cloud']= 'Cloud';
                                        echo form_dropdown('auto_recording',$recording_types,'', array('class'=>'form-control'));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="portlet">
                        <div class="portlet-heading portlet-default">
                            <h3 class="portlet-title text-dark">
                                Publish Zoom Meeting
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
                                    <?php echo form_submit('slide','Add Zoom Meeting','class="btn btn-primary skzmsubmbtn"'); ?>
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

