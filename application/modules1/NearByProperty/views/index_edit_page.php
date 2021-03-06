<?php $this->load->view('inc/header.php'); ?>
<style>
.success { margin-bottom:10px; background-color:#006868; color:#ffea52; border:#CCC solid 1px; text-align:center;}
</style>
<div class="main-content">		

<h3>
	<?php
		if( isset( $title_en) )
		{
			print $title_en;
		}else{
			print "	ZAPCASA | Dashboard";
		}
	?>
</h3>
<hr />
	<?php
		if($this->session->flashdata('success')!='') {
	?>
        	<div class="success"><?php echo $this->session->flashdata('success'); ?></div>
  <?php }?>
			<div class="error" id="error_msg" style="text-align:center;">
				<?php echo $this->session->flashdata('msg_flash');?>
			</div>
			<!-- 	
			<form method="post" name="nearbyAdd_form" action="<?php echo site_url('NearByProperty/index_edit');?>">
			-->		
			<?php 
				$attributes = array('class' => 'edit_property_form add_near_property', 'id' => 'nearbyEdit_form', 'name' => 'nearbyEdit_form','onsubmit' => 'javascript: return validate_nearby_property_form();');
				echo form_open_multipart('NearByProperty/index_edit_page', $attributes);
			?>	
				<input type="hidden" name="nearbypropertyId" value="<?php echo $result[0]->property_details_id; ?>" >
			    <div class="form-group" >
			        <label><font style="color:#f33038;">*</font>Select Category</label>
					<select name="category_id" id="category_id" class="form-control">
						<option value="0"> --- Select One Category --- </option>
		                <?php 
		                	if( count( $category_list ) > 0 ) { 
								foreach( $category_list as $key) {
						?>
		                			<option value="<?php echo $key['category_id']; ?>" <?php if( $result[0]->category_id == $key['category_id'] ) { ?> selected="selected" <?php  } ?>> &nbsp;&nbsp;<?php echo $key['category_name']; ?>&nbsp;&nbsp;</option>	
		                <?php } } ?>
		            </select>
				</div>
			    <div class="form-group" >
			        <label><font style="color:#f33038;">*</font>Name (of the property)</label>
					<input type="text" name="name" id="name" class="form-control" value="<?php echo $result[0]->name; ?>" />
			        <?php echo form_error('title_en')?>
				</div>
			    <div class="form-group" >
			        <label>Italian Name (of the property)</label>
					<input type="text" name="opt_name" id="opt_name" class="form-control" value="<?php echo $result[0]->opt_name; ?>" />
			        <?php echo form_error('title_en')?>
				</div>    
                <div class="form-group">
                	<label><font style="color:#f33038;">*</font>Provience </label>
                	<select name="province" id="province"  class="required form-control" onChange="return get_city(this.value);">
		                <option value="">Please select your Province</option>
		               <?php
	                     foreach($provience_list as $key=>$val) {
						?>
	                    	<?php $st_name1=get_perticular_field_value('zc_region_master','Province_Code'," and `Province Name` LIKE '%".$val."%' group by Province_Code");?>
	                     	<option value="<?php echo $val;?>" <?php if(strtolower( trim( $val ) )== strtolower( trim($result[0]->provience ) ) ){?> selected <?php }?>><?php echo $val;?> - <?php echo $st_name1;?></option>
	                    <?php
						 }
						?>
                     </select>
                 </div>
			     <div class="form-group">
					<label><font style="color:#f33038;">*</font>City </label>
					<select name="city" id="city"  class="required form-control">
					<?php 
						if( $result[0]->city == '') {
					?>
							<option value="">Please select your province first</option>
					<?php
						} else{
							foreach($city as $key=>$val){
					?>
								<option value="<?php echo $val;?>" <?php if($val == $result[0]->city){?> selected <?php }?>><?php echo $val;?></option>
				<?php 		}
						}	
				?>
					</select>
					<label class="error" for="city" generated="true" style="display:none;"></label>
				</div>                
			    <div class="form-group">
					 <label><font style="color:#f33038;">*</font>Zip Code </label>
					 <input class="required form-control" placeholder="Enter your Zip code" type="text" name="zip" id="zip"  value="<?php echo $result[0]->zip; ?>" >
					 <label class="error" for="zip" generated="true" style="display:none;"></label>
				</div>
				<div class="form-group">
					<label><font style="color:#f33038;">*</font>Address </label>
					<input type="text" placeholder="Enter your Street address" id="street_address" name="street_address" value="<?php echo $result[0]->street_address; ?>" class="required form-control">
					<label class="error" for="address" generated="true" style="display:none;"></label>
				</div> 
				<div class="form-group">
					<label>Street No </label>
					<input type="text" name="street_no" placeholder="Enter your Street No" value="<?php echo $result[0]->street_no; ?>" class="form-control" >
				</div>
				<div class="form-group">
				<label>&nbsp;</label>
		        <div style="float: right; text-align: left; width: 79.8%;">
		        	<img id="img_1" src="<?php if($result[0]->url == "" ) { echo base_url().'>assets/images/no_proimg.jpg'; } else { echo base_url().'assets/uploads/NearByProperty/'.$result[0]->url; } ?>" alt="" width="142" height="140" />				
		        	<div class="my_style_browse_btn"> <input type='file' id="property_image"  name="property_image" /></div>
		        </div>
			</div>
        <divclass="form-group">
					<label>&nbsp;</label>
          <input type="submit" class="btn btn-primary" name="Submit" value="Submit" >
          <!--<i class="fa fa-save">&nbsp;</i>-->
            
          <a href="javascript:history.back();" class="btn btn-primary">
            <i class="fa fa-backward">&nbsp;</i>
            Back
          </a>
        </div>
				
			</form>
<script>

function get_city(id) {
		
	var name=id;
	$.post("<?php echo base_url(); ?>NearByProperty/city_search", { name: name },
	function(result){
		  $('#city').html(result);
	});
}

$("#property_image").change(function(){
    var ext = this.value.match(/\.(.+)$/)[1];
    var ext = ext.toLowerCase();
    switch (ext) {
        case 'jpg':
        case 'jpeg':
		case 'JPEG':
        case 'png':
        case 'gif':
            readURL(this,1);
            break;
        default:
            alert('Only jpg, jpeg ,png, or gif file can be uploaded.');
            this.value = '';
    }
});
var img_id=0;
function readURL(input,img_id) {
	var loader="<?php echo base_url();?>assets/images/Loader.gif";
	$('#img_'+img_id).attr('src',loader).width(142).height(140);
    if (input.files && input.files[0]) {
        var reader = new FileReader();     
        reader.onload = function (e) {
            	$('#img_'+img_id).attr('src', e.target.result).width(142).height(140);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function validate_nearby_property_form(){
	var category_id = $('#category_id').val();
	var name = $('#name').val();
	var province = $('#province').val();
	var city = $('#city').val();
	var zip = $('#zip').val();
	var street_address = $('#street_address').val();

	if( category_id == 0) {
		alert("Please Select Category.");
		$('#category_id').focus();
		return false;
	} if( name == "" || name == null ) {
		alert("Please Enter Property Name.");
		$('#name').focus();
		return false;
	} if( province == "" || province == null ) {
		alert("Please Enter Province.");
		$('#province').focus();
		return false;
	} if( city == "" || city == null ) {
		alert("Please Enter City.");
		$('#city').focus();
		return false;
	} if( zip == "" || zip == null ) {
		alert("Please Enter zip.");
		$('#zip').focus();
		return false;
	} if( street_address == "" || street_address == null ) {
		alert("Please Enter Address.");
		$('#street_address').focus();
		return false;
	}	
}

</script>			
<?php $this->load->view('inc/footer.php'); ?>
