<?php //echo'<pre>';print_r($advertiser_detail);
//  $ShowingProvinceCode=get_perticular_field_value('zc_region_master','province_code'," and (province_name = '".str_replace("'","\\\'",$advertiser_detail[0]['province'])."' OR province_name_it = '".str_replace("'","\\\'",$advertiser_detail[0]['province'])."') group by province_code");
// $advertiserGeoAddress.= stripslashes($advertiser_detail[0]['city']).', '.$ShowingProvinceCode.', '.$advertiser_detail[0]['zip'].', Italy';
//  		 //echo "<pre>"; print_r($advertiserGeoAddress);
//  		 echo($advertiser_detail[0]['latitude']=='0'?$GoogleMapMarkersLatitude:$advertiser_detail[0]['latitude']); exit;  ?>

<?php $this->load->view("_include/meta"); ?>

<style>

#mail_form input.error {border:1px solid red;}

#mail_form textarea.error {border:1px solid red;}

#feed_form input.error {border:1px solid red;}

#feed_form textarea.error {border:1px solid red;}

.fullScreen

{

	width: 100% !important;

	z-index: 100 !important;

	height: 450px !important;

	transition: all 2s;

}

.property_view

{

	transition: all 2s;

}

.tmp {

	position: relative;

	top: 50px;

}

</style>

<script type="text/javascript">

	$(document).ready(function () {

		$('#nav li').hover(function () {

			$('ul', this).slideDown(200);

			$(this).children('a:first').addClass("hov");

		}, function () {

			$('ul', this).slideUp(100);

			$(this).children('a:first').removeClass("hov");

		});

	});

	$(function () {

		$(window).scroll(function () {

			var scrollTop = $(document).scrollTop();

			//var searchListHeight = $('.searchresult_box').height();

			//$('.topbluebar').html(scrollTop);

			if (scrollTop >= 40 && scrollTop <= 1385) {

				$('.map-cont').css({

					position: 'fixed',

					top: '120px',

					width: '32.7%',

				});

			} else {

				$('.map-cont').css({

					position: 'relative',

					top: '1335px',

					width: '100%',

				});

				if (scrollTop < 40) {

					$('.map-cont').removeAttr('style');

			}

			}

	});

	});

	$(document).ready(function () {

		$("#mail_form").validate({

			rules: {

				name: {

					required: true

				}, email_id: {

					required: true,

					email: true

				}, message: {

					required: true

				}, subject: {

					required: true

				}

			},

			messages: {

				name: "",

				email_id: "",

				message: "",

				subject: ""

			}

		});

		if ($("#showcase").length) {

			$("#showcase").awShowcase({

				content_width: 464,

				content_height: 376,

				fit_to_parent: false,

				auto: false,

				interval: 3000,

				continuous: false,

				loading: true,

				tooltip_width: 200,

				tooltip_icon_width: 32,

				tooltip_icon_height: 32,

				tooltip_offsetx: 18,

				tooltip_offsety: 0,

				arrows: false,

				buttons: true,

				btn_numbers: true,

				keybord_keys: true,

				mousetrace: false,

				/* Trace x and y coordinates for the mouse */

				pauseonover: true,

				stoponclick: true,

				transition: 'vslide',

				/* hslide/vslide/fade */

				transition_delay: 500,

				transition_speed: 500,

				show_caption: 'onhover',

				/* onload/onhover/show */

				thumbnails: true,

				thumbnails_position: 'outside-last',

				/* outside-last/outside-first/inside-last/inside-first */

				thumbnails_direction: 'vertical',

				/* vertical/horizontal */

				thumbnails_slidex: 0,

				/* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */

				dynamic_height: false,

				/* For dynamic height to work in webkit you need to set the width and height of images in the source. Usually works to only set the dimension of the first slide in the showcase. */

				speed_change: true,

				/* Set to true to prevent users from swithing more then one slide at once. */

				viewline: false

				/* If set to true content_width, thumbnails, transition and dynamic_height will be disabled. As for dynamic height you need to set the width and height of images in the source. */

			});

		}

	});

	$(document).ready(function () {

		$('.fancybox').fancybox();

	});

	$(function () {

		$("#tabss").tabs();

	});

	var page = "advDetails";

</script>

</head>  

<body class="noJS">

<script>

	var bodyTag = document.getElementsByTagName("body")[0];

	bodyTag.className = bodyTag.className.replace("noJS", "hasJS");

</script>

<!----- login pop up end ---------------------->

<div id="toPopup4">

	<div class="close4"></div>

	<div id="popup_content1">

		<table>

			<tr>

				<td><img src="<?php echo base_url(); ?>assets/images/add_newproperty_icon.jpg"></td>

				<td><span
						style="font-weight:bold; color:#000; text-align:left;"><?php echo $this->lang->line('info_addprop_to_add_a_property'); ?></span>
				</td>

			</tr>

		</table>

		<div style="text-align:center;">

			<span><?php echo $this->lang->line('info_addprop_if_you_have_an_advertiser_account'); ?> </span><br/>

			<span><?php echo $this->lang->line('info_addprop_or'); ?></span><br/>

			<span><?php echo $this->lang->line('info_addprop_to_sign_up_as'); ?></span>

			<span
				style="font-size:14px; color:#A3CFF7;">(<?php echo $this->lang->line('info_addprop_this_account_will_be_disconnected'); ?>
				)</span>

			<span style="padding-left:101px;"><a href="<?php echo base_url(); ?>property/add_property_form"
												 class="mainbt"><?php echo $this->lang->line('info_addprop_register_a_new_account'); ?></a></span>

		</div>

	</div>

	</div>

<div id="backgroundPopup4"></div>

<!------ Header part -------------->

<div class="fixed_header">

	<div class="topbluebar"></div>

	<div class="main">

		<?php $this->load->view("_include/header"); ?>

	</div>

	<?php $this->load->view("_include/login_user"); ?>

	<!--saved search popup-->

	<?php $this->load->view("_include/saved_search"); ?>

	<!--saved search popup ends-->

	<?php $this->load->view("_include/information"); ?>

