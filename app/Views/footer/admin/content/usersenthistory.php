<div class="content">

    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">Receiving History</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
            <li class="active">Receiving History</li>
        </ol>

    </div>
    <!-- End Page Header -->


    <div class="container-widget">
        <div class="col-md-12">
            <ul class="topstats clearfix">
                <li class="arrow"></li>
                <li class="col-xs-6 col-lg-3">
						<span class="title"><i class="fa fa-dollar"></i>
							<a href="http://localhost/newstark/admin/cashbox">Stark ID</a>
						</span>
                    <h3>
                        <?php
                        $userAllData = getUserData($user_id);
                        echo $userAllData[0]['u_ref_id'];
                        ?>
                    </h3>
                    <!--<span class="diff"><b class="color-up"><i class="fa fa-caret-up"></i> 26%</b> from last week</span>-->
                </li>
                <li class="col-xs-6 col-lg-3">
						<span class="title"><i class="fa fa-dollar"></i>
							<a href="http://localhost/newstark/admin/cashbox">Investment Plan</a>
						</span>
                    <h3>
                        <?php
                        echo getUserPlan($user_id);
                        ?>
                    </h3>
                    <!--<span class="diff"><b class="color-up"><i class="fa fa-caret-up"></i> 26%</b> from last week</span>-->
                </li>
                <li class="col-xs-6 col-lg-3">
						<span class="title"><i class="fa fa-dollar"></i>
							<a href="http://localhost/newstark/admin/cashbox">Parent ID</a>
						</span>
                    <h3>
                        <?php
                        echo $userAllData[0]['u_who_refer'];
                        ?>
                    </h3>
                    <!--<span class="diff"><b class="color-up"><i class="fa fa-caret-up"></i> 26%</b> from last week</span>-->
                </li>
                <li class="col-xs-6 col-lg-3">
						<span class="title"><i class="fa fa-dollar"></i>

							<a href="http://localhost/newstark/admin/cashbox">Cash Box</a>
						</span>
                    <h3>
                        <?php
                        $cashBoxaftrwithDraw = cashBoxAfterDeposit($user_id);
                        if ($cashBoxaftrwithDraw != false) {
                            //echo $cashBoxaftrwithDraw;
                            echo CURRENCY.number_format((float)$cashBoxaftrwithDraw, 2, '.', '');
                        }
                        else{
                            echo '0';
                        }
                        ?>
                    </h3>
                    <!--<span class="diff"><b class="color-up"><i class="fa fa-caret-up"></i> 26%</b> from last week</span>-->
                </li>
                <li class="col-xs-6 col-lg-3">
						<span class="title"><i class="fa fa-dollar"></i>

							<a href="http://localhost/newstark/admin/cashbox">Achieved Bonus</a>
						</span>
                    <h3>
                        <?php
                        $userMnProfit = userMonthlyProfit($user_id);
                        if ($userMnProfit != false) {
                            $fnlBnsSKZ = $userMnProfit - $userMnProfit*5/100;
                            echo '$'.number_format((float)$fnlBnsSKZ, 2, '.', '');
                        }
                        else{
                            echo '0';
                        }
                        ?>
                    </h3>
                    <!--<span class="diff"><b class="color-up"><i class="fa fa-caret-up"></i> 26%</b> from last week</span>-->
                </li>
                <li class="col-xs-6 col-lg-3">
						<span class="title"><i class="fa fa-dollar"></i>
							<a href="http://localhost/newstark/admin/cashboxhistory">
								Total Transaction/Withdraw
							</a>
						</span>
                    <h3>
                        <?php
                        $userTotalWithdrw = userWithdrawAmount($user_id);
                        if ($userTotalWithdrw != false) {
                            //echo $userTotalWithdrw;
                            echo '$'.number_format((float)$userTotalWithdrw, 2, '.', '');
                        }
                        else{
                            echo '0';
                        }
                        ?>
                    </h3>

                </li>
                <li class="col-xs-6 col-lg-3">
						<span class="title"><i class="fa fa-dollar"></i>
							<a href="http://localhost/newstark/admin/withdrawals">Total Received Amount</a>
						</span>
                    <h3 class="">
                        <?php
                        $allWithDrawAmount = totalReceivedAmount($user_id);
                        echo '$'.number_format((float)$allWithDrawAmount, 2, '.', '');
                        // $44158914.23
                        ?>

                    </h3>
                    <!--<span class="diff"><b class="color-up"><i class="fa fa-caret-up"></i> 26%</b> from last month</span>-->
                </li>

                <li class="col-xs-6 col-lg-3">
						<span class="title"><i class="fa fa-dollar"></i>

							<a href="http://localhost/newstark/admin/cashbox">Total Deposited</a>
						</span>
                    <h3>
                        <?php
                        $totalDepositbyUser =  getTotalDepositByUser(getUserId());
                        if (count($totalDepositbyUser) > 0) {
                            echo CURRENCY.number_format((float)$totalDepositbyUser[0]['ud_amount'], 2, '.', '');
                            //echo ;
                        }
                        else{
                            echo '0';
                        }
                        ?>
                    </h3>
                    <!--<span class="diff"><b class="color-up"><i class="fa fa-caret-up"></i> 26%</b> from last week</span>-->
                </li>


            </ul>
        </div>
    </div>

    <div class="container-padding">
        <!-- Start Row -->
        <div class="row" id="PrintDiv">
            <!-- Start Panel -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-title">
                        User Information
                    </div>
                    <div class="panel-body table-responsive">
                        <table class="table table-hover dataTable">
                            <thead>
                            <tr>
                                <td>User Name</td>
                                <td>Email</td>
                                <td>Mobile</td>
                                <td>NIC</td>
                                <td>Perfect Money ID</td>
                                <td>Next of kin</td>
                                <td>Next of kin Mobile</td>
                                <td>Address</td>
                                <td>Security Pin</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php echo $userAllData[0]['user_name']?></td>
                                <td><?php echo $userAllData[0]['u_email']?></td>
                                <td><?php echo $userAllData[0]['u_mobile']?></td>
                                <td><?php echo $userAllData[0]['u_nic']?></td>
                                <td><?php echo $userAllData[0]['u_perfect']?></td>
                                <td><?php echo $userAllData[0]['u_kin']?></td>
                                <td><?php echo $userAllData[0]['u_phone']?></td>
                                <td><?php echo $userAllData[0]['u_address']?></td>
                                <td>
                                    <?php echo str_repeat('*', strlen($userAllData[0]['u_pin'])); ?>
                                </td>
                            </tr>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <?php //echo $pager->links(); ?>
            </div>
            <!-- End Panel -->


        </div>
        <!-- End Row -->

    </div>


    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- START CONTAINER -->
    <div class="container-padding">
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
                        Receiving History
                    </div>
                    <div class="panel-body table-responsive">
                        <?php if ($history):

                            //var_dump($history);
                            //dd();
                            ?>
                            <table class="table table-hover dataTable">
                                <thead>
                                <tr>
                                    <td>Amount</td>
                                    <td>Cash Box Type</td>
                                    <td>User Id</td>
                                    <td>Action</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($history as $receivingHistory):?>
                                    <tr>
                                        <td><?php echo $receivingHistory['uw_amount']?></td>
                                        <td><?php echo $receivingHistory['uw_fund_type']?></td>
                                        <td>
                                            <?php
                                            $userData = getUserData($receivingHistory['user_id']);
                                            //var_dump($userData);
                                            echo $userData[0]['u_id'] . ' ('.$userData[0]['user_name'].')' ;
                                            //var_dump($userData);
                                            ?></td>
                                        <td>
                                            <?php if ($receivingHistory['uw_fund_type']=='Fund transfer'): ?>
                                                <a target="_blank" class="btn btn-primary" href="<?php echo site_url('admin/withftDetail/'.$user_id)?>">View Detail</a>
                                            <?php else: ?>
                                                <?php echo 'N/A';?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tr>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>

                </div>
                <?php //echo $pager->links(); ?>
            </div>
            <!-- End Panel -->


        </div>
        <!-- End Row -->
    </div>

    <div class="container-padding">
        <!-- Start Row -->
        <div class="row" id="PrintDiv">
            <!-- Start Panel -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-title">
                        Transaction Count
                    </div>
                    <div class="panel-body table-responsive">
                        <?php if ($trasactionCount):

                            //var_dump($history);
                            //dd();
                            ?>
                            <table class="table table-hover dataTable">
                                <thead>
                                <tr>
                                    <td>Transaction Count</td>
                                    <td>Action</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($trasactionCount as $tranCount):?>
                                    <tr>
                                        <td>
                                            <p class="font-w-600">
                                                <?php
                                                $userData = getUserData($tranCount['uw_receiver_id']);
                                                echo $userAllData[0]['u_ref_id'] . ' ('.$userAllData[0]['user_name'].')';//$userData[0]['u_ref_id'] . ' ('.$userData[0]['user_name'].')' ;
                                                ?>
                                                sent <?php echo $tranCount['totalAmount'];?> amount to <?php echo $userData[0]['u_ref_id'] . ' ('.$userData[0]['user_name'].')'?>  <?php echo $tranCount['TotalTimes']?> times.
                                            </p>
                                        </td>
                                        <td>
                                            <a target="_blank" class="btn btn-primary" href="<?php echo site_url('admin/withftDetail/'.$user_id.'?snd='.$tranCount['uw_receiver_id'])?>">
                                                Click To View Detail
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                </tr>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>

                </div>
                <?php //echo $pager->links(); ?>
            </div>
            <!-- End Panel -->


        </div>
        <!-- End Row -->
    </div>


    <!-- END CONTAINER -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->

</div>
