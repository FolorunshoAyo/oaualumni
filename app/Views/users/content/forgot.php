<!--============== Banner Section Start ==============-->
<div class="page-banner full-row bg-gray py-5">
    <div class="container">
        <div class="row row-cols-md-2 row-cols-1 g-3">
            <div class="col">
                <h3 class="page-name text-secondary m-0">Password Recovery</h3>
            </div>
            <div class="col">
                <nav class="float-start float-md-end">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Password Recovery</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!--============== Banner Section End ==============-->

<!--============== Login Section Start ==============-->
<div class="full-row bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <?php
                    echo validation_errors();
                    ?>
                    <?php echo checkFlash();?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="w-50 m-auto w-sm-100">
                    <div class="login-form">
                        <h4 class="text-secondary mb-4">Recover Your Password</h4>
                        <form class="icon-form" action="<?php echo site_url('user/resendLink')?>" method="post">
                            <div class="form-group email">
                                <label for="exampleInputEmail1">Email address</label>
                                <input id="exampleInputEmail1" type="email" name="email" class="form-control bg-gray" placeholder="">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--============== Login Section End ==============-->