<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property_model extends CI_Model{
	
	
  /*  public function get_all_property(&$config, $start){
		$sql="select * from zc_property_details where property_status!='1' ORDER BY `zc_property_details`.`posting_time` DESC LIMIT ".$start.",".$config['per_page']."";
	   $query=$this->db->query($sql);
	   if($query->num_rows()>0){
				
				foreach($query->result_array() as $row){
					$data[]=$row;
				}
				return $data;
			}

        $query = $this->db->get($this->db->dbprefix('property_details'));			
        return $result = $query->result_array();	
    }*/
    
	public function get_all_property(&$config, $start)
    {
        $this->db->select('property_id');
        $this->db->where(array('property_status !=' =>'1' ));
        $query = $this->db->get('property_details');
        $config['total_rows'] = $query->num_rows();        
        
        
        $this->db->where(array('property_status !=' =>'1' ));
        $this->db->limit($config['per_page'], $start);
        $query = $this->db->get('property_details');
        return $result = $query->result_array();
    }
	
	
	
	
	
	
	
	public function status_change($property_id,$active_status)
	{
		$sql="update zc_property_details set property_status='".$active_status."' where property_id='".$property_id."'";
		return $this->db->query($sql);
	}
	
	public function property_approval_status_change($property_id,$property_approval)
	{
		$sql="update zc_property_details set property_approval='".$property_approval."' where property_id='".$property_id."'";
		return $this->db->query($sql);
	}


  public function delete_property($property_id)
  {
	   $dsql="Delete from zc_property_featured where property_id='".$property_id."'";
	   $this->db->query($dsql);
	  $sql="Delete from zc_property_details where property_id='".$property_id."'";
	  return $this->db->query($sql);
  }

   public function get_property_details($property_id)
   {
	   $sql="select * from zc_property_details where property_id='".$property_id."'";
	   $query=$this->db->query($sql);
	   if($query->num_rows()>0){
				
				foreach($query->result_array() as $row){
					$data[]=$row;
				}
				return $data;
			}
   }
   
   public function get_img_prop($property_id)
   {
	   $sql="select * from zc_property_img where property_id='".$property_id."'";
	   $query=$this->db->query($sql);
	   if($query->num_rows()>0){
				
				foreach($query->result_array() as $row){
					$data[]=$row;
				}
				return $data;
			}
	   
   }
   
   
   
   function get_status_of_property()
   {
	  $sql="select * from zc_status_of_property where status='1'";
	   $query=$this->db->query($sql);
	   if($query->num_rows()>0){
				
				foreach($query->result_array() as $row){
					$data[]=$row;
				}
				return $data;
			}
   }
   
   function get_kind_of_property()
   {
	    $sql="select * from zc_kind_of_property where status='1'";
	   $query=$this->db->query($sql);
	   if($query->num_rows()>0){
				
				foreach($query->result_array() as $row){
					$data[]=$row;
				}
				return $data;
			}
   }
   
  
   
   function get_energy_efficiency_class()
   {
	    $sql="select * from zc_energy_efficiency_class where status='1'";
	   $query=$this->db->query($sql);
	   if($query->num_rows()>0){
				
				foreach($query->result_array() as $row){
					$data[]=$row;
				}
				return $data;
			}
   }
   
   /////////////////make feature/////////////////////////////////
   function featured_entry($new_data)
   {
	    $sql="update zc_property_details set feature_status='1' where property_id='".$new_data['property_id']."'";
	    $this->db->query($sql);
	  	  $this->db->insert('zc_property_featured', $new_data);	
		  return $img_id = $this->db->insert_id();
   }
   
   function update_featured_entry($new_data)
   {
	   $usql="update zc_property_details set feature_status='1' where property_id='".$new_data['property_id']."'";
	    $this->db->query($usql);
	   $sql="update zc_property_featured set start_date='".$new_data['start_date']."',number_of_days='".$new_data['number_of_days']."',status='1' where property_id='".$new_data['property_id']."'";
	   return $this->db->query($sql);
   }
   
   function suspend_featured_entry($property_id)
   {
	   $sql="update zc_property_details set feature_status='0' where property_id='".$property_id."'";
	   $sql1="update zc_property_featured set status='0' where property_id='".$property_id."'";
	   $this->db->query($sql1);
	   return $this->db->query($sql);
   }
   
   function get_property_feature_details($property_id)
   {
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

}


?>