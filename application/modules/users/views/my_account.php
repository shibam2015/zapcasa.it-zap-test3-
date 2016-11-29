<?php $this->load->view("inc/header"); ?>
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
		 
		
		
    },
    messages: {
         password: {
            required: "<?php echo $this->lang->line('my_account_please_provide_a_password');?>",
			alphabetsnspace: "<?php echo $this->lang->line('my_account_your_password_must_be_atleast');?> !  ? $ % ^ & ",
            minlength: "<?php echo $this->lang->line('my_account_your_password_must_be_atleast_8_character_long');?>"
        },
        pass2: {
            required: "<?php echo $this->lang->line('my_account_please_provide_a_password');?>",
            minlength: "<?php echo $this->lang->line('my_account_your_password_must_be_atleast_8_character_long');?>",
            equalTo: "<?php echo $this->lang->line('my_account_please_enter_the_same_password_as_above');?>"
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
<!------ banner part ------------->
<div class="insidepage_banner">
	<div class="main">
    	<h2><?php echo $this->lang->line('my_account_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('my_account_jobs');?></font> <?php echo $this->lang->line('my_account_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('my_account_housing');?></font></h2>
    </div>
</div>
<!----- login pop up start  --------------------->
 <?php
 $this->load->view("_include/login_user"); 
 ?>          
<!----- login pop up end --------------------->
<!------ body part ------------->
<div class="main">
	<!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
    <div class="registercomn_box">
    	<!--<div class="arrow_box error_message" style="color:#ED6B1F;">Almost Done! Check the information before sending the form or to modify them if wrong</div>
        <div class="charater_icon"><img src="<?php //echo base_url();?>assets/images/signup_agency_edit_icon.jpg" alt=""></div>-->
         <?php 
			$new_arr=$user_detail;
			echo '<pre>';
			print_r($new_arr);die;
		
		?>
        <?php
		
				$attributes = array('class' => 'register-form', 'id' => 'register');
				echo form_open_multipart('users/confirm_individual_reg', $attributes);		
			?>
        <table width="100%" cellpadding="0" cellspacing="0"  class="form-edit">
        <tr>
           	 	<td><?php echo $this->lang->line('my_account_account_information_user_name');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                <span class="shown"><?php echo $new_arr[0]['user_name'];?></span>
               
                </td>
            </tr>
        	<tr>
           	 	<td><?php echo $this->lang->line('my_account_personal_informations_first_name');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                <span class="shown"><?php echo $new_arr[0]['first_name'];?></span>
                <span class="edit_shown" style="display:none;"><input type="text" name="first_name" value="<?php echo $new_arr[0]['first_name'];?>" class="required"></span>
                <label class="error" for="first_name" generated="true"></label>
                </td>
            </tr>
            <tr>
           	 	<td><?php echo $this->lang->line('my_account_personal_informations_last_name');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                <span class="shown"><?php echo $new_arr[0]['last_name'];?></span>
                <span class="edit_shown" style="display:none;">
                <input type="text" name="last_name" value="<?php echo $new_arr[0]['last_name'];?>" class="required" >
                </span>
                 <label class="error" for="last_name" generated="true"></label>
                </td>
            </tr>
            <tr>
           	 	<td><?php echo $this->lang->line('my_account_birthday');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                <span class="shown"><?php echo date('d-M-Y',strtotime($new_arr[0]['date_of_birth']));?></span>
                <span class="edit_shown" style="display:none;">
             <input type="text" name="date_of_birth" id="datepicker" readonly  value="<?php echo $new_arr[0]['date_of_birth'];?>" class="required">
             </span>
             <label class="error" for="datepicker" generated="true"></label>
                </td>
            </tr>
            <tr>
           	 	<td><?php echo $this->lang->line('my_account_gender');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                 <span class="shown">
                 <?php
                 	if($new_arr[0]['gender']==1){ echo 'Female';}
					else{ echo 'Male';}
				 ?>
                 
                 
                 </span>
                 <span class="edit_shown" style="display:none;">
                 <p style="float:left;  margin-right:5px;"><label style="float:left; padding-top:3px; padding-right:5px;"><input type="radio" name="gender" value="1"  class="required" <?php if($new_arr[0]['gender']==1){?> checked<?php }?> ></label><font style="float:left;"><?php echo $this->lang->line('my_account_gender_female');?></font></p>
                        <p style="float:left; "> <label style="float:left; padding-top:3px; padding-right:5px;">
                        <input type="radio" name="gender" value="0" <?php if($new_arr[0]['gender']==0){?> checked<?php }?>></label><font style="float:left;"><?php echo $this->lang->line('my_account_gender_male');?></font></p>
                  </span>      
                        
                        
                 </td>
            </tr>
            <tr>
           	 	<td><?php echo $this->lang->line('my_account_country');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                <span class="shown"><?php echo get_perticular_field_value('zc_country_master','name'," and id_countries='".$new_arr[0]['country']."'");?></span>
                <span class="edit_shown" style="display:none;">
                <select name="country"  class="required">
                        	
                            <?php
                            	foreach($countries as $country)
								{
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
           	 	<td><?php echo $this->lang->line('my_account_city');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                 <span class="shown">
                 <?php echo $new_arr[0]['city'];?>
                 </span>
                 <span class="edit_shown" style="display:none;">
                <input type="text" name="city" value="<?php echo $new_arr[0]['city'];?>" class="required">
                </span>
                <label class="error" for="city" generated="true"></label>
                </td>
            </tr>
            <tr>
           	 	<td><?php echo $this->lang->line('my_account_telephone');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                <span class="shown"><?php echo $new_arr[0]['contact_ph_no'];?></span>
                <span class="edit_shown" style="display:none;">
                <input type="text" name="ph_no" value="<?php echo $new_arr[0]['contact_ph_no'];?>">
                </span>
                
                </td>
            </tr>
            <tr>
           	 	<td><?php echo $this->lang->line('my_account_account_information_email_address');?></td>
                <td width="5%"></td> 
                <td class="usernme">
                <span class="shown">
                <?php echo $new_arr[0]['email_id']; ?>
                </span>
                <span class="edit_shown" style="display:none;">
                <input type="text" name="email" value="<?php echo $new_arr[0]['email_id']; ?>" class="required email" id="emailss" onKeyUp="document.getElementById('message').style.display='none'" >
                </span>
                <div class="user_msg" id="message" style="display:none;"></div>
                <label class="error" for="email" generated="true"></label>
                </td>
            </tr>
        </table>
        <!--<div style="margin-top:20px; margin-left:42%;">
        	<input type="submit" class="mainbt" value="Send">
            <input type="button" class="mainbt" value="Edit" onClick="return edit_me();">
        	        
        </div>-->
        <?php echo form_close();?>
         <!--<div class="impt_message"><img src="images/information_icon.png" alt="">The information marked with (<font style="color:#ED6B1F">*</font>)may no longer be modified.</div>-->
    </div>
</div>
<script>
 function edit_me()
 {
	 $(".shown").hide();
	 $(".edit_shown").show();
	 

 }
</script>
<script type="text/javascript">
        $(window).load(function()
        {
            $('#datepicker').datepicker({ dateFormat: 'dd-mm-yy',changeYear: true,yearRange: "-100:+0",onClose: function() {$(this).valid();} });
			
			
        });
		
		$(function() {
	 $("#emailss").blur(function(){
            var email=$("#emailss").val();
            $("#message").html("");
		 	$("#message").hide();
		 	var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
			if (filter.test(email)) {
				//return true;
			}else{
				$('#emailss').css( "border", "1px solid red" );
				$( "#emailss").focus();
				$('#emailss').attr("placeholder","<?php echo $this->lang->line('agency_edit_proper_email_address_required');?>");
				$( "#emailss").keyup(function() {
					$('#emailss').css( "border", "1px #AACA9E solid" );
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
                        $("#message").show();
                        if(data==0){
                            $("#message").html("<span style='color:green;'><?php echo $this->lang->line('my_account_email_id_available');?></span>");
							$('input[type="submit"]').removeAttr('disabled');
                        }
                        else{
                            $("#message").html("<span style='color:Red;'><?php echo $this->lang->line('my_account_email_id_already_taken');?></span>");
							$('input[type="submit"]').attr('disabled','disabled');
							//return false;
                        }
                    }
                 });
 
            });
	
	});
	
    </script>


<!------ footer part ------------->
<?php $this->load->view("_include/footer");?>
