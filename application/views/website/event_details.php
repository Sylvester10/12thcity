<!--==============================
Breadcrumb
============================== -->
<div class="breadcumb-wrapper" data-bg-src="<?php echo base_url('assets/uploads/events/' . $event_details->event_image); ?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="breadcumb-content">
                    <h1 class="breadcumb-title"><?php echo ucwords($event_details->caption); ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>

<!--==============================
Event Details area
==============================-->
<section class="space-top space-extra-bottom">
    <div class="container">
        <div class="row gx-30">
            <div class="col-xxl-8 col-lg-7">
                <div class="agency-page-single">
                    <div class="page-content">
                        <div class="agency-page-img">
                            <div class="thumb">
                                <img src="<?php echo base_url('assets/uploads/events/' . $event_details->event_image); ?>" alt="Blog Image" />
                            </div>
                        </div>
                        <div class="row justify-content-between align-items-center">
                            <?php if ($event_details->type == 'event') { ?>

                                <div class="col-lg-6">
                                    <h2 class="page-title h4 text-theme mb-0 mt-15">
                                        <?php echo $event_details->venue; ?>
                                    </h2>
                                    <h5 class="text-theme h6 mb-2">
                                        <?php echo x_date_full($event_details->date); ?>
                                    </h5>
                                </div>

                            <?php } ?>
                        </div>

                        <p class="mb-30 text-theme mt-40">
                            <?php echo $event_details->description; ?>
                        </p>

                        <?php if ($event_details->type == 'event') { ?>

                            <div class="row align-items-center justify-content-between">
                                <div class="col-lg-auto">
                                    <div class="icon-box mb-40">
                                        <button data-slider-prev=".property-single-slider" class="slider-arrow style5 default slider-prev">
                                            <img src="<?php echo base_url(); ?>assets/website/img/icon/arrow-left.svg" alt="" />
                                        </button>
                                        <button data-slider-next=".property-single-slider" class="slider-arrow style5 default slider-next">
                                            <img src="<?php echo base_url(); ?>assets/website/img/icon/arrow-right.svg" alt="" />
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content property-tab-content mb-60">


                                <div class="tab-pane fade show active" role="tabpanel" tabindex="0">
                                    <div class="slider-area property-slider2">
                                        <div class="swiper th-slider property-single-slider" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"1"},"1200":{"slidesPerView":"2"},"1500":{"slidesPerView":"2"}}}'>
                                            <div class="swiper-wrapper">

                                                <?php
                                                $image_names_arr = explode(',', $event_details->other_images);

                                                foreach ($image_names_arr as $image_name) { ?>

                                                    <div class="swiper-slide">
                                                        <div class="property-card2">
                                                            <div class="property-card-thumb img-shine">
                                                                <?php
                                                                // Trim whitespace from the filename just in case
                                                                $image_name = trim($image_name);
                                                                ?>
                                                                <img src="<?php echo base_url('assets/uploads/events/' . $image_name); ?>" alt="Event Image" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        <?php } ?>
                        
                    </div>
                </div>
            </div>


            <div class="col-xxl-4 col-lg-5">
                <aside class="sidebar-area">
                    <div class="widget">
                        <h3 class="widget_title">More Events</h3>
                        <div class="recent-post-wrap">
                            <?php
                            foreach ($recent_events as $y) { ?>

                                <div class="recent-post">
                                    <div class="media-img">
                                        <a href="<?php echo base_url('event-details/' . $y->slug); ?>">
                                            <img src="<?php echo base_url('assets/uploads/events/' . $y->event_image); ?>" alt="Event Image" /></a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="post-title">
                                            <a class="text-inherit" href="<?php echo base_url('event-details/' . $y->slug); ?>"><?php echo ucwords($y->caption); ?></a>
                                        </h4>
                                        <div class="recent-post-meta">
                                            <a href="#"><i class="far fa-calendar"></i><?php echo x_date_full($y->date); ?></a>
                                        </div>
                                    </div>
                                </div>

                            <?php } //endforeach } 
                            ?>

                        </div>
                    </div>
                    <div  class="widget widget_banner" data-bg-src="<?php echo base_url(); ?>assets/website/img/widget/widget-banner.png">
                        <div class="widget-banner text-center">
                            <h3 class="title">Need Help? We Are Here To Help You</h3>
                            <div class="logo">
                                <img src="<?= business_logo ?>" alt="12thcity" />
                            </div>
                            <h4 class="subtitle">You Get Online support</h4>
                            <h5 class="link">
                                <a href="tel:256214203215"><?= business_phone_number ?></a>
                            </h5>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>