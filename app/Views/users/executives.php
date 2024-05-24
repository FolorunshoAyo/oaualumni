<!--============== Banner Section Start ==============-->
<div class="page-banner full-row bg-gray py-5">
    <div class="container">
        <div class="row row-cols-md-2 row-cols-1 g-3">
            <div class="col">
                <h3 class="page-name text-secondary m-0">Executives</h3>
            </div>
            <div class="col">
                <nav class="float-start float-md-end">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
                        <li class="breadcrumb-item active">Our Executives</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!--============== Banner Section End ==============-->

<!--============== Committee List Section Start ==============-->
<div class="full-row bg-white">
    <div class="container">
        <!-- <div class="row">
            <div class="col-lg-4 col-sm-10 col-md-7 m-auto">
                <div class="single-committee-member">
                    <img src="<?php echo site_url('/public/assets/club/images/commitee/commitee-1.jpg') ?>" class="img-fluid" alt="Committee">
                    <h3>
                        Bryan Watshon 
                        <span class="committee-deg">President</span>
                        <div class="social-info">
                            <a href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </h3>
                </div>
            </div>
        </div> -->
        <div class="row">
            <?php if ($executives):?>
                <?php foreach($executives as $executive):?>
                    <div class="col-lg-4 col-sm-6">
                        <div class="single-committee-member">
                            <img src="<?php echo site_url('/public/assets/images/howitworks/' . $executive['hi_dp']) ?>" class="img-fluid" alt="<?php echo $executive['hi_name'] ?>">
                            <h3>
                                <?php echo $executive['hi_name'] ?> 
                                <span class="committee-deg"><?php echo $executive['hi_post'] ?></span>
                                <div class="social-info">
                                    <?php if(isset($executive['hi_facebook']) && !empty($executive['hi_facebook'])): ?>
                                        <a href="<?= $executive['hi_facebook'] ?>">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    <?php endif;?>
                                    <?php if(isset($executive['hi_twitter']) && !empty($executive['hi_twitter'])): ?>
                                        <a href="<?= $executive['hi_twitter'] ?>">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    <?php endif;?>
                                    <?php if(isset($executive['hi_linkedin']) && !empty($executive['hi_linkedin'])): ?>
                                        <a href="<?= $executive['hi_linkedin'] ?>">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    <?php endif;?>
                                </div>
                            </h3>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php else: ?>
                <?php no_data('alert-info','No Alumni has been register'); ?>
            <?php endif?>
        </div>
        <!-- <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="single-committee-member">
                    <img src="<?php echo site_url('/public/assets/club/images/commitee/commitee-5.jpg') ?>" class="img-fluid" alt="Committee">
                    <h3>
                        Alex Kalifa 
                        <span class="committee-deg">Office Secretary</span>
                        <div class="social-info">
                            <a href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </h3>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-committee-member">
                    <img src="<?php echo site_url('/public/assets/club/images/commitee/commitee-7.jpg') ?>" class="img-fluid" alt="Committee">
                    <h3>
                        Mal Muhit 
                        <span class="committee-deg">Finance Member</span>
                        <div class="social-info">
                            <a href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </h3>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-committee-member">
                    <img src="<?php echo site_url('/public/assets/club/images/commitee/commitee-6.jpg') ?>" class="img-fluid" alt="Committee">
                    <h3>
                        Alex Salina 
                        <span class="committee-deg">Committee Member</span>
                        <div class="social-info">
                            <a href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </h3>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-committee-member">
                    <img src="<?php echo site_url('/public/assets/club/images/commitee/commitee-8.jpg') ?>" class="img-fluid" alt="Committee">
                    <h3>
                        Karim Mia 
                        <span class="committee-deg">Committee Member</span>
                        <div class="social-info">
                            <a href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="single-committee-member">
                    <img src="<?php echo site_url('/public/assets/club/images/commitee/commitee-3.jpg') ?>" class="img-fluid" alt="Committee">
                    <h3>
                        Rahim Mia 
                        <span class="committee-deg">Committee Member</span>
                        <div class="social-info">
                            <a href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </h3>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-committee-member">
                    <img src="<?php echo site_url('/public/assets/club/images/commitee/commitee-2.jpg') ?>" class="img-fluid" alt="Committee">
                    <h3>
                        Prince Rimon
                        <span class="committee-deg">Committee Member</span>
                        <div class="social-info">
                            <a href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </h3>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-committee-member">
                    <img src="<?php echo site_url('/public/assets/club/images/commitee/commitee-4.jpg') ?>" class="img-fluid" alt="Committee">
                    <h3>
                        Sheoli Afsar
                        <span class="committee-deg">Committee Member</span>
                        <div class="social-info">
                            <a href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </h3>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-committee-member">
                    <img src="<?php echo site_url('/public/assets/club/images/commitee/commitee-1.jpg') ?>" class="img-fluid" alt="Committee">
                    <h3>
                        Prince Kamla
                        <span class="committee-deg">Committee Member</span>
                        <div class="social-info">
                            <a href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </h3>
                </div>
            </div>
        </div> -->
    </div>
</div>
<!--============== Committee List Section End ==============-->
