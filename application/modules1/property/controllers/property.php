<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property extends CI_Controller {

	
	 
	 public function __construct()
	   {
			parent::__construct();	
			$this->controller = 'property';
			$this->load->library('session');
			$this->load->model('property_model');
			userLoginCheck($this->session->userdata);
			$this->load->library('pagination');
	   }

	public function index()
	{
	
		$data = array();
		 $config['base_url'] = base_url().$this->controller. '/'. __FUNCTION__;
          $config['per_page'] = 20;
          $config['uri_segment'] = 3;
		$data['page_header_title'] = 'Property';
		$data['property_details']=$this->property_model->get_all_property($config, $this->uri->segment($config['uri_segment'], 0));
		//echo '<pre>';print_r($data['property_details']);die;
		//$this->pagination->initialize($config);
		$this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
			//echo '<pre>';print_r($data['pagination']);die;
		$this->load->view('property_template', $data);
		
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
	
	function view_property_details()
	{
		$property_id=$this->uri->segment('3');
		////////////////////////////////////////////
		$data['status_of_property']=$this->property_model->get_status_of_property();
		//echo '<pre>';print_r($data['status_of_property']);die;
		$data['kind_of_property']=$this->property_model->get_kind_of_property();
		$data['energy_efficiency_class']=$this->property_model->get_energy_efficiency_class();
		////////////////////////////////////////////
		$data['page_header_title']="Property Information";
		$data['property_details']=$this->property_model->get_property_details($property_id);
		$data['property_img']=$this->property_model->get_img_prop($property_id);
		
		$this->load->view('property_view_template', $data);
		
	}
	
	function property_image()
	{
		$property_id=$this->uri->segment('3');
		$data['page_header_title']="Property Information";
		$data['property_img']=$this->property_model->get_img_prop($property_id);
		
		$this->load->view('property_img_template', $data);
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
	
	
	function make_featured()
	{
		$property_id=$this->uri->segment('3');
		////////////////////////////////////////////
		$data['status_of_property']=$this->property_model->get_status_of_property();
		//echo '<pre>';print_r($data['status_of_property']);die;
		$data['kind_of_property']=$this->property_model->get_kind_of_property();
		$data['energy_efficiency_class']=$this->property_model->get_energy_efficiency_class();
		////////////////////////////////////////////
		$data['page_header_title']="Property Information";
		$data['property_details']=$this->property_model->get_property_details($property_id);
		$data['property_feature_details']=$this->property_model->get_property_feature_details($property_id);
		$data['property_img']=$this->property_model->get_img_prop($property_id);
		
		$this->load->view('property_featured', $data);
		
	}
	/////////////////////////////property feature/////////////////////////////////////////
	function make_prop_feature()
	{
		$property_id=$this->uri->segment('3');
		$start_date=$this->input->post('start_date');
		$number_of_days=$this->input->post('number_of_days');
		$prop_feature_status=get_perticular_count('zc_property_featured'," and property_id='".$property_id."'");
		if($prop_feature_status==0)
		{
		$new_data=array();
		$new_data['property_id']=$property_id;
		$new_data['start_date']=$start_date;
		$new_data['number_of_days']=$number_of_days;
		$rs=$this->property_model->featured_entry($new_data);
		}
		else
		{
			$new_data=array();
			$new_data['property_id']=$property_id;
			$new_data['start_date']=$start_date;
			$new_data['number_of_days']=$number_of_days;
			$rs=$this->property_model->update_featured_entry($new_data);
		}
		
		redirect('/property');
	}
	
	function property_feature_suspend()
	{
		$property_id=$this->uri->segment('3');
		$rs=$this->property_model->suspend_featured_entry($property_id);
		redirect('/property');
	}
	
	function suspend_property() {
		$property_id=$this->uri->segment('3');
		$uid=$this->session->userdata( 'admin_user_id' );
		$rs=$this->property_model->suspend_property($property_id,$uid);
		if($rs) {
			$msgdata = $this->lang->line('property_the_property_is_suspended_successfully');
			$this->session->set_flashdata('success', $msgdata);
		}
		redirect('/property');
	}
	function resume_property() {
		$property_id=$this->uri->segment('3');
		$uid=$this->session->userdata( 'admin_user_id' );
		$rs=$this->property_model->resume_property($property_id,$uid);
		if($rs) {
			$msgdata =  $this->lang->line('property_the_property_is_active_successfully');
			$this->session->set_flashdata('success',$msgdata);
		}
		redirect('/property');
	}
	

}