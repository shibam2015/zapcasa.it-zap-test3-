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
class advertiser extends CI_Controller {
    public function __construct() {
        parent::__construct();		
		$this->load->library('session');
		$this->load->helper('cookie');
		if(isset($_COOKIE['lang']) && ($_COOKIE['lang'] == "english")){
			$this->lang->load('code', 'english');
		} else {
			$this->lang->load('code', 'it');
		}
		
		
		$this->load->library("pagination");		
		$this->load->model("users/usersm");
		$this->load->model("property/propertym");
		$this->load->model("advertiser/advertiserm");
		/*
		if($this->session->userdata('user_id')){
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
		}
		*/
		//authenticate();
    }	
	public function index(){
		
	}
	public function search($catname=''){
		$data = array();
		$filters = array();
		$location = '0';
		$name = '';
		$advertiser_type = 'all';
		if($this->input->get('name')){
			$name = $this->input->get('name');
		}
		if($this->input->get('advertiser_type')){
			$advertiser_type = $this->input->get('advertiser_type');
		}
		if($this->input->get('location')){
			$location = $this->input->get('location');
		}		
		$filters['name'] = $name;
		$filters['advertiser_type'] = $this->input->get('advertiser_type');
		$filters['location'] = $this->input->get('location');
		
		//Pagination
		$page = (int) (!isset($_GET['page']) ? 1 : $_GET['page']);
		$page = ($page == 0 ? 1 : $page);
		//limit in each page
		$perpage = 10;
		$startpoint = ($page * $perpage) - $perpage;		
		
		
		$data['advertiser_lists'] = $this->advertiserm->getAdvertiserByFilter($filters,$startpoint,$perpage);
		
		if(!strpos($_SERVER['QUERY_STRING'], "page=")===false){
			$QUERY_STRING = str_replace("&page=".$_GET['page'],"",$_SERVER['QUERY_STRING']);			
		}else{
			$QUERY_STRING = $_SERVER['QUERY_STRING'];
		}		
		$path = base_url().'advertiser/search?'.$QUERY_STRING.'&page=';
		$cureentPage = $_GET['page'];
		$data['pagination'] = $this->advertiserm->AdvertiserListingPages($filters, $perpage, $path, $cureentPage,'pagination');
		$data['advertiserCount'] = $this->advertiserm->AdvertiserListingPages($filters, $perpage, $path, $cureentPage,'advertisercounter');
		
		
		
		
		
		
		//echo "<pre>"; print_r($data);exit;
		$this->load->view("advertiser/search",$data);
	}

