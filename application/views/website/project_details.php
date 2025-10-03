<!--==============================
Breadcrumb
============================== -->
<div class="breadcumb-wrapper" data-bg-src="<?php echo base_url('assets/uploads/projects/' . $project_details->featured_image); ?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="breadcumb-content">
                    <h1 class="breadcumb-title"><?php echo $project_details->title; ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>


<!--==============================
Project Details Area
==============================-->
<section class="space-top space-extra-bottom">
    <div class="container">
        <div class="slider-area property-slider1">
            
            <div class="swiper th-slider mb-4" id="propertySlider" data-slider-options='{"effect":"fade","loop":true,"thumbs":{"swiper":".property-thumb-slider"},"autoplayDisableOnInteraction":"true"}'>

                <div class="swiper-wrapper">

                    <?php
                    $image_names_arr = array_filter(explode(',', $project_details->other_images));
                    foreach ($image_names_arr as $image_name):
                        $image = base_url('assets/uploads/projects/' . rawurlencode(trim($image_name)));
                    ?>

                        <div class="swiper-slide swipper">
                            <div class="property-slider-img">
                                <img src="<?php echo $image; ?>" alt="img" />
                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>

            <div class="swiper th-slider property-thumb-slider" data-slider-options='{"effect":"slide","loop":true,"breakpoints":{"0":{"slidesPerView":2},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"3"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}},"autoplayDisableOnInteraction":"true"}'>
                <div class="swiper-wrapper">

                    <?php
                    $image_names_arr = array_filter(explode(',', $project_details->other_images));
                    foreach ($image_names_arr as $image_name):
                        $image = base_url('assets/uploads/projects/' . rawurlencode(trim($image_name)));
                    ?>

                        <div class="swiper-slide">
                            <div class="property-slider-img">
                                <img src="<?php echo $image; ?>" alt="Image" />
                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>

            <button data-slider-prev="#propertySlider" class="slider-arrow style3 slider-prev">
                <img src="<?php echo base_url(); ?>assets/website/img/icon/arrow-left.svg" alt="icon" />
            </button>
            <button
                data-slider-next="#propertySlider"
                class="slider-arrow style3 slider-next">
                <img src="<?php echo base_url(); ?>assets/website/img/icon/arrow-right.svg" alt="icon" />
            </button>
        </div>

        <div class="row gx-30">
            <div class="col-xxl-12 col-lg-12">
                <div class="property-page-single">
                    <div class="page-content">
                        <h2 class="page-title">About This Project</h2>
                        <p class="mb-30">
                            <?php echo $project_details->description; ?>
                        </p>

                        <ul class="property-grid-list">
                            <li>
                                <div class="property-grid-list-icon">
                                    <img src="<?php echo base_url(); ?>assets/website/img/icon/property-single-icon1-3.svg" alt="img" />
                                </div>
                                <div class="property-grid-list-details">
                                    <h4 class="property-grid-list-title">Living Rooms</h4>
                                    <p class="property-grid-list-text"><?php echo $project_details->livingrooms ?? 'N/A'; ?></p>
                                </div>
                            </li>
                            <li>
                                <div class="property-grid-list-icon">
                                    <img src="<?php echo base_url(); ?>assets/website/img/icon/property-single-icon1-4.svg" alt="img" />
                                </div>
                                <div class="property-grid-list-details">
                                    <h4 class="property-grid-list-title">Bedrooms</h4>
                                    <p class="property-grid-list-text"><?php echo $project_details->bedrooms ?? 'N/A'; ?></p>
                                </div>
                            </li>
                            <li>
                                <div class="property-grid-list-icon">
                                    <img src="<?php echo base_url(); ?>assets/website/img/icon/property-single-icon1-5.svg" alt="img" />
                                </div>
                                <div class="property-grid-list-details">
                                    <h4 class="property-grid-list-title">Bathrooms</h4>
                                    <p class="property-grid-list-text"><?php echo $project_details->bathrooms ?? 'N/A'; ?></p>
                                </div>
                            </li>
                            <li>
                                <div class="property-grid-list-icon">
                                    <img src="<?php echo base_url(); ?>assets/website/img/icon/property-single-icon1-7.svg" alt="img" />
                                </div>
                                <div class="property-grid-list-details">
                                    <h4 class="property-grid-list-title">Sqft</h4>
                                    <p class="property-grid-list-text"><?php echo $project_details->size ?? 'N/A'; ?></p>
                                </div>
                            </li>
                            <li>
                                <div class="property-grid-list-icon">
                                    <img src="<?php echo base_url(); ?>assets/website/img/icon/property-single-icon1-8.svg" alt="img" />
                                </div>
                                <div class="property-grid-list-details">
                                    <h4 class="property-grid-list-title">Parking</h4>
                                    <p class="property-grid-list-text"><?php echo $project_details->parking ?? 'N/A'; ?></p>
                                </div>
                            </li>
                            <li>
                                <div class="property-grid-list-icon">
                                    <img src="<?php echo base_url(); ?>assets/website/img/icon/property-single-icon1-9.svg" alt="img" />
                                </div>
                                <div class="property-grid-list-details">
                                    <h4 class="property-grid-list-title">Elevator</h4>
                                    <p class="property-grid-list-text"><?php echo ($project_details->elevator == 1) ? 'Yes' : 'No'; ?></p>
                                </div>
                            </li>
                            <li>
                                <div class="property-grid-list-icon">
                                    <img src="<?php echo base_url(); ?>assets/website/img/icon/property-single-icon1-10.svg" alt="img" />
                                </div>
                                <div class="property-grid-list-details">
                                    <h4 class="property-grid-list-title">Wifi</h4>
                                    <p class="property-grid-list-text"><?php echo ($project_details->wifi == 1) ? 'Yes' : 'No'; ?></p>
                                </div>
                            </li>
                        </ul>

                        <h3 class="page-title mt-50 mb-25">Features & amenities</h3>
                        <div class="swiper th-slider aminities-slider" id="aminitiesSlider1" data-slider-options='{"paginationType":"progressbar","breakpoints":{"0":{"slidesPerView":1},"375":{"slidesPerView":"2"},"768":{"slidesPerView":"3"},"992":{"slidesPerView":"4"},"1200":{"slidesPerView":"6"}}}'>
                            <div class="swiper-wrapper">

                                <?php
                                // We need the same master list again to look up the details (icon, image, title)
                                $amenities_list = [
                                    "car_parking" => ["title" => "Car Parking", "icon" => "aminities-icon1-1.svg", "img" => "aminities1-1.png"],
                                    "fitness_center" => ["title" => "Fitness Center", "icon" => "aminities-icon1-2.svg", "img" => "aminities1-2.png"],
                                    "rooftop_garden" => ["title" => "Rooftop Garden", "icon" => "aminities-icon1-3.svg", "img" => "aminities1-3.png"],
                                    "indoor_pool" => ["title" => "Indoor Pool", "icon" => "aminities-icon1-4.svg", "img" => "aminities1-4.png"],
                                    "pet_friendly" => ["title" => "Pet Friendly", "icon" => "aminities-icon1-5.svg", "img" => "aminities1-5.png"],
                                    "playground" => ["title" => "Playground", "icon" => "aminities-icon1-6.svg", "img" => "aminities1-6.png"],
                                    "basketball_court" => ["title" => "Basketball Court", "icon" => "aminities-icon1-5.svg", "img" => "aminities1-5.png"],
                                    "barbecue" => ["title" => "Barbecue", "icon" => "aminities-icon1-6.svg", "img" => "aminities1-6.png"],
                                    "recreation" => ["title" => "Recreation", "icon" => "aminities-icon1-1.svg", "img" => "aminities1-1.png"],
                                    "security" => ["title" => "Security", "icon" => "aminities-icon1-2.svg", "img" => "aminities1-2.png"],
                                    "ante_room" => ["title" => "Ante Room", "icon" => "aminities-icon1-4.svg", "img" => "aminities1-4.png"],
                                    "visitors_toilet" => ["title" => "Visitors Toilet", "icon" => "aminities-icon1-6.svg", "img" => "aminities1-6.png"],
                                    "ensuite_bedrooms" => ["title" => "En-suite Bedrooms", "icon" => "aminities-icon1-1.svg", "img" => "aminities1-1.png"],
                                    "masters_bedroom" => ["title" => "Master's Bedroom", "icon" => "aminities-icon1-2.svg", "img" => "aminities1-2.png"],
                                    "family_lounge" => ["title" => "Family Lounge", "icon" => "aminities-icon1-3.svg", "img" => "aminities1-3.png"],
                                    "lounge_balcony" => ["title" => "Lounge Balcony", "icon" => "aminities-icon1-4.svg", "img" => "aminities1-4.png"],
                                ];

                                // Check if there are any saved amenities for this project
                                if (!empty($project_details->amenities)) {
                                    // Explode the comma-separated string of keys into an array
                                    $selected_amenity_keys = explode(',', $project_details->amenities);

                                    // Loop through the array of SAVED amenity keys
                                    foreach ($selected_amenity_keys as $amenity_key) {
                                        // Trim any whitespace from the key
                                        $amenity_key = trim($amenity_key);

                                        // Check if this key exists in our master list to avoid errors
                                        if (isset($amenities_list[$amenity_key])) {
                                            $amenity = $amenities_list[$amenity_key];
                                ?>
                                            <div class="swiper-slide">
                                                <div class="aminities-card" data-mask-src="<?php echo base_url(); ?>assets/website/img/theme-img/aminities-shape1.png">
                                                    <div class="aminities-card-img">
                                                        <img src="<?php echo base_url('assets/website/img/aminities/' . $amenity['img']); ?>" alt="<?php echo htmlspecialchars($amenity['title']); ?>">
                                                    </div>
                                                    <div class="aminities-content">
                                                        <div class="aminities-card-icon">
                                                            <img src="<?php echo base_url('assets/website/img/icon/' . $amenity['icon']); ?>" alt="aminities icon">
                                                        </div>
                                                        <h3 class="box-title"><?php echo htmlspecialchars($amenity['title']); ?></h3>
                                                    </div>
                                                </div>
                                            </div>
                                <?php
                                        }
                                    }
                                }
                                ?>

                            </div>
                            <div class="slider-pagination"></div>
                            <button data-slider-prev="#aminitiesSlider1" class="slider-arrow slider-prev"><img src="<?php echo base_url(); ?>assets/website/img/icon/arrow-left.svg" alt="icon"></button>
                            <button data-slider-next="#aminitiesSlider1" class="slider-arrow slider-next"><img src="<?php echo base_url(); ?>assets/website/img/icon/arrow-right.svg" alt="icon"></button>
                        </div>

                        <h3 class="page-title mt-50 mb-30">Property Video</h3>
                        <div class="video-box2 mb-30">
                            <img src="<?php echo base_url(); ?>assets/website/img/property/property_inner_3.jpg" alt="img" />
                            <a href="<?php echo $project_details->video; ?>" class="play-btn style4 popup-video"><i class="fa-sharp fa-solid fa-play"></i></a>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!--==============================
