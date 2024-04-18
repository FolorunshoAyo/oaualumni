<!--============== Banner Section Start ==============-->
<div class="page-banner full-row bg-gray py-5">
    <div class="container">
        <div class="row row-cols-md-2 row-cols-1 g-3">
            <div class="col">
                <h3 class="page-name text-secondary m-0">Interest Groups</h3>
            </div>
            <div class="col">
                <nav class="float-start float-md-end">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Our Interest Groups</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!--============== Banner Section End ==============-->

<!--============== Property Grid Section Start ==============-->
<div class="full-row bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row pb-4">
                    <div class="col-md-12">
                        <form class="selecting-command d-flex flex-wrap" method="get">
                            <label class="me-10">Shorts By :</label>
                            <div class="select-arrow me-30">
                                <select class="form-control form-select bg-gray">
                                    <option>Newest First</option>
                                    <option>Oldest First</option>
                                    <option>Most Popular</option>
                                </select>
                            </div>
                            <?php
                                $currentPage = $pager->getCurrentPage();
                                $perPage = $pager->getPerPage();
                                $totalResults = (int) $totalGroups;

                                $start = ($currentPage - 1) * $perPage + 1;
                                $end = min($start + $perPage - 1, $totalResults);
                            ?>
                            <label><?php echo $start . ' - ' . $end ?> of <?php echo $totalGroups; ?> results</label>
                        </form>
                    </div>
                </div>
                <div class="row row-cols-1 g-4">
                    <div class="col">
                        <div class="featured-thumb list hover-zoomer">
                            <div class="overlay-black overflow-hidden position-relative image-area"> 
                                <img src="<?= site_url("/public/assets/club/homex/assets/images/thumbnail/01.jpg") ?>" alt="">
                            </div>
                            <div class="featured-thumb-data shadow-one">
                                <div class="p-4">
                                    <h5 class="text-secondary hover-text-primary mb-2"><a href="#">Health, Fitness, Weight Loss</a></h5>
                                    <span class="location"><i class="fas fa-map-marker-alt text-primary"></i> Some Location, Los Angles</span>
                                </div>
                                <div class="bg-gray quantity p-4">
                                    <ul>
                                        <li class="pb-0"><i class="fas fa-users text-primary"></i> <span>40</span> Members</li>
                                    </ul>
                                    <p>A simple description to confuse the enemies</p>
                                </div>
                                <div class="p-4 d-inline-block w-100 author">
                                    <div class="float-start"><i class="fas fa-user text-primary me-1"></i> Created by: <b>Jeson Billiam</b></div>
                                    <div class="float-end"><i class="far fa-calendar-alt text-primary me-1"></i> 6 Months Ago</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-5">
                    <div class="col-auto">
                        <?php echo $pager->links();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--============== Property Grid Section End ==============-->