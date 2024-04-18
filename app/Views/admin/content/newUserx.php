

<div class="machine_description_bar">
    <div class="container">
        <div class="row">
            <div class="machine_description_bar_txt">
                <h2 class="cwhite skzlgnfm">Sign Up</h2>
            </div>
        </div>
    </div>
</div>



<div class="container pdbtomsfm">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12  col-xs-12">
            <div class="sinerror">
                <?php echo validation_errors(); ?>
            </div>
            <?php echo checkFlash(); ?>
            <div class="card login_left">
                <div class="card-header skzchdng">
                    User Information
                </div>
                <div class="card-body">
                    <?php
                    $form =  array(
                        'id'=>'userRegistration',
                    );
                    echo form_open_multipart('admin/add-user',$form);
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    Company/Individual Name<span class="red">*</span>
                                </label>
                                <?php
                                echo form_input('com_name',set_value('com_name'),array('class'=>'form-control com_name','placeholder'=>'Please Enter Company/Individual Name','id'=>''));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    Contact Person Name
                                </label>
                                <?php
                                echo form_input('con_person',set_value('con_person'),array('class'=>'form-control con_person','placeholder'=>'Please Enter Contact Person Name'));
                                ?>
                            </div>
                        </div>
                    </div>
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
                            <div class="form-group">
                                <label>
                                    Mobile<span class="red">*</span>
                                </label>
                                <br>
                                <!-- <div class="row">
                                        <div class="col-md-6">
                                            <select class="form-control" name="Phonecountry">
                                                <option value="US">United States</option>
                                                <option value="BG">Bulgaria</option>
                                                <option value="BR">Brazil</option>
                                                <option value="CN">China</option>
                                                <option value="CZ">Czech Republic</option>
                                                <option value="DK">Denmark</option>
                                                <option value="FR">France</option>
                                                <option value="DE">Germany</option>
                                                <option value="IN">India</option>
                                                <option value="MA">Morocco</option>
                                                <option value="NL">Netherlands</option>
                                                <option value="PK">Pakistan</option>
                                                <option value="RO">Romania</option>
                                                <option value="RU">Russia</option>
                                                <option value="SK">Slovakia</option>
                                                <option value="ES">Spain</option>
                                                <option value="TH">Thailand</option>
                                                <option value="AE">United Arab Emirates</option>
                                                <option value="GB">United Kingdom</option>
                                                <option value="VE">Venezuela</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="<?php /*echo set_value('phone'); */?>" class="form-control" name="phone" />
                                        </div>
                                   </div>-->
                                <input id="phone" name="phone" value="<?php echo set_value('phone'); ?>" type="tel" class="form-control mobile skzDyFList" style="width: 100% !important;">
                                <input type="hidden" name="relPhone" id="skzPhone" value="<?php echo set_value('phone'); ?>">
                                <span id="output"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group eyConPassSkz">
                                <label>
                                    Password<span class="red">*</span>
                                </label>
                                <i class="fal fa-eye pull-right eyPassSkz"></i><!---->
                                <?php
                                echo form_password('password',set_value('password'),array('class'=>'form-control password skzSPass','placeholder'=>'Enter Your Password'));
                                ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group eyConPassSkz">
                                <label>
                                    Confirm Password<span class="red">*</span>
                                </label>
                                <i class="fal fa-eye pull-right eyPassSkzCon"></i><!---->
                                <?php
                                echo form_password('conf_password',set_value('conf_password'),array('class'=>'form-control conf_password skzSPassCon','placeholder'=>'Confirm Your Password'));
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    Company Working Since
                                </label>
                                <?php
                                echo form_dropdown('com_working',getYear(),set_value('com_working'),array('class'=>'form-control com_working','id'=>'modYear'));
                                ?>
                                <?php
                                /*                                echo form_input('title','',array('class'=>'form-control com_working','placeholder'=>'Please Add title'));
                                                                */?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    Company Logo (Max Size: 1MB)
                                </label>
                                <div class="" id="" style="position: relative;">
                                    <div class="regimgpre" id="blah">

                                    </div>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input com_logo" id="validatedCustomFile">
                                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                                    <div class="lgncomp">
                                        <span class="xiipexe" id=""></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>
                                    Company Description<span class="red">*</span>
                                </label>
                                <?php
                                echo form_textarea('description',set_value('description'),
                                    array('id'=>'xp_3','placeholder'=>'Enter the description','class'=>'form-control com_desc')
                                );
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    City <span class="red">*</span>
                                </label>
                                <?php if ($AllCities->num_rows() >  0):
                                    $catOption = array();
                                    $catOption[''] = 'Select City';
                                    foreach ($AllCities->result() as $mycity):
                                        $catOption[$mycity->ci_title] = $mycity->ci_title ;
                                    endforeach;
                                    echo form_dropdown('city',$catOption,set_value('city'),array('class'=>'form-control heiplg','id'=>'mycities'));
                                    ?>
                                <?php else: ?>
                                    <?php no_data('alert-info','Cities not available')?>
                                <?php endif; ?>
                                <!-- --><?php
                                /*                                echo form_input('city',set_value('city'),array('class'=>'form-control city txtOnly','placeholder'=>'Select City'));
                                                                */?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    Country<span class="red">*</span>
                                </label>
                                <?php
                                echo form_dropdown('country',getContries(),set_value('country'),array('class'=>'form-control country','id'=>'country'));
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    Address
                                </label>
                                <?php
                                  echo form_input('address',set_value('city'),array('class'=>'form-control city','placeholder'=>'Enter Your Address'));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    Status <span class="red">*</span>
                                </label>
                                <?php
                                    $UserSTatus  = array('1'=>'Active','0'=>'Pending');
                                    echo form_dropdown('status',$UserSTatus,set_value('status'),array('class'=>'form-control'));
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    User Type<span class="red">*</span>
                                </label>
                                <select class="form-control js-example-basic-multiple" value="<?php echo set_value('user_type[]');?>" name="user_type[]" multiple="multiple">
                                    <option value="agent">Agent</option>
                                    <option value="buyer">Buyer</option>
                                    <option value="broker">Broker</option>
                                    <option value="importer">Importer</option>
                                    <option value="manufacturer">Manufacturer</option>
                                    <option value="seller">Seller</option>
                                    <option value="trader">Trader</option>
                                </select>
                                <?php
                                /*                                echo form_input('title','',array('class'=>'form-control user_type','placeholder'=>'Please Add title'));
                                                                */?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    Deals in <span class="red">*</span>
                                </label>
                                <br>
                                <select class="js-example-basic-multiple form-control" name="elmentsType[]" value="<?php echo set_value('elmentsType[]');?>" multiple="multiple">
                                    <option value="Machine">Machine</option>
                                    <option value="Others">Others</option>
                                </select>
                                <!--                                --><?php
                                /*                                echo form_input('title','',array('class'=>'form-control el_type','placeholder'=>'Please Add title'));
                                                                */?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>
                                    Interested in<span class="red">*</span>
                                </label>
                                <select id="skzINtrstr" class="js-example-basic-multiple form-control" name="intrested[]" value="<?php echo set_value('intrested[]');?>" multiple="multiple">
                                    <?php $alCategories = getAllACategories();
                                    foreach ($alCategories as $myCategory):
                                        //var_dump($alCat[0]);
                                        ;?>
                                        <option value="<?php echo $myCategory->c_id;?>"><?php echo $myCategory->c_title;?></option>
                                    <?php endforeach;?>
                                </select>
                                <?php
                                /*                                echo form_input('title','',array('class'=>'form-control int_in','placeholder'=>'Please Add title'));
                                                                */?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label><input type="checkbox" value="1" class="new_ltr" name="newsletter_notif_status">
                                    Subscribe to our Machinesells newsletter for all the latest updates.
                                </label>
                            </div>
                        </div>
                    </div>
                    <!--<div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="read_policy_status" class="accept_term"  name="accept">
                                        I have read and agreed to Machinesells terms & conditions and their privacy policy
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <br>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="<?php echo site_url('admin/active-users')?>" class="btn btn-lg btn-primary  stpprevi">
                                Cancel
                            </a>
                           <!-- <button class="btn btn-default sibtn" id="btn-user-register">Submit</button>-->
                            <button type="submit" class="btn btn-lg btn-primary stpnext" id="step2Nextskz">Submit</button>
                        </div>
                    </div>

                    <?php form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

