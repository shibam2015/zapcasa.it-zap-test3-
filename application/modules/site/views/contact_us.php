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
    	<h2><?php echo $this->lang->line('contactus_real_estate_for');?><font style="font-weight:bold;"><?php echo $this->lang->line('contactus_jobs');?></font> <?php echo $this->lang->line('contactus_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('contactus_housing');?></font></h2>
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
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('contactus_home');?></a></span> >
        <span><?php echo $this->lang->line('contactus_contact_us');?></span>
    </div>
	<!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
	<div class="registercomn_box">
    <div class="arrow_box error_message" id="msg_box_general" style="color:#FF7602;"><?php echo $this->lang->line('contactus_choose_a_category');?>
            
             </div>
    	<div  class="add_newproperty_icon2">
        	<img src="<?php echo base_url();?>assets/images/add_newproperty_icon.jpg" alt="" style="margin-top:66px;margin-left:18px;">
        </div>
       <div class="add_newproperty_table1" style="width:65%; margin-right:9%; margin-top:20px;">
          <strong style="font-weight:bold;"><?php echo $this->lang->line('contactus_highlight_your_properties');?></strong>
          <p style="color:#999;"><?php echo $this->lang->line('contactus_highlight_your_properties_content');?></p>
          <br />
          <strong style="font-weight:bold;"><?php echo $this->lang->line('contactus_advice_and_suggestions');?> </strong>
          <p style="color:#999;"><?php echo $this->lang->line('contactus_advice_and_suggestions_content');?></p>
          <br />
          <strong style="font-weight:bold;"><?php echo $this->lang->line('contactus_reports');?> </strong>
          <p style="color:#999;"><?php echo $this->lang->line('contactus_reports_content');?></p>
          <br />
          <div class="heading" style="border-bottom:2px solid #000;font-size:16px;padding-bottom:5px;"><strong><?php echo $this->lang->line('contactus_fill_the_form');?></strong></div>
      	  <!--<div class="heading" style="border-bottom:2px solid #000;"><strong>FILL THE FORM</strong></div>-->
           <?php
              if($this->session->flashdata('mail_success')!='')
			  {
			?>
            <div class="success" id="success" style="margin-top:10px; width:94%;">
            	<?php echo $this->session->flashdata('mail_success');?>
                </div>
            <?php
			 }
			?>
          <?php
				$new_arr=$this->session->all_userdata();
				$attributes = array('class' => 'register-form', 'id' => 'register','style'=>'width:95%; margin-top:20px;');
				echo form_open_multipart('contact_us/do_contact', $attributes);		
			?>
      	 
            <div>
                <label>
                      <span><?php echo $this->lang->line('contactus_fill_the_form_choose_category');?>: <font>(<?php echo $this->lang->line('contactus_fill_the_form_choose_category_required');?>)</font></span>
                    <label generated="true" for="category" class="error"></label>
                     <select class="required" name="category">
                       <option value=""><?php echo $this->lang->line('contactus_fill_the_form_choose_category_select');?> </option>
                       <option value="Highlight your properties"><?php echo $this->lang->line('contactus_fill_the_form_choose_category_highlight_your_properties');?></option>
                       <option value="Advice and suggestions"><?php echo $this->lang->line('contactus_fill_the_form_choose_category_advice_and_suggessions');?></option>
                       <option value="Reports"><?php echo $this->lang->line('contactus_fill_the_form_choose_category_reports');?></option>
                       <option value="Other"><?php echo $this->lang->line('contactus_fill_the_form_choose_category_other');?></option>
                     </select>
                </label>
            </div>
            <div>
                <label>
                    <span><?php echo $this->lang->line('contactus_fill_the_form_name');?>: <font>(<?php echo $this->lang->line('contactus_fill_the_form_choose_category_required');?>)</font></span>
                    <label generated="true" for="name" class="error"></label>
                   <input type="text" value="" class="required" name="name" tabindex="1" placeholder="<?php echo $this->lang->line('contactus_fill_the_form_enter_your_name');?>" style="width:96%;">
                </label>
            </div>
            <div>
                <label>
                    <span><?php echo $this->lang->line('contactus_fill_the_form_telephone');?>:</span>
                   <!-- <label generated="true" for="first_name" class="error"></label>-->
                   <input type="text" value="" name="phone_number" tabindex="1" placeholder="<?php echo $this->lang->line('contactus_fill_the_form_enter_your_telephone_number');?>" style="width:96%;">
                </label>
            </div>
            <div>
                <label>
                    <span><?php echo $this->lang->line('contactus_fill_the_form_email');?>: <font>(<?php echo $this->lang->line('contactus_fill_the_form_choose_category_required');?>)</font></span>
                    <label generated="true" for="email" class="error"></label>
                   <input type="text" value="" class="required email" name="email" tabindex="1" placeholder="<?php echo $this->lang->line('contactus_fill_the_form_enter_your_email');?>" style="width:96%;">
                </label>
            </div>
            <div>
                <label>
                    <span><?php echo $this->lang->line('contactus_fill_the_form_subject');?>: <font>(<?php echo $this->lang->line('contactus_fill_the_form_choose_category_required');?>)</font></span>
                    <label generated="true" for="subject" class="error"></label>
                   <input type="text" value="" class="required" name="subject" tabindex="1" placeholder="<?php echo $this->lang->line('contactus_fill_the_form_enter_the_subject_of_your_message');?>" style="width:96%;">
                </label>
            </div>
            <div>
                <label>
                    <span><?php echo $this->lang->line('contactus_fill_the_form_message');?>: <font>(<?php echo $this->lang->line('contactus_fill_the_form_choose_category_required');?>)</font></span>
                    <label generated="true" for="field" class="error"></label>
                   <textarea class="required" name="message" id="field" cols="40" rows="4" placeholder="<?php echo $this->lang->line('contactus_fill_the_form_write_your_message');?>"  style="width: 569px; max-width:569px; min-width:569px; height: 102px;"></textarea>
                </label>
            </div>
            <div style="float:left; width:100%; margin-top:12px;">
            	<label style="float:left; width:3%; margin-top:2px; "><input type="checkbox" class="required" value="1" name="agree_terms"></label>
                <p style="float:left; width:95%"><strong style="font-weight:bold"><?php echo $this->lang->line('contactus_fill_the_form_choose_category_required');?>:</strong> <?php echo $this->lang->line('contactus_fill_the_form_required_content');?>.</strong></p>
                <br>
                <label generated="true" for="agree_terms" class="error"></label>
            </div>
          
            	
            	 <div style="margin-bottom:20px; float:right; ">
                  <input type="submit" value="<?php echo $this->lang->line('contactus_button_send');?>" name="submit">
                 </div>
           
         </form>
         
        
      </div>
		
     
    </div>
</div>


<!------ footer part ------------->
<?php $this->load->view("_include/footer");?>
