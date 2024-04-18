<div class="content">

    <!-- Start Page Header -->
    <div class="page-header">
        <h1 class="title">All Withdrawals</h1>
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
                        Ticket Detail
                    </div>
                    <div class="panel-body table-responsive">
                        <?php
                        $totalUsrWithdrw = 0;
                        if ($isTicAvailabe):
                            ?>
                            <table class="table table-bordered mb-0">
                                <tbody>
                                <tr>
                                    <td>
                                        Ticket ID
                                    </td>
                                    <td><?php echo $isTicAvailabe[0]['ut_ticket_number']?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Title
                                    </td>
                                    <td><?php echo  $isTicAvailabe[0]['ut_title']?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Ticket Category
                                    </td>
                                    <td><?php echo  $isTicAvailabe[0]['tic_name']?></td>
                                </tr>
                                <tr>
                                    <td>
                                        User Name
                                    </td>
                                    <td><?php echo  $isTicAvailabe[0]['user_name'].'('.$isTicAvailabe[0]['u_ref_id'].')'?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Phone/Contact
                                    </td>
                                    <td><?php echo  $isTicAvailabe[0]['u_mobile']?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Date
                                    </td>
                                    <td><?php echo $isTicAvailabe[0]['ut_date']?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Detail
                                    </td>
                                    <td><?php echo $isTicAvailabe[0]['ut_detail']?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Status
                                    </td>
                                    <td>
                                        <?php if ($isTicAvailabe[0]['ut_status'] ==1): ?>
                                            <button class="btn btn-success">
                                                Success
                                            </button>
                                        <?php elseif ($isTicAvailabe[0]['ut_status'] == 2): ?>
                                            <button class="btn btn-warning">
                                                cancelled
                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-info">
                                                Pending
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Close Ticket
                                    </td>
                                    <td><a href="<?php echo site_url('admin/closeticket/'.$isTicAvailabe[0]['ut_id'])?>" class="btn btn-primary">Close Now</a> </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="mt-5">
                                <?php
                                $AllComments = getallTicketComments($isTicAvailabe[0]['ut_id']);
                                if ($AllComments):
                                    //var_dump($AllComments);
                                    ?>
                                    <h3 class="m-2">Admin Comments</h3>
                                    <?php foreach($AllComments as $myComnt):?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <tbody>
                                            <tr>
                                                <td><?php echo $myComnt['tcm_comment']?></td>
                                                <td><?php echo $myComnt['tcm_date']?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        <br>
                        <hr>
                        <div class="mt-5">
                            <?php echo form_open('admin/addcomment','')?>
                                <div class="form-group">
                                    <?php echo form_textarea('comment','',['class'=>'form-control']); ?>
                                    <input type="hidden" name="xoi" value="<?php echo $isTicAvailabe[0]['ut_id']?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Add Comment</button>
                            <?php echo form_close(); ?>
                        </div>
                            <?php
                            if ($TicketImages):
                                ?>
                                <div class="row">
                                    <?php foreach($TicketImages as $tickImgs):?>
                                        <div class="col-4">
                                            <img src="<?php echo base_url("public/assets/images/usertickets/".$tickImgs['utm_pic_name'])?>" class="img-fluid img-responsive">
                                        </div>
                                    <?php endforeach;?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            <!-- End Panel -->











        </div>
        <!-- End Row -->






    </div>
    <!-- END CONTAINER -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->




</div>
