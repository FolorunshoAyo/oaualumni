
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid skzMconWhite">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">All Albums</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">All albums</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo checkFlash(); ?>
                            </div>
                            <section class="rightsec">
                                <div class="erresnd">

                                </div>
                                <?php if ($allEvents):?>
                                    <table id="datatable" class="table table-bordered">
                                        <thead>
                                        <th>Id</th>
                                        <th>title</th>
                                        <th>start_date</th>
                                        <th>end_date</th>
                                        <th>Status</th>
                                        <th>Event Name</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        </thead>
                                        <tbody>
                                        <?php foreach($allEvents as $alCal):?>
                                            <tr class="gmi<?php echo $alCal['ev_id']?>">
                                                <td data-title="Order #">
                                                    <?php echo $alCal['ev_id']?>
                                                </td>
                                                <td data-title="Order #">
                                                    <?php echo $alCal['title']?>
                                                </td>
                                                <td data-title="Order #">
                                                    <?php echo $alCal['start_date']?>
                                                </td>
                                                <td data-title="Order #">
                                                    <?php echo $alCal['end_date']?>
                                                </td>
                                                <td data-title="Order #">
                                                    <?php
                                                    if ($alCal['ev_status'] == 0) {
                                                        echo '<button class="btn btn-primary">Disabled</button>';
                                                    } elseif ($alCal['ev_status'] == 1) {
                                                        echo '<button class="btn btn-success">Active</button>';
                                                    } elseif ($alCal['ev_status'] == 2) {
                                                        echo '<button class="btn btn-primary">Archived</button>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo getNewsEventName($alCal['events_id'],'events')?>
                                                </td>
                                                <td data-title="Order #">
                                                    <a  href="<?php echo site_url('admin/edit-calendar/'.$alCal['ev_id']); ?>" class="btn btn-primary skzslimnew">
                                                        Edit
                                                    </a>
                                                </td>
                                                <td data-title="Order #">
                                                    <a  href="<?php echo site_url('admin/delete-calendar/'.$alCal['ev_id']); ?>" class="btn btn-danger albumDrop">
                                                        Delete
                                                    </a>
                                                </td>

                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                    <?php echo $pager->links();?>
                                <?php else: ?>
                                    <?php no_data('alert-info','There is not any album')?>
                                <?php endif?>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>