</div>

</div>

<!------ banner part

<div class="insidepage_banner">

    <div class="main">

        <h2>Real Estate for <font style="font-weight:bold;">Jobs</font> & <font style="font-weight:bold;">Housing</font></h2>

    </div>

</div>

------------->

<!------ body part ---------------->

<?php

if (count($advertiser_detail) == 0) {

	header('Location: ' . base_url() . 'errors/error_404.php');

	die;

}

$user_pref = get_all_preference_by_user("zc_user_preference", $where = " AND user_id=" . $advertiser_detail[0]['user_id']);

if (isset($user_pref[0]['invisible']) && ($user_pref[0]['invisible'] == 1)) {

	//header('Location: '.base_url().'users/my_account');

	header('Location: ' . base_url() . 'errors/error_404.php');

	die;

}

if (isset($advertiser_detail[0]['status']) && ($advertiser_detail[0]['status'] == 0)) {

	//header('Location: '.base_url().'users/my_account');

	header('Location: ' . base_url() . 'errors/error_404.php');

	die;

}

?>

<div class="main main_searchpage">

	<?php

	$business_name = "";

	if ($advertiser_detail[0]['user_type'] == '3') {

		$business_name = ucfirst($advertiser_detail[0]['company_name']);

	} else {

		$business_name = ucfirst($advertiser_detail[0]['first_name']) . " " . ucfirst($advertiser_detail[0]['last_name']);

	}

	?>

	<div id="breadcrumb" class="fk-lbreadbcrumb newvd">

		<span><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('advertise_details_home'); ?></a></span>
		>

    	<span><a href="<?php echo base_url()."advertiser/search?location=&name=&advertiser_type=all";?>">

				<?php echo $this->lang->line('advertiser_title_details'); ?></a></span> >

		<span><?php echo $business_name; ?></span>

	</div>

	<!--<h2 class="pagetitle">Registration</h2>-->

	<!-- <div class="refinesearch">-->



	<?php //$this->load->view("_include/search_header"); ?>



	<!-- </div>-->

	<div class="refinesearch">

		<?php $this->load->view("_include/search_header_advertiser"); ?>

	</div>

	<div class="advertiser_details">

		<h2 class="searchfound">

	        <span class="post_brn">

	        		<?php

					$user_type = get_perticular_field_value('zc_user', 'user_type', " and user_id='" . $this->session->userdata('user_id') . "'");

					if ($user_type == '2' || $user_type == '3') {

						?>

						<a href="<?php echo base_url(); ?>property/add_property_form"
						   class="freepost"><?php echo $this->lang->line('advertise_details_post_your_property'); ?>
							<font
								style="color:#fff000"><?php echo $this->lang->line('advertise_details_free'); ?></font></a>

					<?php

					}
					if ($user_type == '1') {

						?>

						<a href="<?php echo base_url(); ?>property/add_property_form"
						   class="freepost add_property"><?php echo $this->lang->line('advertise_details_post_your_property'); ?>
							<font
								style="color:#fff000"><?php echo $this->lang->line('advertise_details_free'); ?></font></a>

					<?php

					}
					if ($this->session->userdata('user_id') == '0' || $this->session->userdata('user_id') == '') {

						?>

						<a href="<?php echo base_url(); ?>users/common_reg"
						   class="freepost"><?php echo $this->lang->line('advertise_details_post_your_property'); ?>
							<font
								style="color:#fff000"><?php echo $this->lang->line('advertise_details_free'); ?></font></a>

					<?php

					}

					?>

	         </span>

		</h2>


		<div class="property_view">

			<?php

			/*if($advertiser_detail[0]['user_type']=='3')

              {*/

			?>



			<ul>

				<li><a id="show_image" href="javascript:void(0);" class="active"
					   onClick="show_image();"><?php echo $this->lang->line('advertise_details_image_view'); ?></a></li>

				<?php

				if ($advertiser_detail[0]['user_type'] == '2' || $advertiser_detail[0]['user_type'] == '3') {

					if ($user_pref[0]['my_address_display'] != 1) {

						?>

						<li>

							<a id="show_map" href="javascript:void(0);" onClick="initAdvArea();">

								<?php echo $this->lang->line('advertise_details_map_view'); ?>

							</a>

						</li>

					<?php

					}

					}

				?>

			</ul>

			<div class="clear"></div>

			<div id="image_view">

				<?php

				if ($advertiser_detail[0]['file_2'] != '') {

					?>

					<div id="image_view"
						 style="background: url(<?php echo base_url();?>assets/uploads/thumb_92_82/<?php echo $advertiser_detail[0]['file_2']; ?>) 50% no-repeat #ffffff;background-size:contain;">

						<img src="<?php echo base_url();?>assets/images/alpha_10x10.png">

					</div>

				<?php

				} else {

					?>

					<div id="image_view"
						 style="background: url(<?php echo base_url();?>assets/images/<?php echo $this->lang->line('advertise_details_no_proimg_filename');?>) 50% no-repeat #ffffff;background-size:contain;">

						<img src="<?php echo base_url();?>assets/images/alpha_10x10.png">

					</div>

				<?php

				}

				?>

			</div>

			<?php if ($user_pref[0]['my_address_display'] != 1) { ?>

				<div id="map_canvas" style="width:100%;height:300px;display:none;"></div>

			<?php } ?>


		</div>

		<div class="property_info">


			<div class="company_logo" style="height:175px;">

				<?php

				if ($advertiser_detail[0]['user_type'] == '3' || $advertiser_detail[0]['user_type'] == '2') {

					if ($advertiser_detail[0]['file_1'] > ' ') {

						?>

						<img
							src="<?php echo base_url();?>assets/uploads/thumb_92_82/<?php echo $advertiser_detail[0]['file_1']; ?>"
							alt="<?php echo $business_name; ?>">

					<?php

					} else {

						?>

						<img src="<?php echo base_url(); ?>assets/images/no_prof.png"
							 alt="<?php echo $business_name; ?>">

					<?php

					}

				}

				if ($advertiser_detail[0]['user_type'] == '3') {

					?>

					<h2 class="company_name"><?php echo ucfirst($advertiser_detail[0]['company_name']); ?></h2>

					<h3 class="business_name"><?php echo $advertiser_detail[0]['business_name']; ?></h3>

				<?php

				} else {

					?>

					<h2 class="company_name"><?php echo ucfirst($advertiser_detail[0]['first_name']); ?>
						&nbsp;<?php echo ucfirst($advertiser_detail[0]['last_name']); ?></h2>

				<?php

				}

				?>

			</div>

			<?php

			if ($advertiser_detail[0]['vat_number'] != "") {

				?>

				<p><?php echo $this->lang->line('advertise_details_vat') . $advertiser_detail[0]['vat_number']; ?></p>

			<?php

			}

			$advertiserAddress = '';

			$advertiserGeoAddress = '';

			if ($advertiser_detail[0]['user_type'] == '3') {

				if ($user_pref[0]['my_address_display'] != 1) {

					?>

					<p>

						<?php

						if ($_COOKIE['lang'] == "it") {

							if (!strpos($advertiser_detail[0]['city'], "'") === false) {

								$ShowingCityName = get_perticular_field_value('zc_region_master', 'city_it', " and (city = '" . str_replace("'", "\\\'", $advertiser_detail[0]['city']) . "' OR city_it = '" . str_replace("'", "\\\'", $advertiser_detail[0]['city']) . "') group by province_code");

							} else {

								$ShowingCityName = get_perticular_field_value('zc_region_master', 'city_it', " and (city = '" . $advertiser_detail[0]['city'] . "' OR city_it = '" . $advertiser_detail[0]['city'] . "') group by province_code");

							}

							//

							if (!strpos($advertiser_detail[0]['province']) === false) {


								$ShowingProvinceCode = get_perticular_field_value('zc_region_master', 'province_code', " and (province_name = '" . str_replace("'", "\\\'", $advertiser_detail[0]['province']) . "' OR province_name_it = '" . str_replace("'", "\\\'", $advertiser_detail[0]['province']) . "') group by province_code");


							} else {


								$ShowingProvinceCode = get_perticular_field_value('zc_region_master', 'province_code', " and (province_name = '" . $advertiser_detail[0]['province'] . "' OR province_name_it = '" . $advertiser_detail[0]['province'] . "') group by province_code");


							}

						} else {

							if (!strpos($advertiser_detail[0]['province'], "'") === false) {

								$ShowingCityName = get_perticular_field_value('zc_region_master', 'city', " and (city = '" . str_replace("'", "\\\'", $advertiser_detail[0]['city']) . "' OR city_it = '" . str_replace("'", "\\\'", $advertiser_detail[0]['city']) . "') group by province_code");

							} else {

								$ShowingCityName = get_perticular_field_value('zc_region_master', 'city', " and (city = '" . $advertiser_detail[0]['city'] . "' OR city_it = '" . $advertiser_detail[0]['city'] . "') group by province_code");

							}

							//

							if (!strpos($advertiser_detail[0]['province'], "'") === false) {

								$ShowingProvinceCode = get_perticular_field_value('zc_region_master', 'province_code', " and (province_name = '" . str_replace("'", "\\\'", $advertiser_detail[0]['province']) . "' OR province_name_it = '" . str_replace("'", "\\\'", $advertiser_detail[0]['province']) . "') group by province_code");

							} else {

								$ShowingProvinceCode = get_perticular_field_value('zc_region_master', 'province_code', " and (province_name = '" . $advertiser_detail[0]['province'] . "' OR province_name_it = '" . $advertiser_detail[0]['province'] . "') group by province_code");

							}

						}

						if ($advertiser_detail[0]['street_address']) {

							$advertiserAddress .= stripslashes($advertiser_detail[0]['street_address']);

						}

						if ($advertiser_detail[0]['street_no']) {

							$advertiserAddress .= ', ' . stripslashes($advertiser_detail[0]['street_no']);

						}

						if ($advertiser_detail[0]['zip']) {

							$advertiserAddress .= ' - ' . $advertiser_detail[0]['zip'];

						}

						if ($ShowingCityName != "") {

							$advertiserAddress .= ' ' . stripslashes($ShowingCityName);

						}

						if ($ShowingProvinceCode != "") {

							$advertiserAddress .= ' - ' . stripslashes($ShowingProvinceCode);

						}

						if ($st_name1 != "") {

							$advertiserAddress .= ' - ' . $st_name1;

						}

						$advertiserGeoAddress .= stripslashes($ShowingCityName) . ', ' . $st_name1 . ', ' . $advertiser_detail[0]['zip'] . ', Italy';

						echo $advertiserAddress;

						?>

					</p>

				<?php

				}

			}

			if ($advertiser_detail[0]['user_type'] == '2') {

				if ($user_pref[0]['my_address_display'] != 1) {

					?>

					<p>

						<?php

						if ($_COOKIE['lang'] == "it") {

							if (!strpos($advertiser_detail[0]['city'], "'") === false) {

								$ShowingCityName = get_perticular_field_value('zc_region_master', 'city_it', " and (city = '" . str_replace("'", "\\\'", $advertiser_detail[0]['city']) . "' OR city_it = '" . str_replace("'", "\\\'", $advertiser_detail[0]['city']) . "') group by province_code");

							} else {

								$ShowingCityName = get_perticular_field_value('zc_region_master', 'city_it', " and (city = '" . $advertiser_detail[0]['city'] . "' OR city_it = '" . $advertiser_detail[0]['city'] . "') group by province_code");

							}

							//

							if (!strpos($advertiser_detail[0]['province'], "'") === false) {

								$ShowingProvinceCode = get_perticular_field_value('zc_region_master', 'province_code', " and (province_name = '" . str_replace("'", "\\\'", $advertiser_detail[0]['province']) . "' OR province_name_it = '" . str_replace("'", "\\\'", $advertiser_detail[0]['province']) . "') group by province_code");

							} else {

								$ShowingProvinceCode = get_perticular_field_value('zc_region_master', 'province_code', " and (province_name = '" . $advertiser_detail[0]['province'] . "' OR province_name_it = '" . $advertiser_detail[0]['province'] . "') group by province_code");

							}

						} else {

							if (!strpos($advertiser_detail[0]['province'], "'") === false) {

								$ShowingCityName = get_perticular_field_value('zc_region_master', 'city', " and (city = '" . str_replace("'", "\\\'", $advertiser_detail[0]['city']) . "' OR city_it = '" . str_replace("'", "\\\'", $advertiser_detail[0]['city']) . "') group by province_code");

							} else {

								$ShowingCityName = get_perticular_field_value('zc_region_master', 'city', " and (city = '" . $advertiser_detail[0]['city'] . "' OR city_it = '" . $advertiser_detail[0]['city'] . "') group by province_code");

							}

							//

							if (!strpos($advertiser_detail[0]['province'], "'") === false) {

								$ShowingProvinceCode = get_perticular_field_value('zc_region_master', 'province_code', " and (province_name = '" . str_replace("'", "\\\'", $advertiser_detail[0]['province']) . "' OR province_name_it = '" . str_replace("'", "\\\'", $advertiser_detail[0]['province']) . "') group by province_code");

							} else {

								$ShowingProvinceCode = get_perticular_field_value('zc_region_master', 'province_code', " and (province_name = '" . $advertiser_detail[0]['province'] . "' OR province_name_it = '" . $advertiser_detail[0]['province'] . "') group by province_code");

							}

						}

						if ($advertiser_detail[0]['street_address']) {

							$advertiserAddress .= stripslashes($advertiser_detail[0]['street_address']);

						}

						if ($advertiser_detail[0]['street_no']) {

							$advertiserAddress .= ', ' . stripslashes($advertiser_detail[0]['street_no']);

						}

						if ($advertiser_detail[0]['zip']) {

							$advertiserAddress .= ' - ' . $advertiser_detail[0]['zip'];

						}

						if ($ShowingCityName != "") {

							$advertiserAddress .= ' ' . stripslashes($ShowingCityName);

						}

						if ($ShowingProvinceCode != "") {

							$advertiserAddress .= ' - ' . $ShowingProvinceCode;

						}

						echo $advertiserAddress;

						$advertiserGeoAddress .= stripslashes($ShowingCityName) . ', ' . $ShowingProvinceCode . ', ' . $advertiser_detail[0]['zip'] . ', Italy';

						?>

					</p>

				<?php

				}

			}

			?>

			<ul>

				<?php if ($user_pref[0]['my_contact_info'] != 1) { ?>

					<li class="call">

						<?php

						if ($advertiser_detail[0]['user_type'] == '3') {

							if ($advertiser_detail[0]['contact_ph_no'] != '') {

								echo $advertiser_detail[0]['contact_ph_no'];

							} else {

								echo $this->lang->line('advertise_details_contact_not_available');

							}

						} else {

							if ($advertiser_detail[0]['phone_1'] != "") {
								echo $advertiser_detail[0]['phone_1'];
							} else {
								echo $this->lang->line('advertise_details_contact_not_available');
							}

						}

						?>

						<?php

						if ($advertiser_detail[0]['phone_2'] != '') {

							echo " | " . $advertiser_detail[0]['phone_1'];

						}

						if ($advertiser_detail[0]['fax_no'] != '') {

							echo " | " . $this->lang->line('advertise_details_fax') . $advertiser_detail[0]['fax_no'];

						}

						?>

					</li>

					<li class="mail"><?php if ($advertiser_detail[0]['email_id'] != "") {
							echo $advertiser_detail[0]['email_id'];
						} else {
							echo $this->lang->line('advertise_details_contact_not_available');
						} ?></li>

				<?php }

				if ($advertiser_detail[0]['user_type'] == '3') {

					?>



					<?php

					if ($advertiser_detail[0]['website'] != '') { ?>

						<li class="web"><?php echo $advertiser_detail[0]['website']; ?></li>

					<?php } ?>



				<?php

				}

				?>

			</ul>

		</div>

		<div class="sep_line"></div>

		<div class="left_panel">

			<?php

			if ($advertiser_detail[0]['about_me'] != '') { ?>

				<h2><?php echo $this->lang->line('advertise_details_description');?></h2>

				<p>

					<?php echo nl2br($advertiser_detail[0]['about_me']);?>

				</p>

			<?php

			}

			?>



			<!--property posted by owner/agency-->

			<h2 style="margin-top:25px;"><?php echo $this->lang->line('advertise_details_last_properties'); ?></h2>

			<ul>


				<?php
				// echo "<pre> ====> VIX";
				//    print_r($property_list);exit;
				if (!empty($property_list)) {

					foreach ($property_list as $property_lists) {

						$provinceName = get_perticular_field_value('zc_provience', 'provience_name', " and `provience_id` = '" . $property_lists['provience'] . "'");

						if (!strpos($provinceName, "'") === false) {

							$provinceName = str_replace("'", "\\\\\'", stripslashes($provinceName));

						}

						$st_name1 = get_perticular_field_value('zc_region_master', 'province_code', " and `province_name` = '" . $provinceName . "' group by Province_Code");

						$cityName = get_perticular_field_value('zc_city', ($_COOKIE['lang'] == "it" ? 'city_name_it' : 'city_name'), " and `city_id` = '" . $property_lists['city'] . "'");

						$prop_det_url = '';

						if ($property_lists['contract_id'] == 1) {

							$contract = "Rent";

						}

						if ($property_lists['contract_id'] == 2) {

							$contract = "Sell";

						}

						$prop_det_url .= $contract;

						$typology_name = get_perticular_field_value('zc_typologies', 'name', " and status='active' and typology_id='" . $property_lists['typology'] . "'");

						//$prop_det_url.='-'.trim($typology_name);

						$prop_det_url .= '-' . trim($cityName);

						$prop_det_url .= '-' . trim($provinceName);

						$prop_det_url .= '-' . trim($property_lists['property_id']);

						$first_segment = "";
						//echo $prop_det_url;exit;

						$category_id = $property_lists['category_id'];


						if ($category_id == '6' || $category_id == '7') {

							$first_segment = 'Business';

							///////////////////////////////////////////////////

						}

						if ($category_id == '1') {

							$first_segment = 'Residential';

							///////////////////////////////////////////////////

						}

						if ($category_id == '3') {

							$first_segment = 'Rooms';

							///////////////////////////////////////////////////

						}

						if ($category_id == '4') {

							$first_segment = 'Land';

							///////////////////////////////////////////////////

						}

						if ($category_id == '5') {

							$first_segment = 'Vacations';

							///////////////////////////////////////////////////

						}

						?>

						<li>

							<div class="last_property" style="display:table;width:100%;">

								<?php

								$property_name = "";

								if ($property_lists['contract_id'] == 1) {

									$contract = $this->lang->line('advertise_details_rent_for');

								}

								if ($property_lists['contract_id'] == 2) {

									$contract = $this->lang->line('advertise_details_sell_for');

								}

								$property_name .= $contract;

								$typology_name = get_perticular_field_value('zc_typologies', 'name', " and status='active' and typology_id='" . $property_lists['typology'] . "'");

								if (isset($_COOKIE['lang']) && ($_COOKIE['lang'] == "english")) {

									$property_name .= ' ' . stripslashes($typology_name);

								} elseif (isset($_COOKIE['lang']) && ($_COOKIE['lang'] == "it")) {

									$property_name = stripslashes($typology_name) . ' ' . $property_name;

								}

								//$sqForProCode = "SELECT `zc_region_master`.`province_code` FROM `zc_region_master` INNER JOIN `zc_provience` ON `zc_region_master`.`province_name`=`zc_provience`.`provience_name` WHERE `zc_provience`.`provience_id`='".$property_lists['provience']."' GROUP BY `province_code`";

								//$query=$CI->db->query($str);


								$provinceName = get_perticular_field_value('zc_provience', 'provience_name', " and `provience_id` = '" . $property_lists['provience'] . "'");

								if (!strpos($provinceName, "'") === false) {

									$provinceName = str_replace("'", "\\\\\'", stripslashes($provinceName));

								}

								$st_name1 = get_perticular_field_value('zc_region_master', 'province_code', " and `province_name` = '" . $provinceName . "' group by Province_Code");

								$cityName = get_perticular_field_value('zc_city', ($_COOKIE['lang'] == "it" ? 'city_name_it' : 'city_name'), " and `city_id` = '" . $property_lists['city'] . "'");


								if (isset($_COOKIE['lang']) && ($_COOKIE['lang'] == "english")) {

									$name = get_perticular_field_value('zc_contract_types', 'name', " and contract_id='" . $property_lists['contract_id'] . "'");

									$typology_name = get_perticular_field_value('zc_typologies', 'name', " and status='active' and typology_id='" . $property_lists['typology'] . "'");

									$city_name = get_perticular_field_value('zc_city', 'city_name', " and city_id='" . $property_lists['city'] . "'");

									$province_code = get_perticular_field_value('zc_region_master', 'province_code', " and city='" . mysql_real_escape_string($city_name) . "'");


									$proptitle = $name . " For " . stripslashes($typology_name) . " in " . $city_name . ", " . $province_code;

								} else {

									$name_it = get_perticular_field_value('zc_contract_types', 'name_it', " and contract_id='" . $property_lists['contract_id'] . "'");

									$typology_name = get_perticular_field_value('zc_typologies', 'name_it', " and status='active' and typology_id='" . $property_lists['typology'] . "'");

									$city_name = get_perticular_field_value('zc_city', 'city_name_it', " and city_id='" . $property_lists['city'] . "'");

									$province_code = get_perticular_field_value('zc_region_master', 'province_code', " and city_it='" . mysql_real_escape_string($city_name) . "'");


									$proptitle = stripslashes($typology_name) . " in " . $name_it . " a " . $city_name . ", " . $province_code;

								}

								?>

								<div style="display:table-cell;vertical-align:top;width:110px;height:80px;">

									<?php

									$property_id = $property_lists['property_id'];

									$main_img = get_perticular_field_value('zc_property_img', 'file_name', " and property_id='" . $property_id . "' and img_type='main_image'");

									if ($main_img != '') {

										?>

										<a href="<?php echo base_url(); ?><?php echo $first_segment; ?>/<?php echo $prop_det_url; ?>">

											<img
												src="<?php echo base_url(); ?>assets/uploads/Property/Property<?php echo $property_id; ?>/thumb_200_296/<?php echo $main_img; ?>"
												alt="<?php echo stripslashes($proptitle); ?>" width="102px"
												height="68px;">

										</a>

									<?php

									} else {

										?>

										<a href="<?php echo base_url(); ?><?php echo $first_segment; ?>/<?php echo $prop_det_url; ?>">

											<img src="<?php echo base_url(); ?>assets/images/no_img_small.png"
												 alt="<?php echo stripslashes($proptitle); ?>" width="102px"
												 height="68px;">

										</a>

									<?php

									}

									?>

								</div>

								<div style="display:table-cell;vertical-align:top;">

									<h2>

										<a href="<?php echo base_url();?><?php echo $first_segment;?>/<?php echo $prop_det_url;?>">

											<?php echo stripslashes($proptitle); ?>

										</a>

									</h2>

									<h3>

										<?php

										if ($property_lists['area'] != '') {

											echo $area_prop = $property_lists['area'] . ' - ';

										}

										?>

										<?php if ($property_lists['street_address'] != '') {
											echo $property_lists['street_address'] . ',';
										} ?>

										<?php if ($property_lists['street_no'] != '') {
											echo $property_lists['street_no'] . ' - ';
										} ?>

										<?php if ($property_lists['zip'] != '') {
											echo $property_lists['zip'];
										} ?>

									</h3>

									<?php

									if ($property_lists['description'] != "") {

										?>

										<p>

											<?php

											$description = nl2br($property_lists['description']);

											//echo strlen($description);

											if (strlen($description) <= 140) {

												echo $description;

											} else {

												$y = substr($description, 0, 140) . '...';

												echo $y;

											}

											?>

										</p>

									<?php

									}

									?>

								</div>

								<div style="clear:both;"></div>

							</div>

						</li>

					<?php

				}

				} else {

					?>

					<li>

						<div
							class="last_property"><?php echo $this->lang->line('advertise_details_no_property_found');?></div>

					</li>

				<?php

				}

				?>

			</ul>

			<!--Property list endas-->

		</div>

		<div class="right_panel">

			<?php

			$google_adsence = get_perticular_field_value('zc_settings', 'meta_value', " and meta_name='google_adsence'");

			if (isset($google_adsence) && (count($google_adsence) > 0)) {

				?>

				<div class="google_ad">

					<!--

			    		<img src="<?php echo base_url()?>assets/images/google_ad_300x250.jpg" >

			  		 -->

					<?php

					echo "<pre>";

					print_r($google_adsence);

					?>

				</div>

			<?php } ?>

			<?php $uid = $this->session->userdata('user_id'); ?>



			<?php //if($uid != '' || $uid != '0') { ?>

			<h2><?php echo $this->lang->line('advertise_details_ask_a_question'); ?></h2>

			<!--Mail sending option-->

			<?php

			$attributes = array('id' => 'mail_form');

			echo form_open_multipart('advertiser/add_message', $attributes);

			if ($this->session->flashdata('success') != '') {

				?>

				<div class="success" id="success">

					<?php echo $this->session->flashdata('success'); ?>

				</div>

			<?php

			}

			if ($this->session->flashdata('error') != '') {

				?>

				<div class="eror" id="eror">

					<?php echo $this->session->flashdata('error'); ?>

				</div>

			<?php

			}

			if ($uid == '' || $uid == '0') {

				$email_id = '';

				$name = "";

				$phone_number = "";

			}

			if ($uid != '') {

				$email_id = get_perticular_field_value('zc_user', 'email_id', " and user_id='" . $uid . "'");

				$first_name = get_perticular_field_value('zc_user', 'first_name', " and user_id='" . $uid . "'");

				$last_name = get_perticular_field_value('zc_user', 'last_name', " and user_id='" . $uid . "'");

				$name = $first_name . ' ' . $last_name;

				$phone_number = get_perticular_field_value('zc_user', 'contact_ph_no', " and user_id='" . $uid . "'");

			}

			?>

			<div class="advertiser_form">

				<div class="field"><input type="hidden"
										  placeholder="<?php echo $this->lang->line('advertise_details_your_name_field'); ?>"
										  name="name" id="name" value="<?php echo $name; ?>"></div>

				<div class="field"><input type="hidden"
										  placeholder="<?php echo $this->lang->line('advertise_details_email'); ?>"
										  name="email_id" id="email_id"
										  value="<?php if ($user_pref[0]['my_contact_info'] != 1) {
											  echo $email_id;
										  } ?>"></div>

				<div class="field"><input type="text"
										  placeholder="<?php echo $this->lang->line('advertise_details_subject'); ?>"
										  name="subject" id="subject" value=""></div>

				<div class="field"><textarea rows="3" cols="15"
											 placeholder="<?php echo $this->lang->line('advertise_details_message'); ?>"
											 name="message" id="message"></textarea></div>

				<input type="hidden" name="owner_id" value="<?php echo $advertiser_detail[0]['user_id']; ?>">

				<input type="hidden" name="property_id" value="0">

				<div class="field">

					<?php

					if ($this->session->userdata('user_id') == '0' || $this->session->userdata('user_id') == '') {

						?>

						<a herf="javascript:void(0);"
						   class="contact_agent"><?php echo $this->lang->line('advertise_details_send'); ?></a>

					<?php

					} else {

						?>

						<input type="submit" value="<?php echo $this->lang->line('advertise_details_button_send'); ?>">

					<?php

					}

					echo form_close();

					?>


				</div>

			</div>

			<?php // } ?>

			<?php /* ------------- Ask Form ------------- */ ?>





			<div class="feedback"><a href="#Fform" id="open_feedback"
									 onClick="return open_feedback_form();"><?php echo $this->lang->line('advertise_details_leave_feedback'); ?></a>
			</div>


			<!--Feedback form starts-->

			<div id="feedback_form" style="display:none;">

				<a name="Fform"></a>

				<h2><?php echo $this->lang->line('advertise_details_give_feedback'); ?></h2>

				<?php

				$attributes = array('id' => 'feed_form');

				echo form_open_multipart('advertiser/add_feedback', $attributes);

				?>

				<?php

				if ($this->session->flashdata('success_feedback') != '') {

					?>

					<div class="success" id="success">

						<?php echo $this->session->flashdata('success_feedback');?>

					</div>

				<?php

				}

				?>





				<?php

				if ($this->session->flashdata('error_feedback') != '') {

					?>

					<div class="eror" id="eror">

						<?php echo $this->session->flashdata('error_feedback');?>

					</div>

				<?php

				}

				?>

				<?php

				$uid = $this->session->userdata('user_id');


				if ($uid == '' || $uid == '0') {

					$email_id = '';

					$name = "";

					$phone_number = "";

				}

				if ($uid != '') {

					$email_id = get_perticular_field_value('zc_user', 'email_id', " and user_id='" . $uid . "'");

					$first_name = get_perticular_field_value('zc_user', 'first_name', " and user_id='" . $uid . "'");

					$last_name = get_perticular_field_value('zc_user', 'last_name', " and user_id='" . $uid . "'");

					$name = $first_name . ' ' . $last_name;

					$phone_number = get_perticular_field_value('zc_user', 'contact_ph_no', " and user_id='" . $uid . "'");

				}

				?>

				<div class="advertiser_form">

					<p style="margin-bottom: 10px;"><?php echo $this->lang->line('advertise_details_tips_suggestions'); ?></p>

					<div class="field">
						<input <?php if ($uid != '' || $uid != '0') { ?> type="hidden" <?php } else { ?> type="text" <?php } ?>
							placeholder="<?php echo $this->lang->line('advertise_details_feedback_your_name_field'); ?>"
							name="name" id="name" value="<?php echo $name; ?>"></div>

					<div class="field">
						<input <?php if ($uid != '' || $uid != '0') { ?> type="hidden" <?php } else { ?> type="text" <?php } ?>
							placeholder="<?php echo $this->lang->line('advertise_details_feedback_your_email_field'); ?>"
							name="email_id" id="email_id" value="<?php echo $email_id; ?>"></div>


					<div class="field"><input type="text"
											  placeholder="<?php echo $this->lang->line('advertise_details_feedback_subject_field'); ?>"
											  name="subject" id="subject" value=""></div>

					<div class="field"><textarea rows="3" cols="15"
												 placeholder="<?php echo $this->lang->line('advertise_details_feedback_your_feedback_field'); ?>"
												 name="message" id="message"></textarea></div>



					<?php if ($uid == '' || $uid == '0') { ?>

						<div style="float:left; width:100%; margin-top:12px;">

							<label style="float:left; width:5%; margin-top:5px; "><input name="agree_terms"
																						 type="checkbox" value="1"
																						 class="required"></label>

							<p style="float:left; width:95%"><?php echo $this->lang->line('reg_user_I_have_read_and_agree_adviser'); ?>
								<a href="<?php echo base_url(); ?>site/cmsPages/privacy"><?php echo $this->lang->line('reg_user_owner_privacy_policy'); ?></a>
							</p>

							<br/>

							<label class="error" style="color:red;" for="agree_terms" generated="true"></label>

						</div>

						<div style="float:left; width:100%; margin-top:12px;">

							<label style="float:left; width:5%; margin-top:5px; "><input name="receive_mail"
																						 type="checkbox"
																						 value="1"></label>

							<p style="float:left; width:95%"><?php echo $this->lang->line('reg_user_wish_to_receive_informations_adviser'); ?></p>

						</div>

					<?php } ?>



					<input type="hidden" name="owner_id" value="<?php echo $advertiser_detail[0]['user_id']; ?>">

					<input type="hidden" name="property_id" value="0">

					<div class="field">

						<input type="submit"
							   value="<?php echo $this->lang->line('advertise_details_button_submit_feedback'); ?>"
							   onClick="return form_validation_feedback();">

						<?php

						echo form_close();

						?>

					</div>

				</div>

			</div>

			<!--Feedback form ends-->

		</div>

	</div>

