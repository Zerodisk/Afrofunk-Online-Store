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

$route['default_controller'] 	  = "product/browsingByCat";
$route['404_override'] = '';

/*
ADMIN
*/
$route['admin'] 				  =	"admin/home";
$route['admin/'] 				  =	"admin/home";
$route['admin/logout'] 		 	  =	"admin/sessions/logout";
$route['admin/login']    		  =	"admin/sessions/login";
$route['admin/login/(:any)'] 	  =	"admin/sessions/login/$1";
			  		  

/*
Clothing
 */
$route['clothing'] 				  = "product/browsingByCat/1";
$route['clothing/all'] 			  = "product/browsingByCat/1";
$route['clothing/new-arrival'] 	  = "product/browsingByCat/1";

$route['clothing/sale'] 		  = "product/browsingBySale/1";
$route['clothing/sales'] 		  = "product/browsingBySale/1";


$route['clothing/dress'] 		  = "product/browsingByCat/21";
$route['clothing/dresses'] 		  = "product/browsingByCat/21";
$route['clothing/top'] 			  = "product/browsingByCat/22";
$route['clothing/tops'] 		  =	"product/browsingByCat/22";
$route['clothing/jacket'] 		  = "product/browsingByCat/23";
$route['clothing/jackets'] 		  =	"product/browsingByCat/23";
$route['clothing/coats-jacket']   =	"product/browsingByCat/23";
$route['clothing/coats-jackets']  =	"product/browsingByCat/23";
$route['clothing/skirt'] 		  =	"product/browsingByCat/24";
$route['clothing/skirts'] 		  =	"product/browsingByCat/24";
$route['clothing/short'] 		  =	"product/browsingByCat/25";
$route['clothing/shorts'] 		  = "product/browsingByCat/25";
$route['clothing/pant'] 		  = "product/browsingByCat/26";
$route['clothing/pants'] 		  = "product/browsingByCat/26";
$route['clothing/pants-leggin']   = "product/browsingByCat/26";
$route['clothing/pants-leggins']  = "product/browsingByCat/26";
$route['clothing/jumpsuits-playsuit']	= "product/browsingByCat/27";
$route['clothing/jumpsuits-playsuits']	= "product/browsingByCat/27";


/*
Accessories
 */
$route['accessories'] 			  =	"product/browsingByCat/2";
$route['accessories/all'] 		  =	"product/browsingByCat/2";
$route['accessories/new-arrival'] =	"product/browsingByCat/2";
$route['accessories/sale'] 		  =	"product/browsingBySale/2";
$route['accessories/sales']		  =	"product/browsingBySale/2";

$route['accessories/shoe'] 		  =	"product/browsingByCat/41";
$route['accessories/shoes'] 	  = "product/browsingByCat/41";
$route['accessories/bag'] 		  = "product/browsingByCat/42";
$route['accessories/bags']        =	"product/browsingByCat/42";
$route['accessories/jewellery']   = "product/browsingByCat/43";
$route['accessories/sunglasses']  = "product/browsingByCat/44";
$route['accessories/sun-glasses'] = "product/browsingByCat/44";
$route['accessories/other']       = "product/browsingByCat/45";
$route['accessories/others']      = "product/browsingByCat/45";

/*
Brand
 */
$route['brand']		  			  = "product/browsingByBrand";			
$route['brands']		  		  = "product/browsingByBrand";
$route['brand/view/(:any)']		  = "brand/view/$1";				//this is to maintain "brand" controller, i think i will remove brand.php later
$route['brands/view/(:any)']	  = "brand/view/$1";				//this is to maintain "brand" controller, i think i will remove brand.php later

$route['brand/Atmos']			  = "product/browsingByBrand/Atmos&Here;";
$route['brand/(:any)']			  = "product/browsingByBrand/$1";

$route['brands/Atmos']			  = "product/browsingByBrand/Atmos&Here;";
$route['brands/(:any)']			  = "product/browsingByBrand/$1";			

/*
SALE
 */
$route['sale'] 		  			  = "product/browsingBySale";
$route['sales']		  			  = "product/browsingBySale";
$route['sale/clothing'] 		  = "product/browsingBySale/1";
$route['sales/clothing'] 		  = "product/browsingBySale/1";
$route['sale/accessories'] 		  = "product/browsingBySale/2";
$route['sales/accessories'] 	  = "product/browsingBySale/2";

$route['sale/dresses'] 		  	  = "product/browsingBySale/21";
$route['sale/tops'] 		  	  = "product/browsingBySale/22";
$route['sale/jackets'] 		  	  = "product/browsingBySale/23";
$route['sale/coats-jacket']   	  =	"product/browsingBySale/23";
$route['sale/coats-jackets']      =	"product/browsingBySale/23";
$route['sale/skirts'] 		  	  = "product/browsingBySale/24";
$route['sale/shorts'] 		 	  = "product/browsingBySale/25";
$route['sale/pants'] 		  	  = "product/browsingBySale/26";
$route['sale/pants-leggin']       = "product/browsingBySale/26";
$route['sale/pants-leggins']      = "product/browsingBySale/26";
$route['sale/jumpsuits-playsuit']  = "product/browsingBySale/27";
$route['sale/jumpsuits-playsuits'] = "product/browsingBySale/27";

/*
PRODUCT
  below are list of product name redirect from product name to sku
$route['product/product-full-name']	= "product/view/DI085SH97FQG-16816";
*/
$route['redirect/view/(:any)']	  = 'redirect/view/$1';
$route['redirect/(:any)']		  = 'redirect/view/$1';


/*
 * Merchant website
*/
$route['merchant/iconic']	      = 'redirect/merchant/theiconic';
$route['merchant/theiconic']	  = 'redirect/merchant/theiconic';
$route['merchant/gosh']			  = 'redirect/merchant/gosh';
$route['merchant/bb']			  = 'redirect/merchant/bb';

$route['iconic']	  			  = 'redirect/merchant/theiconic';
$route['theiconic']	  			  = 'redirect/merchant/theiconic';
$route['gosh']			  		  = 'redirect/merchant/gosh';
$route['bb']			  		  = 'redirect/merchant/bb';

/*
 * Other
 */
$route['aboutus']				  = 'home/aboutus';



/* End of file routes.php */
/* Location: ./application/config/routes.php */