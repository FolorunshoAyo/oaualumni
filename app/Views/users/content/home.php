<div class="col-lg-11 col-xl-10">
    <div class="row">
        <div class="dashboard-panel w-100">
            <h4 class="text-secondary mb-4">Dashboard</h4>

            <div class="row row-cols-xl-4 row-cols-md-2 row-cols-1 g-4">
                <div class="col">
                    <div class="ball p-4 position-relative text-white" style="background-color: #55e3b0;">
                        <i class="flaticon-user flat-medium float-start pe-3" aria-hidden="true"></i>
                        <h4 class="m-0">
                            <?php echo count($countUsers); ?>
                        </h4>
                        <span class="d-table">Available Users</span> </div>
                </div>
                <div class="col">
                    <div class="ball p-4 position-relative text-white" style="background-color: #dc69f1;">
                        <i class="flaticon-sketch flat-medium float-start pe-3" aria-hidden="true"></i>
                        <h4 class="m-0">
                            <?php echo count($countGallery); ?>
                        </h4>
                        <span class="d-table">Albums</span> </div>
                </div>
                <div class="col">
                    <div class="ball p-4 position-relative text-white" style="background-color: #f1c643;">
                        <i class="flaticon-calendar flat-medium float-start pe-3" aria-hidden="true"></i>
                        <h4 class="m-0">
                            <?php echo count($countEvents); ?>
                        </h4>
                        <span class="d-table">Calenders</span> </div>
                </div>

            </div>
            <div class="row row-cols-xl-2 row-cols-1 mt-4">
                <div class="col">
                    <div class="row row-cols-1 g-4">
                        <div class="col">
                            <div class="bg-white h-100">
                                <a href="#collapseOne" class="panel-accordian text-secondary h6 p-4 d-block position-relative m-0" data-bs-toggle="collapse" aria-expanded="true">
                                    Calendar
                                </a>
                                <div class="collapse show px-4" id="collapseOne">
                                    <?php if (isset($data)&& count($data) > 0): ?>
                                        <div id="calendar"></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col">
                    <div class="row row-cols-1 g-4 lg-mt-0">

                        <div class="col">
                            <div class="bg-white">
                                <a href="#collapseFive" class="panel-accordian text-secondary h6 p-4 d-block position-relative mb-0" data-bs-toggle="collapse" aria-expanded="true">
                                    Recent Users
                                </a>
                                <div class="collapse show px-4 pb-4" id="collapseFive">
                                    <div class="row row-cols-1 g-4">
                                        <?php if (count($usersHome)): ?>
``                                        <?php foreach ($usersHome as $myhome): ?>
                                                <div class="col">
                                                    <div class="recent-properties">

                                                        <?php
                                                        $userDPxx = '';
                                                        $myUserDP = $myhome['u_dp'];
                                                        $image_path = realpath(APPPATH . '../public/assets/images/users');
                                                        if ($myUserDP) {
                                                            if (file_exists($image_path.'/'.$myUserDP))
                                                            {
                                                                $userDPxx = base_url('public/assets/images/users/'.$myUserDP);
                                                            }
                                                            else{
                                                                $userDPxx = base_url('public/assets/club/images/thumbnail/01.jpg');
                                                            }
                                                        }
                                                        else{
                                                            $userDPxx = base_url('public/assets/club/images/thumbnail/01.jpg');
                                                        }
                                                        ?>

                                                        <a href="#" class="image-area">
                                                            <img src="<?php echo $userDPxx;?>" alt="">
                                                        </a>
                                                        <h5><a href="#" class="text-secondary"> <?php echo $myhome['u_first_name']. ' ' . $myhome['u_last_name']; ?></a></h5>
                                                        <p>
                                                            <?php echo $myhome['u_address']?>
                                                        </p>
                                                        <span>
                                                            <?php echo date('d,m,Y',strtotime($myhome['u_date']))?>

                                                        </span><!--12th Jan, 2021-->
                                                    </div>
                                                </div>
                                        <?php endforeach; ?>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <?php  userdashboardFooter(); ?>
    </div>
</div>