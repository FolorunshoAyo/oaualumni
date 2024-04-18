<div class="col-lg-11 col-xl-10">
    <div class="row">
        <div class="dashboard-panel w-100">
            <h4 class="text-secondary mb-4">Gallery</h4>
            <div class="dashboard-personal-info form-border p-5 bg-white">
                <div class="row brdresi">
                    <div class="col-md-12 col-lg-12 col-sm-12  col-xs-12">
                        <?php if($galleries): ?>
                            <div class="row">
                                <?php foreach ($galleries as $gallery): ?>
                                    <?php if (getSingleImage($gallery['gl_id']) != false): ?>
                                        <div class="col-md-6  col-lg-4 col-sm-12 col-xs-12 acglryclm">
                                            <div class="card acglry">
                                                <a href="<?php echo site_url('user/galleryimages/'.$gallery['gl_id']); ?>">
                                                    <img class="card-img-top img-fluid glimg" src="<?php echo getSingleImage($gallery['gl_id'])?>" alt="<?php echo $gallery['gl_name']?>">
                                                </a>

                                                <div class="card-body crdigbd">
                                                    <h5 class="card-title glhd">
                                                        <a class="glhdac" href="<?php echo site_url('user/galleryimages/'.$gallery['gl_id']); ?>">
                                                            <?php echo $gallery['gl_name'];?>
                                                        </a>

                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif;  ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="mbp_pagination">
                                <?php echo $pager->links();?>
                            </div>
                        <?php else: ?>
                            <?php echo no_data('alert-warning','Album not available in this program .');?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php  userdashboardFooter(); ?>
    </div>
</div>