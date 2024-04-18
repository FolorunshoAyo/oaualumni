<div class="content">

    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">User Tracking</h1>
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
                    <form action="<?php echo site_url('admin/tracking')?>" method="get">

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
                                    <label>Section</label>
                                    <?php if (count($allSections) >  0):
                                        $userSection = array();
                                        $userSection[''] = 'Select Section';
                                        foreach ($allSections as $mySection):
                                            $userSection[$mySection['tr_section']] = ucwords($mySection['tr_section']) ;
                                        endforeach;
                                        echo form_dropdown('sect',$userSection,$filters['sect'],array('class'=>'form-control','onchange'=>'this.form.submit()'));
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
                                    echo form_input('ftrid',$filters['ftrid'],array('class'=>'form-control datepicker','placeholder'=>'Select From Date'));
                                    ?>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="srlef">
                                <div class="form-group">
                                    <span>To Date</span><span class="red">*</span>
                                    <?php
                                    echo form_input('ttrid',$filters['ttrid'],array('class'=>'form-control datepicker','placeholder'=>'Select To Date'));
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
                                    <a href="<?php echo site_url('admin/tracking')?>" class="btn btn-primary">Restore Filter</a>
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
                        <?php if ($trackingUsers):
                            //var_dump($maximumReivedAmount);
                            //dd();
                            ?>
                            <table class="table table-hover dataTable">
                                <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>User</td>
                                    <td>Date</td>
                                    <td>Section</td>
                                    <td>section ID</td>
                                    <td>Platform</td>
                                    <td>Browser</td>
                                    <td>Country</td>
                                    <td>City</td>
                                    <td>IP</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($trackingUsers as $userTrack):?>
                                    <tr>
                                        <?php
                                            if (isset($userTrack['user_id']) && !empty($userTrack['user_id'])) {
                                                $userID='5Stark'.$userTrack['user_id'];
                                            }
                                            else{
                                                $userID='5Stark'.$userTrack['section_id'];
                                            }
                                        ?>
                                        <td>  <?php echo $userTrack['tr_id']?></td>
                                        <td>  <?php echo $userTrack['user_id']?></td>
                                        <td>  <?php echo $userTrack['tr_date']?></td>
                                        <td>  <?php echo $userTrack['tr_section']?></td>
                                        <?php if ($userTrack['tr_section']=='login'): ?>
                                            <td>  <?php echo '5Stark'.$userTrack['section_id']?></td>
                                        <?php else: ?>
                                            <td>  <?php echo $userTrack['section_id']?></td>
                                        <?php endif; ?>
                                        <td>  <?php echo $userTrack['tr_platform']?></td>
                                        <td>  <?php echo $userTrack['tr_user_agent']?></td>
                                        <td>  <?php echo $userTrack['tr_country']?></td>
                                        <td>  <?php echo $userTrack['tr_city']?></td>
                                        <td>  <?php echo $userTrack['tr_ip_address']?></td>
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
