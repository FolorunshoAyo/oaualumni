<div class="page-banner full-row bg-gray py-5">
    <div class="container">
        <div class="row row-cols-md-2 row-cols-1 g-3">
            <div class="col">
                <h3 class="page-name text-secondary m-0">Gallery</h3>
            </div>
            <div class="col">
                <nav class="float-start float-md-end">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
                        <li class="breadcrumb-item active">Gallery</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<div class="full-row bg-white">
    <div class="container">
        <?php if($galleries): ?>
            <div class="row">
                <?php foreach ($galleries as $gallery): ?>
                    <?php if (getSingleImage($gallery['gl_id']) != false): ?>
                        <div class="col-md-6  col-lg-4 col-sm-12 col-xs-12 acglryclm">
                            <div class="card acglry">
                                <a href="<?php echo site_url('galleries/photos/'.$gallery['gl_id']); ?>">
                                    <img class="card-img-top img-fluid glimg" src="<?php echo getSingleImage($gallery['gl_id'])?>" alt="<?php echo $gallery['gl_name']?>">
                                </a>

                                <div class="card-body crdigbd">
                                    <h5 class="card-title glhd">
                                        <a class="glhdac" href="<?php echo site_url('galleries/photos/'.$gallery['gl_id']); ?>">
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