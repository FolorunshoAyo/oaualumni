
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid skzMconWhite">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">All Images</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">view album images</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <form action="<?php echo site_url('admin/view-album-images')?>" method="get">
                            <div class="col-md-3">
                                <div class="srlef">
                                    <div class="form-group">
                                        <label>Users</label>
                                        <?php if (count($AllGalleries) >  0):
                                            $galleryOption = array();
                                            $galleryOption[''] = 'Select User';
                                            foreach ($AllGalleries as $myGallery):
                                                $galleryOption[$myGallery['gl_id']] =  $myGallery['gl_name'] ;
                                            endforeach;
                                            echo form_dropdown('glry',$galleryOption,$filters['glr'],array('class'=>'form-control','id'=>'userID','onchange'=>'this.form.submit()'));
                                            ?>
                                        <?php else: ?>
                                            <?php no_data('alert-info','Gallery not available')?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="srlef">
                                    <div class="form-group">
                                        <span>From Date</span><span class="red">*</span>
                                        <?php
                                        echo form_input('fgl',$filters['fgl'],array('class'=>'form-control datepicker','placeholder'=>'Select From Date'));
                                        ?>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="srlef">
                                    <div class="form-group">
                                        <span>To Date</span><span class="red">*</span>
                                        <?php
                                        echo form_input('tgl',$filters['tgl'],array('class'=>'form-control datepicker','placeholder'=>'Select To Date'));
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
                                        <a href="<?php echo site_url('admin/view-album-images')?>" class="btn btn-primary">Restore Filter</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="row">
                 <div class="col-md-12">
                    <div class="row">
                         <div class="col-md-12">
                            <div class="form-group">
                                <?php echo checkFlash(); ?>
                            </div>
                            <section class="rightsec">
                                <div class="erresnd">

                                </div>
                                <?php if ($galleryImages):?>
                                    <table id="datatable" class="table table-bordered">
                                        <thead>
                                            <th>Id</th>
                                            <th>Album Name</th>
                                            <th>Image</th>
                                            <th>Date</th>
                                            <th>Delete</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach($galleryImages as $galleryImage):?>
                                            <tr class="gmi<?php echo $galleryImage['gi_id']?>">
                                                <td data-title="Order #">
                                                    <?php echo $galleryImage['gi_id']?>
                                                </td>
                                                <td data-title="Order #">
                                                    <?php echo $galleryImage['gl_name']?>
                                                </td>
                                                <td data-title="Order #">
                                                    <img src="<?php echo base_url('public/assets/images/galleryImages/'.$galleryImage['gi_name']); ?>" class="img-responsive" width="200">
                                                </td>
                                                <td data-title="Order #">
                                                    <?php echo $galleryImage['gi_date']?>
                                                </td>
                                                <td data-title="Order #">
                                                    <a  href="<?php echo site_url('admin/delete-gallery-image/'.$galleryImage['gi_id'].'/'.$galleryImage['gi_name']); ?>" class="btn btn-danger galleryImageDrop">
                                                        Delete
                                                    </a>
                                                </td>

                                            </tr>
                                        <?php endforeach;?>'
                                        </tbody>
                                    </table>
                                    <?php echo $pager->links();?>
                                <?php else: ?>
                                    <?php no_data('alert-info','There is not any Press Pictures')?>
                                <?php endif?>
                            </section>
                         </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>