More Projects Area  
==============================-->
<section class="space bg-theme" id="property-sec">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-xxl-6 col-lg-8">
                <div class="title-area">
                    <h2 class="sec-title text-white">More Projects </h2>
                </div>
            </div>
        </div>
        <div class="slider-area property-slider2 z-index-common">
            <div class="swiper th-slider" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"},"1500":{"slidesPerView":"3"}},"spaceBetween":"24"}'>
                <div class="swiper-wrapper">

                    <?php
                    // Loop through each project in the $projects array
                    foreach ($projects as $y) { ?>

                        <div class="swiper-slide">
                            <div class="property-card4">
                                <div class="property-card-thumb property-cards">
                                    <img src="<?php echo base_url('assets/uploads/projects/' . $y->featured_image); ?>" alt="<?php echo htmlspecialchars($y->title); ?>" />
                                    <a href="<?php echo base_url('project-details/' . $y->slug); ?>" class="th-btn style-white2 th-btn-icon"></a>
                                    <div class="property-card-hover-wrap">
                                        <a href="<?php echo base_url('project-details/' . $y->slug); ?>" class="th-btn style4 th-btn-icon"></a>
                                        <div class="property-card-meta">
                                            <div class="meta-wrap">
                                                <p class="meta-title"><?php echo mb_strimwidth($y->description, 0, 100, '...'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="property-card-details">
                                    <p class="property-card-location"><?php echo htmlspecialchars($y->location); ?>, <?php echo htmlspecialchars($y->state); ?></p>
                                    <h4 class="box-title"><a href="<?php echo base_url('project-details/' . $y->slug); ?>"><?php echo htmlspecialchars($y->title); ?></a></h4>
                                </div>

                            </div>
                        </div>

                    <?php } // End of the foreach loop 
                    ?>

                </div>
            </div>
        </div>
    </div>

</section>