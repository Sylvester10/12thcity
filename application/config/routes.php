<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = 'errors/error404';
$route['error404'] = 'errors/error404';
$route['translate_uri_dashes'] = FALSE;

// Website routes
$route['about'] = 'home/about';
$route['awards'] = 'home/awards';
$route['awards/(:num)'] = 'home/awards/$1'; // Route for page numbers (e.g., /awards/2)
$route['projects'] = 'home/projects';
$route['projects-ph'] = 'home/projects_ph';
$route['project-details/(:any)'] = 'home/project_details/$1'; // Route for a single project post
$route['events'] = 'home/events'; // Route for the first page
$route['events/(:num)'] = 'home/events/$1'; // Route for page numbers (e.g., /events/2)
$route['event-details/(:any)'] = 'home/event_details/$1'; // Route for a single event/blog post
$route['gallery'] = 'home/gallery'; // Route for the first page
$route['gallery/(:num)'] = 'home/gallery/$1'; // Route for page numbers (e.g., /gallery/2)
$route['affiliate'] = 'home/affiliate';
$route['staff'] = 'home/staff';
$route['contact'] = 'home/contact';
$route['coming-soon'] = 'home/coming_soon';

// Seo
$route['sitemap.xml'] = 'seo/sitemap';
$route['robots.txt'] = 'seo/robots';
$route['schema.json'] = 'seo/schema';

// Admin routes
$route['restricted_access'] = 'admin/restricted_access';
$route['admin_logout'] = 'admin_login/logout';
$route['admin-add-hero'] = 'admin_hero';
$route['admin-events'] = 'admin_events';
$route['admin-add-event'] = 'admin_events/add_event';
$route['admin-update-event/(:any)'] = 'admin_events/update_event/$1';
$route['admin-projects'] = 'admin_projects';
$route['admin-add-project'] = 'admin_projects/add_project';
$route['admin-update-project/(:any)'] = 'admin_projects/update_project/$1';
$route['admin-staff'] = 'admin_staff';
$route['admin-add-staff'] = 'admin_staff/add_staff';
$route['admin-update-staff/(:any)'] = 'admin_staff/update_staff/$1';
$route['admin-awards'] = 'admin_awards';
$route['admin-add-award'] = 'admin_awards/add_award';
$route['admin-update-award/(:any)'] = 'admin_awards/update_award/$1';
$route['admin-gallery'] = 'admin_gallery';
$route['messages'] = 'message/contact_messages';
