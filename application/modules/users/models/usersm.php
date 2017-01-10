<?php
class usersm extends CI_Model {
    //put your code here
    public function __construct() {
        parent::__construct();
    }	
	public function check_login($credentials){
		$this->db->select('user_id,status,blocked_note');
		$loginWhereClause = array(
			'user_id' => $credentials['user_id'],
			'password' => $credentials['password'],
			'verified' => '1'
		);
		$query = $this->db->get_where('zc_user', $loginWhereClause);
		//echo $this->db->last_query();
		return $query->result_array();
    }
	public function check_lang($user_id=0){
		$this->db->select('user_id');	
		$query = $this->db->get_where('zc_user_preference', array( 'user_id' => $user_id ));
		if($query->num_rows()>0){
			$res=$query->result_array();
			if($res[0]['language']!=''){
				return $res[0]['language'];
			}else{
				return 1;
			}
		}else{
			return 1;
		}		
	}
	public function user_profile($uid) {
		$sql = "select * from zc_user where user_id='".$uid."'";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
			return $data;
		}		
	}
	public function get_state_list() {
		$sql = "SELECT ".($_COOKIE['lang']=='it'?"province_name_it":"province_name")." FROM `zc_region_master` GROUP BY ".($_COOKIE['lang']=='it'?"province_name_it":"province_name")."";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row[($_COOKIE['lang']=='it'?'province_name_it':'province_name')];
			}
			return $data;
		}		
	}
	public function get_state_list_it() {
		$sql = "SELECT province_name_it FROM `zc_region_master` GROUP BY province_name";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[] = $row['province_name_it'];
			}
			return $data;
		}		
	}
	public function get_province() {
		$query=$this->db->get("zc_state_master");
		$result=array();
		$count=0;
		foreach($query->result_array() as $row) {
			$result[]=$row;
		}
		return $result;
	}
	public function get_city($province,$lang) {
		if($lang=="it"){
			if(!strpos($province, "'")===false){
				$sql = "SELECT city_it FROM `zc_region_master` WHERE (province_name = '".str_replace("'","\''",$province)."' OR province_name_it = '".str_replace("'","\''",$province)."')";
			}else{
				$sql = "SELECT city_it FROM `zc_region_master` WHERE (province_name LIKE '%".$province."%' OR province_name_it LIKE '%".$province."%')";
			}
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				foreach($query->result_array() as $row){
					$data[] = $row['city_it'];
				}
				return $data;
			}
		}else{
			if(!strpos($province, "'")===false){
				$sql = "SELECT city FROM `zc_region_master` WHERE (province_name = '".str_replace("'","\''",$province)."' OR province_name_it = '".str_replace("'","\''",$province)."')";
			}else{
				$sql = "SELECT city FROM `zc_region_master` WHERE (province_name LIKE '%".$province."%' OR province_name_it LIKE '%".$province."%')";
			}
			$query = $this->db->query($sql);
			if($query->num_rows()>0){
				foreach($query->result_array() as $row){
					$data[] = $row['city'];
				}
				return $data;
			}	
		}
	}
	public function getUsers() {
		$sql = "select * from users where user_id != 1";
		$row = $this->db->query($sql);
		if($row->num_rows() > 0){
			$result = $row->result();
			return $result;
        }else{
			return 0;
        }
    }
	public function getUser($id) {
		$sql = "select * from users where user_id = ".$id;
		$row = $this->db->query($sql);
		if($row->num_rows() > 0){
			$result = $row->row(0);
			return $result;
        }else{
			return 0;
        }
    }
	public function insertUser($arrVal) {
		$this->db->insert('zc_user', $arrVal);
		return $this->db->insert_id();
    }
	public function updateUser($arrVal) {
		$this->db->where('user_id', $arrVal['user_id']);
		$this->db->update('users', $arrVal);
		return $this->db->insert_id();
    }
	public function get_country() {		 
		$query=$this->db->get("zc_country_master");
		$result=array();
		$count=0;
		foreach($query->result_array() as $row) {
			$result[]=$row;
		}
		return $result;
	}
	public function change_pwd($user_id,$pwd) {
		$sql="update zc_user set password='".$pwd."' where user_id='".$user_id."'";
		return $this->db->query($sql);
	}
	public function activate_user($access_token,$uid) {
		$sql="update zc_user set status='1',activation_on=now(),verified='1' where user_id='".$uid."' and password='".$access_token."'";
		return $this->db->query($sql);
	}
	public function new_preference($uid,$new_email_not) {
		$new_data = array();
		$new_data['user_id'] = $uid;
		$new_data['send_me_email']='1';
		$new_data['reply_msg']='1';
		$new_data['email_alerts']='1';
		$new_data['newsletter']=$new_email_not;
		return $this->db->insert('zc_user_preference', $new_data);	
	}
	public function pref_info($new_data){
		$cnt=get_perticular_count('zc_user_preference'," and user_id='".$this->session->userdata( 'user_id' )."'");
		if($cnt<=0){
			$this->db->insert('zc_user_preference', $new_data);
			return $user_id = $this->db->insert_id();
		}else{
			if($this->input->post('send_me_email')!=''){
				$send_me_email=$this->input->post('send_me_email');
			}else{
				$send_me_email=0;
			}
			if($this->input->post('reply_msg')!=''){
				$reply_msg=$this->input->post('reply_msg');
			}else{
				$reply_msg=0;
			}
			if($this->input->post('email_alerts')!=''){
				$email_alerts=$this->input->post('email_alerts');
			}else{
				$email_alerts=0;
			}
			if($this->input->post('newsletter')!=''){
				$newsletter=$this->input->post('newsletter');
			}else{
				$newsletter=0;
			}
			if($this->input->post('invisible')!=''){
				$invisible=$this->input->post('invisible');
			}else{
				$invisible=0;
			}
			if($this->input->post('my_address_display')!=''){
				$my_address_display=$this->input->post('my_address_display');
			}else{
				$my_address_display=0;
			}
			if($this->input->post('language_nm')!=''){
				$language=$this->input->post('language_nm');
			}else{
				$my_address_display=0;
			}
			if($this->input->post('my_contact_info')!=''){
				$my_contact_info=$this->input->post('my_contact_info');
			}else{
				$my_contact_info=0;
			}
			$update_sql="update zc_user_preference set send_me_email ='".$send_me_email."',reply_msg='".$reply_msg."',email_alerts='".$email_alerts."',newsletter='".$newsletter."',invisible ='".$invisible."',my_address_display='".$my_address_display."',my_contact_info ='".$my_contact_info."',language ='".$language."' where user_id='".$this->session->userdata( 'user_id' )."'";
			return $this->db->query($update_sql);
		}
	}
	public function get_pref_info(){
		$uid=$this->session->userdata( 'user_id' );
		$sql="select * from zc_user_preference where user_id='".$uid."'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
			return $data;
		}
	}
	public function upadte_owner($new_user,$uid){
		$update_sql="update zc_user set city='".$new_user['city']."',
		province='".$new_user['province']."',
		street_address='".$new_user['street_address']."',
		street_no='".$new_user['street_no']."',
		zip='".$new_user['zip']."',
		phone_1='".$new_user['phone_1']."',
		phone_2='".$new_user['phone_2']."',
		email_id='".$new_user['email_id']."',
		location='".$new_user['location']."',
		about_me='".$new_user['about_me']."' where user_id='".$uid."'";
		return $this->db->query($update_sql);
	}
	public 	function upadte_user($new_user,$uid){
		$update_sql="update zc_user set first_name = '".$new_user['first_name']."',
		last_name='".$new_user['last_name']."',
		contact_ph_no='".$new_user['contact_ph_no']."',
		date_of_birth='".$new_user['date_of_birth']."',
		city='".$new_user['city']."',
		country='".$new_user['country']."',
		email_id='".$new_user['email_id']."' where user_id='".$uid."'";
		return $this->db->query($update_sql);
	}
	public function upadte_agency($new_user,$uid){
		$update_sql="update zc_user set first_name='".$new_user['first_name']."',
		last_name='".$new_user['last_name']."',
		contact_ph_no='".$new_user['contact_ph_no']."',
		city='".$new_user['city']."',
		province='".$new_user['province']."',
		street_address='".$new_user['street_address']."',
		street_no='".$new_user['street_no']."',
		zip='".$new_user['zip']."',
		phone_1='".$new_user['phone_1']."',
		phone_2='".$new_user['phone_2']."',
		fax_no='".$new_user['fax_no']."',
		website='".$new_user['website']."',
		email_id='".$new_user['email_id']."',
		location='".$new_user['location']."',
		about_me='".$new_user['about_me']."' where user_id='".$uid."'";
		return $this->db->query($update_sql);
	}

	public function edit_user_land($new_user, $uid)
	{
		$query = $this->db->query("SELECT * FROM zc_user WHERE user_id='" . $uid . "'");
		$res = $query->result();


		$where = "user_id = '" . $uid . "'";
		$str = $this->db->update('zc_user', $new_user, $where);
	}
	public function update_profile_1($file_name,$uid){
		$sql="update zc_user set file_1='".$file_name."' where user_id='".$uid."'";
		return $this->db->query($sql);
	}
	public function update_profile_2($file_name,$uid){
		$sql="update zc_user set file_2='".$file_name."' where user_id='".$uid."'";
		return $this->db->query($sql);
	}
	public function delete_img($uid,$file=''){
		//echo $file;
		if($file==1){
			$file_name='file_1';
		}
		if($file==2){
			$file_name='file_2';
		}
		$sql_delete="update zc_user set ".$file_name."='' where user_id='".$uid."'";
		return $this->db->query($sql_delete);
	}
	public function change_password($uid,$password){
		$sql_update_pwd="update zc_user set password='".$password."' where user_id='".$uid."'";
		return $this->db->query($sql_update_pwd);
	}
	public function del_acc(){
		$uid=$this->session->userdata( 'user_id' );
		$properties="select * from zc_property_details where property_post_by='".$uid."'";
		$query=$this->db->query($properties);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$property_id=$row['property_id'];
				/*delete images from db*/
				$del_img="delete from zc_property_img where property_id='".$property_id."'";
				$this->db->query($del_img);
				/*delete folder from asset*/
				$file_name='Property'.$property_id;
				$file1='asset/uploads/Property/'.$file_name;
				$this->delete_files($file1);
				$sql_prop_feature="delete from zc_property_featured where property_id='".$property_id."'";
				$this->db->query($sql_prop_feature);
				$sql_prop_details="delete from zc_property_details where property_id='".$property_id."'";
				$this->db->query($sql_prop_details);
			}
		}
		//echo '<pre>';print_r($property_id);
		/*delete saved search*/
		$del_save_search="delete from zc_save_search where saved_by_user_id='".$uid."'";
		$this->db->query($del_save_search);
		$del_msg="delete from zc_property_message_info where user_id_to='".$uid."' or user_id_from='".$uid."'";
		$this->db->query($del_msg);
		$del_feedback="delete from zc_feedback where feedback_to_id='".$uid."'";
		$this->db->query($del_feedback);
		$sql_user="delete from zc_user where user_id='".$uid."'";
		return $this->db->query($sql_user);
	}
	public function delete_files($target) {
		if(is_dir($target)){
			$files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
			foreach( $files as $file ){
				delete_files( $file );
			}
			$thumb_200_296=$target.'/thumb_200_296';
			$thumb_92_82=$target.'/thumb_92_82';
			rmdir( $thumb_200_296 );
			rmdir( $thumb_92_82 );
			rmdir( $target );
		} elseif(is_file($target)) {
			unlink( $target );  
		}
	}
	public function UserListForNotActvAftr72hrs(){
		$sql = "SELECT `user_id` FROM `zc_user` WHERE `registered_on` < DATE_SUB(NOW(), INTERVAL 3 DAY) AND `verified`='0' ORDER BY `zc_user`.`user_id` ASC";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
			return $data;
		}		
	}
	public function DeltheseUsersForNotActvAccAftr72hrs($userIDarray){
		foreach($userIDarray as $userID){
			$sql_user = "DELETE FROM `zc_user` WHERE `user_id`='".$userID['user_id']."'";
			$this->db->query($sql_user);
		}
	}


	 function pop_search($qry)
	 {
		 $query = $this->db->query($qry);	 
		 if($query->num_rows()>0){
	 			
	 		foreach($query->result_array() as $row){
	 			$data[]=$row;
	 		}
	 		return $data;
	 			
	 	}
	 }
	 
	 function insert_update($qry)
	 {
		 $query = $this->db->query($qry);
		 return $this->db->insert_id();
	 }
	
	
}
?>
