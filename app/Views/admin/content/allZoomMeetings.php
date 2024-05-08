<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid skzMconWhite">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Our Zoom Meetings</h4>

                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>">Admin</a></li>
                            <li class="breadcrumb-item active">Our Zoom Meetings</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <?php echo checkFlash(); ?>
                    </div>
                    <div class="card-box table-responsive">

                        <?php if ($allOnlineMeetings):?>
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Meeting ID</th>
                                    <th>Meeting Name</th>
                                    <th>Meeting Description</th>
                                    <th>Start Time</th>
                                    <th>Duration</th>
                                    <th>Timezone</th>
                                    <th>ADMIN_URL</th>
                                    <th>ZOOM_URL</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                <?php foreach($allOnlineMeetings as $meeting):?>
                                    <?php
                                        $params = [
                                            'name'=>"Admin",
                                            'email' => $adminDetails[0]['email'],
                                            'meeting_number' => $meeting['meeting_id'],
                                            'meeting_topic' => $meeting['name'],
                                            'meeting_pwd' => $meeting['password'],
                                            'role' => '1'
                                        ];
                                    ?>
                                    <tr class="gmi<?php echo $meeting['id']?>">
                                        <td data-title="Order #">
                                            <?php echo $meeting['id']?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php echo $meeting['meeting_id']?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php echo $meeting['name']?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php echo $meeting['short_description']?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php echo $meeting['start_time']?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php echo $meeting['duration']?> mnts.
                                        </td>
                                        <td data-title="Order #">
                                            <?php echo timezone_identifiers_list()[$meeting['timezone']]?>
                                        </td>
                                        <td data-title="Order #">
                                            <a href="<?php echo meetingURL($params) ?>" target="_blank" class='link-danger' target="_blank">admin</a>
                                        </td>
                                        <td data-title="Order #">
                                            <a href="<?php echo $meeting['meeting_url']; ?>" target="_blank"><?php echo $meeting['meeting_url']?></a>
                                        </td>
                                        <td data-title="Order #">
                                            <?php echo $meeting['created_at']?>
                                        </td>
                                        <td data-title="Order #">
                                            <a  href="<?php echo site_url('admin/edit-zoom-meeting/'.$meeting['id']); ?>" class="btn btn-primary skzslimnew">
                                                Edit
                                            </a>
                                            <a  href="<?php echo site_url('admin/delete-zoom-meeting/'.$meeting['id']); ?>" class="btn btn-danger albumDrop">
                                                Delete
                                            </a>
                                        </td>

                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <?php no_data('alert-info','No Zoom Meeting has been created yet')?>
                        <?php endif?>
                    </div>
                    <?php echo $pager->links(); ?>
                </div>
            </div> <!-- end row -->



            <!-- end row -->


        </div> <!-- container -->

    </div>
</div>
