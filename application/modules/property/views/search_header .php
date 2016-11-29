<script type="text/javascript">
$(document).ready(function() {
	$('#location').focus();
	$('.groupOfTexbox2').keypress(function (event) {
		 return isNumber(event, this)
	});	
	$('.groupOfTexbox').keypress(function (event) {
		 return isOnlyNumber(event, this)
	});
	$('.groupOfCurrencyBox1').keypress(function (event) {
		return isCurrency(event, this)
	});
	var search_title='<?php echo $search_title;?>';
	//alert(search_title);
	typology_adjustment(search_title, 'default');
	$('#login-trigger').click(function(){
		$(this).next('#login-content').slideDown(350);
		//$(this).next('#login-content2').slideToggle();
		$('#login-content2').hide();
		$('#login-content3').hide();
		$('#login-content4').hide();
		$('#login-content5').hide();
		
		$(this).toggleClass('active');
		if ($(this).hasClass('active')) $(this).find('span').html('&#x25BC;')
			//else $(this).find('span').html('&#x25BC;')
	})
	$('#login-trigger2').click(function(){
		$(this).next('#login-content2').slideToggle();
		$('#login-content').hide();
		$('#login-content1').hide();
		$('#login-content3').hide();
		$('#login-content4').hide();
		$('#login-content5').hide();
		//$(this).next('#login-content2').slideToggle();
		$(this).toggleClass('active');          

		if ($(this).hasClass('active')) $(this).find('span').html('&#x25BC;')
		// else $(this).find('span').html('&#x25BC;')
	})
	$('#login-trigger3').click(function(){
		$(this).next('#login-content3').slideToggle();
		$('#login-content').hide();
		$('#login-content1').hide();
		$('#login-content2').hide();
		$('#login-content4').hide();
		$('#login-content5').hide();
		//$(this).next('#login-content2').slideToggle();
		$(this).toggleClass('active');          

		if ($(this).hasClass('active')) $(this).find('span').html('&#x25BC;')
		//else $(this).find('span').html('&#x25BC;')
	})
	$('#login-trigger4').click(function(){
		$('#login-content').hide();
		$('#login-content1').hide();
		$('#login-content2').hide();
		$('#login-content3').hide();
		$('#login-content5').hide();
		$(this).next('#login-content4').slideToggle();
		//$(this).next('#login-content2').slideToggle();
		$(this).toggleClass('active');          

		if ($(this).hasClass('active')) $(this).find('span').html('&#x25BC;')
		// else $(this).find('span').html('&#x25BC;')
	})
	$('#login-trigger5').click(function(){
		$('#login-content').hide();
		$('#login-content1').hide();
		$('#login-content2').hide();
		$('#login-content3').hide();
		$('#login-content4').hide();
		$(this).next('#login-content5').slideToggle();
		//$(this).next('#login-content2').slideToggle();
		$(this).toggleClass('active');          

		if ($(this).hasClass('active')) $(this).find('span').html('&#x25BC;')
		//else $(this).find('span').html('&#x25BC;')
	})
	/*$('body').click(function(){
	$('#login-content').hide();
	});*/
	$(document).mouseup(function(e) {
		var closediv = $("#login-content");
		if (closediv.has(e.target).length == 0) {
			closediv.hide();
			$("#login-trigger").removeClass('active');
			//$("#login-trigger").find('span').html('&#x25BC;')
		}
		var closediv = $("#login-content2");
		if (closediv.has(e.target).length == 0) {
			closediv.hide();
			$("#login-trigger2").removeClass('active');
			//$("#login-trigger").find('span').html('&#x25BC;')
		}
		var closediv = $("#login-content3");
		if (closediv.has(e.target).length == 0) {
			closediv.hide();
			$("#login-trigger3").removeClass('active');
			//$("#login-trigger").find('span').html('&#x25BC;')
		}
		var closediv = $("#login-content4");
		if (closediv.has(e.target).length == 0) {
			closediv.hide();
			$("#login-trigger4").removeClass('active');
			//$("#login-trigger").find('span').html('&#x25BC;')
		}
		var closediv = $("#login-content5");
		if (closediv.has(e.target).length == 0) {
			closediv.hide();
			$("#login-trigger5").removeClass('active');
			//$("#login-trigger").find('span').html('&#x25BC;')
		}
	}); 
});
function typology_adjustment(str, deflt){
	//alert(str);
	//document.getElementById('typology').selectedIndex = 0;
	if(str == 'PRO'){
		$("#category_id").val(6);
	}
	if(str == 'BLI'){
		$("#category_id").val(7);
	}
	if(str == 'RES'){
		$("#category_id").val(1);
	}
	if(str == 'VAC'){
		$("#category_id").val(5);
	}
	var selected_typology = $("#selected_typology").val();
	//alert(selected_typology);
	if((str!=0)&&(str!="Business" || str!="For business" || str!="Immobili commerciali") && (str!="Luxury" || str!="Lusso")){
		$.post("<?php echo base_url(); ?>property/getTypology", { lang : '<?php echo $_COOKIE['lang']; ?>', category : str , selected_typology : selected_typology, deflt:deflt},
			function(result){
				// $("#typology").html(result);
				$("#typologys").html(result);
		});
	}
}
/*$(document).ready( function() {
	var luxury = $("#for_luxury").val();
	alert(luxury);
	<?php 
		//if( isset( $_GET['for_luxury'] ) &&( $_GET['for_luxury'] != "" ) ) { 
	?>
	if(luxury != ''){
		typology_adjustment("'"+luxury+"'");
	}
	<?php
		// } 
	?>
});	*/
function initialize() {
	var input = document.getElementById('location');
	//var options = {componentRestrictions: {country: 'ind'}};            
	//new google.maps.places.Autocomplete(input);
}
</script>
<style type="text/css">
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
					url: "<?php echo base_url(); ?>property/getAjaxLocations",
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
$("#mySubmit").click(function(){
	var property_name=$("#property_name").val();
	var save_search_flag=$("#save_search_flag").val();
	var segment_name=$("#segment_name").val();
	if(property_name==''){
		$('#property_name').addClass('errorpop');
		return false;
	}if(save_search_flag==''){
		$('#save_search_flag').addClass('errorpop');
		return false;
	}else{
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>property/saved_search_prop",
			data:{
				property_name: $.trim($('#property_name').val()),
				save_search_flag: $.trim($('#save_search_flag').val()),
				segment_name: $.trim(segment_name)
			},
			async: false,
			success:function(result){
				console.log(result);
				if(result==1){
					var msg = "<span id='msg_content_popup_content1'>";
					msg+= "<div style='text-align:center;'><?php echo $this->lang->line('saved_search_success_text_2'); ?></div>";
					msg+= "<div class='updateing_opt'>";
					msg+= "<input type='button' value='<?php echo $this->lang->line('saved_search_text_1'); ?>' onclick='javascript: list_of_savesearch();'>";
					msg+= "</div></span>";	
					$("#toPopup1 #popup_content1").html(msg);
				}else{
					$("#error").html("<span style='color:red'><?php echo $this->lang->line('search_header_advertise_invalid_username'); ?></span>");
				}
			}
		});
	}
});
function list_of_savesearch() {
	$("#toPopup1").fadeOut("normal");  
	$("#backgroundPopup1").fadeOut("normal"); 
	window.location = "<?php echo base_url(); ?>property/get_saved_search";
}	
</script>
<div class="searchbig">
	<input type="text" name="location" id="location" placeholder='<?php echo $this->lang->line('search_header_location_field');?>' value="<?php echo isset( $location) ? $location : ''; ?>" autocomplete="off"><div id="suggesstion-box" style='overflow:auto;max-height:300px;position:absolute;z-index:10;width:220px;margin-top:32px;'></div>
