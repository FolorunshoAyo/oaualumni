<div class="col-lg-11 col-xl-10">
    <div class="row">
        <div class="dashboard-panel w-100">
            <h4 class="text-secondary mb-4">Gallery Images</h4>
            <div class="dashboard-personal-info form-border p-5 bg-white">
                <div class="row brdresi">
                    <div class="col-md-12 col-lg-12 col-sm-12  col-xs-12">
                        <?php if(count($galleries) > 0 ): ?>
                            <div class="row">
                                <div class="col-md-12 pdz">
                                    <div class="blog-title">
                                        <h1 class="bold">
                                            <?php
                                            $myGallery = $galleries;
                                            echo $myGallery[0]['gl_name']
                                            ?>
                                        </h1>
                                    </div>
                                </div>
                                <div class="demo-gallery">
                                    <ul id="lightgallery" class="list-unstyled row xkksi">
                                        <?php foreach ($galleries as $gallery): ?>

                                            <li class="col-md-3" data-responsive="<?php echo base_url('public/assets/images/galleryImages/'.$gallery['gi_name']);  ?>," data-src="<?php echo base_url('public/assets/images/galleryImages/'.$gallery['gi_name']);?>">
                                                <a href="">
                                                    <img class="img-responsive glingmni" src="<?php echo base_url('public/assets/images/galleryImages/'.$gallery['gi_name']);  ?>">
                                                </a>
                                            </li>


                                            <!-- <div class="col-md-4">
                            <div class="card glidv">
                                <a href="<?php /*echo site_url('photo-galleries/gallery/'.$gallery->gl_id); */?>">
                                    <img class="card-img-top img-fluid glimg" src="<?php /*echo base_url('assets/images/galleryImages/'.$gallery->gi_name);  */?>" alt="<?php /*echo $gallery->gl_name*/?>>
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title glhd">
                                    </h5>
                            </div>
                        </div>-->
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php echo no_data('alert-warning','Images  not available');?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php  userdashboardFooter(); ?>
    </div>
</div>