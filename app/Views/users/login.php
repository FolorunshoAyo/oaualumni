<!--============== Banner Section Start ==============-->
<div class="page-banner full-row bg-gray py-5">
    <div class="container">
        <div class="row row-cols-md-2 row-cols-1 g-3">
            <div class="col">
                <h3 class="page-name text-secondary m-0">Login</h3>
            </div>
            <div class="col">
                <nav class="float-start float-md-end">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
                        <li class="breadcrumb-item active">Login</li>
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
            <div class="col-md-7">
                <div class="mb-5">
                    <h4 class="mb-4 text-secondary">Welcome</h4>
                    <p>Adipiscing lacinia pede proin vulputate habitasse donec adipiscing. Cubilia Interdum hac turpis et dignissim vehicula porta nostra dictum nostra semper. Dictumst congue dictum. Nam massa id, netus interdum amet Metus turpis
                        scelerisque aptent sapien penatibus potenti.</p>
                </div>
                <div class="login-condition flat-small flat-primary">
                    <h5 class="mb-4 text-secondary">Keep in a mind a few basic password rules :</h5>
                    <div class="row">
                        <div class="col-md-8 col-xl-6">
                            <ul>
                                <li><i class="flaticon-checked text-primary"></i>Change your passwords periodically</li>
                                <li><i class="flaticon-checked text-primary"></i>Avoid re-using password for multiple site</li>
                                <li><i class="flaticon-checked text-primary"></i>Use complex characters including uppercase and number</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="mt-sm-50">
                    <a href="<?php echo site_url('login')?>" class="down-active text-secondary me-3">Login</a>
                    <a href="<?php echo site_url('register')?>" class="text-secondary">Register</a>
                    <?php echo form_open('user/checkuser','class="frgpaswd"'); ?>
                        <div class="mb-3 user">
                            <label class="form-label" for="exampleInputEmail1">Email Address</label>
                            <input type="text" class="form-control" id="email" placeholder="" name="email" value=""  autofocus="">
                        </div>
                        <div class="mb-3 password">
                            <label class="form-label" for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control skzSPass" id="password" placeholder="" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Login</button>
                        <a class="text-secondary hover-text-primary d-block mt-4" href="<?php echo site_url('user/forgot')?>">I forgot my password !</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!--============== Login Section End ==============-->