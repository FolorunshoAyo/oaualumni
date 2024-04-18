
<div class="modal fade" tabindex="-1" role="dialog" id="thmModl">
	<div class="modal-dialog" role="document" id="modDialog">
		<div class="modal-content" id="modContent">
			<div class="modal-header" id="thmHead">
				<h4 class="modal-title" id="thmtitle"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body" id="thmBody">
			</div>
			<div class="modal-footer" id="thmfooter">
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="content">
	<!-- Start Footer -->
	<div class="row footer">
		<div class="col-md-6 text-left">
			Copyright © <?php echo date('Y')?> <a href="<?php base_url()?>" target="_blank">Club</a> All rights reserved.
		</div>

	</div>

</div>
	<!-- End Footer -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START SIDEPANEL -->
<div role="tabpanel" class="sidepanel">

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#today" aria-controls="today" role="tab" data-toggle="tab">TODAY</a></li>
		<li role="presentation"><a href="#tasks" aria-controls="tasks" role="tab" data-toggle="tab">TASKS</a></li>
		<li role="presentation"><a href="#chat" aria-controls="chat" role="tab" data-toggle="tab">CHAT</a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">

		<!-- Start Today -->
		<div role="tabpanel" class="tab-pane active" id="today">

			<div class="sidepanel-m-title">
				Today
				<span class="left-icon"><a href="#"><i class="fa fa-refresh"></i></a></span>
				<span class="right-icon"><a href="#"><i class="fa fa-file-o"></i></a></span>
			</div>

			<div class="gn-title">NEW</div>

			<ul class="list-w-title">
				<li>
					<a href="#">
						<span class="label label-danger">ORDER</span>
						<span class="date">9 hours ago</span>
						<h4>New Jacket 2.0</h4>
						Etiam auctor porta augue sit amet facilisis. Sed libero nisi, scelerisque.
					</a>
				</li>
				<li>
					<a href="#">
						<span class="label label-success">COMMENT</span>
						<span class="date">14 hours ago</span>
						<h4>Bill Jackson</h4>
						Etiam auctor porta augue sit amet facilisis. Sed libero nisi, scelerisque.
					</a>
				</li>
				<li>
					<a href="#">
						<span class="label label-info">MEETING</span>
						<span class="date">at 2:30 PM</span>
						<h4>Developer Team</h4>
						Etiam auctor porta augue sit amet facilisis. Sed libero nisi, scelerisque.
					</a>
				</li>
				<li>
					<a href="#">
						<span class="label label-warning">EVENT</span>
						<span class="date">3 days left</span>
						<h4>Birthday Party</h4>
						Etiam auctor porta augue sit amet facilisis. Sed libero nisi, scelerisque.
					</a>
				</li>
			</ul>

		</div>
		<!-- End Today -->

		<!-- Start Tasks -->
		<div role="tabpanel" class="tab-pane" id="tasks">

			<div class="sidepanel-m-title">
				To-do List
				<span class="left-icon"><a href="#"><i class="fa fa-pencil"></i></a></span>
				<span class="right-icon"><a href="#"><i class="fa fa-trash"></i></a></span>
			</div>

			<div class="gn-title">TODAY</div>

			<ul class="todo-list">
				<li class="checkbox checkbox-primary">
					<input id="checkboxside1" type="checkbox"><label for="checkboxside1">Add new products</label>
				</li>

				<li class="checkbox checkbox-primary">
					<input id="checkboxside2" type="checkbox"><label for="checkboxside2"><b>May 12, 6:30 pm</b> Meeting with Team</label>
				</li>

				<li class="checkbox checkbox-warning">
					<input id="checkboxside3" type="checkbox"><label for="checkboxside3">Design Facebook page</label>
				</li>

				<li class="checkbox checkbox-info">
					<input id="checkboxside4" type="checkbox"><label for="checkboxside4">Send Invoice to customers</label>
				</li>

				<li class="checkbox checkbox-danger">
					<input id="checkboxside5" type="checkbox"><label for="checkboxside5">Meeting with developer team</label>
				</li>
			</ul>

			<div class="gn-title">TOMORROW</div>
			<ul class="todo-list">
				<li class="checkbox checkbox-warning">
					<input id="checkboxside6" type="checkbox"><label for="checkboxside6">Redesign our company blog</label>
				</li>

				<li class="checkbox checkbox-success">
					<input id="checkboxside7" type="checkbox"><label for="checkboxside7">Finish client work</label>
				</li>

				<li class="checkbox checkbox-info">
					<input id="checkboxside8" type="checkbox"><label for="checkboxside8">Call Johnny from Developer Team</label>
				</li>

			</ul>
		</div>
		<!-- End Tasks -->

		<!-- Start Chat -->
		<div role="tabpanel" class="tab-pane" id="chat">

			<div class="sidepanel-m-title">
				Friend List
				<span class="left-icon"><a href="#"><i class="fa fa-pencil"></i></a></span>
				<span class="right-icon"><a href="#"><i class="fa fa-trash"></i></a></span>
			</div>

			<div class="gn-title">ONLINE MEMBERS (3)</div>
			<ul class="group">
				<li class="member"><a href="#"><img src="<?php echo base_url('assets/admin/img/profileimg.png')?>" alt="img"><b>Allice Mingham</b>Los Angeles</a><span class="status online"></span></li>
				<li class="member"><a href="#"><img src="<?php echo base_url('assets/admin/img/profileimg2.png')?>" alt="img"><b>James Throwing</b>Las Vegas</a><span class="status busy"></span></li>
				<li class="member"><a href="#"><img src="<?php echo base_url('assets/admin/img/profileimg3.png')?>" alt="img"><b>Fred Stonefield</b>New York</a><span class="status away"></span></li>
				<li class="member"><a href="#"><img src="<?php echo base_url('assets/admin/img/profileimg4.png')?>" alt="img"><b>Chris M. Johnson</b>California</a><span class="status online"></span></li>
			</ul>

			<div class="gn-title">OFFLINE MEMBERS (8)</div>
			<ul class="group">
				<li class="member"><a href="#"><img src="<?php echo base_url('assets/admin/img/profileimg5.png')?>" alt="img"><b>Allice Mingham</b>Los Angeles</a><span class="status offline"></span></li>
				<li class="member"><a href="#"><img src="<?php echo base_url('assets/admin/img/profileimg6.png')?>" alt="img"><b>James Throwing</b>Las Vegas</a><span class="status offline"></span></li>
			</ul>

			<form class="search">
				<input type="text" class="form-control" placeholder="Search a Friend...">
			</form>
		</div>
		<!-- End Chat -->

	</div>

