<?php $this->load->view("_include/meta"); ?>
<style>
    /*jquery error styles */
    div.error {
        float: left;
        color: red;
        padding-right: .5em;
    }

    label.error {
        float: left !important;
        color: red !important;
        padding-right: .5em !important;
        text-align: left !important;
    }

    .userGuideMAP {
        background: #f7f7f7 none repeat scroll 0 0;
        border: 1px solid #e5e3e3;
        color: #666666;
        float: left;
        font-weight: bold;
        margin: 50px 0 0;
    }

    .userGuideMAP h2 {
        background: #b26363 none repeat scroll 0 0;
        color: #f7f7f7;
        font-size: 12px;
        padding: 5px 0;
        text-align: center;
    }

    .userGuideMAP ul {
        list-style: outside none disc;
        margin: 0;
        padding: 10px 10px 10px 25px;
    }

    .userGuideMAP li {
        padding: 10px 0 20px 5px;
    }

    .mapAddress {
        font-size: 14px;
        font-weight: bold;
    }

    .mapAddress a {
        color: #e96e2a;
        float: right;
    }

    #dragged-address-location {
        height: 30px;
        padding: 0 10px 5px;
        color: #AAAAAA;
    }

    #dragged-address-location.active {
        font-weight: bold;
        color: #000000;
    }

    #map_canvas {
        width: 100%;
        height: 400px;
        border: solid 1px #DDDDDD;
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
        $.validator.addMethod("alphabetsnspace", function (value, element) {
            return this.optional(element) || /(https?:\\)?([\w-]+\.)+[\w-]+[.com|.in|.org]+(\[\?%&=]*)?/.test(value);
        });
        jQuery.extend(jQuery.validator.methods, {
            number: function (value, element) {
                return this.optional(element)
                    || /^(?:\d+|\d{1,3}(?:\.\d{3})+)(?:,\d+)?$/.test(value)
                    || /^(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(value);
            }
        });
    });
</script>
</head>
<body class="noJS">
<script>
    var bodyTag = document.getElementsByTagName("body")[0];
    bodyTag.className = bodyTag.className.replace("noJS", "hasJS");
</script>
<!------ Header part -------------->
<!--header-->
<?php $this->load->view("_include/header"); ?>
<!------ banner part -------------->
<div class="insidepage_banner">
    <div class="main">
        <h2>
            <?php echo $this->lang->line('edit_property_form_real_estate_for'); ?>
            <font style="font-weight:bold;">
                <?php echo $this->lang->line('edit_property_form_jobs'); ?>
            </font>
            <?php echo $this->lang->line('edit_property_form_and'); ?>
            <font style="font-weight:bold;">
                <?php echo $this->lang->line('edit_property_form_housing'); ?>
            </font>
        </h2>
    </div>
