<?php if (count($whatWeDo) > 0) :?>
<!--============== Text Block One Section Start ==============-->
    <div class="full-row bg-gray">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-secondary double-down-line text-center">What We Do</h2>
                <span class="text-center mt-4 d-block mb-5">
                    <?php if (isset($websiteSetting) && count($websiteSetting) === 1){ echo $websiteSetting[0]['st_what_we_do']; }?>
                </span>
            </div>
        </div>
        <div class="text-box-one">
            <div class="row row-cols-lg-4 row-cols-md-4 row-cols-1 g-4">
                <?php foreach($whatWeDo as $mywwdo): ?>
                    <div class="col">
                        <div class="p-4 text-center hover-bg-white hover-shadow rounded">
                            <img src="<?php echo base_url('public/assets/images/homeSection/'.$mywwdo['hs_dp']);?>" alt="image" style="width: 120px;">
                            <h5 class="text-secondary hover-text-primary py-3 m-0">
                                <?php
                                    if (
                                            !empty($mywwdo['hs_button_text']) && isset($mywwdo['hs_button_text']) &&
                                            !empty($mywwdo['hs_button_url']) && isset($mywwdo['hs_button_url'])
                                    ) {
                                        echo anchor($mywwdo['hs_button_url'],$mywwdo['hs_button_text'],'');
                                    }
                                    else{
                                        echo $mywwdo['hs_title'];
                                    }
                                ?>
                               <!-- <a href="service-details.html">Lorem Ipsum</a>-->
                            </h5>
                            <?php echo word_limiter(base64_decode($mywwdo['hs_body']), 30);?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
            <!--<div class="row justify-content-center mt-5">
                <div class="col-auto"> <a class="btn btn-primary" href="services.html">More Services</a> </div>
            </div>-->
        </div>
    </div>
</div>
<!--============== Text Block One Section End ==============-->
<?php endif; ?>
<!--============== Happy Living Section Start ==============-->
<!--<div class="full-row living bg-one overlay-secondary-half" style="background-image: url('<?php /*echo base_url('public/assets/club/images/haddyliving.jpg')*/?>'); background-size: cover; background-position: center center; background-repeat: no-repeat;">
    <div class="container position-relative">
        <div class="row">
            <div class="col-lg-6">
                <div class="living-list pe-4">
                    <h3 class="pb-4 mb-3 text-white">Make life for happy living</h3>
                    <ul>
                        <li class="mb-4 text-white d-flex">
                            <i class="flaticon-reward flat-medium float-start d-table me-4 text-primary" aria-hidden="true"></i>
                            <div class="ps-2">
                                <h5 class="mb-3">Experience Quality</h5>
                                <p>Ad non vivamus Elementum eget fringilla venenatis quisque, maecenas adipiscing aliquet justo. Libero. Gravida. Sapien, dolor nostra sem. Rutrum conubia inceptos egestas dolor class.</p>
                            </div>
                        </li>
                        <li class="mb-4 text-white d-flex">
                            <i class="flaticon-real-estate flat-medium float-start d-table me-4 text-primary" aria-hidden="true"></i>
                            <div class="ps-2">
                                <h5 class="mb-3">Experience Quality</h5>
                                <p>Ad non vivamus Elementum eget fringilla venenatis quisque, maecenas adipiscing aliquet justo. Libero. Gravida. Sapien, dolor nostra sem. Rutrum conubia inceptos egestas dolor class.</p>
                            </div>
                        </li>
                        <li class="mb-4 text-white d-flex">
                            <i class="flaticon-seller flat-medium float-start d-table me-4 text-primary" aria-hidden="true"></i>
                            <div class="ps-2">
                                <h5 class="mb-3">Experience Quality</h5>
                                <p>Ad non vivamus Elementum eget fringilla venenatis quisque, maecenas adipiscing aliquet justo. Libero. Gravida. Sapien, dolor nostra sem. Rutrum conubia inceptos egestas dolor class.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>-->
<!--============== Happy Living Section End ==============-->

