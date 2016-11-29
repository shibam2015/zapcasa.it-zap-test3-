<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Cmss extends CI_Model{

	

	

    public function getAllCms(){



        $query = $this->db->get($this->db->dbprefix('cmspages'));			

        return $result = $query->result();	

    }

    public function getSingalCms($cmspages_id){



        $this->db->where('id', $cmspages_id);

        $query = $this->db->get($this->db->dbprefix('cmspages'));			

        return $result = $query->row();	

    }





    public function UpdateCms($edit_id, $data){



        $this->db->where('id', $edit_id);

        $this->db->update('cmspages', $data); 		



    }



    public function addCms($data)

    {

        $this->db->insert('cmspages', $data);

    }

	

	function del_page($page_id)

	{

		$sql="delete from zc_cmspages where id='".$page_id."'";

		return $this->db->query($sql);

	}



}





?>