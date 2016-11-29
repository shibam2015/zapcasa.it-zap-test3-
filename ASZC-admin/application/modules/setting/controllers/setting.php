<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Setting extends CI_Controller {



	

	 

	 public function __construct()

	   {

			parent::__construct();	

			$this->controller = 'setting';

			$this->load->library('session');

			$this->load->model('setting_model');

			userLoginCheck($this->session->userdata);

			$this->load->library('pagination');

	   }



	public function index()

	{

	

		$data = array();

		 $config['base_url'] = base_url().$this->controller. '/'. __FUNCTION__;

          $config['per_page'] = 20;

          $config['uri_segment'] = 3;

		$data['page_header_title'] = 'Site Setting';

		$data['setting_details']=$this->setting_model->get_all_setting($config, $this->uri->segment($config['uri_segment'], 0));

		//echo '<pre>';print_r($data['property_details']);die;

		//$this->pagination->initialize($config);

		$this->pagination->initialize($config);

            $data['pagination'] = $this->pagination->create_links();

			//echo '<pre>';print_r($data['pagination']);die;

		$this->load->view('setting_template', $data);

		

	}

	

	public function status_change()

	{

		$property_id=$this->uri->segment('3');

		$property_status=get_perticular_field_value('zc_property_details','property_status',

		" and property_id='".$property_id."'");

		if($property_status!='1')

		{

			if($property_status=='0')

			{

				$active_status=2;

				$rs=$this->property_model->status_change($property_id,$active_status);

			}

			if($property_status=='2')

			{

				$active_status=0;

				$rs=$this->property_model->status_change($property_id,$active_status);

			}

			if($rs)

			{

				redirect('/property');

			}

			

		}

		else

		{

			redirect('/property');

		}

	}

	

	public function property_approval_st_change()

	{

		$property_id=$this->uri->segment('3');

		$property_approval=get_perticular_field_value('zc_property_details','property_approval'," and property_id='".$property_id."'");

		if($property_approval=='0')

			{

				$property_approval=1;

				$rs=$this->property_model->property_approval_status_change($property_id,$property_approval);

				redirect('/property');

			}

			if($property_approval=='1')

			{

				$property_approval=0;

				$rs=$this->property_model->property_approval_status_change($property_id,$property_approval);

				/*

				sending mail if approval is pending by the admin

				if($rs==1)

				{

					$this->send_mail($property_id);

				}*/

				redirect('/property');

			}

			

		

			

		

		

	}

	

	function delete_property()

	{

		$property_id=$this->uri->segment('3');

		$rs=$this->property_model->delete_property($property_id);

		if($rs)

		{

			$this->session->set_flashdata('success', 'The property is deleted successfully');

			redirect('/property');

		}

	}

	

	function view_setting_details()

	{

		$setting_id=$this->uri->segment('3');

		

		$data['page_header_title']="Setting Information";

		$data['setting_details']=$this->setting_model->get_setting_details($setting_id);

		$this->load->view('setting_view_template', $data);

		

	}

	

	function edit_setting()

	{

		$meta_value=$this->input->post('meta_value');

		$settings_id=$this->input->post('settings_id');

		$rs=$this->setting_model->edit_setting($meta_value,$settings_id);

		echo $rs;

	}

	

	

	//============================================================================

		public function logout()

		{

			

			$session_data = array(

                   'admin_user_id'  => '',                   

				   'admin_login_status'     => '',				   

				   'admin_current_time'     => '',

                   'admin_logged_in' => false);

			$this->session->unset_userdata($session_data);

			redirect('login/');

		}

	//============================================================================



}