<!--==============================
Breadcrumb
============================== -->
<div class="breadcumb-wrapper" data-bg-src="<?php echo base_url(); ?>assets/website/img/bg/breadcumb-bg.jpg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="breadcumb-content">
                    <h1 class="breadcumb-title">News & Insights</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<!--==============================
Events Area
==============================-->

<section class="space bg-theme" id="property-sec">
    <div class="container">

        <?php
        foreach ($events as $y) { ?>

            <div class="property-card-wrap">
                <div class="property-thumb img-shine" data-mask-src="<?php echo base_url(); ?>assets/website/img/shape/property-card1-img-mask.png">
                    <img src="<?php echo base_url('assets/uploads/events/' . $y->event_image); ?>" alt="<?php echo htmlspecialchars($y->caption); ?>">
                </div>
                <div class="property-card">
                    <div class="property-card-details">
                        <span class="property-card-subtitle"><?php echo htmlspecialchars(ucfirst($y->type)); ?></span>
                        <h4 class="property-card-title">
                            <a href="<?php echo base_url('event-details/' . $y->slug); ?>"><?php echo htmlspecialchars($y->caption); ?></a>
                        </h4>
                        <p class="property-card-text">
                            <?php echo htmlspecialchars($y->snippet); ?>
                        </p>
                        <a href="<?php echo base_url('event-details/' . $y->slug); ?>" class="th-btn btn-mask th-btn-icon">Details</a>
                    </div>
                </div>
            </div>

        <?php } ?>

        <div class="mt-60">
            <div class="th-pagination">
                <?php echo $links; ?>
            </div>
        </div>

    </div>
</section>