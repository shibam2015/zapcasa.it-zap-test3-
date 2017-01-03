<?php
global $module_name;
/*
 *	Image Magic Creation Function
 *	Don't Delete It.
 *
 *	$data = array(
		'sourcePath' => './demo/1.jpg',
		'destinationPath' => './demo/thumb_92_82/1.jpg',
		'imageSize' => '50x20'
	);
 *
 *
*/
function CreateImageUsingImageMagic($data){
	$sourcePath = $data['sourcePath'];
	$destinationPath = $data['destinationPath'];
	$imageSize = $data['imageSize'];
	exec ("/usr/bin/convert ".$sourcePath."   -resize ".$imageSize."\!  ".$destinationPath);
}

function CreateImageUsingImageMagicWithGravity($data)
{
	$sourcePath = $data['sourcePath'];
	$destinationPath = $data['destinationPath'];
	$watermarkLogoPath = $data['watermarkLogoPath'];
	$imageSize = $data['imageSize'];
	//echo '<pre>';print_r($data);
	 exec ("convert -strip ".$sourcePath." -flatten /
        -resize ".$imageSize."^ -gravity Center -crop ".$imageSize."+0+0 +repage /
        -gravity SouthWest -draw 'image Over 0,0 100,43 'zap_logo.png'' /
        -background white -alpha remove -quality 80% ".$destinationPath);

	// return copy($sourcePath, $destinationPath);

}
function CreateImageUsingImageMagicWithOutGravity($data){
	$sourcePath = $data['sourcePath'];
	$destinationPath = $data['destinationPath'];
	$imageSize = $data['imageSize'];
	exec ("convert -strip ".$sourcePath." -flatten /
			-resize ".$imageSize."^ -gravity Center -crop ".$imageSize."+0+0 +repage /
			-background white -alpha remove -quality 80% ".$destinationPath);
	// return copy($sourcePath, $destinationPath);
}

// USE THIS FOR BIG IMAGE AND FOR PLANIMETRY

function CreateImageUsingImageMagicWithOutGravitybBigImage($data){
	$sourcePath = $data['sourcePath'];
	$destinationPath = $data['destinationPath'];
	$imageSize = $data['imageSize'];
	exec ("/usr/local/bin/convert -strip ".$sourcePath." -flatten \
			-resize ".$imageSize." \
			-background white -alpha remove -quality 80% ".$destinationPath);
	// return copy($sourcePath, $destinationPath);
}

/*
 *
 *
*/
if (!function_exists('ensure_length')){
    function ensure_length(&$string, $length) {
        $strlen = strlen($string);
        if ($strlen < $length) {
            $string = str_pad($string, $length, "0");
        } else if ($strlen > $length) {
            $string = substr($string, 0, $length);
        }
    }
}
if (!function_exists('authenticate')) {
	function authenticate() {	
		$CI = & get_instance();
        $userId = $CI->session->userdata("sess_user_id");
        if (empty($userId)) {
            //redirect("users/login");
			echo "<script>window.parent.location.href='".base_url()."site/login'</script>";
            exit;
        }
    }
}
function get_categories($where=''){
	$CI =& get_instance();
	$str="select * from zc_categories where 1=1 and status = 'active' ".$where;
	$query=$CI->db->query($str);
	$record="";
	if($query->num_rows()>0){
		$record = $query->result_array();
	}
	return $record;
}
function getCatByName($name=''){
	$where='';
	if($name!=''){
		$where="and name='".$name."'";
	}
	$CI =& get_instance();
	$str="select * from zc_categories where 1=1 and status = 'active' ".$where;
	$query=$CI->db->query($str);
	$record="";
	if($query->num_rows()>0){
		$record = $query->result_array();
	}
	return $record;
}
function get_categories_subcat($where=''){
	$CI =& get_instance();
	$str="select * from zc_categories where parent_id = 0 and status = 'active' ".$where;
	$query=$CI->db->query($str);
	$record= array();
	if($query->num_rows() > 0){
		$result = $query->result();
		foreach($result as $res){
			$data = array();
			$data['category_id'] = $res->category_id;
			$data['name'] = $res->name;
			$data['name_it'] = $res->name_it;
			$data['short_code'] = $res->short_code;
			$data['decs'] = $res->decs;
			$data['parent_id'] = $res->parent_id;
			$data['status'] = $res->status;
			$strSub="select * from zc_categories where parent_id = ".$res->category_id." and status = 'active' ";
			$querysub=$CI->db->query($strSub);
			if($querysub->num_rows()>0){
				$data['subcat'] = $querysub->result();
			}else{
				$data['subcat'] = 0;
			}
			$record[] = $data;
		}
		return $record;
	}else{
		return 0;
	}
	return $record;
}
function get_contracts($where=''){
	$CI =& get_instance();
	$str="select * from zc_contract_types where 1=1 and status = 'active' ".$where;
	$query=$CI->db->query($str);
	$record="";
	if($query->num_rows()>0){
		$record = $query->result_array();
	}
	return $record;
}
function getCategoryDetails($where=''){
	$CI =& get_instance();
	$str="select * from zc_categories where 1=1 and status = 'active' ".$where;
	$query=$CI->db->query($str);
	$record="";
	if($query->num_rows()>0){
		$record = $query->result_array();
	}
	return $record;
}
function get_perticular_count($tablename,$where=""){
	$CI =& get_instance();
	$str="select * from ".$tablename." where 1=1 ".$where;
	$query=$CI->db->query($str);
	//echo $CI->db->last_query();
	$record=$query->num_rows();
	return $record;
}
function get_all_value($tablename,$where=""){
	$CI =& get_instance();
	$str="select * from ".$tablename." where 1=1 ".$where;
	$query=$CI->db->query($str);
	$record="";
	if($query->num_rows()>0){
		foreach($query->result_array() as $row){
			$record[]=$row;
		}
	}
	return $record;
}	
function get_popular_search() {
	$CI =& get_instance();
	$str="select 
			zc_popular_search.*, 
			zc_contract_types.*, 
			zc_typologies.typology_id, 
			zc_typologies.name as typology_name, 
			zc_typologies.name_it as typology_name_it, 
			zc_city.*, 
			zc_region_master.province_code 
			from 
			zc_popular_search left join zc_contract_types on zc_popular_search.contract_type = zc_contract_types.contract_id 
			left join zc_typologies on zc_popular_search.typology = zc_typologies.typology_id 
			left join zc_city on zc_city.city_id = zc_popular_search.ps_city 
			left join zc_provience on zc_provience.provience_id = zc_popular_search.ps_provience 
			left join zc_region_master on zc_city.city_name = zc_region_master.city  
			where zc_popular_search.ps_start_date <= now() and zc_popular_search.ps_end_date >= now() and zc_popular_search.ps_status = '1' order by zc_popular_search.ps_id desc limit 0,5";
	$query=$CI->db->query($str);
	$popular_search_record=array();
	if($query->num_rows()>0){
		foreach($query->result_array() as $row){
			$popular_search_record[]=$row;
		}
	}
	return $popular_search_record;
}
function get_popular_search_property_data($filters='') {
	$CI =& get_instance();
	$where = '';
	if($filters['category_id'] != '') {
		$category_id = '0';
		$pcat_id = '0';
		$category = getCategoryDetails(" and category_id = ".$filters['category_id']);
		if(count($category) > 0){
			$category_id = $category[0]['category_id'];
			$pcat_id = $category[0]['parent_id'];
			if($pcat_id != 0){
				$pcat = getCategoryDetails(" and category_id = ".$pcat_id);
			}
		}
		$filters['category_id'] = $category_id;
		$filters['parent_id'] = $pcat_id;
		$cat_id = $filters['category_id'];
		if($cat_id != '10'){
			if($filters['parent_id'] == "0"){
				$where.=" AND (zc_property_details.category_id in (select category_id from zc_categories where parent_id =".$cat_id.") or zc_property_details.category_id in (".$cat_id.")) ";
			}else{
				$where.=" AND zc_property_details.category_id = ".$cat_id;
			}
		}
	}
	if($filters['contract_type'] != '' && $filters['contract_type'] != 'all') {
		$where.=" AND zc_property_details.contract_id = ".$filters['contract_type'];
	}
	if($filters['posted_by'] != '' && $filters['posted_by'] != 'all') {
		$where.=" AND zc_property_details.property_post_by_type = ".$filters['posted_by'];
	}
	$sql = "select zc_property_details.*, zc_property_img.file_name as main_img, zc_contract_types.*, zc_typologies.typology_id, zc_typologies.name as typology_name, zc_city.*, zc_region_master.province_code from zc_property_details left join zc_property_img on zc_property_details.property_id = zc_property_img.property_id left join zc_contract_types on zc_property_details.contract_id = zc_contract_types.contract_id left join zc_typologies on zc_property_details.typology = zc_typologies.typology_id left join zc_city on zc_property_details.city = zc_city.city_id left join zc_provience on zc_property_details.provience = zc_provience.provience_id left join zc_region_master on zc_city.city_name = zc_region_master.city where zc_property_img.img_type = 'main_image' ".$where;
	$row = $CI->db->query($sql);
	if($row->num_rows() > 0){
		return $result = $row->result();
	}else{
		return 0;
	}
}
function get_advertiser_footer() {
	$CI =& get_instance();
	$str="select * from zc_user where user_type in (2,3) and status = '1' order by registered_on desc limit 0,5";
	$query=$CI->db->query($str);
	$adv_record=array();
	if($query->num_rows()>0){
		foreach($query->result_array() as $row){
			$adv_record[]=$row;
		}
	}
	return $adv_record;
}
function get_featured_property($where=''){
	$CI =& get_instance();
	$sql = "select pf.*,pd.update_price, zc_provience.provience_name, zc_provience.provience_name_it,pd.price,pd.city,pd.provience,pd.category_id,pd.contract_id,pd.suspention_by_user,pd.suspention_status,pd.description,pd.typology,pd.street_address,pd.street_address,pd.street_no,pd.zip,pd.update_time,pd.posting_time, zc_city.* from zc_property_featured as pf LEFT JOIN zc_property_details as pd ON( pd.property_id = pf.property_id ) left join zc_provience on pd.provience = zc_provience.provience_id left join zc_city on pd.city = zc_city.city_id left join zc_region_master on zc_city.city_name = zc_region_master.city ";
	$sql .= "JOIN zc_user as u ON (pd.property_post_by = u.user_id) where u.status='1' and u.verified = '1' and pd.suspention_status!='1' and pf.status='1' and pd.feature_status='1' AND pd.property_approval ='1' ";    //pd.suspention_status is for admin suspension.
	//$sql.= " ORDER BY pf.property_featured_id DESC LIMIT 12";
	$sql.= " ORDER BY RAND() LIMIT 12";
	#echo $sql;exit;
	$query=$CI->db->query($sql);
	$data = array();
	$todayDate = strtotime( date('d-m-Y') );
	if($query->num_rows()>0){
		foreach($query->result_array() as $row){
			$startDate = strtotime( $row['start_date'] );
			$expDateLength = $row['number_of_days'];
			$expireDate = strtotime(date("Y-m-d", $startDate) . " +".$expDateLength."days");
			if( $todayDate > $expireDate ) {
				$sql="UPDATE zc_property_featured SET status='0' where property_featured_id='".$row['property_featured_id']."'";
				$query=$CI->db->query($sql);
			}else{
				$data[] = $row;
			}
		}
	}
	//echo "====".count($data);
	return $data;
}
function get_latest_property($where=''){
	$CI =& get_instance();
	$str = "select zc_property_details.*, zc_provience.provience_name, zc_provience.provience_name_it, zc_property_img.file_name as main_img, zc_contract_types.*, zc_typologies.typology_id, zc_typologies.name as typology_name, zc_city.*, zc_region_master.province_code from zc_property_details left join zc_property_img on zc_property_details.property_id = zc_property_img.property_id left join zc_contract_types on zc_property_details.contract_id = zc_contract_types.contract_id left join zc_typologies on zc_property_details.typology = zc_typologies.typology_id left join zc_city on zc_property_details.city = zc_city.city_id left join zc_provience on zc_property_details.provience = zc_provience.provience_id left join zc_region_master on zc_city.city_name = zc_region_master.city";
	$str .= " JOIN zc_user as u ON (zc_property_details.property_post_by = u.user_id)  ";    //pd.suspention_status is for admin suspension.
	$str.= " where ";
	//$str.= "zc_property_details.status='1' and ";	//	zc_property_details.status is for status of the property .... see `zc_status_of_property` table.
	$str.= "zc_typologies.status='active' AND ";
	$str.= "zc_property_details.suspention_status!='1' AND ";
	$str .= "zc_property_details.property_approval ='1' ";
	$str .= " AND zc_property_details.property_status ='2' ";
	$str .= " AND u.status='1'";
	$str .= " AND u.verified='1'";
	$str.= "group by zc_property_details.property_id ";
	$str.= "order by zc_property_details.property_id desc limit 12";

#	echo "=========".$str;exit;
	$query=$CI->db->query($str);
	$record="";
	if($query->num_rows()>0){
		$record = $query->result_array();
	}
	//echo "====".count($record);
	return $record;
}
function get_perticular_field_value($tablename,$filedname,$where=""){
	$CI =& get_instance();
	$str="select ".$filedname." from ".$tablename." where 1=1 ".$where;
	$query=$CI->db->query($str);
	$CI->db->last_query();
	$record="";
	if($query->num_rows()>0){
		foreach($query->result_array() as $row){
			$field_arr=explode(" as ", $filedname);
			if(count($field_arr)>1){
				$filedname=$field_arr[1];
			}else{
				$filedname=$field_arr[0];
			}
			$record=$row[$filedname];
		}
	}
	return $record;
}
function get_all_basic_search_value($tablename,$cat_id){
	$CI =& get_instance();
	$where = '';//"AND category_id  IN (".$cat_id.")";
	if($cat_id != '') {
		if($cat_id != '10'){
			$where.=" AND (zc_property_details.category_id in (select category_id from zc_categories where parent_id =".$cat_id.") or zc_property_details.category_id in (".$cat_id.")) ";
		}else{
			 //$where.=" AND add_to_luxury='1' ";
			 $where.=" AND zc_property_details.category_id in (1, 5, 6, 7) ";
		}
	}
	$str="select zc_property_details.*, zc_property_img.file_name as main_img, zc_contract_types.contract_id, zc_contract_types.name, zc_contract_types.name_it, zc_contract_types.short_code, zc_contract_types.desc, zc_typologies.typology_id, zc_typologies.name as typology_name, zc_typologies.name_it as typology_name_it, zc_city.city_id, zc_city.country_id, zc_city.city_name, zc_city.city_name_it, zc_region_master.province_code from zc_property_details left join zc_property_img on zc_property_details.property_id = zc_property_img.property_id left join zc_contract_types on zc_property_details.contract_id = zc_contract_types.contract_id left join zc_typologies on zc_property_details.typology = zc_typologies.typology_id left join zc_city on zc_property_details.city = zc_city.city_id left join zc_provience on zc_property_details.provience = zc_provience.provience_id left join zc_region_master on zc_city.city_name = zc_region_master.city where zc_property_img.img_type = 'main_image' ".$where." AND property_approval='1' AND suspention_status='0' ORDER BY `feature_status` DESC";
	$query=$CI->db->query($str);
	//echo $CI->db->last_query();exit;
	$record="";
	if($query->num_rows()>0){
		$record = $query->result();
	}
	return $record;
}
function access_token( $length = 8 ){
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!_#^*';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	$randomString = str_shuffle($randomString);
	return $randomString;
}
if (!function_exists('sendemail')) {
	function sendemail($mail_from, $mail_to, $subject, $body, $cc='') {
		// echo $mail_from."\n".$mail_to."\n".$subject."\n".$body;exit;		
		$CI = & get_instance();
		$CI->load->library("email");
		$CI->email->set_mailtype("html");
		$CI->email->from($mail_from,'ZAPCASA');
		$CI->email->to($mail_to);
		$CI->email->cc($cc);		
		$CI->email->subject($subject);
		$CI->email->message($body);
		$CI->email->send();
		$CI->email->print_debugger();
		return true;
	}
}
function get_all_preference_by_user($tablename,$where=""){
	$CI =& get_instance();
	$str="select * from ".$tablename." where 1=1 ".$where;
	$query=$CI->db->query($str);
	$record=array();
	if($query->num_rows()>0){
		foreach($query->result_array() as $row){
			$record[]=$row;
		}
	} else {
		$record[]=array('invisible' => 0,'my_address_display' => 0,'my_contact_info' => 0 ,'send_me_email' => 0,'reply_msg' => 0,'email_alerts' => 0,'newsletter' => 0);
	}
	return $record;
}	
function subject_inbox($property_id){
	$property_name="";
	$contract = "";
	$contract_id=get_perticular_field_value('zc_property_details','contract_id'," and property_id='".$property_id."'");
	$typology=get_perticular_field_value('zc_property_details','typology'," and property_id='".$property_id."'");
	$city=get_perticular_field_value('zc_property_details','city'," and property_id='".$property_id."'");
	
	if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
		$name=get_perticular_field_value('zc_contract_types','name'," and contract_id='".$contract_id."'");
		$typology_name=get_perticular_field_value('zc_typologies','name'," and typology_id='".$typology."'");
		$city_name=get_perticular_field_value('zc_city','city_name'," and city_id='".$city."'");
		$province_code=get_perticular_field_value('zc_region_master','province_code'," and city='".mysql_real_escape_string($city_name)."'");
		
		$proptitle = $name." For ".stripslashes($typology_name)." in ".$city_name.", ".$province_code;
	} else {
		$name_it=get_perticular_field_value('zc_contract_types','name_it'," and contract_id='".$contract_id."'");
		$typology_name=get_perticular_field_value('zc_typologies','name_it'," and typology_id='".$typology."'");
		$city_name=get_perticular_field_value('zc_city','city_name_it'," and city_id='".$city."'");
		$province_code=get_perticular_field_value('zc_region_master','province_code'," and city_it='".mysql_real_escape_string($city_name)."'");
		
		$proptitle = stripslashes($typology_name)." in ".$name_it." a ".$city_name.", ".$province_code;
	}
	return stripslashes($proptitle);
}
function property_name($property_id){		
	$property_name="";
	$contract = "";
	$contract_id=get_perticular_field_value('zc_property_details','contract_id'," and property_id='".$property_id."'");
	$typology=get_perticular_field_value('zc_property_details','typology'," and property_id='".$property_id."'");
	$city=get_perticular_field_value('zc_property_details','city'," and property_id='".$property_id."'");
	
	if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
		$name=get_perticular_field_value('zc_contract_types','name'," and contract_id='".$contract_id."'");
		$typology_name=get_perticular_field_value('zc_typologies','name'," and typology_id='".$typology."'");
		$city_name=get_perticular_field_value('zc_city','city_name'," and city_id='".$city."'");
		$province_code=get_perticular_field_value('zc_region_master','province_code'," and city='".mysql_real_escape_string($city_name)."'");
		
		$proptitle = $name." For ".stripslashes($typology_name)." in ".$city_name.", ".$province_code;
	} else {
		$name_it=get_perticular_field_value('zc_contract_types','name_it'," and contract_id='".$contract_id."'");
		$typology_name=get_perticular_field_value('zc_typologies','name_it'," and typology_id='".$typology."'");
		$city_name=get_perticular_field_value('zc_city','city_name_it'," and city_id='".$city."'");
		$province_code=get_perticular_field_value('zc_region_master','province_code'," and city_it='".mysql_real_escape_string($city_name)."'");
		
		$proptitle = stripslashes($typology_name)." in ".$name_it." a ".$city_name.", ".$province_code;
	}
	return stripslashes($proptitle);
}
function prop_url($property_id){
	$prop_det_url='';
	$contract_id=get_perticular_field_value('zc_property_details','contract_id'," and property_id='".$property_id."'");
	$typology=get_perticular_field_value('zc_property_details','typology'," and property_id='".$property_id."'");
	$city=get_perticular_field_value('zc_property_details','city'," and property_id='".$property_id."'");
	$provience=get_perticular_field_value('zc_property_details','provience'," and property_id='".$property_id."'");
	if($contract_id==1){
		$contract="Rent";
	}
	if($contract_id==2){
		$contract="Sell";
	}
	$prop_det_url.=$contract;
	$typology_name=get_perticular_field_value('zc_typologies','name'," and typology_id='".$typology."'");
	//$prop_det_url.='-'.trim($typology_name);
	$prop_det_url.='-'.trim($city);
	$prop_det_url.='-'.trim($provience);
	$prop_det_url.='-'.trim($property_id);
	return $prop_det_url;
}
function get_property_type($caterory_id){
	$cat_id='';
	$cat_id=$caterory_id;
	$search_title = "";
	if($cat_id=='6' || $cat_id=='7'){
		$search_title='Business';
	}
	if($cat_id=='1'){
		$search_title='Residential';
	}
	if($cat_id=='3'){
		$search_title='Rooms';
	}
	if($cat_id=='4'){
		$search_title='Land';
	}
	if($cat_id=='5'){
		$search_title='Vacations';
	}
	return $search_title;
}
function get_category_field_value( $cat_id =NULL){
	if($cat_id==NULL){
		return false;
	}
	$CI =& get_instance();
	$str="select `name`,`category_id`,`parent_id` from `zc_categories` where `category_id`='".trim($cat_id)."'";
	$result=$CI->db->query($str);
	if($result->num_rows()==0){
		return false;
	}
	$record = new stdClass;
	$record =  $result->first_row();
	if($record->parent_id==0){
		return $cat_id;
	}else{
		return get_category_field_value($record->parent_id);
	}
}
function get_field_value($tablename,$filedname,$where=""){
	$CI =& get_instance();
	$str="select ".$filedname." from ".$tablename." where 1=1 ".$where."";
	$query=$CI->db->query($str);
	$record = array();
	if($query->num_rows()>0){
		foreach($query->result_array() as $row){
			$record = $row;
		}
	}
	return $record;
}
function getLangLat($address) {
	$address = urlencode($address);
	$request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=" . $address . "&sensor=true";
	$xml = simplexml_load_file($request_url);
	if ($xml->status && $xml->status == "OK") {
		return $xml->result->geometry->location;
	} else {
		return (object) array('lat' => '', 'lng' => '');
	}
}	
function prop_image($property_id){
	$main_image=get_perticular_field_value('zc_property_img','file_name'," and property_id='".$property_id."' and img_type='main_image'");
	$img=$main_image;
	return $img;
}	
function prop_category($property_id){
	//$prop_det_url=($_COOKIE['lang']=='it'?'':'For ');
	$category_id=get_perticular_field_value('zc_property_details','category_id'," and property_id='".$property_id."'");
	$category_name=get_perticular_field_value('zc_categories',($_COOKIE['lang']=='it'?'name_it':'name')," and category_id='".$category_id."'");
	$typology=get_perticular_field_value('zc_property_details','typology'," and property_id='".$property_id."'");
	$luxury=get_perticular_field_value('zc_property_details','add_to_luxury'," and property_id='".$property_id."'");
	
	//$prop_det_url = ($category_id == '2'?($_COOKIE['lang']=='it'?'In ':'For '):'').ucfirst($category_name);
	if($category_id==6 || $category_id==7){
		$prop_det_url = ($_COOKIE['lang']=='it'?'Commerciale ':'Business ').', '.ucfirst($category_name);
	}else{
		$prop_det_url = ucfirst($category_name);
	}	
	//$typology_name=get_perticular_field_value('zc_typologies',($_COOKIE['lang']=='it'?'name_it':'name')," and typology_id='".$typology."'");
	//$prop_det_url.= ', '.trim($typology_name);
	$prop_det_url.= ($luxury == '1'?' | '.($_COOKIE['lang']=='it'?'Lusso':'Luxury'):'');
	
	return $prop_det_url;
}
function deleteNonEmptyDir($dir){
	if (is_dir($dir)){
		$objects = scandir($dir);
		foreach ($objects as $object){
			if($object != "." && $object != ".."){
				if (filetype($dir . "/" . $object) == "dir"){
					deleteNonEmptyDir($dir . "/" . $object);
				}else{
					unlink($dir . "/" . $object);
				}
			}
		}
		reset($objects);
		rmdir($dir);
	}
}
function watermark($pic_path){
	$CI =& get_instance();
	$CI -> load -> library('image_lib');
	$config['source_image'] = $pic_path;
	$config['wm_type'] = 'overlay';
	$config['wm_overlay_path'] = 'assets/images/zap_logo.png';//the overlay image
	$config['wm_opacity']=100;
	$config['wm_vrt_alignment'] = 'bottom';
	$config['wm_hor_alignment'] = 'left';
	$CI->image_lib->initialize($config);
	$CI->image_lib->watermark();
	$CI->image_lib->clear();
	return true;
}
function deleteZeroZeroFromNumber($number){
	if(substr($number, -3)==',00'){
		$number = substr($number, 0, (strlen($number) - 3));
	}
	return $number;
}
function percentage($original_price,$update_price){
	$result=(($update_price-$original_price)/$original_price)*100;
	$number = number_format($result,2,".","");
	$numberData = explode(".",$number);
	if($numberData[1]>'49'){
		$result = $numberData[0] + 1;
	}else{
		$result = $numberData[0];
	}
	$number = number_format($result,2,",",".");
	return deleteZeroZeroFromNumber($number);
}
function show_price($prop_price){
	//return $show_price=number_format($prop_price, 2, ',', '.');
	$number = number_format($prop_price, 2, ",", ".");
	return deleteZeroZeroFromNumber($number);
}
function get_random_password($l = 8, $c = 1, $n = 1, $s = 1) {
	// get count of all required minimum special chars
	$count = $c + $n + $s;
	// all inputs clean, proceed to build password
	// change these strings if you want to include or exclude possible password characters
	$chars = "abcdefghijklmnopqrstuvwxyz";
	$caps = strtoupper($chars);
	$nums = "0123456789";
	$syms = "!?$%^&-";
	// build the base password of all lower-case letters
	for($i = 0; $i < $l; $i++) {
		$out .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
	}
	// create arrays if special character(s) required
	if($count) {
		// split base password to array; create special chars array
		$tmp1 = str_split($out);
		$tmp2 = array();
		// add required special character(s) to second array
		for($i = 0; $i < $c; $i++) {
			array_push($tmp2, substr($caps, mt_rand(0, strlen($caps) - 1), 1));
		}
		for($i = 0; $i < $n; $i++) {
			array_push($tmp2, substr($nums, mt_rand(0, strlen($nums) - 1), 1));
		}
		for($i = 0; $i < $s; $i++) {
			array_push($tmp2, substr($syms, mt_rand(0, strlen($syms) - 1), 1));
		}
		// hack off a chunk of the base password array that's as big as the special chars array
		$tmp1 = array_slice($tmp1, 0, $l - $count);
		// merge special character(s) array with base password array
		$tmp1 = array_merge($tmp1, $tmp2);
		// mix the characters up
		shuffle($tmp1);
		// convert to string for output
		$out = implode('', $tmp1);
	}
	return $out;
}
function send_mail( $details = array() ){
	//pre($details);die;
    $CI =& get_instance();
    $CI->load->library('email'); // load library
    $config = Array(
        'protocol' => 'mail', //mail, sendmail, smtp
        //'smtp_host' => 'ssl://smtp.gmail.com',
        //'smtp_port' => 465,
        //'smtp_user' => 'aditya.arbsoft@gmail.com',
        //'smtp_pass' => 'P@ssw0rd1234',
        'mailtype'  => 'html', 
        'charset'   => 'utf-8' // utf-8, iso-8859-1
    );
    $CI->email->initialize($config);
	$CI->email->set_newline("\r\n");
    $CI->email->from( $details['from'], 'no-reply@zapcasa.it' );
    $CI->email->to( $details['to'] ); 
    $CI->email->subject( $details['subject']);
    $CI->email->message( $details['message']);
    if ($CI->email->send()){
		//echo 'Your email was sent, thanks chamil.';
    } else {
        show_error($CI->email->print_debugger());
	}
    return true;
}
function CreateNewRefToken($id,$typo){
	return strtoupper(($typo=='Rent'?'R':'S').substr(md5($id),0,17));
}
function force_download( $filename = '', $data = '' ){
	//echo $data;die;
	if( $filename == '' || $data == '' ){
		return false;
	}
	if( !file_exists( $data ) ){
		return false;
	}
	// Try to determine if the filename includes a file extension.
	// We need it in order to set the MIME type
	if( false === strpos( $filename, '.' ) ){
		return false;
	}
	// Grab the file extension
	$extension = strtolower( pathinfo( basename( $filename ), PATHINFO_EXTENSION ) );
	// our list of mime types
	$mime_types = array(
		'txt' => 'text/plain',
		'htm' => 'text/html',
		'html' => 'text/html',
		'php' => 'text/html',
		'css' => 'text/css',
		'js' => 'application/javascript',
		'json' => 'application/json',
		'xml' => 'application/xml',
		//'swf' => 'application/x-shockwave-flash',
		'flv' => 'video/x-flv',
		'wmv' => 'video/x-ms-wmv',
		'mp4' => 'video/mp4',
		'3gp' => 'video/3gpp',

		// images
		'png' => 'image/png',
		'jpe' => 'image/jpeg',
		'jpeg' => 'image/jpeg',
		'jpg' => 'image/jpeg',
		'gif' => 'image/gif',
		'bmp' => 'image/bmp',
		'ico' => 'image/vnd.microsoft.icon',
		'tiff' => 'image/tiff',
		'tif' => 'image/tiff',
		'svg' => 'image/svg+xml',
		'svgz' => 'image/svg+xml',
		// archives
		'zip' => 'application/zip',
		'rar' => 'application/x-rar-compressed',
		'exe' => 'application/x-msdownload',
		'msi' => 'application/x-msdownload',
		'cab' => 'application/vnd.ms-cab-compressed',
		// audio/video
		'mp3' => 'audio/mpeg',
		'qt' => 'video/quicktime',
		'mov' => 'video/quicktime',
		// adobe
		'pdf' => 'application/pdf',
		'psd' => 'image/vnd.adobe.photoshop',
		'ai' => 'application/postscript',
		'eps' => 'application/postscript',
		'ps' => 'application/postscript',
		// ms office
		'doc' => 'application/msword',
		'rtf' => 'application/rtf',
		'xls' => 'application/vnd.ms-excel',
		'ppt' => 'application/vnd.ms-powerpoint',
		// open office
		'odt' => 'application/vnd.oasis.opendocument.text',
		'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
	);
	// Set a default mime if we can't find it
	if( !isset( $mime_types[$extension] ) ){
		$mime = 'application/octet-stream';
	}else{
		$mime = ( is_array( $mime_types[$extension] ) ) ? $mime_types[$extension][0] : $mime_types[$extension];
	}
	// Generate the server headers
	if( strstr( $_SERVER['HTTP_USER_AGENT'], "MSIE" ) ){
		header( 'Content-Type: "'.$mime.'"' );
		header( 'Content-Disposition: attachment; filename="'.$filename.'"' );
		header( 'Expires: 0' );
		header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
		header( "Content-Transfer-Encoding: binary" );
		header( 'Pragma: public' );
		header( "Content-Length: ".filesize( $data ) );
	}else{
		header( "Pragma: public" );
		header( "Expires: 0" );
		header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
		header( "Cache-Control: private", false );
		header( "Content-Type: ".$mime, true, 200 );
		header( 'Content-Length: '.filesize( $data ) );
		header( 'Content-Disposition: attachment; filename='.$filename);
		header( "Content-Transfer-Encoding: binary" );
	}
	readfile( $data );
	exit;
}
function get_Adjusted_TypologyID_asArray($categoryCode){
	$CI =& get_instance();
	$str="SELECT `typology_id` FROM `zc_typologies` WHERE FIND_IN_SET('".$categoryCode."',`category_code`)";
	$query=$CI->db->query($str);
	$record = array();
	if($query->num_rows()>0){
		foreach($query->result_array() as $row){
			$record[] = $row['typology_id'];
		}
	}
	return $record;
}
function get_nearby_area($category){
	$CI =& get_instance();
	$data = array();
	$sql="SELECT * FROM `zc_nearbyproperty_details` WHERE `status`=1 AND `category_id`='".$category."'";
	$query=$CI->db->query($sql);
	if($query->num_rows()>0){
		$data = $query->result_array();
	}
	return $data;
}
function geoDistance($lat1, $lng1, $lat2, $lng2, $miles = true){
	$pi80 = M_PI / 180;
	$lat1 *= $pi80;
	$lng1 *= $pi80;
	$lat2 *= $pi80;
	$lng2 *= $pi80;
	// mean radius of Earth in km
	$r = 6372.797;
	$dlat = $lat2 - $lat1;
	$dlng = $lng2 - $lng1;
	$a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
	$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
	$km = $r * $c;
	return ($miles ? ($km * 0.621371192) : $km);
}
?>