<?php
switch($_COOKIE['lang']){
	case 'english':
		$string1 = "OOPS! - This content is not available at this time!";
		$string2 = "This page cannot be shown currently. You do not have permission to access this page, the link you clicked on could be expired or It could be temporarily unavailable.";
		$string3 = "RERURN HOME";
		break;
	case 'it':
		$string1 = "OOPS! - Questo contenuto non è al momento disponibile!";
		$string2 = "Impossibile visualizzare la pagina richiesta al momento. La pagina potrebbe essere temporaneamente non disponibile, il link su cui hai cliccato potrebbe essere scaduto o potresti non disporre dell'autorizzazione a visualizzare questa pagina.";
		$string3 = "TORNA ALLA HOME";
		break;
	default:
		$string1 = "OOPS! - This content is not available at this time!";
		$string2 = "This page cannot be shown currently. You do not have permission to access this page, the link you clicked on could be expired or It could be temporarily unavailable.";
		$string3 = "RERURN HOME";
		break;
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>oops 404 page not found</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<style type="text/css">
		@font-face {
			font-family: 'Love Ya Like A Sister';
			font-style: normal;
			font-weight: 400;
			src: local('Love Ya Like A Sister Regular'), local('LoveYaLikeASister-Regular'), url(http://fonts.gstatic.com/s/loveyalikeasister/v7/LzkxWS-af0Br2Sk_YgSJY5HSI-O7NEBdNbD5SV3GSEY.woff) format('woff');
		}
		body{font-family:'Love Ya Like A Sister', cursive;}
		body{background:#eaeaea;}	
		.wrap{margin:0 auto;width:1000px;}
		.logo{text-align:center;margin-top:50px;}
		.logo img{width:200px;}
		.logo p{color:#272727;font-size:40px;margin-top:1px;}	
		.logo p span{color:lightgreen;}	
		.sub a{color:#fff;text-decoration:none;font-size:13px;font-family: arial, serif;font-weight:bold;}	
		.back a{color:#fff;background:#272727;text-decoration:none;padding:10px 20px;font-size:13px;font-family: arial, serif;font-weight:bold;-webkit-border-radius:.5em;-moz-border-radius:.5em;-border-radius:.5em;}
		.footer{color:black;float:right;}	
		.footer a{color:rgb(255, 122, 8);}
		.sub{margin-top:60px;}	
		</style>
	</head>
	<body>
		<div class="wrap">
			<div class="logo">
				<p><?php echo $string1; ?></p>
				<div style="border-top:1px solid #ED6B1F; border-bottom:1px solid #ED6B1F; margin-bottom: 42px; padding: 10px 0;">
					<a href="<?php echo config_item('base_url');?>">
						<img src="<?php echo config_item('base_url');?>assets/images/WAITING.png"/>
					</a>
				</div>
				<p style="font-size:20px;margin-top:20px;">
					<?php echo $string2; ?>
				</p>
				<div class="sub">
					<p style="float:left;" class="back">
						<a href="<?php echo config_item('base_url').'users/my_account';?>">
							<?php echo $string3; ?>
						</a>
					</p>
					<div class="footer">
						&copy; 2014 Zapcasa. All rights reserved.<br/>
						<p style="float:right; line-height:10px;">
							<a href="<?php echo config_item('base_url');?>">www.zapcasa.it</a>
						</p>
					</div>
				</div>
			</div>
 		</div>
	</body>	