

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid skzMconWhite">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Edit Country</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">Edit Country</li>
                        </ol>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12  m_cont_top">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                            $validation = \Config\Services::validation();
                            echo $validation->listErrors();
                            echo checkFlash();
                            ?>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Country</h4>
                            <form action="<?php echo site_url('admin/updateCountry')?>"  id="newCategory" method="POST">
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationDefault01">Country name <span class="red">*</span></label>
                                        <input type="hidden" name="xkuzj" value="<?php echo $country[0]['co_id'] ?>">
                                        <?php
                                        echo form_input('country_name',$country[0]['co_name'],
                                            array(
                                                'class'=>'form-control',
                                                'id'=>'b_name',
                                                'placeholder'=>'Country Name',

                                            )
                                        );
                                        ?>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationDefault02">Slug/URL</label>
                                        <span class="edturl pull-right">Edit</span>
                                        <?php
                                        echo form_input('country_slug',$country[0]['co_slug'],
                                            array(
                                                'class'=>'form-control',
                                                'id'=>'b_url',
                                                'placeholder'=>'Slug/URL',
                                                'readonly'=>'readonly',

                                            )
                                        );
                                        ?>
                                        <!--<input type="text" class="form-control" id="validationDefault02" placeholder="Slug/URL" value="Otto" >-->
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationDefault03">Status</label>
                                        <?php
                                        $statusOptions['1'] = 1;
                                        $statusOptions['0'] = 0;
                                        echo form_dropdown('status',$statusOptions,$country[0]['co_status'],array('class'=>'form-control custom-select'));
                                        ?>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p></p>
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
