<?php $this->load->view("inc/header");?>
 <!------ banner part -------------->
<div class="slider">
  <div class="flexslider">
     <ul class="slides">
        <li><img src="<?php echo base_url();?>assets/images/alpha_10x10.png" alt="" style="background: url(<?php echo base_url();?>assets/images/banner_img1.jpg) 50% 50% no-repeat rgb(13, 11, 10);"/></li>
      <li><img src="<?php echo base_url();?>assets/images/alpha_10x10.png" alt="" style="background: url(<?php echo base_url();?>assets/images/banner_img2.jpg) 50% 50% no-repeat rgb(13, 11, 10);"/></li>
        <li><img src="<?php echo base_url();?>assets/images/alpha_10x10.png" alt="" style="background: url(<?php echo base_url();?>assets/images/banner_img3.jpg) 50% 50% no-repeat rgb(13, 11, 10);"/></li>
	 </ul>
      <div class="main">
      	<div class="property_sect">
        	<div class="property_colum">
            	<h2><?php echo $this->lang->line('home_page_search_for_a_property');?></h2>

				<div class="tabBox">


					<form name="search" id="prop_search" method="get" class="searchbox" action="<?php echo base_url();?>property/search">
                            	<h4><?php echo $this->lang->line('home_page_search_by');?>:</h4>
                                <span style="height:63px;">
                                	<label><?php echo $this->lang->line('home_page_category');?></label>
									<?php
									//echo "<pre>"; print_r($categories);
									?>
                                    <select name="category_id" onChange="setOptions(this.value);" >
									<?php
									if ($categories != '') {
											foreach($categories as $arrCat){
												if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
													echo '<option value="'.$arrCat['category_id'].'">'.$arrCat['name'].'</option>';
													if($arrCat['subcat'] != 0){
														foreach($arrCat['subcat'] as $arrSubCat){
															echo '<option value="'.$arrSubCat->category_id.'"> -- '.$arrSubCat->name.'</option>';
														}
													}
												} else {
													echo '<option value="'.$arrCat['category_id'].'">'.$arrCat['name_it'].'</option>';
													if($arrCat['subcat'] != 0){
														foreach($arrCat['subcat'] as $arrSubCat){
															echo '<option value="'.$arrSubCat->category_id.'"> -- '.$arrSubCat->name_it.'</option>';
														}
													}
												}
											}
										}
									?>
									</select>
                                </span>
                                <span>
                                	<label><?php echo $this->lang->line('home_page_contract_type');?></label>
                                    <table cellpadding="0" cellspacing="0">
                                    	<tr>
											<td><input type="radio" checked="true" name="contract_type" value="all" id="contract_for_all" ></td><td><?php echo $this->lang->line('home_page_contract_type_all');?></td>
											<td width="22px"></td>

								<?php
									if($contract_types != ''){
										foreach($contract_types as $arrCT){
											if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
								?>
												<td><input type="radio" name="contract_type" value="<?php echo $arrCT['contract_id'];?>" id="contract_for_<?php echo $arrCT['name'];?>" ></td>
												<td>Only for <?php echo $arrCT['name'];?></td>
								<?php
											} else {
								?>
												<td><input type="radio" name="contract_type" value="<?php echo $arrCT['contract_id'];?>" id="contract_for_<?php echo $arrCT['name'];?>" ></td>
												<td>Solo in <?php echo $arrCT['name_it'];?></td>
								<?php
											}
										}
									}
								?>
                                        </tr>
                                    </table>
                                </span>
                                <span>
                                	<label><?php echo $this->lang->line('home_page_type_of_advertiser');?></label>
                                    <table cellpadding="0" cellspacing="0">
                                    	<tr>
                                        	<td><input type="radio" checked="true" name="posted_by" value="all"></td><td><?php echo $this->lang->line('home_page_type_of_advertiser_all');?></td><td width="22px"></td>
                                            <td><input type="radio" name="posted_by" value="2"></td><td><?php echo $this->lang->line('home_page_type_of_advertiser_only_owners');?></td></td>
                                            <td><input type="radio" name="posted_by" value="3"></td><td><?php echo $this->lang->line('home_page_type_of_advertiser_only_agencies');?></td>
                                        </tr>
                                    </table>
                                </span>
                                <span>
                                	<label><?php echo $this->lang->line('home_page_location');?></label>
                                    <table cellpadding="0" cellspacing="0">
                                    	<tr>
                                       	 <td align="center">
											<a class="locate" href="javascript:void(0);" onclick="getMyLocation1();" title="<?php echo $this->lang->line('home_page_search_near_me'); ?>">
												<img src="<?php echo base_url();?>assets/images/location_icon.png" alt="<?php echo $this->lang->line('home_page_search_near_me'); ?>">
											</a>
										 </td>
                                         <td width="10px">&nbsp;</td>
                                         <td width="278px"><input type="text" name="location" id="location" placeholder="<?php echo $this->lang->line('home_page_property_location_field');?>" autocomplete="off"><div id="suggesstion-box" style='overflow:auto;max-height:150px;position:absolute;z-index:1;width:265px;'></div></td>
                                        </tr>
                                    </table>
                                </span>
                                <span style="padding-bottom:14px;">
                                	<label><?php echo $this->lang->line('home_page_price');?></label>
                                    <table cellpadding="0" cellspacing="0" style="width:320px;">
                                    	<tr>
											<td width="32px"><?php echo $this->lang->line('home_page_price_from');?></td>
											<td width="120px">
												<input type="text" class="groupOfCurrencyBox small" name="min_price" value="0">
											</td>
											<td width="12px" style="color:#177cc2; font-size:12px; font-weight:bold;">
												<?php echo $this->lang->line('home_page_price_currency');?>
											</td>
											<td width="9px">&nbsp;</td>
											<td width="15px">
												<?php echo $this->lang->line('home_page_price_to');?>
											</td>
											<td width="120px">
												<input type="text" class="groupOfCurrencyBox small" name="max_price" value="0">
											</td>
											<td width="12px" style="color:#177cc2; font-size:12px; font-weight:bold;">
												<?php echo $this->lang->line('home_page_price_currency');?>
											</td>
                                        </tr>
                                    </table>
                                </span>
                            	<div class="bottomsect">
                                	<input type="submit" value="<?php echo $this->lang->line('home_page_button_search');?>" class="searchbt">
                                </div>
                             </form>


					<div class="bottomshadow"></div>

          		</div>
            </div>
            <div class="property_colum_adverts">
           	   <h2><?php echo $this->lang->line('home_page_find_an_advertiser');?></h2>
           	   <div class="tabBox1">
               		<form name="agency_search" id="agency_search" method="get" class="searchbox1" action="<?php echo base_url();?>advertiser/search">
                            	<h4><?php echo $this->lang->line('home_page_find_an_advertiser_search_by');?>:</h4>
                                <span>
                                	<label><?php echo $this->lang->line('home_page_find_an_advertiser_location');?></label>
                                    <table cellpadding="0" cellspacing="0">
                                    	<tr>
                                       	 <td align="center">
											<a class="locate" href="javascript:void(0);" onclick="getMyLocation2();" title="<?php echo $this->lang->line('home_page_search_near_me'); ?>">
												<img src="<?php echo base_url();?>assets/images/location_icon.png" alt="<?php echo $this->lang->line('home_page_search_near_me'); ?>">
											 </a>
										 </td>
                                         <td width="10px">&nbsp;</td>
                                         <td width="278px"><input type="text" name="location" id="location2" class="required" placeholder="<?php echo $this->lang->line('home_page_advertiser_location_field');?>" autocomplete="off">
                                         <div id="suggesstion-box2" style='overflow:auto;max-height:300px;position:absolute;z-index:1;width:260px;'>
                                         </div>
                                         </td>
                                        </tr>
                                    </table>
                                </span>
                                <span>
                                	<label><?php echo $this->lang->line('home_page_find_an_advertiser_name');?></label>
                                    <table cellpadding="0" cellspacing="0">
                                    	<tr>
                                        	<td><input class="big" type="text" name="name"  placeholder="<?php echo $this->lang->line('home_page_advertiser_name_field');?>"></td>
                                        </tr>
                                    </table>
                                </span>
                                <span>
                                	<label><?php echo $this->lang->line('home_page_find_an_advertiser_type');?></label>
                                    <table cellpadding="0" cellspacing="0">
                                    	<tr>
                                        	<td><input type="radio" checked="true" name="advertiser_type" value="all" class="required"></td><td><?php echo $this->lang->line('home_page_find_an_advertiser_type_all');?></td><td width="22px"></td>
                                            <td><input type="radio" name="advertiser_type" value="2" class="required"></td><td><?php echo $this->lang->line('home_page_find_an_advertiser_type_only_owners');?></td></td>
                                            <td><input type="radio" name="advertiser_type" value="3" class="required"></td><td><?php echo $this->lang->line('home_page_find_an_advertiser_type_only_agencies');?></td>
										</tr>
                                    </table>
                                </span>

						<div class="bottomsect">
                                	<input type="submit" value="<?php echo $this->lang->line('home_page_button_search');?>" class="searchbt">
                                </div>
                            </form>
                    <div class="bottomshadow1"></div>
               </div>
            </div>
            <div class="property_colum_postp">
            	<h2><?php echo $this->lang->line('home_page_post_your_property');?></h2>
                <?php if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) { ?>
				<div class="tabBox2 en">
				<?php } elseif( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "it" )) { ?>
				<div class="tabBox2 it">
				<?php } ?>
                	<h3><?php echo $this->lang->line('home_page_post_your_property_image');?></h3>
                    <div style="margin-top:347px;">
						<?php
						$user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$this->session->userdata( 'user_id' )."'");
						if($user_type=='2' || $user_type=='3') {
							?>
						<a href="<?php echo base_url();?>property/add_property_form" class="freepost">
							<?php echo $this->lang->line('advertise_details_post_your_property'); ?>
							<font style="color:#fff000">
								<?php echo $this->lang->line('advertise_details_free');?>
							</font>
						</a>
						<?php
						}elseif($user_type=='1') {
							?>
						<a href="<?php echo base_url();?>property/add_property_form" class="freepost add_property">
							<?php echo $this->lang->line('advertise_details_post_your_property'); ?>
							<font style="color:#fff000">
								<?php echo $this->lang->line('advertise_details_free');?>
							</font>
						</a>
						<?php
						}elseif($this->session->userdata( 'user_id' )=='0'  || $this->session->userdata( 'user_id' )=='' ) {
						?>
						<a href="<?php echo base_url();?>users/common_reg" class="freepost">
							<?php echo $this->lang->line('advertise_details_post_your_property'); ?>
							<font style="color:#fff000">
								<?php echo $this->lang->line('advertise_details_free');?>
							</font>
						</a>
						<?php
						}
						?>
					</div>
                </div>
            </div>
        </div>
		</div>
	</div>
