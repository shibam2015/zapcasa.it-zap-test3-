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
    	<h2><?php echo $this->lang->line('thanks_property_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('thanks_property_jobs');?></font> <?php echo $this->lang->line('thanks_property_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('thanks_property_housing');?></font></h2>
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
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('thanks_property_home');?></a></span> > 
        <span><?php echo $this->lang->line('thanks_property_thanks');?></span>
    </div>
	<!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
	<div class="registercomn_box">
    	<div class="congratulations"><img src="<?php echo base_url();?>assets/images/register_thanks_icon.jpg" alt=""></div>
    	<div class="mainsucc_box">
            <div class="suceesfulbox">
            <div>
                <img src="<?php echo base_url();?>assets/images/success_icon.jpg" alt="" >
                <span style="float:right !important;">
                   <h1><?php echo $this->lang->line('thanks_property_congratulations');?></h1>
                    <br>
                    
                    
                  </span> 
                  <div class="clear"></div> 
                </div>  
                    <p style="text-align:center;"><?php echo $this->session->flashdata('msg');?></p>
                    
            </div>
            <div style=" margin-left:45%; margin-bottom:20px; float:left;">
                <a class="mainbt" href="<?php echo base_url();?>property/property_details"><?php echo $this->lang->line('thanks_property_ok');?></a> 
            </div>
        </div>
    </div>
</div>


<!------ footer part ------------->
<?php $this->load->view("_include/footer");?>
