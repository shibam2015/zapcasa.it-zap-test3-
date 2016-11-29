<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {
 	public function __construct() {
			parent::__construct();
			$this->load->library('session');
			userLoginCheck($this->session->userdata);
			$this->controller = 'Reports';
			$this->load->library('pagination');
			$this->load->library('form_validation');
			
   	}
	public function property_wise() {
		$data = array();
		$data['result'] = array();
		$this->load->model('Reports_model');
		$data['title_en'] = "Property Wise Reports";
		
		$data['propertyCountByUserType'] = array();
		$data['propertyDetails']  = array();
		
		$config = array();
		$data["pagination"] = array();
		$config["base_url"] = base_url() . "Reports/property_wise";
		$config["total_rows"] = get_perticular_count('zc_property_details'," AND property_approval='1' AND suspention_status='0' AND property_status='2'");
		$config["per_page"] = 15;
		$config["uri_segment"] = 3;
		$paginationA = clone($this->pagination);
		$paginationA->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$result = $this->Reports_model->get_list_of_property($config["per_page"], $page);
		if( count( $result ) > 0 ) {
			
			foreach( $result as $key=>$dataVal) {
				$data['propertyDetails'][] = $dataVal;
				$data['propertyCountByUserType'][$dataVal['property_post_by_type']][] = $dataVal['property_id'];
			}
			$data["pagination"] = $paginationA->create_links();
		}
		
		$data['getSavedProperty']  = array();
		$data['getSavedPropertyProperty'] = array();
		$getSavedProperty = $this->Reports_model->get_saved_property();
		
		if( count( $getSavedProperty ) > 0 ) {
			foreach( $getSavedProperty as $key=>$dataVal) {
				$data['getSavedProperty'][$dataVal['property_post_by_type']][] = $dataVal['saved_id'];
				$data['getSavedPropertyProperty'][$dataVal['property_post_by_type']][$dataVal['property_id']][] = $dataVal['saved_id'];
			}
		}
		$this->load->view('property_wise_index', $data);
		
	}
	
	public function user_wise_reports() {
		$data['resultForUserWise'] = array();
		$data['resultForJoiningDate'] = array();
		
		$this->load->model('Reports_model');
		$data['title_en'] = "User Wise Reports";
		$result = $this->Reports_model->get_list_of_user();
		
		$todayDte = date('Y-m-d');
		$reportDateRange = array();
		for( $i=0;$i<7;$i++ ) {
			$date = strtotime(date("Y-m-d", strtotime($todayDte)) . " -".$i."days");
			$reportDateRange[] =  date('Y-m-d' ,$date);
		}
		if( count( $result ) > 0 ) {
				
			foreach( $result as $key=>$dataVal) {
				$date = date('Y-m-d' ,strtotime($dataVal['registered_on']));	
				$data['resultForUserWise'][$dataVal['user_type']][] = $dataVal;
				
				if( in_array($date, $reportDateRange)) {
					$data['resultForJoiningDate'][$dataVal['user_type']][] = $dataVal['registered_on'];
				}
			}
		}
		
		$this->load->view('user_wise_reports', $data);
	}
	
}