</div>


<!------ footer part -------------->



<?php $this->load->view("_include/footer_search");?>

<!------- pagination js ------------------>



<script type="text/javascript" src="assets/js/jquery.paginate.js"></script>

<script type="text/javascript">

	$("#success").delay(3200).fadeOut(300);

	$("#eror").delay(3200).fadeOut(300);

	$(function () {

		$("#demo5").paginate({

			count: 10,

			start: 1,

			display: 7,

			border: true,

			border_color: '#fff',

			text_color: '#fff',

			background_color: 'black',

			border_hover_color: '#ccc',

			text_hover_color: '#000',

			background_hover_color: '#fff',

			images: false,

			mouse: 'press',

			onChange: function (page) {

				$('._current', '#paginationdemo').removeClass('_current').hide();

				$('#p' + page).addClass('_current').show();

			}

	});

	});

</script>





<?php

// echo "<pre>";

//    print_r($advertiser_detail);exit;


if ($user_pref[0]['my_address_display'] != 1 || $user_pref[0]['invisible'] != 1) {

	?>

	<p><?php

		if ($_COOKIE['lang'] == "it") {

			if (!strpos($advertiser_detail[0]['province'], "'") === false) {

				$st_name1 = get_perticular_field_value('zc_region_master', 'province_code', " and province_name_it = '" . str_replace("'", "\\\''", stripslashes($advertiser_detail[0]['province'])) . "' group by province_code");

			} else {

				$st_name1 = get_perticular_field_value('zc_region_master', 'province_code', " and province_name_it LIKE '%" . $advertiser_detail[0]['province'] . "%' group by province_code");

			}

		} else {

			if (!strpos($advertiser_detail[0]['province'], "'") === false) {

				$st_name1 = get_perticular_field_value('zc_region_master', 'province_code', " and province_name = '" . str_replace("'", "\\\''", stripslashes($advertiser_detail[0]['province'])) . "' group by province_code");

			} else {

				$st_name1 = get_perticular_field_value('zc_region_master', 'province_code', " and province_name LIKE '%" . $advertiser_detail[0]['province'] . "%' group by province_code");

			}

		}

		if ($advertiser_detail[0]['street_address']) {
			$addressStr = str_replace("'", "\'", $advertiser_detail[0]['street_address']) . "<br/>,";
		}

		if ($advertiser_detail[0]['street_no']) {
			$addressStr .= $advertiser_detail[0]['street_no'];
		}

		if ($advertiser_detail[0]['zip']) {
			$addressStr .= ' - ' . $advertiser_detail[0]['zip'];
		}

		if ($advertiser_detail[0]['city']) {
			$addressStr .= ' ' . str_replace("'", "\'", $advertiser_detail[0]['city']);
		}

		if ($st_name1 != "") {
			$addressStr .= ' - ' . $st_name1;
		}

		?>

	</p>

<?php

} else {

	$addressStr = '';

}



