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
    	<h2><?php echo $this->lang->line('under_construction_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('under_construction_jobs');?></font> <?php echo $this->lang->line('under_construction_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('under_construction_housing');?></font></h2>
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
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('under_construction_home');?></a></span> >
        <span><?php echo $this->lang->line('under_construction_my_preference');?></span>
    </div>
	<!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
	<div class="registercomn_box">
    <div class="arrow_box error_message" id="msg_box_general" style="color:#FF7602;"><?php echo $this->lang->line('under_construction_my_preference_content');?>
            
             </div>
    	<div  class="add_newproperty_icon2">
        	<img src="<?php echo base_url();?>assets/images/add_newproperty_icon.jpg" alt="" style="margin-top:66px;margin-left:18px;">
        </div>
       
		
     
    </div>
</div>


<!------ footer part ------------->
<?php $this->load->view("_include/footer");?>
