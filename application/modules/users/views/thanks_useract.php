<?php $this->load->view("_include/meta"); ?>

<script type="text/javascript">
$(document).ready(function() {	
	$('#nav li').hover(function() {
		$('ul', this).slideDown(200);
		$(this).children('a:first').addClass("hov");
	}, function() {
		$('ul', this).slideUp(100);
		$(this).children('a:first').removeClass("hov");		
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
<?php $this->load->view("_include/header");?>
<!------ banner part ------------->
<div class="insidepage_banner">
	<div class="main">
    	<h2><?php echo $this->lang->line('thanks_owner_act_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('thanks_owner_act_jobs');?></font> <?php echo $this->lang->line('thanks_owner_act_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('thanks_owner_act_housing');?></font></h2>
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
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('thanks_user_home');?></a></span> >  
        <span><a href="<?php echo base_url();?>users/common_reg"><?php echo $this->lang->line('thanks_user_register');?></a></span> >
        <span><a href="<?php echo base_url();?>users/comon_signup"><?php echo $this->lang->line('thanks_user_sign_up_as_individual_user');?></a></span> >
        <span><?php echo $this->lang->line('thanks_user_act_thanks');?></span>
    </div>
	<div class="registercomn_box">
    	<div class="congratulations"><img src="<?php echo base_url();?>assets/images/register_thanks_icon.jpg" alt=""></div>
    	<div class="mainsucc_box">
            <div class="suceesfulbox">
                <img src="<?php echo base_url();?>assets/images/success_icon.jpg" alt="">
                <span>
                    <h1><?php echo $this->lang->line('thanks_user_act_congratulations');?></h1>
					<p><?php echo $this->lang->line('thanks_user_act_your_account_successfully_activated');?></p>
                </span>    
            </div>
            <div style="margin-left:39%; margin-bottom:20px; float:left;">
                <a class="mainbt topopup" href="javascript:void(0);"><?php echo $this->lang->line('thanks_user_act_signin');?></a> 
            </div>
        </div>
    </div>
</div>


<!------ footer part ------------->
<?php $this->load->view("inc/footer");?>
