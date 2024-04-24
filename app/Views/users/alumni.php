<!--============== Banner Section Start ==============-->
<div class="page-banner full-row bg-gray py-5">
    <div class="container">
        <div class="row row-cols-md-2 row-cols-1 g-3">
            <div class="col">
                <h3 class="page-name text-secondary m-0">Alumni Directory</h3>
            </div>
            <div class="col">
                <nav class="float-start float-md-end">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active">Alumni Directory</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!--============== Banner Section End ==============-->

<section id="page-content-wrap" class="full-row bg-white">
    <div class="directory-page-content-warp section-padding">
        <div class="container">
            <div class="row">
            <?php if ($allAlumni):?>
                <div class="col-lg-12 text-center">
                    <div class="directory-text-wrap">
                        <h2>Now we have <strong class="funfact-count"><?php echo number_format($totalAlumni, 0, ',') ?></strong> members </h2>
                        <div class="table-search-area">
                            <?php echo form_open('',['method'=>'get', 'class'=>'selecting-command d-flex justify-content-center flex-wrap'])?>
                                <input type="text" name="q" class="form-control" placeholder="Type Your Keyword Here">
                                <button type="submit" class="btn btn-primary">Search</button>
                            <?php echo form_close();?>
                        </div>

                        <p class="show-memeber text-end">
                            <?php
                                $currentPage = $pager->getCurrentPage();
                                $perPage = $pager->getPerPage();
                                $totalResults = (int) $totalAlumni;

                                $start = ($currentPage - 1) * $perPage + 1;
                                $end = min($start + $perPage - 1, $totalResults);
                            ?>
                            Show <span><?php echo $start ?></span>-<span><?php echo $end ?></span> of <span> <?php echo $totalAlumni ?> Member</span>
                        </p>

                        <div class="directory-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Occupation</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Batch</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($allAlumni as $alumni):?>
                                        <tr>
                                            <td class="d-flex align-items-center">
                                                <img src="<?php echo base_url('public/assets/images/alumni/'.$alumni['al_profile_image']);?>" alt="table">
                                                <span><?php  echo $alumni['al_full_name']; ?><br>
                                                <b><?php echo word_limiter($alumni['al_bio'], 10); ?></b></span>
                                            </td>
                                            <td><?php  echo $alumni['al_major']; ?></td>
                                            <td><?php  echo $alumni['al_occupation']; ?></td>
                                            <td><?php  echo $alumni['al_company']; ?></td>
                                            <td><?php  echo $alumni['al_location']; ?></td>
                                            <td><?php  echo $alumni['al_location']; ?></td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="pagination-wrap text-center">
                        <?php echo $pager->links();?>
                    </div>
                </div>
            </div>
            <?php else: ?>
                <?php no_data('alert-info','No Interest Groups has been created'); ?>
            <?php endif?>
        </div>
    </div>
</section>