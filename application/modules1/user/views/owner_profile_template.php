<?php $this->load->view('inc/header.php'); ?>

<div class="main-content">
<h2><?php echo $user_infos[0]['first_name'];?> <?php echo $user_infos[0]['last_name'];?></h2>
<hr>
<div class="panel panel-primary">
<div class="panel-body">
<?php
  $attributes = array('class' => 'form-horizontal form-groups-bordered', 'id' => 'register','role'=>"form");
  echo form_open_multipart('users/update_owner/'.$this->uri->segment('3'), $attributes);

?>

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
        <label class="col-sm-3 control-label" for="field-1">Social Secuirity Number</label>
		<div class="col-sm-5">
				<input id="field-1" name="social_secuirity_number" class="form-control" type="text" placeholder="Social Secuirity Number" value="<?php echo $user_infos[0]['social_secuirity_number'];?>">
		</div>
</div>
<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Date Of Birth</label>
        <div class="col-sm-3">
							<div class="input-group">
								<input type="text" name="date_of_birth" class="form-control datepicker"value="<?php echo $user_infos[0]['date_of_birth'];?>">
								
								<div class="input-group-addon">
									<a href="#"><i class="entypo-calendar"></i></a>
								</div>
							</div>
						</div>
		
</div>

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
       
				<!--<input id="field-1" name="city" class="form-control" type="text" placeholder="City"
                 value="<?php //echo $user_infos[0]['city'];?>"/>-->
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
        <label class="col-sm-3 control-label" for="field-1">Land Phone</label>
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
        <label class="col-sm-3 control-label" for="field-1">Email ID</label>
		<div class="col-sm-5">
				<input id="email_id" name="email_id" class="form-control" type="text" placeholder="Email" value="<?php echo $user_infos[0]['email_id'];?>">
                <div id="message"></div>
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
		if($user_infos[0]['file_1']!='') {
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
		
$(function() {
	 $("#email_id").change(function(){
		 
		 	$("#message").show();
                // $("#message").html("<img src='ajax-loader.gif' /> checking...");
             
 
            var email=$("#email_id").val();
 
              $.ajax({
                    type:"post",
                    url:"<?php echo base_url();?>users/check_email_avail",
                    data: { email:email },
			async: false,
                        success:function(data){
							//alert(data);
                        if(data==0){
                            $("#message").html("<span style='color:green;'>Email ID available</span>");
							$('input[type="submit"]').removeAttr('disabled');
                        }
                         if(data==1){
                            $("#message").html("<span style='color:Red;'>Email ID already taken</span>");
							$('input[type="submit"]').attr('disabled','disabled');
							//return false;
                        }
                    }
                 });
 
            });
 
            });
	
	
		
</script>        
<?php echo  form_close();?>
</div>
</div>
</div>

<?php $this->load->view('inc/footer.php'); ?>