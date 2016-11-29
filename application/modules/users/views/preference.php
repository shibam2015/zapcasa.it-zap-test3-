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
	$('#mypsub1').click(function(){
		
		var exdays = 1;
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires="+d.toGMTString();
		var langnm=$('#language_nm').val();
		if(langnm==''){
			langnm='it';
		}
		document.cookie = "lang =" + langnm + "; " + expires;
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
    	<h2><?php echo $this->lang->line('preference_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('preference_jobs');?></font> <?php echo $this->lang->line('preference_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('preference_housing');?></font></h2>
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
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('preference_home');?></a></span> >
        <span><?php echo $this->lang->line('preference_my_preference');?></span>
    </div>
    <ul class="listing-tabs">
        <li><a href="<?php echo base_url();?>users/my_account"><?php echo $this->lang->line('preference_listing_tab_my_account');?></a></li>
        <li><a href="<?php echo base_url();?>users/change_password"><?php echo $this->lang->line('preference_listing_tab_change_password');?></a></li>
        <li class="active"><a href="javascript:void(0);"><?php echo $this->lang->line('preference_listing_tab_my_preferences');?></a></li>
        <li class="delete-tab"><a href="<?php echo base_url();?>users/delete_account"><?php echo $this->lang->line('preference_listing_tab_delete_account');?></a></li>
    </ul>
	<!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
	<div class="registercomn_box">
    <div class="arrow_box error_message" id="msg_box_general" style="color:#FF7602;"><?php echo $this->lang->line('preference_set_up_your_preference');?>
            
             </div>
    	<div  class="add_newproperty_icon2">
        	<img src="<?php echo base_url();?>assets/images/add_newproperty_icon.jpg" alt="" style="margin-top:66px;margin-left:18px;">
        </div>
        <?php
				$new_arr=$this->session->all_userdata();
				$attributes = array('class' => 'prefernce_form', 'id' => 'register');
				echo form_open_multipart('users/my_preference', $attributes);		
			?>
        <div class="add_newproperty_table1" style="width:65%; margin-right:9%; margin-top:20px;">
        
        	<div>
            
		        <?php  if($this->session->flashdata('success')!='') { ?>
		        			<div class="success" id="successDIV" ><?php echo $this->lang->line('settings_info_success_message'); //$this->session->flashdata('success'); ?></div>
                            
		  		 <?php } ?>
	     	</div>  
	     <!---added by sumana------------------------->
		 <div class="langdiv" style="width:100%;float:left;">
		 <strong style="font-weight:bold;"><?php echo $this->lang->line('lenguage_setting');?></strong>
         <div style="width:100%;float:left;">
		 <div style="text-align:left !important;float:left;margin:14px 0px;">
				<?php
				//echo "=====".$pref_info[0]['language'];
				?>
				<select class="" name="language_nm" id="language_nm" style=" background: #fff none repeat scroll 0 0;border: 1px solid #ccc;">
					<option value="it" <?php echo($pref_info[0]['language']=='it'?'selected':''); ?>>
						<?php echo $this->lang->line('italian');?>
					</option>
					<option value="english" <?php echo(($pref_info[0]['language']=='english' || $pref_info[0]['language']=='')?'selected':''); ?>>
						<?php echo $this->lang->line('english');?>
					</option>
				</select>
			</div>
			</div>
			</div>
			
		 <!--------end-------------------------------->
          <strong style="font-weight:bold;"><?php echo $this->lang->line('preference_email_notification_setting');?></strong>
          <p class="notificaton_label"><?php echo $this->lang->line('preference_send_me_an_email_when_I_receive_new_messages');?>
          <span style="float:right;">
              <input type="checkbox" name="send_me_email" value="1" <?php if($pref_info[0]['send_me_email']=='1'){?>checked="checked"<?php }?> />
          </span>
          </p>
          <p class="notificaton_label"><?php echo $this->lang->line('preference_send_me_an_email_when_I_receive_messages_replies');?>
          <span style="float:right;">
              <input type="checkbox" name="reply_msg" value="1" id="reply_msg" <?php if($pref_info[0]['reply_msg']=='1'){?>checked="checked"<?php }?> />
          </span>
          </p>
          <p class="notificaton_label"><?php echo $this->lang->line('preference_I_wish_to_receive_email_alerts');?>
          <span style="float:right;">
              <input type="checkbox" name="email_alerts" value="1" id="email_alerts" <?php if($pref_info[0]['email_alerts']=='1'){?>checked="checked"<?php }?> />
          </span>
          </p>
          <?php
           $receive_mail=get_perticular_field_value('zc_user','receive_mail'," and user_id='".$uid."'");
		  ?>
          <p class="notificaton_label"><?php echo $this->lang->line('preference_I_wish_to_receive_information');?> 
           <span style="float:right;">
               <input type="checkbox" name="newsletter" value="1" id="newsletter" <?php if($pref_info[0]['newsletter']=='1' || $receive_mail=='1'){?>checked="checked"<?php }?> />
          </span>
          </p>
          <br />
          <?php
             $uid=$this->session->userdata( 'user_id' );
			 $user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$uid."'");
			 if($user_type=='2' || $user_type=='3') {
		  ?>
          <strong style="font-weight:bold;"> <?php echo $this->lang->line('preference_privacy_settings');?> </strong>
          <!--For Owner-->
          <p class="notificaton_label"><?php echo $this->lang->line('preference_make_me_invisible');?> <span style="color:#666666;"><?php echo $this->lang->line('preference_others_will_not_be_able');?></span>
         <span style="float:right;">
              <input type="checkbox" name="invisible" value="1" id="invisible" <?php if($pref_info[0]['invisible']=='1'){?>checked="checked"<?php }?> />
          </span>
         </p>
          <p class="notificaton_label"><?php echo $this->lang->line('preference_dont_show_my_address_on_my_page');?>
          <span style="float:right;">
              <input type="checkbox" name="my_address_display" value="1" id="my_address_display" <?php if($pref_info[0]['my_address_display']=='1'){?>checked="checked"<?php }?>  />
          </span>
          </p>
          <p class="notificaton_label"><?php echo $this->lang->line('preference_dont_show_my_contact_information_on_my_page');?>
          <span style="float:right;">
              <input type="checkbox" name="my_contact_info" value="1" id="my_contact_info" <?php if($pref_info[0]['my_contact_info']=='1'){?>checked="checked"<?php }?> />
          </span>
          </p>
          <?php
			 }
		  ?>
      	  <p style="float:right;margin-top:5px;">
                  <input type="submit" id="mypsub" value="<?php echo $this->lang->line('preference_button_submit');?>" name="submit">
           </p> 
                 
               
         <?php
           echo form_close();
		 ?>
        
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
		//$('#invisible').prop('checked',true);
		
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
		//$('#invisible').prop('checked',true);
		
	}
	else
	{
		$('#invisible').prop('checked',false);
	}

});

$(document).ready(function() {	
	setTimeout(function(){$("#successDIV").hide();},4000);
});


	


</script>


<!------ footer part ------------->
<?php $this->load->view("_include/footer");?>
