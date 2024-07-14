<!--============== Banner Section Start ==============-->
<div class="page-banner full-row bg-gray py-5">
    <div class="container">
        <div class="row row-cols-md-2 row-cols-1 g-3">
            <div class="col">
                <h3 class="page-name text-secondary m-0">Donations</h3>
            </div>
            <div class="col">
                <nav class="float-start float-md-end">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Our Donations</li>
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
        <?php echo checkFlash(); ?>
        <div class="row">
            <?php if ($projects):?>
                <div class="col-lg-12">
                    <div class="row pb-4">
                        <div class="col-md-12">
                            <?php echo form_open('',['method'=>'get', 'class'=>'selecting-command d-flex flex-wrap'])?>
                                <label class="me-10">Shorts By :</label>
                                <div class="select-arrow">
                                    <select name="filter" class="form-control form-select bg-gray">
                                        <option value="" <?php echo $filter === ""? "selected" : "" ?>>Choose Filter</option>
                                        <option value="newest" <?php echo $filter === "newest"? "selected" : "" ?>>Newest First</option>
                                        <option value="oldest" <?php echo $filter === "oldest"? "selected" : "" ?>>Oldest First</option>
                                        <option value="popular" <?php echo $filter === "popular"? "selected" : "" ?>>Most Popular</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary me-30">Filter</button>
                                <?php
                                    $currentPage = $pager->getCurrentPage();
                                    $perPage = $pager->getPerPage();
                                    $totalResults = (int) $totalProjects;

                                    $start = ($currentPage - 1) * $perPage + 1;
                                    $end = min($start + $perPage - 1, $totalResults);
                                ?>
                                <label><?php echo $start . ' - ' . $end ?> of <?php echo $totalProjects; ?> results</label>
                            <?php echo form_close();?>
                        </div>
                    </div>
                    <div class="row row-cols-1 g-4">
                        <?php foreach($projects as $project):?>
                            <div class="col">
                                <div class="profile-list hover-zoomer bg-white shadow-one d-flex">
                                    <div class="profile-data overflow-hidden w-50"> <img src="<?= base_url('public/assets/images/project/'.$project['project_image']) ?>" alt="<?php echo $project['project_name']?>"> </div>
                                    <div class="profile-data p-4 position-relative w-50">
                                        <h5 class="text-secondary hover-text-primary"><a href="<?php echo site_url('donation/read/'.$project['project_id']) ?>"><?php echo $project['project_name']?></a></h5>
                                        <span class="location mb-3 d-block"><i class="fas fa-map-marker-alt text-primary"></i> <?php  echo $project['project_location']; ?></span>
                                        <?php if($project['status'] === "1"): ?>
                                            <div class="rating position-absolute">
                                                <a href="<?php echo site_url('donation/read/'.$project['project_id']) ?>" class="btn btn-primary">Donate</a>
                                            </div>
                                        <?php endif; ?>
                                        <p><?php echo word_limiter($project['short_description'], 25); ?></p>
                                        <div class="py-3 px-4 mt-3 bg-gray">
                                            <div class="progress mb-3">
                                                <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($project['current_amount'] / $project['target_amount']) * 100 ?>%">
                                                    <span class="percent-value"><?php echo ($project['current_amount'] / $project['target_amount']) * 100 ?>%</span>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                Generated $<?= number_format($project['current_amount'], 2) ?> of $<?= number_format($project['target_amount'], 2) ?>.
                                            </div>
                                            <span><?= $project['contributors_count'] ?> Contributors</span>
                                        </div>
                                        <div class="p-4 d-inline-block w-100 author">
                                            <div class="float-start"><i class="fas fa-user text-primary me-1"></i> Created by: <b><?php echo $project['aName'] ?></b></div>
                                            <div class="float-end"><i class="far fa-calendar-alt text-primary me-1"></i> <?php echo timeago($project['created_at']) ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>  
                    </div>
                    <div class="row justify-content-center mt-5">
                        <div class="col-auto">
                            <?php echo $pager->links();?>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <?php no_data('alert-info','No Donations has been created'); ?>
            <?php endif?>
        </div>
    </div>
</div>
<!--============== Property Grid Section End ==============-->