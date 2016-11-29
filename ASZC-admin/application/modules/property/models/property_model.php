<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Property_model extends CI_Model{
	public function get_all_property(&$config, $start, $search_property_code, $type, $activetype, $sqlMore){		
		$search_property_code = substr($search_property_code,1);
		if($search_property_code){
			switch($activetype){
				case 'all':
					$sqlQuery = "SELECT * FROM (
						SELECT *, md5(`property_id`) AS `ref_token` 
						FROM `zc_property_details` WHERE `property_status`!='0'
					) 
					AS p WHERE `ref_token` LIKE '".$search_property_code."%' ";
					break;
				case 'activepro':
					$sqlQuery = "SELECT * FROM (
						SELECT *, md5(`property_id`) AS `ref_token` 
						FROM `zc_property_details` WHERE `property_status`!='0' AND property_status='2' AND suspention_status='0'
					) 
					AS p WHERE `ref_token` LIKE '".$search_property_code."%' ";
					break;
				case 'inactivepro':
					$sqlQuery = "SELECT * FROM (
						SELECT *, md5(`property_id`) AS `ref_token` 
						FROM `zc_property_details` WHERE `property_status`!='0' AND property_approval='0'
					) 
					AS p WHERE `ref_token` LIKE '".$search_property_code."%' ";
					break;
				case 'featured':
					$sqlQuery = $this->FeaturedSQL('1', $sqlMore);
					break;
				case 'suspended':
					$sqlQuery = $this->FeaturedSQL('0', $sqlMore);
					break;
			}
			
		}else{
			switch($type){
				case 'probyuser':
					switch($activetype){
						case 'all':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE `property_status`!='0' AND `property_post_by_type`='2'".$sqlMore;
							break;
						case 'activepro':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE `property_status`!='0' AND `property_post_by_type`='2' AND property_status='2' AND suspention_status='0'".$sqlMore;
							break;
						case 'inactivepro':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE `property_status`!='0' AND `property_post_by_type`='2' AND property_approval='0'".$sqlMore;
							break;
						case 'featured':
							$sqlQuery = $this->FeaturedSQL('1', $sqlMore);
							break;
						case 'suspended':
							$sqlQuery = $this->FeaturedSQL('0', $sqlMore);
							break;
					}
					break;
				case 'all':
					switch($activetype){
						case 'all':
							$sqlQuery = "SELECT * FROM `zc_property_details`".$sqlMore." WHERE 1";
							break;
						case 'activepro':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE property_status!='0' AND property_status='2' AND suspention_status='0'".$sqlMore;
							break;
						case 'inactivepro':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE property_status!='0' AND property_approval='0'".$sqlMore;
							break;
						case 'featured':
							$sqlQuery = $this->FeaturedSQL('1', $sqlMore);
							break;
						case 'suspended':
							$sqlQuery = $this->FeaturedSQL('0', $sqlMore);
							break;
					}
					break;
				case 'byowner':
					switch($activetype){
						case 'all':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE `property_status`!='0' AND `property_post_by_type`='2'".$sqlMore;
							break;
						case 'activepro':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE `property_status`!='0' AND `property_post_by_type`='2' AND property_status='2' AND suspention_status='0'".$sqlMore;
							break;
						case 'inactivepro':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE `property_status`!='0' AND `property_post_by_type`='2' AND property_approval='0'".$sqlMore;
							break;
						case 'featured':
							$sqlQuery = $this->FeaturedSQL('1', $sqlMore);
							break;
						case 'suspended':
							$sqlQuery = $this->FeaturedSQL('0', $sqlMore);
							break;
					}
					break;
				case 'byagency':
					switch($activetype){
						case 'all':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE `property_status`!='0' AND `property_post_by_type`='3'".$sqlMore;
							break;
						case 'activepro':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE `property_status`!='0' AND `property_post_by_type`='3' AND property_status='2' AND suspention_status='0'".$sqlMore;
							break;
						case 'inactivepro':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE `property_status`!='0' AND `property_post_by_type`='3' AND property_approval='0'".$sqlMore;
							break;
						case 'featured':
							$sqlQuery = $this->FeaturedSQL('1', $sqlMore);
							break;
						case 'suspended':
							$sqlQuery = $this->FeaturedSQL('0', $sqlMore);
							break;
					}
					break;
				case 'residentail':
					switch($activetype){
						case 'all':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE `property_status`!='0' AND (
											zc_property_details.category_id in (
												select category_id from zc_categories where parent_id =1
											) or zc_property_details.category_id in (1)
										)".$sqlMore;
							break;
						case 'activepro':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE `property_status`!='0' AND property_status='2' AND suspention_status='0'".$sqlMore;
							break;
						case 'inactivepro':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE property_status!='0' AND property_approval='0'".$sqlMore;
							break;
						case 'featured':
							$sqlQuery = $this->FeaturedSQL('1', $sqlMore);
							break;
						case 'suspended':
							$sqlQuery = $this->FeaturedSQL('0', $sqlMore);
							break;
					}
					break;
				case 'bussiness':
					switch($activetype){
						case 'all':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE `property_status`!='0' AND (
											zc_property_details.category_id in (
												select category_id from zc_categories where parent_id =2
											) or zc_property_details.category_id in (2)
										)".$sqlMore;
							break;
						case 'activepro':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE `property_status`!='0' AND property_status='2' AND suspention_status='0'".$sqlMore;
							break;
						case 'inactivepro':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE property_status!='0' AND property_approval='0'".$sqlMore;
							break;
						case 'featured':
							$sqlQuery = $this->FeaturedSQL('1', $sqlMore);
							break;
						case 'suspended':
							$sqlQuery = $this->FeaturedSQL('0', $sqlMore);
							break;
					}
					break;
				case 'rooms':
					switch($activetype){
						case 'all':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE `property_status`!='0' AND (
											zc_property_details.category_id in (
												select category_id from zc_categories where parent_id =3
											) or zc_property_details.category_id in (3)
										)".$sqlMore;
							break;
						case 'activepro':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE `property_status`!='0' AND property_status='2' AND suspention_status='0'".$sqlMore;
							break;
						case 'inactivepro':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE property_status!='0' AND property_approval='0'".$sqlMore;
							break;
						case 'featured':
							$sqlQuery = $this->FeaturedSQL('1', $sqlMore);
							break;
						case 'suspended':
							$sqlQuery = $this->FeaturedSQL('0', $sqlMore);
							break;
					}
					break;
				case 'land':
					switch($activetype){
						case 'all':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE `property_status`!='0' AND (
											zc_property_details.category_id in (
												select category_id from zc_categories where parent_id =4
											) or zc_property_details.category_id in (4)
										)".$sqlMore;
							break;
						case 'activepro':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE `property_status`!='0' AND property_status='2' AND suspention_status='0'".$sqlMore;
							break;
						case 'inactivepro':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE property_status!='0' AND property_approval='0'".$sqlMore;
							break;
						case 'featured':
							$sqlQuery = $this->FeaturedSQL('1', $sqlMore);
							break;
						case 'suspended':
							$sqlQuery = $this->FeaturedSQL('0', $sqlMore);
							break;
					}
					break;
				case 'vacations':
					switch($activetype){
						case 'all':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE `property_status`!='0' AND (
											zc_property_details.category_id in (
												select category_id from zc_categories where parent_id =5
											) or zc_property_details.category_id in (5)
										)".$sqlMore;
							break;
						case 'activepro':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE `property_status`!='0' AND property_status='2' AND suspention_status='0'".$sqlMore;
							break;
						case 'inactivepro':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE property_status!='0' AND property_approval='0'".$sqlMore;
							break;
						case 'featured':
							$sqlQuery = $this->FeaturedSQL('1', $sqlMore);
							break;
						case 'suspended':
							$sqlQuery = $this->FeaturedSQL('0', $sqlMore);
							break;
					}
					break;
				case 'luxury':
					switch($activetype){
						case 'all':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE 1 = 1".$sqlMore;
							break;
						case 'activepro':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE `property_status`!='0' AND property_status='2' AND suspention_status='0'".$sqlMore;
							break;
						case 'inactivepro':
							$sqlQuery = "SELECT * FROM `zc_property_details` WHERE property_status!='0' AND property_approval='0'".$sqlMore;
							break;
						case 'featured':
							$sqlQuery = $this->FeaturedSQL('1', $sqlMore);
							break;
						case 'suspended':
							$sqlQuery = $this->FeaturedSQL('0', $sqlMore);
							break;
					}
					break;
				default :
					$sqlQuery = "SELECT * FROM `zc_property_details`".$sqlMore." WHERE 1";
					break;
			}			
		}
		$query1 = $this->db->query($sqlQuery);
		$config['total_rows'] = $query1->num_rows();        
		$sqlQuery = $sqlQuery." AND property_status!='0' ORDER BY `property_id` DESC LIMIT ".$start.", ".$config['per_page'];
		$query = $this->db->query($sqlQuery);
		//echo "===========".$this->db->last_query();
        return $result = $query->result_array();
    }
	private function FeaturedSQL($feature_status, $sqlMore){
		$sqlQuery = "SELECT * FROM `zc_property_details` WHERE property_id IN(";
		$sql = "SELECT `zc_property_featured`.`start_date`, 
				`zc_property_featured`.`number_of_days`, 
				`zc_property_details`.`property_id`, 
				`zc_property_details`.`feature_status` 
				FROM `zc_property_details` INNER JOIN `zc_property_featured` 
				ON `zc_property_details`.`property_id` = `zc_property_featured`.`property_id` 
				WHERE `zc_property_featured`.`status` ='1' AND `zc_property_details`.`property_status`!='0'".$sqlMore;
		$query = $this->db->query($sql);
		$result = $query->result_array();
		$q ="0,";
		if(!empty($result)){			
			$todayDate = strtotime(date('Y-m-d'));
			foreach($result as $r){
				$expireDate = strtotime(date('Y-m-d', strtotime($r['start_date'] . " +".$r['number_of_days']." days")));
				if($todayDate < $expireDate){
					if($r['feature_status']==$feature_status){
						$q.= $r['property_id'].",";
					}else{
						$q.= "0,";
					}
				}
			}			
		}
		$q.=rtrim($q,",");
		$sqlQuery.=$q.")";
		return $sqlQuery;
	}
	public function get_all_property_latest(){
        $this->db->select('property_id');
        $this->db->where(array('property_status' =>'2' ));
		$this->db->or_where(array('suspention_status' =>'1' ));
        $query = $this->db->get('property_details');
        $config['total_rows'] = $query->num_rows();
        $this->db->where(array('property_status !=' =>'1' ));
		$this->db->order_by('property_id','DESC');
        $this->db->limit(10,0);
        $query = $this->db->get('property_details');
        return $result = $query->result_array();
    }
	public function status_change($property_id,$byWhom,$active_status){
		$sql="update zc_property_details set suspention_status='".$active_status."',suspention_by_user='".$byWhom."' where property_id='".$property_id."'";
		//die();
		return $this->db->query($sql);
	}
	public function property_approval_status_change($property_id,$property_approval){
		$sql="update zc_property_details set property_approval='".$property_approval."' where property_id='".$property_id."'";
		return $this->db->query($sql);
	}
	public function delete_property($property_id){
		$dsql="Delete from zc_property_featured where property_id='".$property_id."'";
		$this->db->query($dsql);
		$sql="Delete from zc_property_details where property_id='".$property_id."'";
		return $this->db->query($sql);
	}
	public function del_prop_image($property_id){
		$sql="delete from zc_property_img where property_id='".$property_id."'";
		return $this->db->query($sql);
	}
	public function get_property_details($property_id){
		$sql="select * from zc_property_details where property_id='".$property_id."'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
			return $data;
		}
	}
	public function get_img_prop($property_id){
		$sql="select * from zc_property_img where property_id='".$property_id."'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
			return $data;
		}
	}
	function get_status_of_property(){
		$sql="select * from zc_status_of_property where status='1'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
			return $data;
		}
	}
	function get_kind_of_property(){
		$sql="select * from zc_kind_of_property where status='1'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
			return $data;
		}
	}
	function get_energy_efficiency_class(){
	    $sql="select * from zc_energy_efficiency_class where status='1'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
			return $data;
		}
	}
	public function get_contract_type(){
		$this->db->select('name_it,name,contract_id');
		$this->db->where('status', 'active');
		$query=$this->db->get("zc_contract_types");

		$result=array();
		$count=0;
		foreach($query->result() as $row){
			$result[$row->contract_id] = $row->name;
		}
		return $result;
	}
	function featured_entry($new_data){
		$sql="update zc_property_details set feature_status='1' where property_id='".$new_data['property_id']."'";
		$this->db->query($sql);
		$this->db->insert('zc_property_featured', $new_data);	
		return $img_id = $this->db->insert_id();
	}
	function update_featured_entry($new_data){
		$usql="update zc_property_details set feature_status='1' where property_id='".$new_data['property_id']."'";
		$this->db->query($usql);
		$sql="update zc_property_featured set start_date='".$new_data['start_date']."',number_of_days='".$new_data['number_of_days']."',status='1' where property_id='".$new_data['property_id']."'";
		return $this->db->query($sql);
	}
	function resume_featured_entry($property_id){
		$sql="update zc_property_details set feature_status='1' where property_id='".$property_id."'";
		return $this->db->query($sql);
	}
	function suspend_featured_entry($property_id){
		$sql="update zc_property_details set feature_status='0' where property_id='".$property_id."'";
		return $this->db->query($sql);
	}
	function get_property_feature_details($property_id){
		$sql="select * from zc_property_featured where property_id='".$property_id."'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
			return $data;
		}
	}
	function suspend_property($property_id,$uid) {
		$sql="update zc_property_details set suspention_status='1',`suspention_by_user`='".$uid."' where property_id='".$property_id."'";
		return $this->db->query($sql);
	}
	function resume_property($property_id,$uid) {
		$sql="update zc_property_details set suspention_status='0',`suspention_by_user`='".$uid."' where property_id='".$property_id."'";
		return $this->db->query($sql);
	}
	public function featuredFilterProperty($feature_status,$sqlMore){
		$counter = 0;
		$sql = "SELECT `zc_property_featured`.`start_date`, 
				`zc_property_featured`.`number_of_days`, 
				`zc_property_details`.`property_id`, 
				`zc_property_details`.`feature_status` 
				FROM `zc_property_details` INNER JOIN `zc_property_featured` 
				ON `zc_property_details`.`property_id` = `zc_property_featured`.`property_id` 
				WHERE `zc_property_featured`.`status` ='1' AND `zc_property_details`.`property_status`!='0'".$sqlMore;
		$query = $this->db->query($sql);
		$result = $query->result_array();
		if(!empty($result)){
			$todayDate = strtotime(date('Y-m-d'));
			foreach($result as $r){
				$expireDate = strtotime(date('Y-m-d', strtotime($r['start_date'] . " +".$r['number_of_days']." days")));
				if($todayDate < $expireDate){
					if($feature_status==$r['feature_status']){
						$counter++;
					}
				}
			}
		}
		return $counter;
	}
	public function get_city_list($province){
		$sql="SELECT `city` FROM `zc_region_master` WHERE `province_name` = '".mysql_real_escape_string($province)."'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){			
			foreach($query->result_array() as $row){
				$data[]=$row['city'];
			}
			return $data;
		}
	}
	public function get_provience_list(){
		$sql="SELECT `province_name` FROM `zc_region_master` GROUP BY `province_name`";				
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row['province_name'];
			}
			return $data;
		}
	}
	public function get_contract_short_code_by_id($contract_id){
		$this->db->select('short_code');
		$cond = array('status' => 'active', 'contract_id' => $contract_id);
		$this->db->where($cond);
		$query=$this->db->get("zc_contract_types");
		if ($query->num_rows() > 0){
			$row = $query->row();
			$sh_code= $row->short_code;
		}
		return $sh_code;
	}
	public function get_category_list($cat_parent){
		$this->db->select('name_it,name,short_code,category_id');
		$this->db->where('parent_id', $cat_parent);
		$this->db->where('status', 'active');
		$query=$this->db->get("zc_categories");
		$result=array();
		$count=0;
		foreach($query->result_array() as $row){
			$result[]=$row;
		}
		return $result;
	}
	public function get_typology_list(){
		$this->db->select('name,name_it,typology_id');
		$cond=array('status'=>'active');
		$this->db->where($cond);
		$query=$this->db->get("zc_typologies");
		
		$result=array();
		$count=0;
		foreach($query->result() as $row){
			$result[$row->typology_id] = stripslashes($row->name);
		}
		return $result;
	}
	public function get_contract_id_by_short_code($category_code){
		$this->db->select('category_id');
		$cond = array('status' => 'active', 'short_code' => $category_code);
		$this->db->where($cond);
		$query=$this->db->get("zc_categories");
		if ($query->num_rows() > 0){
			$row = $query->row();
			$category_id= $row->category_id;
		}
		return $category_id;
	}
	public function update_property_details($new_data,$property_id){
		$where = "property_id = '".$property_id."'";		
		$str = $this->db->update('zc_property_details', $new_data, $where);
	}
	public function insert_property_picture($file_names,$property_id,$img_type,$prop_img_no){
		$sql="insert into  zc_property_img set property_id='".$property_id."',file_name='".$file_names."',img_type='".$img_type."',prop_img_no='".$prop_img_no."'";
		return $this->db->query($sql);
	}
	public function del_property_img($img_id){
		$sql="delete from zc_property_img where img_id='".$img_id."'";
		return $this->db->query($sql);
	}
	public function searchSqlMore($search_property_code){
		$str = '';
		$search_property_code = substr($search_property_code,1);
		if($search_property_code){
			$str = ' AND 0';
			$sqlQuery = "SELECT GROUP_CONCAT(`property_id` SEPARATOR ',') AS `property_id` FROM ( SELECT *, md5(`property_id`) AS `ref_token` 
						FROM `zc_property_details` WHERE `property_status`!='0' ) AS p WHERE `ref_token` LIKE '".$search_property_code."%'";
			$query=$this->db->query($sqlQuery);
			if($query->num_rows()>0){
				$row = $query->result_array();
				if($row[0]['property_id']){
					$str = " AND `zc_property_details`.`property_id` IN (".$row[0]['property_id'].")";
				}
			}
		}
		return $str;
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
}
?>