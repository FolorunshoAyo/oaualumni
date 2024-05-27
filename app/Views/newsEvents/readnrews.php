<div class="page-banner full-row bg-gray py-5">
    <div class="container">
        <div class="row row-cols-md-2 row-cols-1 g-3">
            <div class="col">
                <h3 class="page-name text-secondary m-0"><?php echo $type == "event"? 'Event Details' : 'News Details' ?></h3>
            </div>
            <div class="col">
                <nav class="float-start float-md-end">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo site_url($type == "event"? 'events' : 'news')?>"><?php echo $type == "event"? 'Events' : 'News' ?></a></li>
                        <li class="breadcrumb-item active">
                            <?php
                                if (count($checkNewEnt) == 1):
                            ?>
                                <?php echo $checkNewEnt[0]['ne_title'];?>
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
        <div class="row">
            <div class="col-lg-4 order-lg-2">
                <div class="blog-sidebar mt-md-50 mb-4">
                    <div class="search_widget">
                        <?php echo form_open('',['method'=>'get'])?>
                        <div class="form-group">
                            <?php echo form_input('sn',$filtrs['sn'],['class'=>'form-control','placeholder'=>'Search News'])?>
                        </div>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 order-lg-1">
                <div class="blog-details bg-white text-ordinary mb-30">
                    <div class="thumb-two overlay-black overflow-hidden position-relative">
                        <img src="<?php echo base_url('public/assets/images/newsEvents/'.$checkNewEnt[0]['ne_dp']);?>" alt="image">
                        <div class="date text-white position-absolute z-index-9">
                            <?php echo $checkNewEnt[0]['start_date'] === null? date('d F, Y', strtotime($checkNewEnt[0]['ne_date'])) : "Event Date: " . date('d F, Y', strtotime($checkNewEnt[0]['start_date'])) . " - " . date('d F, Y', strtotime($checkNewEnt[0]['end_date'])) ?>
                        </div>
                    </div>
                    <div class="blog-content mt-5">
                        <div class="blog-info">
                            <h4 class="mb-4 text-secondary">
                                <?php echo $checkNewEnt[0]['ne_title'];?>
                            </h4>
                            <?php
                                   echo  base64_decode($checkNewEnt[0]['ne_description']);
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>