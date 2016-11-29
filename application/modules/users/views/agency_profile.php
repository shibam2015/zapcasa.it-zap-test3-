<?php $this->load->view("_include/meta"); ?>
<style>
/*jquery error styles */
div.error{ float: left; color: red; padding-right: .5em;  }
label.error { float: left; color: red; padding-right: .5em;font-size:13px; }
</style>
<script type="text/javascript">
$(document).ready(function(){    		
	$('#nav li').hover(function(){
		$('ul', this).slideDown(200);
		$(this).children('a:first').addClass("hov");
	}, function() {
		$('ul', this).slideUp(100);
		$(this).children('a:first').removeClass("hov");		
	});
    $.validator.addMethod("alphabetsnspace", function(value, element) {
		return this.optional(element) || /((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%?"^!]).{8,20})/.test(value);
    });
	$.validator.addMethod("alphanumeric", function(value, element) {
		return this.optional(element) || /^\w+$/i.test(value);
	});
	$("#register").validate({
        rules: {
            first_name: {
				required: true,
				maxlength: 25
			},last_name:{
				required: true,
				maxlength: 50
			},password: {
                required: true,
    			alphabetsnspace: true,
                minlength: 8
            },pass2: {
                required: true,
                minlength: 8,
                equalTo: "#pass"
            },zip: {
				required: true,
				digits: true
			},contact_ph_no: {			
				required: true,
				//phonenumeric: true,
				minlength: 7,
				maxlength: 15			
			},phone_1: {			
				required: true,
				//phonenumeric: true,
				minlength: 7,
				maxlength: 15			
			},phone_2: {
				minlength: 7,
				maxlength: 15			
			},fax_no:{			
				minlength: 7,
				maxlength: 15			
			},user_name: {
				required: true,
				alphanumeric: true,
				minlength: 5,
				maxlength: 100
			},vat_number:{
				required: true,
				minlength: 7,
				maxlength: 16
			}
        },messages: {
            password: {
                required: "<?php echo $this->lang->line('agency_profile_please_provide_a_password');?>",
    			alphabetsnspace: "<?php echo $this->lang->line('agency_profile_your_password_must_be_atleast');?> !  ? $ % ^ & ",
                minlength: "<?php echo $this->lang->line('agency_profile_your_password_must_be_atleast_8_character_long');?>"
            },pass2: {
                required: "<?php echo $this->lang->line('agency_profile_please_provide_a_password');?>",
                minlength: "<?php echo $this->lang->line('agency_profile_your_password_must_be_atleast_8_character_long');?>",
                equalTo: "<?php echo $this->lang->line('agency_profile_please_enter_the_same_password_as_above');?>"
            },zip:{    				
				digits: "<?php echo $this->lang->line('agency_profile_only_numbers_are_applicable');?>"
    		}
        },onfocusout: function (element, event){
			if (element.id === "street_address"){
				this.element(element);
			}else if (element.id === "contact_ph_no"){
				this.element(element);
			}else if (element.id === "phone_1"){
				this.element(element);
			}else if (element.id === "user_name"){
				this.element(element);
			}
		}
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
            <h2><?php echo $this->lang->line('agency_profile_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('agency_profile_jobs');?></font> <?php echo $this->lang->line('agency_profile_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('agency_profile_housing');?></font></h2>
        </div>
    </div>
    <!----- login pop up start  ---------------------->
    <?php
        $this->load->view("_include/login_user"); 
        ?>          
    <!----- login pop up end ---------------------->
    <!------ body part -------------->
    <div class="main">
        <div id="breadcrumb" class="fk-lbreadbcrumb newvd">
            <?php
			if(isset($tab_icon) && $tab_icon==1){
			?>
            <span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('agency_profile_home');?></a></span> > <span><?php echo $this->lang->line('agency_profile_my_account');?></span>
            <?php
			}else{
			?>
            <span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('agency_profile_home');?></a></span> >  
            <span><a href="<?php echo base_url();?>users/common_reg"><?php echo $this->lang->line('agency_profile_register');?></a></span> >
            <span><a href="<?php echo base_url();?>users/reg_agency"><?php echo $this->lang->line('agency_profile_sign_up_as_agency');?></a></span> >
            <span><?php echo $this->lang->line('agency_profile_summary_screen_for_agency');?></span>
            <?php
			}
			?>   
        </div>
        <div style="margin-top:10px;">
            <ul class="listing-tabs">
                <li class="active"><a href="javascript:void(0);"><?php echo $this->lang->line('agency_profile_listing_tab_my_account');?></a></li>
                <li><a href="<?php echo base_url();?>users/change_password"><?php echo $this->lang->line('agency_profile_listing_tab_change_password');?></a></li>
                <li><a href="<?php echo base_url();?>users/my_preference"><?php echo $this->lang->line('agency_profile_listing_tab_my_preferences');?></a></li>
                <li class="delete-tab"><a href="<?php echo base_url();?>users/delete_account"><?php echo $this->lang->line('agency_profile_listing_tab_delete_account');?></a></li>
            </ul>
        </div>
        <!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
        <div class="registercomn_box">
            <!--<div class="arrow_box error_message" style="color:#ED6B1F;">Almost Done! Check the information before sending the form or to modify them if wrong</div>
                <div class="charater_icon"><img src="<?php //echo base_url();?>assets/images/signup_agency_edit_icon.jpg" alt=""></div>-->
            <?php 
			$new_arr=$user_detail[0];
			//print_r($new_arr);
			?>
            <div>
			<?php
			if($this->session->flashdata('success')!=''){
			?>
			<div class="success" id="successDIV" ><?php echo $this->session->flashdata('success'); ?></div>
			<?php
			}
			?>
            </div>
            <?php
			$attributes = array('class' => 'register-form', 'id' => 'register');
			echo form_open_multipart('users/update_agency_reg', $attributes);		
			?>
            <table width="100%" cellpadding="0" cellspacing="0" class="form-edit">
                <tr>
                    <td colspan="3" style="text-align:center; color:#F18D52;"><?php echo $this->lang->line('agency_profile_company_informations');?></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:center; color:#000"><?php echo $this->lang->line('agency_profile_company');?></td>
                </tr>
                <tr>
                    <td style="width:45%;"><?php echo $this->lang->line('agency_profile_company_name');?></td>
                    <td width="5%"></td>
                    <td class="usernme">
                        <span class="shown1"><?php echo $new_arr['company_name'];?></span>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $this->lang->line('agency_profile_company_business_name');?></td>
                    <td width="5%"></td>
                    <td class="usernme">
                        <span class="shown1"><?php echo $new_arr['business_name'];?></span>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $this->lang->line('agency_profile_company_vat_no');?></td>
                    <td width="5%"></td>
                    <td class="usernme">
                        <span class="shown1"><?php echo $new_arr['vat_number'];?></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:center; color:#000"><?php echo $this->lang->line('agency_profile_owner');?></td>
                </tr>
                <tr>
                    <td>
						<font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font>
						<?php echo $this->lang->line('agency_profile_owner_first_name');?>
					</td>
                    <td width="5%"></td>
                    <td class="usernme">
                        <span class="shown"><?php echo $new_arr['first_name']; ?></span>
                        <label for="first_name" generated="true" class="error" style="display:none;font-weight:normal;"></label>
                        <span class="edit_shown" style="display:none;">
                        <input type="text" class="required" name="first_name" value="<?php echo $new_arr['first_name'];?>">
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
						<font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font>
						<?php echo $this->lang->line('agency_profile_owner_last_name');?>
					</td>
                    <td width="5%"></td>
                    <td class="usernme">
                        <span class="shown"><?php echo $new_arr['last_name']; ?></span>
                        <label for="last_name" generated="true" class="error" style="display:none;font-weight:normal;"></label>
                        <span class="edit_shown" style="display:none;">
                        <input type="text" class="required" name="last_name" value="<?php echo $new_arr['last_name'];?>">
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
						<font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font>
						<?php echo $this->lang->line('agency_profile_owner_direct_phone');?>
					</td>
                    <td width="5%"></td>
                    <td class="usernme">
                        <span class="shown"><?php echo $new_arr['contact_ph_no']; ?></span>
                        <label for="contact_ph_no" generated="true" class="error" style="display:none;font-weight:normal;"></label>
                        <span class="edit_shown" style="display:none;">
							<input type="text" class="required" id="contact_ph_no" name="contact_ph_no" value="<?php echo $new_arr['contact_ph_no'];?>">
                        </span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:center; color:#F18D52">
						<?php echo $this->lang->line('agency_profile_owner_contact_informations');?>
					</td>
                </tr>
                <tr>
                    <td>
						<font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font>
						<?php echo $this->lang->line('agency_profile_owner_province');?>
					</td>
                    <td width="5%"></td>
                    <td class="usernme">
                        <span class="shown">
                        <?php
						if(!strpos($new_arr['province'], "'")===false){
							$ShowingProvinceName=get_perticular_field_value('zc_region_master',($_COOKIE['lang']=='it'?'province_name_it':'province_name')," and (`province_name` = '".str_replace("'","\\\''",stripslashes($new_arr['province']))."' OR `province_name_it` = '".str_replace("'","\\\''",stripslashes($new_arr['province']))."') group by province_code");
							$st_name1=get_perticular_field_value('zc_region_master','province_code'," and (`province_name` = '".str_replace("'","\\\''",stripslashes($new_arr['province']))."' OR `province_name_it` = '".str_replace("'","\\\''",stripslashes($new_arr['province']))."') group by province_code");
						}else{
							$ShowingProvinceName=get_perticular_field_value('zc_region_master',($_COOKIE['lang']=='it'?'province_name_it':'province_name')," and (`province_name` = '".$new_arr['province']."' OR `province_name_it` = '".$new_arr['province']."') group by province_code");
							$st_name1=get_perticular_field_value('zc_region_master','province_code'," and (`province_name` = '".$new_arr['province']."' OR `province_name_it` = '".$new_arr['province']."') group by province_code");
						}					
						?>
                        <?php echo stripslashes($ShowingProvinceName).'-'.$st_name1; ?>
                        </span>
                        <span class="edit_shown" style="display:none;">
                            <label for="province" generated="true" class="error" style="display:none;font-weight:normal;"></label>
                            <select name="province" id="province"  class="required" onChange="return get_city(this.value,'<?php echo $_COOKIE['lang'];?>');">
                                <option value=""><?php echo $this->lang->line('agency_profile_please_select_your_province');?></option>
                                <?php						
								foreach($provinces as $key=>$val){
									if($_COOKIE['lang']=="it"){
										if(!strpos($val, "'")===false){
											$st_name=get_perticular_field_value('zc_region_master','province_code'," and province_name_it = '".str_replace("'","\''",$val)."' group by province_code");
										}else{
											$st_name=get_perticular_field_value('zc_region_master','province_code'," and province_name_it = '".$val."' group by province_code");
										}								
									}else{
										if(!strpos($val, "'")===false){
											$st_name=get_perticular_field_value('zc_region_master','province_code'," and province_name = '".str_replace("'","\''",$val)."' group by province_code");
										}else{
											$st_name=get_perticular_field_value('zc_region_master','province_code'," and province_name = '".$val."' group by province_code");
										}
									}
								?>
                                <option value="<?php echo $val;?>" <?php echo($val==$ShowingProvinceName?'selected':''); ?>>
                                    <?php echo stripslashes($val); ?><?php echo '-'.$st_name;?>
                                </option>
                                <?php
								}
								?>
                            </select>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
						<font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font>
						<?php echo $this->lang->line('agency_profile_city_of_residence'); ?>
					</td>
                    <td width="5%"></td>
                    <td class="usernme">
                        <?php
						if(!strpos($new_arr['province'], "'")===false){
							$ShowingCityName=get_perticular_field_value('zc_region_master',($_COOKIE['lang']=='it'?'city_it':'city')," and (`city_it` = '".str_replace("'","\\\''",stripslashes($new_arr['city']))."' OR `city` = '".str_replace("'","\\\''",stripslashes($new_arr['city']))."')");
						}else{
							$ShowingCityName=get_perticular_field_value('zc_region_master',($_COOKIE['lang']=='it'?'city_it':'city')," and (`city` = '".$new_arr['city']."' OR `city_it` = '".$new_arr['city']."')");
						}
						?>
                        <span class="shown"><?php echo stripslashes($ShowingCityName); ?></span>
                        <span class="edit_shown" style="display:none;">
                            <label for="city" generated="true" class="error" style="display:none;font-weight:normal;"></label>
                            <select name="city" id="city"  class="required">
								<option value=""><?php echo $this->lang->line('agency_profile_please_select_your_province_first');?></option>
								<?php
								$cityFieldNm = ($_COOKIE['lang']=='english'?'city':'city_it');
								if(!strpos($new_arr['province'], "'")===false){
									$ct_nameNm=get_perticular_field_value('zc_region_master',$cityFieldNm," and (`city` = '".mysql_real_escape_string($new_arr['city'])."' OR `city_it` = '".mysql_real_escape_string($new_arr['city'])."')");
								}else{
									$ct_nameNm=get_perticular_field_value('zc_region_master',$cityFieldNm," and (`city` = '".mysql_real_escape_string($new_arr['city'])."' OR `city_it` = '".mysql_real_escape_string($new_arr['city'])."')");
								}						
								foreach($city as $key=>$val){
								?>
								<option value="<?php echo $val;?>" <?php echo(stripslashes($val)==$new_arr['city']?'selected':($val==$ct_nameNm?'selected':'')); ?>>
									<?php echo stripslashes($val); ?>
								</option>
								<?php
								}
								?>
							</select>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
						<font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font>
						<?php echo $this->lang->line('agency_profile_owner_address');?>
					</td>
                    <td width="5%"></td>
                    <td class="usernme">
                        <span class="shown">
							<?php if($new_arr['street_address']!=''){echo $new_arr['street_address'].',';} ?>
							<?php if($new_arr['street_no']!=''){echo $new_arr['street_no'].',';} ?>
							<?php if($new_arr['zip']!=''){echo $new_arr['zip'];} ?>
                        </span>
                        <span class="edit_shown" style="display:none;">
                        <label for="street_address" generated="true" class="error" style="display:none;font-weight:normal;"></label>
                        <input placeholder="<?php echo $this->lang->line('agency_profile_owner_street_address_field');?>" type="text" name="street_address" class="required" value="<?php echo $new_arr['street_address'];?>" >
                        <label for="street_no" generated="true" class="error" style="display:none;font-weight:normal;"></label>
                        <input placeholder="<?php echo $this->lang->line('agency_profile_owner_street_no_field');?>" type="text" class="required" name="street_no" value="<?php echo $new_arr['street_no'];?>" >
                        <label for="zip" generated="true" class="error" style="display:none;font-weight:normal;"></label>
                        <input  placeholder="<?php echo $this->lang->line('agency_profile_owner_zip_code_field');?>" type="text" class="required" name="zip" value="<?php echo $new_arr['zip'];?>" >
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
						<font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font>
						<?php echo $this->lang->line('agency_profile_landline_phone');?>
					</td>
                    <td width="5%"></td>
                    <td class="usernme">
                        <span class="shown"><?php echo $new_arr['phone_1']; ?></span>
						<label for="phone_1" generated="true" class="error" style="display:none;font-weight:normal;"></label>
                        <span class="edit_shown" style="display:none;">                        
							<input type="text" class="required" id="phone_1" name="phone_1" value="<?php echo $new_arr['phone_1'];?>">
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $this->lang->line('agency_profile_mobile');?></td>
                    <td width="5%"></td>
                    <td class="usernme">
                        <span class="shown"><?php echo $new_arr['phone_2']; ?></span>
						<label for="phone_2" generated="true" class="error" style="font-weight:normal;"></label>
                        <span class="edit_shown" style="display:none;">
							<input type="text" name="phone_2" id="phone_2" value="<?php echo $new_arr['phone_2'];?>">
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $this->lang->line('agency_profile_company_fax');?></td>
                    <td width="5%"></td>
                    <td class="usernme">
                        <span class="shown"><?php echo $new_arr['fax_no']; ?></span>
						<label for="fax_no" generated="true" class="error" style="font-weight:normal;"></label>
                        <span class="edit_shown" style="display:none;">
							<input type="text" name="fax_no" id="fax_no" value="<?php echo $new_arr['fax_no'];?>">
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $this->lang->line('agency_profile_company_website');?></td>
                    <td width="5%"></td>
                    <td class="usernme">
                        <span class="shown">
                        <?php echo $new_arr['website']; ?>
                        </span>
                        <span class="edit_shown" style="display:none;">
                        <input type="text" name="website" value="<?php echo $new_arr['website'];?>">
                        </span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:center; color:#F18D52"><?php echo $this->lang->line('agency_profile_account_information');?></td>
                </tr>
                <tr>
                    <td><?php echo $this->lang->line('agency_profile_account_information_user_name');?></td>
                    <td width="5%"></td>
                    <td class="usernme">
                        <span class="shown1">
                        <?php echo $new_arr['user_name']; ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
						<font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font>
						<?php echo $this->lang->line('agency_profile_account_information_email_address');?>
					</td>
                    <td width="5%"></td>
                    <td class="usernme">
                        <span class="shown">
                        <?php echo $new_arr['email_id']; ?>
                        </span>
                        <span class="edit_shown" style="display:none;">
                            <div class="user_msg" id="message" style="display:none;"></div>
                            <label for="emailss" generated="true" class="error" style="display:none;font-weight:normal;"></label>
                            <input type="text" name="email" value="<?php echo $new_arr['email_id']; ?>" class="required email" id="emailss" onKeyUp="document.getElementById('message').style.display='none'" >
                        </span>
                    </td>
                </tr>
                <tr style="background-color:#3D8AC1;">
                    <td colspan="3" style="text-align:center;font-size:12px;color:#fff;">
                        <?php echo $this->lang->line('agency_profile_customize_your_details');?>
                    </td>
                </tr>
                <?php
				if(isset($tab_icon) && $tab_icon==1){
				?>
                <tr class="unshown_extra">
                    <td><?php echo $this->lang->line('agency_profile_about_yourself');?></td>
                    <td width="5%"></td>
                    <td class="usernme">
                        <span class="shown">
                        <?php
						if($new_arr['about_me']!=''){
							echo $new_arr['about_me'];
						}else{
							echo $this->lang->line('agency_profile_add_a_description');
						}
						?>
                        </span>
                        <textarea class="edit_shown" style="display:none;max-width:251px;min-width:251px;" name="about_me"><?php echo $new_arr['about_me']?></textarea>
                    </td>
                </tr>
                <tr class="unshown_extra">
                    <td><?php echo $this->lang->line('agency_profile_your_picture');?></td>
                    <td width="5%"></td>
                    <td class="usernme">
                        <span class="shown">
                        <?php 
						if($new_arr['file_1']==''){
						?>
                        <img src="<?php echo  base_url();?>assets/images/no_prof.png" alt="<?php echo $this->lang->line('agency_profile_no_image_found');?>" title="<?php echo $this->lang->line('agency_profile_no_image_found');?>"/>
                        <?php
						}else{
						?>
                        <img src="<?php echo  base_url();?>assets/uploads/thumb_92_82/<?php echo $new_arr['file_1']; ?>" style="-webkit-border-radius:7px;-moz-border-radius:7px;-o-border-radius:7px;border-radius:7px;border:1px solid #3d8ac1;padding:5px;background:#ffffff;"/>
                        <a href="<?php echo base_url();?>users/remove1" onClick="return confirm('<?php echo $this->lang->line('agency_profile_confirm_delete_image');?>')"><?php echo $this->lang->line('agency_profile_remove');?></a>
                        <?php
						}
						 ?>      
                        </span>
                        <input type="file" name="user_file_1" class="edit_shown" style="display:none;">
                    </td>
                </tr>
                <tr class="unshown_extra">
                    <td><?php echo $this->lang->line('agency_profile_image_for_your_detail_page');?></td>
                    <td width="5%"></td>
                    <td class="usernme">
                        <span class="shown">
                        <?php 
						if($new_arr['file_2']==''){
						?>
                        <img src="<?php echo base_url();?>assets/images/<?php echo $this->lang->line('advertise_details_no_proimg_filename');?>" alt="<?php echo $this->lang->line('agency_profile_no_image_found');?>" style="width:250px;height:250px;-webkit-border-radius:7px;-moz-border-radius:7px;-o-border-radius:7px;border-radius:7px;;border:1px solid #3d8ac1;padding:5px;background:#ffffff;" title="<?php echo $this->lang->line('agency_profile_no_image_found');?>"/>
                        <?php
						}else{
						?>
                        <img src="<?php echo  base_url();?>assets/uploads/thumb_92_82/<?php echo $new_arr['file_2']; ?>" style="max-width:250px;max-height:250px;-webkit-border-radius:7px;-moz-border-radius:7px;-o-border-radius:7px;border-radius:7px;border:1px solid #3d8ac1;padding:5px;background:#ffffff;"/>
                        <a href="<?php echo base_url();?>users/remove2" onClick="return confirm('<?php echo $this->lang->line('agency_profile_confirm_delete_image');?>')"><?php echo $this->lang->line('agency_profile_remove');?></a>
                        <?php
						}
						 ?>      
                        </span>
                        <input type="file" name="user_file_2" class="edit_shown" style="display:none;">
                    </td>
                </tr>
                <?php
				}
				?> 
                
                <tr class="unshown_extra">
                    <td>Company Location</td>
                    <td width="5%"></td>
                    <td class="usernme">
                        <span class="shown">
                        <?php echo $new_arr['location']; ?>
                        </span>
                        <span class="edit_shown" style="display:none;">
                            <a class="locate" href="javascript:void(0);" onclick="getMyLocation2();" title="<?php echo $this->lang->line('home_page_search_near_me'); ?>" style="float:left;">
                                <img src="<?php echo base_url();?>assets/images/location_icon.png" alt="<?php echo $this->lang->line('home_page_search_near_me'); ?>" style="width:28px; margin:5px;">
                            </a>
                            <input type="text" name="location" value="<?php echo $new_arr['location']; ?>" class="required location" id="location" style="width:76%; float:left;">
                            <!-- <div id="suggesstion-box2" style='overflow:auto;max-height:300px;position:absolute;z-index:1;width:260px;'> -->
                            </div>
                        </span>
                    </td>
                </tr>

            </table>
            <div style="margin:20px 0; margin-left:42%;">
			<?php
			if(isset($tab_icon) && $tab_icon==1){
				?>
                <!--<input type="submit" class="mainbt" value="Send">-->
                <input type="button" class="mainbt" value="<?php echo $this->lang->line('agency_profile_button_edit');?>" onClick="return edit_me();" id="shown"> 
                <input type="submit" class="mainbt" value="<?php echo $this->lang->line('agency_profile_button_update');?>" id="edit_shown" style="display:none;"> 
                <input type="button" class="mainbt" value="<?php echo $this->lang->line('agency_profile_button_cancel');?>" id="edit_shown_cancel" style="display:none;" onClick="window.location.replace('my_account')">
                <?php
			}
			?>         
            </div>
            <?php echo form_close();?>
            <div class="impt_message">
				<img src="<?php echo base_url();?>assets/images/information_icon.png" alt="">
				<?php echo $this->lang->line('agency_profile_the_information_marked_with');?> (<font style="color:#ED6B1F">*</font>) <?php echo $this->lang->line('agency_profile_is_no_longer_be_modified');?>
			</div>
        </div>
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
        ShowMyLocation(position.coords.latitude, position.coords.longitude, 'location');
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
	function edit_me(){
		$(".shown").hide();
		$(".edit_shown").show();
		$(".unshown_extra").show();
		$("#shown").hide();
		$("#edit_shown_").hide();
		$("#edit_shown").show();
		$("#edit_shown_cancel").show();
	}
	$(window).load(function() {
		$('#datepicker').datepicker({
			dateFormat: 'dd-mm-yy',
			changeYear: true,
			yearRange: "-100:+0",
			onClose: function() {
				$(this).valid();
			}
		});
	});
	function get_city(id, data) {
		var name = id;
		//alert(name);
		var lang = data;
		//alert(lang);
		$.post("<?php echo base_url(); ?>users/city_search", {
			name: name,
			lang: lang
		}, function(result) {
			$('#city').html('<option value=""><?php echo $this->lang->line('agency_profile_please_select_your_province_first');?></option>' + result);
		});
	}
	$(function(){
		$("#contact_ph_no").blur(function() {
			$("#contact_ph_message").hide();
			$("#contact_ph_message").html("");
			//alert("hello");	
			var a = $("#contact_ph_no").val();
			if (a.length > 6) {
				var filter = /^[0-9+]+$/;
				if (filter.test(a)) {
					//alert("ok");
					return true;
				} else {
					$("#contact_ph_message").show();
					//alert("No");
					$("#contact_ph_message").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('reg_owner_phone_required_informations');?></span>");
					//$('input[type="submit"]').attr('disabled','disabled');
					$("#contact_ph_no").val('');
				   // $("#contact_ph_no").focus();
					return false;
				}
				
			}
		});
	});
	$(function(){
		$("#phone_1").blur(function() {
			$("#ph_message").hide();
			$("#ph_message").html("");
			//alert("hello");	
			var a = $("#phone_1").val();
			if (a.length > 6) {
				var filter = /^[0-9+]+$/;
				if (filter.test(a)) {
					//alert("ok");
					return true;
				} else {
					$("#ph_message").show();
					//alert("No");
					$("#ph_message").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('reg_owner_phone_required_informations');?></span>");
					//$('input[type="submit"]').attr('disabled','disabled');
					$("#phone_1").val('');
					//$("#phone_1").focus();
					return false;
				}
			}
		});
	});
	$(function(){
		$("#phone_2").blur(function() {
			$("#ph2_message").hide();
			$("#ph2_message").html("");
			//alert("hello");	
			var a = $("#phone_2").val();
			if (a.length > 6) {
				var filter = /^[0-9+]+$/;
				if (filter.test(a)) {
					//alert("ok");
					return true;
				} else {
					$("#ph2_message").show();
					//alert("No");
					$("#ph2_message").html("<span style='color:Red;font-weight:normal;'><?php //echo $this->lang->line('reg_owner_phone_required_informations');?></span>");
					//$('input[type="submit"]').attr('disabled','disabled');
					$("#phone_2").val('');
					//$("#phone_2").focus();
					return false;
				}
			}
		});
	});
	$(function(){
		$("#fax_no").blur(function() {
			$("#fax_message").hide();
			$("#fax_message").html("");
			//alert("hello");	
			var a = $("#fax_no").val();
			if (a.length > 6) {
				var filter = /^[0-9+]+$/;
				if (filter.test(a)) {
					//alert("ok");
					return true;
				} else {
					$("#fax_message").show();
					//alert("No");
					$("#fax_message").html("<span style='color:Red;font-weight:normal;'><?php //echo $this->lang->line('reg_owner_phone_required_informations');?></span>");
					//$('input[type="submit"]').attr('disabled','disabled');
					$("#fax_no").val('');
					//$("#fax_no").focus();
					return false;
				}
			}
		});
	});
	$(function() {
		$("#emailss").blur(function() {
			var email = $("#emailss").val();
			$("#message").html("");
			$("#message").hide();
			if (email == "" || email == null) {
				return false;
			}
			$.ajax({
				type: "post",
				url: "<?php echo base_url();?>users/check_email_avail_after_reg",
				data: {
					email: email
				},
				async: false,
				success: function(data) {
					$("#message").show();
					if (data == 0 || data == 3) {
						//$("#message").html("<span style='color:green;font-weight:normal;'><?php echo $this->lang->line('owner_profile_email_id_available');?></span>");
						//$('input[type="submit"]').removeAttr('disabled');
					} else if (data == 1) {
						$("#message").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('owner_profile_email_id_already_taken');?></span>");
						//$('input[type="submit"]').attr('disabled','disabled');
						//return false;
					} else {
						$("#message").hide();
					}
				}
			});
		});
	});
	$(document).ready(function() {
		setTimeout(function() {
			$("#successDIV").hide();
		}, 4000);
	});        
    </script>
    <!------ footer part ------------->
    <?php $this->load->view("_include/footer");?>
