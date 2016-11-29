<?php $this->load->view("inc/header");?>
<style>
/*jquery error styles */
div.error{ float: left; color: red; padding-right: .5em;  }
label.error { float: left; color: red; padding-right: .5em;  }
#ssn{  text-transform:uppercase }
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
        return this.optional(element) || /((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%?"^!]).{8,20})/.test(value);
	});
	$.validator.addMethod("alphanumeric", function(value, element) {
		return this.optional(element) || /^\w+$/i.test(value);
	});
	$("#register").validate({
		rules:{
			first_name: {
				required: true,
				maxlength: 25
			},last_name:{
				required: true,
				maxlength: 50
			},social_secuirity_number: {
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
			password: {
				required: "<?php echo $this->lang->line('owner_edit_please_provide_a_password');?>",
				alphabetsnspace: "<?php echo $this->lang->line('owner_edit_your_password_must_be_atleast');?> ! ? $ % ^ - @ + _ .",
				minlength: "<?php echo $this->lang->line('owner_edit_your_password_must_be_atleast_8_character_long');?>"
			},pass2:{
				required: "<?php echo $this->lang->line('owner_edit_please_provide_a_password');?>",
				minlength: "<?php echo $this->lang->line('owner_edit_your_password_must_be_atleast_8_character_long');?>",
				equalTo: "<?php echo $this->lang->line('owner_edit_please_enter_the_same_password_as_above');?>"
			},user_name: {
				alphanumeric: "<?php echo $this->lang->line('owner_edit_user_name_atleast'); ?>"
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
<!------ Header part ------------->
<?php //$this->load->view("_include/header"); ?>
<!------ banner part ------------->
<div class="insidepage_banner">
	<div class="main">
    	<h2><?php echo $this->lang->line('owner_edit_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('owner_edit_jobs');?></font> <?php echo $this->lang->line('owner_edit_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('owner_edit_housing');?></font></h2>
    </div>
</div>
<!----- login pop up start  --------------------->
 <?php
 //$this->load->view("_include/login_user"); 
 ?>          
<!----- login pop up end --------------------->
<!------ body part ------------->
<div class="main">
	<div id="breadcrumb" class="fk-lbreadbcrumb newvd">
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('owner_edit_home');?></a></span> >  
        <span><a href="<?php echo base_url();?>users/common_reg"><?php echo $this->lang->line('owner_edit_register');?></a></span> >
        <span><a href="<?php echo base_url();?>users/reg_owner"><?php echo $this->lang->line('owner_edit_sign_up_as_owner');?></a></span> >
        <span><?php echo $this->lang->line('owner_edit_check_owner_information');?></span>
    </div>
	<!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
	<div class="registercomn_box">
    	<div class="arrow_box error_message" style="color:#ED6B1F;"><?php echo $this->lang->line('owner_edit_almost_done_check_the_information');?></div>
        <div class="charater_icon"><img src="<?php echo base_url();?>assets/images/signup_agency_edit_icon.jpg" alt=""></div>
        <?php 
        if(!isset($edit_mode) || $edit_mode != 1)
        	$new_arr=$this->session->all_userdata();
         //print_r($new_arr);                
        // echo "hhhhhhhhhhhhhhhh                   hhhhhhhhhhhhhhhhhh h h h h h h h h srth srtgsr g".$new_arr['email']." ".$new_arr['email_id'];exit;
        ?>
        <?php
		
        $attributes = array('class' => 'register-form', 'id' => 'register');
        echo form_open_multipart('users/confirm_owner_reg', $attributes);		
        ?>
        <table width="100%" cellpadding="0" cellspacing="0" class="form-edit">
        	<tr>
				<td colspan="3" style="text-align:center; color:#F18D52"><?php echo $this->lang->line('owner_edit_personal_informations');?></td>
			</tr>
        	<tr>
           	 	<td width="48%">
					<font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font>
					<?php echo $this->lang->line('owner_edit_personal_informations_first_name');?>
				</td>
                <td width="4%"></td> 
                <td width="48%" class="usernme">
					<span class="shown"><?php echo $new_arr['first_name'];?></span>
					<span class="edit_shown" style="display:none;">
						<label for="first_name" generated="true" class="error" style="font-weight:normal"></label>
						<input type="text" name="first_name" value="<?php echo $new_arr['first_name'];?>" class="required" tabindex="1" maxlength="25">
					</span>
                </td>
            </tr>
            <tr>
           	 	<td><font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font><?php echo $this->lang->line('owner_edit_personal_informations_last_name');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                	<span class="shown"><?php echo $new_arr['last_name'];?></span>
                    <span class="edit_shown" style="display:none;">
					<label for="last_name" generated="true" class="error" style="font-weight:normal"></label>
                	<input type="text" name="last_name" value="<?php echo $new_arr['last_name'];?>" class="required" tabindex="2" maxlength="50">
               		 </span>
                </td>
            </tr>
            <tr>
           	 	<td><font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font><?php echo $this->lang->line('owner_edit_personal_informations_social_security_number');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                	<span class="shown"><?php echo strtoupper($new_arr['social_secuirity_number']);?></span>
					 <div class="user_msg" id="user_message_ssn" style="display:none;"></div>
                    <span class="edit_shown" style="display:none;">
						<label for="ssn" generated="true" class="error" style="font-weight:normal"></label>
                    		<input placeholder="<?php echo $this->lang->line('owner_edit_personal_informations_social_security_number_field');?>" type="text" name="social_secuirity_number" id="ssn" tabindex="3" class="required" value="<?php echo $new_arr['social_secuirity_number']; ?>" onKeyUp="document.getElementById('user_message_ssn').style.display='none'" >
							<input type="hidden" id="old_ssn" value="<?php echo $new_arr['social_secuirity_number']; ?>" readonly> 
					 </span>					 
                </td>
            </tr>
            <tr>
           	 	<td><font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font><?php echo $this->lang->line('owner_edit_birthday');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                	<span class="shown">
					<?php
					switch($new_arr['reg_month']){
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
					echo $new_arr['reg_day'].' '.$monthName.' '.$new_arr['reg_year'];					
					?>
					
					<?php //echo $new_arr['date_of_birth']; ?></span>
                    <span class="edit_shown" style="display:none;">
                    
                    
                    <?php
                       $cdate=date("Y");
					  
					  
					  ?>
                       
                       <select name="reg_day" style="width:32.2%">
                            <?php
						
						for($d=1;$d<=31;$d++){
							if($d<10){
								$d='0'.$d;	
							}
							
							
							if($new_arr['reg_day']==$d){
								 echo "<option value='".$d."' selected>".$d."</option>";
							}else{
						  echo "<option value='".$d."'>".$d."</option>";
							}
						  }
					  
						?>
                       
                       </select>
                       
                        <select name="reg_month" style="width:32.2%">
                            <option value='01' <?php if($new_arr['reg_month'] =="01"){ echo "selected";}?>><?php echo $this->lang->line('user_registration_birth_month01');?></option>
                            <option value='02' <?php if($new_arr['reg_month'] =="02"){ echo "selected";}?>><?php echo $this->lang->line('user_registration_birth_month02');?></option>
                            <option value='03' <?php if($new_arr['reg_month'] =="03"){ echo "selected";}?>><?php echo $this->lang->line('user_registration_birth_month03');?></option>
                            <option value='04' <?php if($new_arr['reg_month'] =="04"){ echo "selected";}?>><?php echo $this->lang->line('user_registration_birth_month04');?></option>
                            <option value='05' <?php if($new_arr['reg_month'] =="05"){ echo "selected";}?>><?php echo $this->lang->line('user_registration_birth_month05');?></option>
                            <option value='06' <?php if($new_arr['reg_month'] =="06"){ echo "selected";}?>><?php echo $this->lang->line('user_registration_birth_month06');?></option>
                            <option value='07' <?php if($new_arr['reg_month'] =="07"){ echo "selected";}?>><?php echo $this->lang->line('user_registration_birth_month07');?></option>
                            <option value='08' <?php if($new_arr['reg_month'] =="08"){ echo "selected";}?>><?php echo $this->lang->line('user_registration_birth_month08');?></option>
                            <option value='09' <?php if($new_arr['reg_month'] =="09"){ echo "selected";}?>><?php echo $this->lang->line('user_registration_birth_month09');?></option>
                            <option value='10' <?php if($new_arr['reg_month'] =="10"){ echo "selected";}?>><?php echo $this->lang->line('user_registration_birth_month10');?></option>
                            <option value='11' <?php if($new_arr['reg_month'] =="11"){ echo "selected";}?>><?php echo $this->lang->line('user_registration_birth_month11');?></option>
                            <option value='12' <?php if($new_arr['reg_month'] =="12"){ echo "selected";}?>><?php echo $this->lang->line('user_registration_birth_month12');?></option>
                        </select>
                       
                       
                       <select name="reg_year" style="width:32.2%">
                            <?php
						
						for($y=$cdate;$y>=($cdate-100);$y--){
						  if($new_arr['reg_year']==$y){
								 echo "<option value='".$y."' selected>".$y."</option>";
							}else{
						  echo "<option value='".$y."'>".$y."</option>";
							}
						  }
					  
						?>
                       
                       </select>
                    
             	<!--<input type="text" name="date_of_birth" id="datepicker" readonly  value="<?php echo $new_arr['date_of_birth'];?>" class="required" tabindex="4" >-->
             </span>
                </td>
            </tr>
            <tr>
				<td><?php echo $this->lang->line('owner_edit_owner_province');?></td>
                <td width="5%"></td> 
                <td class="usernme">
				<span class="shown">
                    <?php
					if(!strpos($new_arr['province'], "'")===false){
						$st_name1=get_perticular_field_value('zc_region_master','province_code'," and (`province_name` = '".str_replace("'","\\\''",$new_arr['province'])."' OR `province_name_it` = '".str_replace("'","\\\''",$new_arr['province'])."') group by province_code");
					}else{
						$st_name1=get_perticular_field_value('zc_region_master','province_code'," and `province_name` LIKE '%".$new_arr['province']."%' OR `province_name_it` LIKE '%".$new_arr['province']."%' group by province_code");
					}
					$provinceFieldNm = ($_COOKIE['lang']=='english'?'province_name':'province_name_it');
					if(!strpos($new_arr['province'], "'")===false){
						$pr_nameNm=get_perticular_field_value('zc_region_master',$provinceFieldNm," and (province_name_it = '".str_replace("'","\\\''",$new_arr['province'])."' OR province_name_it = '".str_replace("'","\\\''",$new_arr['province'])."') group by province_code");
					}else{
						$pr_nameNm=get_perticular_field_value('zc_region_master',$provinceFieldNm," and (province_name LIKE '%".$new_arr['province']."%' OR province_name_it LIKE '%".$new_arr['province']."%') group by province_code");
					}
					?>
                    <?php echo stripslashes($pr_nameNm); ?><?php echo '-'.$st_name1;?>
				</span>
				<span class="edit_shown" style="display:none;">
					 <select disabled name="province" id="province" style="width:100%"  class="required" onclick="return get_city(this.value,'<?php echo $_COOKIE['lang'];?>');">
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
				<option value="<?php echo $val;?>" <?php echo(stripslashes($val)==$new_arr['province']?'selected':($val==$pr_nameNm?'selected':'')); ?>>
					<?php echo stripslashes($val); ?><?php echo '-'.$st_name;?>
				</option>
				<?php
			}
            ?>
    
    
        </select>
		<input type="hidden" name="province" value="<?php echo $pr_nameNm; ?>">
                    </span>
                </td>
            </tr> 
            <tr>
           	 	<td><?php echo $this->lang->line('owner_edit_city_of_residence');?></td>
                <td width="5%"></td>
                <td class="usernme">
				<span class="shown">
					<?php
					 $cityFieldNm = ($_COOKIE['lang']=='english'?'city':'city_it');
					if(!strpos($new_arr['city'], "'")===false){
						$ct_nameNm=get_perticular_field_value('zc_region_master',$cityFieldNm," and (`city` = '".str_replace("'","\\\''",$new_arr['city'])."' OR `city_it` = '".str_replace("'","\\\''",$new_arr['city'])."')");
					}else{
						$ct_nameNm=get_perticular_field_value('zc_region_master',$cityFieldNm," and (`city` = '".mysql_real_escape_string($new_arr['city'])."' OR `city_it` = '".mysql_real_escape_string($new_arr['city'])."')");
					}					
					echo stripslashes($ct_nameNm);
					?>
				</span>
                  <span class="edit_shown" style="display:none;">                 
				  <select disabled name="city" id="city"  class="required" tabindex="6" style="width:100%">
                        <?php
						foreach($city as $key=>$val){?>
						<option value="<?php echo $val;?>" <?php echo(stripslashes($val)==$new_arr['city']?'selected':($val==$ct_nameNm?'selected':'')); ?>>
							<?php echo stripslashes($val); ?>
						</option>
						<?php
						}
						?>
                    </select>
					<input type="hidden" name="city" value="<?php echo $ct_nameNm; ?>">
                  </span>
                </td>
            </tr>
            <tr>
           	 	<td style="width:220px;"><?php echo $this->lang->line('owner_edit_owner_address');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                <span class="shown">
				<?php if($new_arr['street_address']!=''){echo $new_arr['street_address'].',';} ?>
				<?php if($new_arr['street_no']!=''){echo $new_arr['street_no'].',';} ?>
				<?php if($new_arr['zip']!=''){echo $new_arr['zip'];} ?>
                </span>
                <span class="edit_shown" style="display:none;">
                <input disabled placeholder="<?php echo $this->lang->line('owner_edit_owner_street_address_field');?>" type="text" name="street_address" class="required" value="<?php echo $new_arr['street_address'];?>" tabindex="7" >
                 <input disabled placeholder="<?php echo $this->lang->line('owner_edit_owner_street_no_field');?>" type="text" class="required" name="street_no" value="<?php echo $new_arr['street_no'];?>" tabindex="8" >
                  <input disabled placeholder="<?php echo $this->lang->line('owner_edit_owner_zip_code_field');?>" type="text" class="required" name="zip" value="<?php echo $new_arr['zip'];?>" tabindex="9" >
                
				<input type="hidden" name="street_address" value="<?php echo $new_arr['street_address']; ?>">
				<input type="hidden" name="street_no" value="<?php echo $new_arr['street_no']; ?>">
				<input type="hidden" name="zip" value="<?php echo $new_arr['zip']; ?>">
				
				</span>
                
                </td>
            </tr>
            <tr>
            	<td colspan="3" style="text-align:center; color:#F18D52"><?php echo $this->lang->line('owner_edit_owner_contact_informations');?></td>
            </tr>
            <tr>
           	 	<td><?php echo $this->lang->line('owner_edit_landline_phone');?></td>
                <td width="5%"></td> 
                <td class="usernme">
					<span class="shown">
						<?php echo $new_arr['phone_1']; ?>
					</span>    
					<span class="edit_shown" style="display:none;">
						<input disabled type="text" class="required" name="phone_1" value="<?php echo $new_arr['phone_1'];?>" tabindex="10">
						<input type="hidden" name="phone_1" value="<?php echo $new_arr['phone_1']; ?>">
					</span>                    
                </td>
            </tr>
            <tr>
           	 	<td><?php echo $this->lang->line('owner_edit_mobile');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                <span class="shown">
					<?php echo $new_arr['phone_2']; ?>
                </span>
                <span class="edit_shown" style="display:none;">
					<input disabled type="text" name="phone_2" value="<?php echo $new_arr['phone_2'];?>" tabindex="11">
					<input type="hidden" name="phone_2" value="<?php echo $new_arr['phone_2']; ?>">
                </span>
                    
                </td>
            </tr>
            <tr>
				<td colspan="3" style="text-align:center; color:#F18D52"><?php echo $this->lang->line('owner_edit_account_information');?></td>
			</tr>
            <tr>
           	 	<td><font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font><?php echo $this->lang->line('owner_edit_account_information_user_name');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                 <span class="shown"><?php echo $new_arr['user_name']; ?></span>
                <span class="edit_shown" style="display:none;">
				<label class="error" for="user_name" generated="true" style="font-weight:normal;"></label>
				<div class="user_msg" id="user_message" style="display:none;"></div>
                <input type="text" name="user_name" value="<?php echo $new_arr['user_name']; ?>" 
                 class="required" id="user_name" onKeyUp="document.getElementById('user_message').style.display='none'" tabindex="12" maxlength="50">
                </span>
                </td>
            </tr>
            <tr>
           	 	<td><font style="font-weight:bold; color:#ED6B1F; padding-right:5px;"></font><?php echo $this->lang->line('owner_edit_account_information_email_address');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                 <span class="shown">
                <?php echo $new_arr['email_id']; ?>
                </span>
                <span class="edit_shown" style="display:none;">
				<div class="user_msg" id="message" style="display:none;"></div>
                <label class="error" for="emailss" generated="true" style="font-weight:normal;"></label>
				<input disabled type="text" name="email" value="<?php echo ($new_arr['email_id'] == '')?$new_arr['email']:$new_arr['email_id']; ?>" class="required email" id="emailss" onKeyUp="document.getElementById('message').style.display='none'">
                <input type="hidden" name="email" value="<?php echo ($new_arr['email_id'] == '')?$new_arr['email']:$new_arr['email_id']; ?>">
				</span>
                </td>
            </tr>
			<!--
			<tr class="unshown_extra" style="display:none;">
            	<td>About Yourself</td>
                <td width="5%"></td> 
                <td class="usernme"><textarea name="about_me"></textarea></td>
            </tr> 
            <tr class="unshown_extra" style="display:none;">
            	<td>Upload Your Picture</td>
                <td width="5%"></td> 
                <td class="usernme"><input type="file" name="user_file_1"></td>
            </tr> 
            <tr class="unshown_extra" style="display:none;">
            	<td>Upload Image For Your Detail Page</td>
                <td width="5%"></td> 
                <td class="usernme"><input type="file" name="user_file_2"></td>
            </tr>   -->
        </table>
        <div style="width:60%; margin: 0 auto;">
            	<label>
                	<span><?php echo $this->lang->line('reg_owner_type_the_character');?></span>
                   <?php echo $cap_img ?><br/>
                   <div style="max-width: 390px;">
				   <label class="error" for="captcha" generated="true" style="font-weight:normal;"></label>
                   <input placeholder="<?php echo $this->lang->line('reg_owner_type_the_character_field');?>" name="captcha" type="text"  class="required"> 
 					 <!--<input placeholder="Repeat password" type="text" id="captcha" name="captcha" value="" />-->
                     <div class="error"><?php  if(isset($captcha_err) && $captcha_err!=''){ echo $captcha_err;} ?></div>
                   </div>
                </label>
            </div>
        <input type="hidden" name="language_nm" value="<?php echo $_COOKIE['lang']; ?>">
        <div style="margin-top:20px; margin-left:42%;">
        	<input type="submit" class="mainbt" value="<?php echo $this->lang->line('owner_edit_button_send');?>">
            <input type="button" class="mainbt editMeButton" value="<?php echo $this->lang->line('owner_edit_button_edit');?>" onClick="return edit_me();">       
        </div>
        <?php echo form_close();?>
		<div class="impt_message">
			<img src="<?php echo base_url();?>assets/images/information_icon.png" alt="">
			<?php echo $this->lang->line('owner_edit_the_information_marked_with');?> 
			(<font style="color:#ED6B1F">*</font>) 
			<?php echo $this->lang->line('owner_edit_may_no_longer_be_modified');?>
		</div> 
    </div>
</div>

<?php 

	if(isset($edit_mode) && $edit_mode==1)
	{
		?>
			<script type="text/javascript">
				$('.shown').css('display', 'none');
				$('.register-form span.edit_shown').css('display', 'block');
				$('.editMeButton').css('display', 'none');
			</script>
		<?php
	}

?>

<script type="text/javascript">
function edit_me() {
    $(".shown").hide();
    $(".edit_shown").show();
    $(".unshown_extra").show();
	$('.editMeButton').hide();
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
        $('#city').html(result);
        $('#city option[value="<?php echo str_replace("'","\'",$new_arr['city']); ?>"]').attr('selected', 'selected');
    });
}
$(window).load(function() {
    //get_city('<?php echo $new_arr['province']; ?>','<?php echo $_COOKIE['lang'];?>');
});
$(function() {
    $("#emailss").blur(function() {
        $("#message").html("");
        $("#message").hide();
        var email = $("#emailss").val();
        if (email == "" || email == null) {
            return false;
        }
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (filter.test(email)) {
            //return true;
        } else {
            $('#emailss').css("border", "1px solid red");
            $("#emailss").focus();
            $('#emailss').attr("placeholder", "<?php echo $this->lang->line('agency_edit_proper_email_address_required');?>");
            $("#emailss").keyup(function() {
                $('#emailss').css("border", "1px #AACA9E solid");
            });
            return false;
        }
        if (email != "" || email != null) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url();?>users/check_email_avail",
                data: {
                    email: email
                },
                async: false,
                success: function(data) {
                    $("#message").show();
                    if (data == 0) {
                        $("#message").html("");
                        $('input[type="submit"]').removeAttr('disabled');
                    } else {
                        $("#message").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('owner_edit_email_id_already_taken');?></span>");
                        //$('input[type="submit"]').attr('disabled', 'disabled');
                        //return false;
                    }
                }
            });
        }
    });
    $("#user_name").blur(function() {
        $("#user_message").hide();
        $("#user_message").html("");
        var user_name = $("#user_name").val();
        if (user_name == "" || user_name == null) {
            return false;
        }
        if (user_name != "" || user_name != null) {
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
                        $("#user_message").html("");
                        //$('input[type="submit"]').removeAttr('disabled');
                    } else {
                        $("#user_message").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('owner_edit_user_name_already_taken');?></span>");
                        //$('input[type="submit"]').attr('disabled', 'disabled');
                        //return false;
                    }
                }
            });
        }
    });
	$("#ssn").blur(function() {
        $("#user_message_ssn").hide();
        $("#user_message_ssn").html("");
        var ssn = $("#ssn").val();
        var old_ssn = $("#old_ssn").val();
        if (ssn != "" || ssn != old_ssn) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url();?>users/check_ssn_avail",
                data: {
                    ssn: ssn
                },
                async: false,
                success: function(data) {
                    $("#user_message_ssn").show();
                    if (data != '2') {
                        if (data == 0) {
                            $("#user_message_ssn").html("");
                            //$('input[type="submit"]').removeAttr('disabled');
                        } else {
                            $("#user_message_ssn").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('reg_owner_social_security_number_already_taken');?></span>");
                            //$('input[type="submit"]').attr('disabled', 'disabled');
                            //return false;
                        }
                    } else {
                        $("#user_message").html("");
                       // $('input[type="submit"]').removeAttr('disabled');
                    }
                }
            });
        }
    });
});
$('INPUT[type="file"]').change(function() {
    var ext = this.value.match(/\.(.+)$/)[1];
    var ext = ext.toLowerCase();
    switch (ext) {
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
            $('#uploadButton').attr('disabled', false);
            break;
        default:
            alert('<?php echo $this->lang->line('owner_edit_invalid_image_extension ');?>');
            this.value = '';
    }
});
</script>
<!------ footer part ------------->
<?php //$this->load->view("_include/footer");?>
<?php $this->load->view("inc/footer");?>
