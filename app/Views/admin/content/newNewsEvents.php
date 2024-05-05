<div class="content">

    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">New News/Event</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
            <li class="active">News/Event</li>
        </ol>

    </div>
    <!-- End Page Header -->




    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START CONTAINER -->
    <div class="container-padding skzMconWhite">
        <div class="row ">
            <div class="col-md-8 m_cont_top">
                <?php  echo checkFlash();?>
                <div class="cierrors">
                    <?php
                    $validation = \Config\Services::validation();
                    echo $validation->listErrors();
                    ?>
                </div>

                <div class="form-group">
                    <span>Name</span><span class="red">*</span>
                    <?php
                    $form =  array(
                        'id'=>'ctadx',
                    );
                    echo form_open_multipart('admin/add-news-and-event',$form);
                    echo form_input('title','',array('class'=>'form-control','placeholder'=>'Please add title'));
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
                <?php if($category === "events"): ?>
                <div class="form-group">
                    <span>Location</span><span class="red">*</span>
                    <?php
                    echo form_input('location','',array('class'=>'form-control','placeholder'=>'Please Add Location'));
                    ?>
                    <input type="hidden" value="events" name="catetypee">
                </div>
                <?php else: ?>
                    <input type="hidden" value="news" name="catetypee">
                <?php endif; ?>
                <div class="form-group">
                    <span>News or Event Body</span><span class="red">*</span>
                    <?php
                    echo form_textarea('description','',
                        array('id'=>'elm1','placeholder'=>'Enter your news or events','class'=>'form-control')
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
                                <?php
                                $newsOREvent = array() ;
                                $newsOREvent['news'] = 'News';
                                $newsOREvent['events'] = 'Events';
                                ?>
                                <label>Select Category:</label> <span class="red">*</span>
                                <?php  echo  form_dropdown('category',$newsOREvent,$category,array('class'=>'form-control'));
                                ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_submit('data','Add Now','class="btn btn-primary skzmsubmbtn"'); ?>
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
                                    Select image
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
    <!-- END CONTAINER -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->

</div>
