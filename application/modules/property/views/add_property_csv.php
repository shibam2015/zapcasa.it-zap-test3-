<?php $this->load->view("_include/meta"); ?>
<style>
/*jquery error styles */
div.error{ float: left; color: red; padding-right: .5em;  }
label.error { float: left !important; color: red !important; padding-right: .5em !important; text-align:left !important;  }
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
	
	$.validator.addMethod("alphabetsnspace", function(value, element) {
         return this.optional(element) || /(https?:\\)?([\w-]+\.)+[\w-]+[.com|.in|.org]+(\[\?%&=]*)?/.test(value);
	});


	
jQuery.extend(jQuery.validator.methods, {
         number: function(value, element) {
            return this.optional(element)
            || /^(?:\d+|\d{1,3}(?:\.\d{3})+)(?:,\d+)?$/.test(value)
            ||  /^(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(value);
          }
});
	
	
	$("#register").validate({
		 
    rules: {
       
		zip: {
			
			 digits: true
		},
		 url: {
           
			alphabetsnspace: true,
		 }
		 
		 
       
		
		
		
    },
    messages: {
        zip: {
           
			digits:"<?php echo $this->lang->line('add_property_csv_please_provide_a_digits_only');?>"
			
        },
		 url: {
           
			alphabetsnspace: "<?php echo $this->lang->line('add_property_csv_please_enter_valid_url');?>",
		 }
    },
	
	
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
	
	<!--header-->
<?php 
	$this->load->view("_include/header"); 
?>
	<!------ banner part ------------->
	<div class="insidepage_banner">
		<div class="main">
	    	<h2><?php echo $this->lang->line('add_property_csv_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('add_property_csv_jobs');?></font> <?php echo $this->lang->line('add_property_csv_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('add_property_csv_housing');?></font></h2>
	    </div>
	</div>
	<!----- login pop up start  --------------------->
 <?php
 	$this->load->view("_include/login_user"); 
 ?>          
	<!----- login pop up end --------------------->
	<!------ body part ------------->
	
	<!------ body part ------------->

	<div class="main">
		<div id="breadcrumb" class="fk-lbreadbcrumb newvd">
	    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('add_property_csv_home');?></a></span> > 
             <span><?php echo $this->lang->line('add_property_csv_add_property');?></span>
	        
	    </div>
        <ul class="listing-tabs">
        <li><a href="property_details"><?php echo $this->lang->line('add_property_csv_list_of_properties');?></a></li>
        <li class="active"><a href="add_property_form"><?php echo $this->lang->line('add_property_csv_listing_tab_add_properties');?></a></li>
        <!--<li><a href="#"></a>My preferences</li>
        <li class="delete-tab"><a href="#">Delete account</a></li>-->
    </ul>
	<?php
		$attributes = array('class' => 'add_property_form', 'id' => 'register', 'onsubmit' => 'return formValidation();');
		echo form_open_multipart('property/add_property_csv', $attributes);
		
		$uid=$this->session->userdata( 'user_id' );
		$user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$uid."'");
	?>    
	<!--<h2 class="pagetitle">Sign up <font style="text-transform:none; font-size:22px; ">(for individual users)</font></h2>-->
		<!--Add property csv-->
        
        <div class="registercomn_box">
       
            <div class="arrow_box error_message" id="msg_box_csv">
				<?php echo $this->lang->line('add_property_csv_hi_download_csv_file_first');?> 
				<a href='<?php echo base_url();?>property/add_property_form'>
					<?php echo $this->lang->line('add_property_csv_click_here');?>
				</a>
			</div>
            
            <div id="upload_csv" class="add_newproperty_box">
            	<div class="add_newproperty_icon"><img src="<?php echo base_url();?>assets/images/add_newproperty_icon.jpg" alt=""></div>
                <div class="add_newproperty_table1">
                <!--<div class="section1">
	                	<div class="cat_select">
	                        <label><font style="color:#f33038;">*</font>Contract </label>
	                            
	                            <select name="contract" id="contract" onChange="get_category(this.value);" class="required"  >
	                                <option value="" selected="selected" >Select contract type</option>
	                                <?php //foreach($contract_type as $keyContract=>$valContract): ?>
	                                <option value="<?php //echo $keyContract; ?>"><?php //echo $valContract; ?></option>
	                                <?php //endforeach; ?>
	                            </select>
                                 <label class="error" for="contract" generated="true" style="display:none;"></label>
	                        
	                    </div>
	                    <div class="cat_select" name="category_id" id="category_id" >
	                        <label><font style="color:#f33038;">*</font>Category </label>
	                            <select name="category" id="category" onChange="get_sub_category(this.value);csv_adjustment(this.value);" class="required"  >
	                                <option value="">Select a category</option>
	                            </select>
                                <label class="error" for="category" generated="true" style="display:none;"></label>
	                    </div>
	                    <div class="cat_select" style="display:none;" id="sub_category_area" >
	                        <label><font style="color:#f33038;">*</font>SubCategory </label>
                            <select name="sub_category" id="sub_category" onChange="csv_adjustment(this.value);" class="required"  >
                                <option value="0">Select a Sub category</option>
                            </select>
                            <label class="error" for="sub_categorys" generated="true" style="display:none;"></label>
	                    </div>
	                </div>-->
                    
                    <div id="upload_csv_form">
                	<div class="section2">
                    	<div class="cat_select" style="float:left;">
	                        <label><?php echo $this->lang->line('add_property_csv_download_manual');?> </label>
	                        <?php if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) { ?>
	                          <a id="manual_download_link" href="<?php echo base_url();?>property/dowload_file_doc/ZapCasa-Manual-csv.pdf">
							<?php } elseif( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "it" )) { ?>
	                          <a id="manual_download_link" href="<?php echo base_url();?>property/dowload_file_doc/ZapCasa-Istruzioni-csv.pdf">
							<?php }	?>
                               <img src="<?php echo base_url();?>assets/images/pdf.png" alt="<?php echo $this->lang->line('add_property_csv_manual_pdf');?>">
                              </a>
	                        
	                    </div>
	                	<div class="cat_select" style="float:left;">
	                        <label><?php echo $this->lang->line('add_property_csv_download_csv');?> </label>
	                            
	                          <!-- <a id="csv_download_link" href="">-->
	                        <?php if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) { ?>
                              <a href="<?php echo base_url();?>property/dowload_file_doc/property.csv">
							<?php } elseif( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "it" )) { ?>
                              <a href="<?php echo base_url();?>property/dowload_file_doc/immobili.csv">
							<?php }	?>
                               <img src="<?php echo base_url();?>assets/images/download.png" alt="<?php echo $this->lang->line('add_property_csv_download_csv_image_alt');?>">
                               </a>
	                        
	                    </div>
                      </div>
                
	            	<div class="section2">
                    	
	                	<div class="cat_select">
	                        <label><?php echo $this->lang->line('add_property_csv_upload_csv');?></label>
                            <p style="color:#F00" id="errMsg"><?php echo $this->session->flashdata('msg'); ?></p>
	                            
	                           <input type="file" name="userfile" id="userfile">
	                        
	                    </div>
                      </div>
                      <input class="searchbt" type="submit" name="submit" value="<?php echo $this->lang->line('add_property_csv_button_submit');?>">
                      
                   </div>   
                 </div>
            </div>
	        
	         
	    </div>
	    <?php echo form_close();?>
	</div>

