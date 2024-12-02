<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['admin'] = 'admin/overview';

$route['admin/makanan'] = 'admin/makanan/index';
$route['admin/makanan/create'] = 'admin/makanan/create';
$route['admin/makanan/store'] = 'admin/makanan/store';

$route['admin/makanan/edit/(:any)'] = 'admin/makanan/edit/$1';
$route['admin/makanan/update/(:any)'] = 'admin/makanan/update/$1';
$route['admin/makanan/delete/(:any)'] = 'admin/makanan/delete/$1';



$route['admin/pc'] = 'admin/pc/index';
$route['admin/pc/create'] = 'admin/pc/create';
$route['admin/pc/edit/(:num)'] = 'admin/pc/edit/$1';
$route['admin/pc/delete/(:num)'] = 'admin/pc/delete/$1';



// application/config/routes.php
$route['admin/booking'] = 'admin/booking/index';
$route['admin/booking/create'] = 'admin/booking/create';
$route['admin/booking/store'] = 'admin/booking/store';
$route['admin/booking/edit/(:num)'] = 'admin/booking/edit/$1';
$route['admin/booking/update/(:num)'] = 'admin/booking/update/$1';
$route['admin/booking/delete/(:num)'] = 'admin/booking/delete/$1';







