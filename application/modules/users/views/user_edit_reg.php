<?php $this->load->view("_include/meta"); ?>
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
            required: "Please provide a password",
			alphabetsnspace: "Your password must be at least 8 characters long and one capital letter, one number and one symbol like !  ? $ % ^ & ",
            minlength: "Your password must be at least 8 characters long"
        },
        pass2: {
            required: "Please provide a password",
            minlength: "Your password must be at least 8 characters long",
            equalTo: "Please enter the same password as above"
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
<?php $this->load->view("_include/header"); ?>
<!------ banner part ------------->
<div class="insidepage_banner">
	<div class="main">
    	<h2>Real Estate for <font style="font-weight:bold;">Jobs</font> & <font style="font-weight:bold;">Housing</font></h2>
    </div>
</div>
<!----- login pop up start  --------------------->
 <?php
 $this->load->view("_include/login_user"); 
 ?>          
<!----- login pop up end --------------------->
<!------ body part ------------->
<div class="main">
	<div id="breadcrumb" class="fk-lbreadbcrumb newvd">
    	<span><a href="index.html">Home</a></span> >  
        <span><a href="registercommon.html">Register</a></span> >
        <span><a href="signup_individualuser.html">Sign up as individual users</a></span> >
        <span>Check user information</span>
    </div>
	<!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
    <div class="registercomn_box">
    	<div class="arrow_box error_message" style="color:#ED6B1F;">Almost Done! Check the information before sending the form or to modify them if wrong</div>
        <div class="charater_icon"><img src="<?php echo base_url();?>assets/images/signup_agency_edit_icon.jpg" alt=""></div>
        <?php 
			$new_arr=$this->session->all_userdata();
			//print_r($new_arr);
		
		?>
        <table width="100%" cellpadding="0" cellspacing="0">
        	<tr>
           	 	<td>First Name :</td><td width="5%"></td>
                <td>
                <label class="error" for="first_name" generated="true"></label>
                <input placeholder="Enter your First Name" type="text" name="first_name" class="required" value="<?php echo $new_arr['first_name']; ?>" >
                </td>
            </tr>
            <tr>
           	 	<td>Last Name :</td><td width="5%"></td> 
                <td class="usernme">
                <label class="error" for="last_name" generated="true"></label>
                <input placeholder="Enter your Lat Name" type="text" name="last_name" class="required" value="<?php echo $new_arr['last_name']; ?>" >
                </td>
            </tr>
            <tr>
           	 	<td>Birthday :</td><td width="5%"></td> <td class="usernme">
                <td class="usernme">
                
                <input placeholder="Enter your Birth date" type="text" name="date_of_birth" id="datepicker" readonly class="required"  value="<?php echo $new_arr['date_of_birth']; ?>" >
                
                </td>
				
            </tr>
            <tr>
           	 	<td>Gender :</td><td width="5%"></td> 
                 <td class="usernme">
                <label class="error" for="gender" generated="true"></label>
                      	
                        <p style="float:left; width:70px; margin-right:5px;"><label style="float:left; padding-top:3px; padding-right:5px;"><input type="radio" name="gender" value="1"  class="required" ></label><font style="float:left;">Female</font></p>
                        <p style="float:left; width:60px;"> <label style="float:left; padding-top:3px; padding-right:5px;">
                        <input type="radio" name="gender" value="0"></label><font style="float:left;">Male</font></p>
                </td>
                
            </tr>
            <tr>
           	 	<td>Country :</td><td width="5%"></td>
                
                 <td class="usernme">
                <label class="error" for="country" generated="true"></label>
                        <select name="country"  class="required">
                        	<option value="">Please select your Country</option>
                            <?php
                            	foreach($countries as $country)
								{
							?>
                            <option value="<?php echo $country['id_countries'];?>" <?php if($country['id_countries']==set_value('country')){?> selected <?php }?>><?php echo $country['name'];?></option>
                            <?php
								}
							?>
                        </select>
                
                </td>
            </tr>
            <tr>
           	 	<td>City :</td><td width="5%"></td>
                 <td class="usernme">
                  <label class="error" for="city" generated="true"></label>
                        <input placeholder="Enter your City Name" type="text" name="city"  class="required" value="<?php echo $new_arr['city']; ?>"  >
                        </td>
            </tr>
            <tr>
           	 	<td>Telephone :</td><td width="5%"></td>
                 <td class="usernme">
				 <input placeholder="Enter your Telephone Number" name="ph_no" id="ph_no" type="text"  value="<?php echo $new_arr['contact_ph_no']; ?>">
				 
                 </td>
            </tr>
            <tr>
           	 	<td>Email Address :</td><td width="5%"></td> 
                <td class="usernme">
                <label class="error" for="email1" generated="true"></label>
                        
                        <input name="email" id="email1" type="text" class="required email" value="<?php echo $new_arr['email_id']; ?>">
                </td>
            </tr>
        </table>
        <div style="margin-top:20px; margin-left:42%;">
        	<a class="mainbt" href="<?php echo base_url();?>users/confirm_individual_reg">Send</a>
            <a  href="<?php echo base_url();?>users/edit_user_reg" class="mainbt" >Edit</a>       
        </div>
         <!--<div class="impt_message"><img src="images/information_icon.png" alt="">The information marked with (<font style="color:#ED6B1F">*</font>)may no longer be modified.</div>-->
    </div>
</div>



<!------ footer part ------------->
<?php $this->load->view("_include/footer");?>
