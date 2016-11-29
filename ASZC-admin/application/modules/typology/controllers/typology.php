<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Typology extends CI_Controller {
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
	var  $controller;
	public function __construct(){
		parent::__construct();    
		$this->controller = 'typology';
		$this->load->library('session');
		$this->load->library('pagination');
		userLoginCheck($this->session->userdata);
		$this->load->model('typos');
	}
	public function index(){
		redirect('/typology/typologylist');
	}
	public function typologylist(){
		$search_input = $this->input->get('search_input');
		$data['search_input'] = $search_input;
		$data['page_header_title'] = 'All Typology List'.($search_input?' : '.$search_input:'');
		
		$config['base_url'] = base_url().$this->controller. '/typologylist';
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;
		
		$whereClause = "";
		if($search_input){
			$shortCodeExists = 'Y';
			if($search_input=='Residential' || $search_input=='RES'){
				$search_input='RES';
			}elseif($search_input=='Property for business' || $search_input=='PRO'){
				$search_input='PRO';
			}elseif($search_input=='Business license' || $search_input=='BLI'){
				$search_input='BLI';
			}elseif($search_input=='Rooms' || $search_input=='ROM'){
				$search_input='ROM';
			}elseif($search_input=='Land' || $search_input=='LAND'){
				$search_input='LAND';
			}elseif($search_input=='Vacations' || $search_input=='VAC'){
				$search_input='VAC';
			}else{
				$shortCodeExists = 'N';
			}
			$whereClause = " WHERE (FIND_IN_SET('".$search_input."',`category_code`))";
			if($shortCodeExists=='N'){
				$whereClause = " WHERE (`name`='".$search_input."' OR `name_it`='".$search_input."')";
			}
		}
		
		$data['typolist'] = $this->typos->getTypos($config, $this->uri->segment($config['uri_segment'], 0), $whereClause);
		
		if($search_input){
			$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
			$config['suffix'] = '?search_input='.$search_input;
		}
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();		
		
		$this->load->view('list', $data);
	}
	public function statuschange($id){
		$page=$this->uri->segment('4');
		$data = array();
		$user = $this->typos->getTypoById($id);
		if($user->status == 'active')
			$data['status'] = 'inactive';
		else 
			$data['status'] = 'active';
		
		$this->typos->updateTypo($data, $id);
		$this->session->set_flashdata('success', 'Status has been updated');
		redirect('/typology/typologylist/'.$page);
	}
	public function add_typo(){
		$data=array();
		$data['postingType'] = 'Add New';
		$data['page_header_title'] = 'Add NEw Typology';
		$data['typo_infos'] = array();
		
		$this->load->view('post-typo',$data);	
	}
	public function add_typology(){		
		$category_code = implode(",", $this->input->post('category_code'));
		$name = $this->input->post('name');
		$name_it = $this->input->post('name_it');
		
		$arrVal = array(
			'category_code'=>$category_code,
			'name'=>$name,
			'name_it'=>$name_it
		);
		
		$rs = $this->typos->insert_typology_data($arrVal);
		if($rs){
			$msg = "Typology data added successfully";
			$this->session->set_flashdata('success', $msg);
			redirect('/typology/typologylist');
		}
	}
	public function edit_typo(){
		$data=array();
		$typology_id=$this->uri->segment('3');
		$data['postingType'] = 'Edit';
		$data['page_header_title'] = 'Update Typology';
		$data['typo_infos']=$this->typos->get_typo_detail($typology_id);
		
		$this->load->view('post-typo',$data);	
	}
	public function update_typology(){
		$typology_id=$this->uri->segment('3');
		$page=$this->uri->segment('4');
		//echo '<pre>';print_r($_POST);die;
		
		$category_code = implode(",", $this->input->post('category_code'));
		$name = $this->input->post('name');
		$name_it = $this->input->post('name_it');
		
		$rs = $this->typos->update_typology_data($category_code,$name,$name_it,$typology_id);
		if($rs){
			$msg = "Typology data updated successfully";
			$this->session->set_flashdata('success', $msg);
			redirect('/typology/edit_typo/'.$typology_id);
		}
	}
}
