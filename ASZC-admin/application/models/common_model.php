<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Common_model extends CI_Model{
	public function get_all_property(&$config, $start, $whereClause) {
		/*$data = array();
		$sql="SELECT * FROM `zc_nearbyproperty_details`";
		$query=$this->db->query($sql);if($query->num_rows()>0){		$data = $query->result_array();
		}
		return $data;
		*/
		$this->db->select('property_details_id');
		$this->db->order_by("property_details_id","desc");
		$this->db->where($whereClause);
		$query = $this->db->get('nearbyproperty_details');		
		$config['total_rows'] = $query->num_rows();
		$this->db->where($whereClause);
		$this->db->limit($config['per_page'], $start);
		$this->db->order_by("property_details_id","desc");
		$query = $this->db->get('nearbyproperty_details');
		$this->db->last_query();
		return $result = $query->result_array();
	}
	public function dashboardLatestProperties(){
		$data = array();
		$sql="SELECT * FROM `zc_property_details` WHERE `property_status`='2' AND suspention_status='0' ORDER BY `property_id` DESC LIMIT 0,10";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			$data = $query->result_array();
		}
		return $data;
	}
	public function dashboardLatestPropertiesTotal(){
		$sql="SELECT * FROM `zc_property_details` WHERE `property_status`='2' AND property_approval='1' ORDER BY `property_id` DESC";
		$query=$this->db->query($sql);
		return $query->num_rows();
	}
	public function dashboardLatestUsers(){
		$data = array();
		//$sql="SELECT u.* FROM `zc_user` as u JOIN `zc_property_details` as p ON u.`user_id` = p.`property_post_by` WHERE (u.`user_type`='2' || u.`user_type`='3') AND u.`status`='1' GROUP BY u.`user_id` ORDER BY u.`user_id` DESC LIMIT 0,10";
		$sql="SELECT * FROM `zc_user` WHERE (`user_type`='2' || `user_type`='3') AND `status`='1' AND verified = '1' ORDER BY `user_id` DESC LIMIT 0,10";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			$data = $query->result_array();
		}
		return $data;
	}
	public function dashboardLatestUsersTotal(){
		// $sql="SELECT * FROM `zc_user` WHERE (`user_type`='2' || `user_type`='3') AND `status`='1' ORDER BY `user_id` DESC";
		$sql="SELECT u.* FROM `zc_user` as u JOIN `zc_property_details` as p ON u.`user_id` = p.`property_post_by` WHERE (u.`user_type`='2' || u.`user_type`='3') AND u.`status`='1' GROUP BY u.`user_id`";
		$query=$this->db->query($sql);
		return $query->num_rows();
	}
	public function get_provience_list(){
		$data = array();
		$sql="SELECT `province_name` FROM `zc_region_master` GROUP BY `province_name`";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row['province_name'];
			}
			return $data;
		}
	}
	function get_city_list_all() {
		$data = array();
		$sql="SELECT City FROM `zc_region_master`";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row['City'];
			}
			return $data;
		}
	}
	function get_city_list($province) {
		$data = array();
		$sql="SELECT City FROM `zc_region_master` WHERE `province_name` LIKE '".$province."'";		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row['City'];
			}
			return $data;
		}
	}	public function get_list_of_category() {
		$data = array();
		$sql="SELECT * FROM `zc_nearbyproperty_category`";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			$data = $query->result_array();
		}
		return $data;
	}
	function get_category_list() {
		$data = array();
		$sql="SELECT * FROM `zc_nearbyproperty_category` WHERE `status`=1";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			$data = $query->result_array();
		}
		return $data;
	}
	public function common_update_by_attribute_name($dataStr, $updatByPrms,$attr ,$table_name){
		$sql_query = "UPDATE `".$this->db->dbprefix($table_name)."` SET $dataStr WHERE $attr='".$updatByPrms."'";
		$this->db->query($sql_query);
	}
	public function common_get_details_by_attribute_name($dataStr, $attr ,$table_name){
		$sql_query = "SELECT * FROM `".$this->db->dbprefix($table_name)."` WHERE $attr = '".$dataStr."' ";
		$query = $this->db->query($sql_query);
		return $result = $query->result();
	}
	public function common_update_by_conditions($dataForPostEvent, $conditions,$tableName){
		$sql_query = "UPDATE `".$this->db->dbprefix($tableName)."` SET $dataForPostEvent WHERE $conditions";
		$this->db->query($sql_query);
	}
	public function getLangLat($address) {
		$address = urlencode($address);
		$request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=" . $address . "&sensor=true";
		$xml = simplexml_load_file($request_url);
		if ($xml->status && $xml->status == "OK") {
			return $xml->result->geometry->location;
		} else {
			return (object) array('lat' => '', 'lng' => '');
		}
	}
	public function delete_property($property_id){
		$sql="Delete from zc_nearbyproperty_details where property_details_id='".$property_id."'";
		return $this->db->query($sql);
	}
	public function update_admin_account(){
		$adminDetails = get_all_value('zc_user'," AND `user_type`='4'");
		$newUserName = $_POST['user_name'];
		$newUserPass = ($_POST['password']==''?$adminDetails[0]['password']:md5($_POST['password']));
		$newUserFtNm = $_POST['first_name'];
		$newUserLtNm = $_POST['last_name'];
		$newUserCmNm = $_POST['company_name'];
		$sql="update zc_user set user_name='".$newUserName."',
				password='".$newUserPass."',
				first_name='".$newUserFtNm."',
				last_name='".$newUserLtNm."',
				company_name='".$newUserCmNm."' 
				where user_type='4'";
				return $this->db->query($sql);
	}

	public function get_property_detail($property_id){
		$sql="SELECT * FROM `zc_nearbyproperty_details` where property_details_id='".$property_id."'";
		$query=$this->db->query($sql);
		$data = array();
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
}
?>