<!--============== Slider HTML markup Section Start ==============-->
<?php if (isset($sliders) && count($sliders) > 0 ): ?>
    <div class="full-row overflow-hidden p-0">
        <div id="image-slider-2" style="width:1200px; height:800px;">
            <?php foreach($sliders as $mySlider): ?>
            <!-- Slide 1-->
            <div class="ls-slide" data-ls="bgposition:50% 50%; duration:9000; transition2d:4; kenburnsscale:1.2;">
                <img width="1920" height="1080" src="<?php echo base_url('public/assets/images/sliders/'.$mySlider['sl_dp'])?>" class="ls-bg" alt="" />
                <div style="top:50%; left:50%; text-align:initial; font-weight:400; font-style:normal; text-decoration:none; width:100%; height:100%;" class="ls-l slider-layer-1" data-ls="showinfo:1; position:fixed; durationout:400;"></div>
                <p style="font-weight:600; font-family:'Comfortaa', cursive; font-size:2.5rem; line-height:76px; color:#ffffff; top:320px; left:50px; white-space:nowrap;" class="ls-l" data-ls="offsetyin:30; durationin:1000; delayin:300; offsetyout:-30; durationout:400; parallaxlevel:0;">
                    <?php echo $mySlider['sl_title']; ?>
                </p>
                <p style="font-weight:400; font-size:15px; line-height:76px; color:#ffffff; top:370px; left:53px; white-space:nowrap;" class="ls-l" data-ls="offsetyin:30; durationin:1000; delayin:600; offsetyout:-30; durationout:400; parallaxlevel:0;">
                    <?php echo word_limiter(base64_decode($mySlider['sl_description']), 30);?>
                </p>
                <div style="top:440px; left:53px; text-align:initial; font-weight:400; font-style:normal; text-decoration:none; height:2px; width:350px; background:#adadad;" class="ls-l" data-ls="showinfo:1; durationin:1000; delayin:1200; offsetyout:-30; durationout:400; scalexin:0;"></div>
                <a class="ls-l" href="<?php echo $mySlider['sl_button_url']; ?>" target="-self" data-ls="offsetyin:30; durationin:1000; delayin:2800; offsetyout:-30; durationout:400; hover:true; hoverdurationin:300; hoveropacity:1; hoverbgcolor:#ffffff; hovercolor:#444444; parallaxlevel:0;">
                    <p style="font-weight:500; text-align:center;cursor:pointer; padding-top:8px; padding-bottom:7px; font-family:'Varela Round', sans-serif; font-size:15px; top:460px; left:53px; border-top:2px solid #fff; border-right:2px solid #fff; padding-right:25px; border-bottom:2px solid #fff; border-left:2px solid #fff; padding-left:25px; line-height:30px; text-align:initial; font-weight:400; font-style:normal; text-decoration:none; color:#ffffff; background:rgba(0, 0, 0, 0.1); border-radius:2px; font-weight:500; text-align:center; cursor:pointer;"
                       class="ls-button">
                        <?php echo $mySlider['sl_button_text']; ?>
                    </p>
                </a>
            </div>
            <?php endforeach;?>
        </div>
    </div>
<?php endif; ?>

<!--============== Slider HTML markup Section End ==============-->