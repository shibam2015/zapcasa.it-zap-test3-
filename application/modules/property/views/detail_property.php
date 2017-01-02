<?php $this->load->view("_include/meta"); ?>
<style type="text/css">
.mail_from {outline: none;border: 1px solid #CCC;background: none repeat scroll 0 0 #fff;border-radius: 5px;margin: 10px 19px 7px 1px;padding: 8px 14px;width:93%;}
.mail_body{width: 95%;box-shadow: inset 0 1px 2px #DDD, 0 1px 0 #FFF;-webkit-box-shadow: inset 0 1px 2px #DDD, 0 1px 0 #FFF;-moz-box-shadow: inset 0 1px 2px #DDD, 0 1px 0 #FFF;border: 1px solid #CCC;background: #FFF;margin: 0 0 5px;padding: 10px;border-radius: 5px;}
.message_label{font-weight:bold;}
.map_small{width: 100%; height: 400px;border:solid #0F0 1px;}
.map_small1{width: 100%; height: 400px;border:solid #0F0 1px;}
#showcase1{height:0;width:0;overflow:hidden;}
#showcase3{height:0;width:0;overflow:hidden;}
.gmnoprint{/*display:none;*/}
.gm-style .gm-style-iw{top:16px !importent;}
.gmnoprint img {max-width: none;}
#over_map { right: 2%; position: absolute; top: 15px; z-index: 99; }
.fullScreen
{
	width: 100% !important;
	z-index: 100 !important;
	transition: all 2s;
}
.showHide
{
	transition: all 2s;
}
.right_panel, .left_panel
{
	transform: all 2s;
}
</style>
<?php 
if(count ( $property_details ) == 0 ){
	header('Location: '.base_url().'errors/error_404.php');
	die;
}
?>
<script type="text/javascript">
$(document).ready(function() {
	$.validator.addMethod("multiemail",function(value, element){
		if (this.optional(element)) // return true on optional element 
             return true;
		var emails = value.split(/[;,]+/); // split element by , and ;
		valid = true;
		for (var i in emails) {
             value = emails[i];
             valid = valid && $.validator.methods.email.call(this, $.trim(value), element);
		}
		return valid;
	},$.validator.messages.email);
	$('#nav li').hover(function() {
		$('ul', this).slideDown(200);
		$(this).children('a:first').addClass("hov");
	}, function() {
		$('ul', this).slideUp(100);
		$(this).children('a:first').removeClass("hov");		
	});
	
});
var page="proDetails";
</script>
</head>
<body class="noJS">
	<script>
	var bodyTag = document.getElementsByTagName("body")[0];
	bodyTag.className = bodyTag.className.replace("noJS", "hasJS");
	</script>
	<!------ Header part -------------->
	<div class="fixed_header">
		<div class="topbluebar"></div>
		<div class="main">
			<?php $this->load->view("_include/header"); ?>    
		</div>
		<?php $this->load->view("_include/login_user"); ?>  
		<!--saved search popup-->
		<?php $this->load->view("_include/saved_search"); ?> 
		<!--saved search popup ends-->
		<?php $this->load->view("_include/information"); ?>
		<?php $this->load->view("_include/information_mail"); ?>
		<?php $this->load->view("_include/information_save"); ?>
		<?php echo $this->load->view("_include/information_addprop"); ?>  
	</div>
	<!------ banner part 
	<div class="insidepage_banner">
		<div class="main">
			<h2>Real Estate for <font style="font-weight:bold;">Jobs</font> & <font style="font-weight:bold;">Housing</font></h2>
		</div>
	</div>
	-------------->
<!------ body part -------------->
<style type="text/css">
	.save_search
	{
		display: none !important;
	}
</style>
<div class="main main_searchpage">
	<div id="breadcrumb" class="fk-lbreadbcrumb newvd">
    	<span>
			<a href="<?php echo base_url();?>">
				<?php echo $this->lang->line('details_property_home');?>
			</a>
		</span> >
        <span>
			<a href="<?php echo base_url();?><?php echo $parent_breadcrumb_search_link;?>">
				<?php echo $parent_breadcrumb_search_title;?>
			</a>
		</span> >
		<?php
		if($child_breadcrumb_search_title){
		?>
		<span>
			<a href="<?php echo base_url();?><?php echo $child_breadcrumb_search_link; ?>">
				<?php echo $child_breadcrumb_search_title;?>
			</a>
		</span> >
		<?php
		}
		?>
        <span>
			<?php echo $this->lang->line('details_property_property_details');?>
		</span>        
    </div>
	<!--<h2 class="pagetitle">Registration</h2>-->    
    <div class="refinesearch">
        <?php $this->load->view("_include/search_header"); ?>
    </div>    
	<div class="property_details">
    	<div class="left_panel">
        	<div class="property_info">
				<h4 style="font-weight:bold;color:#000000;font-family:'CenturyGothicRegular';font-size:12px;">
					<?php
					echo $this->lang->line('ref_code').': ';
					//$Typo=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$property_details[0]['typology']."'");
					$Typo=get_perticular_field_value('zc_contract_types','name'," and contract_id='".$property_details[0]['contract_id']."'");
					echo CreateNewRefToken($property_details[0]['property_id'],$Typo);
					?>
				</h4>
            	<h2>
				<?php
					if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
						$name=get_perticular_field_value('zc_contract_types','name'," and contract_id='".$property_details[0]['contract_id']."'");
						$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$property_details[0]['typology']."'");
						$city_name=get_perticular_field_value('zc_city','city_name'," and city_id='".$property_details[0]['city']."'");
						$province_code=get_perticular_field_value('zc_region_master','province_code'," and city='".mysql_real_escape_string($city_name)."'");
						
						$proptitle = $name." For ".stripslashes($typology_name)." in ".$city_name.", ".$province_code;
					} else {
						$name_it=get_perticular_field_value('zc_contract_types','name_it'," and contract_id='".$property_details[0]['contract_id']."'");
						$typology_name=get_perticular_field_value('zc_typologies','name_it'," and status='active' and typology_id='".$property_details[0]['typology']."'");
						$city_name=get_perticular_field_value('zc_city','city_name_it'," and city_id='".$property_details[0]['city']."'");
						$province_code=get_perticular_field_value('zc_region_master','province_code'," and city_it='".mysql_real_escape_string($city_name)."'");
						
						$proptitle = stripslashes($typology_name)." in ".$name_it." a ".$city_name.", ".$province_code;
					}
					echo stripslashes($proptitle);
					//print_r($property_details);exit;
					$property_name=property_name($property_details[0]['property_id']);
					$st_name1=get_perticular_field_value('zc_region_master','province_code'," and `province_name` LIKE '%".$property_details[0]['provience']."%' group by province_code");
					?>
                </h2>

            	<h3>
					<?php
					$propertyAddress = '';
					if($property_details[0]['area']!=''){
						$propertyAddress.= $area_prop=$property_details[0]['area'].' - ';
					}
					if($property_details[0]['street_address']!=''){
						$propertyAddress.= $property_details[0]['street_address'].', ';
					}
					if($property_details[0]['street_no']!=''){
						$propertyAddress.= $property_details[0]['street_no'].' - ';
					}
					if($property_details[0]['zip']!=''){
						$propertyAddress.= $property_details[0]['zip'];
					}
					echo $propertyAddress;
					?>
				</h3>
                <div class="propFeatures">
					<h4>
					<?php
					$propertyPrice = '';
					if($property_details[0]['price']!='0.000'){
						$propertyPrice.= '&euro;'.show_price($property_details[0]['price']).'&nbsp;';
						if($property_details[0]['contract_id']==1){
							$propertyPrice.= '<span style="color:#000; font-weight:bold;">'.$this->lang->line('details_property_per_month').'</span>';
						}
						if($property_details[0]['update_price']!='0.00'){
							$per_prop=percentage($property_details[0]['update_price'],$property_details[0]['price']);
							if($per_prop != 0) {
								$propertyPrice.= '<span style="color:#000; font-weight:bold;">|</span>';
								if ($per_prop < 0) {
									$propertyPrice.= '<span><img src="'.base_url().'assets/images/green.gif" width="10px" height="10px"></span>';
									$propertyPrice.= '<span style="color:#090; font-weight:bold; padding-left:2px;">'.percentage($property_details[0]['update_price'],$property_details[0]['price']).' % </span>';
								} else {
									$propertyPrice.= '<span><img src="'.base_url().'assets/images/red.gif"  width="10px" height="10px"></span>';
									$propertyPrice.= '<span style="color:#F00; font-weight:bold; padding-left:2px;"> +'.percentage($property_details[0]['update_price'],$property_details[0]['price']).' % </span>';
								}
							}
						}					
					}else{
						$propertyPrice.= $this->lang->line('details_property_private_nagotiation');
					}
					echo $propertyPrice;
					?>
					</h4>
				</div>
                <div class="property_view" >
					<?php
					$nearByGoogleMapMarkers = array();
					if( count($nearby_category) > 0 ) {
						?>
						<div id="nearby_category_area" style="display:none; width:175px;height:455px;padding-right:5px;float:left;">
							<div style="height:67px;">
                            	<p style="text-align:center;"><?php echo $this->lang->line('details_property_nearby_click_the_following_categories');?></p>
                            </div>
                            <div class="caraousel-tab" style="height:366px;">
								<ul class="inthe-area" style="height:100%;overflow:auto;">
								<?php
								$nearByProCatID = '';
								$nearByCounter = 0;
								$areaLimit = '5000';
								$nearByCatCounter = 1;
								foreach($nearby_category as $key){
									?>
									<li id="<?php echo $nearByCatCounter; ?>" onClick="return initInTheArea('<?php echo $nearByCatCounter; ?>');" style="float:none;border:0;">
										<?php echo ucfirst($key[($_COOKIE['lang'] == "it"?'it_category_name':'category_name')]);?>
									</li>
									<?php
									$nearByProData = get_nearby_area($key['category_id']);									
									if(count($nearByProData) > 0){
										foreach($nearByProData as $nearByProDataKey){
											// echo '<pre>';print_r($segs);die;
											$nearby_lat = $nearByProDataKey['latitude'];
											$nearby_lng = $nearByProDataKey['longitude'];
											$position="(".$nearby_lat.", ".$nearby_lng.")";
											if( $nearByProDataKey['url'] != "" ) {
												$nearby_image_path = base_url() . 'ASZC-admin/assets/uploads/NearByProperty/' . $nearByProDataKey['property_details_id'] . '/thumb/' . $nearByProDataKey['url'];
											} else {
												$nearby_image_path = base_url()."assets/images/no_proimg.jpg";
											}
											
											$geoDistance = round(geoDistance($GoogleMapMarkersCenterLatitude, $GoogleMapMarkersCenterLongitude, $nearby_lat, $nearby_lng, $miles = true));
											// if($key['category_id'] == 11)
											// {
											// 	echo json_encode($areaLimit." ".$geoDistance);exit;
											// }
											if(floatval($areaLimit) >= floatval($geoDistance)){
												$nearby_adress = "";
												if($nearByProDataKey['street_address']){
													$nearby_adress .= $nearByProDataKey['street_address'];
												}
												if($nearByProDataKey['street_no']){
													$nearby_adress .= ','.$nearByProDataKey['street_no'];
												}
												if($nearByProDataKey['zip']){
													$nearby_adress .= ' - '.$nearByProDataKey['zip'];
												}
												if($nearByProDataKey['city']){
													$nearby_adress .= ' '.$nearByProDataKey['city'];
												}
												if($nearByProDataKey['provience']!= ""){
													$nearby_adress .= ' - '.$nearByProDataKey['provience'];
												}
												$nearByGoogleMapMarkers[$nearByCounter] = array(
													'proptitle' => $nearByProDataKey['name'],
													'hackerspace' => $nearByCatCounter,
													'latitude' => ($nearby_lat=='0'?'42.500000':$nearby_lat),
													'longitude' => ($nearby_lng=='0'?'21.500000':$nearby_lng),
													'proaddress' => $nearby_adress,
													'propurl' => 'javascript:void(0);',
													'proprice' => '',
													'proimg' => $nearby_image_path
												);
											}
											$nearByCounter++;
										}
									}
									$nearByCatCounter++;
								}
								?>
								</ul>
							</div>
							<div style="clear:both"></div>
						</div>
						<?php } ?>
                    <div class="sliderkit photosgallery-captions" id="showcase">
					<div class="sliderkit-nav ">
						<div class="sliderkit-nav-clip">
							<ul>
                            <?php
							$CityName=get_perticular_field_value('zc_city',($_COOKIE['lang']=="it"?'city_name_it':'city_name')," and `city_id` = '".$property_details[0]['city']."'");
							$TypologyName=get_perticular_field_value('zc_typologies',($_COOKIE['lang']=="it"?'name_it':'name')," and status='active' and `typology_id` = '".$property_details[0]['typology']."'");
							
							if(isset($property_image) && ( !empty($property_image))){ 
								foreach($property_image as $property_images){
									if($property_images['img_type']=='prop_picture' || $property_images['img_type']=='main_image'){
										$file = base_url()."assets/uploads/Property/Property".$property_images['property_id']."/thumb_92_82/".$property_images['file_name'];
										$thumb = "";
										if (file_exists($file)) {
											$thumb = $file;
										} else {
											$thumb = base_url()."assets/uploads/Property/Property".$property_images['property_id']."/thumb_92_82/".$property_images['file_name'];
										}
										?>
									<li>
										<a href="#" rel="nofollow" title="<?php echo stripslashes($TypologyName).' in '.stripslashes($CityName); ?>">
											<img src="<?php echo $thumb; ?>" alt="<?php echo stripslashes($TypologyName).' in '.stripslashes($CityName); ?>">
										</a>
									</li>
									<?php
									}
								}
							}
							?>  
							</ul>
						</div>
						<!--<div class="sliderkit-btn sliderkit-nav-btn sliderkit-nav-prev">
                        <a rel="nofollow" href="#" title="Previous line"><span>Previous line</span></a>
                        </div>
						<div class="sliderkit-btn sliderkit-nav-btn sliderkit-nav-next">
                        <a rel="nofollow" href="#" title="Next line"><span>Next line</span></a>
                        </div>-->
						
						
					</div>
					<div class="sliderkit-panels">
						<!--
						<div class="sliderkit-btn sliderkit-go-btn sliderkit-go-prev">
							<a rel="nofollow" href="#" title="Previous">
								<span><?php //echo $this->lang->line('details_property_previous');?></span>
							</a>
						</div>
						<div class="sliderkit-btn sliderkit-go-btn sliderkit-go-next">
							<a rel="nofollow" href="#" title="Next">
								<span><?php //echo $this->lang->line('details_property_next');?></span>
							</a>
						</div>
						-->
						<?php
                         if(isset($property_image) && ( !empty($property_image) ) ) {
							 foreach($property_image as $property_images)
							 {
								 if($property_images['img_type']=='prop_picture' || $property_images['img_type']=='main_image')
								 {
								 	$file_860_482 = base_url()."assets/uploads/Property/Property".$property_images['property_id']."/".$property_images['file_name'];
								 	$file_200_296 = base_url()."assets/uploads/Property/Property".$property_images['property_id']."/thumb_200_296/".$property_images['file_name'];
								 	/*
								 	$thumb_860_482 = "";
								 	$thumb_200_296 = "";
								 	
								 	if (file_exists($file_860_482)) {
								 		$thumb_860_482 = $file_860_482;
								 	} else {
								 		$thumb_860_482 = base_url()."asset/uploads/Property/Property".$property_images['property_id']."/".$property_images['file_name'];;
								 	}
								 	if (file_exists($file_200_296)) {
								 		$thumb_200_296 = $file_200_296;
								 	} else {
								 		$thumb_200_296 = base_url()."asset/uploads/Property/Property".$property_images['property_id']."/".$property_images['file_name'];;
								 	}*/
								 	$thumb_860_482 = $file_860_482;
								 	$thumb_200_296 = $file_200_296;
						?>
						<div class="sliderkit-panel">
							<!-- <a href="<?php //echo $thumb_860_482;?>" title="<?php //echo $TypologyName.' in '.stripslashes($CityName); ?>" class="fancybox"> -->
							<a href="<?php echo $thumb_860_482;?>" title="<?php echo $TypologyName.' in '.stripslashes($CityName); ?>" rel="group" class="fancybox" data-fancybox-group="gallery">
								<img src="<?php echo $thumb_860_482;?>" alt="<?php echo $TypologyName.' in '.stripslashes($CityName); ?>">
                            </a>
						</div>
                         <?php
								 }
							 }
						 }
						  ?>  
                        
						
						
						
						
					</div>
				</div>
                    <!-- IN THE AREA -->
					<div class="showcase" id="showcase1">
						<div id="map_canvas" style="width:464px;height:455px;"></div>
                    </div>
                    <!-- YOUTUBE VIEW START -->
                    <div class="showcase" id="showcase2" style="display:none;">
					<?php  
					if($property_details[0]['youtube_url'] !='' ){
						$youtube_urls=explode('=',$property_details[0]['youtube_url']);
						?>
						<?php //echo $youtube_urls['1'];?> 
						<!-- <iframe width="100%" height="455" src="https://www.youtube.com/embed/ ?rel=0&showinfo=0&modestbranding=1&autohide=1&wmode=transparent" frameborder="1" allowfullscreen></iframe> -->
						<embed id="playerid" width="100%" height="455" allowfullscreen="true" allowscriptaccess="always" quality="high" bgcolor="#000000" name="playerid" style="" src="https://www.youtube.com/embed/<?php echo $youtube_urls['1'];?>?rel=0&showinfo=0&modestbranding=1&autohide=1&wmode=transparent" frameborder="1" type="application/x-shockwave-flash">
						<?php
					}
					?>
                    </div>
                    <!-- STREET VIEW START -->
                    <div class="showcase" id="showcase3"> 
						<div id="map_canvas_street_view" style="width:100%;height:455px;"></div>
                    </div>
                    <div style="clear:both"></div>
                    <div class="caraousel-tab">
                    	<ul>
                        	<li>
								<a href="javascript:void(0);" id="cam" class="active" onClick="return show_photos();">
									<span class="camera">
										<?php echo $this->lang->line('details_property_photos');?>
									</span>
								</a>
							</li>
                            <li>
								<a href="javascript:void(0);" onClick="return initInTheArea();" id="ar">
									<span class="location">
										<?php echo $this->lang->line('details_property_in_the_area');?>
									</span>
								</a>
							</li>
							<?php
							if(isset($property_details[0]) && ($property_details[0]['youtube_url']!='')){
							?>
							<li>
								<a href="javascript:void(0);" onClick="return show_video();" id="video">
									<span class="video">
										<?php echo $this->lang->line('details_property_video');?>
									</span>
								</a>
							</li>
							<?php
							}
							?>
							<li>
								<a href="javascript:void(0);" onClick="return initStreetView();" id="st">
									<span class="street">
										<?php echo $this->lang->line('details_property_street_view');?>
									</span>
								</a>
							</li>
                        </ul>
                    </div>
                    <div style="clear:both"></div>	
                </div>
            </div>
            <!-- <div onclick="removeMarkers();">Hiiiiiiiiiiiiii</div> -->
            <div class="varity_btns">
           
            	<?php
                  if($this->session->userdata( 'user_id' )!='' || $this->session->userdata('user_id')!='0')
				   {
				?>
                <a id="save" href="javascript:void(0)" onClick="return save_property(<?php echo isset( $property_images['property_id'] ) ? $property_images['property_id'] : $property_details[0]['property_id']; ?>);"><?php echo $this->lang->line('details_property_image_save');?></a>
                <?php
				   }
				  else
				  {
				?>
                <a id="save" href="javascript:void(0);" class="save_propertys"><?php echo $this->lang->line('details_property_image_save');?></a>
                <?php
				  }
                ?>
                <a id="general_button_mail" href="javascript:void(0);" onClick="return email_property(<?php echo isset( $property_images['property_id'] ) ? $property_images['property_id'] : $property_details[0]['property_id']; ?>);"><?php echo $this->lang->line('details_property_image_email');?></a>                
               <a id="general_button_print" href="javascript:void(0);" onClick="printPage(printsection.innerHTML)"><?php echo $this->lang->line('details_property_image_print');?></a>
               <?php
              if($this->session->flashdata('mail_success')!='')
			  {
			?>
            <div class="success" id="success" style="float:right;">
            	<?php echo $this->session->flashdata('mail_success');?>
                </div>
            <?php
			 }
			?>
                <div id="prop_saved_msg" style="float:right;"></div>
            	
            	<!--<img src="<?php //echo base_url();?>asset/images/varity_btns.jpg" >-->
            </div> 
            <div class="detailview" id="email_seding_prop" style="display:none;">
                <div class="section2">
					<h2 style="margin:0 0 15px;padding:0 0 5px;font-weight:bold;">
						<?php echo $this->lang->line('details_property_sending_email');?>
					</h2>
					<?php
					$attributes = array('id' => 'email_form');
					echo form_open_multipart('property/send_email', $attributes);
					?>
					<span class="message_label">
						<?php echo $this->lang->line('details_property_recipents_emails');?>						
					</span>					
					<div class="field">
						<label for="mail_to" generated="true" class="error" style="display:none;font-weight:normal;color:red;"></label>
						<input type="text" multiple placeholder="<?php echo $this->lang->line('details_property_recipents_emails_field');?>" class="mail_from required" name="mail_to" id="mail_to" >
					</div>
					<span class="message_label">
						<?php echo $this->lang->line('details_property_your_email');?>						
					</span>
					<div class="field">
						<label for="mail_from" generated="true" class="error" style="display:none;font-weight:normal;color:red;"></label>
						<input type="text" placeholder="<?php echo $this->lang->line('details_property_your_email_field');?>" name="mail_from" id="mail_from" class="mail_from email required" value="">
					</div>
					<span class="message_label">
						<?php echo $this->lang->line('details_property_include_message');?>						
					</span>
					<div class="field" id='mg_body'>
						<label for="message" generated="true" class="error" style="display:none;font-weight:normal;color:red;"></label>
						<textarea class="mail_body required" name="message" id="message" style="margin:10px 19px 7px 1px"></textarea>
					</div>
					<div class="field">
						<br>
						<input type="hidden" name="property_url" value="<?php echo current_url();?>">
						<input type="hidden" name="return_url" value="<?php echo $this->uri->segment(1).'/'.$this->uri->segment(2);?>">
						<input type="submit" name="send_mail" value="<?php echo $this->lang->line('details_property_button_send_email');?>" onClick="return email_form_validation();">
					</div>
					<?php echo form_close(); ?>                         
                </div>
            </div>
            
            <!--property detail view-->
            <div class="detailview" id='printsection'>
            	<div class="section1">
                	<h2><?php echo $this->lang->line('details_property_property_info');?></h2>
                    <div class="column column-listing">
                    	<ul>
                        	<li>
								<span><?php echo $this->lang->line('details_property_property_info_published');?></span>
                             	<?php
								switch(date('m',strtotime($property_details[0]['posting_time']))){
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
								echo date('d',strtotime($property_details[0]['posting_time'])).' '.$monthName.' '.date('Y',strtotime($property_details[0]['posting_time']));
								?>
							</li>
							<li>
								<span><?php echo $this->lang->line('details_property_property_info_updated');?></span>
								<?php
                                if($property_details[0]['update_time']!='0000-00-00'){
									switch(date('m',strtotime($property_details[0]['update_time']))){
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
									echo date('d',strtotime($property_details[0]['update_time'])).' '.$monthName.' '.date('Y',strtotime($property_details[0]['update_time']));
								} else {
									echo '---';
								}
								?>
							</li>
                            <li>
                          	<?php
							$user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$property_details[0]['property_post_by']."'");
							if($user_type==2){
								$first_name=get_perticular_field_value('zc_user','first_name'," and user_id='".$property_details[0]['property_post_by']."'");
								$last_name=get_perticular_field_value('zc_user','last_name'," and user_id='".$property_details[0]['property_post_by']."'"); 
								?>
								<span>
									<?php echo $this->lang->line('details_property_property_info_by_owner');?></span> 
									<?php echo $name=$first_name.' '.$last_name;?>
                            
                            <?php
							  }
							   if($user_type==3)
							  {
							?>
                            <span><?php echo $this->lang->line('details_property_property_info_by_agency');?></span> <?php echo get_perticular_field_value('zc_user','company_name'," and user_id='".$property_details[0]['property_post_by']."'");?>
                            <?php
							  }
							?>
                            </li>

                            <li>
								<span><?php echo $this->lang->line('details_property_property_info_contract');?></span>
								<?php 
									$contract_id=$property_details[0]['contract_id'];
									if($contract_id==1)
									{
										echo $this->lang->line('details_property_property_info_rent');
									}
									if($contract_id==2)
									{
										echo $this->lang->line('details_property_property_info_sell');
									}
								?>
                            </li>
                            
                            <li>
								<span><?php echo $this->lang->line('details_property_category');?></span> 
								<?php
                                if(($property_details[0]['category_id']=='6')){
									echo $this->lang->line('search_header_typology_business_property_for_business');
								}elseif(($property_details[0]['category_id']=='7')){
									echo $this->lang->line('search_header_typology_business_business_license');
								}else{
									echo get_perticular_field_value('zc_categories',($_COOKIE['lang']=='it'?'name_it':'name')," and name='".$category."'");
								} ?>
							</li>                             
                            
                                                   
                        	<li>
								<span><?php echo $this->lang->line('details_property_city');?></span>
								<?php echo stripslashes($city_name); ?>
							</li>
                            <li>
								<span><?php echo $this->lang->line('details_property_provience');?></span>
								<?php echo $province_code; ?>
							</li>
                            <li>
								<span><?php echo $this->lang->line('details_property_zip_code');?></span><?php echo $property_details[0]['zip'];?>
							</li>
                            <li>                      
								<span><?php echo $this->lang->line('details_property_address');?></span> <?php if($property_details[0]['street_address']!=''){echo $property_details[0]['street_address'];}?><?php if($property_details[0]['street_no']!=''){?>, <?php echo $property_details[0]['street_no'];}?>
							</li>
                            <li>
								<span><?php echo $this->lang->line('details_property_area');?></span> 
								<?php if(($property_details[0]['area'] > ' ')){
									echo $property_details[0]['area'];
								} else {
									echo '---';
								}?>
							</li>
							<li>
								<span>
									<?php echo $this->lang->line('details_property_typology');?>
								</span>
								<?php
								$typologyName = get_perticular_field_value('zc_typologies',($_COOKIE['lang']=='it'?'name_it':'name')," and status='active' and typology_id='".$property_details[0]['typology']."'");
								echo stripslashes($typologyName);
								?>
							</li>
                            
                            <?php if(($property_details[0]['category_id']=='1') || ($property_details[0]['category_id']=='5') || ($property_details[0]['category_id']=='6') || ($property_details[0]['category_id']=='7')){ ?>
                            <li>
								<span><?php echo $this->lang->line('details_property_status');?></span> <?php echo get_perticular_field_value('zc_status_of_property',($_COOKIE['lang']=='it'?'name_it':'name')," and id='".$property_details[0]['status']."'"); ?>
							</li>
                            <?php } ?>
                            
                            <?php if(($property_details[0]['category_id']=='1') || ($property_details[0]['category_id']=='4') || ($property_details[0]['category_id']=='5') || ($property_details[0]['category_id']=='6') || ($property_details[0]['category_id']=='7')){ ?>
                            <li>
								<span><?php echo $this->lang->line('details_property_kind');?></span> 
								<?php if(($property_details[0]['kind'] > ' ')){
									echo get_perticular_field_value('zc_kind_of_property',($_COOKIE['lang']=='it'?'name_it':'name')," and id='".$property_details[0]['kind']."'");
								} else {
									echo '---';
								}?>
							</li>
                            <?php } ?>
                            
                            <?php if(($property_details[0]['category_id']=='1') || ($property_details[0]['category_id']=='5') || ($property_details[0]['category_id']=='6') || ($property_details[0]['category_id']=='7')){ ?>
                            <li>
								<span><?php echo $this->lang->line('details_property_energy_class');?></span> 
								<?php
								$energyClass = get_perticular_field_value('zc_energy_efficiency_class','name'," and id='".$property_details[0]['energyclass']."'");
								if($energyClass == 'Not Classified'){
									echo($_COOKIE['lang']=='it'?'Non classificato':'Not Classified');
								}else{
									echo $energyClass;
								}
								?>
							</li>
                            <?php } ?>

                            <?php if(($property_details[0]['category_id']=='1') || ($property_details[0]['category_id']=='5') || ($property_details[0]['category_id']=='6') || ($property_details[0]['category_id']=='7')){ ?>
                            <li>
								<span><?php echo $this->lang->line('details_property_luxury');?></span>
								<?php								
								if($property_details[0]['add_to_luxury']=='0'){
								  echo $this->lang->line('details_property_luxury_no');
								}else{
									echo $this->lang->line('details_property_luxury_yes');
								}
								?>
                            </li>                            
                            <?php } ?>

                        </ul>
                    </div>
                </div>
                <div class="section1">
                	<h3><?php echo $this->lang->line('details_property_main_features');?></h3>
                    <div class="column column-listing">
                    	<ul>
                        <?php 
						if($property_details[0]['category_id']!='3'){
						?>
                        <li>
                        	<span><?php echo $this->lang->line('details_property_surface_area');?></span>
                            <?php echo $property_details[0]['surface_area']; ?>
                        </li>
                        <?php
						}
						if(($property_details[0]['category_id']=='1')|| ($property_details[0]['category_id']=='6')||($property_details[0]['category_id']=='7')||($property_details[0]['category_id']=='5')){
						?>
                        <li>
                        	<span><?php echo $this->lang->line('details_property_room_no');?></span>
                           <?php echo $property_details[0]['room_no']; ?>
                        </li>
                        <?php
						}
						if(($property_details[0]['category_id']=='1')|| ($property_details[0]['category_id']=='6')||($property_details[0]['category_id']=='7')||($property_details[0]['category_id']=='5') || ($property_details[0]['category_id']=='3')){
						?>
                        <li>
                        	<span><?php echo $this->lang->line('details_property_floor');?></span>
                            <?php if(($property_details[0]['floor'] > ' ')){
								echo $property_details[0]['floor'];
							} else {
								echo '---';
							} ?>
                        </li>
                        <?php
						}
						if(($property_details[0]['category_id']=='1')|| ($property_details[0]['category_id']=='6')||($property_details[0]['category_id']=='7')||($property_details[0]['category_id']=='5')){
						?>
                        <li>
                        	<span><?php echo $this->lang->line('details_property_total_of_floor');?></span>
                            <?php if(($property_details[0]['total_of_floors'] > ' ')){
								echo $property_details[0]['total_of_floors'];
							} else {
								echo '---';
							} ?>
                        </li>
                        <?php
						}
						if(($property_details[0]['category_id']=='1')|| ($property_details[0]['category_id']=='6')||($property_details[0]['category_id']=='7')||($property_details[0]['category_id']=='5')){
						?>
                        <li>
                        	<span><?php echo $this->lang->line('details_property_totayear_of_building');?></span>
                             <?php if(($property_details[0]['year_of_building'] > ' ')){
								 echo $property_details[0]['year_of_building'];
							} else {
								echo '---';
							} ?>
                        </li>
                        <?php
						}
						if(($property_details[0]['category_id']=='5')){
						?>
                        <li>
                        	<span><?php echo $this->lang->line('details_property_beds');?></span>
                            <?php if(($property_details[0]['beds_no'] > ' ') && ($property_details[0]['beds_no'] !='0')){
								echo $property_details[0]['beds_no'];
							} else {
								echo '---';
							} ?>
                        </li>
                        <?php
						}
						if(($property_details[0]['category_id']=='1')|| ($property_details[0]['category_id']=='6')||($property_details[0]['category_id']=='7')||($property_details[0]['category_id']=='5') ||($property_details[0]['category_id']=='3')){
						?>
                    	<li>
                        	<span><?php echo $this->lang->line('details_property_bathroomno');?></span>
							<?php echo $property_details[0]['bathrooms_no']; ?>
                        </li>                        
                        <li>
                        	<span><?php echo $this->lang->line('details_property_kitchen');?></span>
                            <?php
							switch($property_details[0]['kitchen']){
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
							?>
                        </li>
                        <li>
                        	<span><?php echo $this->lang->line('details_property_heating');?></span>
                            <?php
							switch($property_details[0]['heating']){
								case 'Centralized':
									$heatingString = $this->lang->line('add_property_form_heating_centralized');
									break;
								case 'Autonomous':
									$heatingString = $this->lang->line('add_property_form_heating_autonomous');
									break;
								case 'No':
									$heatingString = $this->lang->line('add_property_form_heating_non');
									break;
								default:
									$heatingString = '';
									break;
							}
							echo $heatingString;
							?>
                        </li>
                        <?php
						}
                        if(($property_details[0]['category_id']=='1')|| ($property_details[0]['category_id']=='6')||($property_details[0]['category_id']=='7')||($property_details[0]['category_id']=='3')||($property_details[0]['category_id']=='5')){
						?>
                        <li>
                        	<span><?php echo $this->lang->line('details_property_parking');?></span>
							<?php
							switch($property_details[0]['parking']){
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
                        </li>
                        <?php
						}
						if(($property_details[0]['category_id']=='3')){
						?>
                        <li>
                        	<span><?php echo $this->lang->line('details_property_roommates');?></span>
                            <?php
							switch($property_details[0]['roommates']){
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
							?>
                        </li>                       
                        <li>
                        	<span><?php echo $this->lang->line('details_property_occupation');?></span>
                            <?php
							switch($property_details[0]['occupation']){
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
                        </li>
						<?php
						}
						if(($property_details[0]['category_id']=='1')|| ($property_details[0]['category_id']=='6')||($property_details[0]['category_id']=='7')||($property_details[0]['category_id']=='3')||($property_details[0]['category_id']=='5')){
						?>
                        <li>
                        	<span><?php echo $this->lang->line('details_property_frnished');?></span>
                            <?php							
							switch($property_details[0]['furnished']){
								case 'Partly':
									$furnishedString = $this->lang->line('add_property_form_furnished_partly');
									break;
								case 'Yes':
									$furnishedString = $this->lang->line('add_property_form_furnished_yes');
									break;
								case 'No':
									$furnishedString = $this->lang->line('add_property_form_furnished_no');
									break;
								default:
									$furnishedString = '';
									break;
							}
							echo $furnishedString;
							?>
                        </li>
                        <?php
						}
						?>                    
						<li>
							<span><?php echo $this->lang->line('details_property_availability');?></span>
							<?php $availibilty=$property_details[0]['availability']; ?>
							<?php
							if($availibilty==0){
								echo $this->lang->line('details_property_availability_vacant');
							}else{
								echo $this->lang->line('details_property_availability_allowed');
							}
							?>
						</li>
						<?php 
						if(($property_details[0]['category_id']=='3')){
						?>
                        <li>
                        	<span><?php echo $this->lang->line('details_property_smokers');?></span>
                            <?php $smokers=$property_details[0]['smokers']; ?>
                            <?php
                               if($smokers==0)
							   {
								   echo $this->lang->line('details_property_smokers_not_allowed');
							   }
							   else
							   {
								   echo $this->lang->line('details_property_smokers_allowed');
							   }
							?>
                        </li>
                        <?php
						}
						if(($property_details[0]['category_id']=='5')||($property_details[0]['category_id']=='3')){
						?>
                        <li>
                        	<span><?php echo $this->lang->line('details_property_pets');?></span>
                            <?php $pets=$property_details[0]['pets']; ?>
                            <?php
                               if($pets==0)
							   {
								   echo $this->lang->line('details_property_pets_not_allowed');
							   }
							   else
							   {
								   echo $this->lang->line('details_property_pets_allowed');
							   }
							?>
                        </li> 
                        <?php
						}
						?>
                        </ul>                     
                    </div>
                    <?php
					if($property_details[0]['category_id']!='4'){
					?>
                    <div class="section1">
						<h3><?php echo $this->lang->line('details_property_additional_features');?></h3>
						<div class="column column-listing">
							<ul>
								<li>
									<span><?php echo $this->lang->line('details_property_ac');?></span>
									<?php if($property_details[0]['air_conditioning']=='1'){ echo $this->lang->line('details_property_ac_yes');}else{ echo $this->lang->line('details_property_ac_no');} ?>
								</li>
								<li>
									<span><?php echo $this->lang->line('details_property_elevator');?></span>
								   <?php if($property_details[0]['elevator']=='1'){ echo $this->lang->line('details_property_elevator_yes');}else{ echo $this->lang->line('details_property_elevator_no');} ?>
								</li>
								<li>
									<span><?php echo $this->lang->line('details_property_balcony');?></span>
									<?php if($property_details[0]['balcony']=='1'){ echo $this->lang->line('details_property_balcony_yes');}else{ echo $this->lang->line('details_property_balcony_no');} ?>
								</li>
								<li>
									<span><?php echo $this->lang->line('details_property_terrace');?></span>
									<?php if($property_details[0]['terrace']=='1'){ echo $this->lang->line('details_property_terrace_yes');}else{ echo $this->lang->line('details_property_terrace_no');} ?>
								</li>
								<li>
									<span><?php echo $this->lang->line('details_property_garden');?></span>
									<?php
									if($property_details[0]['garden']=='1'){
										echo $this->lang->line('details_property_garden_yes');
									}else{
										echo $this->lang->line('details_property_garden_no');
									}
									?>
								</li>
							</ul>                     
						</div>
						<!--Property detail view ends--> 
					</div>
					<?php
					}
					?>
                    <!--Property detail view ends--> 
                    <h3><?php echo $this->lang->line('details_property_short_description');?></h3>
                    <p><?php echo nl2br($property_details[0]['description']);?></p>
                    <?php $p_img=get_perticular_field_value('zc_property_img','file_name'," and property_id='".$property_details[0]['property_id']."' and img_type='preliminary'");
					
					if($p_img!='')
					  {
					?>
                    <h3><?php echo $this->lang->line('details_property_planimetry');?></h3>
                    <p>
                  <img src="<?php echo base_url();?>assets/uploads/Property/Property<?php echo $property_details[0]['property_id'];?>/<?php echo $p_img;?>" style="width:100%;"></p>
                    <?php
					  }
					?>
                   
                </div>
            </div>
            
           
        </div>
        
        <div class="right_panel">
        	 <h2 class="searchfound"><span class="post_brn">
    	 <?php
					$user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$this->session->userdata( 'user_id' )."'");
                  if($user_type=='2' || $user_type=='3')
				  {
				?> 
                <a href="<?php echo base_url();?>property/add_property_form" class="freepost"><?php echo $this->lang->line('details_property_post_your_property');?> <font style="color:#fff000"><?php echo $this->lang->line('details_property_free');?></font></a>
               
                <?php
				  }
				  if($user_type=='1')
				  {
				?>  
            	
                   <a href="<?php echo base_url();?>property/add_property_form" class="freepost add_property"><?php echo $this->lang->line('details_property_post_your_property');?><font style="color:#fff000"><?php echo $this->lang->line('details_property_free');?></font></a>
                <?php
				  }
				   if($this->session->userdata( 'user_id' )=='0'  || $this->session->userdata( 'user_id' )=='' )
				  
				  {
				?>
                 <a href="<?php echo base_url();?>users/common_reg" class="freepost"><?php echo $this->lang->line('details_property_post_your_property');?> <font style="color:#fff000"><?php echo $this->lang->line('details_property_free');?></font></a>
                <?php
				  }
				?>
    	<!-- <a href="<?php //echo base_url();?>property/add_property_form">Post your property <font>free</font></a>-->
     
     </span></h2>
        	<div class="advertiser_form">
            <h2><?php echo $this->lang->line('details_property_get_more_information');?></h2>
            <?php
             $attributes = array('id' => 'mail_form','class' => 'mail_form_user' );
			 echo form_open_multipart('property/add_message', $attributes);
			?>
           
            <?php
               if($user_profile[0]['user_type']=='3') {
               		if($user_profile[0]['file_1']!='') {
			?>
            				<img src="<?php echo base_url();?>assets/uploads/thumb_92_82/<?php echo $user_profile[0]['file_1'];?>">
            <?php
			   		} else {
			?>
            				<img src="<?php echo base_url();?>assets/images/no_prof.png">
            <?php
			   		}
				$user_preference_loc = get_all_value('zc_user_preference'," and user_id='".$user_profile[0]['user_id']."'");
				if( isset( $user_preference_loc[0] ) &&( count( $user_preference_loc[0] ) > 0 )) {
			 		if( $user_preference_loc[0]['invisible'] != 0 ) {
			?>
						<h3><a href="javascript: void(0);" style="color:#3D8AC1; font-weight:bold;"><?php echo $user_profile[0]['company_name'];?></a></h3>
             <?php 
					} else {
			?>	
             			<h3><a href="<?php echo base_url();?>advertiser/advertiser_details/<?php echo $user_profile[0]['user_id'];?>" style="color:#3D8AC1; font-weight:bold;"><?php echo $user_profile[0]['company_name'];?></a></h3>
			<?php	
             		}
				}else {
             ?>
             		<h3><a href="javascript: void(0);" style="color:#3D8AC1; font-weight:bold;"><?php echo $user_profile[0]['company_name'];?></a></h3>
         <?php } ?>		
             <h4 style="font-weight:bold;"><?php echo $user_profile[0]['business_name'];?></h4>
              
              <?php 
              if( isset( $user_preference_loc[0] ) &&( count( $user_preference_loc[0] ) > 0 )) {
              	if( $user_preference_loc[0]['my_address_display'] != 1 ) {
              ?>
				<p>
				<?php $st_name1=get_perticular_field_value('zc_region_master','province_code'," and `province_name` LIKE '%".$user_profile[0]['province']."%' group by province_code");?>
				  <?php echo $user_profile[0]['street_address'].', '.$user_profile[0]['street_no'].' '.$user_profile[0]['zip'].' '.$user_profile[0]['city'].' '.$st_name1;?>
				</p>
				<?php }else { ?>
            	<p><?php echo $this->lang->line('details_property_well_be_glad_to_reply');?></p>
            <?php 
				}
			}
			?>
            <?php
			   }
			     if($user_profile[0]['user_type']=='2')
			   {
			?>
             <?php
               if($user_profile[0]['file_1']!='') {
			?>
            <img src="<?php echo base_url();?>assets/uploads/thumb_92_82/<?php echo $user_profile[0]['file_1'];?>">
            <?php
			   } else {
			?>
            <img src="<?php echo base_url();?>assets/images/no_prof.png">
            <?php
			   }
			   
			?>
			<?php 
				$user_preference_loc = get_all_value('zc_user_preference'," and user_id='".$user_profile[0]['user_id']."'");
				if( isset( $user_preference_loc[0] ) &&( count( $user_preference_loc[0] ) > 0 )) {
			 		if( $user_preference_loc[0]['invisible'] != 0 ) {
			?>
						<h3  style="color:#3D8AC1;font-weight:bold;"><a href="javascript: void(0);"><?php echo $user_profile[0]['first_name'].' '.$user_profile[0]['last_name'];?></a></h3>
            <?php 
            		} else {
			?>
            			<h3  style="color:#3D8AC1;font-weight:bold;"><a href="<?php echo base_url();?>advertiser/advertiser_details/<?php echo $user_profile[0]['user_id'];?>"><?php echo $user_profile[0]['first_name'].' '.$user_profile[0]['last_name'];?></a></h3>
			<?php 
					}
            	} else {
             ?>
             		<h3  style="color:#3D8AC1;font-weight:bold;"><a href="javascript: void(0);"><?php echo $user_profile[0]['first_name'].' '.$user_profile[0]['last_name'];?></a></h3>
            <?php } ?>
            
            <p style="font-weight:bold;"><?php echo $this->lang->line('details_property_send_me_a_message');?></p>
            <p><?php echo $this->lang->line('details_property_ill_be_glad_to_reply');?></p>
            
            <?php
			   }
			?>
			<div class="clear"></div>
			<?php
              if($this->session->flashdata('success')!='')
			  {
			?>
            <div class="success" id="success" >
            	<?php echo $this->session->flashdata('success');?>
                </div>
            <?php
			  }
			?>
            
             
			<?php
              if($this->session->flashdata('error')!='')
			  {
			?>
            <div class="eror" id="eror">
            	<?php echo $this->session->flashdata('error');?>
                </div>
            <?php
			  }
			?>
            <?php
			
			$uid=$this->session->userdata( 'user_id' );
			//print_r($property_details);exit;
			if($uid==$property_details[0]['property_post_by'])
			{
				
				$email_id='';
				$name="";
				$phone_number="";
			}
			if($uid=='' || $uid=='0')
			{
				$email_id='';
				$name="";
				$phone_number="";
			}
			//if($uid !='' && $uid!=$property_details[0]['property_post_by'])
			if($uid !='')	
			{
				$email_id=get_perticular_field_value('zc_user','email_id'," and user_id='".$uid."'");
				//print_r($email_id);exit;
				$first_name=get_perticular_field_value('zc_user','first_name'," and user_id='".$uid."'");
				$last_name=get_perticular_field_value('zc_user','last_name'," and user_id='".$uid."'"); 
				$name=$first_name.' '.$last_name;
				$phone_number=get_perticular_field_value('zc_user','contact_ph_no'," and user_id='".$uid."'");
			}
			
			
			?>           	
            <div class="field">
				<textarea rows="3" cols="15" placeholder="Message" name="message" id="message"><?php echo $this->lang->line('details_property_i_am_interested');?></textarea>
            </div> 
			<div class="field">
				<input type="hidden" name="name" id="name" value="<?php echo $name;?>">
				<input type="hidden" name="phone_number" id="phone_number" value="<?php echo $phone_number;?>">
				<input type="hidden" name="email_id" id="email_id" value="<?php echo $email_id;?>">
            	<input type="hidden" name="re_url" value="<?php echo $this->uri->segment('1').'/'.$this->uri->segment('2');?>">
            	<input type="hidden" name="owner_id" value="<?php echo $user_profile[0]["user_id"]; ?>">
                <input type="hidden" name="property_id" value="<?php echo $property_details[0]['property_id']; ?>">
                <?php
				if($this->session->userdata( 'user_id' )=='0' || $this->session->userdata( 'user_id' )=='') {
				?>
				<a herf="javascript:void(0);" class="contact_agent"><?php echo $this->lang->line('details_property_send');?></a>
                <?php
				} else {
				?>  
				<input type="submit" value="<?php echo $this->lang->line('details_property_button_send');?>" onClick="return email_form_user_validation();" >
                <?php
				}
				?>
			</div>
            <?php
            echo form_close();
			?>
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
            
           	<?php
                if( count ( $similar_properties) > 0 ) {
			?>
            <div class="advertiser_form">
             		<h2><?php echo $this->lang->line('details_property_similar_property');?></h2>
          			<ul>
                    <?php
						 foreach($similar_properties as $similar_property)
						 {
					?>
            	  	<li>
                	<div class="last_property" style="border-bottom: 0 none;">
                    <?php
					$main_image_sim=get_perticular_field_value('zc_property_img','file_name'," and property_id='".$similar_property['property_id']."' and img_type='main_image'");
					?>
					<a style="font-size:12px;" href="<?php echo prop_url($similar_property['property_id']);?>">
                        <img src="<?php echo base_url();?>assets/uploads/Property/Property<?php echo $similar_property['property_id']; ?>/thumb_92_82/<?php echo $main_image_sim; ?>" alt="<?php echo property_name($similar_property['property_id']);?>">
                    </a>
						<h2>
							<a style="font-size:12px;" href="<?php echo prop_url($similar_property['property_id']);?>">
								<?php echo property_name($similar_property['property_id']);?>
							</a>
						</h2>
                        <h3>
						<?php
						if($similar_property['area']!=''){
							echo $area_prop=$similar_property['area'].' - ';
						}
						?>
						<?php if($similar_property['street_address']!=''){echo $similar_property['street_address'].',';} ?>
						<?php if($similar_property['street_no']!=''){echo $similar_property['street_no'].' - ';} ?>
						<?php if($similar_property['zip']!=''){echo $similar_property['zip'];} ?>
						</h3>
                       
                        <p>
                        <?php
						
						 if($similar_property['price']!=0)
						   {
							   if($similar_property['contract_id']=='1')
							{
								$per_mnt=$this->lang->line('details_property_per_month');
							}
							if($similar_property['contract_id']=='2')
							{
								$per_mnt='';
							}
						?>
						<?php echo '&euro;'.show_price($similar_property['price']);?><?php echo ' '.$per_mnt;?>
                        
						<?php
						   }
						   else
						   {
						?>
                        <?php echo $this->lang->line('details_property_private_nagotiation');?>
                        <?php
						   }
						?>
						<?php //echo percentage('251.000 ','250.000');?></p>
                    </div>
                </li>
                <?php
						 }
				?>
                              
            </ul>
          </div>
           <?php } ?>      
        </div>
		</div>
</div>
		<!------ footer part -------------->
		<?php $this->load->view("_include/footer_search");?>
		<!------- pagination js ------------------>
		<script type="text/javascript" src="assets/js/jquery.paginate.js"></script>
		<script type="text/javascript" src="https://www.youtube.com/iframe_api"></script>		
		<script type="text/javascript">
		$("#success").delay(3200).fadeOut(300);
		$("#eror").delay(3200).fadeOut(300);

		function stopVideo()
		{
			var myPlayer = document.getElementById('playerid');
			myPlayer.stopVideo();
		}
		function save_property(property_id){
			$("#prop_saved_msg").show();
			var property_id = property_id;
			var user_id = "<?php echo $this->session->userdata( 'user_id' ); ?>";
			//alert(user_id);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url();?>property/save_property",
				data: {
					property_id: property_id,
					user_id: user_id
				},
				async: false,
				success: function(result) {
					//alert(result);
					$('#prop_saved_msg').html(result);
					$("#prop_saved_msg").delay(3200).fadeOut(300);
				}
			});
		}
		function pdection() {
			alert('asdasd');
		}
		function email_property(id) {
			$('#email_seding_prop').toggle('slow');
		}
		$(function() {
			$("#demo5").paginate({
				count: 10,
				start: 1,
				display: 7,
				border: true,
				border_color: '#fff',
				text_color: '#fff',
				background_color: 'black',
				border_hover_color: '#ccc',
				text_hover_color: '#000',
				background_hover_color: '#fff',
				images: false,
				mouse: 'press',
				onChange: function(page) {
					$('._current', '#paginationdemo').removeClass('_current').hide();
					$('#p' + page).addClass('_current').show();
				}
			});
		});
		function printPage(printContent) {
			var display_setting = "toolbar=yes,menubar=yes,";
			display_setting += "scrollbars=yes,width=650, height=600, left=100, top=25";
			var pathname = window.location.pathname;
			var printpage = window.open("", "", display_setting);
			printpage.document.open();
			printpage.document.write('<html><head><title>Print Page</title></head>');
			printpage.document.write('<body onLoad="self.print()" align="left"><div style="border-bottom:solid 1px #DDDDDD;"><img src="<?php echo base_url().'assets/images/logo.png '?>" alt="Zapcasa"/></div>' + printContent + '<p>' + pathname + '</p></body></html>');
			printpage.document.close();
			printpage.focus();
			$('#nearby_category_area').hide();
			window.close();
		}
		function email_form_validation() {
			$("#email_form").validate({
				rules: {
					mail_from: {
						required: true						
					},mail_to: {
						required: true,
						multiemail: true
					},message: {
						required: true
					}
				},messages: {
					mail_to: {
						multiemail: "<?php echo $this->lang->line('details_property_comma_sep_valid_email'); ?>"
					}
				},
			});
		}
		function email_form_user_validation() {
			$(".mail_form_user").validate({
				rules: {
					name: {
						required: true
					},email_id: {
						required: true,
						email: true
					},message: {
						required: true
					}
				},messages: {
					name: "",
					email_id: "",
					message: ""
				}
			});
		}
		$('.groupOfCurrencyBox').priceFormat({
			prefix: '',
			centsSeparator: ',',
			thousandsSeparator: '.'
		});
		function isCurrency(evt, element){
			var charCode = (evt.which) ? evt.which : event.keyCode
			// “-” CHECK MINUS, AND ONLY ONE. &&  “.” CHECK DOT, AND ONLY ONE.
			if((charCode != 44 || $(element).val().indexOf(',') != -1) && (charCode != 46 || $(element).val().indexOf('.') != -1) && (charCode < 48 || charCode > 57))
				//console.log(charCode);
				return false;
			return true;
		}
		function isNumber(evt, element) {
			var charCode = (evt.which) ? evt.which : event.keyCode

			if (
				(charCode != 45 || $(element).val().indexOf(',') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
				(charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
				(charCode < 48 || charCode > 57))
				return false;

			return true;
		} 
		function isOnlyNumber(evt, element) {
			var charCode = (evt.which) ? evt.which : event.keyCode

			if (
				(charCode < 48 || charCode > 57))
				return false;

			return true;
		} 
		</script>
		<script type="text/javascript">
		$(function() {
			$(window).scroll(function() {
				var scrollTop = $(document).scrollTop();
				//var searchListHeight = $('.searchresult_box').height();
				//$('.topbluebar').html(scrollTop);
				if (scrollTop >= 40 && scrollTop <= 1385) {
					$('.map-cont').css({
						position: 'fixed',
						top: '120px',
						width: '32.7%',
					});
				} else {
					$('.map-cont').css({
						position: 'relative',
						top: '1335px',
						width: '100%',
					});
					if (scrollTop < 40) {
						$('.map-cont').removeAttr('style');
					}
				}
			});
		});
		$(document).ready(function() {
			$("#mail_form").validate({
				rules:{
					name:{
						required: true
					},email_id: {
						required: true,
						email: true
					},message: {
						required: true
					}
				},
				messages: {
					name: "",
					email_id: "",
					message: "",
					phone_number: ""
				}
			});
			$('.fancybox').fancybox();
		});
		function show_photos() {
			$('#showcase').show();
			$('#cam').addClass('active');
			$('#showcase1').css({
				height: 0,
				width: 0
			});
			$('#ar').removeClass();
			$('#showcase2').hide();
			$('#video').removeClass();
			$('#showcase3').css({
				height: 0,
				width: 0
			});
			$('#st').removeClass();
			$('#nearby_category_area').hide();
		}
		function show_video() {
			$('#showcase').hide();
			$('#cam').removeClass();
			$('#showcase1').css({
				height: 0,
				width: 0
			});
			$('#ar').removeClass();
			$('#showcase2').show();
			$('#video').addClass('active');
			$('#showcase3').css({
				height: 0,
				width: 0
			});
			$('#st').removeClass();
			$('#nearby_category_area').hide();
		}
		</script>
		<?php
		$property_details[0]['longitude'];
		if($property_details[0]['latitude'] == 0 && $property_details[0]['longitude'] == 0 ){
			$propertygetLangLatAddress = $propertyAddress.', '.$city_name.', '.$province_code.', Italy';
			$lat_lng_array = getLangLat($propertygetLangLatAddress);
			$GoogleMapMarkersCenterLatitude = $lat_lng_array->lat;
			$GoogleMapMarkersCenterLongitude = $lat_lng_array->lng;
		} else {
			$GoogleMapMarkersCenterLatitude = $property_details[0]['latitude'];
			$GoogleMapMarkersCenterLongitude = $property_details[0]['longitude'];
		}
		$propertyImage = base_url()."assets/images/no_proimg.jpg";
		$image_path = prop_image($property_details[0]['property_id']);			
		if( $image_path != "" ) {
			$propertyImage =  base_url()."assets/uploads/Property/Property".$property_details[0]['property_id']."/thumb_200_296/".$image_path;
		}
		$mainProGoogleMapMarkers = array();
		$mainProGoogleMapMarkers[] = array(
			'proptitle' => $proptitle,
			'hackerspace' => 'markers',
			'latitude' => ($GoogleMapMarkersCenterLatitude=='0'?'42.500000':$GoogleMapMarkersCenterLatitude),
			'longitude' => ($GoogleMapMarkersCenterLongitude=='0'?'21.500000':$GoogleMapMarkersCenterLongitude),
			'proaddress' => $propertyAddress,
			'propurl' => 'javascript:void(0);',
			'proprice' => '<font style="color:#ED6B1F">'.$propertyPrice.'</font>',
			'proimg' => $propertyImage
		);
		?>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/map.css?nocache=289671982568" type="text/css"/>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?=MAP_KEY?>"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/label.js"></script>
		<script type="text/javascript">
		var WebRoot = '<?php echo base_url(); ?>';
		var centerZoom = 5;
		var centerLatitude = <?php echo(!empty($GoogleMapMarkersCenterLatitude)?$GoogleMapMarkersCenterLatitude:'41.500000'); ?>;
		var centerLongitude = <?php echo(!empty($GoogleMapMarkersCenterLongitude)?$GoogleMapMarkersCenterLongitude:'21.500000'); ?>;
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
		$GoogleMapMarkers = array();
		$GoogleMapMarkers = array_merge($mainProGoogleMapMarkers,$nearByGoogleMapMarkers);
		if(!empty($GoogleMapMarkers)){
			$gMi = 0;			
			foreach($GoogleMapMarkers as $gM){
		?>		
GoogleMapMarkers.push(["<?php echo $gM['proptitle']; ?>","<?php echo $gM['hackerspace']; ?>",<?php echo $gM['latitude']; ?>,<?php echo $gM['longitude']; ?>,"<?php echo $gM['proaddress']; ?>","<?php echo $gM['propurl']; ?>",'<?php echo $gM['proprice']; ?>',"<?php echo $gM['proimg']; ?>", "proDetails"]);		
		markerTitles[<?php echo $gMi; ?>] = "<?php echo $gM['proptitle']; ?>";
		<?php
			$gMi++;
			}
		}
		?>
</script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/represent-map.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/markerclusterer.js"></script>
	</body>
</html>