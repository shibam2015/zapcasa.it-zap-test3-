<?php $this->load->view("_include/meta"); ?>
<style>
/*jquery error styles */
label.error { float: none; color: red; padding-left: .5em; padding-right: .5em;  }
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
	$("#register").validate();
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
    	<h2><?php echo $this->lang->line('forgot_password_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('forgot_password_jobs');?></font> <?php echo $this->lang->line('forgot_password_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('forgot_password_housing');?></font></h2>
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
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('forgot_password_home');?></a></span> >  
        <span><a href="<?php echo base_url();?>users/common_reg"><?php echo $this->lang->line('forgot_password_register');?></a></span> >
        <span><?php echo $this->lang->line('forgot_password_forgot_password');?></span>
    </div>
	<!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
	<div class="registercomn_box">
    	<div class="congratulations"></div>
    	 <?php
              if($this->session->flashdata('success')!='')
		 		{
			?>
                <div class="arrow_box error_message" style="color:#ED6B1F;"><?php echo $this->lang->line('forgot_password_open_your_email_account');?></div>
        <div class="charater_icon"><img src="<?php echo base_url();?>assets/images/register_thanks_icon.jpg" alt=""></div>
        
            <?php
				}
				 else if($this->session->flashdata('success')=='' && $this->session->flashdata('error')!='')
		 		{
			?>
            <div class="arrow_box error_message" style="color:#F00;"><?php echo $this->lang->line('forgot_password_your_email_account_is_not_valid');?></div>
             <div class="charater_icon"><img src="<?php echo base_url();?>assets/images/add_newproperty_icon.jpg" alt=""></div>
            <?php
				}
				else
				{
			?>
            <div class="arrow_box error_message" style="color:#ED6B1F;"><?php echo $this->lang->line('forgot_password_forgot_your_password_enter_your_email');?></div>
        <div class="charater_icon"><img src="<?php echo base_url();?>assets/images/add_newproperty_icon.jpg" alt=""></div>
        <?php 
				}
		?>

		 <?php
              if($this->session->flashdata('success')=='')
		 		{
			?>

            <?php
		
				$attributes = array('class' => 'register-form', 'id' => 'register');
				echo form_open_multipart('users/change_pwd', $attributes);		
			?>
            <div class="mainsucc_box">
                    <div style="float:left; width:100%;">
                    <div style="padding:15px 0 0 15px;">                        	
							<span>
								<?php echo $this->lang->line('forgot_password_email');?>
								<label class="error" for="email" generated="true" style="font-weight:normal;"></label>
							</span>
                            <input type="text" name="email" id="email" placeholder="<?php echo $this->lang->line('forgot_password_email_filed');?>" style="width:90%;" class="required email"><br/>
                        </div>
                </div>
                
                <div style=" margin-left:39%; margin-bottom:20px;">
               <input type="submit" name="Submit" value="<?php echo $this->lang->line('forgot_password_button_submit');?>" id="submit"> 
            </div>
            </div>
                <?php echo form_close();?>
                
           <?php } else {?>
           
    	
    	<div class="mainsucc_box">
            <div class="suceesfulbox">
                <img src="<?php echo base_url();?>assets/images/success_icon.jpg" alt="">
                <span>
                    <h1><?php echo $this->lang->line('forgot_password_congratulations');?></h1>
                    <p><?php echo $this->lang->line('forgot_password_a_new_password_has_been_successfully_sent');?></p>
                    </span>    
                    
            </div>
            <div style=" margin-left:39%; margin-bottom:20px; float:left;">
               <a class="mainbt topopup" href="javascript:void(0);"><?php echo $this->lang->line('forgot_password_signin');?></a> 
            </div>
        </div>
    
           <?php }?>
            
        
    </div>
</div>
<script type="text/javascript">
        $(window).load(function()
        {
            $('#datepicker').datepicker({ dateFormat: 'dd-mm-yy' });
			
        });
    </script>

<!------ footer part ------------->
<?php $this->load->view("_include/footer");?>
