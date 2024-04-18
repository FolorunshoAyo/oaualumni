<div class="col-lg-11 col-xl-10">
    <div class="row">
        <div class="dashboard-panel w-100">
            <h4 class="text-secondary mb-4">Users</h4>
            <?php
                if (count($allUsers) > 0):
            ?>
            <table class="w-100 items-list bg-transparent">
                <thead>
                <tr class="bg-white">
                    <th>User</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($allUsers as $myUsers): ?>
                    <tr>
                        <td>
                            <?php
                            $userDPxx = '';
                            $myUserDP = $myUsers['u_dp'];
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
                            <img src="<?php echo $userDPxx; ?>" alt="">
                            <div class="property-info d-table">
                                <h5 class="text-secondary">
                                    <?php echo $myUsers['u_first_name']. ' ' . $myUsers['u_last_name']; ?>
                                </h5>
                                <span class="font-14">
                                    <span class="text-primary"> Hobbies: </span>
                                     <?php echo $myUsers['u_hobbies']?>
                                </span>
                                <div class="price mt-3">
                                    <span class="font-14">
                                        <span class="text-primary"> Occupation: </span>
                                         <?php echo $myUsers['u_occupation']?>
                                    </span>
                                </div>

                            </div>
                        </td>
                        <td>
                            <?php echo $myUsers['u_email']?>
                        </td>
                        <td>
                            <?php echo $myUsers['u_address']?>
                        </td>
                        <td>
                            <a href="mailto:<?php echo $myUsers['u_email']?>" class="btn btn-primary mr-1 mb-1">
                                Contact
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif;  ?>
            <!--<nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mt-5">
                    <li class="page-item disabled"> <span class="page-link">Previous</span> </li>
                    <li class="page-item active" aria-current="page"> <span class="page-link"> 1 <span class="sr-only">(current)</span> </span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">...</li>
                    <li class="page-item"><a class="page-link" href="#">45</a></li>
                    <li class="page-item"> <a class="page-link" href="#">Next</a> </li>
                </ul>
            </nav>-->
        </div>
        <?php  userdashboardFooter(); ?>
    </div>
</div>