</div>
<div class="multiplesearch">
	<input type="hidden" id="category_id" name="category_id" value="<?php echo isset($category_id) ? $category_id : 0; ?>" >
	<input type="hidden" name="save_search_id" id="save_search_id" value="<?php echo isset( $_GET['save_search_id'] ) ? $_GET['save_search_id'] : 0; ?>" >
	<?php
	if($_GET['save_search_name']){
	?>
	<input type="hidden" name="save_search_name" value="<?php echo $_GET['save_search_name']; ?>">
	<?php
	}
	?>
	<div class="customsearch">
	<?php
		$for_sale = 0;
		$for_rent = 0;
		$by_agency = 0;
		$by_owner = 0;
		$to_be_renovated = 0;
		$good = 0;
		$renovated = 0;
		$new_under_construction = 0;
		$rs_counts = get_all_basic_search_value('zc_property_details',$category_id);
		if($rs_counts != ''){
			//echo "<pre>"; print_r($rs_counts);exit;
			foreach($rs_counts as $arrCountProp){
				if($arrCountProp->contract_id == 1) {
					$for_rent++;
				} 
				if($arrCountProp->contract_id == 2) {
					$for_sale++;
				} 
				if($arrCountProp->property_post_by_type == 2) {
					$by_owner++;
				}
				if($arrCountProp->property_post_by_type == 3) {
					$by_agency++;
				}
				if($arrCountProp->status == 1) {
					$to_be_renovated++;
				} 
				if($arrCountProp->status == 2) {
					$good++;
				}
				if($arrCountProp->status == 3) {
					$renovated++;
				}
				if($arrCountProp->status == 4) {
					$new_under_construction++;
				}
			}
		}
		$selected_typology = 0;
		if( isset ( $_GET['typology'] ) ) {			
			$cnt = 0;
			for($i=0 ;$i< count( $_GET['typology'] ); $i++) {
				if( $cnt == 0 ) {
					$selected_typology = $_GET['typology'][$i];
					$cnt++;
				} else {
					$selected_typology = $selected_typology.",".$_GET['typology'][$i];
				}
			}
		}
		?>
		<div class="filter_id">
			<input type="hidden" id="selected_typology" value="<?php echo isset( $selected_typology ) ? $selected_typology : 0; ?>" >
			<ul>
				<li id="login">
					<a id="login-trigger" href="javascript:void(0);">
						<?php echo $this->lang->line('search_header_basic_filter');?>
						<span style="font-size:10px; padding-left:5px;"><?php echo '&#x25BC;';?></span>
					</a>
					<div id="login-content" class="dp-content">
						<div class="basic_div_part">
							<table width="100%">	
							<?php
								$for_sale_val = 0;
								$for_rent_val = 0;
								$for_all_val = 0;
								$by_agency_val = 0;
								$by_owner_val = 0;
								$by_all_val = 0;
								$to_be_renovated_val = 0;
								$good_val = 0;
								$renovated_val = 0;
								$new_under_construction_val = 0;
								if( isset ( $_GET['contract_type'] ) ) {
									$contract_type = $_GET['contract_type'];
									if($contract_type == 'all'){
										$for_all_val = 'all';
									}
									if( count($contract_type) > 0 ) {
										if( count($contract_type) == 1 ) {
											if( $contract_type[0] == 1 ) {
												$for_rent_val = $contract_type[0];
											} 
											if( $contract_type[0] == 2 ) {
												$for_sale_val = $contract_type[0];
											}
										} else {
											$for_sale_val = isset( $contract_type[0] ) ? $contract_type[0] : 0;
											$for_rent_val = isset( $contract_type[1] ) ? $contract_type[1] : 0;	
										}
									}
								}
								if( isset ( $_GET['posted_by'] ) ) {
									$posted_by = $_GET['posted_by'];
									if($posted_by == 'all'){
										$by_all_val = 'all';
									}
									if( count($posted_by) > 0 ) {
										if( count($posted_by) == 1 ) {
											if( $posted_by[0] == 3 ) {
												$by_agency_val = $posted_by[0];
											}
											if( $posted_by[0] == 2 ) {
												$by_owner_val = $posted_by[0];
											}
										} else {
											$by_agency_val = isset( $posted_by[0] ) ? $posted_by[0] : 0;
											$by_owner_val = isset( $posted_by[1] ) ? $posted_by[1] : 0;
										}
									}
								}
								if( isset ( $_GET['status'] ) ) {
									$status = $_GET['status'];
									if( count($status) > 0 ) {
										foreach($status as  $arrStat){
											if( $arrStat == 1 ) {
												$to_be_renovated_val = $arrStat;
											}
											if( $arrStat == 2 ) {
												$good_val = $arrStat;
											}
											if( $arrStat == 3 ) {
												$renovated_val = $arrStat;
											}
											if( $arrStat == 4 ) {
												$new_under_construction_val = $arrStat;
											}
										}
										/*if( count($status) == 1 ) {
											if( $status[0] == 1 ) {
												$to_be_renovated_val = $status[0];
											}
											if( $status[0] == 2 ) {
												$good_val = $status[0];
											}
											if( $status[0] == 3 ) {
												$renovated_val = $status[0];
											}
											if( $status[0] == 4 ) {
												$new_under_construction_val = $status[0];
											}
										} else {
											$to_be_renovated_val = isset( $status[0] ) ? $status[0] : 0;
											$good_val = isset( $status[1] ) ? $status[1] : 0;
											$renovated_val = isset( $status[2] ) ? $status[2] : 0;
											$new_under_construction_val = isset( $status[3] ) ? $status[3] : 0;
										}*/
									} else {
										$to_be_renovated_val = isset( $status[0] ) ? $status[0] : 0;
										$good_val = isset( $status[1] ) ? $status[1] : 0;
										$renovated_val = isset( $status[2] ) ? $status[2] : 0;
										$new_under_construction_val = isset( $status[3] ) ? $status[3] : 0;
									}
								}
								if($category_id != 3){
								?>
								<tbody>
									<tr>
										<td>
											<span><input type="radio" id="contract" name="contract_type" value="all" <?php if( $for_all_val == 'all' ) { echo "checked"; } ?> /></span> 
											<span><img src="<?php echo base_url();?>assets/images/orenge_mark.png" alt="" /></span>
											<span><img src="<?php echo base_url();?>assets/images/blue_mark.png" alt="" /></span>
											<span> <?php echo $this->lang->line('search_header_all_contract_type');?></span>
										</td>
										<td class="basic_imount">( <?php echo $for_sale + $for_rent; ?> )</td>
									</tr>
								</tbody>
								<tbody>
									<tr>
										<td>
											<span><input type="radio" id="contract" name="contract_type" value="2" <?php if( $for_sale_val != 0 ) { echo "checked"; } ?>/></span> 
											<span><img src="<?php echo base_url();?>assets/images/orenge_mark.png" alt="" /></span>
											<span> <?php echo $this->lang->line('search_header_for_sale');?></span>
										</td>
										<td class="basic_imount">( <?php echo $for_sale; ?> )</td>
									</tr>
								</tbody>
								<?php
								}
								if($category_id == 3){
									$style="style='display:none';";
									$check="checked='checked'";
								}else{
									$style="";
									$check=""; 
								}
								?>
								<tbody <?php echo $style;?>>
									<tr>
										<td>
											<span><input type="radio" id="contract" name="contract_type" value="1" onclick="return check_param();" <?php echo $check;?> <?php if( $for_rent_val != 0 ) { echo "checked"; } ?>/></span> 
											<span><img src="<?php echo base_url();?>assets/images/blue_mark.png" alt="" /></span>
											<span><?php echo $this->lang->line('search_header_for_rent');?></span>
										</td>
										<td class="basic_imount">( <?php echo $for_rent; ?> )</td>
									</tr>
								</tbody>
								<tbody>
									<tr>
										<td>
											<span><input type="radio" name="posted_by" value="all" <?php if( $by_all_val == 'all' ) { echo "checked"; } ?> /></span> 
											<span><?php echo $this->lang->line('search_header_by_all_advertisers');?></span>
										</td>
										<td class="basic_imount">( <?php echo $by_agency + $by_owner; ?> )</td>
									</tr>
								</tbody>
								<tbody>
									<tr>
										<td>
											<span><input type="radio" name="posted_by" value="3" <?php if( $by_agency_val != 0 ) { echo "checked"; } ?> /></span> 
											<span><?php echo $this->lang->line('search_header_by_agency');?></span>
										</td>
										<td class="basic_imount">( <?php echo $by_agency; ?> )</td>
									</tr>
								</tbody>
								<tbody>
									<tr>
										<td>
											<span><input type="radio" name="posted_by" value="2" <?php if( $by_owner_val != 0 ) { echo "checked"; } ?>/></span>
											<span><?php echo $this->lang->line('search_header_by_owner');?></span>
										</td>
										<td class="basic_imount">( <?php echo $by_owner; ?> )</td>
									</tr>
								</tbody>								
							<?php 
							if($category_id == 1 || $category_id == 5){
								$rs_statuses=get_all_value('zc_status_of_property');
								?>
								<tbody>
									<tr>
										<td colspan="2"><hr></td>
									</tr>
								</tbody>
								<?php
								foreach($rs_statuses as $rs_status){
								?>
								<tbody>
									<tr>
										<td>
											<span>
												<input type="checkbox" name="status[]" value="<?php echo $rs_status['id'];?>"
												<?php 
												if( $rs_status['id'] == 1 ) {
													if( $to_be_renovated_val != 0 ) { echo "checked"; }
												}
												if( $rs_status['id'] == 2 ) {
													if( $good_val != 0 ) { echo "checked"; }
												} 
												if( $rs_status['id'] == 3 ) {
													if( $renovated_val != 0 ) { echo "checked"; }
												} 
												if( $rs_status['id'] == 4 ) {
													if( $new_under_construction_val != 0 ) { echo "checked"; }
												}
								?> 
												/>
											</span> 
											<span><?php if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {echo $rs_status['name'];}else{echo $rs_status['name_it'];}?></span>
										</td>
										<td class="basic_imount">
											( <?php
											if( $rs_status['id'] == 1 ) {
											echo $to_be_renovated;
											} if( $rs_status['id'] == 2 ) {
											echo $good;
											} if( $rs_status['id'] == 3 ) {
											echo $renovated;
											} if( $rs_status['id'] == 4 ) {
											echo $new_under_construction;
											}
											?> )
										</td>
									</tr>
								</tbody>
								<?php
										}
									}
								?>

							</table>
						</div>
					</div>
				</li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<div class="customsearch">
		<div class="filter_id">
			<ul>
				<li id="login">
					<a id="login-trigger2" href="javascript:void(0);"><?php echo $this->lang->line('search_header_any_price');?><span style="font-size:10px; padding-left:5px;">▼</span></a>
					<div id="login-content2" class="dp-content">
						<div class="basic_div_part" style="padding:0;">
							<fieldset id="inputs">
								<p style="margin:0 0 3px 0"><?php echo $this->lang->line('search_header_any_price_min');?></p>
								<input type="text" placeholder="<?php echo $this->lang->line('search_header_any_price_min');?>" name="min_price" id="min_price" value="<?php echo (isset($min_price) && $min_price != 0) ? $min_price : ''; ?>" class="groupOfCurrencyBox">
								<p style="margin:0 0 3px 0"><?php echo $this->lang->line('search_header_any_price_max');?></p>
								<input type="text" placeholder="<?php echo $this->lang->line('search_header_any_price_max');?>" name="max_price" id="max_price" value="<?php echo (isset($max_price) && $max_price != 0) ? $max_price : ''; ?>" class="groupOfCurrencyBox">
							</fieldset>
						</div>
					</div>
				</li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<?php
	if($category_id != 3 && $category_id != 4){
	?>
	<div class="customsearch">
		<div class="filter_id">
			<ul>
				<li id="login">
					<a id="login-trigger3" href="javascript:void(0);"><?php echo $this->lang->line('search_header_rooms_number');?><span style="font-size:10px; padding-left:5px;">▼</span></a>
					<div id="login-content3" class="dp-content">
						<div class="basic_div_part">
							<fieldset id="inputs">
								<input type="text" placeholder="<?php echo $this->lang->line('search_header_rooms_number_min');?>" name="min_room" id="min_room" value="<?php echo (isset($min_room) && $min_room != 0) ? $min_room : ''; ?>" class="groupOfTexbox" >
								<input type="text" placeholder="<?php echo $this->lang->line('search_header_rooms_number_max');?>" name="max_room" id="max_room" value="<?php echo (isset($max_room) && $max_room != 0) ? $max_room : ''; ?>" class="groupOfTexbox" >
							</fieldset>
						</div>
					</div>
				</li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<?php
	}
	?>
	<div class="customsearch">
		<div class="filter_id">
			<ul>
				<li id="login">
					<a id="login-trigger4" href="javascript:void(0);">
						<?php echo $this->lang->line('search_header_typology');?><span style="font-size:10px; padding-left:5px;">▼</span>
					</a>
					<div id="login-content4" class="dp-content">
						<div class="basic_div_part" style="overflow-y: scroll; height:200px;">
							<div id="typology">
							<?php
							if($category_id == 2 || $category_id == 6 || $category_id == 7) {
								?>
								<fieldset id="inputs">
									<select name="for_business" id="for_business" onchange="return typology_adjustment(this.value, '');" style="width:223px;">
										<option value=""><?php echo $this->lang->line('search_header_typology_business_select');?></option>
										<option value="PRO" <?php if($category_id == 6) { echo "selected"; }?> ><?php echo $this->lang->line('search_header_typology_business_property_for_business');?></option>
										<option value="BLI" <?php if($category_id == 7) { echo "selected"; }?> ><?php echo $this->lang->line('search_header_typology_business_business_license');?></option>
									</select>
								</fieldset>
								<?php
							}
							if($category_id == 10) {
								?>
								<fieldset id="inputs">
									<select name="for_luxury" id="for_luxury" onchange="return typology_adjustment(this.value, '');" style="width:223px;">
										<option value=""><?php echo $this->lang->line('search_header_typology_luxury_select');?></option>
										<option value="RES" <?php if( isset( $_GET['for_luxury'] ) &&( "RES" == $_GET['for_luxury'] ) ) { echo "selected"; }?> ><?php echo $this->lang->line('search_header_typology_luxury_residential');?></option>
										<option value="PRO" <?php if( isset( $_GET['for_luxury'] ) &&( "PRO" == $_GET['for_luxury'] ) ) { echo "selected"; }?> ><?php echo $this->lang->line('search_header_typology_luxury_property_for_business');?></option>
										<option value="BLI" <?php if( isset( $_GET['for_luxury'] ) &&( "BLI" == $_GET['for_luxury'] ) ) { echo "selected"; }?> ><?php echo $this->lang->line('search_header_typology_business_license');?></option>
										<option value="VAC" <?php if( isset( $_GET['for_luxury'] ) &&( "VAC" == $_GET['for_luxury'] ) ) { echo "selected"; }?> ><?php echo $this->lang->line('search_header_typology_luxury_vacations');?></option>
									</select>
								</fieldset>
								<?php
								}
							?>
							</div>
							<div id="typologys"></div>
						</div>
					</div>
				</li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>	
	<div class="customsearch">
		<div class="filter_id">
			<ul>
				<li id="login">
					<a id="login-trigger5" href="javascript:void(0);"><?php echo $this->lang->line('search_header_more');?><span style="font-size:10px; padding-left:5px;">▼</span></a>
					<div id="login-content5" class="dp-content">
						<div class="basic_div_part">
							<table width="100%">
							<?php
							if($category_id != 3 && $category_id != 2 && $category_id != 4){
							?>
							<tr>
								<td><?php echo $this->lang->line('search_header_bathrooms');?></td>
								<td>
							<?php 
							if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
								$bathroomArray = array('all'=>'All','No'=>'No','1'=>'1','2'=>'2','3'=>'3','>3'=>'>3'); 
							}else{
								$bathroomArray = array('all'=>'Qualsiasi','No'=>'No','1'=>'1','2'=>'2','3'=>'3','>3'=>'>3'); 
							}
							?>
									<fieldset id="inputs">
										<select style="width:137px;" name="bathrooms_no">
											<?php foreach( $bathroomArray as $key=>$val) {?>
											<option value="<?php echo $key; ?>" <?php if( isset( $_GET['bathrooms_no'] ) &&( $key == $_GET['bathrooms_no'] ) ) { echo "selected"; }?> ><?php echo $val; ?></option>
											<?php } ?>
										</select>
									</fieldset>
								</td>
							</tr>
							<?php
							}
