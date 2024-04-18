<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta Tags -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php if (isset($description) && !empty($description)){echo $description;}?>">
    <meta name="keywords" content="">
    <meta name="author" content="Unicoder">


    <!-- Title -->
    <title>
        <?php
        if (isset($title)){
            echo $title;
        }
        else{
            echo   PROJECTNAME;
        }
        ?>
    </title>