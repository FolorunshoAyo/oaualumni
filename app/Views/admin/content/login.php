<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php if (isset($description) && !empty($description)){echo $description;}?>">
	<title>
        <?php
        if (isset($title)){
            echo $title;
        }
        else{
            echo PROJECTNAME;
        }
        ?>
    </title>
    <link rel="shortcut icon" href="<?php echo base_url('public/assets/images/'.getwebsiteSetting('st_fav_icon')); ?>">
	<!-- ========== Css Files ========== -->
	<link href="<?php echo base_url('public/assets/admin/css/root.css')?>" rel="stylesheet">
	<style type="text/css">
		body{background: #F5F5F5;}
	</style>
</head>
<body>

<div class="login-form">
        <?php echo form_open('admin/checkUser')?>
		<div class="top">
			<!--<img src="<?php /*echo base_url('public/assets/admin/img/kode-icon.png')*/?>" alt="icon" class="icon">-->
			<h1>Club</h1>
			<?php echo checkFlash();?>
            <?php echo validation_errors(); ?>
		</div>
		<div class="form-area">
			<div class="group">
				<input type="text" name="username" class="form-control" placeholder="Username">
				<i class="fa fa-user"></i>
			</div>
			<div class="group">
				<input type="password" name="password" class="form-control" placeholder="Password">
				<i class="fa fa-key"></i>
			</div>
			<div class="checkbox checkbox-primary">
				<input id="checkbox101" type="checkbox" checked>
			</div>
			<button type="submit" class="btn btn-default btn-block">LOGIN</button>
		</div>
	<?php echo form_close(); ?>

</div>

</body>
</html>
