<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!--<meta name="viewport" content ="width=device-width, maximum-scale = 1.0, minimum-scale=1.0" />-->
<meta http-equiv="X-UA-Compatible" content="IE=11">
<meta http-equiv="X-UA-Compatible" content="EmulateIE=10">
<meta http-equiv="X-UA-Compatible" content="EmulateIE=9">
<!--for internet support HTML 5-->
<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php 
	$len_change = '';
	if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] != "" )) {
		/*if(trim($_COOKIE['lang'])=='english') {
			//$this->session->set_userdata('language','english');
		} elseif(trim($_COOKIE['lang'])=='it') {
			//$this->session->set_userdata('language','it');
		} else {
			//$this->session->set_userdata('language','english');
		}*/
		if(  $_COOKIE['lang'] == "english" ||  $_COOKIE['lang'] == "it" ) {	
			$this->lang->load('code', $_COOKIE['lang']);
		} else {
			$this->lang->load('code', 'english');
		}
	} else {
	$len_change = ("languageChange('it');");
	}
?>
<?php if($this->router->fetch_method() == 'common_reg'){ ?>
<!----/user/common_reg------>
<title><?php echo $this->lang->line('common_reg_meta_title');?></title>
<meta name="description" content="<?php echo $this->lang->line('common_reg_meta_description');?>">

<?php }elseif($this->router->fetch_method() == 'comon_signup'){ ?>
<!-----/user/comon_signup------>

<title><?php echo $this->lang->line('reg_user_meta_title');?></title>
<meta name="description" content="<?php echo $this->lang->line('reg_user_meta_description');?>">
<meta name="robots" content="noindex, nofollow">

<?php }elseif($this->router->fetch_method() == 'user_edit'){ ?>
<!-----/user/user_edit----->
<title><?php echo $this->lang->line('user_edit_meta_title');?></title>
<meta name="robots" content="noindex, nofollow">

<?php }elseif($this->router->fetch_method() == 'thanks'){ ?>

<!-----/user/thanks/29----->
<title><?php echo $this->lang->line('thanks_user_meta_title');?></title>
<meta name="robots" content="noindex, nofollow">

<?php }elseif($this->router->fetch_method() == 'acctivation'){ ?>

<!----/user/acctivation/29/d925fb06d33d43afb3018789256a632b------>
<title><?php echo $this->lang->line('thanks_owner_act_meta_title');?></title>
<meta name="robots" content="noindex, nofollow">

<?php }elseif($this->router->fetch_method() == 'reg_owner'){ ?>

<!----/user/reg_owner------>
<title><?php echo $this->lang->line('reg_owner_meta_title');?></title>
<meta name="description" content="<?php echo $this->lang->line('reg_owner_meta_description');?>">
<meta name="robots" content="noindex, nofollow">

<?php }elseif($this->router->fetch_method() == 'owner_edit'){ ?>

<!----/user/owner_edit------>
<title><?php echo $this->lang->line('owner_edit_meta_title');?></title>
<meta name="robots" content="noindex, nofollow">

<?php }elseif($this->router->fetch_method() == 'thanksowner'){ ?>

<!----/user/thanksowner/32------>
<title><?php echo $this->lang->line('thanks_owner_meta_title');?></title>
<meta name="robots" content="noindex, nofollow">

<?php }elseif($this->router->fetch_method() == 'my_account'){ ?>

<!-----/user/my_account----->
<title><?php $new_tit=$user_detail[0];	 	
          if($user_detail[0]['user_type']=='3') {
            echo $new_tit['company_name'] ." " .$this->lang->line('my_account_meta_title');
		  } elseif($user_detail[0]['user_type']=='2') {
         	echo $new_tit['first_name'] ." " .$new_tit['last_name'] ." " .$this->lang->line('my_account_meta_title');
		  } else {
         	echo $new_tit['first_name'] ." " .$this->lang->line('my_account_meta_title');
		  }
		?></title>
<meta name="robots" content="noindex, nofollow">

<?php }elseif($this->router->fetch_method() == 'reg_agency'){ ?>

<!----/user/reg_agency------>
<title><?php echo $this->lang->line('reg_agency_meta_title');?></title>
<meta name="description" content="<?php echo $this->lang->line('reg_agency_meta_description');?>">
<meta name="robots" content="noindex, nofollow">

<?php }elseif($this->router->fetch_method() == 'agency_edit'){ ?>

<!----/user/agency_edit------>
<title><?php echo $this->lang->line('agency_edit_meta_title');?></title>
<meta name="robots" content="noindex, nofollow">

<?php }elseif($this->router->fetch_method() == 'thanksagency'){ ?>

<!----/user/thanksagency/34------>
<title><?php echo $this->lang->line('thanks_agency_meta_title');?></title>
<meta name="robots" content="noindex, nofollow">

<?php }elseif($this->router->fetch_method() == 'forget_password'){ ?>

<!----/user/forget_password------>
<title><?php echo $this->lang->line('forgot_password_meta_title');?></title>
<meta name="robots" content="noindex, nofollow">

<?php }elseif($this->router->fetch_method() == 'add_property_form'){ ?>

<!----/property/add_property_form------>
<title><?php echo $this->lang->line('add_property_form_meta_title');?></title>
<meta name="robots" content="noindex, nofollow">

<?php }elseif($this->router->fetch_method() == 'edit_property'){ ?>

<!----/property/add_property_form------>
<title><?php echo $this->lang->line('edit_property_form_meta_title');?></title>
<meta name="robots" content="noindex, nofollow">

<?php }elseif($this->router->fetch_method() == 'add_property_csv'){ ?>

<!----/property/add_property_form------>
<title><?php echo $this->lang->line('add_property_csv_meta_title');?></title>
<meta name="robots" content="noindex, nofollow">

<?php }elseif($this->router->fetch_method() == 'Residential'){ ?>

<!-----/Residential----->
<title><?php echo $this->lang->line('category_residential_meta_title');?></title>

<?php }elseif($this->router->fetch_method() == 'Business'){ ?>

<!-----/Business----->
<title><?php echo $this->lang->line('category_business_meta_title');?></title>

<?php }elseif($this->router->fetch_method() == 'Rooms'){ ?>

<!----/Rooms----->
<title><?php echo $this->lang->line('category_rooms_meta_title');?></title>

<?php }elseif($this->router->fetch_method() == 'Land'){ ?>

<!----/Land------>
<title><?php echo $this->lang->line('category_land_meta_title');?></title>

<?php }elseif($this->router->fetch_method() == 'Vacations'){ ?>
<!----/Vacations------>
<title><?php echo $this->lang->line('category_vacations_meta_title');?></title>

<?php }elseif($this->router->fetch_method() == 'Luxury'){ ?>

<!----/Luxury------>
<title><?php echo $this->lang->line('category_luxury_meta_title');?></title>

<?php }elseif($this->router->fetch_method() == 'advertiser_details'){ ?>

<!----/advertiser_details------>
<title><?php	 	
          if($advertiser_detail[0]['user_type']=='3') {
            echo ucfirst($advertiser_detail[0]['company_name']) ." - " .ucfirst($advertiser_detail[0]['business_name']);
		  } else {
         	echo ucfirst($advertiser_detail[0]['first_name']) ." " .ucfirst($advertiser_detail[0]['last_name']);
		  }
		?> - ZapCasa</title>
<?php if($advertiser_detail[0]['about_me']!=''){
	$meta_descr = nl2br($advertiser_detail[0]['about_me']);
    if(strlen($meta_descr)<=135) {
       echo '<meta name="description" content="' . $meta_descr . '">';
    } else { 
       $y=substr($meta_descr,0,135) . '...';
	   echo '<meta name="description" content="' . $y . '">';
    }
}?>

<?php }else{ ?>

<!--------http://www.zapcasa.it/--------------->
<title><?php echo $this->lang->line('home_page_meta_title');?></title>
<meta name="description" content="<?php echo $this->lang->line('home_page_meta_description');?>">

<?php } ?>

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
<!--<link rel="stylesheet" href="<?php //echo base_url();?>assets/css/glDatePicker.default.css" type="text/css" media="all" />-->
<!--common liabiary fie-->
<script src="<?php echo base_url();?>assets/js/jquery-1.10.2.js"></script>
<script src="<?php echo base_url();?>assets/js<?php echo $this->lang->line('js_folder_lenguage');?>jquery-ui.js"></script>
<!--------- login popup jquery ---->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/script.js"></script>
<!--<script type="text/javascript" src="<?php //echo base_url();?>assets/js/jquery.aw-showcase.js"></script>-->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.fancybox.js"></script>
<script src="<?php echo base_url();?>assets/js<?php echo $this->lang->line('js_folder_lenguage');?>jquery.validate.min.js" type="text/javascript"></script>

