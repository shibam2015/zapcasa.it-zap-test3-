<?php
class propertym extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
		ini_set('memory_limit', '-1'); 
    }

	public function getProeprtiesByFilter($filters=''){
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
			$min_price=$filters['min_price'];
		}
		if($filters['max_price'] == ''){
			$max_price = '0';
		}else{
			$max_price = $filters['max_price'];
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
			 $where.=" AND zc_property_details.typology IN (".$typology.")";
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
		 if($filters['energyclass']!='' && $filters['energyclass']!='all')
		 {
			  $where.=" AND zc_property_details.energyclass='".$filters['energyclass']."'";
		 }
		 if($filters['heating']!='' && $filters['heating']!='all')
		 {
			  $where.=" AND zc_property_details.heating='".$filters['heating']."'";
		 }
		 if($filters['parking']!='' && $filters['parking']!='all')
		 {
			  $where.=" AND zc_property_details.parking='".$filters['parking']."'";
		 }
		 if($filters['furnished']!='' && $filters['furnished']!='all')
		 {
			  $where.=" AND zc_property_details.furnished='".$filters['furnished']."'";
		 }
		 if($filters['roommates']!='' && $filters['roommates']!='all')
		 {
			  $where.=" AND zc_property_details.roommates='".$filters['roommates']."'";
		 }
		 if($filters['occupation']!='' && $filters['occupation']!='all')
		 {
			  $where.=" AND zc_property_details.occupation='".$filters['occupation']."'";
		 }
		 if($filters['smokers']!='' && $filters['smokers']!='all')
		 {
			  $where.=" AND zc_property_details.smokers='".$filters['smokers']."'";
		 }
		 if($filters['pets']!='' && $filters['pets']!='all')
		 {
			  $where.=" AND zc_property_details.pets='".$filters['pets']."'";
		 }
		 if($filters['elevator']!='')
		 {
			  $where.=" AND zc_property_details.elevator='1'";
		 }
		 if($filters['air_conditioning']!='')
		 {
			  $where.=" AND zc_property_details.air_conditioning='1'";
		 }
		 if($filters['garden']!='')
		 {
			  $where.=" AND zc_property_details.garden='1'";
		 }
		 if($filters['terrace']!='')
		 {
			  $where.=" AND zc_property_details.terrace='1'";
		 }
		 if($filters['balcony']!='')
		 {
			  $where.=" AND zc_property_details.balcony='1'";
		 }



		if($filters['location'] != '') {
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
			}
			$where.=" AND (";
			$where.=" zc_property_details.street_address like '%".mysql_real_escape_string($street)."%' or zc_property_details.area like '%".mysql_real_escape_string($area)."%' or zc_property_details.city in (select city_id from zc_city where city_name in (select city from zc_region_master where city like '%".mysql_real_escape_string($city)."%' or city_it like '%".mysql_real_escape_string($city)."%' or province_name like '%".mysql_real_escape_string($city)."%' or province_name_it like '%".mysql_real_escape_string($city)."%'))";
			$where.=" or zc_property_details.provience in (select provience_id from zc_provience where provience_name like '%".mysql_real_escape_string($provience)."%' or provience_name_it like '%".mysql_real_escape_string($provience)."%' or provience_name like '%".mysql_real_escape_string($city)."%' or provience_name_it like '%".mysql_real_escape_string($city)."%')";
			$where.=" or zc_property_details.zip like '%".mysql_real_escape_string($zip)."%'";
			$where.=" )";
			//$str.=" AND city Like'%".$filters['location']."%' or zip Like'%".$filters['location']."%' or provience Like'%".$filters['location']."%'";
		}
		 if($filters['order_option'] == '') {
			 $orderby = ' posting_time DESC';
		 }if($filters['order_option'] == 'order_high_price') {
			 $orderby = ' `price` DESC'; 
		 } if($filters['order_option'] == 'order_low_price') {
			 $orderby = ' `price` ASC'; 
		 } if($filters['order_option'] == 'order_latest') {
			 $orderby = ' `posting_time` DESC'; 
		 }
		//$sql = "select zc_property_details.*, zc_property_img.file_name as main_img, zc_contract_types.*, zc_typologies.typology_id, zc_typologies.name as typology_name, zc_city.*, zc_region_master.Province_Code from zc_property_details left join zc_property_img on zc_property_details.property_id = zc_property_img.property_id left join zc_contract_types on zc_property_details.contract_id = zc_contract_types.contract_id left join zc_typologies on zc_property_details.typology = zc_typologies.typology_id left join zc_city on zc_property_details.city = zc_city.city_id left join zc_provience on zc_property_details.provience = zc_provience.provience_id left join zc_region_master on zc_provience.provience_name = zc_region_master.Province_Name where zc_property_img.img_type = 'main_image' ".$where;
		$sql = "select zc_property_details.*, zc_property_img.file_name as main_img, zc_contract_types.contract_id, zc_contract_types.name, zc_contract_types.name_it, zc_contract_types.short_code, zc_contract_types.desc, zc_typologies.typology_id, zc_typologies.name as typology_name, zc_typologies.name_it as typology_name_it, zc_city.city_id, zc_city.country_id, zc_city.city_name, zc_city.city_name_it, zc_region_master.province_code from zc_property_details left join zc_property_img on zc_property_details.property_id = zc_property_img.property_id left join zc_contract_types on zc_property_details.contract_id = zc_contract_types.contract_id left join zc_typologies on zc_property_details.typology = zc_typologies.typology_id left join zc_city on zc_property_details.city = zc_city.city_id left join zc_provience on zc_property_details.provience = zc_provience.provience_id left join zc_region_master on zc_city.city_name = zc_region_master.city where zc_property_img.img_type = 'main_image' ".$where." AND property_approval='1' AND suspention_status='0' ORDER BY ".$orderby;
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
				$qry1 = "select * from zc_popular_search where (ps_type = 'property_filter' || ps_type = 'property') and typology = '".$typology."' and ps_city = ".$city." and ps_provience = ".$provience." and ps_start_date <= now() and ps_end_date >= now() and ps_status = '1'";
				$row1 = $this->db->query($qry1);
				if($row1->num_rows() > 0){
					$result1 = $row1->result();
					$view = ($result1[0]->ps_views + 1);
					$arrVal['ps_views'] = $view;
					$this->db->where('ps_id', $result1[0]->ps_id);
					$this->db->update('zc_popular_search', $arrVal);
				}else {
					$qry2 = "select * from zc_popular_search where ps_keyword = '".$filters['location']."' and (ps_type = 'property_filter' || ps_type = 'property') and typology = '".$typology."' and ps_city = ".$city." and ps_provience = ".$provience." and ps_status = '1'";
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

					$qry = "insert into zc_popular_search set ps_type = 'property', ps_keyword = '".$filters['location']."', ps_url = '".$_SERVER['REQUEST_URI']."', ps_start_date = now(), ps_end_date = date_add(now(), INTERVAL +7 day), ps_views = '1', ps_created_on = now(), category_id = '".$filters['category_id']."', contract_type = '".$filters['contract_type']."', ps_street = '".$street_address."', ps_street_no = '".$street_no."', ps_zip = '".$zip."', ps_neighborhood = '".$neighborhood."', typology = '".$typology."', posted_by = '".$filters['posted_by']."', location_en = '".$poplocationeng."', location_it = '".$poplocationit."', ps_city = ".$city.",  ps_provience = ".$provience.",  ps_country = ".$country."";
					$this->db->query($qry);
				}
			}

			return $result;
        }else{
			return 0;
        }
	}

	function get_typology_list(){
		$this->db->select('name,name_it,typology_id');
		$cond=array('status'=>'active');
		$this->db->where($cond);
		$query=$this->db->get("zc_typologies");
		
		$result=array();
		$count=0;
		foreach($query->result() as $row){
			if(isset($_COOKIE['lang']) && ($_COOKIE['lang'] == "english")){
				$result[$row->typology_id] = stripslashes($row->name);
			}else{
				$result[$row->typology_id] = stripslashes($row->name_it);
			}
		}
		return $result;
	}

	function getLocations($loc,$lang){
		$_COOKIE['lang'] = $lang;
		$data = array();
		
		$LocationString = explode(',',$loc);
		$NoEleLoc = count($LocationString);
		$StreetAddressString = $LocationString[0];
		$AreaLocationString = $LocationString[0];
		$ZipCodeString = end($LocationString);
		$CityNameString = $LocationString[0];
		$ProvinceNameString = $LocationString[0];
		switch($NoEleLoc){
			case '5':
				$StreetAddressSQL = "`street_address`='".mysql_real_escape_string($LocationString[0])."' AND `city_name`='".mysql_real_escape_string($LocationString[1])."' AND `province_code`='".mysql_real_escape_string($LocationString[2])."' AND `zip`='".mysql_real_escape_string($LocationString[3])."'";
		}
		echo "1.==============".$sql2 = "SELECT `zc_property_details`.`street_address`, `zc_property_details`.zip, zc_property_details.area, zc_city.*, zc_region_master.*, zc_country_master.* from zc_property_details left join zc_city on zc_city.city_id = zc_property_details.city left join zc_provience on zc_provience.provience_id = zc_property_details.provience left join zc_region_master on zc_region_master.city = zc_city.city_name left join zc_country_master on zc_country_master.id_countries = zc_provience.country_id where street_address like '%".mysql_real_escape_string($StreetAddressString)."%'";
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
			echo "2.==============".$sql3 = "select zc_property_details.street_address, zc_property_details.zip, zc_property_details.area, zc_city.*, zc_region_master.*, zc_country_master.* from zc_property_details left join zc_city on zc_city.city_id = zc_property_details.city left join zc_provience on zc_provience.provience_id = zc_property_details.provience left join zc_region_master on zc_region_master.city = zc_city.city_name left join zc_country_master on zc_country_master.id_countries = zc_provience.country_id where area like '%".mysql_real_escape_string($AreaLocationString)."%'";
			$row3 = $this->db->query($sql3);
			if($row3->num_rows() > 0){
				$res3 = $row3->result();
				foreach($res3 as $arrData) {
					if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
						$val = $arrData->area.", ".$arrData->city_name.", ".$arrData->province_code.", ".$arrData->zip.", Italy";
					}else{
						$val = $arrData->area.", ".$arrData->city_name_it.", ".$arrData->province_code.", ".$arrData->zip.", Italia";
					}
					$data[] = $val;
				}
				return array_unique($data);
			}else{
				$sql4 = "select zc_property_details.street_address, zc_property_details.zip, zc_property_details.area, zc_city.*, zc_region_master.*, zc_country_master.* from zc_property_details left join zc_city on zc_city.city_id = zc_property_details.city left join zc_provience on zc_provience.provience_id = zc_property_details.provience left join zc_region_master on zc_region_master.city = zc_city.city_name left join zc_country_master on zc_country_master.id_countries = zc_provience.country_id where zip like '%".mysql_real_escape_string($ZipCodeString)."%'";
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
					$sql = "select zc_region_master.*, zc_country_master.* from zc_region_master left join zc_provience on zc_provience.provience_name = zc_region_master.province_name left join zc_country_master on zc_country_master.id_countries = zc_provience.country_id where (city like '".mysql_real_escape_string($CityNameString)."%' or city_it like '%".mysql_real_escape_string($CityNameString)."%')";
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
						$sql = "select zc_region_master.*, zc_country_master.* from zc_region_master left join zc_provience on zc_provience.provience_name = zc_region_master.province_name left join zc_country_master on zc_country_master.id_countries = zc_provience.country_id where (province_name like '".mysql_real_escape_string($ProvinceNameString)."%' or province_name_it like '%".mysql_real_escape_string($ProvinceNameString)."%')";
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
						return 0;
					}
				}
			}
		}
	}

	function getAdvLocations($loc,$lang){
		$_COOKIE['lang'] = $lang;
		$data = array();
		$sql2 = "select zc_user.street_address, zc_user.zip, zc_city.*, zc_region_master.*, zc_country_master.* from zc_user left join zc_city on zc_city.city_name = zc_user.city left join zc_provience on zc_provience.provience_name = zc_user.province left join zc_region_master on zc_region_master.province_name = zc_provience.provience_name left join zc_country_master on zc_country_master.id_countries = zc_provience.country_id where zc_user.street_address like '%".mysql_real_escape_string($loc)."%'";
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
			$sql4 = "select zc_user.street_address, zc_user.zip, zc_city.*, zc_region_master.*, zc_country_master.* from zc_user left join zc_city on zc_city.city_name = zc_user.city left join zc_provience on zc_provience.provience_name = zc_user.province left join zc_region_master on zc_region_master.province_name = zc_provience.provience_name left join zc_country_master on zc_country_master.id_countries = zc_provience.country_id where zip like '%".mysql_real_escape_string($loc)."%'";
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
				$sql = "select zc_region_master.*, zc_country_master.* from zc_region_master left join zc_provience on zc_provience.provience_name = zc_region_master.province_name left join zc_country_master on zc_country_master.id_countries = zc_provience.country_id where (city like '".mysql_real_escape_string($loc)."%' or city_it like '".mysql_real_escape_string($loc)."%')";
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
					$sql = "select zc_region_master.*, zc_country_master.* from zc_region_master left join zc_provience on zc_provience.provience_name = zc_region_master.province_name left join zc_country_master on zc_country_master.id_countries = zc_provience.country_id where (province_name like '".mysql_real_escape_string($loc)."%' or province_name_it like '".mysql_real_escape_string($loc)."%')";
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
					return 0;
				}
			}
		}
	}
}

?>
