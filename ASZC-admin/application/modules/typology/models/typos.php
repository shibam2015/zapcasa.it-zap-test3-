<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Typos extends CI_Model{
    public function getTypos(&$config, $start, $whereClause){
        $sql = "SELECT * FROM `zc_typologies`".$whereClause." ORDER BY FIELD (`category_code`, 'RES','PRO','BLI','ROM','LAND','VAC')";
		$query = $this->db->query($sql);
		$config['total_rows'] = $query->num_rows();
		
		$sql.=" LIMIT ".$start.", ".$config['per_page'];
		//echo "===========".$sql;
		$query = $this->db->query($sql);
		return $query->result();
    }
	public function getTypoById($id){
        $this->db->where('typology_id', $id);
        return $this->db->get('zc_typologies')->row();
    }
	public function updateTypo($data, $id){
        $this->db->update('zc_typologies', $data, array('typology_id' => $id));
    }
	public function get_typo_detail($typology_id){
		$sql="select * from zc_typologies where typology_id='".$typology_id."'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
			return $data;
		}
	}
	public function insert_typology_data($arrVal) {
		$this->db->insert('zc_typologies', $arrVal);
		return $this->db->insert_id();
    }
	public function update_typology_data($category_code,$name,$name_it,$typology_id){
		$sql="update zc_typologies set 
				category_code='".$category_code."',
				name='".$name."',
				name_it='".$name_it."'
				where `typology_id`='".$typology_id."'";
		return $this->db->query($sql);
	}
}
?>