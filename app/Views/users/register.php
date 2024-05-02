<div class="page-banner full-row bg-gray py-5">
    <div class="container">
        <div class="row row-cols-md-2 row-cols-1 g-3">
            <div class="col">
                <h3 class="page-name text-secondary m-0">Register</h3>
            </div>
            <div class="col">
                <nav class="float-start float-md-end">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
                        <li class="breadcrumb-item active">Register</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>



<div class="container">
    <div class="row mb-2">
        <div class="col-md-12">
            <br><br><br>
            <div class="mb-5 text-center">
                <h2 class="mb-4 text-secondary">Welcome</h2>
                <p>Adipiscing lacinia pede proin vulputate habitasse donec adipiscing. Cubilia Interdum hac turpis et dignissim vehicula porta nostra dictum nostra semper. Dictumst congue dictum. Nam massa id, netus interdum amet Metus turpis
                    scelerisque aptent sapien penatibus potenti.</p>
            </div>
            <div class="login-condition flat-small flat-primary">
                <h5 class="mb-4 text-secondary">Keep in a mind a few basic password rules :</h5>
                <div class="row">
                    <div class="col-md-8 col-xl-6">
                        <ul>
                            <li><i class="flaticon-checked text-primary"></i>Change your passwords periodically</li>
                            <li><i class="flaticon-checked text-primary"></i>Avoid re-using password for multiple site</li>
                            <li><i class="flaticon-checked text-primary"></i>Use complex characters including uppercase and number</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row brdresi">
        <div class="col-md-12 col-lg-12 col-sm-12  col-xs-12">
            <div class="sinerror">
                <?php echo validation_errors(); ?>
            </div>
            <?php echo checkFlash(); ?>
            <div class="card-body">
                <?php
                $form =  array(
                    'id'=>'userRegistration',
                );
                echo form_open_multipart('user/newuser',$form);
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                First Name<span class="red">*</span>
                            </label>
                            <?php
                            echo form_input('first_name',set_value('first_name'),array('class'=>'form-control','placeholder'=>'Please Enter Your First Name','id'=>''));
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                Last Name<span class="red">*</span>
                            </label>
                            <?php
                            echo form_input('last_name',
                                set_value('last_name'),
                                array('class'=>'form-control','placeholder'=>'Please Enter Your First Name'));
                            ?>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                Email<span class="red">*</span>
                            </label>
                            <?php
                            echo form_input('email',set_value('email'),array('class'=>'form-control email','placeholder'=>'Please Enter Your Email'));
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group skzPHoneN">
                            <label>
                                Occupation<span class="red">*</span>
                            </label>
                            <br>
                            <?php
                            echo form_input('occupation',
                                set_value('occupation'),
                                array('class'=>'form-control','placeholder'=>'Please Enter Your Occupation'));
                            ?>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                Address<span class="red">*</span>
                            </label>
                            <?php
                            echo form_input('address',set_value('address'),array('class'=>'form-control','placeholder'=>'Please Enter Your Address'));
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group skzPHoneN">
                            <label>
                                Hobbies<span class="red">*</span>
                            </label>
                            <br>
                            <?php
                            echo form_input('hobbies',
                                set_value('hobbies'),
                                array('class'=>'form-control','placeholder'=>'Please Enter Your Hobbies'));
                            ?>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="validationDefault03">Country</label>
                            <?php
                            if (count($countries) > 0) {
                                $countriesOptions = [];
                                foreach ($countries as $myCountry) {
                                    $countriesOptions[$myCountry['co_id']] = $myCountry['co_name'];
                                }

                            }
                            echo form_dropdown('country',$countriesOptions,'',array('class'=>'form-control custom-select skzgen'));
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group skzPHoneN">
                            <label>
                                Spouse<span class="red">*</span>
                            </label>
                            <br>
                            <?php
                            echo form_input('spouse',
                                set_value('spouse'),
                                array('class'=>'form-control','placeholder'=>'Please Enter Your Spouse'));
                            ?>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label>Mobile Contact <span class="red">*</span></label>
                        <div class="form-group">
                            <input type="hidden" name="realPhone" class="form-control" id="skzPhone1" placeholder="Enter Your Phone/Mobile Number">
                            <input type="text" class="form-control" id="phone1" placeholder="Enter Your Phone/Mobile Number">
                            <span id="result"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Emergency Contact <span class="red">*</span></label>
                        <div class="form-group">
                            <input type="hidden" name="emergencyPhone" class="form-control" id="skzPhone2" placeholder="Enter Your Phone/Mobile Number">
                            <input type="text" class="form-control" id="phone2" placeholder="Enter Your Phone/Mobile Number">
                            <span id="result"></span>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group eyConPassSkz">
                            <label>
                                Password<span class="red">*</span>
                            </label>

                            <?php
                            echo form_password('password',set_value('password'),array('class'=>'form-control password skzSPass', 'id'=>'password', 'placeholder'=>'Enter Your Password'));
                            ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group eyConPassSkz">
                            <label>
                                Confirm Password<span class="red">*</span>
                            </label>
                            <?php
                            echo form_password('conf_password',set_value('conf_password'),array('class'=>'form-control conf_password skzSPassCon','placeholder'=>'Confirm Your Password'));
                            ?>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>
                                Profile Picture
                                <span class="red">*</span>
                            </label>
                            <input type="file" name="dp" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span class="float-right"> Captcha is required </span>
                            <label>
                                <span class="red" id="captchaOperation">*</span>
                            </label>
                            <div class=""><div ></div></div>
                            <input type="text" name="captcha" class="form-control ba b--black-20 pa2 mb2 db w-100" />
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <!--<button type="submit" class="thmebutton" id="btn-user-register">Submit</button>-->
                      <div class="form-group">
                          <button type="submit" class="btn btn-primary mt-15">Register</button>
                      </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>