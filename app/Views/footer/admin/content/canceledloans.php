<div class="content">

    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">Canceled Loans</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>">Dashboard</a></li>
            <li class="active">Canceled Loans</li>
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
                                <form action="<?php echo site_url('admin/pendingloans')?>" method="get">
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
                                    <div class="col-md-3">
                                        <div class="srlef">
                                            <div class="form-group">
                                                <span>From Date</span><span class="red">*</span>
                                                <?php
                                                echo form_input('fpln',$filters['fpln'],array('class'=>'form-control datepicker','placeholder'=>'Select From Date'));
                                                ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="srlef">
                                            <div class="form-group">
                                                <span>To Date</span><span class="red">*</span>
                                                <?php
                                                echo form_input('tpln',$filters['tpln'],array('class'=>'form-control datepicker','placeholder'=>'Select To Date'));
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
                                                <a href="<?php echo site_url('admin/pendingloans')?>" class="btn btn-primary">Restore Filter</a>
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
            <div class="col-md-12">
                <div class="form-group">
                    <?php  echo checkFlash();?>
                    <div class="cierrors">
                        <?php echo validation_errors(); ?>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-title">
                        Pending Loans
                    </div>
                    <div class="panel-body table-responsive">
                        <?php if ($Mywithdraws):?>
                            <?php echo form_open('admin/bulkapproved','')?>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <!--<td class="text-center"><i class="fa fa-trash"></i></td>-->
                                    <td>ul_id</td>
                                    <td>User Plan</td>
                                    <td>User</td>
                                    <td>Amount</td>
                                    <td>Status</td>
                                    <td>Cancel Now</td>
                                    <td>Who Approved</td>
                                    <td>Prof</td>
                                    <td>Date</td>
                                    <td>Updated</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $prmonSum = 0;
                                //var_dump($Mywithdraws);
                                ?>
                                <?php foreach ($Mywithdraws as $currentWithdraw): ?>
                                    <tr>
                                        <td># <b><?php echo $currentWithdraw['ul_id']?></b></td>
                                        <td><?php
                                            $userPlan = getUserPlan($currentWithdraw['user_id']);
                                            echo $userPlan;
                                            ?>
                                        </td>
                                        <td><?php echo $currentWithdraw['u_ref_id'] . ' ( '.$currentWithdraw['user_name'].')'; ?></td>
                                        <td><?php echo $currentWithdraw['ul_amount']?></td>

                                        <?php if ($currentWithdraw['ul_status'] == 0): ?>
                                            <td>
                                                <a  href="<?php echo site_url('admin/approveloan/'.$currentWithdraw['ul_id'].'/3');//3 for approve ?>" class="btn btn-primary">
                                                    Approve Now
                                                </a>
                                            </td>
                                        <?php elseif($currentWithdraw['ul_status'] == 2): ?>
                                            <td>
                                                <a  href="javascript:void(0)" class="btn btn-danger">
                                                    Canceled
                                                </a>
                                            </td>
                                        <?php endif; ?>
                                        <?php if ($currentWithdraw['ul_status'] == 0): ?>
                                            <td>
                                                <a  href="<?php echo site_url('admin/approveloan/'.$currentWithdraw['ul_id'].'/2');//2 for cancel ?>" class="btn btn-danger">
                                                    Cancel Now
                                                </a>
                                            </td>
                                        <?php endif; ?>
                                        <td>
                                            <?php
                                            $skzAdmin = getAdminData($currentWithdraw['admin_id']);
                                            if ($skzAdmin != false) {
                                                echo $skzAdmin[0]['aName'];
                                            }
                                            else{
                                                echo 'N/A';
                                            }

                                            ?>
                                        </td>
                                        <td>
                                            <?php if(!empty($currentWithdraw['ul_proff'])): ?>
                                                <a href="javascript:void(0)" class="showProf" data-text="<?php echo base_url('public/assets/images/prof/' . $currentWithdraw['ul_proff']); ;?>">
                                                    <img src="<?php echo base_url('public/assets/images/prof/'.$currentWithdraw['ul_proff']); ?>" class="img-responsive imgProf">
                                                </a>
                                            <?php else: ?>
                                                N/A
                                            <?php endif;  ?>
                                        </td>
                                        <td><?php echo $currentWithdraw['ul_date']?></td>
                                        <td><?php echo $currentWithdraw['ul_updated']?></td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                            <?php echo form_close(); ?>
                        <?php endif; ?>
                    </div>

                </div>
                <p><?php //echo 'Total PM on this page: <strong>'.$prmonSum .'</strong>';?></p>
                <?php echo $pager->links(); ?>
            </div>
            <!-- End Panel -->











        </div>
        <!-- End Row -->






    </div>
    <!-- END CONTAINER -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->




</div>
