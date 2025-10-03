<?php
defined('BASEPATH') or exit('No direct script access allowed');

/* ===== Documentation ===== 
Name: Constants::General
Role: Include
Description: Holds all the constants used by the app. Required in the construct of the core controller, MY_Controller, which makes it global to the entire application.
Date Created: 4th May, 2023
*/


$business_name = '12thCity Real Estate Developers';
$business = 'Real Estate Developers';
$business_initials = '12thCity';
$business_phone_number = '+234 803-474-2430';
$business_phone_number2 = '+234 916-476-8748';
$business_facebook = 'https://www.facebook.com/people/12th-City-Real-Estate/100088929480811/?mibextid=LQQJ4d';
$business_instagram = 'https://www.instagram.com/12th_city_real_estate';
$business_youtube = 'https://www.youtube.com/@12thCity';
$business_threads = 'https://www.threads.com/@12thcityrealestateng?igshid=NTc4MTIwNjQ2YQ==';
$business_linkedin = 'https://l.instagram.com/?u=https%3A%2F%2Fwww.linkedin.com%2Fcompany%2F12th-city-real-estate-development-ltd%2F&e=AT2OJoCt5I7tV6gal3xLtX2_U2VXCU6_odQuQcpmoxbvSGCTRFnVeghJpcl3hJVVUltqIGbx3ezTghTquT2NjwAsdGSZ92dZN2Vgt6Z3UMZ_1HFR2VxpMW3teM7qSko30SJnWnPCSnIl';
$business_address = 'Unit III, Plot 204 Anyim Pius Anyim Street, Wuye district, Abuja FCT';
$business_street = 'Unit III, Plot 204 Anyim Pius Anyim Street';
$business_state = 'Wuye district, Abuja FCT';
$business_country = 'Nigeria';
$business_contact_email = 'info@12thcityrealestate.ng';
$sub_tagline = 'Global partner of choice. The hallmark of your home story';
$business_keywords = '12thCity Real Estate, 12th City, 12thCity, 12th, 12th City Real Estate, 12th City Real Estate Developers, Real Estate, Estate, Housing, Land, Property, Real Estate in Africa, Real Estate in Nigeria, Real Estate in Abuja, Real Estate in Lagos, Real Estate in Portharcourt, Real Estate in Calabar, Real Estate in Enugu, Top 10 Real Estate, Top Real Estate, Housing Estate, Housing in Africa, Housing in Nigeria, Housing in Abuja, Housing in Lagos, Housing in Portharcourt, Housing in Calabar, Housing in Enugu, Legit investment, best real estate websites';
$business_description = "12th City Real Estate Developers is a real estate agency in Nigeria that specializes in residential and commercial properties. The company was founded in 2015 by two experienced real estate professionals, and it has since grown to become one of the leading real estae agencies in Nigeria.";
$info_mail = "Info_2212!";
$admin_mail = "Admin_2212!";


//Software Info
define('business_name', $business_name);
define('business', $business);
define('business_initials', $business_initials);
define('business_phone_number', $business_phone_number);
define('business_phone_number2', $business_phone_number2);
define('business_facebook', $business_facebook);
define('business_instagram', $business_instagram);
define('business_linkedin', $business_linkedin);
define('business_youtube', $business_youtube);
define('business_threads', $business_threads);
define('business_address', $business_address);
define('business_street', $business_street);
define('business_state', $business_state);
define('business_country', $business_country);
define('business_contact_email', $business_contact_email);
define('sub_tagline', $sub_tagline);
define('business_keywords', $business_keywords);
define('business_description', $business_description);
define('business_website', base_url());
define('business_logo', base_url('assets/general/logo/12th_city_logo.png'));
define('business_logo_white', base_url('assets/general/logo/12th_city_logo_white.png'));
define('business_favicon', base_url('assets/general/logo/favicon/favicon.ico'));


//Developer Info
define('software_vendor', 'DevSylvester');
define('software_vendor_site', 'https://devsylvester.com/');



//MySQL-PHP server time difference. Change to zero if both are on same server
define('mysql_time_difference', 0); //if negative, write as -x, else, x


//login refresh time
define('login_refresh_time', 120); //refresh last login every 120 secs (2 mins) if the use is active


//Email config
define('business_web_mail', business_contact_email);


//defaults
define('default_admin_password', '12thCity2212');


//Others
define('pdf_icon', base_url('assets/general/pdf.png'));
define('id_card', base_url('assets/general/id-card.png'));
define('stripe', base_url('assets/general/stripe.svg'));
define('paystack', base_url('assets/general/paystack.svg'));
define('user_avatar', base_url('assets/general/user.png'));
