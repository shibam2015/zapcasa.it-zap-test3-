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
<?php $this->load->view("_include/header"); ?>
<!------ banner part ------------->
<div class="insidepage_banner">
	<div class="main">
    	<h2><?php echo $this->lang->line('thanks_user_act_alredy_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('thanks_user_act_alredy_jobs');?></font> <?php echo $this->lang->line('thanks_user_act_alredy_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('thanks_user_act_alredy_housing');?></font></h2>
    </div>
</div>
<!----- login pop up start  --------------------->
 <?php
 $this->load->view("_include/login_user"); 
 ?>          
<!----- login pop up end --------------------->
<!------ body part ------------->
<br><br><br>
<div class="main">
	<div id="breadcrumb" class="fk-lbreadbcrumb newvd">
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('thanks_user_act_alredy_home');?></a></span> >  
        <span><a href="<?php echo base_url();?>users/common_reg"><?php echo $this->lang->line('thanks_user_act_alredy_register');?></a></span> >
        <span><a href="<?php echo base_url();?>users/comon_signup"><?php echo $this->lang->line('thanks_user_act_alredy_sign_up_as_individual_user');?></a></span> >
        <span><?php echo $this->lang->line('thanks_user_act_alredy_thanks');?></span>
    </div>
	<div class="registercomn_box">
    	<div class="congratulations"><img src="<?php echo base_url();?>assets/images/WAITING.png" alt=""></div>
    	<div class="mainsucc_box">
            <div class="suceesfulbox">
                <span style="width:100%;">
                    <h1><?php echo $this->lang->line('thanks_user_act_alredy_whats_going_on');?></h1>
                    <p><?php echo $this->lang->line('thanks_user_act_alredy_your_account_is_already_activated');?></p>
                </span>    
            </div>
            <div style=" margin-left:39%;margin-bottom:20px;float:left;">
                <a class="mainbt topopup" href="javascript:void(0);"><?php echo $this->lang->line('thanks_user_act_alredy_signin');?></a> 
            </div>
        </div>
    </div>
</div>


<!------ footer part ------------->
<?php $this->load->view("_include/footer");?>
