<!--==============================
Breadcrumb
============================== -->
<div class="breadcumb-wrapper" data-bg-src="<?php echo base_url(); ?>assets/website/img/bg/breadcumb-bg.jpg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="breadcumb-content">
                    <h1 class="breadcumb-title">Join us</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="space bg-theme" id="property-sec">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-8">
                <div class="title-area">
                    <span class="shadow-title"> Affiliate</span>
                    <h2 class="sec-title text-white"> Become an Affiliate </h2>
                    <p class="sec-text text-white">
                        Join our Affiliate Program today and earn rewarding commissions by referring clients to our genuine, affordable, and fast-growing properties. It’s simple, refer, and get paid while helping others secure their future. Be part of the hallmark of investment opportunities with 12th City.
                    </p>
                </div>
            </div>
        </div>
        <div class="contact-bg-shape3-1 spin shape-mockup" data-bottom="5%" data-left="12%">
            <img src="<?php echo base_url(); ?>assets/website/img/shape/section_shape_2_1.jpg" alt="img" />
        </div>
        <div class="container">
            <div class="row gx-35">
                <div class="col-lg-12">
                    <div class="appointment-wrap2 bg-white me-xxl-5">

                        <?php
                        // Add class="ajax-form" and data-* attributes
                        $form_attributes = [
                            "id" => "affiliate_form",
                            "class" => "ajax-form",
                            "data-notification-style" => "div", // 'div' or 'toastr'
                            "data-message-container" => "#status_msg" // Selector for the message div
                        ];
                        echo form_open_multipart('home/affiliate_ajax', $form_attributes); ?>

                        <div class="row">

                            <h4 class="form-title text-theme">Personal Information*</h4>

                            <div class="form-group style-border style-radius col-md-6 col-sm-12">
                                <input type="email" class="form-control" name="email" placeholder="Email*" required />
                                <i class="fal fa-envelope"></i>
                            </div>

                            <div class="form-group style-border style-radius col-md-6 col-sm-12">
                                <input type="text" class="form-control" name="name" placeholder="Full Name (Company Name if Applicable)*" required />
                                <i class="fal fa-circle-user"></i>
                            </div>

                            <div class="form-group style-border style-radius col-md-6 col-sm-12">
                                <select class="form-select" name="gender" required>
                                    <option value="" disabled selected hidden>Gender*</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <i class="fal fa-angle-down"></i>
                            </div>

                            <div class="form-group style-border style-radius col-md-6 col-sm-12">
                                <input type="text" class="form-control" name="state" placeholder="State of Origin*" required />
                                <i class="fal fa-flag"></i>
                            </div>

                            <div class="form-group style-border style-radius col-md-6 col-sm-12">
                                <select class="form-select" name="nationality" required>
                                    <option value="" disabled selected hidden>Nationality*</option>
                                    <?php
                                    $countries = countries();
                                    foreach ($countries as $nationality) { ?>
                                        <option value="<?php echo $nationality; ?>" <?php echo set_select('nationality', $nationality); ?>>
                                            <?php echo $nationality; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <i class="fal fa-angle-down"></i>
                            </div>

                            <div class="form-group style-border style-radius col-md-6 col-sm-12">
                                <input type="text" class="form-control" name="phone" placeholder="Whatsapp*" required />
                                <i class="fa-brands fa-whatsapp"></i>
                            </div>

                            <div class="form-group style-border style-radius col-md-6 col-sm-12">
                                <input type="text" class="form-control" name="other_phone" placeholder="Other Phone" />
                                <i class="fal fa-phone"></i>
                            </div>

                            <div class="form-group style-border style-radius col-md-6 col-sm-12">
                                <input type="text" class="form-control" name="address" placeholder="Address*" required />
                                <i class="fal fa-location"></i>
                            </div>

                            <div class="form-group style-border style-radius col-md-6 col-sm-12">
                                <select class="form-select" name="applicant_type" required>
                                    <option value="" disabled selected hidden>Type of Applicant*</option>
                                    <option value="Individual Realtor">Individual Realtor</option>
                                    <option value="Freelancer">Freelancer</option>
                                    <option value="Real Estate Marketing Company">Real Estate Marketing Company</option>
                                </select>
                                <i class="fal fa-angle-down"></i>
                            </div>

                            <h5 class="form-title text-theme mt-4">Identification and Documentation*</h5>

                            <div class="form-group style-border style-radius col-md-6 col-sm-12">
                                <input type="file" class="form-control" name="passport" accept=".jpeg,.jpg,.png" required />
                                <i class="fal fa-camera-rotate"></i>
                            </div>

                            <div class="form-group style-border style-radius col-md-6 col-sm-12">
                                <select class="form-select" name="id_card" required>
                                    <option value="" disabled selected hidden>Means of Identification*</option>
                                    <option value="National ID">National ID</option>
                                    <option value="NIN">NIN</option>
                                    <option value="Driver's License">Driver's License</option>
                                    <option value="International Passport">International Passport</option>
                                </select>
                                <i class="fal fa-angle-down"></i>
                            </div>

                            <div class="form-group style-border style-radius col-md-6 col-sm-12">
                                <input type="text" class="form-control" name="id_number" placeholder="ID Number*" required />
                                <i class="fal fa-hashtag"></i>
                            </div>

                            <div class="form-group style-border style-radius col-md-6 col-sm-12">
                                <input type="text" class="form-control" name="cac" placeholder="CAC Registration Number (For Companies)" />
                                <i class="fal fa-file"></i>
                            </div>

                            <h5 class="form-title text-theme mt-4">Bank Account Details*</h5>

                            <div class="form-group style-border style-radius col-md-6 col-sm-12">
                                <input type="text" class="form-control" name="bank_name" placeholder="Bank Name*" required />
                                <i class="fal fa-building"></i>
                            </div>

                            <div class="form-group style-border style-radius col-md-6 col-sm-12">
                                <input type="text" class="form-control" name="account_number" placeholder="Account Number*" required />
                                <i class="fal fa-hashtag"></i>
                            </div>

                            <div class="form-group style-border style-radius col-md-6 col-sm-12">
                                <input type="text" class="form-control" name="account_name" placeholder="Account Name*" required />
                                <i class="fal fa-person"></i>
                            </div>

                            <h5 class="form-title text-theme mt-4">References*</h5>

                            <div class="form-group style-border style-radius col-md-6 col-sm-12">
                                <input type="text" class="form-control" name="referrer_name" placeholder="Referrer Name*" required />
                                <i class="fal fa-person"></i>
                            </div>

                            <div class="form-group style-border style-radius col-md-6 col-sm-12">
                                <input type="text" class="form-control" name="referrer_relationship" placeholder="Relationship*" required />
                                <i class="fal fa-people-arrows"></i>
                            </div>

                            <div class="form-group style-border style-radius col-md-6 col-sm-12">
                                <input type="tel" class="form-control" name="referrer_phone" placeholder="Phone Number*" required />
                                <i class="fal fa-phone"></i>
                            </div>

                            <h5 class="form-title text-theme mt-4">Legal and Compliance*</h5>

                            <div class="form-group style-border style-radius col-12">
                                <div class="d-flex align-items-center mt-2">
                                    <input type="checkbox" id="consentCheckbox" name="consent" class="form-check-input me-2" required>
                                    <label for="consentCheckbox" class="form-check-label">
                                        I consent to 12th City Real Estate Developers Limited conducting necessary background checks *
                                    </label>
                                </div>
                            </div>

                            <div class="form-group style-border style-radius col-md-6 col-sm-12">
                                <input type="text" class="form-control" name="signature" placeholder="Signature (Enter Name and Date)*" required />
                                <i class="fal fa-signature"></i>
                            </div>

                            <div class="col-12 form-btn mt-4">
                                <button class="th-btn" type="submit" id="submit">
                                    Submit
                                    <span class="btn-icon" id="paper-plane"><img src="<?php echo base_url(); ?>assets/website/img/icon/paper-plane.svg" alt="img" /></span>
                                    <span class="spinner-border spinner-border-sm text-light me-2 d-none" id="search-spinner" role="status" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>

                        <p class="form-messages mb-0 mt-3" id="status_msg"></p>

                        <?php echo form_close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>