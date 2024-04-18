

<div class="page-title parallax parallax4" style="background-position: 50% 28px;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-heading">
                    <h2 class="title">Photo Galleries</h2>
                </div><!-- /.page-title-heading -->
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="<?php echo base_url('');?>">Home</a></li>
                        <li> Photo-Galleries</li>
                    </ul>
                </div><!-- /.breadcrumbs -->
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div>



<section class="main-content blog-posts blog-grid have-sidebar">
    <div class="container">
        <?php if($galleries): ?>
            <div class="blog-title">
                <h1 class="bold"> Photo Galleries</h1>
            </div>
            <div class="row">
                <?php foreach ($galleries as $gallery): ?>
                    <div class="col-md-6  col-lg-4 col-sm-12 col-xs-12 acglryclm">
                            <div class="card acglry">
                                <a href="<?php echo site_url('photo-galleries/program/'.$gallery['ap_id']); ?>">
                                    <img class="card-img-top img-fluid glimg" src="<?php echo base_url('public/assets/images/albProgram/'.$gallery['ap_dp'])?>" alt="<?php echo $gallery['ap_title']; ?>">
                                </a>

                                <div class="card-body crdigbd">
                                    <h5 class="card-title glhd">
                                        <a class="glhdac" href="<?php echo site_url('photo-galleries/program/'.$gallery['ap_id']); ?>">
                                            <?php echo strtoupper($gallery['ap_title']);?>
                                        </a>

                                    </h5>
                                </div>
                            </div>
                        </div>
                <?php endforeach; ?>
            </div>
            <?php echo $pager->links();?>
        <?php else: ?>
            <?php echo no_data('alert-warning','press clips not available');?>
        <?php endif; ?>
    </div>
</section>