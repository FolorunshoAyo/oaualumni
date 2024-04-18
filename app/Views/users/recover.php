<div class="page-banner full-row bg-gray py-5">
    <div class="container">
        <div class="row row-cols-md-2 row-cols-1 g-3">
            <div class="col">
                <h3 class="page-name text-secondary m-0">Reset Password</h3>
            </div>
            <div class="col">
                <nav class="float-start float-md-end">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php base_url()?>">Home</a></li>
                        <li class="breadcrumb-item active">Reset Password</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<div class="full-row bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="form-group">
                    <br>
                    <?php echo validation_errors(); ?>
                    <?php echo checkFlash(); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 offset-3 skzfpsetng">
                <div class="wrap-form">
                    <?php echo form_open('user/recoverAccount',['id'=>'reoverAccount'])?>
                    <div class="form-group eyConPassSkz">
                        <label>
                            Password<span class="red">*</span>
                        </label>
                        <?php
                        echo form_password('password',set_value('password'),array('class'=>'form-control password skzSPass','placeholder'=>'Enter Your Password'));
                        ?>
                    </div>
                    <!--  <div class="form-group">
                          <input type="password" name="password" class="form-control" value=""   placeholder="Create New Password">
                      </div>-->
                    <input type="hidden" name="xepe" value="<?php echo $link;?>">
                    <div class="form-group eyConPassSkz">
                        <label>
                            Confirm Password<span class="red">*</span>
                        </label>
                        <?php
                        echo form_password('confirmPassword',set_value('confirmPassword'),array('class'=>'form-control conf_password skzSPassCon','placeholder'=>'Confirm Your Password'));
                        ?>
                    </div>

                    <!-- <div class="form-group">
                         <input type="password" name="confirmPassword" class="form-control" value=""   placeholder="Confirm Password">
                     </div>-->
                    <div class="form-group">
                        <button class="btn btn-primary mt-3" id="btn-user-register">Change Password</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



