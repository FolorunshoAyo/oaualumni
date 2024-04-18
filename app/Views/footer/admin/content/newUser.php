


<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Add new User</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">Add User</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col-md-12">
                    <div class="sinerror">
                        <?php echo validation_errors(); ?>
                    </div>
                    <?php echo checkFlash(); ?>
                    <div class="card skzcards">
                        <div class="card-header">
                            Information
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
                                        echo form_input('com_name',set_value('com_name'),array('class'=>'form-control com_name','placeholder'=>'Please Add title'));
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Contact Person Name
                                        </label>
                                        <?php
                                        echo form_input('con_person',set_value('con_person'),array('class'=>'form-control con_person','placeholder'=>'Please Add title'));
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
                                        echo form_input('email',set_value('email'),array('class'=>'form-control email','placeholder'=>'Please Add title'));
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
                                    <!--<input id="phone" name="phone" value="<?php /*echo set_value('phone'); */?>" type="tel" class="form-control mobile" style="width: 100% !important;">-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Password<span class="red">*</span>
                                        </label>
                                        <?php
                                        echo form_password('password',set_value('password'),array('class'=>'form-control password','placeholder'=>'Please Add title'));
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Confirm Password<span class="red">*</span>
                                        </label>
                                        <?php
                                        echo form_password('conf_password',set_value('conf_password'),array('class'=>'form-control conf_password','placeholder'=>'Please Add title'));
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
                                            Company Logo (Optional)
                                        </label>
                                        <br>
                                        <input type="file" name="image" class="com_logo" id="validatedCustomFile">
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
                                   <!-- <div class="form-group">
                                        <label>
                                            City<span class="red">*</span>
                                        </label>
                                        <?php
/*                                        echo form_input('city',set_value('city'),array('class'=>'form-control city','placeholder'=>'Please Add title'));
                                        */?>
                                    </div>-->
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
                                            User Type<span class="red">*</span>
                                        </label>
                                        <select class="js-example-basic-multiple form-control" value="<?php echo set_value('user_type[]');?>" name="user_type[]" multiple="multiple">
                                            <option value="buyer">buyer</option>
                                            <option value="broker">broker</option>
                                            <option value="seller">seller</option>
                                            <option value="importer">importer</option>
                                            <option value="agent">agent</option>
                                            <option value="trader">trader</option>
                                            <option value="manufacturer">manufacturer</option>
                                        </select>
                                        <?php
                                        /*                                echo form_input('title','',array('class'=>'form-control user_type','placeholder'=>'Please Add title'));
                                                                        */?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Element Types<span class="red">*</span>
                                        </label>
                                        <br>
                                        <select class="js-example-basic-multiple form-control" name="elmentsType[]" value="<?php echo set_value('elmentsType[]');?>" multiple="multiple">
                                            <option value="Machine">Machine</option>
                                            <option value="Spare Parts">Spare Parts</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <!--                                --><?php
                                        /*                                echo form_input('title','',array('class'=>'form-control el_type','placeholder'=>'Please Add title'));
                                                                        */?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Status
                                        </label> <span class="red">*</span>
                                        <?php
                                        $userStatus['1'] = 'active';
                                        $userStatus['0'] = 'Inactive';
                                        echo form_dropdown('status',$userStatus,set_value('status'),array('class'=>'form-control com_working','id'=>''));
                                        ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            News Letter Notification Status
                                        </label></label> <span class="red">*</span>
                                        <?php
                                        $userNewsLetter['1'] = 'active';
                                        $userNewsLetter['0'] = 'Inactive';
                                        echo form_dropdown('newsLetter',$userNewsLetter,set_value('com_working'),array('class'=>'form-control com_working','id'=>''));
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Interested in<span class="red">*</span>
                                        </label>
                                        <select class="js-example-basic-multiple form-control" name="intrested[]" value="<?php echo set_value('intrested[]');?>" multiple="multiple">
                                            <?php $alCategories = getAllACategories();
                                            foreach ($alCategories as $myCategory):
                                                var_dump($alCat[0]);
                                                ;?>
                                                <option value="<?php echo $myCategory->c_id;?>"><?php echo $myCategory->c_title;?></option>
                                            <?php endforeach;?>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Address<span class="red">*</span>
                                        </label>
                                        <?php
                                        echo form_input('address',set_value('address'),array('class'=>'form-control conf_password','placeholder'=>'Please Add address'));
                                        ?>
                                    </div>
                                </div>
                            </div>

                           <!-- <div class="row">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label><input id="read_policy_status" class="accept_term" type="checkbox" name="read_policy_status"> <a href="javascript:void(0);" target="_blank">I have read and agreed to MachineSells terms and condition,</a> <a href="javascript:void(0);" target="_blank"> privacy policy. </a></label>
                                    </div>
                                </div>
                            </div>-->
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-default sibtn" id="btn-user-register">Submit</button>
                                </div>
                            </div>
                            <?php form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

