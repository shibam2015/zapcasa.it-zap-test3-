<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=11">
<meta http-equiv="X-UA-Compatible" content="EmulateIE=10">
<meta http-equiv="X-UA-Compatible" content="EmulateIE=9">
<meta http-equiv="content-type" content="text/html; charset=UTF-8" >
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
	if(  $_COOKIE['lang'] == "english" ||  $_COOKIE['lang'] == "it" ) {	
		$this->lang->load('code', $_COOKIE['lang']);
	} else {
		$this->lang->load('code', 'english');
	}
} else {
	$len_change = ("languageChange('it');");
}
?>

<?php $this->load->view("_include/meta_tag_title_description"); ?>
<?php /* if($this->router->fetch_method() == 'common_reg'){ ?>
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

			<?php
            }elseif($category_id=='1'){
				?>
                <!-----/Residential----->
                <title><?php echo $this->lang->line('category_residential_meta_title');?></title>
                <meta name="description" content="<?php echo $this->lang->line('category_residential_meta_description');?>">
                
			<?php
            }elseif($category_id=='2' || $category_id=='6' || $category_id=='7'){
				?>
                <!-----/Business----->
                <title><?php echo $this->lang->line('category_business_meta_title');?></title>
                <meta name="description" content="<?php echo $this->lang->line('category_business_meta_description');?>">

			<?php
            }elseif($category_id=='3'){
				?>
                <!----/Rooms----->
                <title><?php echo $this->lang->line('category_rooms_meta_title');?></title>
                <meta name="description" content="<?php echo $this->lang->line('category_rooms_meta_description');?>">

			<?php
            }elseif($category_id=='4'){
				?>
                <!----/Land------>
                <title><?php echo $this->lang->line('category_land_meta_title');?></title>
                <meta name="description" content="<?php echo $this->lang->line('category_land_meta_description');?>">

			<?php
            }elseif($category_id=='5'){
				?>
                <!----/Vacations------>
                <title><?php echo $this->lang->line('category_vacations_meta_title');?></title>
                <meta name="description" content="<?php echo $this->lang->line('category_vacations_meta_description');?>">

			<?php
            }elseif($category_id=='10'){
				?>
                <!----/Luxury------>
                <title><?php echo $this->lang->line('category_luxury_meta_title');?></title>
                <meta name="description" content="<?php echo $this->lang->line('category_luxury_meta_description');?>">

			<?php
            }elseif(isset($_GET['advertiser_type'])){
				?>
				<?php if($advertiser_type[0] == 'all' || $advertiser_type[0] == '2' || $advertiser_type[0] == '3'); ?>
                <!----/Advertisers search page------>
                <title><?php echo $this->lang->line('advertise_list_meta_title');?></title>
                <meta name="description" content="<?php echo $this->lang->line('advertise_list_meta_description');?>">

<?php }elseif($this->router->fetch_method() == 'blockedpage'){ ?>

<!--------blockedpage--------------->
<title><?php echo $this->lang->line('ur_ac_is_blocked');?></title>
<meta name="robots" content="noindex, nofollow">

<?php }else{ ?>

<!--------http://www.zapcasa.it/--------------->
<title><?php echo $this->lang->line('home_page_meta_title');?></title>
<meta name="description" content="<?php echo $this->lang->line('home_page_meta_description');?>">

<?php } */?>

<link href="<?php echo base_url();?>assets/css/zapcasa_style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/flexslider.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/customSelectBox.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css" type="text/css" media="all" />
<link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.png" type="image/gif">


<!--common liabiary fie-->
<script src="<?php echo base_url();?>assets/js/jquery-1.10.2.js"></script>
<script src="<?php echo base_url();?>assets/js<?php echo $this->lang->line('js_folder_lenguage');?>jquery-ui.js"></script>
<!--------- login popup jquery ---->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/script.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.fancybox.js"></script>
<script src="<?php echo base_url();?>assets/js<?php echo $this->lang->line('js_folder_lenguage');?>jquery.validate.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.css">

