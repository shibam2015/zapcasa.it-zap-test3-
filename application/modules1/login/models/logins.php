<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logins extends CI_Model{

	public function loginVerify($conditions){
            if(empty($conditions)){
                return FALSE;
            }
            $this->db->where($conditions);
            return $this->db->get($this->db->dbprefix('user'));
    }

}

?>