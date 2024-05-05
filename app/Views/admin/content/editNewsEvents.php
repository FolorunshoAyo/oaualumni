
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title float-left"> Edit News/Event</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                        <li class="breadcrumb-item active">Edit News/Event</li>
                    </ol>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
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
                    echo form_open_multipart('admin/update-news-and-event',$form);
                    echo form_input('title',$events[0]['ne_title'],array('class'=>'form-control','placeholder'=>'Please add title'));
                    ?>
                    <input type="hidden" value="<?php echo $events[0]['ne_id'] ?>" name="xeew">
                    <input type="hidden" value="<?php echo $events[0]['ne_dp'] ?>" name="dimgo">
                </div>
                <div class="form-group">
                    <span>Meta Description</span><span class="red">*</span>
                    <?php
                    echo form_textarea('short_desc',$events[0]['ne_short_description'],
                        array('placeholder'=>'Enter a brief description to show on listings page (255 characters max)','class'=>'form-control', 'maxlength' => '255', 'rows' => '2')
                    );
                    ?>

                </div>
                <?php if($category === "events"): ?>
                <div class="form-group">
                    <span>Location</span><span class="red">*</span>
                    <?php
                    echo form_input('location',$events[0]['ne_location'],array('class'=>'form-control','placeholder'=>'Please Add Location'));
                    ?>
                    <input type="hidden" value="events" name="catetypee">
                </div>
                <?php else: ?>
                    <input type="hidden" value="news" name="catetypee">
                <?php endif; ?>
                <div class="form-group">
                    <span>News or Even Body</span><span class="red">*</span>
                    <?php
                    echo form_textarea('description',base64_decode($events[0]['ne_description']),
                        array('id'=>'elm1','placeholder'=>'Enter your news or events','class'=>'form-control')
                    );
                    ?>
                </div>
                <div class="cf_r">

                </div>
            </div>
            <div class="col-md-4  dhpnl">
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
                                $newsOREvent = array() ;
                                $newsOREvent['news'] = 'News';
                                $newsOREvent['events'] = 'Events';
                                ?>
                                <label>Select Category:</label> <span class="red">*</span>
                                <?php  echo  form_dropdown('category',$newsOREvent,$category,array('class'=>'form-control'));
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                if (!empty($events[0]['ne_status']) || $events[0]['ne_status'] == 0):
                                    $status = array() ;
                                    $status['0'] = 'Disable';
                                    $status['1']= 'Active';
                                    ?>
                                    <label>Status:</label>  <span class="red">*</span>
                                    <?php  echo  form_dropdown('status',$status,$events[0]['ne_status'],array('class'=>'form-control'));
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
                                <div class="gmiivd">
                                    <?php
                                    $addImage=null;
                                    $ResmoveImage=null;
                                    if (file_exists(realpath(APPPATH . '../public/assets/images/newsEvents/').'/'.$events[0]['ne_dp'])) {
                                        $addImage = "dispnn";

                                    }
                                    else{
                                        $ResmoveImage = "dispnn";
                                    }
                                    ?>
                                    <a  class="btn btn-default xiy <?php echo $addImage;?>" href="javascript:void(0)" onclick="document.getElementById('fileID').click(); return false;" >
                                        Select image
                                    </a>

                                    <div class="previmg">
                                        <img src="<?php echo base_url('public/assets/images/newsEvents/'.$events[0]['ne_dp']); ?>" class="img-fluid img-responsive">
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
