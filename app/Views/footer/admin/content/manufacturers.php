

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <ol class="breadcrumb float-left">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">Manufacturers</li>
                        </ol>
                        <h4 class="page-title float-right">
                            <a class="btn btn-primary" href="<?php echo site_url('admin/new-manufacturer')?>">
                                Create
                            </a>
                        </h4>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6 offset-3">
                            <form action="<?php echo site_url('admin/manufacturers/')?>" method="get">
                                <div class="input-group">
                                    <input type="text" name="man" placeholder="Search"  value="<?php if (!empty($search) && isset($search)){ echo $search;}?>"  class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary skzgsadmn" type="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo checkFlash(); ?>
                            </div>
                            <section class="rightsec">
                                <div class="erresnd">

                                </div>
                                <?php if ($manufacturers):?>
                                    <table id="datatable" class="table table-bordered">
                                        <thead>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        </thead>
                                        <tbody>
                                        <?php foreach($manufacturers as $manufacturer):?>
                                            <tr class="gmi<?php echo $manufacturer->man_id?>">
                                                <td data-title="Order #">
                                                    <?php echo $manufacturer->man_id?>
                                                </td>
                                                <td data-title="Order #">
                                                    <?php echo$manufacturer->man_title?>
                                                </td>

                                                <td data-title="Order #">
                                                    <?php if($manufacturer->man_status == 0): ?>
                                                        <a href="javascript:void(0)" id="digenral<?php echo $manufacturer->man_id; ?>" class="btn btn-danger ActManuf" data-text="<?php echo $this->encryption->encrypt($manufacturer->man_id); ?>" data-id="<?php echo $manufacturer->man_id; ?>">
                                                            Disabled
                                                        </a>
                                                    <?php elseif($manufacturer->man_status == 1): ?>
                                                        <a href="javascript:void(0)" id="digenral<?php echo $manufacturer->man_id; ?>" class="btn btn-success DisManuf" data-text="<?php echo $this->encryption->encrypt($manufacturer->man_id); ?>" data-id="<?php echo $manufacturer->man_id; ?>">
                                                            active
                                                        </a>
                                                    <?php endif;?>
                                                </td>


                                                <td data-title="Order #">
                                                    <?php echo $manufacturer->man_date?>
                                                </td>
                                                <td data-title="Order #">
                                                    <a  href="<?php echo site_url('admin/edit-manufacturer/'.$manufacturer->man_id); ?>" class="btn btn-primary skzslimnew">
                                                        Edit
                                                    </a>
                                                </td>
                                                <td data-title="Order #">
                                                    <a  href="javascript:void(0)" class="btn btn-danger manufacturerDrop" data-text="<?php echo site_url('admin/delete-manufacturer/'.$manufacturer->man_id); ?>">
                                                        Delete
                                                    </a>
                                                </td>

                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                    <?php echo $links;?>
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
