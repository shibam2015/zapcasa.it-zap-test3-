<?php $this->load->view("_include/meta"); ?>
<style type="text/css">
/*jquery error styles */
div.error{ float: left; color: red; padding-right: .5em;  }
label.error { float: left !important; color: red !important; padding-right: .5em !important; text-align:left !important;  }
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
	$.validator.addMethod("alphabetsnspace", function(value, element) {
		return this.optional(element) || /(https?:\\)?([\w-]+\.)+[\w-]+[.com|.in|.org]+(\[\?%&=]*)?/.test(value);
	});
	$.validator.addMethod("youtube", function(value, element) {
		if (value != "") {
			var p = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
			return (value.match(p)) ? RegExp.$1 : false;
		} else {
			return true;
		}
	},"<?php echo $this->lang->line('add_property_form_please_enter_valid_url'); ?>");
	jQuery.extend(jQuery.validator.methods, {
		number: function(value, element) {
			return this.optional(element) || /^(?:\d+|\d{1,3}(?:\.\d{3})+)(?:,\d+)?$/.test(value) || /^(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(value);
		}
	});
});
</script>
</head>
<body class="noJS">
    <script type="text/javascript">
        var bodyTag = document.getElementsByTagName("body")[0];
        bodyTag.className = bodyTag.className.replace("noJS", "hasJS");
    </script>
    <!------ Header part -------------->
    <!--header-->
    <?php $this->load->view("_include/header");	?>
    <!------ banner part -------------->
    <div class="insidepage_banner">
        <div class="main">
            <h2><?php echo $this->lang->line('add_property_form_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('add_property_form_jobs');?></font> <?php echo $this->lang->line('add_property_form_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('add_property_form_housing');?></font></h2>
        </div>
    </div>
    <!----- login pop up start  ---------------------->
    <?php $this->load->view("_include/login_user"); ?>
    <!----- login pop up end ---------------------->
    <!------ body part -------------->
    <!------ body part -------------->
    <div class="main">
        <div id="breadcrumb" class="fk-lbreadbcrumb newvd">
            <span><a
                    href="<?php echo base_url(); ?>"><?php echo $this->lang->line('advertise_details_home'); ?></a></span>
            >
            <span><?php echo $this->lang->line('add_property_form_add_property');?></span>
        </div>
        <ul class="listing-tabs">
            <li><a href="property_details"><?php echo $this->lang->line('add_property_form_listing_tabs_list_of_property');?></a></li>
            <li class="active"><a href="add_property_form"><?php echo $this->lang->line('add_property_form_listing_tabs_add_property');?></a></li>
            <!--<li><a href="#"></a>My preferences</li>
			<li class="delete-tab"><a href="#">Delete account</a></li>-->
        </ul>
        <?php
        $attributes = array('class' => 'add_property_form', 'id' => 'register');
		echo form_open_multipart('property/add_property_form', $attributes);
		$uid=$this->session->userdata( 'user_id' );
		$user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$uid."'");
		?>
        <!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
        <!--Add property csv-->
        <div class="registercomn_box" id="regboxId">
            <div class="arrow_box error_message" id="msg_box_general"><?php echo $this->lang->line('add_property_form_add_your_property_on_property');?> (<font style="color:#f33038;">*</font>) <?php echo $this->lang->line('add_property_form_are_required');?>
                <?php if($user_type==3){?>
                <br>
                <?php echo $this->lang->line('add_property_form_as_you_are_agency_you_may_upload_multiple');?>  <a href="<?php echo base_url();?>property/add_property_csv"><?php echo $this->lang->line('add_property_click_here');?></a>
                <?php }?>
            </div>
            <div class="arrow_box error_message" id="msg_box_csv" style="display:none;"><?php echo $this->lang->line('add_property_form_hi_download_csv_file_first');?> <br><?php echo $this->lang->line('add_property_form_if_you_add_single_property');?> <a href='javascript:void(0);' onclick='return add_property()'><?php echo $this->lang->line('add_property_form_download_csv_click_here');?></a></div>
            <div id="upload_csv" class="add_newproperty_box" style="min-height:300px;display:none;">
                <div class="add_newproperty_icon"><img src="<?php echo base_url();?>assets/images/add_newproperty_icon.jpg" alt=""></div>
                <div class="add_newproperty_table1">
                    <div class="section2">
                        <div class="cat_select">
                            <label><?php echo $this->lang->line('add_property_form_download_csv');?> </label>
                            <a href="<?php echo base_url()?>property/dowload_file_doc/property.csv">
                            <img src="<?php echo base_url();?>assets/images/download.png" alt="download csv">
                            </a>
                        </div>
                    </div>
                    <div class="section2">
                        <div class="cat_select">
                            <label><?php echo $this->lang->line('add_property_form_upload_csv');?> </label>
                            <input type="file">
                        </div>
                    </div>
                </div>
            </div>
            <div id="add_newproperty_box" class="add_newproperty_box">
                <div class="add_newproperty_icon"><img src="<?php echo base_url();?>assets/images/add_newproperty_icon.jpg" alt=""></div>
                <!--Add property csv-->
                <div class="add_newproperty_table1">
                    <div class="section1">
                        <div class="cat_select">
                            <label style="display:block;">
								<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_contract');?>
							</label>
							<label class="error" for="contract" generated="true" style="display:none;font-weight:normal"></label>
                            <label class="contarct_error" style="display:none;font-weight:normal"></label>
                            <select name="contract" id="contract" onChange="get_category(this.value);display_things(this.value)" class="required"  >
                                <option value="" selected="selected" ><?php echo $this->lang->line('add_property_form_select_contract_type');?></option>
                                <?php foreach($contract_type as $keyContract=>$valContract): ?>
                                <option value="<?php echo $keyContract; ?>"><?php echo $valContract; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="cat_select" name="category_id" id="category_id" >
                            <label style="display:block;">
								<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_category');?>
							</label>
                            <label class="error" for="category" generated="true" style="display:none;font-weight:normal"></label>
                            <label class="category_error" style="display:none;font-weight:normal"></label>
							<select name="category" id="category" onChange="get_sub_category(this.value);typology_adjustment(this.value);display_things(this.value);" class="required"  >
                                <option value=""><?php echo $this->lang->line('add_property_form_select_a_category');?></option>
                            </select>
                        </div>
                        <div class="cat_select" style="display:none;" id="sub_category_area" >
                            <label style="display:block;">
								<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_subCategory');?>
							</label>
							<label class="error" for="sub_category" generated="true" style="display:none;font-weight:normal"></label>
                            <label class="sub_category_error" style="display:none;font-weight:normal"></label>
                            <select name="sub_category" id="sub_category" onChange="typology_adjustment(this.value);" class="required">
                                <option value="0"><?php echo $this->lang->line('add_property_form_select_a_sub_category');?></option>
                            </select>
                        </div>
                    </div>
                    <div class="heading"><strong><?php echo $this->lang->line('add_property_form_where_is_the_property');?></strong></div>
                    <div class="section2">
                        <div class="cat_select">
                            <label style="display:block;">
								<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_provience');?>
							</label>
							<label class="error" for="province" generated="true" style="display:none;font-weight:normal"></label>
                            <select name="province" id="province"  class="required" onChange="return get_city(this.value);">
                                <option value=""><?php echo $this->lang->line('add_property_form_please_select_your_province');?></option>
                                <?php
								foreach($provience_list as $key=>$val){
								$provinceID=get_perticular_field_value('zc_provience','provience_id'," AND ".($_COOKIE['lang']=='english'?"`provience_name`":"`provience_name_it`")." = '".mysql_real_escape_string($val)."'");
								$st_name1=get_perticular_field_value('zc_region_master','province_code'," AND ".($_COOKIE['lang']=='english'?"`province_name`":"`province_name_it`")." = '".mysql_real_escape_string($val)."' group by province_code");?>
                                <option value="<?php echo $provinceID;?>" <?php echo($provinceID==set_value('province')?'selected':'');?>>
									<?php echo str_replace("\'","'",$val); ?> - <?php echo $st_name1;?>
								</option>
                                <?php
								}
								?>
                            </select>
                        </div>
                        <div class="cat_select">
                            <label style="display:block;">
								<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_city');?>
							</label>
							<label class="error" for="city" generated="true" style="display:none;font-weight:normal"></label>
                            <select name="city" id="city"  class="required">
                                <?php
								if(set_value('city')==''){
								?>
                                <option value="">
									<?php echo $this->lang->line('add_property_form_please_select_your_city_first');?>
								</option>
                                <?php
								}else{
									foreach($city as $key=>$val){
										$cityID=get_perticular_field_value('zc_city','city_id'," AND ".($_COOKIE['lang']=='english'?"`city_name`":"`city_name_it`")." = '".mysql_real_escape_string($val)."'");
										?>
										<option value="<?php echo $cityID;?>" <?php echo($cityID==set_value('city')?'selected':'');?>><?php echo $val;?></option>
									<?php
									}
								}
								?>
                            </select>
                        </div>
                        <div class="cat_select">
                            <label style="display:block;">
								<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_zip_code');?>
							</label>
							<label class="error" for="zip" generated="true" style="display:none;font-weight:normal"></label>
                            <input class="required" placeholder="<?php echo $this->lang->line('add_property_form_zip_code_field');?>" type="text" name="zip" id="zip"  value="<?php echo set_value('zip');?>" >
                        </div>
                    </div>
                    <div class="section2">
                        <div class="cat_select">
                            <label style="display:block;">
								<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_address');?>
							</label>
							<label class="error" for="address" generated="true" style="display:none;font-weight:normal"></label>
                            <input type="text" placeholder="<?php echo $this->lang->line('add_property_form_street_address_field');?>" id="address" name="address" value="<?php echo set_value('address');?>" class="required">
                        </div>
                        <div class="cat_select">
                            <label style="display:block;"><?php echo $this->lang->line('add_property_form_street_no');?> </label>
                            <input type="text" name="street_no" placeholder="<?php echo $this->lang->line('add_property_form_street_no_field');?>">
                        </div>
                        <div class="cat_select">
                            <label style="display:block;"><?php echo $this->lang->line('add_property_form_area');?> </label>
                            <input type="text" name="area" placeholder="<?php echo $this->lang->line('add_property_form_enter_district');?>">
                        </div>
                    </div>
                    <div class="section1">
                        <div class="cat_select" style="width:380px;">
                            <label style="display:block;">
								<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_price');?>
							</label>
							<label id="special_err_price" class="error" for="input_price" generated="true" style="display:none;font-weight:normal"></label>
                            <!--<label class="error" for="input_price" generated="true" style="display:none;font-weight:normal"></label>-->
                            <input type="text" name="input_price"
                                   placeholder="<?php echo $this->lang->line('add_property_price_field'); ?>"
                                   id="input_price" onKeyPress="return unchecked_radio();"
                                   style="width:350px !important;" value="0,00"
                                   class="required number groupOfCurrencyBox">
                        </div>
                        <div class="radio_text" style="padding:0;line-height:40px;">
                            <span> <?php echo $this->lang->line('add_property_ok');?> </span>
                            <input type="radio" name="pvt_negotiation" id="pvt_negotiation" onClick="return blank_text();" value="1"> <?php echo $this->lang->line('add_property_form_private_nagotiation');?>
                        </div>
                    </div>
                    <div class="section2">
                        <div class="cat_select" style="width:100%;">
                            <label style="display:block;"><?php echo $this->lang->line('add_property_form_add_youtube_url');?></label>
							<label for="url" generated="true" class="error" style="font-weight:normal;display:none;"></label>
                            <input type="text" placeholder="<?php echo $this->lang->line('add_property_form_add_youtube_url_field');?>" name="url" id="url">
                        </div>
                    </div>
                </div>
                <div class="add_newproperty_table2">
                    <div class="row1">
                        <div class="cat_select">
                            <label style="display:block;">
								<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_typology');?>
							</label>
							<label class="error" for="typology" generated="true" style="display:none;font-weight:normal"></label>
                            <select name="typology" id="typology" class="required">
                                <option value=""><?php echo $this->lang->line('add_property_form_typology_field');?></option>
                            </select>
                        </div>
                        <div class="cat_select" id="prop_status">
                            <label style="display:block;">
								<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_status');?>
							</label>
							<label class="error" for="status_of_property" generated="true" style="display:none;font-weight:normal"></label>
                            <select name="status_of_property" id="status_of_property"  class="required" >
                                <option value=""><?php echo $this->lang->line('add_property_form_status_field');?></option>
                                <?php
								foreach($status_of_property as $stspro){
								?>
                                <option value="<?php echo $stspro['id']; ?>">
									<?php echo($_COOKIE['lang']=='it'?$stspro['name_it']:$stspro['name']); ?>
								</option>
                                <?php
								}
								?>
                            </select>
                        </div>
                        <div class="cat_select" id="property_kind">
                            <label style="display:block;">
								<?php echo $this->lang->line('add_property_form_kind');?>
							</label>
                            <select name="kind_of_property" id="kind_of_property">
                                <option value=""><?php echo $this->lang->line('add_property_form_kind_field');?></option>
								<?php
								foreach($kind_of_property as $kindpro){
								?>
                                <option value="<?php echo $kindpro['id']; ?>">
									<?php echo($_COOKIE['lang']=='it'?$kindpro['name_it']:$kindpro['name']); ?>
								</option>
                                <?php
								}
								?>
                            </select>
                        </div>
                        <div class="cat_select" id="Energy_class">
                            <label style="display:block;">
								<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_energyclass');?>
							</label>
							<label class="error" for="energy_efficiency" generated="true" style="display:none;font-weight:normal"></label>
                            <select name="energy_efficiency" id="energy_efficiency"  class="required" >
                                <option value=""><?php echo $this->lang->line('add_property_form_energyclass_field');?></option>
                                <?php
								foreach($energy_efficiency_class as $energyeffpro){
								?>
                                <option value="<?php echo $energyeffpro['id']; ?>">
									<?php echo($_COOKIE['lang']=='it'?$energyeffpro['name_it']:$energyeffpro['name']); ?>
								</option>
                                <?php
								}
								?>
                            </select>
                        </div>
                    </div>
                    <div class="heading"><?php echo $this->lang->line('add_property_form_upload_picture_of_the_property');?> <span> <?php echo $this->lang->line('add_property_form_atleast_one_picture_is_required');?></span></div>
                    <div class="row2">
                        <div class="cat_select">
                            <label style="display:block;color:#3d8ac1;">
								<?php echo $this->lang->line('add_property_form_main_image');?><font color="color:#f33038;">*</font>
							</label>
                            <label id="special_err" class="error" for="imgInp1" generated="true" style="display:none;width:100%;margin:5px 0"></label>
                        </div>
                        <div class="property_picture" >
                            <img id="img_1"
                                 src="<?php echo base_url(); ?>assets/images/<?php echo $this->lang->line('add_property_no_proimg_filename'); ?>"
                                 alt="" width="142" height="140"/>
                            <div class="my_style_browse_btn"> <input type='file' id="imgInp1"  name="userfile[]" class="required" /></div>
                            <div class="cross_btn" style="display:none;"></div>
                        </div>
                        <div class="property_picture">
                            <img id="img_2" src="<?php echo base_url();?>assets/images/<?php echo $this->lang->line('add_property_no_proimg_filename');?>" alt="" width="142" height="140" />
                            <div class="my_style_browse_btn"><input type='file' id="imgInp2"  name="userfile[]" /></div>
                            <div class="cross_btn" style="display:none;"></div>
                        </div>
                        <div class="property_picture">
                            <img id="img_3" src="<?php echo base_url();?>assets/images/<?php echo $this->lang->line('add_property_no_proimg_filename');?>" alt="" width="142" height="140" />
                            <div class="my_style_browse_btn"> <input type='file' id="imgInp3"  name="userfile[]"  /></div>
                            <div class="cross_btn" style="display:none;"></div>
                        </div>
                        <div class="property_picture">
                            <img id="img_4" src="<?php echo base_url();?>assets/images/<?php echo $this->lang->line('add_property_no_proimg_filename');?>" alt="" width="142" height="140" />
                            <div class="my_style_browse_btn"> <input type='file' id="imgInp4"  name="userfile[]" /></div>
                            <div class="cross_btn" style="display:none;"></div>
                        </div>
                        <div class="property_picture">
                            <img id="img_5" src="<?php echo base_url();?>assets/images/<?php echo $this->lang->line('add_property_no_proimg_filename');?>" alt="" width="142" height="140" />
                            <div class="my_style_browse_btn"><input type='file' id="imgInp5"  name="userfile[]" /></div>
                            <div class="cross_btn" style="display:none;"></div>
                        </div>
                        <div class="property_picture">
                            <img id="img_6" src="<?php echo base_url();?>assets/images/<?php echo $this->lang->line('add_property_no_proimg_filename');?>" alt="" width="142" height="140" />
                            <div class="my_style_browse_btn"> <input type='file' id="imgInp6"  name="userfile[]" /></div>
                            <div class="cross_btn" style="display:none;"></div>
                        </div>
                    </div>
                    <div class="clear"><br></div>
                    <div class="main_feature" style="display:none;">
                        <div class="heading"><?php echo $this->lang->line('add_property_form_main_feature');?></div>
                        <div class="row3">
                            <div class="cat_select" id="surface_area">
                                <label style="display:block;">
									<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_surface_area');?> (m2)
								</label>
								<label class="error" for="add_surface_area" generated="true" style="display:none;font-weight:normal"></label>
                                <input type="text" name="surface_area" id="add_surface_area" class="required number">
                            </div>
                            <div class="cat_select" id="room_no">
                                <label style="display:block;">
									<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_room_no');?>
								</label>
								<label class="error" for="add_room_no" generated="true" style="display:none;font-weight:normal"></label>
                                <input type="text" name="room_no" id="add_room_no" class="required number">
                            </div>
                            <div class="cat_select" id="floor">
                                <label style="display:block;"><?php echo $this->lang->line('add_property_form_floor');?></label>
                                <input type="text" name="floor" id="room_floor">
                            </div>
                            <div class="cat_select" id="tot_floor">
                                <label style="display:block;">
									<?php echo $this->lang->line('add_property_form_total_of_floors');?>
								</label>
								<label for="tot_room_floor" generated="true" class="error" style="display:none;font-weight:normal"></label>
                                <input type="text" name="tot_floor" id="tot_room_floor" class="number">
                            </div>
                            <div class="cat_select" id="year_of_building">
                                <label style="display:block;">
									<?php echo $this->lang->line('add_property_form_year_of_building');?>
								</label>
								<label for="Y_o_b" generated="true" class="error" style="display:none;font-weight:normal"></label>
                                <input type="text" name="year_of_building" id="Y_o_b" class="number">
                            </div>
                            <div class="cat_select" id="bed_no">
                                <label style="display:block;">
									<?php echo $this->lang->line('add_property_form_bed_no');?>
								</label>
								<label for="room_bed_no" generated="true" class="error" style="display:none;font-weight:normal"></label>
                                <input type="text" name="bed_no" class="number" id="room_bed_no">
                            </div>
                        </div>
                        <div class="row4" id="row4">
                            <div class="cat_select" id="bothroom_no">
                                <label style="display:block;">
									<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_bathrooms_no');?>
								</label>
								<label class="error" for="add_bathroom_no" generated="true" style="display:none;font-weight:normal"></label>
                                <select name="bothroom_no" id="add_bathroom_no" class="required">
                                    <option value=""><?php echo $this->lang->line('add_property_form_bathrooms_no_select');?></option>
                                    <option value="No" ><?php echo $this->lang->line('add_property_form_bathrooms_no_non');?></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="3">>3</option>
                                </select>
                            </div>
                            <div class="cat_select" id="kitchen">
                                <label style="display:block;">
									<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_kitchen');?>
								</label>
								<label class="error" for="add_kitchen" generated="true" style="display:none;font-weight:normal"></label>
                                <select name="kitchen" id="add_kitchen" class="required" >
                                    <option value=""><?php echo $this->lang->line('add_property_form_kitchen_select');?></option>
                                    <option value="No"><?php echo $this->lang->line('add_property_form_kitchen_non');?></option>
                                    <option value="Kitchenettes"><?php echo $this->lang->line('add_property_form_kitchen_kitchenettes');?></option>
                                    <option value="Livable"><?php echo $this->lang->line('add_property_form_kitchen_livable');?></option>
                                    <option value="Living"><?php echo $this->lang->line('add_property_form_kitchen_living');?></option>
                                </select>
                            </div>
                            <div class="cat_select" id="heating">
                                <label style="display:block;">
									<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_heating');?>
								</label>
								<label class="error" for="add_heating" generated="true" style="display:none;font-weight:normal"></label>
                                <select name="heating" id="add_heating" class="required" >
                                    <option value=""><?php echo $this->lang->line('add_property_form_kitchen_select');?></option>
                                    <option value="No"><?php echo $this->lang->line('add_property_form_heating_non');?></option>
                                    <option value="Autonomous"><?php echo $this->lang->line('add_property_form_heating_autonomous');?></option>
                                    <option value="Centralized"><?php echo $this->lang->line('add_property_form_heating_centralized');?></option>
                                </select>
                            </div>
                            <div class="cat_select" id="parking">
                                <label style="display:block;">
									<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_parking');?>
								</label>
								<label class="error" for="add_parking" generated="true" style="display:none;font-weight:normal"></label>
                                <select name="parking" class="required" id="add_parking" >
                                    <option value=""><?php echo $this->lang->line('add_property_form_roommates_select');?></option>
                                    <option value="No"><?php echo $this->lang->line('add_property_form_parking_non');?></option>
                                    <option value="Cargarage"><?php echo $this->lang->line('add_property_form_parking_car_garage');?></option>
                                    <option value="Parking"><?php echo $this->lang->line('add_property_form_parking_parking');?></option>
                                </select>
                            </div>
                            <div class="cat_select" id="roommates">
                                <label style="display:block;">
									<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_roommates');?>
								</label>
								<label class="error" for="add_roommates" generated="true" style="display:none;font-weight:normal"></label>
                                <select name="roommates" id="add_roommates" class="required" >
                                    <option value=""><?php echo $this->lang->line('add_property_form_roommates_select');?></option>
                                    <option value="Only women"><?php echo $this->lang->line('add_property_form_roommates_women');?></option>
                                    <option value="Only Men"><?php echo $this->lang->line('add_property_form_roommates_men');?></option>
                                    <option value="Men and women"><?php echo $this->lang->line('add_property_form_roommates_men_women');?></option>
                                </select>
                            </div>
                            <div class="cat_select" id="occupation">
                                <label style="display:block;">
									<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_occupation');?>
								</label>
								<label class="error" for="add_occupation" generated="true" style="display:none;font-weight:normal"></label>
                                <select name="occupation" id="add_occupation" class="required" >
                                    <option value=""><?php echo $this->lang->line('add_property_form_occupation_select');?></option>
                                    <option value="Only students"><?php echo $this->lang->line('add_property_form_occupation_student');?></option>
                                    <option value="Only workers"><?php echo $this->lang->line('add_property_form_occupation_workers');?></option>
                                    <option value="Students and workers"><?php echo $this->lang->line('add_property_form_occupation_student_worker');?></option>
                                </select>
                            </div>
                            <div class="cat_select"  id="furnished">
                                <label style="display:block;">
									<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_furnished');?>
								</label>
								<label class="error" for="add_furnished" generated="true" style="display:none;font-weight:normal"></label>
                                <select name="furnished" id="add_furnished" class="required" >
                                    <option value=""><?php echo $this->lang->line('add_property_form_furnished_select');?></option>
                                    <option value="No"><?php echo $this->lang->line('add_property_form_furnished_no');?></option>
                                    <option value="Yes"><?php echo $this->lang->line('add_property_form_furnished_yes');?></option>
                                    <option value="Partly"><?php echo $this->lang->line('add_property_form_furnished_partly');?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row5">
                            <div class="cat_select">
                                <label style="display:block;">
									<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_availability');?>
								</label>
								<label class="error" for="availabilty" generated="true" style="display:none;font-weight:normal;width:100%;"></label>
                                <p>
                                    <input type="radio" name="availabilty" id="avail_sp" class="required"
                                           value='0'> <?php echo $this->lang->line('add_property_form_availability_vacent'); ?>
                                    <input type="radio" name="availabilty" id="avail_sp" class="required" value='1'> <?php echo $this->lang->line('add_property_form_availability_occupated');?>
                                </p>
                            </div>
                            <div class="cat_select" id="smokers">
                                <label style="display:block;">
									<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_smokers');?>
								</label>
								<label class="error" for="smokers" generated="true" style="display:none;font-weight:normal;width:100%;"></label>
                                <p>
									<input type="radio" name="smokers" id="smokers_space"class="required" value="0"> <?php echo $this->lang->line('add_property_form_smokers_allowed');?>
                                    <input type="radio" name="smokers" id="smokers_space" class="required"
                                           value="1"> <?php echo $this->lang->line('add_property_form_smokers_not_allowed'); ?>
                                </p>
                            </div>
                            <div class="cat_select" id="pets">
                                <label style="display:block;">
									<font style="color:#f33038;">*</font><?php echo $this->lang->line('add_property_form_pets');?>
								</label>
								<label class="error" for="pets" generated="true" style="display:none;font-weight:normal;width:100%;"></label>
                                <p>
									<input type="radio" name="pets" id="pet_val" class="required" value="0"> <?php echo $this->lang->line('add_property_form_pets_allowed');?>
                                    <input type="radio" name="pets" id="pet_val" class="required"
                                           value="1"> <?php echo $this->lang->line('add_property_form_pets_not_allowed'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="additional_feature" style="display:none;" >
                        <div class="heading" id="row6"><?php echo $this->lang->line('add_property_form_additional_features');?></div>
                        <div class="row6" id="add_feature" >
                            <input type="checkbox" name="air_conditioning" value="1" id="air_conditioning"> <?php echo $this->lang->line('add_property_form_ac');?>
                            <input type="checkbox" name="elevator" value="1" id="elevator"> <?php echo $this->lang->line('add_property_form_ac_elevator');?>
                            <input type="checkbox" name="balcony" value="1" id="balcony"> <?php echo $this->lang->line('add_property_form_ac_balcony');?>
                            <input type="checkbox" name="terrace" value="1" id="terrace"> <?php echo $this->lang->line('add_property_form_ac_terrace');?>
                            <input type="checkbox" name="garden" value="1" id="garden"> <?php echo $this->lang->line('add_property_form_ac_garden');?>
                        </div>
                        <div class="row7" id="row7">
                            <div class="block">
                                <div class="heading"><?php echo $this->lang->line('add_property_form_do_you_have_the_planimetry_of_property');?></div>
                                <div class="image_box"><img id="img_7" src="<?php echo base_url();?>assets/images/<?php echo $this->lang->line('add_property_no_proimg_filename');?>" alt="" width="142" height="146"/></div>
                                <p><?php echo $this->lang->line('add_property_form_upload_an_image_of_the_planimetry');?></p>
                                <div class="property_picture1">
                                    <input type='file' id="imgInp7"  name="user_file_1" />
                                    <div id="remove" style="display:none;"><img src="<?php echo base_url()?>assets/images/cross_icon.png" alt="Remove"></div>
                                </div>
                            </div>
                            <div class="block">
                                <div class="arrow_box error_message"><?php echo $this->lang->line('add_property_form_luxury');?></div>
                                <div class="add_newproperty_icon_small"><img src="<?php echo base_url();?>assets/images/add_newproperty_icon_small.jpg" alt=""></div>
                                <div class="note">
                                    <p><?php echo $this->lang->line('add_property_form_luxury_select_this_check_box');?></p>
                                    <input type="checkbox" name="add_to_luxury" value="1"> <?php echo $this->lang->line('add_property_form_add_to_luxury');?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="heading">
						<font style="color:#f33038 !important;">*</font><?php echo $this->lang->line('add_property_form_write_a_short_description_of_the_property');?>
						<label  class="error" for="field" generated="true" style="display:none;width:100%;margin:5px 0;font-weight:normal"></label>
					</div>
                    <div class="row8">
                        <textarea rows="4" cols="40" id="field" name="description" onKeyUp="countChar(this)" class="required"></textarea>

                        <div style="float:left;">(<span
                                id="charNum">1000</span> <?php echo $this->lang->line('add_property_form_characters_left'); ?>
                            )
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <?php
                $uid = $this->session->userdata('user_id');
				$user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$uid."'");
				$posting_property_limit=get_perticular_field_value('zc_user','posting_property_limit'," and user_id='".$uid."'");
				if($posting_property_limit=='0'){
					if($user_type=='2'){
						$posting_limit=get_perticular_field_value('zc_settings','meta_value'," and settings_id='3'");
					}
					if($user_type=='3'){
						$posting_limit=get_perticular_field_value('zc_settings','meta_value'," and settings_id='4'");
					}
				}else{
                    $posting_limit = $posting_property_limit;
				}
                $total_prop_post = get_perticular_count('zc_property_details', " and property_post_by='" . $uid . "' and property_status='2'");
				$remain=$posting_limit-$total_prop_post;
				if($remain<=0){
				?>
                <div class="error_max" >
                    <?php echo $this->lang->line('add_property_form_we_are_sorry');?><br>
					<span style="font-weight:bold;">
						<?php echo $this->lang->line('add_property_form_first_delete_one');?>
					</span>
                </div>
                <?php
				}
				if($remain>0){
				?>
                <div style="margin-top:20px; margin-left:33%;">
                    <input class="mainbt cancel" name="btnSubmit" type="submit" value="<?php echo $this->lang->line('add_property_form_button_save_draft');?>" id="save_draft">
                    <input class="mainbt" name="btnSubmit" type="submit" value="<?php echo $this->lang->line('add_property_form_button_submit');?>" id="save_button">
                </div>
                <?php
				}else{
				?>
                <div style="margin-top:20px; margin-left:44%;">
                    <input  class="mainbt cancel" name="btnSubmit" type="submit" value="<?php echo $this->lang->line('add_property_form_button_save_draft');?>" id="save_draft">
                </div>
                <?php
				}

				?>
				<input type="hidden" name="btnSubmit" value="<?php echo $this->lang->line('add_property_form_button_submit');?>">
                <div class="clear"></div>
                <div class="impt_message">
					<img src="<?php echo base_url();?>assets/images/information_icon.png" alt=""><?php echo $this->lang->line('add_property_form_the_information_marked_with');?> (<font style="color:#f33038">*</font>) <?php echo $this->lang->line('add_property_form_are_required');?>
				</div>
            </div>
        </div>
        <!--##################  Loading area after form submit start ###################-->
        <div id="form_submit_loading_area" style="display:none;" >
            <div class="main">
                <div class="registercomn_box">
                    <div class="arrow_box error_message" id="msg_box_general" style="color:#FF7602;">
						<?php echo $this->lang->line('property_submit_loading_property_submission_text');?>
                    </div>
                    <div class="congratulations">
						<img src="<?php echo base_url();?>assets/images/register_thanks_icon.jpg" alt="" style="margin-top:75px;margin-left:34px;">
					</div>
                    <div class="mainsucc_box" style="width:63%">
                        <div class="suceesfulbox"  style="width:95%">
                            <div>
                                <span style="width:100%">
                                <img src="<?php echo base_url();?>assets/images/Loader.gif" alt="" style="padding-left: 47%">
                                </span>
                                <div class="clear"></div>
                            </div>
                            <p><br></p>
                        </div>
                        <div style="margin:20px;text-align:center;">
                            <?php echo $this->lang->line('property_submit_loading_please_wait_text');?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--##################  Loading area after form submit end ###################-->
        <?php echo form_close();?>
    </div>
    <!------ footer part -------------->
    <?php $this->load->view("_include/footer");?>
    <script type="text/javascript">
        function get_category(str) {
        	var cat_parent = 0;
        	if (str != 0) {
        		$.post("<?php echo base_url(); ?>property/getCategory",{
        				contract: str,
        				cat_parent: cat_parent
        			},
        			function(result) {
        				$("#category").html(result);
        				// $(".additional_feature").show();
        				// $(".main_feature").show();
        			});
        	} else {
        		// $(".additional_feature").hide();
        		// $(".main_feature").hide();
        	}
        }
        function display_things(str) {
        	//alert(str);

            var contract = $('#contract').val();
            var category = $('#category').val();

            if(contract != '' && category != "")
            {
                $(".additional_feature").show();
                $(".main_feature").show();

                $("#add_bathroom_no").addClass('required');
                $("#add_kitchen").addClass('required');
                $("#add_heating").addClass('required');
                $("#add_parking").addClass('required');
                $("#add_roommates").addClass('required');
                $("#add_occupation").addClass('required');
                $("#add_furnished").addClass('required');
                $("#avail_sp").addClass('required');
                $("#smokers_space").addClass('required');
                $("#pet_val").addClass('required');
            }
            else
            {
                $(".additional_feature").hide();
                $(".main_feature").hide();

                $("#add_bathroom_no").removeClass('required');
                $("#add_kitchen").removeClass('required');
                $("#add_heating").removeClass('required');
                $("#add_parking").removeClass('required');
                $("#add_roommates").removeClass('required');
                $("#add_occupation").removeClass('required');
                $("#add_furnished").removeClass('required');
                $("#avail_sp").removeClass('required');
                $("#smokers_space").removeClass('required');
                $("#pet_val").removeClass('required');
            }

        	if (str == "ROM") {
        		document.getElementById("surface_area").style.display = "none";
        		document.getElementById("room_no").style.display = "none";
        		document.getElementById("tot_floor").style.display = "none";
        		document.getElementById("year_of_building").style.display = "none";
        		document.getElementById("parking").style.display = "block";
        		$('#row7').hide();
        		$('#row4').show();
        		document.getElementById("bed_no").style.display = "none";
        		document.getElementById("bothroom_no").style.display = "block";
        		document.getElementById("kitchen").style.display = "block";
        		document.getElementById("heating").style.display = "block";
        		document.getElementById("roommates").style.display = "block";
        		document.getElementById("occupation").style.display = "block";
        		document.getElementById("furnished").style.display = "block";
        		document.getElementById("smokers").style.display = "block";
        		document.getElementById("pets").style.display = "block";
        		document.getElementById("floor").style.display = "block";
        		document.getElementById("prop_status").style.display = "none";
        		$('#row6').show();
        		document.getElementById("add_feature").style.display = "block";
        		document.getElementById("Energy_class").style.display = "none";
        		document.getElementById("property_kind").style.display = "none";
        		/////////add required///////////////////
        		$("#typology").addClass('required');
        		$("#add_bathroom_no").addClass('required');
        		$("#add_kitchen").addClass('required');
        		$("#add_heating").addClass('required');
        		$("#add_parking").addClass('required');
        		$("#add_roommates").addClass('required');
        		$("#add_occupation").addClass('required');
        		$("#add_furnished").addClass('required');
        		$("#avail_sp").addClass('required');
        		$("#pet_val").addClass('required');
        		$("#smokers_space").addClass('required');
        		/////////add required ends///////////////////////
        		/////////add removed starts///////////////////////
        		$("#status_of_property").removeClass('required');
        		//$("#kind_of_property").removeClass('required');
        		$("#energy_efficiency").removeClass('required');
        		$("#add_surface_area").removeClass('required');
        		$("#add_room_no").removeClass('required');
        		/////////add removed ends///////////////////////
        	}
        	if (str == "LAND") {
        		/*document.getElementById("tot_floor").style.display="none";
        		document.getElementById("year_of_building").style.display="none";
        		document.getElementById("bed_no").style.display="none";
        		document.getElementById("bothroom_no").style.display="none";
        		document.getElementById("kitchen").style.display="none";
        		document.getElementById("parking").style.display="none";
        		document.getElementById("hating").style.display="none";
        		$('#row7').hide();
        		document.getElementById("floor").style.display="none";
        		document.getElementById("furnished").style.display="none";*/
        		//alert('hello');room_no
        		$('#row7').hide();
        		$('#row4').hide();
        		$('#row6').hide();
        		document.getElementById("tot_floor").style.display = "none";
        		document.getElementById("year_of_building").style.display = "none";
        		document.getElementById("bed_no").style.display = "none";
        		document.getElementById("bothroom_no").style.display = "none";
        		document.getElementById("kitchen").style.display = "none";
        		document.getElementById("parking").style.display = "none";
        		document.getElementById("heating").style.display = "none";
        		document.getElementById("floor").style.display = "none";
        		document.getElementById("furnished").style.display = "none";
        		document.getElementById("smokers").style.display = "none";
        		document.getElementById("pets").style.display = "none";
        		document.getElementById("room_no").style.display = "none";
        		document.getElementById("add_feature").style.display = "none";
        		document.getElementById("surface_area").style.display = "block";
        		document.getElementById("prop_status").style.display = "none";
        		document.getElementById("Energy_class").style.display = "none";
        		document.getElementById("property_kind").style.display = "block";
        		/////////add required///////////////////
        		$("#typology").addClass('required');
        		//$("#kind_of_property").addClass('required');
        		$("#add_surface_area").addClass('required');
        		$("#avail_sp").addClass('required');
        		/////////add required ends///////////////////////
        		/////////add removed starts///////////////////////
        		$("#status_of_property").removeClass('required');
        		$("#energy_efficiency").removeClass('required');
        		$("#add_room_no").removeClass('required');
        		$("#add_bathroom_no").removeClass('required');
        		$("#add_kitchen").removeClass('required');
        		$("#add_heating").removeClass('required');
        		$("#add_parking").removeClass('required');
        		$("#add_roommates").removeClass('required');
        		$("#add_occupation").removeClass('required');
        		$("#add_furnished").removeClass('required');
        		$("#pet_val").removeClass('required');
        		$("#smokers_space").removeClass('required');
        		/////////add removed ends///////////////////////
        	}
        	if (str == "VAC") {
        		document.getElementById("surface_area").style.display = "block";
        		document.getElementById("room_no").style.display = "block";
        		document.getElementById("floor").style.display = "block";
        		document.getElementById("tot_floor").style.display = "block";
        		document.getElementById("year_of_building").style.display = "block";
        		document.getElementById("row6").style.display = "block";
        		document.getElementById("bed_no").style.display = "block";
        		document.getElementById("bothroom_no").style.display = "block";
				document.getElementById("kitchen").style.display = "block";
        		document.getElementById("parking").style.display = "block";
        		document.getElementById("roommates").style.display = "none";
        		document.getElementById("occupation").style.display = "none";
        		document.getElementById("heating").style.display = "block";
        		//document.getElementById("furnished").style.display="none";
        		document.getElementById("furnished").style.display = "block";
        		$('#row7').show();
        		$('#row4').show();
        		$('#row6').show();
        		document.getElementById("smokers").style.display = "none";
        		document.getElementById("pets").style.display = "block";
        		document.getElementById("add_feature").style.display = "block";
        		document.getElementById("prop_status").style.display = "block";
                document.getElementById("property_kind").style.display = "block";
                document.getElementById("Energy_class").style.display = "block";
                /*var contract_id = $("#contract").val();
        		if (contract_id == 1) {
                 document.getElementById("property_kind").style.display = "block";
        			//$("#kind_of_property").removeClass('required');
        		} else {
        			document.getElementById("property_kind").style.display = "block";
        			//$("#kind_of_property").addClass('required');
        		}
        		if (contract_id == 1) {
                 document.getElementById("Energy_class").style.display = "block";
        			$("#energy_efficiency").removeClass('required');
        		} else {
        			document.getElementById("Energy_class").style.display = "block";
        			$("#energy_efficiency").addClass('required');
                 }*/
        		////add required class////////////
        		$("#typology").addClass('required');
        		$("#status_of_property").addClass('required');
        		$("#add_surface_area").addClass('required');
        		$("#add_room_no").addClass('required');
        		$("#add_bathroom_no").addClass('required');
        		$("#add_heating").addClass('required');
        		$("#add_parking").addClass('required');
        		$("#add_furnished").addClass('required');
        		$("#avail_sp").addClass('required');
        		$("#pet_val").addClass('required');
        		///////////addition ends///////////////
        		/////////add removed starts///////////////////////
        		//$("#add_kitchen").removeClass('required');
        		$("#add_roommates").removeClass('required');
        		$("#add_occupation").removeClass('required');
        		$("#smokers_space").removeClass('required');
        		/////////add removed ends///////////////////////

        	}
        	if (str == "RES" || str == "BUS") {
        		document.getElementById("surface_area").style.display = "block";
        		document.getElementById("room_no").style.display = "block";
        		document.getElementById("floor").style.display = "block";
        		document.getElementById("tot_floor").style.display = "block";
        		document.getElementById("year_of_building").style.display = "block";
        		document.getElementById("row6").style.display = "block";
        		document.getElementById("bed_no").style.display = "none";
        		document.getElementById("bothroom_no").style.display = "block";
        		document.getElementById("parking").style.display = "block";
        		document.getElementById("roommates").style.display = "none";
        		document.getElementById("occupation").style.display = "none";
        		document.getElementById("furnished").style.display = "none";
        		document.getElementById("furnished").style.display = "block";
        		$('#row7').show();
        		$('#row4').show();
        		$('#row6').show();
        		document.getElementById("smokers").style.display = "none";
        		document.getElementById("pets").style.display = "none";
        		document.getElementById("add_feature").style.display = "block";
        		document.getElementById("prop_status").style.display = "block";
        		document.getElementById("Energy_class").style.display = "block";
        		document.getElementById("property_kind").style.display = "block";
        		//add required class////////////////////////////////////////////
        		$("#typology").addClass('required');
        		$("#status_of_property").addClass('required');
        		//$("#kind_of_property").addClass('required');
        		$("#energy_efficiency").addClass('required');
        		$("#add_surface_area").addClass('required');
        		$("#add_room_no").addClass('required');
        		$("#add_bathroom_no").addClass('required');
        		$("#add_kitchen").addClass('required');
        		$("#add_heating").addClass('required');
        		$("#add_parking").addClass('required');
        		$("#add_furnished").addClass('required');
        		$("#avail_sp").addClass('required');
        		/////end of addition////////////////////////////////////////
        		/////////add removed starts///////////////////////
        		$("#add_roommates").removeClass('required');
        		$("#add_occupation").removeClass('required');
        		$("#pet_val").removeClass('required');
        		$("#smokers_space").removeClass('required');
        		/////////add removed ends///////////////////////
            }

        }
        function get_sub_category(str) {
        	document.getElementById('sub_category').selectedIndex = 0;
        	//for room add restriction///////////////////////////
        	if (str == "BUS") {
        		$.post("<?php echo base_url(); ?>property/getSubCategory", {
        				category: str
        			},
        			function(result) {
        				$("#sub_category").html(result);
        				document.getElementById("sub_category_area").style.display = "block";
        			});
        	} else {
        		document.getElementById("sub_category_area").style.display = "none";
        	}
        }
        function typology_adjustment(str) {
        	document.getElementById('typology').selectedIndex = 0;
        	if ((str != 0) && (str != "BUS")) {
        		$.post("<?php echo base_url(); ?>property/getTypologyAddProperty",{category: str},
				function(result){
					//alert(result);
					$("#typology").html('<option value=""><?php echo $this->lang->line('add_property_form_typology_field');?></option>'+result);
				});
        	}
        }
        var img_id = 0;
        function readURL(input, img_id) {
        	//alert(img_id);
        	/*$('.loader').show();*/
        	var loader = "<?php echo base_url();?>assets/images/Pro-Img-Loader.gif";
        	$('#img_' + img_id).attr('src', loader).width(142).height(140);
        	if (input.files && input.files[0]) {
        		var reader = new FileReader();
        		reader.onload = function(e) {
        			//alert(e.target.result);
        			if (img_id != 7) {
        				$('#img_' + img_id).attr('src', e.target.result).width(142).height(140);
        			} else {
        				$('#img_' + img_id).attr('src', e.target.result).width(142).height(147);
        			}
        		}
        		reader.readAsDataURL(input.files[0]);
        	}
        }
        $("#imgInp1").change(function() {
        	var ext = this.value.match(/\.(.+)$/)[1];
        	var ext = ext.toLowerCase();
        	switch (ext) {
        		case 'jpg':
        		case 'jpeg':
        		case 'JPEG':
        		case 'png':
        		case 'gif':
        			readURL(this, 1);
        			break;
        		default:
        			alert('<?php echo $this->lang->line('add_property_form_file_upload_restriction ');?>');
        			this.value = '';
        	}
        	//img_id++;
        });
        $("#imgInp2").change(function() {
        	//img_id++;
        	var ext = this.value.match(/\.(.+)$/)[1];
        	var ext = ext.toLowerCase();
        	switch (ext) {
        		case 'jpg':
        		case 'jpeg':
        		case 'JPEG':
        		case 'png':
        		case 'gif':
        			readURL(this, 2);
        			break;
        		default:
        			alert('<?php echo $this->lang->line('add_property_form_file_upload_restriction ');?>');
        			this.value = '';
        	}
        });
        $("#imgInp3").change(function() {
        	//img_id++;
        	var ext = this.value.match(/\.(.+)$/)[1];
        	var ext = ext.toLowerCase();
        	switch (ext) {
        		case 'jpg':
        		case 'jpeg':
        		case 'JPEG':
        		case 'png':
        		case 'gif':
        			readURL(this, 3);
        			break;
        		default:
        			alert('<?php echo $this->lang->line('add_property_form_file_upload_restriction ');?>');
        			this.value = '';
        	}
        });
        $("#imgInp4").change(function() {
        	//img_id++;
        	var ext = this.value.match(/\.(.+)$/)[1];
        	var ext = ext.toLowerCase();
        	switch (ext) {
        		case 'jpg':
        		case 'jpeg':
        		case 'JPEG':
        		case 'png':
        		case 'gif':
        			readURL(this, 4);
        			break;
        		default:
        			alert('<?php echo $this->lang->line('add_property_form_file_upload_restriction ');?>');
        			this.value = '';
        	}
        });
        $("#imgInp5").change(function() {
        	//img_id++;
        	var ext = this.value.match(/\.(.+)$/)[1];
        	var ext = ext.toLowerCase();
        	switch (ext) {
        		case 'jpg':
        		case 'jpeg':
        		case 'JPEG':
        		case 'png':
        		case 'gif':
        			readURL(this, 5);
        			break;
        		default:
        			alert('<?php echo $this->lang->line('add_property_form_file_upload_restriction ');?>');
        			this.value = '';
        	}
        });
        $("#imgInp6").change(function() {
        	//img_id++;
        	var ext = this.value.match(/\.(.+)$/)[1];
        	var ext = ext.toLowerCase();
        	switch (ext) {
        		case 'jpg':
        		case 'jpeg':
        		case 'JPEG':
        		case 'png':
        		case 'gif':
        			readURL(this, 6);
        			break;
        		default:
        			alert('<?php echo $this->lang->line('add_property_form_file_upload_restriction ');?>');
        			this.value = '';
        	}
        });
        $("#imgInp7").change(function() {
        	var ext = this.value.match(/\.(.+)$/)[1];
        	var ext = ext.toLowerCase();
        	switch (ext) {
        		case 'jpg':
        		case 'jpeg':
        		case 'JPEG':
        		case 'png':
        		case 'gif':
        			readURL(this, 7);
        			//$("#remove").show();
        			break;
        		default:
        			alert('<?php echo $this->lang->line('add_property_form_file_upload_restriction ');?>');
        			this.value = '';
        	}
        });
        function unchecked_radio() {
        	//alert('sdfgsdfg');
        	//$(this).prop('checked', false);
        	$("#pvt_negotiation").prop("checked", false);
        	$("#input_price").addClass('required number');
        	//$("#special_err_price").show();
        }
        function blank_text(){
        	$("#input_price").removeClass('error required number');
        	$("#special_err_price").html('');
        	$("#input_price").val('');
        }
        function get_city(id){
        	var name = id;
        	$.post("<?php echo base_url(); ?>property/city_search_via_id",{name: name, lang: '<?php echo $_COOKIE['lang']; ?>'},function(result){
				$('#city').html(result);
			});
        }
        ///counter sort description/////////////
        function countChar(val) {
        	var len = val.value.length;
        	if (len >= 1000) {
        		val.value = val.value.substring(0, 1000);
        		$('#charNum').text(0);
        	} else {
        		$('#charNum').text(1000 - len);
        	}
        };
        function click_upload() {
        	$('#upload_csv').show();
        	$('#add_newproperty_box').hide();
        	$('#msg_box_csv').show();
        	$('#msg_box_general').hide();
        }
        function add_property() {
        	$('#upload_csv').hide();
        	$('#add_newproperty_box').show();
        	$('#msg_box_general').show();
        	$('#msg_box_csv').hide();
        }
		function frmSubmit(submitBtnVal){
			$('#register input[name="btnSubmit"]').val(submitBtnVal);
			document.getElementById("register").submit();
		}
		function loaderCall(submitBtnVal){
			$("#regboxId").hide();
        	$("#form_submit_loading_area").show();
        	setTimeout(function(){
				frmSubmit(submitBtnVal);
        	}, 5000);
		}
        /*
        $('#save_draft').click(function(){
        		$("#register").validate({
           ignore: ".ignore"
        })
        		//document.getElementById("register").submit();
         });*/
		$(document).ready(function(){
            jQuery.validator.addMethod("input_price", function(value, element) {
              return this.optional( element ) || value != '0,00';
            }, '<?php echo $this->lang->line('add_property_form_price_min');?>');
			$('#save_draft').click(function(draftClicked){
				var contract = $('#contract').val();
				var category_id = $('#category').val();
                var price = $('#input_price').val();
				if (contract == ''){
					alert('<?php echo $this->lang->line('add_property_form_select_contract_type');?>');
					$('#contract').focus();
					return false;
				}
				if (category_id == '0'){
					alert('<?php echo $this->lang->line('add_property_form_select_a_category');?>');
					$('#category').focus();
					return false;
				}
				if (category_id == 'BUS'){
					var sub_cat = $('#sub_category').val();
					if (sub_cat == '') {
						alert('<?php echo $this->lang->line('add_property_form_select_a_sub_category');?>');
						$('#sub_category').focus();
						return false;
					}
				}
                if(price <= 0)
                {
                    alert('<?php echo $this->lang->line('property_prive_validate_msg');?>');
                    $('#input_price').focus();
                    return false;
                }
				loaderCall('Save Draft');
				draftClicked.preventDefault();
				//document.getElementById("register").submit();
            });
			$("#register").validate({
				rules: {
					zip: {digits: true},
                    url: {youtube: "#url"},
                    input_price: {
                        required: true,
                        input_price: true,
                    }
				},
				messages: {
					zip: {digits: "<?php echo $this->lang->line('add_property_form_please_provide_a_digits_only');?>"},
                    url: {alphabetsnspace: "<?php echo $this->lang->line('add_property_form_please_enter_valid_url');?>"},
                    input_price: {
                        required: "<?php echo $this->lang->line('inbox_this_field_is_required');?>",
                        number: "<?php echo $this->lang->line('add_property_form_please_provide_a_digits_only');?>",
                        //input_price: ""
                    }
				},submitHandler: function (form){
					$("#regboxId").hide();
					$("#form_submit_loading_area").show();
					setTimeout(function(){
						$('#register input[name="btnSubmit"]').val('Submit');
						document.getElementById("register").submit();
					}, 5000);
					return false;
				}
			});
		});
	</script>