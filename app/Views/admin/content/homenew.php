
<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START CONTENT -->
<div class="content">

	<!-- Start Page Header -->
	<div class="page-header">
		<h1 class="title">Dashboard</h1>
	</div>
	<!-- End Page Header -->


	<!-- //////////////////////////////////////////////////////////////////////////// -->
	<!-- START CONTAINER -->
	<div class="container-widget">

		<!-- Start Top Stats -->
		<?php if(isAdmin()): ?>
		    <div class="row">
                <div class="col-md-12">
                    <ul class="topstats clearfix">

                        <li class="col-xs-6 col-lg-2">
                            <span class="title">
                                <i class="fa fa-users"></i>
                                <a href="<?php echo site_url('admin/users'); ?>">Active Users</a>
                            </span>
                                    <h3>
                                        <?php
                                        echo count($users);
                                        ?></h3>
                                    <span class="diff">
                                <b class="">
                                <?php
                                echo count($pendingUsers);
                                ?>
                                </b> Pending Users
                            </span>
                        </li>
                        <li class="col-xs-6 col-lg-2">
                            <span class="title">
                                <i class="fa fa-users"></i>
                                <a href="<?php echo site_url('admin/all-news-and-events'); ?>">News & Events</a>
                            </span>
                                    <h3>
                                        <?php
                                        echo count($NewsEvents);
                                        ?></h3>
                                    <span class="diff">
                                <b class="">
                                <?php
                                echo count($totalEvents);
                                ?>
                                </b> Events
                                <b class="">
                                <?php
                                echo count($totalNews);
                                ?>
                                </b> News
                            </span>
                        </li>

                        <li class="col-xs-6 col-lg-2">
                            <span class="title">
                                <i class="fa fa-users"></i>
                                <a href="<?php echo site_url('admin/all-how-it-works'); ?>">How it Works</a>
                            </span>
                            <h3>
                                <?php
                                echo count($totalHowitWorks);
                                ?></h3>
                        </li>
                        <li class="col-xs-6 col-lg-2">
                            <span class="title">
                                <i class="fa fa-users"></i>
                                <a href="<?php echo site_url('admin/all-albums'); ?>">Albums</a>
                            </span>
                            <h3>
                                <?php
                                echo count($totalGallery);
                                ?></h3>
                        </li>
                        <li class="col-xs-6 col-lg-2">
                            <span class="title">
                                <i class="fa fa-users"></i>
                                <a href="<?php echo site_url('admin/view-album-images'); ?>">Gallery Images</a>
                            </span>
                            <h3>
                                <?php
                                echo count($totalGalleryImages);
                                ?></h3>
                        </li>
                        <li class="col-xs-6 col-lg-2">
                            <span class="title">
                                <i class="fa fa-users"></i>
                                <a href="<?php echo site_url('admin/all-slider'); ?>">Sliders</a>
                            </span>
                            <h3>
                                <?php
                                echo count($sliders);
                                ?></h3>
                        </li>
                    </ul>
                </div>
            </div>
		<?php endif; ?>
		<!-- End Top Stats -->

    <div class="row mt-50 skzMconWhite">
        <div class="col-md-6">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>News and Events</b></h4>
                <?php if (count($NewsEvents) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover m-0 table-actions-bar">

                            <thead>
                            <tr>
                                <th>Picture</th>
                                <th>Title</th>
                                <th>Body/Description</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($NewsEvents as $skzNews): ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo base_url('public/assets/images/newsEvents/'.$skzNews['ne_dp'])?>" alt="<?php echo $skzNews['ne_title']?>" title="<?php echo $skzNews['ne_title']?>" class="rounded-circle thumb-sm"  style="width: 200px;">
                                    </td>

                                    <td>
                                        <h5 class="m-b-0 m-t-0 font-600">
                                            <?php echo $skzNews['ne_title']?>
                                        </h5>
                                    </td>

                                    <td>
                                        <?php echo character_limiter(base64_decode($skzNews['ne_description']),20); ?>
                                    </td>

                                    <td>
                                        <i class="mdi mdi-clock text-success"></i>
                                        <?php echo $skzNews['ne_date']?>
                                    </td>

                                    <td>
                                        <?php if($skzNews['ne_status'] == 0): ?>
                                            <button class="btn btn-danger">Disabled</button>
                                        <?php else: ?>
                                            <button class="btn btn-success">active</button>
                                        <?php endif;?>
                                    </td>

                                    <td>
                                        <a href="<?php echo site_url('admin/edit-news-and-events/'.$skzNews['ne_id'])?>" class="table-action-btn"><i class="mdi mdi-pencil"></i></a>
                                        <a  href="javascript:void(0)" class="table-action-btn newsEventsDrop" data-text="<?php echo site_url('admin/delete-news-and-events/'.$skzNews['ne_id'].'/'.$skzNews['ne_dp']); ?>">
                                            <i class="mdi mdi-close"></i>
                                        </a>
                                    </td>

                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>

                <?php endif;?>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><b>Our Executives</b></h4>
                <?php if (count($howItWorks) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover m-0 table-actions-bar">

                            <thead>
                            <tr>
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Post</th>
                                <th>Is Featured</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($howItWorks as $skzhowitworks): ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo base_url('public/assets/images/howitworks/'.$skzhowitworks['hi_dp'])?>" alt="<?php echo $skzNews['ne_title']?>" title="<?php echo $skzNews['ne_title']?>" class="rounded-circle thumb-sm"  style="width: 200px;">
                                    </td>

                                    <td>
                                        <h5 class="m-b-0 m-t-0 font-600">
                                            <?php echo $skzhowitworks['hi_name']?>
                                        </h5>
                                    </td>

                                    <td>
                                        <?php 
                                            // echo character_limiter(base64_decode($skzhowitworks['hi_body']),20);
                                            echo $skzhowitworks['hi_post'];
                                         ?>
                                    </td>

                                    <td>
                                        <?php if($skzhowitworks['hi_set_featured'] == 0): ?>
                                            <button class="btn btn-danger">No</button>
                                        <?php else: ?>
                                            <button class="btn btn-success">Yes</button>
                                        <?php endif;?>
                                    </td>

                                    <td>
                                        <i class="mdi mdi-clock text-success"></i>
                                        <?php echo $skzhowitworks['hi_date']?>
                                    </td>

                                    <td>
                                        <?php if($skzhowitworks['hi_status'] == 0): ?>
                                            <button class="btn btn-danger">Disabled</button>
                                        <?php else: ?>
                                            <button class="btn btn-success">active</button>
                                        <?php endif;?>
                                    </td>

                                    <td>
                                        <a href="<?php echo site_url('admin/edit-news-and-events/'.$skzhowitworks['hi_id'])?>" class="table-action-btn"><i class="mdi mdi-pencil"></i></a>
                                        <a  href="javascript:void(0)" class="table-action-btn newsEventsDrop" data-text="<?php echo site_url('admin/delete-news-and-events/'.$skzhowitworks['hi_id'].'/'.$skzhowitworks['hi_dp']); ?>">
                                            <i class="mdi mdi-close"></i>
                                        </a>
                                    </td>

                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>

                <?php endif;?>
            </div>
        </div>
    </div>







	</div>
	<!-- END CONTAINER -->
	<!-- //////////////////////////////////////////////////////////////////////////// -->




</div>
<!-- End Content -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
