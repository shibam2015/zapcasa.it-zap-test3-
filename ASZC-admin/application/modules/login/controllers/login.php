<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Login extends CI_Controller {



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

	 public function __construct()

	   {

			parent::__construct();	

			$this->load->library('session');

	   }

	//==========login form=======================

	public function index(){
		
		
		if(isset($this->session->userdata['admin_logged_in'])){

			redirect('dashboard');	

		}

		$this->load->view('login_template');

		

	}

	//====================login check===========================

	public function loginVerify(){
		
		$login_status = 'invalid';

		$username = $_POST["username"];

		$password = md5($_POST["password"]);

		$this->load->model('logins');



		$query = $this->logins->loginVerify(array('user_name' => $username, 'password' => $password, 'status' => '1', 'user_type' => '4'));



		if($query->num_rows)

		{

			$row = $query->row();

			if($row->status=='1')

			{

				$session_data = array(

                   'admin_user_id'  => $row->user_id,                   

				   'admin_login_status'     => $row->status,				   

				   'admin_current_time'     => time(),

                   'admin_logged_in' => TRUE);

				$this->session->set_userdata($session_data);



				$login_status = 'success';

				$resp['redirect_url'] = site_url().'dashboard/';



			}

		}



		$resp['login_status'] = $login_status;

		

		echo json_encode($resp);

		

	}

}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */