<?php
/**
 * Created by PhpStorm.
 * User: mymac
 * Date: 13/10/2017
 * Time: 1:09 PM
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Forgot Password | Machinesells</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/admin//images/favicon.ico')?>">

    <!-- App css -->
    <link href="<?php echo base_url('assets/admin//css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/admin//css/icons.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/admin//css/metismenu.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/admin//css/style.css')?>" rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url('assets/admin//js/modernizr.min.js')?>"></script>

</head>


<body class="bg-accpunt-pages">

<!-- HOME -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <div class="wrapper-page">

                    <div class="account-pages">
                        <div class="account-box">
                            <div class="account-logo-box">
                                <h2 class="text-uppercase text-center">
                                    <a href="index.html" class="text-success">
                                        <span><img src="<?php echo base_url('assets/images/pakistan.png')?>" alt=""></span>
                                    </a>
                                </h2>
                                <h5 class="text-uppercase font-bold m-b-5 m-t-50">Recover Your Account</h5>
                                <?php echo checkFlash();?>
                            </div>
                            <div class="account-content">
                                <form class="form-horizontal" action="<?php echo site_url('admin/restPassword')?>" method="post">

                                    <div class="form-group m-b-20 row">
                                        <div class="col-12">
                                            <label for="emailaddress">Your Password</label>
                                            <input class="form-control" name="password" type="password" id="emailaddress"  >
                                        </div>
                                    </div>
                                    <div class="form-group m-b-20 row">
                                        <div class="col-12">
                                            <label for="emailaddress">Confirm Password</label>
                                            <input class="form-control" name="confPassword" type="password" id="emailaddress"  >
                                        </div>
                                    </div>
                                    <input type="hidden" name="xll" value="<?php echo $ch_link;?>">


                                    <div class="form-group row text-center m-t-10">
                                        <div class="col-12">
                                            <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Recover Now</button>
                                        </div>
                                    </div>

                                </form>

                                <a href="<?php echo site_url('admin/login')?>">Login Now</a>

                                <!-- <div class="row m-t-50">
                                     <div class="col-sm-12 text-center">
                                         <p class="text-muted">Don't have an account? <a href="page-register.html" class="text-dark m-l-5"><b>Sign Up</b></a></p>
                                     </div>
                                 </div>-->

                            </div>
                        </div>
                    </div>
                    <!-- end card-box-->


                </div>
                <!-- end wrapper -->

            </div>
        </div>
    </div>
</section>
<!-- END HOME -->



<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="<?php echo base_url('assets/admin//js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/admin//js/tether.min.js')?>"></script><!-- Tether for Bootstrap -->
<script src="<?php echo base_url('assets/admin//js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/admin//js/metisMenu.min.js')?>"></script>
<script src="<?php echo base_url('assets/admin//js/waves.js')?>"></script>
<script src="<?php echo base_url('assets/admin//js/jquery.slimscroll.js')?>"></script>

<!-- App js -->
<script src="<?php echo base_url('assets/admin//js/jquery.core.js')?>"></script>
<script src="<?php echo base_url('assets/admin//js/jquery.app.js')?>"></script>

</body>
</html>
