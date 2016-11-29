<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	var  $controller;
	public function __construct(){
		parent::__construct();    
		$this->controller = 'user';
		$this->load->library('session');
		$this->load->library('pagination');
		userLoginCheck($this->session->userdata);
		$this->load->model('users');    
		$this -> load -> library('image_lib');
		$this->resized_path = realpath(APPPATH.'../assets/uploads/thumb_92_82');
	}
	public function index(){
		$type = $this->uri->segment('2');
		$activetype = $this->uri->segment('3');
		
		$config['base_url'] = base_url().$this->controller. '/'. $type . '/' . $activetype .'/';
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		
		$data['page_header_title'] = 'All Users';
		
		switch($activetype){
			case 'all':
				$whereClause = array(
					'user_type !=' =>'4'
				);
				break;
			case 'enabled':
				$whereClause = array(
					'user_type !=' =>'4',
					'verified'=>'1',
					'status'=>'1'
				);
				break;
			case 'disabled':
				$whereClause = array(
					'user_type !=' =>'4',
					'verified'=>'1',
					'status'=>'0'
				);
				break;
			case 'notverified':
				$whereClause = array(
					'user_type !=' =>'4',
					'verified'=>'0'
				);
				break;
		}
		
		$data['users'] = $this->users->getUsers($config, $this->uri->segment($config['uri_segment'], 0),$whereClause);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['type'] = $type;
		$data['activetype'] = $activetype;
		$data['search_input'] = '';
		
		$data['allFilterUser'] = get_perticular_count('zc_user',"AND user_type!='4'");
		$data['enbldFilterUser'] = get_perticular_count('zc_user',"AND user_type!='4' AND verified='1' AND status='1'");
		$data['dsbldFilterUser'] = get_perticular_count('zc_user',"AND user_type!='4' AND verified='1' AND status='0'");
		$data['inactFilterUser'] = get_perticular_count('zc_user',"AND user_type!='4' AND verified='0'");
		
		$this->load->view('index', $data);
	}
	public function individual(){
		$type = $this->uri->segment('2');
		$activetype = $this->uri->segment('3');
		
		$config['base_url'] = base_url().$this->controller. '/'. $type . '/' . $activetype .'/';
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		
		$data['page_header_title'] = 'Individual Users';
		
		switch($activetype){
			case 'all':
				$whereClause = array(
					'user_type !=' =>'4',
					'user_type' =>'1'
				);
				break;
			case 'enabled':
				$whereClause = array(
					'user_type !=' =>'4',
					'user_type' =>'1',
					'verified'=>'1',
					'status'=>'1'
				);
				break;
			case 'disabled':
				$whereClause = array(
					'user_type !=' =>'4',
					'user_type' =>'1',
					'verified'=>'1',
					'status'=>'0'
				);
				break;
			case 'notverified':
				$whereClause = array(
					'user_type !=' =>'4',
					'user_type' =>'1',
					'verified'=>'0'
				);
				break;
		}
		$data['users'] = $this->users->getUsers($config, $this->uri->segment($config['uri_segment'], 0),$whereClause);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['type'] = $type;
		$data['activetype'] = $activetype;
		$data['search_input'] = '';
		
		$data['allFilterUser'] = get_perticular_count('zc_user',"AND user_type!='4' AND user_type='1'");
		$data['enbldFilterUser'] = get_perticular_count('zc_user',"AND user_type!='4' AND user_type='1' AND verified='1' AND status='1'");
		$data['dsbldFilterUser'] = get_perticular_count('zc_user',"AND user_type!='4' AND user_type='1' AND verified='1' AND status='0'");
		$data['inactFilterUser'] = get_perticular_count('zc_user',"AND user_type!='4' AND user_type='1' AND verified='0'");
		
		$this->load->view('index', $data);
	}
	public function owner()	{
		$type = $this->uri->segment('2');
		$activetype = $this->uri->segment('3');
		
		$config['base_url'] = base_url().$this->controller. '/'. $type . '/' . $activetype .'/';
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		
		$data['page_header_title'] = 'Owner Users';
		
		switch($activetype){
			case 'all':
				$whereClause = array(
					'user_type !=' =>'4',
					'user_type' =>'2'
				);
				break;
			case 'enabled':
				$whereClause = array(
					'user_type !=' =>'4',
					'user_type' =>'2',
					'verified'=>'1',
					'status'=>'1'
				);
				break;
			case 'disabled':
				$whereClause = array(
					'user_type !=' =>'4',
					'user_type' =>'2',
					'verified'=>'1',
					'status'=>'0'
				);
				break;
			case 'notverified':
				$whereClause = array(
					'user_type !=' =>'4',
					'user_type' =>'2',
					'verified'=>'0'
				);
				break;
		}
		$data['users'] = $this->users->getUsers($config, $this->uri->segment($config['uri_segment'], 0),$whereClause);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['type'] = $type;
		$data['activetype'] = $activetype;
		$data['search_input'] = '';
		
		$data['allFilterUser'] = get_perticular_count('zc_user',"AND user_type!='4' AND user_type='2'");
		$data['enbldFilterUser'] = get_perticular_count('zc_user',"AND user_type!='4' AND user_type='2' AND verified='1' AND status='1'");
		$data['dsbldFilterUser'] = get_perticular_count('zc_user',"AND user_type!='4' AND user_type='2' AND verified='1' AND status='0'");
		$data['inactFilterUser'] = get_perticular_count('zc_user',"AND user_type!='4' AND user_type='2' AND verified='0'");
		
		$this->load->view('index', $data);
	}
	public function agency(){
		$type = $this->uri->segment('2');
		$activetype = $this->uri->segment('3');
		
		$config['base_url'] = base_url().$this->controller. '/'. $type . '/' . $activetype .'/';
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		
		$data['page_header_title'] = 'Agency Users';
		
		switch($activetype){
			case 'all':
				$whereClause = array(
					'user_type !=' =>'4',
					'user_type' =>'3'
				);
				break;
			case 'enabled':
				$whereClause = array(
					'user_type !=' =>'4',
					'user_type' =>'3',
					'verified'=>'1',
					'status'=>'1'
				);
				break;
			case 'disabled':
				$whereClause = array(
					'user_type !=' =>'4',
					'user_type' =>'3',
					'verified'=>'1',
					'status'=>'0'
				);
				break;
			case 'notverified':
				$whereClause = array(
					'user_type !=' =>'4',
					'user_type' =>'3',
					'verified'=>'0'
				);
				break;
		}
		$data['users'] = $this->users->getUsers($config, $this->uri->segment($config['uri_segment'], 0),$whereClause);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['type'] = $type;
		$data['activetype'] = $activetype;
		$data['search_input'] = '';
		
		$data['allFilterUser'] = get_perticular_count('zc_user',"AND user_type!='4' AND user_type='3'");
		$data['enbldFilterUser'] = get_perticular_count('zc_user',"AND user_type!='4' AND user_type='3' AND verified='1' AND status='1'");
		$data['dsbldFilterUser'] = get_perticular_count('zc_user',"AND user_type!='4' AND user_type='3' AND verified='1' AND status='0'");
		$data['inactFilterUser'] = get_perticular_count('zc_user',"AND user_type!='4' AND user_type='3' AND verified='0'");
		
		$this->load->view('index', $data);
	}
	public function admin(){
		$type = $this->uri->segment('2');
		$activetype = $this->uri->segment('3');
		
		$config['base_url'] = base_url().$this->controller. '/'. $type . '/' . $activetype .'/';
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		
		$data['page_header_title'] = 'Admin Users';
		
		switch($activetype){
			case 'all':
				$whereClause = array(
					'user_type' =>'4'
				);
				break;
			case 'enabled':
				$whereClause = array(
					'user_type' =>'4',
					'verified'=>'1',
					'status'=>'1'
				);
				break;
			case 'disabled':
				$whereClause = array(
					'user_type' =>'4',
					'verified'=>'1',
					'status'=>'0'
				);
				break;
			case 'notverified':
				$whereClause = array(
					'user_type' =>'4',
					'verified'=>'0'
				);
				break;
		}
		$data['users'] = $this->users->getUsers($config, $this->uri->segment($config['uri_segment'], 0),$whereClause);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['type'] = $type;
		$data['activetype'] = $activetype;
		$data['search_input'] = '';
		
		$data['allFilterUser'] = get_perticular_count('zc_user',"AND user_type='4'");
		$data['enbldFilterUser'] = get_perticular_count('zc_user',"AND user_type='4' AND verified='1' AND status='1'");
		$data['dsbldFilterUser'] = get_perticular_count('zc_user',"AND user_type='4' AND verified='1' AND status='0'");
		$data['inactFilterUser'] = get_perticular_count('zc_user',"AND user_type='4' AND verified='0'");
		
		$this->load->view('index', $data);
	}
	public function statuschange($id){
		$user_id=$this->uri->segment('3');
		$type=$this->uri->segment('4');
		$activetype=$this->uri->segment('5');
		$page=$this->uri->segment('6');
		$data = array();
		$user = $this->users->getUserById($id);
		if($user->status == '1')
			$data['status'] = '0';
		else
		{
			// $data['status'] = '1';
			$data = array('status' => "1",
						  'blocked_note' => '');
		}
		
		$this->users->updateUser($data, $id);
		$this->session->set_flashdata('success', 'Status has been updated');
		redirect('/user/'.$type.'/'.$activetype.($page==''?'':'/'.$page));
	}
	public function statuschangeoneditprofile($id){
		$data = array();
		$user = $this->users->getUserById($id);
		if($user->status == '1')
			$data['status'] = '0';
		else 
			$data['status'] = '1';
		
		$this->users->updateUser($data, $id);
		$this->session->set_flashdata('success', 'Status has been updated');
		redirect('/user/edit_profile/'.$id);
	}
	public function edit_profile(){
		$data=array();
		$user_id=$this->uri->segment('3');
		$data['postingType'] = 'Edit';
		$data['page_header_title'] = 'User Profile';
		$data['user_infos']=$this->users->get_user_detail($user_id);
		$province=$data['user_infos'][0]['province']; 
		$data['countries']=$this->users->get_country(); 
		$data['provinces']=$this->users->get_state_list();
		$data['city']=$this->users->get_city($province);
		
		$data['pref_info']=$this->users->get_pref_info($user_id);		
		
		if($data['user_infos'][0]['user_type']=='1'){
			$this->load->view('user_profile_template',$data);
		}
		if($data['user_infos'][0]['user_type']=='2'){
			$this->load->view('owner_profile_template',$data);
		}
		if($data['user_infos'][0]['user_type']=='3'){
			$this->load->view('company_profile_template',$data);
		}	
	}
	public function add_profile(){
		$data=array();
		$user_type=$this->uri->segment('3');
		$data['postingType'] = 'Add';
		$data['page_header_title'] = 'Add New User Profile';
		$data['user_infos'] = array(
			array(
				'user_id' => '',
				'user_name' => '',
				'blocked_note' => '',
				'company_name' => '',
				'business_name' => '',
				'vat_number' => '',
				'first_name' => '',
				'last_name' => '',
				'social_secuirity_number' => '',
				'date_of_birth' => '',
				'gender' => '',
				'country' => '',
				'province' => '',
				'city' => '',
				'street_address' => '',
				'street_no' => '',
				'zip' => '',
				'contact_ph_no' => '',
				'phone_1' => '',
				'phone_2' => '',
				'fax_no' => '',
				'website' => '',
				'about_me' => '',
				'file_1' => '',
				'file_2' => '',
				'posting_property_limit' => '',
				'email_id' => '',
				'receive_mail' => '',
				'user_type' => $user_type,
				'status' => ''				
			)
		);
		$data['pref_info'] = array(
			array(
				'language' => '',
				'send_me_email' => '',
				'reply_msg' => '',
				'email_alerts' => '',
				'newsletter' => '',
				'invisible' => '',
				'my_address_display' => '',
				'my_contact_info' => ''
			)
		);
		$data['countries']=$this->users->get_country(); 
		$data['provinces']=$this->users->get_state_list();
		$data['city']=array();
		if($user_type=='1'){
			$this->load->view('user_profile_template',$data);
		}
		if($user_type=='2'){
			$this->load->view('owner_profile_template',$data);
		}
		if($user_type=='3'){
			$this->load->view('company_profile_template',$data);
		}
	}
	public function delete_user(){
		$user_id=$this->uri->segment('3');
		$type=$this->uri->segment('4');
		$activetype=$this->uri->segment('5');
		$page=$this->uri->segment('6');
		$rs=$this->users->del_user($user_id);
		if($rs){
			$this->session->set_flashdata('success', 'User gets deleted sucessfully');
			redirect('/user/'.$type.'/'.$activetype.($page==''?'':'/'.$page));
		}
	}
	public function city_search(){
	  $province=$this->input->post('name');
		$rs=$this->users->get_city($province);
		//echo '<pre>';print_r($rs);die;
		if($rs){
			foreach($rs as $key=>$val){
				echo '<option value="'.$val.'">'.str_replace("\'","'",$val).'</option>';
			}
		}
	}
	private function generate_password_string($access_token, $raw_password){
		$divider = '_';
	    $raw_string = $access_token.$divider.$raw_password;
	    $encrypted_password = md5($raw_string);	    
	    return $encrypted_password;
    }
	public function add_owner(){
		$new_user=array();
		$access_token=access_token();
		$new_user['user_type'] ='2';
		$new_user['user_name'] =$this->input->post('user_name');
		$new_user['first_name'] = $this->input->post('first_name');
		$new_user['last_name'] = $this->input->post('last_name');
		$new_user['social_secuirity_number'] = $this->input->post('social_secuirity_number');
		$new_user['date_of_birth'] = date('d-m-Y', strtotime($this->input->post('date_of_birth')));
		$new_user['city'] = $this->input->post('city');
		$new_user['province'] = $this->input->post('province');
		$new_user['street_address'] = $this->input->post('street_address');
		$new_user['street_no'] = $this->input->post('street_no');
		$new_user['zip'] = $this->input->post('zip');
		$new_user['phone_1'] = $this->input->post('phone_1');
		$new_user['phone_2'] = $this->input->post('phone_2');
		$new_user['email_id'] = $this->input->post('email_id');
		$new_user['password'] = $this->generate_password_string($access_token,$this->input->post('password'));
		$new_user['gender'] = $this->input->post('gender');
		$new_user['access_token'] 	= $access_token ;
		$new_user['agree_terms'] = $this->input->post('agree_terms');
		$new_user['receive_mail'] = $this->input->post('receive_mail');
		$new_user['posting_property_limit'] = $this->input->post('posting_property_limit');
		
		$rs=$this->users->insertUser($new_user);
		
		$new_data=array();
		$new_data['user_id']=$rs;
		if($this->input->post('language_nm')=='english'){
			$mailSubject = 'Activate your ZapCasa account';
			$mailThanksHi = 'Hi';
			$mailThanks_text_1 = 'You are receiving this email because you have requested to register on ZapCasa.';
			$mailThanks_note = 'Note';
			$mailThanks_text_2 = 'If you did not to apply for registration then do nothing, your email will be automatically deleted within 72 hours';
			$mailThanks_text_3 = 'To activate your ZapCasa account, please click on the following link or copy and paste it into your browser';
			$mailThanks_text_4 = 'Regards';
			
			$new_data['language']='en';
		}elseif($this->input->post('language_nm')=='it'){
			$mailSubject = 'Attiva il tuo account ZapCasa';
			$mailThanksHi = 'Ciao';
			$mailThanks_text_1 = 'ricevi questa email perché hai richiesto di registrarti su ZapCasa.';
			$mailThanks_note = 'Nota';
			$mailThanks_text_2 = 'Se pensi di aver ricevuto questo messaggio per errore e non sei stato tu a richiedere la registrazione non fare niente, La tua email sarà cancellata automaticamente entro 72 ore.';
			$mailThanks_text_3 = 'Per attivare il tuo account ZapCasa, clicca sul seguente link o copialo nel tuo browser';
			$mailThanks_text_4 = 'Saluti';
			
			$new_data['language']='it';
		}
		$this->db->insert('zc_user_preference',$new_data);
		
		$email=get_perticular_field_value('zc_user','email_id'," and user_id='".$rs."'");
		$user_name=get_perticular_field_value('zc_user','first_name'," and user_id='".$rs."'").' '.get_perticular_field_value('zc_user','last_name'," and user_id='".$rs."'");
		$passwrd=get_perticular_field_value('zc_user','password'," and user_id='".$rs."'");
		$link=base_url().'users/acctivation/'.$rs.'/'.$passwrd;
		$details=array();
		$default_email = get_perticular_field_value('zc_settings','meta_value'," and meta_name='default_email'");
		$mail_from= isset($default_email) ? $default_email : "no-reply@zapcasa.it";
		$mail_to= $email;
		$subject = $mailSubject;
		$msg='<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">
						<div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
								<div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
							<div style="border-bottom:1px solid #d1d1d1;">
								<img src="'.base_url().'assets/images/logo.png" alt="ZapCasa"/>
							</div>
							<div style="padding:15px;">
								<strong>'.$mailThanksHi.' '.$user_name.'</strong>
								<p>'.$mailThanks_text_1.'</p>
								<p><strong>'.$mailThanks_note.'</strong> '.$mailThanks_text_2.' </p>
								<p> '.$mailThanks_text_3.': </p>
								<p><a href="'.$link.'"><strong>'.$link.'</strong></a></p><br>
								<p>'.$mailThanks_text_4.',<br><a href="http://www.zapcasa.it">www.zapcasa.it</a></p>
							</div>
						</div>

						</body>';
		//$details['message']= $msg;
		$body = $msg;

		sendemail($mail_from, $mail_to, $subject, $body, $cc='');
		
		$this->upload_image_1('user_file_1',$rs);
		$this->upload_image_2('user_file_2',$rs);
		
		
		$msg = "Profile added successfully";
		$this->session->set_flashdata('success', $msg);
		redirect('/user/owner/all');
	}
	public function add_company(){
		$new_user=array();
		$access_token=access_token();
		$new_user['user_type'] ='3';
		$new_user['user_name'] =$this->input->post('user_name');
		$new_user['company_name'] =$this->input->post('company_name');
		$new_user['business_name'] =$this->input->post('business_name');
		$new_user['vat_number'] = $this->input->post('vat_number');
		$new_user['first_name'] = $this->input->post('first_name');
		$new_user['last_name'] = $this->input->post('last_name');
		$new_user['contact_ph_no'] = $this->input->post('contact_ph_no');
		$new_user['province'] = mysql_real_escape_string($this->input->post('province'));
		$new_user['city'] = mysql_real_escape_string($this->input->post('city'));
		$new_user['street_address'] = $this->input->post('street_address');
		$new_user['street_no'] = $this->input->post('street_no');
		$new_user['zip'] = $this->input->post('zip');
		$new_user['phone_1'] = $this->input->post('phone_1');
		$new_user['phone_2'] = $this->input->post('phone_2');
		$new_user['fax_no'] = $this->input->post('fax_no');
		$new_user['website'] = $this->input->post('website');
		$new_user['email_id'] = $this->input->post('email_id');
		$new_user['password'] = $this->generate_password_string($access_token,$this->input->post('password'));
		$new_user['access_token'] 	= $access_token ;
		$new_user['agree_terms'] = $this->input->post('agree_terms');
		$new_user['receive_mail'] = $this->input->post('receive_mail');
		$new_user['posting_property_limit'] = $this->input->post('posting_property_limit');
		
		$rs=$this->users->insertUser($new_user);
		
		$new_data['user_id']=$rs;
		if($this->input->post('language_nm')!=''){
			$new_data['language']='en';
		}
		$this->db->insert('zc_user_preference',$new_data);
		
		$msg = "Profile added successfully";
		$this->session->set_flashdata('success', $msg);
		redirect('/user/agency/all');
	}
	public function add_general_user(){
		$new_user=array();
		$access_token=access_token();
		$new_user['user_type'] ='1';
		$new_user['user_name'] =$this->input->post('user_name');
		$new_user['first_name'] = $this->input->post('first_name');
		$new_user['last_name'] = $this->input->post('last_name');
		$new_user['date_of_birth'] = date('d-m-Y', strtotime($this->input->post('date_of_birth')));
		$new_user['gender'] = $this->input->post('gender');
		$new_user['country'] = $this->input->post('country');
		$new_user['city'] = $this->input->post('city');
		$new_user['contact_ph_no'] = $this->input->post('ph_no');
		$new_user['email_id'] = $this->input->post('email_id');
		$new_user['password'] = $this->generate_password_string($access_token,$this->input->post('password'));		
		$new_user['access_token'] 	= $access_token ;
		$new_user['agree_terms'] = $this->input->post('agree_terms');
		$new_user['receive_mail'] = $this->input->post('receive_mail');
		$new_user['posting_property_limit'] = $this->input->post('posting_property_limit');
		
		$rs=$this->users->insertUser($new_user);
		
		$new_data=array();
		$new_data['user_id']=$rs;
		$new_data['language']='en';
		if($this->input->post('language_nm')=='english'){
			$mailSubject = 'Activate your ZapCasa account';
			$mailThanksHi = 'Hi';
			$mailThanks_text_1 = 'You are receiving this email because you have requested to register on ZapCasa.';
			$mailThanks_note = 'Note';
			$mailThanks_text_2 = 'If you did not to apply for registration then do nothing, your email will be automatically deleted within 72 hours';
			$mailThanks_text_3 = 'To activate your ZapCasa account, please click on the following link or copy and paste it into your browser';
			$mailThanks_text_4 = 'Regards';
			
			$new_data['language']='en';
		}elseif($this->input->post('language_nm')=='it'){
			$mailSubject = 'Attiva il tuo account ZapCasa';
			$mailThanksHi = 'Ciao';
			$mailThanks_text_1 = 'ricevi questa email perché hai richiesto di registrarti su ZapCasa.';
			$mailThanks_note = 'Nota';
			$mailThanks_text_2 = 'Se pensi di aver ricevuto questo messaggio per errore e non sei stato tu a richiedere la registrazione non fare niente, La tua email sarà cancellata automaticamente entro 72 ore.';
			$mailThanks_text_3 = 'Per attivare il tuo account ZapCasa, clicca sul seguente link o copialo nel tuo browser';
			$mailThanks_text_4 = 'Saluti';
			
			$new_data['language']='it';
		}
		$this->db->insert('zc_user_preference',$new_data);
		
		
		$email=get_perticular_field_value('zc_user','email_id'," and user_id='".$rs."'");
		$user_name=get_perticular_field_value('zc_user','first_name'," and user_id='".$rs."'").' '.get_perticular_field_value('zc_user','last_name'," and user_id='".$rs."'");
		$passwrd=get_perticular_field_value('zc_user','password'," and user_id='".$rs."'");
		$link=base_url().'users/acctivation/'.$rs.'/'.$passwrd;
		$default_email = get_perticular_field_value('zc_settings','meta_value'," and meta_name='default_email'");
		$mail_from = isset($default_email) ? $default_email : "no-reply@zapcasa.it";
		$mail_to = $email;
		$subject = $mailSubject;
		$msg='<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">			
			<div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
				<div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
				<div style="border-bottom:1px solid #d1d1d1;">
					<img src="'.base_url().'assets/images/logo.png" alt="ZapCasa"/>
				</div>
				<div style="padding:15px;">
					<strong>'.$mailThanksHi.' '.$user_name.'</strong><br>
					<p>'.$mailThanks_text_1.'</p><br>
					<p><strong>'.$mailThanks_note.'</strong> '.$mailThanks_text_2.'. </p><br>
					<p> '.$mailThanks_text_3.': </p>
					<p><a href="'.$link.'"><strong> '.$link.'</strong></a></p><br>
					<p>'.$mailThanks_text_4.',<br><a href="http://www.zapcasa.it">www.zapcasa.it</a></p>
				</div>
			</div>							
			</body>';
		$body=$msg;
		sendemail($mail_from, $mail_to, $subject, $body, $cc='');
		
		
		$msg = "Profile added successfully";
		$this->session->set_flashdata('success', $msg);
		redirect('/user/individual/all');
	}
	public function update_general_user(){
		$user_id=$this->uri->segment('3');
		$page=$this->uri->segment('4');
		//echo '<pre>';print_r($_POST);die;
		$rs=$this->users->general_user_update($user_id);
		if($rs){
			$msg = "Profile data updated successfully";
			$this->session->set_flashdata('success', $msg);
			redirect('user/edit_profile/'.$user_id);
		}
	}
	public function update_owner(){
		$user_id=$this->uri->segment('3');
		//echo '<pre>';print_r($_POST);die;
		$rs=$this->users->general_owner_update($user_id);
		if($rs) {
			/*$this->upload_image_1('user_file_1',$user_id);
			$this->upload_image_2('user_file_2',$user_id);
			redirect('user/edit_profile/'.$user_id);*/

			$this->upload_image_1('user_file_1',$user_id);
			$this->upload_image_2('user_file_2',$user_id);
			$msg = "Profile data updated successfully";
			$this->session->set_flashdata('success', $msg);
			redirect('user/edit_profile/'.$user_id);
		}
	}
	public function update_company(){
		$user_id=$this->uri->segment('3');
		//echo '<pre>';print_r($_POST);die;
		$rs=$this->users->general_company_update($user_id);
		if($rs){
			$this->upload_image_1('user_file_1',$user_id);
			$this->upload_image_2('user_file_2',$user_id);
			$msg = "Profile data updated successfully";
			$this->session->set_flashdata('success', $msg);
			redirect('user/edit_profile/'.$user_id);
		}
	}
	public function user_search(){
		$search_input=$this->input->get('search_input');
		$type = $this->uri->segment('3');
		$activetype = $this->uri->segment('4');
		
		$config['base_url'] = base_url().$this->controller. '/user_search/'. $type . '/' . $activetype .'/';
		$config['per_page'] = 20;
		$config['uri_segment'] = 5;
		$config['first_url'] = base_url().$this->controller. '/user_search/all?search_input='.$search_input;
		
		
		switch($activetype){
			case 'all':
				$whereClause = "user_type != '4'";
				break;
			case 'enabled':
				$whereClause = "user_type != '4' AND verified='1' AND status='1'";
				break;
			case 'disabled':
				$whereClause = "user_type != '4' AND verified='1' AND status='0'";
				break;
			case 'notverified':
				$whereClause = "user_type != '4' AND verified='0'";
				break;
		}
		
		
		$data['users']=$this->users->get_user_det($config, $this->uri->segment($config['uri_segment'], 0),$whereClause,$search_input);
		$this->pagination->initialize($config);
		
		$this->pagination->suffix = '?search_input='.$search_input;
		
		$data['pagination'] = $this->pagination->create_links();
		
		$data['type'] = $type;
		$data['activetype'] = $activetype;
		$data['search_input'] = $search_input;
		
		$sqlMore = $this->users->get_user_search_id($search_input);
		
		$data['allFilterUser'] = get_perticular_count('zc_user',"AND user_type!='4'".$sqlMore);
		$data['enbldFilterUser'] = get_perticular_count('zc_user',"AND user_type!='4' AND verified='1' AND status='1'".$sqlMore);
		$data['dsbldFilterUser'] = get_perticular_count('zc_user',"AND user_type!='4' AND verified='1' AND status!='1'".$sqlMore);
		$data['inactFilterUser'] = get_perticular_count('zc_user',"AND user_type!='4' AND verified!='1'".$sqlMore);
		
		$data['page_header_title'] = 'Search Users';
		
		$this->load->view('user_search', $data);
	}
	public function upload_image_1($form_field_name,$uid){
		//echo '<pre>';print_r($_FILES);die;
		$config['upload_path'] = '../assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
		$config['encrypt_name']=TRUE;
		$config['set_file_ext']=TRUE;
		$this->load->library('upload', $config);	
		if ( ! $this->upload->do_upload($form_field_name)) {
			$errors = $this->upload->display_errors();
		} else {
			//$uid=$this->session->userdata( 'user_id' );
			$dfile_name=get_perticular_field_value('zc_user','file_1'," and user_id='".$uid."'");
			$dfile='../assets/uploads/'.$dfile_name;
			 if(is_file($dfile))
			 @unlink($dfile);
			$dfile_thmb='assets/uploads/thumb_92_82/'.$dfile_name;
			 if(is_file($dfile_thmb))
			 @unlink($dfile_thmb);	
			$upload_data = $this->upload->data(); 
			$file_names =   $upload_data['file_name'];
			$rs_update=$this->users->update_profile_1($file_names,$uid);
			 $config = array(
			'source_image'      => $upload_data['full_path'], //path to the uploaded image
			'new_image'         => "../assets/uploads/thumb_92_82/".$file_names, //path to
			'maintain_ratio'    => true,
			'width'             => 128,
			'height'            => 128
			);
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
		}
	}
	public function upload_image_2($form_field_name,$uid) {
		$config['upload_path'] = '../assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
		$config['encrypt_name']=TRUE;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload($form_field_name)) {
			$errors = $this->upload->display_errors();       
		} else{
			////////////////delete image first////////////////////
			$uid=$this->session->userdata( 'user_id' );
			$dfile_name=get_perticular_field_value('zc_user','file_2'," and user_id='".$uid."'");
			$dfile='../assets/uploads/'.$dfile_name;
			 if(is_file($dfile))
			 @unlink($dfile);
			$dfile_thmb='../assets/uploads/thumb_92_82/'.$dfile_name;
			 if(is_file($dfile_thmb))
			 @unlink($dfile_thmb);
			
			
			/////////////delete image end//////////////////////////
			$upload_data = $this->upload->data(); 
			$file_names =   $upload_data['file_name'];
			$rs_update=$this->users->update_profile_2($file_names,$uid);
			 $config = array(
			'source_image'      => $upload_data['full_path'], //path to the uploaded image
			'new_image'         => "../assets/uploads/thumb_92_82/".$file_names, //path to
			'maintain_ratio'    => true,
			'width'             => 430,
			'height'            => 300
			);
			
			$this->image_lib->initialize($config);
			$this->image_lib->resize();   
		}
	}	
	public function view_message() {
			$user_id=$this->uri->segment('3');
			$this->load->library('pagination');
			$config = array();
			$data['page_header_title'] = 'User Profile';
			
			$data['user_infos']=$this->users->get_user_detail($user_id);
			$config["base_url"] = base_url() . "user/view_message/".$user_id;
			$config["total_rows"] = get_perticular_count('zc_property_message_info'," and user_id_to='".$user_id."' group by msg_grp_id");
			$config["per_page"] = 10;
			$config["uri_segment"] = 4;
			
			$paginationA = clone($this->pagination);
			$paginationA->initialize($config);
			
			//$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data["msg_totals"] = array();
			if( count($config["total_rows"]) > 0 ) {
				$data["msg_totals"] = $this->users->get_msg_detail($user_id,$config["per_page"], $page);
				$data["pagination"] = $paginationA->create_links();
			}
			/*
			$data['feedback_totals']= array();
			$configB["base_url"] = base_url() . "user/view_message/".$user_id."/feedback";
			$configB["per_page"] = 2;
			$configB["uri_segment"] = 5;
			$configB["total_rows"] = get_perticular_count('zc_feedback'," and feedback_to_id='".$user_id."' and feedback_status='1'");
			$paginationB = clone($this->pagination);
			$paginationB->initialize($configB);
			
			if( count($config["total_rows"]) > 0 ) {
				$data["feedback_totals"] = $this->users->get_user_feddback($user_id,$configB["per_page"], $page);
				$data["paginationB"] = $paginationB->create_links();
			}*/
			$this->load->view('user/view_message',$data);
			
	}	
	public function feedback() {
		$user_id=$this->uri->segment('3');
		$this->load->library('pagination');
		$configB = array();
		$data['page_header_title'] = 'User Profile';
			
		$data['user_infos']=$this->users->get_user_detail($user_id);
		
		$data['feedback_totals']= array();
		$configB["base_url"] = base_url() . "user/feedback/".$user_id;
		$configB["per_page"] = 10;
		$configB["uri_segment"] = 4;
		$configB["total_rows"] = get_perticular_count('zc_feedback'," and feedback_to_id='".$user_id."' and feedback_status='1'");
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		$paginationB = clone($this->pagination);
		$paginationB->initialize($configB);
			
		if( count($configB["total_rows"]) > 0 ) {
			$data["feedback_totals"] = $this->users->get_user_feddback($user_id,$configB["per_page"], $page);
			$data["paginationB"] = $paginationB->create_links();
		}
		$this->load->view('user/view_message',$data);
			
	}
	public function msg_details() {
		$msg_id=$this->input->post('msg_id');
		$msg_grp_id=get_perticular_field_value('zc_property_message_info','msg_grp_id'," and msg_id='".$msg_id."'");
		$all_msgs=$this->users->get_property_msg($msg_grp_id);
		echo "<table>";
		$i=0;
		echo "<tr><td colspan='4'><a href='javascript: void(0);' onclick='location.reload(); ' style='float:right; margin-right:25px; background:#427EBA; color:#fff; border-radius:4px; padding:2px 6px;'  > Back</a></td></tr>";
		foreach($all_msgs as $msgs) {
			if($i%2==0) {
				$class='';
			} else {
				$class="class='odd_row'";
			}
			if($msgs['property_id']!='0') {
				$sub='Request for:'.subject_inbox($msgs['property_id']);
			}
			else {
				$sub='Subject:'.ucfirst($msgs['subject']);
			}
			echo "<tr ".$class.">
	  				<td></td>
                      <td colspan='3'>
					  	<span style='font-weight:bold;'>".$sub."</span><br>
                        <span style='color:#1F76D9'></span>".$msgs['message']."<br>
                        <div style='float:right; margin-right:10px;'>
						<span style='color:#1F76D9;'>By </span>".$msgs['user_name']."</div><br>
                        <div style='float:right; margin-right:10px;'><span style='color:#1F76D9;'>On: </span>".date('d/m/Y g:i A',strtotime($msgs['msg_date']))."
                      </div></td>
            </tr>";
			$i++;
		}
		echo "</table>";
	}
	public function feedback_details() {
		$msg_id=$this->input->post('msg_id');
		$all_msgs=$this->users->get_feedback_details($msg_id);
		echo "<table>";
		$i=0;
		echo "<tr><td colspan='4'><a href='javascript: void(0);' onclick='location.reload(); ' style='float:right; margin-right:25px; background:#427EBA; color:#fff; border-radius:4px; padding:2px 6px;' > Back</a></td></tr>";
		foreach($all_msgs as $msgs) {
			if($i%2==0) {
				$class='';
			} else {
				$class="class='odd_row'";
			}	
			$sub='Subject:'.ucfirst($msgs['feedback_subject']);
			echo "<tr ".$class.">
	  				<td></td>
                      <td colspan='3'>
					  	<span style='font-weight:bold;'>".$sub."</span><br>
                        <span style='color:#1F76D9'></span>".$msgs['feedback_msg']."<br>
                        <div style='float:right; margin-right:10px;'>
						<span style='color:#1F76D9;'>By </span>".$msgs['user_name']."</div><br>
                        <div style='float:right; margin-right:10px;'><span style='color:#1F76D9;'>On: </span>".date('d/m/Y g:i A',strtotime($msgs['feedback_date']))."
                      </div></td>
            </tr>";
			$i++;
		}
		echo "</table>";
	}
	public function latest_active_users(){
		$config['base_url'] = base_url(). $this->controller. '/'. __FUNCTION__;
		$data['page_header_title'] = 'All Users';
		$data['users'] = $this->users->letestactivated_user();
		//print_r($data['users']);exit;
		//$this->pagination->initialize($config);
		//$data['pagination'] = $this->pagination->create_links();
		$this->load->view('latest_active_users', $data);
	}
	public function send_blocked_note(){
		$type=$this->input->post('type');
		$page=$this->input->post('page');
		$userid=$this->input->post('userid');
		
		$data['blocked_note'] = $this->input->post('blockednote');
		$data['status'] = '0';
		$this->users->updateUser($data, $userid);
		
		$default_email = get_perticular_field_value('zc_settings','meta_value'," and meta_name='default_email'");
		$email = get_perticular_field_value('zc_user','email_id'," and user_id='".$userid."'");		
		$user_full_name = get_perticular_field_value('zc_user','first_name'," and user_id='".$userid."'").' '.get_perticular_field_value('zc_user','last_name'," and user_id='".$userid."'");
		
		$mail_from = isset($default_email) ? $default_email : "no-reply@zapcasa.it";
		$mail_to = $email;
		
		$languagePref = get_perticular_field_value('zc_user_preference','language'," and user_id='".$userid."'");
		$subject = ($languagePref == 'it'?'Il tuo account è stato bloccato.':'Your account has been blocked.');
		if($languagePref == 'it'){
			$msg='<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">			
			<div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
				<div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
				<div style="border-bottom:1px solid #d1d1d1;">
					<img src="'.base_url().'assets/images/logo.png" alt="ZapCasa"/>
				</div>
				<div style="padding:15px;">
					<strong>Ciao '.$user_full_name.'</strong>,<br>
					<p>Questo è una notifica automatica per informarti che il tuo account ZapCasa è stato bloccato.</p>
					<p>Per maggiori informazioni ti invitiamo ad effettuare il login su <a href="http://www.zapcasa.it">www.zapcasa.it</a>.</p><br>
					<p>Saluti,<br><a href="http://www.zapcasa.it">www.zapcasa.it</a></p>
				</div>
			</div>
			</body>';
		}else{
			$msg='<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">			
			<div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
				<div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
				<div style="border-bottom:1px solid #d1d1d1;">
					<img src="'.base_url().'assets/images/logo.png" alt="ZapCasa"/>
				</div>
				<div style="padding:15px;">
					<strong>Hi '.$user_full_name.'</strong>,<br>
					<p>This is an automatic notification to inform you that your ZapCasa account has been blocked.</p>
					<p>For further information please login on <a href="http://www.zapcasa.it">www.zapcasa.it</a>.</p><br>
					<p>Regards,<br><a href="http://www.zapcasa.it">www.zapcasa.it</a></p>
				</div>
			</div>
			</body>';
		}
		
		$body=$msg;
		sendemail($mail_from, $mail_to, $subject, $body, $cc='');
		
		$this->session->set_flashdata('success', 'Blocked note has been added & status has been updated');
		//redirect($this->controller.($type=='index'?'':'/'.$type).($page==''?'':'/'.$page));
	}
	public function check_email_avail(){
		$email_id=$this->input->post('email');
		if($email_id==''){
			echo '0';
			exit;
		}else{
			$user_list_cnt=get_perticular_count('zc_user'," and email_id='".$email_id."'");
			echo $user_list_cnt;
			exit;
		}
	}
	public function check_ssn_avail(){
		$socialSN=$this->input->post('ssn');
		if($socialSN=='') {
			echo '2';
			exit;
		} else {
			$user_list_cnt = get_perticular_count('zc_user'," and social_secuirity_number='".$socialSN."'");
			echo $user_list_cnt;
			exit;
		}
	}
	public function check_user_avail(){
		$user_name=$this->input->post('user_name');
		$user_list_cnt=get_perticular_count('zc_user'," and user_name='".$user_name."'");
		echo $user_list_cnt;
		exit;
	}
	public function check_bussname_avail(){
		$business_name=$this->input->post('business_name');
		if($business_name==''){
			echo '2';
			exit;
		}else{
			$user_list_cnt=get_perticular_count('zc_user'," and business_name='".$business_name."'");
			echo $user_list_cnt;
			exit;
		}
	}
	public function check_vat_avail(){
		$vat_no=$this->input->post('vat_no');
		if($vat_no==''){
			echo '2';
			exit;
		}else{
			$user_list_cnt=get_perticular_count('zc_user'," and vat_number='".$vat_no."'");
			echo $user_list_cnt;
			exit;
		}
	}
}