</div>
<div class="taglinesect">
	<div class="main">
    	<h3 class="tagline">
			<?php echo $this->lang->line('home_page_real_estate_for'); ?>
			<font style="font-weight:bold; color:#3687c6;">
				<?php echo $this->lang->line('home_page_jobs');?>
			</font> <?php echo $this->lang->line('home_page_and'); ?>
			<font style="font-weight:bold; color:#3687c6;">
				<?php echo $this->lang->line('home_page_housing');?>
			</font>
		</h3>
        <span>
			<a href="<?php echo base_url();?>site/cmsPages/about-us" class="readmore">
				<?php echo $this->lang->line('home_page_read_more');?>
			</a>
		</span>
    </div>
</div>

<!------ body part -------------->

<div class="main">
	<section>
		<?php
		//Featured Properties.
		if(count($featured_property)>0){
			?>
		<div class="valuableprop">
			<div class="leftcont">
				<h1 style="text-align: left;" ><?php echo $this->lang->line('home_page_featured_properties');?></h1>
				<p style="text-align: left;" ><?php echo $this->lang->line('home_page_featured_properties_content');?></p>
			</div>
			<div class="rightcarousel">
				<div id="wrapper">
					<div class="carousel">
						<?php
						foreach ($featured_property as $property_featured_detail) {
						$main_image=get_perticular_field_value('zc_property_img','file_name'," and property_id='".$property_featured_detail['property_id']."' and img_type='main_image'");
						$property_name=property_name($property_featured_detail['property_id']);

						$contract="";
						$prop_det_url='';
						if($property_featured_detail['contract_id']==1) {
							$contract="Rent";
						} if($property_featured_detail['contract_id']==2) {
							$contract="Sell";
						}
						$prop_det_url.=$contract;
						$prop_det_url.='-'.trim($property_featured_detail['city']);
						$prop_det_url.='-'.trim($property_featured_detail['provience']);
						$prop_det_url.='-'.trim($property_featured_detail['property_id']);

						$parentCategoryName = get_category_field_value($property_featured_detail['category_id']);
						$parms_name = "";
						if( $parentCategoryName == 1 ) {
							$parms_name = "Residential";
						}if( $parentCategoryName == 2 ) {
							$parms_name = "Business";
						}if( $parentCategoryName == 3 ) {
							$parms_name = "Rooms";
						}if( $parentCategoryName == 4 ) {
							$parms_name = "Land";
						}if( $parentCategoryName == 5 ) {
							$parms_name = "Vacations";
						}
						if( $parms_name != "" ) {
							$parms_url = base_url().$parms_name."/".$prop_det_url;
						} else {
							$parms_url = $search_title."/".$prop_det_url;
						}

						if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
							$name=get_perticular_field_value('zc_contract_types','name'," and contract_id='".$property_featured_detail['contract_id']."'");
							$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$property_featured_detail['typology']."'");
							$city_name=get_perticular_field_value('zc_city','city_name'," and city_id='".$property_featured_detail['city']."'");
							$province_code=get_perticular_field_value('zc_region_master','province_code'," and city='".$city_name."'");

							$proptitle = $name." For ".stripslashes($typology_name)." in ".$city_name.", ".$province_code;
						} else {
							$name_it=get_perticular_field_value('zc_contract_types','name_it'," and contract_id='".$property_featured_detail['contract_id']."'");
							$typology_name=get_perticular_field_value('zc_typologies','name_it'," and status='active' and typology_id='".$property_featured_detail['typology']."'");
							$city_name_it=get_perticular_field_value('zc_city','city_name_it'," and city_id='".$property_featured_detail['city']."'");
							$province_code=get_perticular_field_value('zc_region_master','province_code'," and city_it='".$city_name_it."'");

							$proptitle = stripslashes($typology_name)." in ".$name_it." a ".$city_name_it.", ".$province_code;
						}
						?>
						<span>
							<a href="<?php echo $parms_url;?>">
								<img src="<?php echo base_url();?>assets/uploads/Property/Property<?php echo $property_featured_detail['property_id'];?>/thumb_860_482/<?php echo $main_image;?>" alt="<?php echo str_replace("\'","'",$proptitle); ?>"/>
								<h4 style="font-size:13px;"><?php echo str_replace("\'","'",$proptitle); ?></h4>
							</a>
							<p class="price">
							<?php
							if($property_featured_detail['price']!='0.00'){
								echo '&euro; <b style="font-weight:bold">'.show_price($property_featured_detail['price']).'</b>';
								if($property_featured_detail['contract_id']==1){
								?>
								<b style="color:#000; font-weight:bold"><?php echo $this->lang->line('home_page_per_month');?></b>
								<?php
								}
								if($property_featured_detail['update_price']!='0.00'){
									$per_prop=percentage($property_featured_detail['update_price'],$property_featured_detail['price']);
									if($per_prop!=0){
										?>
										<b style="color:#000; font-weight:bold;">|</b>
										<?php
										if ($per_prop < 0){
										?>
										<b style="color:#090; font-weight:bold; padding-left:2px;">
											<img src="<?php echo base_url();?>assets/images/green.gif" width="8px"
												 height="8px"
												 style="width:8px;height:8px;display:inline;float:none;padding:0;">
											<?php echo percentage($property_featured_detail['update_price'],$property_featured_detail['price']);?> %
										</b>
										<?php
										}else{
										?>
										<b style="color:#F00; font-weight:bold; padding-left:2px;">
											<img src="<?php echo base_url();?>assets/images/red.gif" width="8px"
												 height="8px"
												 style="width:8px;height:8px;display:inline;float:none;padding:0;">
											<?php echo '+'.percentage($property_featured_detail['update_price'],$property_featured_detail['price']);?> %
										</b>
										<?php
										}
									}
								}
							}else{
								?>
								<b style="font-weight:bold;">
									<?php echo $this->lang->line('home_page_private_nagotiation');?>
								</b>
								<?php
							}
							?>
							</p>
						</span>
						<?php
					}
						?>
					</div>
					<?php
					if( count($featured_property)>3){
						?>
						<a class="prev" href="#">
							<img src="<?php echo base_url();?>assets/images/leftarrow.png" alt="<?php echo $this->lang->line('home_page_button_prev');?>">
						</a>
						<a class="next" href="#">
							<img src="<?php echo base_url();?>assets/images/rightarrow.png" alt="<?php echo $this->lang->line('home_page_button_next');?>">
						</a>
						<?php
					}else{
						?>
						<a class="prev_">
							<img src="<?php echo base_url();?>assets/images/leftarrow.png" alt="<?php echo $this->lang->line('home_page_button_prev');?>">
						</a>
						<a class="next_">
							<img src="<?php echo base_url();?>assets/images/rightarrow.png" alt="<?php echo $this->lang->line('home_page_button_next');?>">
						</a>
						<?php
					}
					?>
				</div>
			</div>
		</div>
		<?php
		}
		//Latest Properties.
		if(count($latest_property) > 0 && $latest_property != ''){
		?>
		<div class="latestadd">
        	<div class="leftcont">
            	<h1><?php echo $this->lang->line('home_page_latest_add');?></h1>
                <p><?php echo $this->lang->line('home_page_latest_add_content');?></p>
            </div>
            <div class="rightcarousel">
                <div id="wrapper">
                    <div class="carousel2">
					<?php
						foreach($latest_property as $lprop){
							/*-----------for url-------*/
							$first_segment="";
							$category_id = $lprop['category_id'];
						if($category_id=='6' || $category_id=='7'){
							$first_segment='Business';
							///////////////////////////////////////////////////
						}
						if($category_id=='1'){
							$first_segment='Residential';
							///////////////////////////////////////////////////
						}
						if($category_id=='3'){
							$first_segment='Rooms';
							///////////////////////////////////////////////////
						}
						if($category_id=='4'){
							$first_segment='Land';
							///////////////////////////////////////////////////
						}
						if($category_id=='5'){
							$first_segment='Vacations';
							///////////////////////////////////////////////////
						}
						$prop_det_url='';
				 		if($lprop['contract_id']==1){
							$contract="Rent";
						}
						if($lprop['contract_id']==2){
							$contract="Sell";
						}
						$prop_det_url.=$contract;
						$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$lprop['typology']."'");
						//$prop_det_url.='-'.trim($typology_name);
						$prop_det_url.='-'.trim($lprop['city']);
						$prop_det_url.='-'.trim($lprop['provience']);
						$prop_det_url.='-'.trim($lprop['property_id']);
						/*-------------end-----------------------*/
						if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {

							$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$lprop['typology']."'");

							$proptitle = $lprop['name']." For ".stripslashes($typology_name)." in ".$lprop['city_name'].", ".$lprop['province_code'];
						} else {

							$typology_name=get_perticular_field_value('zc_typologies','name_it'," and status='active' and typology_id='".$lprop['typology']."'");

							$proptitle = stripslashes($typology_name)." in ".$lprop['name_it']." a ".$lprop['city_name_it'].", ".$lprop['province_code'];
						}

						if($lprop['main_img']){
							$lpropImg = base_url().'assets/uploads/Property/Property'.$lprop['property_id'].'/thumb_860_482/'.$lprop['main_img'];
						}else{
							$lpropImg = base_url().'assets/images/no_proimg.jpg';
						}

							?>
						<span>
							<a href="<?php echo base_url();?><?php echo $first_segment;?>/<?php echo $prop_det_url;?>">
								<img src="<?php echo $lpropImg; ?>" alt="<?php echo str_replace("\'","'",$proptitle); ?>">
								<h4 style="font-size:13px;"><?php echo str_replace("\'","'",$proptitle); ?></h4>
							</a>
							<p class="price">
							<?php
							if($lprop['price']!='0.00'){
								echo '&euro; <b style="font-weight:bold">'.show_price($lprop['price']).'</b>';
								if($lprop['contract_id']==1){
								?>
								<b style="color:#000; font-weight:bold"><?php echo $this->lang->line('home_page_per_month');?></b>
								<?php
								}
								if($lprop['update_price']!='0.00'){
									$per_prop=percentage($lprop['update_price'],$lprop['price']);
									if($per_prop!=0){
										?>
										<b style="color:#000; font-weight:bold;">|</b>
										<?php
										if ($per_prop < 0){
										?>
										<b style="color:#090; font-weight:bold; padding-left:2px;">
											<img src="<?php echo base_url();?>assets/images/green.gif" width="8px" height="8px" style="width:8px;height:8px;display:inline;float:none;padding:0;">
											<?php echo percentage($lprop['update_price'],$lprop['price']);?> %
										</b>
										<?php
										}else{
										?>
										<b style="color:#F00; font-weight:bold; padding-left:2px;">
											<img src="<?php echo base_url();?>assets/images/red.gif" width="8px" height="8px" style="width:8px;height:8px;display:inline;float:none;padding:0;">
											<?php echo '+'.percentage($lprop['update_price'],$lprop['price']);?> %
										</b>
										<?php
										}
									}
								}
							}else{
								?>
								<b style="font-weight:bold;">
									<?php echo $this->lang->line('home_page_private_nagotiation');?>
								</b>
								<?php
							}
							?>
							</p>
							<!--
							<p class="price">
								&euro;
								<b style="font-weight:bold">
									<?php //echo $lprop['update_price'];?>
								</b> |
								<?php //echo $lprop['surface_area'];?> m | <?php //echo $lprop['room_no'];?> Rooms
							</p>
							-->
						</span>
						<?php
						}
						?>
                    </div>
					<a class="prev2" href="#"><img src="<?php echo base_url();?>assets/images/leftarrow.png" alt="<?php echo $this->lang->line('home_page_button_prev');?>"></a>
					<a class="next2" href="#"><img src="<?php echo base_url();?>assets/images/rightarrow.png" alt="<?php echo $this->lang->line('home_page_button_next');?>"></a>
                </div>
            </div>
        </div>
		<?php
		}
		?>
    </section>