<?php if (count($howItWorks) > 0):?>
<!--============== How It Work Section Start ==============-->
    <div class="full-row bg-white">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-secondary double-down-line text-center">Meet our Executives</h2>
                <span class="text-center mt-4 d-block mb-5">
                      <?php if (isset($websiteSetting) && count($websiteSetting) === 1){ echo $websiteSetting[0]['st_how_it_works']; }?>
                </span>
            </div>
        </div>
        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 single-team">
            <?php foreach($howItWorks as $myhiw): ?>
                <div class="col">
                    <!-- <div class="p-5 mb-4 bg-white shadow-one rounded">
                        <img src="<?php // echo base_url('public/assets/images/howitworks/'.$myhiw['hi_dp']);?>" alt="image">
                        <h5 class="text-secondary py-2 mt-3 mb-2">
                            <?php // echo $myhiw['hi_title'];?>
                        </h5>
                        <p>
                            <?php // echo word_limiter(base64_decode($myhiw['hi_body']), 30);?>
                        </p>
                    </div> -->
                    <div class="single_advisor_profile">
                        <!-- Team Thumb-->
                        <div class="advisor_thumb">
                            <img src="<?php echo base_url('public/assets/images/howitworks/'.$myhiw['hi_dp']);?>" alt="">
                            <!-- Social Info-->
                            <div class="social-info">
                                <?php if(isset($myhiw['hi_facebook']) && !empty($myhiw['hi_facebook'])): ?>
                                    <a href="<?= $myhiw['hi_facebook'] ?>">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                <?php endif;?>
                                <?php if(isset($myhiw['hi_twitter']) && !empty($myhiw['hi_twitter'])): ?>
                                    <a href="<?= $myhiw['hi_twitter'] ?>">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                <?php endif;?>
                                <?php if(isset($myhiw['hi_linkedin']) && !empty($myhiw['hi_linkedin'])): ?>
                                    <a href="<?= $myhiw['hi_linkedin'] ?>">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                <?php endif;?>
                            </div>
                        </div>
                        <!-- Team Details-->
                        <div class="single_advisor_details_info">
                            <h6><?php echo $myhiw['hi_name'];?></h6>
                            <p class="designation"><?php echo $myhiw['hi_post'];?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!--============== How It Work Section End ==============-->
<?php endif; ?>
<!--============== Popular Place Section Start ==============-->
<!--<div class="full-row bg-gray">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-secondary double-down-line text-center">Popular Users</h2>
                <span class="text-center mt-4 d-block mb-5">We listed our oppertunity and servies as a real estate company</span>
            </div>
        </div>
        <div class="row row-cols-lg-4 row-cols-md-2 row-cols-1 g-0">
            <div class="col">
                <div class="overflow-hidden position-relative overlay-secondary hover-zoomer z-index-9"> <img src="<?php /*echo base_url('public/assets/club/images/thumbnail4/1.jpg')*/?>" alt="">
                    <div class="text-white xy-center z-index-9 position-absolute text-center w-100">
                        <h4 class="hover-text-primary"><a href="#">New York</a></h4>
                        <span>31 user Listed</span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="overflow-hidden position-relative overlay-secondary hover-zoomer z-index-9"> <img src="<?php /*echo base_url('public/assets/club/images/thumbnail4/2.jpg')*/?>" alt="">
                    <div class="text-white xy-center z-index-9 position-absolute text-center w-100">
                        <h4 class="hover-text-primary"><a href="#">Florida</a></h4>
                        <span>12 user Listed</span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="overflow-hidden position-relative overlay-secondary hover-zoomer z-index-9"> <img src="<?php /*echo base_url('public/assets/club/images/thumbnail4/3.jpg')*/?>" alt="">
                    <div class="text-white xy-center z-index-9 position-absolute text-center w-100">
                        <h4 class="hover-text-primary"><a href="#">Los Angeles</a></h4>
                        <span>17 user Listed</span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="overflow-hidden position-relative overlay-secondary hover-zoomer z-index-9"> <img src="<?php /*echo base_url('public/assets/club/images/thumbnail4/4.jpg')*/?>" alt="">
                    <div class="text-white xy-center z-index-9 position-absolute text-center w-100">
                        <h4 class="hover-text-primary"><a href="#">Miami</a></h4>
                        <span>25 user Listed</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->
<!--============== Popular Place Section End ==============-->

<!--============== Blog Section Start ==============-->
<?php if (count($newshome)): ?>
<div class="full-row bg-white">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-secondary double-down-line text-center">Recent News</h2>
                <span class="text-center mt-4 d-block mb-5">
                    <?php if (isset($websiteSetting) && count($websiteSetting) === 1){ echo $websiteSetting[0]['st_recent_news']; }?>
                </span>
            </div>
        </div>
        <div class="row">
            <?php foreach ($newshome as $mynews): ?>
