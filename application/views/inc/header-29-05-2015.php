<!doctype html>
<html>
<head>
<?php 
	$len_change = '';
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

<meta charset="utf-8">
<meta name="viewport" content ="width=device-width, maximum-scale = 1.0, minimum-scale=1.0" />
<title>Zapcasa</title>
<!--for internet support HTML 5-->
<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.png" type="image/gif">
<link href="<?php echo base_url();?>assets/css/zapcasa_style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/flexslider.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/customSelectBox.css" type="text/css" media="all" />
<link rel="stylesheet"  href="<?php echo base_url();?>assets/css/pagination_style.css" type="text/css" media="all" />
<!--common liabiary fie-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
<!--------- login popup jquery ---->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/script.js"></script>
<!--------- custom select box jquery ---->
<script src="<?php echo base_url();?>assets/js/jScrollPane.js"></script>
<script src="<?php echo base_url();?>assets/js/SelectBox.js" type="text/javascript"></script>
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
						$('.carousel').parent('div').css('height', 260 + 'px');
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
						$('.carousel2').parent('div').css('height', 260 + 'px');
						$('.carousel2').css('height', '100%');
					}
					//pagination: '#pager'
				});
			});
</script>
<!--banner slider js-->
<script defer src="<?php echo base_url();?>assets/js/jquery.flexslider.js"></script>
<script src="<?php echo base_url();?>assets/js/modernizr.js"></script>
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
</head>

<body class="noJS">
<script>
var bodyTag = document.getElementsByTagName("body")[0];
bodyTag.className = bodyTag.className.replace("noJS", "hasJS");
</script>
<!------ Header part ------------->
<?php
  if(isset($sitepage)){
  }else{
?>
<div class="fixed_header">
<?php
  }
?>
	<div class="topbluebar"></div>
<!----- login pop up start  --------------------->
            <div id="toPopup"> 
                <div class="close"></div>
                <!--<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>-->
                <div id="popup_content"> <!--your content start-->
                	<p><img src="<?php echo base_url();?>assets/images/character_icon_small.jpg" alt="" style="float:left; padding-right:10px; margin-top:-7px">Sign in to your account</p>
               		<form name="login" method="post">
                    	<div class="user_login"><font style="float:left; padding-right:30px;">Sign in as </font>
                        <span><font style="float:left; line-height:10px; padding-right:8px; ">Seller</font><input type="radio" name="s1"></span>  
                        <span><font style="float:left; line-height:10px; padding-right:8px; ">Buyer</font> <input type="radio" name="s1"></span></div>
                    	<div>
                        	<span>Email Id</span>
                            <input type="email" name="email" placeholder="Enter your email Id">
                        </div>
                   		<div>
                        	<span>Password</span>
                            <input type="password" name="passwrd" placeholder="Enter your password">
                        </div>
                        <div>
                        	<input type="submit" name="login" value="Login"> <a href="" class="forgot_pass">Forgot password?</a>
                        </div>
                    </form>
                </div>
           </div> 
           <div id="backgroundPopup"></div>
    <!----- login pop up end --------------------->
<div class="main">
<header>
	<div class="logo"><a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/images/logo.png" alt="Zapcasa"></a></div>
    <div class="header_rightpanel">
    <div class="registerpanel">
    	<div class="myzapcas">
       		 <ul id="nav">
                 <li>
                	 <a href="">My ZapCasa</a>
                     <ul>
                     	<li><a href="">My account</a></li>
                        <li><a href="">Saved properties</a></li>
                        <li><a href="">Saved searches</a></li>
                        <li><a href="">My email alerts</a></li>
                        <li><a href="">My preferences</a></li>
                     </ul>
                 </li>
             </ul>
        </div>
        <ul>
        	<li><a class="topopup" href="javascript:void(0);">SIGN IN</a></li>
            <li><a href="registercommon.html">REGISTER</a></li>
        </ul>
    </div>
    <div class="lanugage">
    	<select class="custom" name="countriesFlag" id="countriesFlag" >
        <option class="italy" <?php if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "it" )) { ?>selected="selected" <?php } ?> value="it" ><?php echo $this->lang->line('italian');?></option>
		  <option class="usa" <?php if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) { ?>selected="selected" <?php } ?> value="english" ><?php echo $this->lang->line('english');?></option>
		</select>
    </div>
    <div class="socail_topmenu">
    	<ul>
        	<li><a href=""><img src="<?php echo base_url();?>assets/images/topfacebook_icon.png" alt="Facebook"></a></li>
            <li><a href=""><img src="<?php echo base_url();?>assets/images/toptwitter_icon.png" alt="Facebook"></a></li>
            <li><a href=""><img src="<?php echo base_url();?>assets/images/topgoogle_plus_icon.png" alt="Facebook"></a></li>
            <li><a href=""><img src="<?php echo base_url();?>assets/images/toplinkedin_icon.png" alt="Facebook"></a></li>
            <li><a href=""><img src="<?php echo base_url();?>assets/images/topemail_icon.png" alt="Facebook"></a></li>
            <li><a href=""><img src="<?php echo base_url();?>assets/images/topsharepoint_icon.png" alt="Facebook"></a></li>
        </ul>
    </div>
    <nav>
    	<ul>
        	<li><a href="<?php echo base_url();?>" <?php if(!isset($search_title)){?> class='active'<?php }?> ><?php echo $this->lang->line('mainMenu-home');?></a></li>
            <li><a href="<?php echo base_url();?>property/search?category_id=1" <?php if(isset($search_title) && ($search_title=='Residential' || $search_title=='Residenziale')){?> class='active'<?php }?>><?php echo $this->lang->line('mainMenu-residential');?></a></li>
            <li><a href="<?php echo base_url();?>property/search?category_id=2" <?php if(isset($search_title) && ($search_title=='Business' || $search_title=='For business' || $search_title=='Commerciale' || $search_title=='Immobili commerciali')){?> class='active'<?php }?>><?php echo $this->lang->line('mainMenu-business');?></a></li>
            <li><a href="<?php echo base_url();?>property/search?category_id=3" <?php if(isset($search_title) && ($search_title=='Rooms' || $search_title=='Stanze')){?> class='active'<?php }?>><?php echo $this->lang->line('mainMenu-rooms');?></a></li>
            <li><a href="<?php echo base_url();?>property/search?category_id=4" <?php if(isset($search_title) && ($search_title=='Land' || $search_title=='Terreni')){?> class='active'<?php }?>><?php echo $this->lang->line('mainMenu-land');?></a></li>
            <li><a href="<?php echo base_url();?>property/search?category_id=5" <?php if(isset($search_title) && ($search_title=='Vacations' || $search_title=='For vacations' || $search_title=='Vacanze')){?> class='active'<?php }?>><?php echo $this->lang->line('mainMenu-vacations');?></a></li>
            <li><a href="<?php echo base_url();?>property/search?category_id=10" <?php if(isset($search_title) && ($search_title=='Luxury' || $search_title=='Lusso')){?> class='active'<?php }?>><?php echo $this->lang->line('mainMenu-luxury');?></a></li>
        </ul>
    </nav>
    </div>
</header>    
</div>
</div>