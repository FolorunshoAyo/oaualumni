<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Layouts</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('admin/plans')?>">Users</a></li>
			<li class="active">Edit User</li>
		</ol>


	</div>
	<!-- End Page Header -->



	<!-- //////////////////////////////////////////////////////////////////////////// -->
	<!-- START CONTAINER -->
	<div class="container-padding">
		<!-- Start Row -->
		<div class="row">
			<div class="col-md-2">

			</div>
			<div class="col-md-8 ">
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
                            echo form_open_multipart('admin/updateUser',$form);
                            ?>
                            <div class="row">
                                <input type="hidden" name="xyp" value="<?php echo $userData[0]['u_id']?>">
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
                                <div class="col-md-12">
                                    <!--<button type="submit" class="thmebutton" id="btn-user-register">Submit</button>-->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary mt-15">Update</button>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>

			</div>
		</div>
		<!-- End Row -->



	</div>
	<!-- END CONTAINER -->
	<!-- //////////////////////////////////////////////////////////////////////////// -->


</div>
