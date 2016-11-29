<?php $this->load->view('inc/header.php'); ?>

<div class="main-content">
<h2><?php echo $user_infos[0]['company_name'];?></h2>
<hr>
<div class="panel panel-primary">
<div class="panel-body">
<?php
  $attributes = array('class' => 'form-horizontal form-groups-bordered', 'id' => 'register','role'=>"form");
  echo form_open_multipart('users/update_company/'.$this->uri->segment('3'), $attributes);

?>
<h3>Company Information</h3>
<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Company Name</label>
		<div class="col-sm-5">
				<input id="field-1" name="company_name" class="form-control" type="text" placeholder="Company Name" value="<?php echo $user_infos[0]['company_name'];?>">
		</div>
</div>

<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Business Name</label>
		<div class="col-sm-5">
				<input id="field-1" name="business_name" class="form-control" type="text" placeholder="Business Name" value="<?php echo $user_infos[0]['business_name'];?>">
		</div>
</div>

<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Vat Number</label>
		<div class="col-sm-5">
				<input id="field-1" name="vat_number" class="form-control" type="text" placeholder="Vat Number" value="<?php echo $user_infos[0]['vat_number'];?>">
		</div>
</div>

<h3>Contact Information</h3>

<div class="form-group">
	<label class="col-sm-3 control-label" for="field-1">First Name</label>
		<div class="col-sm-5">
				<input id="field-1" name="first_name" class="form-control" type="text" placeholder="First Name" value="<?php echo $user_infos[0]['first_name'];?>">
		</div>
</div>        
<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Last Name</label>
		<div class="col-sm-5">
				<input id="field-1" name="last_name" class="form-control" type="text" placeholder="Last Name" value="<?php echo $user_infos[0]['last_name'];?>">
		</div>
</div>




<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Direct Phone Number</label>
		<div class="col-sm-5">
				<input id="field-1" name="contact_ph_no" class="form-control" type="text" placeholder="Contact Number" value="<?php echo $user_infos[0]['contact_ph_no'];?>">
		</div>
</div>


<h3>Contact Information</h3>
<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Province</label>
		<div class="col-sm-5">
			<select name="province" id="province"  class="required" onChange="return get_city(this.value);">
                        	<option value="">Please select your Province</option>
                            <?php
                            	foreach($provinces as $key=>$val)
								{
									$st_name=get_perticular_field_value('zc_region_master','Province_Code'," and `Province Name` LIKE '%".$val."%' group by Province_Code");
							?>
                            <option value="<?php echo $val;?>" <?php if($val==$user_infos[0]['province']){?> selected <?php }?>><?php echo $val;?><?php echo '-'.$st_name;?></option>
                            <?php
								}
							?>
                        </select>
		</div>
</div>
<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">City</label>
		<div class="col-sm-5">
       
				 <select name="city" id="city"  class="required">
                        	<?php foreach($city as $key=>$val){?>
                            <option value="<?php echo $val;?>" <?php if($val==$user_infos[0]['city']){?> selected <?php }?>><?php echo $val;?></option>
                            <?php }?>
                    </select>
		</div>
</div>

<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Street Address</label>
		<div class="col-sm-5">
				<input id="field-1" name="street_address" class="form-control" type="text" placeholder="Street Address" value="<?php echo $user_infos[0]['street_address'];?>">
		</div>
</div>

<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Street No</label>
		<div class="col-sm-5">
				<input id="field-1" name="street_no" class="form-control" type="text" placeholder="Street No" value="<?php echo $user_infos[0]['street_no'];?>">
		</div>
</div>

<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Zip</label>
		<div class="col-sm-5">
				<input id="field-1" name="zip" class="form-control" type="text" placeholder="ZIP" value="<?php echo $user_infos[0]['zip'];?>">
		</div>
</div>

<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Land Line Number</label>
		<div class="col-sm-5">
				<input id="field-1" name="phone_1" class="form-control" type="text" placeholder="Phone 1" value="<?php echo $user_infos[0]['phone_1'];?>">
		</div>
</div>

<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Mobile</label>
		<div class="col-sm-5">
				<input id="field-1" name="phone_2" class="form-control" type="text" placeholder="Phone 2" value="<?php echo $user_infos[0]['phone_2'];?>">
		</div>
</div>

<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Fax Number</label>
		<div class="col-sm-5">
				<input id="field-1" name="fax_no" class="form-control" type="text" placeholder="Fax Number" value="<?php echo $user_infos[0]['fax_no'];?>">
		</div>
</div>

<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Website</label>
		<div class="col-sm-5">
				<input id="field-1" name="website" class="form-control" type="text" placeholder="Website" value="<?php echo $user_infos[0]['website'];?>">
		</div>
</div>

<h3>Acoount Informations</h3>
<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Email ID</label>
		<div class="col-sm-5">
				<input id="field-1" name="email_id" class="form-control" type="text" placeholder="Phone 2" value="<?php echo $user_infos[0]['email_id'];?>">
		</div>
</div>





<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Description</label>
		<div class="col-sm-5">
          <textarea style="width: 493px; height: 169px;" name="about_me"><?php echo $user_infos[0]['about_me'];?></textarea>
				
		</div>
</div>



<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Image</label>
		<div class="col-sm-5">
        <?php
		if($user_infos[0]['file_1']!='')
		{
		?>
        <img src="<?php echo $this->config->item('img_path');?>assets/uploads/thumb_92_82/<?php echo $user_infos[0]['file_1']; ?>">
        <?php
        }
		?>
		<input type="file" name="user_file_1">		
		</div>
</div>

<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1"> Image For Detail Page</label>
		<div class="col-sm-5">
        <?php
                if($user_infos[0]['file_2']!='')
				{
			  ?>
			 <img src="<?php echo $this->config->item('img_path');?>assets/uploads/thumb_92_82/<?php echo $user_infos[0]['file_2']; ?>">
             <?php
				}
			 ?>
             <input type="file" name="user_file_2">
		</div>
</div>

<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Receive Mail</label>
		<div class="col-sm-5">
         <input type="radio" name="receive_mail" value="0" <?php if($user_infos[0]['receive_mail']==0){?>checked="checked"<?php }?>>No
		  <input type="radio" name="receive_mail" value="1" <?php if($user_infos[0]['receive_mail']==1){?>checked="checked"<?php }?>>Yes
		</div>
</div>
<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Posting Property Limit</label>
		<div class="col-sm-5">
				<input id="field-1" name="posting_property_limit" class="form-control" type="text" placeholder="Limit Of Property" value="<?php echo $user_infos[0]['posting_property_limit'];?>">
		</div>
</div>
<div class="form-group" align="center"> 
	<button class="btn btn-success" type="submit">Update</button>
</div>
<script type="text/javascript">
function get_city(id)
		{
			//alert('hello');	
		var name=id;

		$.post("<?php echo base_url(); ?>users/city_search", { name: name },
		
     function(result){
      					//alert(result);
				  		 $('#city').html(result);
					
					});
		}
</script>        

<?php echo  form_close();?>
</div>
</div>
</div>

<?php $this->load->view('inc/footer.php'); ?>