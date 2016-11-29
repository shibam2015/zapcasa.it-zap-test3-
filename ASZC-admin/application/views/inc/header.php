<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />	
	<title>
	<?php
	if( isset( $page_header_title) ){
		print $page_header_title." | ZAPCASA";
	}else{
		print "	ZAPCASA | Dashboard";
	}
	?>
	</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/neon-core.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/neon-theme.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/neon-forms.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
	<script src="<?php echo base_url()?>assets/js/jquery-1.11.0.min.js"></script>
	<script src="<?php echo base_url()?>assets/js/jquery-ui.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.validate.min.js" type="text/javascript"></script>
	
</head>
<body class="page-body page-fade">
    <input type="hidden" id="global_base_url" value="<?php echo base_url()?>" />
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->	
	<div class="sidebar-menu">		
		<header class="logo-env">			
			<!-- logo -->
			<div class="logo">
				<a href="<?=site_url('/dashboard/')?>">
					<img src="<?=asset_url()?>images/logo.png" width="170" alt="" />
				</a>
			</div>			
						<!-- logo collapse icon -->						
			<div class="sidebar-collapse">

				<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->

					<i class="entypo-menu"></i>

				</a>

			</div>
			<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
					<i class="entypo-menu"></i>
				</a>
			</div>			
		</header>
	<?php $this->load->view('inc/menubar.php'); ?>	
	</div>	