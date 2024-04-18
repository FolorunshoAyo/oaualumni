<div class="content">

    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">Received Fund Transfer History/Detail</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
            <li class="active">Received Fund Transfer History/Detail</li>
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
                        <form action="<?php echo site_url('admin/ftDetail/'.$skzUserId)?>" method="get">
                            <div class="col-md-3">
                                <div class="srlef">
                                    <div class="form-group">
                                        <span>From Date</span><span class="red">*</span>
                                        <?php
                                        echo form_input('fcbd',$filters['fcbd'],array('class'=>'form-control datepicker','placeholder'=>'Select From Date'));
                                        ?>
                                    </div>
                                    <?php if (isset($senderId) && !empty($senderId)):?>
                                            <input type="hidden" name="snd" value="<?php echo $senderId?>">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="srlef">
                                    <div class="form-group">
                                        <span>To Date</span><span class="red">*</span>
                                        <?php
                                        echo form_input('tcbd',$filters['tcbd'],array('class'=>'form-control datepicker','placeholder'=>'Select To Date'));
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
                                        <a href="<?php echo site_url('admin/ftDetail/'.$skzUserId)?>" class="btn btn-primary">Restore Filter</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Start Panel -->
            <div class="col-md-12" id="PrintDiv">
                <div class="form-group">
                    <?php echo checkFlash(); ?>
                </div>
                <div class="panel panel-default">
                    <div class="pull-right">
                        <a href="javascript:void(0)" onclick="printdiv('PrintDiv');" class="btn btn-success waves-effect waves-light">Print Now</a>
                        <a href="javascript:void(0)" id="exportasCSV" class="btn btn-success waves-effect waves-light">Export</a>
                    </div>
                    <div class="panel-title">
                        Received Fund Transfer History/Detail
                    </div>
                    <div class="panel-body table-responsive">
                        <?php
                        $cshUTamnt = 0;
                        if ($allUserCashBox):
                            ?>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <!--<td class="text-center"><i class="fa fa-trash"></i></td>-->
                                    <td>Cash Box ID</td>
                                    <td>User (Receiver) </td>
                                    <td>Sender</td>
                                    <td>Received Date</td>
                                    <td>Inserted Date</td>
                                    <td>Type</td>
                                    <td>Currency</td>
                                    <td>Amount</td>
                                    <td>Status</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($allUserCashBox as $userCachBox):?>
                                    <tr>
                                        <!--										<td class="text-center"><div class="checkbox margin-t-0"><input id="checkbox1" type="checkbox"><label for="checkbox1"></label></div></td>-->
                                        <td># <b><?php echo $userCachBox['cb_id']?></b></td>
                                        <td><?php echo $userCachBox['u_ref_id'] . ' ( '.$userCachBox['user_name'].')'; ?></td>
                                        <td>
                                            <?php
                                            if ($userCachBox['cb_type'] == 'Fund transfer') {
                                                //echo $userCachBox->sender_id;
                                                $userInfoSKZ = getUserInfo($userCachBox['sender_id']);
                                                if ($userInfoSKZ != false) {
                                                    echo $userInfoSKZ[0]['u_ref_id'] . ' ( ' . $userInfoSKZ[0]['user_name'] . ')';
                                                }else{
                                                    echo 'User Not found.';
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td><?php if(!empty($userCachBox['cb_date'])){ echo $userCachBox['cb_date'];}else{ echo 'N/A';}?></td>
                                        <td><?php echo $userCachBox['cb_inserted_date']; ?></td>
                                        <td><?php echo $userCachBox['cb_type']?></td>
                                        <td><?php echo $userCachBox['cb_currency']?></td>
                                        <td>
                                            <?php
                                            //echo $userCachBox->cb_amount;
                                            $cshUTamnt+=$userCachBox['cb_amount'];
                                            echo number_format((float)$userCachBox['cb_amount'], 2, '.', '');
                                            ?>
                                        </td>

                                        <td>
                                            <?php if ($userCachBox['cb_status'] == 1): ?>
                                                <button class="btn btn-success">
                                                    Active
                                                </button>
                                            <?php else: ?>
                                                <a  href="<?php echo site_url('admin/approvecashbox/'.$userCachBox['cb_id']); ?>" class="btn btn-info">
                                                    Approve Now
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                                <tr>
                                    <td>Total CashBox for This page: <strong><?php echo $cshUTamnt;?></strong></td>
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
