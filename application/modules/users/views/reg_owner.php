<?php $this->load->view("inc/header");?>
<style>
/*jquery error styles */
div.error{ float: left; color: red; padding-right: .5em;}
label.error{float: left; color: red; padding-right: .5em;}
#ssn{text-transform:uppercase}
</style>
<script type="text/javascript">
$(document).ready(function(){
	/* $('#ssn').keyup(function(){
		console.log($(this).val().length);
	}); */
	$.validator.addMethod("alphabetsnspace", function(value, element) {
		return this.optional(element) || /((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%?._+\"^!-]).{8,20})/.test(value);
	});
	$.validator.addMethod("alphanumeric", function(value, element) {
		return this.optional(element) || /^\w+$/i.test(value);
	});
	$("#register").validate({
		rules:{
			first_name:{
				required: true,
				maxlength: 25
			},last_name:{
				required: true,
				maxlength: 50
			},ssn:{
				required: true,
				minlength: 16,
				maxlength: 25
			},password:{
				required: true,
				alphabetsnspace: true,
				minlength: 8,
				maxlength: 255
			},pass2:{
				required: true,
				minlength: 8,
				maxlength: 255,
				equalTo: "#pass"
			},user_name:{
				required: true,
				alphanumeric: true,
				minlength: 5,
				maxlength: 100
			},phone_1:{				
				required: true,
				//phonenumeric: true,
				minlength: 7,
				maxlength: 15
			},phone_2:{
				minlength: 7,
				maxlength: 15
			},zip:{				
				required: true,
				number:true,
				//phonenumeric: true,
				//minlength: 5,
				maxlength: 15
			}
		},messages:{
			password:{
				required:"<?php echo $this->lang->line('reg_user_please_provide_a_password');?>",
				alphabetsnspace:"<?php echo $this->lang->line('reg_user_your_password_must_be_atleast');?> ! ? $ % ^ - @ + _ .",
				minlength:"<?php echo $this->lang->line('reg_user_your_password_must_be_atleast_8_character_long');?>"
			},pass2:{
				required: "<?php echo $this->lang->line('reg_user_please_provide_a_password');?>",
				minlength: "<?php echo $this->lang->line('reg_user_your_password_must_be_atleast_8_character_long');?>",
				equalTo: "<?php echo $this->lang->line('reg_user_please_enter_the_same_password_as_above');?>"
			},user_name:{
				alphanumeric: "<?php echo $this->lang->line('reg_owner_account_information_user_name_atleast'); ?>",
			}
		}
	});	
});
function get_city(id,data){
	var name=id;
	//alert(name);
	var lang=data;
	//alert(lang);
	$.post("<?php echo base_url(); ?>users/city_search", { name: name,lang:lang },function(result){
		$('#city').html('<option value=""><?php echo $this->lang->line('reg_owner_please_select_your_province_first');?></option>'+result);
	});
}
$(window).load(function() {    
	get_city('<?php echo set_value('province'); ?>', '<?php echo $_COOKIE['lang'];?>');
});
</script>
<!------ banner part ------------->
<div class="insidepage_banner">
	<div class="main">
    	<h2><?php echo $this->lang->line('reg_user_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('reg_user_jobs');?></font> <?php echo $this->lang->line('reg_user_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('reg_user_housing');?></font></h2>
    </div>
</div>
<!------ body part ------------->
<?php
//echo $_COOKIE['lang'];
?>
<div class="main">
	<div id="breadcrumb" class="fk-lbreadbcrumb newvd">
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('reg_owner_home');?></a></span> >  
        <span><a href="<?php echo base_url();?>users/common_reg"><?php echo $this->lang->line('reg_owner_register');?></a></span> >
        <span><?php echo $this->lang->line('reg_owner_sign_up_as_owner');?></span>
    </div>
	<!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
	<div class="registercomn_box">
		<div class="arrow_box error_message" style="color:#ED6B1F;"><?php echo $this->lang->line('reg_owner_hey_great_choice');?></div>
        <div class="charater_icon"><img src="<?php echo base_url();?>assets/images/add_newproperty_icon.jpg" alt=""></div>
        <div class="owner_registbox">       
       	<?php
		$new_arr=$this->session->all_userdata();
		//echo '<pre>';print_r($new_arr)
		$attributes = array('class' => 'register-form', 'id' => 'register', 'name' => 'register');
		echo form_open_multipart('users/do_owner_reg', $attributes);		
		?>
        	<form class="register-form" action="signup_individualuser_edit.html" name="register" method="post">
				<h2><?php echo $this->lang->line('reg_owner_personal_informations');?></h2>
                <div>
                    <label>
                        <span><?php echo $this->lang->line('reg_owner_personal_informations_first_name');?>
							<font>(<?php echo $this->lang->line('reg_owner_required');?>)</font>
						</span>
                        <label class="error" for="first_name" generated="true"  style="display:none;"></label>
                         <?php echo form_error('first_name', '<div class="error">', '</div>'); ?>
						<input placeholder="<?php echo $this->lang->line('reg_owner_personal_informations_first_name_field');?>" type="text" tabindex="1" name="first_name" class="required" maxlength="25" value="<?php echo set_value('first_name'); ?>" >
                    </label>
                </div>
            	<div>
                    <label>
                        <span><?php echo $this->lang->line('reg_owner_personal_informations_last_name');?>
							<font>(<?php echo $this->lang->line('reg_owner_required');?>)</font>
						</span>
                        <label class="error" for="last_name" generated="true"></label>
                        <?php echo form_error('last_name', '<div class="error">', '</div>'); ?>
                        <input placeholder="<?php echo $this->lang->line('reg_owner_personal_informations_last_name_field');?>" type="text" tabindex="1" name="last_name" class="required" maxlength="50"  value="<?php echo set_value('last_name'); ?>"  >
                    </label>
                </div>
                <div>
                	<h3><?php echo $this->lang->line('reg_owner_private_informations');?></h3>
                    <p><?php echo $this->lang->line('reg_owner_private_informations_note');?></p>
                </div>            
                <div style="float:left; width:100%;">
					<label>
						<span><?php echo $this->lang->line('reg_owner_private_informations_social_security_number');?>
							<font>(<?php echo $this->lang->line('reg_owner_required');?>)</font>
						</span>
                        <label class="error" for="ssn" generated="true" style="display:none;"></label>
						<div id="ssn_message" style="display:none;"></div>
						<?php echo form_error('social_secuirity_number', '<div class="error">', '</div>'); ?>                       
						<input name="social_secuirity_number" id="ssn" placeholder="<?php echo $this->lang->line('reg_owner_private_informations_social_security_number_field');?>" type="text" tabindex="1" class="required" minlength="16" maxlength="25" style="text-transform:uppercase" value="<?php echo set_value('social_secuirity_number'); ?>" onKeyUp="document.getElementById('ssn_message').style.display='none'">
					</label>                    
                </div>
				<!--document.getElementById('message').style.display='none';-->
				<div>
					<span><?php echo $this->lang->line('reg_owner_birthday');?>
						<font style="color: #9DCFF3;">(<?php echo $this->lang->line('reg_owner_required');?>)</font>
					</span>
					<label class="error" for="datepicker" generated="true"></label>
					<?php echo form_error('date_of_birth', '<div class="error">', '</div>'); ?>                       
					<?php
					$cdate=date("Y");
					$selecteddate=set_value('reg_day');  
					?>
					<div style="width:32.5%; float:left;">
						<?php echo form_error('reg_day', '<div class="error">', '</div>'); ?>
						<label class="error" for="reg_day" generated="true"></label>
						<select name="reg_day" id="reg_day" class="required" >
							<option value=''><?php echo $this->lang->line('user_registration_birth_day');?></option>
							<?php
							for($d=1;$d<=31;$d++){
								if($d>9){
									if($selecteddate==$d){
										echo "<option value='".$d."' selected>".$d."</option>";
									}else{
										echo "<option value='".$d."'>".$d."</option>";
									}
								}else{
									if($selecteddate==$d){
										echo "<option value='0".$d."' selected>0".$d."</option>";
									}else{
										echo "<option value='0".$d."'>0".$d."</option>";
									}
								}
							}
							?>
                       </select>
					</div>
					<div style="width:32.5%; float:left;">
					<?php echo form_error('reg_month', '<div class="error">', '</div>'); ?>
					<label class="error" for="reg_month" generated="true"></label>
						<select name="reg_month" id="reg_month" class="required">
							<option value=''><?php echo $this->lang->line('user_registration_birth_month');?></option>
							<option value='01' <?php if(set_value('reg_month')=='01'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month01');?></option>
							<option value='02' <?php if(set_value('reg_month')=='02'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month02');?></option>
							<option value='03' <?php if(set_value('reg_month')=='03'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month03');?></option>
							<option value='04' <?php if(set_value('reg_month')=='04'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month04');?></option>
							<option value='05' <?php if(set_value('reg_month')=='05'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month05');?></option>
							<option value='06' <?php if(set_value('reg_month')=='06'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month06');?></option>
							<option value='07' <?php if(set_value('reg_month')=='07'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month07');?></option>
							<option value='08' <?php if(set_value('reg_month')=='08'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month08');?></option>
							<option value='09' <?php if(set_value('reg_month')=='09'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month09');?></option>
							<option value='10' <?php if(set_value('reg_month')=='10'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month10');?></option>
							<option value='11' <?php if(set_value('reg_month')=='11'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month11');?></option>
							<option value='12' <?php if(set_value('reg_month')=='12'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month12');?></option>
						</select>
					</div>
				   <div style="width:32.5%; float:left;">
						<?php echo form_error('reg_year', '<div class="error">', '</div>'); ?>
						<label class="error" for="reg_year" generated="true"></label>
						<select name="reg_year" id="reg_year" class="required" >
							<option value=''><?php echo $this->lang->line('user_registration_birth_year');?></option>
							<?php
							for($y=$cdate;$y>=($cdate-100);$y--){
								if(set_value('reg_year')==$y){
									echo "<option value='".$y."' selected>".$y."</option>";
								}else{
									echo "<option value='".$y."'>".$y."</option>";
								}
							}
							?>
						</select>
				   </div>
					<!--<input placeholder="<?php echo $this->lang->line('reg_owner_enter_your_birthday');?>" type="text" name="date_of_birth" id="datepicker" readonly style="width:70% !important" tabindex="1"  class="required"  value="<?php echo set_value('date_of_birth'); ?>" >-->
				</div>
				<div style="float:left; width:100%;">
					<?php
					//print_r($provinces);
					?>
					<label>
						<span><?php echo $this->lang->line('reg_owner_owner_province');?> 
							<font>(<?php echo $this->lang->line('reg_owner_required');?>)</font>
						</span>
						<label class="error" for="province" generated="true"></label>
						<?php echo form_error('province', '<div class="error">', '</div>'); ?>
						<select name="province" id="province"  class="required" onChange="return get_city(this.value,'<?php echo $_COOKIE['lang'];?>');">
							<option value=""><?php echo $this->lang->line('reg_owner_please_select_your_province');?></option>    
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
						<span><?php echo $this->lang->line('reg_owner_city_of_residence');?>
							<font>(<?php echo $this->lang->line('reg_owner_required');?>)</font>
						</span>
						<label class="error" for="city" generated="true"></label>
						<?php echo form_error('city', '<div class="error">', '</div>'); ?>
						<select name="city" id="city"  class="required">
							<option value=""><?php echo $this->lang->line('reg_owner_please_select_your_province_first');?></option>
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
                        <span><?php echo $this->lang->line('reg_owner_owner_address');?>
							<font>(<?php echo $this->lang->line('reg_owner_required');?>)</font>
						</span>
                        <label class="error" for="street_address" generated="true"></label>
						<?php echo form_error('street_address', '<div class="error">', '</div>'); ?>
                        <input placeholder="<?php echo $this->lang->line('reg_owner_owner_street_address_field');?>" type="text" name="street_address" class="required" maxlength="250"  value="<?php echo set_value('street_address');?>" >
					</label>
					<label>
						<label class="error" for="street_no" generated="true"></label>                     
						<?php echo form_error('street_no', '<div class="error">', '</div>'); ?>
						<input placeholder="<?php echo $this->lang->line('reg_owner_owner_street_no_field');?>" type="text" class="required" name="street_no" maxlength="20"  value="<?php echo set_value('street_no');?>" >
					</label>
					<label>
						<label class="error" for="zip" generated="true"></label>
						<?php echo form_error('zip', '<div class="error">', '</div>'); ?>
						<input  placeholder="<?php echo $this->lang->line('reg_owner_owner_zip_code_field');?>" type="text" class="required" name="zip" maxlength="15" value="<?php echo set_value('zip');?>" >
                    </label>
                </div>
                <h2><?php echo $this->lang->line('reg_owner_owner_contact_informations');?></h2>
                <div style="float:left; width:100%; margin-bottom:10px;">
                    <label>
                        <span><?php echo $this->lang->line('reg_owner_phone_number');?>[xxxxxxxxxxxxxxx or +xxxxxxxxxxxxxx]</span>
                        <label class="error" for="phone_1" id="ph_message" generated="true"></label>
                        <?php echo form_error('phone_1', '<div class="error">', '</div>'); ?>
                        <div class="user_msg"  style="display:none;"></div>
                        <span id="spnPhoneStatus"></span>
                        <input placeholder="<?php echo $this->lang->line('reg_owner_phone_number_field');?>" maxlength="15" type="text" tabindex="1" class="required" name="phone_1" value="<?php echo set_value('phone_1');?>" id="phone_1">
					</label>                    
					<label>
						<span id="spnPhoneStatus1"></span>
						<label class="error" for="phone_2" id="ph2_message" generated="true"></label>
						<?php echo form_error('phone_2', '<div class="error">', '</div>'); ?>
						<input placeholder="<?php echo $this->lang->line('reg_owner_nobile_number_field');?>"  maxlength="15" type="text" tabindex="1"  name="phone_2" value="<?php echo $new_arr['phone_2'];?>" id="phone_2" >
                    </label>
                </div>
                <h2><?php echo $this->lang->line('reg_owner_account_information');?></h2>                
				<!--
				<div>
				<label>
				<span><?php //echo $this->lang->line('reg_user_account_information_user_name');?>
				<font>(<?php //echo $this->lang->line('reg_user_required');?>)</font></span>
				<label class="error" for="user_name" generated="true"></label>
				<?php //echo form_error('user_name', '<div class="error">', '</div>'); ?>
				<input placeholder="<?php //echo $this->lang->line('reg_user_account_information_user_name_field');?>"
				type="text" tabindex="1" name="user_name" class="required" value="<?php //echo set_value('user_name'); ?>" maxlength="100">
				</label>
				</div>
				-->
				<div style="float:left; width:100%;">
					<label>
						<span><?php echo $this->lang->line('reg_owner_account_information_user_name');?> 
						<font>(<?php echo $this->lang->line('reg_owner_required');?>)</font></span>
						<label class="error" for="user_name" generated="true" style="display:none;"></label>
						<?php echo form_error('user_name', '<div class="error">', '</div>'); ?>
						<div id="user_message_uname"  style="display:none;"></div>
						<input placeholder="<?php echo $this->lang->line('reg_owner_account_information_user_name_field');?>" type="text" tabindex="9" id="user_name" name="user_name" maxlength="50" class="required" value="<?php echo set_value('user_name'); ?>" onKeyUp="document.getElementById('user_message_uname').style.display='none'">
					</label>
				</div>
				<!-- <div style="float:left; width:100%;">
				<label>
				<span><?php //echo $this->lang->line('reg_owner_account_information_email_address');?>
				<font>(<?php //echo $this->lang->line('reg_owner_required');?>)</font></span>
				<label class="error" for="email1" generated="true"></label>
				<?php //echo form_error('email1', '<div class="error">', '</div>'); ?>
				<input placeholder="<?php //echo $this->lang->line('reg_owner_account_information_email_field');?>" 
				name="email" id="email1" type="text" tabindex="1"  class="required email" 
				value="<?php //echo set_value('email'); ?>">
				</label>
				</div> -->                
				<div style="float:left; width:100%;">
					<label>
						<span><?php echo $this->lang->line('reg_agency_account_information_email_address');?> 
						<font>(<?php echo $this->lang->line('reg_agency_required');?>)</font></span>
						<label class="error" for="email1" generated="true" style="display:none;"></label>
						<?php echo form_error('email', '<div class="error">', '</div>'); ?>
						<div class="user_msg" id="message" style="display:none;"></div>
						<label class="error" for="email" generated="true"></label>
						<input placeholder="<?php echo $this->lang->line('reg_agency_account_information_email_field');?>" name="email" id="email1" type="text" tabindex="9" maxlength="100"  class="required email" value="<?php echo set_value('email'); ?>" onKeyUp="document.getElementById('message').style.display='none';" >
					</label>
				</div>
                <div style="float:left; width:100%;">
                    <label>
                        <span><?php echo $this->lang->line('reg_owner_account_information_confirmation_email');?> <font>(<?php echo $this->lang->line('reg_owner_required');?>)</font></span>
                        <label class="error" for="email2" generated="true"></label>
                        <?php echo form_error('email2', '<div class="error">', '</div>'); ?>
                         <input placeholder="<?php echo $this->lang->line('reg_owner_account_information_confirmation_email_field');?>" type="text" tabindex="1" name="email2" id="email2" class="required" equalTo='#email1' value="<?php echo set_value('email2'); ?>" >
                    </label>
                </div>
                <div style="float:left; width:100%;">
                    <label>
                        <span><?php echo $this->lang->line('reg_owner_account_information_password_to_access_account');?> <font>(<?php echo $this->lang->line('reg_owner_required');?>)</font></span>
                         <label class="error" for="pass" generated="true"></label>
                          <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                        <input placeholder="<?php echo $this->lang->line('reg_owner_account_information_password_to_access_account_field');?>" type="password" name="password" id="pass" tabindex="1" maxlength="255" class="required" value="<?php echo set_value('password'); ?>" onfocus='this.type="password"' >
                    </label>
                </div>
                <div style="float:left; width:100%;">
                    <label>
                        <span><?php echo $this->lang->line('reg_owner_repeat_password');?> <font>(<?php echo $this->lang->line('reg_owner_required');?>)</font></span>
                        <label class="error" for="pass2" generated="true"></label>
                        <?php echo form_error('pass2', '<div class="error">', '</div>'); ?>
                        <input placeholder="<?php echo $this->lang->line('reg_owner_repeat_password_field');?>" type="password" tabindex="1" name="pass2" id="pass2" maxlength="255"  class="required" value="<?php echo set_value('pass2'); ?>" onfocus='this.type="password"' >
                    </label>
                </div>
				<!-- <div style="float:left; width:100%;">
				<label>
				<span><?php //echo $this->lang->line('reg_owner_type_the_character');?></span>
				<?php //echo $cap_img ?><br/>
				<input placeholder="<?php //echo $this->lang->line('reg_owner_type_the_character_field');?>" name="captcha" type="text"  class="required"> 
				<!--<input placeholder="Repeat password" type="text" id="captcha" name="captcha" value="" />-->
				<!-- <div class="error"><?php  //if(isset($captcha_err) && $captcha_err!=''){ echo $captcha_err;} ?></div>
				</label>
				</div> -->
				<div style="float:left; width:100%; margin-top:12px;">
					<label class="error" for="agree_terms" generated="true"></label>
					<?php echo form_error('agree_terms', '<div class="error">', '</div>'); ?>
					<div class="clearfix"></div><br>
					<label style="float:left; width:5%; margin-top:5px; ">
						<input name="agree_terms" type="checkbox" value="1" class="required" >
					</label>
					<p style="float:left; width:95%"><?php echo $this->lang->line('reg_owner_I_have_read_and_agree');?> 
						<a href="<?php echo base_url();?>site/cmsPages/terms-of-use" target="_blank">
							<?php echo $this->lang->line('reg_owner_owner_general_condition');?>
						</a> 
						<?php echo $this->lang->line('reg_owner_and_the');?> 
						<a href="<?php echo base_url();?>site/cmsPages/privacy" target="_blank">
							<?php echo $this->lang->line('reg_owner_owner_privacy_policy');?>
						</a>
					</p>
				</div>
				<div style="float:left; width:100%; margin-top:12px;">
					<label style="float:left; width:5%; margin-top:5px;">
						<input name="terms" type="checkbox" value="1" >
					</label>
					<p style="float:left; width:95%">
						<?php echo $this->lang->line('reg_owner_wish_to_receive_informations');?>
					</p>
				</div>
				<div style="float:left; width:100%; margin-top:12px;">
					<input name="submit" type="submit" value="<?php echo $this->lang->line('reg_owner_button_register');?>">   
				</div>
				<?php echo form_close();?>
				<!--</form>-->
			</div>
		</div>
</div>
<script type="text/javascript">
var categories = [];
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
               // $("#phone_1").focus();
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
        }else{
			
		}
    });
    $("#ssn").blur(function() {
        // alert("hii");
        var ssn = $("#ssn").val();
        $("#ssn_message").hide();
        $("#ssn_message").html("");
        if (ssn == "" || ssn == null) {
            //$("#ssn").focus();
            return false;
        }
        $.ajax({
            type: "post",
            url: "<?php echo base_url();?>users/check_ssn_avail",
            data: {
                ssn: ssn
            },
            async: false,
            success: function(data) {
                $("#ssn_message").show();
                if (data == 0 && data != "") {
                    //$("#user_message_uname").html("<span style='color:green;'><?php //echo $this->lang->line('agency_edit_user_name_available');?></span>");
                    //$('input[type="submit"]').removeAttr('disabled');
					if($.inArray('ssn', categories)!==-1){
						categories = jQuery.grep(categories, function(value) {
							return value != 'ssn';
						});
					}
                } else {
                    $("#ssn_message").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('reg_owner_social_security_number_already_taken');?></span>");
					if($.inArray('ssn', categories)==-1){
						categories.push('ssn');
					}					
					//$('input[type="submit"]').attr('disabled', 'disabled');
					//$("#ssn").focus();
                    //return false;
                }
				//$('input[type="submit"]').removeAttr('disabled');
            }
        });
    });
    $("#user_name").blur(function() {
        //alert("hii");
        var user_name = $("#user_name").val();
        $("#user_message_uname").hide();
        $("#user_message_uname").html("");
        if (user_name == "" || user_name == null) {
            //$("#user_name").focus();
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
                $("#user_message_uname").show();
                if (data == 0 && data != "") {
                    //$("#user_message_uname").html("<span style='color:green;'><?php //echo $this->lang->line('agency_edit_user_name_available');?></span>");
                    //$('input[type="submit"]').removeAttr('disabled');
					if($.inArray('user_name', categories)!==-1){
						categories = jQuery.grep(categories, function(value) {
							return value != 'user_name';
						});
					}
                } else {
                    $("#user_message_uname").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('agency_edit_user_name_already_taken');?></span>");
                    //$('input[type="submit"]').attr('disabled', 'disabled');
                    //$("#user_name").focus();
                    //return false;
					if($.inArray('user_name', categories)==-1){
						categories.push('user_name');
					}
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
                if (data == 1) {
                    $("#message").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('reg_agency_account_information_email_address_taken');?></span>");
                    //$('input[type="submit"]').attr('disabled', 'disabled');					
                    //$("#email1").focus();
					if($.inArray('email1', categories)==-1){
						categories.push('email1');
					}
                } else {
                    //$('input[type="submit"]').removeAttr('disabled');
					if($.inArray('email1', categories)!==-1){
						categories = jQuery.grep(categories, function(value) {
							return value != 'email1';
						});
					}
                }
				$('input[type="submit"]').removeAttr('disabled');
            }			
        });
    });
});	
$('#register').submit(function(){
	if(categories.length>0){
		return false;
	}
});	
</script>
<?php $this->load->view("inc/footer");?>