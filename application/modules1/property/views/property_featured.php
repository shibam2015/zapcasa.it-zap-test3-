<?php $this->load->view('inc/header.php'); ?>

<style>
.success { margin-bottom:10px; background-color:#006868; color:#ffea52; border:#CCC solid 1px; text-align:center;}
</style>
<div class="main-content">		

<h3>Make Property Feature</h3>
<hr />
<?php
  $attributes = array('class' => 'form-horizontal form-groups-bordered', 'id' => 'register','role'=>"form");
  echo form_open_multipart('property/make_prop_feature/'.$this->uri->segment('3'), $attributes);

?>
 		<?php
		
         if($this->session->flashdata('success')!='')
		 {
		?>
        <div class="success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php }?>
<div class="error" id="error_msg" style="text-align:center;"><?php echo $this->session->flashdata('msg_flash');?></div>
<div class="jumbotron">
	<?php
            $property_name="";
			if($property_details[0]['contract_id']==1)
			{
				$contract="Rent For";
			}
			if($property_details[0]['contract_id']==2)
			{
				$contract="Sell For";
			}
			$property_name.=$contract;
			$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$property_details[0]['typology']."'");
			$property_name.=' '.stripslashes($typology_name);
			
			
			?>
			<h2><?php echo $property_name.' In '.$property_details[0]['city'].' '.$property_details[0]['provience'];?></h2>
            <br />
            <div class="form-group">        
        <label class="col-sm-3 control-label" for="field-1">Start Date:</label>
        <div class="col-sm-3">
							<div class="input-group">
								<input type="text" id="featured_start_date" class="form-control datepicker" name="start_date" value="<?php echo  $property_feature_details[0]['start_date'];?>" style="width:120px !important;"">
								
								<div class="input-group-addon">
									<a href="#"><i class="entypo-calendar"></i></a>
								</div>
							</div>
						</div>
		
			</div>
            <br>
            <div class="form-group">        
         <label class="col-sm-3 control-label" for="field-1">Number Of Days:</label>
		<div class="col-sm-5">
        <select name="number_of_days"  class="required">
                        	<option value="">Please select Number of Days</option>
                            <?php
                            	for($i=1;$i<=365;$i++)
								{
							?>
                            <option value="<?php echo $i;?>" <?php if($property_feature_details[0]['number_of_days']==$i){?>selected="selected"<?php }?> ><?php echo $i;?></option>
                            <?php
								}
							?>
                        </select>
				
		</div>
		</div>
        <br />
        <div class="form-group"> 
        <div class="col-sm-5">
				<button class="btn btn-success" type="submit">Make Feature</button>
                </div>
		</div>
        

            
        
		
			</div>
</div>
<?php
  echo form_close();
?>

<?php //echo '<pre>';print_r($property_details);?>

<!-- Modal 6 (Long Modal)-->
<?php $this->load->view('inc/footer.php'); ?>
 <script>
$(function() {
	$( "#featured_start_date" ).datepicker('option', {dateFormat: 'dd-mm-yy'});
});
</script>
