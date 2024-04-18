
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">All Messages</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">View Messages</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo checkFlash(); ?>
                        </div>
                        <section class="rightsec">
                            <div class="erresnd">

                            </div>
                            <?php if ($messages):?>
                                <table id="datatable" class="table table-bordered">
                                    <thead>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Message</th>
                                        <th>Orgnization</th>
                                        <th>Designation</th>
                                        <th>Date</th>
                                        <th>Mobile</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach($messages as $message):?>
                                        <tr class="gmi<?php echo $message->cn_id?>">
                                            <td data-title="Order #">
                                                <?php echo $message->cn_id?>
                                            </td>
                                            <td data-title="Order #">
                                                <?php echo $message->cn_name?>
                                            </td>
                                            <td data-title="Order #">
                                                <?php echo $message->cn_comments?>
                                            </td>

                                            <td data-title="Order #">
                                                <?php echo strtoupper($message->cn_orgnization)?>
                                            </td>
                                            <td data-title="Order #">
                                                <?php echo strtoupper($message->cn_designation)?>
                                            </td>

        <!--                                    <td data-title="Order #">
                                                <?php /*if($message->ne_status == 0): */?>
                                                    <button class="btn btn-danger">Disabled</button>
                                                <?php /*else: */?>
                                                    <button class="btn btn-success">active</button>
                                                <?php /*endif;*/?>
                                            </td>
        -->
                                            <td data-title="Order #">
                                                <?php echo $message->cn_date?>
                                            </td>
                                            <td data-title="Order #">
                                                <?php echo $message->cn_number?>
                                            </td>

                                        </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>

                            <?php else: ?>
                                <?php no_data('alert-info','There is not any Tender')?>
                            <?php endif?>
                        </section>
                    </div>
                </div>

            </div>
            </div>
        </div>
    </div>
</div>
