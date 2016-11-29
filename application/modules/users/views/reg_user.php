<?php $this->load->view("inc/header");?>
<style>
/*jquery error styles */
div.error{ float: left; color: red; padding-right: .5em;  }
label.error { float: left; color: red; padding-right: .5em;  }
</style>
<script type="text/javascript">
$(document).ready(function() {	
	$.validator.addMethod("alphabetsnspace", function(value, element) {
        return this.optional(element) || /((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%?._+\"^!-]).{8,20})/.test(value);
	});
	$.validator.addMethod("alphanumeric", function(value, element) {
		return this.optional(element) || /^\w+$/i.test(value);
	});
	$("#register").validate({
		rules: {
			password: {
				required: true,
				alphabetsnspace: true,
				minlength: 8
			},
			pass2: {
				required: true,
				minlength: 8,
				equalTo: "#pass"
			},	
			user_name: {
				required: true,
				alphanumeric: true,
				minlength: 5,
				maxlength: 100
			},
			ph_no: {
				//required: true,
				//alphanumeric: true,
                               
				minlength: 7,
				maxlength: 15
			},
		},
		messages: {
			password: {
				required: "<?php echo $this->lang->line('reg_user_please_provide_a_password');?>",
				alphabetsnspace: "<?php echo $this->lang->line('reg_user_your_password_must_be_atleast');?> ! ? $ % ^ - @ + _ .",
				minlength: "<?php echo $this->lang->line('reg_user_your_password_must_be_atleast_8_character_long');?>"
			},
			pass2: {
				required: "<?php echo $this->lang->line('reg_user_please_provide_a_password');?>",
				minlength: "<?php echo $this->lang->line('reg_user_your_password_must_be_atleast_8_character_long');?>",
				equalTo: "<?php echo $this->lang->line('reg_user_please_enter_the_same_password_as_above');?>"
			},
			user_name: {
				alphanumeric: "<?php echo $this->lang->line('reg_user_account_information_user_name_atleast');?>"
			}
		}
	});	
});
window.fbAsyncInit = function() {
	FB.init({
		appId		: '1540614492896758',
		oauth		: true,
		status		: true, // check login status
		cookie		: true, // enable cookies to allow the server to access the session			
		xfbml		: true, // parse XFBML
		version		: 'v2.5'	  
	});
};
(function(d, s, id){
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
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
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('reg_user_home');?></a></span> >  
        <span><a href="<?php echo base_url();?>users/common_reg"><?php echo $this->lang->line('reg_user_register');?></a></span> >
        <span><?php echo $this->lang->line('reg_user_sign_up_as_individual_user');?></span>
    </div>
	<!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
	<div class="registercomn_box">
    	<div class="registercomn_box_left">
        	<h2><?php echo $this->lang->line('reg_user_sign_up_using_your_facebook_or_google_account');?></h2>
            <div style="margin-left:18%; margin-top:10%;">
            	<a href="javascript:void(0);" class="facebook_bt" onClick="fb_login('<?php echo base_url(); ?>');">
					<img src="<?php echo base_url()?>assets/images/facebook_socialbt.png" alt="<?php echo $this->lang->line('reg_user_facebook');?>">
					<font><?php echo $this->lang->line('reg_user_facebook');?></font>
				</a>
				<?php 
				$google_client_id 		= '486148900452-hji9n8dt4ag1tnp4d15mkn96i4immnk2.apps.googleusercontent.com';
				$google_client_secret 	= 'jig6WKmBU7c-HXkhaUn_Es5B';
				$google_redirect_url 	=  base_url().'users/google';
				$google_developer_key 	= '486148900452-hji9n8dt4ag1tnp4d15mkn96i4immnk2@developer.gserviceaccount.com';

				require_once dirname(__FILE__).'/../../../../assets/src/Google_Client.php';
				require_once dirname(__FILE__).'/../../../../assets/src/contrib/Google_Oauth2Service.php';

				$gClient = new Google_Client();
				$gClient->setApplicationName('fds-login');
				$gClient->setClientId($google_client_id);
				$gClient->setClientSecret($google_client_secret);
				$gClient->setRedirectUri($google_redirect_url);
				$gClient->setDeveloperKey($google_developer_key);

				$google_oauthV2 = new Google_Oauth2Service($gClient);
				$authUrl = $gClient->createAuthUrl();
				?>
                <a href="javascript:void(0);" onClick="location.href='<?php echo $authUrl;?>'" class="google_bt">
					<img src="<?php echo base_url()?>assets/images/gplus_socialbt.png" alt="<?php echo $this->lang->line('reg_user_google');?>">
					<font><?php echo $this->lang->line('reg_user_google');?></font>
				</a>
            </div>
            <div style="float:left; margin-top:100px;">
            	<img src="<?php echo base_url()?>assets/images/facebookpicx.jpg" alt="Social">
            </div>
        </div>
        <div class="orpicx">
		<?php if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) { ?>
			<img src="<?php echo base_url();?>assets/images/or_img.png" alt="Or">
			<?php } elseif( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "it" )) { ?>
			<img src="<?php echo base_url();?>assets/images/or_img_it.png" alt="Oppure">
		<?php } ?>
		</div>
        <div class="registercomn_box_right">
        	<h2><?php echo $this->lang->line('reg_user_enter_your_personal_information');?></h2>
            <?php
				$new_arr = $this->session->all_userdata();
				$attributes = array('class' => 'register-form', 'id' => 'register');
				echo form_open_multipart('users/do_registration', $attributes);		
			?>
        	<!--<form class="register-form" action="signup_individualuser_edit.html" name="register" method="post">-->
            <div>
                    <label>
                        <span><?php echo $this->lang->line('reg_user_account_information_user_name');?>
						<font>(<?php echo $this->lang->line('reg_user_required');?>)</font></span>
						<div class="user_msg" id="user_message" style="display:none;"></div>
                        <label class="error" for="username" generated="true"></label>
                        <?php echo form_error('user_name', '<div class="error">', '</div>'); ?>
                       <input placeholder="<?php echo $this->lang->line('reg_user_account_information_user_name_field');?>" type="text" tabindex="1" id="username" name="user_name" class="required" value="<?php echo set_value('user_name'); ?>" maxlength="100">
                    </label>
                </div>
                <div>
                    <label>
                        <span><?php echo $this->lang->line('reg_user_owner_first_name');?> <font>(<?php echo $this->lang->line('reg_user_required');?>)</font></span>
                        <label class="error" for="first_name" generated="true"  style="display:none;"></label>
                        <?php echo form_error('first_name', '<div class="error">', '</div>'); ?>
                       <input placeholder="<?php echo $this->lang->line('reg_user_owner_first_name_field');?>" type="text" tabindex="2" name="first_name" class="required" value="<?php echo set_value('first_name'); ?>"  maxlength="255">
                    </label>
                </div>
            	<div>
                    <label>
                        <span><?php echo $this->lang->line('reg_user_owner_last_name');?> <font>(<?php echo $this->lang->line('reg_user_required');?>)</font></span>
                        <label class="error" for="last_name" generated="true"></label>
                        <?php echo form_error('last_name', '<div class="error">', '</div>'); ?>
                        <input placeholder="<?php echo $this->lang->line('reg_user_owner_last_name_field');?>" type="text" tabindex="3" name="last_name" class="required" value="<?php echo set_value('last_name'); ?>"  maxlength="255">
                    </label>
                </div>
                <div>
                <?php
                	//echo '<pre>';print_r($countries);
				?>
                    <label>
                        <span><?php echo $this->lang->line('reg_user_country');?> <font>(<?php echo $this->lang->line('reg_user_required');?>)</font></span>
                        <label class="error" for="country" generated="true"></label>
                        <?php echo form_error('country', '<div class="error">', '</div>'); ?>
                        <select name="country"  class="required" tabindex="4" >
                        	<option value=""><?php echo $this->lang->line('reg_user_please_select_your_country');?></option>
                            <?php
                            	foreach($countries as $country)
								{
							?>
                            <option value="<?php echo $country['id_countries'];?>" <?php if($country['id_countries']==set_value('country')){?> selected <?php }?>><?php echo $country['name'];?></option>
                            <?php
								}
							?>
                        </select>
                    </label>
                </div>
                <div>
                    <label>
                        <span><?php echo $this->lang->line('reg_owner_city');?> </span>
                        <label class="error" for="city" generated="true"></label>
                         <?php echo form_error('city', '<div class="error">', '</div>'); ?>
                        <input placeholder="<?php echo $this->lang->line('reg_user_city_name');?>" type="text" name="city" tabindex="5"  value="<?php echo set_value('city'); ?>" class="required" maxlength="255">
                    </label>
                </div>
                <div>
                   	 <div style="float:left; width:66%;">
                        <span><?php echo $this->lang->line('reg_user_birthday');?> <font style="color: #9DCFF3;">(<?php echo $this->lang->line('reg_user_required');?>)</font></span>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                       <!-- <?php echo form_error('date_of_birth', '<div class="error">', '</div>'); ?>-->
                       
                      <?php
                       $cdate=date("Y");
					  			$selecteddate=set_value('reg_day');  
					  ?>
                      
                      <div style="width:30%; float:left;">
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
                       <div style="width:30%; float:left;">
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
                       <div style="width:30%; float:left;">
                       
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
                       
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                       <!--  <label class="error" for="datepicker" generated="true"></label>-->
                       <!-- <select name="date" class="small" required>
                        	<option value="0">1</option>
                            <option value="1">2</option>
                            <option value="1">3</option>
                            <option value="1">4</option>
                        </select>
                        <select name="Month" class="small" required>
                        	<option value="0">1</option>
                            <option value="1">2</option>
                            <option value="1">3</option>
                            <option value="1">4</option>
                        </select>
                        <select name="year" class="small" required>
                        	<option value="0">1</option>
                            <option value="1">2</option>
                            <option value="1">3</option>
                            <option value="1">4</option>
                        </select>-->
                        <!--<input placeholder="<?php echo $this->lang->line('reg_user_birthday_field');?>" type="text" name="date_of_birth" id="datepicker" readonly style="width:70% !important" tabindex="6"  class="required"  value="<?php echo set_value('date_of_birth'); ?>" >
                        <br/>-->
                       
                    </div>
                    <div style="float:left; width:34%;">
                      <span style=" float:left;"><?php echo $this->lang->line('reg_user_gender');?> <font style="color: #9DCFF3;">(<?php echo $this->lang->line('reg_user_required');?>)</font></span>
                       <label class="error" for="gender" generated="true"></label>
                      	<?php echo form_error('gender', '<div class="error">', '</div>'); ?>
                        <p style="float:left; width:70px; margin-right:5px;"><label style="float:left; padding-top:3px; padding-right:5px;"><input type="radio" name="gender" value="1"  class="required" <?php if(set_value('gender')=='1'){?> checked<?php }?> ></label><font style="float:left;"><?php echo $this->lang->line('reg_user_female');?></font></p>
                        <p style="float:left; width:60px;"> <label style="float:left; padding-top:3px; padding-right:5px;">
                        <input type="radio" name="gender" value="0" <?php if(set_value('gender')=='0'){?> checked<?php }?>></label><font style="float:left;"><?php echo $this->lang->line('reg_user_male');?></font></p>
                        <br/>
                        
                    </div>
                  
                </div>
        <div style="float:left; width:100%;">
            <label>
                <span>
                    <?php echo $this->lang->line('reg_user_telephone_number'); ?> 
                    <font>(<?php echo $this->lang->line('reg_user_telephone_number_option'); ?>)</font>[xxxxxxxxxxxxxxx or +xxxxxxxxxxxxxx]
                </span>
				
				<label class="error" for="ph_no" id="ph_message" generated="true"></label>
				<?php echo form_error('ph_no', '<div class="error">', '</div>'); ?>
				<span id="spnPhoneStatus1"></span>
                 <input placeholder="<?php echo $this->lang->line('reg_user_telephone_number_field'); ?>" name="ph_no" id="ph_no" maxlength="15" type="text" min="7" value="<?php echo $new_arr['contact_ph_no']; ?>">
            </label>
          </div>
                <div style="float:left; width:100%;">
                    <label>
                        <span><?php echo $this->lang->line('reg_user_account_information_email_address');?> 
						<font>(<?php echo $this->lang->line('reg_user_required');?>)</font></span>
						<div class="user_msg" id="email_message" style="display:none;"></div>
                        <label class="error" for="email1" generated="true"></label>
                        <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                        <input placeholder="<?php echo $this->lang->line('reg_user_account_information_email_field');?>"  name="email" id="email1" type="text" tabindex="8"  class="required email" value="<?php echo set_value('email'); ?>">
                    </label>
                </div>
                <div style="float:left; width:100%;">
                    <label>
                        <span><?php echo $this->lang->line('reg_user_account_information_confirmation_email');?> <font>(<?php echo $this->lang->line('reg_user_required');?>)</font></span>
                         <label class="error" for="email2" generated="true"></label>
                         <?php echo form_error('email2', '<div class="error">', '</div>'); ?>
						 <div class="user_msg" id="email_message" style="display:none;"></div>
                        <input placeholder="<?php echo $this->lang->line('reg_user_account_information_confirmation_email_field');?>" type="text" tabindex="9" name="email2" id="email2" class="required email" equalTo='#email1' value="<?php echo set_value('email2'); ?>" onKeyUp="document.getElementById('email_message').style.display='none'">
                    </label>
                </div>
                <div style="float:left; width:100%;">
                    <label>
                        <span><?php echo $this->lang->line('reg_user_account_information_password_to_access_account');?> 
                            <font>(<?php echo $this->lang->line('reg_user_required');?>)</font></span>
                         <label class="error" for="pass" generated="true"></label>
                         <?php echo form_error('password', '<div class="error">', '</div>'); ?>
                        <input placeholder="<?php echo $this->lang->line('reg_user_account_information_password_to_access_account_field');?>" type="password" name="password" id="pass" tabindex="10" pattern=".{8,}" class="required" value="<?php echo set_value('password'); ?>" onfocus='this.type="password"' maxlength="255">
                    </label>
                </div>
                <div style="float:left; width:100%;">
                    <label>
                        <span><?php echo $this->lang->line('reg_user_repeat_password');?> <font>(<?php echo $this->lang->line('reg_user_required');?>)</font></span>
                        <label class="error" for="pass2" generated="true"></label>
                        <?php echo form_error('pass2', '<div class="error">', '</div>'); ?>
                        <input placeholder="<?php echo $this->lang->line('reg_user_repeat_password_field');?>" type="password" tabindex="11" name="pass2" id="pass2" pattern=".{8,}"  class="required" value="<?php echo set_value('pass2'); ?>" onfocus='this.type="password"' maxlength="255">
                    </label>
                </div>
                <div style="float:left; width:100%;">
            	<label>
                	<span><?php echo $this->lang->line('reg_user_type_the_character');?></span>
                   <?php echo $cap_img ?><br/>
                   <input placeholder="<?php echo $this->lang->line('reg_user_type_the_character_field');?>" 
                          name="captcha" type="text"  class="required"> 
 					 <!--<input placeholder="Repeat password" type="text" id="captcha" name="captcha" value="" />-->
                     <div class="error"><?php  if(isset($captcha_err) && $captcha_err!=''){ echo $captcha_err;} ?></div>
                </label>
            </div>
            <div style="float:left; width:100%; margin-top:12px;">
            	<label style="float:left; width:5%; margin-top:5px; "><input name="agree_terms" type="checkbox" value="1"  class="required" ></label><p style="float:left; width:95%"><?php echo $this->lang->line('reg_user_I_have_read_and_agree');?> <a href="<?php echo base_url();?>site/cmsPages/terms-of-use" target="_blank"><?php echo $this->lang->line('reg_user_owner_general_condition');?></a> <?php echo $this->lang->line('reg_user_and_the');?> <a href="<?php echo base_url();?>site/cmsPages/privacy" target="_blank"><?php echo $this->lang->line('reg_user_owner_privacy_policy');?></a></p>
                <br/>
                <label class="error" for="agree_terms" generated="true"></label>
                <?php echo form_error('agree_terms', '<div class="error">', '</div>'); ?>
            </div>
            <div style="float:left; width:100%; margin-top:12px;">
            	<label style="float:left; width:5%; margin-top:5px; "><input name="receive_mail" type="checkbox" value="1" ></label><p style="float:left; width:95%"><?php echo $this->lang->line('reg_user_wish_to_receive_informations');?></p>
            </div>
            <div style="float:left; width:100%; margin-top:12px;">
            	<input name="submit" type="submit" value="<?php echo $this->lang->line('reg_user_button_register');?>">
            
            </div>
            <?php echo form_close();?>
            <!--</form>-->
        </div>
    </div>
</div>
<script type="text/javascript">
var categories = [];
$(function() {
	$("#username").blur(function() {
		var user_name=$("#username").val();
		$("#user_message").hide();
		$("#user_message").html("");
		if(user_name == "" || user_name == null ) {
			return false;
		}else if(user_name == "<?php echo $this->lang->line('reg_agency_account_information_user_name_field');?>"){
			return false;
		}  
		$.ajax({
			type:"post",
			url:"<?php echo base_url();?>users/check_user_avail",
			data: { user_name:user_name },
			async: false,
			success:function(data){
				$("#user_message").show();
				if(data==0){
					// $("#user_message").html("<span style='color:green;'><?php echo $this->lang->line('agency_edit_user_name_available');?></span>");
					//$('input[type="submit"]').removeAttr('disabled');
					if($.inArray('username', categories)!==-1){
						categories = jQuery.grep(categories, function(value) {
							return value != 'username';
						});
					}
				}
				else{
					$("#user_message").html("<span style='color:Red;font-weight:normal'><?php echo $this->lang->line('agency_edit_user_name_already_taken');?></span>");
					//$('input[type="submit"]').attr('disabled','disabled');
					//return false;
					if($.inArray('username', categories)==-1){
						categories.push('username');
					}
				}
				$('input[type="submit"]').removeAttr('disabled');
			}
		});
	});
	$("#email1").blur(function() {
		$("#email_message").hide();
		$("#email_message").html("");
		var email=$("#email1").val();
		var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		if (filter.test(email)) {
			//return true;
		}else{
			$('#email1').css( "border", "1px solid red" );
			//$( "#email1").focus();
			$('#email1').attr("placeholder","<?php echo $this->lang->line('agency_edit_proper_email_address_required');?>");
			$( "#email1").keyup(function() {
				$('#email1').css( "border", "1px #AACA9E solid" );
				$('input[type="submit"]').removeAttr('disabled');
			});
			return false;
		}		
		if(email == "" || email == null ) {
			return false;
		}
		$.ajax({
			type:"post",
			url:"<?php echo base_url();?>users/check_email_avail",
			data: { email:email },
			async: false,
			success:function(data){
				$("#email_message").show();
				if(data==0){
					//$("#email_message").html("<span style='color:green;font-weight:normal;'><?php echo $this->lang->line('agency_edit_email_id_available');?></span>");
					//$('input[type="submit"]').removeAttr('disabled');
					if($.inArray('email1', categories)!==-1){
						categories = jQuery.grep(categories, function(value) {
							return value != 'email1';
						});
					}
				}else{
					$("#email_message").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('agency_edit_email_id_already_taken');?></span>");
					//$('input[type="submit"]').attr('disabled','disabled');
					//return false;
					if($.inArray('email1', categories)==-1){
						categories.push('email1');
					}
				}
				$('input[type="submit"]').removeAttr('disabled');
			}
		});
	});	
	$("#ph_no").blur(function(){
		$("#ph_message").hide();
		$("#ph_message").html("");
		//alert("hello");	
		var a = $("#ph_no").val();
		if(a.length>6){
			var filter = /^[0-9+]+$/;
			if (filter.test(a)) {
				//alert("ok");
				return true;
			}else{
				$("#ph_message").show();
				//alert("No");
				$("#ph_message").html("<span style='color:Red;font-weight:normal;'><?php //echo $this->lang->line('reg_owner_phone_required_informations');?></span>");
				//$('input[type="submit"]').attr('disabled','disabled');
				$( "#ph_no").val('');
				//$( "#ph_no").focus();
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
function fb_login(base_url) {
    FB.login(function(response) {
        if (response.authResponse) {
            access_token = response.authResponse.accessToken; //get access token
            user_id = response.authResponse.userID; //get FB UID			
            FB.api('/me?fields=birthday,first_name,last_name,email,id,gender,age_range', function(response) {
                //alert(response.toSource());
                //die();
                //==================================================================
                user_email = response.email; //get user email
                fb_id = response.id; //get user facebook id
                //==================================================================
                if ((typeof(response.birthday) != "undefined")) {
                    birthday = response.birthday; //get birthday date
                } else {
                    birthday = '';
                }
                //=================================================================
                if ((typeof(response.gender) != "undefined")) {
                    gender = response.gender; //get user gender
                } else {
                    gender = '';
                }
                //==================================================================
                first_name = response.first_name; //get first name
                if (typeof(response.last_name) != "undefined") {
                    last_name = response.last_name; // get Last name
                } else {
                    last_name = '';
                }
                //var data_json = '{"email":"'+response.email+'","id":'+response.id+',"cover":"'+cover_pics+'","picture":"'+profile_pics+'","fname":"'+first_name+'","lname":"'+last_name+'"}';
                //var data_id = btoa(data_json);
                
                var jqXHR = $.ajax({
                    type: "POST",
                    url: base_url + "users/facebookLogin",
                    data: {
                        email: user_email,
                        fb_id: fb_id,
                        birthday: birthday,
                        gender: gender,
                        first_name: first_name,
                        last_name: last_name
                    },
                    async: false,
                    success: function(result){                    
                        if ($.trim(result) == 1) {
                            window.location = base_url + 'users/my_account';
                        } else if ($.trim(result) == 2) {
                            location.reload();
                        }
                    }
                });
                //alert(jqXHR.toSource());
                if (jqXHR.responseText == 1) {
                    //window.location = base_url+'seller';
                    $("#error_msg").html("<?php echo $this->lang->line('reg_user_user_invalid_user_email');?>");
                }else if (jqXHR.responseText == 2) {
                    //$("#error_msg").html("You are already registered in our site with direct registration. If are you want to login please use login form. ");
                    window.location = base_url + 'dashboard/';
                }else if (jqXHR.responseText == 3) {
                    $("#error_msg").html("<?php echo $this->lang->line('reg_user_user_admin_blocked_account');?>");
                }else {
                    //window.location = base_url+'users/fbregistration/'+encodeURIComponent(data_id);
                }
                // you can store this data into your database             
            });
        }else {
            //user hit cancel button
            console.log('<?php echo $this->lang->line('reg_user_user_authorize ');?>');
        }
    },{scope: 'publish_actions,email'});
}
</script>
<div id="fb-root" ></div>
 <!------ footer part ------------->
<?php $this->load->view("inc/footer");?>