?>
<?php
if($category_id != 3)
{
?>
<tr>
<td>
<?php echo $this->lang->line('search_header_square_meters');?>
</td>
<td>
<fieldset id="inputs">
<input type="text"  placeholder="Min" name="min_surface_area" id="min_surface_area"  style="width:50px;" value="<?php echo isset( $_GET['min_surface_area'] ) ? $_GET['min_surface_area'] : '';?>" class="groupOfTexbox">
-
<input type="text"  placeholder="Max" name="max_surface_area" id="max_surface_area" style="width:50px;" value="<?php echo isset( $_GET['max_surface_area'] ) ? $_GET['max_surface_area'] : '';?>" class="groupOfTexbox" >
</fieldset>    
</td>
</tr>
<?php
}

if($category_id == 5)
{
?>
<tr>
<td>
<?php echo $this->lang->line('search_header_bed_no');?> 
</td>
<td>
<fieldset id="inputs">
<input type="text" placeholder="Min" name="min_beds_no" id="min_beds_no" style="width:50px;" value="<?php echo isset( $_GET['min_beds_no'] ) ? $_GET['min_beds_no'] : '';?>" class="groupOfTexbox" >
-
<input type="text" placeholder="Max" name="max_beds_no" id="max_beds_no"  style="width:50px;" value="<?php echo isset( $_GET['max_beds_no'] ) ? $_GET['max_beds_no'] : '';?>" class="groupOfTexbox" >
</fieldset>    
</td>
</tr>
<?php
}
?>
<?php
if($category_id != 3)
{
?> 
<tr>
<td>
<?php echo $this->lang->line('search_header_kind_of_property');?>
</td>
<td>
<?php $kind_of_propertys=get_all_value('zc_kind_of_property');?>
<fieldset id="inputs">
<select style="width:137px;" name="kind">
<option value="all" <?php if( isset( $_GET['kind'] ) &&( $_GET['kind'] == "all" ) ) { echo "selected"; }?> ><?php echo $this->lang->line('search_header_kind_of_property_all');?></option>
<?php
foreach($kind_of_propertys as $kind_of_property)
{
	if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
?>
<option value="<?php echo $kind_of_property['id'];?>"  <?php if( isset( $_GET['kind'] ) &&( $kind_of_property['id'] == $_GET['kind'] ) ) { echo "selected"; }?> ><?php echo $kind_of_property['name'];?></option>
<?php
	}else{
?>
<option value="<?php echo $kind_of_property['id'];?>"  <?php if( isset( $_GET['kind'] ) &&( $kind_of_property['id'] == $_GET['kind'] ) ) { echo "selected"; }?> ><?php echo $kind_of_property['name_it'];?></option>
<?php
	}
}
?>
</select>
</fieldset>     
</td>
</tr>
<?php
}
?>
<?php
if($category_id != 3 && $category_id != 4)
{
?>
<tr>
<td>
<?php echo $this->lang->line('search_header_energy_class');?> 
</td>
<td>
<?php $energy_classes=get_all_value('zc_energy_efficiency_class');?>
<fieldset id="inputs">
<select style="width:137px;" name="energyclass">
<option value="all" <?php if( isset( $_GET['energyclass'] ) &&( $_GET['energyclass'] == "all" ) ) { echo "selected"; }?> ><?php echo $this->lang->line('search_header_energy_class_all');?> </option>
<?php
foreach($energy_classes as $energy_class)
{
?>
<option value="<?php echo $energy_class['id'];?>" <?php if( isset( $_GET['energyclass'] ) &&( $energy_class['id'] == $_GET['energyclass'] ) ) { echo "selected"; }?> >
<?php 
	if($energy_class['id'] == "0"){
		if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
			echo $energy_class['name'];
		}else{
			echo 'Non classificato';
		}
	}else{
		echo $energy_class['name'];
	}
?>
</option>
<?php
}
?>
</select>
</fieldset>    
</td>
</tr>

