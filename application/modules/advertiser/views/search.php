<?php $this->load->view("inc/header");?>
<style>
.nicescroll-rails{
	display:none; 
 }
 .fullScreen
{
	width: 100% !important;
	z-index: 100 !important;
	height: 450px !important;
	transition: all 2s;
}
#map_canvas{ transition: all 2s; }
</style>
<div class="main main_searchpage">
	<div id="breadcrumb" class="fk-lbreadbcrumb newvd">
		<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('advertise_list_home');?></a></span> &gt;
		<span><a href="<?php echo base_url();?>advertiser/search?location=&name=&advertiser_type=all"><?php echo $this->lang->line('advertiser_title_details');?></a></span>
		<?php
		if(count($_GET)==1 && $_GET['advertiser_type']=='all'){
			
		}else{
		?>
		&gt; <span><?php echo $this->lang->line('advertise_list_search_result');?></span>
		<?php
		}
		?>
	</div>
	<div class="refinesearch">
		<?php $this->load->view("advertiser/search_header_advertiser"); ?>
	</div>
	<h2 class="searchfound">
		<?php echo $this->lang->line('advertise_list_rentals');?> 
		
		<font style="font-size:12px; font-weight:normal;"><?php echo $advertiserCount;?> <?php echo $this->lang->line('advertise_list_results');?></font>
		<span class="post_brn">
			<?php
			$user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$this->session->userdata( 'user_id' )."'");
			if($user_type=='2' || $user_type=='3') {
			?> 
			<a href="<?php echo base_url();?>property/add_property_form" class="freepost">
				<?php echo $this->lang->line('advertise_details_post_your_property');?> 
				<font style="color:#fff000">
					<?php echo $this->lang->line('advertise_details_free');?>
				</font>
			</a>
			<?php
			}elseif($user_type=='1') {
			?> 
			<a href="<?php echo base_url();?>property/add_property_form" class="freepost add_property">
				<?php echo $this->lang->line('advertise_details_post_your_property');?> 
				<font style="color:#fff000">
					<?php echo $this->lang->line('advertise_details_free');?>
				</font>
			</a>
			<?php
			}elseif($this->session->userdata( 'user_id' )=='0'  || $this->session->userdata( 'user_id' )=='' ) {
			?>
			<a href="<?php echo base_url();?>users/common_reg" class="freepost">
				<?php echo $this->lang->line('advertise_details_post_your_property');?> 
				<font style="color:#fff000">
					<?php echo $this->lang->line('advertise_details_free');?>
				</font>
			</a>
			<?php
			}
			?>
		</span>
	</h2>
	<!-- <div class="rightmap_area"><img src="images/map_small.jpg" ></div>-->
	<div class="rightmap_area" id="map_canvas" style="width:445px;height:367px;border:solid 1px #DDDDDD;"></div>
	<div class="searchresult_box searchresult_box2" style="height:660px ! important;overflow:hidden;">
		<div style="width:100%;overflow:auto;height:620px !important;overflow:auto;">
			<!--<div id="paginationdemo" class="demo">
				<div id="p1" class="pagedemo _current">-->
			<ul>
		<?php
			if(!empty($advertiser_lists) && $advertiser_lists != 0) {
				$alt = 0;
				$gMapCounter = 0;				
				foreach($advertiser_lists as $arrAdv){
					$advertiserGeoAddress = "";
					$link = base_url().'advertiser/advertiser_details/'.$arrAdv->user_id;
					$business_name = "";
					$user_type = "";
					$nameForBusiness = "";
					if($arrAdv->user_type == '3') {
						$business_name = ucfirst($arrAdv->company_name);
						$user_type = $this->lang->line('advertise_list_advertiser_agency');
						$nameForBusiness = ucfirst($arrAdv->business_name);
					}else {
						$business_name = ucfirst($arrAdv->first_name) ." " .ucfirst($arrAdv->last_name);
						$user_type = $this->lang->line('advertise_list_advertiser_owner');
					}
		?>
				<li>
					<div class="listingImg">
						<a href="<?php echo $link;?>">
		<?php
						if($arrAdv->file_1 != '') {
		?>
							<img src="<?php echo base_url();?>assets/uploads/thumb_92_82/<?php echo $arrAdv->file_1; ?>" alt="<?php echo $business_name; ?>">
		<?php
						}else{
		?> 
							<img src="<?php echo base_url();?>assets/images/no_prof.png" alt="<?php echo $business_name; ?>" <?php if( $arrAdv->user_type == '2') { ?> style="max-width: 170px; max-height: 100px;" <?php } else { ?>width="102px" height="68px;" <?php }?> >
		<?php
						}
		?>
					<div class="listingShw" style="background-size:107px;"></div>
					</a>
					</div>
					<div class="listingContent">
						<h2 style="padding: 0 0 5px;" ><a href="<?php echo $link;?>" onMouseOver="goToMarker('<?php echo $gMapCounter; ?>')" onMouseOut="markerListMouseOut('<?php echo $gMapCounter; ?>')"><?php echo $business_name;?></a></h2>
		<?php 
						if($arrAdv->my_address_display == 0 ){  
		?>
						<div class="listAddress">
		<?php 
							if( $nameForBusiness != "" ) {
		?>
							<p style="font-weight: bold;color: #000000;" ><?php echo $nameForBusiness; ?></p>
		<?php				} 
		?>
							<h4>
		<?php
							if($arrAdv->street_address) { echo $arrAdv->street_address; }
							if($arrAdv->street_no) { echo ', '.$arrAdv->street_no; }
							if($arrAdv->zip) { echo ' - '.$arrAdv->zip; }
							if($arrAdv->city){
								if(!strpos($arrAdv->city, "'")===false){
									$city_name=get_perticular_field_value('zc_city',($_COOKIE['lang']=='english'?"city_name":"city_name_it")," and `city_name` = '".str_replace("'","\\\''",stripslashes($arrAdv->city))."' OR `city_name_it` = '".str_replace("'","\\\''",stripslashes($arrAdv->city))."'");
								}else{
									$city_name=get_perticular_field_value('zc_city',($_COOKIE['lang']=='english'?"city_name":"city_name_it")," and `city_name` = '".$arrAdv->city."' OR `city_name_it` = '".$arrAdv->city."'");
								}
								echo ' '.stripslashes($city_name);
							}
							
							if(!strpos($arrAdv->province, "'")===false){
								$st_name1=get_perticular_field_value('zc_region_master','province_code'," and `province_name` = '".str_replace("'","\\\''",stripslashes($arrAdv->province))."' group by province_code");
							}else{
								$st_name1=get_perticular_field_value('zc_region_master','province_code'," and `province_name` LIKE '%".$arrAdv->province."%' group by province_code");
							}
							
							
							if( $st_name1 != "" ) { echo ' - '.$st_name1; } 
		?>
							</h4>
							<p><?php echo $user_type; ?></p>
						</div>
		<?php 
						} 
		?>
						<div class="propFeatures">
							<h3><?php echo $this->lang->line('advertise_list_property_post');?> <font style="color:#ED6B1F"><?php echo get_perticular_count('zc_property_details'," and property_post_by='".$arrAdv->user_id."' AND property_status='2' AND suspention_status='0'");?></font></h3>
						</div>
					</div>
				</li>
		<?php

				if($_COOKIE['lang']=="it"){
					if(!strpos($arrAdv->city, "'")===false){
						$ShowingCityName=get_perticular_field_value('zc_region_master','city_it'," and (city = '".str_replace("'","\\\'",$arrAdv->city)."' OR city_it = '".str_replace("'","\\\'",$arrAdv->city)."') group by province_code");
					}else{
						$ShowingCityName=get_perticular_field_value('zc_region_master','city_it'," and (city = '".$arrAdv->city."' OR city_it = '".$arrAdv->city."') group by province_code");
					}
					//
					if(!strpos($arrAdv->province, "'")===false){
						$ShowingProvinceCode=get_perticular_field_value('zc_region_master','province_code'," and (province_name = '".str_replace("'","\\\'",$arrAdv->province)."' OR province_name_it = '".str_replace("'","\\\'",$arrAdv->province)."') group by province_code");
					}else{
						$ShowingProvinceCode=get_perticular_field_value('zc_region_master','province_code'," and (province_name = '".$arrAdv->province."' OR province_name_it = '".$arrAdv->province."') group by province_code");
					}
				}else{
					if(!strpos($arrAdv->province, "'")===false){
						$ShowingCityName=get_perticular_field_value('zc_region_master','city'," and (city = '".str_replace("'","\\\'",$arrAdv->city)."' OR city_it = '".str_replace("'","\\\'",$arrAdv->city)."') group by province_code");
					}else{
						$ShowingCityName=get_perticular_field_value('zc_region_master','city'," and (city = '".$arrAdv->city."' OR city_it = '".$arrAdv->city."') group by province_code");
					}
					//
					if(!strpos($arrAdv->province, "'")===false){							
						$ShowingProvinceCode=get_perticular_field_value('zc_region_master','province_code'," and (province_name = '".str_replace("'","\\\'",$arrAdv->province)."' OR province_name_it = '".str_replace("'","\\\'",$arrAdv->province)."') group by province_code");
					}else{
						$ShowingProvinceCode=get_perticular_field_value('zc_region_master','province_code'," and (province_name = '".$arrAdv->province."' OR province_name_it = '".$arrAdv->province."') group by province_code");
					}
				}
				if( $arrAdv->street_address) {
					$advertiserAddress.= stripslashes($arrAdv->street_address);
				}
				if( $arrAdv->street_no) {
					$advertiserAddress.= ', '.stripslashes($arrAdv->street_no);
				}
				if( $arrAdv->zip) {
					$advertiserAddress.= ' - '.$arrAdv->zip;
				}
				if( $ShowingCityName != "" ) {
					$advertiserAddress.= ' '.stripslashes($ShowingCityName);
				}
				if( $ShowingProvinceCode != "" ) {
					$advertiserAddress.= ' - '.$ShowingProvinceCode;
				}

				$advertiserGeoAddress.= stripslashes($ShowingCityName).', '.$ShowingProvinceCode.', '.$arrAdv->zip.', Italy';
				$lat_lng_array = getLangLat($advertiserGeoAddress);
				$GoogleMapMarkersLatitude = $lat_lng_array->lat;
				$GoogleMapMarkersLongitude = $lat_lng_array->lng;
				if($arrAdv->file_1 == "")
					$img = base_url().'assets/images/no_prof.png';
				else
					$img = base_url().'assets/uploads/thumb_92_82/'.$arrAdv->file_1;
				$alt++;
				if($alt > 1){
					$alt = 0;
				}
				$GoogleMapMarkers[$gMapCounter] = array(
					'proptitle' => $business_name,
					'hackerspace' => 'markers',
					'latitude' => $GoogleMapMarkersLatitude,
					'longitude' => $GoogleMapMarkersLongitude,
					'proaddress' => $advertiserGeoAddress,
					'propurl' => $link,
					'proprice' => null,
					'proimg' => $img,
				);
				$gMapCounter++;
				}
		?>
				<div class="clear"></div>	  
		<?php  
			}else{
		?>
				<div class="no_record_search"> <?php echo $this->lang->line('advertise_list_sorry_no_record_found');?></div>
		<?php
			}
		?>
			</ul>
		<!--</div>
			<div id="p2" class="pagedemo" style="display:none;">Page 2</div>
			<div id="demo5"></div>
		</div>-->
		</div>
		<div style="float: right; width: 100%; border-top: 1px solid #EEEEEE;">
			<fieldset id="inputs">
				<?php echo $pagination; ?>
			</fieldset>
		</div>
		<div class="clear"></div>
	</div>
		<?php /*
		<div class="google_ad"><img src="<?php echo base_url()?>assets/images/google_ad_300x250.jpg" ></div>
		*/ ?>
                 <?php 
				$google_adsence = get_perticular_field_value('zc_settings','meta_value'," and meta_name='google_adsence'"); 
				if( isset($google_adsence) && ( count($google_adsence) > 0 ) ) {
			?>
					<div class="google_ad">
					<?php 
						print_r($google_adsence);
					?>
					</div>
			<?php } ?>

