

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid skzMconWhite">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title float-left">Add a New Country</h4>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin')?>"> Dashboard </a></li>
                            <li class="breadcrumb-item active">New Country</li>
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
                            <h4 class="card-title">Add a new Country</h4>
                            <form action="<?php echo site_url('admin/addCountry')?>"  id="newCategory" method="POST">
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationDefault01">Country name <span class="red">*</span></label>
                                        <?php
                                        echo form_input('country_name','',
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
                                        echo form_input('country_slug','',
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
                                        echo form_dropdown('status',$statusOptions,'',array('class'=>'form-control custom-select'));
                                        ?>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <p></p>
                                            <button class="btn btn-primary" type="submit">Add Country</button>
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
