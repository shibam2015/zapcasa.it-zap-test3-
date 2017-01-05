<?php $this->load->view('inc/header.php'); ?>



<style>

.success { margin-bottom:10px; background-color:#006868; color:#ffea52; border:#CCC solid 1px; text-align:center;}

</style>

<div class="main-content">		



<h3>Make Property Feature</h3>


	<?php
	$popups = NULL;
	$property_main_img = get_perticular_field_value('zc_property_img', 'file_name', " and property_id='" . $property_details[0]['property_id'] . "' AND img_type='main_image'");
	$propImg = base_url() . 'assets/images/no_proimg.jpg';
	if ($property_main_img != '' && file_exists("../assets/uploads/Property/Property" . $property_details[0]['property_id'] . "/thumb_200_296/" . $property_main_img)) {
		$propImg = frontend_path() . 'assets/uploads/Property/Property' . $property_details[0]['property_id'] . '/thumb_200_296/' . $property_main_img;
	}
	$name = get_perticular_field_value('zc_contract_types', 'name', " and contract_id='" . $property_details[0]['contract_id'] . "'");
	$typology_name = get_perticular_field_value('zc_typologies', 'name', " and status='active' and typology_id='" . $property_details[0]['typology'] . "'");
	$city_name = get_perticular_field_value('zc_city', 'city_name', " and city_id='" . $property_details[0]['city'] . "'");
	$province_code = get_perticular_field_value('zc_region_master', 'province_code', " and city='" . mysql_real_escape_string($city_name) . "'");

	$proptitle = $name . " For " . stripslashes($typology_name) . " in " . $city_name . ", " . $province_code;

	$propSecTitle = ($property_details[0]['area'] != '' ? $property_details[0]['area'] . ' - ' : '');
	$propSecTitle .= ($property_details[0]['street_address'] != '' ? $property_details[0]['street_address'] . ', ' : '');
	$propSecTitle .= ($property_details[0]['street_no'] != '' ? $property_details[0]['street_no'] . ' - ' : '');
	$propSecTitle .= ($property_details[0]['zip'] != '' ? $property_details[0]['zip'] : '');

	$property_posted_by = get_perticular_field_value('zc_user', 'user_name', " and user_id='" . $property_details[0]['property_post_by'] . "'");
	$propertyRefCode = CreateNewRefToken($property_details[0]['property_id'], $name);
	?>
	<div class="modal fade" id="proSusModal" style="background: rgba(0, 0, 0, 0.5);opacity:1;">
		<div class="modal-dialog" style="opacity:1;position:fixed;top:450px;left:375px;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" onclick="proSusModalClose();" data-dismiss="modal"
							aria-hidden="true">&times;</button>
					<h5 class="modal-title"><strong><?php echo stripslashes($proptitle); ?></strong></h5>
				</div>
				<div class="modal-body">
					<form class="BlockedProFrm" action="" method="post">
						<div class="col-md-12">
							<div class="form-group no-margin">
								<label class="control-label blcknt" for="field-7">Property Suspended Note</label>
								<textarea name="blocked_note" class="form-control require" rows="5"></textarea>
							</div>
						</div>
						<div style="clear:both;padding:5px;"></div>
						<div class="col-md-12">
							<div class="form-group no-margin">
								<label class="control-label" for="field-7">&nbsp;</label>
								<input type="hidden" name="proid"
									   value="<?php echo $property_details[0]['property_id']; ?>">
								<input type="submit" class="btn btn-success btn-sm pull-right" value="Submit">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" onclick="proSusModalClose();" data-dismiss="modal">
						Close
					</button>
				</div>
			</div>
		</div>
	</div>
	<?php
	if ($property_details[0]['property_status'] == '1') {
		$activeStatus = 'Drafted&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		$btn_class = "inactive";
		$css_class = "entypo-pause";
		$statusURL = 'href="javascript:void(0);"';
	}
	if ($property_details[0]['property_status'] == '2' && $property_details[0]['property_approval'] == '1') {
		$activeStatus = 'Published&nbsp;&nbsp;&nbsp;';
		$btn_class = "";
		$css_class = "entypo-flash";
		//$statusURL = base_url()."property/status_change/".$property_details[0]['property_id'].$pageLink;
		$statusURL = 'data-toggle="modal" href="javascript:;" onclick="javascript:proSusModal();"';
	}

	if ($property_details[0]['property_status'] == '2' && $property_details[0]['property_approval'] == '0') {
		$activeStatus = 'Inactive';
		$btn_class = "suspended";
		$css_class = "entypo-pause";
		$statusURL = 'href="' . base_url() . "property/status_change/" . $property_details[0]['property_id'] . '"';
	}
	?>
	<!--<a <?php echo $statusURL; ?> class="btn btn-success <?php echo $btn_class; ?> btn-sm btn-icon btn-xs">
				<i class="<?php echo $css_class; ?>"></i><?php echo $activeStatus; ?>
			</a>-->

	<?php
	$pageLink = "";
	$featuredLink = '<a href="' . base_url() . "property/make_featured/" . $property_details[0]['property_id'] . '" class="btn btn-blue btn-sm btn-icon btn-xs">
								<i class="entypo-back-in-time"></i>Feature&nbsp;&nbsp;
							 </a>';
	$featureStatus = get_perticular_field_value('zc_property_featured', 'status', " and property_id='" . $property_details[0]['property_id'] . "'");
	if ($featureStatus == 1) {
		$todayDate = strtotime(date('Y-m-d'));
		$startDate = get_perticular_field_value('zc_property_featured', 'start_date', " and property_id='" . $property_details[0]['property_id'] . "'");
		$expDateLength = get_perticular_field_value('zc_property_featured', 'number_of_days', " and property_id='" . $property_details[0]['property_id'] . "'");
		$expireDate = strtotime(date('Y-m-d', strtotime($startDate . " +" . $expDateLength . " days")));
		if ($todayDate < $expireDate) {
			$featuredLink = '<a href="' . base_url() . "property/" . ($property_details[0]['feature_status'] == 0 ? 'property_feature_resume' : 'property_feature_suspend') . "/" . $property_details[0]['property_id'] . $pageLink . '" class="btn btn-' . ($property_details[0]['feature_status'] == 0 ? 'gold' : 'red') . ' btn-sm btn-icon btn-xs">
										<i class="entypo-back-in-time"></i>' . ($property_details[0]['feature_status'] == 0 ? 'Resume' : 'Suspend') . '
									 </a>';
		}
	}
	echo $featuredLink;
	?>

	<a href="<?php echo base_url(); ?>property/delete_property/<?php echo $property_details[0]['property_id']; ?>"
	   class="btn btn-sm btn-icon btn-xs btn-red" onclick="return confirm('Are your sure?')">
		<i class="entypo-cancel"></i>Delete
	</a>

	<a href="<?php echo base_url(); ?>property/all/all" class="btn btn-sm btn-icon btn-xs btn-black">
		<i class="entypo-box"></i>Back
	</a>

	<a class="btn btn-default editbtn btn-sm btn-icon btn-xs" style="width:120px;" title="Click here to edit"
	   href="<?php echo base_url(); ?>property/edit_property_details/<?php echo $property_details[0]['property_id']; ?>">
		<i class="entypo-pencil"></i>Edit Property
	</a>


	<hr />


	<?php

  $attributes = array('class' => 'form-horizontal form-groups-bordered', 'id' => 'register','role'=>"form");

  echo form_open_multipart('property/make_prop_feature/'.$this->uri->segment('3').'/'.$this->uri->segment('4').'/'.$this->uri->segment('5').'/'.$this->uri->segment('6'), $attributes);



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

			$name=get_perticular_field_value('zc_contract_types','name'," and contract_id='".$property_details[0]['contract_id']."'");
			$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$property_details[0]['typology']."'");
			$city_name=get_perticular_field_value('zc_city','city_name'," and city_id='".$property_details[0]['city']."'");
			$province_code=get_perticular_field_value('zc_region_master','province_code'," and city='".mysql_real_escape_string($city_name)."'");

			$proptitle = $name." For ".stripslashes($typology_name)." in ".$city_name.", ".$province_code;

			

			?>

			<h2><?php echo stripslashes($proptitle); ?></h2>

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