</div>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/map.css?nocache=289671982568" type="text/css"/>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/label.js"></script>
<script type="text/javascript">
var WebRoot = '<?php echo base_url(); ?>';
var centerZoom = 4;
var centerLatitude = <?php echo(!empty($GoogleMapMarkers)?$GoogleMapMarkers[0]['latitude']:'41.500000'); ?>;
var centerLongitude = <?php echo(!empty($GoogleMapMarkers)?$GoogleMapMarkers[0]['longitude']:'21.500000'); ?>;
var map;
var infowindow = null;
var gmarkers = [];
var markerTitles = [];
var highestZIndex = 0;
var agent = "default";
var zoomControl = true;
var MarkerDraggable = false;
var DrawCircleAroundMarker = false;
var CircleMapRadius = 750;
var geocoder;
var markerTitles = [];
// markers array: name, type (icon), lat, long, description, uri, address
GoogleMapMarkers = new Array();
<?php
if(!empty($GoogleMapMarkers)){
	$gMi = 0;
	foreach($GoogleMapMarkers as $gM){
?>
GoogleMapMarkers.push(["<?php echo $gM['proptitle']; ?>","<?php echo $gM['hackerspace']; ?>",<?php echo $gM['latitude']; ?>,<?php echo $gM['longitude']; ?>,"<?php echo $gM['proaddress']; ?>","<?php echo $gM['propurl']; ?>",'<?php echo $gM['proprice']; ?>',"<?php echo $gM['proimg']; ?>"]);		
markerTitles[<?php echo $gMi; ?>] = "<?php echo $gM['proptitle']; ?>";
<?php
	$gMi++;
	}
}
?>

</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/represent-map.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/markerclusterer.js"></script>
<?php $this->load->view("inc/footer");?>