<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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
        public function __construct()
	   {
			parent::__construct();	
                $this->controller = 'user';
				$this->load->library('session');
                        $this->load->library('pagination');
                        userLoginCheck($this->session->userdata);
                        $this->load->model('users');    
                        $this -> load -> library('image_lib');
                        $this->resized_path = realpath(APPPATH.'../assets/uploads/thumb_92_82');
	   }
	//==========login form=======================
	public function index()
	{
            $config['base_url'] = base_url().  $this->controller. '/'. __FUNCTION__;
            $config['per_page'] = 20;
            $config['uri_segment'] = 3;

            $data['page_header_title'] = 'All Users';
			
            $data['users'] = $this->users->getUsers($config, $this->uri->segment($config['uri_segment'], 0));
//            $this->pagination->set_style();
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
			//echo '<pre>';print_r($data['pagination']);die;
            
            $this->load->view('index', $data);
		
	}
	//====================login check===========================
        
        public function statuschange($id)
        {
            $data = array();
            $user = $this->users->getUserById($id);
            if($user->status == '1')
                $data['status'] = '0';
            else 
                $data['status'] = '1';
            
            $this->users->updateUser($data, $id);
            $this->session->set_flashdata('msg_flash', 'Status has been updated');
            redirect($this->controller.'/index');
        }
		
/////////////////////////////edit profile///////////////////////////////////////
public function edit_profile()
{
	$user_id=$this->uri->segment('3');
	 $data['page_header_title'] = 'User Profile';
	$data['user_infos']=$this->users->get_user_detail($user_id);
	$province=$data['user_infos'][0]['province'];
	$data['countries']=$this->users->get_country(); 
	$data['provinces']=$this->users->get_state_list(); 
	$data['city']=$this->users->get_city($province);
	//echo '<pre>';print_r($data['user_infos']);
	if($data['user_infos'][0]['user_type']=='1')
	{
		$this->load->view('user_profile_template',$data);
	}
	if($data['user_infos'][0]['user_type']=='2')
	{
		$this->load->view('owner_profile_template',$data);
	}
	if($data['user_infos'][0]['user_type']=='3')
	{
		$this->load->view('company_profile_template',$data);
	}
	
}
///////////////////////////delete the user//////////////////////////////////////
  public function delete_user()
  {
	  $user_id=$this->uri->segment('3');
	  $rs=$this->users->del_user($user_id);
	  if($rs)
	  {
		  $this->session->set_flashdata('msg_flash', 'User gets deleted sucessfully');
          redirect($this->controller.'/index');
	  }
  }
  
  function city_search()
  {
	  $province=$this->input->post('name');
		$rs=$this->users->get_city($province);
		//echo '<pre>';print_r($rs);die;
		if($rs)
		{
			foreach($rs as $key=>$val)
			{
				echo "<option value='".$val."'>".$val."</option>";
			}
		}
  }
  
  /////////////////////update general user///////////////////////////////////////
  
  public function update_general_user()
  {
	 $user_id=$this->uri->segment('3');
	  //echo '<pre>';print_r($_POST);die;
	  $rs=$this->users->general_user_update($user_id);
	  if($rs)
	  {
		  redirect('users/edit_profile/'.$user_id);
	  }
	  
  }
  
 /////////////////update owner profile//////////////////////////////////////////////
 public function update_owner() {
	 $user_id=$this->uri->segment('3');
	$rs=$this->users->general_owner_update($user_id);
  	if($rs) {
		/*$this->upload_image_1('user_file_1',$user_id);
	 	$this->upload_image_2('user_file_2',$user_id);
		redirect('user/edit_profile/'.$user_id);*/
  		
  		$this->upload_image_1('user_file_1',$user_id);
  		$this->upload_image_2('user_file_2',$user_id);
  		$msg = $this->lang->line('owner_info_success_message');
  		$this->session->set_flashdata('success', $msg);
  		redirect('users/edit_profile/'.$user_id);
  		
	  }
 }
 
 ///////////////update company profile///////////////////////////////////////
 public function update_company()
 {
	 $user_id=$this->uri->segment('3');
	  
	  //echo '<pre>';print_r($_POST);die;
	  $rs=$this->users->general_company_update($user_id);
	 
	  if($rs)
	  {
		  $this->upload_image_1('user_file_1',$user_id);
	  $this->upload_image_2('user_file_2',$user_id);
		  redirect('users/edit_profile/'.$user_id);
	  }
 }
 
 /////////////////////search//////////////////////////////////////////////
 public function user_search()
 {
	$user_name=$this->input->post('search_input');
	$data['users']=$this->users->get_user_det($user_name);
	$data['page_header_title'] = 'All Users';
	//$data['users']=
	$data['pagination'] = '';
			//echo '<pre>';print_r($data['users']);die;
            
            $this->load->view('index', $data);
 }
 
