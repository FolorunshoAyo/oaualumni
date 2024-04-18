


<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <ol class="breadcrumb float-left">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">
                                <?php echo str_replace('-'," ",$this->uri->segment(2));?>
                            </li>
                        </ol>
                        <h4 class="page-title float-right">
                            <!-- <a class="btn btn-primary" href="<?php echo site_url('admin/new-sub-category')?>">
                                Create
                            </a> -->
                        </h4>

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
                                <?php if ($subCategoriesContent):?>
                                    <table id="datatable" class="table table-bordered">
                                        <thead>
                                        <th>Id</th>
                                        <th>Page Name</th>
                                        <th>Manage</th>

                                        </thead>
                                        <tbody>
                                        <?php foreach($subCategoriesContent as $subCategoryContent):?>
                                            <tr>
                                              <td><?= $subCategoryContent->content_id; ?></td>
                                              <td><?= $subCategoryContent->content_heading; ?></td>
                                              <td>
                                                <a href="<?= base_url(); ?>admin/edit-sub-categories-content/<?= $subCategoryContent->content_id; ?>" class="btn btn-success DisProdMac">Edit</a>
                                                        </td>
                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <?php no_data('alert-info','There is not any Sub-Category')?>
                                <?php endif?>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
