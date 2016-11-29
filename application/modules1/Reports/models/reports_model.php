<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports_model extends CI_Model{
	
	function get_list_of_property($limit, $start) {
		$str = "";
		//$str.=" AND add_to_luxury='1'";
		$sql="SELECT * FROM zc_property_details WHERE property_approval='1' AND suspention_status='0' AND property_status='2'".$str." ORDER BY `feature_status` DESC LIMIT $start ,$limit";
		$query=$this->db->query($sql);	
		$data = array();
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	
	function get_saved_property() {
		$str = "";
		$sql="SELECT ps.*,p.property_id,p.property_post_by_type FROM zc_saved_property as ps JOIN zc_property_details as p ON( p.property_id = ps.property_id ) WHERE ps.property_id != 0";
		$query=$this->db->query($sql);
		$data = array();
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	
	function get_list_of_user() {
		$str = "";
		$sql="SELECT u.user_id,u.registered_on,u.user_type FROM zc_user as u WHERE u.status = '1' AND u.user_type != 4";
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