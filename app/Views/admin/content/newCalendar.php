

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid skzMconWhite">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Add Calendar</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">New Calendar</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12  m_cont_top">
                    <?php echo form_open('admin/add-calendar',['id'=>'ctadx']); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span>Calendar Title</span> <label class="red">*</label>
                                    <input type="text" name="title" value="" class="form-control" id="xp_8" placeholder="Add your Title"  />
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
                                       echo form_dropdown('eventId',$userOption,'',array('class'=>'form-control','id'=>'newEvent'));
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
                                    echo form_input('stdate','',array('class'=>'form-control','placeholder'=>'Select Start Date'), 'datetime-local');
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span>End Date</span><span class="red">*</span>
                                    <?php
                                    echo form_input('endate','',array('class'=>'form-control','placeholder'=>'Select End Date'), 'datetime-local');
                                    ?>
                                </div>
                            </div>
                        </div>
                       <div class="row">
                           <div class="col-6">
                               <div class="form-group">
                                   <input type="submit" name="maker" value="Add Calendar"  class="btn btn-primary" />
                               </div>
                           </div>
                       </div>
                    <?php echo form_close(); ?>
                </div>
            </div>

        </div>
    </div>
</div>
