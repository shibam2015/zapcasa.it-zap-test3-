<?php $this->load->view("inc/header");?>
<style>
/*jquery error styles */
div.error{ float: left; color: red; padding-right: .5em;  }
label.error { float: left; color: red; padding-right: .5em;  }
</style>
<script type="text/javascript">
$(document).ready(function() {	
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
			},
			pass2: {
				required: true,
				minlength: 8,
				equalTo: "#pass"
			},user_name:{
				required: true,
				alphanumeric: true,
				minlength: 5,
				maxlength: 100
			}		
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
			},user_name:{
				alphanumeric: "<?php echo $this->lang->line('reg_user_account_information_user_name_atleast'); ?>",
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
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('user_edit_home');?></a></span> >  
        <span><a href="<?php echo base_url();?>users/common_reg"><?php echo $this->lang->line('user_edit_register');?></a></span> >
        <span><a href="<?php echo base_url();?>users/comon_signup"><?php echo $this->lang->line('user_edit_sign_up_as_individual_user');?></a></span> >
        <span><?php echo $this->lang->line('user_edit_check_user_information');?></span>
    </div>
	<!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
    <div class="registercomn_box">
    	<div class="arrow_box error_message" style="color:#ED6B1F;"><?php echo $this->lang->line('user_edit_almost_done_check_the_information');?></div>
        <div class="charater_icon"><img src="<?php echo base_url();?>assets/images/signup_agency_edit_icon.jpg" alt=""></div>
         <?php 
			$new_arr=$this->session->all_userdata();
			//print_r($new_arr);
			if( !isset( $new_arr['user_name'] ) || ( $new_arr['user_name'] == "" ) ) {
				header("Location: " .base_url());
				die();
			}
		?>
        <?php
		
				$attributes = array('class' => 'register-form', 'id' => 'register');
				echo form_open_multipart('users/confirm_individual_reg', $attributes);		
			?>
        <table width="100%" cellpadding="0" cellspacing="0"  class="form-edit">
        	<tr>
           	 	<td width="48%">
					<font style="font-weight:bold; color:#ED6B1F; padding-right:5px;"></font>
					<?php echo $this->lang->line('user_edit_personal_informations_first_name');?>
				</td>
                <td width="4%"></td> 
                <td width="48%" class="usernme">
					<span class="shown"><?php echo $new_arr['first_name'];?></span>
					<span class="edit_shown" style="display:none;">
						<label class="error" for="first_name" generated="true" style="font-weight:normal;"></label>
						<input disabled type="text" name="first_name" value="<?php echo $new_arr['first_name'];?>" class="required">
						<input type="hidden" name="first_name" value="<?php echo $new_arr['first_name'];?>">
					</span>                
                </td>
            </tr>
            <tr>
           	 	<td><font style="font-weight:bold; color:#ED6B1F; padding-right:5px;"></font><?php echo $this->lang->line('user_edit_personal_informations_last_name');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                <span class="shown"><?php echo $new_arr['last_name'];?></span>
                <span class="edit_shown" style="display:none;">
					<label class="error" for="last_name" generated="true" style="font-weight:normal;"></label>
					<input disabled type="text" name="last_name" value="<?php echo $new_arr['last_name'];?>" class="required">
					<input type="hidden" name="last_name" value="<?php echo $new_arr['last_name'];?>">
                </span>
                
                </td>
            </tr>
            <tr>
           	 	<td><font style="font-weight:bold; color:#ED6B1F; padding-right:5px;"></font><?php echo $this->lang->line('user_edit_birthday');?></td>
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
                       
                       <select disabled name="reg_day" style="width:32.1%">
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
                       
                        <select disabled name="reg_month" style="width:32.1%">
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
                       
                       
                       <select disabled name="reg_year" style="width:32.1%">
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
                <!--<span class="shown"><?php echo date('d-M-Y',strtotime($new_arr['date_of_birth']));?></span>
                <span class="edit_shown" style="display:none;">
             <input type="text" name="date_of_birth" id="datepicker" readonly  value="<?php echo $new_arr['date_of_birth'];?>" class="required">
             </span>
             <label class="error" for="datepicker" generated="true"></label>-->
                </td>
            </tr>
            <tr>
           	 	<td><?php echo $this->lang->line('user_edit_gender');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                 <span class="shown">
                 <?php
                 	if($new_arr['gender']==1){ echo $this->lang->line('user_edit_gender_female');}
					else{ echo $this->lang->line('user_edit_gender_male');}
				 ?>
                 
                 
                 </span>
                 <span class="edit_shown" style="display:none;">
						<p style="float:left;  margin-right:5px;">
							<label style="float:left; padding-top:3px; padding-right:5px;">
								<input disabled type="radio" name="gender" value="1"  class="required" <?php if($new_arr['gender']==1){?> checked<?php }?> >
							</label>
							<font style="float:left;"><?php echo $this->lang->line('user_edit_gender_female');?></font>
						</p>
                        <p style="float:left; ">
							<label style="float:left; padding-top:3px; padding-right:5px;">
								<input disabled type="radio" name="gender" value="0" <?php if($new_arr['gender']==0){?> checked<?php }?>>
							</label>
							<font style="float:left;"><?php echo $this->lang->line('user_edit_gender_male');?></font>
						</p>
						<input type="hidden" name="gender" value="<?php echo $new_arr['gender'];?>">
					</span>      
                        
                        
                 </td>
            </tr>
            <tr>
           	 	<td><?php echo $this->lang->line('user_edit_country');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                <span class="shown"><?php echo get_perticular_field_value('zc_country_master','name'," and id_countries='".$new_arr['country']."'");?></span>
                <span class="edit_shown" style="display:none;">
                <select name="country"  class="required" disabled style="width:98%;">
                        	
                            <?php
                            	foreach($countries as $country)
								{
							?>
                            <option value="<?php echo $country['id_countries'];?>" <?php if($country['id_countries']==$new_arr['country']){?> selected <?php }?>><?php echo $country['name'];?></option>
                            <?php
								}
							?>
                        </select>
						<input type="hidden" name="country" value="<?php echo $new_arr['country'];?>">
              	</span>          
                
                
                </td>
            </tr>
            <tr>
           	 	<td><?php echo $this->lang->line('user_edit_city');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                 <span class="shown">
                 <?php echo $new_arr['city'];?>
                 </span>
                 <span class="edit_shown" style="display:none;">
                <input type="text" disabled name="city" value="<?php echo $new_arr['city'];?>" >
				<input type="hidden" name="city" value="<?php echo $new_arr['city'];?>">
                </span>
                <label class="error" for="city" generated="true"></label>
                </td>
            </tr>
            <tr>
           	 	<td><?php echo $this->lang->line('user_edit_telephone');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                <span class="shown"><?php echo $new_arr['contact_ph_no'];?></span>
                <span class="edit_shown" style="display:none;">
                <input type="text" disabled name="ph_no" value="<?php echo $new_arr['contact_ph_no'];?>">
				<input type="hidden" name="ph_no" value="<?php echo $new_arr['contact_ph_no'];?>">
                </span>
                
                </td>
            </tr>
			<tr>
           	 	<td><font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font><?php echo $this->lang->line('user_edit_account_information_user_name');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                 <span class="shown">
                <?php echo $new_arr['user_name']; ?>
                </span>
                <span class="edit_shown" style="display:none;">
				<label class="error" for="user_name" generated="true" style="font-weight:normal;"></label>
				<div class="user_msg" id="user_message" style="display:none;"></div>        
                <input type="text" name="user_name" value="<?php echo $new_arr['user_name']; ?>" class="required" id="user_name" onKeyUp="document.getElementById('user_message').style.display='none'" >
                </span>
                
                
                
                </td>
            </tr>
            <tr>
           	 	<td><?php echo $this->lang->line('user_edit_account_information_email_address');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                <span class="shown">
                <?php echo $new_arr['email_id']; ?>
                </span>
                <span class="edit_shown" style="display:none;">
                <input type="text" name="email" value="<?php echo $new_arr['email_id']; ?>" disabled class="required email" id="emailss" onKeyUp="document.getElementById('message').style.display='none'" >
                <input type="hidden" name="email" value="<?php echo $new_arr['email_id'];?>">
				</span>
                <div class="user_msg" id="message" style="display:none;"></div>
                <label class="error" for="email" generated="true"></label>
                </td>
            </tr>
        </table>
		<input type="hidden" name="language_nm" value="<?php echo $_COOKIE['lang']; ?>">
        <div style="margin-top:20px; margin-left:42%;">
        	<input type="submit" class="mainbt" value="<?php echo $this->lang->line('user_edit_button_send');?>">
            <input type="button" class="mainbt editMeButton" value="<?php echo $this->lang->line('user_edit_button_edit');?>" onClick="return edit_me();">
        </div>
        <?php echo form_close();?>
         <div class="impt_message"><img src="<?php echo base_url();?>assets/images/information_icon.png" alt=""><?php echo $this->lang->line('user_edit_the_information_marked_with');?> (<font style="color:#ED6B1F">*</font>) <?php echo $this->lang->line('user_edit_may_no_longer_be_modified');?></div>
    </div>
</div>
<script type="text/javascript">
function edit_me(){
	$(".shown").hide();
	$(".edit_shown").show();
	$('.editMeButton').hide();
}
$(window).load(function(){
	$('#datepicker').datepicker({
		dateFormat: 'dd-mm-yy',
		changeYear: true,
		yearRange: "-100:+0",
		onClose: function(){
			$(this).valid();
		}
	});
});		
$(function() {			
	$("#emailss").blur(function() {
		$("#message").html("");
        $("#message").hide();
		var email = $("#emailss").val();
		//var sEmail = $('#email').val()
		var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			if (filter.test(email)) {
				//return true;
			}else{
				$('#emailss').css( "border", "1px solid red" );
				$( "#emailss").focus();
				$('#emailss').attr("placeholder","<?php echo $this->lang->line('user_edit_proper_email_address_required');?>");
				$( "#emailss").keyup(function() {
					$('#emailss').css( "border", "1px #AACA9E solid" );
				});
				return false;
			}
		if(email == "" || email == null ) {
			return false;
		}
		if (email != "" || email != null) {
			$.ajax({
				type:"post",
				url:"<?php echo base_url();?>users/check_email_avail",
				data: { email:email },
				async: false,
				success:function(data){
					$("#message").show();
					if(data==0){
						//$("#message").html("<span style='color:green;'><?php echo $this->lang->line('user_edit_email_id_available');?></span>");
						//$('input[type="submit"]').removeAttr('disabled');
					}
					else{
						$("#message").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('user_edit_email_id_already_taken');?></span>");
						//$('input[type="submit"]').attr('disabled','disabled');
						//return false;
					}
				}
			});
		} 
	});	
	$("#user_name").blur(function() {
		 $("#user_message").hide();
		 $("#user_message").html("");
		 // $("#message").html("<img src='ajax-loader.gif' /> checking..."); 
		var user_name=$("#user_name").val();
		if (user_name == "" || user_name == null) {
			return false;
		}
		if (user_name != "" || user_name != null) {
			$.ajax({
				type:"post",
				url:"<?php echo base_url();?>users/check_user_avail",
				data: { user_name:user_name },
				async: false,
					success:function(data){
					$("#user_message").show();
					if(data==0){
						//$("#user_message").html("<span style='color:green;'><?php echo $this->lang->line('user_edit_user_name_available');?></span>");
					}
					else{
						$("#user_message").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('user_edit_user_name_already_taken');?></span>");
						//$('input[type="submit"]').attr('disabled','disabled');
						//return false;
					}
					$('input[type="submit"]').removeAttr('disabled');
				}
			});
		} 
	});	
});	
</script>
<!------ footer part ------------->
<?php $this->load->view("inc/footer");?>
