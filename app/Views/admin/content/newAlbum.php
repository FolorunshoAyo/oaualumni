

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid skzMconWhite">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Add Album</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">New-Album</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6  m_cont_top">
                    <div class="form-group">
                        <?php  echo checkFlash();?>
                    </div>
                    <div class="form-group">
                        <?php  echo validation_errors();?>
                    </div>
                    <div class="form-group">
                       <!-- <form action="<?php /*echo site_url('admin/add-album')*/?>" id="ctadx" enctype="multipart/form-data" method="post" accept-charset="utf-8">-->
                            <?php echo form_open_multipart('admin/add-album',['id'=>'ctadx']); ?>
                            <span>Album Name</span> <label class="red">*</label>
                            <input type="text" name="album" value="" class="form-control" id="xp_8" placeholder="Add your album"  />
                    </div>
                    <div class="form-group">
                        <input type="submit" name="maker" value="Add Album"  class="btn btn-primary" />
                    </div>
                    <div class="cf_r">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