</div>
<!----- login pop up start  ---------------------->
<?php $this->load->view("_include/login_user"); ?>
<!----- login pop up end ---------------------->
<!------ body part -------------->
<!------ body part -------------->
<div class="main">
    <div id="breadcrumb" class="fk-lbreadbcrumb newvd">
                    
            <span>
				<a href="<?php echo base_url(); ?>">
                    <?php echo $this->lang->line('edit_property_form_home'); ?>
                </a>
			</span> >
        <!--<?php
        if ($locupdatetype == 'update') {
            ?>
            <span>
				<a href="<?php echo base_url();?>property/property_details">
                    <?php echo $this->lang->line('edit_property_form_list_of_property');?>
                </a>
			</span> >
            <span>
				<a href="<?php echo base_url();?>property/edit_property/<?php echo $property_details[0]['property_id']; ?>">
                    <?php echo $this->lang->line('edit_property_form_edit_property');?>
                </a>
			</span> >
        <?php
        } elseif ($locupdatetype == 'add') {
            ?>
            <span>
				<a href="<?php echo base_url();?>property/add_property_form">
                    <?php echo $this->lang->line('add_property_form_add_property');?>
                </a>
			</span> >
        <?php
        }
        ?>-->
        <span>
				<?php echo $this->lang->line('managae_location_page_manage_location_str'); ?>
			</span>
    </div>

    <?php
    //Finding Property Title Here.
    if (isset($_COOKIE['lang']) && ($_COOKIE['lang'] == "english")) {
        //$name = get_perticular_field_value('zc_contract_types', 'name', " and contract_id='" . $property_details[0]['contract_id'] . "'");
        // $typology_name = get_perticular_field_value('zc_typologies', 'name', " and status='active' and typology_id='" . $property_details[0]['typology'] . "'");
        // $city_name = get_perticular_field_value('zc_city', 'city_name', " and city_id='" . $user_details[0]['city'] . "'");
        $province_code = get_perticular_field_value('zc_region_master', 'province_code', " and city='" . mysql_real_escape_string($user_details[0]['city']) . "'");

        $proptitle = stripslashes($user_details[0]['first_name']) . '&nbsp' . stripslashes($user_details[0]['last_name']) . " in " . $user_details[0]['city'] . ", " . $province_code;
    } else {
        // $name_it = get_perticular_field_value('zc_contract_types', 'name_it', " and contract_id='" . //$property_details[0]['contract_id'] . "'");
        //$typology_name = get_perticular_field_value('zc_typologies', 'name_it', " and status='active' and typology_id='" . $property_details[0]['typology'] . "'");
        // $city_name = get_perticular_field_value('zc_city', 'city_name_it', " and city_id='" . $property_details[0]['city'] . "'");
        $province_code = get_perticular_field_value('zc_region_master', 'province_code', " and city_it='" . mysql_real_escape_string($user_details[0]['city']) . "'");

        $proptitle = stripslashes($user_details[0]['first_name']) . stripslashes($user_details[0]['last_name']) . " in " . $user_details[0]['city'] . ", " . $province_code;
    }

    //Finding Property Image Here.
    $propertyImage = base_url() . "assets/images/no_prof.png";
    $image_path = $user_details[0]['file_1'];
    if ($image_path != "") {
        $propertyImage = base_url() . "assets/uploads/thumb_92_82/" . $image_path;
    }
    //FInding Property Address Here.
    $Company_name = $user_details[0]['company_name'];
    $propertyShowingAddress = '';
    $propertyAddress = ($user_details[0]['area'] != '' ? $user_details[0]['area'] . ' - ' : '');
    $propertyAddress .= ($user_details[0]['street_address'] != '' ? $user_details[0]['street_address'] . ', ' : '');
    $propertyAddress .= ($user_details[0]['street_no'] != '' ? $user_details[0]['street_no'] : '');
    $propertyShowingAddress .= $propertyAddress . ', ' . $city_name . ', ' . $province_code;
    $propertyAddress .= ($user_details[0]['zip'] != '' ? ' - ' . $user_details[0]['zip'] : '');
    $propertyShowingAddress .= ($user_details[0]['zip'] != '' ? ' - ' . $user_details[0]['zip'] : '');

    $GoogleMapMarkers[0] = array(
        'proptitle' => $proptitle,
        'hackerspace' => 'markers',
        'latitude' => ($user_details[0]['latitude'] == '0' ? '0' : $user_details[0]['latitude']),
        'longitude' => ($user_details[0]['longitude'] == '0' ? '0' : $user_details[0]['longitude']),
        'proaddress' => $propertyAddress,
        'propurl' => 'javascript:void(0);',
        'proprice' => '',
        'proimg' => $propertyImage
    );

    ?>
    <div class="registercomn_box"
         id="regboxId" <?php //echo($propertySuspensionStatus==1?'style="display:none;"':''); ?>>
        <div class="arrow_box error_message" id="msg_box_general">
            <?php echo $this->lang->line('managae_location_page_you_can_find_str'); ?>
        </div>
        <div id="add_newproperty_box" class="add_newproperty_box">
            <div class="add_newproperty_icon">
                <img src="<?php echo base_url(); ?>assets/images/add_newproperty_icon.jpg" alt="">

                <div class="userGuideMAP">
                    <h2><?php echo $this->lang->line('managae_location_page_map_instruction'); ?></h2>
                    <ul>
                        <li><?php echo $this->lang->line('check_if_loc_is_in_the_right_place'); ?></li>
                        <li><?php echo $this->lang->line('feel_free_2drag_the_marker'); ?></li>
                    </ul>
                </div>
            </div>
            <div class="add_newproperty_table1">
                <!--<div class="section1">
						<div class="mapAddress">
							<?php echo $propertyShowingAddress; ?>
							<a href="<?php echo base_url() . 'property/edit_property/' . $property_details[0]['property_id']; ?>">
								<?php echo $this->lang->line('managae_location_page_edit_address'); ?>
							</a>
						</div>
                    </div>-->
                <div class="section2" style="border-top:1px solid #cccccc">
                    <?php
                    $attributes = array('class' => 'add_property_form', 'id' => 'register');
                    echo form_open_multipart('users/update_location', $attributes);
                    ?>
                    <div class="cat_select">
                        <label style="display:block;">
                            <font
                                style="color:#f33038;">*</font><?php echo $this->lang->line('managae_location_page_latitude_str'); ?>
                        </label>
                        <label style="display:none;font-weight:normal" generated="true" for="promaplatitude"
                               class="error"></label>
                        <input value="<?php echo(!empty($GoogleMapMarkers) ? $GoogleMapMarkers[0]['latitude'] : ''); ?>"
                               name="promaplatitude" id="promaplatitude" placeholder="Enter Latitude" type="text"
                               class="required placeholder">
                    </div>
                    <div class="cat_select">
                        <label style="display:block;">
                            <font
                                style="color:#f33038;">*</font><?php echo $this->lang->line('managae_location_page_longitude_str'); ?>
                        </label>
                        <label style="display:none;font-weight:normal" generated="true" for="promaplongitude"
                               class="error"></label>
                        <input
                            value="<?php echo(!empty($GoogleMapMarkers) ? $GoogleMapMarkers[0]['longitude'] : ''); ?>"
                            name="promaplongitude" id="promaplongitude" placeholder="Enter Longitude" type="text"
                            class="required placeholder">
                    </div>
                    <div class="cat_select" style="width:245px;">
                        <label style="display:block;">&nbsp;</label>
                        <input type="hidden" name="locupdatetype" value="<?php echo $locupdatetype; ?>">
                        <input type="hidden" name="locupdatefor" value="<?php echo $users[0]['property_id']; ?>">
                        <input type="submit"
                               value="<?php echo $this->lang->line('managae_location_page_save_position_str'); ?>"
                               name="btnSubmit" class="mainbt" style="margin-right:0;">
                        <a style="height:33px; margin:0px;float:right;" class="mainbt"
                           href="<?php echo base_url() . 'users/my_account' ?>">
                            <?php echo $this->lang->line('managae_location_page_skip_str'); ?>
                        </a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <div class="add_newproperty_table2" style="margin-top:0;padding:15px 0 0 2px">
                    <p id="dragged-address-location">
                        <?php echo $this->lang->line('dragged_address_will_be_shown_here_str'); ?>
                    </p>

                    <div class="rightmap_area" id="map_canvas"></div>
                </div>
            </div>
        </div>
    </div>
    <!--##################  Loading area after form submit start ###################-->
    <div id="form_submit_loading_area" style="display:none;">
        <div class="main">
            <div class="registercomn_box">
                <div class="arrow_box error_message" id="msg_box_general" style="color:#FF7602;">
                    <?php echo $this->lang->line('property_submit_loading_property_submission_text'); ?>
                </div>
                <div class="congratulations">
                    <img src="<?php echo base_url(); ?>assets/images/register_thanks_icon.jpg" alt=""
                         style="margin-top:75px;margin-left:34px;">
                </div>
                <div class="mainsucc_box" style="width:63%">
                    <div class="suceesfulbox" style="width:95%">
                        <div>
                                <span style="width:100%">
                                <img src="<?php echo base_url(); ?>assets/images/Loader.gif" alt=""
                                     style="padding-left: 47%">
                                </span>

                            <div class="clear"></div>
                        </div>
                        <p><br></p>
                    </div>
                    <div style="margin:20px;text-align:center;">
                        <?php echo $this->lang->line('property_submit_loading_please_wait_text'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--##################  Loading area after form submit end ###################-->
    <?php
    // if($propertySuspensionStatus==1){
    if ($property_details[0]['blocked_note'] != "" || strlen($property_details[0]['blocked_note']) > 0) {
        ?>
        <div id="susspend_by_admin_area">
            <div class="main">
                <div class="registercomn_box">
                    <div class="arrow_box error_message" id="msg_box_general" style="color:#FF7602;">
                        <?php echo $this->lang->line('property_details_suspend_sorry_this_content_is_suspended');?>
                    </div>
                    <div class="congratulations"><img src="<?php echo base_url();?>assets/images/WAITING.png" alt=""
                                                      style="margin-top:75px;margin-left:34px;"></div>
                    <div class="mainsucc_box" style="width:63%">
                        <div class="suceesfulbox" style="width:95%">
                            <div>
                                <span style="width:100%">
                                    <p style="font-size: 13px !important;">
                                        <?php echo $this->lang->line('property_details_suspend_we_are_checking');?>
                                        <br/>
                                        <?php echo $this->lang->line('property_details_suspend_after_checked');?>
                                    </p>
                                </span>

                                <div class="clear"></div>
                            </div>
                            <p><br></p>
                        </div>
                        <div style=" margin-left:27%; margin-bottom:20px; float:left;">
                            <a class="mainbt" href="<?php echo base_url();?>property/property_details">
                                <?php echo $this->lang->line('property_details_suspend_back_to_the_list_of_property_button');?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/map.css?nocache=289671982568" type="text/css"/>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?= MAP_KEY ?>"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/markerclusterer.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/label.js"></script>
<script type="text/javascript">
    var WebRoot = '<?php echo base_url(); ?>';
    var centerZoom = <?php echo(!empty($GoogleMapMarkers)?($GoogleMapMarkers[0]['latitude']=='0'?'7':'14'):'7'); ?>;
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
<!------ footer part -------------->
<?php $this->load->view("_include/footer"); ?>
<script type="text/javascript">
    $(".allownumericwithdecimal").on("keypress keyup blur", function (event) {
        console.log(event.which);
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
    $(document).ready(function () {
        $("#register").validate({
            rules: {},
            messages: {}, submitHandler: function (form) {
                $("#regboxId").hide();
                $("#form_submit_loading_area").show();
                setTimeout(function () {
                    $('#register input[name="btnSubmit"]').val('Submit');
                    document.getElementById("register").submit();
                }, 5000);
                return false;
            }
        });
    });
</script>
