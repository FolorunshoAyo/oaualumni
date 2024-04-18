
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Album</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">Edit Album</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-md-6  m_cont_top">
                    <?php  echo checkFlash();?>
                    <?php echo validation_errors(); ?>
                    <div class="form-group">
                        <span>Album Name</span> <label class="red">*</label>
                        <?php
                        $form =  array(
                            'id'=>'ctadx',
                        );
                        echo form_open_multipart('admin/update-album',$form);
                        echo form_input('album',$album[0]['gl_name'],array('class'=>'form-control','placeholder'=>'Please Add album Name'));
                        ?>

                    </div>
                    <input type="hidden" name="xdi" value="<?php echo $album[0]['gl_id']?>" class="">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <?php
                                if (!empty($album[0]['gl_status']) || $album[0]['gl_status'] == 0):
                                    $status = array() ;
                                    $status['0'] = 'Disable';
                                    $status['1']= 'Active';
                                    ?>
                                    <label>Status:</label> <label class="red">*</label>
                                    <?php  echo  form_dropdown('status',$status,$album[0]['gl_status'],array('class'=>'form-control'));
                                    ?>
                                <?php else: ?>
                                    The status is not available please try again.
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo form_submit('maker','Update','class="btn btn-primary"'); ?>
                    </div>
                    <div class="cf_r">

                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
