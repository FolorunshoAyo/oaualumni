<div class="col-lg-11 col-xl-10">
    <div class="row">
        <div class="dashboard-panel w-100">
            <h4 class="text-secondary mb-4">Change Password</h4>
            <div class="dashboard-change-password p-5 bg-white">
                    <?php
                    $form =  array(
                        'id'=>'passwordPIn',
                    );
                    echo form_open('user/updateUserPassword',$form);
                    ?>
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo checkFlash(); ?>
                                <div class="sinerror">
                                    <?php echo validation_errors(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="current-password" class="form-label">Current Password</label>
                                    <abbr title="Put your current password here">
                                        <!--<input id="current-password" type="text" name="password" class="form-control">-->
                                        <?php
                                        //var_dump($userInfo);
                                        echo form_input('old_password','',array('class'=>'form-control','placeholder'=>'Old Password','id'=>'current-password'));
                                        ?>
                                    </abbr>
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="new-password" class="form-label">New Password</label>
                                    <abbr title="Password must 8 charactor and contain latter and number">
                                        <!--<input id="new-password" type="text" name="password" class="form-control">-->
                                        <?php
                                        echo form_input('user_password','',array('class'=>'form-control','placeholder'=>'New Password','id'=>'new-password'));
                                        ?>
                                    </abbr>
                                </div>
                                <div class="mb-3">
                                    <label for="renew-password" class="form-label">Re-Type New Password</label>
                                    <abbr title="Re-Type New Password">
                                       <!-- <input id="renew-password" type="text" name="password" class="form-control">-->
                                        <?php
                                        echo form_input('confirm_password','',array('class'=>'form-control','placeholder'=>'renew-password'));
                                        ?>
                                    </abbr>
                                </div>
                                <button class="btn btn-primary mt-3" type="submit">Save Change</button>
                            </div>
                        </div>
                </form>
                <!--<a href="#" class="text-primary d-table mt-4">Ckick here if you forgot password?</a>-->
            </div>
        </div>
        <?php userdashboardFooter();?>
    </div>
</div>