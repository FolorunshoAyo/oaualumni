

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <ol class="breadcrumb float-left">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">Contact Form</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 offset-3">
                            <form action="<?php echo site_url('admin/contact/')?>" method="get">
                                <div class="input-group">
                                    <input type="text" name="cnfr" placeholder="Search"  value="<?php if (!empty($search) && isset($search)){ echo $search;}?>"  class="form-control">
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
                                <?php checkFlash();?>
                            </div>
                            <section class="rightsec brewords">
                                <div class="erresnd">

                                </div>
                                <?php if ($contactForm):?>
                                    <table id="datatable" class="table table-bordered">
                                        <thead>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Detail</th>
                                        <th>Company</th>
                                        <th>Selected</th>
                                        <th>Date</th>

                                        </thead>
                                        <tbody>
                                        <?php foreach($contactForm as $cotnactF):?>
                                            <tr class="gmi<?php echo $cotnactF->con_id?>">
                                                <td data-title="Order #">
                                                    <?php echo $cotnactF->con_id?>
                                                </td>
                                                <td class="brewords" data-title="Order #">
                                                    <span class="brewords">
                                                        <?php echo $cotnactF->con_name?>
                                                   </span>
                                                </td>
                                                <td data-title="Order #">
                                                    <?php echo $cotnactF->con_email?>
                                                </td>
                                                <td data-title="Order #">
                                                    <?php echo $cotnactF->con_contact?>
                                                </td>
                                                <td data-title="Order #">
                                                    <?php echo $cotnactF->con_detail?>
                                                </td>
                                                <td data-title="Order #">
                                                    <?php echo $cotnactF->con_company?>
                                                </td>
                                                <td data-title="Order #">
                                                    <?php echo $cotnactF->con_selected?>
                                                </td>


                                                <td data-title="Order #">
                                                    <?php
                                                    echo  $cotnactF->con_date;
                                                    ?>
                                                </td>

                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                    <h1> <?php echo $links;?></h1>
                                <?php else: ?>
                                    <?php no_data('alert-info','The Contact Form  is not available')?>
                                <?php endif?>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

