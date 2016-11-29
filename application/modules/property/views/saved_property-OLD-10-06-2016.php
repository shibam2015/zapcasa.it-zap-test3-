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
		rules: {
			name: {
				required: true
			},
			email_id: {
				required: true,
				email: true
			},
			message: {
				required: true
			},
			phone_number: {
				required: true
			}
		},messages: {
			name: "",
			email_id: "",
			message: "",
			phone_number: ""
		}
	});
	$("#showcase").awShowcase({
		content_width: 464,
		content_height: 376,
		fit_to_parent: false,
		auto: false,
		interval: 3000,
		continuous: false,
		loading: true,
		tooltip_width: 200,
		tooltip_icon_width: 32,
		tooltip_icon_height: 32,
		tooltip_offsetx: 18,
		tooltip_offsety: 0,
		arrows: false,
		buttons: true,
		btn_numbers: true,
		keybord_keys: true,
		mousetrace: false,
		/* Trace x and y coordinates for the mouse */
		pauseonover: true,
		stoponclick: true,
		transition: 'vslide',
		/* hslide/vslide/fade */
		transition_delay: 500,
		transition_speed: 500,
		show_caption: 'onhover',
		/* onload/onhover/show */
		thumbnails: true,
		thumbnails_position: 'outside-last',
		/* outside-last/outside-first/inside-last/inside-first */
		thumbnails_direction: 'vertical',
		/* vertical/horizontal */
		thumbnails_slidex: 0,
		/* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
		dynamic_height: false,
		/* For dynamic height to work in webkit you need to set the width and height of images in the source. Usually works to only set the dimension of the first slide in the showcase. */
		speed_change: true,
		/* Set to true to prevent users from swithing more then one slide at once. */
		viewline: false /* If set to true content_width, thumbnails, transition and dynamic_height will be disabled. As for dynamic height you need to set the width and height of images in the source. */
	});
});
$(document).ready(function() {
	$('.fancybox').fancybox();
});
</script>
</head>
<body class="noJS">
    <script>
        var bodyTag = document.getElementsByTagName("body")[0];
        bodyTag.className = bodyTag.className.replace("noJS", "hasJS");
    </script>
    <!------ Header part ------------->
    <!------ Header part ------------->
    <?php $this->load->view("_include/header"); 
	if($this->session->userdata('delete_saved_property_message') != ''){ 
		$succes_msg = $this->session->userdata('delete_saved_property_message');
		$this->session->unset_userdata('delete_saved_property_message');
	}else{
		$succes_msg = '';
	}
	?>
    <!------ banner part ------------->
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
    <!----- login pop up start  --------------------->
    <?php $this->load->view("_include/login_user"); ?>          
    <!----- login pop up end --------------------->
    <!------ body part ------------->
    <div class="main">
        <div id="breadcrumb" class="fk-lbreadbcrumb newvd">
            <span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('saved_property_home');?></a></span> 
            ><span>  <?php echo $this->lang->line('saved_property_header_saved_properties');?></span>
        </div>
        <!--<h2 class="pagetitle">Registration</h2>-->
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
                <div>
                    <div class="inbox_tabs">
                        <ul>
                            <!-- <li><a class="active" href="<?php //echo base_url();?>property/get_message">Inbox</a></li>-->
                            <!--                    <li><a href="#">Reply</a></li>
                                <li><a href="#">Search</a></li>
                                <li><a href="javascript:void(0);" onClick="return delete_msg();">Delete</a></li>-->
                        </ul>
                    </div>
                    <!--<div class="search_area">
                        <?php
                            /*$attributes = array('class' => 'add_property_form', 'id' => 'idForm1');
                            echo form_open_multipart('property/msg_search', $attributes);*/
                            ?> 
                        	<input type="text" name="search_fld" class="search-fld" placeholder="Search a message"/>
                            <input type="submit" class="search_img" value="" />
                         <?php /*echo form_close();*/?>   
                        </div>-->
                    <div class="clear"></div>
                </div>
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
                            //echo count($property_lists);
                            foreach($property_lists as $property_list ){
                            	$suspended_user_type = get_perticular_field_value('zc_user','user_type'," and user_id='".$propertyDetails[0]['suspention_by_user']."'");
								/////////////////////////property name///////////////////////////////////
								$property_id=$property_list['property_id'];
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
                            		$property_status = $propertyDetails[0]['property_status'];
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
								//$prop_det_url.='-'.trim($typology_name);
								//$city=get_perticular_field_value('zc_property_details','city'," and property_id='".$property_id."'");
								$provience=get_perticular_field_value('zc_property_details','provience'," and property_id='".$property_id."'");
								//$prop_typology=get_perticular_field_value('zc_property_details','typology'," and property_id='".$property_id."'");
								$st_name1=get_perticular_field_value('zc_region_master','Province_Code'," and `province_name` LIKE '%".$provience."%' group by Province_Code");
								$prop_det_url.='-'.trim($city);
								$prop_det_url.='-'.trim($provience);
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
                        <tr <?php echo $class1;?> <?php echo(($property_status == 2 && $suspention_status == 0)?'':'style="background:#ffffd7"'); ?>>
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
                                        <a <?php echo(($property_status == 2 && $suspention_status == 0)?'href="'.$parms_url.'"':'style="color:#686868;" href="javascript:void(0);"'); ?>>
                                        <?php
										$main_img=get_perticular_field_value('zc_property_img','file_name'," and property_id='".$property_id."' and img_type='main_image'");
										if($main_img!=''){
											?>
											<img src="<?php echo base_url();?>assets/uploads/Property/Property<?php echo $property_id;?>/thumb_92_82/<?php echo $main_img;?>" alt="" width="102px" height="68px;">
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
                                            <a href="<?php echo(($suspended_user_type != 4 || $propertyDetails[0]['suspention_status'] == 0)?$parms_url:'javascript: void(0);'); ?>">
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
										</p>
                                    </div>
                                    <div class="clear"></div>
                                </span>
                            </td>
                            <td>
                                <input type="hidden" id="saved_<?php echo $property_list['saved_id'] ?>" value="<?php echo $parms_url;?>">
								<?php
								if($property_status == 2 && $suspention_status == 0){
								?>
                                <div class="mask">
									<button class="modify" onClick="return prop_view(<?php echo $property_list['saved_id'];?>);"><?php echo $this->lang->line('saved_property_button_view');?></button>
								</div>
                                <?php
								}
								?>											
                            </td>
                            <td>
                                <div class="mask"><button class="delete __DelSaveSearch" id="<?php echo $property_list['saved_id'];?>" onClick="return delete_saved(<?php echo $property_list['saved_id'];?>,'<?php echo $toPageString; ?>');"><?php echo $this->lang->line('saved_property_button_delete');?></button></div>
                            </td>
                        </tr>
                        <?php
                            }
                            $j++;
                            $i++;							$entryCounter++;
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
            <?php /*	
                <div class="google_add_area">
                	<span class="google_ad"><img src="<?php echo base_url();?>asset/images/google_ad_300x250.jpg" width="300" height="250" alt=""></span>
        </div>
        */ ?>
        <?php 
            $google_adsence = get_perticular_field_value('zc_settings','meta_value'," and meta_name='google_adsence'"); 
            if( isset($google_adsence) && ( count($google_adsence) > 0 ) ) {
            ?>
        <div class="google_add_area">
            <span class="google_ad">
            <?php 
                echo "<pre>";
                print_r($google_adsence);
                ?>
            </span>
        </div>
        <?php } ?>
        <div class="clear"></div>
    </div>
    </div>
    <!--inbox end-->
    </div>
    <!------ footer part ------------->
    <?php $this->load->view("_include/footer_search");?>
    <!------- pagination js ----------------->
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.paginate.js"></script>
    <script type="text/javascript">
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
	function delete_msg() {
		var checkedValues = $('input:checkbox:checked').map(function() {
			return this.value;
		}).get();
		//alert(checkedValues);	
		if (checkedValues == '') {
			alert('<?php echo $this->lang->line('saved_property_please_select_message_which_you_want_to_delete ');?>');
			return false;
		} else {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>property/delete_msg", // 
				data: {
					msg_id: checkedValues
				}, // <---
				success: function(msg) {
					location.reload(true);
				},
				error: function() {
					alert("<?php echo $this->lang->line('saved_property_there_is_something_wrong');?>");
					//alert("failure");
				}
			});
		}
	}
	function click_me(id) {
		var div_id = "#inbox_msg";
		$.ajax({
			type: "POST",
			url: "<?php echo base_url()?>property/msg_details", // 
			data: {
				msg_id: id
			}, // <---
			success: function(msg) {
				$(div_id).html(msg);
				$("#msg_id").val(id);
			},
			error: function() {
				alert("<?php echo $this->lang->line('saved_property_there_is_something_wrong');?>");
			}
		});
		$("#inbox_delete_pagination").html("<a href='javascript:void(0);' class='inbox_delete_pagination_lft' onClick='return open_reply();'><img src='<?php echo base_url();?>assets/images/reply.png' title='<?php echo $this->lang->line('saved_property_image_reply');?>'></a><a class='view_prop' href='<?php echo base_url();?>property/view_property/" + id + "'><?php echo $this->lang->line('saved_property_view_property');?></a>");
	}
	function open_reply() {
		$("#bbb").show();
	}
	$(".success").delay(3200).fadeOut(300);
	function delete_saved(id, pageString) {
		//alert(id);
		if (confirm("<?php echo $this->lang->line('are_you_sure_text');?>")) {
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>property/delete_saved_property", // 
				data: {
					saved_id: id
				}, // <---
				success: function(msg) { //alert("<?php echo $this->lang->line('saved_property_delete_message'); ?>");				
					location.href = '<?php echo base_url().'property/get_saved_property'; ?>' + pageString;
				},
				error: function() {
					alert("<?php echo $this->lang->line('saved_property_there_is_something_wrong');?>");
					//alert("failure");
				}
			});
			//delete here
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
		setTimeout(function() {
			$("#successDIV").hide();
		}, 4000);
	});
    </script>
</body>
</html>
