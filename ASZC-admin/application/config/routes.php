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
$route['user/admin/delete_user/(.*)'] = 'user/admin/delete_user/$1';
$route['user/admin/statuschange/(.*)'] = 'user/admin/statuschange/$1';
$route['user/admin/update_owner/(.*)'] = 'user/admin/update_owner/$1';
$route['user/admin/update_general_user/(.*)'] = 'user/admin/update_general_user/$1';
$route['user/admin/edit_profile/(.*)'] = 'user/admin/edit_profile/$1';
$route['user/admin(.*)'] = 'user/admin/$1';

$route['user/agency/delete_user/(.*)'] = 'user/agency/delete_user/$1';
$route['user/agency/statuschange/(.*)'] = 'user/agency/statuschange/$1';
$route['user/agency/update_owner/(.*)'] = 'user/agency/update_owner/$1';
$route['user/agency/update_general_user/(.*)'] = 'user/agency/update_general_user/$1';
$route['user/agency/edit_profile/(.*)'] = 'user/agency/edit_profile/$1';
$route['user/agency(.*)'] = 'user/agency/$1';

$route['user/owner/delete_user/(.*)'] = 'user/owner/delete_user/$1';
$route['user/owner/statuschange/(.*)'] = 'user/owner/statuschange/$1';
$route['user/owner/update_owner/(.*)'] = 'user/owner/update_owner/$1';
$route['user/owner/update_general_user/(.*)'] = 'user/owner/update_general_user/$1';
$route['user/owner/edit_profile/(.*)'] = 'user/owner/edit_profile/$1';
$route['user/owner(.*)'] = 'user/owner/$1';

$route['user/individual/delete_user/(.*)'] = 'user/individual/delete_user/$1';
$route['user/individual/statuschange/(.*)'] = 'user/individual/statuschange/$1';
$route['user/individual/update_owner/(.*)'] = 'user/individual/update_owner/$1';
$route['user/individual/update_general_user/(.*)'] = 'user/individual/update_general_user/$1';
$route['user/individual/edit_profile/(.*)'] = 'user/individual/edit_profile/$1';
$route['user/individual(.*)'] = 'user/individual/$1';

$route['user/send_blocked_note(.*)'] = 'user/send_blocked_note/$1';

$route['user/user_search/(.*)'] = 'user/user_search/$1';
$route['user/user_search'] = 'user/user_search';
$route['user/delete_user/(.*)'] = 'user/delete_user/$1';
$route['user/view_message/(.*)'] = 'user/view_message/$1';
$route['user/feedback/(.*)'] = 'user/feedback/$1';
$route['user/statuschangeoneditprofile/(.*)'] = 'user/statuschangeoneditprofile/$1';
$route['user/statuschange/(.*)'] = 'user/statuschange/$1';
$route['user/update_company/(.*)'] = 'user/update_company/$1';
$route['user/update_owner/(.*)'] = 'user/update_owner/$1';
$route['user/update_general_user/(.*)'] = 'user/update_general_user/$1';
$route['user/add_company/(.*)'] = 'user/add_company/$1';
$route['user/add_owner/(.*)'] = 'user/add_owner/$1';
$route['user/add_general_user/(.*)'] = 'user/add_general_user/$1';
$route['user/add_general_user'] = 'user/add_general_user';
$route['user/add_company'] = 'user/add_company';
$route['user/add_owner'] = 'user/add_owner';
$route['user/add_profile/(.*)'] = 'user/add_profile/$1';
$route['user/edit_profile/(.*)'] = 'user/edit_profile/$1';
$route['user/check_bussname_avail'] = 'user/check_bussname_avail';
$route['user/check_vat_avail'] = 'user/check_vat_avail';
$route['user/check_email_avail'] = 'user/check_email_avail';
$route['user/check_user_avail'] = 'user/check_user_avail';
$route['user/check_ssn_avail'] = 'user/check_ssn_avail';
$route['user/city_search'] = 'user/city_search';
$route['user/adduser'] = 'user/adduser';
$route['user/manage_location/(.*)'] = 'user/manage_location/(.*)';
$route['user/update_location/(.*)'] = 'user/update_location/(.*)';
$route['user/(.*)'] = 'user/index/$1';

$route['property/delete_property/(.*)'] = 'property/delete_property/$1';
$route['property/del_img/(.*)'] = 'property/del_img/$1';
$route['property/city_search_via_id'] = 'property/city_search_via_id';
$route['property/getTypologyedit'] = 'property/getTypologyedit';
$route['property/getSubCategoryedit'] = 'property/getSubCategoryedit';
$route['property/getCategoryedit'] = 'property/getCategoryedit';
$route['property/update_property_details/(.*)'] = 'property/update_property_details/$1';
$route['property/edit_property_details/(.*)'] = 'property/edit_property_details/$1';
$route['property/view_property_details/(.*)'] = 'property/view_property_details/$1';
$route['property/property_image/(.*)'] = 'property/property_image/$1';
$route['property/pro_view_st_change/(.*)'] = 'property/pro_view_st_change/$1';
$route['property/status_change_ajx'] = 'property/status_change_ajx';
$route['property/status_change/(.*)'] = 'property/status_change/$1';
$route['property/property_feature_suspend/(.*)'] = 'property/property_feature_suspend/$1';
$route['property/property_feature_resume/(.*)'] = 'property/property_feature_resume/$1';
$route['property/make_prop_feature/(.*)'] = 'property/make_prop_feature/$1';
$route['property/make_featured/(.*)'] = 'property/make_featured/$1';
$route['property/manage_location/(.*)'] = 'property/manage_location/$1';
$route['property/update_location'] = 'property/update_location';
$route['property/(.*)'] = 'property/index/$1';


$route['default_controller'] = "login";

$route['404_override'] = '';



/* End of file routes.php */

/* Location: ./application/config/routes.php */