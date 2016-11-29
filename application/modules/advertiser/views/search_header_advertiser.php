<style>
#country-list{background: #ffffff;float:left;list-style:none;margin:0;padding:0;width:100%;}
#country-list li{padding: 10px; background: #ffffff;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background: #f0f0f0;}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$("#location").keyup(function(){
		var o1 = $(this).val();
        if (o1.length > 2) {
			a(function() {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>property/getAjaxAdvLocations",
					data:'fname=location&disname=suggesstion-box&keyword='+o1+"&lang=<?php echo $_COOKIE['lang']; ?>",
					beforeSend: function(){
						$("#location").css("background","#FFF url(<?php echo base_url(); ?>assets/images/LoaderIcon.gif) no-repeat 98%");
					},
					success: function(data){
						$("#suggesstion-box").html('');
						if(data != 0){
							$("#suggesstion-box").show();
							$("#suggesstion-box").html(data);
							$("#suggesstion-box").css("border","#c4c4c4 1px solid");
							$("#location").css("background","#FFF");
						}else{
							$("#suggesstion-box").hide();
							$("#location").css("background","#FFF");
						}
					}
				});		
			}, 500)
		}else{
			$("#suggesstion-box").html('');
			$("#suggesstion-box").hide();
		}
	});
	var a = (function() {
		var e = 0;
		return function(t, s) {
			clearTimeout(e);
			e = setTimeout(t, s)
		}
	})(),
	e = 0;
});
function selectCountry(val, fname, disname) {
	$("#"+fname).val(val);
	$("#"+disname).hide();
	$("#suggesstion-box").css("border","#c4c4c4 0px solid");
}
</script>
<form class="" id="agency_search" method="get" action="<?php echo base_url();?>advertiser/search">
<div class="multiplesearch" style="width:100%;">
	<div class="searchbig">
		<input type="text" name="location" id="location" placeholder="<?php echo $this->lang->line('search_header_advertise_location_field');?>" value="<?php echo isset( $_GET['location'] ) ? $_GET['location'] : ''; ?>" autocomplete="off">
		<div id="suggesstion-box" style='overflow:auto;max-height:300px;position:absolute;z-index:1;width:220px;margin-top:32px;'></div>
	</div>
	<div class="searchbig" style="margin-left:10px;">
		<input type="text" name="name"  placeholder="<?php echo $this->lang->line('search_header_advertise_name_field');?>" value="<?php echo isset( $_GET['name'] ) ? $_GET['name'] : ''; ?>">
		<!-- <div class="prove-list" style="display:"></div>-->
	</div>
	<div class="customsearch" style="margin-left:10px;margin-top:4px;">
		<input type="radio" class="required" value="all" name="advertiser_type" <?php echo (isset($_GET['advertiser_type']) && $_GET['advertiser_type'] == "all") ? 'checked="true"' : ''; ?>><?php echo $this->lang->line('home_page_type_of_advertiser_all');?>
	</div>
	<div class="customsearch" style="margin-top:4px;">
		<input type="radio" class="required" value="2" name="advertiser_type" <?php echo (isset($_GET['advertiser_type']) && $_GET['advertiser_type'] == "2") ? 'checked="true"' : ''; ?>><?php echo $this->lang->line('search_header_advertise_owners');?>
	</div>
	<div class="customsearch" style="margin-top:4px;">
		<input type="radio" class="required" value="3" name="advertiser_type" <?php echo (isset($_GET['advertiser_type']) && $_GET['advertiser_type'] == "3") ? 'checked="true"' : ''; ?>><?php echo $this->lang->line('search_header_advertise_agency');?>
	</div>
	<div class="customsearch" style="float:right;width:80px;">
		<div class="bottom_btnbar">
			<input type="submit" name="search" value="<?php echo $this->lang->line('search_header_advertise_button_search');?>">
		</div>
	</div>	
</div>
</form>