</div>
<!-- END SIDEPANEL -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- ================================================
jQuery Library
================================================ -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/jquery.min.js')?>"></script>

<!-- ================================================
Bootstrap Core JavaScript File
================================================ -->
<script src="<?php echo base_url('public/assets/admin/js/bootstrap/bootstrap.min.js')?>"></script>

<!-- ================================================
Plugin.js')?> - Some Specific JS codes for Plugin Settings
================================================ -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/plugins.js')?>"></script>

<!-- ================================================
Bootstrap Select
================================================ -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/bootstrap-select/bootstrap-select.js')?>"></script>

<!-- ================================================
Bootstrap Toggle
================================================ -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/bootstrap-toggle/bootstrap-toggle.min.js')?>"></script>

<!-- ================================================
Bootstrap WYSIHTML5
================================================ -->
<!-- main file -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/bootstrap-wysihtml5/wysihtml5-0.3.0.min.js')?>"></script>
<!-- bootstrap file -->
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/bootstrap-wysihtml5/bootstrap-wysihtml5.js')?>"></script>
<script src="<?php echo base_url('public/assets/js/adminScript.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/assets/admin/js/custom.js?version=313')?>"></script>


<script type="text/javascript">
    var surl = "<?php echo site_url();?>";
    var burl = "<?php echo base_url();?>";
    var curl = "<?php echo current_url();?>";
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
