<?php $this->load->view("inc/header");?>
<?php $this->load->view("_include/login_user"); ?> 
<!--popup for save search-->
<?php $this->load->view("_include/saved_search"); ?> 
<?php $this->load->view("_include/information"); ?>
<?php $this->load->view("_include/information_mail"); ?>
<style type="text/css">
#wrapper{position: relative;}
.no_decoration_anchor{color:#3D8AC1;font-weight:bold;}
.desc_prop{font-weight:bold;}
.enlarge{width:100%;position:absolute;}
.nicescroll-rails{display:none;}
.fullScreen
{
	width: 100% !important;
	z-index: 100 !important;
	height: 450px !important;
	transition: all 2s;
}
#map_canvas{ transition: all 2s; }
</style>
<script type="text/javascript">
$(document).ready(function() {	
	$('#nav li').hover(function() {
		$('ul', this).slideDown(200);
		$(this).children('a:first').addClass("hov");
	}, function() {
		$('ul', this).slideUp(100);
		$(this).children('a:first').removeClass("hov");		
	});	
});
$(function(){
	$(window).scroll(function(){
		var scrollTop = $(document).scrollTop();
	});
});
</script>

<form class="form" id="form_order" method="get" action="<?php echo base_url();?>property/search">
	<div class="main main_searchpage">
		<div id="breadcrumb" class="fk-lbreadbcrumb newvd">
			<span>
				<a href="<?php echo base_url();?>">
					<?php echo $this->lang->line('property_search_home');?>
				</a>
			</span> &gt; 
			<?php
			if($parentCatname != ''){
			?>
			<span>
				<a href="<?php echo base_url();?>property/search?category_id=<?php echo $parent_id;?>">
					<?php echo $parentCatname;?>
				</a>
			</span> &gt;
			<?php
			}			
			if($category_id == 6 || $category_id == 7 || $category_id == 10){
				if($parentCatname){
					$breadCrumbLinkSub = base_url().'property/search?category_id='.$parent_id.'&'.($category_id == 10 ? 'for_luxury='.$_GET['for_luxury']: 'for_business='.$_GET['for_business']);
				}else{
					$breadCrumbLinkSub = base_url().'property/search?category_id='.$category_id;
				}
			?>
			<span>
				<a href="<?php echo $breadCrumbLinkSub; ?>">
					<?php echo $search_title;?>
				</a>
			</span> &gt;
			<?php
			}else{
			?>
			<span>
				<a href="<?php echo base_url();?>property/search?category_id=<?php echo $category_id;?>">
					<?php echo $search_title;?>
				</a>
			</span> &gt;
			<?php
			}
			?>
			<span><?php echo $this->lang->line('property_search_search_result');?></span>
		</div>
		
		<div class="refinesearch">
			<?php $this->load->view("property/search_header"); ?>
		</div>
		<?php 
		$count = 0;
		if($property_details != 0 && count($property_details) > 0){
			//$count = number_format(count($property_details));
		}
		?>

		<h2 class="searchfound">
			<?php
			if($parentCatname != ''){
			?>
			<?php echo $parentCatname;?> - 
			<?php
			}
			?>
			<?php echo ucwords(strtolower($search_title));?> 
			<font style="font-size:12px; font-weight:normal;">
				<?php echo $propertyCount;?> <?php echo $this->lang->line('property_search_results');?>
			</font> 
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
		<?php
		if(!empty($property_details)){
		?>
		<div class="rightmap_area" id="map_canvas" style="width:445px;height:367px;border:solid 1px #DDDDDD;"></div>
		<?php
		}
		?>
		<div id="search_full" class="searchresult_box" style="height:640px !important;">
			<div style="float: right; width: 100%; border-bottom: 1px solid #EEEEEE;">
				<fieldset id="inputs">
				<?php
				$order_option="order_latest";
				if( isset( $_GET['order_option'] ) && ( $_GET['order_option'] != "" ) ) {
					$order_option=$this->input->get('order_option');
				}
				if(count($property_details) > 0 ) { 
				?>
					<select name="order_option" id="order_option" onChange="return do_order();" style="width: 150px; float: right; margin: 5px 3px 5px 0px;">
						<option value="order_latest" <?php if($order_option=='order_latest'){?>selected<?php }?>><?php echo $this->lang->line('property_search_order_by_latest_first');?></option>
						<option value="order_high_price" <?php if($order_option=='order_high_price'){?> selected<?php }?>><?php echo $this->lang->line('property_search_highest_price_first');?></option>
						<option value="order_low_price" <?php if($order_option=='order_low_price'){?> selected<?php }?>><?php echo $this->lang->line('property_search_lowest_price_first');?></option>
					</select>
				<?php
				}
				?>
				</fieldset>
			</div>
			
			<!--<div id="paginationdemo" class="demo">
			<div id="p1" class="pagedemo _current">-->
			<div style="overflow: auto; position: relative; float: left; height: 552px ! important;width:100%;">
				<ul>
				<?php
				$GoogleMapMarkers = array();
				$l=1;				
				if(!empty($property_details) && $property_details != 0) {
					$alt = 0;
					$gMapCounter = 0;
					foreach($property_details as $arrProp) {
						$first_segment="";
						if($_GET['category_id']=='10' || $_GET['for_luxury']!=''){
							if($_GET['for_luxury']!=''){
								$first_segment='Luxury-'.ucfirst(strtolower($_GET['for_luxury']));
							}else{
								$first_segment='Luxury';
							}
						}elseif($_GET['category_id']=='6' || $_GET['category_id']=='7' || $_GET['for_business']!=''){
							if($_GET['for_business']!=''){
								$first_segment='Business-'.ucfirst(strtolower($_GET['for_business']));
							}else{
								$first_segment='Business';
							}
						}else{
							$category_id=$arrProp->category_id;
							if($category_id=='6' || $category_id=='7'){
								$first_segment='Business';
							}elseif($category_id=='1'){
								$first_segment='Residential';
							}elseif($category_id=='3'){
								$first_segment='Rooms';
							}elseif($category_id=='4'){
								$first_segment='Land';
							}elseif($category_id=='5'){
								$first_segment='Vacations';
							}
						}						
						$prop_det_url='';
						if($arrProp->contract_id==1){
							$contract="Rent";
						}elseif($arrProp->contract_id==2){
							$contract="Sell";
						}
						$prop_det_url.=$contract;
						$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$arrProp->typology."'");
						//$prop_det_url.='-'.trim($typology_name);
						if($_COOKIE['lang'] == "english")				
						{
							$prop_det_url.='-'.trim($arrProp->city_name);
							$prop_det_url.='-'.trim($arrProp->provience_name);
						}
						else
						{
							$prop_det_url.='-'.trim($arrProp->city_name_it);
							$prop_det_url.='-'.trim($arrProp->provience_name_it);
						}
						$prop_det_url.='-'.trim($arrProp->property_id);						
						?>
					<li class="<?php echo($alt>0?'alt':''); ?>" <?php echo($arrProp->feature_status == 1?'style="background-color:rgb(233, 242, 255);"':''); ?>>
						<?php
						if($arrProp->feature_status == 1){
						?>
						<div style="text-align:left; margin-left:6px;">
							<span style="color: rgb(163, 163, 10); font-weight:bold;"><?php echo $this->lang->line('property_search_paid_add');?> -</span>
							<a href="<?php echo base_url();?>site/Highlight_your_advert"><span style="color: rgb(163, 163, 10);"> <?php echo $this->lang->line('property_search_paid_add_read_more');?></span></a>
						</div>
						<?php
						}
						?>
						<div class="listingImg">
							<?php
							$count_img=get_perticular_count('zc_property_img'," and property_id='".$arrProp->property_id."' and img_type!='preliminary'");
							if($arrProp->main_img != ''){
								$propertyImage = base_url().'assets/uploads/Property/Property'.$arrProp->property_id.'/thumb_200_296/'.$arrProp->main_img;
							}else{
								$propertyImage = base_url().'assets/images/no_proimg.jpg';
							}
							?>
							<a href="<?php echo base_url();?><?php echo $first_segment;?>/<?php echo $prop_det_url;?>">
								<img src="<?php echo $propertyImage; ?>" alt="">
								<figcaption class="photo-count">
									<?php echo $count_img;?> <?php echo $this->lang->line('property_search_photos');?>
								</figcaption>
								<div class="listingShw"></div>
							</a>
							<?php
							if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
								$proptitle = $arrProp->name." For ".stripslashes($arrProp->typology_name)." in ".stripslashes($arrProp->city_name).", ".$arrProp->province_code;
							}else{
								$proptitle = stripslashes($arrProp->typology_name_it)." in ".$arrProp->name_it." a ".stripslashes($arrProp->city_name_it).", ".$arrProp->province_code;
							}							
							?>
							<div style="text-align:left; margin-left:6px;">
								<?php echo $this->lang->line('property_search_published');?> 
								<?php
								switch(date('m',strtotime($arrProp->posting_time))){
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
								echo date('d',strtotime($arrProp->posting_time)).' '.$monthName.' '.date('Y',strtotime($arrProp->posting_time));
								//echo date('d M Y',strtotime($arrProp->posting_time));
								?><br>
								<?php
								if($arrProp->update_time!='0000-00-00'){
									
									switch(date('m',strtotime($arrProp->update_time))){
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
									
									echo $this->lang->line('property_search_updated')." ".date('d',strtotime($arrProp->update_time)).' '.$monthName.' '.date('Y',strtotime($arrProp->update_time));
									//echo $this->lang->line('property_search_updated')." ".date('d M Y',strtotime($arrProp->update_time));
									echo '<br>';
								}
								$property_post_by_type = $arrProp->property_post_by_type;
								if($property_post_by_type=='2'){
									$user_preference = get_all_value('zc_user_preference'," and user_id='".$arrProp->property_post_by."'");		
									$first_name = get_perticular_field_value('zc_user','first_name'," and user_id='".$arrProp->property_post_by."'");
									$last_name=get_perticular_field_value('zc_user','last_name'," and user_id='".$arrProp->property_post_by."'"); 
									$name = $first_name.' '.$last_name;
									?>
									<span style="font-weight:bold;"><?php echo $this->lang->line('property_search_by_owner');?> </span><br>
									<span style="font-weight:bold; color:#5199D4;">
										<?php 
										if(isset( $user_preference[0] ) &&( count( $user_preference[0] ) > 0 )) { 
											if($user_preference[0]['invisible'] != 0 ) { 
												echo $name;
											}else{
												?>
												<a href="<?php echo base_url();?>advertiser/advertiser_details/<?php echo $arrProp->property_post_by;?>">
													<?php echo $name;?>
												</a>
												<?php
											} 
										}else {
											echo $name;
										}
										?>
									</span>
									<?php
								}
								if($property_post_by_type=='3') {
									$user_preference = get_all_value('zc_user_preference'," and user_id='".$arrProp->property_post_by."'");
									$company_name=get_perticular_field_value('zc_user','company_name'," and user_id='".$arrProp->property_post_by."'");
									?>
									<span style="font-weight:bold;"><?php echo $this->lang->line('property_search_by_company');?></span><br>
									<span style="font-weight:bold; color:#5199D4;">
										<?php 
										if( isset( $user_preference[0] ) &&( count( $user_preference[0] ) > 0 )) { 
											if( $user_preference[0]['invisible'] != 0 ) { 
												echo $company_name;
											} else {
												?>
												<a href="<?php echo base_url();?>advertiser/advertiser_details/<?php echo $arrProp->property_post_by;?>">
													<?php echo $company_name;?>
												</a>
												<?php
											}
										} else {
											echo $company_name;
										}
										?>
									</span>
									<?php
								}
								?>
							</div>
							<!-- <div class="listingShw"></div> -->
						</div>

						<div class="listingContent">
							<h4 style="font-weight:bold;font-size:12px;">
								<?php echo $this->lang->line('ref_code').': '.CreateNewRefToken($arrProp->property_id,$arrProp->name); ?>
							</h4>
							<h2 class="hackerspace">
								<a href="<?php echo base_url().$first_segment.'/'.$prop_det_url;?>" onMouseOver="goToMarker('<?php echo $gMapCounter; ?>')" onMouseOut="markerListMouseOut('<?php echo $gMapCounter; ?>')">
									<?php echo $proptitle;?>
								</a>
							</h2>
							<div class="listAddress">
								<h3>
									<?php
									$propertyAddress = ($arrProp->area!=''?$arrProp->area.' - ':'');
									$propertyAddress.= ($arrProp->street_address!=''?$arrProp->street_address.', ':'');
									$propertyAddress.= ($arrProp->street_no!=''?$arrProp->street_no.' - ':'');
									$propertyAddress.= ($arrProp->zip!=''?$arrProp->zip:'');
									echo $propertyAddress;
									?>
								</h3>
							</div>
							<p style="text-align:left;">
							<?php 
							echo substr($arrProp->description,0,90);
							$str_len=strlen($arrProp->description);
							if($str_len > '150'){echo '...';}
							?>
							<br>
							</p>
							<!--by category wise show-->
							<?php
							$cat_id=$arrProp->category_id;
							if($cat_id=='1' || $cat_id=='6' || $cat_id=='7') {
							?>
							<p style="text-align:left !important;margin:10px 0;">
								<?php 
								echo '<span class="desc_prop">m2: </span>'.$arrProp->surface_area.'<span class="desc_prop"> | '.$this->lang->line('property_search_rooms').': </span>'.$arrProp->room_no; 
								if($arrProp->floor != '') {
									echo '<span class="desc_prop"> | '.$this->lang->line('property_search_floor').': </span>'.$arrProp->floor; 
								}
								echo '<span class="desc_prop">| '.$this->lang->line('property_search_parking').': </span>';
								switch($arrProp->parking){
									case 'Parking':
										$parkingString = $this->lang->line('add_property_form_parking_parking');
										break;
									case 'Cargarage':
										$parkingString = $this->lang->line('add_property_form_parking_car_garage');
										break;
									case 'No':
										$parkingString = $this->lang->line('add_property_form_parking_non');
										break;
									default:
										$parkingString = '';
										break;
								}
								echo $parkingString;
								?> 
							</p>
							<?php
							}
							if($cat_id=='3') {
							?>
							<p style="text-align:left !important;margin:10px 0;">
								<?php 
								echo '<span class="desc_prop">'.$this->lang->line('property_search_bathrooms').': </span>'.$arrProp->bathrooms_no.'<span class="desc_prop"> | '.$this->lang->line('property_search_kitchen').':</span> ';
								switch($arrProp->kitchen){
									case 'Living':
										$kitchenString = $this->lang->line('add_property_form_kitchen_living');
										break;
									case 'Livable':
										$kitchenString = $this->lang->line('add_property_form_kitchen_livable');
										break;
									case 'Kitchenettes':
										$kitchenString = $this->lang->line('add_property_form_kitchen_kitchenettes');
										break;
									case 'No':
										$kitchenString = $this->lang->line('add_property_form_kitchen_livable');
										break;
									default:
										$kitchenString = '';
										break;
								}
								echo $kitchenString;
								echo ' <span class="desc_prop">| '.$this->lang->line('property_search_rommates').': </span>';
								switch($arrProp->roommates){
									case 'Men and women':
										$roommatesString = $this->lang->line('add_property_form_roommates_men_women');
										break;
									case 'Only Men':
										$roommatesString = $this->lang->line('add_property_form_roommates_men');
										break;
									case 'Only women':
										$roommatesString = $this->lang->line('add_property_form_roommates_women');
										break;
									default:
										$roommatesString = '';
										break;
								}
								echo $roommatesString;
								echo ', ';
								switch($arrProp->occupation){
									case 'Students and workers':
										$occupationString = $this->lang->line('add_property_form_occupation_student_worker');
										break;
									case 'Only workers':
										$occupationString = $this->lang->line('add_property_form_occupation_workers');
										break;
									case 'Only students':
										$occupationString = $this->lang->line('add_property_form_occupation_student');
										break;
									default:
										$occupationString = '';
										break;
								}
								echo $occupationString;
								?> 
							</p>
							<?php
							}
							if($cat_id=='4') {
							?>
							<p style="text-align:left !important;margin:10px 0;">
								<?php
								if($arrProp->availability == 0) {
									$availabilty = $this->lang->line('property_search_availability_vacant');
								} else {
									$availabilty = $this->lang->line('property_search_availability_occupied');
								}
								echo '<span class="desc_prop">m2: </span>'.$arrProp->surface_area.'<span class="desc_prop"> | '.$this->lang->line('property_search_availability').': </span> '.$availabilty; 
								?>
							</p>
							<?php
							}
							if($cat_id=='5') {
							?>
							<p style="text-align:left !important;margin:10px 0;">
							<?php
								if($arrProp->beds_no != '') {
									echo '<span class="desc_prop">'.$this->lang->line('property_search_beds').': </span>'.$arrProp->beds_no.'<span class="desc_prop"> | </span>';
								}
								echo '<span class="desc_prop">'.$this->lang->line('property_search_bathrooms').': </span>'.$arrProp->bathrooms_no.'<span class="desc_prop"> | '.$this->lang->line('property_search_kitchen').': </span>';
								switch($arrProp->kitchen){
									case 'Living':
										$kitchenString = $this->lang->line('add_property_form_kitchen_living');
										break;
									case 'Livable':
										$kitchenString = $this->lang->line('add_property_form_kitchen_livable');
										break;
									case 'Kitchenettes':
										$kitchenString = $this->lang->line('add_property_form_kitchen_kitchenettes');
										break;
									case 'No':
										$kitchenString = $this->lang->line('add_property_form_kitchen_livable');
										break;
									default:
										$kitchenString = '';
										break;
								}
								echo $kitchenString;
								echo '<span class="desc_prop"> | '.$this->lang->line('property_search_parking').': </span>';
								switch($arrProp->parking){
									case 'Parking':
										$parkingString = $this->lang->line('add_property_form_parking_parking');
										break;
									case 'Cargarage':
										$parkingString = $this->lang->line('add_property_form_parking_car_garage');
										break;
									case 'No':
										$parkingString = $this->lang->line('add_property_form_parking_non');
										break;
									default:
										$parkingString = '';
										break;
								}
								echo $parkingString;
							?>
							</p>
							<?php
							}
							?>							
							<div class="propFeatures" style="width:100%;">
								<div style="float:left;">
									<?php
									$propertyPrice = '';
									if($arrProp->price!='0.00'){
										$propertyPrice.= '<span style="color:#000; font-weight:bold;float:left;">&euro;'.show_price($arrProp->price).'&nbsp;</span>';
										if($arrProp->contract_id==1){
											$propertyPrice.= '<span style="color:#000; font-weight:bold;float:left;">'.$this->lang->line('property_search_per_month').'</span>';
										}
										if($arrProp->update_price!='0.00'){
											$per_prop=percentage($arrProp->update_price,$arrProp->price);
											if($per_prop!=0){
												$propertyPrice.= '<span style="color:#000; font-weight:bold;float:left;">|</span>';
												if ($per_prop < 0){
													$propertyPrice.= '<span style="float: left;"><img src="'.base_url().'assets/images/green.gif" style="margin:5px 0 0 0;" width="8px" height="8px"></span>';
													$propertyPrice.= '<span style="color:#090; font-weight:bold; padding-left:2px; float: left;">'.percentage($arrProp->update_price,$arrProp->price).' % </span>';
												}else{
													$propertyPrice.= '<span style="float: left;"><img src="'.base_url().'assets/images/red.gif" style="margin:5px 0 0 0;" width="8px" height="8px"></span>';
													$propertyPrice.= '<span style="color:#F00; font-weight:bold; padding-left:2px; float: left;"> +'.percentage($arrProp->update_price,$arrProp->price).' % </span>';
												}
											}
										}
									}else{
										$propertyPrice.= $this->lang->line('property_search_private_nagotiation');
									}
									echo '<font style="color:#ED6B1F">'.$propertyPrice.'</font>';
									?>
								</div>
								<div style="float:right; !important;" id="saved_<?php echo $arrProp->property_id;?>">
								<?php
								if($this->session->userdata( 'user_id' )!='' || $this->session->userdata('user_id')!='0'){
									$saved_prop_cnt=get_perticular_count('zc_saved_property',"and property_id='".$arrProp->property_id."' and saved_by_user_id='".$this->session->userdata( 'user_id' )."'");
									if($saved_prop_cnt=='0'){
									?>
									<a href="javascript:void(0);" onClick="return save_property(<?php echo $arrProp->property_id;?>);">
										<img src="<?php echo base_url();?>assets/images/fav0.png" title="<?php echo $this->lang->line('property_search_save_the_property');?>">
									</a>
									<?php
									}else{
									?>
									<a href="javascript:void(0);">
										<img src="<?php echo base_url();?>assets/images/fav1.png" title="<?php echo $this->lang->line('property_search_saved_by_you');?>">
									</a>
									<?php
									}
								}else{
								?>
								<a href="javascript:void(0);" class="save_prop_main">
									<img src="<?php echo base_url();?>assets/images/fav0.png" title="<?php echo $this->lang->line('property_search_save_the_property');?>">
								</a>
								<?php
								}
								?>
								</div>
							</div>
						</div>
					</li>						
						<?php
						$alt++;
						if($alt > 1){
							$alt = 0;
						}
						$GoogleMapMarkers[$gMapCounter] = array(
							'proptitle' => $proptitle,
							'hackerspace' => 'marker'.$arrProp->contract_id,
							'latitude' => ($arrProp->latitude=='0'?'42.500000':$arrProp->latitude),
							'longitude' => ($arrProp->longitude=='0'?'21.500000':$arrProp->longitude),
							'proaddress' => $propertyAddress,
							'propurl' => base_url().$first_segment.'/'.$prop_det_url,
							'proprice' => '<font style="color:#ED6B1F">'.$propertyPrice.'</font>',
							'proimg' => $propertyImage,
						);
						$gMapCounter++;
					}
				}else{
					?>
					<div class="no_record_search">
						<?php echo $this->lang->line('property_search_sorry_no_record_found');?>
					</div>
					<?php
				}
				?>
				</ul>
			</div>

			<div style="float: right; width: 100%; border-top: 1px solid #EEEEEE;">
				<fieldset id="inputs">
					<?php echo $pagination; ?>
				</fieldset>
			</div>
			<div class="clear"></div>			
			<div class="clear"></div>
		</div>		
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
</form>
<script type="text/javascript">
function save_property(property_id){
	$("#prop_saved_msg").show();
	var property_id=property_id; 
	var user_id="<?php echo $this->session->userdata('user_id'); ?>";
	//alert(user_id);
	$.ajax({
		type: "POST",
		url: "<?php echo base_url();?>property/save_property",
		data:{property_id: property_id, user_id: user_id},
		async: false,
		success:function(result){
			var img="<img src='<?php echo base_url();?>assets/images/fav1.png' title='<?php echo $this->lang->line('property_search_saved_property');?>'/>";
			$('#saved_'+property_id).html(img);
			$("#prop_saved_msg").delay(3200).fadeOut(300);
		}
	});
}
function do_order(){
	var FormGetURL = $('#form_order').serialize().split('&');
	var j = 0;
	var PlaceHolder = new Array();
	$('#form_order .placeholder').each(function(){
		PlaceHolder[j] = $(this).attr('id');
		j++;
	});
	var cleanUrl = '';
	for(var i=0;i<FormGetURL.length;i++){		
		var LeftEle = FormGetURL[i].split('=');
		cleanUrl+= (i==0?'':'&')+LeftEle[0]+'='+(($.inArray(LeftEle[0],PlaceHolder) !== -1)?'':LeftEle[1]);
	}
	location.href = '<?php echo base_url(); ?>' + 'property/search?' + cleanUrl;
	//document.getElementById("form_order").submit();
}

</script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/map.css?nocache=289671982568" type="text/css"/>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?=MAP_KEY?>"></script>
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
