<!--============== Banner Section Start ==============-->
<div class="page-banner full-row bg-gray py-5">
    <div class="container">
        <div class="row row-cols-md-2 row-cols-1 g-3">
            <div class="col">
                <h3 class="page-name text-secondary m-0">Donation Made</h3>
            </div>
            <div class="col">
                <nav class="float-start float-md-end">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a <?php echo base_url() ?>>Home</a></li>
                        <li class="breadcrumb-item active">Donation Made</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!--============== Banner Section End ==============-->

<!--============== Error Section End ==============-->
<div class="full-row bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="text-center">
                    <h1 class="font-80 text-primary w-100">Thank You</h1>
                    <span class="error-text"> Thank You @ (<b><?php echo $email ?></b>) for donating to (<b><?php echo $item_name ?></b>)</span> <br>
                    <span class="error text">Donation Amount: <b><?php echo $currency_code . $payment_amt ?></b></span><br>
                    <a class="btn btn-primary mt-3" href="<?php echo site_url('donations') ?>">Go Back To Donations</a> 
                </div>
            </div>
        </div>
    </div>
</div>
<!--============== Error Section End ==============-->