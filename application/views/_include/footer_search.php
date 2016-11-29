<footer class="searchpage">
	<div class="footerbar"></div>
    <div class="mainfooter">
    	<div class="main">
        	<div class="footermenulist">
				<ul class="searchmenu">
            	<h3><?php echo $this->lang->line('footer_popular_searches');?></h3>
				<?php
				$popular_search = get_popular_search();
					foreach($popular_search as $arrPopSearch) {
						//echo "<pre>"; print_r($arrPopSearch);exit;
						if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
							if($arrPopSearch['name'] != ''){
								$proptitle = stripslashes($arrPopSearch['name'])." For ".$arrPopSearch['typology_name']." in ".stripslashes($arrPopSearch['city_name']).", ".$arrPopSearch['province_code'].", Italy";
								$LocationHref = "http://".$_SERVER['HTTP_HOST'].$arrPopSearch['ps_url'];
							}else{
								if($arrPopSearch['ps_type'] == 'advertiser_filter'){
									$proprtyType = $arrPopSearch['advertiser_type'];
									switch($proprtyType){
										case 'all':
											$proprtyType = $this->lang->line('footer_search_advertiser_all');
											break;
										case '2':
											$proprtyType = $this->lang->line('footer_search_advertise_owners');
											break;
										case '3':
											$proprtyType = $this->lang->line('footer_search_advertise_agency');
											break;
										default:
											$proprtyType = $this->lang->line('footer_search_advertiser_all');
											break;
									}
									
									$linkData0 = explode("&name=",$arrPopSearch['ps_url']);
									$linkData1 = explode("location=",$linkData0[0]);
									
									$LocationHref = "http://".$_SERVER['HTTP_HOST'].$linkData1[0]."location=".stripslashes($arrPopSearch['city_name']).($arrPopSearch['province_code']==''?'':", ".$arrPopSearch['province_code']).", Italy";
									$LocationHref.= "&name=".$linkData0[1];
								
								}else{
									$proprtyType = stripslashes($arrPopSearch['typology_name']);
									$LocationHref = "http://".$_SERVER['HTTP_HOST'].$arrPopSearch['ps_url'];
								}
								//$proptitle = $proprtyType." in ".stripslashes($arrPopSearch['ps_keyword']);
								$proptitle = $proprtyType.($arrPopSearch['city_name']==''?'':" in ".stripslashes($arrPopSearch['city_name'])).($arrPopSearch['province_code']==''?'':", ".$arrPopSearch['province_code']).", Italy";
							}
							$location = $arrPopSearch['location_en'];
						} else {
							if($arrPopSearch['name_it'] != ''){
								$proptitle = $arrPopSearch['typology_name_it']." in ".stripslashes($arrPopSearch['name_it'])." a ".stripslashes($arrPopSearch['city_name_it']).", ".$arrPopSearch['province_code'].", Italia";
								$LocationHref = "http://".$_SERVER['HTTP_HOST'].$arrPopSearch['ps_url'];
							}else{
								if($arrPopSearch['ps_type'] == 'advertiser_filter'){
									$proprtyType = $arrPopSearch['advertiser_type'];
									switch($proprtyType){
										case 'all':
											$proprtyType = $this->lang->line('footer_search_advertiser_all');
											break;
										case '2':
											$proprtyType = $this->lang->line('footer_search_advertise_owners');
											break;
										case '3':
											$proprtyType = $this->lang->line('footer_search_advertise_agency');
											break;
										default:
											$proprtyType = $this->lang->line('footer_search_advertiser_all');
											break;
									}
									
									$linkData0 = explode("&name=",$arrPopSearch['ps_url']);
									$linkData1 = explode("location=",$linkData0[0]);
									
									$LocationHref = "http://".$_SERVER['HTTP_HOST'].$linkData1[0]."location=".stripslashes($arrPopSearch['city_name_it']).($arrPopSearch['province_code']==''?'':", ".$arrPopSearch['province_code']).", Italia";
									$LocationHref.= "&name=".$linkData0[1];
								
								}else{
									$proprtyType = stripslashes($arrPopSearch['typology_name_it']);
									$LocationHref = "http://".$_SERVER['HTTP_HOST'].$arrPopSearch['ps_url'];
								}
								//$proptitle = $proprtyType." a ".stripslashes($arrPopSearch['ps_keyword']);
								$proptitle = $proprtyType.($arrPopSearch['city_name_it']==''?'':" a ".stripslashes($arrPopSearch['city_name_it'])).($arrPopSearch['province_code']==''?'':", ".$arrPopSearch['province_code']).", Italia";
							}
							$location = $arrPopSearch['location_it'];
						}						
						$searchlink = 'property/search?location='.$location.'&category_id='.$arrPopSearch['category_id'].'&contract_type='.$arrPopSearch['contract_type'].'&typology[]='.$arrPopSearch['typology'];
					$proptitle = ($arrPopSearch['for_luxury']!=''?$this->lang->line('mainMenu-luxury').' ':'').$proptitle;
				?>
                	<li><a href="<?php echo $LocationHref; ?>"><?php echo $proptitle;?></a></li>
				<?php
					}
				?>
                </ul>
                
                <ul class="searchmenu">
                <h3><?php echo $this->lang->line('footer_you_are_an_advertiser');?></h3>
                <?php $user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$this->session->userdata( 'user_id' )."'");
				if($user_type=='2' || $user_type=='3')
				  { ?>
                
                <li><a href="<?php echo base_url();?>property/add_property_form" class="freepost"><?php echo $this->lang->line('footer_place_a_free_advert');?></a></li>
                <?php
					}
					if($user_type=='1')
					{
				?>
                 <li><a href="<?php echo base_url()."users/my_account/"; ?>"><?php echo $this->lang->line('footer_place_a_free_advert');?></a></li>
				 <?php
				  }
				
                  if($this->session->userdata( 'user_id' )=='0'  || $this->session->userdata( 'user_id' )=='' )
				  
				  {
				?>
                 <li><a href="<?php echo base_url();?>users/common_reg" class="freepost"><?php echo $this->lang->line('footer_place_a_free_advert');?></a></li>
                <?php }?>				 
                <li><a href="<?php echo base_url()."site/Highlight_your_advert/"; ?>"><?php echo $this->lang->line('footer_highlight_your_advert');?></a></li>
                
              <?php /*?>
			 <!-- #########################  Advertiser List  ######################## -->
			    
                 <?php 
					$advertiser_record = get_advertiser_footer();
					//echo "<pre>";
					//print_r($advertiser_record);die;
					foreach($advertiser_record as $adrec)
					{
				?>                
                	<li><a href="<?php echo base_url()."advertiser/advertiser_details/".$adrec['user_id']; ?>"><?php echo $adrec['first_name']." ".$adrec['last_name']; ?></a></li>
                    
              <?php }?>
                	<?php */?>
                </ul>
                <ul class="searchmenu_last">
                <h3><?php echo $this->lang->line('footer_our_estate_agencies');?></h3>  
                
                             
                    <li><?php echo anchor('advertiser/agency_search_by_area/North-west', $this->lang->line('footer_northwest_agencies'), array('title' => $this->lang->line('footer_northwest_agencies')));?></li>
                    <li><?php echo anchor('advertiser/agency_search_by_area/North-east', $this->lang->line('footer_northeast_agencies'), array('title' => $this->lang->line('footer_northeast_agencies')));?></li>
                    <li><?php echo anchor('advertiser/agency_search_by_area/Center', $this->lang->line('footer_central_agencies'), array('title' => $this->lang->line('footer_central_agencies')));?></li>
                    <li><?php echo anchor('advertiser/agency_search_by_area/South', $this->lang->line('footer_south_agencies'), array('title' => $this->lang->line('footer_south_agencies')));?></li>
                    
                    <li><?php echo anchor('advertiser/agency_search_by_area/Islands', $this->lang->line('footer_islands_agencies'), array('title' => $this->lang->line('footer_islands_agencies')));?></li>
                    
                </ul>
            </div>
        </div>
    </div>
     <?php 
    	$followUs = get_all_value('zc_settings',"and meta_key_group='social_pages'");
    ?>
    <div class="footerlast_sec">
    	<div class="main">
        	<div style="width:70%; float:left;">
            <ul>
          	  <li><a href="<?php echo base_url();?>site/cmsPages/about-us" title="<?php echo $this->lang->line('footer_about_us_title');?>" ><?php echo $this->lang->line('footer_about_us');?></a></li>
              <!--<li><a href="">Site Map</a></li>-->
              <li><a href="<?php echo base_url();?>site/cmsPages/privacy" title="<?php echo $this->lang->line('footer_privacy_title');?>" ><?php echo $this->lang->line('footer_privacy');?></a></li>
              <li><a href="<?php echo base_url();?>site/cmsPages/disclaimer" title="<?php echo $this->lang->line('footer_disclaimer_title');?>" ><?php echo $this->lang->line('footer_disclaimer');?></a></li>
              <li><a href="<?php echo base_url();?>site/cmsPages/terms-of-use" title="<?php echo $this->lang->line('footer_terms_title');?>" ><?php echo $this->lang->line('footer_terms');?></a></li>
              <li><a href="<?php echo base_url();?>site/cmsPages/cookie-policy" title="<?php echo $this->lang->line('footer_policy_title');?>" ><?php echo $this->lang->line('footer_policy');?></a></li>
              <li><a href="<?php echo base_url();?>contact_us" title="<?php echo $this->lang->line('footer_contact_title');?>" ><?php echo $this->lang->line('footer_contact');?></a></li>
            </ul>
            <p>&copy; <?php echo $this->lang->line('footer_rights_reserved');?></p>
            </div>
            <ul class="follow">
            	<?php if( count($followUs) > 0 ) { ?>
	            	<li style="padding-right:20px;"><?php echo $this->lang->line('footer_follow_us');?></li>
	            	<?php foreach( $followUs as $follow_us ): ?>	
			            	<?php if( ( $follow_us['meta_name'] == "facebook_page") && ( $follow_us['meta_value'] != "" ) ) { ?>
			                	<li><a href="<?php echo "http://".$follow_us['meta_value']; ?>" class="facebook" target="_blank" ></a></li>
			                <?php } if( ( $follow_us['meta_name'] == "twitter_page") && ( $follow_us['meta_value'] != "" ) ) { ?>
			                	<li><a href="<?php echo "http://".$follow_us['meta_value']; ?>" class="twitter" target="_blank" ></a></li>
			                <?php } if( ( $follow_us['meta_name'] == "gplus_page") && ( $follow_us['meta_value'] != "" ) ) { ?>	
			                	<li><a href="<?php echo "http://".$follow_us['meta_value']; ?>" class="gplus" target="_blank" ></a></li>
			                <?php } ?>
	             	<?php endforeach; ?>
                <?php } ?>
            </ul>
        </div>
    </div>
</footer>

<!-------------------placeholder--------------------->

<script>
	//$(function() {
		// Invoke the plugin
		//$('input, textarea').placeholder();
		
	//});
	$(window).load( function(){
		//$('input, textarea').placeholder();
	});
</script>
