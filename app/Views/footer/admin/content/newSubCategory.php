

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Add Sub Category</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">New Sub Category</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-8 m_cont_top">
                    <?php  checkFlash();?>
                    <div class="cierrors">
                        <?php echo validation_errors(); ?>
                    </div>
                    <div class="form-group">
                        <?php
                        $form =  array(
                            'id'=>'ctadx',
                        );
                        echo form_open_multipart('admin/add-sub-category',$form);

                        if ($AllCategories->num_rows() >  0):
                            $CategoriesOptions = array() ;
                            foreach ($AllCategories->result() as $category) {
                                $CategoriesOptions[$category->c_id] = $category->c_title;
                            }
                            ?>
                            <label>Please select main category:</label>
                            <?php  echo  form_dropdown('category',$CategoriesOptions,'',array('class'=>'form-control'));
                            ?>
                        <?php else: ?>
                            Please add the tender files first to <a href="<?php echo site_url('admin/new-tender')?>">insert</a>  the about us section
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <span>Sub-category</span><span class="red">*</span>
                        <?php
                            echo form_input('subCategory','',array('class'=>'form-control','placeholder'=>'Add sub-category'));
                        ?>

                    </div>
                    <div class="form-group">
                        <span>Slug/URL</span><span class="red">*</span>
                        <?php
                            echo form_input('subCategorySlug','',array('class'=>'form-control','placeholder'=>'Please enter Slug/URL'));
                        ?>

                    </div>
                    <div class="cf_r">

                    </div>
                </div>
                <div class="col-md-4 m_cont_top dhpnl">
                    <div class="portlet">
                        <div class="portlet-heading portlet-default">
                            <h3 class="portlet-title text-dark">
                                Publish
                            </h3>
                            <div class="portlet-widgets">
                                <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default"><i class="mdi mdi-minus"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div id="bg-default" class="panel-collapse collapse in show">
                            <div class="portlet-body">
                                <div class="form-group">
                                    <?php
                                    $status = array() ;
                                    $status['1']= 'Active';
                                    $status['0'] = 'Disable';
                                    ?>
                                    <label>Status:</label> <span class="red">*</span>
                                    <?php  echo  form_dropdown('status',$status,'',array('class'=>'form-control'));
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php echo form_submit('maker','Add','class="btn btn-primary skzmsubmbtn"'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

