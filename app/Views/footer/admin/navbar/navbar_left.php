
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
                    <li><a href="<?php echo site_url('admin/new-news-and-event')?>">Add News/Events</a></li>
                    <li><a href="<?php echo site_url('admin/all-news-and-events')?>">All News/Events</a></li>
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
