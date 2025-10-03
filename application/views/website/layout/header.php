<!doctype html>
<html class="no-js" lang="zxx" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $title; ?> - <?= sub_tagline; ?> </title>

    <meta name="author" content="12thcity">
    <meta name="description" content="<?php echo business_description; ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo base_url(); ?>">

    <!-- Open Graph Tags -->
    <meta property="og:title" content="<?php echo $title; ?>" />
    <meta property="og:description" content="<?php echo business_description; ?>" />
    <meta property="og:image" content="<?php echo base_url('assets/website/img/home.png'); ?>" />
    <meta property="og:url" content="<?php echo current_url(); ?>" />
    <meta property="og:type" content="website" />

    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="<?php echo $title; ?>" />
    <meta name="twitter:description" content="<?php echo business_description; ?>" />
    <meta name="twitter:image" content="<?php echo base_url('assets/website/img/home.png'); ?>" />
    <meta name="twitter:url" content="<?php echo current_url(); ?>" />

    <meta name="mswebdialog-title" content="<?php echo $title; ?>" />
    <meta name="mswebdialog-logo" content="<?php echo business_logo; ?>" />
    <meta name="mswebdialog-header-color" content="#FFF" />
    <meta name="mswebdialog-newwindowurl" content="*" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets/general/logo/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/general/logo/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/general/logo/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo base_url(); ?>assets/website/img/favicons/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo base_url(); ?>assets/general/logo/favicon/favicon-192x192.png">
    <meta name="theme-color" content="#ffffff">

    <!--==============================
	  Google Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&amp;family=Outfit:wght@100..900&amp;display=swap" rel="stylesheet">

    <!--==============================
	    All CSS File
	============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/website/css/bootstrap.min.css">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/website/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/website/css/magnific-popup.min.css">
    <!-- Swiper Js -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/website/css/swiper-bundle.min.css">
    <!-- datetimepicker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/website/css/jquery.datetimepicker.min.css">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/website/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/website/css/custom.css">

</head>

<body class="">

    <!--[if lte IE 9]>
    	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  	<![endif]-->

    <!--==============================
        Mobile Menu
    ============================== -->
    <div class="th-menu-wrapper onepage-nav">
        <div class="th-menu-area text-center">
            <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
            <div class="mobile-logo">
                <a href="<?php echo base_url(); ?>">
                    <img src="<?php echo business_logo_white; ?>" alt="12thcity">
                </a>
            </div>
            <div class="th-mobile-menu">
                <ul>
                    <li><a href="<?php echo base_url(); ?>about"> About us </a></li>
                    <!-- <li><a href="<?php echo base_url(); ?>projects"> Projects </a></li> -->
                    <li class="menu-item-has-children">
                        <a href="<?php echo base_url(); ?>#"> Projects </a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo base_url(); ?>projects"> Abuja </a></li>
                            <li><a href="<?php echo base_url(); ?>projects-ph"> Portharcourt </a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url(); ?>events"> News & Insights </a></li>
                    <!-- <li><a href="<?php echo base_url(); ?>staff"> Our Staff </a></li> -->
                    <li class="menu-item-has-children">
                        <a href="<?php echo base_url(); ?>#"> Our Staff </a>
                        <ul class="sub-menu">
                            <li><a href="<?php echo base_url(); ?>staff"> Abuja </a></li>
                            <li><a href="<?php echo base_url(); ?>staff-ph"> Portharcourt </a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url(); ?>awards"> Awards & Recognition </a></li>
                    <li><a href="<?php echo base_url(); ?>gallery"> Gallery </a></li>
                    <li><a href="<?php echo base_url(); ?>affiliate"> Join us </a></li>
                    <li><a href="<?php echo base_url(); ?>contact"> Contact Us </a></li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
	Header Area
    ==============================-->
    <header class="th-header header-layout1">
        <div class="sticky-wrapper">
            <!-- Main Menu Area -->
            <div class="menu-area">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="header-logo">
                                <a href="<?php echo base_url(); ?>">
                                    <img src="<?php echo business_logo_white; ?>" alt="12thCity">
                                </a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <nav class="main-menu d-none d-lg-inline-block">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>about"> About us </a></li>
                                    <!-- <li><a href="<?php echo base_url(); ?>projects"> Projects </a></li> -->
                                    <li class="menu-item-has-children">
                                        <a href="<?php echo base_url(); ?>#"> Projects </a>
                                        <ul class="sub-menu">
                                            <li><a href="<?php echo base_url(); ?>projects"> Abuja </a></li>
                                            <li><a href="<?php echo base_url(); ?>projects-ph"> Portharcourt </a></li>
                                        </ul>
                                    </li>
                                    <li><a href="<?php echo base_url(); ?>events"> News & Insights </a></li>
                                    <li><a href="<?php echo base_url(); ?>staff"> Our Staff </a></li>
                                    <li><a href="<?php echo base_url(); ?>awards"> Awards & Recognition </a></li>
                                    <li><a href="<?php echo base_url(); ?>gallery"> Gallery </a></li>
                                    <li><a href="<?php echo base_url(); ?>affiliate"> Join us </a></li>
                                </ul>
                            </nav>
                            <div class="header-button d-flex d-lg-none">
                                <button type="button" class="th-menu-toggle sidebar-btn">
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <span class="line"></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-auto d-none d-xl-block">
                            <div class="header-button">
                                <a href="<?php echo base_url(); ?>contact" class="th-btn btn-mask th-btn-icon">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </header>