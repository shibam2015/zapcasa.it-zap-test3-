<?php $this->load->view("_include/meta"); ?>


<style>
   #wrapper { position: relative; }
   #over_map { left: 404px; position: absolute; top: 155px; z-index: 99; }
   #over_map_learge {  
    position: absolute;
    top: 115px;
    z-index: 99; }
	 .nicescroll-rails{
		display:none; 
	 }

   #map_canvas {
	   transition: all 2s;
   }
   
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
});
</script>
<!---<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=<?= MAP_KEY ?>"></script>-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/map.css?nocache=289671982568" type="text/css"/>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?= MAP_KEY ?>">
</script>
    <script>
	
/*function initialize() {
  var mapOptions = {
    zoom: 4,
    center: new google.maps.LatLng(-33, 151),
    panControl: false,
    zoomControl: false,
    scaleControl: true
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'),
                                mapOptions);
	var map = new google.maps.Map(document.getElementById('map-canvas1'),
                                mapOptions);							
								
}

google.maps.event.addDomListener(window, 'load', initialize);*/



function initialize() {

	var mapOptions = {
    zoom: 4,
    center: new google.maps.LatLng(-25.363882, 131.044922),
		zoomControl: true,
  };
  var mapProp = {
  zoom: 7,
    center: new google.maps.LatLng(-25.363882, 131.044922),
	 zoomControl: false,
};

	var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
	// var map2 = new google.maps.Map(document.getElementById("map_canvas"),mapProp);


	  
  var marker = new google.maps.Marker({
    position: map.getCenter(),
    map: map,
    title: 'Click to zoom'
  });

  google.maps.event.addListener(map, 'center_changed', function() {
    // 3 seconds after the center of the map has changed, pan back to the
    // marker.
    window.setTimeout(function() {
      map.panTo(marker.getPosition());
    }, 3000);
  });

  google.maps.event.addListener(marker, 'click', function() {
    map.setZoom(8);
    map.setCenter(marker.getPosition());
  });
  
}

google.maps.event.addDomListener(window, 'load', initialize);



    </script>

<script type="text/javascript">
$(function(){
	$(window).scroll(function(){
		var scrollTop = $(document).scrollTop();
		//var searchListHeight = $('.searchresult_box').height();
		//$('.topbluebar').html(scrollTop);
		/*if(scrollTop >= 40 && scrollTop <= 1385){
			$('.map-cont').css({
				position : 'fixed',
				top : '120px',
				width : '32.7%',
			});
		} else {
			$('.map-cont').css({
				position : 'relative',
				top : '1335px',
				width : '100%',
			});
			if(scrollTop < 40){
				$('.map-cont').removeAttr('style');
			}
		}*/
	});
});
$(document).ready(function()
{
	
	<?php /*?>$("#showcase").awShowcase(
	{
		content_width:			464,
		content_height:			376,
		fit_to_parent:			false,
		auto:					false,
		interval:				3000,
		continuous:				false,
		loading:				true,
		tooltip_width:			200,
		tooltip_icon_width:		32,
		tooltip_icon_height:	32,
		tooltip_offsetx:		18,
		tooltip_offsety:		0,
		arrows:				false,
		buttons:				true,
		btn_numbers:			true,
		keybord_keys:			true,<?php */?>
//		mousetrace:				false, /* Trace x and y coordinates for the mouse */
//		pauseonover:			true,
//		stoponclick:			true,
//		transition:				'vslide', /* hslide/vslide/fade */
//		transition_delay:		500,
//		transition_speed:		500,
//		show_caption:			'onhover', /* onload/onhover/show */
//		thumbnails:				true,
//		thumbnails_position:	'outside-last', /* outside-last/outside-first/inside-last/inside-first */
//		thumbnails_direction:	'vertical', /* vertical/horizontal */
//		thumbnails_slidex:		0, /* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
//		dynamic_height:			false, /* For dynamic height to work in webkit you need to set the width and height of images in the source. Usually works to only set the dimension of the first slide in the showcase. */
//		speed_change:			true, /* Set to true to prevent users from swithing more then one slide at once. */
//		viewline:				false /* If set to true content_width, thumbnails, transition and dynamic_height will be disabled. As for dynamic height you need to set the width and height of images in the source. */
//	});
	
});
</script>

</head>

<body class="noJS">
<script>
var bodyTag = document.getElementsByTagName("body")[0];
bodyTag.className = bodyTag.className.replace("noJS", "hasJS");
</script>
<!------ Header part ------------->
<div class="fixed_header">
<div class="topbluebar"></div>
<div class="main">
<?php $this->load->view("_include/header"); ?>    
</div>
<?php
 	$this->load->view("_include/login_user"); 
 ?> 
 
</div>
<!------ banner part 
<div class="insidepage_banner">
	<div class="main">
    	<h2>Real Estate for <font style="font-weight:bold;">Jobs</font> & <font style="font-weight:bold;">Housing</font></h2>
    </div>
</div>
------------->
<!------ body part ------------->

