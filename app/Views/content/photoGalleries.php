<div class="page-banner full-row bg-gray py-5">
    <div class="container">
        <div class="row row-cols-md-2 row-cols-1 g-3">
            <div class="col">
                <h3 class="page-name text-secondary m-0">
                    Galleries Album
                </h3>
            </div>
            <div class="col">
                <nav class="float-start float-md-end">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo site_url('galleries')?>">Gallery</a></li>
                        <?php if(count($galleries) > 0 ): ?>
                            <li class="breadcrumb-item active">
                                <?php
                                $myGallery = $galleries;
                                echo $myGallery[0]['gl_name']
                                ?>
                            </li>
                        <?php endif; ?>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="full-row bg-white">
    <div class="container">
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


