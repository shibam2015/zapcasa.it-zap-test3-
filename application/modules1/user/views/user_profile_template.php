<?php $this->load->view('inc/header.php'); ?>

<div class="main-content">
<h2><?php echo ucfirst($user_infos[0]['first_name']);?> <?php echo ucfirst($user_infos[0]['last_name']);?></h2>
<hr>
<div class="panel-body">

<?php
  $attributes = array('class' => 'form-horizontal form-groups-bordered', 'id' => 'register','role'=>"form");
  echo form_open_multipart('users/update_general_user/'.$this->uri->segment('3'), $attributes);

?>
<!--<form class="form-horizontal form-groups-bordered" role="form">-->
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
        <label class="col-sm-3 control-label" for="field-1">Date Of Birth</label>
        <div class="col-sm-3">
							<div class="input-group">
								<input type="text" class="form-control datepicker" name="date_of_birth" value="<?php echo $user_infos[0]['date_of_birth'];?>">
								
								<div class="input-group-addon">
									<a href="#"><i class="entypo-calendar"></i></a>
								</div>
							</div>
						</div>
		
</div>
<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Gender</label>
		<div class="col-sm-5">
          <input type="radio" name="gender" value="0" <?php if($user_infos[0]['gender']==0){?>checked="checked"<?php }?>>Male
		  <input type="radio" name="gender" value="0" <?php if($user_infos[0]['gender']==1){?>checked="checked"<?php }?>>Female
		</div>
</div>
<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Country</label>
		<div class="col-sm-5">
        <select name="country"  class="required">
                        	<option value="">Please select your Country</option>
                            <?php
                            	foreach($countries as $country)
								{
							?>
                            <option value="<?php echo $country['id_countries'];?>" <?php if($country['id_countries']==$user_infos[0]['country']){?> selected <?php }?>><?php echo $country['name'];?></option>
                            <?php
								}
							?>
                        </select>
				
		</div>
</div>

<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">City</label>
		<div class="col-sm-5">
       
				<input id="field-1" name="city" class="form-control" type="text" placeholder="City"
                 value="<?php echo $user_infos[0]['city'];?>"/>
		</div>
</div>

<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Telephone</label>
		<div class="col-sm-5">
				<input id="field-1" name="contact_ph_no" class="form-control" type="text" placeholder="Contact Number" value="<?php echo $user_infos[0]['contact_ph_no'];?>">
		</div>
</div>


<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Email ID</label>
		<div class="col-sm-5">
				<input id="field-1" name="email_id" class="form-control" type="text" placeholder="Phone 2" value="<?php echo $user_infos[0]['email_id'];?>">
		</div>
</div>


<div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Receive Mail</label>
		<div class="col-sm-5">
         <input type="radio" name="receive_mail" value="0" <?php if($user_infos[0]['receive_mail']==0){?>checked="checked"<?php }?>>No
		  <input type="radio" name="receive_mail" value="1" <?php if($user_infos[0]['receive_mail']==1){?>checked="checked"<?php }?>>Yes
		</div>
</div>


<div class="form-group" align="center"> 
	<button class="btn btn-success" type="submit">Update</button>
</div>





<?php
  echo  form_close();
?>
</div>

</div>

<?php $this->load->view('inc/footer.php'); ?>