<div class="main main_searchpage">
	<div id="breadcrumb" class="fk-lbreadbcrumb newvd">
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('advertise_list_home');?></a></span> >  
		<span>
			<a href="<?php echo base_url().'advertiser/search?location=&name=&advertiser_type=all';?>">
				<?php echo $this->lang->line('advertise_details_advertisers');?>
			</a>
		</span> >
        <span style="text-transform:capitalize;">
		<?php
		switch($area){
			case 'North-west':
				$areabreadCrumb = $this->lang->line('footer_northwest_agencies');
				break;
			case 'North-east':
				$areabreadCrumb = $this->lang->line('footer_northeast_agencies');
				break;
			case 'Center':
				$areabreadCrumb = $this->lang->line('footer_central_agencies');
				break;
			case 'South':
				$areabreadCrumb = $this->lang->line('footer_south_agencies');
				break;
			case 'Islands':
				$areabreadCrumb = $this->lang->line('footer_islands_agencies');
				break;
			default:
				$areabreadCrumb = $this->lang->line('footer_northwest_agencies');
				break;			
		}
		?>
			<a href="<?php echo base_url().'advertiser/agency_search_by_area/'.$area; ?>"><?php echo $areabreadCrumb; ?></a>
		</span> >
		<span><?php echo $this->lang->line('advertise_list_search_result');?></span>
    </div>
	<!--<h2 class="pagetitle">Registration</h2>-->
	<div class="refinesearch">
        <?php $this->load->view("_include/search_header_advertiser"); ?>
    </div>
    <h2 class="searchfound"><?php echo $this->lang->line('advertise_list_rentals');?> <font style="font-size:12px; font-weight:normal;"><?php echo $total_row;?> <?php echo $this->lang->line('advertise_list_results');?></font> 
    	<?php /*?>
    	<span class="post_brn"><a href="#"><?php echo $this->lang->line('advertise_list_post_your_property');?> <font><?php echo $this->lang->line('advertise_list_free');?></font></a></span> */ ?>
    
	    	<span class="post_brn">
	    	 <?php
					 $user_type=get_perticular_field_value('zc_user','user_type'," and user_id='".$this->session->userdata( 'user_id' )."'");
	                  if($user_type=='2' || $user_type=='3')
					  {
					?> 
	                <a href="<?php echo base_url();?>property/add_property_form" class="freepost"><?php echo $this->lang->line('advertise_list_post_your_property');?> <font style="color:#fff000"><?php echo $this->lang->line('advertise_list_free');?></font></a>
	               
	                <?php
					  }
					  if($user_type=='1')
					  {
					?>  
	            	
	                   <a href="<?php echo base_url();?>property/add_property_form" class="freepost add_property"><?php echo $this->lang->line('advertise_list_post_your_property');?> <font style="color:#fff000"><?php echo $this->lang->line('advertise_list_free');?></font></a>
	                <?php
					  }
					   if($this->session->userdata( 'user_id' )=='0'  || $this->session->userdata( 'user_id' )=='' )
					  
					  {
					?>
	                 <a href="<?php echo base_url();?>users/common_reg" class="freepost"><?php echo $this->lang->line('advertise_list_post_your_property');?> <font style="color:#fff000"><?php echo $this->lang->line('advertise_list_free');?></font></a>
	                <?php
					  }
					?>
	    	<!-- <a href="<?php //echo base_url();?>property/add_property_form">Post your property <font>free</font></a>-->
	     
	     </span>
    
    </h2>
    
 <!-- <div class="rightmap_area"><img src="images/map_small.jpg" ></div>-->


	<div class="rightmap_area" id="map_canvas" style="width:445px;height:367px;border:solid 1px #DDDDDD;"></div>

	<div class="searchresult_box searchresult_box2" style="height:660px ! important;overflow:hidden;">
      <div style="width:100%;overflow:auto;height:620px !important;overflow:auto;">
    <!--<div id="paginationdemo" class="demo">
	  <div id="p1" class="pagedemo _current">-->
        <ul>

			<?php
		if(count($advertiser_lists)!=0)
		{
          foreach($advertiser_lists as $advertiser_list)
		  {

			  $link=base_url().'advertiser/advertiser_details/'.$advertiser_list['user_id'];
			  
			  $user_pref = get_all_preference_by_user("zc_user_preference",$where=" AND user_id=".$advertiser_list['user_id']);
			  
			  $business_name = "";
			  $user_type = "";
			  $nameForBusiness = "";
			  if($advertiser_list['user_type']=='3') {
			  	$business_name = ucfirst($advertiser_list['company_name']);
			  	$user_type = $this->lang->line('advertise_list_advertiser_agency');
			  	$nameForBusiness = ucfirst($advertiser_list['business_name']);
			  } else {
			  	$business_name = ucfirst($advertiser_list['first_name']) ." " .ucfirst($advertiser_list['last_name']);
			  	$user_type = $this->lang->line('advertise_list_advertiser_owner');
			  }
			  
			 if( count($user_pref) > 0 ) {
			 	if( isset( $user_pref[0]['invisible'] ) && ( $user_pref[0]['invisible'] == 0) ) { 		
		?>
	        	<li>
	            	<div class="listingImg">
	                	<a href="<?php echo $link;?>">
	                    <?php
	                    	$user_image=$advertiser_list['file_1'];
							if($user_image!='') {
						?>
	                    		<img src="<?php echo base_url();?>assets/uploads/thumb_92_82/<?php echo $user_image; ?>" alt="<?php echo $business_name; ?>">
								
							<?php
							} else {
	                     ?> 
	                     		<img src="<?php echo base_url();?>assets/images/no_prof.png" alt="<?php echo $business_name; ?>" <?php if( $advertiser_list['user_type']=='2') { ?> style="max-width: 170px; max-height: 100px;" <?php } else { ?>width="102px" height="68px;" <?php }?> > 
								
						<?php
							}
	                     ?>
						 <div class="listingShw" style="background-size:108px;"></div>
	                    </a>	                	
	                </div>
	                <div class="listingContent">
					<h2 style="padding: 0 0 5px;" ><a href="<?php echo $link;?>"><?php echo $business_name;?></a></h2>
	                    <?php if( $user_pref[0]['my_address_display'] == 0 ) {  ?>
		                    <div class="listAddress">
		                    	<?php if( $nameForBusiness != "" ) {?><p style="font-weight: bold;color: #000000;" ><?php echo $nameForBusiness; ?></p><?php } ?>
								<h4>
									<?php $st_name1=get_perticular_field_value('zc_region_master','province_code'," and `province_name` LIKE '%".$advertiser_list['province']."%' group by province_code");?>
							  		<?php 
							  			if( $advertiser_list['street_address'] ) { echo $advertiser_list['street_address']; }
							  			if( $advertiser_list['street_no'] ) { echo ', '.$advertiser_list['street_no']; }
							  			if( $advertiser_list['zip'] ) { echo ' - '.$advertiser_list['zip']; }
							  			if($advertiser_list['city']){
											if(!strpos($advertiser_list['city'], "'")===false){
												$city_name=get_perticular_field_value('zc_city',($_COOKIE['lang']=='english'?"city_name":"city_name_it")," and `city_name` = '".str_replace("'","\\\''",stripslashes($advertiser_list['city']))."' OR `city_name_it` = '".str_replace("'","\\\''",stripslashes($advertiser_list['city']))."'");
											}else{
												$city_name=get_perticular_field_value('zc_city',($_COOKIE['lang']=='english'?"city_name":"city_name_it")," and `city_name` = '".$advertiser_list['city']."' OR `city_name_it` = '".$advertiser_list['city']."'");
											}
											echo ' '.stripslashes($city_name);
										}
							  			if( $st_name1 != "" ) { echo ' - '.$st_name1; } 
							  		?>
								</h4>
								<p><?php echo $user_type; ?></p>
							</div>
						<?php } ?>	
	                    <div class="propFeatures">
							<h3><?php echo $this->lang->line('advertise_list_property_post'); ?>  <font
									style="color:#ED6B1F"><?php echo get_perticular_count('zc_property_details', " and property_post_by='" . $advertiser_list['user_id'] . "'and 	property_status='2'and property_approval='1'"); ?></font>
							</h3></div>
	                </div>
	            </li>
            <?php
		  		}
		  	}		
		  }
		  ?>
            <div class="clear"></div>	  
	<?php  
		}
		else
		{
			?>
            <div class="no_record_search"> <?php echo $this->lang->line('advertise_list_sorry_no_record_found');?></div>
            <?php
		}
			?>
            
        </ul>
       <!--</div>
       <div id="p2" class="pagedemo" style="display:none;">Page 2</div>
       <div id="demo5"></div>
     </div>-->
     </div>
                  <!--pagenation-->
        <?php if(isset($links)){echo '<div class="inbox_delete_pagination_rht" style="margin-right:2px;">'.$links.'</div>'; } ?>
        <div class="clear"></div>	  
    </div>
    <!--<div class="rightmap_area">
		<div class="map-cont">
        	<iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/?ie=UTF8&amp;ll=22.309426,88.582764&amp;spn=1.79388,2.688904&amp;t=m&amp;z=9&amp;output=embed"></iframe>
        </div>    
    </div>-->
  
    <?php 
	$google_adsence = get_perticular_field_value('zc_settings','meta_value'," and meta_name='google_adsence'"); 
	if( isset($google_adsence) && ( count($google_adsence) > 0 ) ) {
?>
		<div class="google_ad">
			<!-- 
				<img src="<?php echo base_url()?>asset/images/google_ad_300x250.jpg" >
			 -->
		<?php 
			echo "<pre>";
			print_r($google_adsence);
		?>
		</div>
	<?php } ?>
</div>


<!------ footer part ------------->

<?php $this->load->view("_include/footer_search");?>
<!------- pagination js ----------------->


</body>
</html>

