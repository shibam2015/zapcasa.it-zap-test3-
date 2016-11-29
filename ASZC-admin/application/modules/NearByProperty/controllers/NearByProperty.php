<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class NearByProperty extends CI_Controller {

 public function __construct()
   {
	parent::__construct();
	$this->load->library('session');
	userLoginCheck($this->session->userdata);
	$this->controller = 'NearByProperty';
	$this->load->library('pagination');
	$this->load->library('form_validation');
   }

	

	public function n_category() {		
		$data = array();
		$data['result'] = array();
		$this->load->model('Common_model');
		$data['title_en'] = "View All Near By Category";
		$data['result'] = $this->Common_model->get_list_of_category();
		$this->load->view('n_category_index', $data);		
	}

	

	public function n_category_edit() {

		$data = array();

		if( isset($_REQUEST['Submit']) && ($_REQUEST['Submit'] == "Submit" ) && ($_REQUEST['cat_id'] == 0 ) ) {

			$data = array(

					'category_id' => '',

					'category_name' => $_REQUEST['category_name'],

					'it_category_name' => $_REQUEST['it_category_name'],

					'created' => time(),

					'status' => 1,

			);

			$this->db->insert('zc_nearbyproperty_category', $data);

			$nearbypropertyCategoryId = $this->db->insert_id();

			redirect('NearByProperty/n_category');

		}	

		$this->load->view('n_category_edit', $data);

	}

	public function n_category_edit_page( $cat_id = 0 ) {

		$this->load->model('Common_model');

		$data = array();

		//if( isset( $cat_id ) && ( $cat_id != 0) ) {

			$data['result'] = array();

			if( isset($_REQUEST['Submit']) && ($_REQUEST['Submit'] == "Submit" ) && ($_REQUEST['cat_id'] != 0 ) ) {

				$updatByPrms = $_REQUEST['cat_id'];

				$dataStr = " category_name ='".$_REQUEST['category_name']."',it_category_name ='".$_REQUEST['it_category_name']."'";

				$attr = "category_id";

				$table_name = "nearbyproperty_category";

				$this->Common_model->common_update_by_attribute_name($dataStr, $updatByPrms,$attr ,$table_name);

			}

			$attr = "category_id";

			$table_name = "nearbyproperty_category";

			$data['result'] = $this->Common_model->common_get_details_by_attribute_name($cat_id, $attr ,$table_name);

			if( count( $data['result'] ) > 0 ) {

				$this->load->view('n_category_edit_page', $data);

			} else {

				redirect('NearByProperty/n_category');

			}

		/*} else {

			redirect('NearByProperty/n_category');

		}*/

	}

	

	public function statuschange( $cat_id = 0 ) {

		$this->load->model('Common_model');

		$data = array();

		if( isset( $cat_id ) && ( $cat_id != 0) ) {

			$attr = "category_id";

			$table_name = "nearbyproperty_category";

			$cat_details = $this->Common_model->common_get_details_by_attribute_name($cat_id, $attr ,$table_name);

			

			if( count( $cat_details ) > 0 ) {

				if( $cat_details[0]->status == 1 ) {

					$dataStr = " status = 2";

				} else {

					$dataStr = " status = 1";

				}

				$updatByPrms = $cat_details[0]->category_id;

				$attr = "category_id";

				$table_name = "nearbyproperty_category";

				$this->Common_model->common_update_by_attribute_name($dataStr, $updatByPrms,$attr ,$table_name);

			}

			redirect('NearByProperty/n_category');

		} else {

		 redirect('NearByProperty/n_category');

		}

	}

	

	public function index() {
		
		$type= $this->uri->segment('3');	
		$this->load->model('Common_model');
		$result = '';
		$data = array();
		$data['result'] = array();
		$this->load->model('Common_model');
		$data['title_en'] = "View All Near By Property";
		//$data['result'] = $this->Common_model->get_all_property();
		$config['base_url'] = base_url().$this->controller. '/'. __FUNCTION__ .'/'.$type;
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$data['page_header_title'] = 'Property';
		
		
		$data['type'] = $type;
		
		$data['category_list']=$this->Common_model->get_category_list();
		
		if($type=='all'){
			$whereClause = array();
		}else{
			$whereClause = array('category_id ' =>$type );
		}

		$data['property_details']=$this->Common_model->get_all_property($config, $this->uri->segment($config['uri_segment'], 0), $whereClause);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();    
		$this->load->view('index', $data);
	}

	

	public function index_edit($prp_id = '') {

		$this->load->model('Common_model');
		$data = array();
		$data['category_list']= array();
		if (userLoginCheck($this->session->userdata)) {		
		}
		if( isset($_REQUEST['Submit']) && ($_REQUEST['Submit'] == "Submit" ) ) {
			$lat_lng_array = $this->Common_model->getLangLat( $this->input->post('street_address') . ','.$this->input->post( 'street_no' ) . ','. $this->input->post( 'city' ) . ',' . $this->input->post( 'provience' ) . ',' . $this->input->post( 'zip' ));
			$latitude = (float) $lat_lng_array->lat;
			$longitude = (float)$lat_lng_array->lng;
			 $data = array(
			 		'property_details_id' => '',
			 		'category_id' => $_REQUEST['category_id'],
			 		'name' => $_REQUEST['name'],
			 		'opt_name' => $_REQUEST['opt_name'],
			 		'provience' => $_REQUEST['province'],
			 		'zip' => $_REQUEST['zip'],
			 		'street_address' => $_REQUEST['street_address'],
			 		'street_no' => $_REQUEST['street_no'],
			 		'city' => $_REQUEST['city'],
			 		'latitude' => $latitude,
			 		'longitude' => $longitude,
			 		'url' => '',
			 		'created' => time(),
			 		'status' => 1,
			 );

			$this->db->insert('zc_nearbyproperty_details', $data);
			$nearbypropertyDetailsId = $this->db->insert_id();
			if( $nearbypropertyDetailsId > 0 ) {	
				if( isset($_FILES['property_image']['name']) && ($_FILES['property_image']['name'] != "" )) {
					$name_type = end(explode('.', $_FILES['property_image']['name']));
					$valid_array_type = array('jpg', 'jpeg', 'png', 'bmp','JPG' ,'JPEG','PNG');
					if (in_array($name_type, $valid_array_type)) {
						$nearByPropertyDir = 'assets/uploads/NearByProperty/';
						$new_thumb_targetpath = 'assets/uploads/NearByProperty/thumb/';
						if(!file_exists($nearByPropertyDir)){
							mkdir($nearByPropertyDir, 0777, false);
						}
						if(!file_exists($new_thumb_targetpath)){
							mkdir($new_thumb_targetpath, 0777, false);

						}
						$property_name = "property".$nearbypropertyDetailsId.'_pic.'.$name_type;
						$new_targetpath = $nearByPropertyDir.$property_name;
						@unlink($new_targetpath);
						copy($_FILES['property_image']['tmp_name'], $new_targetpath);
						$thumb_path =   $new_thumb_targetpath.'/'.$property_name;
						@unlink($thumb_path);
						copy($_FILES['property_image']['tmp_name'], $thumb_path);
						$result = thumb($new_targetpath, 180, 180, $thumb_path);
						$thumb_url = "";
						$upadteData=array('url'=>$property_name);
						$this->db->where('property_details_id',$nearbypropertyDetailsId);
						$this->db->update('zc_nearbyproperty_details',$upadteData);						
					}
				}
			}
		}
			
		$data['title_en'] = "Add Near By Property";
		$data['provience_list']=$this->Common_model->get_provience_list();
		$data['category_list']=$this->Common_model->get_category_list();
		// $this->load->view('index_edit', $data);		
		redirect('NearByProperty/manage_location/update/'.$nearbypropertyDetailsId);
	}

	

	public function index_edit_page( $cat_id = 0  ) {

		$this->load->model('Common_model');

		$data = array();

		$data['result'] = array();



		if( isset($_REQUEST['Submit']) && ($_REQUEST['Submit'] == "Submit" ) && ($_REQUEST['nearbypropertyId'] != 0 ) ) {

			$lat_lng_array = $this->Common_model->getLangLat( $this->input->post('street_address') . ','.$this->input->post( 'street_no' ) . ','. $this->input->post( 'city' ) . ',' . $this->input->post( 'provience' ) . ',' . $this->input->post( 'zip' ));

			$latitude = (float) $lat_lng_array->lat;

			$longitude = (float)$lat_lng_array->lng;

				

			$updatByPrms = $_REQUEST['nearbypropertyId'];

			$dataStr = " `category_id` ='".$_REQUEST['category_id']."',`name`='".$_REQUEST['name']."',`opt_name` ='".$_REQUEST['opt_name']."',`provience`='".$_REQUEST['province']."',`city` ='".$_REQUEST['city']."',`zip`='".$_REQUEST['zip']."',`street_address` ='".$_REQUEST['street_address']."',`street_no`='".$_REQUEST['street_no']."',`modified_on`='".time()."'";

			$attr = "property_details_id";

			$table_name = "nearbyproperty_details";

			$this->Common_model->common_update_by_attribute_name($dataStr, $updatByPrms,$attr ,$table_name);

			

			if( isset($_FILES['property_image']['name']) && ($_FILES['property_image']['name'] != "" )) {

					

				$name_type = end(explode('.', $_FILES['property_image']['name']));

				$valid_array_type = array('jpg', 'jpeg', 'png', 'bmp','JPG' ,'JPEG','PNG');

				if (in_array($name_type, $valid_array_type)) {

			

					$nearByPropertyDir = 'assets/uploads/NearByProperty/';

					$new_thumb_targetpath = 'assets/uploads/NearByProperty/thumb/';

					if(!file_exists($nearByPropertyDir)){

						mkdir($nearByPropertyDir, 0777, false);

					}

					if(!file_exists($new_thumb_targetpath)){

						mkdir($new_thumb_targetpath, 0777, false);

					}

					$property_name = "property".$updatByPrms.'_pic.'.$name_type;

					$new_targetpath = $nearByPropertyDir.$property_name;

					@unlink($new_targetpath);

					copy($_FILES['property_image']['tmp_name'], $new_targetpath);

					$upadteData=array('url'=>$property_name);

					$this->db->where('property_details_id',$updatByPrms);

					$this->db->update('zc_nearbyproperty_details',$upadteData);

			

				}

			}

		}

		$data['title_en'] = "Edit Near By Property";

		$attr = "property_details_id";

		$table_name = "nearbyproperty_details";

		$data['result'] = $this->Common_model->common_get_details_by_attribute_name($cat_id, $attr ,$table_name);

		if( count( $data['result'] ) > 0 ) {

			$data['provience_list']=$this->Common_model->get_provience_list();

			$data['category_list']=$this->Common_model->get_category_list();

			$data['city']=$this->Common_model->get_city_list_all();

			$this->load->view('index_edit_page', $data);

		} else {
			redirect('NearByProperty/manage_location/update/'.$_REQUEST['nearbypropertyId']);
			// redirect('NearByProperty/index/all');

		}

	}

	public function manage_location(){
		$this->load->model('Common_model');
		$data = array();
			
		$data['locupdatetype']=$this->uri->segment('3');				
		$property_id=$this->uri->segment('4');
		$data['property_details']=$this->Common_model->get_property_detail($property_id);
		
		$this->load->view('NearByProperty/manage-location',$data);			
	}

	public function update_location(){
		
		$property_id=$this->input->post('locupdatefor');

		if(userLoginCheck($this->session->userdata)){			
		}
		
		$lat = (float) $this->input->post('promaplatitude');
		$long = (float) $this->input->post('promaplongitude');			
		
		$sql = "UPDATE zc_nearbyproperty_details SET latitude='".$lat."', longitude='".$long."' WHERE property_details_id=".$property_id;
		$this->db->query($sql);
			
		redirect('NearByProperty/index/all');
			
	}

	public function index_delete_page($prop_id='')
	{
		$this->load->model('Common_model');
		$property_id=$this->uri->segment('3');
		$rs=$this->Common_model->delete_property($property_id);
		if($rs)
		{
			$this->session->set_flashdata('success', 'The property is deleted successfully');
			redirect('NearByProperty/index/all');
		}
	}

	public function statuschange_prop( $type, $cat_id = 0 ) {

		$this->load->model('Common_model');

		$data = array();

		if( isset( $cat_id ) && ( $cat_id != 0) ) {

			$attr = "property_details_id";

			$table_name = "nearbyproperty_details";

			$cat_details = $this->Common_model->common_get_details_by_attribute_name($cat_id, $attr ,$table_name);

				

			if( count( $cat_details ) > 0 ) {

				if( $cat_details[0]->status == 1 ) {

					$dataStr = " status = 2";

				} else {

					$dataStr = " status = 1";

				}

				$updatByPrms = $cat_details[0]->property_details_id;

				$attr = "property_details_id";

				$table_name = "nearbyproperty_details";

				$this->Common_model->common_update_by_attribute_name($dataStr, $updatByPrms,$attr ,$table_name);

			}

			redirect('NearByProperty/index/'.$type);

		} else {

			redirect('NearByProperty/index/'.$type);

		}

	}

	

	function city_search() {
		$this->load->model('Common_model');
		$province=$this->input->post('name');
		$rs=$this->Common_model->get_city_list($province);
		if( count( $rs ) > 0 ) {
			foreach($rs as $key=>$val) {
				echo "<option value='".$val."'>".$val."</option>";
			}
		} else {
			echo "<option value='0'>Please select your province first</option>";
		}
	}

	

	function upload_image_1($form_field_name,$property_id) {

		/*$new_file="Property".$property_id;

		$structure = './asset/uploads/NearByProperty/'.$new_file;

		if (!is_dir('asset/uploads/NearByProperty/'.$new_file)) {

			mkdir('./asset/uploads/NearByProperty/'.$new_file, 0777, true);

			chmod('./asset/uploads/NearByProperty/'.$new_file, 0777);

		}

	

		$config['upload_path'] = './asset/uploads/NearByProperty/'.$new_file;

		$config['allowed_types'] = 'gif|jpg|png|jpeg';

		$config['encrypt_name']=TRUE;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload($form_field_name)) {

			$errors = $this->upload->display_errors();

		} else {

			$upload_data = $this->upload->data();

			$file_names =   $upload_data['file_name'];

			$rs_update=$this->property_model->insert_property_picture($file_names,$property_id);

			

		}*/

	}

	

	

}