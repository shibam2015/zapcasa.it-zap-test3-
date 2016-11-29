<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cms extends CI_Controller {
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
		$this->load->library('form_validation');
		$this->load->model('cmss');
	}
	public function index(){
		userLoginCheck($this->session->userdata);
		$data = array();
		$data['page_header_title'] = 'Manage All CMS Pages';
		$this->load->model('cmss');
		$result = $this->cmss->getAllCms();
		if(!$result){
			$data['page_content'] = '<tr>			
			<td colspan="4" align="center" height="100"> no records found.</td>
			</tr>';
		}else{
			$data['page_content'] = '';
			for($i=0;$i<=count($result)-1;$i++){
				if($result[$i]->status==1){
					$css_class = "entypo-lock-open";
					$title = "Click here to disabled";
					$status = "disabled";
				}else{
					$css_class = "entypo-lock";
					$title = "Click here to enable";
					$status = "enable";
				}
				//=======================================================cmsEditorPost
				$datetime = $result[$i]->created_at;
				$home_url = get_perticular_field_value('zc_settings','meta_value'," and meta_name='home_url'");
				$data['page_content'].= '<tr>
											<td>'.$result[$i]->title_en.'</td>
											<td>'.date("jS \of F Y h:i:s A", intval($datetime)).'</td>
											<td>'.$home_url.'/site/cmsPages/'.$result[$i]->slug.'</td>
											<td>
												<a href="'.site_url('cms/edit_page/'.$result[$i]->id).'" class="btn btn-default btn-sm btn-icon icon-left" title="Click here to edit">
													<i class="entypo-pencil"></i>Edit
												</a>
												&nbsp;
												<a href="'.site_url('cms/edit_page/'.$result[$i]->id).'/'.$status.'/" class="btn btn-info btn-sm btn-icon icon-left" title="'.$title.'">
													<i class="'.$css_class.'"></i>Status
												</a>
												&nbsp;
												<a href="'.site_url('cms/del_page/'.$result[$i]->id).'/" class="btn-xs btn-red" title="DELETE">
													Delete
												</a>
											</td>
										</tr>';
			}
		}
		$this->load->view('cms_views', $data);
	}
	function del_page(){
		$page_id=$this->uri->segment(3);
		$rs=$this->cmss->del_page($page_id);
		if($rs){
			redirect('cms');
		}
	}
	public function edit_page($id = NULL){
		userLoginCheck($this->session->userdata);
		if($this->input->post('method') == 'post'){
			$this->form_validation->set_rules('title_en', 'Title', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if ($this->form_validation->run() == TRUE){
				$data = array();
				$id= $this->input->post('id');
				$data['title_en'] = $this->input->post('title_en');
				$data['title_it'] = $this->input->post('title_it');
				$data['content_en'] = $this->input->post('content_en');
				$data['content_it'] = $this->input->post('content_it');
				$data['created_at'] = time();
				$data['status'] = $this->input->post('status');
				$data['ip_address'] = $this->input->ip_address();
				$data['slug'] = url_title($this->input->post('title_en'), 'dash', TRUE);
				$this->cmss->UpdateCms($id, $data);
				$msg = "Successfully update your selected page.";
				$this->session->set_flashdata('msg_flash', '<p style="color:#044e1e;">'.$msg.'</p>');
				redirect(site_url('/cms/'));
			}
		}elseif($this->uri->segment(4, 0)){
			$val = $this->uri->segment(4);
			if($val=='enable'){
				$val_update = 1;
				$msg = "Successfully enable.";
			}else{
				$val_update = 0;
				$msg = "Successfully disabled.";
			}
			$data = array('status' => $val_update);
			$this->load->model('cmss');
			$this->cmss->UpdateCms($id, $data);
			$this->session->set_flashdata('msg_flash', '<p style="color:#044e1e;">'.$msg.'</p>');
			redirect(site_url('/cms/'));
		}
		$row = $this->cmss->getSingalCms($id);
		$data = array();
		$data['page_header_title'] = $row->title_en;
		$data['cmspages_id'] = $row->id;
		$data['title_en'] = $row->title_en;
		$data['title_it'] = $row->title_it;
		$data['content_en'] = $row->content_en;
		$data['content_it'] = $row->content_it;
		$data['status'] = $row->status;
		$this->load->view('edit_page', $data);
	}
	public function add_page(){
		userLoginCheck($this->session->userdata);
		$data = array();
		$data['page_header_title'] = 'Add Page';
		if($this->input->post('method') == 'post'){
			$this->form_validation->set_rules('title_en', 'Title', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if ($this->form_validation->run() == TRUE){
				$data = array();
				$data['title_en'] = $this->input->post('title_en');
				$data['title_it'] = $this->input->post('title_it');
				$data['content_en'] = $this->input->post('content_en');
				$data['content_it'] = $this->input->post('content_it');
				$data['created_at'] = time();
				$data['status'] = $this->input->post('status');
				$data['ip_address'] = $this->input->ip_address();
				$data['slug'] = url_title($this->input->post('title_en'), 'dash', TRUE);
				$this->cmss->addCms($data);
				$this->session->set_flashdata('msg_flash', '<p style="color:#044e1e;">Page successfully added</p>');
				redirect(site_url('/cms/'));
			}
		}
		$this->load->view('add_page', $data);
	}
}