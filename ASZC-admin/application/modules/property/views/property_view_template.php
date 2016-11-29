<?php $this->load->view('inc/header.php'); ?>
<style type="text/css">
.success{margin-bottom:10px; background-color:#006868; color:#ffea52; border:#CCC solid 1px; text-align:center;}
.editbtn{padding-right:18px !important;}
.btn-success.suspended {background-color: #ff9600;color: #000000;}
.btn-success.suspended.btn-icon i{background-color: #cc7800;}
.btn-success.inactive {background-color: #ddbebe;color: #000000;}
.btn-success.inactive.btn-icon i{background-color: #A08282;}
.makefeature{background:#90b6ce}
.makefeature i{background:#50809E !important}
.btn-info.inactive {background-color: #ddbebe;color: #000000;}
.btn-info.inactive.btn-icon i{background-color: #A08282;}
.filterTbl{color: #0859db;display: table;float: left;font-weight: bold;line-height: 26px;margin-bottom: 15px;}
.filterTbl a{display: table-cell;padding: 0 5px;}
.filterTbl a.selected{text-decoration:underline;}
.filterTbl a:first-child{color:#666666;}
.lblReq {color: red;margin: 0 0 0 10px;}
.propertyName .img {float: left;width: 100px;}
.propertyName .img img {height: 100px;width: 100px;}
.propertyName .title {float: right;width: 300px;}
.propertyName .title h5 {font-size: 12px;font-weight: bold;margin: 0;}
.propertyName .title h6 {margin: 0;}
.propertyName .title p {color: #999999;margin: 0;}
</style>
<div class="main-content">
	<div class="row">
		<!-- Profile Info and Notifications -->
		<div class="col-md-6 col-sm-8 clearfix">
			<h3>View Property</h3>
			<h5>
				<a href="<?php echo base_url();?>property/edit_property_details/<?php echo $property_details[0]['property_id']; ?>" class="btn btn-default btn-icon btn-xs" title="Click here to edit the property">
					<i class="entypo-pencil"></i>Edit Property
				</a>
				<?php
				if($property_details[0]['property_status']=='2'){
					$activeStatus = 'Published&nbsp;&nbsp;&nbsp;';
					$btn_class = "";
					$css_class = "entypo-flash";
					$statusURL = 'data-toggle="modal" data-target="#proSusModal" href="javascript:void(0);"';
				}                    
				if($property_details[0]['property_status']=='1'){
					$activeStatus ='Drafted&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
					$btn_class = "inactive";
					$css_class = "entypo-pause";
					$statusURL = 'href="javascript:void(0);"';
				}
				if($property_details[0]['suspention_status']=='1'){
					$activeStatus = 'Inactive';
					$btn_class = "suspended";
					$css_class = "entypo-pause";
					$statusURL = 'href="'.base_url()."property/pro_view_st_change/".$property_details[0]['property_id'].'"';
				}
				?>
				<a <?php echo $statusURL;?> class="btn btn-success <?php echo $btn_class; ?> btn-sm btn-icon btn-xs">
					<i class="<?php echo $css_class; ?>"></i><?php echo $activeStatus; ?>
				</a>
				<?php
				$featuredLink = '<a href="'.base_url()."property/make_featured/".$property_details[0]['property_id'].'/all/all" class="btn btn-blue btn-sm btn-icon btn-xs">
									<i class="entypo-back-in-time"></i>Feature&nbsp;&nbsp;
								 </a>';
				$featureStatus = get_perticular_field_value('zc_property_featured','status'," and property_id='".$property_details[0]['property_id']."'");
				if($featureStatus == 1){
					$todayDate = strtotime(date('Y-m-d'));
					$startDate = get_perticular_field_value('zc_property_featured','start_date'," and property_id='".$property_details[0]['property_id']."'");
					$expDateLength = get_perticular_field_value('zc_property_featured','number_of_days'," and property_id='".$property_details[0]['property_id']."'");
					$expireDate = strtotime(date('Y-m-d', strtotime($startDate . " +".$expDateLength." days")));
					if($todayDate < $expireDate){
						$featuredLink = '<a href="'.base_url()."property/".($property_details[0]['feature_status']==0?'property_feature_resume':'property_feature_suspend')."/".$property_details[0]['property_id'].'/all/all" class="btn btn-'.($property_details[0]['feature_status']==0?'gold':'red').' btn-sm btn-icon btn-xs">
											<i class="entypo-back-in-time"></i>'.($property_details[0]['feature_status']==0?'Resume':'Suspend').'
										 </a>';
					}
				}
				echo $featuredLink;
				?>
			</h5>
		</div>
		<!-- Raw Links -->
		<div class="col-md-6 col-sm-4 clearfix hidden-xs">
			<ul class="list-inline links-list pull-right">
				<li class="sep"></li>
				<li>
					<a href="<?php echo site_url('/dashboard/logout/'); ?>" title="Logout">
						Log Out <i class="entypo-logout right"></i>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<hr>
	<?php
	if($this->session->flashdata('success')){
	?>
	<div class="success">
		<?php echo $this->session->flashdata('success'); ?>
	</div>
	<?php
	}
	?>
	<div class="error" id="error_msg" style="text-align:center;">
		<?php echo $this->session->flashdata('msg_flash');?>
	</div>
	<div class="jumbotron">
		<?php
		$property_name="";
		if($property_details[0]['contract_id']==1){
			$contract="Rent For";
		}
		if($property_details[0]['contract_id']==2){
			$contract="Sell For";
		}
		$property_name.=$contract;
		$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$property_details[0]['typology']."'");
		$property_name.=' '.stripslashes($typology_name);
		
		
		$name=get_perticular_field_value('zc_contract_types','name'," and contract_id='".$property_details[0]['contract_id']."'");
		$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$property_details[0]['typology']."'");
		$city_name=get_perticular_field_value('zc_city','city_name'," and city_id='".$property_details[0]['city']."'");
		$province_code=get_perticular_field_value('zc_region_master','province_code'," and city='".mysql_real_escape_string($city_name)."'");
		
		$proptitle = $name." For ".stripslashes($typology_name)." in ".$city_name.", ".$province_code;
		?>
		<h1>
			<?php echo stripslashes($proptitle); ?>
		</h1><br/>
		<h2>
			Short description of the property
		</h2>
		<p>
			<?php echo nl2br($property_details[0]['description']);?>
		</p>
		<h2>
			<b>Address:</b>
		</h2>
		<label>
			<?php echo nl2br($property_details[0]['street_address']);?>
		</label>
		<label>
			<?php echo $property_details[0]['street_no']?>
		</label>
		<label>
			<?php if($property_details[0]['zip']!=''){ echo ','.$property_details[0]['zip'];}?>
		</label>
		<?php
		if($property_details[0]['area']!=''){
			echo '<br/><label><b>Area :</b> '.$property_details[0]['area'].'</label>';
		}
		if($property_details[0]['private_nagotiation']!='0'){
			echo '<br/><label> Private Nagotiation </label>';
		}
		if($property_details[0]['private_nagotiation']=='0'){
			echo '<br/><label><b>Price :</b> '.$property_details[0]['price'].'</label><br>';
		}
		?>
		<label>
			<b>Published on </b>
			<?php echo $property_details[0]['posting_time']; ?> By 
			<b>
				<?php echo get_perticular_field_value('zc_user','first_name'," and user_id='".$property_details[0]['property_post_by']."'"); ?>
				<?php echo get_perticular_field_value('zc_user','last_name'," and user_id='".$property_details[0]['property_post_by']."'"); ?>
			</b>
		</label>
		<?php
		if($property_details[0]['suspention_status']=='1' && $property_details[0]['blocked_note']!=''){
		?>
		<h4>
			<b>Blocked Note:</b>
		</h4>
		<p style="color:red;">
			<?php echo stripslashes($property_details[0]['blocked_note']); ?>
		</p>
		<?php
		}
		?>
	</div>
	<div class="row">
		<div class="col-md-6">
			<h2>Main Features</h2>
			<div class="column">
				<ul>
					<li>
						<span>Typology</span>:
						<?php
						$typologyName = get_perticular_field_value('zc_typologies','name'," and status='active' AND typology_id='".$property_details[0]['typology']."'");
						echo stripslashes($typologyName);
						?> 
					</li>
					<li>
						<span>Status</span>: 
						<?php echo get_perticular_field_value('zc_status_of_property','name'," and id='".$property_details[0]['status']."'"); ?>
					</li>
					<li>
						<span>Kind</span>: 
						<?php echo get_perticular_field_value('zc_kind_of_property','name'," and id='".$property_details[0]['kind']."'") ;?>
					</li>
					<li>
						<span>Energy Class</span>:
						<?php echo get_perticular_field_value('zc_energy_efficiency_class','name'," and id='".$property_details[0]['energyclass']."'") ;?>
					</li>
				</ul>
			</div>
			<div class="column">
				<ul>
					<li><span>Surface Area</span>: <?php echo $property_details[0]['surface_area']; ?></li>
					<li><span>Room No</span>: <?php echo $property_details[0]['room_no']; ?></li>
					<li><span>Floor</span>: <?php echo $property_details[0]['floor']; ?></li>
					<li><span>Total Floors</span>: <?php echo $property_details[0]['total_of_floors']; ?></li>
				</ul>
			</div>
			<div class="column">
				<ul>
					<li><span>Year of Building</span>: <?php echo $property_details[0]['year_of_building']; ?></li>
					<li><span>Beds</span>: <?php echo $property_details[0]['beds_no']; ?></li>
					<li><span>Bathrooms No</span>: <?php echo $property_details[0]['bathrooms_no']; ?></li>
					<li><span>Kitchen</span>: <?php echo $property_details[0]['kitchen']; ?></li>
				</ul>
			</div>
			<div class="column">
				<ul>
					<li><span>Heating</span>: <?php echo $property_details[0]['heating']; ?></li>
					<li><span>Parking</span>: <?php echo $property_details[0]['parking']; ?></li>
					<li><span>Roommates</span>: <?php echo $property_details[0]['roommates']; ?></li>
					<li><span>Occupation</span>: <?php echo $property_details[0]['occupation']; ?></li>
				</ul>
			</div>
			<div class="column">
				<ul>
					<li><span>Furnished</span>: <?php echo $property_details[0]['furnished']; ?></li>
					<li><span>Availability</span>: <?php echo $property_details[0]['availability']; ?></li>
					<li><span>Smokers</span>: <?php echo $property_details[0]['smokers']; ?></li>
					<li><span>Pets</span>: <?php echo $property_details[0]['pets']; ?></li>
				</ul>
			</div>
		</div>
		<div class="col-md-6">
			<h2>Additional Features</h2>
			<div class="column">
				<ul>
					<li><span>Air conditioning</span>: 
						<?php if($property_details[0]['air_conditioning']==0){ echo 'No';} else{ echo 'Yes' ;} ?>
					</li>
					<li><span>Elevator</span>: 
						<?php if($property_details[0]['elevator']==0){echo 'No';} else{echo 'yes';} ?>
					</li>
					<li><span>Balcony</span>:
						<?php if($property_details[0]['balcony']==0){ echo 'No';}else{echo 'Yes';} ?>
					</li>
					<li><span>Terrace</span>: 
						<?php if($property_details[0]['terrace']==0){ echo 'No';} else{echo 'Yes'; } ?>
					</li>
					<li><span>Garden</span>:
						<?php if($property_details[0]['garden']==0){echo 'No';}else{echo 'Yes';} ?>
					</li>
				</ul>
			</div>
		</div>
		<div class="detailview">
			<div class="section1">
			</div>
			<div class="section1">
				<a class="btn btn-primary btn-lg" role="button" href="<?php echo base_url();?>property/property_image/<?php echo $this->uri->segment('3');?>">
				Go to Image Gallery
				</a>
			</div>
		</div>
	</div>
	<?php $this->load->view('inc/footer.php'); ?>
	<div class="modal fade" id="proSusModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h5 class="modal-title"><strong><?php echo stripslashes($proptitle); ?></strong></h5>
				</div>
				<div class="modal-body">
					<form class="BlockedProFrm" action="" method="post">								
						<div class="col-md-12">
							<div class="form-group no-margin">
								<label class="control-label blcknt" for="field-7">Property Suspended Note</label>
								<textarea name="blocked_note" class="form-control require" rows="5"></textarea>
							</div>
						</div>
						<div style="clear:both;padding:5px;"></div>
						<div class="col-md-12">
							<div class="form-group no-margin">
								<label class="control-label" for="field-7">&nbsp;</label>
								<input type="hidden" name="proid" value="<?php echo $property_details[0]['property_id']; ?>">
								<input type="submit" class="btn btn-success btn-sm pull-right" value="Submit">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>            
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$('.BlockedProFrm').submit(function(eFrm){
		if($(this).find('textarea[name="blocked_note"]').val()==''){
			$(this).find('.blcknt').append('<span class="lblReq">This field is required.</span>');
			$(this).find('textarea[name="blocked_note"]').focus();
			return false;		
		}else{
			var proid = $(this).find('input[name="proid"]').val();
			var blockednote = $(this).find('textarea[name="blocked_note"]').val();
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>property/status_change_ajx",
				data: {proid:proid,blockednote:blockednote},
				success: function(msg){
					location.reload();
				},error: function(){
					alert("there is something wrong");
				}
			});
		}	
		eFrm.preventDefault();
	});
	$(function(){
		setTimeout(function(){
			$(".lblReq").fadeOut(1500);
		}, 5000);
	});
	$(function(){
		setTimeout(function(){
			$(".post-message").hide();
		}, 5000);
	});
	</script>
