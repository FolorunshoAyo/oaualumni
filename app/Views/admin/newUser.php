


<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <ol class="breadcrumb float-left">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active"><?php echo str_replace('-'," ",$this->uri->segment(2));?></li>
                        </ol>
                        <h4 class="page-title float-right">
                            <a class="btn btn-primary" href="<?php echo site_url('admin/new-user')?>">
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
                            <form action="<?php echo site_url('admin/'.$this->uri->segment(2).'/')?>" method="get">
                                <div class="input-group">
                                    <input type="text" name="usr" placeholder="Search"  value="<?php if (!empty($search) && isset($search)){ echo $search;}?>"  class="form-control">
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
                                <?php if ($allUsers):?>
                                    <table id="datatable" class="table table-bordered">
                                        <thead>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Logo</th>
                                        <th>Email Address</th>
                                        <th>Change Password</th>
                                        <th>Trusted</th>
                                        <th>Date</th>
                                        <th>Approve</th>
                                        <th>Edit</th>

                                        </thead>
                                        <tbody>
                                        <?php foreach($allUsers as $user):?>
                                            <tr class="gmi<?php echo $user->u_id?>">
                                                <td data-title="Order #">
                                                    <?php echo $user->u_id?>
                                                </td>
                                                <td data-title="Order #">
                                                    <?php echo $user->u_company_name?>
                                                </td>



                                                <td data-title="Order #">
                                                    <img src="<?php echo base_url('assets/images/comLogo/'.$user->u_company_logo); ?>" class="img-responsive" width="200">
                                                </td>
                                                <td data-title="Order #">
                                                    <?php echo $user->u_email?>
                                                </td>
                                                <td data-title="Order #">
                                                    <button type="button" class="chgPs btn btn-primary" id="chgPs" data-text="<?php echo $user->u_id?>">
                                                        Change Password
                                                    </button>
                                                </td>



                                                <?php if($user->u_trusted == 1): ?>
                                                    <td data-title="Order #">
                                                        <a href="javascript:void(0)" id="digenral<?php echo $user->u_id; ?>" class="btn btn-danger ActTrsUser" data-text="<?php echo $this->encryption->encrypt($user->u_id); ?>" data-id="<?php echo $user->u_id; ?>">
                                                            UnTrusted
                                                        </a>
                                                    </td>
                                                <?php elseif($user->u_trusted == 0): ?>
                                                    <td data-title="Order #">
                                                        <a href="javascript:void(0)" id="digenral<?php echo $user->u_id; ?>" class="btn btn-success DisTrsUser" data-text="<?php echo $this->encryption->encrypt($user->u_id); ?>" data-id="<?php echo $user->u_id; ?>">
                                                            Trusted
                                                        </a>
                                                    </td>
                                                <?php endif; ?>
                                                <td data-title="Order #">
                                                    <?php echo $user->u_date?>
                                                </td>



                                                <?php if($user->u_status == 0): ?>
                                                    <td data-title="Order #">
                                                        <a href="javascript:void(0)" id="digenral<?php echo $user->u_id; ?>" class="btn btn-info Actser" data-text="<?php echo $this->encryption->encrypt($user->u_id); ?>" data-id="<?php echo $user->u_id; ?>">
                                                            Active Now
                                                        </a>
                                                    </td>
                                                <?php elseif($user->u_status == 1): ?>
                                                    <td data-title="Order #">
                                                        <a href="javascript:void(0)" id="digenral<?php echo $user->u_id; ?>" class="btn btn-success DisUser" data-text="<?php echo $this->encryption->encrypt($user->u_id); ?>" data-id="<?php echo $user->u_id; ?>">
                                                            Active
                                                        </a>
                                                    </td>
                                                <?php endif; ?>

                                                <td data-title="Order #">
                                                    <a  href="<?php echo site_url('admin/edit-user/'.$user->u_id); ?>">
                                                        Edit
                                                    </a>
                                                </td>

                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                    <?php echo $links;?>
                                <?php else: ?>
                                    <?php no_data('alert-info','The user is not available')?>
                                <?php endif?>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

