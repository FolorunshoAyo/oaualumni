<!--=================================-->
<!--=         Upcoming Event        =-->
<!--=================================-->
<?php if (count($upcomingevents) > 0): ?>
<section id="upcoming-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="upcoming-event-wrap">
                    <div class="up-event-titile">
                        <h3>Upcoming event</h3>
                    </div>
                    <div class="upcoming-event-content owl-carousel">
                        <?php foreach($upcomingevents as $upcomingevent): ?>
                            <!-- No 1 Event -->
                            <div class="single-upcoming-event">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="up-event-thumb">
                                            <img src="<?php echo base_url('public/assets/images/newsEvents/' . $upcomingevent->ne_dp)?>" class="img-fluid" alt="<?php echo $upcomingevent->ne_title ?>">
                                            <h4 class="up-event-date">It’s <?php echo date('d F Y', strtotime($upcomingevent->start_date)) ?></h4>
                                        </div>
                                    </div>

                                    <div class="col-lg-7">
                                        <div class="display-table">
                                            <div class="display-table-cell">
                                                <div class="up-event-text">
                                                    <div class="event-countdown">
                                                        <div class="event-countdown-counter" data-event-date="<?php echo date('Y/n/j', strtotime($upcomingevent->start_date)); ?>"></div>
                                                        <p>Remaining</p>
                                                    </div>
                                                    <h3><a href="single-event.html"><?php echo $upcomingevent->ne_title ?></a></h3>
                                                    <p><?php echo word_limiter(base64_decode($upcomingevent->ne_description), 30);?></p>
                                                    <a href="<?php echo site_url("events/read/" . $upcomingevent->ne_id) ?>" class="btn btn-primary">Join
                                                        with us</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- partial -->
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>