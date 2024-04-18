
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
                <div class="col-md-9">
                    <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo checkFlash(); ?>
                </div>
                <section class="rightsec">
                    <div class="erresnd">

                    </div>
                    <?php if ($allAlbums):?>
                        <table id="datatable" class="table table-bordered">
                            <thead>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Images</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>
                                <?php foreach($allAlbums as $album):?>
                                <tr class="gmi<?php echo $album['gl_id']?>">
                                    <td data-title="Order #">
                                        <?php echo $album['gl_id']?>
                                    </td>
                                    <td data-title="Order #">
                                        <?php echo $album['gl_name']?>
                                    </td>
                                    <td data-title="Order #">
                                        <?php echo $album['gl_date']?>
                                    </td>
                                    <td data-title="Order #">
                                        <?php
                                        if ($album['gl_status'] == 0) {
                                            echo '<button class="btn btn-danger">Disabled</button>';
                                        } elseif ($album['gl_status'] == 1) {
                                            echo '<button class="btn btn-success">Active</button>';
                                        } elseif ($album['gl_status'] == 2) {
                                            echo '<button class="btn btn-primary">Archived</button>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo AlbumImagesCount($album['gl_id'])?>
                                    </td>
                                    <td data-title="Order #">
                                        <a  href="<?php echo site_url('admin/edit-album/'.$album['gl_id']); ?>" class="btn btn-primary skzslimnew">
                                            Edit
                                        </a>
                                    </td>
                                    <td data-title="Order #">
                                        <a  href="<?php echo site_url('admin/delete-album/'.$album['gl_id']); ?>" class="btn btn-danger albumDrop">
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