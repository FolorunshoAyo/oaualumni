<div class="content">

    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">All Tickets</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
            <li class="active">All Tickets</li>
        </ol>

    </div>
    <!-- End Page Header -->




    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START CONTAINER -->
    <div class="container-padding">


        <!-- Start Row -->
        <div class="row">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <form action="<?php echo site_url('admin/alltickets')?>" method="get">
                                    <div class="col-md-3">
                                        <div class="srlef">
                                            <div class="form-group">
                                                <label>Users</label>
                                                <?php if (count($AllUsers) >  0):
                                                    $userOption = array();
                                                    $userOption[''] = 'Select User';
                                                    foreach ($AllUsers as $myUser):
                                                        $userOption[$myUser['u_id']] = $myUser['u_ref_id'] . ' ('.$myUser['user_name'].')' ;
                                                    endforeach;
                                                    echo form_dropdown('user',$userOption,$filters['user'],array('class'=>'form-control','id'=>'userID','onchange'=>'this.form.submit()'));
                                                    ?>
                                                <?php else: ?>
                                                    <?php no_data('alert-info','Makers not available')?>
                                                <?php endif; ?>
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
                                                <a href="<?php echo site_url('admin/alltickets')?>" class="btn btn-primary">Restore Filter</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Panel -->
            <div class="col-md-12" id="PrintDiv">
                <div class="form-group">
                    <?php  echo checkFlash();?>
                    <div class="cierrors">
                        <?php echo validation_errors(); ?>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-title">
                        All Tickets
                    </div>
                    <div class="panel-body table-responsive">
                        <?php
                        $totalUsrWithdrw = 0;
                        if ($MyTickets):
                            ?>
                            <table class="table table-bordered mb-0">
                                <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Title</td>
                                    <td>Category</td>
                                    <td>Stark ID</td>
                                    <td>Phone</td>
                                    <td>Date</td>
                                    <td>Updated</td>
                                    <td>Status</td>
                                    <td>Check Detail</td>
                                    <td>Close</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($MyTickets as $myindiTicket): ?>
                                    <tr>
                                        <?php
                                        $HowMany = getTotalticketComment($myindiTicket['ut_id']);
                                        ?>
                                        <!--										<td class="text-center"><div class="checkbox margin-t-0"><input id="checkbox1" type="checkbox"><label for="checkbox1"></label></div></td>-->
                                        <td># <b><?php echo $myindiTicket['ut_id']?></b></td>
                                        <td><?php echo $myindiTicket['ut_title'].'('.count($HowMany).')'?></td>
                                        <td><?php echo $myindiTicket['tic_name']?></td>
                                        <td><?php echo $myindiTicket['u_ref_id'].'('.$myindiTicket['user_name'].')'?></td>
                                        <td><?php echo $myindiTicket['u_mobile']?></td>
                                        <td><?php echo $myindiTicket['ut_date']?></td>
                                        <td><?php echo $myindiTicket['ut_updated']?></td>
                                        <td>
                                            <?php if ($myindiTicket['ut_status'] ==1): ?>
                                                <button class="btn btn-info">
                                                    Pending
                                                </button>
                                            <?php elseif ($myindiTicket['ut_status'] == 2): ?>
                                                <button class="btn btn-success">
                                                    Closed
                                                </button>
                                            <?php else: ?>
                                                <button class="btn btn-info">
                                                    Pending
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="<?php echo site_url('admin/ticdetail/'.$myindiTicket['ut_id'])?>">Check Now</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="<?php echo site_url('admin/closeticket/'.$myindiTicket['ut_id'])?>">Close Now</a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
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
