<div class="page-banner full-row bg-gray py-5">
    <div class="container">
        <div class="row row-cols-md-2 row-cols-1 g-3">
            <div class="col">
                <h3 class="page-name text-secondary m-0">Donation - (<?php echo $checkProject[0]['project_name'];?>)</h3>
            </div>
            <div class="col">
                <nav class="float-start float-md-end">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo site_url('donations')?>">Donations</a></li>
                        <li class="breadcrumb-item active">
                            <?php
                                if (count($checkProject) == 1):
                            ?>
                                <?php echo $checkProject[0]['project_name'];?>
                            <?php  endif; ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="full-row bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-details bg-white text-ordinary mb-30">
                    <div class="thumb-two overlay-black overflow-hidden position-relative">
                        <img src="<?php echo base_url('public/assets/images/project/'.$checkProject[0]['project_image']);?>" alt="image">
                        <div class="date text-white position-absolute z-index-9">
                            <?php echo $checkProject[0]['created_at']; ?>
                        </div>
                    </div>
                    <div class="blog-content mt-2">
                        <div class="blog-info">
                            <h4 class="my-4 text-secondary d-flex align-items-center justify-content-between flex-wrap">
                                <?php echo $checkProject[0]['project_name']; ?>
                                <!-- <a href="#" class="btn btn-primary" style="color: #fff !important;">Make Donation</a> -->
                            </h4>
                            <?php
                                echo $checkProject[0]['description'];
                            ?>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="#" class="btn btn-primary">Make Donation</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog-sidebar mt-md-50">
                    <div class="navigation_link_widget">
                        <h4 class="double-down-line-left text-secondary position-relative pb-4 mb-4">Contributors (<?php echo count($contributors) ?>)</h4>
                        <div <?php echo count($contributors) > 2? 'class="read-more-content"' : "" ?>>
                            <?php if ($contributors): ?>
                            <ul>
                                <?php foreach($contributors as $contributor):?>
                                    <li><?php echo $contributor['first_name'] . " " . $contributor['last_name'] ?></li>
                                <?php endforeach;?>  
                            </ul>
                            <?php else: ?>
                                <?php no_data('alert-info','No contributors registered'); ?>
                            <?php endif; ?>
                            <div class="overlay"></div>
                        </div>
                        <?php if (count($contributors) > 2): ?>
                            <a href="#" class="read-more-link" onclick="toggleReadMore(event, this)">Read More</a>
                            <script>
                                function toggleReadMore(event,link) {
                                    event.preventDefault();

                                    var content = link.closest('.navigation_link_widget').querySelector('.read-more-content');
                                    var overlay = content.querySelector('.overlay');

                                    if (link.classList.contains('read-more-link')) {
                                        // Expand the content
                                        content.style.height = content.scrollHeight + 'px';
                                        overlay.style.opacity = 0;
                                        link.classList.remove("read-more-link");
                                        link.classList.add("read-less-link");
                                        link.innerHTML = "Read Less";
                                    } else {
                                        // Collapse the content
                                        content.style.height = '60px'; // Set the initial height
                                        overlay.style.opacity = 1;
                                        link.classList.add("read-more-link");
                                        link.classList.remove("read-less-link");
                                        link.innerHTML = "Read More";
                                    }
                                }
                            </script>
                         <?php endif; ?>
                        <div class="mt-2">
                            <a href="#" class="btn btn-primary">Make Donation</a>
                        </div>
                    </div>
                </div>
                <?php if (count($otherProjects) > 0): ?>
                    <div class="blog-sidebar mt-md-50">
                        <div class="navigation_link_widget mt-5">
                            <h4 class="double-down-line-left text-secondary position-relative pb-4 mb-4">Other Donations</h4>
                            <ul>
                                <?php foreach($otherProjects as $project): ?>
                                    <li><?php $project['project_name']  . ' (' . $project['contributors'] . 'members)' ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                    <?php endif; ?>
            </div>
        </div>
    </div>
</div>