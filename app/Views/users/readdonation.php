<div class="page-banner full-row bg-gray py-5">
    <div class="container">
        <div class="row row-cols-md-2 row-cols-1 g-3">
            <div class="col">
                <h3 class="page-name text-secondary m-0">Donation - (<?php echo $checkProject[0]['project_name'];?>)</h3>
            </div>
            <div class="col">
                <nav class="float-start float-md-end">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo site_url('donations')?>">Donations</a></li>
                        <li class="breadcrumb-item active">
                            <?php
                                if (count($checkProject) == 1):
                            ?>
                                <?php echo $checkProject[0]['project_name'];?>
                            <?php  endif; ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="full-row bg-white">
    <div class="container">
        <?php echo checkFlash(); ?>
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-details bg-white text-ordinary mb-4">
                    <div class="thumb-two overlay-black overflow-hidden position-relative">
                        <img src="<?php echo base_url('public/assets/images/project/'.$checkProject[0]['project_image']);?>" alt="image">
                        <div class="date text-white position-absolute z-index-9">
                            <?php echo $checkProject[0]['created_at']; ?>
                        </div>
                    </div>
                    <div class="blog-content mt-2">
                        <div class="blog-info">
                            <h4 class="my-4 text-secondary d-flex align-items-center justify-content-between flex-wrap">
                                <?php echo $checkProject[0]['project_name']; ?>
                            </h4>
                            <span class="location mb-3 d-block"><i class="fas fa-map-marker-alt text-primary"></i> <?php  echo $checkProject[0]['project_location']; ?></span>
                            <div class="py-3 px-4 my-3 bg-gray">
                                <div class="progress mb-3">
                                    <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($checkProject[0]['current_amount'] / $checkProject[0]['target_amount']) * 100 ?>%">
                                        <span class="percent-value"><?php echo ($checkProject[0]['current_amount'] / $checkProject[0]['target_amount']) * 100 ?>%</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    Generated $<?= number_format($checkProject[0]['current_amount'], 2) ?> of $<?= number_format($checkProject[0]['target_amount'], 2) ?>.
                                </div>
                            </div>
                            <?php
                                echo $checkProject[0]['description'];
                            ?>
                        </div>
                    </div>
                </div>
                <?php if($checkProject[0]['status'] !== "2"): ?>
                <div>
                    <button class="btn btn-primary donateButton">Make Donation</button>
                </div>
                <?php else: ?>
                    <div class="mt-4">
                        <p> Our Goal was successfully met. Thanks to the above contributors. 🎉✨</p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-4">
                <div class="blog-sidebar mt-md-50">
                    <div class="navigation_link_widget">
                        <h4 class="double-down-line-left text-secondary position-relative pb-4 mb-4">Contributors (<?php echo count($contributors) ?>)</h4>
                        <div <?php echo count($contributors) > 2? 'class="read-more-content"' : "" ?>>
                            <?php if ($contributors): ?>
                            <ul>
                                <?php foreach($contributors as $contributor):?>
                                    <li><?php echo $contributor['first_name'] . " " . $contributor['last_name'] . " @ " . $contributor['email'] . " - <b>$" . $contributor['amount'] . "</b>"?></li>
                                <?php endforeach;?>  
                            </ul>
                            <?php else: ?>
                                <?php no_data('alert-info','No contributors registered'); ?>
                            <?php endif; ?>
                            <div class="overlay"></div>
                        </div>
                        <?php if (count($contributors) > 2): ?>
                            <a href="#" class="read-more-link" onclick="toggleReadMore(event, this)">Read More</a>
                            <script>
                                function toggleReadMore(event,link) {
                                    event.preventDefault();

                                    var content = link.closest('.navigation_link_widget').querySelector('.read-more-content');
                                    var overlay = content.querySelector('.overlay');

                                    if (link.classList.contains('read-more-link')) {
                                        // Expand the content
                                        content.style.height = content.scrollHeight + 'px';
                                        overlay.style.opacity = 0;
                                        link.classList.remove("read-more-link");
                                        link.classList.add("read-less-link");
                                        link.innerHTML = "Read Less";
                                    } else {
                                        // Collapse the content
                                        content.style.height = '60px'; // Set the initial height
                                        overlay.style.opacity = 1;
                                        link.classList.add("read-more-link");
                                        link.classList.remove("read-less-link");
                                        link.innerHTML = "Read More";
                                    }
                                }
                            </script>
                         <?php endif; ?>
                        <?php if($checkProject[0]['status'] !== "2"): ?>
                        <div class="mt-4">
                            <button class="btn btn-primary donateButton">Make Donation</button>
                        </div>
                        <?php else: ?>
                            <div class="mt-4">
                                <p> Our Goal was successfully met. Thanks to the above contributors. 🎉✨</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (count($otherProjects) > 0): ?>
                    <div class="blog-sidebar mt-md-50">
                        <div class="navigation_link_widget mt-5">
                            <h4 class="double-down-line-left text-secondary position-relative pb-4 mb-4">Other Donations</h4>
                            <ul>
                                <?php foreach($otherProjects as $project): ?>
                                    <li><a href="<?php echo site_url("donation/read/" . $project['project_id'])?>"><b><?php echo $project['project_name']  . ' (' . $project['contributors'] . ' contributors)' ?></b></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div id="donationModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Donation Wizard</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Step 1: Select Donation Amount -->
        <div id="step1">
            <p>Select the amount you wish to donate to <b>(<?php echo $checkProject[0]['project_name'] ?>):</b></p>
            <div class="amount-options">
                <label class="amount-option">
                    <input type="radio" name="donationAmount" value="10">
                    <span class="pill">$10</span>
                </label>
                <label class="amount-option">
                    <input type="radio" name="donationAmount" value="20">
                    <span class="pill">$20</span>
                </label>
                <label class="amount-option">
                    <input type="radio" name="donationAmount" value="50">
                    <span class="pill">$50</span>
                </label>
                <label class="amount-option">
                    <input type="radio" name="donationAmount" value="100">
                    <span class="pill">$100</span>
                </label>
            </div>
            <div class="form-group">
                <label for="customAmount">Or enter custom amount:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text rounded-0">$</span>
                    </div>
                    <input type="number" class="form-control rounded-0" id="customAmount" aria-label="Amount (to the nearest dollar)" placeholder="Enter amount">
                </div>
            </div>
        </div>
        <div id="step2" style="display: none;">
            <p>Please fill in the following form:</p>
            <form id="guestForm">
                <div class="row mb-3">
                    <div class="form-group col-6">
                        <label for="guestFirstName">First Name</label>
                        <input type="text" class="form-control" id="guestFirstName" placeholder="Enter First Name">
                    </div>
                    <div class="form-group col-6">
                        <label for="guestLastName">Last Name</label>
                        <input type="text" class="form-control" id="guestLastName" placeholder="Enter Last Name">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="guestEmail">Email</label>
                    <input type="text" class="form-control" id="guestEmail" placeholder="Enter your Email">
                </div>
                <div class="form-group">
                    <label for="guestPhone">Phone</label>
                    <input type="tel" class="form-control" id="guestPhone" placeholder="Enter your mobile number">
                </div>
            </form>
        </div>
        <!-- Step 3: Donation Summary -->
        <div id="step3" style="display: none;">
          <h5>Donation Summary</h5>
          <div class="row">
            <div class="col-6">
                <p><b>First Name:</b> <br> 
                    <span id="summaryFirstName">
                        <?php echo $userLoggedIn? $userData[0]['u_first_name'] : ""?>
                    </span>
                </p>
            </div>
            <div class="col-6">
                <p><b>Last Name:</b> <br> <span id="summaryLastName"><?php echo $userLoggedIn? $userData[0]['u_last_name'] : "" ?> </span></p>
            </div>
            <div class="col-6">
                <p><b>Email:</b> <br> <span id="summaryEmail"><?php echo $userLoggedIn? $userData[0]['u_email'] : "" ?></span></p>
            </div>
            <div class="col-6">
                <p><b>Phone:</b> <br> <span id="summaryPhone"><?php echo $userLoggedIn? $userData[0]['u_mobile'] : "" ?></span></p>
            </div>
            <div class="col-12">
                <p><b>Amount:</b> <br> <span id="summaryAmount"></span></p>
            </div>
          </div>          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="prevButton" class="btn btn-primary" style="display: none;">Previous</button>
        <button type="button" id="nextButton" class="btn btn-primary">Next</button>
        <button type="button" id="payNowButton" class="btn btn-primary" style="display: none;">
            Pay With Paypal                                   
        </button>
      </div>
      </div>
    </div>
  </div>
</div>