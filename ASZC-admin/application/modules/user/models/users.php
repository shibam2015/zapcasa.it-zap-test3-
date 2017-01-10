<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Model{
    public function getUsers(&$config, $start,$whereClause){
        $this->db->select('user_id');
        $this->db->where($whereClause);
        $query = $this->db->get('user');
        $config['total_rows'] = $query->num_rows();
        $this->db->where($whereClause);
        $this->db->limit($config['per_page'], $start);
		$this->db->order_by("user_id", "desc");		
        $query = $this->db->get('user');
        return $query->result();
    }

	public function user_profile($user_id)
	{
		$sql = "select * from zc_user where user_id='" . $user_id . "'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	public function getUsers1(&$config, $start,$type=''){
        $this->db->select('user_id');
        $this->db->where(array('user_type' =>$type));
        $query = $this->db->get('user');
        $config['total_rows'] = $query->num_rows();        
        $this->db->where(array('user_type' =>$type));
        $this->db->limit($config['per_page'], $start);
		
		$this->db->order_by("user_id", "desc");
		
        $query = $this->db->get('user');
        return $query->result();
    }
	public function letestactivated_user(){
        $this->db->select('*');
        $this->db->where(array('user_type !=' =>'4'));  
		$this->db->where(array('status' =>'1'));	
		$this->db->order_by('user_id','DESC');
        $this->db->limit(10,0);
		
		$this->db->order_by("user_id", "desc");
		
        $query = $this->db->get('user');
        return $query->result();
    }
	public function get_state_list(){
		$sql="SELECT `province_name` FROM `zc_region_master` GROUP BY `province_name`";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row['province_name'];
			}
			return $data;
		}
	}
	public  function get_city($province){
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
	public function get_country(){
		$query=$this->db->get("zc_country_master");
		$result=array();
		$count=0;
		foreach($query->result_array() as $row){
			$result[]=$row;
		}
		return $result;
	}
    public function getUserById($id){
        $this->db->where('user_id', $id);
        return $this->db->get('user')->row();
    }
    public function updateUser($data, $id){
        $this->db->update('user', $data, array('user_id' => $id));
    }
	public function del_user($user_id){
		$user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$user_id."'");
		if($user_type=='2' || $user_type=='3'){
			$sql_getPropertyId="SELECT property_id,property_post_by FROM `zc_property_details` WHERE `property_post_by`=".$user_id;	
			$query_getPropertyId=$this->db->query($sql_getPropertyId);
			$property_id = 0;
			$i=0;
			if($query_getPropertyId->num_rows()>0){
				foreach($query_getPropertyId->result_array() as $row){
					if( $i == 0 ) {
						$property_id = $row['property_id'];
						$i++;
					} else {
						$property_id = $property_id.",".$row['property_id'];
					}
				}
			}
			$sql_prop="delete from zc_property_details where property_id IN ($property_id)";
			$this->db->query($sql_prop);
			$sql_prop="delete from zc_property_img where  property_id IN ($property_id)";
			$this->db->query($sql_prop);
		}
		$sql="delete from zc_user where user_id='".$user_id."'";
		return $this->db->query($sql);
	}	
	public function get_user_detail($user_id){
		$sql="select * from zc_user where user_id='".$user_id."'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
			return $data;
		}
	}
	public function add_user_update($user_id){
		$sql="update zc_user set 
				first_name='".$_POST['first_name']."',
				last_name='".$_POST['last_name']."',
				date_of_birth='".$_POST['date_of_birth']."',
				gender='".$_POST['gender']."',
				country='".$_POST['country']."',
				city='".$_POST['city']."',
				contact_ph_no='".$_POST['contact_ph_no']."',
				email_id='".$_POST['email_id']."',
				receive_mail='".$_POST['receive_mail']."',
				user_type='".$_POST['user_type']."',
				status='".$_POST['status']."' 
				where user_id='".$user_id."'";
		return $this->db->query($sql);
	}
	public function general_user_update($user_id){
		$sql="update zc_user set 
				first_name='".$_POST['first_name']."',
				last_name='".$_POST['last_name']."',
				date_of_birth='".$_POST['date_of_birth']."',
				gender='".$_POST['gender']."',
				country='".$_POST['country']."',
				city='".$_POST['city']."',
				contact_ph_no='".$_POST['contact_ph_no']."',
				email_id='".$_POST['email_id']."'
				where user_id='".$user_id."'";
		return $this->db->query($sql);
	}
	public function general_owner_update($user_id){
		$update_sql="update zc_user set
		first_name='".$this->input->post('first_name')."',
		last_name='".$this->input->post('last_name')."',
		social_secuirity_number='".$this->input->post('social_secuirity_number')."',
		date_of_birth='".$this->input->post('date_of_birth')."',
		city='".mysql_real_escape_string($this->input->post('city'))."',
		province='".mysql_real_escape_string($this->input->post('province'))."',
		street_address='".$this->input->post('street_address')."',
		street_no='".$this->input->post('street_no')."',
		zip='".$this->input->post('zip')."',
		phone_1='".$this->input->post('phone_1')."',
		phone_2='".$this->input->post('phone_2')."',
		email_id='".$this->input->post('email_id')."',
		posting_property_limit ='".$this->input->post('posting_property_limit')."'
		where user_id='".$user_id."'";
		
		$update_sql_about_me='update zc_user set about_me="'.$this->input->post('about_me').'" where user_id='.$user_id;
		$this->db->query($update_sql_about_me);
		return $this->db->query($update_sql);
	}
	public function general_company_update($user_id){
		$update_sql="update zc_user set
		company_name='".$this->input->post('company_name')."',
		business_name='".$this->input->post('business_name')."',
		vat_number='".$this->input->post('vat_number')."',
		first_name='".$this->input->post('first_name')."',
		last_name='".$this->input->post('last_name')."',
		contact_ph_no='".$this->input->post('contact_ph_no')."',
		city='".mysql_real_escape_string($this->input->post('city'))."',
		province='".mysql_real_escape_string($this->input->post('province'))."',
		street_address='".$this->input->post('street_address')."',
		street_no='".$this->input->post('street_no')."',
		zip='".$this->input->post('zip')."',
		phone_1='".$this->input->post('phone_1')."',
		phone_2='".$this->input->post('phone_2')."',
		fax_no='".$this->input->post('fax_no')."',
		website='".$this->input->post('website')."',
		email_id='".$this->input->post('email_id')."',
		posting_property_limit ='".$this->input->post('posting_property_limit')."'
		where user_id='".$user_id."'";

		$update_sql_about_me='update zc_user set about_me="'.$this->input->post('about_me').'" where user_id='.$user_id;
		$this->db->query($update_sql_about_me);
		return $this->db->query($update_sql);
	}
	function update_profile_1($file_name,$uid){
		$uid=$this->uri->segment('3');
		$sql="update zc_user set file_1='".$file_name."' where user_id='".$uid."'";
		return $this->db->query($sql);
	}
	function update_profile_2($file_name,$uid){
		$uid=$this->uri->segment('3');
		$sql="update zc_user set file_2='".$file_name."' where user_id='".$uid."'";
		return $this->db->query($sql);
	}
	public function get_user_det(&$config, $start,$whereClause,$search_input){
		$data = array();
		$numRows = 0;
		if($search_input!=''){
			$sqlWithOutLimit="select * from zc_user where ".$whereClause." 
					and (user_name Like'%".$search_input."%' or 
					first_name Like'%".$search_input."%' or 
					last_name Like'%".$search_input."%' or 
					email_id ='".$search_input."' OR 
					vat_number ='".$search_input."' OR 
					social_secuirity_number ='".$search_input."')";
			$query=$this->db->query($sqlWithOutLimit);
			$numRows = $query->num_rows();
			$sql = $sqlWithOutLimit." LIMIT ".$start.", ".$config['per_page'];
			$query=$this->db->query($sql);
			if($query->num_rows()>0){
				foreach($query->result() as $row){
					$data[]=$row;
				}
				
			}
		}
		$config['total_rows'] = $numRows;
		return $data;
	}
	public function get_user_search_id($user_name){
		$str = ' AND 0';
		if($user_name!=''){			
			$sql="select GROUP_CONCAT(`user_id` SEPARATOR ',') AS `user_id` from zc_user where user_type!='4' and user_name Like'%".$user_name."%' or first_name Like'%".$user_name."%' or last_name Like'%".$user_name."%' or email_id ='".$user_name."' OR vat_number ='".$user_name."' OR social_secuirity_number ='".$user_name."'";
			$query=$this->db->query($sql);
			if($query->num_rows()>0){
				$row = $query->result();
				if($row[0]->user_id){
					$str = " AND `user_id` IN (".$row[0]->user_id.")";
				}
			}
		}
		return $str;
	}
	function get_msg_detail($uid,$limit, $start) {
		$this->db->where('user_id_to =',$uid);
		$this->db->or_where('user_id_from =',$uid);
		$this->db->group_by("msg_grp_id");
		$this->db->limit($limit, $start);
		$query = $this->db->get("zc_property_message_info");
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row;
			}
		}
		return $data;
	}
	function get_property_msg($msg_grp_id) {
		$this->db->where('msg_grp_id =',$msg_grp_id);
		$this->db->order_by("msg_date", "desc");
		$query = $this->db->get("zc_property_message_info");
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row;
			}
		}
		return $data;
	}
	function get_feedback($feedback_to_id) {
		$sql="select * from zc_feedback where feedback_to_id='".$feedback_to_id ."' and feedback_status='1'";
		$query=$this->db->query($sql);
		$data = array();
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	function get_user_feddback($uid,$limit, $start){
		$this->db->where('feedback_to_id =',$uid);
		$this->db->where(array('feedback_status =' =>'1' ));
		$this->db->limit($limit, $start);
		$query = $this->db->get("zc_feedback");
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row;
			}
		}
		return $data;
	}
	function get_feedback_details($msg_id) {
		$sql="select * from zc_feedback where feedback_id='".$msg_id ."' and feedback_status='1'";
		$query=$this->db->query($sql);	
		$data = array();
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	public function insertUser($arrVal) {
		$this->db->insert('zc_user', $arrVal);
		return $this->db->insert_id();
    }
	public function get_pref_info($uid){
		$sql="select * from zc_user_preference where user_id='".$uid."'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
			return $data;
		}
	}
}
?>