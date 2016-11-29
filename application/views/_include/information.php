<div id="toPopup2"> 
       <div class="close2"></div>
       <div id="popup_content1"> <!--your content start-->

                   <?php /* 
                    	<div style="text-align:center;">
                        	<span>To Contact with Advertiser, You need to do login </span><br/>
                            <span style="padding-left:175px;"><img src="<?php echo base_url();?>asset/images/or_img.png" /></span><br/>	
                            <span> To make a fastly registration via google or facebook, else u can usethe registration form.</span>
                            
                            
                        </div>
                   	*/ ?>	
                       
         <div style="text-align:center;">
               <span><?php echo $this->lang->line('info_please_signin_to_your_account');?> </span><br/>
              <span style="padding-left:10px;"><?php echo $this->lang->line('info_or');?></span><br/>	
              <span style="padding-left:101px;"><a href="<?php echo base_url();?>users/common_reg" class="mainbt"><?php echo $this->lang->line('info_register_a_new_account');?></a></span>              
        </div>         
    </div>
</div>
<div id="backgroundPopup2"></div>