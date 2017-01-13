<?php $this->load->view("_include/meta"); ?>
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
</script>
</head>
<body class="noJS">
    <script>
	var bodyTag = document.getElementsByTagName("body")[0];
	bodyTag.className = bodyTag.className.replace("noJS", "hasJS");
    </script>
    <!------ Header part -------------->
    <?php $this->load->view("_include/header"); ?>
    <!------ banner part -------------->
    <div class="insidepage_banner">
        <div class="main">
            <h2><?php echo $this->lang->line('property_details_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('property_details_jobs');?></font> <?php echo $this->lang->line('property_details_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('property_details_housing');?></font></h2>
        </div>
    </div>
    <!----- login pop up start  ---------------------->
    <?php $this->load->view("_include/login_user"); ?>          
    <!----- login pop up end ---------------------->
    <!------ body part -------------->
    <div class="main">
        <div id="breadcrumb" class="fk-lbreadbcrumb newvd">
            <span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('property_details_home');?></a></span> ><span><?php echo $this->lang->line('property_details_list_of_properties');?></span>
        </div>
        <div class="property_details">
            <div class="left_panel">
                <ul class="listing-tabs">
                    <li class="active">
						<a href="<?php echo base_url();?>property/property_details">
							<?php echo $this->lang->line('property_details_listing_tab_list_of_properties');?>
						</a>
					</li>
                    <li>
						<a href="<?php echo base_url();?>property/add_property_form">
							<?php echo $this->lang->line('property_details_listing_tab_add_properties');?>
                        </a>
                    </li>
                </ul>
                <div class="advertiser_details">
                    <div class="prop_panel" id="property_listing">
                        <?php
						if($this->session->flashdata('success')!=''){
						?>
                        <div class="success" id="success-message">
							<?php echo $this->session->flashdata('success'); ?>
						</div>
                        <?php
						}
						$uid=$this->session->userdata('user_id');
						$user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$uid."' ");
						$featuredPropertyId = array();
						if(count($getFeaturedProperty)> 0 ){
							foreach($getFeaturedProperty as $property_lists_featured) {
								$featuredPropertyId[] = $property_lists_featured['property_id'];
							}
						}
						?>
                        <h2>
							<?php echo $this->lang->line('property_details_heading_list_of_properties');?>
							<span style="float:right;color:#888888;font-weight:normal;font-size:12px;">
								<?php
								$publishable_properties = count($property_list);
								$posting_property_limit=get_perticular_field_value('zc_user','posting_property_limit'," and user_id='".$uid."' ");
								$remaining_publishable_properties = (int)$posting_property_limit - ((int)$totalPublishedPropertyList + (int)$totalHightlightedPropertyList);
								echo $this->lang->line('property_details_heading_publishable_properties').'&nbsp;';
								echo $remaining_publishable_properties;
								echo '&nbsp;'.$this->lang->line('property_details_heading_on').'&nbsp;';
								echo $posting_property_limit;
								?>
							</span>
						</h2>
                        <ul class="property-info">
                            <li id="pub_prop" <?php echo($this->uri->segment(3) == "property_list"?'class="active"':'');?>>
								<a href="<?php echo base_url();?>property/property_details/property_list">
									<?php echo $this->lang->line('property_details_property_info_published');?> 
									<span>
									(<?php echo $totalPublishedPropertyList; ?>)
									</span>
								</a>
							</li>
                            <li id="draft_prop" <?php echo($this->uri->segment(3) == "draft_property_list"?'class="active"':''); ?>>
								<a href="<?php echo base_url();?>property/property_details/draft_property_list">
									<?php echo $this->lang->line('property_details_draft');?> 
									<span>(<?php echo $totalDraftedPropertyList; ?>)</span>
								</a>
							</li>
                            <li id="high_prop">
								<a href="<?php echo base_url();?>property/property_details/highlight_property_list">
									<?php echo $this->lang->line('property_details_Highlights');?> 
									<span>(<?php echo $totalHightlightedPropertyList; ?>)</span>
								</a>
							</li>
                        </ul>
                        <!-- Published Property. -->
                        <div class="publish-info-box" id="property_Listing">
                            <ul>
                                <li style="margin-bottom:20px;padding:5px 10px;background:#fff;border:1px solid rgba(0, 0, 0, 0.2);height:20px;line-height:20px;">
                                    <input type="checkbox" name="checkAll" id="checkAll" onClick="checkAllProperty(this,'property');" style="vertical-align: middle;">
                                    <label style="margin-left:5px;">
										<?php echo $this->lang->line('property_details_select_all');?>
									</label>
                                    <img src="<?php echo base_url();?>assets/images/delete_icon.png" onClick="return delete_bulk_msg('property');" style="cursor:pointer; float:right;margin-top:1px;height:17px;" title="<?php echo $this->lang->line('property_details_delete');?>" />
                                </li>
                                <div class="clear"></div>
						<?php
						if(!empty($property_list)){
							//echo "<pre>"; print_r($property_list);die();
							foreach($property_list as $property_lists){
								$suspended_user_type = get_perticular_field_value('zc_user','user_type'," and user_id='".$property_lists['suspention_by_user']."'");
								if(!in_array($property_lists['property_id'],$featuredPropertyId)){
									$property_id=$property_lists['property_id'];
								?>
                                <li>
									<div class="last_property"
										 style="padding:10px 0 0 0;<?php echo($suspended_user_type != 4 && $property_lists['property_approval'] != 0 ? '' : 'background:#FFFFD7'); ?>">
										<div style="display:table">
											<div style="display:table-cell;width:150px;vertical-align:top;">
												<div style="display:table">
													<div style="display:table-cell;vertical-align:middle;">
													<?php
													if ($suspended_user_type != 4 && $property_lists['property_approval'] == 1) {
														?>
														<input type="checkbox" name="propertyId[]"  style="float:left; margin-left: 5px; margin-right: 2px;" class="property" value="<?php echo $property_lists['property_id'];?>" onClick="checkArr('property');">
														<?php
													}else{
														?>
														&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														<?php
													}
													?>
													</div>
													<div style="display:table-cell;vertical-align:middle;">
														<a style="display:table-cell;vertical-align:middle;" <?php echo(($suspended_user_type != 4 && $property_lists['property_approval'] == 1) ? 'href=' . base_url() . 'property/edit_property/' . $property_id : 'href=' . base_url() . 'property/blocked_property/' . $property_id); ?>>

														<?php
														$main_img=get_perticular_field_value('zc_property_img','file_name'," and property_id='".$property_id."' and img_type='main_image'");
														if($main_img!=''){
															?>
															<img src="<?php echo base_url();?>assets/uploads/Property/Property<?php echo $property_id;?>/thumb_92_82/<?php echo $main_img;?>" alt="" width="102px" style="margin:0 0 0 10px">
															<?php
														}else{
															?>
															<img src="<?php echo base_url();?>assets/images/<?php echo $this->lang->line('property_details_no_proimg_filename');?>" alt="" width="102px" style="margin:0 0 0 10px">
															<?php
														}
														?>
														</a>
													</div>
												</div>
											</div>

											<div style="display:table-cell;vertical-align:top;width:470px;">
												<h4 style="font-weight:bold;color:#000000;font-family:'CenturyGothicRegular';font-size:12px;">
													<?php
													$ContractType=get_perticular_field_value('zc_contract_types',($_COOKIE['lang']=='it'?'name_it':'name')," and contract_id='".$property_lists['contract_id']."'");
													echo $this->lang->line('ref_code').': ';
													echo CreateNewRefToken($property_lists['property_id'],$ContractType);
													?>
												</h4>
												<h2 style="display:table;width:100%;">
													<a style="display:table-cell;vertical-align:middle;" <?php echo(($suspended_user_type != 4 && $property_lists['property_approval'] == 1) ? 'href=' . base_url() . 'property/edit_property/' . $property_id : 'href=' . base_url() . 'property/blocked_property/' . $property_id); ?>>
														<?php
														$TypologyName=get_perticular_field_value('zc_typologies',($_COOKIE['lang']=='it'?'name_it':'name')," and status='active' and typology_id='".$property_lists['typology']."'");
														$CityName=get_perticular_field_value('zc_city',($_COOKIE['lang']=='it'?'city_name_it':'city_name')," and (`city_id` = '".$property_lists['city']."')");
														$ProvienceName=get_perticular_field_value('zc_provience','provience_name'," and `provience_id` = '".$property_lists['provience']."'");
														if(strpos($ProvienceName, "'")>0){
															$ProvienceName = str_replace("\'","\\\''",$ProvienceName);
														}
														$ProvinceCode=get_perticular_field_value('zc_region_master','province_code'," and `province_name` = '".$ProvienceName."' group by Province_Code");
														
														if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
															$PropTitle = stripslashes($ContractType)." For ".stripslashes($TypologyName)." in ".stripslashes($CityName).", ".$ProvinceCode;
														}else{
															$PropTitle = stripslashes($TypologyName)." in ".stripslashes($ContractType)." a ".stripslashes($CityName).", ".$ProvinceCode;
														}
														echo $PropTitle;
														?>
													</a>
													<?php
													if ($property_lists['property_approval'] == 1) {
														?>
													<div style="display:table-cell;vertical-align:middle;width:110px;">
														<?php

														if ($suspended_user_type != 4 || $property_lists['suspention_status'] == 0) {
															if($user_type==2) {
															?>     
															<div class="not_approval">
																<a style="color:#FFFFFF;font-weight:normal;font-size:11px;" href="<?php echo base_url();?>property/delete_property/<?php echo $property_lists['property_id'];?>" onClick="return confirm('<?php echo $this->lang->line('property_details_are_you_sure');?>')">
																	<?php echo $this->lang->line('property_details_delete');?>
																</a>
															</div>
															<div class="approval">
																<?php 
																if($property_lists['suspention_status']==0) {
																?>
																<a style="color:#FFFFFF;font-weight:normal;font-size:11px;" href="<?php echo base_url();?>property/suspend_property/<?php echo $property_lists['property_id'];?>">
																	<?php echo $this->lang->line('property_details_suspend');?>
																</a>
																<?php
																} else {
																 ?>
																<a style="color:#FFFFFF;font-weight:normal;font-size:11px;" href="<?php echo base_url();?>property/resume_property/<?php echo $property_lists['property_id'];?>">
																	<?php echo $this->lang->line('property_details_resume');?>
																</a>
																<?php
																}

																?>
															</div>
															<?php
															}
															if($user_type==3) {
															?>  
															<div class="not_approval">
																<a style="color:#FFFFFF;font-weight:normal;font-size:11px;" href="<?php echo base_url();?>property/delete_property/<?php echo $property_lists['property_id'];?>" onClick="return confirm('<?php echo $this->lang->line('property_details_are_you_sure');?>')">
																	<?php echo $this->lang->line('property_details_delete');?>
																</a>
															</div>
															<div class="approval">
																<?php 
																if($property_lists['suspention_status']==0) {
																?>
																<a style="color:#FFFFFF;font-weight:normal;font-size:11px;" href="<?php echo base_url();?>property/suspend_property/<?php echo $property_lists['property_id'];?>">
																	<?php echo $this->lang->line('property_details_suspend');?>
																</a>
																<?php
																} else {
																?>
																<a style="color:#FFFFFF;font-weight:normal;font-size:11px;" href="<?php echo base_url();?>property/resume_property/<?php echo $property_lists['property_id'];?>">
																	<?php echo $this->lang->line('property_details_resume');?>
																</a>
																<?php
																}
																?>
															</div>
															<?php
															}
														}	
														?>
													</div>
													<?php
													} ?>
												</h2>
												<h3>
												<?php
													echo($property_lists['area']!=''?$property_lists['area'].' - ':'');
													echo($property_lists['street_address']!=''?nl2br($property_lists['street_address']).', ':'');
													echo($property_lists['street_no']!=''?$property_lists['street_no'].' - ':'');
													echo($property_lists['zip']!=''?$property_lists['zip']:'');
												?>
												</h3>
												<p style="width:460px;word-break:break-all;margin:5px 0 0;">
												<?php 
												if($suspended_user_type != 4 || $property_lists['suspention_status'] == 0){
													$desc = nl2br($property_lists['description']);
													if(strlen($desc) > 100){
														echo substr($desc, 0, 50) . " ...";
													} else {
														echo $desc;	
													}
													?>										
													<br>                                            
													<font style="color:#ED6B1F">
													<?php
													if($property_lists['price']!='0.00'){
														echo '&euro;'.show_price($property_lists['price']);
														if($property_lists['contract_id']==1){
															?>
															<span style="color:#000; font-weight:bold;">
																<?php echo $this->lang->line('property_search_per_month');?>
															</span>
															<?php
														}
														if($property_lists['update_price']!='0.00'){
															$per_prop=percentage($property_lists['update_price'],$property_lists['price']);
															if($per_prop!=0){
																?>
																<span style="color:#000; font-weight:bold;">|</span>
																<?php
																if ($per_prop < 0){
																?>																
																<span style="color:#090;font-weight:bold;padding:0 0 0 17px;position:relative;">
																	<span style="position:absolute;top:2px;left:0">
																		<img src="<?php echo base_url();?>assets/images/green.gif" width="8px" height="8px" style="border:none;">
																	</span>
																	<?php echo percentage($property_lists['update_price'],$property_lists['price']);?> %
																</span>
																<?php
																}else{
																	?>																	
																	<span style="color:#F00;font-weight:bold;padding:0 0 0 17px;position:relative;">
																		<span style="position:absolute;top:2px;left:0">
																			<img src="<?php echo base_url();?>assets/images/red.gif" width="8px" height="8px" style="border:none;">
																		</span>
																		<?php echo '+'.percentage($property_lists['update_price'],$property_lists['price']);?> %
																	</span>
																	<?php
																}
															}
														}
													}else{
														echo $this->lang->line('property_search_private_nagotiation');
													}

													?>
													</font>

												<?php
												}else{
													echo "<span style='color:#FF0000;'>";
													echo "<label style='font-weight:bold; ' >".$this->lang->line('suspended_property_msg_by_admin_first')."</label>";
													echo $this->lang->line('suspended_property_msg_by_admin_secound');
													echo "</span>";
												}	
												?> 
												</p>
												<?php
												if ($property_lists['property_approval'] == '0') {
													?>
													<p style="color:red"><?php echo $this->lang->line('property_inactive_by_admin'); ?>
														,<?php echo $this->lang->line('blocked_werecommend_that_youdonot_continue_tothis_website_property');
														?>
														<br><?php echo $this->lang->line('blocked_werecommend_that_youdonot_continue_tothis_website_property1'); ?>
													</p>
												<?php
												}
												?>
											</div>
										</div>

										<div style="display:table;width:100%;background:rgba(0, 0, 0, 0.08);min-height:25px;margin-top:10px;">
											<div style="display:table-cell;vertical-align:middle;padding-left:5px;">
												<?php
												switch(date('m',strtotime($property_lists['posting_time']))){
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
												echo '<strong style="font-weight:bold;">'.$this->lang->line('property_details_info_published').':</strong> '.date('d',strtotime($property_lists['posting_time'])).' '.$monthName.' '.date('Y',strtotime($property_lists['posting_time']));
												?>
												<?php
												if($property_lists['update_time']!='0000-00-00'){
													?><br>
													<?php
													switch(date('m',strtotime($property_lists['update_time']))){
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
													echo '<strong style="font-weight:bold;">'.$this->lang->line('property_details_info_update').':</strong> '.date('d',strtotime($property_lists['update_time'])).' '.$monthName.' '.date('Y',strtotime($property_lists['update_time']));
												}
												?>
											</div>
											<div style="display:table-cell;vertical-align:middle;text-align:right;padding-right:5px;">
												<?php
												$category_id=get_perticular_field_value('zc_property_details','contract_id'," and property_id='".$property_id."'");
												echo prop_category($property_lists['property_id']);
												?>
											</div>
										</div>
									</div>
                                </li>
                                <?php
								}
								?>
                                <input type="hidden" id="property_del_str" value="">
                                <?php 		
							}
						}else{
							?> 
                                <li>
                                    <div class="last_property">
                                        <?php echo $this->lang->line('property_details_no_property_is_added_by_you');?>
                                    </div>
                                </li>
                                <?php
						}
						?> 
                            </ul>
                            <div class="row pagination-inbox" >
                                <div class="col-md-12 col-md-offset-5">
                                    <div class="inbox_delete_pagination_rht">
                                        <?php echo $pagination_property_list; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Drafted Properties. -->
                        <div class="draft-info-box" style="display:none;" id="draft_Listing">
							<ul>
                                <li  style="margin-bottom:20px;padding:5px 3px;background:#fff;border:1px solid rgba(0, 0, 0, 0.2);height:20px;line-height:20px;">
                                    <input type="checkbox" name="checkAll" id="checkAll" onClick="checkAllProperty(this,'draft');" style="vertical-align: middle;">
                                    <label style="margin-left:5px;"><?php echo $this->lang->line('property_details_select_all');?></label>
                                    <img src="<?php echo base_url();?>assets/images/delete_icon.png" onClick="return delete_bulk_msg('draft');" style="cursor:pointer; float:right;  margin-top: -2px;" title="<?php echo $this->lang->line('property_details_delete');?>" />
                                </li> 
                                <div class="clear"></div>
                                <?php 
							if(!empty($draft_property_list)){
								foreach($draft_property_list as $draft_property_lists){
									$property_id=$draft_property_lists['property_id'];
								?>
                                <li>
                                    <div class="last_property" style="padding:10px 0 0 0;">
										<div style="display:table">
											<div style="display:table-cell;width:150px;vertical-align:top;">
												<div style="display:table">
													<div style="display:table-cell;vertical-align:middle;">
														<input type="checkbox" name="propertyId[]" class="draft" style="float:left; margin-left: 5px; margin-right: 2px;" value="<?php echo $draft_property_lists['property_id'];?>" onClick="checkArr('draft');">
													</div>
													<div style="display:table-cell;vertical-align:middle;">
														<a href="<?php echo base_url();?>property/edit_property/<?php echo $property_id;?>">
															<?php
															$main_img=get_perticular_field_value('zc_property_img','file_name'," and property_id='".$property_id."' and img_type='main_image'");
															if($main_img!=''){
															?>
															<img src="<?php echo base_url();?>assets/uploads/Property/Property<?php echo $property_id;?>/thumb_92_82/<?php echo $main_img;?>" alt="" width="102px">
															<?php
															}else{
															?>
															<img src="<?php echo base_url();?>assets/images/<?php echo $this->lang->line('property_details_no_proimg_filename');?>" alt="" width="102px">
															<?php
															}
															?>
														</a>
													</div>
												</div>												
											</div>
											<div style="display:table-cell;vertical-align:top;width:470px;">
												<h4 style="font-weight:bold;color:#000000;font-family:'CenturyGothicRegular';font-size:12px;">
													<?php
													$draftContractType=get_perticular_field_value('zc_contract_types',($_COOKIE['lang']=='it'?'name_it':'name')," and contract_id='".$draft_property_lists['contract_id']."'");
													echo $this->lang->line('ref_code').': ';
													echo CreateNewRefToken($draft_property_lists['property_id'],$draftContractType);
													?>
												</h4>
												<h2 style="display:table;width:100%;">
													<a style="display:table-cell;vertical-align:middle;" href="<?php echo  base_url();?>property/edit_property/<?php echo $property_id;?>">
														<?php
														$draftTypologyName=get_perticular_field_value('zc_typologies',($_COOKIE['lang']=='it'?'name_it':'name')," and status='active' and typology_id='".$draft_property_lists['typology']."'");
														$draftCityName=get_perticular_field_value('zc_city',($_COOKIE['lang']=='it'?'city_name_it':'city_name')," and (`city_id` = '".$draft_property_lists['city']."')");
														$draftProvienceName=get_perticular_field_value('zc_provience','provience_name'," and `provience_id` = '".$draft_property_lists['provience']."'");
														if(strpos($draftProvienceName, "'")>0){
															$draftProvienceName = str_replace("\'","\\\''",$draftProvienceName);
														}
														$draftProvinceCode=get_perticular_field_value('zc_region_master','province_code'," and `province_name` = '".$draftProvienceName."' group by Province_Code");
														
														if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
															$draftPropTitle = stripslashes($draftContractType)." For ".stripslashes($draftTypologyName)." in ".stripslashes($draftCityName).", ".$draftProvinceCode;
														}else{
															$draftPropTitle = stripslashes($draftTypologyName)." in ".stripslashes($draftContractType)." a ".stripslashes($draftCityName).", ".$draftProvinceCode;
														}
														echo $draftPropTitle;
														?>
													</a>
													<div style="display:table-cell;vertical-align:middle;width:110px;">
														<?php
														if($user_type==2){
														?>     
														<div class="not_approval">
															<a style="color:#FFFFFF;font-weight:normal;font-size:11px;" href="<?php echo base_url();?>property/delete_property/<?php echo $draft_property_lists['property_id'];?>" onClick="return confirm('<?php echo $this->lang->line('property_details_are_you_sure');?>')">
																<?php echo $this->lang->line('property_details_delete');?>
															</a>
														</div>
														<?php
														}
														if($user_type==3){
														?>  
														<div class="not_approval">
															<a style="color:#FFFFFF;font-weight:normal;font-size:11px;" href="<?php echo base_url();?>property/delete_property/<?php echo $draft_property_lists['property_id'];?>" onClick="return confirm('<?php echo $this->lang->line('property_details_are_you_sure');?>')">
																<?php echo $this->lang->line('property_details_delete');?>
															</a>
														</div>
														<?php
														}
														?>
													</div>
												</h2>
												<h3>
												<?php 
													echo($draft_property_lists['area']!=''?$draft_property_lists['area'].' - ':'');
													echo($draft_property_lists['street_address']!=''?nl2br($draft_property_lists['street_address']).', ':'');
													echo($draft_property_lists['street_no']!=''?$draft_property_lists['street_no'].' - ':'');
													echo($draft_property_lists['zip']!=''?$draft_property_lists['zip']:'');
												?>
												</h3>
												<p style="width:460px;word-break:break-all;margin:5px 0 0;">
													<?php 
													$desc = nl2br($draft_property_lists['description']);	
													if(strlen($desc) > 100){
														echo substr($desc, 0, 50) . " ...";
													}else{
														echo $desc;	
													}
													?>
													<br>                                            
													<font style="color:#ED6B1F">
													<?php
													if($draft_property_lists['price']!='0.00'){
														echo '&euro;'.show_price($draft_property_lists['price']);
														if($draft_property_lists['contract_id']==1){
															?>
															<span style="color:#000; font-weight:bold;">
																<?php echo $this->lang->line('property_search_per_month');?>
															</span>
															<?php
														}
														if($draft_property_lists['update_price']!='0.00'){
															$per_prop=percentage($draft_property_lists['update_price'],$draft_property_lists['price']);
															if($per_prop!=0){
																?>
																<span style="color:#000; font-weight:bold;">|</span>
																<?php
																if ($per_prop < 0){
																?>																
																<span style="color:#090;font-weight:bold;padding:0 0 0 17px;position:relative;">
																	<span style="position:absolute;top:2px;left:0">
																		<img src="<?php echo base_url();?>assets/images/green.gif" width="8px" height="8px" style="border:none;">
																	</span>
																	<?php echo percentage($draft_property_lists['update_price'],$draft_property_lists['price']);?> %
																</span>
																<?php
																}else{
																	?>																	
																	<span style="color:#F00;font-weight:bold;padding:0 0 0 17px;position:relative;">
																		<span style="position:absolute;top:2px;left:0">
																			<img src="<?php echo base_url();?>assets/images/red.gif" width="8px" height="8px" style="border:none;">
																		</span>
																		<?php echo '+'.percentage($draft_property_lists['update_price'],$draft_property_lists['price']);?> %
																	</span>
																	<?php
																}
															}
														}
													}else{
														echo $this->lang->line('property_search_private_nagotiation');
													}
													?>
													</font>
												</p>
											</div>
										</div>
										<div style="display:table;width:100%;background:rgba(0, 0, 0, 0.08);height:25px;margin-top:10px;">
											<div style="display:table-cell;vertical-align:middle;padding-left:5px;">
												<?php
												switch(date('m',strtotime($draft_property_lists['posting_time']))){
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
												echo '<strong style="font-weight:bold;">'.$this->lang->line('property_details_in_draft').':'.'</strong> '.date('d',strtotime($draft_property_lists['posting_time'])).' '.$monthName.' '.date('Y',strtotime($draft_property_lists['posting_time']));
												?>
											</div>
											<div style="display:table-cell;vertical-align:middle;text-align:right;padding-right:5px;">
												<?php
												$category_id=get_perticular_field_value('zc_property_details','contract_id'," and property_id='".$property_id."'");
												echo prop_category($draft_property_lists['property_id']);
												?>
											</div>
										</div>
                                    </div>
                                </li>
                                <?php
								}
								?>
                                <input type="hidden" id="draft_del_str" value="">
                                <?php 		
							}else{
							?> 
                                <li>
                                    <div class="last_property">
                                        <?php echo $this->lang->line('property_details_no_property_is_saved_as_draft_by_you');?> 
                                    </div>
                                </li>
                                <?php
							}
							?> 
                            </ul>
                            <div class="row pagination-inbox" >
                                <div class="col-md-12 col-md-offset-5">
                                    <div class="inbox_delete_pagination_rht">
                                        <?php echo $pagination_property_draft; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
						<!-- Highlighted Properties. -->        
                        <div class="property-info-box" style="display:none;">
						<?php 
						if(count($getFeaturedProperty)> 0 ){
							?>
							<div style="color:#ed6b1f;padding:5px 0px 5px 15px;background:#f2e8e8;font-weight:bold;font-size:12px;">
								<?php echo $this->lang->line('property_details_you_cannot_delete_or_edit');?>
							</div>
							<ul style="background-color:#FFFFFF;">
							<?php							
							foreach($getFeaturedProperty as $property_lists_featured) {
								$property_id=$property_lists_featured['property_id'];
								$suspended_user_type = get_perticular_field_value('zc_user','user_type'," and user_id='".$property_lists_featured['suspention_by_user']."'");
								$main_image=get_perticular_field_value('zc_property_img','file_name'," and property_id='".$property_lists_featured['property_id']."' and img_type='main_image'");
								$property_name=property_name($property_lists_featured['property_id']);                                    	
								$featuredPropertyId[] = $property_lists_featured['property_id'];
								$contract="";
								$prop_det_url='';
								if($property_lists_featured['contract_id']==1){
									$contract="Rent";
								}
								if($property_lists_featured['contract_id']==2){
									$contract="Sell";
								}
								$prop_det_url.=$contract;
								$prop_det_url.='-'.trim($property_lists_featured['city']);
								$prop_det_url.='-'.trim($property_lists_featured['provience']);
								$prop_det_url.='-'.trim($property_lists_featured['property_id']);
								
								$parentCategoryName = get_category_field_value( $property_lists_featured['category_id'] );
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
								?>
                                <li>
                                    <div class="last_property" style="padding:10px 0 0 0;<?php echo($suspended_user_type != 4 || $property_lists_featured['suspention_status'] == 0?'':'background:#FFFFD7'); ?>">
										<div style="display:table">
											<div style="display:table-cell;width:150px;vertical-align:top;">
												<div style="display:table">
													<div style="display:table-cell;vertical-align:middle;">
														
													</div>
													<div style="display:table-cell;vertical-align:middle;">
														<a href="javascript: void(0);" <?php echo(($suspended_user_type != 4 || $property_lists_featured['suspention_status'] == 0)?'':'id="suspend_property_by_admin"'); ?>>
														<?php
														$main_img=get_perticular_field_value('zc_property_img','file_name'," and property_id='".$property_id."' and img_type='main_image'");
														if($main_img!=''){
														?>
															<img src="<?php echo base_url();?>assets/uploads/Property/Property<?php echo $property_id;?>/thumb_92_82/<?php echo $main_img;?>" alt="" width="102px">
															<?php
														}else{
															?>
															<img src="<?php echo base_url();?>assets/images/<?php echo $this->lang->line('property_details_no_proimg_filename');?>" alt="" width="102px">
															<?php
														}
														?>
														</a>
													</div>
												</div>
											</div>											
											<div style="display:table-cell;vertical-align:top;width:470px;">
												<h4 style="font-weight:bold;color:#000000;font-family:'CenturyGothicRegular';font-size:12px;">
													<?php
													$feaContractType=get_perticular_field_value('zc_contract_types',($_COOKIE['lang']=='it'?'name_it':'name')," and contract_id='".$property_lists_featured['contract_id']."'");
													echo $this->lang->line('ref_code').': ';
													echo CreateNewRefToken($property_lists_featured['property_id'],$feaContractType);
													?>
												</h4>
												<h2 style="display:table;width:100%;">
													<a href="javascript: void(0);" <?php echo(($suspended_user_type != 4 || $property_lists_featured['suspention_status'] == 0)?'':'id="suspend_property_by_admin"'); ?>>
														<?php
														
														$feaTypologyName=get_perticular_field_value('zc_typologies',($_COOKIE['lang']=='it'?'name_it':'name')," and status='active' and typology_id='".$property_lists_featured['typology']."'");
														$feaCityName=get_perticular_field_value('zc_city',($_COOKIE['lang']=='it'?'city_name_it':'city_name')," and (`city_id` = '".$property_lists_featured['city']."')");
														$feaProvienceName=get_perticular_field_value('zc_provience','provience_name'," and `provience_id` = '".$property_lists_featured['provience']."'");
														if(strpos($feaProvienceName, "'")>0){
															$feaProvienceName = str_replace("\'","\\\''",$feaProvienceName);
														}
														$feaProvinceCode=get_perticular_field_value('zc_region_master','province_code'," and `province_name` = '".$feaProvienceName."' group by Province_Code");
														
														if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
															$feaPropTitle = stripslashes($feaContractType)." For ".stripslashes($feaTypologyName)." in ".stripslashes($feaCityName).", ".$feaProvinceCode;
														}else{
															$feaPropTitle = stripslashes($feaTypologyName)." in ".stripslashes($feaContractType)." a ".stripslashes($feaCityName).", ".$feaProvinceCode;
														}
														echo $feaPropTitle;
														?>
													</a>
													<div style="display:table-cell;vertical-align:middle;">
														<?php
														//echo "==".$property_lists_featured['feature_status'];
														if( $suspended_user_type != 4 || $property_lists_featured['suspention_status'] == 0 ) {
															if($user_type==2) {
															?>
															<div class="approval">
																<?php 
																if($property_lists_featured['feature_status']==1) {
																?>
																<a style="color:#FFFFFF;font-weight:normal;font-size:11px;" href="<?php echo base_url();?>property/suspend_featured_property/<?php echo $property_lists_featured['property_id'];?>">
																	<?php echo $this->lang->line('property_details_suspend');?>
																</a>
																<?php
																} else {
																 ?>
																<a style="color:#FFFFFF;font-weight:normal;font-size:11px;" href="<?php echo base_url();?>property/resume_featured_property/<?php echo $property_lists_featured['property_id'];?>">
																	<?php echo $this->lang->line('property_details_resume');?>
																</a>
																<?php
																}
																?>
															</div>
															<?php
															}
															if($user_type==3) {
															?>
															<div class="approval">
																<?php 
																if($property_lists_featured['feature_status']==1) {
																?>
																<a style="color:#FFFFFF;font-weight:normal;font-size:11px;" href="<?php echo base_url();?>property/suspend_featured_property/<?php echo $property_lists_featured['property_id'];?>">
																	<?php echo $this->lang->line('property_details_suspend');?>
																</a>
																<?php
																} else {
																?>
																<a style="color:#FFFFFF;font-weight:normal;font-size:11px;" href="<?php echo base_url();?>property/resume_featured_property/<?php echo $property_lists_featured['property_id'];?>">
																	<?php echo $this->lang->line('property_details_resume');?>
																</a>
																<?php
																}
																?>
															</div>
															<?php
															}
														}
														?>
													</div>
												</h2>
												<h3>
												<?php
													echo($property_lists_featured['area']!=''?$property_lists_featured['area'].' - ':'');
													echo($property_lists_featured['street_address']!=''?nl2br($property_lists_featured['street_address']).', ':'');
													echo($property_lists_featured['street_no']!=''?$property_lists_featured['street_no'].' - ':'');
													echo($property_lists_featured['zip']!=''?$property_lists_featured['zip']:'');
												?>
												</h3>
												<p style="width:460px;word-break:break-all;margin:5px 0 0;">
												<?php 
												if( $suspended_user_type != 4 || $property_lists_featured['suspention_status'] == 0) {
													$desc =  $property_lists_featured['description'];
													if(strlen($desc) > 100){
														echo substr($desc, 0, 50) . " ...";
													} else {
														echo $desc;	
													}
													if($property_lists_featured['suspention_status']!=0){
														echo "<label style='font-size: 12px; font-weight: bold'>".$this->lang->line('property_details_Unavailable')."</label>";
													}
													?>									
													<br>                                            
													<font style="color:#ED6B1F">
													<?php
													if($property_lists_featured['price']!='0.00'){
														echo '&euro;'.show_price($property_lists_featured['price']);
														if($property_lists_featured['contract_id']==1){
															?>
															<span style="color:#000; font-weight:bold;">
																<?php echo $this->lang->line('property_search_per_month');?>
															</span>
															<?php
														}
														if($property_lists_featured['update_price']!='0.00'){
															$per_prop=percentage($property_lists_featured['update_price'],$property_lists_featured['price']);
															if($per_prop!=0){
																?>
																<span style="color:#000; font-weight:bold;">|</span>
																<?php
																if ($per_prop < 0){
																?>																
																<span style="color:#090;font-weight:bold;padding:0 0 0 17px;position:relative;">
																	<span style="position:absolute;top:2px;left:0">
																		<img src="<?php echo base_url();?>assets/images/green.gif" width="8px" height="8px" style="border:none;">
																	</span>
																	<?php echo percentage($property_lists_featured['update_price'],$property_lists_featured['price']);?> %
																</span>
																<?php
																}else{
																	?>																	
																	<span style="color:#F00;font-weight:bold;padding:0 0 0 17px;position:relative;">
																		<span style="position:absolute;top:2px;left:0">
																			<img src="<?php echo base_url();?>assets/images/red.gif" width="8px" height="8px" style="border:none;">
																		</span>
																		<?php echo '+'.percentage($property_lists_featured['update_price'],$property_lists_featured['price']);?> %
																	</span>
																	<?php
																}
															}
														}
													}else{
														echo $this->lang->line('property_search_private_nagotiation');
													}
													?>
													</font>
													<?php		
												}else {
													echo "<span style='color:#FF0000;' >";
													echo "<label style='font-weight:bold; ' >".$this->lang->line('suspended_property_msg_by_admin_first')."</label>";
													echo $this->lang->line('suspended_property_msg_by_admin_secound');
													echo "</span>";
												}
												?> 
												</p>
											</div>
										</div>
										<div style="display:table;width:100%;background:rgba(0, 0, 0, 0.08);margin-top:10px;">
											<?php
											$todayDate = time();
											$featuredDate = strtotime($property_lists_featured['start_date']);
											$diff = $todayDate - $featuredDate;

											$hightlightedDay = floor($diff/(24*60*60))+1;
											?> 
											<div style="display:table-cell;vertical-align:middle;padding-left:5px;">												
												<?php
												switch(date('m',strtotime($property_lists_featured['posting_time']))){
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
												echo '<strong style="font-weight:bold;">'.$this->lang->line('property_details_info_published').':</strong> '.date('d',strtotime($property_lists_featured['posting_time'])).' '.$monthName.' '.date('Y',strtotime($property_lists_featured['posting_time']));
												if($property_lists_featured['start_date']!='0000-00-00'){
												?>
												<br><strong style="font-weight:bold;"><?php echo $this->lang->line('property_details_Highlights');?>:</strong>
												<?php
												echo $this->lang->line('property_details_highlights_day')." ".$hightlightedDay." ".$this->lang->line('property_details_highlights_of')." ".$property_lists_featured['number_of_days'];


												}
												?>
											</div>
											<div style="display:table-cell;vertical-align:middle;text-align:right;padding-right:5px;">
												<?php
												$category_id=get_perticular_field_value('zc_property_details','contract_id'," and property_id='".$property_id."'");
												echo prop_category($property_lists_featured['property_id']);
												?>
											</div>
										</div>
									</div>
                                </li>
                                <?php
							}
							?>
								<input type="hidden" id="property_del_str" value="">
                            </ul>
                            <div class="row pagination-inbox" >
                                <div class="col-md-12 col-md-offset-5">
                                    <div class="inbox_delete_pagination_rht">
                                        <?php echo $pagination_property_highlight; ?>
                                    </div>
                                </div>
                            </div>
                            <?php 		
						} else {
							?>
                            <div class="property-add-img">
                                <img src="<?php echo base_url();?>assets/images/add_newproperty_icon.jpg" alt="" >
                            </div>
                            <div class="property-add">
                                <h1><?php echo $this->lang->line('property_details_more_prominence_to_your_property');?></h1>
                                <h2><?php echo $this->lang->line('property_details_learn_how_highlight');?></h2>
                                <a href="<?php echo base_url();?>site/Highlight_your_advert" class="read-property"><?php echo $this->lang->line('property_details_read_more');?></a>
                            </div>
                        <?php
						}
						?>
						</div>
						<?php
						if($this->uri->segment(3) == "property_list"){
						?>
                        <script type="text/javascript">
						$(document).ready( function() {
							publish_prop();
						});
                        </script>
                        <?php
						}elseif($this->uri->segment(3) == "draft_property_list"){
						?>
                        <script type="text/javascript">
						$(document).ready( function() {
							draft_prop();
						});
                        </script>	
                        <?php
						}elseif($this->uri->segment(3) == "highlight_property_list"){
						?>
                        <script type="text/javascript">
						$(document).ready( function() {
							highlight_prop();
						});
                        </script>		
                        <?php
						}else{
						?>
                        <script type="text/javascript">
						$(document).ready( function() {
							publish_prop();
						});
                        </script>		
                        <?php
						}						
						if($this->uri->segment(3) == 'highlight'){
						?>
                        <script type="text/javascript">
						$(document).ready(function(){
							highlight_prop();
						});
                        </script>
                        <?php
						}
						?>
					</div>
                    <!-- -------------------  Susspend By Admin Area Start   -------------------------->
                    <div id="susspend_by_admin_area" style="display:none;">
                        <div class="main">
                            <div class="registercomn_box">
                                <div class="arrow_box error_message" id="msg_box_general" style="color:#FF7602;">
									<?php echo $this->lang->line('property_details_suspend_sorry_this_content_is_suspended');?>
                                </div>
                                <div class="congratulations"><img src="<?php echo base_url();?>assets/images/register_thanks_icon.jpg" alt="" style="margin-top:75px;margin-left:34px;"></div>
                                <div class="mainsucc_box" style="width:63%">
                                    <div class="suceesfulbox"  style="width:95%">
                                        <div>
                                            <span style="width:100%">
                                                <p style="font-size: 13px !important;">
                                                    <?php echo $this->lang->line('property_details_suspend_we_are_checking');?>
													<br/>
													<?php echo $this->lang->line('property_details_suspend_after_checked');?> 
                                                </p>
                                            </span>
                                            <div class="clear"></div>
                                        </div>
                                        <p><br></p>
                                    </div>
                                    <div style=" margin-left:27%; margin-bottom:20px; float:left;">
                                        <a class="mainbt" href="<?php echo base_url();?>property/property_details">
											<?php echo $this->lang->line('property_details_suspend_back_to_the_list_of_property_button');?>
										</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- -------------------  Susspend By Admin Area Start   -------------------------->
                </div>
            </div>
            <div class="right_panel">
            <?php $google_adsence = get_perticular_field_value('zc_settings','meta_value'," and meta_name='google_adsence'");
				if( isset($google_adsence) && ( count($google_adsence) > 0 ) ) { ?>
                	<div class="google_ad" id="google_ad"><?php echo "<pre>"; print_r($google_adsence); ?></div>
				<?php } ?> 	
       		</div>
    </div>
    </div>
<script>
        function highlight_prop()
        {
         $('.property-info-box').show();
         $('.draft-info-box').hide();
         $('.publish-info-box').hide();
         $('#pub_prop').removeClass('active');
         $('#draft_prop').removeClass('active');
         $('#high_prop').addClass('active');
          
        }
        function draft_prop()
        {
         $('.property-info-box').hide();
         $('.draft-info-box').show();
         $('.publish-info-box').hide();
         $('#pub_prop').removeClass('active');
         $('#draft_prop').addClass('active');
         $('#high_prop').removeClass('active');
        }
        function publish_prop()
        {
         $('.property-info-box').hide();
         $('.draft-info-box').hide();
         $('.publish-info-box').show();
         $('#pub_prop').addClass('active');
         $('#draft_prop').removeClass('active');
         $('#high_prop').removeClass('active');
        }

        function checkAllProperty(ca,type) {
        	if( type == "property" ) {
        		field = "property_Listing";
        	} if( type == "draft" ) {
        		field = "draft_Listing";
        	}		
        	var cboxes=document.getElementById(field).getElementsByTagName('input');
        	for (var i =0; i < cboxes.length; i++) {
        		if(cboxes[i].type == "checkbox"){
        			cboxes[i].checked=((ca.checked==true)? true : false);
        			checkArr(type);
        		}
        	}
        }
		
        function checkArr(type){
        	if(type=="property"){
        		arrInput="property_del_str";
        	}else{
        		arrInput="draft_del_str";
        	}
        	var list="";
        	var i=0;
        	   $("."+type).each(function(e){
        		  if($(this).is(':checked')) {
        			   if( i== 0) {
        				 	list = list + $(this).attr('value');
        					i++;
        			   } else {
        		   			list = list+ "|" + $(this).attr('value')+"|";
        			   }
        		   }
        	   });
        	document.getElementById(arrInput).value=list;
        }
		
        function delete_bulk_msg(type) {
        	var arrInputId = 0;
        	var urlCustom = "";
        		if(type=="draft"){
        			var arrInputId = $("#draft_del_str").val();
        			var urlCustom = "<?php echo base_url()?>property/del_bulk_property";
        		}else{
        			var arrInputId = $("#property_del_str").val();
        			var urlCustom = "<?php echo base_url()?>property/del_bulk_property";
        		}
        	 if(arrInputId == ""){
        		alert("<?php echo $this->lang->line('please_select_atleast_one_item_text');?>");
        	 } else if(confirm("<?php echo $this->lang->line('property_details_are_you_sure');?>") == true){
        		if( urlCustom != "" ) { 
        			 $.ajax({
        				 type: "POST",
        				 url: urlCustom, 
        				 data: {dataField: arrInputId },
        				 success: function(msg){
        				 	if(type=="draft"){
        						document.getElementById("draft_del_str").value = "";
        				 	}
        				 	else {
        						document.getElementById("property_del_str").value = "";
        				 	}
        					location.reload(true);	
        				 },
        				 error: function(){
        						alert("<?php echo $this->lang->line('inbox_there_is_something_wrong');?>");
        				 }
        			 });
        		}	
        	}
        	return false;
        }
        
        $(document).ready( function() {
        	$("#suspend_property_by_admin").click( function(){
        		$("#property_listing").hide();
        		$("#google_ad").hide();
        		$("#susspend_by_admin_area").show();
        	});
        });
        
	$(function(){setTimeout(function(){$("#success-message").fadeOut(1500);},5000);});
</script>
	<!------ footer part ------------->
    <?php $this->load->view("_include/footer");?>