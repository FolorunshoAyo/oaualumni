

<main>

    <div class="main-content">

        <div class="col-md-6  m_cont_top">
            <div class="form-group">
                <?php  checkFlash();?>
            </div>
            <h3>Program Category</h3>
            <div class="form-group">
                <form action="<?php echo site_url('admin/update-program-category')?>" id="ctadx" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <input type="text" name="sName" value="<?php echo $proCat[0]['pcName'];?>" class="form-control" id="xp_8" placeholder="Category Name"  />
            </div>
            <div class="form-group">
                <input type="text" name="sSlug" value="<?php echo $proCat[0]['pcSlug'];?>" class="form-control" id="xp_99x" placeholder="Slug"  />
            </div>

            <div class="form-group">
                <label>Select Language:</label>
                <input type="hidden" value="<?php echo $proCat[0]['pcId'];?>" name="xiiie">
                <?php
                    $language = array(
                            'English'=>'English',
                            'Urdu'=>'Urdu',
                            'Sindhi'=>'Sindhi',
                    );
                    echo form_dropdown('language',$language,$proCat[0]['pcLanguage'],array('class'=>'form-control'));
                ?>
               <!-- <select name="language">
                    <option>English</option>
                    <option>Urdu</option>
                    <option>Sindhi</option>
                </select>-->
            </div>

            <div class="form-group">
                <input type="submit" name="maker" value="Add Contact"  class="btn btn-primary" />
            </div>
            <div class="cf_r">

            </div>
        </div>
    </div>

    </form>
    <!--/.main-content -->
    <!--/.main-content -->

</main>
