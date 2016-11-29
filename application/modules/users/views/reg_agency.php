<?php $this->load->view("inc/header");?>
<style>
/*jquery error styles */
div.error{ float: left; color: red; padding-right: .5em;  }
label.error { float: left; color: red; padding-right: .5em;  }
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
         return this.optional(element) || /((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%?"^!-]).{8,20})/.test(value);
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
				maxlength: 15,
				digits: true
			},contact_ph_no: {
				required: true,
				//phonenumeric: true,
				minlength: 7,
				maxlength: 15			
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
		},messages:{
			password:{
				required: "<?php echo $this->lang->line('reg_agency_please_provide_a_password');?>",
				alphabetsnspace: "<?php echo $this->lang->line('reg_agency_your_password_must_be_atleast');?> ! ? $ % ^ - @ + _ .",
				minlength: "<?php echo $this->lang->line('reg_agency_your_password_must_be_atleast_8_character_long');?>"
			},pass2: {
				required: "<?php echo $this->lang->line('reg_agency_please_provide_a_password');?>",
				minlength: "<?php echo $this->lang->line('reg_agency_your_password_must_be_atleast_8_character_long');?>",
				equalTo: "<?php echo $this->lang->line('reg_agency_please_enter_the_same_password_as_above');?>"
			},user_name: {
				alphanumeric: "<?php echo $this->lang->line('agency_edit_user_name_atleast'); ?>"
			}
		},onfocusout: function (element, event){
			if (element.id === "street_address"){
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
<!------ banner part ------------->
<div class="insidepage_banner">
	<div class="main">
    	<h2><?php echo $this->lang->line('reg_user_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('reg_user_jobs');?></font> <?php echo $this->lang->line('reg_user_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('reg_user_housing');?></font></h2>
    </div>
</div>
<!------ body part ------------->
<div class="main">
	<div id="breadcrumb" class="fk-lbreadbcrumb newvd">
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('reg_agency_home');?></a></span> >  
        <span><a href="<?php echo base_url();?>users/common_reg"><?php echo $this->lang->line('reg_agency_register');?></a></span> >
        <span><?php echo $this->lang->line('reg_agency_sign_up_as_agency');?></span>
    </div>    
	<!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
	<div class="registercomn_box">
		<div class="arrow_box error_message" style="color:#ED6B1F;"><?php echo $this->lang->line('reg_agency_hey_greate_choice');?></div>
        <div class="charater_icon">
			<img src="<?php echo base_url();?>assets/images/add_newproperty_icon.jpg" alt="">
		</div>
		<div class="owner_registbox">
		<?php
		$new_arr=$this->session->all_userdata();
		$attributes = array('class' => 'register-form', 'id' => 'register');
		echo form_open_multipart('users/do_agency_reg', $attributes);		
		?>
			<h2><?php echo $this->lang->line('reg_agency_company_informations');?></h2>
			<div>
				<h3><?php echo $this->lang->line('reg_agency_company');?></h3>
			</div>
			<div>
				<label>
					<span><?php echo $this->lang->line('reg_agency_company_name');?> <font>(<?php echo $this->lang->line('reg_agency_required');?>)</font></span>
					<div class="comp_name_msg" id="comp_name_msg_id" style="display:none;"></div>
					<label class="error" for="comp_name" generated="true" style="display:none;"></label>
					<?php echo form_error('company_name', '<div class="error">', '</div>'); ?>
					<input placeholder="<?php echo $this->lang->line('reg_agency_company_name_field');?>" type="text" name="company_name" id="comp_name" class="required" value="<?php echo set_value('company_name');?>" maxlength="250">  
				</label>
			</div>
			<div>  
				<div class="business-name">
					<div class="buss_name_msg" id="buss_name_msg_id" style="display:none;"></div>
					<label class="error" for="buss_name" generated="true" style="display:none;"></label>
					<?php echo form_error('business_name', '<div class="error">', '</div>'); ?>
					<input placeholder="<?php echo $this->lang->line('reg_agency_company_business_name_field');?>" type="text" id="buss_name" name="business_name" class="midium required" value="<?php echo set_value('business_name');?>" maxlength="250"> 
				 </div>
				 <div class="business-name">   
					<div class="user_msg" id="user_message_vat" style="display:none;"></div>
					<label class="error" for="vat_no" generated="true" style="display:none;"></label>
					<?php echo form_error('vat_number', '<div class="error">', '</div>'); ?>
					<input placeholder="<?php echo $this->lang->line('reg_agency_company_vat_no_field');?>"  type="text" id="vat_no" name="vat_number" maxlength="16" class="midium_last required" value="<?php echo set_value('vat_number');?>" id="" onKeyUp="document.getElementById('user_message_vat').style.display='none'" style="width:84%;">
				</div>
			</div>
			<div>
				<h3><?php echo $this->lang->line('reg_agency_owner');?></h3>
				<p><?php echo $this->lang->line('reg_agency_owner_note_this_informations_will_not_be_published');?></p>
			</div>
			<div style="margin-bottom:10px; float:left; width:100%;">
				<div class="business-name">   
					<label class="error" for="first_name" generated="true" style="display:none;"></label>
					<?php echo form_error('first_name', '<div class="error">', '</div>'); ?>
					<input placeholder="<?php echo $this->lang->line('reg_agency_owner_first_name');?>" name="first_name" maxlength="25" type="text" class="midium required" value="<?php echo set_value('first_name');?>"  >
				</div> 
				<div class="business-name">
					<label class="error" for="last_name" generated="true" style="display:none;"></label>
					<?php echo form_error('last_name', '<div class="error">', '</div>'); ?>
					<input placeholder="<?php echo $this->lang->line('reg_agency_owner_last_name');?>" name="last_name" maxlength="50" type="text" class="midium_last required" value="<?php echo set_value('last_name');?>"  style="width:84%;" >
				</div>
			</div>
			<div style="margin-bottom:10px; float:left; width:100%;">
				<label>
					<span><font>(<?php echo $this->lang->line('reg_agency_required');?>)</font>[xxxxxxxxxxxxxxx or +xxxxxxxxxxxxxx]</span>
					<label class="error" for="contact_ph_no" id="contact_ph_message" generated="true" style="display:none;"></label>
					<?php echo form_error('contact_ph_no', '<div class="error">', '</div>'); ?>
					<span id="spnPhoneStatus"></span>
					<label>    
						<input placeholder="<?php echo $this->lang->line('reg_agency_owner_direct_phone');?>" name="contact_ph_no" type="text" class="required" value="<?php echo set_value('contact_ph_no');?>"  id="contact_ph_no" maxlength="15"> 
					</label>
				</label>
			</div>
			<h2>
				<?php echo $this->lang->line('reg_agency_owner_contact_informations');?>
				<font style="text-transform:none; font-size:14px;"> (<?php echo $this->lang->line('reg_agency_owner_of_the_agency');?>)</font>
			</h2>
			<div style="float:left; width:100%;">				
				<label>
					<span><?php echo $this->lang->line('reg_agency_owner_province');?> <font>(<?php echo $this->lang->line('reg_agency_required');?>)</font></span>
					<label class="error" for="province" generated="true"></label>
					<?php echo form_error('province', '<div class="error">', '</div>'); ?>
					<select name="province" id="province"  class="required" onChange="return get_city(this.value,'<?php echo $_COOKIE['lang'];?>');">
						<option value=""><?php echo $this->lang->line('reg_agency_please_select_your_province');?></option>
						<?php						
						foreach($provinces as $key=>$val){							
							if($_COOKIE['lang']=="it"){
								if(!strpos($val, "'")===false){
									$st_name=get_perticular_field_value('zc_region_master','province_code'," and province_name_it = '".str_replace("'","\''",$val)."' group by province_code");
								}else{
									$st_name=get_perticular_field_value('zc_region_master','province_code'," and province_name_it LIKE '%".$val."%' group by province_code");
								}								
							}else{
								if(!strpos($val, "'")===false){
									$st_name=get_perticular_field_value('zc_region_master','province_code'," and province_name = '".str_replace("'","\''",$val)."' group by province_code");
								}else{
									$st_name=get_perticular_field_value('zc_region_master','province_code'," and province_name LIKE '%".$val."%' group by province_code");
								}
							}
							?>
							<option value="<?php echo $val;?>" <?php if($val==set_value('province')){?> selected <?php }?>>
								<?php echo stripslashes($val); ?><?php echo '-'.$st_name;?>
							</option>
							<?php
						}
						?>
					</select>
				</label>
			</div>
			<div style="float:left; width:100%;">				
				<label>
					<span><?php echo $this->lang->line('reg_agency_city_of_residence');?> <font>(<?php echo $this->lang->line('reg_agency_required');?>)</font></span>
					<label class="error" for="city" generated="true"></label>
					<select name="city" id="city"  class="required">
						<option value=""><?php echo $this->lang->line('agency_profile_please_select_your_province_first');?></option>
					<?php
					if(set_value('city')==''){
						foreach($city as $key=>$val){
						?>
						<option value="<?php echo $val;?>" <?php if($val==set_value('city')){?> selected <?php }?>><?php echo $val;?></option>
						<?php
						}
					}else{
						foreach($city as $key=>$val){
						?>
						<option value="<?php echo $val;?>" <?php if($val==set_value('city')){?> selected <?php }?>><?php echo $val;?></option>
						<?php
						}
					}
					?>
					</select>
				</label>
			</div>
			<div style="float:left; width:100%; margin-bottom:10px;">
				<label>
					<span><?php echo $this->lang->line('reg_agency_owner_address');?> <font>(<?php echo $this->lang->line('reg_agency_required');?>)</font></span>
					<label class="error" for="street_address" generated="true" style="display:none;" ></label>
					<?php echo form_error('street_address', '<div class="error">', '</div>'); ?>
					<input placeholder="<?php echo $this->lang->line('reg_agency_owner_street_address_field');?>" type="text" tabindex="1" maxlength="250" class="required" name="street_address" id="street_address" value="<?php echo set_value('street_address');?>" >
				</label>
				<div class="business-name">
					<label class="error" for="street_no" generated="true" style="display:none;"></label>
					<input class="midium required" placeholder="<?php echo $this->lang->line('reg_agency_owner_street_no_field');?>" type="text" maxlength="20" tabindex="2" name="street_no" value="<?php echo set_value('street_no');?>">
				</div>
				<div class="business-name">   
					<label class="error" for="zip" generated="true" style="display:none;"></label>
					<input class="midium required" placeholder="<?php echo $this->lang->line('reg_agency_owner_zip_code_field');?>" tabindex="3" maxlength="15" type="text" name="zip" id="zip" value="<?php echo set_value('zip');?>" style="width:84%;">
				</div>
			</div>
			<div style="float:left; width:100%;">
				<label>
					<span><?php echo $this->lang->line('reg_agency_phone_number');?>
					<font>(<?php echo $this->lang->line('reg_agency_required');?>)</font>[xxxxxxxxxxxxxxx or +xxxxxxxxxxxxxx]</span>
					<label class="error" for="phone_1" id="ph_message" generated="true"></label>
					<?php echo form_error('phone_1', '<div class="error">', '</div>'); ?>
					<span id="spnPhoneStatus1"></span>
					<input placeholder="<?php echo $this->lang->line('reg_agency_phone_number_field');?>" type="text" tabindex="4" name="phone_1" id="phone_1" class="required" value="<?php echo set_value('phone_1');?>" maxlength="15">
				</label>
				<div class="business-name">
					<label class="error" for="phone_2" id="ph2_message" generated="true"></label>
					<?php echo form_error('phone_2', '<div class="error">', '</div>'); ?>
					<div class="clearfix"></div><br>
					<input placeholder="<?php echo $this->lang->line('reg_agency_enter_mobile_number');?>" type="text" name="phone_2" id="phone_2" class="midium" tabindex="5" value="<?php echo $new_arr['phone_2'];?>" maxlength="15">
				</div>
				<div class="business-name">
					<label class="error" for="fax_no" id="fax_message" generated="true"></label>
					<?php echo form_error('fax_no', '<div class="error">', '</div>'); ?>
					<div class="clearfix"></div><br>
					<input placeholder="<?php echo $this->lang->line('reg_agency_enter_fax_number');?>" type="text"  name="fax_no" id="fax_no" class="midium_last" tabindex="6" value="<?php echo $new_arr['fax_no'];?>" maxlength="15" style="width:84%;">
				</div>
			</div>
			<div style="float:left; width:100%; margin-bottom:10px;">
				<label>
					<span><?php echo $this->lang->line('reg_agency_owner_website');?> <font>(<?php echo $this->lang->line('reg_agency_owner_website_option');?>)</font></span>
					 <input placeholder="<?php echo $this->lang->line('reg_agency_owner_website_field');?>" type="text" name="website" tabindex="7" value="<?php echo $new_arr['website'];?>"  >
				</label>
			</div>
			<h2><?php echo $this->lang->line('reg_agency_account_information');?></h2>
			<div style="float:left; width:100%;">
				<label>
					<span><?php echo $this->lang->line('reg_agency_account_information_user_name');?> 
						<font>(<?php echo $this->lang->line('reg_agency_required');?>)</font>
					</span>
					<label class="error" for="user_name" generated="true" style="display:none;"></label>
					<?php echo form_error('user_name', '<div class="error">', '</div>'); ?>
					<div id="user_message"  style="display:none;"></div>
					<input placeholder="<?php echo $this->lang->line('reg_agency_account_information_user_name_field');?>" type="text" id="user_name" tabindex="8" name="user_name" class="required" maxlength="50" value="<?php echo set_value('user_name');?>" onKeyUp="document.getElementById('user_message').style.display='none'">
				</label>
			</div>
			<div style="float:left; width:100%;">
				<label>
					<span><?php echo $this->lang->line('reg_agency_account_information_email_address');?> 
						<font>(<?php echo $this->lang->line('reg_agency_required');?>)</font>
					</span>
					<label class="error" for="email1" generated="true" style="display:none;"></label>
					<?php echo form_error('email', '<div class="error">', '</div>'); ?>
					<div class="user_msg" id="message" style="display:none;"></div>
					<label class="error" for="email" generated="true"></label>
					<input placeholder="<?php echo $this->lang->line('reg_agency_account_information_email_field');?>" name="email" id="email1" type="text" tabindex="9" class="required email" value="<?php echo set_value('email'); ?>" onKeyUp="document.getElementById('message').style.display='none'">
				</label>
			</div>
			<div style="float:left; width:100%;">
				<label>
					<span><?php echo $this->lang->line('reg_agency_account_information_confirmation_email');?> <font>(<?php echo $this->lang->line('reg_agency_required');?>)</font></span>
					<label class="error" for="email2" generated="true"></label>
					<input placeholder="<?php echo $this->lang->line('reg_agency_account_information_confirmation_email_field');?>" type="text" tabindex="10" name="email2" id="email2" class="required" equalTo='#email1' value="<?php echo set_value('email2'); ?>" >
				</label>
			</div>
			<div style="float:left; width:100%;">
				<label>
					<span><?php echo $this->lang->line('reg_agency_account_information_password_to_access_account');?> <font>(<?php echo $this->lang->line('reg_agency_required');?>)</font></span>
					 <label class="error" for="pass" generated="true"></label>
					 <?php echo form_error('password', '<div class="error">', '</div>'); ?>
					<input placeholder="<?php echo $this->lang->line('reg_agency_account_information_password_to_access_account_field');?>" type="password" name="password" id="pass" tabindex="11" class="required" value="<?php echo set_value('password'); ?>" onfocus='this.type="password"' >
				</label>
			</div>
			<div style="float:left; width:100%;">
				<label>
					<span><?php echo $this->lang->line('reg_agency_repeat_password');?> <font>(<?php echo $this->lang->line('reg_agency_required');?>)</font></span>
					<label class="error" for="pass2" generated="true"></label>
					<?php echo form_error('pass2', '<div class="error">', '</div>'); ?>
					<input placeholder="<?php echo $this->lang->line('reg_agency_repeat_password_field');?>" type="password" tabindex="12" name="pass2" id="pass2"  class="required" value="<?php echo set_value('pass2'); ?>" onfocus='this.type="password"' >
				</label>
			</div>
			<!-- <div style="float:left; width:100%;">
			<label>
			<span><?php //echo $this->lang->line('reg_agency_type_the_character');?></span>
			<?php //echo $cap_img ?><br/>
			<input placeholder="<?php //echo $this->lang->line('reg_agency_type_the_character_field');?>" name="captcha" type="text"  class="required"> 
			<div class="error"><?php  //if(isset($captcha_err) && $captcha_err!=''){ echo $captcha_err;} ?></div>
			</label>
			</div> -->
            <div style="float:left; width:100%; margin-top:12px;">
            	<label class="error" for="agree_terms" generated="true"></label>
                <?php echo form_error('agree_terms', '<div class="error">', '</div>'); ?>
				<br/>
				<label style="float:left; width:5%; margin-top:5px;">
                    <input name="agree_terms" type="checkbox" value="13"  class="required" >
				</label>
                <p style="float:left; width:95%"><?php echo $this->lang->line('reg_agency_I_have_read_and_agree');?>
                    <a href="<?php echo base_url();?>site/cmsPages/terms-of-use" target="_blank" ><?php echo $this->lang->line('reg_agency_owner_general_condition');?></a> <?php echo $this->lang->line('reg_agency_and_the');?> <a href="<?php echo base_url();?>site/cmsPages/privacy" target="_blank"><?php echo $this->lang->line('reg_agency_owner_privacy_policy');?></a>
				</p>                
            </div>
            <div style="float:left; width:100%; margin-top:12px;">
            	<label style="float:left; width:5%; margin-top:5px; "><input name="terms" type="checkbox" value="" ></label>
                <p style="float:left; width:95%"><?php echo $this->lang->line('reg_agency_wish_to_receive_informations');?></p>
            </div>
            <div style="float:left; width:100%; margin-top:12px;">
            	<input name="submit" type="submit" value="<?php echo $this->lang->line('reg_agency_button_register');?>">   
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<script type="text/javascript">
var categories = [];
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
    $.post("<?php echo base_url(); ?>users/city_search", {name: name,lang: lang},function(result){
		// alert(result);
		$('#city').html('<option value=""><?php echo $this->lang->line('agency_profile_please_select_your_province_first');?></option>'+result);
	});
}
$(window).load(function() {    
	get_city('<?php echo set_value('province'); ?>', '<?php echo $_COOKIE['lang'];?>');
});
///// for ph no////
function numberFormat(obj) {
    var nStr1 = obj.value;
    var name = obj.name;
    var p = nStr1.split('.');
    var nStr = "";
    for (i = 0; i < p.length; i++)
        nStr += p[i];
    nStr += '';
    x = nStr.split(',');
    x1 = x[0];
    x2 = x.length > 1 ? ',' + x[1] : '';
    if (x2.length > 3) x2 = x2.substring(0, 3);
    //alert(x1+' = '+x1.length);
    var rgx = (x1.length > 9 ? /(\d+)(\d{3})/ : /(\d+)(\d{4})/);
    while (rgx.test(x1))
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    if (x2 == '' && x1.length > 10) x2 = ',';
    var a = "document.getElementById('";
    var b = name;
    var c = "').value=x1+x2";
    eval(a + b + c);
}
/////ph no end///
$(function() {	
    /*
	$("#comp_name").blur(function() {
        $("#comp_name_msg_id").hide();
        var comp_name = $("#comp_name").val();
        if (comp_name == "" || comp_name == null) {
            return false;
        }
        $.ajax({
            type: "post",
            url: "<?php echo base_url();?>users/check_comp_avail",
            data: {
                company_name: comp_name
            },
            async: false,
            success: function(data) {
                $("#comp_name_msg_id").show();
                if (data != '2') {
                    if (data == 0) {
                        $("#comp_name_msg_id").html("");
                        //$('input[type="submit"]').removeAttr('disabled');
                    } else {
                        $("#comp_name_msg_id").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('reg_agency_comp_name_already_taken');?></span>");
                        //$('input[type="submit"]').attr('disabled', 'disabled');
                        //return false;
                    }
                } else {
                    $("#comp_name_msg_id").html("");
                    //$('input[type="submit"]').removeAttr('disabled');
                }
				$('input[type="submit"]').removeAttr('disabled');
            }
        });
    });
	*/
    $("#buss_name").blur(function() {
        $("#buss_name_msg_id").hide();
        var buss_name = $("#buss_name").val();
        if (buss_name == "" || buss_name == null) {
            return false;
        }
        $.ajax({
            type: "post",
            url: "<?php echo base_url();?>users/check_bussname_avail",
            data: {
                business_name: buss_name
            },
            async: false,
            success: function(data) {
                $("#buss_name_msg_id").show();
                if (data != '2') {
                    if (data == 0) {
                        $("#buss_name_msg_id").html("");
                        //$('input[type="submit"]').removeAttr('disabled');
						if($.inArray('buss_name', categories)!==-1){
							categories = jQuery.grep(categories, function(value) {
								return value != 'buss_name';
							});
						}
                    } else {
                        $("#buss_name_msg_id").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('reg_agency_bus_name_already_taken');?></span>");
                       // $('input[type="submit"]').attr('disabled', 'disabled');
                        //return false;
						if($.inArray('buss_name', categories)==-1){
							categories.push('buss_name');
						}
                    }
                } else {
                    $("#buss_name_msg_id").html("");
                   // $('input[type="submit"]').removeAttr('disabled');
                }
				$('input[type="submit"]').removeAttr('disabled');
            }
        });
    });
    $("#vat_no").blur(function() {
        $("#user_message_vat").hide();
        var vat_no = $("#vat_no").val();
        if (vat_no == "" || vat_no == null) {
            return false;
        }
        $.ajax({
            type: "post",
            url: "<?php echo base_url();?>users/check_vat_avail",
            data: {
                vat_no: vat_no
            },
            async: false,
            success: function(data) {
                $("#user_message_vat").show();
                if (data != '2') {
                    if (data == 0) {
                        $("#user_message_vat").html("");
                        //$('input[type="submit"]').removeAttr('disabled');
						if($.inArray('vat_no', categories)!==-1){
							categories = jQuery.grep(categories, function(value) {
								return value != 'vat_no';
							});
						}
                    } else {
                        $("#user_message_vat").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('reg_agency_vat_number_already_taken');?></span>");
                       // $('input[type="submit"]').attr('disabled', 'disabled');
						//return false;
						if($.inArray('vat_no', categories)==-1){
							categories.push('vat_no');
						}
                    }
                } else {
                    $("#user_message_vat").html("");
                    //$('input[type="submit"]').removeAttr('disabled');
                }
				$('input[type="submit"]').removeAttr('disabled');
            }
        });
    });
    $("#email1").blur(function() {
        //alert("hii");
        var userEmail = $("#email1").val();
        $("#message").hide();
        $("#message").html("");
        if (userEmail == "" || userEmail == null){
           // $("#email1").focus();
            return false;
        }
        $.ajax({
            type: "post",
            url: "<?php echo base_url();?>users/check_email_avail",
            data: {
                email: userEmail
            },
            async: false,
            success: function(data) {
                $("#message").show();
                if (data == 0) {
                    $("#message").html("");
                    //$('input[type="submit"]').removeAttr('disabled');
					if($.inArray('email1', categories)!==-1){
						categories = jQuery.grep(categories, function(value) {
							return value != 'email1';
						});
					}
                } else {
                    $("#message").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('agency_edit_email_id_already_taken');?></span>");
                   // $('input[type="submit"]').attr('disabled', 'disabled');
                    //return false;
					if($.inArray('email1', categories)==-1){
						categories.push('email1');
					}
                }
				$('input[type="submit"]').removeAttr('disabled');
            }
        });
    });
    $("#user_name").blur(function() {
        var user_name = $("#user_name").val();
        $("#user_message").hide();
        $("#user_message").html("");
        if (user_name == "" || user_name == null) {
            return false;
        } else if (user_name == "<?php echo $this->lang->line('reg_agency_account_information_user_name_field');?>") {
            return false;
        }
        $.ajax({
            type: "post",
            url: "<?php echo base_url();?>users/check_user_avail",
            data: {
                user_name: user_name
            },
            async: false,
            success: function(data) {
                $("#user_message").show();
                if (data == 0) {
                    //$("#user_message").html("<span style='color:green;'><?php echo $this->lang->line('agency_edit_user_name_available');?></span>");
                    //$('input[type="submit"]').removeAttr('disabled');
					if($.inArray('user_name', categories)!==-1){
						categories = jQuery.grep(categories, function(value) {
							return value != 'user_name';
						});
					}
                }else {
                    $("#user_message").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('agency_edit_user_name_already_taken');?></span>");
                   // $('input[type="submit"]').attr('disabled', 'disabled');
                    //return false;
					if($.inArray('user_name', categories)==-1){
						categories.push('user_name');
					}
                }
				$('input[type="submit"]').removeAttr('disabled');
            }
        });
    });
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
$('#register').submit(function(){
	if(categories.length>0){
		return false;
	}
});	
</script>
<?php $this->load->view("inc/footer");?>
