<?php
//ob_start(); 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
       {
            parent::__construct();
			$this->load->model('user_model');
			$this -> load -> library('image_lib');
			$this->resized_path = realpath(APPPATH.'../assets/uploads/thumb_92_82');
			$uid=$this->session->userdata( 'user_id' );
			if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
				$this->lang->load('code', 'english');
			} else {
				$this->lang->load('code', 'it');
			}
       }
	public function index()
	{
		
		$this->load->view('site');
	}
	
	public function common_reg()
	{
		$this->session->set_userdata('user_id',0);
		$this->load->view('site/users/common_reg');
	}
	
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////for general user registration///////////////////////
	//////////////////////////////////////////////////////////////////////////////
	public function comon_signup()
	{
		
		$uid=$this->session->userdata( 'user_id' );
		if( $uid != 0 ) {
			redirect('users/my_account');
		}
		$new_user['contact_ph_no'] = $this->input->post('ph_no');
  		$this->session->set_userdata($new_user);
		
		$data['countries']=$this->user_model->get_country();
		$captcha_lib=base_url().'/captcha/';
		
		$this->load->helper('captcha');
		$captcha_path=base_url();
	  $vals = array(
		 'img_path' => './captcha/',
		 'img_url' => $captcha_lib,
		 'img_width' => '280',
		 'img_height' => 80,
		 'expiration' => 7200 
		 
		 );
		  $cap = create_captcha($vals);
	
		  $data['captcha'] = array(
			 'captcha_time' => $cap['time'],
			 'ip_address' => $this->input->ip_address(),
			 'word' => $cap['word']
			 );
			 //print_r($data['captcha']);die;
		
		$query = $this->db->insert_string('captcha', $data['captcha']);
		$this->db->query($query);	 
		 // $this->session->set_userdata($data['captcha']);
		  $data['cap_img']=$cap['image'];
		  $this->load->view('site/users/reg_user',$data);
		  
		
	}
	public function do_registration()
	{
		$this->load->library('form_validation');
		$new_user['contact_ph_no'] = $this->input->post('ph_no');
  		$this->session->set_userdata($new_user);
		
		if($this->input->post('submit')==/*'Register' || 'Registrati'*/$this->lang->line('reg_user_button_register'))
		{
			
			//$this->form_validation->set_rules('captcha','Security Code','required');
			$this->form_validation->set_rules('user_name', 'User Name', 'required|is_unique[zc_user.user_name]');
			$this->form_validation->set_rules('first_name', 'first_name', 'required');
			$this->form_validation->set_rules('last_name', 'last_name', 'required');
			$this->form_validation->set_rules('country', 'country', 'required');
			//$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[zc_user.email_id]');
			$this->form_validation->set_rules('email2', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required|matches[pass2]');
			$this->form_validation->set_rules('pass2', 'Password Confirmation', 'required');
			//print_r($_POST);
			 if($this->form_validation->run() == FALSE)
			  {
				  
			  	$data['countries']=$this->user_model->get_country();
				$captcha_lib=base_url().'/captcha/';
				
				$this->load->helper('captcha');
				$captcha_path=base_url();
			  $vals = array(
				 'img_path' => './captcha/',
				 'img_url' => $captcha_lib,
				 'img_width' => '280',
				 'img_height' => 80,
				 'expiration' => 7200 
				 
				 );
				  $cap = create_captcha($vals);
				  $data['captcha'] = array(
					 'captcha_time' => $cap['time'],
					 'ip_address' => $this->input->ip_address(),
					 'word' => $cap['word']
					 );
					 //print_r($data['captcha']);die;
				
				$query = $this->db->insert_string('captcha', $data['captcha']);
				$this->db->query($query);	 
				 // $this->session->set_userdata($data['captcha']);
				  $data['cap_img']=$cap['image'];
				  $this->load->view('site/users/reg_user',$data);
			  }
			  else
			  {
				 $expiration = time()-7200; // Two hour limit
					$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
					
					// Then see if a captcha exists:
					$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
					$binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
					$query = $this->db->query($sql, $binds);
					$row = $query->row();
					
					if ($row->count == 0)
					{
						 /*$this->session->set_flashdata('captcha_err', 'You submit a wrong captcha');
						 redirect('users/comon_signup');*/
						 $data['countries']=$this->user_model->get_country();
						$captcha_lib=base_url().'/captcha/';
						
						$this->load->helper('captcha');
						$captcha_path=base_url();
					  $vals = array(
						 'img_path' => './captcha/',
						 'img_url' => $captcha_lib,
						 'img_width' => '280',
						 'img_height' => 80,
						 'expiration' => 7200 
						 
						 );
						  $cap = create_captcha($vals);
						  $data['captcha'] = array(
							 'captcha_time' => $cap['time'],
							 'ip_address' => $this->input->ip_address(),
							 'word' => $cap['word']
							 );
							 //print_r($data['captcha']);die;
						
						$query = $this->db->insert_string('captcha', $data['captcha']);
						$this->db->query($query);	 
						 // $this->session->set_userdata($data['captcha']);
						 $data['captcha_err']= $this->lang->line('reg_user_you_submit_wrong_captcha');
						  $data['cap_img']=$cap['image'];
						  $this->load->view('sites/users/reg_user',$data);
						
					}
				  
				 
				  else{
				   		$new_user=array();
						$access_token=access_token();
						$new_user['user_type'] ='1';
						$new_user['user_name'] = $this->input->post('user_name');
						$new_user['first_name'] = $this->input->post('first_name');
						$new_user['last_name'] = $this->input->post('last_name');
						$new_user['contact_ph_no'] = $this->input->post('ph_no');
						$new_user['date_of_birth'] = $this->input->post('date_of_birth');
						$new_user['city'] = $this->input->post('city');
						$new_user['country'] = $this->input->post('country');
						$new_user['email_id'] = $this->input->post('email');
						$new_user['password'] = $this->generate_password_string($access_token,$this->input->post('password'));
						$new_user['gender'] = $this->input->post('gender');
						$new_user['access_token'] 	= $access_token ;
						$new_user['agree_terms'] = $this->input->post('agree_terms');
						$new_user['receive_mail'] = $this->input->post('receive_mail');
						
						$this->session->set_userdata($new_user);
						$ym=$this->session->all_userdata();
						//echo '<pre>';print_r($ym);die;
						redirect('users/user_edit');
						
						
						/*$rs=$this->user_model->insert_user( $new_user );
						if($rs)
						{
							$email=get_perticular_field_value('zc_user','email_id'," and user_id='".$rs."'");
							$user_name=get_perticular_field_value('zc_user','first_name'," and user_id='".$rs."'").' '.get_perticular_field_value('zc_user','last_name'," and user_id='".$rs."'");
							$passwrd=get_perticular_field_value('zc_user','password'," and user_id='".$rs."'");
							$link=base_url().'user/acctivation/'.$rs.'/'.$passwrd;
							$details=array();
							$details['from']="biswabijoymukherji@rediffmail.com";
							$details['to']=$email;
							$details['subject']="Congratulation";
							$details['message']="Welcome  ".$user_name.",<br/> To activate your account please click on the following Link <br/>  <strong> ".$link."</strong>";
							send_mail($details);
							redirect('user/thanks');
						}*/
				  		
				  }
			  
			  }
		}
		else
		{
			$data['countries']=$this->user_model->get_country();
		$captcha_lib=base_url().'/captcha/';
		
		$this->load->helper('captcha');
		$captcha_path=base_url();
	  $vals = array(
		 'img_path' => './captcha/',
		 'img_url' => $captcha_lib,
		 'img_width' => '280',
		 'img_height' => 80,
		 'expiration' => 7200 
		 
		 );
		  $cap = create_captcha($vals);
		  $data['captcha'] = array(
			 'captcha_time' => $cap['time'],
			 'ip_address' => $this->input->ip_address(),
			 'word' => $cap['word']
			 );
			 //print_r($data['captcha']);die;
		
		$query = $this->db->insert_string('captcha', $data['captcha']);
		$this->db->query($query);	 
		 // $this->session->set_userdata($data['captcha']);
		  $data['cap_img']=$cap['image'];
		  $this->load->view('site/users/reg_user',$data);
		  
		}
	}
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////for general user registration ends///////////////////////
	//////////////////////////////////////////////////////////////////////////////
	
		//////////////////////////////////////////////////////////////////////////////
	//////////////////////////for general  as Owner registration statrts///////////////////////
	//////////////////////////////////////////////////////////////////////////////
	public function reg_owner()
	{
		$uid=$this->session->userdata( 'user_id' );
		if( $uid != 0 ) {
			redirect('users/my_account');
		}
		$new_user['phone_2'] = '';			
		$this->session->set_userdata($new_user); 
		
		$captcha_lib=base_url().'/captcha/';
		
		$this->load->helper('captcha');
		$captcha_path=base_url();
	  $vals = array(
		 'img_path' => './captcha/',
		 'img_url' => $captcha_lib,
		 'img_width' => '280',
		 'img_height' => 80,
		 'expiration' => 7200 
		 
		 );
		  $cap = create_captcha($vals);
		  $data['captcha'] = array(
			 'captcha_time' => $cap['time'],
			 'ip_address' => $this->input->ip_address(),
			 'word' => $cap['word']
			 );
			 //print_r($data['captcha']);die;
		
		$query = $this->db->insert_string('captcha', $data['captcha']);
		$this->db->query($query);	 
		 // $this->session->set_userdata($data['captcha']);
		  $data['cap_img']=$cap['image'];
		$data['provinces']=$this->user_model->get_state_list(); 
		
		
		$this->load->view('site/users/reg_owner',$data);
		
	}
	
	
	function do_owner_reg() {
		$this->load->library('form_validation');
		/////////store in session while first input/////////////////////////////////////
		$new_user['phone_2'] = $this->input->post('phone_2');			
		$this->session->set_userdata($new_user);
		/////////session ends///////////////////////////////////////////
		if($this->input->post('submit')==/*'Register' || 'Registrati'*/$this->lang->line('reg_owner_button_register')) {
			//$this->form_validation->set_rules('captcha','Security Code','required');
			$this->form_validation->set_rules('user_name', 'User Name', 'required|is_unique[zc_user.user_name]');
			$this->form_validation->set_rules('first_name', 'first_name', 'required');
			$this->form_validation->set_rules('last_name', 'last_name', 'required');
			$this->form_validation->set_rules('social_secuirity_number', 'Social Secuirity Number', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('province', 'Province', 'required');
			$this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required');
			$this->form_validation->set_rules('street_address', 'Street Address', 'required');
			$this->form_validation->set_rules('street_no', 'Street Number', 'required');
			$this->form_validation->set_rules('zip', 'ZIP', 'required');
			$this->form_validation->set_rules('phone_1', 'Phone Number', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[zc_user.email_id]|matches[email2]');
			$this->form_validation->set_rules('email2', 'Email Confirmation', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required|matches[pass2]');
			$this->form_validation->set_rules('pass2', 'Password Confirmation', 'required');
			
			//print_r($_POST);
			 if($this->form_validation->run() == FALSE) {
				  
			  	$data['provinces']=$this->user_model->get_province();
				$captcha_lib=base_url().'/captcha/';
				
				$this->load->helper('captcha');
				$captcha_path=base_url();
			  $vals = array(
				 'img_path' => './captcha/',
				 'img_url' => $captcha_lib,
				 'img_width' => '280',
				 'img_height' => 80,
				 'expiration' => 7200 
				 
				 );
				  $cap = create_captcha($vals);
				  $data['captcha'] = array(
					 'captcha_time' => $cap['time'],
					 'ip_address' => $this->input->ip_address(),
					 'word' => $cap['word']
					 );
					 //print_r($data['captcha']);die;
				
				$query = $this->db->insert_string('captcha', $data['captcha']);
				$this->db->query($query);	 
				 // $this->session->set_userdata($data['captcha']);
				 $data['provinces']=$this->user_model->get_state_list();
				  $province=set_value('province');
					$data['city']=$this->user_model->get_city($province);
				  $data['cap_img']=$cap['image'];
				  $this->load->view('site/users/reg_owner',$data);
			  }
			  else
			  {
				 $expiration = time()-7200; // Two hour limit
					$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
					
					// Then see if a captcha exists:
					$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
					$binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
					$query = $this->db->query($sql, $binds);
					$row = $query->row();
					
					if ($row->count == 0)
					{
						 
				  
							
							$captcha_lib=base_url().'/captcha/';
							
							$this->load->helper('captcha');
							$captcha_path=base_url();
						  $vals = array(
							 'img_path' => './captcha/',
							 'img_url' => $captcha_lib,
							 'img_width' => '280',
							 'img_height' => 80,
							 'expiration' => 7200 
							 
							 );
							  $cap = create_captcha($vals);
							  $data['captcha'] = array(
								 'captcha_time' => $cap['time'],
								 'ip_address' => $this->input->ip_address(),
								 'word' => $cap['word']
								 );
								 //print_r($data['captcha']);die;
							
							$query = $this->db->insert_string('captcha', $data['captcha']);
							$this->db->query($query);	 
							 // $this->session->set_userdata($data['captcha']);
							 $data['provinces']=$this->user_model->get_state_list();
							  $province=set_value('province');
								$data['city']=$this->user_model->get_city($province);
							  $data['captcha_err']= $this->lang->line('reg_owner_you_submit_wrong_captcha');
							  $data['cap_img']=$cap['image'];
							  $this->load->view('site/users/reg_owner',$data);
			  
						
					}
				  
				 
				  else{
				   		$new_user=array();
						$access_token=access_token();
						$new_user['user_type'] ='2';
						$new_user['user_name'] =$this->input->post('user_name');
						$new_user['first_name'] = $this->input->post('first_name');
						$new_user['last_name'] = $this->input->post('last_name');
						$new_user['social_secuirity_number'] = $this->input->post('social_secuirity_number');
						$new_user['date_of_birth'] = $this->input->post('date_of_birth');
						$new_user['city'] = $this->input->post('city');
						$new_user['province'] = $this->input->post('province');
						$new_user['street_address'] = $this->input->post('street_address');
						$new_user['street_no'] = $this->input->post('street_no');
						$new_user['zip'] = $this->input->post('zip');
						$new_user['phone_1'] = $this->input->post('phone_1');
						$new_user['phone_2'] = $this->input->post('phone_2');
						$new_user['email_id'] = $this->input->post('email');
						$new_user['password'] = $this->generate_password_string($access_token,$this->input->post('password'));
						$new_user['gender'] = $this->input->post('gender');
						$new_user['access_token'] 	= $access_token ;
						$new_user['agree_terms'] = $this->input->post('agree_terms');
						$new_user['receive_mail'] = $this->input->post('receive_mail');
						
						$this->session->set_userdata($new_user);
						$ym=$this->session->all_userdata();
						//echo '<pre>';print_r($ym);die;
						redirect('users/owner_edit');
						
						/*$rs=$this->user_model->insert_user( $new_user );
						if($rs)
						{
							$email=get_perticular_field_value('zc_user','email_id'," and user_id='".$rs."'");
							$user_name=get_perticular_field_value('zc_user','first_name'," and user_id='".$rs."'").' '.get_perticular_field_value('zc_user','last_name'," and user_id='".$rs."'");
							$passwrd=get_perticular_field_value('zc_user','password'," and user_id='".$rs."'");
							$link=base_url().'user/acctivation/'.$rs.'/'.$passwrd;
							$details=array();
							$details['from']="biswabijoymukherji@rediffmail.com";
							$details['to']=$email;
							$details['subject']="Congratulation";
							$details['message']="Welcome  ".$user_name.",<br/> To activate your account please click on the following Link <br/>  <strong> ".$link."</strong>";
							send_mail($details);
							redirect('user/thanksowner');
						}*/
				  		
				  }
			  
			  }
		}
		else
		{
			$data['provinces']=$this->user_model->get_province();
				$captcha_lib=base_url().'/captcha/';
				
				$this->load->helper('captcha');
				$captcha_path=base_url();
			  $vals = array(
				 'img_path' => './captcha/',
				 'img_url' => $captcha_lib,
				 'img_width' => '280',
				 'img_height' => 80,
				 'expiration' => 7200 
				 
				 );
				  $cap = create_captcha($vals);
				  $data['captcha'] = array(
					 'captcha_time' => $cap['time'],
					 'ip_address' => $this->input->ip_address(),
					 'word' => $cap['word']
					 );
					 //print_r($data['captcha']);die;
				
				$query = $this->db->insert_string('captcha', $data['captcha']);
				$this->db->query($query);	 
				 // $this->session->set_userdata($data['captcha']);
				 $data['provinces']=$this->user_model->get_state_list();
				  $data['cap_img']=$cap['image'];
				  $this->load->view('site/users/reg_owner',$data);
		}
	
	}

	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////for general  as Owner registration ends///////////////////////
	//////////////////////////////////////////////////////////////////////////////
	
		//////////////////////////////////////////////////////////////////////////////
	//////////////////////////for general  as Agency registration starts///////////////////////
	//////////////////////////////////////////////////////////////////////////////
	public function reg_agency()
	{
		$uid=$this->session->userdata( 'user_id' );
		if( $uid != 0 ) {
			redirect('users/my_account');
		}
		$new_user['phone_2'] = $this->input->post('phone_2');
		$new_user['fax_no'] = $this->input->post('fax_no');
		$new_user['website'] = $this->input->post('website');
		$this->session->set_userdata($new_user); 
		
		$captcha_lib=base_url().'/captcha/';
		
		$this->load->helper('captcha');
		$captcha_path=base_url();
	  $vals = array(
		 'img_path' => './captcha/',
		 'img_url' => $captcha_lib,
		 'img_width' => '280',
		 'img_height' => 80,
		 'expiration' => 7200 
		 
		 );
		  $cap = create_captcha($vals);
		  $data['captcha'] = array(
			 'captcha_time' => $cap['time'],
			 'ip_address' => $this->input->ip_address(),
			 'word' => $cap['word']
			 );
			 //print_r($data['captcha']);die;
		
		$query = $this->db->insert_string('captcha', $data['captcha']);
		$this->db->query($query);	 
		 // $this->session->set_userdata($data['captcha']);
		  $data['cap_img']=$cap['image'];
		 
		$data['provinces']=$this->user_model->get_state_list();  
		//$data['provinces']=$this->user_model->get_province();
		$this->load->view('site/users/reg_agency',$data);
		
	}
	
	function do_agency_reg()
	{
		
		$this->load->library('form_validation');
		$new_user['phone_2'] = $this->input->post('phone_2');
		$new_user['fax_no'] = $this->input->post('fax_no');
		$new_user['website'] = $this->input->post('website');
		$this->session->set_userdata($new_user);
  
		
		if($this->input->post('submit')==/*'Register' || 'Registrati'*/$this->lang->line('reg_agency_button_register'))
		{
			
			//$this->form_validation->set_rules('captcha','Security Code','required');
			$this->form_validation->set_rules('user_name', 'User Name', 'required|is_unique[zc_user.user_name]');
			$this->form_validation->set_rules('company_name', 'Company Name', 'required');
			$this->form_validation->set_rules('business_name', 'Business Name', 'required');
			$this->form_validation->set_rules('vat_number', 'Vat Number', 'required');
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');
			$this->form_validation->set_rules('contact_ph_no', 'Contact Numnber', 'required');
			$this->form_validation->set_rules('province', 'Province', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('street_address', 'Street Address', 'required');
			$this->form_validation->set_rules('street_no', 'Street Number', 'required');
			$this->form_validation->set_rules('zip', 'ZIP', 'required');
			$this->form_validation->set_rules('phone_1', 'Phone Number', 'required');
			//$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[zc_user.email_id]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[zc_user.email_id]|matches[email2]');
			$this->form_validation->set_rules('email2', 'Email Confirmation', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required|matches[pass2]');
			$this->form_validation->set_rules('pass2', 'Password Confirmation', 'required');
			
			//print_r($_POST);
			 if($this->form_validation->run() == FALSE)
			  {
				
			  	//echo 'asdasd';
				$captcha_lib=base_url().'/captcha/';
				
				$this->load->helper('captcha');
				$captcha_path=base_url();
			  $vals = array(
				 'img_path' => './captcha/',
				 'img_url' => $captcha_lib,
				 'img_width' => '280',
				 'img_height' => 80,
				 'expiration' => 7200 
				 
				 );
				  $cap = create_captcha($vals);
				  $data['captcha'] = array(
					 'captcha_time' => $cap['time'],
					 'ip_address' => $this->input->ip_address(),
					 'word' => $cap['word']
					 );
					 //print_r($data['captcha']);die;
				
				$query = $this->db->insert_string('captcha', $data['captcha']);
				$this->db->query($query);	 
				 // $this->session->set_userdata($data['captcha']);
				  $data['cap_img']=$cap['image'];
				  
					 $data['provinces']=$this->user_model->get_state_list();
					 $province=set_value('province');
					$data['city']=$this->user_model->get_city($province);
				  $this->load->view('site/users/reg_agency',$data);
			  }
			  else
			  {
				 $expiration = time()-7200; // Two hour limit
					$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
					
					// Then see if a captcha exists:
					$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
					$binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
					$query = $this->db->query($sql, $binds);
					$row = $query->row();
					
					if ($row->count == 0)
					{
						//echo 'captch validation';
						$captcha_lib=base_url().'/captcha/';
							
							$this->load->helper('captcha');
							$captcha_path=base_url();
						  $vals = array(
							 'img_path' => './captcha/',
							 'img_url' => $captcha_lib,
							 'img_width' => '280',
							 'img_height' => 80,
							 'expiration' => 7200 
							 
							 );
							  $cap = create_captcha($vals);
							  $data['captcha'] = array(
								 'captcha_time' => $cap['time'],
								 'ip_address' => $this->input->ip_address(),
								 'word' => $cap['word']
								 );
								 //print_r($data['captcha']);die;
							
							$query = $this->db->insert_string('captcha', $data['captcha']);
							$this->db->query($query);	 
							  $data['provinces']=$this->user_model->get_state_list();
							  $province=set_value('province');
							  $data['city']=$this->user_model->get_city($province);
							  $data['captcha_err']= $this->lang->line('reg_agency_you_submit_wrong_captcha');
							  $data['cap_img']=$cap['image'];
							  $this->load->view('site/users/reg_agency',$data);
						/*
						
						 $this->session->set_flashdata('captcha_err', 'You submit a wrong captcha');
						 redirect('user/reg_agency');*/
						
					}
				  
				 
				  else{
				   		$new_user=array();
						$access_token=access_token();
						$new_user['user_type'] ='3';
						$new_user['user_name'] =$this->input->post('user_name');
						$new_user['company_name'] = $this->input->post('company_name');
						$new_user['business_name'] = $this->input->post('business_name');
						$new_user['vat_number'] = $this->input->post('vat_number');
						$new_user['first_name'] = $this->input->post('first_name');
						$new_user['last_name'] = $this->input->post('last_name');
						$new_user['contact_ph_no'] = $this->input->post('contact_ph_no');
						$new_user['province'] = $this->input->post('province');
						$new_user['city'] = $this->input->post('city');
						$new_user['street_address'] = $this->input->post('street_address');
						$new_user['street_no'] = $this->input->post('street_no');
						$new_user['zip'] = $this->input->post('zip');
						$new_user['phone_1'] = $this->input->post('phone_1');
						$new_user['phone_2'] = $this->input->post('phone_2');
						$new_user['fax_no'] = $this->input->post('fax_no');
						$new_user['website'] = $this->input->post('website');
						$new_user['email_id'] = $this->input->post('email');
						$new_user['password'] = $this->generate_password_string($access_token,$this->input->post('password'));
						$new_user['gender'] = $this->input->post('gender');
						$new_user['access_token'] 	= $access_token ;
						$new_user['agree_terms'] = $this->input->post('agree_terms');
						$new_user['receive_mail'] = $this->input->post('receive_mail');
						$this->session->set_userdata($new_user);
						$ym=$this->session->all_userdata();
						//echo '<pre>';print_r($ym);die;
						redirect('users/agency_edit');
						
						/*$rs=$this->user_model->insert_user( $new_user );
						if($rs)
						{
							$email=get_perticular_field_value('zc_user','email_id'," and user_id='".$rs."'");
							$user_name=get_perticular_field_value('zc_user','first_name'," and user_id='".$rs."'").' '.get_perticular_field_value('zc_user','last_name'," and user_id='".$rs."'");
							$passwrd=get_perticular_field_value('zc_user','password'," and user_id='".$rs."'");
							$link=base_url().'user/acctivation/'.$rs.'/'.$passwrd;
							$details=array();
							$details['from']="biswabijoymukherji@rediffmail.com";
							$details['to']=$email;
							$details['subject']="Congratulation";
							$details['message']="Welcome  ".$user_name.",<br/> To activate your account please click on the following Link <br/>  <strong> ".$link."</strong>";
							send_mail($details);
							redirect('user/thanksagency');
						}*/
				  		
				  }
			  
			  }
		}
		else
		{
			$captcha_lib=base_url().'/captcha/';
				
				$this->load->helper('captcha');
				$captcha_path=base_url();
			  $vals = array(
				 'img_path' => './captcha/',
				 'img_url' => $captcha_lib,
				 'img_width' => '280',
				 'img_height' => 80,
				 'expiration' => 7200 
				 
				 );
				  $cap = create_captcha($vals);
				  $data['captcha'] = array(
					 'captcha_time' => $cap['time'],
					 'ip_address' => $this->input->ip_address(),
					 'word' => $cap['word']
					 );
					 //print_r($data['captcha']);die;
				
				$query = $this->db->insert_string('captcha', $data['captcha']);
				$this->db->query($query);	 
				 // $this->session->set_userdata($data['captcha']);
				  $data['cap_img']=$cap['image'];
				  
					 $data['provinces']=$this->user_model->get_state_list();
					$this->load->view('site/users/reg_agency',$data);
		}
	
	}
	
	
	
	
			//////////////////////////////////////////////////////////////////////////////
	//////////////////////////for general  as Agency registration ends///////////////////////
	//////////////////////////////////////////////////////////////////////////////
	
	
	 private function generate_password_string($access_token, $raw_password )
    {
	    $divider = '_';
	    $raw_string = $access_token.$divider.$raw_password;
	    $encrypted_password = md5($raw_string);
	    
	    return $encrypted_password;
    }
	
	public function thanks()
	{
		$open_page_flag = $this->session->userdata('open_page_flag');
		if( isset( $open_page_flag ) && ( $open_page_flag == "yes" ) ) {
			$data['title']=$this->lang->line('user_registration_successfull_title');
			$data['msg']=$this->lang->line('user_your_account_successfully_created_msg');
			$data['before_activation']=1;
			$data['login_data']=1;
			
			$open_page_flag['open_page_flag'] = '';
			$this->session->set_userdata($open_page_flag);
			
			$open_page_flag = $this->session->userdata('open_page_flag');
			$this->load->view('site/users/thanks_user',$data);
		} else {
			redirect('/');
		}
	}
	public function thanksowner()
	{
		$open_page_flag = $this->session->userdata('open_page_flag');
		if( isset( $open_page_flag ) && ( $open_page_flag == "yes" ) ) {	
			$data['title']=$this->lang->line('user_registration_successfull_title');
			$data['msg']=$this->lang->line('user_your_account_successfully_created_msg');
			$data['before_activation']=1;
			$data['login_data']=1;
			
			$open_page_flag['open_page_flag'] = '';
			$this->session->set_userdata($open_page_flag);
			
			$this->load->view('site/users/thanksowner',$data);
		} else {
			redirect('/');
		}
	}
	public function thanksagency()
	{
		$open_page_flag = $this->session->userdata('open_page_flag');
		if( isset( $open_page_flag ) && ( $open_page_flag == "yes" ) ) {
			$data['title']=$this->lang->line('user_registration_successfull_title');
			$data['msg']=$this->lang->line('user_your_account_successfully_created_msg');
			$data['before_activation']=1;
			$data['login_data']=1;
			
			$open_page_flag['open_page_flag'] = '';
			$this->session->set_userdata($open_page_flag);
			
			$this->load->view('site/users/thanksagency',$data);
		} else {
			redirect('/');
		}
	}
	
	
	
	
	
	public function login() {
		$email = $this->input->post('email');
 		$raw_password = $this->input->post('password');
		$user_id=get_perticular_field_value('zc_user','user_id'," and email_id='".$email."' or user_name='".$email."'");
		$access_token=get_perticular_field_value('zc_user','access_token'," and email_id='".$email."' or user_name='".$email."'");
		$pwd=$this->generate_password_string( $access_token, $raw_password );
		$data['user_id'] 	= $user_id;
		$data['password'] 	= $pwd;
		$rs=get_perticular_count('zc_user'," and email_id='".$email."' or user_name='".$email."' and password='".$pwd."' and status='1'");
		//echo '<pre>';print_r($data);die;
		if($rs==1)
		{
			$user_info=$this->user_model->check_login($data);
			if( count( $user_info ) > 0 ) {
				$this->session->set_userdata('user_id',$user_info[0]['user_id']);
				echo 1;
			} else {
				echo 0;
			}	
		}
		else
		{
			echo 0;
		}
		
	}
	
	
	public function logout(){
	$this->do_logout();
    }
    
    private function do_logout()
	{
		$this->session->set_userdata('user_id',0);
		$this->session->set_userdata('session_id',0);
		
		$this->session->sess_destroy();
		redirect('/');
		
	}
	
	
	
	/////////////////////for genral logout///////////////////////////////
	
	////////////generate password//////////////
	public function forget_password()
	{
		//echo $pwd=get_random_password();
		$this->load->view('site/users/forgot_password');
		
		
	}
	public function change_pwd()
	{
		$email = $this->input->post('email');
		$user_id=get_perticular_field_value('zc_user','user_id'," and email_id='".$email."'");
		if($user_id!='')
		{
		$raw_password=get_random_password();
		$access_token=get_perticular_field_value('zc_user','access_token'," and email_id='".$email."'");
		$pwd=$this->generate_password_string( $access_token, $raw_password );
		$rs=$this->user_model->change_pwd($user_id,$pwd);
		
		//redirect('/');
		$user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$user_id."'");
		if($user_type==3)
		{
			$user_name=get_perticular_field_value('zc_user','company_name'," and user_id='".$user_id."'");
		}
		else
		{
		$user_name=get_perticular_field_value('zc_user','first_name'," and user_id='".$user_id."'").' '.get_perticular_field_value('zc_user','last_name'," and user_id='".$user_id."'");
		}
		$msg='<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">

<div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
	<div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
    <div style="border-bottom:1px solid #d1d1d1;">
    	<img src="'.base_url().'assets/images/logo.png" alt="ZapCasa"/>
    </div>
    <div style="padding:15px;">
    	<strong>'.$this->lang->line('change-pwd-hi').' '.$user_name.'</strong>
        <p>'.$this->lang->line('change-pwd-text-1').'</p>
        <p><strong>'.$this->lang->line('change-pwd-note').':</strong> '.$this->lang->line('change-pwd-text-2').' </p>
        <p><strong>'.$this->lang->line('change-pwd-text-3').'</strong> '.$this->lang->line('change-pwd-text-4').'.</p>
        <p><strong>'.$this->lang->line('change-pwd-text-5').'</strong> '.$raw_password.'</p><br>
        <p>'.$this->lang->line('change-pwd-text-6').',<br>www.zapcasa.it</p>
    </div>
</div>

</body>';
		
		$details=array();
		$default_email = get_perticular_field_value('zc_settings','meta_value'," and meta_name='default_email'");
		//$details['from']= isset($default_email) ? $default_email : "no-reply@zapcasa.it";
		$details['from']= "no-reply@zapcasa.it";
		$details['to']=$email;
		$details['subject']=$this->lang->line('change-pwd-subject');
		/*$details['message']="Hi  ".$user_name.",<br/> Your New Password for the site is <br/>  <strong> ".$raw_password."</strong>";*/
		$details['message']=$msg;
		//echo '<pr>';print_r($details);die;
		send_mail($details);
		$this->session->set_flashdata('success', '1');
		redirect('users/forget_password');
		}
		else
		{
			$this->session->set_flashdata('error', '1');
			redirect('users/forget_password');
		}
		
	}
	public function acctivation()
	{
		$access_token=$this->uri->segment('4');
		$uid=$this->uri->segment('3');
		$user_cnt=get_perticular_count('zc_user'," and user_id='".$uid."'");
		if($user_cnt!=0)
		{
		$verified_not=get_perticular_field_value('zc_user','verified'," and user_id='".$uid."'");
		if($verified_not==0)
		{
			$rs=$this->user_model->activate_user($access_token,$uid);
			if($rs)
			{
				$this->session->set_userdata('reg_id',$uid);
				//redirect('/');
				$user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$uid."'");
				/////////////////new entry//////////////////
				$new_email_not=get_perticular_field_value('zc_user','receive_mail'," and user_id='".$uid."'");
				$rs_new_preferenc=$this->user_model->new_preference($uid,$new_email_not);
				
				////////////////new entry///////////////////////////
				if($user_type==1)
				{
					$data['title']=$this->lang->line('user_activation_successfull_msg');
					$this->load->view('site/users/thanks_useract',$data);
				}
				if($user_type==2)
				{
					$data['title']=$this->lang->line('user_activation_successfull_msg');
					$this->load->view('site/users/thanksowneract',$data);
				}
				if($user_type==3)
				{
					$data['title']=$this->lang->line('user_activation_successfull_msg');
					$this->load->view('site/users/thanksagencyact',$data);
				}
			}
			
		}
	
		else
		{
			$user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$uid."'");
				if($user_type==1)
				{
					$data['title']=$this->lang->line('user_activation_successfull_msg');
					$this->load->view('site/users/thanks_useract_alredy',$data);
				}
				if($user_type==2)
				{
					$data['title']=$this->lang->line('user_activation_successfull_msg');
					$this->load->view('site/users/thanksowneract_alredy',$data);
				}
				if($user_type==3)
				{
					$data['title']=$this->lang->line('user_activation_successfull_msg');
					$this->load->view('site/users/thanksagencyact_alredy',$data);
				}
		}
		}
		else
		{
			$data['title']="Activation unSuccessfull";
					$this->load->view('site/users/thanksagencyact_fail',$data);
		}
	}
	
	public function getStateByCountryCode()
	{
		
		$country_id = $this->input->post('country');
		$country_sort=get_perticular_field_value('zc_country_master','iso_alpha2'," and id_countries='".$country_id."'");
		$rs=$this->user_model->get_state_list($country_sort);
		
		$country='';
		if(!empty($rs))
		{
			$country .= '<option value="">'.$this->lang->line('user_please_select_your_province').'</option>';
			foreach( $rs as $val )
			{
				$country .= '<option value="'.$val['ID'].'">'.$val['name'].'</option>';
			}
		
			
		}
		else
		{
			$country .= '<option value="">'.$this->lang->line('user_please_select_your_province').'</option>';
		}
		echo $country;
		
	}
	
	////////////////////user edit page///////////////////////
	
	function check_email_avail()
	{
		$email_id=$this->input->post('email');
		if($email_id=='')
		{
			echo '2';
			exit;
		}
		else
		{
		$user_list_cnt=get_perticular_count('zc_user'," and email_id='".$email_id."' and status='1'");
		echo $user_list_cnt;
		exit;
		}
	}
	function check_user_avail()
	{
		$user_name=$this->input->post('user_name');
		$user_list_cnt=get_perticular_count('zc_user'," and user_name='".$user_name."' and status='1'");
		echo $user_list_cnt;
		exit;
	}
	
	
	
	function user_edit()
	{
		$data['countries']=$this->user_model->get_country();
		$data['title']="user edit";
		$this->load->view('site/users/user_edit',$data);
	}
	
	function confirm_individual_reg() {
		$new_user=array();
		$new_arr=$this->session->all_userdata();
		if( isset($new_arr) && ($new_arr['access_token'] == "" ) ) {
			redirect('/');
		}
		$new_user['user_type'] ='1';
		$new_user['user_name']= $this->input->post('user_name');
		$new_user['first_name'] = $this->input->post('first_name');
		$new_user['last_name'] = $this->input->post('last_name');
		$new_user['contact_ph_no'] = $this->input->post('ph_no');
		$new_user['date_of_birth'] = $this->input->post('date_of_birth');
		$new_user['city'] = $this->input->post('city');
		$new_user['country'] = $this->input->post('country');
		$new_user['email_id'] = $this->input->post('email');
		$new_user['password'] = $new_arr['password'];
		$new_user['gender'] = $this->input->post('gender');
		$new_user['access_token'] 	= $new_arr['access_token'] ;
		$new_user['agree_terms'] = $new_arr['agree_terms'];
		$new_user['receive_mail'] = $new_arr['receive_mail'];
		//echo '<pre>';print_r($new_user);die;
		
		$rs=$this->user_model->insert_user( $new_user );
		if($rs)
		{
			$default_email = get_perticular_field_value('zc_settings','meta_value'," and meta_name='default_email'");
			
			$new_user['user_name'] ='';
			$new_user['first_name'] = '';
			$new_user['last_name'] = '';
			$new_user['contact_ph_no'] = '';
			$new_user['date_of_birth'] = '';
			$new_user['city'] = '';
			$new_user['country'] = '';
			$new_user['email_id'] = '';
			$new_user['password'] = '';
			$new_user['gender'] = '';
			$new_user['access_token'] 	='' ;
			$new_user['agree_terms'] ='';
			$new_user['receive_mail'] = '';
			
			$this->session->set_userdata($new_user);
			
			$open_page_flag['open_page_flag'] = 'yes';
			$this->session->set_userdata($open_page_flag);
			
			$email=get_perticular_field_value('zc_user','email_id'," and user_id='".$rs."'");
			$user_name=get_perticular_field_value('zc_user','first_name'," and user_id='".$rs."'").' '.get_perticular_field_value('zc_user','last_name'," and user_id='".$rs."'");
			$passwrd=get_perticular_field_value('zc_user','password'," and user_id='".$rs."'");
			$link=base_url().'users/acctivation/'.$rs.'/'.$passwrd;
			$details=array();
			$details['from']= isset($default_email) ? $default_email : "no-reply@zapcasa.it";
			$details['to']=$email;
			$details['subject']= $this->lang->line('thanks_text_subject');
			//$contentMsg = "<strong>Hi  ".$user_name.",</strong> <br/> <br/>You are receiving this email because you have requested to register on Zapcasa.it <br/> <br/><strong>Note: </strong>If you did not to apply for registration then do nothing, your email will be automatically deleted within 72 hours. <br/><br/>  To activate your ZapCasa account, please click on the following link or copy and paste it into your browser: <br/> <strong> ".$link."</strong> <br/><br/>Regards,<br/><strong> www.zapcasa.it</strong>";
			$msg='<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">
			
				<div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
					<div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
				    <div style="border-bottom:1px solid #d1d1d1;">
				    	<img src="'.base_url().'assets/images/logo.png" alt="ZapCasa"/>
				    </div>
				    <div style="padding:15px;">
				    	<strong>'.$this->lang->line('thanks_hi').' '.$user_name.'</strong>
				        <p>'.$this->lang->line('thanks_text_1').'</p>
				        <p><strong>'.$this->lang->line('thanks_text_note').':</strong> '.$this->lang->line('thanks_text_2').'. </p>
				        <p> '.$this->lang->line('thanks_text_3').': </p>
				        <p><strong> '.$link.'</strong></p><br>
				        <p>'.$this->lang->line('thanks_text_4').',<br>www.zapcasa.it</p>
				    </div>
				</div>
							
				</body>';
			$details['message']= $msg;
			send_mail($details);
			$url='users/thanks/'.$rs;
			redirect($url);
			//redirect('user/thanks/$rs');
		}
		
	}
	
	function edit_user_reg() {
		$data['title']="user edit";
		$this->load->view('site/users/user_edit_reg');
	}
	
	///////////////////////registration as owner/////////////////////////////////
	function city_search()
	{
		$province=$this->input->post('name');
		$rs=$this->user_model->get_city($province);
		//echo '<pre>';print_r($rs);die;
		if($rs)
		{
			foreach($rs as $key=>$val)
			{
				echo "<option value='".$val."'>".$val."</option>";
			}
		}
	}
	
	///////////////////owner edit/////////////////////////
	
	function owner_edit()
	{
		$new_user=array();
		$new_arr=$this->session->all_userdata();
		if( isset($new_arr) && ($new_arr['access_token'] == "" ) ) {
			redirect('/');
		}
		$data['provinces']=$this->user_model->get_state_list();
		$data['city']=$this->user_model->get_city($new_arr['province']);
		$data['title']="owner_edit";
		$this->load->view('site/users/owner_edit',$data);
	}
	
	function confirm_owner_reg()
	{
					//echo 'ffffffffffffff';die;
						
						
						$new_user=array();
						$new_arr=$this->session->all_userdata();
						$new_user['user_type'] ='2';
						$new_user['user_name'] =$this->input->post('user_name');
						$new_user['first_name'] = $this->input->post('first_name');
						$new_user['last_name'] = $this->input->post('last_name');
						$new_user['social_secuirity_number'] = $this->input->post('social_secuirity_number');
						$new_user['date_of_birth'] = $this->input->post('date_of_birth');
						$new_user['city'] = $this->input->post('city');
						$new_user['province'] = $this->input->post('province');
						$new_user['street_address'] = $this->input->post('street_address');
						$new_user['street_no'] = $this->input->post('street_no');
						$new_user['zip'] = $this->input->post('zip');
						$new_user['phone_1'] = $this->input->post('phone_1');
						$new_user['phone_2'] = $this->input->post('phone_2');
						$new_user['email_id'] = $this->input->post('email');
						$new_user['password'] = $new_arr['password'];
						$new_user['access_token'] 	= $new_arr['access_token'] ;
						$new_user['agree_terms'] = $new_arr['agree_terms'];
						$new_user['receive_mail'] = $new_arr['receive_mail'];
						//$new_user['about_me'] = $this->input->post('about_me');
						//echo '<pre>';print_r($new_user);die;
						//$file=$_FILES;
						//echo '<pre>';print_r($file);die;
						
						$rs=$this->user_model->insert_user( $new_user );
						//$this->upload_image_1('user_file_1',$rs);
						//$this->upload_image_2('user_file_2',$rs);
						
						if($rs)
						{
						$new_user['user_name'] ='';
						$new_user['first_name'] = '';
						$new_user['last_name'] = '';
						$new_user['social_secuirity_number'] = '';
						$new_user['date_of_birth'] = '';
						$new_user['city'] = '';
						$new_user['province'] = '';
						$new_user['street_address'] = '';
						$new_user['street_no'] = '';
						$new_user['zip'] = '';
						$new_user['phone_1'] = '';
						$new_user['phone_2'] = '';
						$new_user['email_id'] = '';
						$new_user['password'] = '';
						$new_user['access_token'] 	= '' ;
						$new_user['agree_terms'] = '';
						$new_user['receive_mail'] = '';
							
							$this->session->set_userdata($new_user);
							
							$open_page_flag['open_page_flag'] = 'yes';
							$this->session->set_userdata($open_page_flag);
							
							$email=get_perticular_field_value('zc_user','email_id'," and user_id='".$rs."'");
							$user_name=get_perticular_field_value('zc_user','first_name'," and user_id='".$rs."'").' '.get_perticular_field_value('zc_user','last_name'," and user_id='".$rs."'");
							$passwrd=get_perticular_field_value('zc_user','password'," and user_id='".$rs."'");
							$link=base_url().'users/acctivation/'.$rs.'/'.$passwrd;
							$details=array();
							$default_email = get_perticular_field_value('zc_settings','meta_value'," and meta_name='default_email'");
							$details['from']= isset($default_email) ? $default_email : "no-reply@zapcasa.it";
							$details['to']=$email;
							$details['subject'] = $this->lang->line('thanks_owner_subject');
							//$details['message']="<strong>Hi  ".$user_name.",</strong> <br/> <br/>You are receiving this email because you have requested to register on Zapcasa.it <br/> <br/><strong>Note: </strong>If you did not to apply for registration then do nothing, your email will be automatically deleted within 72 hours. <br/><br/>  To activate your ZapCasa account, please click on the following link or copy and paste it into your browser: <br/> <strong> ".$link."</strong> <br/><br/>Regards,<br/><strong> www.zapcasa.it</strong>";
							//$details['message']="Welcome  ".$user_name.",<br/> To activate your account please click on the following Link <br/>  <strong> ".$link."</strong>";
							$msg='<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">
									<div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
										<div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
									    <div style="border-bottom:1px solid #d1d1d1;">
									    	<img src="'.base_url().'assets/images/logo.png" alt="ZapCasa"/>
									    </div>
									    <div style="padding:15px;">
									    	<strong>'.$this->lang->line('thanks_owner_hi').' '.$user_name.'</strong>
									        <p>'.$this->lang->line('thanks_owner_text_1').'</p>
									        <p><strong>'.$this->lang->line('thanks_owner_note').':</strong> '.$this->lang->line('thanks_owner_text_2').' </p>
									        <p> '.$this->lang->line('thanks_owner_text_3').': </p>
									        <p><strong> '.$link.'</strong></p><br>
									        <p>'.$this->lang->line('thanks_owner_text_4').',<br>www.zapcasa.it</p>
									    </div>
									</div>
									
									</body>';
							$details['message']= $msg;
							send_mail($details);
							$url='users/thanksowner/'.$rs;
							redirect($url);
							//redirect('user/thanksowner/$rs');
						}
		
	}
	////////////////////owner edit ends////////////////////////////////////////

	
	function upload_image_1($form_field_name,$uid)
	{
	
		$config['upload_path'] = './assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|PNG|jpeg|GIF';
		$config['encrypt_name']=TRUE;
	
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload($form_field_name))
		{
					$errors = $this->upload->display_errors();
                    
		}
		else
		{
			////////////////delete image first////////////////////
					$uid=$this->session->userdata( 'user_id' );
					$dfile_name=get_perticular_field_value('zc_user','file_1'," and user_id='".$uid."'");
					$dfile='assets/uploads/'.$dfile_name;
					 if(is_file($dfile))
					 @unlink($dfile);
					$dfile_thmb='assets/uploads/thumb_92_82/'.$dfile_name;
					 if(is_file($dfile_thmb))
					 @unlink($dfile_thmb);
					
					
					/////////////delete image end//////////////////////////
					
			$upload_data = $this->upload->data(); 
			$file_names =   $upload_data['file_name'];
			$rs_update=$this->user_model->update_profile_1($file_names,$uid);
			 $config = array(
			'source_image'      => $upload_data['full_path'], //path to the uploaded image
			'new_image'         => "assets/uploads/thumb_92_82/".$file_names, //path to
			'maintain_ratio'    => true,
			'quality'   			 => 85,
			'master_dim'         => 'auto',
			'width'             => 128,
			'height'            => 128
			);
			
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			
		   
		}
	}
	function upload_image_2($form_field_name,$uid)
	{
	
		
		$config['upload_path'] = './assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|PNG|jpeg|GIF';
		$config['encrypt_name']=TRUE;
		$this->load->library('upload', $config);
		
	
		if ( ! $this->upload->do_upload($form_field_name))
		{
					$errors = $this->upload->display_errors();
                    
		}
		else
		{
					////////////////delete image first////////////////////
					$uid=$this->session->userdata( 'user_id' );
					$dfile_name=get_perticular_field_value('zc_user','file_2'," and user_id='".$uid."'");
					$dfile='assets/uploads/'.$dfile_name;
					 if(is_file($dfile))
					 @unlink($dfile);
					$dfile_thmb='assets/uploads/thumb_92_82/'.$dfile_name;
					 if(is_file($dfile_thmb))
					 @unlink($dfile_thmb);
					
					
					/////////////delete image end//////////////////////////
					$upload_data = $this->upload->data(); 
					$file_names =   $upload_data['file_name'];
					$rs_update=$this->user_model->update_profile_2($file_names,$uid);
					 $config = array(
					'source_image'      => $upload_data['full_path'], //path to the uploaded image
					'new_image'         => "assets/uploads/thumb_92_82/".$file_names, //path to
					'maintain_ratio'	     => true,
					'quality'   			 => '90%',
					'master_dim'         => 'auto',
					'width'             => 128,
					'height'            => 128
					);
					
					$this->image_lib->initialize($config);
					$this->image_lib->resize();

		   
		}
	}
	
	
	function agency_edit()
	{
		$new_user=array();
		$new_arr=$this->session->all_userdata();
		if( isset($new_arr) && ($new_arr['access_token'] == "" ) ) {
			redirect('/');
		}
		$data['provinces']=$this->user_model->get_state_list();
		$data['city']=$this->user_model->get_city($new_arr['province']);
		$data['title']="agency_edit";
		$this->load->view('site/users/agency_edit',$data);
	}
	
	function confirm_agency_reg()
	{
					//echo 'ffffffffffffff';die;
                                                $new_user=array();
						$new_arr=$this->session->all_userdata();
						$new_user['user_type'] ='3';
						$new_user['user_name'] =$this->input->post('user_name');
						$new_user['company_name'] =$this->input->post('company_name');
						$new_user['business_name'] =$this->input->post('business_name');
						$new_user['vat_number'] = $this->input->post('vat_number');
						$new_user['first_name'] = $this->input->post('first_name');
						$new_user['last_name'] = $this->input->post('last_name');
						$new_user['contact_ph_no'] = $this->input->post('contact_ph_no');
						$new_user['province'] = $this->input->post('province');
						$new_user['city'] = $this->input->post('city');
						$new_user['street_address'] = $this->input->post('street_address');
						$new_user['street_no'] = $this->input->post('street_no');
						$new_user['zip'] = $this->input->post('zip');
						$new_user['phone_1'] = $this->input->post('phone_1');
						$new_user['phone_2'] = $this->input->post('phone_2');
						$new_user['fax_no'] = $this->input->post('fax_no');
						$new_user['website'] = $this->input->post('website');
						$new_user['email_id'] = $this->input->post('email');
						$new_user['password'] = $new_arr['password'];
						$new_user['access_token'] 	= $new_arr['access_token'] ;
						$new_user['agree_terms'] = $new_arr['agree_terms'];
						$new_user['receive_mail'] = $new_arr['receive_mail'];
						//$new_user['about_me'] = $this->input->post('about_me');
						
						//echo '<pre>';print_r($new_user);die;
						//$file=$_FILES;
						//echo '<pre>';print_r($file);die;
						
						$rs=$this->user_model->insert_user( $new_user );
						/*$this->upload_image_1('user_file_1',$rs);
						$this->upload_image_2('user_file_2',$rs);*/
						
						if($rs)
						{
						$new_user['user_type'] ='';
						$new_user['user_name'] ='';
						$new_user['company_name'] = '';
						$new_user['business_name'] = '';
						$new_user['vat_number'] = '';
						$new_user['first_name'] = '';
						$new_user['last_name'] = '';
						$new_user['contact_ph_no'] = '';
						$new_user['province'] = '';
						$new_user['city'] = '';
						$new_user['street_address'] = '';
						$new_user['street_no'] = '';
						$new_user['zip'] = '';
						$new_user['phone_1'] = '';
						$new_user['phone_2'] = '';
						$new_user['fax_no'] = '';
						$new_user['website'] ='';
						$new_user['email_id'] ='';
						$new_user['password'] = '';
						$new_user['access_token'] 	= '' ;
						$new_user['agree_terms'] = '';
						$new_user['receive_mail'] = '';
						$new_user['about_me'] = '';
							
							$this->session->set_userdata($new_user);
							
							$open_page_flag['open_page_flag'] = 'yes';
							$this->session->set_userdata($open_page_flag);
							
							$email=get_perticular_field_value('zc_user','email_id'," and user_id='".$rs."'");
							$user_name=get_perticular_field_value('zc_user','first_name'," and user_id='".$rs."'").' '.get_perticular_field_value('zc_user','last_name'," and user_id='".$rs."'");
							$passwrd=get_perticular_field_value('zc_user','password'," and user_id='".$rs."'");
							$link=base_url().'users/acctivation/'.$rs.'/'.$passwrd;
							$details=array();
							$default_email = get_perticular_field_value('zc_settings','meta_value'," and meta_name='default_email'");
							$details['from']= isset($default_email) ? $default_email : "no-reply@zapcasa.it";
							$details['to']=$email;
							$details['subject']=$this->lang->line('thanks_agency_subject');
							//$details['message']="<strong>Hi  ".$user_name.",</strong> <br/> <br/>You are receiving this email because you have requested to register on Zapcasa.it <br/> <br/><strong>Note: </strong>If you did not to apply for registration then do nothing, your email will be automatically deleted within 72 hours. <br/><br/>  To activate your ZapCasa account, please click on the following link or copy and paste it into your browser: <br/> <strong> ".$link."</strong> <br/><br/>Regards,<br/><strong> www.zapcasa.it</strong>";
							//$details['message']="Welcome  ".$user_name.",<br/> To activate your account please click on the following Link <br/>  <strong> ".$link."</strong>";
							$msg='<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">
		
									<div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
										<div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
									    <div style="border-bottom:1px solid #d1d1d1;">
									    	<img src="'.base_url().'assets/images/logo.png" alt="ZapCasa"/>
									    </div>
									    <div style="padding:15px;">
									    	<strong>'.$this->lang->line('thanks_agency_hi').' '.$user_name.'</strong>
									        <p>'.$this->lang->line('thanks_agency_text_1').'</p>
									        <p><strong>'.$this->lang->line('thanks_agency_note').':</strong> '.$this->lang->line('thanks_agency_text_2').' </p>
									        <p> '.$this->lang->line('thanks_agency_text_3').': </p>
									        <p><strong> '.$link.'</strong></p><br>
									        <p>'.$this->lang->line('thanks_agency_text_4').',<br>www.zapcasa.it</p>
									    </div>
									</div>
								
								</body>';
							$details['message']= $msg;
							send_mail($details);
							$url='users/thanksagency/'.$rs;
							redirect($url);
						}
		
	}
	
//////////////////////////////view page of user////////////////////////////////////////////////////////////
function user_profile()
{
	$reg_id=$this->uri->segment('3');
	$this->session->set_userdata('reg_id','');
	$data['user_detail']=$this->user_model->user_profile($reg_id);
	//echo '<pre>';print_r($data['user_detail']);die;
	$data['countries']=$this->user_model->get_country();
	$data['title']="agency_edit";
	$this->load->view('site/users/user_profile',$data);
	
}
function owner_profile()
{
	$reg_id=$this->uri->segment('3');
	$this->session->set_userdata('reg_id','');
	$data['user_detail']=$this->user_model->user_profile($reg_id);
	//echo '<pre>';print_r($data['user_detail']);die;
	$data['countries']=$this->user_model->get_country();
	$data['title']="agency_edit";
	$this->load->view('site/users/owner_profile',$data);
	
}
function agency_profile()
{
	$reg_id=$this->uri->segment('3');
	$this->session->set_userdata('reg_id','');
	$data['user_detail']=$this->user_model->user_profile($reg_id);
	//echo '<pre>';print_r($data['user_detail']);die;
	$data['countries']=$this->user_model->get_country();
	$data['title']="agency_edit";
	$this->load->view('site/users/agency_profile',$data);
	
}



//////////////////////////////view page of owner////////////////////////////////////////////////////////////

//////////////////////////////view page of agency////////////////////////////////////////////////////////////	

function check_user_info()
{
	$data['title']="My Account";
	echo $uid=$this->uri->segment('3');
	$data['tab_icon']='1';
	$data['user_detail']=$this->user_model->user_profile($uid);
	$user_type=$data['user_detail'][0]['user_type'];
	$data['provinces']=$this->user_model->get_state_list();
	$data['city']=$this->user_model->get_city($data['user_detail'][0]['province']);
	$data['countries']=$this->user_model->get_country();
	if($user_type==1)
	{
		/////////////for general profile/////////////////////////////
		$this->load->view('site/users/user_profile',$data);	
	}
	if($user_type==2)
	{
		////////////////for owner profile//////////////////////////////
		$this->load->view('site/users/owner_profile',$data);
	}
	if($user_type==3)
	{
		///////////////for company/////////////////////////////////////
		$this->load->view('site/users/agency_profile',$data);
	}
	
}
//////////////user dash board///////////////////////////////////////////////////////////
function my_account()
{
	
	$data['title']="My Account";
	$uid=$this->session->userdata( 'user_id' );
	$data['tab_icon']='1';
	$data['user_detail']=$this->user_model->user_profile($uid);
	$user_type=$data['user_detail'][0]['user_type'];
	$data['provinces']=$this->user_model->get_state_list();
	$data['city']=$this->user_model->get_city($data['user_detail'][0]['province']);
	$data['countries']=$this->user_model->get_country();
	if($user_type==1)
	{
		/////////////for general profile/////////////////////////////
		$this->load->view('site/users/user_profile',$data);	
	}
	elseif($user_type==2)
	{
		////////////////for owner profile//////////////////////////////
		$this->load->view('site/users/owner_profile',$data);
	}
	elseif($user_type==3)
	{
		///////////////for company/////////////////////////////////////
		$this->load->view('site/users/agency_profile',$data);
	}else {
		redirect('/');
	}
	
	//$this->load->view('site/user/my_account',$data);
	
}

function check_email_avail_after_reg()
	{
		$uid=$this->session->userdata( 'user_id' );
		$email_id=$this->input->post('email');
		$email_ids=get_perticular_field_value('zc_user','email_id'," and user_id='".$uid."'");
		if($email_id==$email_ids)
		{
			echo 2;
			exit;
		}
		else
		{
		$user_list_cnt=get_perticular_count('zc_user'," and email_id='".$email_id."' and status='1'");
		echo $user_list_cnt;
		exit;
		}
	}

function update_owner_reg()
{
	
						$uid=$this->session->userdata( 'user_id' );
						$new_user['city'] = $this->input->post('city');
						$new_user['province'] = $this->input->post('province');
						$new_user['street_address'] = $this->input->post('street_address');
						$new_user['street_no'] = $this->input->post('street_no');
						$new_user['zip'] = $this->input->post('zip');
						$new_user['phone_1'] = $this->input->post('phone_1');
						$new_user['phone_2'] = $this->input->post('phone_2');
						$new_user['email_id'] = $this->input->post('email');
						$new_user['about_me'] = mysql_real_escape_string($this->input->post('about_me'));
						//echo '<pre>';print_r($new_user);die;
						//$file=$_FILES;
						//echo '<pre>';print_r($file);die;
						
						$rs=$this->user_model->upadte_owner( $new_user,$uid );
						$this->upload_image_1('user_file_1',$uid);
						$this->upload_image_2('user_file_2',$uid);
						$msg = $this->lang->line('user_info_success_message');
						$this->session->set_flashdata('success', $msg);
						redirect('users/my_account');
}

function update_user_reg()
{
						$uid=$this->session->userdata( 'user_id' );
						$new_user['first_name'] = $this->input->post('first_name');
						$new_user['last_name'] = $this->input->post('last_name');
						$new_user['contact_ph_no'] = $this->input->post('ph_no');
						$new_user['date_of_birth'] = $this->input->post('date_of_birth');
						$new_user['city'] = $this->input->post('city');
						$new_user['country'] = $this->input->post('country');
						$new_user['email_id'] = $this->input->post('email');
						$rs=$this->user_model->upadte_user( $new_user,$uid );
						$msg = $this->lang->line('user_info_success_message');
						$this->session->set_flashdata('success', $msg);
						redirect('users/my_account');
}
	
	
function update_agency_reg()
{
						$uid=$this->session->userdata( 'user_id' );
						$new_user['first_name'] = $this->input->post('first_name');
						$new_user['last_name'] = $this->input->post('last_name');
						$new_user['contact_ph_no'] = $this->input->post('contact_ph_no');
						$new_user['province'] = $this->input->post('province');
						$new_user['city'] = $this->input->post('city');
						$new_user['street_address'] = $this->input->post('street_address');
						$new_user['street_no'] = $this->input->post('street_no');
						$new_user['zip'] = $this->input->post('zip');
						$new_user['phone_1'] = $this->input->post('phone_1');
						$new_user['phone_2'] = $this->input->post('phone_2');
						$new_user['fax_no'] = $this->input->post('fax_no');
						$new_user['website'] = $this->input->post('website');
						$new_user['email_id'] = $this->input->post('email');
						$new_user['about_me'] = mysql_real_escape_string($this->input->post('about_me'));
						//echo '<pre>';print_r($new_user);die;
						//$file=$_FILES;
						//echo '<pre>';print_r($file);die;
						
						$rs=$this->user_model->upadte_agency( $new_user,$uid );
						$this->upload_image_1('user_file_1',$uid);
						$this->upload_image_2('user_file_2',$uid);
						$msg = $this->lang->line('user_info_success_message');
						$this->session->set_flashdata('success', $msg);
						redirect('users/my_account');
}	


////////////////function remove the images//////////////////////////////

function remove1()
{
	$uid=$this->session->userdata( 'user_id' );
	$file_name=get_perticular_field_value('zc_user','file_1'," and user_id='".$uid."'");
	$file='assets/uploads/'.$file_name;
	 if(is_file($file))
	 @unlink($file);
	$file_thmb='assets/uploads/thumb_92_82/'.$file_name;
	 if(is_file($file_thmb))
	 @unlink($file_thmb);
	 $this->user_model->delete_img($uid,$file='1'); 
	 
	redirect('users/my_account');
}
function remove2()
{
	$uid=$this->session->userdata( 'user_id' );
	$file_name=get_perticular_field_value('zc_user','file_2'," and user_id='".$uid."'");
	$file='assets/uploads/'.$file_name;
	 if(is_file($file))
	 @unlink($file);
	$file_thmb='assets/uploads/thumb_92_82/'.$file_name;
	 if(is_file($file_thmb))
	 @unlink($file_thmb);
	 $this->user_model->delete_img($uid,$file='2'); 
	 
	redirect('users/my_account');
}

/////////////////change_password////////////////////

function change_password()
{
	$data['title']="change_password";
	if($this->input->post('submit')!='')
	{
		$uid=$this->session->userdata( 'user_id' );
		$access_token=get_perticular_field_value('zc_user','access_token'," and user_id='".$uid."'");
		$password = $this->generate_password_string($access_token,$this->input->post('password'));
		$this->user_model->change_password($uid,$password);
		$msg = $this->lang->line('changed_password_success_message');
		$this->session->set_flashdata('success', $msg);
		redirect('users/change_password');
	}
	else
	{
		
		$this->load->view('site/users/change_password',$data);
		
	}
}

function check_ssn_avail()
{
	$ssn=$this->input->post('ssn');
		if($ssn=='')
		{
			echo '2';
			exit;
		}
		else
		{
		$user_list_cnt=get_perticular_count('zc_user'," and social_secuirity_number='".$ssn."' and status='1'");
		echo $user_list_cnt;
		exit;
		}
}


function check_vat_avail()
{
	$vat_no=$this->input->post('vat_no');
		if($vat_no=='')
		{
			echo '2';
			exit;
		}
		else
		{
		$user_list_cnt=get_perticular_count('zc_user'," and vat_number='".$vat_no."' and status='1'");
		echo $user_list_cnt;
		exit;
		}
}

function delete_account()
{
	$this->load->view('site/users/delete_acc');
}

function del_acc()
{
	$rs=$this->user_model->del_acc();
	if($rs)
	{
		$this->session->set_userdata('user_id',0);
		$this->session->set_userdata('session_id',0);
		
		$this->session->sess_destroy();

		$open_page_flag['open_page_flag'] = 'yes';
		$this->session->set_userdata($open_page_flag);
		
		$this->load->view('site/users/thanks_del');
	}
}

////////////////////////my preference//////////////////////////////////
function my_preference()
{
	$uid=$this->session->userdata( 'user_id' );
	if($uid==0 || $uid=='')
	{
		redirect('/');
	}
	else
	{
		/*if($this->input->post('submit')=='Submit')*/
		if($this->input->post('submit')!='')
		{
			//echo '<pre>';print_r($_POST);
			$new_data=array();
			$new_data['user_id']=$uid;
			if($this->input->post('send_me_email')!='')
			{
				$new_data['send_me_email']=$this->input->post('send_me_email');
			}
			if($this->input->post('reply_msg')!='')
			{
				$new_data['reply_msg']=$this->input->post('reply_msg');
			}
			if($this->input->post('email_alerts')!='')
			{
			$new_data['email_alerts']=$this->input->post('email_alerts');
			}
			if($this->input->post('newsletter')!='')
			{
			$new_data['newsletter']=$this->input->post('newsletter');
			}
			if($this->input->post('invisible')!='')
			{
			$new_data['invisible']=$this->input->post('invisible');
			}
			if($this->input->post('my_address_display')!='')
			{
			$new_data['my_address_display']=$this->input->post('my_address_display');
			}
			if($this->input->post('my_contact_info')!='')
			{
			$new_data['my_contact_info']=$this->input->post('my_contact_info');
			}
			$rs=$this->user_model->pref_info($new_data);
			if($rs)
			{
				$msg = $this->lang->line('contact_us_text_user_email');
				$this->session->set_flashdata('success', $msg);
				redirect('users/my_preference');
			}
		}
		else
		{
			$data['pref_info']=$this->user_model->get_pref_info();
			$this->load->view('site/users/preference',$data);
		}
	}
}

///////////////////for email alerts////////////////////////////////
function my_email_alerts()
{
	$this->load->view('site/users/email_alerts');
}

function checkMail(){
	$details=array();
	$details['from']=  "no-reply@zapcasa.it";
	$details['to']=$email;//'suvomita19@gmail.com';
	$details['subject']=$this->lang->line('check_mail_text_1');
	$user_name = "Suvomita  Das";
	$link = "www.google.com";
	$details['message']="<strong>Hi  ".$user_name.",</strong> <br/> <br/>You are receiving this email because you have requested to register on Zapcasa.it <br/> <br/><strong>Note: </strong>If you did not to apply for registration then do nothing, your email will be automatically deleted within 72 hours. <br/><br/>  To activate your ZapCasa account, please click on the following link or copy and paste it into your browser: <br/> <strong> ".$link."</strong> <br/><br/>Regards,<br/><strong> www.zapcasa.it</strong>";
	send_mail($details);
}



//===========================================================================
public function facebookLogin()
	{
		//print "<pre>";
		//print_r($_REQUEST);
		//die;
		if(isset($_REQUEST['email']))
		{
			$email = $_REQUEST['email'];	
			$fb_id = $_REQUEST['fb_id'];
			$birthday = $_REQUEST['birthday'];
			$gender = ucfirst(strtolower($_REQUEST['gender']));
			$first_name = $_REQUEST['first_name'];
			$last_name = $_REQUEST['last_name'];
			$pass = $_REQUEST['fb_id'];
			$access_token = access_token();
			$password = $this->generate_password_string($access_token, $pass);
			
			$chk_email = $this->user_model->pop_search("select * from zc_user where email_id = '".$email."'");
		
			if(count($chk_email) > 0)
			{
				$this->session->set_userdata('user_id',$chk_email[0]['user_id']);
				//redirect(base_url().'user/my_account');
				echo 1;
			}
			else
			{
				$qry = "insert into zc_user set email_id = '".$email."', first_name = '".$first_name."', last_name = '".$last_name."', password = '".$password."'";
				$rs = $this->user_model->insert_update($qry);
				
				$this->session->set_userdata('user_id',$rs);
				
			   $user_id = $rs;
			   $email_user=get_perticular_field_value('zc_user','email_id'," and user_id='".$user_id."'");
			   $first_name=get_perticular_field_value('zc_user','first_name'," and user_id='".$user_id."'");
			   $last_name=get_perticular_field_value('zc_user','last_name'," and user_id='".$user_id."'");
			   
						    $details=array();
							$details['from']=  "no-reply@zapcasa.it";
							$details['to'] = /*$*/$email;
							$details['subject'] = $this->lang->line('social_login_mail_subject');
							$link = '';
							$details['message'] = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">
						 <div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
						  <div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
							 <div style="border-bottom:1px solid #d1d1d1;">
							  <img src="'.base_url().'assets/images/logo.png" alt="ZapCasa"/>
							 </div>
							 <div style="padding:15px;">
							  <strong>'.$this->lang->line('new_mail-hi').' '.$first_name." ".$last_name.'</strong>
								 <p>'.$this->lang->line('social_login_mail_content').': </p>
								 <p>'.$pass.'</p>
								
								 <p><br>www.zapcasa.it</p>
							 </div>
						 </div>
							  
						 </body>';
						 
						 	//if( send_mail($details) )
 							//{
								echo 1; 
 							//}
			}
			
		}else{
			$email = '';	
			$fb_id = '';	
			$birthday = '';	
			$gender = '';	
			$first_name = '';	
			$last_name = '';	
			//redirect('/');
			echo 2;
		}
		
		
		
	}
//===========================================================================
//===========================================================================
public function google()
	{

	$google_client_id 		= '486148900452-hji9n8dt4ag1tnp4d15mkn96i4immnk2.apps.googleusercontent.com';
	$google_client_secret 	= 'jig6WKmBU7c-HXkhaUn_Es5B';
	$google_redirect_url 	=  base_url().'users/google';
	$google_developer_key 	= '486148900452-hji9n8dt4ag1tnp4d15mkn96i4immnk2@developer.gserviceaccount.com';
	
	require_once dirname(__FILE__).'/../../assets/src/Google_Client.php';
	require_once dirname(__FILE__).'/../../assets/src/contrib/Google_Oauth2Service.php';
	
	$gClient = new Google_Client();
	$gClient->setApplicationName('fds-login');
	$gClient->setClientId($google_client_id);
	$gClient->setClientSecret($google_client_secret);
	$gClient->setRedirectUri($google_redirect_url);
	$gClient->setDeveloperKey($google_developer_key);
	
	$google_oauthV2 = new Google_Oauth2Service($gClient);	
	$code = '';
	if(isset($_REQUEST['code']))
	{
		$code = trim($_REQUEST['code']);
	}
	$gClient->authenticate($code);
	$token = $gClient->getAccessToken();
		if ($gClient->getAccessToken()) 
		{
			  $user = $google_oauthV2->userinfo->get();
			
			  $id_google = $user['id'];
			  $email = $user['email'];
			  $first_name = $user['given_name'];
			  $last_name = $user['family_name'];
			  $username_array = explode('@', $email);
			  $username = $username_array[0];
			  $pass = $user['id'];
		
		
			   $access_token = access_token();
			   $password = $this->generate_password_string($access_token, $pass);
	
		
			$chk_email = $this->user_model->pop_search("select * from zc_user where email_id = '".$email."'");
		
			if(count($chk_email) > 0)
			{
				$user_id = $chk_email[0]['user_id'];
				$this->session->set_userdata('user_id',$user_id);				
				
				
			}
			else
			{
				$qry = "insert into zc_user set email_id = '".$email."', first_name = '".$first_name."', last_name = '".$last_name."', password = '".$password."'";
				$rs = $this->user_model->insert_update($qry);				
				$this->session->set_userdata('user_id',$rs);				
				
				
			   $user_id = $rs;
			   $email_user=get_perticular_field_value('zc_user','email_id'," and user_id='".$user_id."'");
			   $first_name=get_perticular_field_value('zc_user','first_name'," and user_id='".$user_id."'");
			   $last_name=get_perticular_field_value('zc_user','last_name'," and user_id='".$user_id."'");
			   
						    $details=array();
							$details['from']=  "no-reply@zapcasa.it";
							$details['to'] = $email;//"soumalya.arb@gmail.com";
							$details['subject'] = $this->lang->line('social_login_mail_subject');
							$link = '';
							$details['message'] = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">
						 <div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
						  <div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
							 <div style="border-bottom:1px solid #d1d1d1;">
							  <img src="'.base_url().'assets/images/logo.png" alt="ZapCasa"/>
							 </div>
							 <div style="padding:15px;">
							  <strong>'.$this->lang->line('new_mail-hi').' '.$first_name." ".$last_name.'</strong>
								 <p>'.$this->lang->line('social_login_mail_content').':</p>
								 <p>'.$pass.'</p>
								
								 <p><br>www.zapcasa.it</p>
							 </div>
						 </div>
							  
						 </body>';
						 
						 	//if( send_mail($details) )
 							//{
								redirect(base_url().'users/my_account');
 							//}
				
			}
			
		}else{
			  $id_google = "";
			  $email = "";
			  $first_name = "";
			  $last_name = "";
			  $username_array = "";
			  $username = "";
			
			  redirect(base_url().'users/comon_signup');
		}
		
		
		
	}

	
	
	
}