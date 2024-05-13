<div class="page-banner full-row bg-gray py-5">
    <div class="container">
        <div class="row row-cols-md-2 row-cols-1 g-3">
            <div class="col">
                <h3 class="page-name text-secondary m-0">Online Meeting - (<?php echo $checkOnlineMeeting[0]['name']; ?>)</h3>
            </div>
            <div class="col">
                <nav class="float-start float-md-end">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo site_url('interest-groups') ?>">Interest Groups</a></li>
                        <li class="breadcrumb-item active">
                            <?php
                            if (count($checkOnlineMeeting) == 1) :
                            ?>
                                <?php echo $checkOnlineMeeting[0]['name']; ?>
                            <?php endif; ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<?php
    // start meeting configurations
    if(isset($userData)){
        $user_full_name = $userData[0]['u_last_name'] . ' ' . $userData[0]['u_first_name'];
        $user_email = $userData[0]['u_email'];
        $meeting_number = $checkOnlineMeeting[0]['meeting_id'];
        $meeting_pwd = $checkOnlineMeeting[0]['password'];
        $role = '0';
    }
?>

<div class="full-row bg-white">
    <div class="container">
        <?php echo checkFlash(); ?>
        <?php
        if (!$userLoggedIn) {
            no_data('alert-info', 'You need to login to join a meeting.');
        }
        ?>
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-details bg-white text-ordinary mb-30">
                    <div class="thumb-two overlay-black overflow-hidden position-relative">
                        <img src="<?php echo base_url('public/assets/images/zoom-placeholder.jpg'); ?>" alt="image">
                        <div class="date text-white position-absolute z-index-9">
                            <?php echo $checkOnlineMeeting[0]['created_at']; ?>
                        </div>
                    </div>
                    <div class="blog-content mt-2">
                        <div class="blog-info">
                            <h4 class="my-4 text-secondary d-flex align-items-center justify-content-between flex-wrap">
                                <?php echo $checkOnlineMeeting[0]['name']; ?>
                                <!-- <a href="#" class="btn btn-primary" style="color: #fff !important;">Join group</a> -->
                            </h4>
                            <?php
                            echo $checkOnlineMeeting[0]['short_description'];
                            ?>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <?php if (userLoggedIn()) : ?>
                        <a href="<?php echo site_url('online-meeting/join/' . $checkOnlineMeeting[0]['id'] . '?name=' . $user_full_name . '&email=' . $user_email . '&meeting_number=' . $meeting_number . '&meeting_pwd=' . $meeting_pwd . '&role=0') ?>" class="btn btn-primary joinGroupBtn">Join Meeting</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog-sidebar mt-md-50">
                    <div class="navigation_link_widget">
                        <h4 class="double-down-line-left text-secondary position-relative pb-4 mb-4">Meeting Information</h4>
                        <div class="read-more-content">
                            <ul>
                                <?php
                                $startDatetime = $checkOnlineMeeting[0]['start_time'];
                                $durationMinutes = $checkOnlineMeeting[0]['duration'];

                                $startDateTimeObj = new \DateTime($startDatetime);

                                $endDateTimeObj = clone $startDateTimeObj;
                                $endDateTimeObj->modify("+" . $durationMinutes . " minutes");

                                $startTimestamp = $startDateTimeObj->getTimestamp();
                                $endTimestamp = $endDateTimeObj->getTimestamp();

                                $date = date('F j, Y', $startTimestamp);

                                $startTime = date('H:i', $startTimestamp);
                                $endTime = date('H:i', $endTimestamp);
                                ?>
                                <li><b>Date</b>: <?php echo $date ?></li>
                                <li><b>Time</b>: <?php echo "$startTime - $endTime" ?></li>
                                <li><b>Duration</b>: <?php echo $checkOnlineMeeting[0]['duration'] . 'min.' ?></li>
                                <li><b>Timezone</b>: <?php echo timezone_identifiers_list()[$checkOnlineMeeting[0]['timezone']] ?></li>
                                <li><b>Host Video</b>: <?php echo $checkOnlineMeeting[0]['host_video'] == 1 ? 'Yes' : 'No'; ?></li>
                                <li><b>Participant Video</b>: <?php echo $checkOnlineMeeting[0]['participant_video'] == 1 ? 'Yes' : 'No'; ?></li>
                                <li><b>Join Before Host</b>: <?php echo $checkOnlineMeeting[0]['join_before_host'] == 1 ? 'Yes' : 'No'; ?></li>
                            </ul>
                            <div class="overlay"></div>
                        </div>
                        <a href="#" class="read-more-link" onclick="toggleReadMore(event, this)">Read More</a><br><br>
                        <script>
                            function toggleReadMore(event, link) {
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
                        <?php if (userLoggedIn()) : ?>
                            <a href="<?php echo site_url('online-meeting/join/' . $checkOnlineMeeting[0]['id'] . '?name=' . $user_full_name . '&email=' . $user_email . '&meeting_number=' . $meeting_number . '&meeting_pwd=' . $meeting_pwd . '&role=0') ?>" class="btn btn-primary joinGroupBtn">Join Meeting</a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (count($otherMeetings) > 0) : ?>
                    <div class="blog-sidebar mt-md-50">
                        <div class="navigation_link_widget mt-5">
                            <h4 class="double-down-line-left text-secondary position-relative pb-4 mb-4">Other Online Meetings</h4>
                            <ul>
                                <?php foreach ($otherMeetings as $meeting) : ?>
                                    <li><?php echo $meeting['name'] ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>