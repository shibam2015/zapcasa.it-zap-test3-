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

$route['default_controller'] = "site";
$route['404_override'] = '';
//$route['property_search'] = '';
//$route['property_search/Residential'] = 'Residential';

$route['Residential'] = 'property/search/RES';
$route['Residenziale'] = 'property/search/RES';
$route['Business'] = 'property/search/BUS';
$route['Commerciale'] = 'property/search/BUS';
$route['Rooms'] = 'property/search/ROM';
$route['Stanze'] = 'property/search/ROM';
$route['Land'] = 'property/search/LAND';
$route['Terreni'] = 'property/search/LAND';
$route['Vacations'] = 'property/search/VAC';
$route['Vacanze'] = 'property/search/VAC';
$route['Property-for-business'] = 'property/search/PRO';
$route['Immobili-commerciali'] = 'property/search/PRO';
$route['Business-license'] = 'property/search/BLI';
$route['Licenze-commerciali'] = 'property/search/BLI';
$route['Luxury'] = 'property/search/LUX';
$route['Lusso'] = 'property/search/LUX';

$route['My_Feedback'] = 'advertiser/get_feedback';

$route['contact_us/do_contact'] = 'site/do_contact';
$route['contact_us'] = 'site/contact';


$route['Residential/(.*)']='property/property_full_details/$1';
$route['Business/(.*)']='property/property_full_details/$1';
$route['Rooms/(.*)']='property/property_full_details/$1';
$route['Land/(.*)']='property/property_full_details/$1';
$route['Vacations/(.*)']='property/property_full_details/$1';
$route['Luxury/(.*)']='property/property_full_details/$1';

$route['Business-Pro/(.*)']='property/property_full_details/$1';
$route['Business-Bli/(.*)']='property/property_full_details/$1';

$route['Luxury-Res/(.*)']='property/property_full_details/$1';
$route['Luxury-Pro/(.*)']='property/property_full_details/$1';
$route['Luxury-Bli/(.*)']='property/property_full_details/$1';
$route['Luxury-Vac/(.*)']='property/property_full_details/$1';


$route['My_Feedback/(.*)'] = 'advertiser/get_feedback/$1';


//$route['admin']='admin/login';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