<?php
}
?>
<?php
if($category_id==1)
{
?>
<tr>
<td>
<?php echo $this->lang->line('search_header_heating');?> 
</td>
<td>
<?php 	 
	if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
		$heatingArray = array('all'=>'All','No'=>'No','Autonomous'=>'Autonomous','Centralized'=>'Centralized');
	}else{
		$heatingArray = array('all'=>'Qualsiasi','No'=>'No','Autonomous'=>'Autonomo','Centralized'=>'Centralizzato');
	}
?>
<fieldset id="inputs">
<select style="width:137px;" name="heating">
<?php foreach( $heatingArray as $key=>$val) {?>
<option value="<?php echo $key; ?>" <?php if( isset( $_GET['heating'] ) &&( $key == $_GET['heating'] ) ) { echo "selected"; }?> ><?php echo $val; ?></option>
<?php } ?>
</select>
</fieldset>     
</td>
</tr>
<?php
}
?>
<?php
if($category_id==3 || $category_id==1 || $category_id==2 || $category_id==6 || $category_id==7 || $category_id==5)
{
?>
<tr>
<td>
<?php echo $this->lang->line('search_header_parking');?> 
</td>
<td>
<?php 	 
	if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
		$parkingArray = array('all'=>'All','No'=>'No','Cargarage'=>'Car garage','Parking'=>'Parking');
	}else{
		$parkingArray = array('all'=>'Qualsiasi','No'=>'No','Cargarage'=>'Box auto','Parking'=>'Posto auto');
	}
