<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Setting_model extends CI_Model{

	

	

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

    

	public function get_all_setting(&$config, $start)

    {

        $this->db->select('settings_id');

        $query = $this->db->get('zc_settings');

        $config['total_rows'] = $query->num_rows();        

        

        

       

        $this->db->limit($config['per_page'], $start);

        $query = $this->db->get('zc_settings');

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

	  $sql="Delete from zc_property_details where property_id='".$property_id."'";

	  return $this->db->query($sql);

  }



   public function get_setting_details($setting_id)

   {

	   $sql="select * from zc_settings where settings_id='".$setting_id."'";

	   $query=$this->db->query($sql);

	   if($query->num_rows()>0){

				

				foreach($query->result_array() as $row){

					$data[]=$row;

				}

				return $data;

			}

   }

   

   public function edit_setting($meta_value,$settings_id)

   {

	   $sql="update zc_settings set meta_value='".$meta_value."' where settings_id='".$settings_id."'";

	   return $this->db->query($sql);

   }

   

 



}





?>