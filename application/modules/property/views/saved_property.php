<?php $this->load->view("_include/meta"); ?>
<style>
#idForm .search-fld textarea.error {border:1px solid red;}
</style>
<script type="text/javascript">
$(document).ready(function() {
	$("#idForm").validate({
		rules: {
			message: {
				required: true
			}
		},messages: {
			message: ""
		}
	});
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
    <!-- Header part -->
    <?php $this->load->view("_include/header"); 
	if($this->session->userdata('delete_saved_property_message') != ''){ 
		$succes_msg = $this->session->userdata('delete_saved_property_message');
		$this->session->unset_userdata('delete_saved_property_message');
	}else{
		$succes_msg = '';
	}
	?>
    <!-- banner part -->
    <div class="insidepage_banner">
        <div class="main">
            <h2>
				<?php echo $this->lang->line('saved_property_real_estate_for');?>
				<font style="font-weight:bold;">
					<?php echo $this->lang->line('saved_property_jobs');?>
				</font>
				<?php echo $this->lang->line('saved_property_and');?>
				<font style="font-weight:bold;">
					<?php echo $this->lang->line('saved_property_housing');?>
				</font>
			</h2>
        </div>
    </div>
    <!-- login pop up start -->
    <?php $this->load->view("_include/login_user"); ?>          
    <!--- login pop up end -->
    <!-- body part -->
    <div class="main">
        <div id="breadcrumb" class="fk-lbreadbcrumb newvd">
            <span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('saved_property_home');?></a></span> 
            > <span><?php echo $this->lang->line('saved_property_header_saved_properties');?></span>
        </div>
        <!-- Inbox-->
        <div>
            <ul class="listing-tabs">
                <li class="active"><a href="<?php echo base_url();?>property/get_saved_property"><?php echo $this->lang->line('saved_property_listing_tab_saved_properties');?></a></li>
                <li><a href="<?php echo base_url();?>property/get_saved_search"><?php echo $this->lang->line('saved_property_listing_tab_saved_searches');?></a></li>
            </ul>
            <div class="inbox_area">
                <?php  if($succes_msg!='') { ?>
                <div class="success" id="successDIV" ><?php echo $succes_msg; ?></div>
                <?php } ?>
                <div class="clear"></div>
                <div class="advertiser_details save_search_width">
                    <table width="100%" border="0" cellspacing="3" cellpadding="3">
                        <tr class="heading">
                            <td width="5%"><?php echo $this->lang->line('saved_property_saved_property_no');?></td>
                            <td width="15%"><?php echo $this->lang->line('saved_property_saved_property_date');?></td>
                            <td width="64%"><?php echo $this->lang->line('saved_property_saved_property_name');?></td>
                            <td width="8%">&nbsp;</td>
                            <td width="8%">&nbsp;</td>
                        </tr>
                        <?php
						//echo "=============".count($property_lists);
						if(!empty($property_lists)){
							$entryCounter = 1;
                            $i=1;
                            $j=0;
                            // error_reporting(E_ALL);
                            foreach($property_lists as $property_list ){
                            	// $suspended_user_type = get_perticular_field_value('zc_user','user_type'," and user_id='".$propertyDetails[0]['suspention_by_user']."'");
                            	$suspended_user_type = get_perticular_field_value('zc_user','user_type'," and user_id='".$this->session->userdata('user_id')."'");
								//$user_status = get_perticular_field_value('zc_user','status'," and user_id='".$property_id."'");
								//echo '<pre>';print_r($property_lists);die;

								/////////////////////////property name///////////////////////////////////
								$property_id=$property_list['property_id'];
								$user_status_list = $property_list['user_status'];
								//echo property_id;die;
								$prop_contract_id=get_perticular_field_value('zc_property_details','contract_id'," and property_id='".$property_id."'");
								$prop_typology=get_perticular_field_value('zc_property_details','typology'," and property_id='".$property_id."'");
								$property_name="";
								$contract="";
                            	$provience = "";
                            	$prop_price = '0,00';
                            	$prop_update_price = '0,00';
                            	$contract="";
                            	$prop_det_url='';
                            	$property_status = 2;
								$suspention_status = 0;
								//$user_status=0;
								//$user_status_list = 0;									
                            	if($prop_contract_id==1){
                            		$contract="Rent";
                            	}
                            	if($prop_contract_id==2){
                            		$contract="Sell";
								}
                            	$property_name.= $contract;
                            	$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$prop_typology."'");
                            	$property_name.=' '.stripslashes($typology_name);
								////////////////////propurl////////////////////////////////
                            	$prop_det_url='';
                            	$propertyDetails = array();
                            	$propertyDetails = get_all_value('zc_property_details'," and property_id='".$property_id."'");																						
                            	$city = '';
                            	$prop_typology = '';
                            	$prop_id = 0;
                            	$address = "";

                            	if(isset($propertyDetails[0])) {
									//echo '<pre>';print_r($propertyDetails);die;
                            		$property_status = $propertyDetails[0]['property_status'];
									$property_approval = $propertyDetails[0]['property_approval'];
									$suspention_status = $propertyDetails[0]['suspention_status'];
                            		$city =  $propertyDetails[0]['city'];
                            		$prop_typology = $propertyDetails[0]['typology'];
                            		$provience = $propertyDetails[0]['provience'];
                            		$prop_price = $propertyDetails[0]['price'];
                            		$prop_update_price = $propertyDetails[0]['update_price'];
                            		$prop_id = $propertyDetails[0]['property_id'];

                            		if($propertyDetails[0]['area']!='') {
                            			$address .= $propertyDetails[0]['area'].' - ';
                            		}
                            		if($propertyDetails[0]['street_address']!=''){ $address .= $propertyDetails[0]['street_address'].',';}
                            		if($propertyDetails[0]['street_no']!=''){ $address .= $propertyDetails[0]['street_no'].' - ';}
                            		if($propertyDetails[0]['zip']!=''){ $address .= $propertyDetails[0]['zip'];}
                            	}
                            	$prop_det_url.= $contract;
                            	$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$prop_typology."'");
								$provience=get_perticular_field_value('zc_property_details','provience'," and property_id='".$property_id."'");
								$st_name1=get_perticular_field_value('zc_region_master','Province_Code'," and `province_name` LIKE '%".$provience."%' group by Province_Code");
								//$prop_det_url.='-'.trim($city);
								//$prop_det_url.='-'.trim($provience);
                            	if($_COOKIE['lang'] == "english")				
								{
									$prop_det_url.='-'.trim($property_list['city_name']);
									$prop_det_url.='-'.trim($property_list['provience_name']);
								}
								else
								{
									$prop_det_url.='-'.trim($property_list['city_name_it']);
									$prop_det_url.='-'.trim($property_list['provience_name_it']);
								}					
                            	$prop_det_url.='-'.trim($property_id);	
                            	$category_id=get_perticular_field_value('zc_property_details','category_id'," and property_id='".$property_id."'");
								$search_title=get_property_type($category_id);											
                            	$main_image=get_perticular_field_value('zc_property_img','file_name'," and property_id='".$property_id."' and img_type='main_image'");
								$property_name=property_name($property_id);
                            	$parentCategoryName = get_category_field_value( $category_id );
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
                            	  	if($j%2==0) {
                            			$class1='';
                            		} else {
                            			$class1="class='odd_row'";
                            		}
                            		if( $prop_id != 0 ) {
										$entryPerPage = 10;
										$noOfEntry = count($property_lists);
										if($noOfEntry==1){
											$toPageString = (($this->uri->segment('3') - $entryPerPage)==0?"":"/".($this->uri->segment('3')));
										}else{
											$toPageString = "/".$this->uri->segment('3');
										}										
                            			?>
										<tr <?php echo $class1; ?> <?php echo(($property_status == 2 && ($suspention_status == 0 && $user_status_list == 1 && $property_approval != '0')) ? '' : 'style="background:#ffffd7"'); ?>>
                            <td><?php echo ($entryCounter + $this->uri->segment('3'));?></td>
                            <td>
							<?php
							switch(date('m',strtotime($property_list['saved_date']))){
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
								echo date('d',strtotime($property_list['saved_date'])).' '.$monthName.' '.date('Y',strtotime($property_list['saved_date']));
							?>
							</td>
                            <td>
                                <span>
                                    <div class="property_img">
										<a <?php echo(($property_status == 2 && ($suspention_status == 0 && $user_status_list == 1 && $property_approval != '0')) ? 'href="' . $parms_url . '"' : 'style="color:#686868;"'); ?>>
                                        <?php
										$main_img=get_perticular_field_value('zc_property_img','file_name'," and property_id='".$property_id."' and img_type='main_image'");
										if($main_img!=''){
											?>
											<img
												src="<?php echo base_url();?>assets/uploads/Property/Property<?php echo $property_id;?>/thumb_92_82/<?php echo $main_img;?>"
												alt="" width="102px"
												height="68px;" <?php echo(($property_status == 2 && ($suspention_status == 0 && $user_status_list == 1 && $property_approval != '0')) ? '' : 'style="opacity:0.4;filter:alpha(opacity=40);"'); ?>>
											<?php
										}else{
											?>
											<img src="<?php echo base_url();?>assets/images/no_proimg.jpg" alt="" width="102px" height="68px;">
											<?php
										}
										?>
                                        </a>
                                    </div>
                                    <div class="property_cont">
                                        <h4 style="font-weight:bold;color:#000000;font-family:'CenturyGothicRegular';font-size:12px;">
											<?php
											echo $this->lang->line('ref_code').': ';
											$Typo=get_perticular_field_value('zc_contract_types',($_COOKIE['lang']=='it'?'name_it':'name')," and contract_id='".$propertyDetails[0]['contract_id']."'");
											echo CreateNewRefToken($propertyDetails[0]['property_id'],$Typo);
											?>
										</h4>
                                        <h4 style="font-size:15px;">
											<a <?php echo(($property_status == 2 && ($suspention_status == 0 && $user_status_list == 1 && $property_approval != '0')) ? 'href="' . $parms_url . '"' : 'style="color:#999999;"'); ?>>
											<?php
											$ContractType=get_perticular_field_value('zc_contract_types',($_COOKIE['lang']=='it'?'name_it':'name')," and contract_id='".$prop_contract_id."'");
											$TypologyName=get_perticular_field_value('zc_typologies',($_COOKIE['lang']=='it'?'name_it':'name')," and status='active' and typology_id='".$propertyDetails[0]['typology']."'");
											$CityName=get_perticular_field_value('zc_city',($_COOKIE['lang']=='it'?'city_name_it':'city_name')," and (`city_id` = '".$propertyDetails[0]['city']."')");
											$ProvienceName=get_perticular_field_value('zc_provience','provience_name'," and `provience_id` = '".$propertyDetails[0]['provience']."'");
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
                                        </h4>
                                        <h3>
										<?php
										echo($propertyDetails[0]['area']!=''?$propertyDetails[0]['area'].' - ':'');
										echo($propertyDetails[0]['street_address']!=''?nl2br($propertyDetails[0]['street_address']):'');
										echo($propertyDetails[0]['street_no']!=''?', '.$propertyDetails[0]['street_no']:'');
										echo($propertyDetails[0]['zip']!=''?' - '.$propertyDetails[0]['zip']:'');
										?>
										</h3>
                                        <p class="price" style="font-size:12px;color:#ED6B1F;">
											<font style="color:#ED6B1F">
											<?php
											if($prop_price!='0.00'){
												echo '&euro;'.show_price($prop_price);
												if($prop_contract_id==1){
													?>
													<span style="color:#000; font-weight:bold;">
														<?php echo $this->lang->line('property_search_per_month');?>
													</span>
													<?php
												}
												if($prop_update_price!='0.00'){
													$per_prop=percentage($prop_update_price,$prop_price);
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
																<?php echo percentage($prop_update_price,$prop_price);?> % 
															</span>
															<?php
														}else{
															?>
															<span style="color:#F00;font-weight:bold;padding:0 0 0 17px;position:relative;">
																<span style="position:absolute;top:2px;left:0">
																	<img src="<?php echo base_url();?>assets/images/red.gif" width="8px" height="8px" style="border:none;">
																</span>
																<?php echo '+'.percentage($prop_update_price,$prop_price);?> %
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
											<?php echo(($property_status == 2 && ($suspention_status == 0 && $user_status_list == 1)) ? '' : '<span style="color:#ff1515;font-weight:bold;margin-left:10px;">' . $this->lang->line('saved_property_unavailable') . '</span>'); ?>
										</p>
										<?php
										if ($property_approval == '0') {
											?>
											<p style="color:red"><?php echo $this->lang->line('property_inactive_by_admin'); ?></p>
										<?php
										}
										?>
                                    </div>
                                    <div class="clear"></div>
                                </span>
                            </td>
                            <td>
                                <input type="hidden" id="saved_<?php echo $property_list['saved_id'] ?>" value="<?php echo $parms_url;?>">
								<?php
								if ($property_status == 2 && ($suspention_status == 0 && $user_status_list == 1 && $property_approval != '0')) {
								?>
                                <div class="mask">
									<button class="modify" onClick="return prop_view(<?php echo $property_list['saved_id'];?>);"><?php echo $this->lang->line('saved_property_button_view');?></button>
								</div>
                                <?php
								}
								?>		
																		
                            </td>
                            <td>
                            	<?php if(count($property_lists) == 1 && $toPageString != '') { 
                            		$str = explode("/", $toPageString);													
                            		if($str[1] == 0)
                            			$str = '';
                            		else
                            		{
                            			$str = $str[1]-10;
                            			$str = "/".$str;
                            		}							
                            	?>
                            		<div class="mask"><button class="delete __DelSaveSearch" id="<?php echo $property_list['saved_id'];?>" onClick="return delete_saved(<?php echo $property_list['saved_id'];?>,'<?php echo $str; ?>');"><?php echo $this->lang->line('saved_property_button_delete');?></button></div>
                            	<?php } else { ?>
                            		<div class="mask"><button class="delete __DelSaveSearch" id="<?php echo $property_list['saved_id'];?>" onClick="return delete_saved(<?php echo $property_list['saved_id'];?>,'<?php echo $toPageString; ?>');"><?php echo $this->lang->line('saved_property_button_delete');?></button></div>
                            	<?php } ?>                                
                            </td>
                        </tr>
                        <?php
                            }
                            $j++;
                            $i++;
							$entryCounter++;
                            }
                            ?>
                        <tr colspan="5"></tr>
                        <?php 	 
						}else{
						 ?>
                        <tr>
                            <td colspan="5" style="text-align:center;"><?php echo $this->lang->line('saved_property_sorry_no_records_found');?></td>
                        </tr>
                        <?php
						}
						?>
                    </table>
                    <?php
					if(!empty($property_lists)){
					?>						
                    <div class="row pagination-inbox">
                        <div class="col-md-12 col-md-offset-5">
                            <div class="inbox_delete_pagination_rht">
								<?php echo $pagination; ?>
							</div>
                        </div>
                    </div>
                    <?php
					}
				?>
                </div>
            </div>
        <?php 
            $google_adsence = get_perticular_field_value('zc_settings','meta_value'," and meta_name='google_adsence'"); 
            if( isset($google_adsence) && ( count($google_adsence) > 0 ) ) {
            ?>
        <div class="google_add_area"><?php echo "<pre>"; print_r($google_adsence);?></div>
        <?php } ?>
        <div class="clear"></div>
    </div>
    </div>
    <!--inbox end-->
    </div>
    <!------ footer part ------------->
    <?php $this->load->view("_include/footer_search");?>
    <script type="text/javascript">
	function delete_saved(id, pageString) {
		if (confirm("<?php echo $this->lang->line('are_you_sure_text');?>")) {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>property/delete_saved_property",
				data: {
					saved_id: id
				},
				success: function(msg) {			
					location.href = '<?php echo base_url().'property/get_saved_property';?>' + pageString;
				},
				error: function(){
					alert("<?php echo $this->lang->line('saved_property_there_is_something_wrong');?>");
				}
			});
			return true;
		} else {
			return false;
		}
	}
	function prop_view(id) {
		var ret_url = $('#saved_' + id).val();
		$(location).attr('href', ret_url);
	}
	$(document).ready(function() {
		setTimeout(function(){$("#successDIV").hide();},4000);
	});
    </script>
</body>
</html>
