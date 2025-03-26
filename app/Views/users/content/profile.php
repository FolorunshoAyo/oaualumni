<div class="col-lg-11 col-xl-10">
    <div class="row">
        <div class="dashboard-panel w-100">
            <h4 class="text-secondary mb-4">Personal Information</h4>
            <div class="dashboard-personal-info form-border p-5 bg-white">
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
                            echo form_open_multipart('user/updateprofile',$form);
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            First Name<span class="red">*</span>
                                        </label>
                                        <?php
                                        echo form_input('first_name',$userData[0]['u_first_name'],
                                            array('class'=>'form-control','placeholder'=>'Please Enter Your First Name','id'=>'')
                                        );
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
                                            $userData[0]['u_last_name'],
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
                                        echo form_input('email',$userData[0]['u_email'],array('class'=>'form-control email','placeholder'=>'Please Enter Your Email','readonly'=>'readonly'));
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
                                            $userData[0]['u_occupation'],
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
                                        echo form_input('address',$userData[0]['u_address'],array('class'=>'form-control','placeholder'=>'Please Enter Your Address'));
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group skzPHoneN">
                                        <label>
                                            Hobbies<span class="red">*</span>
                                        </label>
                                        <input type="hidden" name="xceep" value="<?php echo $userData[0]['u_dp'] ?>">
                                        <br>
                                        <?php
                                        echo form_input('hobbies',
                                            $userData[0]['u_hobbies'],
                                            array('class'=>'form-control','placeholder'=>'Please Enter Your Hobbies'));
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <!-- Date of Birth Field -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Date of Birth<span class="red">*</span>
                                        </label>
                                        <?php
                                        echo form_input('dob', $userData[0]['u_dob'], array('class' => 'form-control', 'placeholder' => 'Please Enter Your Date of Birth'), 'date');
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
                                        </label>
                                        <input type="file" name="dp" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="float-right"> User Name</span>
                                        <label>
                                            <span class="red" id="">*</span>
                                        </label>
                                        <div class=""><div ></div></div>
                                        <input type="text" value="<?php echo $userData[0]['user_name'];  ?>" readonly='readonly' class="form-control ba b--black-20 pa2 mb2 db w-100" placeholder="Enter Your User Name">
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
                                        echo form_dropdown('country',$countriesOptions, $userData[0]['country_id'],array('class'=>'form-control custom-select skzgen'));
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
                                            $userData[0]['u_spouse'],
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
                                        <input type="hidden" name="realPhone" class="form-control" id="skzPhone1" placeholder="Enter Your Phone/Mobile Number" value="<?php echo  $userData[0]['u_mobile'];?>">
                                        <input type="text" class="form-control" id="phone1" placeholder="Enter Your Phone/Mobile Number" value="<?php echo  $userData[0]['u_mobile'];?>">
                                        <span id="result"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Emergency Contact <span class="red">*</span></label>
                                    <div class="form-group">
                                        <input type="hidden" name="emergencyPhone" class="form-control" id="skzPhone2" placeholder="Enter Your Phone/Mobile Number" value="<?php echo  $userData[0]['u_emergency_phone'];?>">
                                        <input type="text" class="form-control" id="phone2" placeholder="Enter Your Phone/Mobile Number" value="<?php echo  $userData[0]['u_emergency_phone'];?>">
                                        <span id="result"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!--<button type="submit" class="thmebutton" id="btn-user-register">Submit</button>-->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary mt-15">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php  userdashboardFooter(); ?>
    </div>
</div>