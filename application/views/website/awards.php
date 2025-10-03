<!--==============================
Breadcrumb
============================== -->
<div class="breadcumb-wrapper" data-bg-src="<?php echo base_url(); ?>assets/website/img/bg/breadcumb-bg.jpg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="breadcumb-content">
                    <h1 class="breadcumb-title">Awards & Recognition</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<!--==============================
Products Area  
==============================-->
<section class="space" id="property-sec">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-8">
                <div class="title-area">
                    <span class="shadow-title"> Awards</span>
                    <h2 class="sec-title "> Awards & Recognition</h2>
                    <p class="sec-text ">
                        Our commitment to excellence and innovation has earned us industry recognition and accolades. We take pride in being acknowledged for our ethical practices, strong performance, and client-focused approach—achievements that reinforce our credibility and inspire us to set even higher standards in investment management.
                    </p>
                </div>
            </div>
        </div>

        <?php
        foreach ($awards as $y) { ?>

            <div class="property-card-wrap border-top">
                <div class="property-thumb img-shine" data-mask-src="<?php echo base_url(); ?>assets/website/img/shape/property-card1-img-mask.png">
                    <img src="<?php echo base_url('assets/uploads/awards/' . $y->award_photo); ?>" alt="<?php echo htmlspecialchars($y->title); ?>">
                </div>
                <div class="property-card">
                    <div class="property-card-details">
                        <!-- <span class="property-card-subtitle"><?php echo htmlspecialchars(ucfirst($y->type)); ?></span> -->
                        <h4 class="property-card-title text-black">
                            <a href="#"><?php echo htmlspecialchars($y->title); ?></a>
                        </h4>
                        <p class="property-card-text text-black">
                            <?php echo htmlspecialchars($y->description); ?>
                        </p>
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