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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = true;
$route['(:any)'] = "main/$1";
$route['admin'] = 'admin/login';


$route['page/(:any)'] = 'main/page/$1';
$route['blog/(:any)'] = 'main/theBlog/$1';
$route['explore/(:num)/(:any)'] = 'main/explore/$1/$2';
$route['product/(:num)/(:any)'] = 'main/product/$1/$2';
$route['course_detail/(:num)/(:any)'] = 'main/course_detail/$1/$2';
$route['contact/(:num)/(:any)'] = 'main/contact/$1/$2';
$route['qbank/(:num)/(:any)'] = 'main/qbank_detail/$1/$2';

$route['checkout'] = 'main/checkout';
$route['service/(:any)'] = 'main/service/$1';

$route['signup/(:any)'] = 'main/signup/$1';
$route['search/(:any)/(:any)'] = 'main/search/$1/$2';
$route['search/(:any)'] = 'main/search/$1';
$route['userprofile/(:any)'] = 'main/userprofile/$1';
$route['userliked/(:any)'] = 'main/userliked/$1';
$route['userreels/(:any)'] = 'main/userreels/$1';
$route['usermentions/(:any)'] = 'main/usermentions/$1';
$route['userproperties/(:any)'] = 'main/userproperties/$1';
$route['user-shop/(:any)'] = 'main/user_shop/$1';
$route['post/(:any)'] = 'main/post/$1';

$route['property/(:num)/(:any)'] = 'main/property_details/$1/$2';
$route['developer/(:num)/(:any)'] = 'main/developer_details/$1/$2';
$route['video/(:num)'] = 'main/video_link/$1';
