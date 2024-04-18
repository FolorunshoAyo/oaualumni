

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid skzMconWhite">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Website Settings</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php  echo checkFlash();?>
                    </div>
                    <div class="form-group">
                        <?php  echo validation_errors();?>
                    </div>
                </div>
            </div>

            <?php echo form_open_multipart('admin/addsettings',['id'=>'ctadx']); ?>
            <div class="row m_cont_top">
                <div class="col-md-6">
                    <div class="form-group">
                        <span>Email</span> <label class="red">*</label>
                        <?php echo form_input('email','',['class'=>'form-control','placeholder'=>'Add your Email']);?>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <span>Phone</span> <label class="red">*</label>
                        <?php echo form_input('phone','',['class'=>'form-control','placeholder'=>'Add your Phone']);?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <span>Address</span> <label class="red">*</label>
                        <?php echo form_input('address','',['class'=>'form-control','placeholder'=>'Add your Address']);?>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <span>What We Do</span> <label class="red">*</label>
                        <?php echo form_input('wwdo','',['class'=>'form-control','placeholder'=>'Add your Address']);?>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <span>How It Works</span> <label class="red">*</label>
                        <?php echo form_input('hiw','',['class'=>'form-control','placeholder'=>'Add your Address']);?>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <span>Recent News</span> <label class="red">*</label>
                        <?php echo form_input('rnews','',['class'=>'form-control','placeholder'=>'Add your Address']);?>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <span>Recent Events</span> <label class="red">*</label>
                        <?php echo form_input('revent','',['class'=>'form-control','placeholder'=>'Add your Address']);?>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <span>Events Calendar</span> <label class="red">*</label>
                        <?php echo form_input('ecal','',['class'=>'form-control','placeholder'=>'Add your Address']);?>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <span>Footer Content</span> <label class="red">*</label>
                      <?php echo form_textarea('footer_content','',['class'=>'form-control','placeholder'=>'Add Your Footer Content'])?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <span>Fav Icon</span> <label class="red">*</label>
                        <?php echo form_upload('favicon','',['class'=>'form-control','placeholder'=>'Add Your Fav Icon'])?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <span>Logo</span> <label class="red">*</label>
                        <?php echo form_upload('logo','',['class'=>'form-control','placeholder'=>'Add Your Logo'])?>
                    </div>
                </div>
            </div><!--row ends here-->
            <div class="form-group">
                <input type="submit" name="maker" value="Add Settings"  class="btn btn-primary" />
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
