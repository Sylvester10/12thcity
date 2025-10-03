<!--==============================
	Footer Area
==============================-->
<footer class="footer-wrapper footer-layout4 footer-default bg-theme background-image" style="background-image: url('<?php echo base_url('assets/website/img/bg/award-bg-1-1.png'); ?>');">
    <div class="container">
        <div class="footer-wrap">
            <div class="newsletter-wrap style4">
                <h5 class="newsletter-title">Get Our Latest Newsletter Updates</h5>

                <?php
                $form_attributes = array("id" => "newsletter_form", "class" => "newsletter-form");
                echo form_open_multipart('home/newsletter_ajax', $form_attributes); ?>

                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Enter Email">
                </div>

                <button class="th-btn" type="submit" id="submit_newsletter">
                    <span class="btn-text">
                        Subscribe
                        <span class="btn-icon" id="paper-plane">
                            <img src="<?php echo base_url(); ?>assets/website/img/icon/paper-plane.svg" alt="img" />
                        </span>
                    </span>

                    <span class="spinner-border spinner-border-sm me-2 d-none" style="color: #f8f9fa;" id="search-spinner" role="status" aria-hidden="true"></span>

                    <span class="btn-message"></span>
                </button>

                <?php echo form_close(); ?>

            </div>
            <p class="form-messages mb-0 mt-3" id="status_msg"></p>


            <div class="widget-area">
                <div class="row justify-content-between">
                    <div class="col-md-6 col-xl-4">
                        <div class="widget footer-widget">
                            <div class="th-widget-about">
                                <div class="about-logo">
                                    <a href="<?php echo base_url(); ?>"><img src="<?php echo business_logo_white; ?> " alt="12thcity" /></a>
                                </div>
                                <p class="about-text">
                                    <?php echo sub_tagline; ?>
                                </p>
                                <div class="th-social style5">
                                    <a href="<?= business_facebook ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    <a href="<?= business_instagram ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                                    <a href="<?= business_threads ?>" target="_blank"><i class="fab fa-threads"></i></a>
                                    <a href="<?= business_linkedin ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="<?= business_youtube ?>" target="_blank"><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="widget footer-widget">
                            <h3 class="widget_title">Get In Touch</h3>
                            <div class="th-widget-contact">
                                <div class="info-box_text">
                                    <div class="icon">
                                        <i class="fas fa-location-dot"></i>
                                    </div>
                                    <div class="details">
                                        <p><?php echo business_street; ?> </p>
                                        <p><?php echo business_state; ?> </p>
                                    </div>
                                </div>
                                <div class="info-box_text">
                                    <div class="icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="details">
                                        <p><a href="tel:<?php echo business_phone_number; ?>" class="info-box_link"><?php echo business_phone_number; ?></a></p>
                                        <p><a href="tel:<?php echo business_phone_number2; ?>" class="info-box_link"><?php echo business_phone_number2; ?></a></p>
                                    </div>
                                </div>
                                <div class="info-box_text">
                                    <div class="icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="details">
                                        <p><a href="mailto:<?php echo business_contact_email; ?>" class="info-box_link"><?php echo business_contact_email; ?></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="widget widget_nav_menu footer-widget">
                            <h3 class="widget_title">Quick Links</h3>
                            <div class="menu-all-pages-container">
                                <ul class="menu">
                                    <li><a href="<?php echo base_url(); ?>about"> About Us </a></li>
                                    <li><a href="<?php echo base_url(); ?>products"> Products </a></li>
                                    <li><a href="<?php echo base_url(); ?>events"> News & Insights </a></li>
                                    <li><a href="<?php echo base_url(); ?>affiliate"> Join us </a></li>
                                    <li><a href="<?php echo base_url(); ?>staff"> Our Staff </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-6 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">Explore</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                <li><a href="property">All Properties</a></li>
                                <li><a href="team">Our Agents</a></li>
                                <li><a href="property">All Projects</a></li>
                                <li><a href="about">Our Process</a></li>
                                <li><a href="contact">Neighborhood</a></li>
                            </ul>
                        </div>
                    </div>
                </div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-wrap bg-light">
        <div class="container">
            <div class="row gy-3 align-items-center">
                <div class="col-lg-6">
                    <p class="copyright-text">
                        Copyright <i class="fal fa-copyright"></i> <?php echo date('Y'); ?>.
                        <a href="<?php echo base_url(); ?>"><?php echo business_name; ?></a>, All rights reserved.
                    </p>
                </div>
                <div class="col-lg-6 text-center text-lg-end">
                    <div class="footer-links">
                        <ul>
                            <li><a href="<?php echo base_url(); ?>contact">Terms of service</a></li>
                            <li><a href="<?php echo base_url(); ?>contact">Privacy policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!--==============================
    All Js File
============================== -->
<!-- Jquery -->
<script src="<?php echo base_url(); ?>assets/website/js/vendor/jquery-3.7.1.min.js"></script>

<!-- Swiper Js -->
<script src="<?php echo base_url(); ?>assets/website/js/swiper-bundle.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>assets/website/js/bootstrap.min.js"></script>
<!-- Magnific Popup -->
<script src="<?php echo base_url(); ?>assets/website/js/jquery.magnific-popup.min.js"></script>
<!-- Counter Up -->
<script src="<?php echo base_url(); ?>assets/website/js/jquery.counterup.min.js"></script>
<!-- Range Slider -->
<script src="<?php echo base_url(); ?>assets/website/js/jquery-ui.min.js"></script>
<!-- Isotope Filter -->
<script src="<?php echo base_url(); ?>assets/website/js/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo base_url(); ?>assets/website/js/isotope.pkgd.min.js"></script>
<!-- Gsap -->
<script src="<?php echo base_url(); ?>assets/website/js/gsap.min.js"></script>
<!-- DateTime JS -->
<script src="<?php echo base_url(); ?>assets/website/js/jquery.datetimepicker.min.js"></script>

<!-- 360 degree Js -->
<script src="<?php echo base_url(); ?>assets/website/js/threesixty.min.js"></script>
<script src="<?php echo base_url(); ?>assets/website/js/panolens.min.js"></script>

<!-- Main Js File -->
<script src="<?php echo base_url(); ?>assets/website/js/main.js"></script>

<!-- general scripts -->
<script src="<?php echo base_url(); ?>assets/general/js/my_functions.js"></script>
<script src="<?php echo base_url(); ?>assets/website/js/custom.js"></script>


<!-- display image on click for gallery page -->
<script>
    $(document).ready(function() {
        // This listens for the moment the #imageModal starts to close
        $("#imageModal").on("hide.bs.modal", function() {
            // Find whichever element has focus and "blur" it (remove focus)
            if (document.activeElement) {
                document.activeElement.blur();
            }
        });

        // Your existing click handler for setting the image can stay here
        $(document).on("click", '[data-bs-target="#imageModal"]', function() {
            var imageUrl = $(this).data("image");
            console.log("Image URL:", imageUrl); // Add this
            $("#modalImage").attr("src", imageUrl);
        });
    });
</script>

<!-- schema -->
<script>
    fetch("<?= base_url('seo/schema') ?>")
        .then(response => response.text())
        .then(json => {
            const script = document.createElement("script");
            script.type = "application/ld+json";
            script.text = json;
            document.head.appendChild(script); // or document.body if you prefer
        });
</script>

<!-- pass base_url to js -->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
</body>

</html>