<!--------- custom select box jquery ---->
<script src="<?php echo base_url();?>assets/js/jScrollPane.js"></script>
<script src="<?php echo base_url();?>assets/js/SelectBox.js" type="text/javascript"></script>

<!--  For MAP  -->
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
function languageChange(lang){
	/*
	var exdays = 1;
	var d = new Date();
	d.setTime(d.getTime() + (exdays*24*60*60*1000));
	var expires = "expires="+d.toGMTString();
	document.cookie = "lang =" + lang + "; " + expires;
	location.reload(true);
	*/
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
	$(window).load(function(){
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

<script type="text/javascript">
var switchTo5x = true;
</script>
<!-- <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script> -->
<!--
<script type="text/javascript">
stLight.options({
	publisher: "4773a28a-9835-4ca6-972c-697003fe07f6",
	doNotHash: false,
	doNotCopy: false,
	hashAddressBar: false
});
</script>
-->
<!--coolcarousel slider js-->
<script src="<?php echo base_url();?>assets/js/jquery.carouFredSel-6.1.0-packed.js" type="text/javascript"></script>
<script type="text/javascript">
			$(function() {

				$('.carousel').carouFredSel({
					width: 760,
					items: 3,
					scroll: 1,
					auto: {
						duration: 1250,
						timeoutDuration: 2500
					},
					prev: '.prev',
					next: '.next',
					onCreate : function () {
						$('.carousel').parent('div').css('height', 280 + 'px');
						$('.carousel').css('height', '100%');
					}
					//pagination: '#pager'
				});
				$('.carousel2').carouFredSel({
					width: 760,
					items: 3,
					scroll: 1,
					auto: {
						duration: 1250,
						timeoutDuration: 2500
					},
					prev: '.prev2',
					next: '.next2',
					onCreate : function () {
						$('.carousel2').parent('div').css('height', 280 + 'px');
						$('.carousel2').css('height', '100%');
					}
					//pagination: '#pager'
				});
			});
</script>
<!--banner slider js-->
<script defer src="<?php echo base_url();?>assets/js/jquery.flexslider.js"></script>
<script src="<?php echo base_url();?>assets/js/modernizr.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.price_format.2.0.js"></script>
<script type="text/javascript">
    $(function(){
      //SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "fade",
        start: function(slider){
         // $('body').removeClass('loading');
        }
      });
    });
</script>
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
<style>
.NoScriptAlertOverlay{background:rgba(240, 40, 48, 0.7);width:100%;position:fixed;top:0;z-index:1000000;border-bottom:solid 1px rgba(236, 177, 180, 0.7);}
.NoScriptAlert{color:#FFFFFF;padding:20px;text-align:center;}
.NoScriptAlert a{color:#FFFFFF;text-decoration:underline;}
.NoScriptDisableOverlay {background: rgba(0,0,0,0.5);position: fixed;left: 0;top: 0;right: 0;bottom: 0;z-index: 1000;}
</style>
</head>
<body class="noJS">
<!-- DISABLED JAVASCRIPT ALERT TO USER -->
<noscript>	
	<div class="NoScriptAlertOverlay">
		<h3 class="NoScriptAlert">
			<?php echo $this->lang->line('disabled_javascript_alert_str1');?> 
			<a href="<?php echo base_url();?>">
				<?php echo $this->lang->line('disabled_javascript_alert_str2');?>
			</a>.
		</h3>
	</div>
	<div class="NoScriptDisableOverlay"></div>
</noscript>
<script>
var bodyTag = document.getElementsByTagName("body")[0];
bodyTag.className = bodyTag.className.replace("noJS", "hasJS");
</script>
<!------ Header part ------------->
<?php
if(isset($sitepage)){
	echo '<div class="fixed_header1">';
}else{
	echo '<div class="fixed_header">';
}

//echo '--->'.$_COOKIE['lang'];
?>
	<!----- login pop up start  --------------------->
	<div id="toPopup"> 
		<div class="close"></div>
		<div id="popup_content">
			<p><img src="<?php echo base_url();?>assets/images/character_icon_small.jpg" alt="" style="float:left; padding-right:10px; margin-top:-7px"><?php echo $this->lang->line('login_signin_to_your_account');?></p>
			<div id="error"></div>
			<div>
				<span><?php echo $this->lang->line('login_username');?></span>
				<input type="email" name="email" id="email" placeholder="<?php echo $this->lang->line('login_email_id_field');?>">
			</div>
			<div>
				<span><?php echo $this->lang->line('login_password');?></span>
				<input type="password" name="password" id="password" placeholder="<?php echo $this->lang->line('login_password_field');?>">
			</div>
			<div>
				<input type="hidden" id="current_url" name="current_url" value="<?php echo current_url();?>">
				<input type="submit" name="login" value="<?php echo $this->lang->line('login_button_login');?>" id="login"> 
				<a href="<?php echo base_url();?>users/forget_password" class="forgot_pass" title="<?php echo $this->lang->line('login_forgot_password_title');?>"><?php echo $this->lang->line('login_forgot_password');?></a>
			</div>
		</div>
	</div> 
	<div id="backgroundPopup"></div>
<script>
$(document).ready(function(){
	$("#login").click(function(){
		var email=$('#email').val(); 
		var password=$('#password').val();
		var current_url=$('#current_url').val();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>users/login",
			data:{email: $.trim($('#email').val()), password: $.trim($('#password').val())},
			async: false,
			success:function(result){
				if(result=='invalid'){
					var url = "<?php echo base_url().'users/blockedpage';?>";
					$(location).attr('href',url);
					//location.reload();
				}else if(result==1){
					//var url = "<?php echo base_url().'users/my_account';?>";
					//$(location).attr('href',url);
					location.reload();
				}else{
					$("#error").html("<span style='color:red'><?php echo $this->lang->line('login_invalid_username');?></span>");
				}
			}
		});
	});
});
$(document).keypress(function(e) {
	if(e.which == 13) {
		var email=$('#email').val(); 
		var password=$('#password').val();
		var current_url=$('#current_url').val();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>users/login",
			data:{email: $.trim($('#email').val()), password: $.trim($('#password').val())},
			async: false,
			success:function(result){
				if(result=='invalid'){
					var url = "<?php echo base_url().'users/blockedpage';?>";
					$(location).attr('href',url);
				}else if(result==1){
					//var url = "<?php echo base_url().'users/my_account';?>";
					//$(location).attr('href',url);
					location.reload();
				}else{
					$("#error").html("<span style='color:red'><?php echo $this->lang->line('login_invalid_username');?></span>");
				}
			}
		});
	}
});
</script>
	<!----- login pop up end --------------------->
	<div id="toPopup4">
		<div class="close4"></div>
		<div id="popup_content1">
			<table>
				<tr>
					<td><img src="<?php echo base_url();?>assets/images/add_newproperty_icon.jpg"></td>
					<td><span style="font-weight:bold; color:#000; text-align:left;"><?php echo $this->lang->line('info_addprop_to_add_a_property');?></span></td>
				</tr>
			</table>
			<div style="text-align:center;">
				<span><?php echo $this->lang->line('info_addprop_if_you_have_an_advertiser_account');?> </span><br/>
				<span><?php echo $this->lang->line('info_addprop_or');?></span><br/>
				<span><?php echo $this->lang->line('info_addprop_to_sign_up_as');?></span>
				<span style="font-size:14px; color:#A3CFF7;">(<?php echo $this->lang->line('info_addprop_this_account_will_be_disconnected');?>)</span>
				<span style="padding-left:101px;"><a href="<?php echo base_url();?>property/add_property_form" class="mainbt"><?php echo $this->lang->line('info_addprop_register_a_new_account');?></a></span>
			</div>
		</div>
	</div>

	<div id="backgroundPopup4"></div>
	<?php
	//if(!isset($search_title)) {
	?>
	<div class="topbluebar"></div>
	<?php // }?>
	<div class="main">
		<header>
			<div class="logo"><a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/images/logo.png" alt="Zapcasa"></a></div>
			<div class="header_rightpanel">
				<div class="registerpanel">
					<div class="myzapcas">
						<ul id="nav">
							<li><a href=""><?php echo $this->lang->line('header_title');?></a>
						<?php 
						$uid = $this->session->userdata( 'user_id' );
						$msg_count=get_perticular_count('zc_property_message_info'," and user_id_to='".$uid."' and msg_to_delete='0' and read_status='0'");
						if($msg_count != '') {
							$mesg_cnt = $msg_count;
						} else {
							$mesg_cnt = 0;
						}
						$user_type = get_perticular_field_value('zc_user','user_type'," and user_id='".$uid."'");
						if($uid!='0') {
							if($user_type=='2' || $user_type=='3') {
							?>
								<ul>
									<li>
										<a href="<?php echo base_url();?>property/get_message"><?php echo $this->lang->line('mainMenu-inbox');?>
											<sup class="count">
												<?php echo $mesg_cnt;?>
											</sup>
										</a>
									</li>
									<li><a href="<?php echo base_url();?>property/property_details"><?php echo $this->lang->line('mainMenu-propertyList');?></a></li>
									<li><a href="<?php echo base_url();?>property/add_property_form"><?php echo $this->lang->line('mainMenu-addProperty');?></a></li>
									<li><a href="<?php echo base_url();?>My_Feedback"><?php echo $this->lang->line('mainMenu-feedback');?></a></li>
									<li><a href="<?php echo  base_url();?>property/get_saved_property"><?php echo $this->lang->line('mainMenu-savedProperty');?></a></li>
									<li><a href="<?php echo base_url();?>property/get_saved_search"><?php echo $this->lang->line('mainMenu-savedSearch');?></a></li>	<li><a href="<?php echo base_url();?>users/my_account"><?php echo $this->lang->line('mainMenu-myAccount');?></a></li>
									<li><a href="<?php echo base_url();?>users/my_preference"><?php echo $this->lang->line('mainMenu-myPreferences');?></a></li>
								</ul>
							<?php
							} else{
							?>
								<ul>
									<li>
										<a href="<?php echo base_url();?>property/get_message"><?php echo $this->lang->line('mainMenu-inbox');?>
											<sup class="count">
												<?php echo $mesg_cnt;?>
											</sup>
										</a>
									</li>
									<!-- <li><a href="<?php //echo base_url();?>My_Feedback"><?php //echo $this->lang->line('mainMenu-feedback');?></a></li> -->
									<li><a href="<?php echo  base_url();?>property/get_saved_property"><?php echo $this->lang->line('mainMenu-savedProperty');?></a></li>
									<li><a href="<?php echo base_url();?>property/get_saved_search"><?php echo $this->lang->line('mainMenu-savedSearch');?></a></li>	<li><a href="<?php echo base_url();?>users/my_account"><?php echo $this->lang->line('mainMenu-myAccount');?></a></li>
									<li><a href="<?php echo base_url();?>users/my_preference"><?php echo $this->lang->line('mainMenu-myPreferences');?></a></li>
								</ul>
							<?php
							}
						}
						?>
							</li>
						</ul>
					</div>
				<ul>
				<?php
					$uid = $this->session->userdata('user_id');
					if($uid=='0') {
				?>
					<li><a class="topopup" href="javascript:void(0);"><?php echo $this->lang->line('signin');?></a></li>
					<li><a href="<?php echo base_url();?>users/common_reg"><?php echo $this->lang->line('register');?></a></li>
				<?php
					}else {
					$uname = get_perticular_field_value('zc_user','first_name'," and user_id='".$uid."'");
					if($user_type=='2' || $user_type=='3') {
				?>
					<li><a href="<?php echo base_url();?>advertiser/advertiser_details/<?php echo $uid;?>"><?php echo $this->lang->line('hi');?> <?php echo ucfirst(substr($uname,0,6)).'...';?></a></li>
				<?php					
					}else {
				?>
					<li><a href="<?php echo base_url();?>users/my_account"><?php echo $this->lang->line('hi');?><?php echo ucfirst(substr($uname,0,6)).'...';?></a></li>
				<?php
					}
				?>
					<li><a href="<?php echo base_url();?>users/logout"><?php echo $this->lang->line('mainMenu-logout');?></a></li>
				<?php
				}
				?>
				</ul>	
			</div>
				<div class="lanugage">
					<select class="custom" name="countriesFlag" id="countriesFlag" >
						<option class="italy" <?php if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "it" )) { ?>selected="selected" <?php } ?> value="it" ><?php echo $this->lang->line('italian');?></option>
						<option class="usa" <?php if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) { ?>selected="selected" <?php } ?> value="english" ><?php echo $this->lang->line('english');?></option>
					</select>
				</div>
				<!-- <div class="socail_topmenu">
					<ul>
						<li><a href=""><img src="<?php //echo base_url();?>assets/images/topfacebook_icon.png" alt="Facebook"></a></li>
						<li><a href=""><img src="<?php //echo base_url();?>assets/images/toptwitter_icon.png" alt="Facebook"></a></li>
						<li><a href=""><img src="<?php //echo base_url();?>assets/images/topgoogle_plus_icon.png" alt="Facebook"></a></li>
						<li><a href=""><img src="<?php //echo base_url();?>assets/images/toplinkedin_icon.png" alt="Facebook"></a></li>
						<li><a href=""><img src="<?php //echo base_url();?>assets/images/topemail_icon.png" alt="Facebook"></a></li>
						<li><a href=""><img src="<?php //echo base_url();?>assets/images/topsharepoint_icon.png" alt="Facebook"></a></li>
					</ul>
				</div> -->
				<nav>
				<?php
					if(isset($for_luxury) && $for_luxury !=''){
						$luxury = $for_luxury;
					}else{
						$luxury = '';
					}
				?>
					<ul>
						<li><a href="<?php echo base_url();?>" <?php if(!isset($category_id)){?> class='active'<?php }?> ><?php echo $this->lang->line('mainMenu-home');?></a></li>
						<li><a href="<?php echo base_url();?>property/search?category_id=1" <?php if(isset($category_id) && ($category_id==1)){?> class='active'<?php }?>><?php echo $this->lang->line('mainMenu-residential');?></a></li>
						<li><a href="<?php echo base_url();?>property/search?category_id=2" <?php if(isset($category_id) && ($category_id==2 || $category_id==6 || $category_id==7) && $luxury == ''){?> class='active'<?php }?>><?php echo $this->lang->line('mainMenu-business');?></a></li>
						<li><a href="<?php echo base_url();?>property/search?category_id=3" <?php if(isset($category_id) && ($category_id==3)){?> class='active'<?php }?>><?php echo $this->lang->line('mainMenu-rooms');?></a></li>
						<li><a href="<?php echo base_url();?>property/search?category_id=4" <?php if(isset($category_id) && ($category_id==4)){?> class='active'<?php }?>><?php echo $this->lang->line('mainMenu-land');?></a></li>
						<li><a href="<?php echo base_url();?>property/search?category_id=5" <?php if(isset($category_id) && ($category_id==5)){?> class='active'<?php }?>><?php echo $this->lang->line('mainMenu-vacations');?></a></li>
						<li><a href="<?php echo base_url();?>property/search?category_id=10" <?php if((isset($category_id) && ($category_id==10)) || ($luxury !='')){?> class='active'<?php }?>><?php echo $this->lang->line('mainMenu-luxury');?></a></li>
					</ul>
				</nav>
			</div>
		</header>
	</div>
</div>
