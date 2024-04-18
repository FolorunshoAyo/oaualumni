<div class="col-lg-11 col-xl-10">
    <div class="row">
        <div class="dashboard-panel w-100">
            <h4 class="text-secondary mb-4">Calendar</h4>
            <div class="dashboard-personal-info form-border p-5 bg-white">
                <div class="row brdresi">
                    <div class="col-md-12 col-lg-12 col-sm-12  col-xs-12">
                        <?php if (isset($data)&& count($data) > 0): ?>
                            <div id="calendar"></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php  userdashboardFooter(); ?>
    </div>
</div>