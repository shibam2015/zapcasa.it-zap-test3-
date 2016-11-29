<!doctype html>
	<html>
		<head>
			<meta charset="utf-8">
			<!-- <meta name="viewport" content ="width=device-width, maximum-scale = 1.0, minimum-scale=1.0" /> -->
			<meta http-equiv="X-UA-Compatible" content="IE=11">
            <meta http-equiv="X-UA-Compatible" content="EmulateIE=10">
			<meta http-equiv="X-UA-Compatible" content="EmulateIE=9">
			<!--for internet support HTML 5-->
			<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<![endif]-->
			<?php
			$this->load->library('session');
			$this->load->helper('cookie');
			$len_change = '';
			//echo "==========".$_COOKIE['lang'];
			if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] != "" )) {
				/*if(trim($_COOKIE['lang'])=='english') {
					//$this->session->set_userdata('language','english');
				}elseif(trim($_COOKIE['lang'])=='it') {
					//$this->session->set_userdata('language','it');
				}else{
					//$this->session->set_userdata('language','english');
				}*/
				if(  $_COOKIE['lang'] == "english" ||  $_COOKIE['lang'] == "it" ) {
					$this->lang->load('code', $_COOKIE['lang']);
				} else {
					$this->lang->load('code', 'english');
				}
			} else {
				//$len_change = ("languageChange('it');");
			}			
			?>
            
            <?php $this->load->view("_include/meta_tag_title_description"); ?>
			<?php /*
			if($this->router->fetch_method() == 'common_reg'){
				?>
				<!----/user/common_reg------>
				<title><?php echo $this->lang->line('common_reg_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('common_reg_meta_description');?>">
				<meta name="robots" content="noindex, nofollow">
				<?php
			}elseif($this->router->fetch_method() == 'comon_signup'){
				?>
				<!-----/user/comon_signup------>
				<title><?php echo $this->lang->line('reg_user_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('reg_user_meta_description');?>">
				<meta name="robots" content="noindex, nofollow">
				<?php
			}elseif($this->router->fetch_method() == 'user_edit'){
				?>
				<!-----/user/user_edit----->
				<title><?php echo $this->lang->line('user_edit_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('home_page_meta_description');?>">
				<meta name="robots" content="noindex, nofollow">
				<?php
			}elseif($this->router->fetch_method() == 'thanks'){
				?>
				<!-----/user/thanks/29----->
				<title><?php echo $this->lang->line('thanks_user_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('home_page_meta_description');?>">
				<meta name="robots" content="noindex, nofollow">
				<?php
			}elseif($this->router->fetch_method() == 'acctivation'){
				?>
				<!----/ user/acctivation/29/d925fb06d33d43afb3018789256a632b ------>
				<title><?php echo $this->lang->line('thanks_owner_act_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('home_page_meta_description');?>">
				<meta name="robots" content="noindex, nofollow">
				<?php
			}elseif($this->router->fetch_method() == 'reg_owner'){
				?>
				<!----/user/reg_owner------>
				<title><?php echo $this->lang->line('reg_owner_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('reg_owner_meta_description');?>">
				<meta name="robots" content="noindex, nofollow">
				<?php
			}elseif($this->router->fetch_method() == 'owner_edit'){
				?>
				<!----/user/owner_edit------>
				<title><?php echo $this->lang->line('owner_edit_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('home_page_meta_description');?>">
				<meta name="robots" content="noindex, nofollow">
				<?php
			}elseif($this->router->fetch_method() == 'thanksowner'){
				?>
				<!----/user/thanksowner/32------>
				<title><?php echo $this->lang->line('thanks_owner_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('home_page_meta_description');?>">
				<meta name="robots" content="noindex, nofollow">
				<?php
			}elseif($this->router->fetch_method() == 'reg_agency'){
				?>
				<!----/user/reg_agency------>
				<title><?php echo $this->lang->line('reg_agency_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('reg_agency_meta_description');?>">
				<meta name="robots" content="noindex, nofollow">
				<?php
			}elseif($this->router->fetch_method() == 'agency_edit'){
				?>
				<!----/user/agency_edit------>
				<title><?php echo $this->lang->line('agency_edit_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('home_page_meta_description');?>">
				<meta name="robots" content="noindex, nofollow">
				<?php
			}elseif($this->router->fetch_method() == 'thanksagency'){
				?>
				<!----/user/thanksagency/34------>
				<title><?php echo $this->lang->line('thanks_agency_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('home_page_meta_description');?>">
				<meta name="robots" content="noindex, nofollow">
				<?php 
			}elseif($this->router->fetch_method() == 'forget_password'){
				?>
				<!----/user/forget_password------>
				<title><?php echo $this->lang->line('forgot_password_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('home_page_meta_description');?>">
				<meta name="robots" content="noindex, nofollow">
				<?php
			}elseif($this->router->fetch_method() == 'add_property_form'){
				?>
				<!----/property/add_property_form------>
				<title><?php echo $this->lang->line('add_property_form_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('home_page_meta_description');?>">
				<meta name="robots" content="noindex, nofollow">
				<?php
			}elseif($this->router->fetch_method() == 'thanks_add_property'){
				?>
				<!----/property/Property successfully saved------>
				<title><?php echo $this->lang->line('property_successfully_saved_meta_title');?></title>				
				<meta name="robots" content="noindex, nofollow">
				<?php
			}elseif($this->router->fetch_method() == 'property_details'){
				?>
				<!----/property/List Of Properties page------>
				<title><?php echo $this->lang->line('property_details_meta_title');?></title>				
				<meta name="robots" content="noindex, nofollow">
				<?php
			}elseif($this->router->fetch_method() == 'edit_property'){
				?>
				<!----/property/edit_property_form------>
				<title><?php echo $this->lang->line('edit_property_form_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('home_page_meta_description');?>">
				<meta name="robots" content="noindex, nofollow">
				<?php
			}elseif($this->router->fetch_method() == 'add_property_csv'){
				?>
				<!----/property/add_property_form------>
				<title><?php echo $this->lang->line('add_property_csv_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('home_page_meta_description');?>">
				<meta name="robots" content="noindex, nofollow">
				<?php
			}elseif($this->router->fetch_method() == 'advertiser_details'){
				?>
				<!----/ Advertiser_details ------>
				<title><?php
					if($advertiser_detail[0]['user_type']=='3') {
						echo ucfirst($advertiser_detail[0]['company_name']) ." - " .ucfirst($advertiser_detail[0]['business_name']);
					} else {
						echo ucfirst($advertiser_detail[0]['first_name']) ." " .ucfirst($advertiser_detail[0]['last_name']);
					}
					?> - ZapCasa</title>
				<?php
				if($advertiser_detail[0]['about_me']!=''){
					$meta_descr = nl2br($advertiser_detail[0]['about_me']);
					if(strlen($meta_descr)<=130) {
						echo '<meta name="description" content="' . $meta_descr . '">';
					} else {
						$y=substr($meta_descr,0,130) . '...';
						echo '<meta name="description" content="' . $y . '">';
					}
				}
				?>
				<!-- <meta name="robots" content="noindex, nofollow"> -->
				<?php
			}elseif(($property_details[0]['category_id']=='1') || ($property_details[0]['category_id']=='2') || ($property_details[0]['category_id']=='3') || ($property_details[0]['category_id']=='4') || ($property_details[0]['category_id']=='5') || ($property_details[0]['category_id']=='6') || ($property_details[0]['category_id']=='7') || ($property_details[0]['category_id']=='10')){
				?>
				<!-----/Property detail pages----->
				<title><?php
					if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
						$name=get_perticular_field_value('zc_contract_types','name'," and contract_id='".$property_details[0]['contract_id']."'");
						$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$property_details[0]['typology']."'");
						$city_name=get_perticular_field_value('zc_city','city_name'," and city_id='".$property_details[0]['city']."'");
						$province_code=get_perticular_field_value('zc_region_master','province_code'," and city='".mysql_real_escape_string($city_name)."'");
						
						$proptitle = $name." For ".stripslashes($typology_name)." in ".$city_name.", ".$province_code;
					} else {
						$name_it=get_perticular_field_value('zc_contract_types','name_it'," and contract_id='".$property_details[0]['contract_id']."'");
						$typology_name=get_perticular_field_value('zc_typologies','name_it'," and status='active' and typology_id='".$property_details[0]['typology']."'");
						$city_name=get_perticular_field_value('zc_city','city_name_it'," and city_id='".$property_details[0]['city']."'");
						$province_code=get_perticular_field_value('zc_region_master','province_code'," and city_it='".mysql_real_escape_string($city_name)."'");
						
						$proptitle = stripslashes($typology_name)." in ".$name_it." a ".$city_name.", ".$province_code;
					}
					echo stripslashes($proptitle);
					//print_r($property_details);exit;
					$property_name=property_name($property_details[0]['property_id']);
					$st_name1=get_perticular_field_value('zc_region_master','province_code'," and `province_name` LIKE '%".$property_details[0]['provience']."%' group by province_code");
				?></title>
				<meta name="description" content="<?php
                $propertyAddress = '';
					if($property_details[0]['area']!=''){
						$propertyAddress.= $area_prop=$property_details[0]['area'].' - ';
					}
					if($property_details[0]['street_address']!=''){
						$propertyAddress.= $property_details[0]['street_address'].', ';
					}
					if($property_details[0]['street_no']!=''){
						$propertyAddress.= $property_details[0]['street_no'].' - ';
					}
					if($property_details[0]['zip']!=''){
						$propertyAddress.= $property_details[0]['zip'];
					}
					echo $propertyAddress;
				?> - ZapCasa">
				<?php
			}else{
				?>
				<title><?php echo $this->lang->line('home_page_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('home_page_meta_description');?>">
				<!--<meta name="robots" content="noindex, nofollow">-->
				<?php
			}*/
			?>
			<link href="<?php echo base_url();?>assets/css/zapcasa_style.css" rel="stylesheet" type="text/css" media="all" />
			<link rel="stylesheet" href="<?php echo base_url();?>assets/css/flexslider.css" type="text/css" media="all" />
			<link rel="stylesheet" href="<?php echo base_url();?>assets/css/customSelectBox.css" type="text/css" media="all" />
			<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css" type="text/css" media="all" />
			<link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.png" type="image/gif">
			<?php
			//echo $this->router->fetch_method();
			//echo "<pre>";
			//print_r($this->router);
			?>
			<!-- <link rel="stylesheet" href="<?php //echo base_url();?>asset/css/glDatePicker.default.css" type="text/css" media="all" /> -->
			<!--common liabiary fie-->
			<script src="<?php echo base_url();?>assets/js/jquery-1.10.2.js"></script>
			<script src="<?php echo base_url();?>assets/js<?php echo $this->lang->line('js_folder_lenguage');?>jquery-ui.js"></script>
			<!--------- login popup jquery ---->
			<script type="text/javascript" src="<?php echo base_url();?>assets/js/script.js"></script>
			<!-- <script type="text/javascript" src="<?php //echo base_url();?>asset/js/jquery.aw-showcase.js"></script> -->
			<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.fancybox.js"></script>
			<script src="<?php echo base_url();?>assets/js<?php echo $this->lang->line('js_folder_lenguage');?>jquery.validate.min.js" type="text/javascript"></script>
			<!--<script type="text/javascript" src="<?php //echo base_url();?>asset/js/glDatePicker.min.js"></script>-->
			<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css">
			<!--------- custom select box jquery ---->
			<script src="<?php echo base_url();?>assets/js/jScrollPane.js"></script>
			<script src="<?php echo base_url();?>assets/js/SelectBox.js" type="text/javascript"></script>
			<script src="<?php echo base_url();?>assets/js/jquery.nicescroll.min.js" type="text/javascript"></script>
			<script src="<?php echo base_url();?>assets/js/jquery.paginate.js" type="text/javascript"></script>
			<script>
			$(function(){
				$("select.custom").each(function(){
					var sb = new SelectBox({
						selectbox: $(this),
						height: 45,
						width: 100,
						changeCallback: function(val){
							languageChange(val);
						}
					});
				});
			});
			function languageChange(lang){
				/* var exdays = 1;
				var d = new Date();
				d.setTime(d.getTime() + (exdays*24*60*60*1000));
				var expires = "expires="+d.toGMTString();
				document.cookie = "lang =" + lang + "; " + expires
				location.reload(true); */
				if(lang!=""){
					url = "<?php echo base_url(); ?>site/languageselection";
					$.post(url,{lang:lang},function(data){
						if(data!="" && data=='language-changed'){
							location.reload(true);
						}
					});
				}
			}
			</script>
			<script><?php echo $len_change; ?></script>
			<!------------------------------------------------------------------------>
			<!-- jQuery Plugin scripts -->
			<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.easing.1.3.min.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.mousewheel.min.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.lightbox-0.5.pack.js"></script>
			<!-- Slider Kit scripts -->
			<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.sliderkit.1.9.2.pack.js"></script>
			<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.placeholder.js"></script>
			<script src="<?php echo base_url();?>assets/js/jquery.price_format.2.0.js"></script>
			<!-- Slider Kit launch -->
			<script type="text/javascript">
			$(window).load(function(){
				//$(window).load() must be used instead of $(document).ready() because of Webkit compatibility
				// Sliderkit photo gallery > With captions
				$(".photosgallery-captions").sliderkit({
					navscrollatend:true,
					mousewheel:false,
					keyboard:false,
					shownavitems:6,
					auto:false,
					fastchange:true,
					panelbtnshover:false
				});
				// jQuery Lightbox
				var lightboxPath = "<?php echo base_url();?>assets/js/lightbox/";
				$("a[rel='group1']").lightBox({
					imageLoading:lightboxPath+"lightbox-ico-loading.gif",
					imageBtnPrev:lightboxPath+"lightbox-btn-prev.gif",
					imageBtnNext:lightboxPath+"lightbox-btn-next.gif",
					imageBtnClose:lightboxPath+"lightbox-btn-close.gif",
					imageBlank:lightboxPath+"lightbox-blank.gif"
				});
			});
			</script>
			<!--
			<script type="text/javascript">
				var switchTo5x=true;
			</script>
			<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
			<script type="text/javascript">
			stLight.options({
				publisher: "4773a28a-9835-4ca6-972c-697003fe07f6",
				doNotHash: false,
				doNotCopy: false,
				hashAddressBar: false
			});
			</script>
			-->