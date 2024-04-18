<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Promotions</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
			<li class="active">Edit Promotion</li>
		</ol>


	</div>
	<!-- End Page Header -->



	<!-- //////////////////////////////////////////////////////////////////////////// -->
	<!-- START CONTAINER -->
	<div class="container-padding">
		<!-- Start Row -->
		<div class="row">
			<div class="form-group" style="margin-left:50px;">
				<h1>Edit Promotion</h1>
			</div>
			<div class="col-md-9 m_cont_top">
				<div class="sinerror">
					<?php echo validation_errors(); ?>
				</div>
				<div class="form-group">
					<?php echo checkFlash();?>
				</div>
				<?php
				$farr = array('id' => 'x_b_s' );
				echo form_open_multipart('admin/updatePromotion',$farr);
				?>
				<input type="hidden" name="yup" value="<?php echo $skzPromotion[0]['pr_id']; ?>">
				<input type="hidden" name="yig" value="<?php echo $skzPromotion[0]['pr_dp']; ?>">
				<div class="form-group">
					<span class="">Status<span class="red">*</span></span>
					<?php
					$englishStatus = array(
						'1'=>'Active',
						'2'=>'Pending',
					);
					echo form_dropdown('status',$englishStatus, $skzPromotion[0]['pr_status'],array('class'=>'form-control'));
					?>
				</div>
				<div class="row">
					<div  class="col-md-6">
						<div class="form-group">
							<span class="">Title<span class="red">*</span></span>
							<?php
							$catname = array(
								'name' =>'b_name',
								'class' =>'form-control',
								'placeholder' =>'Promotion Title',
								'id' =>'b_name',
								'value' =>$skzPromotion[0]['pr_title'],
							);
							echo form_input($catname);
							?>
						</div>
					</div>
					<div  class="col-md-6">
						<div class="form-group">
							<span class="">Slug/URL<span class="red">*</span></span>
							<span class="edturl pull-right">Edit</span>
							<?php
							$bUrl = array(
								'name' =>'b_url',
								'class' =>'form-control',
								'placeholder' =>'Promotion URL',
								'id' =>'b_url',
								'readonly' =>'readonly',
								'value' =>$skzPromotion[0]['pr_url'],
							);
							echo form_input($bUrl);
							?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<span>Level 1</span><span class="red">*</span>
							<?php
							echo form_input('level_1',$skzPromotion[0]['pr_level_1'],array('class'=>'form-control','placeholder'=>'Please enter level 1 value'));
							?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<span>Any Level</span>
							<?php
							echo form_input('any_level',$skzPromotion[0]['pr_any_level'],array('class'=>'form-control ','placeholder'=>'Please enter any level value'));
							?>
						</div>
					</div>
					<!--<div class="col-md-2">
						<div class="form-group">
							<span>Level 3</span>
							<?php
/*							echo form_input('level_3',$skzPromotion[0]['pr_level_3'],array('class'=>'form-control ','placeholder'=>'Please enter level 3 value'));
							*/?>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<span>Level 4</span>
							<?php
/*							echo form_input('level_4',$skzPromotion[0]['pr_level_4'],array('class'=>'form-control ','placeholder'=>'Please enter level 4 value'));
							*/?>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<span>Level 5</span>
							<?php
/*							echo form_input('level_5',$skzPromotion[0]['pr_level_5'],array('class'=>'form-control ','placeholder'=>'Please enter level 5 value'));
							*/?>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<span>Level 6</span>
							<?php
/*							echo form_input('level_6',$skzPromotion[0]['pr_level_6'],array('class'=>'form-control ','placeholder'=>'Please enter level 6 value'));
							*/?>
						</div>
					</div>-->
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<span>Personal Investment</span><span class="red">*</span>
							<?php
							echo form_input('direct_deposit',$skzPromotion[0]['pr_direct_deposit'],array('class'=>'form-control ','placeholder'=>'Please enter direct deposit value'));
							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<span>From Date</span><span class="red">*</span>
							<?php
							echo form_input('from_date',$skzPromotion[0]['pr_from_date'],array('class'=>'form-control datepicker','placeholder'=>'Please select a date'));
							?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<span>To Date</span><span class="red">*</span>
							<?php
							echo form_input('to_date',$skzPromotion[0]['pr_to_date'],array('class'=>'form-control datepicker','placeholder'=>'Please select a date'));
							?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<span class="">Promotion Detail<span class="red">*</span></span>
					<?php
					$blog = array(
						'name' =>'promotion',
						'class' =>'form-control edit',
						'placeholder' =>'Promotion',
						'id' =>'elm1',
						'wrap'=>'off',
						'rows'=>'13'
					);
					echo form_textarea($blog,base64_decode($skzPromotion[0]['promotion']));
					?>
				</div>



				<div class="col-md-12 plbz">
					<div class="cropping">
						<div class="bdppic">
							<div class="canmy" style="display:none">

							</div>
							<div class="form-group">
								<input type="file" id="imgInp" name="bdp" class="xykk" style="display: none">
								<a  class="btn btn-default xiy" href="javascript:void(0)" onclick="document.getElementById('imgInp').click(); return false;" />
								Add image
								</a>
								<input type="hidden" id="testimage" name="testimage" value="male.png">
								<div id="croppfed"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="control-group" >
					<ul id="i_gz_x" class="inline list-unstyled">

					</ul>
				</div>

				<div class="f_igx form-group">

				</div>

				<div class="control-group">
					<button type="submit" class="btn btn-primary">Update Promotion</button>
				</div>
				<?php echo form_close();?>
			</div>
			<div class="col-md-3">
				<img src="<?php echo base_url('public/assets/images/promotion/'.$skzPromotion[0]['pr_dp']) ?>" class="img-responsive img-fluid img-responsive">
			</div>
		</div>
		<!-- End Row -->



	</div>
	<!-- END CONTAINER -->
	<!-- //////////////////////////////////////////////////////////////////////////// -->


</div>
