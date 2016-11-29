<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('common_model');
	}	public function index(){
		$data = array();
		$data['page_header_title'] = 'Dashboard';
		userLoginCheck($this->session->userdata);
		$data['dashboardLatestProperties']=$this->common_model->dashboardLatestProperties();
		$data['dashboardLatestPropertiesTotal']=$this->common_model->dashboardLatestPropertiesTotal();
		$data['dashboardLatestUsers']=$this->common_model->dashboardLatestUsers();
		$data['dashboardLatestUsersTotal']=$this->common_model->dashboardLatestUsersTotal();
		$this->load->view('dashboard_template', $data);
		//print "<pre>";
		//print_r($this->session->userdata);
		/*$session_data = array(			'ip_address' => '',
			'user_agent' => '',			'last_activity' => '',
			'user_data' => '',
			'admin_user_id' => '',
			'admin_login_status' => '',
			'current_time' => '',
			'admin_logged_in' => '',
			'admin_current_time' => ''		);
		$this->session->unset_userdata($session_data);*/
	}
	public function logout(){
		$session_data = array(
			'admin_user_id'  => '',
			'admin_login_status'     => '',
			'admin_current_time'     => '',
			'admin_logged_in' => false		);
		$this->session->unset_userdata($session_data);
		redirect('login/');
	}
	public function update_admin(){
		$response = 'Failure';
		$responseText = 'Opps ! Try again.';
		if(isset($_POST['ajaxAction']) && $_POST['ajaxAction']=='UpdateAdmin'){
			$this->common_model->update_admin_account();
			$response = 'Success';
			$responseText = 'Admin details updated successfully!';
		}
		//Json Encoding.
		$returnArray=array("response"=>$response,"responseText"=>$responseText);
		$returnArray["json"] = json_encode($returnArray);
		echo json_encode($returnArray);
	}
}