<!------ footer part ------------->
	
<?php $this->load->view("_include/footer");?>
<script type="text/javascript">

 	function get_category(str){
 	 		var cat_parent=0;
 	 		if(str!=0){
 	 			$.post("<?php echo base_url(); ?>property/getCategory", { contract: str,cat_parent : cat_parent },
 	 			function(result){
 	 				   $("#category").html(result);
					 
					   
 	 			});
 	 		}
			
	}
	
	

	function get_sub_category(str){
		//alert(str);
		document.getElementById('sub_category').selectedIndex = 0;
		
		//for room add restriction///////////////////////////
		
		
		
		if(str=="BUS"){
 			$.post("<?php echo base_url(); ?>property/getSubCategory", { category : str },
 			function(result){
 				   $("#sub_category").html(result);
				 
 				   document.getElementById("sub_category_area").style.display="block";
				  
 			});
 		}else{
 			document.getElementById("sub_category_area").style.display="none";
			
 		}	
	}	
		

	
	
    
	
	
	
	
	
	///////////////////////for csv purpose////////////////////////////////////
	function csv_adjustment(str)
	{
		//alert(str);
		var contract=$("#contract").val();
		if(contract=='1')
		{
			var type="rent"
		}
		if(contract=='2')
		{
			var type="sell"
		}
		
		 if(str=='BUS')
		{
			document.getElementById("upload_csv_form").style.display="none";
			//$("#upload_csv").show();
		}
		if(str=="PRO" && contract=='1')
		{
			document.getElementById("upload_csv_form").style.display="block";
			$("#csv_download_link").attr("href", "<?php echo base_url()?>property/dowload_file_doc/property_pro_rent.csv");
			
		}
		if(str=="PRO" && contract=='2')
		{
			document.getElementById("upload_csv_form").style.display="block";
			$("#csv_download_link").attr("href", "<?php echo base_url()?>property/dowload_file_doc/property_pro_sell.csv");
			
		}
		
		if(str=="BLI" && contract=='1')
		{
			document.getElementById("upload_csv_form").style.display="block";
			$("#csv_download_link").attr("href", "<?php echo base_url()?>property/dowload_file_doc/property_bli_rent.csv");
		}
		if(str=="BLI" && contract=='2')
		{
			document.getElementById("upload_csv_form").style.display="block";
			$("#csv_download_link").attr("href", "<?php echo base_url()?>property/dowload_file_doc/property_bli_sell.csv");
		}
		
		
		
		if(str=="RES" && contract=='1')
		{
			document.getElementById("upload_csv_form").style.display="block";
			$("#csv_download_link").attr("href", "<?php echo base_url()?>property/dowload_file_doc/property_res_rent.csv");
		}
		if(str=="RES" && contract=='2')
		{
			document.getElementById("upload_csv_form").style.display="block";
			$("#csv_download_link").attr("href", "<?php echo base_url()?>property/dowload_file_doc/property_res_sell.csv");
		}
		
		
		
		
		
		if(str=="ROM" && contract=='1')
		{
			document.getElementById("upload_csv_form").style.display="block";
			$("#csv_download_link").attr("href", "<?php echo base_url()?>property/dowload_file_doc/property_rom_rent.csv");
		}
		if(str=="ROM" && contract=='2')
		{
			document.getElementById("upload_csv_form").style.display="block";
			$("#csv_download_link").attr("href", "<?php echo base_url()?>property/dowload_file_doc/property_rom_sell.csv");
		}
		
		
		
		if(str=="VAC"  && contract=='1')
		{
			document.getElementById("upload_csv_form").style.display="block";
			$("#csv_download_link").attr("href", "<?php echo base_url()?>property/dowload_file_doc/property_vac_rent.csv");
		}
		if(str=="VAC"  && contract=='2')
		{
			document.getElementById("upload_csv_form").style.display="block";
			$("#csv_download_link").attr("href", "<?php echo base_url()?>property/dowload_file_doc/property_vac_sell.csv");
		}
		
		
		
		
		
		if(str=="LAND" && contract=='1')
		{
			document.getElementById("upload_csv_form").style.display="block";
			$("#csv_download_link").attr("href", "<?php echo base_url()?>property/dowload_file_doc/property_land_rent.csv");
		}
		if(str=="LAND" && contract=='2')
		{
			document.getElementById("upload_csv_form").style.display="block";
			$("#csv_download_link").attr("href", "<?php echo base_url()?>property/dowload_file_doc/property_land_sell.csv");
		}
		
		
		
		
		
		
		
		
		 if(str=='')
		{
			document.getElementById("upload_csv_form").style.display="none";
			//$("#upload_csv").show();
		}
		 if(str=='0')
		{
			document.getElementById("upload_csv_form").style.display="none";
			//$("#upload_csv").show();
			
			
			
		}
		
	}
	
	function formValidation()
	{
		var userfile = $("#userfile").val();
		
		if(userfile == '') {
			$("#errMsg").html('<?php echo $this->lang->line('upload_csv_file_text');?>');
			return false;
		} else {
			$("#errMsg").html('');	
			return true;
		}	
	}
	
	
 </script>
 