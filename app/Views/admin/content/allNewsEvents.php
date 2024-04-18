<div class="content">

    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">All News/Events</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
            <li class="active">All News/Events</li>
        </ol>

    </div>
    <!-- End Page Header -->




    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START CONTAINER -->
    <div class="container-padding">

        <div class="row ">
            <div class="col-md-12">


                <div class="row">
                    <form action="<?php echo site_url('admin/all-news-and-events')?>" method="get">
                       <!-- <div class="col-md-3">
                            <div class="srlef">
                                <div class="form-group">
                                    <label>Users</label>
                                    <?php /*if (count($AllUsers) >  0):
                                        $userOption = array();
                                        $userOption[''] = 'Select User';
                                        foreach ($AllUsers as $myUser):
                                            $userOption[$myUser['u_id']] =  ' ('.$myUser['user_name'].')' ;
                                        endforeach;
                                        echo form_dropdown('user',$userOption,$filters['user'],array('class'=>'form-control','id'=>'userID','onchange'=>'this.form.submit()'));
                                        */?>
                                    <?php /*else: */?>
                                        <?php /*no_data('alert-info','Users not available')*/?>
                                    <?php /*endif; */?>
                                </div>
                            </div>
                        </div>-->
                        <div class="col-md-3">
                            <div class="srlef">
                                <div class="form-group">
                                    <span>From Date</span><span class="red">*</span>
                                    <?php
                                    echo form_input('fnevx',$filters['fnev'],array('class'=>'form-control datepicker','placeholder'=>'Select From Date'));
                                    ?>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="srlef">
                                <div class="form-group">
                                    <span>To Date</span><span class="red">*</span>
                                    <?php
                                    echo form_input('tnev',$filters['tnev'],array('class'=>'form-control datepicker','placeholder'=>'Select To Date'));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="srlef">
                                    <div class="form-group">
                                        <span>Per Page</span><span class="red">*</span>
                                        <?php
                                        $profitPrPage = array();
                                        $profitPrPage['20'] = '20';
                                        $profitPrPage['50'] = '50';
                                        $profitPrPage['75'] = '75';
                                        $profitPrPage['100'] = '100';
                                        $profitPrPage['150'] = '150';
                                        $profitPrPage['200'] = '200';
                                        $profitPrPage['300'] = '300';
                                        $profitPrPage['500'] = '500';
                                        $profitPrPage['700'] = '700';
                                        $profitPrPage['1000'] = '1000';
                                        echo form_dropdown('ppg',$profitPrPage,$filters['page'],array('class'=>'form-control datepicker','onchange'=>'this.form.submit()'));
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button class="btn btn-primary">Filter Now</button>
                                    <a href="<?php echo site_url('admin/all-news-and-events')?>" class="btn btn-primary">Restore Filter</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- Start Row -->
        <div class="row" id="PrintDiv">
            <!-- Start Panel -->
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo checkFlash(); ?>
                </div>
                <div class="panel panel-default">

                    <div class="panel-body table-responsive">
                        <?php if ($allEvents):
                            ?>
                            <table class="table table-hover dataTable">
                                <thead>
                                <tr>
                                    <!--<td class="text-center"><i class="fa fa-trash"></i></td>-->
                                    <td>Id</td>
                                    <td>Name</td>
                                    <td>Body</td>
                                    <td>Category</td>
                                    <td>Status</td>
                                    <td>File/Image</td>
                                    <td>Date</td>
                                    <td>Edit</td>
                                    <td>Delete</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($allEvents as $event):?>
                                    <tr class="gmi<?php echo $event['ne_id']?>">
                                        <td data-title="Order #">
                                            <?php echo $event['ne_id']?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php echo $event['ne_title']?>
                                        </td>
                                        <td data-title="Order #">
                                            <?php echo word_limiter(base64_decode($event['ne_description']),30)?>
                                        </td>

                                       <td data-title="Order #">
                                            <?php echo strtoupper($event['ne_category'])?>
                                        </td>

                                        <td data-title="Order #">
                                            <?php if($event['ne_status'] == 0): ?>
                                                <button class="btn btn-danger">Disabled</button>
                                            <?php else: ?>
                                                <button class="btn btn-success">active</button>
                                            <?php endif;?>
                                        </td>

                                        <td data-title="Order #">
                                            <img src="<?php echo base_url('public/assets/images/newsEvents/'.$event['ne_dp']); ?>" class="img-responsive" width="200">
                                        </td>
                                        <td data-title="Order #">
                                            <?php echo $event['ne_date']?>
                                        </td>
                                        <td data-title="Order #">
                                            <a  href="<?php echo site_url('admin/edit-news-and-events/'.$event['ne_id']); ?>" class="btn btn-primary skzslimnew">
                                                Edit
                                            </a>
                                        </td>
                                        <td data-title="Order #">
                                            <a  href="<?php echo site_url('admin/deletenewsevent/'.$event['ne_id']); ?>" class="btn btn-danger newsEventsDrop">
                                                Delete
                                            </a>
                                        </td>

                                    </tr>
                                <?php endforeach;?>
                                <!--<td class="text-center"><i class="fa fa-trash"></i></td>-->
                                </tr>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>

                </div>
                <?php echo $pager->links(); ?>
            </div>
            <!-- End Panel -->

        </div>
        <!-- End Row -->
    </div>
    <!-- END CONTAINER -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->

</div>
