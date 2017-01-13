<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of users
 *
 * @author user
 */
class property extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('cookie');
		$this->load->library('image_lib');
		if(isset($_COOKIE['lang']) && ($_COOKIE['lang'] == "english")){
			$this->lang->load('code', 'english');
		} else {
			$this->lang->load('code', 'it');
		}
		
		
		$this->load->model("site/sitem");
		$this->load->model("users/usersm");
		$this->load->model("property/propertym");
		$this->load->library("pagination");
		//authenticate();
		/* if($this->session->userdata('user_id')){
			$data['pref_info']=$this->usersm->get_pref_info();
			if( isset($data['pref_info'][0]['language'] ) && ( $data['pref_info'][0]['language'] == "english" )) {
				$this->lang->load('code', 'english');
				//$_COOKIE['lang']='english';
			} else {
				$this->lang->load('code', 'it');
				//$_COOKIE['lang']='it';
			}
		}else{
			if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
				$this->lang->load('code', 'english');
			} else {
				$this->lang->load('code', 'it');
			}
		} */
    }
	public function index(){		
		$data = array();
		$cat = get_categories();
		$data['categories'] = $cat;
		$cont = get_contracts();
		$data['contract_types'] = $cont;
		$this->load->view("site/index",$data);
	}
	public function search($catname=''){
		//echo "======".$msg_id=$this->uri->segment('1');
		$data = array();
		$filters = array();
		$category_id = '0';
		$contract_type = 'all';
		$posted_by = 'all';
		$location = '';
		$min_price = '0';
		$max_price = '0';
		$min_room = '0';
		$max_room = '0';
		$status = '';
		$pcat_id = '0';
		$segments = '';
		$segments_it = '';
		$parentCatname = '';
		$parentCatname_it = '';
		$for_typology = '';
		$for_luxury = '';
		$for_business = '';
		if($this->input->get('for_typology')){
			$for_typology = $this->input->get('for_typology');
		}
		if($this->input->get('category_id')){
			$category_id = $this->input->get('category_id');
		}
		if($this->input->get('contract_type')){
			$contract_type = $this->input->get('contract_type');
		}
		if($this->input->get('posted_by')){
			$posted_by = $this->input->get('posted_by');
		}
		if($this->input->get('location')){
			$location = $this->input->get('location');
		}
		if($this->input->get('min_price') /*&& $this->input->get('min_price') > 0*/){
			$min_price = $this->input->get('min_price');
		}
		if($this->input->get('max_price') /*&& $this->input->get('max_price') > 0*/){
			$max_price = $this->input->get('max_price');
		}
		if($this->input->get('min_room') /*&& $this->input->get('min_room') > 0*/){
			$min_room = $this->input->get('min_room');
		}
		if($this->input->get('max_room') /*&& $this->input->get('max_room') > 0*/){
			$max_room = $this->input->get('max_room');
		}
		if($this->input->get('status')){
			$status = $this->input->get('status');
		}
		if($this->input->get('for_business')){
			$for_business = $this->input->get('for_business');
		}
		if($this->input->get('for_luxury')){
			$for_luxury = $this->input->get('for_luxury');
		}
		$order_option = '';
		if($this->input->get('order_option')){
			$order_option = $this->input->get('order_option');
		}		
		if($catname != ''){
			$category = getCategoryDetails(" and short_code = '".$catname."'");
		}else if($for_business != ''){
			$category = getCategoryDetails(" and short_code = '".$for_business."'");
		}else if($for_luxury != ''){
			$category = getCategoryDetails(" and short_code = '".$for_luxury."'");
		}else{
			if($for_typology != ''){
				$category = getCategoryDetails(" and category_id = ".$for_typology);
			}else{
				$category = getCategoryDetails(" and category_id = ".$category_id);
			}
		}

		if(count($category) > 0){
			if($for_luxury != ''){
				$category_id = 10;
				$pcat_id = 10;
			}else{
				$category_id = $category[0]['category_id'];
				$pcat_id = $category[0]['parent_id'];
			}
			$category_code = $category[0]['short_code'];
			$segments = $category[0]['name'];
			$segments_it = $category[0]['name_it'];						
			if($pcat_id != 0){
				$pcat = getCategoryDetails(" and category_id = ".$pcat_id);
				$parentCatname = $pcat[0]['name'];
				$parentCatname_it = $pcat[0]['name_it'];
			}
		}
		$filters['category_id'] = $category[0]['category_id'];
		$filters['contract_type'] = $this->input->get('contract_type');
		$filters['posted_by'] = $this->input->get('posted_by');
		$filters['min_price'] = $this->input->get('min_price');
		$filters['max_price'] = $this->input->get('max_price');
		$filters['min_room'] = $this->input->get('min_room');
		$filters['max_room'] = $this->input->get('max_room');
		$filters['status'] = $this->input->get('status');
		$filters['location'] = $this->input->get('location');

		$filters['status'] = $this->input->get('status');		
		$filters['typology'] = $this->input->get('typology');
		$filters['bathrooms_no']=$this->input->get('bathrooms_no');
		$filters['min_surface_area']=$this->input->get('min_surface_area');
		$filters['max_surface_area']=$this->input->get('max_surface_area');
		$filters['min_beds_no']=$this->input->get('min_beds_no');
		$filters['max_beds_no']=$this->input->get('max_beds_no');
		$filters['kind']=$this->input->get('kind');
		$filters['energyclass']=$this->input->get('energyclass');
		$filters['heating']=$this->input->get('heating');
		$filters['parking']=$this->input->get('parking');
		$filters['furnished']=$this->input->get('furnished');
		$filters['roommates']=$this->input->get('roommates');
		$filters['occupation']=$this->input->get('occupation');
		$filters['smokers']=$this->input->get('smokers');
		$filters['pets']=$this->input->get('pets');
		$filters['elevator']=$this->input->get('elevator');
		$filters['air_conditioning']=$this->input->get('air_conditioning');
		$filters['garden']=$this->input->get('garden');
		$filters['terrace']=$this->input->get('terrace');
		$filters['balcony']=$this->input->get('balcony');
		$filters['order_option'] = $order_option;

		$filters['parent_id'] = $pcat_id;
		
		$filters['for_business'] = $for_business;
		$filters['for_luxury'] = $for_luxury;
		
		//Pagination
		$page = (int) (!isset($_GET['page']) ? 1 : $_GET['page']);
		$page = ($page == 0 ? 1 : $page);
		//limit in each page
		$perpage = 10;
		$startpoint = ($page * $perpage) - $perpage;
		
		$uid = $this->session->userdata('user_id');
		
		if($uid == 0 || $uid == '') {
			$data['property_details'] = $this->propertym->getProeprtiesByFilter($filters,$startpoint,$perpage);
		}else{
			if($this->input->get('save_search_id')){
				$filters['save_search_id']=$this->input->get('save_search_id');
			}			
			$this->session->set_userdata('new_search',$filters);
			$data['property_details'] = $this->propertym->getProeprtiesByFilter($filters,$startpoint,$perpage);
		}
		/*echo "<pre>";
		var_dump($data['property_details']);
		die();*/
		
		if(!strpos($_SERVER['QUERY_STRING'], "page=")===false){
			$QUERY_STRING = str_replace("&page=".$_GET['page'],"",$_SERVER['QUERY_STRING']);			
		}else{
			$QUERY_STRING = $_SERVER['QUERY_STRING'];
		}
		
		if($QUERY_STRING==''){
			$QUERY_STRING = 'category_id='.$category_id;
		}
		
		$path = base_url().'property/search?'.$QUERY_STRING.'&page=';
		$cureentPage = $_GET['page'];
		$data['pagination'] = $this->propertym->PropertyListingPages($filters, $perpage, $path, $cureentPage,'pagination');
		$data['propertyCount'] = $this->propertym->PropertyListingPages($filters, $perpage, $path, $cureentPage,'propertycounter');
		
		$data['category_id'] = $category_id;
		$data['contract_type'] = $contract_type;
		$data['posted_by'] = $posted_by;
		$data['min_price'] = $min_price;
		$data['max_price'] = $max_price;
		$data['min_room'] = $min_room;
		$data['max_room'] = $max_room;
		$data['status'] = $status;
		$data['location'] = $location;
		$data['parent_id'] = $pcat_id;
		
		if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
			$data['search_title'] = $segments;
			$data['parentCatname'] = $parentCatname;
		}else{
			$data['search_title'] = $segments_it;
			$data['parentCatname'] = $parentCatname_it;
		}	
		$this->load->view("property/search",$data);
	}
	public function property_full_details(){ 		
		$segs = $this->uri->segment_array();
		$segments=explode('-',$segs['2']);
		$segments['1']=get_perticular_field_value('zc_city','city_id'," AND ".($_COOKIE['lang']=='english'?"`city_name`":"`city_name_it`")." = '".$segments['1']."'");
		$segments['2']=get_perticular_field_value('zc_provience','provience_id'," AND ".($_COOKIE['lang']=='english'?"`provience_name`":"`provience_name_it`")." = '".$segments['2']."'");
		
		$property_id=end(explode('-',$segs['2']));
		$intProID = (int)$property_id;
		if(strlen($property_id)!=strlen($intProID)){
			redirect('errors/error_404.php');
		}
		$data=$this->propertym->get_property_detail($property_id);
		
		if(!isset($data[0]['property_post_by']) || $data[0]['property_post_by'] == ""){
			redirect('errors/error_404.php');
		}
		//User Is Blocked.
		$proHolderDetails = get_all_preference_by_user("zc_user",$where=" AND user_id=".$data[0]['property_post_by']);		
		if(isset($proHolderDetails[0]['status']) && ($proHolderDetails[0]['status'] == 0)){
			redirect('errors/error_404.php');
		}

		if(isset($proHolderDetails[0]['verified']) && isset($proHolderDetails[0]['verified']) == '0') {
			redirect('errors/error_404.php');	
		}
		
		//Advertiser Has Suspended The Property or admin have inactive property.
		if($data[0]['suspention_status']==1 || $data[0]['property_approval']==0){
			redirect('errors/error_404.php');
		}
		$data['contract']=$segments['0'];
		
		$segs1Arr = explode("-",$segs['1']);
		$data['child_breadcrumb_search_title'] = '';
		$data['for_luxury'] = '';
		
		$parentCategory = getCategoryDetails(" and (name = '".$segs1Arr[0]."' or name_it='".$segs1Arr[0]."')");
		$data['parent_breadcrumb_search_link'] = 'property/search?category_id='.$parentCategory[0]['category_id'];		
		if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
			$data['parent_breadcrumb_search_title'] = $parentCategory[0]['name'];
			$data['for_luxury'] = $parentCategory[0]['name'];
		}else{
			$data['parent_breadcrumb_search_title'] = $parentCategory[0]['name_it'];
			$data['for_luxury'] = $parentCategory[0]['name_it'];
		}
		
		if($segs1Arr[1]){
			$childCategory = getCategoryDetails(" and short_code = '".strtoupper($segs1Arr[1])."'");
			$data['child_breadcrumb_search_link'] = 'property/search?category_id='.$childCategory[0]['category_id'].'&'.($segs1Arr[0]=='Luxury'?'for_luxury':'for_business').'='.$childCategory[0]['short_code'];
			if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
				$data['child_breadcrumb_search_title'] = $childCategory[0]['name'];
				$data['for_luxury'] = $childCategory[0]['name'];
			}else{
				$data['child_breadcrumb_search_title'] = $childCategory[0]['name_it'];
				$data['for_luxury'] = $childCategory[0]['name_it'];
			}
		}
		
		
		$data['category']=$segs1Arr[0];
		$data['search_title']=$data['category'];
		$data['property_details']=$this->propertym->get_property_detail($property_id);		
		$data['property_image']=$this->propertym->get_all_prop_image($property_id);					
		$data['similar_properties']=$this->propertym->get_similar_property($property_id);
		$data['nearby_category']=$this->propertym->get_nearby_category_property();
		$data['user_profile']=$this->usersm->user_profile($data['property_details']['0']['property_post_by']);
		//print_r($data['user_profile']);exit;
		$data['show_save_search_flag'] = 1;
		$this->load->view('property/detail_property',$data);
		///////////for server///////////////////////////////////////////
		/* $segs = $this->uri->segment_array();
		// echo '<pre>';print_r($segs);die;
		$segments=explode('-',$segs['3']);
		$property_id=end(explode('-',$segs['3']));
		$data['contract']=$segments['0'];
		$data['category']=$segs['1'];
		$data['search_title']=$data['category'];
		$data['property_details']=$this->property_model->get_property_detail($property_id);
		$data['property_image']=$this->property_model->get_all_prop_image($property_id);
		$data['user_profile']=$this->user_model->user_profile($data['property_details']['0']['property_post_by']);
		$this->load->view('site/property/detail_property',$data);*/
		// echo '<pre>';print_r($data['property_image']);
	}
	public function getTypology(){
		$lang = $this->input->post('lang');
		$category_codes = $this->input->post('category');
		$deflt =  $this->input->post('deflt');
		$selected_typology = explode(",",trim( $this->input->post('selected_typology')));
		$category_code = '';

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
		$typology_list=$this->propertym->get_typology_list($lang);
		if(!empty($typology_list)){
			foreach($typology_list as $key=>$val):
				if(!in_array($key,$typology_array)){
					continue;
				}
				$checked="";
				if(in_array($key,$selected_typology)){
					if($deflt == ''){
						$checked="";
					}else{
						$checked="checked";
					}
				}
				$typology .='<tbody>
								<tr>
									<td>
										<span><input type="checkbox" name="typology[]" value='.$key.' '.$checked.' ></span> 
										<span>'.stripslashes($val).'</span>
									</td>
								</tr>
							</tbody>';
				
				endforeach;
		}else{
			$typology .= '<tbody style="display:none;">
							<tr><td></td></tr></tbody>';
		}
		echo $typology;
	}
	public function getTypologyAddProperty(){
		
		$category_codes = $this->input->post('category');
		$deflt =  $this->input->post('deflt');
		$selected_typology = explode( ",",trim( $this->input->post('selected_typology') ) );
		$category_code = '';

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
		//echo "=====".$_COOKIE['lang'];
		$typology_list=$this->propertym->get_typology_list($_COOKIE['lang']);
		if(!empty($typology_list)){
			foreach($typology_list as $key=>$val):
				if(!in_array($key,$typology_array)){
					continue;
				}
				$selected="";
				if(in_array($key,$selected_typology)){
					if($deflt == ''){
						$selected="";
					}else{
						$selected="selected";
					}
				}
				$typology .='<option value="'.$key.'" '.$selected.'>'.stripslashes($val).'</option>';
				
				endforeach;
		}else{
			$typology .= '';
		}
		echo $typology;
	}
	public function getAjaxLocations(){		
		$json_array = array();		
		if(!empty($_POST["keyword"]) && strlen($_POST["keyword"]) > 2) {
			$data = $this->propertym->getLocations($_POST["keyword"],$_POST["lang"]);
			if($data != 0){
				echo '<ul id="country-list">';
				foreach($data as $arrData) {
					if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
						$val = $arrData;
					}else{
						$val = $arrData;
					}
					echo '<li style="cursor:pointer" onClick="selectCountry(\''.$val.'\', \''.$_POST["fname"].'\', \''.$_POST["disname"].'\');">'.str_replace("\'","'",$val).'</li>';
				}
				echo '</ul>';
			}else{
				echo 0;
			}
		}		
		//echo json_encode($data);		
	}
	public function getAjaxAdvLocations(){
		
		$json_array = array();
		if(!empty($_POST["keyword"]) && strlen($_POST["keyword"]) > 2) {
			$data = $this->propertym->getAdvLocations($_POST["keyword"],$_POST["lang"]);
			if($data != 0){
				echo '<ul id="country-list">';
				foreach($data as $arrData) {
					if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
						$val = $arrData;
					}else{
						$val = $arrData;
					}		
					echo '<li style="cursor:pointer" onClick="selectCountry(\''.$val.'\', \''.$_POST["fname"].'\', \''.$_POST["disname"].'\');">'.str_replace("\'","'",$val).'</li>';
				}
				echo '</ul>';
			}else{
				echo 0;
			}
		}
		
		//echo json_encode($data);		
	}

	public function add_property_form()
	{
		$uid=$this->session->userdata('user_id');
		if($uid==0 || $uid==''){
			redirect('users/common_reg');
		}else{
			$user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$uid."'");
			if($user_type!='1'){
				if($this->input->post('btnSubmit')){
					//echo '<pre>';print_r($_POST);die;
					/*echo "<pre>";
					print_r($_POST);
					die;*/
					$property_post_by=$this->session->userdata( 'user_id' );
					$new_data=array();
					if($this->input->post('btnSubmit')=='Save Draft'){
						$new_data['property_status']='1';
						//$time=date('Y-m-d');
						//$new_data['update_time'] =date('Y-m-d');

					}else{
						/*if($user_type=='2'){
							$new_data['property_status']='0';
						}else{*/
						$new_data['property_status']='2';


						/*}*/
					}
					$new_data['property_post_by'] =$property_post_by;
					$new_data['property_post_by_type'] =$user_type;
					$time=date('Y-m-d');
					$new_data['posting_time'] =$time;
					$category=$this->input->post('category');

					$uid=$this->session->userdata( 'user_id' );
					$user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$uid."' ");
					//if($user_type=='2'){
					//$property_approval='0';
					//}
					//if($user_type=='3'){
					$property_approval='1';
					//}
					if($this->input->post('pvt_negotiation')=='1'){
						$price='';
						$private_nagotiation='1';
					}else{
						$pricee = $this->input->post('input_price');
						//echo '<br>';
						$pricees=floatval(str_replace(',', '.', str_replace('.', '', $pricee)));
						$price=$pricees;
						$private_nagotiation='0';
					}

					if($category=='LAND'){
						$new_data['contract_id']=$this->input->post('contract');
						$new_data['category_id']='4';
						$new_data['provience']=$this->input->post('province');
						$new_data['city']=$this->input->post('city');
						$new_data['zip']=$this->input->post('zip');
						$new_data['street_address']=$this->input->post('address');
						$new_data['street_no']=$this->input->post('street_no');
						$new_data['area']=$this->input->post('area');
						$new_data['price']=$price;
						$new_data['private_nagotiation']=$private_nagotiation;
						$new_data['youtube_url']=$this->input->post('url');
						$new_data['typology']=$this->input->post('typology');
						$new_data['kind']=$this->input->post('kind_of_property');
						$new_data['surface_area']=$this->input->post('surface_area');
						$new_data['availability']=$this->input->post('availabilty');
						$new_data['description']=$this->input->post('description');
						$new_data['property_approval']=$property_approval;
						$lat_lng_array=getLangLat( $this->input->post('street_address') . ','.$this->input->post( 'street_no' ) . ','. $this->input->post( 'city' ) . ',' . $this->input->post( 'provience' ) . ',' . $this->input->post( 'zip' ));
						$new_data['latitude'] = (float) $lat_lng_array->lat;
						$new_data['longitude'] = (float)$lat_lng_array->lng;

						$property_id=$this->propertym->add_new_property($new_data);
					}
					if($category=='VAC'){
						$new_data['contract_id']=$this->input->post('contract');
						$new_data['category_id']='5';
						$new_data['provience']=$this->input->post('province');
						$new_data['city']=$this->input->post('city');
						$new_data['zip']=$this->input->post('zip');
						$new_data['street_address']=$this->input->post('address');
						$new_data['street_no']=$this->input->post('street_no');
						$new_data['area']=$this->input->post('area');
						$new_data['price']=$price;
						$new_data['private_nagotiation']=$private_nagotiation;
						$new_data['youtube_url']=$this->input->post('url');
						$new_data['typology']=$this->input->post('typology');
						$new_data['status']=$this->input->post('status_of_property');
						$new_data['kind'] = $this->input->post('kind_of_property');
						if($this->input->post('energy_efficiency')){
							$new_data['energyclass'] = $this->input->post('energy_efficiency');
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
						$new_data['availability']=$this->input->post('availabilty');
						$new_data['pets']=$this->input->post('pets');
						$new_data['air_conditioning']=$this->input->post('air_conditioning');
						$new_data['elevator']=$this->input->post('elevator');
						$new_data['balcony']=$this->input->post('balcony');
						$new_data['terrace']=$this->input->post('terrace');
						$new_data['garden']=$this->input->post('terrace');
						$new_data['add_to_luxury']=$this->input->post('add_to_luxury');
						$new_data['description']=$this->input->post('description');
						$new_data['property_approval']=$property_approval;
						$lat_lng_array=getLangLat( $this->input->post('street_address') . ','.$this->input->post( 'street_no' ) . ','. $this->input->post( 'city' ) . ',' . $this->input->post( 'provience' ) . ',' . $this->input->post( 'zip' ));
						$new_data['latitude'] = (float) $lat_lng_array->lat;
						$new_data['longitude'] = (float)$lat_lng_array->lng;
						$property_id=$this->propertym->add_new_property($new_data);
					}
					if($category=='ROM'){
						$new_data['contract_id']=$this->input->post('contract');
						$new_data['category_id']='3';
						$new_data['provience']=$this->input->post('province');
						$new_data['city']=$this->input->post('city');
						$new_data['zip']=$this->input->post('zip');
						$new_data['street_address']=$this->input->post('address');
						$new_data['street_no']=$this->input->post('street_no');
						$new_data['area']=$this->input->post('area');
						$new_data['price']=$price;
						$new_data['private_nagotiation']=$private_nagotiation;
						$new_data['youtube_url']=$this->input->post('url');
						$new_data['typology'] = $this->input->post('typology');
						$new_data['floor'] = $this->input->post('floor');
						$new_data['bathrooms_no']=$this->input->post('bothroom_no');
						$new_data['kitchen']=$this->input->post('kitchen');
						$new_data['heating']=$this->input->post('heating');
						$new_data['parking']=$this->input->post('parking');
						$new_data['roommates']=$this->input->post('roommates');
						$new_data['occupation']=$this->input->post('occupation');
						$new_data['furnished']=$this->input->post('furnished');
						$new_data['availability']=$this->input->post('availabilty');
						$new_data['smokers']=$this->input->post('smokers');
						$new_data['pets']=$this->input->post('pets');
						$new_data['air_conditioning']=$this->input->post('air_conditioning');
						$new_data['elevator']=$this->input->post('elevator');
						$new_data['balcony']=$this->input->post('balcony');
						$new_data['terrace']=$this->input->post('terrace');
						$new_data['garden']=$this->input->post('terrace');
						$new_data['add_to_luxury']=$this->input->post('add_to_luxury');
						$new_data['description']=$this->input->post('description');
						$new_data['property_approval']=$property_approval;
						$lat_lng_array=getLangLat( $this->input->post('street_address') . ','.$this->input->post( 'street_no' ) . ','. $this->input->post( 'city' ) . ',' . $this->input->post( 'provience' ) . ',' . $this->input->post( 'zip' ));
						$new_data['latitude'] = (float) $lat_lng_array->lat;
						$new_data['longitude'] = (float)$lat_lng_array->lng;
						$property_id=$this->propertym->add_new_property($new_data);
					}
					if($category=='RES'){
						$new_data['contract_id']=$this->input->post('contract');
						$new_data['category_id']='1';
						$new_data['provience']=$this->input->post('province');
						$new_data['city']=$this->input->post('city');
						$new_data['zip']=$this->input->post('zip');
						$new_data['street_address']=$this->input->post('address');
						$new_data['street_no']=$this->input->post('street_no');
						$new_data['area']=$this->input->post('area');
						$new_data['price']=$price;
						$new_data['private_nagotiation']=$private_nagotiation;
						$new_data['youtube_url']=$this->input->post('url');
						$new_data['typology']=$this->input->post('typology');
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
						$new_data['availability']=$this->input->post('availabilty');
						$new_data['air_conditioning']=$this->input->post('air_conditioning');
						$new_data['elevator']=$this->input->post('elevator');
						$new_data['balcony']=$this->input->post('balcony');
						$new_data['terrace']=$this->input->post('terrace');
						$new_data['garden']=$this->input->post('terrace');
						$new_data['add_to_luxury']=$this->input->post('add_to_luxury');
						$new_data['description']=$this->input->post('description');
						$new_data['property_approval']=$property_approval;
						$lat_lng_array=getLangLat( $this->input->post('street_address') . ','.$this->input->post( 'street_no' ) . ','. $this->input->post( 'city' ) . ',' . $this->input->post( 'provience' ) . ',' . $this->input->post( 'zip' ));
						$new_data['latitude'] = (float) $lat_lng_array->lat;
						$new_data['longitude'] = (float)$lat_lng_array->lng;
						$property_id=$this->propertym->add_new_property($new_data);
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
						$new_data['contract_id']=$this->input->post('contract');
						$new_data['category_id']=$sub_cat_id;
						$new_data['provience']=$this->input->post('province');
						$new_data['city']=$this->input->post('city');
						$new_data['zip']=$this->input->post('zip');
						$new_data['street_address']=$this->input->post('address');
						$new_data['street_no']=$this->input->post('street_no');
						$new_data['area']=$this->input->post('area');
						$new_data['price']=$price;
						$new_data['private_nagotiation']=$private_nagotiation;
						$new_data['youtube_url']=$this->input->post('url');
						$new_data['typology']=$this->input->post('typology');
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
						$new_data['availability'] = $this->input->post('availabilty');
						$new_data['air_conditioning']=$this->input->post('air_conditioning');
						$new_data['elevator']=$this->input->post('elevator');
						$new_data['balcony']=$this->input->post('balcony');
						$new_data['terrace']=$this->input->post('terrace');
						$new_data['garden']=$this->input->post('terrace');
						$new_data['add_to_luxury']=$this->input->post('add_to_luxury');
						$new_data['description']=$this->input->post('description');
						$new_data['property_approval']=$property_approval;
						$lat_lng_array = getLangLat( $this->input->post('street_address') . ','.$this->input->post( 'street_no' ) . ','. $this->input->post( 'city' ) . ',' . $this->input->post( 'provience' ) . ',' . $this->input->post( 'zip' ));
						$new_data['latitude'] = (float) $lat_lng_array->lat;
						$new_data['longitude'] = (float)$lat_lng_array->lng;
						$property_id=$this->propertym->add_new_property($new_data);
					}

					$files = $_FILES;
					if($files['userfile']['name']!=''){
						$this->edit_do_uploads($property_id);
					}
					if($_FILES['user_file_1']['name']!=''){
						$this->upload_image_1('user_file_1',$property_id);
					}
					if($this->input->post('btnSubmit')=='Save Draft'){
						$msgdata = $this->lang->line('property_the_property_is_saved_successfully');
						$this->session->set_flashdata('msg', $msgdata);
					}else{
						$msgdata = $this->lang->line('property_the_property_is_posted_successfully');
						$this->session->set_flashdata('msg', $msgdata);
					}
					redirect('property/manage_location/add/'.$property_id);
					//redirect('property/thanks_add_property');
				}
				$this->config->load('site_config', TRUE);
				$site_config = $this->config->item('site_config');
				//$status = get_all_value("zc_status_of_property","and status='1'");
				//print_r($status);
				$data['status_of_property']=get_all_value("zc_status_of_property","and status='1'");
				$data['kind_of_property']=get_all_value("zc_kind_of_property","and status='1'");
				$data['energy_efficiency_class']=get_all_value("zc_energy_efficiency_class","and status='1'");
				$data['contract_type']=$this->propertym->get_contract_type();
				//$data['city_list']=$this->propertym->get_city_list();
				//$data['provinces']=$this->user_model->get_state_list();
				$data['provience_list']=$this->propertym->get_provience_list($_COOKIE['lang']);
				$this->load->view('property/add_property_form',$data);
			}else{
				$this->do_logout();
				$msgdata = $this->lang->line('property_please_login_to_add_your_property');
				$this->session->set_flashdata('error_user', $msgdata);
				redirect('users/common_reg');
			}
		}
	}

	public function edit_do_uploads($property_id)
	{
		//echo $slug;die;
		$new_file = "Property" . $property_id;
		$this->load->library('upload');
		$structure = './assets/uploads/Property/' . $new_file;
		if (!is_dir('assets/uploads/Property/' . $new_file)) {
			mkdir('./assets/uploads/Property/' . $new_file, 0777, true);
			chmod('./assets/uploads/Property/' . $new_file, 0777);
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
			$upload_path = 'assets/uploads/Property/' . $new_file;

			$this->upload->initialize($this->set_upload_options($upload_path));

			if ($_FILES['userfile']['name'] != '') {
				$this->upload->do_upload();
				$upload_data = $this->upload->data();
				$file_names = $upload_data['file_name'];

				$original_size = getimagesize($_FILES['userfile']['tmp_name']);
				$ratio = $original_size[0] / $original_size[1];

				/*
				 *	161x241
				*/

				if (!is_dir('assets/uploads/Property/' . $new_file . '/thumb_860_482')) {
					mkdir('./assets/uploads/Property/' . $new_file . '/thumb_860_482', 0777, true);
				}
				
				$config = array(
					'source_image' => "./assets/uploads/Property/" . $new_file . "/" . $file_names,
					'new_image' => "./assets/uploads/Property/" . $new_file . "/thumb_860_482/" . $file_names,
					'width' => 241,
					'height' => 161,
				);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();

				$this->setWatermarkImage("./assets/uploads/Property/" . $new_file . "/thumb_860_482/" . $file_names, "./assets/uploads/Property/" . $new_file . "/thumb_860_482/" . $file_names);
				
				/*
				 *	113x170
				*/

				if (!is_dir('assets/uploads/Property/' . $new_file . '/thumb_200_296')) {
					mkdir('./assets/uploads/Property/' . $new_file . '/thumb_200_296', 0777, true);
				}
				
				$config = array(
					'source_image' => "./assets/uploads/Property/" . $new_file . "/" . $file_names,
					'new_image' => "./assets/uploads/Property/" . $new_file . "/thumb_200_296/" . $file_names,
					'width' => 170,
					'height' => 113,
				);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->setWatermarkImage("./assets/uploads/Property/" . $new_file . "/thumb_200_296/" . $file_names, "./assets/uploads/Property/" . $new_file . "/thumb_200_296/" . $file_names);
				
				/*
				 *	50x75
				*/

				if (!is_dir('assets/uploads/Property/' . $new_file . '/thumb_92_82')) {
					mkdir('./assets/uploads/Property/' . $new_file . '/thumb_92_82', 0777, true);
				}
				
				$config = array(
					'source_image' => "./assets/uploads/Property/" . $new_file . "/" . $file_names,
					'new_image' => "./assets/uploads/Property/" . $new_file . "/thumb_92_82/" . $file_names,
					'width' => 92,
					'height' => 82,
				);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				/*
				 *	800x800
				*/

				$config = array(
					'source_image' => "./assets/uploads/Property/" . $new_file . "/" . $file_names,
					'new_image' => "./assets/uploads/Property/" . $new_file . "/" . $file_names,
					'width' => 800,
					'height' => 800,
				);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->setWatermarkImage("./assets/uploads/Property/" . $new_file . "/" . $file_names, "./assets/uploads/Property/" . $new_file . "/" . $file_names);

				if ($i == 0) {
					$img_type = "main_image";
					$prop_img_no = "0";
				} else {
					$img_type = "prop_picture";
					$prop_img_no = $i;
				}
				$rs_update = $this->propertym->insert_property_picture($file_names, $property_id, $img_type, $prop_img_no);
			}
		}
	}

	private function set_upload_options($upload_path)
	{
		$config = array();
		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = '*';
		$config['max_size'] = '0';
		$config['overwrite'] = FALSE;
		$config['encrypt_name'] = TRUE;
		$config['set_file_ext'] = TRUE;
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
		$config['wm_opacity'] = 100;
		$config['wm_vrt_alignment'] = 'bottom';
		$config['wm_hor_alignment'] = 'left';
		$this->image_lib->initialize($config);
		$pic_path = $destinationPath;
		$this->image_lib->watermark($pic_path);
	}

	public function upload_image_1($form_field_name,$property_id){
		$new_file="Property".$property_id;
		$structure = './assets/uploads/Property/' . $new_file;
		if (!is_dir('assets/uploads/Property/' . $new_file)) {
			mkdir('./assets/uploads/Property/' . $new_file, 0777, true);
			chmod('./assets/uploads/Property/' . $new_file, 0777);
		}

		$config['upload_path'] = './assets/uploads/Property/'.$new_file;
		$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPEG|JPG|PNG';
		$config['encrypt_name']=TRUE;
		$this->load->library('upload', $config);
		//echo '<pre>';print_r($config);die;
		if ( ! $this->upload->do_upload($form_field_name)){
			$errors = $this->upload->display_errors();
		} else {
			$upload_data = $this->upload->data();
			$file_names =   $upload_data['file_name'];
			$img_type="preliminary";
			$prop_img_no="0";
			$rs_update=$this->propertym->insert_property_picture($file_names,$property_id,$img_type,$prop_img_no);

			$new_file = 'assets/uploads/Property/Property' . $property_id . '/' . $dfile_name;
			$file_names = $upload_data['file_name'];
			/****************    SET WATERMARK    ***************/
			//$this->setWatermark($form_field_name,$new_file.$file_names);
			/*********************        CREATE OPTIMIZED IMAGE (W+H)    *************************/
			$original_size = getimagesize($_FILES['user_file_1']['tmp_name']);
			$fileExtension = pathinfo($_FILES['user_file_1']['name'], PATHINFO_EXTENSION);
			$resizeUploadedImage = $this->resizeUploadedImage($original_size[0],$original_size[1],'preliminary');
			
			$config = array(
				'source_image' => './assets/uploads/Property/Property'.$property_id.'/'.$dfile_name.'/'.$upload_data['file_name'],
				'new_image' => './assets/uploads/Property/Property'.$property_id.'/'.$dfile_name.'/'.$upload_data['file_name'],
				'maintain_ratio' => true,
				'width' => $resizeUploadedImage['width'],
				'height' => $resizeUploadedImage['height'],
			);
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			//CreateImageUsingImageMagicWithOutGravitybBigImage($imgData);
			
		}
	}

	public function resizeUploadedImage($width, $height, $for)
	{
		if ($for == 'preliminary') {
			$optimumWidth = 618;
			$optimumHeight = 618;
		} elseif ($for == 'productimage800') {
			$optimumWidth = 800;
			$optimumHeight = 800;
		} elseif ($for == 'productimage241') {
			$optimumWidth = 241;
			$optimumHeight = 161;
		} elseif ($for == 'productimage170') {
			$optimumWidth = 170;
			$optimumHeight = 113;
		} elseif ($for == 'productimage75') {
			$optimumWidth = 75;
			$optimumHeight = 50;
		}
		if ($width > $height) {
			if ($width > $optimumWidth) {
				$newWidth = $optimumWidth;
			} else {
				$newWidth = $width;
			}
			$ratio = $width / $height;
			$newHeight = (int)($newWidth / $ratio);
		} elseif ($width < $height) {
			if ($height > $optimumHeight) {
				$newHeight = $optimumHeight;
			} else {
				$newHeight = $height;
			}
			$ratio = $height / $width;
			$newWidth = (int)($newHeight / $ratio);
		} elseif ($width == $height) {
			if ($height > $optimumHeight) {
				$newHeight = $optimumHeight;
			} else {
				$newHeight = $height;
			}
			$newWidth = (int)$newHeight;
		}
		return array("width" => $newWidth, "height" => $newHeight);
	}

	private function do_logout()
	{
		$this->session->set_userdata('user_id', 0);
		$this->session->set_userdata('session_id', 0);
	}

	public function setWatermark($fieldName, $picPath)
	{
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = $_FILES[$fieldName]['tmp_name'];
		$config['new_image'] = $picPath;
		$config['wm_type'] = 'overlay';
		$config['wm_overlay_path'] = './assets/images/zap_logo.png';//the overlay image
		$config['wm_opacity']=100;
		$config['wm_vrt_alignment'] = 'bottom';
		$config['wm_hor_alignment'] = 'left';
		$this->image_lib->initialize($config);
		$pic_path=$picPath;
		$this->image_lib->watermark($pic_path);
	}

	public function createImageWithVariousHeightWidth($fileExtension, $pathSource, $pathDestination, $file, $customWidth, $customHeight){
		$pathToImages = './'.$pathSource;
		$pathToSmall  = './'.$pathDestination;
		$fname        = $file;
		$info         = pathinfo($pathToImages . $fname);

		if (strtolower($info['extension']) == 'jpg' || strtolower($info['extension']) == 'jpeg') {
			if(strtolower($fileExtension)=='jpg' || strtolower($fileExtension)=='jpeg'){
				$img1    = imagecreatefromjpeg("{$pathToImages}{$fname}");
			}elseif(strtolower($fileExtension)=='png'){
				$img1    = imagecreatefrompng("{$pathToImages}{$fname}");
			}elseif(strtolower($fileExtension)=='gif'){
				$img1    = imagecreatefromgif("{$pathToImages}{$fname}");
			}elseif(strtolower($fileExtension)=='bmp'){
				$img1    = imagecreatefromgif("{$pathToImages}{$fname}");
			}			
			$width1  = imagesx($img1);
			$height1 = imagesy($img1);		
			$new_width1=$customWidth;
			$new_height1=$customHeight;
			$tmp_img1 = imagecreatetruecolor($new_width1, $new_height1);
			$backgroundColor = imagecolorallocate($tmp_img1, 255, 255, 255);
			imagefill($tmp_img1, 0, 0, $backgroundColor);
			imagecopyresized($tmp_img1, $img1, 0, 0, 0, 0, $new_width1, $new_height1, $width1, $height1);
			
			if(strtolower($fileExtension)=='jpg' || strtolower($fileExtension)=='jpeg'){
				imagejpeg($tmp_img1, "{$pathToSmall}{$fname}");
			}elseif(strtolower($fileExtension)=='png'){
				imagepng($tmp_img1, "{$pathToSmall}{$fname}");
			}elseif(strtolower($fileExtension)=='gif'){
				imagegif($tmp_img1, "{$pathToSmall}{$fname}");
			}elseif(strtolower($fileExtension)=='bmp'){
				imagewbmp($tmp_img1, "{$pathToSmall}{$fname}");
			}
		}
		if (strtolower($info['extension']) == 'png') {
			$img2    = imagecreatefrompng("{$pathToImages}{$fname}");
			$width2  = imagesx($img2);
			$height2 = imagesy($img2);
			$new_width2=$customWidth;
			$new_height2=$customHeight;
			$tmp_img2 = imagecreatetruecolor($new_width2, $new_height2);
			$backgroundColor = imagecolorallocate($tmp_img2, 255, 255, 255);
			imagefill($tmp_img2, 0, 0, $backgroundColor);
			imagecopyresized($tmp_img2, $img2, 0, 0, 0, 0, $new_width2, $new_height2, $width2, $height2);
			imagepng($tmp_img2, "{$pathToSmall}{$fname}");
		}
		if (strtolower($info['extension']) == 'gif') {
			$img3    = imagecreatefromgif("{$pathToImages}{$fname}");
			$width3  = imagesx($img3);
			$height3 = imagesy($img3);
			$new_width3=$customWidth;
			$new_height3=$customHeight;
			$tmp_img3 = imagecreatetruecolor($new_width3, $new_height3);
			$backgroundColor = imagecolorallocate($tmp_img3, 255, 255, 255);
			imagefill($tmp_img3, 0, 0, $backgroundColor);
			imagecopyresized($tmp_img3, $img3, 0, 0, 0, 0, $new_width3, $new_height3, $width3, $height3);
			imagegif($tmp_img3, "{$pathToSmall}{$fname}");
		}
		if (strtolower($info['extension']) == 'bmp') {
			$img4    = imagecreatefromgif("{$pathToImages}{$fname}");
			$width4  = imagesx($img4);
			$height4 = imagesy($img4);
			$new_width4=$customWidth;
			$new_height4=$customHeight;
			$tmp_img4 = imagecreatetruecolor($new_width4, $new_height4);
			$backgroundColor = imagecolorallocate($tmp_img4, 255, 255, 255);
			imagefill($tmp_img4, 0, 0, $backgroundColor);
			imagecopyresized($tmp_img4, $img4, 0, 0, 0, 0, $new_width4, $new_height4, $width4, $height4);
			imagewbmp($tmp_img4, "{$pathToSmall}{$fname}");
		}
	}
	public function create_thumb($new_file,$file_names){
		$this->load->library('image_lib');
		$original_size = getimagesize($_FILES['userfile']['tmp_name']);
		$ratio = $original_size[0] / $original_size[1];
		//Thumb image cteate
		if (!is_dir('assets/uploads/Property/'.$new_file.'/thumb_200_296')) {
			mkdir('./assets/uploads/Property/'.$new_file.'/thumb_200_296', 0777, true);
		}
		$new_height = 170;	//370;
		$new_width = (int)($new_height/$ratio);
		//$new_height = 370;
		$file_name=$_FILES['userfile']['name'];
		$file_name=str_replace(" ","_",$file_name);
		$config['image_library'] = 'gd2';
		$config['source_image'] = $_FILES['userfile']['tmp_name'];
		$config['encrypt_name']=TRUE;
		$config['new_image'] = "assets/uploads/Property/".$new_file."/thumb_200_296/".$file_names;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = $new_width;
		$config['height'] = $new_height;
		$config['wm_type'] = 'overlay';
		$config['wm_overlay_path'] = './assets/images/zap_logo.png';//the overlay image
		$config['wm_opacity']=100;
		$config['wm_vrt_alignment'] = 'bottom';
		$config['wm_hor_alignment'] = 'left';
		$pic_path="assets/uploads/Property/".$new_file."/thumb_200_296/".$file_names;
		$this -> image_lib->initialize($config);
		$this->image_lib->watermark($pic_path);
		$this->image_lib->clear();
		$this -> image_lib->initialize($config);
		$this -> image_lib->resize();
		watermark($pic_path);
		/*if(!$this->image_lib->watermark())
		{
		   echo $this->image_lib->display_errors();
		} */
		//$this -> image_lib -> initialize($config);
		//$this -> image_lib -> resize();
		$original_size = getimagesize($_FILES['userfile']['tmp_name']);
		$ratio = $original_size[0] / $original_size[1];
		//Thumb image cteate
		if (!is_dir('assets/uploads/Property/'.$new_file.'/thumb_92_82')) {
			mkdir('./assets/uploads/Property/'.$new_file.'/thumb_92_82', 0777, true);
		}
		$new_width = 75;	//92
		$new_height = (int)($new_width/$ratio);
		$file_name=$_FILES['userfile']['name'];
		$file_name=str_replace(" ","_",$file_name);
		$config['image_library'] = 'gd2';
		$config['source_image'] = $_FILES['userfile']['tmp_name'];
		$config['encrypt_name']=TRUE;
		$config['new_image'] = "assets/uploads/Property/".$new_file."/thumb_92_82/".$file_names;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = $new_width;
		$config['height'] = $new_height;
		$this -> image_lib -> initialize($config);
		$this -> image_lib -> resize();
		///////////////////
		if (!is_dir('assets/uploads/Property/'.$new_file.'/thumb_860_482')) {
			mkdir('./assets/uploads/Property/'.$new_file.'/thumb_860_482', 0777, true);
		}
		$new_width = 241;
		$new_height = (int)($new_width/$ratio);
		$file_name=$_FILES['userfile']['name'];
		$file_name=str_replace(" ","_",$file_name);
		$config['image_library'] = 'gd2';
		$config['source_image'] = $_FILES['userfile']['tmp_name'];
		$config['encrypt_name']=TRUE;
		$config['new_image'] = "assets/uploads/Property/".$new_file."/thumb_860_482/".$file_names;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = $new_width;
		$config['height'] = $new_height;											
		$config['wm_type'] = 'overlay';
		$config['wm_overlay_path'] = 'assets/images/zap_logo.png';//the overlay image
		$config['wm_opacity']=100;
		$config['wm_vrt_alignment'] = 'bottom';
		$config['wm_hor_alignment'] = 'left';
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$pic_path="assets/uploads/Property/".$new_file."/thumb_860_482/".$file_names;
		watermark($pic_path);
		
		//$this->image_lib->watermark(); 
		$original_size = getimagesize($_FILES['userfile']['tmp_name']);
		$ratio = $original_size[0] / $original_size[1];
	}

	public function getCategory()
	{
		$contract_id = $this->input->post('contract');
		$cat_parent = $this->input->post('cat_parent');
		$contract_code = $this->propertym->get_contract_short_code_by_id($contract_id);
		$category_list = $this->propertym->get_category_list($cat_parent);
		$category = '';
		if (!empty($category_list[0])) {
			$category .= '<option value="">' . ($_COOKIE['lang'] == 'it' ? 'Seleziona la categoria' : 'Select a category') . '</option>';
			foreach ($category_list as $key => $val) {
				if ($val['short_code'] != "LUX") {
					if ($contract_code == "SAL") {
						if ($val['short_code'] == "ROM") {
							continue;
						}
						$category .= '<option value="' . $val['short_code'] . '">' . ($_COOKIE['lang'] == 'it' ? $val['name_it'] : $val['name']) . '</option>';
					} else {
						$category .= '<option value="' . $val['short_code'] . '">' . ($_COOKIE['lang'] == 'it' ? $val['name_it'] : $val['name']) . '</option>';
					}
				}
			}
		} else {
			$category .= '<option value="">' . ($_COOKIE['lang'] == 'it' ? 'Seleziona la categoria' : 'Select a category') . '</option>';
		}
		echo $category;
	}

	public function getSubCategory()
	{

		$category_code = $this->input->post('category');
		$select_subcat = $this->input->post('select_subcat');
		$contract_id = $this->propertym->get_contract_id_by_short_code($category_code);
		$sub_category_list = $this->propertym->get_category_list($contract_id);
		$category = '';
		if (!empty($sub_category_list[0])) {
			$category .= '<option value="">' . ($_COOKIE['lang'] == 'it' ? 'Seleziona la Sottocategoria' : 'Select a Sub category') . '</option>';
			foreach ($sub_category_list as $key => $val) {
				if ($category_code == "SAL") {
					$category .= '<option value="' . $val['short_code'] . '">' . ($_COOKIE['lang'] == 'it' ? $val['name_it'] : $val['name']) . '</option>';
				}else{
					$category .= '<option value="' . $val['short_code'] . '">' . ($_COOKIE['lang'] == 'it' ? $val['name_it'] : $val['name']) . '</option>';
				}
			}
		} else {
			$category .= '<option value="">' . $this->lang->line('property_select_a_subcategory') . '</option>';
		}
		echo $category;
	}

	public function city_search(){

		$province=$this->input->post('name');
		$rs=$this->propertym->get_city_list($province,$_COOKIE['lang']);
		//echo '<pre>';print_r($rs);die;
		if($rs){
			foreach($rs as $key=>$val){
				echo "<option value='".$val."'>".str_replace("\'","'",$val)."</option>";
			}
		}
	}

	public function city_search_via_id()
	{
		$provinceID=$this->input->post('name');
		$lang=$this->input->post('lang');
		$province=get_perticular_field_value('zc_provience',($lang=='it'?"provience_name_it":"provience_name")," AND provience_id='".$provinceID."'");
		$rs=$this->propertym->get_city_list($province,$lang);
		if ($rs) {
			foreach($rs as $key=>$val){
				$cityID=get_perticular_field_value('zc_city','city_id'," AND ".($lang=='it'?"`city_name_it`":"`city_name`")." = '".mysql_real_escape_string($val)."'");
				echo "<option value='".$cityID."'>".str_replace("\'","'",$val)."</option>";
			}
		}
	}

	public function property_details(){
		$data['title']="Property Detail";
		$property_post_by=$this->session->userdata('user_id');
		if($property_post_by=='' || $property_post_by=='0'){
			redirect('/');
		}
		$data["pagination"] = array();
		$config = array();
		$config["per_page"] = 10;
		$config["uri_segment"] = 4;
		/*
		**	Published Properties.
		*/
		$config["base_url"] = base_url() . "property/property_details/property_list";
		if( $this->uri->segment(3) == "property_list" ) {
			$page1 = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		} else{
			$page1 = 0;
		}
		//$config["total_rows"] = get_perticular_count('zc_property_details'," AND property_post_by=$property_post_by AND property_status='2'");
		$data['property_list'] = $this->propertym->get_save_property_list($property_post_by,$config["per_page"], $page1);
		$totalPublishedPropertyList = $this->propertym->get_save_property_list($property_post_by, '', '');
		$config["total_rows"] = count($totalPublishedPropertyList);
		$paginationA = clone($this->pagination);
		$paginationA->initialize($config);
		$data["totalPublishedPropertyList"] = count($totalPublishedPropertyList);
		$data["pagination_property_list"] = $paginationA->create_links();
		/*
		**	Draft Properties.
		*/
		$config["base_url"] = base_url() . "property/property_details/draft_property_list";
		if( $this->uri->segment(3) == "draft_property_list" ) {
			$page2 = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		} else{
			$page2 = 0;
		}
		//$config["total_rows"] = get_perticular_count('zc_property_details'," AND property_post_by=$property_post_by AND property_status='1'");
		$data['draft_property_list']=$this->propertym->get_draft_property_list($property_post_by,$config["per_page"], $page2);
		$totalDraftedPropertyList = $this->propertym->get_draft_property_list($property_post_by, '', '');
		$config["total_rows"] = count($totalDraftedPropertyList);
		$paginationB = clone($this->pagination);
		$paginationB->initialize($config);
		$data["totalDraftedPropertyList"] = count($totalDraftedPropertyList);
		$data["pagination_property_draft"] = $paginationB->create_links();
		/*
		**	Hight-Lighted Properties.
		*/
		$config["base_url"] = base_url() . "property/property_details/highlight_property_list";
		if( $this->uri->segment(3) == "highlight_property_list" ) {
			$page3 = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		} else{
			$page3 = 0;
		}
		$config["total_rows"] = get_perticular_count('zc_property_details,zc_property_featured'," AND zc_property_details.property_id=zc_property_featured.property_id AND zc_property_details.property_post_by=$property_post_by AND zc_property_details.property_status='2' and zc_property_featured.status = '1'");
		$data['featuredCount'] = $config["total_rows"];
		$data['getFeaturedProperty'] = $this->propertym->get_save_property_list_highlight($property_post_by,$config["per_page"], $page3);
		$totalHightlightedPropertyList = $this->propertym->get_save_property_list_highlight($property_post_by, '', '');
		$config["total_rows"] = count($totalHightlightedPropertyList);
		$data['featuredCount'] = $config["total_rows"];
		$paginationC = clone($this->pagination);
		$paginationC->initialize($config);
		$data["totalHightlightedPropertyList"] = count($totalHightlightedPropertyList);
		$data["pagination_property_highlight"] = $paginationC->create_links();
		/*
		**
		*/
		$this->load->view('property/property_details',$data);
	}

	public function get_message(){
		$uid=$this->session->userdata('user_id');
		if($uid=='' || $uid=='0'){
			redirect('/');
		}else{
			//$data['msg_totals']=$this->propertym->get_msg_detail($uid);
			////////////////////////////////////////////////////////////////////
			$config = array();
			$config["base_url"] = base_url()."property/get_message";
			//$config["total_rows"] = get_perticular_count('zc_property_message_info',"and msg_to_delete = '0' and user_id_to = '".$uid."' group by msg_grp_id");
			$config["total_rows"] = get_perticular_count('zc_property_message_info',"and msg_to_delete = '0' and user_id_to = '".$uid."' group by msg_grp_id order by msg_date desc");
			$config["per_page"] = 10;
			$config["uri_segment"] = 3;
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			//$data["msg_totals"] = $this->Countries->fetch_countries($config["per_page"], $page);
			$data["msg_totals"] = $this->propertym->get_msg_detail($uid,$config["per_page"], $page);
			$data['check_user_to']=$this->propertym->check_user_to_status($uid);
			// echo $data['check_user_to'][0]['status'];exit;
			$data["links"] = $this->pagination->create_links();
			///////////////////////////////////////////////////////////////
			// echo json_encode($data["msg_totals"]);exit;
			#echo "<br> <pre>"; print_r($data);exit;
			$this->load->view('property/inbox',$data);
		}
	}

	public function get_send_message(){
		$uid=$this->session->userdata('user_id');
		if($uid=='' || $uid=='0'){
			redirect('/');
		}else{
			//$data['msg_totals']=$this->propertym->get_msg_detail($uid);
			////////////////////////////////////////////////////////////////////
			$config = array();
			$config["base_url"] = base_url()."property/get_send_message";
			//$config["total_rows"] = get_perticular_count('zc_property_message_info',"and msg_to_delete = '0' and user_id_to = '".$uid."' group by msg_grp_id");
			$config["total_rows"] = get_perticular_count('zc_property_message_info',"and msg_from_delete = '0' and user_id_from = '".$uid."' group by msg_grp_id order by msg_date desc");
			$config["per_page"] = 10;
			$config["uri_segment"] = 3;
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			//$data["msg_totals"] = $this->Countries->fetch_countries($config["per_page"], $page);
			$data["send_msg_totals"] = $this->propertym->get_send_msg_detail($uid,$config["per_page"], $page);
			$data['check_user_to']=$this->propertym->check_user_to_status($data["send_msg_totals"][0]['user_id_to']);
			$data['check_user_from']=$this->propertym->check_user_to_status($data["send_msg_totals"][0]['user_id_from']);
			//print_r($data["send_msg_totals"]);exit;
			$data["links"] = $this->pagination->create_links();
			///////////////////////////////////////////////////////////////
			#echo "<br><pre>"; print_r($data);exit;
			$this->load->view('property/archive',$data);
		}
	}

	public function get_saved_search(){
		if( $this->session->userdata( 'user_id' ) == 0 || $this->session->userdata( 'user_id' ) == "" ) {
			redirect('/');
		}
		$uid=$this->session->userdata( 'user_id' );
		$config = array();
		$data["pagination"] = array();
		$config["base_url"] = base_url() . "property/get_saved_search";
		$config["total_rows"] = get_perticular_count('zc_save_search'," AND saved_by_user_id=$uid");
		$config["per_page"] = 10;
		$config["uri_segment"] = 3;
		$pagination = clone($this->pagination);
		$pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["pagination"] = $pagination->create_links();
		$data['saved_lsits']=$this->propertym->get_saved_list($config["per_page"], $page);
		//$data['saved_lsits']=$this->propertym->get_saved_list();
		$this->load->view('property/saved_search',$data);
	}

	public function get_saved_property()
	{
		if( $this->session->userdata( 'user_id' ) == 0 || $this->session->userdata( 'user_id' ) == "" ) {
			redirect('/');
		}
		$uid=$this->session->userdata( 'user_id' );
		$config = array();
		$data["pagination"] = array();
		$config["base_url"] = base_url() . "property/get_saved_property";
		$existingPropertIDs = get_perticular_field_value('zc_property_details',"GROUP_CONCAT(`property_id`)","");
		//$config["total_rows"] = get_perticular_count('zc_saved_property'," AND saved_by_user_id=$uid ".($existingPropertIDs==''?"":"AND `property_id` IN(".$existingPropertIDs.")"));
		$config['total_rows'] = $this->propertym->count_get_saved_property();
		$config["per_page"] = 10;
		$config["uri_segment"] = 3;
		$pagination = clone($this->pagination);
		$pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["pagination"] = $pagination->create_links();
		//echo '-----------------';
		$data['property_lists']=$this->propertym->get_saved_property($config["per_page"], $page);
		$this->load->view('property/saved_property',$data);
		//echo '<pre>';print_r($data['property_lists']);die;
	}

	public function view_property()
	{
		$msg_id=$this->uri->segment('3');
		$property_id=get_perticular_field_value('zc_property_message_info','property_id'," and msg_id='".$msg_id."'");
		$prop_det_url='';
		$conrtact_id=get_perticular_field_value('zc_property_details','contract_id'," and property_id='".$property_id."'");
		if($conrtact_id==1){
			$contract="Rent";
		}
		if($conrtact_id==2){
			$contract="Sell";
		}
		$prop_det_url.=$contract;
		$typology_id=get_perticular_field_value('zc_property_details','typology'," and property_id='".$property_id."'");
		$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$typology_id."'");
		//$prop_det_url.='-'.trim($typology_name);
		$city=get_perticular_field_value('zc_property_details','city'," and property_id='".$property_id."'");
		$provience=get_perticular_field_value('zc_property_details','provience'," and property_id='".$property_id."'");
		//$prop_det_url.='-'.trim($city);
		//$prop_det_url.='-'.trim($provience);
		if($_COOKIE['lang'] == "english")				
		{
			$prop_det_url.='-'.get_perticular_field_value('zc_city','city_name'," and city_id='".$city."'");
			$prop_det_url.='-'.get_perticular_field_value('zc_provience','provience_name'," and provience_id='".$provience."'");
		}
		else
		{
			$prop_det_url.='-'.get_perticular_field_value('zc_city','city_name_it'," and city_id='".$city."'");
			$prop_det_url.='-'.get_perticular_field_value('zc_provience','provience_name'," and provience_id='".$provience."'");
		}	
		$prop_det_url.='-'.trim($property_id);
		///////////////////////////////////////////////////
		$category_id=get_perticular_field_value('zc_property_details','category_id'," and property_id='".$property_id."'");
		if($category_id=='6' || $category_id=='7'){
			$search_title='Business';
			///////////////////////////////////////////////////
		}
		if($category_id=='1'){
			$search_title='Residential';
			///////////////////////////////////////////////////
		}
		if($category_id=='3'){
			$search_title='Rooms';
			///////////////////////////////////////////////////
		}
		if($category_id=='4'){
			$search_title='Land';
			///////////////////////////////////////////////////
		}
		if($category_id=='5'){
			$search_title='Vacations';
			///////////////////////////////////////////////////
		}
		//echo 'Vacations'.'/'.$prop_det_url;exit;
		redirect('Vacations'.'/'.$prop_det_url);
		//redirect($search_title.'/'.$prop_det_url);
	}

	public function feedback_details(){
		echo "GEr";
	}

	public function msg_details(){
		$uid = $this->session->userdata('user_id');
		if ($uid == '' || $uid == '0') {
			redirect('/');
		}
		$msg_id=$this->input->post('msg_id');
		$lang=$this->input->post('lang');
		$msg_grp_id=get_perticular_field_value('zc_property_message_info','msg_grp_id'," and msg_id='".$msg_id."'");
		$ch=$this->propertym->change_read_status($msg_grp_id);
		//$rs=$this->propertym->get_individual_msg($msg_id);
		$all_msgs=$this->propertym->get_property_msg($msg_grp_id);
		#echo "<pre> ===>"; print_r($all_msgs);exit;

		$config["per_page"] = 10;
		$page = 0;
		#$all_msgs=$this->propertym->get_property_msg($msg_grp_id);
		$WHERE = " AND (pm.user_id_to=". $uid ." OR pm.user_id_from=". $uid .") AND pm.msg_to_delete='0' AND property_id = " . $all_msgs[0]['property_id'];
		$data["msg_totals"] = $this->propertym->get_msg_detail1($uid, $config["per_page"], $page, $WHERE);
		$data['check_user_to'] = $this->propertym->check_user_to_status($uid);
		#echo "<pre> ===>"; print_r($all_msgs);
		//echo "<pre> ===>"; print_r($msg_totals);exit;
		$HTML = '';
		$Status = 1;
		//$msg_detail=get_perticular_field_value('zc_property_message_info','message'," and msg_id='".$msg_id."'");
		// $email_from=get_perticular_field_value('zc_property_message_info','email_id'," and msg_id='".$msg_id."'");
		//$phone_number=get_perticular_field_value('zc_property_message_info','ph_number'," and msg_id='".$msg_id."'");
		if(count($all_msgs) > 0){
			#echo "<pre>"; print_r($all_msgs);#exit;
			$area=get_perticular_field_value('zc_property_details','area'," and property_id='".$all_msgs[0]['property_id']."'");
			$street_address=get_perticular_field_value('zc_property_details','street_address'," and property_id='".$all_msgs[0]['property_id']."'");
			$street_no=get_perticular_field_value('zc_property_details','street_no'," and property_id='".$all_msgs[0]['property_id']."'");
			$zip=get_perticular_field_value('zc_property_details','zip'," and property_id='".$all_msgs[0]['property_id']."'");

			$areaStAddStNoZip = '';
			if($area!=''){
				$areaStAddStNoZip.= $area.' - ';
			}
			if($street_address!=''){
				$areaStAddStNoZip.= $street_address.', ';
			}
			if($street_no!=''){
				$areaStAddStNoZip.= $street_no.' - ';
			}
			if($zip!=''){
				$areaStAddStNoZip.= $zip;
			}
			if ($areaStAddStNoZip == '') {
				//$areaStAddStNoZip .= '-';
			}
			$HTML .= "<table>";
			$i=0;
			if ($all_msgs[0]['properMy_Feedbackty_id'] != '0') {
				//$subjectLine = ($lang=='it'?'Richiesta per':'Request for').": ".subject_inbox($all_msgs[0]['property_id']);	/*$this->lang->line('property_request_for').':'.*/ /* K */
				/*$subjectLine = (strlen(subject_inbox($all_msgs[0]['property_id'])) > 11)?(($lang=='it'?'Richiesta per':'Request for').": ".subject_inbox($all_msgs[0]['property_id'])):$this->lang->line('prop_not_avilable');*/
				$subjectLine = (ucfirst($all_msgs[0]['subject']) != '') ? (($lang == 'it' ? 'Richiesta per' : 'Request for') . ": " . ucfirst($all_msgs[0]['subject'])) : $this->lang->line('prop_not_avilable');
			}else{
				$subjectLine = (ucfirst($all_msgs[0]['subject']) != '') ? (($lang == 'it' ? 'Richiesta per' : 'Request for') . ": " . ucfirst($all_msgs[0]['subject'])) : $this->lang->line('prop_not_avilable');
				//$subjectLine = ucfirst($all_msgs[0]['subject']);	/*$this->lang->line('property_subject').':'.*/
			}
			#echo $subjectLine;exit;
			$j = 1;
			foreach($all_msgs as $msgs){
				if($i%2==0){
					$class='';
					//$sub_class="class='odd_row'";
				}else{
					$class="class='odd_row'";
					//$sub_class="";
				}
				if ($j == 1) {
					$inboxSubject = $subjectLine;
					$areaStAddStNoZipHTML = "<span style='color:#000;display:block;'>" . $areaStAddStNoZip . "</span><br><hr><br>";
					$j++;
				} else {
					$inboxSubject = '';
					$areaStAddStNoZipHTML = '';
				}
				$user_name = get_field_value("zc_user", "first_name, last_name", $where = " AND user_id='" . $msgs['user_id_from'] . "'");
				$from_full_name = $user_name['first_name'] . " " . $user_name['last_name'];

				switch (date('m', strtotime($msgs['msg_date']))) {
					case '01':
						$monthName = $this->lang->line('cal_jan');
						break;
					case '02':
						$monthName = $this->lang->line('cal_feb');
						break;
					case '03':
						$monthName = $this->lang->line('cal_mar');
						break;
					case '04':
						$monthName = $this->lang->line('cal_apr');
						break;
					case '05':
						$monthName = $this->lang->line('cal_may');
						break;
					case '06':
						$monthName = $this->lang->line('cal_jun');
						break;
					case '07':
						$monthName = $this->lang->line('cal_jul');
						break;
					case '08':
						$monthName = $this->lang->line('cal_aug');
						break;
					case '09':
						$monthName = $this->lang->line('cal_sep');
						break;
					case '10':
						$monthName = $this->lang->line('cal_oct');
						break;
					case '11':
						$monthName = $this->lang->line('cal_nov');
						break;
					case '12':
						$monthName = $this->lang->line('cal_dec');
						break;
				}
				$messageTime = date('d', strtotime($msgs['msg_date'])) . ' ' . $monthName . ' ' . date('Y', strtotime($msgs['msg_date']));

				$HTML .= "<tr " . $class . ">
						<td colspan='5'>
							<span style='display:block;font-weight:bold;'>" . $inboxSubject . "</span>
							" . $areaStAddStNoZipHTML . "
							<span style='color:#000'>" . stripslashes($msgs['message']) . "</span>
							<br>
							<div style='float:right;'>
								<span style='color:#1F76D9;'>" . ($lang == 'it' ? 'Da' : 'By') . " </span>
								" . ucfirst($from_full_name) . "
							</div>
							<br>
							<div style='float:right;'>
								<span style='color:#1F76D9;'>" . ($lang == 'it' ? 'In data' : 'On') . ": </span>
								" . $messageTime . "
							</div>
						</td>
					  </tr>";
				$i++;
			}
			$HTML .= "</table>";
			if ($all_msgs['0']['property_id'] != 0) {
				if ($uid == $all_msgs['0']['user_id_to'] && $all_msgs['0']['msg_from_delete'] == '1') {
					$Status = 0;
					$HTML .= '<div class="warrning"> <p> ' . $this->lang->line('conversation_deleted') . '</p></div>';
				} else if ($uid == $all_msgs['0']['user_id_from'] && $all_msgs['0']['msg_to_delete'] == '1') {
					$Status = 0;
					$HTML .= '<div class="warrning"> <p> ' . $this->lang->line('conversation_deleted') . '</p></div>';
				}

				if ($data["msg_totals"][0]['admin_approval'] == '') {
					$Status = 0;
					$HTML .= '<div class="warrning"> <p> ' . $this->lang->line('inbox_this_property_deleted') . '</p></div>';
				} else if ($data["msg_totals"][0]['admin_approval'] == 0) {
					$Status = 0;
					$HTML .= '<div class="warrning"> <p> ' . $this->lang->line('inbox_this_property_inactive_by_admin') . '</p></div>';
				} else if ($data["check_user_to"][0]['status'] == 0) {
					$Status = 0;
					$HTML .= '<div class="warrning"> <p> ' . $this->lang->line('inbox_this_user_is_no_longer_registered') . '</p></div>';
				} else if ($data["msg_totals"][0]['blocked_note'] != "" && strlen($data["msg_totals"][0]['blocked_note']) > 0) {
					$Status = 0;
					$HTML .= '<div class="warrning"> <p> ' . $this->lang->line('inbox_this_user_has_been_blocked') . '</p></div>';
				} else if (isset($data["msg_totals"][0]['suspention_status']) && $data["msg_totals"][0]['suspention_status'] == 1) {
					$Status = 0;
					$HTML .= '<div class="warrning"> <p> ' . $this->lang->line('suspended_property_msg_by_admin_first') . '</p></div>';
				}
			} else {
				if ($data["check_user_to"][0]['status'] == 0) {
					$Status = 0;
					$HTML .= '<div class="warrning"> <p> ' . $this->lang->line('inbox_this_user_is_no_longer_registered') . '</p></div>';
				} else if ($data["msg_totals"][0]['blocked_note'] != "" && strlen($data["msg_totals"][0]['blocked_note']) > 0) {
					$Status = 0;
					$HTML .= '<div class="warrning"> <p> ' . $this->lang->line('inbox_this_user_has_been_blocked') . '</p></div>';
				}
			}
		}
		$ResData = array("Output" => $HTML, "Status" => $Status);
		echo json_encode($ResData);
		exit;
	}

	public function msg_reply()
	{

		$redirectPageName = $this->input->post('redirect_to');
		//echo '<pre>';print_r($_POST);
		$property_id = get_perticular_field_value('zc_property_message_info', 'property_id', " and msg_id='" . $_POST['msg_id'] . "'");
		$owner_id = get_perticular_field_value('zc_property_details', 'property_post_by', " and property_id='" . $property_id . "'");
		$new_message = array();
		//$new_message['msg_grp_id']='12';
		$new_message['msg_date'] = date('Y-m-d H:i:s');
		$new_message['subject'] = get_perticular_field_value('zc_property_message_info', 'subject', " and msg_id='" . $_POST['msg_id'] . "'");
		//$new_message['subject']=$this->input->post('subject');
		$new_message['property_id'] = get_perticular_field_value('zc_property_message_info', 'property_id', " and msg_id='" . $_POST['msg_id'] . "'");
		$new_message['user_id_to'] = get_perticular_field_value('zc_property_message_info', 'user_id_from', " and msg_id='" . $_POST['msg_id'] . "'");
		$new_message['user_name_to'] = get_perticular_field_value('zc_property_message_info', 'user_name', " and msg_id='" . $_POST['msg_id'] . "'");
		$new_message['email_id_to'] = get_perticular_field_value('zc_property_message_info', 'email_id', " and msg_id='" . $_POST['msg_id'] . "'");
		$new_message['user_id_from'] = $_POST['user_id_form'];
		$new_message['user_name'] = get_perticular_field_value('zc_user', 'user_name', " and user_id='" . $_POST['user_id_form'] . "'");
		$new_message['ph_number'] = get_perticular_field_value('zc_user', 'contact_ph_no', " and user_id='" . $_POST['user_id_form'] . "'");
		$new_message['email_id'] = get_perticular_field_value('zc_user', 'email_id', " and user_id='" . $_POST['user_id_form'] . "'");
		$new_message['message'] = $this->input->post('message');
		$new_message['msg_grp_id'] = get_perticular_field_value('zc_property_message_info', 'msg_grp_id', " and msg_id='" . $_POST['msg_id'] . "'");
		//echo '<pre>';print_r($new_message);die;

		$blockedUserIdSQL = "";
		$blockedUserId = get_perticular_field_value("zc_user", "user_id", "AND `user_id`='" . $new_message['user_id_to'] . "' AND `status`='0'");
		if ($blockedUserId) {
			redirect('property/' . $redirectPageName);
		}

		$email_owner = get_perticular_field_value('zc_user', 'email_id', " and user_id='" . $_POST['user_id_form'] . "'");
		$rs = $this->propertym->add_message($new_message);
		if ($rs) {
			$user_id = $this->session->userdata('user_id');
			$user_preference_loc = get_all_value('zc_user_preference', " and user_id='" . $new_message['user_id_to'] . "'");
			$email_user = get_perticular_field_value('zc_user', 'email_id', " and user_id='" . $user_id . "'");
			if (isset($user_preference_loc[0]) && (count($user_preference_loc[0]) > 0)) {
				if ($user_preference_loc[0]['reply_msg'] == 1 && $user_preference_loc[0]['language'] == 'english') {
					$details = array();
					/*$mail_from = $email_user;*/

					$sql = "SELECT * FROM zc_user_preference WHERE user_id=" . $new_message['user_id_to'];
					$query = $this->db->query($sql);
					$lang = $query->result();
					$lang = $lang[0]->language;

					if (isset($lang) && ($lang == "english")) {
						$this->lang->load('code', 'english');
					} else {
						$this->lang->load('code', 'it');
					}

					$mail_from = isset($default_email) ? $default_email : "no-reply@zapcasa.it";
					$mail_to = $new_message['email_id_to'];
					$subject = $this->lang->line('reply_mail_subject');
					$link = "";
					$subject_rpl = get_perticular_field_value('zc_property_message_info', 'subject', " and msg_id='" . $_POST['msg_id'] . "'");
					$username_rpl = get_perticular_field_value('zc_user', 'user_name', " and user_id='" . $_POST['user_id_form'] . "'");
					$message = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">
												<div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
													<div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
													<div style="border-bottom:1px solid #d1d1d1;">
														<img src="' . base_url() . 'assets/images/logo.png" alt="logo"/>
													</div>
													<div style="padding:15px;">
														<strong>' . $this->lang->line('new_mail-hi') . ' ' . $new_message['user_name_to'] . '</strong>
														<p>' . $username_rpl . ' ' . $this->lang->line('new_inbox_mail_replied_to_your_message') . '</p>
														<p>' . $this->lang->line('to_read_and_reply') . '. <a style="text-decoration:none;color:blue;" href="' . base_url() . 'property/get_message">' . $this->lang->line('click_here_mail') . '</a></p>
														<p>' . $this->lang->line('regards_mail') . ',<br><a href="http://www.zapcasa.it">www.zapcasa.it</a></p>
													</div>
													<div style="padding:15px;border-top:1px solid #ddd;">
														<p>' . $this->lang->line('Messages_you_are_receiving_this_email_because') . '</p>
													</div>
												</div>
											</body>';
					$body = $message;
					sendemail($mail_from, $mail_to, $subject, $body, $cc = '');

					if (isset($_COOKIE['lang']) && ($_COOKIE['lang'] == "english")) {
						$this->lang->load('code', 'english');
					} else {
						$this->lang->load('code', 'it');
					}
				} else {
					$details = array();
					/*$mail_from = $email_user;*/

					$sql = "SELECT * FROM zc_user_preference WHERE user_id=" . $new_message['user_id_to'];
					$query = $this->db->query($sql);
					$lang = $query->result();
					$lang = $lang[0]->language;

					if (isset($lang) && ($lang == "english")) {
						$this->lang->load('code', 'english');
					} else {
						$this->lang->load('code', 'it');
					}

					$mail_from = isset($default_email) ? $default_email : "no-reply@zapcasa.it";
					$mail_to = $new_message['email_id_to'];
					$subject = 'Rispondi Messaggio di avviso - Zapcasa';
					$link = "";
					$subject_rpl = get_perticular_field_value('zc_property_message_info', 'subject', " and msg_id='" . $_POST['msg_id'] . "'");
					$username_rpl = get_perticular_field_value('zc_user', 'user_name', " and user_id='" . $_POST['user_id_form'] . "'");
					$message = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">
												<div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
													<div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
													<div style="border-bottom:1px solid #d1d1d1;">
														<img src="' . base_url() . 'assets/images/logo.png" alt="logo"/>
													</div>
													<div style="padding:15px;">
														<strong>Ciao, ' . $new_message['user_name_to'] . '</strong>
														<p>' . $username_rpl . ' risposto al tuo messaggio.</p>
														<p>Per leggere e rispondere a questo messaggio, vai al tuo arrivo in ZapCasa. <a style="text-decoration:none;color:blue;" href="' . base_url() . 'property/get_message">CLICCA QUI</a></p>
														<p>Saluti,<br><a href="http://www.zapcasa.it">www.zapcasa.it</a></p>
													</div>
													<div style="padding:15px;border-top:1px solid #ddd;">
														<p>Stai ricevuto questa email perché sei registrato su ZapCasa. Per interrompere la ricezione di queste email, accedere al proprio conto ZapCasa e disattivare le notifiche. www.zapcasa.it</p>
													</div>
												</div>
											</body>';
					$body = $message;
					//echo $message;die();
					sendemail($mail_from, $mail_to, $subject, $body, $cc = '');

					if (isset($_COOKIE['lang']) && ($_COOKIE['lang'] == "english")) {
						$this->lang->load('code', 'english');
					} else {
						$this->lang->load('code', 'it');
					}
				}

			}
			$msgdata = $this->lang->line('message_success_reply');
			$this->session->set_flashdata('msg', $msgdata);
			redirect('property/' . $redirectPageName);
			//echo 1;
		}
	}

	public function msg_search()
	{
		$uid = $this->session->userdata('user_id');
		if ($uid == '' || $uid == '0') {
			redirect('/');
		} else {
			$user_id_to = $this->session->userdata('user_id');
			$search_string = $this->input->post('search_fld');

			$config = array();
			$config["base_url"] = base_url() . "property/msg_search";
			//$config["total_rows"] = get_perticular_count('zc_property_message_info',"and msg_to_delete = '0' and user_id_to = '".$uid."' group by msg_grp_id");
			$config["total_rows"] = get_perticular_count('zc_property_message_info', "and msg_to_delete = '0' and (`message` LIKE '%{$search_string}%' or user_name='$search_string') and user_id_to = '" . $uid . "'");
			$config["per_page"] = 10;
			$config["uri_segment"] = 3;
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			//$data["msg_totals"] = $this->Countries->fetch_countries($config["per_page"], $page);
			$data['check_user_to'] = $this->propertym->check_user_to_status($uid);


			$data['msg_totals'] = $this->propertym->search_msg($search_string, $user_id_to, $config["per_page"], $page);
			$data["links"] = $this->pagination->create_links();
			$this->load->view('property/inbox', $data);
		}
	}

	public function thanks_add_property()
	{
		$uid = $this->session->userdata('user_id');
		if ($uid == 0 || $uid == '') {
			redirect('users/common_reg');
		} else {
			$user_type = get_perticular_field_value('zc_user', 'user_type', " and user_id='" . $uid . "'");
			if ($user_type != '1') {
				if (!$this->session->flashdata('msg')) {
					redirect('/');
				}
				$data['title'] = "Thanks";
				$this->load->view('property/thanks_property', $data);
			} else {
				redirect('/');
			}
		}
	}

	public function delete_property()
	{
		$property_id = $this->uri->segment('3');
		$data = $this->propertym->get_property_detail($property_id);
		/*echo "<pre>";
		print_r($data);
		die;*/
		if ($data[0]['property_status'] == '2') {
			$rs = $this->propertym->delete_property($property_id);
			$rs = 1;
			if ($rs) {
				$this->propertym->del_prop_image($property_id);
				$dfile = 'assets/uploads/Property/Property' . $property_id;
				if (is_dir($dfile))
					//@rmdir($dfile);
					deleteNonEmptyDir($dfile);
				//$data['property_details'] = $this->propertym->get_property_detail($property_id);


				$msgdata = $this->lang->line('property_the_property_is_deleted_successfully');
				$this->session->set_flashdata('success', $msgdata);
				redirect('property/property_details');
			}

		} elseif ($data[0]['property_status'] == '1') {
			$rs = $this->propertym->delete_property($property_id);
			$rs = 1;
			if ($rs) {
				$this->propertym->del_prop_image($property_id);
				$dfile = 'assets/uploads/Property/Property' . $property_id;
				if (is_dir($dfile))
					//@rmdir($dfile);
					deleteNonEmptyDir($dfile);
				//$data['property_details'] = $this->propertym->get_property_detail($property_id);


				$msgdata = $this->lang->line('property_the_property_is_deleted_successfully');
				$this->session->set_flashdata('success', $msgdata);
				redirect('property/property_details/draft_property_list');

			}
		}
		{
			$rs = $this->propertym->delete_property($property_id);
			$rs = 1;
			if ($rs) {
				$this->propertym->del_prop_image($property_id);
				$dfile = 'assets/uploads/Property/Property' . $property_id;
				if (is_dir($dfile))
					//@rmdir($dfile);
					deleteNonEmptyDir($dfile);
				//$data['property_details'] = $this->propertym->get_property_detail($property_id);


				$msgdata = $this->lang->line('property_the_property_is_deleted_successfully');
				$this->session->set_flashdata('success', $msgdata);
				redirect('property/property_details/highlight_property_list');

			}
		}

		}

	public function suspend_property()
	{
		$property_id = $this->uri->segment('3');
		$rs = $this->propertym->suspend_property($property_id);
		if ($rs) {
			$msgdata = $this->lang->line('property_the_property_is_suspended_successfully');
			$this->session->set_flashdata('success', $msgdata);
			redirect('property/property_details');
		}
	}

	public function resume_property()
	{
		$property_id=$this->uri->segment('3');
		$rs = $this->propertym->resume_property($property_id);
		if($rs){
			$msgdata = $this->lang->line('property_the_property_is_active_successfully');
			$this->session->set_flashdata('success', $msgdata);
			redirect('property/property_details');
		}
	}

	public function suspend_featured_property()
	{
		$property_id=$this->uri->segment('3');
		$rs = $this->propertym->suspend_featured_property($property_id);
		if($rs){
			$msgdata = $this->lang->line('property_the_property_is_suspended_successfully');
			$this->session->set_flashdata('success', $msgdata);
			redirect('property/property_details');
		}
	}

	public function resume_featured_property()
	{
		$property_id=$this->uri->segment('3');
		$rs = $this->propertym->resume_featured_property($property_id);
		if($rs){
			$msgdata =  $this->lang->line('property_the_property_is_active_successfully');
			$this->session->set_flashdata('success',$msgdata);
			redirect('property/property_details');
		}
	}

	public function del_bulk_property()
	{
		$dataField = $this->input->post('dataField');
		$dataField = explode("|", $dataField);
		foreach ($dataField as $property_id) {
			if ($property_id != '') {
				//$property_id = $property_id;
				$rs = $this->propertym->delete_property($property_id);
				$rs = 1;
				if ($rs) {
					$this->propertym->del_prop_image($property_id);
					$dfile = 'assets/uploads/Property/Property' . $property_id;
					if (is_dir($dfile))
						//@rmdir($dfile);
						deleteNonEmptyDir($dfile);
					$msgdata = $this->lang->line('property_the_property_is_deleted_successfully');
					$this->session->set_flashdata('success', $msgdata);

				}
			}
		}
		redirect('property/property_details');
	}

	public function edit_property()
	{
		$uid = $this->session->userdata('user_id');
		if ($uid == 0 || $uid == '') {
			redirect('users/common_reg');
		} else {
			$user_type = get_perticular_field_value('zc_user', 'user_type', " and user_id='" . $uid . "'");
			if ($user_type != '1') {
				$property_id = $this->uri->segment('3');
				$data['property_details'] = $this->propertym->get_property_detail($property_id);
				//This property is not mine.
				if ($uid != $data['property_details'][0]['property_post_by']) {
					redirect('/');
				}
				//This property is already featured.
				if ($data['property_details'][0]['feature_status'] == '1') {
					$getFeaturedProperty = $this->propertym->get_save_property_list_highlight($uid, '', '');
					if (count($getFeaturedProperty)) {
						$alreadyFeaturedPro = array();
						foreach ($getFeaturedProperty as $gFp) {
							$alreadyFeaturedPro[] = $gFp['property_id'];
						}
						if (in_array($property_id, $alreadyFeaturedPro)) {
							redirect('property/property_details');
						}
					}
				}
				//Property Is Suspended By Admin.
				$data['propertySuspensionStatus'] = $data['property_details'][0]['suspention_status'];

				$this->config->load('site_config', TRUE);
				$site_config = $this->config->item('site_config');
				$data['property_images'] = $this->propertym->property_image($property_id);

				$data['status_of_property'] = get_all_value("zc_status_of_property", "and status='1'");
				$data['kind_of_property'] = get_all_value("zc_kind_of_property", "and status='1'");
				$data['energy_efficiency_class'] = get_all_value("zc_energy_efficiency_class", "and status='1'");

				$data['contract_type'] = $this->propertym->get_contract_type();

				$province = get_perticular_field_value('zc_provience', ($_COOKIE['lang'] == 'english' ? "provience_name" : "provience_name_it"), " AND provience_id='" . $data['property_details'][0]['provience'] . "'");


				$data['city'] = $this->propertym->get_city_list($province, $_COOKIE['lang']);
				//$data['provinces']=$this->user_model->get_state_list();
				$data['provience_list'] = $this->propertym->get_provience_list($_COOKIE['lang']);
				$this->load->view('property/edit_property_form', $data);
			} else {
				redirect('/');
			}
		}
	}

	public function blocked_property()

	{
		$uid = $this->session->userdata('user_id');

		$data = array();
		$this->load->view('property/blockedproperty', $data);


	}


	public function manage_location()
	{
		$uid = $this->session->userdata('user_id');
		if ($uid == 0 || $uid == '') {
			redirect('users/common_reg');
		} else {
			$user_type = get_perticular_field_value('zc_user', 'user_type', " and user_id='" . $uid . "'");
			if ($user_type != '1') {
				$data['locupdatetype'] = $this->uri->segment('3');
				$property_id = $this->uri->segment('4');
				$data['property_details'] = $this->propertym->get_property_detail($property_id);
				//This property is not mine.
				if ($uid != $data['property_details'][0]['property_post_by']) {
					redirect('/');
				}
				//This property is already featured.
				if ($data['property_details'][0]['feature_status'] == '1') {
					$getFeaturedProperty = $this->propertym->get_save_property_list_highlight($uid, '', '');
					if (count($getFeaturedProperty)) {
						$alreadyFeaturedPro = array();
						foreach ($getFeaturedProperty as $gFp) {
							$alreadyFeaturedPro[] = $gFp['property_id'];
						}
						if (in_array($property_id, $alreadyFeaturedPro)) {
							redirect('property/property_details');
						}
					}
				}
				//Property Is Suspended By Admin.
				$data['propertySuspensionStatus'] = $data['property_details'][0]['suspention_status'];

				$this->config->load('site_config', TRUE);
				$site_config = $this->config->item('site_config');
				$data['property_images'] = $this->propertym->property_image($property_id);

				$data['status_of_property'] = get_all_value("zc_status_of_property", "and status='1'");
				$data['kind_of_property'] = get_all_value("zc_kind_of_property", "and status='1'");
				$data['energy_efficiency_class'] = get_all_value("zc_energy_efficiency_class", "and status='1'");

				$data['contract_type'] = $this->propertym->get_contract_type();

				$province = get_perticular_field_value('zc_provience', ($_COOKIE['lang'] == 'english' ? "provience_name" : "provience_name_it"), " AND provience_id='" . $data['property_details'][0]['provience'] . "'");


				$data['city'] = $this->propertym->get_city_list($province, $_COOKIE['lang']);
				//$data['provinces']=$this->user_model->get_state_list();
				$data['provience_list'] = $this->propertym->get_provience_list($_COOKIE['lang']);
				$this->load->view('property/manage-location', $data);
			} else {
				redirect('/');
			}
		}
	}

	public function update_location()
	{

		$property_id = $this->input->post('locupdatefor');
		$uid = $this->session->userdata('user_id');
		if($uid==0 || $uid==''){
			redirect('users/common_reg');
		}else{
			$user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$uid."'");
			if($user_type!='1'){
				$new_data['latitude'] = (float)$this->input->post('promaplatitude');
				$new_data['longitude'] = (float)$this->input->post('promaplongitude');
				$property_ids = $this->propertym->edit_property_land($new_data, $property_id);

				$msgdata = $this->lang->line('property_the_property_is_posted_successfully');

				if ($this->input->post('locupdatetype') == 'update') {
					$this->session->set_flashdata('saved_msg', $msgdata);
					redirect('property/edit_property/' . $property_id);
				} elseif ($this->input->post('locupdatetype') == 'add') {
					$this->session->set_flashdata('msg', $msgdata);
					redirect('property/thanks_add_property');
				}
			}else{
				$msgdata = $this->lang->line('property_please_login_to_add_your_property');
				$this->session->set_flashdata('error_user', $msgdata);
				redirect('users/common_reg');
			}
		}
	}

	public function skip_manage_loc()
	{
		$locupdatetype = $this->uri->segment('3');
		$property_id = $this->uri->segment('4');
		$uid = $this->session->userdata('user_id');
		if($uid==0 || $uid==''){
			redirect('users/common_reg');
		}else{
			$user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$uid."'");
			if ($user_type != '1') {
				$msgdata = $this->lang->line('property_the_property_is_posted_successfully');
				if ($locupdatetype == 'update') {
					$this->session->set_flashdata('saved_msg', $msgdata);
					redirect('property/edit_property/' . $property_id);
				} elseif ($locupdatetype == 'add') {
					$this->session->set_flashdata('msg', $msgdata);
					redirect('property/thanks_add_property');
				}
			}else{
				$msgdata = $this->lang->line('property_please_login_to_add_your_property');
				$this->session->set_flashdata('error_user', $msgdata);
				redirect('users/common_reg');
			}
		}
	}

	public function getCategoryedit()
	{
		$lang = $this->input->post('lang');
		$contract_id = $this->input->post('contract');
		$cat_parent = $this->input->post('cat_parent');
		$contract_code = $this->propertym->get_contract_short_code_by_id($contract_id);
		$category_list = $this->propertym->get_category_list($cat_parent);
		$select_cat = $this->input->post('select_cat');
		if ($select_cat == 'PRO' || $select_cat == 'BLI' || $select_cat == 'BUS') {
			$sected_cat = 'BUS';
		}else{
			$sected_cat = $select_cat;
		}
		$category = '';
		//echo "=============".$lang;
		if (!empty($category_list[0])) {
			$category .= '<option value="">' . $this->lang->line('property_select_a_category') . '</option>';
			foreach ($category_list as $key => $val) {
				if ($val['short_code'] == $sected_cat) {
					$selection = "selected='selected'";
				} else {
					$selection = "";
				}
				if ($contract_code == "SAL") {
					if ($val['short_code'] == "ROM") {
						continue;
					}
					$category .= '<option value="' . $val['short_code'] . '" ' . $selection . '>' . ($lang == 'it' ? $val['name_it'] : $val['name']) . '</option>';
				} else {
					$category .= '<option value="' . $val['short_code'] . '" ' . $selection . '>' . ($lang == 'it' ? $val['name_it'] : $val['name']) . '</option>';
				}
			}
		} else {
			$category .= '<option value="">' . $this->lang->line('property_select_a_category') . '</option>';
		}
		echo $category;
	}

	public function getSubCategoryedit()
	{
		$lang = $this->input->post('lang');
		$category_code = $this->input->post('category');
		$contract_id = $this->propertym->get_contract_id_by_short_code($category_code);
		$sub_category_list = $this->propertym->get_category_list($contract_id);
		$sected_subcat = $this->input->post('select_subcat');
		$category = '';
		if (!empty($sub_category_list[0])) {
			$category .= '<option value="">' . $this->lang->line('property_select_a_subcategory') . '</option>';
			foreach ($sub_category_list as $key => $val) {
				if ($val['short_code'] == $sected_subcat) {
					$selection = "selected='selected'";
				} else {
					$selection = "";
				}
				if ($category_code == "SAL") {
					$category .= '<option value="' . $val['short_code'] . '" ' . $selection . '>' . ($lang == 'it' ? $val['name_it'] : $val['name']) . '</option>';
				} else {
					$category .= '<option value="' . $val['short_code'] . '" ' . $selection . '>' . ($lang == 'it' ? $val['name_it'] : $val['name']) . '</option>';
				}
			}
		} else {
			$category .= '<option value="">' . $this->lang->line('property_select_a_subcategory') . '</option>';
		}
		echo $category;
	}

	public function getTypologyedit()
	{
		$lang = $this->input->post('lang');
		$category_codes = $this->input->post('category');
		$select_typology = $this->input->post('select_typology');
		$typology_list = $this->propertym->get_typology_list($lang);

		if ($category_codes == 'RES' || $category_codes == 'Residenziale' || $category_codes == 'Residential') {
			$category_code = "RES";
		}
		if ($category_codes == 'Rooms' || $category_codes == 'Stanze' || $category_codes == 'ROM') {
			$category_code = "ROM";
		}
		if ($category_codes == 'Land' || $category_codes == 'LAND' || $category_codes == 'Terreni') {
			$category_code = "LAND";
		}
		if ($category_codes == 'VAC' || $category_codes == 'For vacations' || $category_codes == 'Vacations' || $category_codes == 'Vacanze') {
			$category_code = "VAC";
		}
		if ($category_codes == 'PRO' || $category_codes == 'Property' || $category_codes == 'Property for business' || $category_codes == 'Immobili commerciali') {
			$category_code = "PRO";
		}
		if ($category_codes == 'BLI' || $category_codes == 'Business license' || $category_codes == 'Licenze commerciali') {
			$category_code = "BLI";
		}

		$typology_array = array();
		$typology_array = get_Adjusted_TypologyID_asArray($category_code);

		$typology = '';
		if (!empty($typology_list)) {
			if ($lang == 'it') {
				$typology .= '<option value="">Seleziona la tipologia di immobile</option>';
			} else {
				$typology .= '<option value="">Select the typology of property</option>';
			}
			foreach ($typology_list as $key => $val):
				if (!in_array($key, $typology_array)) {
					continue;
				}
				if ($key == $select_typology) {
					$selection="selected='selected'";
				}else{
					$selection="";
				}
				$typology .= '<option value="' . $key . '" ' . $selection . '>' . $val . '</option>';
			endforeach;
		}else{
			if ($lang == 'it') {
				$typology .= '<option value="">Seleziona la tipologia di immobile</option>';
			} else {
				$typology .= '<option value="">Select the typology of property</option>';
			}
		}
		echo $typology;
	}

	public function del_img()
	{
		$ids = explode('_', $this->uri->segment('3'));
		$img_id = $ids[0];
		$property_id = $ids[1];
		$dfile_name = get_perticular_field_value('zc_property_img', 'file_name', " and img_id='" . $img_id . "'");
		//Delete The Main Image.
		$dfile = 'assets/uploads/Property/Property' . $property_id . '/' . $dfile_name;
		if (is_file($dfile)) {
			@unlink($dfile);
		}
		$dfile1 = 'assets/uploads/Property/Property' . $property_id . '/thumb_860_482/' . $dfile_name;
		if (is_file($dfile1)) {
			@unlink($dfile1);
		}
		$dfile2 = 'assets/uploads/Property/Property' . $property_id . '/thumb_200_296/' . $dfile_name;
		if (is_file($dfile2)) {
			@unlink($dfile2);
		}
		$dfile3 = 'assets/uploads/Property/Property' . $property_id . '/thumb_92_82/' . $dfile_name;
		if (is_file($dfile3)) {
			@unlink($dfile3);
		}

		$rs = $this->propertym->del_property_img($img_id);
		redirect('property/edit_property/' . $property_id);
	}

	public function update_property()
	{
		$property_id = $this->input->post('property_id');
		$uid = $this->session->userdata('user_id');

		if ($uid == 0 || $uid == '') {
			redirect('users/common_reg');
		}else{
			$user_type = get_perticular_field_value('zc_user', 'user_type', " and user_id='" . $uid . "'");
			if ($user_type != '1') {
				if ($this->input->post('btnSubmit')) {
					/*echo "<pre>";
					print_r($_FILES);
					die;*/
					$property_post_by = $this->session->userdata('user_id');
					$new_data = array();

					if ($this->input->post('btnSubmit') == 'Save Draft') {
						$new_data['property_status'] = '1';
						//$time = date('d-m-Y');
						$new_data['posting_time'] = date('d-m-Y');

						if ($this->input->post('pvt_negotiation') == '1') {
							$price = '';
							$private_nagotiation = '1';
							$update_price = '0.00';
						} else {
							$pricee = $this->input->post('input_price');
							//echo '<br>';
							$pricees = floatval(str_replace(',', '.', str_replace('.', '', $pricee)));
							$price = $pricees;
							$private_nagotiation = '0';
							$update_price = '0.00';
						}
					}
					if ($this->input->post('btnSubmit') == 'Submit') {
						$new_data['property_status'] = '2';
						//$time = date('d-m-Y');
						$new_data['update_time'] = date('Y-m-d');
						if ($this->input->post('pvt_negotiation') == '1') {
							$price = '';
							$update_price = '0.00';
							$private_nagotiation = '1';
						} else {
							$pricee = $this->input->post('price');
							//echo '<br>';
							$pricees = floatval(str_replace(',', '.', str_replace('.', '', $pricee)));
							//echo $pricees;die;
							//$price=$pricees;
							$private_nagotiation = '0';
							$up_price = get_perticular_field_value('zc_property_details', 'update_price', " and property_id='" . $property_id . "'");
							if ($up_price == '0.00') {
								$price_org = get_perticular_field_value('zc_property_details', 'price', " and property_id='" . $property_id . "'");
								$price = $price_org;
								$update_price = $pricees;
							} else {
								$price_org = get_perticular_field_value('zc_property_details', 'update_price', " and property_id='" . $property_id . "'");
								$price = $pricees;
								$update_price = $price_org;
							}
						}
					}
					//$time=date('Y-m-d');
					//$new_data['update_time'] = $time;
					$uid = $this->session->userdata('user_id');
					$user_type = get_perticular_field_value('zc_user', 'user_type', " and user_id='" . $uid . "' ");

					$property_approval = '1';

					//$time=date('Y-m-d');
					//$new_data['update_time'] =$time;

					$contract_id = get_perticular_field_value('zc_property_details', 'contract_id', " and property_id='" . $property_id . "'");
					$category_id = get_perticular_field_value('zc_property_details', 'category_id', " and property_id='" . $property_id . "'");
					$category_name = get_perticular_field_value('zc_categories', 'short_code', " and category_id='" . $category_id . "'");
					if ($category_name == 'PRO' || $category_name == 'BLI' || $category_name == 'BUS') {
						$category = "BUS";
					} else {
						$category = $category_name;
					}

					$alreadyUpdatedLatitude = get_perticular_field_value('zc_property_details', 'latitude', " and property_id='" . $property_id . "'");
					$alreadyUpdatedLongitude = get_perticular_field_value('zc_property_details', 'longitude', " and property_id='" . $property_id . "'");

					if ($category == 'LAND') {
						$new_data['category_id'] = '4';
						$new_data['provience'] = $this->input->post('province');
						$new_data['city'] = $this->input->post('city');
						$new_data['zip'] = $this->input->post('zip');
						$new_data['street_address'] = $this->input->post('address');
						$new_data['street_no'] = $this->input->post('street_no');
						$new_data['area'] = $this->input->post('area');
						$new_data['price'] = $price;
						$new_data['update_price'] = $update_price;
						$new_data['private_nagotiation'] = $private_nagotiation;
						$new_data['youtube_url'] = $this->input->post('url');
						$new_data['typology'] = $this->input->post('typology');
						$new_data['kind'] = $this->input->post('kind_of_property');
						$new_data['surface_area'] = $this->input->post('surface_area');
						$new_data['availability'] = $this->input->post('availabilty');
						$new_data['description'] = $this->input->post('description');
						$new_data['property_approval'] = $property_approval;
						if ($alreadyUpdatedLatitude == '0' && $alreadyUpdatedLongitude == '0') {
							$lat_lng_array = getLangLat($this->input->post('street_address') . ',' . $this->input->post('street_no') . ',' . $this->input->post('city') . ',' . $this->input->post('provience') . ',' . $this->input->post('zip'));
							$new_data['latitude'] = (float)$lat_lng_array->lat;
							$new_data['longitude'] = (float)$lat_lng_array->lng;
						}
						$property_ids = $this->propertym->edit_property_land($new_data, $property_id);
					}
					if ($category == 'VAC') {
						$new_data['category_id'] = '5';
						$new_data['provience'] = $this->input->post('province');
						$new_data['city'] = $this->input->post('city');
						$new_data['zip'] = $this->input->post('zip');
						$new_data['street_address'] = $this->input->post('address');
						$new_data['street_no'] = $this->input->post('street_no');
						$new_data['area'] = $this->input->post('area');
						$new_data['price'] = $price;
						$new_data['update_price'] = $update_price;
						$new_data['private_nagotiation'] = $private_nagotiation;
						$new_data['youtube_url'] = $this->input->post('url');
						$new_data['typology'] = $this->input->post('typology');
						$new_data['status'] = $this->input->post('status_of_property');
						$new_data['kind'] = $this->input->post('kind_of_property');
						if ($this->input->post('energy_efficiency')) {
							$new_data['energyclass'] = $this->input->post('energy_efficiency');
						}
						$new_data['surface_area'] = $this->input->post('surface_area');
						$new_data['room_no'] = $this->input->post('room_no');
						$new_data['floor'] = $this->input->post('floor');
						$new_data['total_of_floors'] = $this->input->post('tot_floor');
						$new_data['year_of_building'] = $this->input->post('year_of_building');
						$new_data['beds_no'] = $this->input->post('bed_no');
						$new_data['bathrooms_no'] = $this->input->post('bothroom_no');
						$new_data['kitchen'] = $this->input->post('kitchen');
						$new_data['heating'] = $this->input->post('heating');
						$new_data['parking'] = $this->input->post('parking');
						$new_data['furnished'] = $this->input->post('furnished');
						$new_data['availability'] = $this->input->post('availabilty');
						$new_data['pets'] = $this->input->post('pets');
						$new_data['air_conditioning'] = $this->input->post('air_conditioning');
						$new_data['elevator'] = $this->input->post('elevator');
						$new_data['balcony'] = $this->input->post('balcony');
						$new_data['terrace'] = $this->input->post('terrace');
						$new_data['garden'] = $this->input->post('terrace');
						$new_data['add_to_luxury'] = $this->input->post('add_to_luxury');
						$new_data['description'] = $this->input->post('description');
						$new_data['property_approval'] = $property_approval;
						if ($alreadyUpdatedLatitude == '0' && $alreadyUpdatedLongitude == '0') {
							$lat_lng_array = getLangLat($this->input->post('street_address') . ',' . $this->input->post('street_no') . ',' . $this->input->post('city') . ',' . $this->input->post('provience') . ',' . $this->input->post('zip'));
							$new_data['latitude'] = (float)$lat_lng_array->lat;
							$new_data['longitude'] = (float)$lat_lng_array->lng;
						}
						$property_ids = $this->propertym->edit_property_vac($new_data, $property_id);
					}
					if ($category == 'ROM') {
						$new_data['category_id'] = '3';
						$new_data['provience'] = $this->input->post('province');
						$new_data['city'] = $this->input->post('city');
						$new_data['zip'] = $this->input->post('zip');
						$new_data['street_address'] = $this->input->post('address');
						$new_data['street_no'] = $this->input->post('street_no');
						$new_data['area'] = $this->input->post('area');
						$new_data['price'] = $price;
						$new_data['update_price'] = $update_price;
						$new_data['private_nagotiation'] = $private_nagotiation;
						$new_data['youtube_url'] = $this->input->post('url');
						$new_data['typology'] = $this->input->post('typology');
						$new_data['floor'] = $this->input->post('floor');
						$new_data['bathrooms_no'] = $this->input->post('bothroom_no');
						$new_data['kitchen'] = $this->input->post('kitchen');
						$new_data['heating'] = $this->input->post('heating');
						$new_data['parking'] = $this->input->post('parking');
						$new_data['roommates'] = $this->input->post('roommates');
						$new_data['occupation'] = $this->input->post('occupation');
						$new_data['furnished'] = $this->input->post('furnished');
						$new_data['availability'] = $this->input->post('availabilty');
						$new_data['smokers'] = $this->input->post('smokers');
						$new_data['pets'] = $this->input->post('pets');
						$new_data['air_conditioning'] = $this->input->post('air_conditioning');
						$new_data['elevator'] = $this->input->post('elevator');
						$new_data['balcony'] = $this->input->post('balcony');
						$new_data['terrace'] = $this->input->post('terrace');
						$new_data['garden'] = $this->input->post('terrace');
						$new_data['add_to_luxury'] = $this->input->post('add_to_luxury');
						$new_data['description'] = $this->input->post('description');
						$new_data['property_approval'] = $property_approval;
						if ($alreadyUpdatedLatitude == '0' && $alreadyUpdatedLongitude == '0') {
							$lat_lng_array = getLangLat($this->input->post('street_address') . ',' . $this->input->post('street_no') . ',' . $this->input->post('city') . ',' . $this->input->post('provience') . ',' . $this->input->post('zip'));
							$new_data['latitude'] = (float)$lat_lng_array->lat;
							$new_data['longitude'] = (float)$lat_lng_array->lng;
						}
						$property_ids = $this->propertym->edit_property_rom($new_data, $property_id);
					}
					if ($category == 'RES') {
						$new_data['category_id'] = '1';
						$new_data['provience'] = $this->input->post('province');
						$new_data['city'] = $this->input->post('city');
						$new_data['zip'] = $this->input->post('zip');
						$new_data['street_address'] = $this->input->post('address');
						$new_data['street_no'] = $this->input->post('street_no');
						$new_data['area'] = $this->input->post('area');
						$new_data['price'] = $price;
						$new_data['update_price'] = $update_price;
						$new_data['private_nagotiation'] = $private_nagotiation;
						$new_data['youtube_url'] = $this->input->post('url');
						$new_data['typology'] = $this->input->post('typology');
						$new_data['status'] = $this->input->post('status_of_property');
						$new_data['kind'] = $this->input->post('kind_of_property');
						$new_data['energyclass'] = $this->input->post('energy_efficiency');
						$new_data['surface_area'] = $this->input->post('surface_area');
						$new_data['room_no'] = $this->input->post('room_no');
						$new_data['floor'] = $this->input->post('floor');
						$new_data['total_of_floors'] = $this->input->post('tot_floor');
						$new_data['year_of_building'] = $this->input->post('year_of_building');
						$new_data['bathrooms_no'] = $this->input->post('bothroom_no');
						$new_data['kitchen'] = $this->input->post('kitchen');
						$new_data['heating'] = $this->input->post('heating');
						$new_data['parking'] = $this->input->post('parking');
						$new_data['furnished'] = $this->input->post('furnished');
						$new_data['availability'] = $this->input->post('availabilty');
						$new_data['air_conditioning'] = $this->input->post('air_conditioning');
						$new_data['elevator'] = $this->input->post('elevator');
						$new_data['balcony'] = $this->input->post('balcony');
						$new_data['terrace'] = $this->input->post('terrace');
						$new_data['garden'] = $this->input->post('terrace');
						$new_data['add_to_luxury'] = $this->input->post('add_to_luxury');
						$new_data['description'] = $this->input->post('description');
						$new_data['property_approval'] = $property_approval;
						if ($alreadyUpdatedLatitude == '0' && $alreadyUpdatedLongitude == '0') {
							$lat_lng_array = getLangLat($this->input->post('street_address') . ',' . $this->input->post('street_no') . ',' . $this->input->post('city') . ',' . $this->input->post('provience') . ',' . $this->input->post('zip'));
							$new_data['latitude'] = (float)$lat_lng_array->lat;
							$new_data['longitude'] = (float)$lat_lng_array->lng;
						}
						$property_ids = $this->propertym->edit_property_res($new_data, $property_id);
					}
					if ($category == 'BUS') {
						$sub_cat = $this->input->post('sub_category');
						{
							if ($sub_cat == 'PRO') {
								$sub_cat_id = '6';
							}
							if ($sub_cat == 'BLI') {
								$sub_cat_id = '7';
							}
						}
						$new_data['category_id'] = $sub_cat_id;
						$new_data['provience'] = $this->input->post('province');
						$new_data['city'] = $this->input->post('city');
						$new_data['zip'] = $this->input->post('zip');
						$new_data['street_address'] = $this->input->post('address');
						$new_data['street_no'] = $this->input->post('street_no');
						$new_data['area'] = $this->input->post('area');
						$new_data['price'] = $price;
						$new_data['update_price'] = $update_price;
						$new_data['private_nagotiation'] = $private_nagotiation;
						$new_data['youtube_url'] = $this->input->post('url');
						$new_data['typology'] = $this->input->post('typology');
						$new_data['status'] = $this->input->post('status_of_property');
						$new_data['kind'] = $this->input->post('kind_of_property');
						$new_data['energyclass'] = $this->input->post('energy_efficiency');
						$new_data['surface_area'] = $this->input->post('surface_area');
						$new_data['room_no'] = $this->input->post('room_no');
						$new_data['floor'] = $this->input->post('floor');
						$new_data['total_of_floors'] = $this->input->post('tot_floor');
						$new_data['year_of_building'] = $this->input->post('year_of_building');
						$new_data['bathrooms_no'] = $this->input->post('bothroom_no');
						$new_data['kitchen'] = $this->input->post('kitchen');
						$new_data['heating'] = $this->input->post('heating');
						$new_data['parking'] = $this->input->post('parking');
						$new_data['furnished'] = $this->input->post('furnished');
						$new_data['availability'] = $this->input->post('availabilty');
						$new_data['air_conditioning'] = $this->input->post('air_conditioning');
						$new_data['elevator'] = $this->input->post('elevator');
						$new_data['balcony'] = $this->input->post('balcony');
						$new_data['terrace'] = $this->input->post('terrace');
						$new_data['garden'] = $this->input->post('terrace');
						$new_data['add_to_luxury'] = $this->input->post('add_to_luxury');
						$new_data['description'] = $this->input->post('description');
						$new_data['property_approval'] = $property_approval;
						if ($alreadyUpdatedLatitude == '0' && $alreadyUpdatedLongitude == '0') {
							$lat_lng_array = getLangLat($this->input->post('street_address') . ',' . $this->input->post('street_no') . ',' . $this->input->post('city') . ',' . $this->input->post('provience') . ',' . $this->input->post('zip'));
							$new_data['latitude'] = (float)$lat_lng_array->lat;
							$new_data['longitude'] = (float)$lat_lng_array->lng;
						}
						$property_ids = $this->propertym->edit_property_bus($new_data, $property_id);
					}
					$this->edit_do_uploads_update($property_id);
					$this->upload_image_update_1('user_file_1', $property_id);
					if ($this->input->post('btnSubmit') == 'Save Draft') {
						$msgdata = $this->lang->line('property_the_property_is_saved_successfully');
						$this->session->set_flashdata('draft_msg', $msgdata);
					} else {
						$msgdata = $this->lang->line('property_the_property_is_posted_successfully');
						$this->session->set_flashdata('saved_msg', $msgdata);
						redirect('property/manage_location/update/' . $property_id);
					}
					redirect('property/edit_property/' . $property_id);
				}
				$this->config->load('site_config', TRUE);
				$site_config = $this->config->item('site_config');
				$data['status_of_property'] = $site_config['status_of_property'];
				$data['kind_of_property'] = $site_config['kind_of_property'];
				$data['energy_efficiency_class'] = $site_config['energy_efficiency_class'];
				$data['contract_type'] = $this->propertym->get_contract_type();
				//$data['city_list']=$this->property_model->get_city_list();
				//$data['provinces']=$this->user_model->get_state_list();
				$data['provience_list'] = $this->propertym->get_provience_list();
				$this->load->view('property/add_property_form', $data);
			}else{
				$msgdata = $this->lang->line('property_please_login_to_add_your_property');
				$this->session->set_flashdata('error_user', $msgdata);
				redirect('users/common_reg');
			}
		}
	}

	public function edit_do_uploads_update($property_id)
	{
		$new_file = "Property" . $property_id;
		$this->load->library('upload');
		$structure = './assets/uploads/Property/' . $new_file;
		if (!is_dir('assets/uploads/Property/' . $new_file)) {
			mkdir('./assets/uploads/Property/' . $new_file, 0777, true);
			chmod('./assets/uploads/Property/' . $new_file, 0777);
		}
		$files = $_FILES;
		$cpt = count($_FILES['userfile']['name']);
		for ($i = 0; $i < $cpt; $i++) {
			$_FILES['userfile']['name'] = $files['userfile']['name'][$i];
			$_FILES['userfile']['type'] = $files['userfile']['type'][$i];
			$_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
			$_FILES['userfile']['error'] = $files['userfile']['error'][$i];
			$_FILES['userfile']['size'] = $files['userfile']['size'][$i];
			$upload_path = 'assets/uploads/Property/' . $new_file;
			if (!is_dir('assets/uploads/Property/' . $new_file . "/thumb_860_482/")) {
				mkdir('./assets/uploads/Property/' . $new_file . "/thumb_860_482/", 0777, true);
				chmod('./assets/uploads/Property/' . $new_file . "/thumb_860_482/", 0777);
			}
			if (!is_dir('assets/uploads/Property/' . $new_file . "/thumb_200_296/")) {
				mkdir('./assets/uploads/Property/' . $new_file . "/thumb_200_296/", 0777, true);
				chmod('./assets/uploads/Property/' . $new_file . "/thumb_200_296/", 0777);
			}
			if (!is_dir('assets/uploads/Property/' . $new_file . "/thumb_92_82/")) {
				mkdir('./assets/uploads/Property/' . $new_file . "/thumb_92_82/", 0777, true);
				chmod('./assets/uploads/Property/' . $new_file . "/thumb_92_82/", 0777);
			}
			$this->upload->initialize($this->set_upload_options($upload_path));
			//echo '<pre>';print_r($upload_path);

			if ($_FILES['userfile']['name'] != '') {

				$this->upload->do_upload();
				$upload_data = $this->upload->data();
				$file_names = $upload_data['file_name'];

				$original_size = getimagesize($_FILES['userfile']['tmp_name']);
				$ratio = $original_size[0] / $original_size[1];

				/*
				 *	161x241
				*/
				$upload_data = $this->upload->data();
				$file_names = $upload_data['file_name'];
				//$rs_update = $this->usersm->update_profile_1($file_names, $uid);
				$config = array(
					'source_image' => "./assets/uploads/Property/" . $new_file . "/" . $file_names,
					'new_image' => "./assets/uploads/Property/" . $new_file . "/thumb_860_482/" . $file_names,
					'width' => 241,
					'height' => 161
				);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();

				$this->setWatermarkImage("./assets/uploads/Property/" . $new_file . "/thumb_860_482/" . $file_names, "./assets/uploads/Property/" . $new_file . "/thumb_860_482/" . $file_names);
				/*
				 *	113x170
				*/

				$config = array(
					'source_image' => "./assets/uploads/Property/" . $new_file . "/" . $file_names,
					'new_image' => "./assets/uploads/Property/" . $new_file . "/thumb_200_296/" . $file_names,
					'width' => 113,
					'height' => 170
				);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->setWatermarkImage("./assets/uploads/Property/" . $new_file . "/thumb_200_296/" . $file_names, "./assets/uploads/Property/" . $new_file . "/thumb_200_296/" . $file_names);
				/*
				 *	50x75
				*/

				$config = array(
					'source_image' => "./assets/uploads/Property/" . $new_file . "/" . $file_names,
					'new_image' => "./assets/uploads/Property/" . $new_file . "/thumb_92_82/" . $file_names,
					'width' => 92,
					'height' => 82
				);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				/*
				 *	800x800
				*/
				$config = array(
					'source_image' => "./assets/uploads/Property/" . $new_file . "/" . $file_names,
					'new_image' => "./assets/uploads/Property/" . $new_file . "/" . $file_names,
					'width' => 800,
					'height' => 800,
				);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->setWatermarkImage("./assets/uploads/Property/" . $new_file . "/" . $file_names, "./assets/uploads/Property/" . $new_file . "/" . $file_names);

				if ($i == 0) {
					$dfile_name = get_perticular_field_value('zc_property_img', 'file_name', " and property_id='" . $property_id . "' and img_type='main_image'");
					$dfile = 'assets/uploads/Property/Property' . $property_id . '/' . $dfile_name;
					if (is_file($dfile)) {
						@unlink($dfile);
					}
					$dfile1 = 'assets/uploads/Property/Property' . $property_id . '/thumb_860_482/' . $dfile_name;
					if (is_file($dfile1)) {
						@unlink($dfile1);
					}
					$dfile2 = 'assets/uploads/Property/Property' . $property_id . '/thumb_200_296/' . $dfile_name;
					if (is_file($dfile2)) {
						@unlink($dfile2);
					}
					$dfile3 = 'assets/uploads/Property/Property' . $property_id . '/thumb_92_82/' . $dfile_name;
					if (is_file($dfile3)) {
						@unlink($dfile3);
					}
					$img_id = get_perticular_field_value('zc_property_img', 'img_id', " and property_id='" . $property_id . "' and img_type='main_image'");
					$this->propertym->del_property_img($img_id);
					$img_type = "main_image";
					$prop_img_no = "0";
				} else {
					$dfile_name = get_perticular_field_value('zc_property_img', 'file_name', " and property_id='" . $property_id . "' and img_type='prop_picture' and prop_img_no='" . $i . "'");
					$dfile = 'assets/uploads/Property/Property' . $property_id . '/' . $dfile_name;
					if (is_file($dfile)) {
						@unlink($dfile);
					}
					$dfile1 = 'assets/uploads/Property/Property' . $property_id . '/thumb_860_482/' . $dfile_name;
					if (is_file($dfile1)) {
						@unlink($dfile1);
					}
					$dfile2 = 'assets/uploads/Property/Property' . $property_id . '/thumb_200_296/' . $dfile_name;
					if (is_file($dfile2)) {
						@unlink($dfile2);
					}
					$dfile3 = 'assets/uploads/Property/Property' . $property_id . '/thumb_92_82/' . $dfile_name;
					if (is_file($dfile3)) {
						@unlink($dfile3);
					}
					$img_id = get_perticular_field_value('zc_property_img', 'img_id', " and property_id='" . $property_id . "' and img_type='prop_picture' and prop_img_no='" . $i . "'");
					$this->propertym->del_property_img($img_id);
					$img_type = "prop_picture";
					$prop_img_no = $i;
				}
				$rs_update = $this->propertym->insert_property_picture($file_names, $property_id, $img_type, $prop_img_no);
			}
		}
	}

	public function upload_image_update_1($form_field_name, $property_id)
	{
		$new_file = "Property" . $property_id;
		$config['upload_path'] = './assets/uploads/Property/' . $new_file;
		$config['allowed_types'] = 'gif|jpg|png|jpeg|GIF|JPEG|JPG|PNG';
		$config['encrypt_name'] = TRUE;
		$config['set_file_ext'] = TRUE;


		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($form_field_name)) {
			$errors = $this->upload->display_errors();
		} else {
			$img_id = $dfile_name = get_perticular_field_value('zc_property_img', 'img_id', " and property_id='" . $property_id . "' and img_type='preliminary'");
			$dfile_name = get_perticular_field_value('zc_property_img', 'file_name', " and property_id='" . $property_id . "' and img_type='preliminary'");
			$this->propertym->del_property_img($img_id);
			$dfile = 'assets/uploads/Property/Property' . $property_id . '/' . $dfile_name;


			if (is_file($dfile))
				@unlink($dfile);
			$new_file = $dfile;
			$upload_data = $this->upload->data();
			$file_names = $upload_data['file_name'];

			$img_type = "preliminary";
			$prop_img_no = "0";
			$rs_update = $this->propertym->insert_property_picture($file_names, $property_id, $img_type, $prop_img_no);

			//$this->setWatermark($form_field_name,$new_file.$file_names);

			$original_size = getimagesize($_FILES['user_file_1']['tmp_name']);
			$fileExtension = pathinfo($_FILES['user_file_1']['name'], PATHINFO_EXTENSION);
			$resizeUploadedImage = $this->resizeUploadedImage($original_size[0], $original_size[1], 'preliminary');

			//$this->createImageWithVariousHeightWidth($fileExtension, $dfile, $dfile, $file_names, $resizeUploadedImage['width'], $resizeUploadedImage['height']);
			unset($config);
			$config = array(
				'source_image' => './assets/uploads/Property/Property'.$property_id.'/'.$upload_data['file_name'],
				'new_image' => './assets/uploads/Property/Property'.$property_id.'/'.$upload_data['file_name'],
				'maintain_ratio' => true,
				'width' => $resizeUploadedImage['width'],
				'height' => $resizeUploadedImage['height'],
			);
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			//CreateImageUsingImageMagicWithOutGravitybBigImage($imgData);
			/*$this->setWatermarkImage('./assets/uploads/Property/Property'.$property_id.'/'.$dfile_name.'/'.$upload_data['file_name'],'./assets/uploads/Property/Property'.$property_id.'/'.$dfile_name.'/'.$upload_data['file_name']);*/
		}
	}

	public function delete_saved_search(){
		$saved_id=$this->input->post('saved_id');
		$rs=$this->propertym->delete_saved_property($saved_id);
		$msg = $this->lang->line('saved_search_delete_message');
		$newdata = array("delete_saved_search_message" => $msg);	 
		$this->session->set_userdata($newdata);
		if($rs){
			echo  1;
		}
	}
	public function del_bulk_msg() {
		$dataField=$this->input->get('datas');
		$type=$this->input->get('type');
		$msg_ids = explode('|',$dataField);		
		$user_id=$this->session->userdata( 'user_id' );
	 	foreach($msg_ids as $mid){
			if($mid){
				$msgDetails = get_all_value('zc_property_message_info'," and msg_id='".$mid."'");
				if($type=='from'){	//For Inbox.
					$uid = $msgDetails[0]['user_id_to'];
					$mgrid = $msgDetails[0]['msg_grp_id'];
					$rs=$this->propertym->delete_per_msg($uid,$mgrid,'from');					
					$rs=$this->propertym->delete_per_msg($uid,$mgrid,'to');					
				}elseif($type=='to'){	//For Sent Items.
					$uid = $msgDetails[0]['user_id_from'];
					$mgrid = $msgDetails[0]['msg_grp_id'];
					$rs=$this->propertym->delete_per_msg($uid,$mgrid,'to');
					$rs=$this->propertym->delete_per_msg($uid,$mgrid,'from');					
				}
			}
		}
		$this->propertym->delete_per_msg_permenent();
		$msg = $this->lang->line('property_info_inbox_delete_message');
		$newdata = array("delete_inbox_message" => $msg);	 
		$this->session->set_userdata($newdata);
		if($rs){
			echo  1;
		}
	}
	public function add_message(){
		//echo '<pre>';print_r($_POST);
		$property_details=$this->propertym->get_property_detail($this->input->post('property_id'));
		// print_r($property_details);
		//$topology=get_perticular_field_value('zc_typologies','name,name_it'," and typology_id='".$property_details[0]['typology']."'");
		$property_name=property_name($property_details[0]['property_id']);

		$st_name1=$this->propertym->get_provience_name($property_details[0]['provience']);	
		if($data['pref_info'][0]['language']=='english'){
			$subject_dtls=$property_name/*.' '.$this->lang->line('property_title_in').' '.$property_details[0]['city'].', '.$st_name1[0]['provience_name']*/;
		}else{
			$subject_dtls=$property_name/*.' '.$this->lang->line('property_title_in').' '.$property_details[0]['city'].', '.$st_name1[0]['provience_name_it']*/;
		}
		$user_id_from=$this->session->userdata( 'user_id' );
		$owner_id=$this->input->post('owner_id');
		$return_url=$this->input->post('re_url');
		$new_message=array();
		$new_message['msg_date']=date('Y-m-d H:i:s');
		$new_message['subject']=$subject_dtls;
		//$new_message['subject']="Property Message".$subject_dtls;
		$new_message['property_id']=$this->input->post('property_id');
		$new_message['user_id_to']=$owner_id;
		$new_message['user_name_to']=get_perticular_field_value('zc_user','user_name'," and user_id='".$owner_id."'");
		$new_message['email_id_to']=get_perticular_field_value('zc_user','email_id'," and user_id='".$owner_id."'");
		$new_message['user_id_from']=$user_id_from;
		$user_name_from=get_perticular_field_value('zc_user','user_name'," and user_id='".$user_id_from."'");
		$new_message['user_name']=$this->input->post('name');
		$new_message['ph_number']=$this->input->post('phone_number');
		$new_message['email_id']=$this->input->post('email_id');
		$new_message['message']=$this->input->post('message');
		$msg_cnt=get_perticular_count('zc_property_message_info'," and property_id='".$this->input->post('property_id')."' and user_id_to='".$owner_id."' and email_id='".$this->input->post('email_id')."' and status='1'");
		$data['pref_info']=$this->usersm->get_pref_info();
	
		if($msg_cnt==0){
			$new_message['msg_grp_id']=access_token();
		}else{
			$new_message['msg_grp_id']=get_perticular_field_value('zc_property_message_info','msg_grp_id'," and property_id='".$this->input->post('property_id')."' and user_id_to='".$owner_id."' and email_id='".$this->input->post('email_id')."' and status='1' LIMIT 1");
		}
		// echo '<pre>';print_r($new_message);die;
		$email_owner=get_perticular_field_value('zc_user','email_id'," and user_id='".$owner_id."'");
		if($user_id_from!=$owner_id){
			$rs=$this->propertym->add_message($new_message);
			if($rs){			 
				$user_id=$this->session->userdata( 'user_id' );
				$user_preference_loc = get_all_value('zc_user_preference'," and user_id='".$owner_id."'");
				$email_user=get_perticular_field_value('zc_user','email_id'," and user_id='".$user_id."'");
				if( isset( $user_preference_loc[0] ) &&( count( $user_preference_loc[0] ) > 0 )) {					  
					if( $user_preference_loc[0]['send_me_email'] == 1 ) {				 
						$details=array();
						/*$mail_from = $email_user;*/
						// error_reporting(E_ALL);
						$sql = "SELECT * FROM zc_user_preference WHERE user_id=".$new_message['user_id_to'];
						$query = $this->db->query($sql);
						$lang = $query->result();
						$lang = $lang[0]->language;

						if(isset($lang) && ($lang == "english")){
							$this->lang->load('code', 'english');
						} else {
							$this->lang->load('code', 'it');
						}

						$mail_from= isset($default_email) ? $default_email : "no-reply@zapcasa.it";
						$mail_to = $new_message['email_id_to'];
						$subject = $this->lang->line('new_mail_subject_replay');
						$user_name = $this->input->post('name');
						$link = "";
						$message = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">
										<div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
											<div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
											<div style="border-bottom:1px solid #d1d1d1;">
												<img src="'.base_url().'assets/images/logo.png" alt="logo">
											</div>
											<div style="padding:15px;">
												<strong>'.$this->lang->line('new_mail-hi').' '.$new_message['user_name_to'].'</strong>
												<p>'.$this->lang->line('you_have_receive_new_mail').' '.$user_name_from.'</p>
												<p>'.$this->lang->line('to_read_and_reply').'. <a style="text-decoration:none;color:blue;" href="'.base_url().'property/get_message">'.$this->lang->line('click_here_mail').'</a></p>
												<p>'.$this->lang->line('regards_mail').',<br><a href="http://www.zapcasa.it">www.zapcasa.it</a></p>
											</div>
											<div style="padding:15px;border-top:1px solid #ddd;">
												<p>'.$this->lang->line('Messages_you_are_receiving_this_email_because').'</p>
											</div>
										</div>
									</body>';
						$body = $message;
						sendemail($mail_from, $mail_to, $subject, $body, $cc='');

						if(isset($_COOKIE['lang']) && ($_COOKIE['lang'] == "english")){
							$this->lang->load('code', 'english');
						} else {
							$this->lang->load('code', 'it');
						}
					}
				}
				$msgdata = $this->lang->line('property_your_message_is_posting_successfully');
				$this->session->set_flashdata('success', $msgdata);
				redirect($return_url);
			}	 
		}else{
			$msgdata = $this->lang->line('property_you_cant_message_yourself');
			$this->session->set_flashdata('error', $msgdata);
			redirect($return_url);
		}
	}
	public function save_property(){
		$property_id=$this->input->post('property_id');
		$user_id=$this->input->post('user_id');
		$saved_cnt=get_perticular_count('zc_saved_property',"and property_id='".$property_id."' and saved_by_user_id='".$user_id."'");
		if($saved_cnt==0){
			$new_data=array();
			$new_data['property_id']=$property_id;
			$new_data['saved_by_user_id']=$user_id;
			$new_data['saved_date']=date('Y-m-d H:i:s');
			$this->propertym->save_property($new_data);
			echo "<div class='success' id='success' style='text-align: center; padding: 5px 10px;'>".$this->lang->line('property_the_property_is_saved_successfully')."</div>";
		}else{
			echo "<div class='eror' id='eror' style='text-align: center;  padding: 5px 10px;'>".$this->lang->line('property_the_property_is_already_saved_by_you')."</div>";
		}
	}
	public function saved_search_prop(){
		$property_name=$this->input->post('property_name');
		$segment_name = $this->input->post('segment_name');
		$save_search_flag = $this->input->post('save_search_flag');

		$new_data=array();
		$new_saved_search=array();
		$contract_id='';
		$save_search_id = 0 ;
		$new_saved_search=$this->session->userdata('new_search');

		$contract_id = $new_saved_search['contract_type'];
		$property_post_by_type='';
		if(!empty($new_saved_search['property_post_by_type'])){
			foreach($new_saved_search['property_post_by_type'] as $key=>$val){
				$property_post_by_type.=','.$val;
			}
			$property_post_by_type=ltrim($property_post_by_type,',');
		}
		/////////////////status///////////////////////////////////////
		$status='';
		if(!empty($new_saved_search['status'])){
			foreach($new_saved_search['status'] as $key=>$val){
				$status.=','.$val;
			}
			$status=ltrim($status,',');
		}
		//////////////////typology///////////////////////////////
		$typology='';
		if(!empty($new_saved_search['typology'])){
			foreach($new_saved_search['typology'] as $key=>$val){
				$typology.=','.$val;
			}
			$typology=ltrim($typology,',');
		}
		//////////////////category///////////////////////////////
		$category='';
		if(!empty($new_saved_search['category_id'])){
			$category = $new_saved_search['category_id'];
		}else{
			$segment = strtolower($segment_name);
			if($segment==strtolower('Residential')){
				$category='1';
			}
			if($segment==strtolower('Business')){
				$category='2';
			}
			if($segment==strtolower('Rooms')){
				$category='3';
			}
			if($segment==strtolower('Land')){
				$category='4';
			}
			if($segment==strtolower('Vacations')){
				$category='5';
			}
			if($segment==strtolower('Luxury')){
				$category='0';
			}
		}

		$new_data['saved_property_name']	= $property_name;
		$new_data['saved_by_user_id']		= $this->session->userdata('user_id');
		$new_data['location']				= isset($new_saved_search['location'])?$new_saved_search['location']:'';
		$new_data['category']				= $category;
		$new_data['contract_id']			= $contract_id;
		$new_data['property_post_by_type']	= isset($property_post_by_type)?$property_post_by_type:"";
		$new_data['status']					= $status;
		$new_data['min_price']				= isset($new_saved_search['min_price'])?$new_saved_search['min_price']:0;
		$new_data['max_price']				= isset($new_saved_search['max_price'])?$new_saved_search['max_price']:0;
		$new_data['min_room']				= isset($new_saved_search['min_room'])?$new_saved_search['min_room']:0;
		$new_data['max_room']				= isset($new_saved_search['max_room'])?$new_saved_search['max_room']:0;
		$new_data['typology']				= $typology;
		$new_data['bathrooms_no']			= isset($new_saved_search['bathrooms_no'])?$new_saved_search['bathrooms_no']:0;
		$new_data['min_surface_area']		= isset($new_saved_search['min_surface_area'])?$new_saved_search['min_surface_area']:0;
		$new_data['max_surface_area']		= isset($new_saved_search['max_surface_area'])?$new_saved_search['max_surface_area']:0;
		$new_data['min_beds_no']			= isset($new_saved_search['min_beds_no'])?$new_saved_search['min_beds_no']:0;
		$new_data['max_beds_no']			= isset($new_saved_search['max_beds_no'])?$new_saved_search['max_beds_no']:0;
		$new_data['kind']					= isset( $new_saved_search['kind'])?$new_saved_search['kind']:0;
		$new_data['energyclass']			= isset($new_saved_search['energyclass'])?$new_saved_search['energyclass']:'';
		$new_data['heating']				= isset($new_saved_search['heating'])?$new_saved_search['heating']:'';
		$new_data['parking']				= isset($new_saved_search['parking'])?$new_saved_search['parking']:'';
		$new_data['furnished']				= isset($new_saved_search['furnished'])?$new_saved_search['furnished']:'';
		$new_data['roommates']				= isset($new_saved_search['roommates'])?$new_saved_search['roommates']:'';
		$new_data['occupation']				= isset($new_saved_search['occupation'])?$new_saved_search['occupation']:'';
		$new_data['smokers']				= isset($new_saved_search['smokers'])?$new_saved_search['smokers']:0;
		$new_data['pets']					= isset($new_saved_search['pets'])?$new_saved_search['pets']:'';
		$new_data['elevator']				= isset($new_saved_search['elevator'])?$new_saved_search['elevator']:'';
		$new_data['air_conditioning']		= isset($new_saved_search['air_conditioning'])?$new_saved_search['air_conditioning']:'';
		$new_data['garden']					= isset($new_saved_search['garden'])?$new_saved_search['garden']:'';
		$new_data['terrace']				= isset($new_saved_search['terrace'])?$new_saved_search['terrace']:'';
		$new_data['balcony']				= isset($new_saved_search['balcony'])?$new_saved_search['balcony']:'';
		$new_data['add_neighbour_zip']		= isset($new_saved_search['add_neighbour_zip'])?$new_saved_search['add_neighbour_zip']:'';
		$new_data['saved_date']				= date('Y-m-d H:i:s');
		$new_data['property_category']		= isset($new_saved_search['property_category'])?$new_saved_search['property_category']:'';
				
		if($this->input->post('save_search_id')!= "" && $this->input->post('save_search_id') > 0){
			$save_search_id=$this->input->post('save_search_id');
			$new_data['saved_property_name']	= $property_name;
			$new_data['saved_by_user_id']		= $this->session->userdata('user_id');
			$new_data['location']				= ($this->input->post('location') != '' && $this->input->post('location') != $this->lang->line('search_header_location_field'))?$this->input->post('location'):'';
			$new_data['category']				= ($this->input->post('category_id') != '')?$this->input->post('category_id'):0;
			$new_data['contract_id'] = ($this->input->post('contract_type') != '') ? $this->input->post('contract_type') : "";
			//$new_data['property_post_by_type']	= ($this->input->post('posted_by') != '')?implode(",", $this->input->post('posted_by')):"";
			$new_data['status']					= ($this->input->post('status') != '')?$this->input->post('status'):"";
			$new_data['min_price']				= ($this->input->post('min_price') != '')?$this->input->post('min_price'):0;
			$new_data['max_price']				= ($this->input->post('max_price') != '')?$this->input->post('max_price'):0;
			$new_data['min_room']				= ($this->input->post('min_room') != '')?$this->input->post('min_room'):0;
			$new_data['max_room']				= ($this->input->post('max_room') != '')?$this->input->post('max_room'):0;
			$new_data['typology']				= ($this->input->post('typology') != '')?implode(",", $this->input->post('typology')):"";
			$new_data['bathrooms_no']			= ($this->input->post('bathrooms_no') != '')?$this->input->post('bathrooms_no'):'';
			$new_data['min_surface_area']		= ($this->input->post('min_surface_area') != '')?$this->input->post('min_surface_area'):0;
			$new_data['max_surface_area']		= ($this->input->post('max_surface_area') != '')?$this->input->post('max_surface_area'):0;
			$new_data['min_beds_no']			= ($this->input->post('min_beds_no') != '')?$this->input->post('min_beds_no'):0;
			$new_data['max_beds_no']			= ($this->input->post('max_beds_no') != '')?$this->input->post('max_beds_no'):0;
			$new_data['kind']					= ($this->input->post('kind') != '')?$this->input->post('kind'):'';
			$new_data['energyclass']			= ($this->input->post('energyclass') != '')?$this->input->post('energyclass'):'';
			$new_data['heating']				= ($this->input->post('heating') != '')?$this->input->post('heating'):'';
			$new_data['parking']				= ($this->input->post('parking') != '')?$this->input->post('parking'):'';
			$new_data['furnished']				= ($this->input->post('furnished') != '')?$this->input->post('furnished'):'';
			$new_data['roommates']				= ($this->input->post('roommates') != '')?$this->input->post('roommates'):0;
			$new_data['occupation']				= ($this->input->post('occupation') != '')?$this->input->post('occupation'):0;
			$new_data['smokers']				= ($this->input->post('smokers') == '1')?$this->input->post('smokers'):0;
			$new_data['pets']					= ($this->input->post('pets') == '1')?$this->input->post('pets'):0;
			$new_data['elevator']				= ($this->input->post('elevator') == '1')?$this->input->post('elevator'):0;
			$new_data['air_conditioning']		= ($this->input->post('air_conditioning') == '1')?$this->input->post('air_conditioning'):0;
			$new_data['garden']					= ($this->input->post('garden') == '1')?$this->input->post('garden'):0;
			$new_data['terrace']				= ($this->input->post('terrace') == '1')?$this->input->post('terrace'):0;
			$new_data['balcony']				= ($this->input->post('balcony') == '1')?$this->input->post('balcony'):0;
			$new_data['add_neighbour_zip']		= ($this->input->post('add_neighbour_zip') != '')?$this->input->post('add_neighbour_zip'):'';
			$new_data['saved_date']				= date('Y-m-d H:i:s');
			$new_data['property_category']		= ($this->input->post('property_category') != '')?$this->input->post('property_category'):'';
		}

		$search_filter = $this->session->userdata('new_search');
		//echo '<pre>';print_r($new_saved_search);
		
		$rs=$this->propertym->saved_search($new_data,$save_search_id,$save_search_flag);
		
		if($rs){
			$default_email = get_perticular_field_value('zc_settings','meta_value'," and meta_name='default_email'");
			
			$user_id=$this->session->userdata( 'user_id' );
			$user_preference_loc = get_all_value('zc_user_preference'," and user_id='".$user_id."'");
			$email_user=get_perticular_field_value('zc_user','email_id'," and user_id='".$user_id."'");
			$first_name=get_perticular_field_value('zc_user','first_name'," and user_id='".$user_id."'");
			$last_name=get_perticular_field_value('zc_user','last_name'," and user_id='".$user_id."'");
			if( isset( $user_preference_loc[0] ) &&( count( $user_preference_loc[0] ) > 0 )) {				
				if($user_preference_loc[0]['email_alerts'] == 1 ) {
					$mail_from = isset($default_email) ? $default_email : "no-reply@zapcasa.it";
					$mail_to = $email_user;
					$subject = $this->lang->line('new_mail_subject');
					$link = base_url().'property/get_saved_search';
					$message = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">
									<div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
										<div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
										<div style="border-bottom:1px solid #d1d1d1;">
											<img src="'.base_url().'asset/images/logo.png" alt="logo"/>
										</div>
										<div style="padding:15px;">
											<strong>'.$this->lang->line('new_mail-hi').' '.$first_name." ".$last_name.'</strong>
											<p>'.$this->lang->line('content_successfull_saved_search').' :</p>
											<p><a href="'.$link.'" target="_blank">'.$link.'</a></p>
											<p><br><a href="http://www.zapcasa.it">www.zapcasa.it</a></p>
										</div>
									</div>
								</body>';
					// if(sendemail($mail_from, $mail_to, $subject, $message, $cc='')){
						echo 1; 
					// } 
				}else{
					echo 1; 
				}
			}
		}
		//echo '<pre>';print_r($search_filter);
	}
	public function save_search_modify() {
		$save_search_id = $this->input->post('save_search_id');
		$rs=$this->propertym->get_details_saved_property( $save_search_id );
		

		if(count($rs) > 0 ){
			$data = "";
			$location = isset($rs['location'])?urlencode($rs['location']):'';
			$category_id = isset( $rs['category'] ) ? $rs['category'] : '';
			$add_neighbour_zip = isset( $rs['add_neighbour_zip'] ) ? $rs['add_neighbour_zip'] : '';
			$contract_id = isset( $rs['contract_id'] ) ? $rs['contract_id'] : '';
			$status = isset( $rs['status'] ) ? $rs['status'] : '';
			$property_category = isset( $rs['property_category'] ) ? $rs['property_category'] : '';
			$saved_property_name = $rs['saved_property_name'];
			$min_price = isset( $rs['min_price'] ) ? urlencode($rs['min_price']) : '';
			$max_price = isset( $rs['max_price'] ) ? urlencode($rs['max_price']) : '';
			$min_room = isset( $rs['min_room'] ) ? $rs['min_room'] : '';
			$max_room = isset( $rs['max_room'] ) ? $rs['max_room'] : '';
			
			if( $min_price == '0,00'){
				$min_price = "";
			} if( $max_price == '0,00'){
				$max_price = "";
			} if( $min_room == '0'){
				$min_room = "";
			} if( $max_room == '0'){
				$max_room = "";
			}
			
			$typology = isset( $rs['typology'] ) ? $rs['typology'] : '';
			$property_post_by_type = isset( $rs['property_post_by_type'] ) ? $rs['property_post_by_type'] : '';
			$bathrooms_no = isset( $rs['bathrooms_no'] ) ? $rs['bathrooms_no'] : '';
			$min_surface_area = isset( $rs['min_surface_area'] ) ? $rs['min_surface_area'] : '';
			$max_surface_area = isset( $rs['max_surface_area'] ) ? $rs['max_surface_area'] : '';
			$min_beds_no = isset( $rs['min_beds_no'] ) ? $rs['min_beds_no'] : '';
			$max_beds_no = isset( $rs['max_beds_no'] ) ? $rs['max_beds_no'] : '';
			if( $min_surface_area == '0'){
				$min_surface_area = "";
			} if( $max_surface_area == '0'){
				$max_surface_area = "";
			} if( $min_beds_no == '0'){
				$min_beds_no = "";
			} if( $max_beds_no == '0'){
				$max_beds_no = "";
			} if( $bathrooms_no == '0'){
				$bathrooms_no = "";
			}

			$kind = isset( $rs['kind'] ) ? $rs['kind'] : '';
			$energyclass = isset( $rs['energyclass'] ) ? $rs['energyclass'] : '';
			$heating = isset( $rs['heating'] ) ? $rs['heating'] : '';
			$parking = isset( $rs['parking'] ) ? $rs['parking'] : '';
			$furnished = isset( $rs['furnished'] ) ? $rs['furnished'] : '';
			$roommates = isset( $rs['roommates'] ) ? $rs['roommates'] : '';
			$occupation = isset( $rs['occupation'] ) ? $rs['occupation'] : '';
			$smokers = isset( $rs['smokers'] ) ? $rs['smokers'] : '';
			$pets = isset( $rs['pets'] ) ? $rs['pets'] : '';
			$elevator = isset( $rs['elevator'] ) ? $rs['elevator'] : '';
			$air_conditioning = isset( $rs['air_conditioning'] ) ? $rs['air_conditioning'] : '';
			$garden = isset( $rs['garden'] ) ? $rs['garden'] : '';
			$terrace = isset( $rs['terrace'] ) ? $rs['terrace'] : '';
			$balcony = isset( $rs['balcony'] ) ? $rs['balcony'] : '';

			if( $kind == '0'){
				$kind = "";
			} if( $energyclass == '0'){
				$energyclass = "";
			} if( $heating == '0'){
				$heating = "";
			} if( $parking == '0'){
				$parking = "";
			} if( $furnished == '0'){
				$furnished = "";			}
			if( $roommates == '0'){
				$roommates = "";
			} if( $occupation == '0'){
				$occupation = "";
			} if( $smokers == '0'){
				$smokers = "";
			} if( $pets == '0'){
				$pets = "";
			}if( $elevator == '0'){
				$elevator = "";
			} if( $air_conditioning == '0'){
				$air_conditioning = "";
			} if( $garden == '0'){
				$garden = "";
			} if( $terrace == '0'){
				$terrace = "";
			}if( $balcony == '0'){
				$balcony = "";
			}
			$contract_type = "";
			if( $contract_id != "" ) {
				/* $contract_id_array = explode(",", $contract_id);
				for( $i=0; $i< count( $contract_id_array ); $i++) {
					if( $i == 0 ) {
						$contract_type = "&contract_type[]=".$contract_id_array[$i];
					} else {
						$contract_type = $contract_type."&contract_type[]=".$contract_id_array[$i];	
					}
				} */
				$contract_type = "&contract_type=".$contract_id;
			}
			
			$status_id = "";
			if( $status != "" ) {
				$status_array = explode(",", $status);

				for( $i=0; $i< count( $status_array ); $i++) {
					if( $i == 0 ) {
						$status_id = "&status[]=".$status_array[$i];
					} else {
						$status_id = $status_id."&status[]=".$status_array[$i];
					}
				}
			}
			$typology_id = "";
			if( $typology != "" ) {
				$typology_array = explode(",", $typology);
				for( $i=0; $i< count( $typology_array ); $i++) {
					if( $i == 0 ) {
						$typology_id = "&typology[]=".$typology_array[$i];
					} else {
						$typology_id = $typology_id."&typology[]=".$typology_array[$i];
					}
				}
			}
			$property_post_by_id = "";
			if( $property_post_by_type != "" ) {
				$property_post_by_array = explode(",", $property_post_by_type);
				for( $i=0; $i< count( $property_post_by_array ); $i++) {
					if( $i == 0 ) {
						$property_post_by_id = "&posted_by[]=".$property_post_by_array[$i];
					} else {
						$property_post_by_id = $property_post_by_id."&posted_by[]=".$property_post_by_array[$i];
					}
				}
			}
			$otherCriteria = "";
			$elevator_cond = "";
			if( $elevator != '0' ) {
				$elevator_cond = "&elevator=".$elevator;
			}
			$air_conditioning_cond = "";
			if( $air_conditioning != '0' ){
				$air_conditioning_cond = "&air_conditioning=".$air_conditioning;
			}
			$garden_cond = "";
			if( $garden != '0' ) {
				$garden_cond = "&garden=".$garden;
			}
			$terrace_cond = "";
			if( $terrace != '0' ) {
				$terrace_cond = "&terrace=".$terrace;
			}
			$balcony_cond = "";
			if( $balcony != '0' ) {
				$balcony_cond = "&balcony=".$balcony;
			}
			$smokers_cond = "";
			if( $smokers != '0' ){
				$smokers_cond = "&smokers=".$smokers;
			}
			$pets_cond = "";
			if( $pets != '0' ){
				$pets_cond = "&pets=".$pets;
			}
			$otherCriteria = $elevator_cond.$air_conditioning_cond.$garden_cond.$terrace_cond.$balcony_cond.$smokers_cond.$pets_cond;
			$queryStr=$contract_type.$property_post_by_id.$status_id;
			$data = "?location=$location&category_id=$category_id&add_neighbour_zip=$add_neighbour_zip&property_cat=$property_category&min_price=$min_price&max_price=$max_price&min_room=$min_room&max_room=$max_room$typology_id&bathrooms_no=$bathrooms_no&min_surface_area=$min_surface_area&max_surface_area=$max_surface_area&kind=$kind&energyclass=$energyclass&heating=$heating&parking=$parking&furnished=$furnished$queryStr$otherCriteria&search=Search&category_search=$property_category&save_search_id=$save_search_id&save_search_name=$saved_property_name";	
			
			$searchPrms = trim(preg_replace('/[\s\t\n\r\s]+/', ' ', $data));
			redirect('property/search'.$searchPrms);
		} else {
			redirect('property/get_saved_search');
		}
	}
	public function serach_filter() {
		if( !isset($_GET['category_search'])){
			header('Location: '.base_url().'errors/error_404.php');
			die;
		}
		$new_filter=array();
		$segments=$this->input->post('category_search');
		if( $this->input->get('property_cat') !="" ) {
			$segments = $this->input->get('property_cat');
		}
		$category='0';
		$category_id = $_GET['category_id'];
		$category_code = '';
		$segments = '';
		$pcat_id = $category_id;
		$category = get_categories(" and category_id = ".$category_id);
		if(count($category) > 0){
			$category_code = $category[0]['short_code'];
			$segments = $category[0]['name'];
			$pcat_id = $category[0]['parent_id'];
		}
		$new_filter['category'] = $category_id;
		if($this->input->get('contract_type') && $this->input->get('contract_type') != ''){
			$new_filter['contract_id']=$this->input->get('contract_type');
		}else{
			$temparray2 = array('1', '2');
			$new_filter['contract_id']= $temparray2;
		}
		if($this->input->get('posted_by') && $this->input->get('posted_by') != ''){
			$new_filter['property_post_by_type']=$this->input->get('posted_by');
		}else{
			$temparray = array('1', '2');
			$new_filter['property_post_by_type']= $temparray;
		}
		
		$new_filter['status']=$this->input->get('status');
		$new_filter['min_price']=$this->input->get('min_price');
		$new_filter['max_price']=$this->input->get('max_price');
		$new_filter['min_room']=$this->input->get('min_room');
		$new_filter['max_room']=$this->input->get('max_room');
		$new_filter['typology']=$this->input->get('typology');
		$new_filter['bathrooms_no']=$this->input->get('bathrooms_no');
		$new_filter['min_surface_area']=$this->input->get('min_surface_area');
		$new_filter['max_surface_area']=$this->input->get('max_surface_area');
		$new_filter['min_beds_no']=$this->input->get('min_beds_no');
		$new_filter['max_beds_no']=$this->input->get('max_beds_no');
		$new_filter['kind']=$this->input->get('kind');
		$new_filter['energyclass']=$this->input->get('energyclass');
		$new_filter['heating']=$this->input->get('heating');
		$new_filter['parking']=$this->input->get('parking');
		$new_filter['furnished']=$this->input->get('furnished');
		$new_filter['roommates']=$this->input->get('roommates');
		$new_filter['occupation']=$this->input->get('occupation');
		$new_filter['smokers']=$this->input->get('smokers');
		$new_filter['pets']=$this->input->get('pets');
		$new_filter['elevator']=$this->input->get('elevator');
		$new_filter['air_conditioning']=$this->input->get('air_conditioning');
		$new_filter['garden']=$this->input->get('garden');
		$new_filter['terrace']=$this->input->get('terrace');
		$new_filter['balcony']=$this->input->get('balcony');
		$new_filter['location']=$this->input->get('location');

		$new_filter['property_category']= $segments;
		$new_filter['save_search_id'] = 0 ;
		if( isset( $_GET['save_search_id'] ) && (  $_GET['save_search_id'] != "" ) ) {
			$new_filter['save_search_id']=$this->input->get('save_search_id');
		}
		$order_option="";
		if( isset( $_GET['ordering_opt'] ) && ( $_GET['ordering_opt'] != "" ) ) {
			$order_option=$this->input->get('ordering_opt');
		}
		$this->session->set_userdata('order_option',$order_option);
		$uid=$this->session->userdata( 'user_id' );
		
		if($uid==0 || $uid==''){
			$this->serach_filter_property($new_filter,$segments,$order_option,$pcat_id);
		}else{
			$this->session->set_userdata('new_search',$new_filter);
			$this->serach_filter_property($new_filter,$segments,$order_option,$pcat_id);
		}
	}
	public function serach_filter_property($new_filter,$segments,$order_option,$pcat_id='') {
		//echo "<pre>"; print_r($new_filter);exit;
		$data['property_details']=$this->propertym->search_property($new_filter,$segments,$order_option,$pcat_id);
		$data['search_title']=$segments;
		$result_count = count($data['property_details']);
		$keysearch = $this->input->get('location');
		if($result_count > 0){
			$blank_db = $this->propertym->pop_search("select * from zc_popular_search where ps_type = 'property_filter'");
			if(count($blank_db) > 0){
				$qry = "select * from zc_popular_search where ps_type = 'property_filter' and ps_keyword = '".$keysearch."' and ps_start_date <= now() and ps_end_date >= now() and ps_status = '1'";
				$res = $this->propertym->pop_search($qry);
				if(count($res) > 0){
					$view = ($res[0]['ps_views'] + 1);
					$this->propertym->insert_update("update zc_popular_search set ps_views = '".$view."' where ps_id = '".$res[0]['ps_id']."'");
				}else{
					$qry2 = "select * from zc_popular_search where ps_keyword = '".$keysearch."' and ps_type = 'property_filter' and ps_status = '1'";
					$res2 = $this->propertym->pop_search($qry2);
					$this->propertym->insert_update("delete from zc_popular_search where ps_id = '".$res2[0]['ps_id']."'");
					$qry = "insert into zc_popular_search set ps_type = 'property_filter', ps_keyword = '".$keysearch."', ps_url = '".$_SERVER['REQUEST_URI']."', ps_start_date = now(), ps_end_date = date_add(now(), INTERVAL +7 day), ps_views = '1', ps_created_on = now()";
					$this->propertym->insert_update($qry);
				}
			}else{
				$qry = "insert into zc_popular_search set ps_type = 'property_filter', ps_keyword = '".$keysearch."', ps_url = '".$_SERVER['REQUEST_URI']."', ps_start_date = now(), ps_end_date = date_add(now(), INTERVAL +7 day), ps_views = '1', ps_created_on = now()";
				$this->propertym->insert_update($qry);
			}
		}
		$this->load->view('property/property_search',$data);
	}

	public function add_property_csv()
	{
		$uid = $this->session->userdata('user_id');
		if ($uid == 0 || $uid == '') {
			redirect('users/common_reg');
		} else {
			$user_type = get_perticular_field_value('zc_user', 'user_type', " and user_id='" . $uid . "'");
			if ($user_type == '1') {
				redirect('/');
			}
			if ($this->input->post('submit')) {
				$this->upload_pdf('userfile');
			} else {
				$data['title'] = "add_property";
				$data['contract_type'] = $this->propertym->get_contract_type();
				$this->config->load('site_config', TRUE);
				$site_config = $this->config->item('site_config');
				$this->load->view('property/add_property_csv', $data);
			}
		}
	}

	public function upload_pdf($form_field_name)
	{
		//$this->load->library('csvimport');
		//echo '<pre>';print_r($_FILES);die;
		$config['upload_path'] = './assets/uploads/property_tmp_csv';
		$config['allowed_types'] = 'text/plain|text/csv|csv';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($form_field_name)) {
			$errors = $this->upload->display_errors();
			$errors = $this->lang->line('upload_csv_file_text');
			$this->session->set_flashdata('msg', $errors);
			redirect('property/add_property_csv');
		} else {
			$upload_data = $this->upload->data();
			$file_names = $upload_data['file_name'];
			$this->add_property_csv_upload($file_names);
		}
	}

	public function add_property_csv_upload($file_names){
		$new_data=array();
		$file = "./assets/uploads/property_tmp_csv/" . $file_names;
		$records=$this->csv_to_array($file);
		if(!empty($records)){
			$i=0;
			foreach($records as $record){
				if(($record['CONTRACT']==1)||($record['CONTRACT']==2)|| $record['CATEGORY']="RES" || $record['CATEGORY']="ROM"||$record['CATEGORY']="LAND"||$record['CATEGORY']="VAC"){
					$new_data[$i]['property_post_by']=$this->session->userdata( 'user_id' );
					$new_data[$i]['posting_time']=date('d-m-Y');
					if (array_key_exists('CONTRACT', $record)) {
						$new_data[$i]['contract_id']=$record['CONTRACT'];
					}
					if (array_key_exists('CATEGORY', $record)) {
						$category_id=get_perticular_field_value('zc_categories','category_id'," and short_code='".$record['CATEGORY']."'");
						$new_data[$i]['category_id']=$category_id;
					}
					if (array_key_exists('PROVIENCE', $record)) {
						$new_data[$i]['provience']=$record['PROVIENCE'];
					}
					if (array_key_exists('CITY', $record)) {
						$new_data[$i]['city']=$record['CITY'];
					}
					if (array_key_exists('ZIPCODE', $record)) {
						$new_data[$i]['zip']=$record['ZIPCODE'];
					}
					if (array_key_exists('ADDRESS', $record)) {
						$new_data[$i]['street_address']=$record['ADDRESS'];
					}
					if (array_key_exists('STREETNO', $record)) {
						$new_data[$i]['street_no']=$record['STREETNO'];
					}
					if (array_key_exists('AREA', $record)) {
						$new_data[$i]['area']=$record['AREA'];
					}
					if (array_key_exists('PRICE', $record)) {
						$new_data[$i]['price']=$record['PRICE'];
					}
					if (array_key_exists('PRICE', $record)) {
						$new_data[$i]['youtube_url']=$record['YOUTUBEURL'];
					}
					if (array_key_exists('DESCRIPTION', $record)) {
						$new_data[$i]['description']=$record['DESCRIPTION'];
					}
					$new_data[$i]['property_status']='1';
					$i++;
				}
			}
		}
		// echo json_encode($new_data);exit;
		if(count($new_data)!=0){
			$property_id=$this->propertym->add_new_property_csv($new_data);
			////////////////delete the xls file after insert the data//////
			$dfile='assets/uploads/property_tmp_csv/'.$file_names;
			if(is_file($dfile))
				@unlink($dfile);
			$msgdata = $this->lang->line('property_msg_text_1');
			$this->session->set_flashdata('msg', $msgdata);
			redirect('property/thanks_add_property');
		}else{
			$msgdata = $this->lang->line('property_please_check_you_file');
			$this->session->set_flashdata('msg', $msgdata);
			redirect('property/add_property_csv');
		}
	}

	public function csv_to_array($filename = '', $delimiter = ',')
	{
		if (!file_exists($filename) || !is_readable($filename))
			return FALSE;
		$header = NULL;
		$data = array();
		if (($handle = fopen($filename, 'r')) !== FALSE) {
			while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
				if (!$header)
					$header = $row;
				else
					$data[] = array_combine($header, $row);
			}
			fclose($handle);
		}
		return $data;
	}

	public function delete_saved_property(){
		$saved_id=$this->input->post('saved_id');
		$rs=$this->propertym->delete_saved_propertys($saved_id);
		$msg = $this->lang->line('saved_property_delete_message');
		$newdata = array("delete_saved_property_message" => $msg);
		$this->session->set_userdata($newdata);
		if($rs){
			echo  1;
		}
	}
	public function update_save_rec(){
		$rec_option=$this->input->post('value');
		$saved_id=$this->input->post('id');
		$rs=$this->propertym->update_save_rec($rec_option,$saved_id);
		$msg = $this->lang->line('saved_property_update_message');
		$newdata = array("update_saved_property_message" => $msg);
		$this->session->set_userdata($newdata);
	}
	public function delete_msg_per(){
		$delete_msg_ids=$this->input->post('msg_id');
		$uid=$this->session->userdata('user_id');
		//$msgDetails = get_all_value('zc_property_message_info'," and msg_id='".$delete_msg_ids."'");
		/*if(($msgDetails[0]['msg_from_delete'] == '1' && $msgDetails[0]['msg_to_delete'] == '0')){
			//------Condition for sent msg. will be attached in 'or' condition
			//($msgDetails[0]['msg_from_delete'] == '0' && $msgDetails[0]['msg_to_delete'] == '1')
			$rs=$this->propertym->delete_per_msg_2($delete_msg_ids, "to");
			$rs=$this->propertym->delete_per_msg($user_id,$mgrid,'from');					
		}else{
			if($user_id==$msgDetails[0]['user_id_to']){
				$rs=$this->propertym->delete_per_msg_2($delete_msg_ids, "to");
			}elseif($user_id==$msgDetails[0]['user_id_from']){
				$this->propertym->insert_update("update zc_property_message_info set msg_from_delete = '1' where msg_id='".$delete_msg_ids."'");
			}
		}*/
		$msgDetails = get_all_value('zc_property_message_info'," and msg_id='".$delete_msg_ids."'");
		$mgrid = $msgDetails[0]['msg_grp_id'];
		$rs=$this->propertym->delete_per_msg($uid,$mgrid,'from');					
		$rs=$this->propertym->delete_per_msg($uid,$mgrid,'to');					
		$this->propertym->delete_per_msg_permenent();
		echo $msg = $this->lang->line('property_info_inbox_delete_message');
		$newdata = array("delete_inbox_message" => $msg);
		$this->session->set_userdata($newdata);
	}
	public function send_email(){
		$this->load->library('email');
		$return_url=$this->input->post('return_url');
		$mail_from=$this->input->post('mail_from');
		$mail_to=$this->input->post('mail_to');
		$mail_tos=explode(',',$mail_to);

		$message='';
		$msg=nl2br($this->input->post('message'));
		// $message=$msg.'<br>'.$this->lang->line('property_click_here_to_view_the_property').'<br>'.$this->input->post('property_url');
		$message = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">
						<div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
							<div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
								<div style="border-bottom:1px solid #d1d1d1;">
									<img src="'.base_url().'assets/images/logo.png" alt="logo"/>
								</div>
								<div style="padding:15px;">
									<p>'.$msg.'</p>
									<p>'.$this->lang->line('property_click_here_to_view_the_property').'</p>
									<p><a href="'.$this->input->post('property_url').'">'.$this->input->post('property_url').'</a></p>
									<p><br>'.$this->lang->line('property_message_sent_from').' '.$mail_from.'</p>
									<p><br>'.$this->lang->line('property_message_regards').'</p>
									<p>www.zapcasa.it</p>
								</div>
							</div>
						</div>
					</body>';
		$default_email = get_perticular_field_value('zc_settings','meta_value'," and meta_name='default_email'");
		$mail_from= isset($default_email) ? $default_email : "no-reply@zapcasa.it";
		$subject= $this->lang->line('property_message_for_property');
		//foreach($mail_tos as $key=>$val){
		for($i=0;$i<count($mail_tos);$i++){
			sendemail($mail_from, $mail_tos[$i], $subject, $message, $cc='');
		}
		$msgdata = $this->lang->line('property_your_mail_is_sending_successfully');
		$this->session->set_flashdata('mail_success', $msgdata);
		redirect($return_url);
	}
	public function dowload_file_doc(){
		$file_name=$this->uri->segment('3');
		$files='./assets/uploads/csv/'.$file_name;
		force_download($file_name,$files);
		//force_download( 'screenshot.png', './images/screenshot.png' );
	}
	public function testImageMagic(){
		$imgData = array(
			'sourcePath' => './demo/1080.jpg',
			'destinationPath' => './demo/thumb_92_82/1.jpg',
			'imageSize' => '500x200'
		);
		CreateImageUsingImageMagic($imgData);
		echo 'Resulted';
	}
}
?>