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
                 
                	 <a href="">My ZapCasa</a>
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
                     
                     	<li><a href="<?php echo base_url();?>property/get_message">Inbox  <sup class="count"><?php echo $mesg_cnt;?></sup></a></li>
                        <li><a href="<?php echo base_url();?>property/property_details">List Of Property</a></li>
                        <li><a href="<?php echo base_url();?>property/add_property_form">Add Property</a></li>
                        <li><a href="<?php echo base_url();?>My_Feedback">My Feedback</a></li>
                        <li><a href="<?php echo  base_url();?>property/get_saved_property">Saved properties</a></li>
                        <li><a href="<?php echo base_url();?>property/get_saved_search">Saved searches</a></li>
                        <li><a href="<?php echo base_url();?>users/my_email_alerts">My email alerts </a></li>
                        <li><a href="<?php echo base_url();?>users/my_account">My account</a></li>
                        <li><a href="<?php echo base_url();?>users/my_preference">My preferences</a></li>
                     </ul>
                      <?php
						}
						else
						{
							?>
                      <ul>
                          <li><a href="<?php echo base_url();?>property/get_message">Inbox  <sup class="count">0</sup></a></li>
                        <!-- <li><a href="<?php //echo base_url();?>My_Feedback">My Feedback</a></li> -->
                        <li><a href="<?php echo  base_url();?>property/get_saved_property">Saved properties</a></li>
                        <li><a href="<?php echo base_url();?>property/get_saved_search">Saved searches</a></li>
                        <li><a href="<?php echo base_url();?>users/my_email_alerts">My email alerts </a></li>
                        <li><a href="<?php echo base_url();?>users/my_account">My account</a></li>
                        <li><a href="<?php echo base_url();?>users/my_preference">My preferences</a></li>
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
        	<li><a class="topopup" href="javascript:void(0);">SIGN IN</a></li>
            <!--<li><a href="registercommon.html">REGISTER</a></li>-->
            <li><a href="<?php echo base_url();?>users/common_reg">REGISTER</a></li>
            <?php
			  }
			  else
			  {
				  $uname=get_perticular_field_value('zc_user','first_name'," and user_id='".$uid."'");
				  if($user_type=='2' || $user_type=='3')
						{
		
?>
 <li><a href="<?php echo base_url();?>advertiser/advertiser_details/<?php echo $uid;?>">Hi! <?php echo ucfirst(substr($uname,0,6)).'...';?></a></li>
<?php					
					}
						else
						{
							?>
                             <li><a href="<?php echo base_url();?>users/my_account">Hi! <?php echo ucfirst(substr($uname,0,6)).'...';?></a></li>
							
                            <?php
						}
				 
			?>
           
            <!--<li><a href="registercommon.html">REGISTER</a></li>-->
            <li><a href="<?php echo base_url();?>users/logout">LOGOUT</a></li>
            <?php
			  }
			?>
        </ul>
    </div>
    <div class="lanugage">
    	<select class="custom" name="countriesFlag">
        <option class="italy" selected="selected">Italy</option>
		  <option class="usa">USA</option>
		</select>
    </div>
    <div class="socail_topmenu">
    	<ul>
        	<li><a href=""><img src="<?php echo base_url();?>assets/images/topfacebook_icon.png" alt="Facebook"></a></li>
            <li><a href=""><img src="<?php echo base_url();?>assets/images/toptwitter_icon.png" alt="Facebook"></a></li>
            <li><a href=""><img src="<?php echo base_url();?>assets/images/topgoogle_plus_icon.png" alt="Facebook"></a></li>
            <li><a href=""><img src="<?php echo base_url();?>assets/images/toplinkedin_icon.png" alt="Facebook"></a></li>
            <li><a href=""><img src="<?php echo base_url();?>assets/images/topemail_icon.png" alt="Facebook"></a></li>
            <li><a href=""><img src="<?php echo base_url();?>assets/images/topsharepoint_icon.png" alt="Facebook"></a></li>
        </ul>
    </div>
    <nav>
    	<?php
        	
		?>
    	<ul>
        	<li><a href="<?php echo base_url();?>" <?php if(!isset($search_title)){?> class='active'<?php }?> >Home</a></li>
            <li><a href="<?php echo base_url();?>Residential" <?php if(isset($search_title) && $search_title=='Residential'){?> class='active'<?php }?>>Residential</a></li>
            <li><a href="<?php echo base_url();?>Business" <?php if(isset($search_title) && $search_title=='Business'){?> class='active'<?php }?>>Business</a></li>
            <li><a href="<?php echo base_url();?>Rooms" <?php if(isset($search_title) && $search_title=='Rooms'){?> class='active'<?php }?>>Rooms</a></li>
            <li><a href="<?php echo base_url();?>Land" <?php if(isset($search_title) && $search_title=='Land'){?> class='active'<?php }?>>Land</a></li>
            <li><a href="<?php echo base_url();?>Vacations" <?php if(isset($search_title) && $search_title=='Vacations'){?> class='active'<?php }?>>Vacations</a></li>
            <li><a href="<?php echo base_url();?>Luxury" <?php if(isset($search_title) && $search_title=='Luxury'){?> class='active'<?php }?>>Luxury</a></li>
        </ul>
    </nav>
    </div>
</header>    
</div>
