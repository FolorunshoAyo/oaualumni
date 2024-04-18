

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit resource</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">Edit resource</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row m_cont_top">
                <div class="col-md-8 ">
                    <?php  checkFlash();?>
                    <div class="cierrors2">
                        <?php echo validation_errors(); ?>
                    </div>
                    <div class="form-group">
                        <span>Name</span><span class="red">*</span>
                        <?php
                        $form =  array(
                            'id'=>'ctadx',
                        );
                        echo form_open_multipart('admin/update-resource',$form);
                        echo form_input('title',$newsLetter[0]['r_title'],array('class'=>'form-control','placeholder'=>'Please add title'));
                        ?>
                        <input type="hidden" value="<?php echo $newsLetter[0]['r_id'] ?>" name="xeew">
                        <input type="hidden" value="<?php echo $newsLetter[0]['r_dp'] ?>" name="dimgo">
                    </div>
                    <div class="form-group">
                        <?php
                        if ($Mylanguages->num_rows() >  0):
                            $languagesOptions = array() ;
                            foreach ($Mylanguages->result() as $language) {
                                $languagesOptions[$language->id]=$language->language;
                            }
                            ?>
                            <label>Select Language:</label> <span class="red">*</span>
                            <?php  echo  form_dropdown('language',$languagesOptions,$newsLetter[0]['language_id'],array('class'=>'form-control'));
                            ?>
                        <?php else: ?>
                            Please add the language first to <a href="<?php echo site_url('admin/new-language')?>">insert</a>  the about us section
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <?php
                        if (!empty($newsLetter[0]['r_status']) || $newsLetter[0]['r_status'] == 0):
                            $status = array() ;
                            $status['0'] = 'Disable';
                            $status['1']= 'Active';
                            ?>
                            <label>Status:</label> <span class="red">*</span>
                            <?php  echo  form_dropdown('status',$status,$newsLetter[0]['r_status'],array('class'=>'form-control'));
                            ?>
                        <?php else: ?>
                            The status is not available please try again.
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <?php echo form_upload('image','',
                            array('class'=>'tp_3','id'=>'fileID','style'=>'display: none')
                        )?>
                        <a  class="btn btn-default xiy" href="javascript:void(0)" onclick="document.getElementById('fileID').click(); return false;" >
                            Add image
                        </a>
                    </div>
                    <div class="form-group">
                        <?php echo form_submit('maker','Update','class="btn btn-primary skzmsubmbtn"'); ?>
                    </div>
                    <div class="cf_r">

                    </div>
                </div>
                <div class="col-md-4  dhpnl">
                    <img src="<?php echo base_url('assets/images/resource/'.$newsLetter[0]['r_dp']); ?>" class="img-fluid">
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

