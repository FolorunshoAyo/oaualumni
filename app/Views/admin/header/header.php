<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
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
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php if (isset($description) && !empty($description)){echo $description;}?>">
	<meta name="keywords" content="bootstrap, admin, dashboard, flat admin template, responsive," />

    <!-- App favicon --><!--base_url('public/assets/images/logo.ico')-->
    <link rel="shortcut icon" href="<?php echo base_url('public/assets/images/'.getwebsiteSetting('st_fav_icon')); ?>">
<!--    <link rel="shortcut icon" href="assets/images/favicon.ico">-->




