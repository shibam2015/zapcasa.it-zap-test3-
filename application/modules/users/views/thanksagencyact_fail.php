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
    	<h2><?php echo $this->lang->line('thanks_agency_act_fail_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('thanks_agency_act_fail_jobs');?></font> <?php echo $this->lang->line('thanks_agency_act_fail_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('thanks_agency_act_fail_housing');?></font></h2>
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
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('thanks_agency_act_fail_home');?></a></span> >  
        <span><a href="<?php echo base_url();?>users/common_reg"><?php echo $this->lang->line('thanks_agency_act_fail_register');?></a></span> >
        <span><a href="<?php echo base_url();?>users/reg_agency"><?php echo $this->lang->line('thanks_agency_act_fail_sign_up_as_agency');?></a></span> >
        <span><?php echo $this->lang->line('thanks_agency_act_fail_thanks');?></span>
    </div>
	<div class="registercomn_box">
    	<div class="congratulations"><img src="<?php echo base_url();?>assets/images/NO.png" alt=""></div>
    	<div class="mainsucc_box">
            <div class="suceesfulbox">
                <span style="width:100%;">
                   <h1><?php echo $this->lang->line('thanks_agency_act_fail_Something_has_gone_wrong');?></h1>
                   <p><?php echo $this->lang->line('thanks_agency_act_fail_your_activation_link_is_no_longer_valid');?></p>
                </span>                   
            </div>
            <div style=" margin-left:39%;margin-bottom:20px;float:left;">
                <a class="mainbt" href="<?php echo base_url();?>users/reg_agency"><?php echo $this->lang->line('thanks_agency_act_fail_register_btn');?></a> 
            </div>
        </div>
    </div>
</div>


<!------ footer part ------------->
<?php $this->load->view("_include/footer");?>
