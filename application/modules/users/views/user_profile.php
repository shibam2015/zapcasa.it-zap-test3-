<?php $this->load->view("inc/header");?>
<style>
/*jquery error styles */
div.error{ float: left; color: red; padding-right: .5em;}
label.error{float: left; color: red; padding-right: .5em;font-size:13px;}
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
			ph_no:{
				minlength: 7,
				maxlength: 15
			}
		},onfocusout: function (element, event){
			if (element.id === "ph_no"){
				this.element(element);
			}
		}
	});	
});
</script>
<!------ banner part ------------->
<div class="insidepage_banner">
    <div class="main">
        <h2><?php echo $this->lang->line('user_profile_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('user_profile_jobs');?></font> <?php echo $this->lang->line('user_profile_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('user_profile_housing');?></font></h2>
    </div>
</div>
<div class="main">
	<div id="breadcrumb" class="fk-lbreadbcrumb newvd">
		<?php
		if(isset($tab_icon) && $tab_icon==1){
		?>
		<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('user_profile_home');?></a></span> > <span><?php echo $this->lang->line('user_profile_my_account');?></span>
		<?php
		}else{
		?>
		<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('user_profile_home');?></a></span> >  
		<span><a href="<?php echo base_url();?>users/common_reg"><?php echo $this->lang->line('user_profile_register');?></a></span> >
		<span><a href="<?php echo base_url();?>users/comon_signup"><?php echo $this->lang->line('user_profile_sign_up_as_individual_user');?></a></span> >
		<span><?php echo $this->lang->line('user_profile_summary_screen_for_individual_user');?></span>
		<?php
		}
		?>    
	</div>
	<div style="margin-top:10px;">
		<ul class="listing-tabs">
			<li class="active"><a href="javascript:void(0);"><?php echo $this->lang->line('user_profile_listing_tab_my_account');?></a></li>
			<li><a href="<?php echo base_url();?>users/change_password"><?php echo $this->lang->line('user_profile_listing_tab_change_password');?></a></li>
			<li><a href="<?php echo base_url();?>users/my_preference"><?php echo $this->lang->line('user_profile_listing_tab_my_preferences');?></a></li>
			<li class="delete-tab"><a href="<?php echo base_url();?>users/delete_account"><?php echo $this->lang->line('user_profile_listing_tab_delete_account');?></a></li>
		</ul>
	</div>
	<!--
	<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2> 
	-->
	<div class="registercomn_box">
		<!-- 
		<div class="arrow_box error_message" style="color:#ED6B1F;">Almost Done! Check the information before sending the form or to modify them if wrong</div>
		<div class="charater_icon"><img src="<?php //echo base_url();?>assets/images/signup_agency_edit_icon.jpg" alt=""></div> 
		-->
		<?php 
		$new_arr=$user_detail;//print_r($new_arr);die;?>
		<div>
		<?php
		if($this->session->flashdata('success')!=''){
			?>
			<div class="success" id="successDIV"><?php echo $this->session->flashdata('success'); ?></div>
			<?php
		}
		?>
		</div>
		<?php
		$attributes = array('class' => 'register-form', 'id' => 'register');
		echo form_open_multipart('users/update_user_reg', $attributes);		
		?>
		<table width="100%" cellpadding="0" cellspacing="0"  class="form-edit">
			<tr>
				<td style="width:45%;">
					<font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font>
					<?php echo $this->lang->line('user_profile_personal_informations_first_name');?>
				</td>
				<td width="5%"></td>
				<td class="usernme">
					<span class="shown"><?php echo $new_arr[0]['first_name'];?></span>
					<label class="error" for="first_name" generated="true"></label>
					<span class="edit_shown" style="display:none;"><input type="text" name="first_name" value="<?php echo $new_arr[0]['first_name'];?>" class="required"></span>
				</td>
			</tr>
			<tr>
				<td>
					<font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font>
					<?php echo $this->lang->line('user_profile_personal_informations_last_name');?>
				</td>
				<td width="5%"></td>
				<td class="usernme">
					<span class="shown"><?php echo $new_arr[0]['last_name'];?></span>
					<label class="error" for="last_name" generated="true"></label>
					<span class="edit_shown" style="display:none;">
						<input type="text" name="last_name" value="<?php echo $new_arr[0]['last_name'];?>" class="required" >
					</span>					
				</td>
			</tr>
			<tr>
				<td>
					<font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font>
					<?php echo $this->lang->line('user_profile_birthday');?>
				</td>
				<td width="5%"></td>
				<td class="usernme">
					<span class="shown">
					<?php
					switch(date('m',strtotime($new_arr[0]['date_of_birth']))){
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
					echo date('d',strtotime($new_arr[0]['date_of_birth'])).' '.$monthName.' '.date('Y',strtotime($new_arr[0]['date_of_birth']));
					?>
					</span>
					<span class="edit_shown" style="display:none;">
						<?php
							$dobexp=$new_arr[0]['date_of_birth'];
							$dobexpdatata=explode("-",$dobexp);
							//echo $dobexpdatata[0];
							//echo $dobexpdatata[1];
							?>
						<?php
							$cdate=date("Y");
							$selecteddate=$dobexpdatata[0];  
							$selectedmonth=$dobexpdatata[1];  
							$selectedyear=$dobexpdatata[2];  
							?>
						<div style="width:30%; float:left;">
							<?php echo form_error('reg_day', '<div class="error">', '</div>'); ?>
							<label class="error" for="reg_day" generated="true" style="font-weight:normal;"></label>
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
							<label class="error" for="reg_month" generated="true" style="font-weight:normal;"></label>
							<select name="reg_month" id="reg_month" class="required">
								<option value=''><?php echo $this->lang->line('user_registration_birth_month');?></option>
								<option value='01' <?php if($selectedmonth=='01'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month01');?></option>
								<option value='02' <?php if($selectedmonth=='02'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month02');?></option>
								<option value='03' <?php if($selectedmonth=='03'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month03');?></option>
								<option value='04' <?php if($selectedmonth=='04'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month04');?></option>
								<option value='05' <?php if($selectedmonth=='05'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month05');?></option>
								<option value='06' <?php if($selectedmonth=='06'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month06');?></option>
								<option value='07' <?php if($selectedmonth=='07'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month07');?></option>
								<option value='08' <?php if($selectedmonth=='08'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month08');?></option>
								<option value='09' <?php if($selectedmonth=='09'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month09');?></option>
								<option value='10' <?php if($selectedmonth=='10'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month10');?></option>
								<option value='11' <?php if($selectedmonth=='11'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month11');?></option>
								<option value='12' <?php if($selectedmonth=='12'){ echo 'selected';}?>><?php echo $this->lang->line('user_registration_birth_month12');?></option>
							</select>
						</div>
						<div style="width:30%; float:left;">
							<?php echo form_error('reg_year', '<div class="error">', '</div>'); ?>
							<label class="error" for="reg_year" generated="true" style="font-weight:normal;"></label>
							<select name="reg_year" id="reg_year" class="required" >
								<option value=''><?php echo $this->lang->line('user_registration_birth_year');?></option>
								<?php
									for($y=$cdate;$y>=($cdate-100);$y--){
										if($selectedyear==$y){
											echo "<option value='".$y."' selected>".$y."</option>";
										}else{
											echo "<option value='".$y."'>".$y."</option>";
										}
									  }
									 
									?>
							</select>
						</div>
						<!--<input type="text" name="date_of_birth" id="datepicker" readonly  value="<?php echo $new_arr[0]['date_of_birth'];?>" class="required">-->
					</span>					
				</td>
			</tr>
			<tr>
				<td><?php echo $this->lang->line('user_profile_gender');?></td>
				<td width="5%"></td>
				<td class="usernme">
					<span class="shown">
					<?php
						if($new_arr[0]['gender']==1){ echo $this->lang->line('user_profile_gender_female');}
						else{ echo $this->lang->line('user_profile_gender_male');}
						?>
					</span>
					<span class="edit_shown" style="display:none;">
						<p style="float:left;  margin-right:5px;"><label style="float:left; padding-top:3px; padding-right:5px;"><input type="radio" name="gender" value="1"  class="required" <?php if($new_arr[0]['gender']==1){?> checked<?php }?> ></label><font style="float:left;"><?php echo $this->lang->line('user_profile_gender_female');?></font></p>
						<p style="float:left; "> <label style="float:left; padding-top:3px; padding-right:5px;">
							<input type="radio" name="gender" value="0" <?php if($new_arr[0]['gender']==0){?> checked<?php }?>></label><font style="float:left;"><?php echo $this->lang->line('user_profile_gender_male');?></font>
						</p>
					</span>
				</td>
			</tr>
			<tr>
				<td>
					<font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font>
					<?php echo $this->lang->line('user_profile_country');?>
				</td>
				<td width="5%"></td>
				<td class="usernme">
					<span class="shown">
						<?php echo get_perticular_field_value('zc_country_master','name'," and id_countries='".$new_arr[0]['country']."'");?>
					</span>
					<label for="country" generated="true" class="error" style="font-weight:normal;"></label>
					<span class="edit_shown" style="display:none;">
						<select id="country" name="country" class="required">
							<option value=""><?php echo $this->lang->line('reg_user_please_select_your_country');?></option>
							<?php
							foreach($countries as $country){
							?>
							<option value="<?php echo $country['id_countries'];?>" <?php if($country['id_countries']==$new_arr[0]['country']){?> selected <?php }?>><?php echo $country['name'];?></option>
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
					<?php echo $this->lang->line('user_profile_city');?>
				</td>
				<td width="5%"></td>
				<td class="usernme">
					<span class="shown"><?php echo $new_arr[0]['city'];?></span>
					<label class="error" for="city" generated="true" style="font-weight:normal;"></label>
					<span class="edit_shown" style="display:none;">
						<input type="text" name="city" id="city" value="<?php echo $new_arr[0]['city'];?>" class="required">
					</span>
				</td>
			</tr>
			<tr>
				<td><?php echo $this->lang->line('user_profile_telephone');?></td>
				<td width="5%"></td>
				<td class="usernme">
					<span class="shown"><?php echo $new_arr[0]['contact_ph_no'];?></span>
					<label class="error" for="ph_no" generated="true" style="font-weight:normal;"></label>
					<span class="edit_shown" style="display:none;">
						<input type="text" id="ph_no" name="ph_no" value="<?php echo $new_arr[0]['contact_ph_no'];?>" minlength="7" maxlength="15">
					</span>
				</td>
			</tr>
			<tr>
				<td><?php echo $this->lang->line('user_profile_account_information_user_name');?></td>
				<td width="5%"></td>
				<td class="usernme">
					<span class="shown1">
					<?php echo $new_arr[0]['user_name']; ?>
					</span>
				</td>
			</tr>
			<tr>
				<td>
					<font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font>
					<?php echo $this->lang->line('user_profile_account_information_email_address');?>
				</td>
				<td width="5%"></td>
				<td class="usernme">
					<span class="shown"><?php echo $new_arr[0]['email_id']; ?></span>
					<div class="user_msg" id="message" style="display:none;"></div>
					<label class="error" for="emailss" generated="true"></label>
					<span class="edit_shown" style="display:none;">
						<input type="text" name="email" value="<?php echo $new_arr[0]['email_id']; ?>" class="required email" id="emailss" onKeyUp="document.getElementById('message').style.display='none';">
					</span>					
				</td>
			</tr>
		</table>
		<div style="margin-top:20px; margin-left:42%;">
			<?php
				if(isset($tab_icon) && $tab_icon==1)
				{
				?>
			<!--<input type="submit" class="mainbt" value="Send">-->
			<input type="button" class="mainbt" value="<?php echo $this->lang->line('user_profile_button_edit');?>" onClick="return edit_me();" id="shown"> 
			<input type="submit" class="mainbt" value="<?php echo $this->lang->line('user_profile_button_update');?>" id="edit_shown" style="display:none;"> 
			<input type="button" class="mainbt" value="<?php echo $this->lang->line('owner_profile_button_cancel');?>" id="edit_shown_cancel" style="display:none;" onClick="window.location.replace('my_account')">
			<?php
				}
				?>         
		</div>
		<!--<div style="margin-top:20px; margin-left:42%;">
			<input type="submit" class="mainbt" value="Send">
			   <input type="button" class="mainbt" value="Edit" onClick="return edit_me();">
					
			</div>-->
		<?php echo form_close();?>
		<div class="impt_message"><img src="<?php echo base_url();?>assets/images/information_icon.png" alt=""><?php echo $this->lang->line('owner_profile_the_information_marked_with');?> (<font style="color:#ED6B1F">*</font>) <?php echo $this->lang->line('owner_profile_is_no_longer_be_modified');?></div>
		<!--<div class="impt_message"><img src="images/information_icon.png" alt="">The information marked with (<font style="color:#ED6B1F">*</font>)may no longer be modified.</div>-->
	</div>
</div>
<script>
    function edit_me()
    {
     $(".shown").hide();
     $(".edit_shown").show();
      $("#shown").hide();
     $("#edit_shown").show();
     $("#edit_shown_cancel").show();
    
    }
</script>
<script type="text/javascript">
    $(window).load(function(){
        $('#datepicker').datepicker({
			dateFormat: 'dd-mm-yy',
			changeYear: true,
			yearRange: "-100:+0",
			onClose: function() {
				$(this).valid();
			}
		});
    });
    $(function() {
		$("#emailss").change(function(){    
			var email=$("#emailss").val();
			$("#message").html("");
			$("#message").hide();
			if(email == "" || email == null ) {
				return false;
			}
			var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			if (filter.test(email)) {
				//return true;
			}else{
				//$('#emailss').css( "border", "1px solid red" );
				$( "#emailss").focus();
				$('#emailss').attr("placeholder","<?php echo $this->lang->line('agency_edit_proper_email_address_required');?>");
				$( "#emailss").keyup(function() {
					//$('#emailss').css( "border", "1px #AACA9E solid" );
				});
				return false;
			}
			$.ajax({
                type:"post",
                url:"<?php echo base_url();?>users/check_email_avail_after_reg",
                data: { email:email },
				async: false,
				success:function(data){
					$("#message").show();
					//alert(data);
					if(data==0){
                        //$("#message").html("<span style='color:green;font-weight:normal;'><?php echo $this->lang->line('user_profile_email_id_available');?></span>");
						$('input[type="submit"]').removeAttr('disabled');
					}else if(data==1){
                        $("#message").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('user_profile_email_id_already_taken');?></span>");
						//$('input[type="submit"]').attr('disabled','disabled');
						//return false;
                    }else{
						$("#message").hide();
					}
                }
			});   
        });    
	});
    $(function(){
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
	$(document).ready(function() {	
		setTimeout(function(){$("#successDIV").hide();},4000);
    });   
</script>
<!------ footer part ------------->
<?php $this->load->view("inc/footer");?>