`               <div class="col">
                <div class="hover-zoomer thumb-two shadow-one">
                    <div class="overlay-black overflow-hidden position-relative">
                        <img src="<?php echo base_url('public/assets/images/newsEvents/'.$mynews['ne_dp']);?>" alt="image">
                        <div class="date text-white position-absolute z-index-9"><?php echo date('d F, Y', strtotime($mynews[0]['ne_date']));?></div>
                    </div>
                    <div class="p-4">
                        <h6 class="text-secondary hover-text-primary mb-4">
                            <a href="<?php echo site_url('news/readnrews/'.$mynews['ne_id'])?>">
                                Our team are working to provide the owneship of property.
                                <?php echo $mynews['ne_title'];?>
                            </a>
                        </h6>
                        <?php echo word_limiter(base64_decode($mynews['ne_description']), 30);?>
                        <a class="mt-3 text-primary hover-text-secondary" href="<?php echo site_url('news/readnrews/'.$mynews['ne_id'])?>">Read More</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>
<!--============== Blog Section End ==============-->


<!--============== Blog Section Start ==============-->
<?php if (count($eventshome)): ?>

<div class="full-row bg-white">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-secondary double-down-line text-center">Recent Events</h2>
                <span class="text-center mt-4 d-block mb-5">
                    <?php if (isset($websiteSetting) && count($websiteSetting) === 1){ echo $websiteSetting[0]['st_recent_events']; }?>
                </span>
            </div>
        </div>
            <div class="row">
                <?php foreach ($eventshome as $myevent): ?>
                    <div class="col">
                        <div class="hover-zoomer thumb-two shadow-one">
                            <div class="overlay-black overflow-hidden position-relative">
                                <img src="<?php echo base_url('public/assets/images/newsEvents/'.$myevent['ne_dp']);?>" alt="image">
                                <div class="date text-white position-absolute z-index-9"><?php echo $myevent['start_date'] === null? date('d F, Y', strtotime($checkNewEnt[0]['ne_date'])) : "Event Date: " . date('d F, Y', strtotime($myevent['start_date'])) . " - " . date('d F, Y', strtotime($myevent['end_date'])) ?></div>
                            </div>
                            <div class="p-4">
                                <h6 class="text-secondary hover-text-primary mb-4">
                                    <a href="<?php echo site_url('news/readnrews/'.$myevent['ne_id'])?>">
                                        <?php echo $myevent['ne_title'];?>
                                    </a>
                                </h6>
                                <p><?php echo $myevent['ne_short_description'] ?></p>
                                <a class="mt-3 text-primary hover-text-secondary" href="<?php echo site_url('news/readnrews/'.$myevent['ne_id'])?>">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
    </div>
</div>
<?php endif; ?>
<!--============== Blog Section End ==============-->

<!--============== Blog Section Start ==============-->
<?php if (count($onlinemeetings)): ?>

<div class="full-row bg-white">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-secondary double-down-line text-center">Online Meetings</h2>
                <span class="text-center mt-4 d-block mb-5">
                    <!-- <?php if (isset($websiteSetting) && count($websiteSetting) === 1){ echo $websiteSetting[0]['st_recent_events']; }?> -->
                    Zoom meetings are listed here
                </span>
            </div>
        </div>
            <div class="row">
                <?php foreach ($onlinemeetings as $meeting): ?>
                    <div class="col">
                        <div class="hover-zoomer thumb-two shadow-one">
                            <div class="overlay-black overflow-hidden position-relative">
                                <img src="<?php echo base_url('public/assets/images/zoom-placeholder.jpg')?>" alt="image">
                                <div class="date text-white position-absolute z-index-9">November 26, 2018</div>
                            </div>
                            <div class="p-4">
                                <h6 class="text-secondary hover-text-primary mb-4">
                                    <a href="<?php echo site_url('online-meeting/'.$meeting['id'])?>">
                                        <?php echo $meeting['name'];?>
                                    </a>
                                </h6>
                                <p><?php echo $meeting['short_description'] ?></p>
                                <a class="mt-3 text-primary hover-text-secondary" href="<?php echo site_url('online-meeting/'.$meeting['id'])?>">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
    </div>
</div>
<?php endif; ?>
<!--============== Blog Section End ==============-->




<!--============== Blog Section Start ==============-->
<?php if ($calendarData): ?>

    <div class="full-row bg-white">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="text-secondary double-down-line text-center">Events Calendar</h2>
                    <span class="text-center mt-4 d-block mb-5">
                    <?php if (isset($websiteSetting) && count($websiteSetting) === 1){ echo $websiteSetting[0]['st_calendar']; }?>
                </span>
            </div>
            <div class="row">
                <div class="quick-events"></div>
            </div>
        </div>
    </div>
<?php endif; ?>
<!--============== Blog Section End ==============-->
<br><br><br>



<!--============== Massage Box One Section Start ==============-->
<!--<div class="full-row bg-primary py-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="text-white text-center line-height-50">Why do we use it?</h3>
            </div>
        </div>
    </div>
</div>-->
<!--============== Massage Box One Section End ==============-->




