
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Calendar</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">Edit Calendar</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12  m_cont_top">
                    <?php  echo checkFlash();?>
                    <?php echo validation_errors(); ?>
                    <div class="form-group">
                        <?php
                        $form =  array(
                            'id'=>'ctadx',
                        );
                        echo form_open('admin/update-calendar',$form);
                        ?>

                    </div>
                    <input type="hidden" name="xdi" value="<?php echo $calendar[0]['ev_id']?>" class="">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span>Calendar Title</span> <label class="red">*</label>
                                <?php
                                    echo form_input('title',$calendar[0]['title'],array('class'=>'form-control','placeholder'=>'Add your Title'));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span>Select Event</span> <label class="red">*</label>
                                <?php if (count($allEvents) >  0):
                                    $userOption = array();
                                    $userOption[''] = 'Select Event';
                                    foreach ($allEvents as $myEvent):
                                        $userOption[$myEvent['ne_id']] =  $myEvent['ne_title'] ;
                                    endforeach;
                                    echo form_dropdown('eventId',$userOption,$calendar[0]['events_id'],array('class'=>'form-control','id'=>'newEvent'));
                                    ?>
                                <?php else: ?>
                                    <?php no_data('alert-info','The Events is not available. ')?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span>Start Date</span><span class="red">*</span>
                                <?php
                                echo form_input('stdate',$calendar[0]['start_date'],array('class'=>'form-control datepicker','placeholder'=>'Select Start Date'), 'datetime-local');
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span>End Date</span><span class="red">*</span>
                                <?php
                                echo form_input('endate',$calendar[0]['end_date'],array('class'=>'form-control datepicker','placeholder'=>'Select End Date'), 'datetime-local');
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                if (!empty($calendar[0]['ev_status']) || $calendar[0]['ev_status'] == 0):
                                    $status = array() ;
                                    $status['7'] = 'Disable';
                                    $status['1']= 'Active';
                                    ?>
                                    <label>Status:</label> <label class="red">*</label>
                                    <?php  echo  form_dropdown('status',$status,$calendar[0]['ev_status'],array('class'=>'form-control'));
                                    ?>
                                <?php else: ?>
                                    The status is not available please try again.
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo form_submit('maker','Update','class="btn btn-primary"'); ?>
                    </div>
                    <div class="cf_r">

                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
