<?php
class Logincheck
{
	function isLogin()
	{
		$CI =& get_instance();
			
		$login=false;
		$sid = $CI->session->userdata('user_id');
		if($sid !="" && is_numeric($sid)) {
			$status = get_perticular_field_value('zc_user', 'status', " and user_id='" . $sid . "'");
			
			if($status != "1" && !strstr($_SERVER['REQUEST_URI'], '/users/logout')) {
				$CI->session->set_userdata('user_id',0);
				$CI->session->set_userdata('session_id',0);

				$CI->session->sess_destroy();
				redirect(base_url().'users/blockedpage');
				exit();
			}
		}
		
		/*if($CI->session->userdata('admin_login')=='admin_login')
		{
			$login=true;
			$CI->load->model('dbsettings');
			$data = $CI->dbsettings->getSettingInfo();
			if (!empty($data)) {
				foreach ($data as $key => $value) {
					$CI->config->set_item($value->name,$value->value);					
				}
			}
		}
		if(($login==false && $CI->uri->segment(1)!='login')  )
		{
			header("location: ".base_url."login");
			exit();
		}*/
	}
	
}
?>