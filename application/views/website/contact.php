<!--==============================
Breadcrumb
============================== -->
<div class="breadcumb-wrapper" data-bg-src="<?php echo base_url(); ?>assets/website/img/bg/breadcumb-bg.jpg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="breadcumb-content">
                    <h1 class="breadcumb-title">Contact</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<!--==============================
Contact Area   
==============================-->
<div class="space">
    <div class="container">
        <div class="row gy-4 justify-content-center">
            <div class="col-xl-4 col-lg-6">
                <div class="about-contact-grid style2">
                    <div class="about-contact-icon">
                        <i class="fal fa-location-dot"></i>
                    </div>
                    <div class="about-contact-details">
                        <h6 class="about-contact-details-title">Our Address</h6>
                        <p class="about-contact-details-text">
                            <?= business_address ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="about-contact-grid style2">
                    <div class="about-contact-icon">
                        <i class="fal fa-phone"></i>
                    </div>
                    <div class="about-contact-details">
                        <h6 class="about-contact-details-title">Phone Number</h6>
                        <p class="about-contact-details-text">
                            <a href="tel:01234567890"><?= business_phone_number ?></a>
                        </p>
                        <p class="about-contact-details-text">
                            <a href="tel:01234567890"><?= business_phone_number2 ?></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="about-contact-grid style2">
                    <div class="about-contact-icon">
                        <i class="fal fa-envelope"></i>
                    </div>
                    <div class="about-contact-details">
                        <h6 class="about-contact-details-title">Email Address</h6>
                        <p class="about-contact-details-text">
                            <a href="mailto:<?= business_contact_email ?>"><?= business_contact_email ?></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="space contact-area-3 z-index-common" data-bg-src="<?php echo base_url(); ?>assets/website/img/bg/contact-bg-1-1.png" data-overlay="title" data-opacity="3" id="contact-sec">
    <div class="contact-bg-shape3-1 spin shape-mockup" data-bottom="5%" data-left="12%">
        <img src="<?php echo base_url(); ?>assets/website/img/shape/section_shape_2_1.jpg" alt="img" />
    </div>
    <div class="container">
        <div class="row gx-35">
            <div class="col-lg-6">
                <div class="appointment-wrap2 bg-white me-xxl-5">
                    <h2 class="form-title text-theme">Get In Touch</h2>

                    <?php
                    // Add class="ajax-form" and data-* attributes
                    $form_attributes = [
                        "id" => "contact_us_form",
                        "class" => "ajax-form",
                        "data-notification-style" => "div", // 'div' or 'toastr'
                        "data-message-container" => "#status_msg" // Selector for the message div
                    ];
                    echo form_open_multipart('home/contact_ajax', $form_attributes); ?>

                    <div class="row">
                        <div class="form-group style-border style-radius col-12">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name*" />
                            <i class="fal fa-user"></i>
                        </div>
                        <div class="form-group style-border style-radius col-12">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email*" />
                            <i class="fal fa-envelope"></i>
                        </div>
                        <div class="form-group style-border style-radius col-12">
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone*" />
                            <i class="fal fa-phone"></i>
                        </div>
                        <div class="col-12 form-group style-border style-radius">
                            <i class="far fa-comments"></i>
                            <textarea name="message" placeholder="Type Your Message" class="form-control"></textarea>
                        </div>

                        <div class="col-12 form-btn mt-4">
                            <button class="th-btn" type="submit" id="submit">
                                Submit
                                <span class="btn-icon" id="paper-plane"><img src="<?php echo base_url(); ?>assets/website/img/icon/paper-plane.svg" alt="img" /></span>
                                <span class="spinner-border spinner-border-sm text-light me-2 d-none" style="color: #f8f9fa" id="search-spinner" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>

                    <p class="form-messages mb-0 mt-3" id="status_msg"></p>

                    <?php echo form_close(); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="location-map contact-sec-map z-index-common">
        <div class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8068645.343970305!2d-1.498118149999968!3d9.084866100000022!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104e0b1ae0d579f5%3A0xdea45935c75d8343!2s12th%20CITY%20REAL%20ESTATE%20DEVELOPERS!5e0!3m2!1sen!2sng!4v1674913902813!5m2!1sen!2sng" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="location-map-address bg-theme">
            <div class="media-body">
                <h4 class="title">Address:</h4>
                <p class="text"><?= business_address ?></p>
            </div>
        </div>
    </div>
</div>

<!--==============================
    Popup Modal v1
============================== -->
<div class="th-modal modal fade" id="whatsappModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="container">
                <button type="button" class="icon-btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-regular fa-xmark"></i></button>
                <div class="page-single bg-theme">

                    <div class="page-content text-center">
                        <h2 class="h3 page-title text-white fw-medium">Thank you for contacting us.</h2>
                        <div class="row gy-30">
                            <div class="col-xl-12">
                                <p class="mb-20 text-light">Please click the button to join our whatsapp group</p>

                                <div class="mb-xl-12 mb-0">
                                    <div class="btn-wrap">
                                        <a href="https://wa.link/2347069785153" target="_blank" class="th-btn btn-mask th-btn-icon">
                                            Join
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>