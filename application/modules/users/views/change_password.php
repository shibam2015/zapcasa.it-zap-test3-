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
         return this.optional(element) || /((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%?"^!-]).{8,20})/.test(value);
});
    $("#register1").validate({
    rules: {
        oldpassword: {
            required: true,
            remote: {
                url: "change_password_process",
                type: "post",
                data: {
                    oldpassword: function () {
                        return $("#oldpass").val();
                    }
                }
            }
        },
        password: {
            required: true,
			alphabetsnspace: true,
            minlength: 8
        },
        pass2: {
            required: true,
            minlength: 8,
            equalTo: "#pass"
        }
		
		
    },
    messages: {
       oldpassword: {
            required: "<?php echo $this->lang->line('change_password_please_enter_your_actual_password');?>",
           remote: "<?php echo $this->lang->line('change_password_you_enter_a_wrong_password');?>"
        },
       password: {
            required: "<?php echo $this->lang->line('change_password_please_provide_a_password');?>",
			alphabetsnspace: "<?php echo $this->lang->line('change_password_your_password_must_be_atleast');?> !  ? $ % ^ & ",
            minlength: "<?php echo $this->lang->line('change_password_your_password_must_be_atleast_8_character_long');?>"
        },
        pass2: {
            required: "<?php echo $this->lang->line('change_password_please_provide_a_password');?>",
            minlength: "<?php echo $this->lang->line('change_password_your_password_must_be_atleast_8_character_long');?>",
            equalTo: "<?php echo $this->lang->line('change_password_please_enter_the_same_password_as_above');?>"
        }
    }
});
});
</script>
</head>

<body class="noJS">
<?php
	if( $this->session->userdata( 'user_id' ) == "" || $this->session->userdata( 'user_id' ) == "0" ) {
		header('Location: '.base_url());
		die;
	}
?>
<script>
var bodyTag = document.getElementsByTagName("body")[0];
bodyTag.className = bodyTag.className.replace("noJS", "hasJS");
</script>
<!------ Header part ------------->
<?php $this->load->view("_include/header"); ?>
<!------ banner part ------------->
<div class="insidepage_banner">
	<div class="main">
    	<h2><?php echo $this->lang->line('change_password_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('change_password_jobs');?></font> <?php echo $this->lang->line('change_password_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('change_password_housing');?></font></h2>
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
    <span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('change_password_home');?></a></span> > <span><?php echo $this->lang->line('change_password_heading_change_password');?></span>
     </div>
     
     
    	 <div style="margin-top:10px;">
    <ul class="listing-tabs">
        <li><a href="<?php echo base_url();?>users/my_account"><?php echo $this->lang->line('change_password_listing_tab_my_account');?></a></li>
        <li class="active"><a href="javascript:void(0);"><?php echo $this->lang->line('change_password_listing_tab_change_password');?></a></li>
        <li><a href="<?php echo base_url();?>users/my_preference"><?php echo $this->lang->line('change_password_listing_tab_my_preferences');?></a></li>
        <li class="delete-tab"><a href="<?php echo base_url();?>users/delete_account"><?php echo $this->lang->line('change_password_listing_tab_delete_account');?></a></li>
    </ul>
    </div>
   
	<!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
	<div class="registercomn_box">
    	
        <div class="owner_registbox">
     
<div>
	<?php  if($this->session->flashdata('success')!='') { ?>
		<div class="success" id="successDIV" ><?php echo $this->session->flashdata('success'); ?></div>
	<?php } ?>
    <?php  if($this->session->flashdata('error')!='') { ?>
        <div class="error" id="errorDIV" ><?php echo $this->session->flashdata('error'); ?></div>
    <?php } ?>
</div> 
       	<?php
		$new_arr=$this->session->all_userdata();
		//echo '<pre>';print_r($new_arr)
		$attributes = array('class' => 'register-form', 'id' => 'register1');
		echo form_open_multipart('users/change_password', $attributes);		
		?>
               <h2><?php echo $this->lang->line('change_password_change_your_password');?></h2>
               
                <div style="float:left;width:100%;border-bottom:1px solid #dddddd;margin-bottom:15px;padding-bottom:15px;">
                    <label>
                        <span><font style="color:#ffffff;font-weight:700;background:#3D8AC1;margin-right:10px;padding:3px 8px;-webkit-border-radius:25%;-moz-border-radius:25%;-o-border-radius:25%;border-radius:25%;">1</font> <?php echo $this->lang->line('change_password_enter_old_password');?> <font>(<?php echo $this->lang->line('change_password_required');?>)</font></span>
                         <label class="error" for="oldpass" generated="true"></label>
                        <input placeholder="<?php echo $this->lang->line('change_password_enter_old_password_field');?>" type="password" name="oldpassword" id="oldpass" tabindex="1" class="required" value="<?php echo set_value('password'); ?>" onfocus='this.type="password"'>
                    </label>
                </div>

                 <div style="float:left; width:100%;">
                    <label>
                        <span><font style="color:#ffffff;font-weight:700;background:#3D8AC1;margin-right:10px;padding:3px 8px;-webkit-border-radius:25%;-moz-border-radius:25%;-o-border-radius:25%;border-radius:25%;">2</font> <?php echo $this->lang->line('change_password_password_to_access_the_account');?> <font>(<?php echo $this->lang->line('change_password_required');?>)</font></span>
                         <label class="error" for="pass" generated="true"></label>
                        <input placeholder="<?php echo $this->lang->line('change_password_password_to_access_the_account_field');?>" type="password" name="password" id="pass" tabindex="1" class="required" value="<?php echo set_value('password'); ?>" onfocus='this.type="password"'>
                    </label>
                </div>
                <div style="float:left; width:100%;">
                    <label>
                        <span><font style="color:#ffffff;font-weight:700;background:#3D8AC1;margin-right:10px;padding:3px 8px;-webkit-border-radius:25%;-moz-border-radius:25%;-o-border-radius:25%;border-radius:25%;">3</font> <?php echo $this->lang->line('change_password_repeat_password');?> <font>(<?php echo $this->lang->line('change_password_required');?>)</font></span>
                        <label class="error" for="pass2" generated="true"></label>
                        <input placeholder="<?php echo $this->lang->line('change_password_repeat_password_field');?>" type="password" tabindex="1" name="pass2" id="pass2"  class="required" value="<?php echo set_value('pass2'); ?>" onfocus='this.type="password"'>
                    </label>
                </div>
                
             <div style=" margin-left:188px;float:left; width:100%;">
             <input name="submit" type="submit" value="<?php echo $this->lang->line('change_password_button_save');?>">  
             </div>
            
           
            <?php echo form_close();?>
            
            <!--</form>-->
        </div>
    </div>
</div>
<script>
$(document).ready(function() {	
	setTimeout(function(){$("#successDIV").hide();},4000);
});

</script>

<!------ footer part ------------->
<?php $this->load->view("_include/footer");?>
