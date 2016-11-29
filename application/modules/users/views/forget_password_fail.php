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
    	<h2><?php echo $this->lang->line('forgot_password_fail_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('forgot_password_fail_jobs');?></font> <?php echo $this->lang->line('forgot_password_fail_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('forgot_password_fail_housing');?></font></h2>
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
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('forgot_password_fail_home');?></a></span> >  
        <span><a href="<?php echo base_url();?>users/common_reg"><?php echo $this->lang->line('forgot_password_fail_register');?></a></span> >
         <span><?php echo $this->lang->line('forgot_password_fail_forgot_password');?></span>
    </div>
	<!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
	<div class="registercomn_box">
    	<div class="charater_icon"><img src="<?php echo base_url();?>assets/images/WAITING.png" alt=""></div>
           
    	
    	<div class="mainsucc_box">
            <div class="suceesfulbox">
                <img src="<?php echo base_url();?>assets/images/error_icon.jpg" alt="">
                <span>
                    <h1><?php echo $this->lang->line('forgot_password_fail_sorry');?></h1>
                    <p><?php echo $this->lang->line('forgot_password_fail_this_is_not_a_valid_email');?></p>
                    </span>    
                    
            </div>
            <div style=" margin-left:39%; margin-bottom:20px; float:left;">
               <a class="mainbt" href="javascript:void(0);" id="topopup"><?php echo $this->lang->line('forgot_password_fail_register_btn');?></a> 
            </div>
        </div>
    
            
        
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
