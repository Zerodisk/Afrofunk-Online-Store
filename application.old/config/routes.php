<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "welcome";
$route['404_override'] = '';

/*
ADMIN
*/
$route['admin'] = 				"admin/home";
$route['admin/'] = 				"admin/home";
$route['admin/logout'] = 		"admin/sessions/logout";
$route['admin/login'] = 		"admin/sessions/login";
$route['admin/login/(:any)'] = 	"admin/sessions/login/$1";

/*
BRAND:
below are list Brand name to BrandID

$route['brand/hello-world-brand']	= "brand/view/2938";
$route['brand/yo-yo-brand']			= "brand/view/9134";
$route['brand/brand-1']				= "brand/view/10001";
$route['brand/brand-2']				= "brand/view/10002";
//any other brand that not being redirect, useing below
$route['brand/(:any)']				= "brand/findByKeyword/$1";			//view brand page
/*





/*
PRODUCT
below are list of product name
*/



/* End of file routes.php */
/* Location: ./application/config/routes.php */