</div>
<style>
#country-list{background: #ffffff;float:left;list-style:none;margin:0;padding:0;width:100%;}
#country-list li{padding: 10px; background: #ffffff;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background: #f0f0f0;}
#location{padding: 10px;border: #c4c4c4 1px solid;}
</style>
<script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.geocomplete.js"></script>
<script type="text/javascript">
if (navigator.geolocation) {
	// Browser supports it, we're good to go!
} else {
	alert('<?php echo $this->lang->line('home_page_your_browser_not_suport_geolocation');?>');
}
function getMyLocation1(){
	navigator.geolocation.getCurrentPosition(exportPosition1, errorPosition);
}
function getMyLocation2(){
	navigator.geolocation.getCurrentPosition(exportPosition2, errorPosition);
}
function errorPosition(){
    alert('<?php echo $this->lang->line('home_page_your_position_cannot_be_detected');?>');
}
function exportPosition1(position){
    ShowMyLocation(position.coords.latitude, position.coords.longitude, 'location');
}
function exportPosition2(position){
    ShowMyLocation(position.coords.latitude, position.coords.longitude, 'location2');
}
function ShowMyLocation(MyLatitude, MyLongitude, InputBoxID){
	var MyLanguage = '<?php echo($_COOKIE['lang']=='it'?'it':'en'); ?>';
	var URL = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='+MyLatitude+','+MyLongitude+'&sensor=false&language='+MyLanguage;
	//var URL = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=40.851775,14.268124&sensor=false&language='+MyLanguage;
	$.ajax({
		url: URL,
		success: function(data){
			var MyLocation = '';
			for(var i = 0; i < data.results[3].address_components.length; i++){
				for(var j = 0; j < data.results[3].address_components[i].types.length; j++){
					if(data.results[1].address_components[i].types[j] == 'locality'){
						MyLocation+= data.results[1].address_components[i].long_name + ', ';
					}
					if(data.results[1].address_components[i].types[j] == 'administrative_area_level_2'){
						MyLocation+= data.results[1].address_components[i].short_name + ', ';
					}
					if(data.results[3].address_components[i].types[j] == 'country'){
						MyLocation+= data.results[3].address_components[i].long_name;
					}
					/*if(data.results[3].address_components[i].types[j] == 'postal_code'){
						MyLocation+= data.results[3].address_components[i].short_name;
					}*/
				}
			}
			$('#'+InputBoxID).val(MyLocation);
		}
	});
}
/* function getMyLocation(txtname){
	var myloc = geoplugin_city()+(geoplugin_region()!=''?', '+geoplugin_region():'')+(geoplugin_countryName()!=''?', '+geoplugin_countryName():'');
	$('#'+txtname).val(myloc);
} */
$(document).ready(function () {
	$("#location").keyup(function(){
		var o1 = $(this).val();
        if (o1.length > 2) {
			a(function() {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>property/getAjaxLocations",
					data:'fname=location&disname=suggesstion-box&keyword='+o1+"&lang=<?php echo $_COOKIE['lang']; ?>",
					beforeSend: function(){
						$("#location").css("background","#FFF url(<?php echo base_url(); ?>assets/images/LoaderIcon.gif) no-repeat 98%");
					},
					success: function(data){
						$("#suggesstion-box").html('');
						if(data != 0){
							$("#suggesstion-box").show();
							$("#suggesstion-box").html(data);
							$("#suggesstion-box").css("border","#c4c4c4 1px solid");
							$("#location").css("background","#FFF");
						}else{
							$("#suggesstion-box").hide();
							$("#location").css("background","#FFF");
						}
					}
				});
			}, 500)
		}else{
			$("#suggesstion-box").html('');
			$("#suggesstion-box").hide();
		}
	});
	$("#location2").keyup(function(){
		var o2 = $(this).val();
        if (o2.length > 2) {
			a(function() {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>property/getAjaxAdvLocations",
					data:'fname=location2&disname=suggesstion-box2&keyword='+o2+"&lang=<?php echo $_COOKIE['lang']; ?>",
					beforeSend: function(){
						$("#suggesstion-box2").html('');
						$("#location2").css("background","#FFF url(<?php echo base_url(); ?>assets/images/LoaderIcon.gif) no-repeat 98%");
					},
					success: function(data){
						$("#suggesstion-box2").html('');
						if(data != 0){
							$("#suggesstion-box2").html('');
							$("#suggesstion-box2").show();
							$("#suggesstion-box2").html(data);
							$("#suggesstion-box2").css("border","#c4c4c4 1px solid");
							$("#location2").css("background","#FFF");
						}else{
							$("#suggesstion-box2").html('');
							$("#suggesstion-box2").hide();
							$("#location2").css("background","#FFF");
						}
					}
				});
			}, 500)
		}else{
			$("#suggesstion-box2").html('');
			$("#suggesstion-box2").hide();
		}
	});
	var a = (function() {
		var e = 0;
		return function(t, s) {
			clearTimeout(e);
			e = setTimeout(t, s)
		}
	})(),
		e = 0;
});
function selectCountry(val, fname, disname) {
	$("#"+fname).val(val);
	$("#"+disname).hide();
	$("#suggesstion-box").css("border","#c4c4c4 0px solid");
	$("#suggesstion-box2").css("border","#c4c4c4 0px solid");
}
</script>
<?php $this->load->view("inc/footer"); ?>