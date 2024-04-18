<div class="content">

    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">Maximum Amount Sent</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
            <li class="active">Maximum Amount Sent</li>
        </ol>

    </div>
    <!-- End Page Header -->




    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START CONTAINER -->
    <div class="container-padding">

        <div class="row">
            <div class="col-md-12">


                <div class="row">
                    <form action="<?php echo site_url('admin/maxsentamount')?>" method="get">
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
                                    <a href="<?php echo site_url('admin/maxsentamount')?>" class="btn btn-primary">Restore Filter</a>
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
                    <div class="pull-right">
                        <a href="javascript:void(0)" onclick="printdiv('PrintDiv');" class="btn btn-success waves-effect waves-light">Print Now</a>
                        <a href="javascript:void(0)" id="exportasCSV" class="btn btn-success waves-effect waves-light">Export</a>
                    </div>
                    <div class="panel-title">
                        Maximum Amount Sent
                    </div>
                    <div class="panel-body table-responsive">
                        <?php if ($maximumReivedAmount):
                            //var_dump($maximumReivedAmount);
                            //dd();
                            ?>
                            <table class="table table-hover dataTable">
                                <thead>
                                <tr>
                                    <td>Maximum Amount</td>
                                    <td>Date</td>
                                    <td>Cash Box Type</td>
                                    <td>User Id</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($maximumReivedAmount as $maxAmount):?>
                                    <tr>
                                        <td> <b>
                                                <a target="_blank" type="button" href="<?php echo site_url('admin/withdrawals?user='.$maxAmount['user_id'].'&fwid=&twid=&ppg=20')?>" data-toggle="tooltip" title="Click to view the Detail">
                                                    <?php echo $maxAmount['uw_amount']?>
                                                </a>
                                            </b></td>
                                        <td><?php

                                            echo date('d/M/Y  ', strtotime($maxAmount['uw_date']))
                                            ?></td>
                                        <td><?php echo $maxAmount['uw_fund_type']?></td>
                                        <td>
                                            <?php
                                            $userData = getUserData($maxAmount['user_id']);
                                            //var_dump($userData);
                                            echo $userData[0]['u_ref_id'] . ' ('.$userData[0]['user_name'].')' ;
                                            //var_dump($userData);
                                            ?></td>
                                    </tr>
                                <?php endforeach;?>
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
