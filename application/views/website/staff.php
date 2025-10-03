<!--==============================
Breadcrumb
============================== -->
<div class="breadcumb-wrapper" data-bg-src="<?php echo base_url(); ?>assets/website/img/bg/breadcumb-bg.jpg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="breadcumb-content">
                    <h1 class="breadcumb-title">Governance</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="space">
    <div class="container z-index-common">
        <div class="row justify-content-lg-between justify-content-center align-items-center">
            <div class="col-xxl-6 col-lg-7">
                <div class="title-area text-lg-start text-center">
                    <h2 class="sec-title">Our Awesome Team</h2>
                    <p class="sec-text">Skilled Professionals Building Value, One Property at a Time</p>
                </div>
            </div>
        </div>
        <div class="row gy-30">
            <?php foreach ($staff as $y) { ?>
                <div class="col-lg-4 col-md-6">
                    <div class="th-team team-card style4">
                        <div class="img-wrap">
                            <div class="team-img">
                                <img src="<?php echo base_url('assets/uploads/staff/' . $y->staff_photo); ?>" alt="12thcity Team">
                            </div>
                            <!-- <div class="th-social-wrap">
                                <div class="th-social">
                                    <?php if (!empty($y->facebook)) { ?>
                                        <a target="_blank" href="<?php echo $y->facebook; ?>"><i class="fab fa-facebook-f"></i></a>
                                    <?php } ?>
                                    <?php if (!empty($y->twitter)) { ?>
                                        <a target="_blank" href="<?php echo $y->twitter; ?>"><i class="fab fa-twitter"></i></a>
                                    <?php } ?>
                                    <?php if (!empty($y->linkedin)) { ?>
                                        <a target="_blank" href="<?php echo $y->linkedin; ?>"><i class="fab fa-linkedin-in"></i></a>
                                    <?php } ?>
                                    <?php if (!empty($y->instagram)) { ?>
                                        <a target="_blank" href="<?php echo $y->instagram; ?>"><i class="fab fa-instagram"></i></a>
                                    <?php } ?>
                                </div>
                            </div> -->
                        </div>
                        <div class="team-card-content">
                            <div class="media-left">
                                <h3 class="box-title">
                                    <a href="#"><?php echo $y->name; ?></a>
                                </h3>
                                <span class="team-desig"><?php echo $y->designation; ?></span>
                            </div>
                            <a class="icon-btn" href="tel:<?php echo $y->phone; ?>">
                                <img src="<?php echo base_url(); ?>assets/website/img/icon/phone.svg" alt="img">
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>