function check_email_avail()
	{
		$email_id=$this->input->post('email');
		if($email_id=='')
		{
			echo '2';
			exit;
		}
		else
		{
		$user_list_cnt=get_perticular_count('zc_user'," and email_id='".$email_id."' and status='1'");
		echo $user_list_cnt;
		exit;
		}
	}
	
////////////////////////upload images/////////////////////////////////////////////
function upload_image_1($form_field_name,$uid)
	{
		//echo '<pre>';print_r($_FILES);die;
		$config['upload_path'] = '../assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
		$config['encrypt_name']=TRUE;
	
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload($form_field_name)) {
					$errors = $this->upload->display_errors();
		} else {
			//$uid=$this->session->userdata( 'user_id' );
			$dfile_name=get_perticular_field_value('zc_user','file_1'," and user_id='".$uid."'");
			
			$dfile='../assets/uploads/'.$dfile_name;
			 if(is_file($dfile))
			 @unlink($dfile);
			$dfile_thmb='assets/uploads/thumb_92_82/'.$dfile_name;
			 if(is_file($dfile_thmb))
			 @unlink($dfile_thmb);	
					
			$upload_data = $this->upload->data(); 
			$file_names =   $upload_data['file_name'];
			$rs_update=$this->users->update_profile_1($file_names,$uid);
			 $config = array(
			'source_image'      => $upload_data['full_path'], //path to the uploaded image
			'new_image'         => "../assets/uploads/thumb_92_82/".$file_names, //path to
			'maintain_ratio'    => true,
			'width'             => 128,
			'height'            => 128
			);
			
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
		}
	}
	
	function upload_image_2($form_field_name,$uid) {
		
		
		$config['upload_path'] = '../assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
		$config['encrypt_name']=TRUE;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload($form_field_name)) {
			$errors = $this->upload->display_errors();       
		} else{
			////////////////delete image first////////////////////
			$uid=$this->session->userdata( 'user_id' );
			$dfile_name=get_perticular_field_value('zc_user','file_2'," and user_id='".$uid."'");
			$dfile='../assets/uploads/'.$dfile_name;
			 if(is_file($dfile))
			 @unlink($dfile);
			$dfile_thmb='../assets/uploads/thumb_92_82/'.$dfile_name;
			 if(is_file($dfile_thmb))
			 @unlink($dfile_thmb);
			
			
			/////////////delete image end//////////////////////////
			$upload_data = $this->upload->data(); 
			$file_names =   $upload_data['file_name'];
			$rs_update=$this->users->update_profile_2($file_names,$uid);
			 $config = array(
			'source_image'      => $upload_data['full_path'], //path to the uploaded image
			'new_image'         => "../assets/uploads/thumb_92_82/".$file_names, //path to
			'maintain_ratio'    => true,
			'width'             => 128,
			'height'            => 128
			);
			
			$this->image_lib->initialize($config);
			$this->image_lib->resize();   
		}
	}	
	
	function view_message() {
			$user_id=$this->uri->segment('3');
			$this->load->library('pagination');
			$config = array();
			$data['page_header_title'] = 'User Profile';
			
			$data['user_infos']=$this->users->get_user_detail($user_id);
			$config["base_url"] = base_url() . "users/view_message/".$user_id;
			$config["total_rows"] = get_perticular_count('zc_property_message_info'," and user_id_to='".$user_id."' group by msg_grp_id");
			$config["per_page"] = 10;
			$config["uri_segment"] = 4;
			
			$paginationA = clone($this->pagination);
			$paginationA->initialize($config);
			
			//$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$data["msg_totals"] = array();
			if( count($config["total_rows"]) > 0 ) {
				$data["msg_totals"] = $this->users->get_msg_detail($user_id,$config["per_page"], $page);
				$data["pagination"] = $paginationA->create_links();
			}
			/*
			$data['feedback_totals']= array();
			$configB["base_url"] = base_url() . "user/view_message/".$user_id."/feedback";
			$configB["per_page"] = 2;
			$configB["uri_segment"] = 5;
			$configB["total_rows"] = get_perticular_count('zc_feedback'," and feedback_to_id='".$user_id."' and feedback_status='1'");
			$paginationB = clone($this->pagination);
			$paginationB->initialize($configB);
			
			if( count($config["total_rows"]) > 0 ) {
				$data["feedback_totals"] = $this->users->get_user_feddback($user_id,$configB["per_page"], $page);
				$data["paginationB"] = $paginationB->create_links();
			}*/
			$this->load->view('users/view_message',$data);
			
	}	
	
	function feedback() {
		$user_id=$this->uri->segment('3');
		$this->load->library('pagination');
		$configB = array();
		$data['page_header_title'] = 'User Profile';
			
		$data['user_infos']=$this->users->get_user_detail($user_id);
		
		$data['feedback_totals']= array();
		$configB["base_url"] = base_url() . "users/feedback/".$user_id;
		$configB["per_page"] = 10;
		$configB["uri_segment"] = 4;
		$configB["total_rows"] = get_perticular_count('zc_feedback'," and feedback_to_id='".$user_id."' and feedback_status='1'");
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		$paginationB = clone($this->pagination);
		$paginationB->initialize($configB);
			
		if( count($configB["total_rows"]) > 0 ) {
			$data["feedback_totals"] = $this->users->get_user_feddback($user_id,$configB["per_page"], $page);
			$data["paginationB"] = $paginationB->create_links();
		}
		$this->load->view('users/view_message',$data);
			
	}
	
	function msg_details() {
		$msg_id=$this->input->post('msg_id');
		$msg_grp_id=get_perticular_field_value('zc_property_message_info','msg_grp_id'," and msg_id='".$msg_id."'");
		$all_msgs=$this->users->get_property_msg($msg_grp_id);
		echo "<table>";
		$i=0;
		echo "<tr><td colspan='4'><a href='javascript: void(0);' onclick='location.reload(); ' style='float:right; margin-right:25px; background:#427EBA; color:#fff; border-radius:4px; padding:2px 6px;'  > Back</a></td></tr>";
		foreach($all_msgs as $msgs) {
			if($i%2==0) {
				$class='';
			} else {
				$class="class='odd_row'";
			}
			if($msgs['property_id']!='0') {
				$sub='Request for:'.subject_inbox($msgs['property_id']);
			}
			else {
				$sub='Subject:'.ucfirst($msgs['subject']);
			}
			echo "<tr ".$class.">
	  				<td></td>
                      <td colspan='3'>
					  	<span style='font-weight:bold;'>".$sub."</span><br>
                        <span style='color:#1F76D9'></span>".$msgs['message']."<br>
                        <div style='float:right; margin-right:10px;'>
						<span style='color:#1F76D9;'>By </span>".$msgs['user_name']."</div><br>
                        <div style='float:right; margin-right:10px;'><span style='color:#1F76D9;'>On: </span>".date('d/m/Y g:i A',strtotime($msgs['msg_date']))."
                      </div></td>
            </tr>";
			$i++;
		}
		echo "</table>";
	}
	
	function feedback_details() {
		$msg_id=$this->input->post('msg_id');
		$all_msgs=$this->users->get_feedback_details($msg_id);
		echo "<table>";
		$i=0;
		echo "<tr><td colspan='4'><a href='javascript: void(0);' onclick='location.reload(); ' style='float:right; margin-right:25px; background:#427EBA; color:#fff; border-radius:4px; padding:2px 6px;' > Back</a></td></tr>";
		foreach($all_msgs as $msgs) {
			if($i%2==0) {
				$class='';
			} else {
				$class="class='odd_row'";
			}	
			$sub='Subject:'.ucfirst($msgs['feedback_subject']);
			echo "<tr ".$class.">
	  				<td></td>
                      <td colspan='3'>
					  	<span style='font-weight:bold;'>".$sub."</span><br>
                        <span style='color:#1F76D9'></span>".$msgs['feedback_msg']."<br>
                        <div style='float:right; margin-right:10px;'>
						<span style='color:#1F76D9;'>By </span>".$msgs['user_name']."</div><br>
                        <div style='float:right; margin-right:10px;'><span style='color:#1F76D9;'>On: </span>".date('d/m/Y g:i A',strtotime($msgs['feedback_date']))."
                      </div></td>
            </tr>";
			$i++;
		}
		echo "</table>";
	}
	
}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */