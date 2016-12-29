<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Property extends CI_Controller { 
	public function __construct(){
		parent::__construct();
		$this->controller = 'property';
		$this->load->library('session');
		$this->load->library('image_lib');
		$this->load->model('property_model');
		userLoginCheck($this->session->userdata);
		$this->load->library('pagination');
	}
	public function index(){
		$data = array();
		$sqlMore = "";
		$type = $this->uri->segment('2');
		$activetype = $this->uri->segment('3');
		$config['base_url'] = base_url().$this->controller. '/'. $type . '/' . $activetype .'/';
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$search_property_code = $this->input->get('search_property_code');		
		$data['page_header_title'] = 'Property';
		$data['search_property_code'] = $search_property_code;
		$data['type'] = $type;
		$data['activetype'] = $activetype;
		
		if(!strpos($type, "-")===false){
			$typeData = explode("-",$type);
			$type = $typeData[0];
			$proPostedBy = $typeData[1];
		}
		
		switch($type){
			case 'probyuser':
				$FnMOfProPostedBy = get_perticular_field_value('zc_user','user_name'," AND `user_id`='".$proPostedBy."'");
				$pageBlockTitle = "View All Properties By : ".stripslashes($FnMOfProPostedBy);
				$sqlMore = " AND `zc_property_details`.`property_post_by`='".$proPostedBy."'";
				$data['user_infos']=$this->property_model->get_user_detail($proPostedBy);
				break;
			case '':
				$pageBlockTitle = "View The Property For : ".$search_property_code;
				$sqlMore = $this->property_model->searchSqlMore($search_property_code);
				break;
			case 'all':
				$pageBlockTitle = "View All The Properties";
				$sqlMore = ($search_property_code==''?"":$this->property_model->searchSqlMore($search_property_code));				
				break;
			case 'byowner':
				$pageBlockTitle = "View All Properties By : Owners";
				$sqlMore = " AND `zc_property_details`.`property_post_by_type`='2'";
				break;
			case 'byagency':
				$pageBlockTitle = "View All Properties By : Agencies";
				$sqlMore = " AND `zc_property_details`.`property_post_by_type`='3'";
				break;
			case 'residentail':
				$pageBlockTitle = "View All Properties Under Residential Category";
				$sqlMore = " AND (zc_property_details.category_id in (select category_id from zc_categories where parent_id =1) or zc_property_details.category_id in (1))";
				break;
			case 'bussiness':
				$pageBlockTitle = "View All Properties Under Bussiness Category";
				$sqlMore = " AND (zc_property_details.category_id in (select category_id from zc_categories where parent_id =2) or zc_property_details.category_id in (2))";
				break;
			case 'rooms':
				$pageBlockTitle = "View All Properties Under Room Category";
				$sqlMore = " AND (zc_property_details.category_id in (select category_id from zc_categories where parent_id =3) or zc_property_details.category_id in (3))";
				break;
			case 'land':
				$pageBlockTitle = "View All Properties Under Land Category";
				$sqlMore = " AND (zc_property_details.category_id in (select category_id from zc_categories where parent_id =4) or zc_property_details.category_id in (4))";
				break;
			case 'vacations':
				$pageBlockTitle = "View All Properties Under Vacations Category";
				$sqlMore = " AND (zc_property_details.category_id in (select category_id from zc_categories where parent_id =5) or zc_property_details.category_id in (5))";
				break;
			case 'luxury':
				$pageBlockTitle = "View All Properties Under Luxury Category";
				$sqlMore = " AND zc_property_details.category_id in (1, 5, 6, 7)";
				break;
		}		
		$data['pageBlockTitle'] = $pageBlockTitle;
		
		$data['property_details'] = $this->property_model->get_all_property($config, $this->uri->segment($config['uri_segment'], 0), $search_property_code, $type, $activetype, $sqlMore);
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
				
		$data['allFilterProperty'] = get_perticular_count('zc_property_details',"AND property_status!='0'".$sqlMore);
		$data['activeFilterProperty'] = get_perticular_count('zc_property_details',"AND property_status='2' AND property_approval='1'".$sqlMore);
		$data['inActiveFilterProperty'] = get_perticular_count('zc_property_details',"AND property_status!='0' AND property_approval='0'".$sqlMore);
		$data['featuredFilterProperty'] = $this->property_model->featuredFilterProperty('1',$sqlMore);
		$data['suspendedFilterProperty'] = $this->property_model->featuredFilterProperty('0',$sqlMore);
		
		//echo '<pre>';print_r($data['pagination']);die;
		$this->load->view('property_template', $data);	
	}
	public function latest_property_add(){
		$data = array();
		$config['base_url'] = base_url().$this->controller. '/'. __FUNCTION__;
		$data['page_header_title'] = 'Property';
		$data['property_details']=$this->property_model->get_all_property_latest();
		$this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
		//echo '<pre>';print_r($data['pagination']);die;
		$this->load->view('latest_property_add', $data);		
	}
	public function status_change(){
		$property_id=$this->uri->segment('3');
		$type=$this->uri->segment('4');
		$activetype=$this->uri->segment('5');
		$page=$this->uri->segment('6');
		if($type == '')
		{
			$type = 'all';
			$activetype = 'all';
		}
		//$property_status=get_perticular_field_value('zc_property_details','property_status', " and property_id='".$property_id."'");
		$property_approval=get_perticular_field_value('zc_property_details','property_approval', " and property_id='".$property_id."'");
		
		if($property_approval=='0'){
			// $byWhom=$this->session->userdata('admin_user_id');
			// $active_status=1;
			// $rs=$this->property_model->status_change($property_id,$byWhom,$active_status);
			$sql = "UPDATE zc_property_details SET property_approval='1' WHERE property_id='".$property_id."'";
			$res = $this->db->query($sql);
		}
		if($property_approval=='1'){
			// $byWhom=get_perticular_field_value('zc_property_details','property_post_by', " and property_id='".$property_id."'");
			// $active_status=0;
			// $rs=$this->property_model->status_change($property_id,$byWhom,$active_status);
			$sql = "UPDATE zc_property_details SET property_approval='0' WHERE property_id='".$property_id."'";
			$res = $this->db->query($sql);
		}
		$this->session->set_flashdata('success', 'The property status changed successfully');
		redirect('/property/'.$type.'/'.$activetype.($page==''?'':'/'.$page));
	}
	public function status_change_ajx(){
		$property_id=$this->input->post('proid');
		$data['blocked_note'] = $this->input->post('blockednote');

		$property_approval=get_perticular_field_value('zc_property_details','property_approval'," and property_id='".$property_id."'");
		if($property_approval=='0'){
			// $byWhom=$this->session->userdata('admin_user_id');
			// $active_status=1;
			// $rs=$this->property_model->status_change($property_id,$byWhom,$active_status);
			$sql = "UPDATE zc_property_details SET property_approval='1' WHERE property_id='" . $property_id . "'";
			$res = $this->db->query($sql);
		}
		if($property_approval=='1'){
			// $byWhom=get_perticular_field_value('zc_property_details','property_post_by', " and property_id='".$property_id."'");
			// $active_status=0;
			// $rs=$this->property_model->status_change($property_id,$byWhom,$active_status);
			$sql = "UPDATE zc_property_details SET property_approval='0' WHERE property_id='".$property_id."'";
			$res = $this->db->query($sql);
		}
		$this->send_blocked_note($property_id);
		//echo "hii";die;


		$this->property_model->update_property_details($data,$property_id);

		$this->session->set_flashdata('success', 'Blocked note has been added & status has been updated');
		//redirect('/property/'.$type.'/'.$activetype.($page==''?'':'/'.$page));
	}

	protected function send_blocked_note($property_id = "")
	{


		$new_data['blocked_note'] = $this->input->post('blockednote');

		//$this->property_model->update_property_details($new_data,$property_id);
		$userid = get_perticular_field_value('zc_property_details', 'property_post_by', " and property_id='" . $property_id . "'");
		$default_email = get_perticular_field_value('zc_settings', 'meta_value', " and meta_name='default_email'");
		$email = get_perticular_field_value('zc_user', 'email_id', " and user_id='" . $userid . "'");
		$user_full_name = get_perticular_field_value('zc_user', 'first_name', " and user_id='" . $userid . "'") . ' ' . get_perticular_field_value('zc_user', 'last_name', " and user_id='" . $userid . "'");

		$mail_from = isset($default_email) ? $default_email : "no-reply@zapcasa.it";
		$mail_to = $email;
		$languagePref = get_perticular_field_value('zc_user_preference', 'language', " and user_id='" . $userid . "'");
		$subject = ($languagePref == 'it' ? 'Il tuo Proprietà è stato bloccato.' : 'Your Property has been blocked.');
		if ($languagePref == 'it') {
			$msg = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">
			<div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
				<div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
				<div style="border-bottom:1px solid #d1d1d1;">
					<img src="' . base_url() . 'assets/images/logo.png" alt="ZapCasa"/>
				</div>
				<div style="padding:15px;">
					<strong>Ciao ' . $user_full_name . '</strong>,<br>
					<p>Questo è una notifica automatica per informarti che il tuo on Proprietà ZapCasa è stato bloccato.</p>
					<p>Per maggiori informazioni ti invitiamo ad effettuare il login su <a href="http://www.zapcasa.it">www.zapcasa.it</a>.</p><br>
					<p>Saluti,<br><a href="http://www.zapcasa.it">www.zapcasa.it</a></p>
				</div>
			</div>
			</body>';
		} else {
			$msg = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">
			<div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
				<div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
				<div style="border-bottom:1px solid #d1d1d1;">
					<img src="' . base_url() . 'assets/images/logo.png" alt="ZapCasa"/>
				</div>
				<div style="padding:15px;">
					<strong>Hi ' . $user_full_name . '</strong>,<br>
					<p>This is an automatic notification to inform you that your Property On ZapCasa has been blocked.</p>
					<p>For further information please login on <a href="http://www.zapcasa.it">www.zapcasa.it</a>.</p><br>
					<p>Regards,<br><a href="http://www.zapcasa.it">www.zapcasa.it</a></p>
				</div>
			</div>
			</body>';
		}
		$body = $msg;
		sendemail($mail_from, $mail_to, $subject, $body, $cc = '');

		//$this->session->set_flashdata('success', 'Blocked note has been added & status has been updated');
		//redirect($this->controller.($type=='index'?'':'/'.$type).($page==''?'':'/'.$page));
	}

	public function pro_view_st_change(){
		$property_id = $this->uri->segment('3');
		//$property_status=get_perticular_field_value('zc_property_details','property_status', " and property_id='".$property_id."'");
		$suspention_status=get_perticular_field_value('zc_property_details','suspention_status', " and property_id='".$property_id."'");

		if($suspention_status=='0'){
			$byWhom=$this->session->userdata('admin_user_id');
			$active_status=1;
			$rs=$this->property_model->status_change($property_id,$byWhom,$active_status);
		}
		if($suspention_status=='1'){
			$byWhom=get_perticular_field_value('zc_property_details','property_post_by', " and property_id='".$property_id."'");
			$active_status=0;
			$rs=$this->property_model->status_change($property_id,$byWhom,$active_status);
		}
		$this->session->set_flashdata('success', 'The property status changed successfully');
		redirect('/property/view_property_details/'.$property_id);
	}

	public function property_approval_st_change(){
		$property_id=$this->uri->segment('3');
		$property_approval=get_perticular_field_value('zc_property_details','property_approval'," and property_id='".$property_id."'");
		if($property_approval=='0'){
			$property_approval=1;
			$rs=$this->property_model->property_approval_status_change($property_id,$property_approval);
			redirect('/property');
		}
		if($property_approval=='1'){
			$property_approval=0;
			$rs=$this->property_model->property_approval_status_change($property_id,$property_approval);
			/*
			sending mail if approval is pending by the admin
			if($rs==1){
				$this->send_mail($property_id);
			}*/
			redirect('/property');
		}
	}

	public function delete_property(){
		$property_id=$this->uri->segment('3');
		$type=$this->uri->segment('4');
		$activetype=$this->uri->segment('5');
		$page=$this->uri->segment('6');

		$rs=$this->property_model->delete_property($property_id);
		if($rs){
			$this->property_model->del_prop_image($property_id);
			$dfile='./assets/uploads/Property/Property'.$property_id;
			if(is_dir($dfile))
				//@rmdir($dfile);
				deleteNonEmptyDir($dfile);

			$this->session->set_flashdata('success', 'The property is deleted successfully');
			redirect('/property/'.$type.'/'.$activetype.($page==''?'':'/'.$page));
		}
	}

	public function view_property_details(){
		$property_id=$this->uri->segment('3');
		////////////////////////////////////////////
		$data['status_of_property']=$this->property_model->get_status_of_property();
		//echo '<pre>';print_r($data['status_of_property']);die;
		$data['kind_of_property']=$this->property_model->get_kind_of_property();
		$data['energy_efficiency_class']=$this->property_model->get_energy_efficiency_class();
		////////////////////////////////////////////
		$data['page_header_title']="Property Information";
		$data['property_details']=$this->property_model->get_property_details($property_id);
		$data['property_img'] = $this->property_model->get_img_prop($property_id);

		$this->load->view('property_view_template', $data);
	}

	public function edit_property_details(){
		$property_id=$this->uri->segment('3');
		$data['property_details']=$this->property_model->get_property_details($property_id);
		$data['property_images']=$this->property_model->get_img_prop($property_id);
		$data['status_of_property']=get_all_value("zc_status_of_property","and status='1'");
		$data['kind_of_property']=get_all_value("zc_kind_of_property","and status='1'");
		$data['energy_efficiency_class']=$this->property_model->get_energy_efficiency_class();
		$data['contract_type']=$this->property_model->get_contract_type();
		$province=get_perticular_field_value('zc_provience','provience_name'," AND provience_id='".$data['property_details'][0]['provience']."'");
		$data['city']=$this->property_model->get_city_list($province);
		$data['provience_list']=$this->property_model->get_provience_list();

		$this->load->view('property_edit_template', $data);
	}

	public function update_property_details(){
		$property_id=$this->uri->segment('3');

		//$new_data['property_status']='2';
		$new_data['update_time']=date('Y-m-d');
		if($this->input->post('pvt_negotiation')=='1'){
			$price='';
			$update_price='0.00';
			$private_nagotiation='1';
		}else{
			$pricee=$this->input->post('price');
			$pricees=floatval(str_replace(',', '.', str_replace('.', '', $pricee)));

			$private_nagotiation='0';
			$up_price=get_perticular_field_value('zc_property_details','update_price'," and property_id='".$property_id."'");
			if($up_price=='0.00'){
				$price_org=get_perticular_field_value('zc_property_details','price'," and property_id='".$property_id."'");
				$price=$price_org;
				$update_price=$pricees;
			}else{
				$price_org=get_perticular_field_value('zc_property_details','update_price'," and property_id='".$property_id."'");
				$price=$pricees;
				$update_price=$price_org;
			}
		}
		$property_approval='1';
		$category_id=get_perticular_field_value('zc_property_details','category_id'," and property_id='".$property_id."'");
		$category_name=get_perticular_field_value('zc_categories','short_code'," and category_id='".$category_id."'");
		if($category_name=='PRO' || $category_name=='BLI' || $category_name=='BUS'){
			$category="BUS";
		}else{
			$category=$category_name;
		}

		$new_data['category_id']='4';
		$new_data['provience']=$this->input->post('province');
		$new_data['city']=$this->input->post('city');
		$new_data['zip']=$this->input->post('zip');
		$new_data['street_address']=$this->input->post('address');
		$new_data['street_no']=$this->input->post('street_no');
		$new_data['area']=$this->input->post('area');
		$new_data['price']=$price;
		$new_data['update_price']=$update_price;
		$new_data['private_nagotiation']=$private_nagotiation;
		$new_data['youtube_url']=$this->input->post('url');
		$new_data['typology']=$this->input->post('typology');
		$new_data['availability']=$this->input->post('availabilty');
		$new_data['description']=$this->input->post('description');
		$new_data['property_approval']=$property_approval;
		// $lat_lng_array=getLangLat( $this->input->post('street_address') . ','.$this->input->post( 'street_no' ) . ','. $this->input->post( 'city' ) . ',' . $this->input->post( 'provience' ) . ',' . $this->input->post( 'zip' ));
		// $new_data['latitude'] = (float) $lat_lng_array->lat;
		// $new_data['longitude'] = (float)$lat_lng_array->lng;

		if($category=='LAND'){
			$new_data['category_id']='4';
			$new_data['kind']=$this->input->post('kind_of_property');
			$new_data['surface_area'] = $this->input->post('surface_area');
		}
		if($category=='VAC'){
			$new_data['category_id'] = '5';
			$new_data['status']=$this->input->post('status_of_property');
			if($this->input->post('energy_efficiency')){
				$new_data['energyclass']=$this->input->post('energy_efficiency');
			}
			$new_data['surface_area']=$this->input->post('surface_area');
			$new_data['room_no']=$this->input->post('room_no');
			$new_data['floor']=$this->input->post('floor');
			$new_data['total_of_floors']=$this->input->post('tot_floor');
			$new_data['year_of_building']=$this->input->post('year_of_building');
			$new_data['beds_no']=$this->input->post('bed_no');
			$new_data['bathrooms_no']=$this->input->post('bothroom_no');
			$new_data['kitchen']=$this->input->post('kitchen');
			$new_data['heating']=$this->input->post('heating');
			$new_data['parking']=$this->input->post('parking');
			$new_data['furnished']=$this->input->post('furnished');
			$new_data['pets']=$this->input->post('pets');
			$new_data['air_conditioning']=$this->input->post('air_conditioning');
			$new_data['elevator']=$this->input->post('elevator');
			$new_data['balcony']=$this->input->post('balcony');
			$new_data['terrace']=$this->input->post('terrace');
			$new_data['garden']=$this->input->post('terrace');
			$new_data['add_to_luxury']=$this->input->post('add_to_luxury');
		}
		if($category=='ROM'){
			$new_data['category_id'] = '3';
			$new_data['floor'] = $this->input->post('floor');
			$new_data['bathrooms_no']=$this->input->post('bothroom_no');
			$new_data['kitchen']=$this->input->post('kitchen');
			$new_data['heating']=$this->input->post('heating');
			$new_data['parking']=$this->input->post('parking');
			$new_data['roommates']=$this->input->post('roommates');
			$new_data['occupation']=$this->input->post('occupation');
			$new_data['furnished']=$this->input->post('furnished');
			$new_data['smokers']=$this->input->post('smokers');
			$new_data['pets']=$this->input->post('pets');
			$new_data['air_conditioning']=$this->input->post('air_conditioning');
			$new_data['elevator']=$this->input->post('elevator');
			$new_data['balcony']=$this->input->post('balcony');
			$new_data['terrace']=$this->input->post('terrace');
			$new_data['garden']=$this->input->post('terrace');
			$new_data['add_to_luxury']=$this->input->post('add_to_luxury');
		}
		if($category=='RES'){
			$new_data['category_id'] = '1';
			$new_data['status']=$this->input->post('status_of_property');
			$new_data['kind']=$this->input->post('kind_of_property');
			$new_data['energyclass']=$this->input->post('energy_efficiency');
			$new_data['surface_area']=$this->input->post('surface_area');
			$new_data['room_no']=$this->input->post('room_no');
			$new_data['floor']=$this->input->post('floor');
			$new_data['total_of_floors']=$this->input->post('tot_floor');
			$new_data['year_of_building']=$this->input->post('year_of_building');
			$new_data['bathrooms_no']=$this->input->post('bothroom_no');
			$new_data['kitchen']=$this->input->post('kitchen');
			$new_data['heating']=$this->input->post('heating');
			$new_data['parking']=$this->input->post('parking');
			$new_data['furnished']=$this->input->post('furnished');
			$new_data['air_conditioning']=$this->input->post('air_conditioning');
			$new_data['elevator']=$this->input->post('elevator');
			$new_data['balcony']=$this->input->post('balcony');
			$new_data['terrace']=$this->input->post('terrace');
			$new_data['garden']=$this->input->post('terrace');
			$new_data['add_to_luxury']=$this->input->post('add_to_luxury');
		}
		if($category=='BUS'){
			$sub_cat=$this->input->post('sub_category');
			{
				if($sub_cat=='PRO'){
					$sub_cat_id='6';
				}
				if($sub_cat=='BLI'){
					$sub_cat_id='7';
				}
			}
			$new_data['category_id'] = $sub_cat_id;
			$new_data['status'] = $this->input->post('status_of_property');
			$new_data['kind'] = $this->input->post('kind_of_property');
			$new_data['energyclass'] = $this->input->post('energy_efficiency');
			$new_data['surface_area'] = $this->input->post('surface_area');
			$new_data['room_no'] = $this->input->post('room_no');
			$new_data['floor']=$this->input->post('floor');
			$new_data['total_of_floors'] = $this->input->post('tot_floor');
			$new_data['year_of_building']=$this->input->post('year_of_building');
			$new_data['bathrooms_no'] = $this->input->post('bothroom_no');
			$new_data['kitchen']=$this->input->post('kitchen');
			$new_data['heating']=$this->input->post('heating');
			$new_data['parking'] = $this->input->post('parking');
			$new_data['furnished']=$this->input->post('furnished');
			$new_data['air_conditioning']=$this->input->post('air_conditioning');
			$new_data['elevator']=$this->input->post('elevator');
			$new_data['balcony']=$this->input->post('balcony');
			$new_data['terrace']=$this->input->post('terrace');
			$new_data['garden']=$this->input->post('terrace');
			$new_data['add_to_luxury']=$this->input->post('add_to_luxury');
		}
		$property_ids=$this->property_model->update_property_details($new_data,$property_id);

		$this->edit_do_uploads_update($property_id);
		$this->upload_image_update_1('user_file_1',$property_id);
		$this->session->set_flashdata('success', "The property is Updated successfully");

		// redirect('property/edit_property_details/'.$property_id);
		redirect('property/manage_location/update/'.$property_id);
	}

	public function edit_do_uploads_update($property_id)
	{
		$new_file = "Property" . $property_id;
		$this->load->library('upload');
		$upload_path = '../assets/uploads/Property/' . $new_file;
		if (!is_dir($upload_path)) {
			mkdir($upload_path, 0777, true);
			chmod($upload_path, 0777);
		}
		$files = $_FILES;
		//echo '<pre>';print_r($files);die;
		$cpt = count($_FILES['userfile']['name']);
		for ($i = 0; $i < $cpt; $i++) {
			$_FILES['userfile']['name'] = $files['userfile']['name'][$i];
			$_FILES['userfile']['type'] = $files['userfile']['type'][$i];
			$_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
			$_FILES['userfile']['error'] = $files['userfile']['error'][$i];
			$_FILES['userfile']['size'] = $files['userfile']['size'][$i];
			$this->upload->initialize($this->set_upload_options($upload_path));

			if ($_FILES['userfile']['name'] != '') {
				$this->upload->do_upload();
				$upload_data = $this->upload->data();
				$file_names = $upload_data['file_name'];

				/*	------------------	Default	--------------------*/

				$original_size = getimagesize($_FILES['userfile']['tmp_name']);
				$ratio = $original_size[0] / $original_size[1];

				/*
				 *	161x241
				*/
				$upload_data = $this->upload->data();
				$file_names = $upload_data['file_name'];
				//$rs_update = $this->usersm->update_profile_1($file_names, $uid);
				$config = array(
					'source_image' => "../assets/uploads/Property/" . $new_file . "/" . $file_names,
					'new_image' => "../assets/uploads/Property/" . $new_file . "/thumb_860_482/" . $file_names,
					'width' => 161,
					'height' => 241
				);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();

				$this->setWatermarkImage("../assets/uploads/Property/" . $new_file . "/thumb_860_482/" . $file_names, "../assets/uploads/Property/" . $new_file . "/thumb_860_482/" . $file_names);
				/*
				 *	113x170
				*/

				$config = array(
					'source_image' => "../assets/uploads/Property/" . $new_file . "/" . $file_names,
					'new_image' => "../assets/uploads/Property/" . $new_file . "/thumb_200_296/" . $file_names,
					'width' => 170,
					'height' => 113
				);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->setWatermarkImage("../assets/uploads/Property/" . $new_file . "/thumb_200_296/" . $file_names, "../assets/uploads/Property/" . $new_file . "/thumb_200_296/" . $file_names);
				/*
				 *	50x75
				*/

				$config = array(
					'source_image' => "../assets/uploads/Property/" . $new_file . "/" . $file_names,
					'new_image' => "../assets/uploads/Property/" . $new_file . "/thumb_92_82/" . $file_names,
					'width' => 92,
					'height' => 82
				);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				/*
				 *	800x800
				*/
				$config = array(
					'source_image' => "../assets/uploads/Property/" . $new_file . "/" . $file_names,
					'new_image' => "../assets/uploads/Property/" . $new_file . "/" . $file_names,
					'width' => 800,
					'height' => 800,
				);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->setWatermarkImage("../assets/uploads/Property/" . $new_file . "/" . $file_names, "../assets/uploads/Property/" . $new_file . "/" . $file_names);

				$pic_path = $upload_path . '/' . $file_names;
				//watermark($pic_path);
				if ($i == 0) {
					$dfile_name = get_perticular_field_value('zc_property_img', 'file_name', " and property_id='" . $property_id . "' and img_type='main_image'");
					$dfile = $upload_path . '/' . $dfile_name;
					if (is_file($dfile)) {
						@unlink($dfile);
					}
					$dfile1 = $upload_path . '/thumb_860_482/' . $dfile_name;
					if (is_file($dfile1)) {
						@unlink($dfile1);
					}
					$dfile2 = $upload_path . '/thumb_200_296/' . $dfile_name;
					if (is_file($dfile2)) {
						@unlink($dfile2);
					}
					$dfile3 = $upload_path . '/thumb_92_82/' . $dfile_name;
					if (is_file($dfile3)) {
						@unlink($dfile3);
					}
					$img_id = get_perticular_field_value('zc_property_img', 'img_id', " and property_id='" . $property_id . "' and img_type='main_image'");
					$this->property_model->del_property_img($img_id);
					$img_type = "main_image";
					$prop_img_no = "0";
				} else {
					$dfile_name = get_perticular_field_value('zc_property_img', 'file_name', " and property_id='" . $property_id . "' and img_type='prop_picture' and prop_img_no='" . $i . "'");
					$dfile = $upload_path . '/' . $dfile_name;
					if (is_file($dfile)) {
						@unlink($dfile);
					}
					$dfile1 = $upload_path . '/thumb_860_482/' . $dfile_name;
					if (is_file($dfile1)) {
						@unlink($dfile1);
					}
					$dfile2 = $upload_path . '/thumb_200_296/' . $dfile_name;
					if (is_file($dfile2)) {
						@unlink($dfile2);
					}
					$dfile3 = $upload_path . '/thumb_92_82/' . $dfile_name;
					if (is_file($dfile3)) {
						@unlink($dfile3);
					}
					$img_id = get_perticular_field_value('zc_property_img', 'img_id', " and property_id='" . $property_id . "' and img_type='prop_picture' and prop_img_no='" . $i . "'");
					$this->property_model->del_property_img($img_id);
					$img_type = "prop_picture";
					$prop_img_no = $i;
				}
				$rs_update = $this->property_model->insert_property_picture($file_names, $property_id, $img_type, $prop_img_no);
			}
		}
	}

	private function set_upload_options($upload_path)
	{
		$config = array();
		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = '*';
		$config['max_size']      = '0';
		$config['overwrite']     = FALSE;
		$config['encrypt_name'] = TRUE;
		$config['set_file_ext']=TRUE;
		return $config;
	}

	public function setWatermarkImage($sourcePath, $destinationPath)
	{
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = $sourcePath;
		$config['new_image'] = $destinationPath;
		$config['wm_type'] = 'overlay';
		$config['wm_overlay_path'] = './assets/images/watermark_zap_logo.png';//the overlay image
		$config['wm_opacity']=100;
		$config['wm_vrt_alignment'] = 'bottom';
		$config['wm_hor_alignment'] = 'left';
		$this->image_lib->initialize($config);
		$pic_path = $destinationPath;
		$this->image_lib->watermark($pic_path);
	}

	public function upload_image_update_1($form_field_name, $property_id)
	{
		$new_file = "Property" . $property_id;
		$config['upload_path'] = '../assets/uploads/Property/' . $new_file;
		$config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPEG|JPG|PNG';
		$config['encrypt_name'] = TRUE;
		$config['set_file_ext'] = TRUE;

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($form_field_name)) {
			$errors = $this->upload->display_errors();
		} else {
			$img_id = $dfile_name = get_perticular_field_value('zc_property_img', 'img_id', " and property_id='" . $property_id . "' and img_type='preliminary'");
			$dfile_name = get_perticular_field_value('zc_property_img', 'file_name', " and property_id='" . $property_id . "' and img_type='preliminary'");
			$this->property_model->del_property_img($img_id);
			$dfile = '../assets/uploads/Property/Property' . $property_id . '/' . $dfile_name;
			if (is_file($dfile))
				@unlink($dfile);
			$new_file = $dfile;
			$upload_data = $this->upload->data();
			$file_names = $upload_data['file_name'];

			$img_type = "preliminary";
			$prop_img_no = "0";
			$rs_update = $this->property_model->insert_property_picture($file_names, $property_id, $img_type, $prop_img_no);

			//SET WATERMARK
			//$this->setWatermark($form_field_name,$new_file.$file_names);
			//CREATE OPTIMIZED IMAGE (W+H)
			$original_size = getimagesize($_FILES['user_file_1']['tmp_name']);
			$fileExtension = pathinfo($_FILES['user_file_1']['name'], PATHINFO_EXTENSION);
			$resizeUploadedImage = $this->resizeUploadedImage($original_size[0], $original_size[1], 'preliminary');
			//$this->createImageWithVariousHeightWidth($fileExtension, $dfile, $dfile, $file_names, $resizeUploadedImage['width'], $resizeUploadedImage['height']);

			unset($config);
			$config = array(
				'source_image' => '../assets/uploads/Property/Property' . $property_id . '/' . $upload_data['file_name'],
				'new_image' => '../assets/uploads/Property/Property' . $property_id . '/' . $upload_data['file_name'],
				'maintain_ratio' => true,
				'width' => $resizeUploadedImage['width'],
				'height' => $resizeUploadedImage['height'],
			);
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			// $this->setWatermarkImage('../assets/uploads/Property/Property'.$property_id.'/'.$dfile_name.'/'.$upload_data['file_name'],'../assets/uploads/Property/Property'.$property_id.'/'.$dfile_name.'/'.$upload_data['file_name']);

		}
	}

	public function resizeUploadedImage($width,$height,$for){
		if($for == 'preliminary'){
			$optimumWidth = 618;
			$optimumHeight = 618;
		}elseif($for == 'productimage800'){
			$optimumWidth = 800;
			$optimumHeight = 800;
		}elseif($for == 'productimage241'){
			$optimumWidth = 241;
			$optimumHeight = 161;
		}elseif($for == 'productimage170'){
			$optimumWidth = 170;
			$optimumHeight = 113;
		}elseif($for == 'productimage75'){
			$optimumWidth = 75;
			$optimumHeight = 50;
		}
		if($width > $height){
			if($width > $optimumWidth){
				$newWidth = $optimumWidth;
			}else{
				$newWidth = $width;
			}
			$ratio = $width / $height;
			$newHeight = (int)($newWidth/$ratio);
		}elseif($width < $height){
			if($height > $optimumHeight){
				$newHeight = $optimumHeight;
			}else{
				$newHeight = $height;
			}
			$ratio = $height / $width;
			$newWidth = (int)($newHeight/$ratio);
		}elseif($width == $height){
			if($height > $optimumHeight){
				$newHeight = $optimumHeight;
			}else{
				$newHeight = $height;
			}
			$newWidth = (int)$newHeight;
		}
		return array("width" => $newWidth, "height" => $newHeight);
	}

	public function manage_location()
	{
		$this->load->model('Common_model');
		$data = array();

		$data['locupdatetype'] = $this->uri->segment('3');
		$property_id = $this->uri->segment('4');
		$data['property_details'] = $this->property_model->get_property_details($property_id);

		$this->load->view('property/manage-location', $data);
	}

	public function update_location()
	{

		$property_id = $this->input->post('locupdatefor');

		if (userLoginCheck($this->session->userdata)) {
		}

		$lat = (float)$this->input->post('promaplatitude');
		$long = (float)$this->input->post('promaplongitude');

		$sql = "UPDATE zc_property_details SET latitude='" . $lat . "', longitude='" . $long . "' WHERE property_id=" . $property_id;
		$this->db->query($sql);

		redirect('property/edit_property_details/' . $property_id);

	}

	public function setWatermark($fieldName, $picPath)
	{
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = $_FILES[$fieldName]['tmp_name'];
		$config['new_image'] = $picPath;
		$config['wm_type'] = 'overlay';
		$config['wm_overlay_path'] = './assets/images/watermark_zap_logo.png';//the overlay image
		$config['wm_opacity'] = 100;
		$config['wm_vrt_alignment'] = 'middle';
		$config['wm_hor_alignment'] = 'center';
		$this->image_lib->initialize($config);
		$pic_path = $picPath;
		$this->image_lib->watermark($pic_path);
	}
	// public function upload_image_update_1($form_field_name,$property_id){
	// 	$new_file="Property".$property_id;
	// 	$config['upload_path'] = '../assets/uploads/Property/'.$new_file;
	// 	$config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPEG|JPG|PNG';
	// 	$config['encrypt_name']=TRUE;
	// 	$config['set_file_ext']=TRUE;
		
		
	// 	$this->load->library('upload', $config);
	// 	if ( ! $this->upload->do_upload($form_field_name)){
	// 		$errors = $this->upload->display_errors();
	// 	}else{			
	// 		$img_id=$dfile_name=get_perticular_field_value('zc_property_img','img_id'," and property_id='".$property_id."' and img_type='preliminary'");
	// 		$this->property_model->del_property_img($img_id);
	// 		$dfile_name=get_perticular_field_value('zc_property_img','file_name'," and property_id='".$property_id."' and img_type='preliminary'");
	// 		$dfile = '../assets/uploads/Property/Property'.$property_id.'/'.$dfile_name;
	// 		if(is_file($dfile))
	// 			@unlink($dfile);
	// 		$new_file=$dfile;
	// 		$upload_data = $this->upload->data(); 
	// 		$file_names =   $upload_data['file_name'];
			
	// 		$img_type="preliminary";
	// 		$prop_img_no="0";
	// 		$rs_update=$this->property_model->insert_property_picture($file_names,$property_id,$img_type,$prop_img_no);
			
	// 		//$this->setWatermark($form_field_name,$new_file.$file_names);
			
	// 		$original_size = getimagesize($_FILES['user_file_1']['tmp_name']);			
	// 		$fileExtension = pathinfo($_FILES['user_file_1']['name'], PATHINFO_EXTENSION);			
	// 		$resizeUploadedImage = $this->resizeUploadedImage($original_size[0],$original_size[1],'preliminary');
	// 		//$this->createImageWithVariousHeightWidth($fileExtension, $dfile, $dfile, $file_names, $resizeUploadedImage['width'], $resizeUploadedImage['height']);
	// 		$imgData = array(
	// 			'sourcePath' => '../assets/uploads/Property/Property'.$property_id.'/'.$dfile_name.'/'.$upload_data['file_name'],
	// 			'destinationPath' => '../assets/uploads/Property/Property'.$property_id.'/'.$dfile_name.'/'.$upload_data['file_name'],
	// 			'imageSize' => $resizeUploadedImage['width'].'x'.$resizeUploadedImage['height'],
	// 			'watermarkLogoPath' => '../assets/images/watermark_zap_logo.png'
	// 		);
	// 		CreateImageUsingImageMagicWithOutGravitybBigImage($imgData);
	// 		/*$this->setWatermarkImage('../assets/uploads/Property/Property'.$property_id.'/'.$dfile_name.'/'.$upload_data['file_name'],'../assets/uploads/Property/Property'.$property_id.'/'.$dfile_name.'/'.$upload_data['file_name']);*/
	// 	}
	// }

	public function createImageWithVariousHeightWidth($fileExtension, $pathSource, $pathDestination, $file, $customWidth, $customHeight)
	{
		$pathToImages = $pathSource;
		$pathToSmall = $pathDestination;
		$fname = $file;
		$info = pathinfo($pathToImages . $fname);

		if (strtolower($info['extension']) == 'jpg' || strtolower($info['extension']) == 'jpeg') {
			if (strtolower($fileExtension) == 'jpg' || strtolower($fileExtension) == 'jpeg') {
				$img1 = imagecreatefromjpeg("{$pathToImages}{$fname}");
			} elseif (strtolower($fileExtension) == 'png') {
				$img1 = imagecreatefrompng("{$pathToImages}{$fname}");
			} elseif (strtolower($fileExtension) == 'gif') {
				$img1 = imagecreatefromgif("{$pathToImages}{$fname}");
			} elseif (strtolower($fileExtension) == 'bmp') {
				$img1 = imagecreatefromgif("{$pathToImages}{$fname}");
			}
			$width1 = imagesx($img1);
			$height1 = imagesy($img1);
			$new_width1 = $customWidth;
			$new_height1 = $customHeight;
			$tmp_img1 = imagecreatetruecolor($new_width1, $new_height1);
			$backgroundColor = imagecolorallocate($tmp_img1, 255, 255, 255);
			imagefill($tmp_img1, 0, 0, $backgroundColor);
			imagecopyresized($tmp_img1, $img1, 0, 0, 0, 0, $new_width1, $new_height1, $width1, $height1);

			if (strtolower($fileExtension) == 'jpg' || strtolower($fileExtension) == 'jpeg') {
				imagejpeg($tmp_img1, "{$pathToSmall}{$fname}");
			} elseif (strtolower($fileExtension) == 'png') {
				imagepng($tmp_img1, "{$pathToSmall}{$fname}");
			} elseif (strtolower($fileExtension) == 'gif') {
				imagegif($tmp_img1, "{$pathToSmall}{$fname}");
			} elseif (strtolower($fileExtension) == 'bmp') {
				imagewbmp($tmp_img1, "{$pathToSmall}{$fname}");
			}
		}
		if (strtolower($info['extension']) == 'png') {
			$img2 = imagecreatefrompng("{$pathToImages}{$fname}");
			$width2 = imagesx($img2);
			$height2 = imagesy($img2);
			$new_width2 = $customWidth;
			$new_height2 = $customHeight;
			$tmp_img2 = imagecreatetruecolor($new_width2, $new_height2);
			$backgroundColor = imagecolorallocate($tmp_img2, 255, 255, 255);
			imagefill($tmp_img2, 0, 0, $backgroundColor);
			imagecopyresized($tmp_img2, $img2, 0, 0, 0, 0, $new_width2, $new_height2, $width2, $height2);
			imagepng($tmp_img2, "{$pathToSmall}{$fname}");
		}
		if (strtolower($info['extension']) == 'gif') {
			$img3 = imagecreatefromgif("{$pathToImages}{$fname}");
			$width3 = imagesx($img3);
			$height3 = imagesy($img3);
			$new_width3 = $customWidth;
			$new_height3 = $customHeight;
			$tmp_img3 = imagecreatetruecolor($new_width3, $new_height3);
			$backgroundColor = imagecolorallocate($tmp_img3, 255, 255, 255);
			imagefill($tmp_img3, 0, 0, $backgroundColor);
			imagecopyresized($tmp_img3, $img3, 0, 0, 0, 0, $new_width3, $new_height3, $width3, $height3);
			imagegif($tmp_img3, "{$pathToSmall}{$fname}");
		}
		if (strtolower($info['extension']) == 'bmp') {
			$img4 = imagecreatefromgif("{$pathToImages}{$fname}");
			$width4 = imagesx($img4);
			$height4 = imagesy($img4);
			$new_width4 = $customWidth;
			$new_height4 = $customHeight;
			$tmp_img4 = imagecreatetruecolor($new_width4, $new_height4);
			$backgroundColor = imagecolorallocate($tmp_img4, 255, 255, 255);
			imagefill($tmp_img4, 0, 0, $backgroundColor);
			imagecopyresized($tmp_img4, $img4, 0, 0, 0, 0, $new_width4, $new_height4, $width4, $height4);
			imagewbmp($tmp_img4, "{$pathToSmall}{$fname}");
		}
	}

	public function property_image(){
		$property_id=$this->uri->segment('3');
		$data['page_header_title']="Property Information";
		$data['property_img'] = $this->property_model->get_img_prop($property_id);

		$this->load->view('property_img_template', $data);
	}

	public function logout(){
		$session_data = array(
			'admin_user_id'  => '',
			'admin_login_status' => '',
			'admin_current_time' => '',
			'admin_logged_in' => false
		);
		$this->session->unset_userdata($session_data);
		redirect('login/');
	}

	public function make_featured(){
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
		$data['property_img'] = $this->property_model->get_img_prop($property_id);

		$this->load->view('property_featured', $data);
	}

	public function make_prop_feature(){
		$property_id=$this->uri->segment('3');
		$type=$this->uri->segment('4');
		$activetype=$this->uri->segment('5');
		$page=$this->uri->segment('6');

		$start_date=$this->input->post('start_date');
		$number_of_days=$this->input->post('number_of_days');
		$prop_feature_status=get_perticular_count('zc_property_featured'," and property_id='".$property_id."'");
		if($prop_feature_status==0){
			$new_data=array();
			$new_data['property_id']=$property_id;
			$new_data['start_date']=$start_date;
			$new_data['number_of_days']=$number_of_days;
			$rs=$this->property_model->featured_entry($new_data);
		}else{
			$new_data=array();
			$new_data['property_id']=$property_id;
			$new_data['start_date']=$start_date;
			$new_data['number_of_days']=$number_of_days;
			$rs=$this->property_model->update_featured_entry($new_data);
		}
		redirect('/property/'.$type.'/'.$activetype.($page==''?'':'/'.$page));
	}

	public function property_feature_resume(){
		$property_id=$this->uri->segment('3');
		$type=$this->uri->segment('4');
		$activetype=$this->uri->segment('5');
		$page=$this->uri->segment('6');

		$rs=$this->property_model->resume_featured_entry($property_id);
		$this->session->set_flashdata('success', 'The property resumed successfully');
		redirect('/property/'.$type.'/'.$activetype.($page==''?'':'/'.$page));
	}

	public function property_feature_suspend(){
		$property_id=$this->uri->segment('3');
		$type=$this->uri->segment('4');
		$activetype=$this->uri->segment('5');
		$page=$this->uri->segment('6');

		$rs=$this->property_model->suspend_featured_entry($property_id);
		$this->session->set_flashdata('success', 'The property suspended successfully');
		redirect('/property/'.$type.'/'.$activetype.($page==''?'':'/'.$page));
	}

	public function suspend_property() {
		$property_id=$this->uri->segment('3');
		$type=$this->uri->segment('4');
		$activetype=$this->uri->segment('5');
		$page=$this->uri->segment('6');

		$uid=$this->session->userdata('admin_user_id');
		$rs=$this->property_model->suspend_property($property_id,$uid);
		if($rs) {
			$msgdata = $this->lang->line('property_the_property_is_suspended_successfully');
			$this->session->set_flashdata('success', $msgdata);
		}
		redirect('/property/'.$type.'/'.$activetype.($page==''?'':'/'.$page));
	}

	public function resume_property() {
		$property_id=$this->uri->segment('3');
		$type=$this->uri->segment('4');
		$activetype=$this->uri->segment('5');
		$page=$this->uri->segment('6');

		$uid=$this->session->userdata('admin_user_id');
		$rs=$this->property_model->resume_property($property_id,$uid);
		if($rs) {
			$msgdata =  $this->lang->line('property_the_property_is_active_successfully');
			$this->session->set_flashdata('success',$msgdata);
		}
		redirect('/property/'.$type.'/'.$activetype.($page==''?'':'/'.$page));
	}

	public function getCategoryedit(){
		$contract_id = $this->input->post('contract');
		$cat_parent = $this->input->post('cat_parent');
		$contract_code=$this->property_model->get_contract_short_code_by_id($contract_id);
		$category_list=$this->property_model->get_category_list($cat_parent);
		$select_cat=$this->input->post('select_cat');
		if($select_cat=='PRO' || $select_cat=='BLI' || $select_cat=='BUS'){
			$sected_cat='BUS';
		}else{
			$sected_cat=$select_cat;
		}
		$category='';
		if(!empty($category_list[0])){
			$category .= '<option value="">Select a category</option>';
			foreach( $category_list as $key=>$val ){
				if($val['short_code']==$sected_cat){
					$selection="selected='selected'";
				}else{
					$selection="";
				}
				if($contract_code=="SAL"){
					if($val['short_code']=="ROM"){
						continue;
					}
					$category .= '<option value="'.$val['short_code'].'" '.$selection.'>'.$val['name'].'</option>';
				}else{
					$category .= '<option value="'.$val['short_code'].'" '.$selection.'>'.$val['name'].'</option>';
				}
			}
		}else{
			$category .= '<option value="">Select a category</option>';
		}
		echo $category;
	}

	public function getSubCategoryedit(){
		$category_code = $this->input->post('category');
		$contract_id=$this->property_model->get_contract_id_by_short_code($category_code);
		$sub_category_list=$this->property_model->get_category_list($contract_id);
		$sected_subcat=$this->input->post('select_subcat');
		$category='';
		if(!empty($sub_category_list[0])){
			$category .= '<option value="">Select a Subcategory</option>';
			foreach( $sub_category_list as $key=>$val ){
				if($val['short_code']==$sected_subcat){
					$selection="selected='selected'";
				}else{
					$selection="";
				}
				if($category_code=="SAL"){
					$category .= '<option value="'.$val['short_code'].'" '.$selection.'>'.$val['name'].'</option>';
				}else{
					$category .= '<option value="'.$val['short_code'].'" '.$selection.'>'.$val['name'].'</option>';
				}
			}
		}else{
			$category .= '<option value="">Select a Subcategory</option>';
		}
		echo $category;
	}

	public function getTypologyedit(){
		$category_codes = $this->input->post('category');
		$select_typology = $this->input->post('select_typology');
		$typology_list=$this->property_model->get_typology_list();

		if($category_codes=='RES' || $category_codes=='Residenziale' || $category_codes=='Residential'){
			$category_code="RES";
		}
		if($category_codes=='Rooms' || $category_codes=='Stanze' || $category_codes=='ROM'){
			$category_code="ROM";
		}
		if($category_codes=='Land' || $category_codes=='LAND' || $category_codes=='Terreni'){
			$category_code="LAND";
		}
		if($category_codes=='VAC' || $category_codes=='For vacations' || $category_codes=='Vacations' || $category_codes=='Vacanze'){
			$category_code="VAC";
		}
		if($category_codes=='PRO' || $category_codes=='Property' || $category_codes=='Property for business' || $category_codes=='Immobili commerciali'){
			$category_code="PRO";
		}
		if($category_codes=='BLI' || $category_codes=='Business license' || $category_codes=='Licenze commerciali'){
			$category_code="BLI";
		}

		$typology_array=array();
		$typology_array = get_Adjusted_TypologyID_asArray($category_code);

		$typology='';
		if(!empty($typology_list)){
			$typology .= '<option value="">Select the typology of property</option>';
			foreach($typology_list as $key=>$val):
				if(!in_array($key,$typology_array)){
					continue;
				}
				if($key==$select_typology){
					$selection="selected='selected'";
				}else{
					$selection="";
				}
				$typology .= '<option value="'.$key.'" '.$selection.'>'.$val.'</option>';
			endforeach;
		}else{
			$typology .= '<option value="">Select the typology of property</option>';
		}
		echo $typology;
	}

	public function city_search_via_id()
	{
		$provinceID=$this->input->post('name');
		$province=get_perticular_field_value('zc_provience',"provience_name"," AND provience_id='".$provinceID."'");
		$rs=$this->property_model->get_city_list($province);
		if ($rs) {
			foreach($rs as $key=>$val){
				$cityID=get_perticular_field_value('zc_city','city_id'," AND `city_name` = '".mysql_real_escape_string($val)."'");
				echo "<option value='".$cityID."'>".str_replace("\'","'",$val)."</option>";
			}
		}
	}

	public function del_img(){
		$ids=explode('_',$this->uri->segment('3'));
		$img_id=$ids[0];
		$property_id=$ids[1];
		$dfile_name=get_perticular_field_value('zc_property_img','file_name'," and img_id='".$img_id."'");
		//Delete The Main Image.
		$dfile='../assets/uploads/Property/Property'.$property_id.'/'.$dfile_name;
		if(is_file($dfile)){
			@unlink($dfile);
		}
		$dfile1='../assets/uploads/Property/Property'.$property_id.'/thumb_860_482/'.$dfile_name;
		if(is_file($dfile1)){
			@unlink($dfile1);
		}
		$dfile2='../assets/uploads/Property/Property'.$property_id.'/thumb_200_296/'.$dfile_name;
		if(is_file($dfile2)){
			@unlink($dfile2);
		}
		$dfile3='../assets/uploads/Property/Property'.$property_id.'/thumb_92_82/'.$dfile_name;
		if(is_file($dfile3)){
			@unlink($dfile3);
		}
		$rs=$this->property_model->del_property_img($img_id);
		$this->session->set_flashdata('success', "The property image is Deleted successfully");
		redirect('property/edit_property_details/'.$property_id);
	}
}
?>