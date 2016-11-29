<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users
 *
 * @author user
 */

class site extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('cookie');
		if(isset( $_COOKIE['lang']) && ($_COOKIE['lang'] == "english")){
			$this->lang->load('code', 'english');
		} else {
			$this->lang->load('code', 'it');
		}
		
		$this->load->model("site/sitem");
		$this->load->model("users/usersm");
		//authenticate();		
		/* if($this->session->userdata('user_id')){
			$data['pref_info']=$this->usersm->get_pref_info();
			if( isset($data['pref_info'][0]['language'] ) && ( $data['pref_info'][0]['language'] == "english" )) {
				//$this->lang->load('code', 'english');
				//$_COOKIE['lang']='english';
			} else {
				//$this->lang->load('code', 'it');
				//$_COOKIE['lang']='it';
			}
		}else{
			if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
				//$this->lang->load('code', 'english');
			} else {
				//$this->lang->load('code', 'it');
			}
		} */		
    }	
	public function index(){
		$data = array();
		$data['sitepage'] = "1";
		$cat = get_categories_subcat();
		$data['categories'] = $cat;
		$cont = get_contracts();
		$data['contract_types'] = $cont;
		$featured = get_featured_property();
		$data['featured_property'] = $featured;
		$latest = get_latest_property();
		$data['latest_property'] = $latest;
		$this->load->view("site/index",$data);
	}
	public function cmsPages() {
		$data['sitepage'] = "1";
		if( $this->uri->segment(3) ) {
			$slug = $this->uri->segment(3);
			$cmsDetails = get_all_value('zc_cmspages'," and slug='".$slug."'");
			$data['cmsDetails']= array();
			if( count( $cmsDetails ) > 0 ) {
				$data['cmsDetails']= $cmsDetails[0];
				$this->load->view('site/cms',$data);
			} else {
				$route['404_override'] = 'errors/error_general';
			}
		} else {
			$route['404_override'] = 'errors/error_general';
		}
	}
	public function contact(){
		$this->load->view('site/contact_us');
	}
	public function do_contact(){ 
		//echo '<pre>';print_r($_POST);

		$new_data=array();
		$new_data['category']=$this->input->post('category');
		$new_data['name']=$this->input->post('name');
		$new_data['phone_number']=$this->input->post('phone_number');
		$new_data['email']=$this->input->post('email');
		$new_data['subject']=$this->input->post('subject');
		$new_data['message']=$this->input->post('message');
		// $contact_msg_id=$this->contact_model->add_new_msg($new_data);

		$this->session->set_flashdata('mail_success', 
		$this->lang->line('contact_us_mail_success'));
		/*dfhdfghfgh*/
		$msg='<div style="width:500px; margin:0 auto; padding:10px 0; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#333; border:1px solid #ccc; background:rgba(232,232,232,.2); border-radius: 4px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" style="">
		<tr>
		<td colspan="2" style="border-bottom:2px solid #ccc;">
		<span style=" padding:5px 5px 8px 5px; float:left; margin-bottom:3px;">
		<img src="'.base_url().'assets/images/logo.png" width="170" /></span>
		<span style="color:#EE7D3E; font-size:19px; margin-top:36px; margin-left:5px; float:left;">Real Estate for <strong>jobs & Housing</strong></span>
		</td>
		</tr>
		<tr>
		<td style="padding:20px 5px 5px; width:115px;" valign="top"><label style="font-weight:bold; font-size:12px; margin-left: 6px;">'.$this->lang->line('contact_us_text_category').': </label></td>
		<td style="padding:20px 5px 5px;"  valign="top"><span style="float: left; width: 150px; font-size:14px; color:#572335;">'.$this->input->post('category').'</span></td>
		</tr>
		<tr>
		<td style="padding:5px; width:115px;" valign="top"><label style="font-weight:bold; font-size:12px; margin-left: 6px;">'.$this->lang->line('contact_us_text_user_name').': </label></td>
		<td style="padding:5px;" valign="top"><span style="float: left; width: 150px; font-size:14px; color:#572335; ">'.$this->input->post('name').'</span></td>
		</tr>
		<tr>
		<td style="padding:5px; width:115px;" valign="top"><label style="font-weight:bold; font-size:12px; margin-left: 6px;">'.$this->lang->line('contact_us_text_phone_number').': </label></td>
		<td style="padding:5px;" valign="top"><span  style="float: left; width: 150px; font-size:14px; color: #572335; ">'.$this->input->post('phone_number').'</span></td>
		</tr>
		<tr>
		<td style="padding:5px; width:115px;" valign="top"><label style="font-weight:bold; font-size:12px; margin-left: 6px;">'.$this->lang->line('contact_us_text_user_email').':  </label></td>
		<td style="padding:5px;" valign="top"><span  style="float: left; width: 150px; font-size:14px; color:#572335; ">'.$this->input->post('email').'</span></td>
		</tr>
		<tr>
		<td style="padding:5px; width:115px;" valign="top"><label style="font-weight:bold; font-size:12px; margin-left: 6px;">'.$this->lang->line('contact_us_text_subject').':  </label></td>
		<td style="padding:5px;" valign="top"><span  style="float: left; width: 150px; font-size:14px; color:#572335; ">'.$this->input->post('subject').'</span></td>
		</tr>
		<tr>
		<td style="padding:5px; width:115px;" valign="top"><label style="font-weight:bold; font-size:12px; margin-left: 6px;">
		'.$this->lang->line('contact_us_text_message').':  </label></td>
		<td style="padding:5px;" valign="top"><span  style="float: left; width: 362px; font-size:14px; color:#572335;">'.$this->input->post('message').'</span></td>
		</tr>
		</table>
		</div>';
		$details=array();
		$default_email = get_perticular_field_value('zc_settings','meta_value'," and meta_name='default_email'");
		$mail_from= isset($default_email) ? $default_email : "no-reply@zapcasa.it";
		$mail_to = 'info@zapcasa.it';
		$subject = $this->lang->line('contact_us_subject');
		$message = $msg;
		
		$body = $message;
		
		sendemail($mail_from, $mail_to, $subject, $body, $cc='');
		
		redirect('contact_us');
	}
	public function Highlight_your_advert(){
		$data['sitepage'] = "1";
		$cmsDetails =get_all_value('zc_cmspages'," and slug='highlight-your-advert'");
		$data['cmsDetails']= array();
		if( count( $cmsDetails ) > 0 ) {
			$data['cmsDetails']= $cmsDetails[0];
			$this->load->view('site/cms',$data);
		} else {
			$route['404_override'] = 'errors/error_general';
		}
	}
	public function languageselection(){
		if(!empty($_POST['lang'])){
			$_COOKIE['lang'] = $_POST['lang'];
		}else{
			$_COOKIE['lang'] = 'it';
		}
		setcookie('lang', '',time()-(60*60*24*30),"/");  // "update" by adding a new 
		setcookie('lang', $_COOKIE['lang'],time()+(60*60*24*30),"/");  // "update" by adding a new 
		echo "language-changed";
	}	
}
?>