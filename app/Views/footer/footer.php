
<!--============== Footer Section Start ==============-->
<footer class="full-row bg-gray p-0">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="divider py-80">
                    <div class="row g-4">
                        <div class="col-lg-4">
                            <div class="footer-widget">
                                <div class="footer-logo mb-4">
                                    <a href="<?php echo base_url()?>">
                                        <img class="logo-bottom img-responsive img-fluid" src="<?php echo base_url('public/assets/images/'.getwebsiteSetting('st_logo'))?>" alt="image" style="width: 150px;">
                                    </a>
                                </div>
                                <p class="pb-20">
                                    <?php echo getwebsiteSetting('st_footer_cotnent');  ?>
                                </p>
                                <a class="btn btn-primary mt-4" href="<?php echo site_url('register')?>">Register Now</a>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row row-cols-md-3 row-cols-1">
                                <div class="col">
                                    <div class="footer-widget footer-nav">
                                        <h4 class="widget-title text-secondary double-down-line-left position-relative">
                                            Users
                                        </h4>
                                        <ul>
                                            <li><a href="<?php echo site_url('login')?>">Register</a></li>
                                            <li><a href="<?php echo site_url('register')?>">Login</a></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="footer-widget footer-nav">
                                        <h4 class="widget-title text-secondary double-down-line-left position-relative">Quick Links</h4>
                                        <ul>
                                            <li><a href="<?php echo base_url(); ?>">Home</a></li>
                                            <li><a href="<?php echo site_url('news')?>">News</a></li>
                                            <li><a href="<?php echo site_url('events')?>">Events</a></li>
                                            <li><a href="<?php echo site_url('contact')?>">Contact</a></li>
                                            <li><a href="<?php echo site_url('galleries')?>">Gallery</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="footer-widget">
                                        <h4 class="widget-title text-secondary double-down-line-left position-relative">Contact Us</h4>
                                        <ul>
                                            <li>
                                                <?php echo getwebsiteSetting('st_address');  ?>
                                            </li>
                                            <li>
                                                <?php echo getwebsiteSetting('st_phone');  ?>
                                            </li>
                                            <li>
                                                <?php echo getwebsiteSetting('st_email');  ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="footer-widget media-widget mt-4 text-secondary hover-text-primary">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="#"><i class="fas fa-rss"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright Start -->
    <div class="copyright">
        <div class="container">
            <div class="row row-cols-sm-2 row-cols-1">
                <div class="col"> <span>© <?php echo date('Y')?> <?php echo PROJECT?> All right reserved</span> </div>
                <!--<div class="col">
                    <ul class="line-menu text-ordinary float-end">
                        <li><a href="#">Privacy & Policy</a></li>
                        <li>|</li>
                        <li><a href="#"> Site Map</a></li>
                    </ul>
                </div>-->
            </div>
        </div>
    </div>
    <!-- Copyright End -->
</footer>
<!--============== Footer Section End ==============-->

<!-- Scroll to top -->
<a href="#" class="bg-secondary text-white" id="scroll"><i class="fas fa-angle-up"></i></a>
<!-- End Scroll To top -->
</div>
<!-- Wrapper End -->

<script type="text/javascript">
    baseurl="<?php echo base_url('');?>"
    sturl="<?php echo site_url('');?>"
</script>
<!-- Javascript Files -->
<script src="<?php echo base_url('public/assets/club/js/jquery.min.js')?>"></script>
<!--jQuery Layer Slider -->
<script src="<?php echo base_url('public/assets/club/js/greensock.js')?>"></script>
<script src="<?php echo base_url('public/assets/club/js/layerslider.transitions.js')?>"></script>
<script src="<?php echo base_url('public/assets/club/js/layerslider.kreaturamedia.jquery.js')?>"></script>
<!--jQuery Layer Slider -->
<script src="<?php echo base_url('public/assets/club/js/popper.min.js')?>"></script>
<script src="<?php echo base_url('public/assets/club/js/bootstrap.min.js')?>"></script>

<script src="<?php echo base_url('public/assets/club/js/tmpl.js')?>"></script>
<script src="<?php echo base_url('public/assets/club/js/jquery.dependClass-0.1.js')?>"></script>
<script src="<?php echo base_url('public/assets/club/js/draggable-0.1.js')?>"></script>
<script src="<?php echo base_url('public/assets/club/js/jquery.slider.js')?>"></script>
<script src="<?php echo base_url('public/assets/club/js/wow.js')?>"></script>
<script src="<?php echo base_url('public/assets/club/js/owl.carousel.min.js')?>"></script>
<script src="<?php echo base_url('public/assets/club/js/YouTubePopUp.jquery.js')?>"></script>
<script src="<?php echo base_url('public/assets/club/js/validate.js')?>"></script>
<script src="<?php echo base_url('public/assets/club/js/jquery.cookie.js')?>"></script>
<script src="<?php echo base_url('public/assets/club/js/custom.js')?>"></script>