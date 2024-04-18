
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid skzMconWhite">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Add Images in your Album</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">New Gallery Images</li>
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
            <?php echo form_open_multipart('admin/add-gallery-images')?>
            <?php echo form_upload('galleryImages[]','',
                array('class'=>'tp_3','id'=>'fileID','style'=>'display: none','multiple'=>'multiple')
            )?>
            <a  class="btn btn-default xiy" href="javascript:void(0)" onclick="document.getElementById('fileID').click(); return false;" >
                Select image
            </a>
        </div>


        <div class="form-group">
            <?php
            if (count($AllAlbums) >  0):
                $albumsOptions = array() ;
                foreach ($AllAlbums as $album) {
                    $albumsOptions[$album['gl_id']] = $album['gl_name'];
                }
                ?>
                <label>Select Album:</label><span class="red">*</span>
                <?php  echo  form_dropdown('album',$albumsOptions,'',array('class'=>'form-control'));
                ?>
            <?php else: ?>
                Please add the tender files first to <a href="<?php echo site_url('admin/new-tender')?>">insert</a>  the about us section
            <?php endif; ?>
        </div>

        <div class="form-group">
            <?php echo form_submit('maker','Upload','class="btn btn-primary"'); ?>
        </div>
        <div class="cf_r">

        </div>
        <?php echo form_close(); ?>
    </div>
</div>
        </div>
    </div>
</div>