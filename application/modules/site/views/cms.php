<?php $this->load->view("inc/header"); ?>
<!------ banner part ------------->
<div class="insidepage_banner">
	<div class="main">
    	<h2><?php echo $this->lang->line('cms_real_estate_for');?><span style="font-weight:bold;"><?php echo $this->lang->line('cms_jobs');?></span> <?php echo $this->lang->line('cms_and');?> <span style="font-weight:bold;"><?php echo $this->lang->line('cms_housing');?></span></h2>
    </div>
</div>
<!------ body part ------------->

<div class="main">
	<div style="float:left;position:relative;min-height:225px;width:1000px;">
	<?php
		/*if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
      		echo $cmsDetails['content_en'];
		} elseif( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "it" )) { 
      		echo $cmsDetails['content_it'];
		}*/
		echo $cmsDetails[$this->lang->line('cms_page_content')];
	?>
	</div>
</div>


<!------ footer part ------------->
<?php $this->load->view("inc/footer");?>