?>
<fieldset id="inputs">
<select style="width:137px;" name="parking">
<?php foreach( $parkingArray as $key=>$val) {?>
<option value="<?php echo $key; ?>" <?php if( isset( $_GET['parking'] ) &&( $key == $_GET['parking'] ) ) { echo "selected"; }?> ><?php echo $val; ?></option>
<?php } ?>
</select>
</fieldset>     
</td>
</tr>
<?php
}
?>  
<?php
if($category_id==3 || $category_id==1 || $category_id==6 || $category_id==7)
{
?>
<tr>
<td>
<?php echo $this->lang->line('search_header_furnished');?> 
</td>
<td>
<?php 	
	if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
		$furnishedArray = array('all'=>'All','No'=>'No','Yes'=>'Yes','Partly'=>'Partly'); 
	}else{
		$furnishedArray = array('all'=>'Qualsiasi','No'=>'No','Yes'=>'sì','Partly'=>'Parzialmente');
	}
?>
<fieldset id="inputs">
<select style="width:137px;" name="furnished">
<?php foreach( $furnishedArray as $key=>$val) {?>
<option value="<?php echo $key; ?>" <?php if( isset( $_GET['furnished'] ) &&( $key == $_GET['furnished'] ) ) { echo "selected"; }?> ><?php echo $val; ?></option>
<?php } ?>
</select>
</fieldset>     
</td>
</tr>
<?php
}
?>
<?php
if($category_id==3)
{
?>
<tr>
<td>
<?php echo $this->lang->line('search_header_roommates');?> 
</td>
<td>
<?php 	 
	if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
		$roommatesArray = array('all'=>'All','Only women'=>'Only women','Only Men'=>'Only Men','Men and women'=>'Men and women');
	}else{
		$roommatesArray = array('all'=>'Qualsiasi','Only women'=>'Solo donne','Only Men'=>'Solo uomini','Men and women'=>'Uomini e donne');
	}
