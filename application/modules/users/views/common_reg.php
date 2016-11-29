<?php $this->load->view("inc/header");?>
<!-- body part -->
<!-- banner part -->
<div class="insidepage_banner">
	<div class="main">
    	<h2><?php echo $this->lang->line('common_reg_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('common_reg_jobs');?></font> <?php echo $this->lang->line('common_reg_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('common_reg_housing');?></font></h2>
    </div>
</div>
<div class="main">
	<div id="breadcrumb" class="fk-lbreadbcrumb newvd">
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('common_reg_home');?></a></span> >  
        <span><?php echo $this->lang->line('common_reg_heading_register');?></span>
    </div>
    
	<h2 class="pagetitle">
		<?php echo($this->session->flashdata('error_user')?$this->lang->line('property_please_login_to_add_your_property'):'');?>
	</h2>
	<div class="registercomn_box">
    	<div class="registercomn_box_left">
        	<h3><?php echo $this->lang->line('common_reg_are_you_looking_for_a_property');?></h3>
            <h4><?php echo $this->lang->line('common_reg_customizable_and_free');?></h4>
            <p><?php echo $this->lang->line('common_reg_customizable_and_free_content');?></p>
            <ul>
            	<li><?php echo $this->lang->line('common_reg_services');?></li>
                <li class="sublist"><?php echo $this->lang->line('common_reg_private_message_box');?><br>
                 <span><?php echo $this->lang->line('common_reg_to_communicate_with_advertisers');?></span>
                </li>
                <li class="sublist"><?php echo $this->lang->line('common_reg_save_your_searches');?><br>
                	<span><?php echo $this->lang->line('common_reg_to_resume_your_search');?></span>
                </li>
                <li class="sublist"><?php echo $this->lang->line('common_reg_save_your_favorite_properties');?> <br>
                	<span><?php echo $this->lang->line('common_reg_to_compare_and_evaluate_everything_comfortably');?></span>
                </li>
                <li class="sublist"><?php echo $this->lang->line('common_reg_email_alerts');?><br>
                	<span><?php echo $this->lang->line('common_reg_to_receive_custom_alerts_with_properties');?></span>
                </li>
            </ul>
            <div style="float:left;"><a class="mainbt" href="<?php echo base_url();?>users/comon_signup"><?php echo $this->lang->line('common_reg_sign_up');?></a> <font style="float:left; font-size:18px; padding-top:9px; padding-right:10px;"><?php echo $this->lang->line('common_reg_or');?></font> <a class="textlink topopup" href=""><?php echo $this->lang->line('common_reg_log_in_to_your_account');?></a></div>
        </div>
        <div class="orpicx">
			<img src="<?php echo base_url();?>assets/images/<?php echo $this->lang->line('common_reg_or_imagename');?>" alt="<?php echo $this->lang->line('common_reg_or');?>">
		</div>
        <div class="registercomn_box_right">
        	<h3><?php echo $this->lang->line('common_reg_want_to_sell_or_rent_your_properties');?></h3>
        	<h4><?php echo $this->lang->line('common_reg_now_you_can_do_it_free_on_ZapCasa');?></h4>
            <p><?php echo $this->lang->line('common_reg_are_you_an_agency');?></p>
            <p><?php echo $this->lang->line('common_reg_sell_and_rent_properties');?></p>
            <ul>
            	<li><?php echo $this->lang->line('common_reg_services');?></li>
                <li class="sublist"><?php echo $this->lang->line('common_reg_sedicated_public_page');?><br>
                	<span><?php echo $this->lang->line('common_reg_to_create_and_manage');?></span>
                </li>
                <li class="sublist"><?php echo $this->lang->line('common_reg_post_and_manage');?><br>
                	<span><?php echo $this->lang->line('common_reg_to_create_a_detailed_page');?></span>
                </li>
                <li class="sublist"><?php echo $this->lang->line('common_reg_multiple_upload');?><br>
                	<span><?php echo $this->lang->line('common_reg_if_you_are_an_agency');?></span>
                </li>
                <li class="sublist"><?php echo $this->lang->line('common_reg_private_message_box');?> <br>
                	<span><?php echo $this->lang->line('common_reg_reply_and_easily_manage');?></span>
				</li>
            </ul>
            <div style="float:left;"><a class="mainbt" href="<?php echo base_url();?>users/reg_owner"><?php echo $this->lang->line('common_reg_sign_up_as_owner');?></a> <a class="mainbt" href="<?php echo base_url()?>users/reg_agency"><?php echo $this->lang->line('common_reg_sign_up_as_agency');?></a> <font style="float:left; font-size:18px; padding-top:9px; padding-right:10px;"><?php echo $this->lang->line('common_reg_or');?></font> <a class="textlink topopup" href=""><?php echo $this->lang->line('common_reg_log_into_your_account');?></a></div>
        </div>
    
    </div>
</div>

<!-- footer part -->
<?php $this->load->view("inc/footer");?>
