<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//===========assets url making================================================================
if ( ! function_exists('asset_url()')){
	function asset_url(){
		return base_url().'assets/';
	}
}
if ( ! function_exists('frontend_path')){
	function frontend_path(){
		$CI =& get_instance();
		return $CI->config->item('frontend_path');
	}
}
//============================================================================================
function userLoginCheck($sess_val){
	//print"<pre>";
	//print_r($sess_val);
	if(!isset($sess_val['admin_logged_in'])){
		redirect('dashboard/logout/');
	}
	//======================================================================
	if(!isset($sess_val['admin_login_status'])){
		redirect('dashboard/logout/');
	}
}
//============================================================================================
function pr($array){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}
function name($fname=NULL,$lname=NULL){
	return $fname.' '.$lname;
}
?>