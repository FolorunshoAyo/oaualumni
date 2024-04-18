
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid skzMconWhite">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">All Countries</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">All Countries</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    $validation = \Config\Services::validation();
                    echo $validation->listErrors();
                    echo checkFlash();
                    ?>
                    <?php echo form_open('',['method'=>'get','id'=>'frmtrg'])?>
                    <div class="row">
                        <!--<div class="row">
                            <div class="col-md-12">
                                <h>Filters</h>
                            </div>
                        </div>-->

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Search Country</label>
                                <?php
                                echo form_input('s',$filtrs['s'],['class'=>'form-control']);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <a href="<?php echo site_url('admin/countries'); ?>">Clear Filters</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Search</button>
                    </div>
                </div>
            </div>
            <?php echo form_close();?>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">

                            <section class="rightsec">
                                <div class="erresnd">

                                </div>
                                <?php if ($countries):?>
                                    <table id="datatable" class="table table-bordered">
                                        <thead>
                                        <th scope="col">#</th>
                                        <th scope="col">Country Name</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Updated</th>
                                        <th scope="col">Deleted</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Admin ID</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Deleted</th>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (count($countries) > 0):
                                            ?>
                                            <?php foreach ($countries as $myCountry): ?>
                                            <tr>
                                                <th scope="row"><?=$myCountry['co_id']?></th>
                                                <td><?=$myCountry['co_name']?></td>
                                                <td><?=$myCountry['co_slug']?></td>
                                                <td><?=$myCountry['co_date']?></td>
                                                <td><?=$myCountry['co_updated']?></td>
                                                <td><?=$myCountry['co_deleted']?></td>
                                                <td><?=$myCountry['co_status']?></td>
                                                <td><?=$myCountry['admin_id']?></td>
                                                <td>
                                                    <a href="<?php echo site_url('admin/editCountry/'.$myCountry['co_id'])?>" class="btn btn-primary">Edit</a>
                                                </td>
                                                <td>
                                                    <a href="<?php echo site_url('admin/deleteCountry/'.$myCountry['co_id'])?>" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                        <?php endif; ?>
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