	public function get_feedback()
	{
		$uid=$this->session->userdata( 'user_id' );
		if($uid=='' || $uid=='0' ) {
			redirect('/');
		} else {
			$user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$uid."'");
			if($user_type=='1'){
				redirect('/');
			}
			$feedback_to_id=$this->session->userdata('user_id');			
			$data["pagination"] = array();			
			$data['feedback_lists'] = array();
			$config["base_url"] = base_url() . "My_Feedback";			
			$config["total_rows"] = get_perticular_count('zc_feedback'," AND feedback_to_id=$feedback_to_id AND feedback_status='1' AND feedback_to_delete = '0'");
			$config["per_page"] = 10;
			$config["uri_segment"] = 2;			
			$pagination = clone($this->pagination);
			$pagination->initialize($config);
			$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;			

			$result = $this->advertiserm->get_feedback($config["per_page"], $page);
			if( count( $result ) > 0 ) {
				$data['feedback_lists']=$result;
				$data["links"] = $pagination->create_links();
			}
			/* $data['feedback_lists']=$this->advertiserm->get_feedback();*/
			$this->load->view('advertiser/feedback_msg',$data);
		}
	}	
	public function advertiser_details() {		
		$advertiser_id=$this->uri->segment('3');		
		$data['search_title']=$this->lang->line('advertiser_title_details');
		$data['advertiser_detail']=$this->advertiserm->get_advertiser_detial($advertiser_id);
		$data['property_list']=$this->advertiserm->get_property_list($advertiser_id);
		$this->load->view('advertiser/advertiser_detail',$data);
	}	
	public function advertiser_search_adv() {
		//echo '<pre>';print_r($_GET);die;
		$location=$this->input->get('location');
		$name=$this->input->get('name');
		if( $this->input->get('advertiser_type')=='' || $this->input->get('advertiser_type')=='all' ) {
			$advertiser_type='all';
		} else{
			$advertiser_types=$this->input->get('advertiser_type');
			if(count($advertiser_types)==2) {
				$advertiser_type='all';
			} else{
				$advertiser_type=$advertiser_types[0];
			}
		}		
		$config = array();
		$config['base_url'] = base_url() . '/advertiser/advertiser_search_adv/?search=true';  
		foreach ($_GET as $key=>$value) {
			if ($key != 'search' && $key != 'offset') {
				if( $key == 'advertiser_type' ) {
					if(count($value) > 0 ) {
						foreach($value as $k=>$v):
							$config['base_url'] .= '&'.$key.'[]='.$v;
						endforeach;
					}
				}
				if( $key != 'advertiser_type' ) {
					$config['base_url'] .= '&'.$key.'='.$value;
				}	
			}
		}
		$total_row = $this->advertiserm->get_advertiser_count($location,$name,$advertiser_type);
		$config['query_string_segment'] = 'offset';
		$config['page_query_string'] = true;
		$config['total_rows'] =  $total_row;
		$config['per_page'] = 10;
		if (!empty($_GET['offset'])) {
			$offset = $_GET['offset'];
		} else {
			$offset = 0;
		}
		$this->pagination->initialize($config);
		$data["links"] = $this->pagination->create_links();
		$data['total_row'] = isset($total_row) ?$total_row : 0;
		$data['search_title']=$this->lang->line('advertiser_title_list');
		$data['advertiser_lists']=$this->advertiserm->get_list($location,$name,$advertiser_type,$config["per_page"], $offset);
		//---------------------------- POPULAR SEARCH CALCULATION  ------------------------------------
		$result_count = $total_row;
		if($this->input->get('location') != ''){
			//echo '<pre>';print_r($_GET);die;
			//$this->input->get('name');
			$keysearch = mysql_real_escape_string($this->input->get('location'));
			//$keysearch.= ($this->input->get('name')!=''?" , ".$this->input->get('name'):"");
			if($result_count > 0){
				$list = explode(", ", $location);
				if(count($list) > 4){
					if(isset($list[0]) && $list[0] != ''){
						$street = $list[0];
						$area = $list[0];
					}
					if(isset($list[1]) && $list[1] != ''){
						$city = $list[1];
					}
					if(isset($list[2]) && $list[2] != ''){
						$provience_code = $list[2];
					}
					if(isset($list[3]) && $list[3] != ''){
						$zip = $list[3];
					}
					if(isset($list[4]) && $list[4] != ''){
						$country = $list[4];
					}
				}elseif(count($list) == 4){
					if(isset($list[0]) && $list[0] != ''){
						$street = $list[0];
						$area = $list[0];
					}
					if(isset($list[1]) && $list[1] != ''){
						$city = $list[0];
					}
					if(isset($list[2]) && $list[2] != ''){
						$provience_code = $list[1];
					}
					if(isset($list[3]) && $list[3] != ''){
						$zip = $list[2];
					}
					if(isset($list[4]) && $list[4] != ''){
						$country = $list[4];
					}
				}else if(count($list) == 3){
					if(isset($list[0]) && $list[0] != ''){
						$city = $list[0];
					}
					if(isset($list[1]) && $list[1] != ''){
						$provience_code = $list[1];
					}
					if(isset($list[2]) && $list[2] != ''){
						$zip = $list[2];
					}
				}else{
					if(isset($list[0]) && $list[0] != ''){
						$city = $list[0];
					}
					if(isset($list[1]) && $list[1] != ''){
						$provience = $list[1];
					}
					if(isset($list[2]) && $list[2] != ''){
						$provience_code = $list[2];
					}
					if(isset($list[3]) && $list[3] != ''){
						$country = $list[3];
					}
				}
				
				/********	City	**************/
				if(!strpos($city, "'")===false){
					$city=get_perticular_field_value('zc_city','city_id'," and (`city_name` = '".str_replace("'","\\\''",$city)."' OR `city_name_it` = '".str_replace("'","\\\''",$city)."')");
				}else{
					$city=get_perticular_field_value('zc_city','city_id'," and (`city_name` = '".$city."' OR `city_name_it` = '".$city."')");
				}
				/********	Province	**************/
				$provience_name=get_perticular_field_value('zc_region_master','province_name'," and `province_code` = '".$provience_code."' group by province_code");
				if(!strpos($provience_name, "'")===false){
					$provience=get_perticular_field_value('zc_provience','provience_id'," and `provience_name` = '".str_replace("'","\\''",$provience_name)."'");
				}else{
					$provience=get_perticular_field_value('zc_provience','provience_id'," and `provience_name` = '".$provience_name."'");
				}				
				$country = '104';			
				
				
				$blank_db = $this->advertiserm->pop_search("select * from zc_popular_search where ps_type = 'advertiser_filter'");	
				if(count($blank_db) > 0){
					$qry = "select * from zc_popular_search where ps_type = 'advertiser_filter' and advertiser_type = '".$advertiser_type."' and ps_city = ".$city." and ps_provience = ".$provience." and ps_start_date <= now() and ps_end_date >= now() and ps_status = '1'";
					$res = $this->advertiserm->pop_search($qry);	
					if(count($res) >0){
						$view = ($res[0]['ps_views'] + 1);
						$this->advertiserm->insert_update("update zc_popular_search set ps_views = '".$view."' where ps_id = '".$res[0]['ps_id']."'");
					}else{
						$qry2 = "select * from zc_popular_search where ps_type = 'advertiser_filter' and advertiser_type = '".$advertiser_type."' and ps_city = ".$city." and ps_provience = ".$provience." and ps_status = '1'";
						$res2 = $this->advertiserm->pop_search($qry2);
						$this->advertiserm->insert_update("delete from zc_popular_search where ps_id = '".$res2[0]['ps_id']."'");
						
						$qry = "insert into zc_popular_search set
						ps_type = 'advertiser_filter', 
						ps_keyword = '".$keysearch."',
						ps_url = '".addslashes($_SERVER['REQUEST_URI'])."',
						ps_start_date = now(),
						ps_end_date = date_add(now(), INTERVAL +7 day),
						ps_views = '1',
						ps_created_on = now(),
						ps_street = '".$street."',
						ps_zip = '".$zip."',
						ps_city = '".$city."',
						ps_provience = '".$provience."',
						ps_country = '".$country."',
						advertiser_type = '".$advertiser_type."', 
						location_en = '".$keysearch."',
						location_it = '".$keysearch."' ";
						$this->advertiserm->insert_update($qry);	
					}
				}else{
					
					$qry = "insert into zc_popular_search set 
					ps_type = 'advertiser_filter',
					ps_keyword = '".$keysearch."',
					ps_url = '".addslashes($_SERVER['REQUEST_URI'])."',
					ps_start_date = now(),
					ps_end_date = date_add(now(), INTERVAL +7 day),
					ps_views = '1',
					ps_created_on = now(),
					ps_street = '".$street."',
					ps_zip = '".$zip."',
					ps_city = '".$city."',
					ps_provience = '".$provience."',
					ps_country = '".$country."',
					advertiser_type = '".$advertiser_type."', 
					location_en = '".$keysearch."',
					location_it = '".$keysearch."' ";
					$this->advertiserm->insert_update($qry);
				}
			}
		}
		//---------------------------- POPULAR SEARCH CALCULATION  ------------------------------------
		$this->load->view('advertiser/advertiser_list',$data);
	}	
	public function feedback_details(){
		$lang = $this->input->post('lang');
		$msg_id=$this->input->post('msg_id');
		$all_msgs=$this->advertiserm->get_feedback_details($msg_id);
		$ch=$this->advertiserm->change_read_status_feedback($msg_id);
		//$all_msgs=get_perticular_field_value('zc_feedback','message'," and msg_id='".$msg_id."'");
		// $email_from=get_perticular_field_value('zc_property_message_info','email_id'," and msg_id='".$msg_id."'");
		//$phone_number=get_perticular_field_value('zc_property_message_info','ph_number'," and msg_id='".$msg_id."'");
		echo "<table>";
		$i=0;
		foreach($all_msgs as $msgs){
			if($i%2==0){
				$class='';
				//$sub_class="class='odd_row'";
			}else{
				$class="class='odd_row'";
				//$sub_class="";
			}
			$sub=ucfirst($msgs['feedback_subject']);
			
			switch(date('m',strtotime($msgs['feedback_date']))){
				case '01':
					$monthName = $this->lang->line('cal_jan');
					break;
				case '02':
					$monthName = $this->lang->line('cal_feb');
					break;
				case '03':
					$monthName = $this->lang->line('cal_mar');
					break;
				case '04':
					$monthName = $this->lang->line('cal_apr');
					break;
				case '05':
					$monthName = $this->lang->line('cal_may');
					break;
				case '06':
					$monthName = $this->lang->line('cal_jun');
					break;
				case '07':
					$monthName = $this->lang->line('cal_jul');
					break;
				case '08':
					$monthName = $this->lang->line('cal_aug');
					break;
				case '09':
					$monthName = $this->lang->line('cal_sep');
					break;
				case '10':
					$monthName = $this->lang->line('cal_oct');
					break;
				case '11':
					$monthName = $this->lang->line('cal_nov');
					break;
				case '12':
					$monthName = $this->lang->line('cal_dec');
					break;			
			}
			$messageTime = date('d',strtotime($msgs['feedback_date'])).' '.$monthName.' '.date('Y',strtotime($msgs['feedback_date']));
			
			echo "<tr ".$class.">
					<td colspan='5'>
						<span style='display:block;font-weight:bold;'>".$sub."</span>
						<br><hr><br>
						<span style='color:#000000'>".stripslashes($msgs['feedback_msg'])."</span>
						<br>
						<div style='float:right;'>
							<span style='color:#1F76D9;'>".($lang=='it'?'Da':'By')." </span>
							".$msgs['user_name']."
						</div>
						<br>
						<div style='float:right;'>
							<span style='color:#1F76D9;'>".($lang=='it'?'In data':'On').": </span>
							".$messageTime."
						</div>
					</td>
				  </tr>";
				$i++;
		}
		echo "</table>";
	}
	public function add_message(){
		//echo '<pre>';print_r($_POST);die;
		$user_id_from=$this->session->userdata( 'user_id' );
		$owner_id=$this->input->post('owner_id');
		//$return_url=$this->input->post('re_url');
		$new_message=array();

		$new_message['msg_date']=date('Y-m-d H:i:s');
		$new_message['subject']=$this->input->post('subject');
		$new_message['property_id']=$this->input->post('property_id');
		$new_message['user_id_to']=$owner_id;
		$new_message['user_name_to']=get_perticular_field_value('zc_user','user_name'," and user_id='".$owner_id."'");
		$new_message['email_id_to']=get_perticular_field_value('zc_user','email_id'," and user_id='".$owner_id."'");
		$new_message['user_id_from']=$user_id_from;
		$new_message['user_name']=$this->input->post('name');
		$new_message['ph_number']=$this->input->post('phone_number');
		$new_message['email_id']=$this->input->post('email_id');
		$new_message['message']=$this->input->post('message');

		$new_message['msg_grp_id']=access_token();

		// echo '<pre>';print_r($new_message);die;
		$email_owner=get_perticular_field_value('zc_user','email_id'," and user_id='".$owner_id."'");
		if($user_id_from!=$owner_id){
			$rs=$this->propertym->add_message($new_message);
			if($rs){
				$user_id=$this->session->userdata( 'user_id' );
				$user_preference_loc = get_all_value('zc_user_preference'," and user_id='".$owner_id."'");
				$email_user=get_perticular_field_value('zc_user','email_id'," and user_id='".$user_id."'");
				if(isset( $user_preference_loc[0]) &&(count( $user_preference_loc[0]) > 0 )){
					if($user_preference_loc[0]['send_me_email'] == 1){
						$details=array();
						/*$mail_from = $email_user;*/
						$mail_from= isset($default_email) ? $default_email : "no-reply@zapcasa.it";
						$mail_to = $new_message['email_id_to'];
						$subject = $this->lang->line('new_mail_subject_replay');
						//$this->lang->line('new_mail_subject');
						$user_name = $this->input->post('name');
						$link = "";
						$message = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">
													<div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
														<div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
														<div style="border-bottom:1px solid #d1d1d1;">
															<img src="'.base_url().'assets/images/logo.png" alt="ZapCasa"/>
														</div>
														<div style="padding:15px;">
															<strong>'.$this->lang->line('new_mail-hi').' '.$new_message['user_name_to'].'</strong>
															<p>'.$this->lang->line('you_have_receive_new_mail').' '.$user_name.'</p>
															<p>'.$this->lang->line('to_read_and_reply').'. <a style="text-decoration:none;color:blue;" href="'.base_url().'property/get_message">'.$this->lang->line('click_here_mail').'</a></p>
															<p><br>'.$this->lang->line('regards_mail').',<br><a href="http://www.zapcasa.it">www.zapcasa.it</a></p>
														</div>
														<div style="padding:15px;border-top:1px solid #ddd;">
															<p>'.$this->lang->line('Messages_you_are_receiving_this_email_because').'</p>
														</div>
													</div>
												</body>';
						$body = $message;
						sendemail($mail_from, $mail_to, $subject, $body, $cc='');
					}
				}
				$msgdata =  $this->lang->line('advertiser_msg_your_message_is_posting_successfully');
				$this->session->set_flashdata('success',$msgdata);
				redirect('advertiser/advertiser_details/'.$owner_id);
			}
		}else{
			$msgdata = $this->lang->line('advertiser_msg_you_cant_message_yourself');
			$this->session->set_flashdata('error', $msgdata);
			redirect('advertiser/advertiser_details/'.$owner_id);
		}
	}
	public function agency_search_by_area($area) {
		$qry = "SELECT `province_name` FROM `zc_region_master` WHERE LOWER(`geo_breakdown`) = '".strtolower($area)."' group by `province_code`";
		$res = $this->advertiserm->pop_search($qry);
		$prov = array();
		$data = array();
		$data['advertiser_lists'] = array();
		$data['search_title'] = 'Agency List';
		$data['area'] = $area;
		if( count( $res ) > 0 ) {
			foreach($res as $resVal) {
				
				$prov[] = "'".str_replace("\'","\\\\''",strtolower($resVal['province_name']))."'";
			}
			$provinces = implode(",",$prov);
			$qry2 = "select * from zc_user left join zc_user_preference on zc_user.user_id = zc_user_preference.user_id where LOWER(`province`) IN (".$provinces.") AND user_type='3' and zc_user.status != '0' and zc_user_preference.invisible = '0' and zc_user_preference.my_address_display = '0' order by zc_user.user_id DESC";		
			$res2 = $this->advertiserm->pop_search($qry2);
			$uid = array();
			if( count( $res2 ) > 0 ) {	
				foreach($res2 as $resVal2) {
					$uid[] = "'".$resVal2['user_id']."'";			
				}
				$userid = implode(",",$uid);
				$config = array();
				$config['base_url'] = base_url() . '/advertiser/agency_search_by_area/'.$area.'?search=true';
				
				$total_row = count($res2);
				$config['query_string_segment'] = 'offset';
				$config['page_query_string'] = true;
				$config['total_rows'] =  $total_row;
				$config['per_page'] = 10;

				if (!empty($_GET['offset'])) {
					$offset = $_GET['offset'];
				} else {
					$offset = 0;
				}
				$this->pagination->initialize($config);
				$data["links"] = $this->pagination->create_links();
				$data['total_row'] = isset($total_row) ?$total_row : 0;
				$qry3 = "SELECT * FROM `zc_user` WHERE `user_id` IN (".$userid.") AND `status` = '1'";
				$data['advertiser_lists']=$this->advertiserm->pop_search($qry3);
				$this->load->view('advertiser/estate_agency',$data);	
			} else {
				$data['total_row'] = 0;
				$this->load->view('advertiser/estate_agency',$data);	
			}	
		} else {
			$data['total_row'] = 0;
			$this->load->view('advertiser/estate_agency',$data);	
		}
	}
	function add_feedback(){
		if( $this->session->userdata( 'user_id' ) == 0 || $this->session->userdata( 'user_id' ) == "" ) {
			//redirect('/');
		}
		$new_data=array();
		$agree_terms = 0;
		$receive_mail = 0;
		if( isset($_POST['agree_terms']) ) {
			$agree_terms = $this->input->post('agree_terms');
		}
		if( isset($_POST['receive_mail']) ) {
			$receive_mail = $this->input->post('receive_mail');
		}
		$owner_id=$this->input->post('owner_id');
		$new_data['feedback_date']=date('d-m-Y');
		$new_data['feedback_subject']=$this->input->post('subject');
		$new_data['feedback_msg']=$this->input->post('message');
		$new_data['user_email']=$this->input->post('email_id');
		$new_data['user_name']=$this->input->post('name');
		$new_data['feedback_to_id']= $owner_id;

		$new_data['privacy_policy']=$agree_terms;
		$new_data['newsletter']= $receive_mail;

		if($this->session->userdata('user_id') != '') {
			$new_data['user_status_type']= '1';
		}else{
			$new_data['user_status_type']= '0';
		}
		if($this->session->userdata( 'user_id')!=$owner_id){			
			$rs=$this->propertym->add_feedback($new_data);
			if($rs) {
				if($this->session->userdata( 'user_id' ) != ''){			 
					$user_id=$this->session->userdata( 'user_id' );
					$email_user=get_perticular_field_value('zc_user','email_id'," and user_id='".$user_id."'");
				}else{
					$email_user=$this->input->post('email_id');
				}
				
				$user_preference_loc = get_all_value('zc_user_preference'," and user_id='".$owner_id."'");
				$user_name=get_perticular_field_value('zc_user','first_name'," and user_id='".$owner_id."'")." ".get_perticular_field_value('zc_user','last_name'," and user_id='".$owner_id."'");
				$email_user_to=get_perticular_field_value('zc_user','email_id'," and user_id='".$owner_id."'");
				if(isset( $user_preference_loc[0]) &&(count( $user_preference_loc[0]) > 0 )){
					
					if( $user_preference_loc[0]['send_me_email'] == 1){
						
						$mail_from= isset($default_email) ? $default_email : "no-reply@zapcasa.it";
						$mail_to=$email_user_to;
						$subject= $this->lang->line('new_feedback_mail_subject_text');
						
						//$link = base_url().'My_Feedback/'.$rs.'/details';
						$msg = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">
									<div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
										<div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
										<div style="border-bottom:1px solid #d1d1d1;">
											<img src="'.base_url().'assets/images/logo.png" alt="ZapCasa">
										</div>
										<div style="padding:15px;">
											<strong>'.$this->lang->line('new_mail-hi').' '.$user_name.',</strong>
											<p>'.$this->lang->line('new_feedback_mail_you_have_received_a_new_feedback_from').'.</p>
											<p>'.$this->lang->line('new_feedback_mail_to_red_id').' <a style="text-decoration:none;color:blue;" href="'.base_url().'My_Feedback">'.$this->lang->line('new_feedback_mail_click_here').'</a></p>
											<p><br>'.$this->lang->line('regards_mail').',<br><a href="http://www.zapcasa.it">www.zapcasa.it</a></p>
										</div>
										<div style="padding:15px;border-top:1px solid #ddd;">
											<p>'.$this->lang->line('Messages_you_are_receiving_this_email_because').'</p>
										</div>
									</div>
								</body>';
						$body=$msg;
						
						sendemail($mail_from, $mail_to, $subject, $body, $cc='');
					}
				}
				$msgdata = $this->lang->line('advertiser_msg_your_feedback_is_posting_successfully');
				$this->session->set_flashdata('success_feedback', $msgdata);
				redirect('advertiser/advertiser_details/'.$owner_id);
			}

		} else{
			$msgdata = $this->lang->line('advertiser_msg_you_cant_feedback_yourself');
			$this->session->set_flashdata('error_feedback', $msgdata);
			redirect('advertiser/advertiser_details/'.$owner_id);
		}
	}
	public function del_bulk_msg() {
		$msgId = $this->input->get('dataField');
		$msg_ids = explode('|',$msgId);
		//print_r($msg_ids);die;
		$user_id=$this->session->userdata('user_id');
		foreach($msg_ids as $mid){	
			$delete_msg_ids=$mid;	 
			$msgDetails = get_all_value('zc_feedback'," and feedback_id='".$delete_msg_ids."'");
			if(($msgDetails[0]['feedback_from_delete'] == '1' && $msgDetails[0]['feedback_to_delete'] == '0')){
				//echo $rs=$this->advertiserm->delete_bulk_feedback($delete_msg_ids);	
			}else {
				if($user_id==$msgDetails[0]['feedback_to_id']){
					/*$this->advertiserm->insert_update("update zc_feedback set feedback_to_delete = '1' where feedback_id='".$delete_msg_ids."'");*/
					$rs=$this->advertiserm->delete_bulk_feedback($delete_msg_ids);
				}else{
					$this->advertiserm->insert_update("update zc_feedback set feedback_from_delete = '1' where feedback_id='".$delete_msg_ids."'");
				}
			}
		}
		$msg = $this->lang->line('advertiser_info_feedback_delete_message');
		$newdata = array("delete_feedback_message" => $msg);	 
		$this->session->set_userdata($newdata);
	}
}
?>