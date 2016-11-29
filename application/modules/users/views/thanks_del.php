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
    	<h2><?php echo $this->lang->line('thanks_del_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('thanks_del_jobs');?></font> <?php echo $this->lang->line('thanks_del_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('thanks_del_housing');?></font></h2>
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
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('thanks_del_home');?></a></span> >
        <span><?php echo $this->lang->line('thanks_del_thanks');?></span>
    </div>
	<!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
	<div class="registercomn_box">
    <div class="arrow_box error_message" id="msg_box_general" style="color:#FF7602;"><?php echo $this->lang->line('thanks_del_as_you_requested');?>
            
             </div>
    	<div class="congratulations"><img src="<?php echo base_url();?>assets/images/register_thanks_icon.jpg" alt="" style="margin-top:75px;margin-left:34px;"></div>
    	<div class="mainsucc_box">
            <div class="suceesfulbox">
            <div>
               
                <span>
                    <h1><?php echo $this->lang->line('thanks_del_account_successfully_deleted');?></h1>
                    <br>
                    <p style="font-size: 13px !important;">
                    <?php echo $this->lang->line('thanks_del_thank_you_for_using_zapCasa_services');?>
                    </p>  
                    
                  </span> 
                  <div class="clear"></div> 
                </div>  
                   
                    <p><br></p>
                    <p><?php echo $this->lang->line('thanks_del_we_hope_you_have_achieved_your_goals');?>
                    </p>
                    <p><br></p>
					
            </div>
            <div style=" margin-left:24%; margin-bottom:20px; float:left;">
                <a class="mainbt" href="<?php echo base_url();?>"><?php echo $this->lang->line('thanks_del_back_to_home_page');?></a> 
            </div>
        </div>
    </div>
</div>


<!------ footer part ------------->
<?php $this->load->view("_include/footer");?>
