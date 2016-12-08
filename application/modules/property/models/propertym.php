<?php 
class propertym extends CI_Model {
    //put your code here
    public function __construct() {
        parent::__construct();
		ini_set('memory_limit', '-1'); 
    }
	public function getProeprtiesByFilter($filters='',$startpoint,$perpage){		
		$for_business = $filters['for_business'];
		$for_luxury = $filters['for_luxury'];		
		//echo "<pre>"; print_r($filters);
		$where = '';
		if($filters['category_id'] != '') {
			$cat_id = $filters['category_id'];
			if($cat_id != '10'){
				if($filters['parent_id'] == "0"){
					$where.=" AND (zc_property_details.category_id in (select category_id from zc_categories where parent_id =".$cat_id.") or zc_property_details.category_id in (".$cat_id.")) ";
				}else{
					$where.=" AND zc_property_details.category_id = ".$cat_id;
				}
			}else{
				 //$where.=" AND add_to_luxury='1' ";
				 $where.=" AND zc_property_details.category_id in (1, 5, 6, 7) ";
			}
		}
		if($filters['contract_type'] != '' && $filters['contract_type'] != 'all') {
			$where.=" AND zc_property_details.contract_id = ".$filters['contract_type'];
		}
		if($filters['posted_by'] != '' && $filters['posted_by'] != 'all') {
			$where.=" AND zc_property_details.property_post_by_type = ".$filters['posted_by'];
		}
		if($filters['status'] != '' && $filters['status'] != 'all') {
			$status='';
			foreach($filters['status'] as $key=>$val){
				$status.=','.$val;
			}
			$status=ltrim($status,',');
			$where.=" AND zc_property_details.status in (".$status.") ";
		}
		
		if($filters['min_price'] == ''){
			$min_price='0';
		}else{
			$min_price=str_replace(".","",$filters['min_price']);
			$min_price=str_replace(",",".",$min_price);			
		}
		if($filters['max_price'] == ''){
			$max_price = '0';
		}else{			
			$max_price=str_replace(".","",$filters['max_price']);
			$max_price=str_replace(",",".",$max_price);
		}
		if($min_price != "0" && $max_price == '0'){
			$where.=" AND zc_property_details.price >= '".$min_price."'";
		}
		if($max_price != "0" && $min_price == '0'){
			$where.=" AND zc_property_details.price <= '".$max_price."'";
		}
		if($min_price != "0" && $max_price != '0'){
			$where.=" AND zc_property_details.price BETWEEN '".$min_price."' AND '".$max_price."' ";
		}
		if($filters['min_room'] == ''){
			$min_room='0';
		}else{
			$min_room=$filters['min_room'];
		}
		if($filters['max_room'] == ''){
			$max_room = '0';
		}else{
			$max_room = $filters['max_room'];
		}
		if($min_room != "0" && $max_room == '0'){
			$where.=" AND zc_property_details.room_no >= '".$min_room."'";
		}
		if($max_room != "0" && $min_room == '0'){
			$where.=" AND zc_property_details.room_no <= '".$max_room."'";
		}
		if($min_room != "0" && $max_room != '0'){
			$where.=" AND zc_property_details.room_no BETWEEN '".$min_room."' AND '".$max_room."' ";
		}
		if(!empty($filters['typology'])) {
			$typology='';
			foreach($filters['typology'] as $key=>$val){
				$typology.=','.$val;
			 }
			 $typology=ltrim($typology,',');			 
			 $where.=(($typology!='')?" AND zc_property_details.typology IN (".$typology.")":"");
		}
		if($filters['bathrooms_no']!='' && $filters['bathrooms_no']!='all') {
		  $where.=" AND zc_property_details.bathrooms_no='".$filters['bathrooms_no']."'";
		}
		if($filters['min_surface_area'] !='' || $filters['max_surface_area'] !='' ) {
			if($filters['min_surface_area']=='') {
				$min_surface_area='0';
			} else {
				$min_surface_area=$filters['min_surface_area'];
			}
			if($filters['max_surface_area']=='') {
				$max_surface_area = '0';
			} else {
				$max_surface_area=$filters['max_surface_area'];
			}
			if( $max_surface_area == '0' && $min_surface_area !='0' ) {
				$where.=" AND zc_property_details.surface_area >= '".$min_surface_area."'";
			} else {
				$where.=" AND zc_property_details.surface_area >= '".$min_surface_area."' AND zc_property_details.surface_area <= '".$max_surface_area."'";
			}
		}
		if($filters['min_beds_no'] !='' || $filters['max_beds_no'] !='' ) {
			if($filters['min_beds_no'] == '') {
				$min_beds_no = '0';
			} else {
				$min_beds_no = $filters['min_beds_no'];
			}
			if($filters['max_beds_no']=='') {
				$max_beds_no = '0';
			} else {
				$max_beds_no=$filters['max_beds_no'];
			}
			if( $max_beds_no == '0' && $min_beds_no !='0' ) {
				$where.=" AND zc_property_details.beds_no >= '".$min_beds_no."'";
			} else {
				$where.=" AND zc_property_details.beds_no >= '".$min_beds_no."' AND zc_property_details.beds_no <= '".$max_beds_no."'";
			}
		}
		if($filters['kind']!='' && $filters['kind']!='all') {
			  $where.=" AND zc_property_details.kind='".$filters['kind']."'";
		}
		if($filters['energyclass']!='' && $filters['energyclass']!='all'){
			$where.=" AND ".($filters['energyclass']=='0'?"(zc_property_details.energyclass='' OR zc_property_details.energyclass='0')":"zc_property_details.energyclass='".$filters['energyclass']."'");
		}
		if($filters['heating']!='' && $filters['heating']!='all'){
			$where.=" AND zc_property_details.heating='".$filters['heating']."'";
		}
		if($filters['parking']!='' && $filters['parking']!='all'){
			$where.=" AND zc_property_details.parking='".$filters['parking']."'";
		}
		if($filters['furnished']!='' && $filters['furnished']!='all'){
			$where.=" AND zc_property_details.furnished='".$filters['furnished']."'";
		}
		if($filters['roommates']!='' && $filters['roommates']!='all'){
			$where.=" AND zc_property_details.roommates='".$filters['roommates']."'";
		}
		if($filters['occupation']!='' && $filters['occupation']!='all'){
			$where.=" AND zc_property_details.occupation='".$filters['occupation']."'";
		}
		if($filters['smokers']!='' && $filters['smokers']!='all'){
			$where.=" AND zc_property_details.smokers='".$filters['smokers']."'";
		}
		if($filters['pets']!='' && $filters['pets']!='all'){
			$where.=" AND zc_property_details.pets='".$filters['pets']."'";
		}
		if($filters['elevator']!=''){
			$where.=" AND zc_property_details.elevator='1'";
		}
		if($filters['air_conditioning']!=''){
			$where.=" AND zc_property_details.air_conditioning='1'";
		}
		if($filters['garden']!=''){
			$where.=" AND zc_property_details.garden='1'";
		}
		if($filters['terrace']!=''){
			$where.=" AND zc_property_details.terrace='1'";
		}
		if($filters['balcony']!=''){
			$where.=" AND zc_property_details.balcony='1'";
		}

		if($filters['location'] != ''){
			$location = $filters['location'];
			$street = $location;
			$area = $location;
			$city = $location;
			$provience = $location;
			$provience_code = $location;
			$country = $location;
			$zip = $location;
			$poplocationeng = $location;
			$poplocationit = $location;
			$list = explode(", ", $location);
			//echo "<pre>"; print_r($list);exit;
			//$val = $arrData->city.", ".$arrData->province_name.", ".$arrData->province_code.", ".$arrData->name;
			//echo "====".count($list);
			if(count($list) > 4){
				if(isset($list[0]) && $list[0] != ''){
					$street = $list[0];
					$area = $list[0];
				}
				if(isset($list[1]) && $list[1] != ''){
					$city = $list[1];
				}
				if(isset($list[2]) && $list[2] != ''){
					$provience_code = $list[2];
				}
				if(isset($list[3]) && $list[3] != ''){
					$zip = $list[3];
				}
				if(isset($list[4]) && $list[4] != ''){
					$country = $list[4];
				}
				$StreetOperatorSQL = 'OR';
				$CityOperatorSQL = 'AND';
				$ProvienceOperatorSQL = 'AND';
				$ZipOperatorSQL = 'AND';
			}elseif(count($list) == 4){
				if(isset($list[0]) && $list[0] != ''){
					$street = $list[0];
					$area = $list[0];
				}
				if(isset($list[1]) && $list[1] != ''){
					$city = $list[0];
				}
				if(isset($list[2]) && $list[2] != ''){
					$provience_code = $list[1];
				}
				if(isset($list[3]) && $list[3] != ''){
					$zip = $list[2];
				}
				if(isset($list[4]) && $list[4] != ''){
					$country = $list[4];
				}
				$StreetOperatorSQL = 'AND';
				$CityOperatorSQL = 'AND';
				$ProvienceOperatorSQL = 'AND';
				$ZipOperatorSQL = 'OR';
			}else if(count($list) == 3){
				if(isset($list[0]) && $list[0] != ''){
					$city = $list[0];
				}
				if(isset($list[1]) && $list[1] != ''){
					$provience_code = $list[1];
				}
				if(isset($list[2]) && $list[2] != ''){
					$zip = $list[2];
				}
				$StreetOperatorSQL = 'OR';
				$CityOperatorSQL = 'OR';
				$ProvienceOperatorSQL = 'AND';
				$ZipOperatorSQL = 'OR';
			}else{
				if(isset($list[0]) && $list[0] != ''){
					$city = $list[0];
				}
				if(isset($list[1]) && $list[1] != ''){
					$provience = $list[1];
				}
				if(isset($list[2]) && $list[2] != ''){
					$provience_code = $list[2];
				}
				if(isset($list[3]) && $list[3] != ''){
					$country = $list[3];
				}
				$StreetOperatorSQL = 'OR';
				$CityOperatorSQL = 'OR';
				$ProvienceOperatorSQL = 'OR';
				$ZipOperatorSQL = 'OR';
			}
			if(!strpos($area, "'")===false){
				$area = str_replace("'","\\\\'",$area);
			}
			if(!strpos($street, "'")===false){
				$street = str_replace("'","\\\\'",$street);
			}
			if(!strpos($city, "'")===false){
				$city = str_replace("'","\\\\'",$city);
			}
			$where.=" AND (";
			$where.=" zc_property_details.zip like '%".mysql_real_escape_string($zip)."%'";
			$where.=" ".$ZipOperatorSQL." zc_property_details.area like '%".mysql_real_escape_string($area)."%'";
			$where.=" ".$StreetOperatorSQL." zc_property_details.street_address like '%".mysql_real_escape_string($street)."%'";
			$where.=" ".$CityOperatorSQL." zc_property_details.city in (select city_id from zc_city where city_name in (select city from zc_region_master where city like '%".mysql_real_escape_string($city)."%' or city_it like '%".mysql_real_escape_string($city)."%' or province_name like '%".mysql_real_escape_string($city)."%' or province_name_it like '%".mysql_real_escape_string($city)."%'))";
			//$where.=" ".$ProvienceOperatorSQL." zc_property_details.provience in (SELECT `zc_provience`.`provience_id` FROM `zc_region_master` INNER JOIN `zc_provience` ON (`zc_region_master`.`province_name`=`zc_provience`.`provience_name` AND `zc_region_master`.`province_name_it`=`zc_provience`.`provience_name_it`) WHERE `zc_region_master`.`province_code` like '%".mysql_real_escape_string($provience_code)."%')";
			$where.=" )";
			//$str.=" AND city Like'%".$filters['location']."%' or zip Like'%".$filters['location']."%' or provience Like'%".$filters['location']."%'";
		}
		
		$orderby = '';
		$featuredProperties = array();
		$featured_property = get_featured_property();		
		if(count($featured_property)>0){
			foreach($featured_property as $property_featured_detail){
				$featuredProperties[] = $property_featured_detail['property_id'];
			}
			$featuredPropertySQL = implode(",",$featuredProperties);
			$orderby = 'FIELD(zc_property_details.property_id,'.$featuredPropertySQL.') DESC, ';
		}
		
		if($filters['order_option'] == ''){
			$orderby.= ' posting_time DESC';
		}if($filters['order_option'] == 'order_high_price'){
			$orderby.= ' `price` DESC'; 
		} if($filters['order_option'] == 'order_low_price'){
			$orderby.= ' `price` ASC'; 
		}
		if($filters['order_option'] == 'order_latest'){
			$orderby.= ' `posting_time` DESC'; 
		}
		
		//$sql = "select zc_property_details.*, zc_property_img.file_name as main_img, zc_contract_types.*, zc_typologies.typology_id, zc_typologies.name as typology_name, zc_city.*, zc_region_master.Province_Code from zc_property_details left join zc_property_img on zc_property_details.property_id = zc_property_img.property_id left join zc_contract_types on zc_property_details.contract_id = zc_contract_types.contract_id left join zc_typologies on zc_property_details.typology = zc_typologies.typology_id left join zc_city on zc_property_details.city = zc_city.city_id left join zc_provience on zc_property_details.provience = zc_provience.provience_id left join zc_region_master on zc_provience.provience_name = zc_region_master.Province_Name where zc_property_img.img_type = 'main_image' ".$where;
		$blockedUserIdSQL = "";
		$blockedUserId = get_field_value("zc_user","GROUP_CONCAT(`user_id` SEPARATOR ',') AS blocked_user","AND `status`='0'");
		if(!empty($blockedUserId) && $blockedUserId['blocked_user']!=''){
			$blockedUserIdSQL.= " AND zc_property_details.property_post_by NOT IN (".$blockedUserId['blocked_user'].")";
		}
		$UserActiveSql = " JOIN zc_user as u ON (zc_property_details.property_post_by = u.user_id) ";
		$UserActiveWhere = " AND u.status='1'  ";
		$sql = "select zc_property_details.*, zc_property_img.file_name as main_img, zc_contract_types.contract_id, zc_contract_types.name, zc_contract_types.name_it, zc_contract_types.short_code, zc_contract_types.desc, zc_typologies.typology_id, zc_typologies.name as typology_name, zc_typologies.name_it as typology_name_it, zc_city.city_id, zc_city.country_id, zc_city.city_name, zc_city.city_name_it, zc_region_master.province_code, zc_provience.provience_name, zc_provience.provience_name_it from zc_property_details left join zc_property_img on zc_property_details.property_id = zc_property_img.property_id left join zc_contract_types on zc_property_details.contract_id = zc_contract_types.contract_id left join zc_typologies on zc_property_details.typology = zc_typologies.typology_id left join zc_city on zc_property_details.city = zc_city.city_id left join zc_provience on zc_property_details.provience = zc_provience.provience_id left join zc_region_master on zc_city.city_name = zc_region_master.city " . $UserActiveSql . " where zc_property_img.img_type = 'main_image' " . $UserActiveWhere . ' ' . $where . " AND `zc_typologies`.`status`='active' AND property_approval='1' AND suspention_status='0' " . $blockedUserIdSQL . " ORDER BY " . $orderby . " LIMIT " . $startpoint . ", " . $perpage;
		if($filters['category_id'] == 10)
		{
			$sql = "select zc_property_details.*, zc_property_img.file_name as main_img, zc_contract_types.contract_id, zc_contract_types.name, zc_contract_types.name_it, zc_contract_types.short_code, zc_contract_types.desc, zc_typologies.typology_id, zc_typologies.name as typology_name, zc_typologies.name_it as typology_name_it, zc_city.city_id, zc_city.country_id, zc_city.city_name, zc_city.city_name_it, zc_region_master.province_code, zc_provience.provience_name, zc_provience.provience_name_it from zc_property_details left join zc_property_img on zc_property_details.property_id = zc_property_img.property_id left join zc_contract_types on zc_property_details.contract_id = zc_contract_types.contract_id left join zc_typologies on zc_property_details.typology = zc_typologies.typology_id left join zc_city on zc_property_details.city = zc_city.city_id left join zc_provience on zc_property_details.provience = zc_provience.provience_id left join zc_region_master on zc_city.city_name = zc_region_master.city " . $UserActiveSql . " where zc_property_details.add_to_luxury='1' AND zc_property_details.category_id IN (1,2,5,6) AND zc_property_img.img_type = 'main_image' " . $UserActiveWhere . ' ' . $where . " AND `zc_typologies`.`status`='active' AND property_approval='1' AND suspention_status='0' " . $blockedUserIdSQL . " ORDER BY " . $orderby . " LIMIT " . $startpoint . ", " . $perpage;
		}
		$row = $this->db->query($sql);
		if($row->num_rows() > 0){
			$result = $row->result();
			if($filters['location'] != ''){
				$street_address = $result[0]->street_address;
				$street_no = $result[0]->street_no;
				$neighborhood = $result[0]->area;
				$zip = $result[0]->zip;
				$typology = $result[0]->typology;
				$city = $result[0]->city;
				$provience = $result[0]->provience;
				$country = $result[0]->country_id;
				if($for_business=='' AND $for_luxury==''){
					$qry1 = "select * from zc_popular_search where (ps_type = 'property_filter' || ps_type = 'property') and (for_business = '".$for_business."' AND for_luxury = '".$for_luxury."') and typology = '".$typology."' and ps_city = ".$city." and ps_provience = ".$provience." and ps_start_date <= now() and ps_end_date >= now() and ps_status = '1'";
				}else{
					$qry1 = "select * from zc_popular_search where (ps_type = 'property_filter' || ps_type = 'property') and (for_business = '".$for_business."' || for_luxury = '".$for_luxury."') and typology = '".$typology."' and ps_city = ".$city." and ps_provience = ".$provience." and ps_start_date <= now() and ps_end_date >= now() and ps_status = '1'";
				}
				//echo "====".$qry1;
				$row1 = $this->db->query($qry1);
				if($row1->num_rows() > 0){
					$result1 = $row1->result();
					$view = ($result1[0]->ps_views + 1);
					$arrVal['ps_views'] = $view;
					$this->db->where('ps_id', $result1[0]->ps_id);
					$this->db->update('zc_popular_search', $arrVal);
				}else {
					if($for_business=='' AND $for_luxury==''){
						$qry2 = "select * from zc_popular_search where ps_keyword = '".mysql_real_escape_string($filters['location'])."' and (ps_type = 'property_filter' || ps_type = 'property') and (for_business = '".$for_business."' AND for_luxury = '".$for_luxury."') and typology = '".$typology."' and ps_city = ".$city." and ps_provience = ".$provience." and ps_status = '1'";
					}else{
						$qry2 = "select * from zc_popular_search where ps_keyword = '".mysql_real_escape_string($filters['location'])."' and (ps_type = 'property_filter' || ps_type = 'property') and (for_business = '".$for_business."' || for_luxury = '".$for_luxury."') and typology = '".$typology."' and ps_city = ".$city." and ps_provience = ".$provience." and ps_status = '1'";
					}
					//echo "====".$qry2;
					$row2 = $this->db->query($qry2);
					if($row2->num_rows() > 0){
						$result2 = $row2->result();
						$this->db->where('ps_id', $result2[0]->ps_id);
						$this->db->delete('zc_popular_search');
					}
					if(count($list) > 4){
						//$poplocationeng = $street.", ".$result[0]->city_name.", ".$provience_code.", ".$zip.", Italy";
						//$poplocationit = $street.", ".$result[0]->city_name_it.", ".$provience_code.", ".$zip.", Italia";
						$poplocationeng = $result[0]->city_name.", ".$provience_code.", Italy";
						$poplocationit = $result[0]->city_name_it.", ".$provience_code.", Italia";
					}else{
						$poplocationeng = $result[0]->city_name.", ".$provience_code.", Italy";
						$poplocationit = $result[0]->city_name_it.", ".$provience_code.", Italia";
					}

					$qry = "insert into zc_popular_search set 
					ps_type = 'property',
					ps_keyword = '".mysql_real_escape_string($filters['location'])."',
					ps_url = '".$_SERVER['REQUEST_URI']."',
					ps_start_date = now(),
					ps_end_date = date_add(now(), INTERVAL +7 day),
					ps_views = '1',
					ps_created_on = now(),
					category_id = '".$filters['category_id']."',
					contract_type = '".$filters['contract_type']."',
					ps_street = '".$street_address."',
					ps_street_no = '".$street_no."',
					ps_zip = '".$zip."',
					ps_neighborhood = '".$neighborhood."',
					for_business = '".$for_business."',
					for_luxury = '".$for_luxury."',
					typology = '".$typology."',
					posted_by = '".$filters['posted_by']."',
					location_en = '".addslashes($poplocationeng)."',
					location_it = '".addslashes($poplocationit)."',
					ps_city = ".$city.",
					ps_provience = ".$provience.",
					ps_country = ".$country."";
					$this->db->query($qry);
				}
			}
			
			return $result;
        }else{
			return 0;
        }
	}
	public function get_typology_list($lang){
		
		//echo "=====".$lang;
		
		
		$this->db->select('name,name_it,typology_id');
		$cond=array('status'=>'active');
		$this->db->where($cond);
		$query=$this->db->get("zc_typologies");
		
		$result=array();
		$count=0;
		foreach($query->result() as $row){
			if( isset($lang) && $lang == "english" ) {
				$result[$row->typology_id]=$row->name;
			}else{
				$result[$row->typology_id]=$row->name_it;
			}
		}
		return $result;
	}
	public function getLocations($loc,$lang){
		$_COOKIE['lang'] = $lang;
		$data = array();
		$apostrophePresent = false;
		if(!strpos($loc, "'")===false){
			$loc = str_replace("'","\\\\'",$loc);
			$apostrophePresent = true;
		}		
		$LocationString = explode(',',$loc);
		$NoEleLoc = count($LocationString);
		switch($NoEleLoc){
			case '5':
				$StreetAddressSQL = ($LocationString[0]!=''?"`street_address` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"").($LocationString[1]!=''?" AND `city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"").($LocationString[2]!=''?" AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[2],' '),' '))."%'":"").($LocationString[3]!=''?" AND `zip` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[3],' '),' '))."%'":"");
				$AreaLocationSQL = ($LocationString[0]!=''?"`area` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"").($LocationString[1]!=''?" AND `city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"").($LocationString[2]!=''?" AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[2],' '),' '))."%'":"").($LocationString[3]!=''?" AND `zip` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[3],' '),' '))."%'":"");
				$CityCodeSQL = ($LocationString[0]!=''?"(`city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%' OR `city_name_it` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%') AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"");
				$ZipCodeSQL = ($LocationString[0]!=''?"`zip` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				break;
			case '4':
				$StreetAddressSQL = ($LocationString[0]!=''?"`street_address` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"").($LocationString[1]!=''?" AND `city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"").($LocationString[2]!=''?" AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[2],' '),' '))."%'":"").($LocationString[3]!=''?" AND `zip` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[3],' '),' '))."%'":"");
				$AreaLocationSQL = ($LocationString[0]!=''?"`area` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"").($LocationString[1]!=''?" AND `city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"").($LocationString[2]!=''?" AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[2],' '),' '))."%'":"").($LocationString[3]!=''?" AND `zip` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[3],' '),' '))."%'":"");
				$CityCodeSQL = ($LocationString[0]!=''?"(`city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%' OR `city_name_it` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%') AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"");
				$ZipCodeSQL = ($LocationString[0]!=''?"`zip` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				break;
			case '3':
				$StreetAddressSQL = ($LocationString[0]!=''?"`street_address` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"").($LocationString[1]!=''?" AND `city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"").($LocationString[2]!=''?" AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[2],' '),' '))."%'":"");
				$AreaLocationSQL = ($LocationString[0]!=''?"`area` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"").($LocationString[1]!=''?" AND `city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"").($LocationString[2]!=''?" AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[2],' '),' '))."%'":"");
				$CityCodeSQL = ($LocationString[0]!=''?"(`city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%' OR `city_name_it` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%') AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"");
				$ZipCodeSQL = ($LocationString[0]!=''?"`zip` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				break;
			case '2':
				$StreetAddressSQL = ($LocationString[0]!=''?"`street_address` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"").($LocationString[1]!=''?" AND `city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"");
				$AreaLocationSQL = ($LocationString[0]!=''?"`area` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"").($LocationString[1]!=''?" AND `city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"");
				$ZipCodeSQL = ($LocationString[0]!=''?"`zip` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				$CityCodeSQL = ($LocationString[0]!=''?"(`city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%' OR `city_name_it` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%') AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"");
				break;
			case '1':
				$StreetAddressSQL = ($LocationString[0]!=''?"`street_address` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				$AreaLocationSQL = ($LocationString[0]!=''?"`area` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				$CityCodeSQL = ($LocationString[0]!=''?"`city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%' OR `city_name_it` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				$ZipCodeSQL = ($LocationString[0]!=''?"`zip` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				break;
			default:
				$StreetAddressSQL = ($LocationString[0]!=''?"`street_address` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				$AreaLocationSQL = ($LocationString[0]!=''?"`area` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				$CityCodeSQL = ($LocationString[0]!=''?"`city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%' OR `city_name_it` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				$ZipCodeSQL = ($LocationString[0]!=''?"`zip` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				break;
		}
		/*	City Name With Property	*/
		$sql4 = "SELECT `zc_property_details`.`street_address`, `zc_property_details`.`zip`, `zc_property_details`.`area`, `zc_city`.*, `zc_region_master`.*, `zc_country_master`.* FROM `zc_property_details` LEFT JOIN `zc_city` ON `zc_city`.`city_id` = `zc_property_details`.`city` LEFT JOIN `zc_provience` ON `zc_provience`.`provience_id` = `zc_property_details`.`provience` LEFT JOIN `zc_region_master` ON `zc_region_master`.`city` = `zc_city`.`city_name` LEFT JOIN `zc_country_master` ON `zc_country_master`.`id_countries` = `zc_provience`.`country_id` WHERE ".$CityCodeSQL." ORDER BY `zc_city`.".($_COOKIE['lang'] == "english"?"`city_name`":"`city_name_it`")." ASC";
		$res4 = $this->db->query($sql4);
		if($res4->num_rows() > 0){
			$row4 = $res4->result();
			foreach($row4 as $arrData) {
				if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
					$val = $arrData->city.", ".$arrData->province_code.", Italy";
				}else{
					$val = $arrData->city_it.", ".$arrData->province_code.", Italia";
				}
				$data[] = $val;
			}
		}
		/*	City Name Only	*/
		$sql5 = "SELECT `zc_region_master`.*,`zc_country_master`.* FROM `zc_region_master` LEFT JOIN `zc_provience` ON `zc_provience`.`provience_name` = `zc_region_master`.`province_name` LEFT JOIN `zc_country_master` ON `zc_country_master`.`id_countries` = `zc_provience`.`country_id` WHERE (`city` LIKE '".mysql_real_escape_string($loc)."%' OR `city_it` LIKE '".mysql_real_escape_string($loc)."%') GROUP BY `zc_region_master`.`province_code` ORDER BY `zc_region_master`.".($_COOKIE['lang'] == "english"?"`city`":"`city_it`")." ASC";
		$res5 = $this->db->query($sql5);
		if($res5->num_rows() > 0){
			$row5 = $res5->result();
			foreach($row5 as $arrData) {
				if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
					$val = $arrData->city.", ".$arrData->province_code.", Italy";
				}else{
					$val = $arrData->city_it.", ".$arrData->province_code.", Italia";
				}
				$data[] = $val;
			}
		}
		/*	Street Address	*/
		$sql1 = "SELECT `zc_property_details`.`street_address`, `zc_property_details`.`zip`, `zc_property_details`.`area`, `zc_city`.*, `zc_region_master`.*, `zc_country_master`.* FROM `zc_property_details` LEFT JOIN `zc_city` ON `zc_city`.`city_id` = `zc_property_details`.`city` LEFT JOIN `zc_provience` ON `zc_provience`.`provience_id` = `zc_property_details`.`provience` LEFT JOIN `zc_region_master` ON `zc_region_master`.`city` = `zc_city`.`city_name` LEFT JOIN `zc_country_master` ON `zc_country_master`.`id_countries` = `zc_provience`.`country_id` WHERE ".$StreetAddressSQL." ORDER BY `zc_property_details`.`street_address` ASC";
		$res1 = $this->db->query($sql1);
		if($res1->num_rows() > 0){
			$row1 = $res1->result();
			foreach($row1 as $arrData) {
				if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
					$val = $arrData->street_address.", ".$arrData->city_name.", ".$arrData->province_code.", ".$arrData->zip.", Italy";
				}else{
					$val = $arrData->street_address.", ".$arrData->city_name_it.", ".$arrData->province_code.", ".$arrData->zip.", Italia";
				}
				$data[] = $val;
			}
		}
		/*	Area / Neighbourhood	*/
		$sql2 = "SELECT `zc_property_details`.`street_address`, `zc_property_details`.`zip`, `zc_property_details`.`area`, `zc_city`.*, `zc_region_master`.*, `zc_country_master`.* FROM `zc_property_details` LEFT JOIN `zc_city` ON `zc_city`.`city_id` = `zc_property_details`.`city` LEFT JOIN `zc_provience` ON `zc_provience`.`provience_id` = `zc_property_details`.`provience` LEFT JOIN `zc_region_master` ON `zc_region_master`.`city` = `zc_city`.`city_name` LEFT JOIN `zc_country_master` ON `zc_country_master`.`id_countries` = `zc_provience`.`country_id` WHERE ".$AreaLocationSQL." ORDER BY `zc_property_details`.`area` ASC";
		$res2 = $this->db->query($sql2);
		if($res2->num_rows() > 0){
			$row2 = $res2->result();
			foreach($row2 as $arrData) {
				if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
					$val = $arrData->area.", ".$arrData->city_name.", ".$arrData->province_code.", ".$arrData->zip.", Italy";
				}else{
					$val = $arrData->area.", ".$arrData->city_name_it.", ".$arrData->province_code.", ".$arrData->zip.", Italia";
				}
				$data[] = $val;
			}			
		}
		/*	Zip-Code	*/
		$sql3 = "SELECT `zc_property_details`.`street_address`, `zc_property_details`.`zip`, `zc_property_details`.`area`, `zc_city`.*, `zc_region_master`.*, `zc_country_master`.* FROM `zc_property_details` LEFT JOIN `zc_city` ON `zc_city`.`city_id` = `zc_property_details`.`city` LEFT JOIN `zc_provience` ON `zc_provience`.`provience_id` = `zc_property_details`.`provience` LEFT JOIN `zc_region_master` ON `zc_region_master`.`city` = `zc_city`.`city_name` LEFT JOIN `zc_country_master` ON `zc_country_master`.`id_countries` = `zc_provience`.`country_id` WHERE ".$ZipCodeSQL." ORDER BY `zc_property_details`.`zip` ASC";
		$res3 = $this->db->query($sql3);
		if($res3->num_rows() > 0){
			$row3 = $res3->result();
			foreach($row3 as $arrData) {
				if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
					$val = $arrData->city_name.", ".$arrData->province_code.", ".$arrData->zip.", Italy";
				}else{
					$val = $arrData->city_name_it.", ".$arrData->province_code.", ".$arrData->zip.", Italia";
				}
				$data[] = $val;
			}
		}
		/*
		$sql6 = "SELECT `zc_region_master`.*,`zc_country_master`.* FROM `zc_region_master` LEFT JOIN `zc_provience` ON `zc_provience`.`provience_name` = `zc_region_master`.`province_name` LEFT JOIN `zc_country_master` ON `zc_country_master`.`id_countries` = `zc_provience`.`country_id` WHERE (`province_name` LIKE '".mysql_real_escape_string($loc)."%' OR `province_name_it` LIKE '".mysql_real_escape_string($loc)."%') GROUP BY `zc_region_master`.`province_code`";
		$res6 = $this->db->query($sql6);
		if($res6->num_rows() > 0){
			$row6 = $res6->result();
			foreach($row6 as $arrData) {
				if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
					$val = $arrData->province_name.", ".$arrData->province_code.", Italy";
				}else{
					$val = $arrData->province_name_it.", ".$arrData->province_code.", Italia";
				}
				$data[] = $val;
			}			
		}
		*/
		return array_unique($data);
	}	
	public function getAdvLocations($loc,$lang){
		$_COOKIE['lang'] = $lang;
		$data = array();
		$apostrophePresent = false;
		if(!strpos($loc, "'")===false){
			$loc = str_replace("'","\\\\'",$loc);
			$apostrophePresent = true;
		}
		$LocationString = explode(',',$loc);
		$NoEleLoc = count($LocationString);
		switch($NoEleLoc){
			case '5':
				$StreetAddressSQL = ($LocationString[0]!=''?"`street_address` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"").($LocationString[1]!=''?" AND `city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"").($LocationString[2]!=''?" AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[2],' '),' '))."%'":"").($LocationString[3]!=''?" AND `zip` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[3],' '),' '))."%'":"");
				$AreaLocationSQL = ($LocationString[0]!=''?"`area` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"").($LocationString[1]!=''?" AND `city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"").($LocationString[2]!=''?" AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[2],' '),' '))."%'":"").($LocationString[3]!=''?" AND `zip` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[3],' '),' '))."%'":"");
				$CityCodeSQL = ($LocationString[0]!=''?"(`city` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%' OR `city_it` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%') AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"");
				$ProvinceCodeSQL = ($LocationString[0]!=''?"(`province_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%' OR `province_name_it` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%') AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"");
				$ZipCodeSQL = ($LocationString[0]!=''?"`zip` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				break;
			case '4':
				$StreetAddressSQL = ($LocationString[0]!=''?"`street_address` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"").($LocationString[1]!=''?" AND `city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"").($LocationString[2]!=''?" AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[2],' '),' '))."%'":"").($LocationString[3]!=''?" AND `zip` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[3],' '),' '))."%'":"");
				$AreaLocationSQL = ($LocationString[0]!=''?"`area` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"").($LocationString[1]!=''?" AND `city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"").($LocationString[2]!=''?" AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[2],' '),' '))."%'":"").($LocationString[3]!=''?" AND `zip` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[3],' '),' '))."%'":"");
				$CityCodeSQL = ($LocationString[0]!=''?"(`city` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%' OR `city_it` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%') AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"");
				$ProvinceCodeSQL = ($LocationString[0]!=''?"(`province_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%' OR `province_name_it` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%') AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"");
				$ZipCodeSQL = ($LocationString[0]!=''?"`zip` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				break;
			case '3':
				$StreetAddressSQL = ($LocationString[0]!=''?"`street_address` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"").($LocationString[1]!=''?" AND `city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"").($LocationString[2]!=''?" AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[2],' '),' '))."%'":"");
				$AreaLocationSQL = ($LocationString[0]!=''?"`area` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"").($LocationString[1]!=''?" AND `city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"").($LocationString[2]!=''?" AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[2],' '),' '))."%'":"");
				$CityCodeSQL = ($LocationString[0]!=''?"(`city` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%' OR `city_it` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%') AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"");
				$ProvinceCodeSQL = ($LocationString[0]!=''?"(`province_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%' OR `province_name_it` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%') AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"");
				$ZipCodeSQL = ($LocationString[0]!=''?"`zip` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				break;
			case '2':
				$StreetAddressSQL = ($LocationString[0]!=''?"`street_address` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"").($LocationString[1]!=''?" AND `city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"");
				$AreaLocationSQL = ($LocationString[0]!=''?"`area` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"").($LocationString[1]!=''?" AND `city_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"");
				$ZipCodeSQL = ($LocationString[0]!=''?"`zip` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				$CityCodeSQL = ($LocationString[0]!=''?"(`city` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%' OR `city_it` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%') AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"");
				$ProvinceCodeSQL = ($LocationString[0]!=''?"(`province_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%' OR `province_name_it` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%') AND `province_code` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"");
				break;
			case '1':
				$StreetAddressSQL = ($LocationString[0]!=''?"`street_address` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				$AreaLocationSQL = ($LocationString[0]!=''?"`area` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				$CityCodeSQL = ($LocationString[0]!=''?"`city` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%' OR `city_it` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				$ProvinceCodeSQL = ($LocationString[0]!=''?"`province_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%' OR `province_name_it` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				$ZipCodeSQL = ($LocationString[0]!=''?"`zip` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
			default:
				$StreetAddressSQL = ($LocationString[0]!=''?"`street_address` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				$AreaLocationSQL = ($LocationString[0]!=''?"`area` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				$CityCodeSQL = ($LocationString[0]!=''?"`city` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%' OR `city_it` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				$ProvinceCodeSQL = ($LocationString[0]!=''?"`province_name` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%' OR `province_name_it` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				$ZipCodeSQL = ($LocationString[0]!=''?"`zip` LIKE '".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");				
		}
		/************	Data For Advertiser	************/
		/*	City Name Only	*/
		$sql3 = "SELECT `zc_region_master`.*,`zc_country_master`.* FROM `zc_region_master` LEFT JOIN `zc_provience` ON `zc_provience`.`provience_name` = `zc_region_master`.`province_name` LEFT JOIN `zc_country_master` ON `zc_country_master`.`id_countries` = `zc_provience`.`country_id` WHERE (".$CityCodeSQL.") GROUP BY `province_code` ORDER BY `zc_region_master`.".($_COOKIE['lang'] == "english"?"`city`":"`city_it`")." ASC";
		$res3 = $this->db->query($sql3);
		if($res3->num_rows() > 0){
			$row3 = $res3->result();
			foreach($row3 as $arrData) {
				if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
					$val = $arrData->city.", ".$arrData->province_code.", Italy";
				}else{
					$val = $arrData->city_it.", ".$arrData->province_code.", Italia";
				}
				$data[] = $val;
			}
		}
		/*	Street Address	*/
		$sql1 = "SELECT `zc_user`.`street_address`, `zc_user`.`zip`, `zc_city`.*, `zc_region_master`.*, `zc_country_master`.* FROM `zc_user` LEFT JOIN `zc_city` ON `zc_city`.`city_name` = `zc_user`.`city` LEFT JOIN `zc_provience` ON `zc_provience`.`provience_name` = `zc_user`.`province` LEFT JOIN `zc_region_master` ON `zc_region_master`.`province_name` = `zc_provience`.`provience_name` LEFT JOIN `zc_country_master` ON `zc_country_master`.`id_countries` = `zc_provience`.`country_id` WHERE ".$StreetAddressSQL." GROUP BY `zc_region_master`.`province_code` ORDER BY `zc_user`.`street_address` ASC";
		$res1 = $this->db->query($sql1);
		if($res1->num_rows() > 0){
			$row1 = $res1->result();
			foreach($row1 as $arrData) {
				if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
					$val = $arrData->street_address.", ".$arrData->city_name.", ".$arrData->province_code.", ".$arrData->zip.", Italy";
				}else{
					$val = $arrData->street_address.", ".$arrData->city_name_it.", ".$arrData->province_code.", ".$arrData->zip.", Italia";
				}
				$data[] = $val;
			}			
		}
		/*	Zip-Code	*/
		$sql2 = "SELECT `zc_user`.`street_address`, `zc_user`.`zip`, `zc_city`.*, `zc_region_master`.*, `zc_country_master`.* FROM `zc_user` LEFT JOIN `zc_city` ON `zc_city`.`city_name` = `zc_user`.`city` LEFT JOIN `zc_provience` ON `zc_provience`.`provience_name` = `zc_user`.`province` LEFT JOIN `zc_region_master` ON `zc_region_master`.`province_name` = `zc_provience`.`provience_name` LEFT JOIN `zc_country_master` ON `zc_country_master`.`id_countries` = `zc_provience`.`country_id` WHERE ".$ZipCodeSQL." GROUP BY `zc_region_master`.`province_code` ORDER BY `zc_user`.`zip` ASC";
		$res2 = $this->db->query($sql2);
		if($res2->num_rows() > 0){
			$row2 = $res2->result();
			foreach($row2 as $arrData) {
				if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
					$val = $arrData->city_name.", ".$arrData->province_code.", ".$arrData->zip.", Italy";
				}else{
					$val = $arrData->city_name_it.", ".$arrData->province_code.", ".$arrData->zip.", Italia";
				}
				$data[] = $val;
			}			
		}
		/*
		$sql4 = "SELECT `zc_region_master`.*,`zc_country_master`.* FROM `zc_region_master` LEFT JOIN `zc_provience` ON `zc_provience`.`provience_name` = `zc_region_master`.`province_name` LEFT JOIN `zc_country_master` ON `zc_country_master`.`id_countries` = `zc_provience`.`country_id` WHERE (".$ProvinceCodeSQL.") GROUP BY `province_code`";
		$res4 = $this->db->query($sql4);
		if($res4->num_rows() > 0){
			$row4 = $res4->result();
			foreach($row4 as $arrData) {
				if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
					$val = $arrData->province_name.", ".$arrData->province_code.", Italy";
				}else{
					$val = $arrData->province_name_it.", ".$arrData->province_code.", Italia";
				}
				$data[] = $val;
			}			
		}
		*/
		return array_unique($data);
	}
	public function getAdvLocationsBackUp($loc,$lang){
		$_COOKIE['lang'] = $lang;
		$data = array();
		
		$LocationString = explode(',',$loc);
		$NoEleLoc = count($LocationString);
		switch($NoEleLoc){
			case '5':
				$StreetAddressSQL = ($LocationString[0]!=''?"`zc_user`.`street_address` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"").($LocationString[1]!=''?" AND `city_name` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"").($LocationString[2]!=''?" AND `province_code` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[2],' '),' '))."%'":"").($LocationString[3]!=''?" AND `zip` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[3],' '),' '))."%'":"");
				$ZipCodeSQL = ($LocationString[0]!=''?"`zip` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				break;
			case '4':
				$StreetAddressSQL = ($LocationString[0]!=''?"`zc_user`.`street_address` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"").($LocationString[1]!=''?" AND `city_name` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"").($LocationString[2]!=''?" AND `province_code` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[2],' '),' '))."%'":"").($LocationString[3]!=''?" AND `zip` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[3],' '),' '))."%'":"");
				$ZipCodeSQL = ($LocationString[0]!=''?"`zip` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				break;
			case '3':
				$StreetAddressSQL = ($LocationString[0]!=''?"`zc_user`.`street_address` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"").($LocationString[1]!=''?" AND `city_name` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"").($LocationString[2]!=''?" AND `province_code` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[2],' '),' '))."%'":"");
				$ZipCodeSQL = ($LocationString[0]!=''?"`zip` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				break;
			case '2':
				$StreetAddressSQL = ($LocationString[0]!=''?"`zc_user`.`street_address` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"").($LocationString[1]!=''?" AND `city_name` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[1],' '),' '))."%'":"");
				$ZipCodeSQL = ($LocationString[0]!=''?"`zip` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				break;
			case '1':
				$StreetAddressSQL = ($LocationString[0]!=''?"`zc_user`.`street_address` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				$ZipCodeSQL = ($LocationString[0]!=''?"`zip` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				break;
			default:
				$StreetAddressSQL = ($LocationString[0]!=''?"`zc_user`.`street_address` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				$ZipCodeSQL = ($LocationString[0]!=''?"`zip` LIKE '%".mysql_real_escape_string(rtrim(ltrim($LocationString[0],' '),' '))."%'":"");
				break;
		}
		
		
		$sql2 = "SELECT `zc_user`.`street_address`, `zc_user`.`zip`, `zc_city`.*, `zc_region_master`.*, `zc_country_master`.* FROM `zc_user` LEFT JOIN `zc_city` ON `zc_city`.`city_name` = `zc_user`.`city` LEFT JOIN `zc_provience` ON `zc_provience`.`provience_name` = `zc_user`.`province` LEFT JOIN `zc_region_master` ON `zc_region_master`.`province_name` = `zc_provience`.`provience_name` LEFT JOIN `zc_country_master` ON `zc_country_master`.`id_countries` = `zc_provience`.`country_id` WHERE ".$StreetAddressSQL;
		$row2 = $this->db->query($sql2);
		if($row2->num_rows() > 0){
			$res2 = $row2->result();
			foreach($res2 as $arrData) {
				if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
					$val = $arrData->street_address.", ".$arrData->city_name.", ".$arrData->province_code.", ".$arrData->zip.", Italy";
				}else{
					$val = $arrData->street_address.", ".$arrData->city_name_it.", ".$arrData->province_code.", ".$arrData->zip.", Italia";
				}
				$data[] = $val;
			}
			return array_unique($data);
		}else{
			$sql4 = "SELECT `zc_user`.`street_address`, `zc_user`.`zip`, `zc_city`.*, `zc_region_master`.*, `zc_country_master`.* FROM `zc_user` LEFT JOIN `zc_city` ON `zc_city`.`city_name` = `zc_user`.`city` LEFT JOIN `zc_provience` ON `zc_provience`.`provience_name` = `zc_user`.`province` LEFT JOIN `zc_region_master` ON `zc_region_master`.`province_name` = `zc_provience`.`provience_name` LEFT JOIN `zc_country_master` ON `zc_country_master`.`id_countries` = `zc_provience`.`country_id` WHERE ".$ZipCodeSQL;
			$row4 = $this->db->query($sql4);
			if($row4->num_rows() > 0){
				$res4 = $row4->result();
				foreach($res4 as $arrData) {
					if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
						$val = $arrData->city_name.", ".$arrData->province_code.", ".$arrData->zip.", Italy";
					}else{
						$val = $arrData->city_name_it.", ".$arrData->province_code.", ".$arrData->zip.", Italia";
					}
					$data[] = $val;
				}
				return array_unique($data);
			}else{
				$sql = "SELECT `zc_region_master`.*, `zc_country_master`.* FROM `zc_region_master` LEFT JOIN `zc_provience` ON `zc_provience`.`provience_name` = `zc_region_master`.`province_name` LEFT JOIN `zc_country_master` ON `zc_country_master`.`id_countries` = `zc_provience`.`country_id` WHERE (`city` LIKE` '".mysql_real_escape_string($loc)."%' OR `city_it` LIKE '".mysql_real_escape_string($loc)."%')";
				$row = $this->db->query($sql);
				if($row->num_rows() > 0){
					$res = $row->result();
					foreach($res as $arrData) {
						if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
							$val = $arrData->city.", ".$arrData->province_code.", Italy";
						}else{
							$val = $arrData->city_it.", ".$arrData->province_code.", Italia";
						}
						$data[] = $val;
					}
					return array_unique($data);
				}else{
					/*
					$sql = "select zc_region_master.*, zc_country_master.* FROM `zc_region_master` LEFT JOIN `zc_provience` ON `zc_provience`.`provience_name` = `zc_region_master`.`province_name` LEFT JOIN `zc_country_master` ON `zc_country_master`.`id_countries` = `zc_provience.`country_id` WHERE (`province_name` LIKE '".mysql_real_escape_string($loc)."%' OR `province_name_it` LIKE '".mysql_real_escape_string($loc)."%')";
					$row = $this->db->query($sql);
					if($row->num_rows() > 0){
						$res = $row->result();
						foreach($res as $arrData) {
							if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
								$val = $arrData->province_name.", ".$arrData->province_code.", Italy";
							}else{
								$val = $arrData->province_name_it.", ".$arrData->province_code.", Italia";
							}
							$data[] = $val;
						}
						return array_unique($data);
					}
					*/
					return 0;
				}
			}
		}
	}
	public function get_contract_type(){
		$this->db->select('name_it,name,contract_id');
		$this->db->where('status', 'active');
		$query=$this->db->get("zc_contract_types");

		$result=array();
		$count=0;
		foreach($query->result() as $row){
			$result[$row->contract_id] = ($_COOKIE['lang']=='it'?$row->name_it:$row->name);
		}
		return $result;
	}
	public function get_provience_list($lang=null){
		if($lang=='english'){
			$sql="SELECT `province_name` FROM `zc_region_master` GROUP BY `province_name`";
		}else{
			$sql="SELECT `province_name_it` FROM `zc_region_master` GROUP BY `province_name_it`";
		}		
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				if($lang=='english'){
					$data[]=$row['province_name'];
				}else{
					$data[]=$row['province_name_it'];
				}
			}
			return $data;
		}
	}
	public function get_contract_short_code_by_id($contract_id){
		$this->db->select('short_code');
		$cond = array('status' => 'active', 'contract_id' => $contract_id);
		$this->db->where($cond);
		$query=$this->db->get("zc_contract_types");
		if ($query->num_rows() > 0){
			$row = $query->row();
			$sh_code= $row->short_code;
		}
		return $sh_code;
	}
	public function get_category_list($cat_parent){
		$this->db->select('name_it,name,short_code,category_id');
		$this->db->where('parent_id', $cat_parent);
		$this->db->where('status', 'active');
		$query=$this->db->get("zc_categories");
		$result=array();
		$count=0;
		foreach($query->result_array() as $row){
			$result[]=$row;
		}
		return $result;
	}
	public function get_contract_id_by_short_code($category_code){
		$this->db->select('category_id');
		$cond = array('status' => 'active', 'short_code' => $category_code);
		$this->db->where($cond);
		$query=$this->db->get("zc_categories");
		if ($query->num_rows() > 0){
			$row = $query->row();
			$category_id= $row->category_id;
		}
		return $category_id;
	}	
	public function get_city_list($province,$lang){
		if($lang=='english'){
			$sql="SELECT `city` FROM `zc_region_master` WHERE `province_name` = '".mysql_real_escape_string($province)."'";
		}else{
			$sql="SELECT `city_it` FROM `zc_region_master` WHERE `province_name_it` = '".mysql_real_escape_string($province)."'";
		}
		$query=$this->db->query($sql);
		if($query->num_rows()>0){			
			foreach($query->result_array() as $row){
				if($lang=='english'){
					$data[]=$row['city'];
				}else{
					$data[]=$row['city_it'];
				}				
			}
			return $data;
		}
	}
	public function get_save_property_list($property_post_by, $limit='', $start='') {
		$feaExtProSQL = "";
		$getFeaturedProperty = $this->get_save_property_list_highlight($property_post_by,'','');
		if(count($getFeaturedProperty)){
			$alreadyFeaturedPro = array();
			foreach($getFeaturedProperty as $gFp){
				$alreadyFeaturedPro[] = $gFp['property_id'];
			}
			$feaExtProSQL.= " AND property_id NOT IN(".implode($alreadyFeaturedPro,",").") ";
		}
		$sql = "SELECT * FROM `zc_property_details` where property_post_by='".$property_post_by."' and property_status='2' ".$feaExtProSQL."ORDER BY `property_id` DESC".($limit==''?"":" LIMIT ".$start." ,".$limit);
		$query=$this->db->query($sql);
		$data = array();
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	public function get_save_property_list_highlight($property_post_by,$limit='', $start='') {
		/*echo $sql="SELECT * FROM zc_property_details,zc_property_featured where zc_property_details.property_id=zc_property_featured.property_id AND zc_property_details.property_post_by= '".$property_post_by ."' AND zc_property_details.property_status='2' and zc_property_details.feature_status = '1' and zc_property_featured.status = '1' ORDER BY `property_id` DESC LIMIT ".$start." ,".$limit;
		$query=$this->db->query($sql);
		$data = array();
		if($query->num_rows()>0){
		foreach($query->result_array() as $row){
		$data[]=$row;
		}
		}
		return $data;*/
		$CI =& get_instance();
		$sql="select pf.*,pd.update_price,pd.price,pd.city,pd.provience,pd.category_id,pd.contract_id,pd.suspention_by_user,pd.suspention_status,pd.feature_status,pd.description,pd.typology,pd.street_address,pd.street_address,pd.street_no,pd.area,pd.zip,pd.update_time,pd.posting_time from zc_property_featured as pf LEFT JOIN zc_property_details as pd ON( pd.property_id = pf.property_id ) where pd.property_post_by= '".$property_post_by ."' AND pf.status='1' ORDER BY pf.property_featured_id DESC".($limit==''?"":" LIMIT ".$start." ,".$limit);

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
				} else {
					$data[] = $row;
				}
			}
		}
		return $data;
	}
	public function get_draft_property_list($property_post_by,$limit='', $start=''){
		$sql="SELECT * FROM `zc_property_details` where property_post_by='".$property_post_by."' and property_status='1' ORDER BY `property_id` DESC".($limit==''?"":" LIMIT ".$start." ,".$limit);
		$query=$this->db->query($sql);
		$data = array();
		if($query->num_rows()>0){	
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	public function get_msg_detail($uid,$limit, $start){
		/*
		$sql="SELECT * FROM `zc_property_message_info` where user_id_to='".$uid."'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
			return $data;
		}
		*/
		$data = array();
		/*$this->db->where('user_id_to =',$uid);
		$this->db->where('msg_to_delete =','0');
		//$this->db->or_where('user_id_from =',$uid); 
		$this->db->group_by("msg_grp_id");
		$this->db->order_by("msg_date","desc");
		//$this->db->order_by("msg_date","desc");
		$this->db->limit($limit, $start);*/
		$sql = "SELECT pm.*,
					(SELECT msg_date FROM zc_property_message_info as tmp
						WHERE
						(pm.user_id_to=" . $uid . " AND pm.msg_to_delete='0' AND tmp.property_id=pm.property_id AND tmp.msg_grp_id=pm.msg_grp_id)
						ORDER BY msg_date DESC LIMIT 1) as odate,
					(SELECT suspention_status FROM zc_property_details
						WHERE
						property_id=pm.property_id) as suspention_status,
					(SELECT property_approval FROM zc_property_details
						WHERE
						property_id=pm.property_id) as admin_approval

				FROM zc_property_message_info as pm WHERE (pm.user_id_to=" . $uid . " AND pm.msg_to_delete='0') GROUP BY pm.msg_grp_id ORDER BY odate DESC LIMIT " . $start . "," . $limit;  // OR (pm.user_id_from=".$uid." AND pm.msg_from_delete='0')
	
		$query = $this->db->query($sql);
		#echo "==========".$this->db->last_query();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row;
			}
		}
		for($i=0; $i<count($data); $i++)
		{
			$tmp = $this->check_user_to_status($data[$i]['user_id_from']);
			$data[$i]['user_from_status'] = $tmp[0]['status'];
			$data[$i]['blocked_note'] = $tmp[0]['blocked_note'];
		}
		// echo json_encode($data);exit;
		return $data;
	}
	public function get_send_msg_detail($uid,$limit, $start){
		/*
		$sql="SELECT * FROM `zc_property_message_info` where user_id_to='".$uid."'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
			return $data;
		}
		*/
		$data = array();
		/*$this->db->where('user_id_from =',$uid);
		$this->db->where('msg_from_delete =','0');
		//$this->db->or_where('user_id_from =',$uid); 
		$this->db->group_by("msg_grp_id");
		$this->db->order_by("msg_date","desc");
		$this->db->limit($limit, $start);*/

		$sql = "SELECT pm.*,
					(SELECT msg_date FROM zc_property_message_info as tmp
							WHERE
							(pm.user_id_from=" . $uid . " AND pm.msg_from_delete='0' AND tmp.property_id=pm.property_id AND tmp.msg_grp_id=pm.msg_grp_id)
							ORDER BY msg_date DESC LIMIT 1) as odate,
						(SELECT suspention_status FROM zc_property_details
							WHERE
							property_id=pm.property_id) as suspention_status,
						(SELECT property_approval FROM zc_property_details
							WHERE
							property_id=pm.property_id) as admin_approval
					FROM zc_property_message_info as pm
					WHERE (pm.user_id_from=" . $uid . " AND pm.msg_from_delete='0') GROUP BY pm.msg_grp_id ORDER BY odate DESC LIMIT " . $start . "," . $limit;  // OR (pm.user_id_from=".$uid." AND pm.msg_from_delete='0')

		$query = $this->db->query($sql);
		#echo "==========".$this->db->last_query();exit;
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row;
			}
		}
		
		return $data;
	}
	public function get_saved_list($limit, $start){
		$uid=$this->session->userdata( 'user_id' );
		$this->db->where('saved_by_user_id =',$uid);
		$this->db->order_by("saved_date", "desc");
		$this->db->limit($limit, $start);
		$query = $this->db->get("zc_save_search");
		$data = array();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row;
			}
		}
		return $data;
	}	
	public function get_saved_property($limit, $start){
		$uid=$this->session->userdata( 'user_id' );
		$sql = "SELECT sp.* FROM zc_saved_property as sp JOIN zc_property_featured as p ON sp.property_id=p.property_id JOIN zc_property_details as pd ON p.property_id = pd.property_id ";
		$sql .= "JOIN zc_user as u ON pd.property_post_by = u.user_id WHERE sp.saved_by_user_id = ".$uid." AND p.status='0' AND u.status='0' ORDER BY sp.saved_date DESC LIMIT ".$start.",".$limit;  

		// $this->db->where('saved_by_user_id =',$uid);
		// $this->db->order_by("saved_date", "desc");
		// $this->db->limit($limit, $start);
		$query = $this->db->query($sql);
		//echo "===========".$this->db->last_query();
		$data = array();

		// echo json_encode($data);exit;
		
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row;
			}
		}
		return $data;
	}
	public function change_read_status($msg_grp_id){
		$uid=$this->session->userdata( 'user_id' );
		$sql="Update zc_property_message_info set read_status='1' where user_id_to='".$uid."' and msg_grp_id='".$msg_grp_id."'";
		return $this->db->query($sql);
	}
	public function get_property_msg($msg_grp_id){
		$this->db->where('msg_grp_id =',$msg_grp_id);
		//$this->db->where('msg_to_delete =',0);
		$this->db->order_by("msg_date", "asc");
		//$this->db->limit($limit, $start);
		$query = $this->db->get("zc_property_message_info");
		//echo "===========".$this->db->last_query();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	public function add_message($new_message){
		#echo '<pre>';print_r($new_message);die;
		$this->db->insert('zc_property_message_info', $new_message);
		//echo $sql = $this->db->last_query();die;
		 return $msg_id = $this->db->insert_id();
	}
	public function search_msg($search_string,$user_id_to,$limit, $start){
		$str="";
		if($search_string!=''){
			$str.=" AND `message` LIKE '%{$search_string}%' or user_name='$search_string'";
		}
		$sql="SELECT * FROM `zc_property_message_info` where user_id_to='".$user_id_to."'".$str." AND msg_to_delete = '0' ORDER BY `msg_date` DESC LIMIT ".$start.", ".$limit;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
			return $data;
		}
	}
	public function add_new_property_csv($new_data){
		//$error="";
		foreach($new_data as $new_datas){			
			if(is_string($new_datas['provience']))
				$new_datas['provience']=get_perticular_field_value('zc_provience','provience_id'," AND ".($_COOKIE['lang']=='english'?"`provience_name`":"`provience_name_it`")." = '".$new_datas['provience']."'");			
			if(is_string($new_datas['city']))
				$new_datas['city']=get_perticular_field_value('zc_city','city_id'," AND ".($_COOKIE['lang']=='english'?"`city_name`":"`city_name_it`")." = '".$new_datas['city']."'");		
			$this->db->insert('zc_property_details', $new_datas);
		}
		return 1;
	}
	public function add_new_property($new_data){
		//echo '<pre>';print_r($new_data);die;
		  $this->db->insert('zc_property_details', $new_data);
		  return $property_id = $this->db->insert_id();
	}
	public function delete_property($property_id){

		$sql = "delete from zc_property_message_info where property_id='".$property_id."'";
		$this->db->query($sql);
		$sql="delete from zc_property_details where property_id='".$property_id."'";
		return $this->db->query($sql);
	}
	public function del_prop_image($property_id){
		$sql="delete from zc_property_img where property_id='".$property_id."'";
		return $this->db->query($sql);
	}
	public function suspend_property($property_id){
		$uid=$this->session->userdata('user_id');
		$sql="update zc_property_details set suspention_status='1',`suspention_by_user`='".$uid."' where property_id='".$property_id."'";
		return $this->db->query($sql);
	}	
	public function resume_property($property_id){
		$uid=$this->session->userdata( 'user_id' );
		$sql="update zc_property_details set suspention_status='0',`suspention_by_user`='".$uid."' where property_id='".$property_id."'";
		$sql1="update zc_property_featured set status='0' where property_id='".$property_id."'";
		$this->db->query($sql1);
		return $this->db->query($sql);
	}
	public function suspend_featured_property($property_id){
		$uid=$this->session->userdata('user_id');
		$sql="update zc_property_details set feature_status='0',`suspention_by_user`='".$uid."' where property_id='".$property_id."'";
		return $this->db->query($sql);
	}
	public function resume_featured_property($property_id){
		$uid=$this->session->userdata('user_id');
		$sql="update zc_property_details set feature_status='1',`suspention_by_user`='".$uid."' where property_id='".$property_id."'";
		$this->db->query($sql);
		return $this->db->query($sql);
	}
	public function insert_property_picture($file_names,$property_id,$img_type,$prop_img_no){
		$sql="insert into  zc_property_img set property_id='".$property_id."',file_name='".$file_names."',img_type='".$img_type."',prop_img_no='".$prop_img_no."'";
		return $this->db->query($sql);
	}
	public function del_property_img($img_id){
		$sql="delete from zc_property_img where img_id='".$img_id."'";
		return $this->db->query($sql);
	}
	public function get_property_detail($property_id){
		$sql="SELECT * FROM `zc_property_details` where property_id='".$property_id."'";
		$query=$this->db->query($sql);
		$data = array();
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	public function property_image($property_id){
		$sql="SELECT * FROM `zc_property_img` where property_id='".$property_id."' and img_type='prop_picture'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
			return $data;
		}
	}
	public function edit_property_bus($new_data,$property_id){
		$query = $this->db->query("SELECT * FROM zc_property_details WHERE property_id='".$property_id."'");
		$res = $query->result();
		if($res[0]->property_status == 1)
		{
			$new_data['update_time'] = '';
			$new_data['posting_time'] = date('Y-m-d');
		}
		$where = "property_id = '".$property_id."'";		
		$str = $this->db->update('zc_property_details', $new_data, $where);
	}
	public function edit_property_res($new_data,$property_id){
		//echo '<pre>';print_r($new_data);die;
		$query = $this->db->query("SELECT * FROM zc_property_details WHERE property_id='".$property_id."'");
		$res = $query->result();
		if($res[0]->property_status == 1)
		{
			$new_data['update_time'] = '';
			$new_data['posting_time'] = date('Y-m-d');
		}
		$where = "property_id = '".$property_id."'";
		$str = $this->db->update('zc_property_details', $new_data, $where); 
	}
	public function edit_property_rom($new_data,$property_id){
		$query = $this->db->query("SELECT * FROM zc_property_details WHERE property_id='".$property_id."'");
		$res = $query->result();
		if($res[0]->property_status == 1)
		{
			$new_data['update_time'] = '';
			$new_data['posting_time'] = date('Y-m-d');
		}
		$where = "property_id = '".$property_id."'";
		$str = $this->db->update('zc_property_details', $new_data, $where);
	}
	public function edit_property_vac($new_data,$property_id){
		$query = $this->db->query("SELECT * FROM zc_property_details WHERE property_id='".$property_id."'");
		$res = $query->result();
		if($res[0]->property_status == 1)
		{
			$new_data['update_time'] = '';
			$new_data['posting_time'] = date('Y-m-d');
		}
		$where = "property_id = '".$property_id."'";
		$str = $this->db->update('zc_property_details', $new_data, $where); 
	}
	public function edit_property_land($new_data,$property_id){
		$query = $this->db->query("SELECT * FROM zc_property_details WHERE property_id='".$property_id."'");
		$res = $query->result();
		if($res[0]->property_status == 1)
		{
			$new_data['update_time'] = '';
			$new_data['posting_time'] = date('Y-m-d');
		}
		$where = "property_id = '".$property_id."'";
		$str = $this->db->update('zc_property_details', $new_data, $where);
	}
	public function delete_saved_property($saved_id){
		$sql="Delete from zc_save_search where saved_id='".$saved_id."'";
		return $this->db->query($sql);
	}
	public function get_all_prop_image($property_id){
		$sql="SELECT * FROM `zc_property_img` where property_id='".$property_id."'";
		$query=$this->db->query($sql);
		$data = array();
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	public function get_similar_property($property_id) {
		$data = array();
		$sql="SELECT * FROM `zc_property_details` where property_id='".$property_id."'";
		$query=$this->db->query($sql);
		$rs = array();
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$rs[]=$row;
			}
		}
		if( count($rs) > 0 ) {
			$sql_search_similar="select * from zc_property_details where contract_id='".$rs[0]['contract_id']."' and typology='".$rs[0]['typology']."' and city='".$rs[0]['city']."' and provience='".$rs[0]['provience']."' and property_id!='".$property_id."' AND property_status='2' ORDER BY price DESC LIMIT 0 , 5 ";
			$query_search=$this->db->query($sql_search_similar);
			if($query_search->num_rows()>0){
				foreach($query_search->result_array() as $row){
					$data[] = $row;
				}
			}
		}
		return $data;
	}
	public function get_nearby_category_property() {
		$data = array();
		$sql="SELECT * FROM `zc_nearbyproperty_category` WHERE `status`=1";
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			$data = $query->result_array();
		}
		return $data;
	}
	public function delete_per_msg($userid,$msggroupid,$type) {
		if($type=='from'){		//	For Inbox Items.
			$sql_del="update zc_property_message_info set msg_from_delete='0',msg_to_delete='1' where user_id_to='".$userid."' AND msg_grp_id='".$msggroupid."'";
		}elseif($type=='to'){	//	For Sent Items.
			$sql_del="update zc_property_message_info SET msg_from_delete='1',msg_to_delete='0' where user_id_from='".$userid."' AND msg_grp_id='".$msggroupid."'";
		}
		$this->db->query($sql_del);		
	}
	public function delete_per_msg_2($msgid,$type) {
		if($type=='to'){		//	For Inbox Items.
			$sql_del="update zc_property_message_info set msg_from_delete='0',msg_to_delete='1' where msg_id='".$msgid."'";
		}elseif($type=='from'){	//	For Sent Items.
			$sql_del="update zc_property_message_info SET msg_from_delete='1',msg_to_delete='0' where msg_id='".$msgid."'";
		}
		$this->db->query($sql_del);		
	}
	
	public function get_provience_name($province_id=0){
		$data = array();
		$sql="SELECT * FROM `zc_provience` WHERE `provience_id`=".$province_id;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			$data = $query->result_array();
		}
		return $data;
	}
	public function check_user_to_status($user_id=0){
		$data = array();
		if($user_id){
			$sql="SELECT * FROM `zc_user` WHERE `user_id`=".$user_id;
			$query=$this->db->query($sql);
			//echo $this->db->last_query();exit;
			if($query->num_rows()>0){
				$data = $query->result_array();
			}
		}	
		return $data;
	}
	public function save_property($new_data){
		$this->db->insert('zc_saved_property', $new_data);
		return $saved_id = $this->db->insert_id();
	}
	public function add_feedback($new_data){
		$this->db->insert('zc_feedback', $new_data);
		//echo $sql = $this->db->last_query();die;	
		return $msg_id = $this->db->insert_id();
	}
	public function saved_search($new_data,$save_search_id = 0,$save_search_flag = 'new_save_search' ){
		//echo '<pre>';print_r($new_data);echo $save_search_flag; die;
		if( $save_search_id == 0 ) {
			$this->db->insert('zc_save_search', $new_data);
			return $saved_id = $this->db->insert_id();
		} else if( $save_search_flag == "new_save_search" ) {
			$this->db->insert('zc_save_search', $new_data);
			return $saved_id = $this->db->insert_id();
		} else if( $save_search_flag == "update_save_search" ) {
			$this->db->where('saved_id', $save_search_id);
			$this->db->update('zc_save_search', $new_data);
			return 1;
		}else {
			$this->db->where('saved_id', $save_search_id);
			$this->db->update('zc_save_search', $new_data);
			return 1;
		}
	}
	public function PropertyListingPages($filters='',$limit, $path, $cureentPage,$returnType){
		$for_business = $filters['for_business'];
		$for_luxury = $filters['for_luxury'];		
		$where = '';
		if($filters['category_id'] != '') {
			$cat_id = $filters['category_id'];
			if($cat_id != '10'){
				if($filters['parent_id'] == "0"){
					$where.=" AND (zc_property_details.category_id in (select category_id from zc_categories where parent_id =".$cat_id.") or zc_property_details.category_id in (".$cat_id.")) ";
				}else{
					$where.=" AND zc_property_details.category_id = ".$cat_id;
				}
			}else{
				 //$where.=" AND add_to_luxury='1' ";
				 $where.=" AND zc_property_details.category_id in (1, 5, 6, 7) ";
			}
		}
		if($filters['contract_type'] != '' && $filters['contract_type'] != 'all') {
			$where.=" AND zc_property_details.contract_id = ".$filters['contract_type'];
		}
		if($filters['posted_by'] != '' && $filters['posted_by'] != 'all') {
			$where.=" AND zc_property_details.property_post_by_type = ".$filters['posted_by'];
		}
		if($filters['status'] != '' && $filters['status'] != 'all') {
			$status='';
			foreach($filters['status'] as $key=>$val){
				$status.=','.$val;
			}
			$status=ltrim($status,',');
			$where.=" AND zc_property_details.status in (".$status.") ";
		}
		if($filters['min_price'] == ''){
			$min_price='0';
		}else{			
			$min_price=str_replace(".","",$filters['min_price']);
			$min_price=str_replace(",",".",$min_price);
		}
		if($filters['max_price'] == ''){
			$max_price = '0';
		}else{			
			$max_price=str_replace(".","",$filters['max_price']);
			$max_price=str_replace(",",".",$max_price);
		}
		if($min_price != "0" && $max_price == '0'){
			$where.=" AND zc_property_details.price >= '".$min_price."'";
		}
		if($max_price != "0" && $min_price == '0'){
			$where.=" AND zc_property_details.price <= '".$max_price."'";
		}
		if($min_price != "0" && $max_price != '0'){
			$where.=" AND zc_property_details.price BETWEEN '".$min_price."' AND '".$max_price."' ";
		}
		if($filters['min_room'] == ''){
			$min_room='0';
		}else{
			$min_room=$filters['min_room'];
		}
		if($filters['max_room'] == ''){
			$max_room = '0';
		}else{
			$max_room = $filters['max_room'];
		}
		if($min_room != "0" && $max_room == '0'){
			$where.=" AND zc_property_details.room_no >= '".$min_room."'";
		}
		if($max_room != "0" && $min_room == '0'){
			$where.=" AND zc_property_details.room_no <= '".$max_room."'";
		}
		if($min_room != "0" && $max_room != '0'){
			$where.=" AND zc_property_details.room_no BETWEEN '".$min_room."' AND '".$max_room."' ";
		}
		if(!empty($filters['typology'])) {
			$typology='';
			foreach($filters['typology'] as $key=>$val){
				$typology.=','.$val;
			 }
			 $typology=ltrim($typology,',');			 
			 $where.=(($typology!='')?" AND zc_property_details.typology IN (".$typology.")":"");
		}
		if($filters['bathrooms_no']!='' && $filters['bathrooms_no']!='all') {
		  $where.=" AND zc_property_details.bathrooms_no='".$filters['bathrooms_no']."'";
		}
		if($filters['min_surface_area'] !='' || $filters['max_surface_area'] !='' ) {
			if($filters['min_surface_area']=='') {
				$min_surface_area='0';
			} else {
				$min_surface_area=$filters['min_surface_area'];
			}
			if($filters['max_surface_area']=='') {
				$max_surface_area = '0';
			} else {
				$max_surface_area=$filters['max_surface_area'];
			}
			if( $max_surface_area == '0' && $min_surface_area !='0' ) {
				$where.=" AND zc_property_details.surface_area >= '".$min_surface_area."'";
			} else {
				$where.=" AND zc_property_details.surface_area >= '".$min_surface_area."' AND zc_property_details.surface_area <= '".$max_surface_area."'";
			}
		}
		if($filters['min_beds_no'] !='' || $filters['max_beds_no'] !='' ) {
			if($filters['min_beds_no'] == '') {
				$min_beds_no = '0';
			} else {
				$min_beds_no = $filters['min_beds_no'];
			}
			if($filters['max_beds_no']=='') {
				$max_beds_no = '0';
			} else {
				$max_beds_no=$filters['max_beds_no'];
			}
			if( $max_beds_no == '0' && $min_beds_no !='0' ) {
				$where.=" AND zc_property_details.beds_no >= '".$min_beds_no."'";
			} else {
				$where.=" AND zc_property_details.beds_no >= '".$min_beds_no."' AND zc_property_details.beds_no <= '".$max_beds_no."'";
			}
		}
		if($filters['kind']!='' && $filters['kind']!='all') {
			  $where.=" AND zc_property_details.kind='".$filters['kind']."'";
		}
		if($filters['energyclass']!='' && $filters['energyclass']!='all'){
			$where.=" AND ".($filters['energyclass']=='0'?"(zc_property_details.energyclass='' OR zc_property_details.energyclass='0')":"zc_property_details.energyclass='".$filters['energyclass']."'");
		}
		if($filters['heating']!='' && $filters['heating']!='all'){
			$where.=" AND zc_property_details.heating='".$filters['heating']."'";
		}
		if($filters['parking']!='' && $filters['parking']!='all'){
			$where.=" AND zc_property_details.parking='".$filters['parking']."'";
		}
		if($filters['furnished']!='' && $filters['furnished']!='all'){
			$where.=" AND zc_property_details.furnished='".$filters['furnished']."'";
		}
		if($filters['roommates']!='' && $filters['roommates']!='all'){
			$where.=" AND zc_property_details.roommates='".$filters['roommates']."'";
		}
		if($filters['occupation']!='' && $filters['occupation']!='all'){
			$where.=" AND zc_property_details.occupation='".$filters['occupation']."'";
		}
		if($filters['smokers']!='' && $filters['smokers']!='all'){
			$where.=" AND zc_property_details.smokers='".$filters['smokers']."'";
		}
		if($filters['pets']!='' && $filters['pets']!='all'){
			$where.=" AND zc_property_details.pets='".$filters['pets']."'";
		}
		if($filters['elevator']!=''){
			$where.=" AND zc_property_details.elevator='1'";
		}
		if($filters['air_conditioning']!=''){
			$where.=" AND zc_property_details.air_conditioning='1'";
		}
		if($filters['garden']!=''){
			$where.=" AND zc_property_details.garden='1'";
		}
		if($filters['terrace']!=''){
			$where.=" AND zc_property_details.terrace='1'";
		}
		if($filters['balcony']!=''){
			$where.=" AND zc_property_details.balcony='1'";
		}
		if($filters['location'] != ''){
			$location = $filters['location'];
			$street = $location;
			$area = $location;
			$city = $location;
			$provience = $location;
			$provience_code = $location;
			$country = $location;
			$zip = $location;
			$poplocationeng = $location;
			$poplocationit = $location;
			$list = explode(", ", $location);
			//echo "<pre>"; print_r($list);exit;
			//$val = $arrData->city.", ".$arrData->province_name.", ".$arrData->province_code.", ".$arrData->name;
			//echo "====".count($list);
			if(count($list) > 4){
				if(isset($list[0]) && $list[0] != ''){
					$street = $list[0];
					$area = $list[0];
				}
				if(isset($list[1]) && $list[1] != ''){
					$city = $list[1];
				}
				if(isset($list[2]) && $list[2] != ''){
					$provience_code = $list[2];
				}
				if(isset($list[3]) && $list[3] != ''){
					$zip = $list[3];
				}
				if(isset($list[4]) && $list[4] != ''){
					$country = $list[4];
				}
				$StreetOperatorSQL = 'OR';
				$CityOperatorSQL = 'AND';
				$ProvienceOperatorSQL = 'AND';
				$ZipOperatorSQL = 'AND';
			}elseif(count($list) == 4){
				if(isset($list[0]) && $list[0] != ''){
					$street = $list[0];
					$area = $list[0];
				}
				if(isset($list[1]) && $list[1] != ''){
					$city = $list[0];
				}
				if(isset($list[2]) && $list[2] != ''){
					$provience_code = $list[1];
				}
				if(isset($list[3]) && $list[3] != ''){
					$zip = $list[2];
				}
				if(isset($list[4]) && $list[4] != ''){
					$country = $list[4];
				}
				$StreetOperatorSQL = 'AND';
				$CityOperatorSQL = 'AND';
				$ProvienceOperatorSQL = 'AND';
				$ZipOperatorSQL = 'OR';
			}else if(count($list) == 3){
				if(isset($list[0]) && $list[0] != ''){
					$city = $list[0];
				}
				if(isset($list[1]) && $list[1] != ''){
					$provience_code = $list[1];
				}
				if(isset($list[2]) && $list[2] != ''){
					$zip = $list[2];
				}
				$StreetOperatorSQL = 'OR';
				$CityOperatorSQL = 'OR';
				$ProvienceOperatorSQL = 'AND';
				$ZipOperatorSQL = 'OR';
			}else{
				if(isset($list[0]) && $list[0] != ''){
					$city = $list[0];
				}
				if(isset($list[1]) && $list[1] != ''){
					$provience = $list[1];
				}
				if(isset($list[2]) && $list[2] != ''){
					$provience_code = $list[2];
				}
				if(isset($list[3]) && $list[3] != ''){
					$country = $list[3];
				}
				$StreetOperatorSQL = 'OR';
				$CityOperatorSQL = 'OR';
				$ProvienceOperatorSQL = 'OR';
				$ZipOperatorSQL = 'OR';
			}
			if(!strpos($area, "'")===false){
				$area = str_replace("'","\\\\'",$area);
			}
			if(!strpos($street, "'")===false){
				$street = str_replace("'","\\\\'",$street);
			}
			if(!strpos($city, "'")===false){
				$city = str_replace("'","\\\\'",$city);
			}
			$where.=" AND (";
			$where.=" zc_property_details.zip like '%".mysql_real_escape_string($zip)."%'";
			$where.=" ".$ZipOperatorSQL." zc_property_details.area like '%".mysql_real_escape_string($area)."%'";
			$where.=" ".$StreetOperatorSQL." zc_property_details.street_address like '%".mysql_real_escape_string($street)."%'";
			$where.=" ".$CityOperatorSQL." zc_property_details.city in (select city_id from zc_city where city_name in (select city from zc_region_master where city like '%".mysql_real_escape_string($city)."%' or city_it like '%".mysql_real_escape_string($city)."%' or province_name like '%".mysql_real_escape_string($city)."%' or province_name_it like '%".mysql_real_escape_string($city)."%'))";
			//$where.=" ".$ProvienceOperatorSQL." zc_property_details.provience in (SELECT `zc_provience`.`provience_id` FROM `zc_region_master` INNER JOIN `zc_provience` ON (`zc_region_master`.`province_name`=`zc_provience`.`provience_name` AND `zc_region_master`.`province_name_it`=`zc_provience`.`provience_name_it`) WHERE `zc_region_master`.`province_code` like '%".mysql_real_escape_string($provience_code)."%')";
			$where.=" )";
			//$str.=" AND city Like'%".$filters['location']."%' or zip Like'%".$filters['location']."%' or provience Like'%".$filters['location']."%'";
		}
		if($filters['order_option'] == ''){
			$orderby = ' posting_time DESC';
		}if($filters['order_option'] == 'order_high_price'){
			$orderby = ' `price` DESC'; 
		} if($filters['order_option'] == 'order_low_price'){
			$orderby = ' `price` ASC'; 
		}
		if($filters['order_option'] == 'order_latest'){
			$orderby = ' `posting_time` DESC'; 
		}
		
		$blockedUserIdSQL = "";
		$blockedUserId = get_field_value("zc_user","GROUP_CONCAT(`user_id` SEPARATOR ',') AS blocked_user","AND `status`='0'");
		if(!empty($blockedUserId) && $blockedUserId['blocked_user']!=''){
			$blockedUserIdSQL.= " AND zc_property_details.property_post_by NOT IN (".$blockedUserId['blocked_user'].")";
		}
		
		$total_pages = 0;
		$sql = "select count(*) as `num` from zc_property_details left join zc_property_img on zc_property_details.property_id = zc_property_img.property_id left join zc_contract_types on zc_property_details.contract_id = zc_contract_types.contract_id left join zc_typologies on zc_property_details.typology = zc_typologies.typology_id left join zc_city on zc_property_details.city = zc_city.city_id left join zc_provience on zc_property_details.provience = zc_provience.provience_id left join zc_region_master on zc_city.city_name = zc_region_master.city where zc_property_img.img_type = 'main_image' ".$where." AND `zc_typologies`.`status`='active' AND property_approval='1' AND suspention_status='0' ".$blockedUserIdSQL."ORDER BY ".$orderby;
		$row = $this->db->query($sql);		
		if($row->num_rows()>0){
			$result = $row->result();
			$total_pages = $result[0]->num;
		}
		
		if($returnType=='propertycounter'){
			return $total_pages;
		}
		
		
		$adjacents = "2";
		$page      = (int) (!isset($cureentPage) ? 1 : $cureentPage);
		$page      = ($page == 0 ? 1 : $page);
		if ($page)
			$start = ($page - 1) * $limit;
		else
			$start = 0;
		/* $sql = "SELECT id FROM $tbl_name ".$where_clause." LIMIT $start, $limit";
		$result = mysql_query($sql); */
		$prev       = $page - 1;
		$next       = $page + 1;
		$lastpage   = ceil($total_pages / $limit);
		$lpm1       = $lastpage - 1;
		$pagination = "";
		if ($lastpage > 1) {
			$pagination .= "<div class='inbox_delete_pagination_rht'>";
			if ($page > 1)
				$pagination .= "<a href='".$path."$prev'>&lsaquo;</a>";
			else
				$pagination .= "";
			if ($lastpage < 7 + ($adjacents * 2)) {
				for ($counter = 1; $counter <= $lastpage; $counter++) {
					if ($counter == $page)
						$pagination .= "<strong>$counter</strong>";
					else
						$pagination .= "<a href='" . $path . "$counter'>$counter</a>";
				}
			} elseif ($lastpage > 5 + ($adjacents * 2)) {
				if ($page < 1 + ($adjacents * 2)) {
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
						if ($counter == $page)
							$pagination .= "<strong>$counter</strong>";
						else
							$pagination .= "<a href='" . $path . "$counter'>$counter</a>";
					}
					//$pagination .= "<span class='doted'>...</span>";
					$pagination .= "<a href='" . $path . "$lpm1'>$lpm1</a>";
					$pagination .= "<a href='" . $path . "$lastpage'>$lastpage</a>";
				} elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
					$pagination .= "<a href='" . $path . "1'>1</a>";
					$pagination .= "<a href='" . $path . "2'>2</a>";
					//$pagination .= "<span class='doted'>...</span>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
						if ($counter == $page)
							$pagination .= "<strong>$counter</strong>";
						else
							$pagination .= "<a href='" . $path . "$counter'>$counter</a>";
					}
					//$pagination .= "<span class='doted'>...</span>";
					$pagination .= "<a href='" . $path . "$lpm1'>$lpm1</a>";
					$pagination .= "<a href='" . $path . "$lastpage'>$lastpage</a>";
				} else {
					$pagination .= "<a href='" . $path . "1'>1</a>";
					$pagination .= "<a href='" . $path . "2'>2</a>";
					//$pagination .= "<span class='doted'>...</span>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
						if ($counter == $page)
							$pagination .= "<strong>$counter</strong>";
						else
							$pagination .= "<a href='" . $path . "$counter'>$counter</a>";
					}
				}
			}
			if ($page < $counter - 1)
				$pagination .= "<a href='".$path."$next'>&rsaquo;</a>";
			else
				$pagination .= "";
			$pagination .= "</div>\n";
		}
		return $pagination;
	}
	function get_details_saved_property( $saved_id ) {
		$data = array();
		$sql="SELECT * FROM zc_save_search where saved_id='".$saved_id."'";
		$query_search=$this->db->query( $sql );
		if($query_search->num_rows()>0){
			foreach($query_search->result_array() as $row){
			   $data = $row;
            }
		}
		return $data;
	}
	function search_property($new_filter,$segments,$order_option,$pcat_id=''){
		$cat_id = 0;
		$str="";
		if($new_filter['category'] != '') {
			$cat_id = $new_filter['category'];
			if($cat_id != '10'){
				if($pcat_id == "0"){
					$str.=" AND (zc_property_details.category_id in (select category_id from zc_categories where parent_id =".$cat_id.") or zc_property_details.category_id in (".$cat_id.")) ";
				}else{
					$str.=" AND zc_property_details.category_id = ".$cat_id;
				}
			}
		}	
		if(!empty($new_filter['contract_id'])){
			$contract_id='';
			foreach($new_filter['contract_id'] as $key=>$val){
				$contract_id.=','.$val;
			}
			$contract_id=ltrim($contract_id,',');
			//$str.=" AND contract_id IN ($contract_id)";
		}

		///////////////either owner or agency//////////////////////////
		if(!empty($new_filter['property_post_by_type'])) {
			$property_post_by_type='';
			foreach($new_filter['property_post_by_type'] as $key=>$val){
				$property_post_by_type.=','.$val;
			}
			$property_post_by_type=ltrim($property_post_by_type,',');
			$str.=" AND property_post_by_type IN ($property_post_by_type)";
		}
		///////////////either status//////////////////////////
		if(!empty($new_filter['status'])){
			$status='';
			foreach($new_filter['status'] as $key=>$val){
				$status.=','.$val;
			}
			$status=ltrim($status,',');
			$str.=" AND status IN ($status)";
		}
		//////////////////price checking//////////////////////////
		if($new_filter['min_price'] == ''){
			$min_price='0';
		}else{
			$min_price=$new_filter['min_price'];
		}
		if($new_filter['max_price'] == ''){
			$max_price = '0';
		}else{
			$max_price=$new_filter['max_price'];
		}
		if($min_price != "0" && $max_price == '0'){
			$str.=" AND price >= '".$min_price."'";
		}
		if($max_price != "0" && $min_price == '0'){
			$str.=" AND price <= '".$max_price."'";
		}
		if($min_price != "0" && $max_price != '0'){
			$str.=" AND price BETWEEN '".$min_price."' AND '".$max_price."' ";
		}

		if($new_filter['min_room'] !='' || $new_filter['max_room'] !='' ){
			if($new_filter['min_room']=='') {
				$min_room='0';
			} else {
				$min_room=$new_filter['min_room'];
			}
			if($new_filter['max_room']=='') {
				$max_room = '0';
			} else {
				$max_room=$new_filter['max_room'];
			}
			if( $max_room == '0' && $min_room !='0' ) {
				$str.=" AND room_no >= '$min_room'";
			} else {
				$str.=" AND room_no >= '".$min_room."' AND room_no <= '".$max_room."'";
			}
		}
		///////////////typology filter////////////////////////////
		if(!empty($new_filter['typology']))	{
			$typology='';
			foreach($new_filter['typology'] as $key=>$val){
				$typology.=','.$val;
			}
			$typology=ltrim($typology,',');
			$str.=" AND typology IN ($typology)";
		}
		//////////////////////more information///////////////////////
		///////bathroom filter/////////////////////////////////////
		if($new_filter['bathrooms_no']!='' && $new_filter['bathrooms_no']!='all'){
			$str.=" AND bathrooms_no='".$new_filter['bathrooms_no']."'";
		}
	
		if($new_filter['min_surface_area'] !='' || $new_filter['max_surface_area'] !='' ){
			if($new_filter['min_surface_area']=='') {
				$min_surface_area='0';
			} else {
				$min_surface_area=$new_filter['min_surface_area'];
			}
			if($new_filter['max_surface_area']=='') {
				$max_surface_area = '0';
			} else {
				$max_surface_area=$new_filter['max_surface_area'];
			}
			if( $max_surface_area == '0' && $min_surface_area !='0' ) {
				$str.=" AND surface_area >= '".$min_surface_area."'";
			} else {
				$str.=" AND surface_area >= '".$min_surface_area."' AND surface_area <= '".$max_surface_area."'";
			}
		}
		if($new_filter['min_beds_no'] !='' || $new_filter['max_beds_no'] !='' ){
			if($new_filter['min_beds_no']=='') {
				$min_beds_no='0';
			} else {
				$min_beds_no=$new_filter['min_beds_no'];
			}
			if($new_filter['max_beds_no']=='') {
				$max_beds_no = '0';
			} else {
				$max_beds_no=$new_filter['max_beds_no'];
			}
			if( $max_beds_no == '0' && $min_beds_no !='0' ) {
				$str.=" AND beds_no >= '".$min_beds_no."'";
			} else {
				$str.=" AND beds_no >= '".$min_beds_no."' AND beds_no <= '".$max_beds_no."'";
			}
		}
		////////////////////////////////Kind////////////////////////////////////////////
		if($new_filter['kind']!='' && $new_filter['kind']!='all'){
			$str.=" AND kind='".$new_filter['kind']."'";
		}
		////////////////////energyclass///////////////////////////////////////////
		if($new_filter['energyclass']!='' && $new_filter['energyclass']!='all'){
			$str.=" AND energyclass='".$new_filter['energyclass']."'";
		}
		////////////////heating///////////////////////////////////////////////
		if($new_filter['heating']!='' && $new_filter['heating']!='all'){
			$str.=" AND heating='".$new_filter['heating']."'";
		}
		/////////////////parking//////////////////////////////////////////
		if($new_filter['parking']!='' && $new_filter['parking']!='all'){
			$str.=" AND parking='".$new_filter['parking']."'";
		}
		/////////////////furnished//////////////////////////////////////////
		if($new_filter['furnished']!='' && $new_filter['furnished']!='all'){
			$str.=" AND furnished='".$new_filter['furnished']."'";
		}
		/////////////////roommates//////////////////////////////////////////
		if($new_filter['roommates']!='' && $new_filter['roommates']!='all'){
			$str.=" AND roommates='".$new_filter['roommates']."'";
		}
		/////////////////occupation//////////////////////////////////////////
		if($new_filter['occupation']!='' && $new_filter['occupation']!='all'){
			$str.=" AND occupation='".$new_filter['occupation']."'";
		}
		/////////////////smokers//////////////////////////////////////////
		if($new_filter['smokers']!='' && $new_filter['smokers']!='all'){
			$str.=" AND smokers='".$new_filter['smokers']."'";
		}
		/////////////////pets//////////////////////////////////////////
		if($new_filter['pets']!='' && $new_filter['pets']!='all'){
			$str.=" AND pets='".$new_filter['pets']."'";
		}
		/////////////////elevator//////////////////////////////////////////
		if($new_filter['elevator']!=''){
			$str.=" AND elevator='1'";
		}
		/////////////////air_conditioning//////////////////////////////////////////
		if($new_filter['air_conditioning']!=''){
			$str.=" AND air_conditioning='1'";
		}
		/////////////////garden//////////////////////////////////////////
		if($new_filter['garden']!=''){
			$str.=" AND garden='1'";
		}
		/////////////////terrace//////////////////////////////////////////
		if($new_filter['terrace']!=''){
			$str.=" AND terrace='1'";
		} /////////////////balcony//////////////////////////////////////////
		if($new_filter['balcony']!=''){
			$str.=" AND balcony='1'";
		}
		//////////////////////////for address or neighbourhood or zip///////////////////////
		if($new_filter['location'] != '') {
			$location = $new_filter['location'];
			$str.=" AND (";
			$str.=" city in (select city_id from zc_city where city_name like '%".$location."%' or city_name_it like '%".$location."%')";
			$str.=" or provience in (select provience_id from zc_provience where provience_name like '%".$location."%' or provience_name_it like '%".$location."%')";
			$str.=" or zip like '%".$location."%'";
			$str.=" )";
		}
		/////////////////////add new code order by//////////////////////////////////////////
		$str1='`feature_status` DESC, `posting_time` DESC';
		if($order_option=='') {
			$str1='`feature_status` DESC, `posting_time` DESC';
		}if($order_option=='order_high_price') {
			$str1=' `price` DESC'; 
		} if($order_option=='order_low_price') {
			$str1=' `price` ASC'; 
		} if($order_option=='order_latest') {
			$str1=' `posting_time` DESC'; 
		}
		if($cat_id != '10') {
			$sql="SELECT zc_property_details.*, zc_categories.name as category_name, zc_categories.name_it as category_name_it, zc_city.*, zc_provience.*, zc_contract_types.contract_id, zc_contract_types.name as contract_name, zc_contract_types.name_it as contract_name_it FROM zc_property_details left join zc_categories on zc_property_details.category_id = zc_categories.category_id left join zc_city on zc_property_details.city = zc_city.city_id left join zc_provience on zc_property_details.provience = zc_provience.provience_id left join zc_contract_types on zc_property_details.contract_id = zc_contract_types.contract_id WHERE property_approval='1' ".$str." AND suspention_status='0' AND property_status='2' ORDER BY `feature_status` DESC";
		}else{
			$sql="SELECT zc_property_details.*, zc_categories.name as category_name, zc_categories.name_it as category_name_it, zc_city.*, zc_provience.*, zc_contract_types.contract_id, zc_contract_types.name as contract_name, zc_contract_types.name_it as contract_name_it FROM zc_property_details left join zc_categories on zc_property_details.category_id = zc_categories.category_id left join zc_city on zc_property_details.city = zc_city.city_id left join zc_provience on zc_property_details.provience = zc_provience.provience_id left join zc_contract_types on zc_property_details.contract_id = zc_contract_types.contract_id WHERE add_to_luxury='1' ".$str." AND property_approval='1' AND suspention_status='0' AND property_status='2' ORDER BY `feature_status` DESC";
		}
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
			return $data;
		}
	}
	function pop_search($qry){
		$query = $this->db->query($qry);
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
			return $data;
		}
	}
	function insert_update($qry){
		$query = $this->db->query($qry);
	}
	function delete_saved_propertys($saved_id){
		$sql="Delete from zc_saved_property where saved_id='".$saved_id."'";
		return $this->db->query($sql);
	}
	function update_save_rec($rec_option,$saved_id){
		$up_sql="update  zc_save_search set rec_option='".$rec_option."' where saved_id='".$saved_id."'";
		return $this->db->query($up_sql);
	}
}
?>