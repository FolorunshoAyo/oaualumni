<!--============== Banner Section Start ==============-->
<div class="page-banner full-row bg-gray py-5">
    <div class="container">
        <div class="row row-cols-md-2 row-cols-1 g-3">
            <div class="col">
                <h3 class="page-name text-secondary m-0">Online Meetings</h3>
            </div>
            <div class="col">
                <nav class="float-start float-md-end">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Our Online Meetings</li>
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
            <?php if ($meetings):?>
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
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary me-30">Filter</button>
                                <?php
                                    $currentPage = $pager->getCurrentPage();
                                    $perPage = $pager->getPerPage();
                                    $totalResults = (int) $totalMeetings;

                                    $start = ($currentPage - 1) * $perPage + 1;
                                    $end = min($start + $perPage - 1, $totalResults);
                                ?>
                                <label><?php echo $start . ' - ' . $end ?> of <?php echo $totalMeetings; ?> results</label>
                            <?php echo form_close();?>
                        </div>
                    </div>
                    <div class="row row-cols-1 g-4">
                        <?php foreach($meetings as $meeting):?>
                            <div class="col">
                                <div class="featured-thumb list hover-zoomer">
                                    <div class="overflow-hidden position-relative image-area"> 
                                        <img src="<?= base_url('public/assets/images/zoom-placeholder.jpg') ?>" alt="<?php echo $meeting['name']?>">
                                    </div>
                                    <div class="featured-thumb-data shadow-one">
                                        <div class="p-4">
                                            <h5 class="text-secondary hover-text-primary mb-2"><a href="<?php echo site_url('online-meeting/read/'.$meeting['id']) ?>"><?php echo $meeting['name']?></a></h5>
                                        </div>
                                        <div class="bg-gray quantity p-4">
                                            <!-- <ul>
                                                <li class="pb-0"><i class="fas fa-users text-primary"></i> <span><?php // echo $meeting['member_count'] ?></span> Members</li>
                                            </ul> -->
                                            <p><?php echo word_limiter($meeting['short_description'], 25); ?></p>
                                        </div>
                                        <div class="p-4 d-inline-block w-100 author">
                                            <div class="float-start"><i class="fas fa-user text-primary me-1"></i> Created by: <b><?php echo $meeting['aName'] ?></b></div>
                                            <div class="float-end"><i class="far fa-calendar-alt text-primary me-1"></i> <?php echo timeago($meeting['created_at']) ?></div>
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
                <?php no_data('alert-info','No online meeting has been created'); ?>
            <?php endif?>
        </div>
    </div>
</div>
<!--============== Property Grid Section End ==============-->