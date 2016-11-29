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
				required: "<?php echo $this->lang->line('agency_edit_please_provide_a_password');?>",
				alphabetsnspace: "<?php echo $this->lang->line('agency_edit_your_password_must_be_atleast');?> ! ? $ % ^ - @ + _ .",
				minlength: "<?php echo $this->lang->line('agency_edit_your_password_must_be_atleast_8_character_long');?>"
			},pass2: {
				required: "<?php echo $this->lang->line('agency_edit_please_provide_a_password');?>",
				minlength: "<?php echo $this->lang->line('agency_edit_your_password_must_be_atleast_8_character_long');?>",
				equalTo: "<?php echo $this->lang->line('agency_edit_please_enter_the_same_password_as_above');?>"
			},user_name: {
				alphanumeric: "<?php echo $this->lang->line('agency_edit_user_name_atleast'); ?>"
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
    	<h2><?php echo $this->lang->line('agency_edit_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('agency_edit_jobs');?></font> <?php echo $this->lang->line('agency_edit_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('agency_edit_housing');?></font></h2>
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
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('agency_edit_home');?></a></span> >  
        <span><a href="<?php echo base_url();?>users/common_reg"><?php echo $this->lang->line('agency_edit_register');?></a></span> >
        <span><a href="<?php echo base_url();?>users/reg_agency"><?php echo $this->lang->line('agency_edit_sign_up_as_agency');?></a></span> >
        <span><?php echo $this->lang->line('agency_edit_check_agency_information');?></span>
    </div>
	<!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
	<div class="registercomn_box">
    	<div class="arrow_box error_message" style="color:#ED6B1F;">
			<?php echo $this->lang->line('agency_edit_almost_done_check_the_information');?>
		</div>
        <div class="charater_icon">
			<img src="<?php echo base_url();?>assets/images/signup_agency_edit_icon.jpg" alt="">
		</div>
        <?php 
		if(!isset($edit_mode) || $edit_mode != 1)
        	$new_arr=$this->session->all_userdata();
		//print_r($new_arr);
		$attributes = array('class' => 'register-form', 'id' => 'register');
		echo form_open_multipart('users/confirm_agency_reg', $attributes);		
		?>
        <table width="100%" cellpadding="0" cellspacing="0" class="form-edit">
        	<tr><td colspan="3" style="text-align:center; color:#F18D52;"><?php echo $this->lang->line('agency_edit_company_informations');?></td></tr>
            <tr><td colspan="3" style="text-align:center; color:#000"><?php echo $this->lang->line('agency_edit_company');?></td></tr>
        	<tr>
           	 	<td width="48%"><font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font><?php echo $this->lang->line('agency_edit_company_name');?></td>
                <td width="4%"></td> 
                <td width="48%" class="usernme">
					<span class="shown"><?php echo $new_arr['company_name'];?></span>
					<div class="comp_name_msg" id="comp_name_msg_id" style="display:none;"></div>
					<label class="error" for="comp_name" id="comp_name_id" generated="true"></label>
					<span class="edit_shown" style="display:none;">
						<input placeholder="<?php echo $this->lang->line('agency_edit_company_name_field');?>" type="text" name="company_name" id="comp_name" class="required" value="<?php echo $new_arr['company_name'];?>" maxlength="250">
					</span>
                </td>
            </tr>
            <tr>
           	 	<td><font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font><?php echo $this->lang->line('agency_edit_company_business_name');?></td>
                <td width="5%"></td> 
                <td class="usernme">
					<span class="shown"><?php echo $new_arr['business_name'];?></span>
					<div class="buss_name_msg" id="buss_name_msg_id" style="display:none;"></div>
					<label class="error" for="buss_name" id="buss_name_id" generated="true"></label>
					<span class="edit_shown" style="display:none;">
						<input placeholder="<?php echo $this->lang->line('agency_edit_company_business_name_field');?>" type="text" name="business_name" id="buss_name" class="required" value="<?php echo$new_arr['business_name'];?>" maxlength="250"> 
					</span>                
                </td>
            </tr>
            <tr>
           	 	<td><font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font><?php echo $this->lang->line('agency_edit_company_vat_no');?></td>
                <td width="5%"></td> 
                <td class="usernme">
					<span class="shown"><?php echo $new_arr['vat_number'];?></span>					
					<label class="error" for="vat_number" generated="true" style="display:none;"></label>
					<div class="user_msg" id="user_message_vat" style="display:none;"></div>
					<span class="edit_shown" style="display:none;"> 
						<input placeholder="<?php echo $this->lang->line('agency_edit_company_vat_no_field');?>"  type="text" name="vat_number" id="vat_number" maxlength="16" class="midium_last required" value="<?php echo $new_arr['vat_number'];?>" onKeyUp="document.getElementById('user_message_vat').style.display='none'" style="width:92%;">
					</span>
				</td>
            </tr>
			<tr>
				<td colspan="3" style="text-align:center; color:#000"><?php echo $this->lang->line('agency_edit_owner');?></td>
			</tr>
			<tr>
           	 	<td><?php echo $this->lang->line('agency_edit_owner_first_name');?></td>
                <td width="5%"></td> 
                <td class="usernme">
				<span class="shown"><?php echo $new_arr['first_name']; ?></span>
				<label class="error" for="first_name" generated="true"></label>
                <span class="edit_shown" style="display:none;">
					<input disabled type="text" class="required" name="first_name" maxlength="25" value="<?php echo $new_arr['first_name'];?>">
					<input type="hidden" name="first_name" value="<?php echo $new_arr['first_name']; ?>">
                </span>
				
                
                </td>
            </tr>
            <tr>
           	 	<td><?php echo $this->lang->line('agency_edit_owner_last_name');?></td>
                <td width="5%"></td> 
                <td class="usernme">
				<span class="shown"><?php echo $new_arr['last_name']; ?></span>
				<label class="error" for="last_name" generated="true"></label>
                <span class="edit_shown" style="display:none;">
					<input disabled type="text" class="required" name="last_name" maxlength="50" value="<?php echo $new_arr['last_name'];?>">
					<input type="hidden" name="last_name" value="<?php echo $new_arr['last_name']; ?>">
                </span>
				</td>
            </tr>
			<tr>
           	 	<td><?php echo $this->lang->line('agency_edit_owner_direct_phone');?></td>
                <td width="5%"></td> 
                <td class="usernme">
				<span class="shown"><?php echo $new_arr['contact_ph_no']; ?></span>
				<label class="error" for="contact_ph_no" generated="true"></label>
                <span class="edit_shown" style="display:none;">
					<input disabled type="text" class="required" name="contact_ph_no" value="<?php echo $new_arr['contact_ph_no'];?>" maxlength="15">
					<input type="hidden" name="contact_ph_no" value="<?php echo $new_arr['contact_ph_no']; ?>">
                </span>
				
                </td>
            </tr>           
            <tr>
				<td colspan="3" style="text-align:center; color:#F18D52"><?php echo $this->lang->line('agency_edit_owner_contact_informations');?></td>
			</tr>
            <tr>
           	 	<td><?php echo $this->lang->line('agency_edit_owner_province');?></td>
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
					<label class="error" for="province" generated="true"></label>
                    <span class="edit_shown" style="display:none;">
                    	 <select disabled name="province" id="province"  class="required" onChange="return get_city(this.value);" style="width:98%">
                        	<option value=""><?php echo $this->lang->line('agency_edit_please_select_your_province');?></option>
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
           	 	<td><?php echo $this->lang->line('agency_edit_city_of_residence');?></td>
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
				  <select disabled name="city" id="city"  class="required" style="width:98%">
                        	<?php foreach($city as $key=>$val){?>
                            <option value="<?php echo $val;?>" <?php echo(stripslashes($val)==$new_arr['city']?'selected':($val==$ct_nameNm?'selected':'')); ?>>
								<?php echo stripslashes($val);?>
							</option>
                            <?php }?>
                    </select>
					<input type="hidden" name="city" value="<?php echo $ct_nameNm; ?>">
                  </span>
                
                </td>
            </tr>
            <tr>
           	 	<td><?php echo $this->lang->line('agency_edit_owner_address');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                <span class="shown">
				<?php if($new_arr['street_address']!=''){echo $new_arr['street_address'].',';} ?>
				<?php if($new_arr['street_no']!=''){echo $new_arr['street_no'].',';} ?>
				<?php if($new_arr['zip']!=''){echo $new_arr['zip'];} ?>
                </span>
                <span class="edit_shown" style="display:none;">
					<label class="error" for="street_address" generated="true"></label>
					<input disabled placeholder="<?php echo $this->lang->line('agency_edit_owner_street_address_field');?>" maxlength="250" type="text" name="street_address" class="required" value="<?php echo $new_arr['street_address'];?>" >
					<label class="error" for="street_no" generated="true"></label>
					<input disabled placeholder="<?php echo $this->lang->line('agency_edit_owner_street_no_field');?>" type="text" maxlength="20" class="required" name="street_no" value="<?php echo $new_arr['street_no'];?>" >
					<label class="error" for="zip" generated="true"></label>
					<input disabled placeholder="<?php echo $this->lang->line('agency_edit_owner_zip_code_field');?>" type="text" maxlength="15" class="required" name="zip" value="<?php echo $new_arr['zip'];?>" >
                
					<input type="hidden" name="street_address" value="<?php echo $new_arr['street_address']; ?>">
					<input type="hidden" name="street_no" value="<?php echo $new_arr['street_no']; ?>">
					<input type="hidden" name="zip" value="<?php echo $new_arr['zip']; ?>">
				
				</span>
                
                </td>
            </tr>
            <tr>
           	 	<td><?php echo $this->lang->line('agency_edit_landline_phone');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                	 <span class="shown">
					<?php echo $new_arr['phone_1']; ?>
                </span>
				<label class="error" for="phone_1" generated="true"></label>
                <span class="edit_shown" style="display:none;">
                	<input disabled type="text" class="required" name="phone_1" value="<?php echo $new_arr['phone_1'];?>" maxlength="15">
					<input type="hidden" name="phone_1" value="<?php echo $new_arr['phone_1']; ?>">
                </span>
                </td>
            </tr>
            <tr>
           	 	<td><?php echo $this->lang->line('agency_edit_mobile');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                 <span class="shown">
					<?php echo $new_arr['phone_2']; ?>
                </span>				
                <span class="edit_shown" style="display:none;">
					<input disabled type="text" name="phone_2" value="<?php echo $new_arr['phone_2'];?>" maxlength="15">
					<input type="hidden" name="phone_2" value="<?php echo $new_arr['phone_2']; ?>">
                </span>                
                </td>
            </tr>
            <tr>
           	 	<td><?php echo $this->lang->line('agency_edit_company_fax');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                 <span class="shown">
					<?php echo $new_arr['fax_no']; ?>
                </span>				
                <span class="edit_shown" style="display:none;">
					<input disabled type="text" name="fax_no" value="<?php echo $new_arr['fax_no'];?>" maxlength="15">
					<input type="hidden" name="fax_no" value="<?php echo $new_arr['fax_no']; ?>">
                </span>
                
                </td>
            </tr>
            <tr>
           	 	<td><?php echo $this->lang->line('agency_edit_company_website');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                 <span class="shown">
					<?php echo $new_arr['website']; ?>
                </span>
                <span class="edit_shown" style="display:none;">
                <input disabled type="text" name="website" value="<?php echo $new_arr['website'];?>">
				<input type="hidden" name="website" value="<?php echo $new_arr['website']; ?>">
                </span>
                
                </td>
            </tr>
            <tr>
				<td colspan="3" style="text-align:center; color:#F18D52"><?php echo $this->lang->line('agency_edit_account_information');?></td>
			</tr>
            <tr>
           	 	<td><font style="font-weight:bold; color:#ED6B1F; padding-right:5px;">*</font><?php echo $this->lang->line('agency_edit_account_information_user_name');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                 <span class="shown">
                <?php echo $new_arr['user_name']; ?>
                </span>
				<div class="user_msg" id="user_message" style="display:none;"></div>
				<label class="error" for="usersname" generated="true"></label>
                <span class="edit_shown" style="display:none;">
					<input type="text" name="user_name" value="<?php echo $new_arr['user_name']; ?>" class="required" maxlength="50" id="usersname" onKeyUp="document.getElementById('user_message').style.display='none'" >
                </span>
                </td>
            </tr>
            <tr>
           	 	<td><?php echo $this->lang->line('agency_edit_account_information_email_address');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                 <span class="shown">
					<?php echo $new_arr['email_id']; ?>
                </span>
				<div class="user_msg" id="message" style="display:none;"></div>
                <label class="error" for="emailss" generated="true"></label>
                <span class="edit_shown" style="display:none;">
					<input disabled type="text" name="email" value="<?php echo ($new_arr['email_id'] == '')?$new_arr['email']:$new_arr['email_id']; ?>" class="required email" id="emailss" onKeyUp="document.getElementById('message').style.display='none'" >
					<input type="hidden" name="email" value="<?php echo ($new_arr['email_id'] == '')?$new_arr['email']:$new_arr['email_id']; ?>">
				</span>
                </td>
            </tr>
            <?php
			/*?>
			<tr class="unshown_extra" style="display:none;">
            	<td>About Yourself</td>
                <td width="5%"></td> 
                <td class="usernme"><textarea name="about_me"></textarea></td>
            </tr> 
            <tr class="unshown_extra" style="display:none;">
            	<td>Upload Your Logo</td>
                <td width="5%"></td> 
                <td class="usernme"><input type="file" name="user_file_1"></td>
            </tr> 
            <tr class="unshown_extra" style="display:none;">
            	<td>Upload Image For Your Detail Page</td>
                <td width="5%"></td> 
                <td class="usernme"><input type="file" name="user_file_2"></td>
            </tr>   <?php */?>
        </table>
        <div style="width:60%;margin:0 auto;">
			<label>
				<span><?php echo $this->lang->line('reg_agency_type_the_character');?></span>
			   <?php echo $cap_img ?><br/>
			   <div style="max-width: 390px;">
			   <label class="error" for="captcha" generated="true"></label>
			   <div class="error"><?php  if(isset($captcha_err) && $captcha_err!=''){ echo $captcha_err;} ?></div>
			   <input placeholder="<?php echo $this->lang->line('reg_agency_type_the_character_field');?>" name="captcha" type="text"  class="required"> 
				<!-- <input placeholder="Repeat password" type="text" id="captcha" name="captcha" value="" /> -->                     
			   </div>
			</label>
		</div>
		<input type="hidden" name="language_nm" value="<?php echo $_COOKIE['lang']; ?>">        
        <div style="margin-top:20px; margin-left:42%;">
        	<input type="submit" class="mainbt" value="<?php echo $this->lang->line('agency_edit_button_send');?>">
            <input type="button" class="mainbt editMeButton" value="<?php echo $this->lang->line('agency_edit_button_edit');?>" onClick="return edit_me();">         
        </div>
        <?php echo form_close();?>
		<div class="impt_message">
			<img src="<?php echo base_url();?>assets/images/information_icon.png" alt="">
			<?php echo $this->lang->line('agency_edit_the_information_marked_with'); ?> 
			(<font style="color:#ED6B1F">*</font>) 
			<?php echo $this->lang->line('agency_edit_may_no_longer_be_modified'); ?>
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
function get_city(id) {
    var name = id;
    $.post("<?php echo base_url(); ?>users/city_search",{name: name},function(result) {
		//alert(result);
		$('#city').html(result);
	});
}
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
                       // $('input[type="submit"]').removeAttr('disabled');
                    } else {
                        $("#buss_name_msg_id").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('reg_agency_bus_name_already_taken');?></span>");
                       // $('input[type="submit"]').attr('disabled', 'disabled');
                        //return false;
                    }
                } else {
                    $("#buss_name_msg_id").html("");
                  //  $('input[type="submit"]').removeAttr('disabled');
                }
				$('input[type="submit"]').removeAttr('disabled');
            }
        });
    });
	$("#emailss").blur(function() {
        var email = $("#emailss").val();
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
        $("#message").hide();
        if (email == "" || email == null) {
            return false;
        }
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
                  //  $('input[type="submit"]').removeAttr('disabled');
                } else {
                    $("#message").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('agency_edit_email_id_already_taken');?></span>");
                  //  $('input[type="submit"]').attr('disabled', 'disabled');
                    //return false;
                }
				$('input[type="submit"]').removeAttr('disabled');
            }
        });
    });
    $("#usersname").blur(function() {
        var user_name = $("#usersname").val();
        $("#user_message").hide();
        $("#user_message").html("");
        if (user_name == "" || user_name == null) {
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
                   // $('input[type="submit"]').removeAttr('disabled');
                } else {
                    $("#user_message").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('agency_edit_user_name_already_taken');?></span>");
                 //   $('input[type="submit"]').attr('disabled', 'disabled');
                    //return false;
                }
				$('input[type="submit"]').removeAttr('disabled');
            }
        });
    });
    $("#vat_number").blur(function() {
        $("#user_message_vat").hide();
        var vat_no = $("#vat_number").val();
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
                      //  $('input[type="submit"]').removeAttr('disabled');
                    } else {
                        $("#user_message_vat").html("<span style='color:Red;font-weight:normal;'><?php echo $this->lang->line('reg_agency_vat_number_already_taken');?></span>");
                      //  $('input[type="submit"]').attr('disabled', 'disabled');
                        //return false;
                    }
                } else {
                    $("#user_message_vat").html("");
                   // $('input[type="submit"]').removeAttr('disabled');
                }
				$('input[type="submit"]').removeAttr('disabled');
            }
        });
    });
});
$('INPUT[type="file"]').change(function() {
    var ext = this.value.match(/\.(.+)$/)[1];
    switch (ext) {
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
            $('#uploadButton').attr('disabled', false);
            break;
        default:
            alert('<?php echo $this->lang->line('advertise_list_home ');?>');
			this.value = '';
    }
});
</script>
<!------ footer part ------------->
<?php //$this->load->view("_include/footer");?>
<?php $this->load->view("inc/footer");?>