?>
<fieldset id="inputs">
<select style="width:137px;" name="roommates">
<?php foreach( $roommatesArray as $key=>$val) {?>
<option value="<?php echo $key; ?>" <?php if( isset( $_GET['roommates'] ) &&( preg_replace('/\s+/','', $key ) == preg_replace('/\s+/','', urldecode($_GET['roommates'])) ) ) { echo "selected"; }?> ><?php echo $val; ?></option>
<?php } ?>
</select>
</fieldset>     
</td>
</tr>
<tr>
<td>
<?php echo $this->lang->line('search_header_occupation');?>
</td>
<td>
<?php 	
	if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
		$occupationArray = array('all'=>'All','Only students'=>'Only students','Only workers'=>'Only workers','Students and workers'=>'Students and workers'); 
	}else{
		$occupationArray = array('all'=>'Qualsiasi','Only students'=>'Solo studenti','Only workers'=>'Solo lavoratori','Students and workers'=>'Studenti e lavoratori');
	}
?>
<fieldset id="inputs">
<select style="width:137px;" name="occupation">
<?php foreach( $occupationArray as $key=>$val) {?>
<option value="<?php echo $key; ?>" <?php if( isset( $_GET['occupation'] ) &&( $key == $_GET['occupation'] ) ) { echo "selected"; }?> ><?php echo $val; ?></option>
<?php } ?>
</select>
</fieldset> 
</td>
</tr>
<?php }?>
</table>    
</div>
<?php
if($category_id != 4 &&  $category_id != 10 )
{
?>
<div class="basic_div_part">
<hr>

<?php echo $this->lang->line('search_header_show_only_with');?>
<table width="100%">
<?php
if($category_id==3)
{
?>
<tr>
<td>
<span><input type="checkbox" name="smokers" value="1" <?php if( isset( $_GET['smokers'] ) &&( $_GET['smokers'] == "1" ) ) { echo "checked"; }?> /></span> 
<span><?php echo $this->lang->line('search_header_smokers_allowed');?></span>
</td>
</tr>
<tr>
<td>
<span><input type="checkbox" name="pets" value="1" <?php if( isset( $_GET['pets'] ) &&( $_GET['pets'] == "1" ) ) { echo "checked"; }?> /></span> 
<span><?php echo $this->lang->line('search_header_pets_allowed');?></span>
</td>
</tr>

<?php
}
?>
<?php
if($category_id==5 || $category_id==6 || $category_id==7 || $category_id==1 || $category_id==2)
{
?>
<tr>
<td>
<span><input type="checkbox" name="elevator" value="1" <?php if( isset( $_GET['elevator'] ) &&( $_GET['elevator'] == "1" ) ) { echo "checked"; }?> /></span> 
<span><?php echo $this->lang->line('search_header_elevator');?></span>
</td>
</tr>
<?php
}
?>   
<?php
if($category_id==5 || $category_id==1)
{
?>



<tr>
<td>
<span><input type="checkbox" name="air_conditioning" value="1" <?php if( isset( $_GET['air_conditioning'] ) &&( $_GET['air_conditioning'] == "1" ) ) { echo "checked"; }?> /></span> 
<span><?php echo $this->lang->line('search_header_air_conditioning');?></span>
</td>
</tr>
<tr>
<td>
<span><input type="checkbox" name="garden" value="1" <?php if( isset( $_GET['garden'] ) &&( $_GET['garden'] == "1" ) ) { echo "checked"; }?> /></span> 
<span><?php echo $this->lang->line('search_header_garden');?></span>
</td>
</tr>
<tr>
<td>
<span><input type="checkbox" name="terrace" value="1" <?php if( isset( $_GET['terrace'] ) &&( $_GET['terrace'] == "1" ) ) { echo "checked"; }?> /></span> 
<span><?php echo $this->lang->line('search_header_terrace');?></span>
</td>
</tr>
<?php
}
?> 
<?php
if($category_id==5 || $category_id==1 || $category_id == 3)
{
?> 
<tr>
<td>
<span><input type="checkbox" name="balcony" value="1" <?php if( isset( $_GET['balcony'] ) &&( $_GET['balcony'] == "1" ) ) { echo "checked"; }?> /></span> 
<span><?php echo $this->lang->line('search_header_balcony');?></span>
</td>
</tr>
<?php
}
?>    

</table>    
</div>
<?php }?>

