<?php
  if(!isset($search_title))
  {
?><div class="topbluebar"></div>
<?php }?>
<div class="main">
<header>
	<div class="logo"><a href="<?php echo base_url();?>">
    <img src="<?php echo base_url();?>assets/images/logo.png" alt="Zapcasa"></a></div>
    <div class="header_rightpanel">
    <div class="registerpanel">
    	<div class="myzapcas">
       		 <ul id="nav">
                 <li>
                 
                	 <a href=""><?php echo $this->lang->line('header_title');?></a>
                     <?php
                 	$uid=$this->session->userdata( 'user_id' );
						
						$msg_count=get_perticular_count('zc_property_message_info'," and user_id_to='".$uid."' and read_status='0'");
						if($msg_count!='')
						{
							$mesg_cnt=$msg_count;
						}
						else
						{
							$mesg_cnt=0;
						}
						
					//echo '<pre>';print_r($nw);die;
					$user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$uid."'");
					if($uid!='0')
					{
						if($user_type=='2' || $user_type=='3')
						{
				 ?>
                     <ul>
                     
                     	<li><a href="<?php echo base_url();?>property/get_message"><?php echo $this->lang->line('mainMenu-inbox');?>  <sup class="count"><?php echo $mesg_cnt;?></sup></a></li>
                        <li><a href="<?php echo base_url();?>property/property_details"><?php echo $this->lang->line('mainMenu-propertyList');?></a></li>
                        <li><a href="<?php echo base_url();?>property/add_property_form"><?php echo $this->lang->line('mainMenu-addProperty');?></a></li>
                        <li><a href="<?php echo base_url();?>My_Feedback"><?php echo $this->lang->line('mainMenu-feedback');?></a></li>
                        <li><a href="<?php echo  base_url();?>property/get_saved_property"><?php echo $this->lang->line('mainMenu-savedProperty');?></a></li>
                        <li><a href="<?php echo base_url();?>property/get_saved_search"><?php echo $this->lang->line('mainMenu-savedSearch');?></a></li>
                       <?php /*
                        <li><a href="<?php echo base_url();?>user/my_email_alerts"><?php echo $this->lang->line('mainMenu-myEmailAlert');?></a></li>
                        */ ?>
                        <li><a href="<?php echo base_url();?>user/my_account"><?php echo $this->lang->line('mainMenu-myAccount');?></a></li>
                        <li><a href="<?php echo base_url();?>user/my_preference"><?php echo $this->lang->line('mainMenu-myPreferences');?></a></li>
                     </ul>
                      <?php
						} else{
							?>
                      <ul>
                        <li><a href="<?php echo base_url();?>property/get_message"><?php echo $this->lang->line('mainMenu-inbox');?>  <sup class="count"><?php echo $mesg_cnt;?></sup></a></li>
                        <li><a href="<?php echo base_url();?>My_Feedback"><?php echo $this->lang->line('mainMenu-feedback');?></a></li>
                        <li><a href="<?php echo  base_url();?>property/get_saved_property"><?php echo $this->lang->line('mainMenu-savedProperty');?></a></li>
                        <li><a href="<?php echo base_url();?>property/get_saved_search"><?php echo $this->lang->line('mainMenu-savedSearch');?></a></li>
                        <?php /*
						<li><a href="<?php echo base_url();?>user/my_email_alerts"><?php echo $this->lang->line('mainMenu-myEmailAlert');?></a></li>
                        */ ?>
                        <li><a href="<?php echo base_url();?>user/my_account"><?php echo $this->lang->line('mainMenu-myAccount');?></a></li>
                        <li><a href="<?php echo base_url();?>user/my_preference"><?php echo $this->lang->line('mainMenu-myPreferences');?></a></li>
                     </ul>
                            
                            <?php
						}
					}
				 ?>
                 </li>
                
             </ul>
        </div>
        <ul>
        	<?php
              $uid=$this->session->userdata( 'user_id' );
			  if($uid=='0')
			  {
			?>
        	<li><a class="topopup" href="javascript:void(0);"><?php echo $this->lang->line('signin');?></a></li>
            <!--<li><a href="registercommon.html">REGISTER</a></li>-->
            <li><a href="<?php echo base_url();?>user/common_reg"><?php echo $this->lang->line('register');?></a></li>
            <?php
			  }
			  else
			  {
				  $uname=get_perticular_field_value('zc_user','first_name'," and user_id='".$uid."'");
				  if($user_type=='2' || $user_type=='3')
						{
		
?>
 <li><a href="<?php echo base_url();?>advertiser/advertiser_details/<?php echo $uid;?>"><?php echo $this->lang->line('hi');?> <?php echo ucfirst(substr($uname,0,6)).'...';?></a></li>
<?php					
					}
						else
						{
							?>
                             <li><a href="<?php echo base_url();?>user/my_account"><?php echo $this->lang->line('hi');?><?php echo ucfirst(substr($uname,0,6)).'...';?></a></li>
							
                            <?php
						}
				 
			?>
           
            <!--<li><a href="registercommon.html">REGISTER</a></li>-->
            <li><a href="<?php echo base_url();?>user/logout"><?php echo $this->lang->line('mainMenu-logout');?></a></li>
            <?php
			  }
			?>
        </ul>
    </div>
    <div class="lanugage">
    	<select class="custom" name="countriesFlag" id="countriesFlag" >
        <option class="italy" <?php if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "it" )) { ?>selected="selected" <?php } ?> value="it" ><?php echo $this->lang->line('italian');?></option>
		  <option class="usa" <?php if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) { ?>selected="selected" <?php } ?> value="english" ><?php echo $this->lang->line('english');?></option>
		</select>
    </div>
    <div class="socail_topmenu">
		<!-- Go to www.addthis.com/dashboard to customize your tools -->
		<!--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54c921dd147fb6d7" async="async"></script>-->
		<!-- Go to www.addthis.com/dashboard to customize your tools -->
		<!--<div class="addthis_sharing_toolbox"></div>-->
		<span class='st_facebook'></span>
		<span class='st_twitter'></span>
		<span class='st_googleplus'></span>
		<span class='st_linkedin'></span>
		<span class='st_email'></span>
		<span class='st_sharethis'></span>
    	<?php /* ?>
    	<ul>
        	<li><a href=""><img src="<?php echo base_url();?>asset/images/topfacebook_icon.png" alt="Facebook"></a></li>
            <li><a href=""><img src="<?php echo base_url();?>asset/images/toptwitter_icon.png" alt="Facebook"></a></li>
            <li><a href=""><img src="<?php echo base_url();?>asset/images/topgoogle_plus_icon.png" alt="Facebook"></a></li>
            <li><a href=""><img src="<?php echo base_url();?>asset/images/toplinkedin_icon.png" alt="Facebook"></a></li>
            <li><a href=""><img src="<?php echo base_url();?>asset/images/topemail_icon.png" alt="Facebook"></a></li>
            <li><a href=""><img src="<?php echo base_url();?>asset/images/topsharepoint_icon.png" alt="Facebook"></a></li>
        </ul>
        */ ?>
    </div>
    <nav>
    	<?php
        	
		?>
    	<ul>
        	<li><a href="<?php echo base_url();?>" <?php if(!isset($search_title)){?> class='active'<?php }?> ><?php echo $this->lang->line('mainMenu-home');?></a></li>
            <li><a href="<?php echo base_url();?>Residential" <?php if(isset($search_title) && $search_title=='Residential'){?> class='active'<?php }?>><?php echo $this->lang->line('mainMenu-residential');?></a></li>
            <li><a href="<?php echo base_url();?>Business" <?php if(isset($search_title) && $search_title=='Business'){?> class='active'<?php }?>><?php echo $this->lang->line('mainMenu-business');?></a></li>
            <li><a href="<?php echo base_url();?>Rooms" <?php if(isset($search_title) && $search_title=='Rooms'){?> class='active'<?php }?>><?php echo $this->lang->line('mainMenu-rooms');?></a></li>
            <li><a href="<?php echo base_url();?>Land" <?php if(isset($search_title) && $search_title=='Land'){?> class='active'<?php }?>><?php echo $this->lang->line('mainMenu-land');?></a></li>
            <li><a href="<?php echo base_url();?>Vacations" <?php if(isset($search_title) && $search_title=='Vacations'){?> class='active'<?php }?>><?php echo $this->lang->line('mainMenu-vacations');?></a></li>
            <li><a href="<?php echo base_url();?>Luxury" <?php if(isset($search_title) && $search_title=='Luxury'){?> class='active'<?php }?>><?php echo $this->lang->line('mainMenu-luxury');?></a></li>
        </ul>
    </nav>
    </div>
</header>    
</div>