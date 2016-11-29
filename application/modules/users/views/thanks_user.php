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
    	<h2><?php echo $this->lang->line('thanks_user_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('thanks_user_jobs');?></font> <?php echo $this->lang->line('thanks_user_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('thanks_user_housing');?></font></h2>
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
        <span><?php echo $this->lang->line('thanks_user_thanks');?></span>
    </div>
	<div class="registercomn_box">
    	<div class="congratulations"><img src="<?php echo base_url();?>assets/images/register_thanks_icon.jpg" alt=""></div>
    	<div class="mainsucc_box">
          <div class="suceesfulbox">
            <div>
                <img src="<?php echo base_url();?>assets/images/success_icon.jpg" alt="">
                <span style="float:right !important;">
                    <h1><?php echo $this->lang->line('thanks_user_congratulations');?></h1>
                    <p style="font-size: 13px !important;"><?php echo $msg;?></p>  
                </span> 
                <div class="clear"></div> 
            </div>  
                <p style="text-align:center;"><?php echo $this->lang->line('thanks_user_for_your_security');?></p>
                <p><br></p>
                <p style="text-align: center;"><?php echo $this->lang->line('thanks_user_content');?></p>
                <p><br></p>
				<p style="font-weight: bold; text-align:center;"><?php echo $this->lang->line('thanks_user_you_have_72_hours_to_activate_your_account');?></p>
          </div>
            <div style=" margin-left:45%; margin-bottom:20px; float:left;">
                <a class="mainbt" href="<?php echo base_url();?>"><?php echo $this->lang->line('thanks_user_ok');?></a> 
            </div>
        </div>
    </div>
</div>


<!------ footer part ------------->
<?php $this->load->view("_include/footer");?>