?>

<?php



if ($user_pref[0]['my_address_display'] != 1 || $user_pref[0]['invisible'] != 1) {

	?>

	<p>

		<?php

		if ($_COOKIE['lang'] == "it") {

			if (!strpos($advertiser_detail[0]['province'], "'") === false) {

				$st_name1 = get_perticular_field_value('zc_region_master', 'province_code', " and province_name_it = '" . str_replace("'", "\\\''", stripslashes($advertiser_detail[0]['province'])) . "' group by province_code");

			} else {

				$st_name1 = get_perticular_field_value('zc_region_master', 'province_code', " and province_name_it LIKE '%" . $advertiser_detail[0]['province'] . "%' group by province_code");

			}

		} else {

			if (!strpos($advertiser_detail[0]['province'], "'") === false) {

				$st_name1 = get_perticular_field_value('zc_region_master', 'province_code', " and province_name = '" . str_replace("'", "\\\''", stripslashes($advertiser_detail[0]['province'])) . "' group by province_code");

			} else {

				$st_name1 = get_perticular_field_value('zc_region_master', 'province_code', " and province_name LIKE '%" . $advertiser_detail[0]['province'] . "%' group by province_code");

			}

		}

		if ($advertiser_detail[0]['street_address']) {
			$addressStr = str_replace("'", "\'", $advertiser_detail[0]['street_address']) . "<br/>,";
		}

		if ($advertiser_detail[0]['street_no']) {
			$addressStr .= $advertiser_detail[0]['street_no'];
		}

		if ($advertiser_detail[0]['zip']) {
			$addressStr .= ' - ' . $advertiser_detail[0]['zip'];
		}

		if ($advertiser_detail[0]['city']) {
			$addressStr .= ' ' . str_replace("'", "\'", $advertiser_detail[0]['city']);
		}

		if ($st_name1 != "") {
			$addressStr .= ' - ' . $st_name1;
		}

		?>

	</p>

<?php

} else {

	$addressStr = '';

}



