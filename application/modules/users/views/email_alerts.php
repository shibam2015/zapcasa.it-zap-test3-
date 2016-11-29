<?php $this->load->view("_include/meta"); ?>
<style>
/*jquery error styles */
div.error{ float: left; color: red; padding-right: .5em;  }
label.error { float: left; color: red; padding-right: .5em;  }
.notificaton_label{
	margin:0;
	padding:0;
	line-height:30px;
	border-bottom:1px dashed #d1d1d1;
}
.yes{
	color:#3d8ac1;
}
.no{
	color:#F00;
}
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
    	<h2><?php echo $this->lang->line('email_alert_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('email_alert_jobs');?></font> <?php echo $this->lang->line('email_alert_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('email_alert_housing');?></font></h2>
    </div>
</div>
<!----- login pop up start  --------------------->
 <?php
 $this->load->view("_include/login_user"); 
 ?>          
<!----- login pop up end --------------------->
<!------ body part ------------->
<?php
	$uid=$this->session->userdata( 'user_id' );
?>
<div class="main">
	<div id="breadcrumb" class="fk-lbreadbcrumb newvd">
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('email_alert_home');?></a></span> >
        <span><?php echo $this->lang->line('email_alert_heading_my_email_alerts');?></span>
    </div>
    <ul class="listing-tabs">
        <li><a href="<?php echo base_url();?>property/get_saved_property"><?php echo $this->lang->line('email_alert_save_property');?></a></li>
        <li><a href="<?php echo base_url();?>property/get_saved_search"><?php echo $this->lang->line('email_alert_save_searches');?></a></li>
        <li class="active"><a href="<?php echo base_url();?>users/my_email_alerts"><?php echo $this->lang->line('email_alert_my_email_alerts');?></a></li>
        <!--<li><a href="#"></a>My preferences</li>
        <li class="delete-tab"><a href="#">Delete account</a></li>-->
    </ul>
	<!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
	<div class="registercomn_box">
    <div class="property-info-box">
            	<div class="property-add-img">
                	<img src="<?php echo base_url();?>assets/images/add_newproperty_icon.jpg" alt="" >
                </div>
                <div class="property-add">
               <?php  echo $content=get_perticular_field_value('zc_cmspages','content_en'," and slug ='email-alert'");?>
                    <!--<a href="#" class="read-property">Read More</a>-->
                </div>
            </div>
    
    	
       <div class="email_allerts">
        <?php echo $this->lang->line('email_alert_recommended_properties');?>
       </div>
       <div style=" margin-top:5px;">
       <table>
          <tr>
              <td colspan="4" style="text-align:center;"> <?php echo $this->lang->line('email_alert_sorry_no_recommendation_found');?> </td>
          </tr>
       </table>
       
       </div>
        
      </div>
       
		
     
    </div>
</div>
<script>
////////invisible////////////////////////////////
$( "#invisible" ).change(function() {
	if($('#invisible').is(':checked'))
	{
		$('#my_address_display').prop('checked',true);
		$('#my_contact_info').prop('checked',true);
	}
	else
	{
		$('#my_address_display').prop('checked',false);
		$('#my_contact_info').prop('checked',false);
	}

});
//////////
$( "#my_address_display" ).change(function() {
	if($('#my_address_display').is(':checked') && $('#my_contact_info').is(':checked') )
	{
		$('#invisible').prop('checked',true);
		
	}
	else
	{
		$('#invisible').prop('checked',false);
	}

});
//////////
$( "#my_contact_info" ).change(function() {
	if($('#my_address_display').is(':checked') && $('#my_contact_info').is(':checked') )
	{
		$('#invisible').prop('checked',true);
		
	}
	else
	{
		$('#invisible').prop('checked',false);
	}

});




</script>


<!------ footer part ------------->
<?php $this->load->view("_include/footer");?>
