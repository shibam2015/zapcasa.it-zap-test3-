<?php
class advertiserm extends CI_Model {
    //put your code here
    public function __construct() {
        parent::__construct();
    }
	public function getAdvertiserByFilter($filters='',$startpoint,$perpage){
		$where = '';
		if($filters['advertiser_type'] != '' && $filters['advertiser_type'] != 'all') {
			$where.=" and user_type = ".$filters['advertiser_type'];
		}
		if($filters['name'] != '') {
			$list = explode(" ", $filters['name']);
			if(count($list) > 1 && $list[1] != ''){
				$fname = $list[0];
				$lname = $list[1];
			}else{
				$fname = $filters['name'];
				$lname = $filters['name'];
			}
			if(isset($filters['advertiser_type']) && $filters['advertiser_type'] != '' && $filters['advertiser_type'] == "2"){
				$where.=" and (first_name like '%".mysql_real_escape_string($fname)."%' or last_name like '%".mysql_real_escape_string($lname)."%') ";
			}else if(isset($filters['advertiser_type']) && $filters['advertiser_type'] != '' && $filters['advertiser_type'] == "3"){
				$where.=" and (company_name like '%".mysql_real_escape_string($filters['name'])."%' or business_name like '%".mysql_real_escape_string($filters['name'])."%') ";
			}else{
				$where.=" and (((first_name like '%".mysql_real_escape_string($fname)."%' or last_name like '%".mysql_real_escape_string($lname)."%') and user_type!= 3) or (user_type=3 and (company_name like '%".mysql_real_escape_string($filters['name'])."%' or business_name like '%".mysql_real_escape_string($filters['name'])."%'))) ";
			}
		}
		if($filters['location'] != '') {
			$location = $filters['location'];
			$street = $location;
			$city = $location;
			$provience = $location;
			$country = $location;
			$zip = $location;
			$list = explode(", ", $location);
			if(count($list) > 4){
				if(isset($list[0]) && $list[0] != ''){
					$street = $list[0];
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
			}elseif(count($list) == 3){
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
			if(!strpos($city, "'")===false){
				$cityNameEn=get_perticular_field_value('zc_city','city_name'," and (`city_name` = '".str_replace("'","\\\''",$city)."' OR `city_name_it` = '".str_replace("'","\\\''",$city)."')");
				$cityNameIt=get_perticular_field_value('zc_city','city_name_it'," and (`city_name` = '".str_replace("'","\\\''",$city)."' OR `city_name_it` = '".str_replace("'","\\\''",$city)."')");
			}else{
				$cityNameEn=get_perticular_field_value('zc_city','city_name'," and (`city_name` = '".$city."' OR `city_name_it` = '".$city."')");
				$cityNameIt=get_perticular_field_value('zc_city','city_name_it'," and (`city_name` = '".$city."' OR `city_name_it` = '".$city."')");
			}
			//$where.=" and ( city='".$location."' or province='".$location."' or zip='".$location."' )";
			$where.=" AND (";
			$where.=" zip like '%".mysql_real_escape_string($zip)."%'";
			$where.=" ".$ZipOperatorSQL." street_address like '%".mysql_real_escape_string($street)."%'";
			if(!strpos($city, "'")===false){
				$where.=" ".$CityOperatorSQL." (city = '".mysql_real_escape_string($cityNameEn)."' OR city = '".mysql_real_escape_string($cityNameIt)."')";
			}else{
				$where.=" ".$CityOperatorSQL." (city like '%".mysql_real_escape_string($cityNameEn)."%' OR city like '%".mysql_real_escape_string($cityNameIt)."%')";
			}
			
			//$where.=" ".$ProvienceOperatorSQL." province like '%".mysql_real_escape_string($provience)."%' ";			
			$where.=" )";
			
			/***********************	Insert/Update	Popular-Search-Table	***************************/
			$keysearch = mysql_real_escape_string($filters['location']);
			$advertiser_type = $filters['advertiser_type'];
			/********	City	**************/
			if(!strpos($city, "'")===false){
				$city=get_perticular_field_value('zc_city','city_id'," and (`city_name` = '".str_replace("'","\\\''",$city)."' OR `city_name_it` = '".str_replace("'","\\\''",$city)."')");
			}else{
				$city=get_perticular_field_value('zc_city','city_id'," and (`city_name` = '".$city."' OR `city_name_it` = '".$city."')");
			}
			/********	Province	**************/			
			$provience_name=get_perticular_field_value('zc_region_master','province_name'," and `province_code` = '".$provience_code."' group by province_code");
			if(!strpos($provience_name, "'")===false){
				$provience=get_perticular_field_value('zc_provience','provience_id'," and `provience_name` = '".str_replace("'","\\''",$provience_name)."'");
			}else{
				$provience=get_perticular_field_value('zc_provience','provience_id'," and `provience_name` = '".$provience_name."'");
			}
			$country = '104';	
			
			$blank_db = $this->advertiserm->pop_search("select * from zc_popular_search where ps_type = 'advertiser_filter'");	
			if(count($blank_db) > 0){
				$qry = "select * from zc_popular_search where ps_type = 'advertiser_filter' and advertiser_type = '".$advertiser_type."' and ps_city = '".$city."' and ps_provience = '".$provience."' and ps_start_date <= now() and ps_end_date >= now() and ps_status = '1'";
				$res = $this->advertiserm->pop_search($qry);	
				if(count($res) >0){
					$view = ($res[0]['ps_views'] + 1);
					$this->advertiserm->insert_update("update zc_popular_search set ps_views = '".$view."' where ps_id = '".$res[0]['ps_id']."'");
				}else{
					$qry2 = "select * from zc_popular_search where ps_type = 'advertiser_filter' and advertiser_type = '".$advertiser_type."' and ps_city = '".$city."' and ps_provience = '".$provience."' and ps_status = '1'";
					$res2 = $this->advertiserm->pop_search($qry2);
					$this->advertiserm->insert_update("delete from zc_popular_search where ps_id = '".$res2[0]['ps_id']."'");
					
					$qry = "insert into zc_popular_search set
					ps_type = 'advertiser_filter', 
					ps_keyword = '".$keysearch."',
					ps_url = '".addslashes($_SERVER['REQUEST_URI'])."',
					ps_start_date = now(),
					ps_end_date = date_add(now(), INTERVAL +7 day),
					ps_views = '1',
					ps_created_on = now(),
					ps_street = '".addslashes($street)."',
					ps_zip = '".$zip."',
					ps_city = '".$city."',
					ps_provience = '".$provience."',
					ps_country = '".$country."',
					advertiser_type = '".$advertiser_type."', 
					location_en = '".$keysearch."',
					location_it = '".$keysearch."' ";
					$this->advertiserm->insert_update($qry);	
				}
			}else{				
				$qry = "insert into zc_popular_search set 
				ps_type = 'advertiser_filter',
				ps_keyword = '".$keysearch."',
				ps_url = '".addslashes($_SERVER['REQUEST_URI'])."',
				ps_start_date = now(),
				ps_end_date = date_add(now(), INTERVAL +7 day),
				ps_views = '1',
				ps_created_on = now(),
				ps_street = '".addslashes($street)."',
				ps_zip = '".$zip."',
				ps_city = '".$city."',
				ps_provience = '".$provience."',
				ps_country = '".$country."',
				advertiser_type = '".$advertiser_type."', 
				location_en = '".$keysearch."',
				location_it = '".$keysearch."' ";
				$this->advertiserm->insert_update($qry);
			}
		}
		$sql = "select * from zc_user left join zc_user_preference on zc_user.user_id = zc_user_preference.user_id where user_type not in(1,4) ".$where." and zc_user.status != '0' and zc_user.verified != '0' and zc_user_preference.invisible = '0' and zc_user_preference.my_address_display = '0' order by zc_user.user_id desc LIMIT ".$startpoint.", ".$perpage;
		//echo "=====".$sql;
		$row = $this->db->query($sql);
		if($row->num_rows() > 0){
			$result = $row->result();
			return $result;
        }else{
			return 0;
        }
	}
	function get_list($location,$name,$advertiser_type,$limit, $start) {
		$where = '';
		$data = array();
		if($advertiser_type!='') {
			//$where.=" AND status='1' ";
			if($advertiser_type=='all') {
				$user_type='2,3';
			} if($advertiser_type=='2') {
				$user_type='2';
			} if($advertiser_type=='3'){
				$user_type='3';
			}
			//$where.= " and user_type in (".$user_type.") ";
			if(isset($name) && $name!='') {
				$list = explode(" ", $filters['name']);
				if(count($list) > 1 && $list[1] != ''){
					$fname = $list[0];
					$lname = $list[1];
				}else{
					$fname = $name;
					$lname = $name;
				}
				if(isset($advertiser_type) && $advertiser_type != '' && $advertiser_type == "2"){
					$where.=" and (first_name like '%".mysql_real_escape_string($fname)."%' or last_name like '%".mysql_real_escape_string($lname)."%') ";
				}else if(isset($advertiser_type) && $advertiser_type != '' && $advertiser_type == "3"){
					$where.=" and (company_name like '%".mysql_real_escape_string($name)."%' or business_name like '%".mysql_real_escape_string($name)."%') ";
				}else{
					$where.=" and (((first_name like '%".mysql_real_escape_string($fname)."%' or last_name like '%".mysql_real_escape_string($lname)."%') and user_type!= 3) or (user_type=3 and (company_name like '%".mysql_real_escape_string($name)."%' or business_name like '%".mysql_real_escape_string($name)."%'))) ";
				}
			}
			if($location != '') {
				$location = $location;
				$street = $location;
				$city = $location;
				$provience = $location;
				$country = $location;
				$zip = $location;
				$list = explode(", ", $location);
				if(count($list) > 4){
					if(isset($list[0]) && $list[0] != ''){
						$street = $list[0];
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
				}elseif(count($list) == 3){
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
				
				if(!strpos($city, "'")===false){
					$cityNameEn=get_perticular_field_value('zc_city','city_name'," and (`city_name` = '".str_replace("'","\\\''",$city)."' OR `city_name_it` = '".str_replace("'","\\\''",$city)."')");
					$cityNameIt=get_perticular_field_value('zc_city','city_name_it'," and (`city_name` = '".str_replace("'","\\\''",$city)."' OR `city_name_it` = '".str_replace("'","\\\''",$city)."')");
				}else{
					$cityNameEn=get_perticular_field_value('zc_city','city_name'," and (`city_name` = '".$city."' OR `city_name_it` = '".$city."')");
					$cityNameIt=get_perticular_field_value('zc_city','city_name_it'," and (`city_name` = '".$city."' OR `city_name_it` = '".$city."')");
				}
					//$where.=" and ( city='".$location."' or province='".$location."' or zip='".$location."' )";
				$where.=" AND (";
				$where.=" zip like '%".mysql_real_escape_string($zip)."%'";
				$where.=" ".$ZipOperatorSQL." street_address like '%".mysql_real_escape_string($street)."%'";
				$where.=" ".$CityOperatorSQL." (city like '%".mysql_real_escape_string($cityNameEn)."%' OR city like '%".mysql_real_escape_string($cityNameIt)."%')";
				//$where.=" ".$ProvienceOperatorSQL." province like '%".mysql_real_escape_string($provience)."%' ";			
				$where.=" )";
				
				
			}
		
			//$sql="select * from zc_user where ".$where." and user_type in (".$user_type.") ORDER BY `user_id` DESC LIMIT $start ,$limit";
			$sql = "select * from zc_user left join zc_user_preference on zc_user.user_id = zc_user_preference.user_id where user_type in (".$user_type.") ".$where." and zc_user.status != '0' and zc_user_preference.invisible = '0' and zc_user_preference.my_address_display = '0' order by zc_user.user_id DESC LIMIT $start ,$limit";
			
			//echo "====".$sql;
			
			$query=$this->db->query($sql);
				
			if($query->num_rows()>0){
					
				foreach($query->result_array() as $row){
					$data[]=$row;
				}
					
			}
		}
		return $data;
	}
	function get_advertiser_count($location,$name,$advertiser_type) {
		$where = '';
		$data = 0;
		if($advertiser_type!='') {
			$where.=" AND status='1' ";
			if($advertiser_type=='all') {
				$user_type='2,3';				
			} if($advertiser_type=='2') {
				$user_type='2';
			} if($advertiser_type=='3'){
				$user_type='3';
			}
			$where.= " and user_type in (".$user_type.") ";
			/*
			if(isset($name) && $name!='') {
				$names=explode(' ',$name);
				if(count($names)==2) {
					$first_name=$names['0'];
					$last_name=$names['1'];
					$where.="AND first_name='".$first_name."' and last_name='".$last_name."'";
				} if(count($names)==1){
					$where.="AND first_name='".$names['0']."' or last_name='".$names['0']."'";
				}
			}
			*/
			if(isset($name) && $name!='') {
				$list = explode(" ", $filters['name']);
				if(count($list) > 1 && $list[1] != ''){
					$fname = $list[0];
					$lname = $list[1];
				}else{
					$fname = $name;
					$lname = $name;
				}
				if(isset($advertiser_type) && $advertiser_type != '' && $advertiser_type == "2"){
					$where.=" and (first_name like '%".mysql_real_escape_string($fname)."%' or last_name like '%".mysql_real_escape_string($lname)."%') ";
				}else if(isset($advertiser_type) && $advertiser_type != '' && $advertiser_type == "3"){
					$where.=" and (company_name like '%".mysql_real_escape_string($name)."%' or business_name like '%".mysql_real_escape_string($name)."%') ";
				}else{
					$where.=" and (((first_name like '%".mysql_real_escape_string($fname)."%' or last_name like '%".mysql_real_escape_string($lname)."%') and user_type!= 3) or (user_type=3 and (company_name like '%".mysql_real_escape_string($name)."%' or business_name like '%".mysql_real_escape_string($name)."%'))) ";
				}
			}

			

			/*********************/
			if($location != '') {
				$location = $location;
				$street = $location;
				$city = $location;
				$provience = $location;
				$country = $location;
				$zip = $location;
				$list = explode(", ", $location);
				if(count($list) > 4){
					if(isset($list[0]) && $list[0] != ''){
						$street = $list[0];
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
				}elseif(count($list) == 3){
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
				
				if(!strpos($city, "'")===false){
					$cityNameEn=get_perticular_field_value('zc_city','city_name'," and (`city_name` = '".str_replace("'","\\\''",$city)."' OR `city_name_it` = '".str_replace("'","\\\''",$city)."')");
					$cityNameIt=get_perticular_field_value('zc_city','city_name_it'," and (`city_name` = '".str_replace("'","\\\''",$city)."' OR `city_name_it` = '".str_replace("'","\\\''",$city)."')");
				}else{
					$cityNameEn=get_perticular_field_value('zc_city','city_name'," and (`city_name` = '".$city."' OR `city_name_it` = '".$city."')");
					$cityNameIt=get_perticular_field_value('zc_city','city_name_it'," and (`city_name` = '".$city."' OR `city_name_it` = '".$city."')");
				}
					//$where.=" and ( city='".$location."' or province='".$location."' or zip='".$location."' )";
				$where.=" AND (";
				$where.=" zip like '%".mysql_real_escape_string($zip)."%'";
				$where.=" ".$ZipOperatorSQL." street_address like '%".mysql_real_escape_string($street)."%'";
				$where.=" ".$CityOperatorSQL." (city like '%".mysql_real_escape_string($cityNameEn)."%' OR city like '%".mysql_real_escape_string($cityNameIt)."%')";
				//$where.=" ".$ProvienceOperatorSQL." province like '%".mysql_real_escape_string($provience)."%' ";			
				$where.=" )";
			}
	
			$sql = "select * from zc_user left join zc_user_preference on zc_user.user_id = zc_user_preference.user_id where user_type not in(1,4) ".$where." and zc_user_preference.invisible = '0' and zc_user_preference.my_address_display = '0' order by zc_user.user_id desc";
			
			//echo "=====".$sql="select user_id from zc_user where ".$where." and user_type in (".$user_type.")" ;
			$query=$this->db->query($sql);
			$data=$query->num_rows();
		}
		return $data;
	}
	/////////////////////get advertiser details/////////////////////
	function get_advertiser_detial($advertiser_id){
		$sql="select * from zc_user where user_id='".$advertiser_id."'";
		$query=$this->db->query($sql);
		$data = array();	
		if($query->num_rows()>0){	
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	/////////////property list of owner/agency//////////////////////
	function get_property_list($advertiser_id){
		$sql="select * from zc_property_details where property_post_by='".$advertiser_id."' and property_status='2' and property_approval='1' and suspention_status='0' order by `property_id` desc LIMIT 0,5";
		$query=$this->db->query($sql);
		$data = array();
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	/////////////////get feedback////////////////////////////////////////
	function get_feedback($limit=0, $start=0) {
		$feedback_to_id=$this->session->userdata('user_id');
		$sql = "select * from zc_feedback where feedback_to_id='" . $feedback_to_id . "' and feedback_status='1' ORDER BY feedback_date,feedback_id desc LIMIT $start ,$limit";
		$query=$this->db->query($sql);
		$data = array();	
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}
	function get_feedback_details($msg_id) {
		$uid=$this->session->userdata( 'user_id' );
		$sql="select * from zc_feedback where feedback_id='".$msg_id ."' and feedback_status='1' and `feedback_to_id` = '".$uid."'";
		$query=$this->db->query($sql);
			
			if($query->num_rows()>0){
				
				foreach($query->result_array() as $row){
					$data[]=$row;
				}
				return $data;
			}
	}
	function delete_feedback($delete_msg_ids) {
		foreach($delete_msg_ids as $key=>$val){
			//$msg_grp_id=get_perticular_field_value('zc_feedback','msg_grp_id'," and msg_id='".$val."'");
			$sql_del="delete from zc_feedback where feedback_id='".$val."'";
			$this->db->query($sql_del);
		}
		return 1;
	}
	function delete_bulk_feedback($delete_msg_ids) {
			$sql_del="delete from zc_feedback where feedback_id='".$delete_msg_ids."'";
			$this->db->query($sql_del);
	}
	function get_ajax_simple_list($term) {
		return $term;
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
	function change_read_status_feedback($id){
		$uid=$this->session->userdata( 'user_id' );
		$sql="Update zc_feedback set read_status='1' where feedback_to_id='".$uid."' and feedback_id='".$id."'";
		return $this->db->query($sql);
	}
	public function AdvertiserListingPages($filters='',$limit, $path, $cureentPage,$returnType){
		$where = '';
		if($filters['advertiser_type'] != '' && $filters['advertiser_type'] != 'all') {
			$where.=" and user_type = ".$filters['advertiser_type'];
		}
		if($filters['name'] != '') {
			$list = explode(" ", $filters['name']);
			if(count($list) > 1 && $list[1] != ''){
				$fname = $list[0];
				$lname = $list[1];
			}else{
				$fname = $filters['name'];
				$lname = $filters['name'];
			}
			if(isset($filters['advertiser_type']) && $filters['advertiser_type'] != '' && $filters['advertiser_type'] == "2"){
				$where.=" and (first_name like '%".mysql_real_escape_string($fname)."%' or last_name like '%".mysql_real_escape_string($lname)."%') ";
			}else if(isset($filters['advertiser_type']) && $filters['advertiser_type'] != '' && $filters['advertiser_type'] == "3"){
				$where.=" and (company_name like '%".mysql_real_escape_string($filters['name'])."%' or business_name like '%".mysql_real_escape_string($filters['name'])."%') ";
			}else{
				$where.=" and (((first_name like '%".mysql_real_escape_string($fname)."%' or last_name like '%".mysql_real_escape_string($lname)."%') and user_type!= 3) or (user_type=3 and (company_name like '%".mysql_real_escape_string($filters['name'])."%' or business_name like '%".mysql_real_escape_string($filters['name'])."%'))) ";
			}
		}
		if($filters['location'] != '') {
			$location = $filters['location'];
			$street = $location;
			$city = $location;
			$provience = $location;
			$country = $location;
			$zip = $location;
			$list = explode(", ", $location);
			if(count($list) > 4){
				if(isset($list[0]) && $list[0] != ''){
					$street = $list[0];
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
			}elseif(count($list) == 3){
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
			if(!strpos($city, "'")===false){
				$cityNameEn=get_perticular_field_value('zc_city','city_name'," and (`city_name` = '".str_replace("'","\\\''",$city)."' OR `city_name_it` = '".str_replace("'","\\\''",$city)."')");
				$cityNameIt=get_perticular_field_value('zc_city','city_name_it'," and (`city_name` = '".str_replace("'","\\\''",$city)."' OR `city_name_it` = '".str_replace("'","\\\''",$city)."')");
			}else{
				$cityNameEn=get_perticular_field_value('zc_city','city_name'," and (`city_name` = '".$city."' OR `city_name_it` = '".$city."')");
				$cityNameIt=get_perticular_field_value('zc_city','city_name_it'," and (`city_name` = '".$city."' OR `city_name_it` = '".$city."')");
			}
			//$where.=" and ( city='".$location."' or province='".$location."' or zip='".$location."' )";
			$where.=" AND (";
			$where.=" zip like '%".mysql_real_escape_string($zip)."%'";
			$where.=" ".$ZipOperatorSQL." street_address like '%".mysql_real_escape_string($street)."%'";
			if(!strpos($city, "'")===false){
				$where.=" ".$CityOperatorSQL." (city = '".mysql_real_escape_string($cityNameEn)."' OR city = '".mysql_real_escape_string($cityNameIt)."')";
			}else{
				$where.=" ".$CityOperatorSQL." (city like '%".mysql_real_escape_string($cityNameEn)."%' OR city like '%".mysql_real_escape_string($cityNameIt)."%')";
			}
			
			//$where.=" ".$ProvienceOperatorSQL." province like '%".mysql_real_escape_string($provience)."%' ";			
			$where.=" )";
		}
		$total_pages = 0;
		$sql = "select count(*) as `num` from zc_user left join zc_user_preference on zc_user.user_id = zc_user_preference.user_id where user_type not in(1,4) ".$where." and zc_user.status != '0' and zc_user.verified != '0' and zc_user_preference.invisible = '0' and zc_user_preference.my_address_display = '0' order by zc_user.user_id desc";
		
		$row = $this->db->query($sql);		
		if($row->num_rows()>0){
			$result = $row->result();
			$total_pages = $result[0]->num;
		}
		
		if($returnType=='advertisercounter'){
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
}
?>