?>





<script>

	function show_image() {

		$('#show_image').addClass('active');

		$('#image_view').show();

		$('#map_canvas').hide();

		$('#map_canvas').removeClass('active');

		$('#show_map').removeClass('active');

	}

	function open_feedback_form() {

		$('#feedback_form').slideDown("slow");

		$('#open_feedback').hide();

	}

	function form_validation_feedback() {

		$("#feed_form").validate({

			rules: {

				name: {

					required: true

				},

				email_id: {

					required: true,

					email: true

				},

				subject: {

					required: true

				},

				message: {

					required: true

				}, agree_terms: {

					required: true

				},

			}, messages: {

				name: "",

				email_id: "",

				subject: "",

				message: "",

				agree_terms: {

					required: "Required"

				}

				}

		});

	}

</script>

<?php

$advertiserGeoAddress .= stripslashes($advertiser_detail[0]['city']) . ', ' . $ShowingProvinceCode . ', ' . $advertiser_detail[0]['zip'] . ', Italy';
// echo "<pre>"; print_r($response);exit;

$lat_lng_array = getLangLat($advertiserGeoAddress);

$GoogleMapMarkersLatitude = $lat_lng_array->lat;

$GoogleMapMarkersLongitude = $lat_lng_array->lng;

if ($advertiser_detail[0]['file_1'] == "")

	$advertiserImage = base_url() . 'assets/images/no_prof.png';