<!--<script type="text/javascript" src="<?php //echo base_url();?>assets/js/glDatePicker.min.js"></script>-->
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css">

<!--------- custom select box jquery ---->
<script src="<?php echo base_url();?>assets/js/jScrollPane.js"></script>
<script src="<?php echo base_url();?>assets/js/SelectBox.js" type="text/javascript"></script>

<!--  For MAP  -->
<script src="<?php echo base_url();?>assets/js/map.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/js/jquery.nicescroll.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/js/jquery.paginate.js" type="text/javascript"></script>

<script>	
$(function() {
	$("select.custom").each(function() {					
		var sb = new SelectBox({
			selectbox: $(this),
			height: 45,
			width: 100,
			changeCallback: function(val) {
				languageChange(val);
			}
		});
	});
	
});
function languageChange(lang) {
	var exdays = 1;
	var d = new Date();
	d.setTime(d.getTime() + (exdays*24*60*60*1000));
	var expires = "expires="+d.toGMTString();
	document.cookie = "lang =" + lang + "; " + expires;
	location.reload(true);
}
</script>
<script> <?php echo $len_change; ?> </script>
<!------------------------------------------------------------------------>
<!-- jQuery Plugin scripts -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.easing.1.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.lightbox-0.5.pack.js"></script>

<!-- Slider Kit scripts -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.sliderkit.1.9.2.pack.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.placeholder.js"></script>

<!-- Slider Kit launch -->
<script type="text/javascript">
	$(window).load(function(){ //$(window).load() must be used instead of $(document).ready() because of Webkit compatibility

		// Sliderkit photo gallery > With captions
		$(".photosgallery-captions").sliderkit({
			navscrollatend: true,
			mousewheel:true,
			keyboard:true,
			shownavitems:4,
			auto:false,
			fastchange:true
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

<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "4773a28a-9835-4ca6-972c-697003fe07f6", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
