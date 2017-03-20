<?php $this->load->view('inc/header.php'); ?>



	<style>


		.success {
			margin-bottom: 10px;
			background-color: #006868;
			color: #ffea52;
			border: #CCC solid 1px;
			text-align: center;
		}


	</style>

<style>

/*jquery error styles */

.mapAddress{font-size:14px;font-weight:bold;}

.mapAddress a{color:#e96e2a;float:right;}

#dragged-address-location{height: 30px;padding: 0 10px 5px;color:#AAAAAA;}

#dragged-address-location.active{font-weight: bold;color:#000000;}

#map_canvas{width:100%;height:400px;border:solid 1px #DDDDDD;}

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

		return this.optional(element) || /(https?:)?([w-]+.)+[w-]+[.com|.in|.org]+([?%&=]*)?/.test(value);

	});

	jQuery.extend(jQuery.validator.methods, {

		 number: function(value, element) {

			return this.optional(element)

				|| /^(?:d+|d{1,3}(?:.d{3})+)(?:,d+)?$/.test(value)

				|| /^(?:d+|d{1,3}(?:,d{3})+)(?:.d+)?$/.test(value);

		  }

	});

});

</script>



	<div class="main-content">


		<h3>


			<?php



			if (isset($title_en)) {



			print $title_en;



		}else{



			print "	ZAPCASA | Dashboard";



		}



			?>


		</h3>


		<hr/>

		<?php

	// echo '<pre>';print_r($property_details);

	//Finding Property Title Here.

	if (isset($_COOKIE['lang']) && ($_COOKIE['lang'] == "english")) {

		//$name=get_perticular_field_value('zc_contract_types','name'," and contract_id='".$property_details[0]['contract_id']."'");

		//$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$property_details[0]['typology']."'");

		//$city_name=get_perticular_field_value('zc_city','city_name'," and city_id='".$property_details[0]['city']."'");

		$province_code = get_perticular_field_value('zc_region_master', 'province_code', " and city='" . mysql_real_escape_string($property_details[0]['provience']) . "'");



		$proptitle = stripslashes($property_details[0]['name']) . " in " . $property_details[0]['provience'] . ", " . $province_code;

	} else {

		//$name_it=get_perticular_field_value('zc_contract_types','name_it'," and contract_id='".$property_details[0]['contract_id']."'");

		//$typology_name=get_perticular_field_value('zc_typologies','name_it'," and status='active' and typology_id='".$property_details[0]['typology']."'");

		//$city_name=get_perticular_field_value('zc_city','city_name_it'," and city_id='".$property_details[0]['city']."'");

		$province_code = get_perticular_field_value('zc_region_master', 'province_code', " and city_it='" . mysql_real_escape_string($property_details[0]['provience']) . "'");



		$proptitle = $property_details[0]['name'] . " For " . stripslashes($property_details[0]['name']) . " in " . $property_details[0]['provience'] . ", " . $province_code;

	}


		//FInding Property Address Here.

		$propertyShowingAddress = '';

		$propertyAddress = ($property_details[0]['street_address'] != '' ? $property_details[0]['street_address'] . ', ' : '');

		$propertyAddress .= ($property_details[0]['street_no'] != '' ? $property_details[0]['street_no'] : '');

	$propertyShowingAddress .= $propertyAddress . ', ' . $property_details[0]['provience'] . ', ' . $province_code;

		$propertyAddress .= ($property_details[0]['zip'] != '' ? ' - ' . $property_details[0]['zip'] : '');

		$propertyShowingAddress .= ($property_details[0]['zip'] != '' ? ' - ' . $property_details[0]['zip'] : '');

	//$propertyImage = base_url()."assets/images/no_proimg.jpg";

	//$image_path =$property_details[0]['url'];

	if ($property_details[0]['url'] != "") {

		$propertyImage = base_url() . "assets/uploads/NearByProperty/" . $property_details[0]['property_details_id'] . "/thumb/" . $property_details[0]['url'];

	}

		$GoogleMapMarkers[0] = array(

			'proptitle' => $proptitle,

			'hackerspace' => 'markers',

			'latitude' => ($property_details[0]['latitude'] == '0' ? '0' : $property_details[0]['latitude']),

			'longitude' => ($property_details[0]['longitude'] == '0' ? '0' : $property_details[0]['longitude']),

			'proaddress' => $propertyAddress,

			'propurl' => 'javascript:void(0);',

			'proprice' => '',

			'proimg' => $propertyImage

		);



		?>

		<div class="registercomn_box"
			 id="regboxId" <?php //echo($propertySuspensionStatus==1?'style="display:none;"':''); ?>>

			<div id="add_newproperty_box" class="add_newproperty_box">

				<div class="add_newproperty_table1" style="width:100%;">

					<div class="section1">

						<div class="mapAddress">

							<?php echo $propertyShowingAddress; ?>

						</div>

					</div>

					<div class="section2" style="border-top:1px solid #cccccc">

						<?php

						$attributes = array('class' => 'add_property_form', 'id' => 'register');

						echo form_open_multipart('NearByProperty/update_location', $attributes);

						?>

						<div class="cat_select">

							<label style="display:block;">

								<font style="color:#f33038;">*</font>Latitude 

							</label>

							<label style="display:none;font-weight:normal" generated="true" for="promaplatitude"
								   class="error"></label>

							<input
								value="<?php echo(!empty($GoogleMapMarkers) ? $GoogleMapMarkers[0]['latitude'] : ''); ?>"
								name="promaplatitude" id="promaplatitude" placeholder="Enter Latitude" type="text"
								class="required placeholder">

						</div>

						<div class="cat_select">

							<label style="display:block;">

								<font style="color:#f33038;">*</font>Longitude

							</label>

							<label style="display:none;font-weight:normal" generated="true" for="promaplongitude"
								   class="error"></label>

							<input
								value="<?php echo(!empty($GoogleMapMarkers) ? $GoogleMapMarkers[0]['longitude'] : ''); ?>"
								name="promaplongitude" id="promaplongitude" placeholder="Enter Longitude" type="text"
								class="required placeholder">

						</div>

						<div class="cat_select" style="width:245px;margin-top:22px;>

                            <label style=" display:block;
						"></label>

						<input type="hidden" name="locupdatefor"
							   value="<?php echo $property_details[0]['property_details_id']; ?>">

						<input type="submit" value="Save" name="btnSubmit" class="mainbt" style="margin-right:0;">
						<input type="submit" value=" SKIP" name="btnSubmit" class="mainbt" style="margin-left: 10px;">


					</div>

					<?php echo form_close(); ?>

				</div>

				<div class="add_newproperty_table2" style="margin-top:0;padding:15px 0 0 2px">

					<p id="dragged-address-location">

						Dragged address will be shown here.

					</p>

					<div class="rightmap_area" id="map_canvas"></div>

				</div>

			</div>

		</div>

		</div>



	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/map.css?nocache=289671982568" type="text/css"/>

	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/zapcasa_style.css" type="text/css"/>

	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?= MAP_KEY ?>"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/label.js"></script>

	<script type="text/javascript">

		var WebRoot = '<?php echo base_url(); ?>';

		var centerZoom = <?php echo(!empty($GoogleMapMarkers)?($GoogleMapMarkers[0]['latitude']=='0'?'7':'14'):'7'); ?>;;

		var centerLatitude = <?php echo(!empty($GoogleMapMarkers)?($GoogleMapMarkers[0]['latitude']=='0'?'42.500000':$GoogleMapMarkers[0]['latitude']):'41.500000'); ?>;

		var centerLongitude = <?php echo(!empty($GoogleMapMarkers)?($GoogleMapMarkers[0]['longitude']=='0'?'12.500000':$GoogleMapMarkers[0]['longitude']):'21.500000'); ?>;

		var map;

		// var infowindow = null;

		var gmarkers = [];

		var markerTitles = [];

		var highestZIndex = 0;

		var agent = "default";

		var zoomControl = true;

		var MarkerDraggable = true;

		var MarkerClickable = false;

		var DrawCircleAroundMarker = true;

		var CircleMapRadius = <?php echo(!empty($GoogleMapMarkers)?($GoogleMapMarkers[0]['latitude']=='0'?'75000':'750'):'75000'); ?>;

		var geocoder;

		var markerTitles = [];

		// markers array: name, type (icon), lat, long, description, uri, address

		GoogleMapMarkers = new Array();

		<?php

		if(!empty($GoogleMapMarkers)){

			$gMi = 0;

			foreach($GoogleMapMarkers as $gM){

		?>

		GoogleMapMarkers.push(["<?php echo $gM['proptitle']; ?>", "<?php echo $gM['hackerspace']; ?>", <?php echo($gM['latitude']=='0'?'42.500000':$gM['latitude']); ?>, <?php echo($gM['longitude']=='0'?'12.500000':$gM['longitude']); ?>, "<?php echo $gM['proaddress']; ?>", "<?php echo $gM['propurl']; ?>", '<?php echo $gM['proprice']; ?>', "<?php echo $gM['proimg']; ?>", "noMarker"]);

		markerTitles[<?php echo $gMi; ?>] = "<?php echo $gM['proptitle']; ?>";

		<?php

			$gMi++;

			}

		}

		?>

	</script>

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/represent-map.js"></script>



<?php $this->load->view('inc/footer.php'); ?>