</div>                     
</li>
</ul>
<div class="clear"></div>
</div>
</div>

<?php
if($category_id==3)
{
?>
<div class="bottom_btnbar" style="float:right;margin-top:-1px;">
<input type="submit" name="search" value="<?php echo $this->lang->line('search_header_button_search');?>">
<!--<input type="button"  id="save_search" name="search" value="Save Search" >-->

<?php
if($this->session->userdata( 'user_id' )!='' || $this->session->userdata('user_id')!='0')
{
?>
<a class="save_search" href="javascript:void(0);"><?php echo $this->lang->line('search_header_save_search');?></a>
<?php
}
else
{
?>
<a class="save_search_poup" href="javascript:void(0);"><?php echo $this->lang->line('search_header_save_search');?></a>
<?php
}
?>
</div>
<?php
}
else
{
?>
<div class="bottom_btnbar" style="float:right;margin-top:-10px;">
<input type="submit" name="search" value="<?php echo $this->lang->line('search_header_button_search');?>">
<?php
if($this->session->userdata( 'user_id' )!='' || $this->session->userdata('user_id')!='0') {
?>
<a class="save_search" href="javascript:void(0);"><?php echo $this->lang->line('search_header_save_search');?></a>
<?php
} else {
?>
<a class="save_search_poup" href="javascript:void(0);"><?php echo $this->lang->line('search_header_save_search');?></a>
<?php
}
?>
</div>
<?php
}
?>
<?php $segs = $this->uri->segment_array();?>
<input type="hidden" name="category_search" value="<?php if(isset($search_title)){ echo $search_title;}else{echo $segs[1];}?>" />
<input type="hidden" id="segment_name" value="<?php if(isset($search_title)){ echo $search_title;}else{echo $segs[1];}?>" />
<!-- <input type="hidden" name="ordering_opt" id="ordering_opt" value=""> -->
</div>


