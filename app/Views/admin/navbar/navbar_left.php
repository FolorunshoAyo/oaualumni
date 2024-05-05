
<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START SIDEBAR -->
<div class="sidebar clearfix">

	<ul class="sidebar-panel nav">
		<li class="sidetitle">MAIN</li>
		<li><a href="<?php echo site_url('admin')?>"><span class="icon color5"><i class="fa fa-home"></i></span>Dashboard<!--<span class="label label-default">2</span>--></a></li>
		<!--<li><a href="mailbox.html"><span class="icon color6"><i class="fa fa-envelope-o"></i></span>Mailbox<span class="label label-default">19</span></a></li>-->
		<?php if (isSuperAdmin()):?>
            <li><a href="#"><span class="icon color9"><i class="fa fa-user"></i></span>Admins<span class="caret"></span></a>
                <ul>
                    <li><a href="<?php echo site_url('admin/newadmin')?>">Create Admin</a></li>
                    <li><a href="<?php echo site_url('admin/all')?>">All Admins</a></li>
                </ul>
            </li>
            <li><a href="#"><span class="icon color9"><i class="fa fa-user"></i></span>Users<span class="caret"></span></a>
                <ul>
                    <li><a href="<?php echo site_url('admin/users')?>">Active Users</a></li>
                    <li><a href="<?php echo site_url('admin/pendingusers')?>">InActive Users</a></li>
                </ul>
            </li>
            <li><a href="#"><span class="icon color9"><i class="fa fa-user"></i></span>News/Events<span class="caret"></span></a>
                <ul>
                    <li><a href="<?php echo site_url('admin/new-news-and-event?cat=news')?>">Add News/Events</a></li>
                    <li><a href="<?php echo site_url('admin/all-news-and-events')?>">All News/Events</a></li>
                </ul>
            </li>
            <li><a href="#"><span class="icon color9"><i class="fa fa-user"></i></span>Calendar<span class="caret"></span></a>
                <ul>
                    <li><a href="<?php echo site_url('admin/new-calendar')?>">Add Calendar</a></li>
                    <li><a href="<?php echo site_url('admin/all-calendar')?>">Calendars Data</a></li>

                </ul>
            </li>
            <li><a href="#"><span class="icon color9"><i class="fa fa-user"></i></span>What We Do<span class="caret"></span></a>
                <ul>
                    <li><a href="<?php echo site_url('admin/new-about-section')?>">Add What We Do</a></li>
                    <li><a href="<?php echo site_url('admin/all-about-sections')?>">What We Do Sections</a></li>
                </ul>
            </li>
            <li><a href="#"><span class="icon color9"><i class="fa fa-user"></i></span>Our Executives<span class="caret"></span></a>
                <ul>
                    <li><a href="<?php echo site_url('admin/new-how-it-works')?>">Add Executive</a></li>
                    <li><a href="<?php echo site_url('admin/all-how-it-works')?>">Executives</a></li>
                </ul>
            </li>
            <li><a href="#"><span class="icon color9"><i class="fa fa-user"></i></span>Our Alumni<span class="caret"></span></a>
                <ul>
                    <li><a href="<?php echo site_url('admin/new-alumni')?>">Add Alumni</a></li>
                    <li><a href="<?php echo site_url('admin/all-alumni')?>">Alumni</a></li>
                </ul>
            </li>
            <li><a href="#"><span class="icon color9"><i class="fa fa-user"></i></span>Our Interest Groups<span class="caret"></span></a>
                <ul>
                    <li><a href="<?php echo site_url('admin/new-interest-group')?>">Add Interest Group</a></li>
                    <li><a href="<?php echo site_url('admin/all-interest-groups')?>">Interest Groups</a></li>
                </ul>
            </li>
            <li><a href="#"><span class="icon color9"><i class="fa fa-user"></i></span>Donation Causes<span class="caret"></span></a>
                <ul>
                    <li><a href="<?php echo site_url('admin/new-donation')?>">Add Donation</a></li>
                    <li><a href="<?php echo site_url('admin/all-donation-causes')?>">All Donations</a></li>
                </ul>
            </li>
            <li><a href="#"><span class="icon color9"><i class="fa fa-user"></i></span>Albums & Gallery<span class="caret"></span></a>
                <ul>
                    <li><a href="<?php echo site_url('admin/new-album')?>">Add New Album</a></li>
                    <li><a href="<?php echo site_url('admin/all-albums')?>">All Albums</a></li>
                    <li><a href="<?php echo site_url('admin/new-gallery-images')?>">Add Images</a></li>
                    <li><a href="<?php echo site_url('admin/view-album-images')?>">All Images</a></li>

                </ul>
            </li>
            <li><a href="#"><span class="icon color9"><i class="fa fa-user"></i></span>Website Settings<span class="caret"></span></a>
                <ul>
                    <li><a href="<?php echo site_url('admin/settings')?>">Add Settings</a></li>
                    <li><a href="<?php echo site_url('admin/allsettings')?>">Settings</a></li>
                    <li><a href="<?php echo site_url('admin/newCountry')?>">Add a Country</a></li>
                    <li><a href="<?php echo site_url('admin/countries')?>">Countries</a></li>
                </ul>
            </li>
            <li><a href="#"><span class="icon color9"><i class="fa fa-user"></i></span>Sliders<span class="caret"></span></a>
                <ul>
                    <li><a href="<?php echo site_url('admin/new-slider')?>">Add Sliders</a></li>
                    <li><a href="<?php echo site_url('admin/all-slider')?>">Sliders</a></li>

                </ul>
            </li>
		<?php endif; ?>

	</ul>




	<ul class="sidebar-panel nav">

		<li><a href="<?php echo site_url('admin/queries')?>"><span class="icon color15"><i class="fa fa-columns"></i></span>Queries</a></li>
	</ul>


</div>
<!-- END SIDEBAR -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
