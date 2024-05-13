<div class="page-banner full-row bg-gray py-5">
    <div class="container">
        <div class="row row-cols-md-2 row-cols-1 g-3">
            <div class="col">
                <h3 class="page-name text-secondary m-0">Events</h3>
            </div>
            <div class="col">
                <nav class="float-start float-md-end">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
                        <li class="breadcrumb-item active">Events</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="full-row bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 order-lg-2">
                <div class="blog-sidebar mt-md-50">
                    <div class="search_widget">
                        <?php echo form_open('',['method'=>'get'])?>
                        <div class="form-group">
                            <?php echo form_input('sn',$filtrs['sn'],['class'=>'form-control','placeholder'=>'Search News'])?>
                        </div>
                        <?php echo form_close();?>
                        <div class="" style="margin-top: 20px;">
                            <?php if ($calendarData) :?>
                                    <div  class="quick-events"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- <div class="navigation_link_widget mt-5">
                         <h4 class="double-down-line-left text-secondary position-relative pb-4 mb-4">Categories</h4>
                         <ul>
                             <li><a href="#">Housing Properties (05)</a></li>
                             <li><a href="#">Appartment (01)</a></li>
                             <li><a href="#">Luxury Condos (03)</a></li>
                             <li><a href="#">Construction (04)</a></li>
                             <li><a href="#">Green Villas (02)</a></li>
                             <li><a href="#">Commertial (06)</a></li>
                         </ul>
                     </div>
                     <div class="recent_post_widget mt-5">
                         <h4 class="double-down-line-left text-secondary position-relative pb-4 mb-4">Recent Post</h4>
                         <ul>
                             <li>
                                 <a href="#"><img src="assets/images/thumbnaillist/01.jpg" alt=""></a>
                                 <div class="post-info">
                                     <h6 class="text-secondary hover-text-primary"><a href="#">Your investment is our heart.</a></h6>
                                     <span>February 22, 2021</span> </div>
                             </li>
                             <li>
                                 <a href="#"><img src="assets/images/thumbnaillist/02.jpg" alt=""></a>
                                 <div class="post-info">
                                     <h6 class="text-secondary hover-text-primary"><a href="#">Our team are working to provide.</a></h6>
                                     <span>February 20, 2021</span> </div>
                             </li>
                             <li>
                                 <a href="#"><img src="assets/images/thumbnaillist/03.jpg" alt=""></a>
                                 <div class="post-info">
                                     <h6 class="text-secondary hover-text-primary"><a href="#">Your investment is our heart.</a></h6>
                                     <span>February 15, 2021</span> </div>
                             </li>
                             <li>
                                 <a href="#"><img src="assets/images/thumbnaillist/04.jpg" alt=""></a>
                                 <div class="post-info">
                                     <h6 class="text-secondary hover-text-primary"><a href="#">Our team are working to provide.</a></h6>
                                     <span>February 02, 2021</span> </div>
                             </li>
                         </ul>
                     </div>
                     <div class="property_list_widget mt-5">
                         <h4 class="double-down-line-left text-secondary position-relative pb-4 mb-4">Latest Property</h4>
                         <ul>
                             <li>
                                 <a href="#"><img src="assets/images/thumbnaillist/01.jpg" alt=""></a>
                                 <div class="thumb-body">
                                     <h6 class="text-secondary hover-text-primary"><a href="property-single-1.html">Nirala Appartment</a></h6>
                                     <span class="font-14"><i class="fas fa-map-marker-alt icon-primary icon-small"></i> Avenue South Burlington, Los Angles</span>
                                     <div class="mt-2 d-flex">
                                         <span class="text-primary h6">$1280 <sub>/ Mo</sub></span>
                                         <span class="mx-2">|</span>
                                         <span class="text-secondary">Housing</span>
                                     </div>
                                 </div>
                             </li>
                             <li>
                                 <a href="#"><img src="assets/images/thumbnaillist/02.jpg" alt=""></a>
                                 <div class="thumb-body">
                                     <h6 class="text-secondary hover-text-primary"><a href="property-single-1.html">New Luxury Condos</a></h6>
                                     <span class="font-14"><i class="fas fa-map-marker-alt icon-primary icon-small"></i> Avenue South Burlington, Los Angles</span>
                                     <div class="mt-2 d-flex">
                                         <span class="text-primary h6">$1280 <sub>/ Mo</sub></span>
                                         <span class="mx-2">|</span>
                                         <span class="text-secondary">Housing</span>
                                     </div>
                                 </div>
                             </li>
                             <li>
                                 <a href="#"><img src="assets/images/thumbnaillist/03.jpg" alt=""></a>
                                 <div class="thumb-body">
                                     <h6 class="text-secondary hover-text-primary"><a href="property-single-1.html">Zarafaloz Appartment</a></h6>
                                     <span class="font-14"><i class="fas fa-map-marker-alt icon-primary icon-small"></i> Avenue South Burlington, Los Angles</span>
                                     <div class="mt-2 d-flex">
                                         <span class="text-primary h6">$1280 <sub>/ Mo</sub></span>
                                         <span class="mx-2">|</span>
                                         <span class="text-secondary">Housing</span>
                                     </div>
                                 </div>
                             </li>
                             <li>
                                 <a href="#"><img src="assets/images/thumbnaillist/04.jpg" alt=""></a>
                                 <div class="thumb-body">
                                     <h6 class="text-secondary hover-text-primary"><a href="property-single-1.html">Monopuly Trade Center</a></h6>
                                     <span class="font-14"><i class="fas fa-map-marker-alt icon-primary icon-small"></i> Avenue South Burlington, Los Angles</span>
                                     <div class="mt-2 d-flex">
                                         <span class="text-primary h6">$1280 <sub>/ Mo</sub></span>
                                         <span class="mx-2">|</span>
                                         <span class="text-secondary">Housing</span>
                                     </div>
                                 </div>
                             </li>
                         </ul>
                     </div>
                     <div class="featured_property_widget mt-5">
                         <h4 class="mt-5 mb-4 text-secondary">Featured Property</h4>
                         <div class="owl-carousel featured-property owl-loaded owl-drag">



                             <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-1338px, 0px, 0px); transition: all 0.25s ease 0s; width: 3122px;"><div class="owl-item cloned" style="width: 416px; margin-right: 30px;"><div class="featured-thumb hover-zoomer mb-4 bg-gray">
                                             <div class="overlay-black overflow-hidden position-relative"> <img src="assets/images/thumbnail/02.jpg" alt="">
                                                 <div class="featured bg-primary text-white">Featured</div>
                                                 <div class="sale bg-secondary text-white">For Sale</div>
                                                 <div class="price text-primary">$212,000 <span class="text-white">$1200/Sqft</span></div>
                                                 <div class="starmark text-white"><i class="far fa-star"></i></div>
                                             </div>
                                             <div class="featured-thumb-data">
                                                 <div class="p-4">
                                                     <h5 class="text-secondary hover-text-primary mb-2"><a href="#">Apolo Family Appartment</a></h5>
                                                     <span class="location"><i class="fas fa-map-marker-alt text-primary"></i> Avenue South Burlington, Los Angles</span> </div>
                                             </div>
                                         </div></div><div class="owl-item cloned" style="width: 416px; margin-right: 30px;"><div class="featured-thumb hover-zoomer mb-4 bg-gray">
                                             <div class="overlay-black overflow-hidden position-relative"> <img src="assets/images/thumbnail/03.jpg" alt="">
                                                 <div class="featured bg-primary text-white">Featured</div>
                                                 <div class="sale bg-secondary text-white">For Sale</div>
                                                 <div class="price text-primary">$52,000 <span class="text-white">$1200/Sqft</span></div>
                                                 <div class="starmark text-white"><i class="far fa-star"></i></div>
                                             </div>
                                             <div class="featured-thumb-data">
                                                 <div class="p-4">
                                                     <h5 class="text-secondary hover-text-primary mb-2"><a href="#">Office Floor In Trade Center</a></h5>
                                                     <span class="location"><i class="fas fa-map-marker-alt text-primary"></i> Avenue South Burlington, Los Angles</span> </div>
                                             </div>
                                         </div></div><div class="owl-item" style="width: 416px; margin-right: 30px;"><div class="featured-thumb hover-zoomer mb-4 bg-gray">
                                             <div class="overlay-black overflow-hidden position-relative"> <img src="assets/images/thumbnail/01.jpg" alt="">
                                                 <div class="featured bg-primary text-white">Featured</div>
                                                 <div class="sale bg-secondary text-white">For Sale</div>
                                                 <div class="price text-primary">$352,000 <span class="text-white">$1200/Sqft</span></div>
                                                 <div class="starmark text-white"><i class="far fa-star"></i></div>
                                             </div>
                                             <div class="featured-thumb-data">
                                                 <div class="p-4">
                                                     <h5 class="text-secondary hover-text-primary mb-2"><a href="#">Nirala Appartment</a></h5>
                                                     <span class="location"><i class="fas fa-map-marker-alt text-primary"></i> Avenue South Burlington, Los Angles</span> </div>
                                             </div>
                                         </div></div><div class="owl-item active" style="width: 416px; margin-right: 30px;"><div class="featured-thumb hover-zoomer mb-4 bg-gray">
                                             <div class="overlay-black overflow-hidden position-relative"> <img src="assets/images/thumbnail/02.jpg" alt="">
                                                 <div class="featured bg-primary text-white">Featured</div>
                                                 <div class="sale bg-secondary text-white">For Sale</div>
                                                 <div class="price text-primary">$212,000 <span class="text-white">$1200/Sqft</span></div>
                                                 <div class="starmark text-white"><i class="far fa-star"></i></div>
                                             </div>
                                             <div class="featured-thumb-data">
                                                 <div class="p-4">
                                                     <h5 class="text-secondary hover-text-primary mb-2"><a href="#">Apolo Family Appartment</a></h5>
                                                     <span class="location"><i class="fas fa-map-marker-alt text-primary"></i> Avenue South Burlington, Los Angles</span> </div>
                                             </div>
                                         </div></div><div class="owl-item" style="width: 416px; margin-right: 30px;"><div class="featured-thumb hover-zoomer mb-4 bg-gray">
                                             <div class="overlay-black overflow-hidden position-relative"> <img src="assets/images/thumbnail/03.jpg" alt="">
                                                 <div class="featured bg-primary text-white">Featured</div>
                                                 <div class="sale bg-secondary text-white">For Sale</div>
                                                 <div class="price text-primary">$52,000 <span class="text-white">$1200/Sqft</span></div>
                                                 <div class="starmark text-white"><i class="far fa-star"></i></div>
                                             </div>
                                             <div class="featured-thumb-data">
                                                 <div class="p-4">
                                                     <h5 class="text-secondary hover-text-primary mb-2"><a href="#">Office Floor In Trade Center</a></h5>
                                                     <span class="location"><i class="fas fa-map-marker-alt text-primary"></i> Avenue South Burlington, Los Angles</span> </div>
                                             </div>
                                         </div></div><div class="owl-item cloned" style="width: 416px; margin-right: 30px;"><div class="featured-thumb hover-zoomer mb-4 bg-gray">
                                             <div class="overlay-black overflow-hidden position-relative"> <img src="assets/images/thumbnail/01.jpg" alt="">
                                                 <div class="featured bg-primary text-white">Featured</div>
                                                 <div class="sale bg-secondary text-white">For Sale</div>
                                                 <div class="price text-primary">$352,000 <span class="text-white">$1200/Sqft</span></div>
                                                 <div class="starmark text-white"><i class="far fa-star"></i></div>
                                             </div>
                                             <div class="featured-thumb-data">
                                                 <div class="p-4">
                                                     <h5 class="text-secondary hover-text-primary mb-2"><a href="#">Nirala Appartment</a></h5>
                                                     <span class="location"><i class="fas fa-map-marker-alt text-primary"></i> Avenue South Burlington, Los Angles</span> </div>
                                             </div>
                                         </div></div><div class="owl-item cloned" style="width: 416px; margin-right: 30px;"><div class="featured-thumb hover-zoomer mb-4 bg-gray">
                                             <div class="overlay-black overflow-hidden position-relative"> <img src="assets/images/thumbnail/02.jpg" alt="">
                                                 <div class="featured bg-primary text-white">Featured</div>
                                                 <div class="sale bg-secondary text-white">For Sale</div>
                                                 <div class="price text-primary">$212,000 <span class="text-white">$1200/Sqft</span></div>
                                                 <div class="starmark text-white"><i class="far fa-star"></i></div>
                                             </div>
                                             <div class="featured-thumb-data">
                                                 <div class="p-4">
                                                     <h5 class="text-secondary hover-text-primary mb-2"><a href="#">Apolo Family Appartment</a></h5>
                                                     <span class="location"><i class="fas fa-map-marker-alt text-primary"></i> Avenue South Burlington, Los Angles</span> </div>
                                             </div>
                                         </div></div></div></div><div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span class="fa fa-angle-left"></span></button><button type="button" role="presentation" class="owl-next"><span class="fa fa-angle-right"></span></button></div><div class="owl-dots disabled"></div></div>
                     </div>-->
                </div>
            </div>
            <div class="col-lg-8 order-lg-1">
                <div class="row row-cols-md-2 row-cols-1 g-4">
                    <?php if ($news): ?>
                        <?php
                        foreach ($news as $mynews):
                            ?>
                            <div class="col">
                                <div class="hover-zoomer thumb-two shadow-one">
                                    <div class="overlay-black overflow-hidden position-relative">
                                        <img src="<?php echo base_url('public/assets/images/newsEvents/'.$mynews['ne_dp']);?>" alt="image">
                                        <div class="date text-white position-absolute z-index-9">
                                            <?php echo $mynews['ne_date'];?>
                                            <!-- November 26, 2018-->
                                        </div>
                                    </div>
                                    <div class="p-4">
                                        <h6 class="text-secondary hover-text-primary mb-4">
                                            <a href="<?php echo site_url('events/read/' . $mynews['ne_id']);  ?>">
                                                <?php echo $mynews['ne_title'];?>
                                            </a>
                                        </h6>
                                        <?php echo $mynews['ne_short_description'];?>
                                        <div>
                                            <a class="mt-3 text-primary hover-text-secondary" href="<?php echo site_url('events/read/' . $mynews['ne_id']);  ?>">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    <?php else: ?>
                        <?php echo no_data('alert-warning','News not available');?>
                    <?php endif; ?>

                </div>
                <div class="mbp_pagination">
                   <?php echo $pager->links();?>
                </div>
            </div>
        </div>
    </div>
</div>