else

	$advertiserImage = base_url() . 'assets/uploads/thumb_92_82/' . $advertiser_detail[0]['file_1'];

?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/map.css?nocache=289671982568" type="text/css"/>

<script src="https://maps.googleapis.com/maps/api/js?key=<?= MAP_KEY ?>"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/markerclusterer.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/label.js"></script>

<script type="text/javascript">

	var WebRoot = '<?php echo base_url(); ?>';

	var centerZoom = 8;

	var centerLatitude = <?php echo($advertiser_detail[0]['latitude'] =='0'?$GoogleMapMarkersLatitude:$advertiser_detail[0]['latitude']); ?>;

	var centerLongitude =
	<?php echo($advertiser_detail[0]['longitude']=='0'?$GoogleMapMarkersLongitude:$advertiser_detail[0]['longitude']);?>

	// 'latitude' => ($advertiser_detail[0]['latitude']=='0'?$GoogleMapMarkersLatitude:$advertiser_detail[0]['latitude']),

	// 'longitude' => ($arrAdv->longitude=='0'?$GoogleMapMarkersLongitude:$arrAdv->longitude),
	// var centerLatitude = <?php echo(!empty($GoogleMapMarkersLatitude)?$advertiser_detail[0]['latitude']:'41.500000'); ?>;

	//      var centerLongitude = <?php echo(!empty($GoogleMapMarkersLongitude)?$advertiser_detail[0]['longitude']:'21.500000'); ?>;

		var map;

	var infowindow = null;

	var gmarkers = [];

	var markerTitles = [];

	var highestZIndex = 0;

	var agent = "default";

	var zoomControl = true;

	var MarkerDraggable = false;

	var DrawCircleAroundMarker = false;

	var CircleMapRadius = 750;

	var geocoder;

	var markerTitles = [];

	// markers array: name, type (icon), lat, long, description, uri, address

	GoogleMapMarkers = new Array();

	GoogleMapMarkers.push(["<?php echo $business_name; ?>", "markers", <?php  echo($advertiser_detail[0]['latitude'] =='0'?$GoogleMapMarkersLatitude:$advertiser_detail[0]['latitude']); ?>, <?php echo($advertiser_detail[0]['longitude']=='0'?$GoogleMapMarkersLongitude:$advertiser_detail[0]['longitude']); ?>, "<?php echo $advertiserAddress; ?>", "javascript:void(0);", '', "<?php echo $advertiserImage; ?>", "advDetails"]);

	markerTitles[0] = "<?php echo $business_name; ?>";

</script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/represent-map1.js"></script>

</body>

</html>

