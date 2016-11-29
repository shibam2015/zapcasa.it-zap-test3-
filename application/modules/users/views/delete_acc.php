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
    	<h2><?php echo $this->lang->line('delete_acc_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('delete_acc_jobs');?></font> <?php echo $this->lang->line('delete_acc_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('delete_acc_housing');?></font></h2>
    </div>
</div>
<?php
	if( $this->session->userdata( 'user_id' ) == "" || $this->session->userdata( 'user_id' ) == "0" ) {
		header('Location: '.base_url());
		die;
	}
?>
<!----- login pop up start  --------------------->
 <?php
 $this->load->view("_include/login_user"); 
 ?>          
<!----- login pop up end --------------------->
<!------ body part ------------->

<div class="main">
	<div id="breadcrumb" class="fk-lbreadbcrumb newvd">
    <span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('delete_acc_home');?></a></span> > <span><?php echo $this->lang->line('delete_acc_heading_delete_account');?></span>    	 
    </div>
    <div style="margin-top:10px;">
    <ul class="listing-tabs">
        <li><a href="<?php echo base_url();?>users/my_account"><?php echo $this->lang->line('delete_acc_listing_tab_my_account');?></a></li>
        <li><a href="<?php echo base_url();?>users/change_password"><?php echo $this->lang->line('delete_acc_listing_tab_change_password');?></a></li>
        <li><a href="<?php echo base_url();?>users/my_preference"><?php echo $this->lang->line('delete_acc_listing_tab_my_preferences');?></a></li>
        <li class="delete-tab active"><a href="javascript:void(0);"><?php echo $this->lang->line('delete_acc_listing_tab_delete_account');?></a></li>
    </ul>
    </div>
	<!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
	<div class="registercomn_box">
    	
        <div class="owner_registbox">
       
               <h2><?php echo $this->lang->line('delete_acc_delete_your_zapcasa_account');?></h2>
               
               
                 <div style="float:left; width:100%;">
                 	<p style="font-weight:bold;color:#0D6DD8;"><?php echo $this->lang->line('delete_acc_Youve_decided_to_delete_the_zapcasa_account_for');?>
                    <?php
					$uid=$this->session->userdata( 'user_id' );
                      $user_name=get_perticular_field_value('zc_user','first_name'," and user_id='".$uid."'").' '.get_perticular_field_value('zc_user','last_name'," and user_id='".$uid."'");
					  $user_email=get_perticular_field_value('zc_user','email_id'," and user_id='".$uid."'")
					?>
                    <br><?php echo $user_name?> (<?php echo $user_email; ?>)</p>
                 	<p><?php echo $this->lang->line('delete_acc_if_you_delete_your_zapcasa_account');?></p>
                   <div style="float:left; width:100%; margin-top:12px;">
            	<label style="float:left; width:5%; margin-top:5px; "><input id="req_check" type="checkbox" value="1" onChange="return enable_button();" ></label><p style="float:left; width:95%"><span style="font-weight:bold"><?php echo $this->lang->line('delete_acc_required');?>*</span> <span style="font-size:12px;"><?php echo $this->lang->line('delete_acc_yes_I_understand_that_deletion');?></span></p>
            </div>
                </div>
                
             <div style="margin-left:97px;float:left; width:100%;">
             <?php 
			   
				$attributes = array('class' => 'register-form', 'id' => 'register');
				echo form_open_multipart('users/del_acc', $attributes);	
			 ?>
             <input class="mainbt" name="submit" type="submit" value="<?php echo $this->lang->line('delete_acc_delete_your_account');?>" onClick="return check_checkbox();" style="opacity:0.54" disabled>
             <?php echo form_close();?>  
             </div>
            
           
           
            
            <!--</form>-->
        </div>
    </div>
</div>
<script>
function enable_button()
{
	  if($("#req_check").is(':checked'))
	  {
		  $('.mainbt').css('opacity', '');
		  $('.mainbt').prop('disabled', false);
	  }
	  else
	  {
		  $('.mainbt').css('opacity', '0.54');
		  $('.mainbt').prop('disabled', true);
	  }
}
 function check_checkbox()
 {
	
	  if($("#req_check").is(':checked'))
	  {
		  return confirm('<?php echo $this->lang->line('delete_acc_are_you_sure_you_wish_to_delete_this');?>');
	  }
	  else
	  {
		  //alert('You have to checked check box first');
		  return false;
	  }
 }
</script>

<!------ footer part ------------->
<?php $this->load->view("_include/footer");?>
