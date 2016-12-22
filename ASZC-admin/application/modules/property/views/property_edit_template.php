<?php $this->load->view('inc/header.php'); ?>
<script src="<?php echo frontend_path().'assets/js/jquery.price_format.2.0.js'; ?>" type="text/javascript"></script>
<style>
/*jquery error styles */
div.error{ float: left; color: red; padding-right: .5em;}
label.error{float: left; color: red; padding-right: .5em;}
#ssn{text-transform:uppercase}
.image-options .edit{position:relative;}
.image-options .edit input {cursor: pointer;height: 24px;opacity: 0;position: absolute;top: 0;width: 23px;}
.form-groups-bordered .form-group {border-bottom: 1px solid #ebebeb;margin-bottom: 0;padding-bottom: 15px;padding-top: 15px;}
.form-horizontal .control-label {font-weight: bold;}
.noperspective{perspective:none;}
.property-loader-box{display:none;background: rgba(255, 255, 255, 0.8) none repeat scroll 0 0;bottom: 0;left: 0;position: absolute;right: 0;text-align: center;top: 0;}
.property-loader-box .msg {bottom: 0;left: 0;margin-top:-100px;position: fixed;right: 0;top: 50%;width: 100%;}
.property-loader-box .txt {color: red;font-weight: bold;}
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
<script type="text/javascript">
$(document).ready(function(){
	var contract=$("#contract").val();
	get_category(contract);
	var p_n=$("#pvt_negotiation").prop("checked");
	if(p_n==true){
		$("#input_price").removeClass('error required number');
		$("#special_err_price").html('');
		$("#input_price").val('');
	}
	$.validator.addMethod("alphabetsnspace", function(value, element) {
		 return this.optional(element) || /(https?:\\)?([\w-]+\.)+[\w-]+[.com|.in|.org]+(\[\?%&=]*)?/.test(value);
	});
	$.validator.addMethod("youtube", function(value, element) {
		if(value != "" ) {
			 var p = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
			 return (value.match(p)) ? RegExp.$1 : false;
		} else{
			return true;
		}
	}, "<?php echo $this->lang->line('edit_property_form_please_enter_valid_url'); ?>");
	jQuery.extend(jQuery.validator.methods, {
		 number: function(value, element) {
			return this.optional(element)
			|| /^(?:\d+|\d{1,3}(?:\.\d{3})+)(?:,\d+)?$/.test(value)
			||  /^(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(value);
		  }
	});
});
</script>
<div class="main-content">
	<div class="row">
		<!-- Profile Info and Notifications -->
		<div class="col-md-6 col-sm-8 clearfix">
			<h3>Edit Property</h3>
			<?php
			$popups = NULL;
			$property_main_img = get_perticular_field_value('zc_property_img','file_name'," and property_id='".$property_details[0]['property_id']."' AND img_type='main_image'");
			$propImg = base_url().'assets/images/no_proimg.jpg';
			if($property_main_img!='' && file_exists("../assets/uploads/Property/Property".$property_details[0]['property_id']."/thumb_200_296/".$property_main_img)){
				$propImg = frontend_path().'assets/uploads/Property/Property'.$property_details[0]['property_id'].'/thumb_200_296/'.$property_main_img;
			}
			$name=get_perticular_field_value('zc_contract_types','name'," and contract_id='".$property_details[0]['contract_id']."'");
			$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$property_details[0]['typology']."'");
			$city_name=get_perticular_field_value('zc_city','city_name'," and city_id='".$property_details[0]['city']."'");
			$province_code=get_perticular_field_value('zc_region_master','province_code'," and city='".mysql_real_escape_string($city_name)."'");

			$proptitle = $name." For ".stripslashes($typology_name)." in ".$city_name.", ".$province_code;
			
			$propSecTitle = ($property_details[0]['area']!=''?$property_details[0]['area'].' - ':'');
			$propSecTitle.= ($property_details[0]['street_address']!=''?$property_details[0]['street_address'].', ':'');
			$propSecTitle.= ($property_details[0]['street_no']!=''?$property_details[0]['street_no'].' - ':'');
			$propSecTitle.= ($property_details[0]['zip']!=''?$property_details[0]['zip']:'');
			
			$property_posted_by = get_perticular_field_value('zc_user','user_name'," and user_id='".$property_details[0]['property_post_by']."'");
			$propertyRefCode = CreateNewRefToken($property_details[0]['property_id'],$name);
			?>
			<div class="modal fade" id="proSusModal" style="background: rgba(0, 0, 0, 0.5);opacity:1;">
				<div class="modal-dialog" style="opacity:1;position:fixed;top:450px;left:375px;">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" onclick="proSusModalClose();" data-dismiss="modal" aria-hidden="true">&times;</button>
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
							<button type="button" class="btn btn-default" onclick="proSusModalClose();" data-dismiss="modal">Close</button>            
						</div>
					</div>
				</div>
            </div>
			<?php
			if($property_details[0]['property_status']=='1'){
				$activeStatus ='Drafted&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				$btn_class = "inactive";
				$css_class = "entypo-pause";
				$statusURL = 'href="javascript:void(0);"';
			}
			if($property_details[0]['property_status']=='2' && $property_details[0]['property_approval'] == '1'){
				$activeStatus = 'Published&nbsp;&nbsp;&nbsp;';
				$btn_class = "";
				$css_class = "entypo-flash";
				//$statusURL = base_url()."property/status_change/".$property_details[0]['property_id'].$pageLink;
				$statusURL = 'data-toggle="modal" href="javascript:;" onclick="javascript:proSusModal();"';
			}                    
			
			if($property_details[0]['property_status']=='2' && $property_details[0]['property_approval']=='0'){
				$activeStatus = 'Inactive';
				$btn_class = "suspended";
				$css_class = "entypo-pause";
				$statusURL = 'href="'.base_url()."property/status_change/".$property_details[0]['property_id'].'"';
			}
			?>
			<a <?php echo $statusURL;?> class="btn btn-success <?php echo $btn_class; ?> btn-sm btn-icon btn-xs">
				<i class="<?php echo $css_class; ?>"></i><?php echo $activeStatus; ?>
			</a>

			<?php
			$featuredLink = '<a href="'.base_url()."property/make_featured/".$property_details[0]['property_id'].'" class="btn btn-blue btn-sm btn-icon btn-xs">
								<i class="entypo-back-in-time"></i>Feature&nbsp;&nbsp;
							 </a>';
			$featureStatus = get_perticular_field_value('zc_property_featured','status'," and property_id='".$property_details[0]['property_id']."'");
			if($featureStatus == 1){
				$todayDate = strtotime(date('Y-m-d'));
				$startDate = get_perticular_field_value('zc_property_featured','start_date'," and property_id='".$property_details[0]['property_id']."'");
				$expDateLength = get_perticular_field_value('zc_property_featured','number_of_days'," and property_id='".$property_details[0]['property_id']."'");
				$expireDate = strtotime(date('Y-m-d', strtotime($startDate . " +".$expDateLength." days")));
				if($todayDate < $expireDate){
					$featuredLink = '<a href="'.base_url()."property/".($property_details[0]['feature_status']==0?'property_feature_resume':'property_feature_suspend')."/".$property_details[0]['property_id'].$pageLink.'" class="btn btn-'.($property_details[0]['feature_status']==0?'gold':'red').' btn-sm btn-icon btn-xs">
										<i class="entypo-back-in-time"></i>'.($property_details[0]['feature_status']==0?'Resume':'Suspend').'
									 </a>';
				}
			}
			echo $featuredLink;
			?>

			<a href="<?php echo base_url();?>property/delete_property/<?php echo $property_details[0]['property_id']; ?>" class="btn btn-sm btn-icon btn-xs btn-red" onclick="return confirm('Are your sure?')">
				<i class="entypo-cancel"></i>Delete
			</a>

			<a href="<?php echo base_url();?>property/all/all" class="btn btn-sm btn-icon btn-xs btn-black">
				<i class="entypo-box"></i>View All Properties
			</a>

			<a class="btn btn-default editbtn btn-sm btn-icon btn-xs" style="width:120px;" title="Click here to edit" href="<?php echo base_url();?>user/edit_profile/<?php echo $property_details[0]['property_post_by']; ?>">
				<i class="entypo-pencil"></i>Edit User Profile
			</a>			


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
	<br/>
	<div class="post-message" style="text-align:center;background:#00a651;color:#FFFFFF;">
		<?php echo $this->session->flashdata('success');?>
	</div>
	<hr>
    <div class="panel panel-primary">
        <div class="panel-body">
            <?php
			$attributes = array('class' => 'form-horizontal form-groups-bordered', 'id' => 'register','role'=>"form");
			echo form_open_multipart('property/update_property_details/'.$this->uri->segment('3'), $attributes);
			?>
            <div class="form-group">
				<div class="cat_select">
					<label class="col-sm-1 control-label" for="contract">Contract</label>
					<div class="col-sm-3">					
						<label class="error" for="contract" generated="true" style="display:none;font-weight:normal"></label>
						<select disabled name="contract" id="contract" onChange="get_category(this.value);" class="form-control required">
							<option value="" selected="selected">Select contract type</option>
							<?php
							foreach($contract_type as $keyContract=>$valContract){
							?>
							<option value="<?php echo $keyContract; ?>" <?php echo($property_details[0]['contract_id']==$keyContract?'selected':''); ?>>
								<?php echo $valContract; ?>
							</option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="cat_select" name="category_id" id="category_id">
					<label class="col-sm-1 control-label" for="category">Category</label>
					<div class="col-sm-3">
						<label class="error" for="category" generated="true" style="display:none;font-weight:normal"></label>
						<select disabled name="category" id="category" onChange="get_sub_category(this.value);typology_adjustment(this.value);display_things(this.value);" class="form-control required">
							<option value="">Select a category</option>							
						</select>
					</div>
				</div>
				<div class="cat_select" style="display:none;" id="sub_category_area">
					<label class="col-sm-1 control-label" for="sub_category">Sub-Category</label>
					<div class="col-sm-3">
						<label class="error" for="sub_category" generated="true" style="display:none;font-weight:normal"></label>
						<select name="sub_category" id="sub_category" onChange="typology_adjustment(this.value);" class="form-control required">
							<option value="0">Select a Subcategory</option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="cat_select">
					<label class="col-sm-1 control-label" for="province">Province</label>
					<div class="col-sm-3">
						<label class="error" for="province" generated="true" style="display:none;font-weight:normal"></label>
						<select name="province" id="province"  class="form-control required" onChange="return get_city(this.value);">
							<option value="">Please select your Province</option>
							<?php
							foreach($provience_list as $key=>$val){
							$provinceID=get_perticular_field_value('zc_provience','provience_id'," AND `provience_name` = '".mysql_real_escape_string($val)."'");
							$st_name1=get_perticular_field_value('zc_region_master','province_code'," AND `province_name` = '".mysql_real_escape_string($val)."' group by province_code");?>
							<option value="<?php echo $provinceID;?>" <?php echo($provinceID==$property_details[0]['provience']?'selected':''); ?>>
								<?php echo str_replace("\'","'",$val); ?> - <?php echo $st_name1;?>
							</option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="cat_select">
					<label class="col-sm-1 control-label" for="city">City</label>
					<div class="col-sm-3">
						<label class="error" for="city" generated="true" style="display:none;font-weight:normal;"></label>
						<select name="city" id="city" class="form-control required">
						<?php 
							if($property_details[0]['city']==''){
							?>
							<option value="">Please select your city first</option>
							<?php
							}else{
								foreach($city as $key=>$val){
								$cityID=get_perticular_field_value('zc_city','city_id'," AND `city_name` = '".mysql_real_escape_string($val)."'");
								?>
									<option value="<?php echo $cityID;?>" <?php echo($cityID==$property_details[0]['city']?'selected':''); ?>>
										<?php echo str_replace("\'","'",$val); ?>
									</option>
								<?php
								}
							}
						?>
						</select>
					</div>
				</div>
				<div class="cat_select">
					<label class="col-sm-1 control-label" for="zip">Zip</label>
					<div class="col-sm-3">
						<label class="error" for="zip" generated="true" style="display:none;font-weight:normal"></label>
						<input class="form-control required" placeholder="Enter your Zip code" type="text" name="zip" id="zip"  value="<?php echo $property_details[0]['zip'];?>">
					</div>
				</div>
            </div>
			<div class="form-group">
				<div class="cat_select">
					<label class="col-sm-1 control-label" for="address">Address</label>
					<div class="col-sm-3">
						<label class="error" for="address" generated="true" style="display:none;font-weight:normal"></label>
						<input type="text" placeholder="Enter your Street Name" id="address" name="address" value="<?php echo $property_details[0]['street_address'];?>" class="form-control required">
					</div>
				</div>
				<div class="cat_select">
					<label class="col-sm-1 control-label" for="street_no">Street No</label>
					<div class="col-sm-3">
						<input type="text" name="street_no" placeholder="Enter your Street No" value="<?php echo $property_details[0]['street_no'];?>" class="form-control">
					</div>
				</div>
				<div class="cat_select">
					<label class="col-sm-1 control-label" for="area">Area</label>
					<div class="col-sm-3">
						<input type="text" name="area" placeholder="District, Neighbourhood..." value="<?php echo $property_details[0]['area'];?>" class="form-control">
					</div>
				</div>
            </div>
			<div class="form-group">
				<div class="cat_select">
					<label class="col-sm-2 control-label" for="price">Price</label>
					<div class="col-sm-4">
						<label id="special_err_price" class="error" for="input_price" generated="true" style="display:none;font-weight:normal"></label>
						<?php $price=number_format($property_details[0]['price'], 2, ',', '.'); ?>
						<input type="text" name="price" placeholder="In EUR (eg. 1.000,00) 1.000.000,00)" id="input_price" onKeyPress="return unchecked_radio();" class="form-control required number groupOfCurrencyBox" value="<?php echo $price;?>">
					</div>
				</div>
				<div class="cat_select">
					<label class="col-sm-2 control-label" for="pvt_negotiation">OR</label>
					<div class="col-sm-4" style="padding-top:6px;">
						<input type="radio" name="pvt_negotiation" id="pvt_negotiation" onClick="return blank_text();" value='1' <?php echo($property_details[0]['private_nagotiation']==1?'checked':''); ?>>
						&nbsp;&nbsp;Private nagotiation
					</div>
				</div>
            </div>
			<div class="form-group">
				<div class="cat_select">
					<label class="col-sm-2 control-label" for="url">YouTube URL</label>
					<div class="col-sm-8">
						<input type="text" placeholder="Enter the property related YouTube Url" name="url" id="url" value="<?php echo $property_details[0]['youtube_url'];?>" class="form-control">
					</div>
				</div>
            </div>
			<div class="form-group">
				<div class="cat_select">
					<label class="col-sm-2 control-label" for="typology">Typology</label>
					<div class="col-sm-4">
						<label class="error" for="typology" generated="true" style="display:none;font-weight:normal"></label>
						<select name="typology" id="typology" class="form-control required">
							<option value="">Select the typology of property</option>
						</select>
					</div>
				</div>
				<div class="cat_select" id="prop_status">
					<label class="col-sm-2 control-label" for="status_of_property">Status</label>
					<div class="col-sm-4">
						<label class="error" for="status_of_property" generated="true" style="display:none;font-weight:normal"></label>
						<select name="status_of_property" id="status_of_property"  class="form-control required">
							<option value="">Select status of the property</option>                               
							<?php
							foreach($status_of_property as $stspro){
							?>
							<option value="<?php echo $stspro['id']; ?>" <?php echo($stspro['id']==$property_details[0]['status']?'selected':''); ?>>
								<?php echo $stspro['name']; ?>
							</option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="clearfix"></div><br>
				<div class="cat_select" id="property_kind">
					<label class="col-sm-2 control-label" for="area">Area</label>
					<div class="col-sm-4">
						<select name="kind_of_property" id="kind_of_property" class="form-control">
							<option value="">Select kind of property</option>
							<?php
							foreach($kind_of_property as $kindpro){
							?>
							<option value="<?php echo $kindpro['id']; ?>" <?php echo($kindpro['id']==$property_details[0]['kind']?'selected':''); ?>>
								<?php echo $kindpro['name']; ?>
							</option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="cat_select" id="Energy_class">
					<label class="col-sm-2 control-label" for="area">Energy Class</label>
					<div class="col-sm-4">
						<label class="error" for="energy_efficiency" generated="true" style="display:none;font-weight:normal"></label>
						<select name="energy_efficiency" id="energy_efficiency"  class="form-control required" >
							<option value="">Select the energy efficiency class</option>
							<?php
							foreach($energy_efficiency_class as $energyeffpro){
							?>
							<option value="<?php echo $energyeffpro['id']; ?>" <?php echo($energyeffpro['id']==$property_details[0]['energyclass']?'selected':''); ?>>
								<?php echo $energyeffpro['name']; ?>
							</option>
							<?php
							}
							?>
						</select>
					</div>
				</div>
            </div>
			<!-- Property Images -->
			<div class="form-group gallery-env">
				<div class="cat_select">
					<?php
					$main_image_src = frontend_path().'assets/images/no_proimg.jpg';
					$main_image=get_perticular_field_value('zc_property_img','file_name'," and property_id='".$property_details[0]['property_id']."' and img_type='main_image'");				
					if($main_image && file_exists('../assets/uploads/Property/Property'.$property_details[0]['property_id'].'/'.$main_image)){
						$main_image_src = frontend_path().'assets/uploads/Property/Property'.$property_details[0]['property_id'].'/'.$main_image;
					}
					?>
					<div class="col-sm-2 col-xs-4" data-tag="1d">
						<article class="image-thumb">
							<a href="javascript:void(0);" class="image">
								<img id="img_1" src="<?php echo $main_image_src; ?>">
							</a> 
							<div class="image-options">
								<a href="javascript:void(0);" class="edit">
									<i class="entypo-pencil"></i>
									<input type='file' id="imgInp1" name="userfile[]">
								</a>
							</div>
						</article>
					</div>
					<?php
					for($imgTag=1;$imgTag<6;$imgTag++){
						$prop_image_src = frontend_path().'assets/images/no_proimg.jpg';
						$prop_image=get_perticular_field_value('zc_property_img','file_name'," and property_id='".$property_details[0]['property_id']."' and img_type='prop_picture' and prop_img_no='".$imgTag."'");
						if($prop_image && file_exists('../assets/uploads/Property/Property'.$property_details[0]['property_id'].'/'.$prop_image)){
							$prop_image_src = frontend_path().'assets/uploads/Property/Property'.$property_details[0]['property_id'].'/'.$prop_image;
							$prop_image_id=get_perticular_field_value('zc_property_img','img_id'," and property_id='".$property_details[0]['property_id']."' and img_type='prop_picture' and prop_img_no='".$imgTag."'");
							$prop_image_del_html = '<a href="'.base_url().'property/del_img/'.$prop_image_id.'_'.$property_details[0]['property_id'].'" onClick="return confirm(\'Are you sure? This change will take effect immediately. Click OK to delete the image.\');" class="delete"><i class="entypo-cancel"></i></a>';
						}else{
							$prop_image_del_html = '';
						}
					?>
					<div class="col-sm-2 col-xs-4" data-tag="1d">
						<article class="image-thumb">
							<a href="javascript:void(0);" class="image">
								<img id="img_<?php echo ($imgTag + 1); ?>" src="<?php echo $prop_image_src; ?>">
							</a> 
							<div class="image-options">
								<a href="javascript:void(0);" class="edit">
									<i class="entypo-pencil"></i>
									<input type='file' id="imgInp<?php echo ($imgTag + 1); ?>" name="userfile[]">
								</a>
								<?php echo $prop_image_del_html; ?>
							</div>
						</article>
					</div>
					<?php
					}
					?>
				</div>
			</div>
            <!-- Main Features -->
			<div class="main_feature" style="display:none;">
				<div class="form-group">
					<div class="cat_select" id="surface_area">
						<label class="col-sm-2 control-label" for="surface_area">Surface area (m2)</label>
						<div class="col-sm-2">
							<label class="error" for="surface_area" generated="true" style="display:none;font-weight:normal"></label>
							<input type="text" name="surface_area" id="add_surface_area" class="form-control required number" value="<?php echo $property_details[0]['surface_area'];?>">
						</div>
					</div>
					<div class="cat_select" id="room_no">
						<label class="col-sm-2 control-label" for="room_no">Rooms No</label>
						<div class="col-sm-2">
							<label class="error" for="room_no" generated="true" style="display:none;font-weight:normal"></label>
							<input type="text" name="room_no" id="add_room_no" class="form-control required number" value="<?php echo $property_details[0]['room_no'];?>">
						</div>
					</div>
					<div class="cat_select" id="floor">
						<label class="col-sm-2 control-label" for="floor">Floor</label>
						<div class="col-sm-2">
							<input type="text" name="floor" id="room_floor" class="form-control" value="<?php echo $property_details[0]['floor'];?>">
						</div>
					</div>				
					<div class="clearfix"></div><br>
					<div class="cat_select" id="tot_floor">
						<label class="col-sm-2 control-label" for="tot_floor">Total of Floors</label>
						<div class="col-sm-2">
							<input type="text" name="tot_floor" id="tot_room_floor" class="form-control number" value="<?php echo $property_details[0]['total_of_floors'];?>">
						</div>
					</div>
					<div class="cat_select" id="year_of_building">
						<label class="col-sm-2 control-label" for="year_of_building">Year of Building</label>
						<div class="col-sm-2">
							<input type="text" name="year_of_building" id="Y_o_b" class="form-control number" value="<?php echo $property_details[0]['year_of_building'];?>">
						</div>
					</div>
					<div class="cat_select" id="bed_no">
						<label class="col-sm-2 control-label" for="bed_no">Beds No.</label>
						<div class="col-sm-2">
							<input type="text" name="bed_no" class="form-control number" id="room_bed_no" value="<?php echo $property_details[0]['beds_no'];?>">
						</div>
					</div>
				</div>
				<div class="form-group" id="row4">
					<div class="cat_select" id="bothroom_no">
						<label class="col-sm-2 control-label" for="bothroom_no">Bathrooms</label>
						<div class="col-sm-2">
							<label class="error" for="add_bathroom_no" generated="true" style="display:none;font-weight:normal"></label>
							<select name="bothroom_no" id="add_bathroom_no" class="form-control required">
								<option value="">Select</option>
								<option value="No" <?php echo($property_details[0]['bathrooms_no']=='No'?'selected':''); ?>>No</option>
								<option value="1" <?php echo($property_details[0]['bathrooms_no']=='1'?'selected':''); ?>>1</option>
								<option value="2" <?php echo($property_details[0]['bathrooms_no']=='2'?'selected':''); ?>>2</option>
								<option value="3" <?php echo($property_details[0]['bathrooms_no']=='3'?'selected':''); ?>>3</option>
								<option value=">3" <?php echo($property_details[0]['bathrooms_no']=='>3'?'selected':''); ?>>>3</option>
							</select>
						</div>
					</div>
					<div class="cat_select" id="kitchen">
						<label class="col-sm-2 control-label" for="kitchen">Kitchen</label>
						<div class="col-sm-2">
							<label class="error" for="add_kitchen" generated="true" style="display:none;font-weight:normal"></label>
							<select name="kitchen" id="add_kitchen" class="form-control required">
								<option value="">Select</option>
								<option value="No" <?php echo($property_details[0]['kitchen']=='No'?'selected':''); ?>>No</option>
								<option value="Kitchenettes" <?php echo($property_details[0]['kitchen']=='Kitchenettes'?'selected':''); ?>>Kitchenettes</option>
								<option value="Livable" <?php echo($property_details[0]['kitchen']=='Livable'?'selected':''); ?>>Livable</option>
								<option value="Living" <?php echo($property_details[0]['kitchen']=='Living'?'selected':''); ?>>Living</option>
							</select>
						</div>
					</div>
					<div class="cat_select" id="heating">
						<label class="col-sm-2 control-label" for="heating">Heating</label>
						<div class="col-sm-2">
							<label class="error" for="add_heating" generated="true" style="display:none;font-weight:normal"></label>
							<select name="heating" id="add_heating" class="form-control required">
								<option value="">Select</option>
								<option value="No"<?php echo($property_details[0]['heating']=='No'?'selected':''); ?>>No</option>
								<option value="Autonomous" <?php echo($property_details[0]['heating']=='Autonomous'?'selected':''); ?>>Autonomous</option>
								<option value="Centralized" <?php echo($property_details[0]['heating']=='Centralized'?'selected':''); ?>>Centralized</option>
							</select>
						</div>
					</div>
					<div class="clearfix"></div><br>
					<div class="cat_select" id="parking">
						<label class="col-sm-2 control-label" for="parking">Parking</label>
						<div class="col-sm-2">
							<label class="error" for="add_parking" generated="true" style="display:none;font-weight:normal"></label>
							<select name="parking" class="form-control required" id="add_parking">
								<option value="">Select</option>
								<option value="No" <?php echo($property_details[0]['parking']=='No'?'selected':''); ?>>No</option>
								<option value="Cargarage" <?php echo($property_details[0]['parking']=='Cargarage'?'selected':''); ?>>Car garage</option>
								<option value="Parking" <?php echo($property_details[0]['parking']=='Parking'?'selected':''); ?>>Parking</option>
							</select>
						</div>
					</div>
					<div class="cat_select" id="roommates">
						<label class="col-sm-2 control-label" for="roommates">Roommates</label>
						<div class="col-sm-2">
							<label class="error" for="add_roommates" generated="true" style="display:none;font-weight:normal"></label>
							<select name="roommates" id="add_roommates" class="form-control required">
								<option value="">Select</option>
								<option value="Only women" <?php echo($property_details[0]['roommates']=='Only women'?'selected':''); ?>>Only women</option>
								<option value="Only Men" <?php echo($property_details[0]['roommates']=='Only Men'?'selected':''); ?>>Only Men</option>
								<option value="Men and women" <?php echo($property_details[0]['roommates']=='Men and women'?'selected':''); ?>>Men and women</option>
							</select>
						</div>
					</div>
					<div class="cat_select" id="occupation">
						<label class="col-sm-2 control-label" for="occupation">Occupation</label>
						<div class="col-sm-2">
							<label class="error" for="add_occupation" generated="true" style="display:none;font-weight:normal"></label>
							<select name="occupation" id="add_occupation" class="form-control required">
								<option value="">Select</option>
								<option value="Only students" <?php echo($property_details[0]['occupation']=='Only students'?'selected':''); ?>>Only students</option>
								<option value="Only workers" <?php echo($property_details[0]['occupation']=='Only workers'?'selected':''); ?>>Only workers</option>
								<option value="Students and workers" <?php echo($property_details[0]['occupation']=='Students and workers'?'selected':''); ?>>Students and workers</option>
							</select>
						</div>
					</div>
					<div class="cat_select" id="furnished">
						<label class="col-sm-2 control-label" for="furnished">Furnished</label>
						<div class="col-sm-2">
							<label class="error" for="add_furnished" generated="true" style="display:none;font-weight:normal"></label>
							<select name="furnished" id="add_furnished" class="form-control required">
								<option value="">Select</option>
								<option value="No" <?php echo($property_details[0]['furnished']=='No'?'selected':''); ?>>No</option>
								<option value="Yes" <?php echo($property_details[0]['furnished']=='Yes'?'selected':''); ?>>Yes</option>
								<option value="Partly" <?php echo($property_details[0]['furnished']=='Partly'?'selected':''); ?>>Partly</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-1 control-label" for="availabilty">Availability</label>
					<div class="col-sm-3" style="padding-top:6px;">
						<label class="error" for="availabilty" generated="true" style="display:none;font-weight:normal"></label>
						<input type="radio" name="availabilty" id="avail_sp" class="required" value='0' <?php echo($property_details[0]['availability']=='0'?'checked':''); ?>>
						&nbsp;Vacent&nbsp;&nbsp;
						<input type="radio" name="availabilty" id="avail_sp" class="required" value='1' <?php echo($property_details[0]['availability']=='1'?'checked':''); ?>>
						&nbsp;Occupated
					</div>
					<div id="smokers">
						<label class="col-sm-1 control-label" for="smokers">Smokers</label>
						 <div class="col-sm-3" style="padding-top:6px;">
							<label class="error" for="smokers" generated="true" style="display:none;font-weight:normal"></label>
							<input type="radio" name="smokers" id="smokers_space" class="required" value="0" <?php echo($property_details[0]['smokers']=='0'?'checked':''); ?>>
							&nbsp;Allowed&nbsp;&nbsp;
							<input type="radio" name="smokers" id="smokers_space" class="required" value="1" <?php echo($property_details[0]['smokers']=='1'?'checked':''); ?>>
							&nbsp;Not allowed
						</div>
					</div>
					<div id="pets">
						<label class="col-sm-1 control-label" for="pets">Pets</label>
						 <div class="col-sm-3" style="padding-top:6px;">
							<label class="error" for="pets" generated="true" style="display:none;font-weight:normal"></label>
							<input type="radio" name="pets" id="pet_val" class="required" value="0" <?php echo($property_details[0]['pets']=='0'?'checked':''); ?>>
							&nbsp;Allowed&nbsp;&nbsp;
							<input type="radio" name="pets" id="pet_val" class="required" value="1" <?php echo($property_details[0]['pets']=='1'?'checked':''); ?>>
							&nbsp;Not allowed
						</div>
					</div>
				</div>
			</div>
			<!-- Additional Features -->
			<div class="additional_feature" style="display:none;">
				<div class="form-group">
					<label class="col-sm-2 control-label" id="row6" for="availabilty">Additional Features</label>
					<div class="col-sm-10" id="add_feature" style="padding-top:7px;">
						<input type="checkbox" name="air_conditioning" value="1" id="air_conditioning" <?php echo($property_details[0]['air_conditioning']=='1'?'checked':'');?>>
						&nbsp;Air Conditioning&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="elevator" value="1" id="elevator" <?php echo($property_details[0]['elevator']=='1'?'checked':'');?>>
						&nbsp;Elevator&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="balcony" value="1" id="balcony" <?php echo($property_details[0]['balcony']=='1'?'checked':'');?>>
						&nbsp;Balcony&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="terrace" value="1" id="terrace" <?php echo($property_details[0]['terrace']=='1'?'checked':'');?>>
						&nbsp;Terrace&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="checkbox" name="garden" value="1" id="garden" <?php echo($property_details[0]['garden']=='1'?'checked':'');?>>
						&nbsp;Garden
					</div>
				</div>
				<div class="form-group gallery-env" id="row7">
					<label class="col-sm-2 control-label" for="">Planimetry Image</label>
					<?php
					$planimetry_image_src = frontend_path().'assets/images/no_proimg.jpg';
					$planimetry_image=get_perticular_field_value('zc_property_img','file_name'," and property_id='".$property_details[0]['property_id']."' and img_type='preliminary'");
					if($planimetry_image && file_exists('../assets/uploads/Property/Property'.$property_details[0]['property_id'].'/'.$planimetry_image)){
						$planimetry_image_src = frontend_path().'assets/uploads/Property/Property'.$property_details[0]['property_id'].'/'.$planimetry_image;
						$planimetry_image_id=get_perticular_field_value('zc_property_img','img_id'," and property_id='".$property_details[0]['property_id']."' and img_type='preliminary'");
						$planimetry_image_del_html = '<a href="'.base_url().'property/del_img/'.$planimetry_image_id.'_'.$property_details[0]['property_id'].'" onClick="return confirm(\'Are you sure? This change will take effect immediately. Click OK to delete the image.\');" class="delete"><i class="entypo-cancel"></i></a>';
					}else{
						$planimetry_image_del_html = '';
					}
					?>
					<div class="col-sm-2 col-xs-4" data-tag="1d">
						<article class="image-thumb">
							<a href="javascript:void(0);" class="image">
								<img id="img_7" src="<?php echo $planimetry_image_src; ?>">
							</a> 
							<div class="image-options">
								<a href="javascript:void(0);" class="edit">
									<i class="entypo-pencil"></i>
									<input type='file' id="imgInp7" name="user_file_1">
								</a>
								<?php echo $planimetry_image_del_html; ?>
							</div>
						</article>
					</div>
					<label class="col-sm-2 control-label" for="contract">Dedicated to luxury?</label>
					<div class="col-sm-6">
						<span style="display:block;margin-top:50px;">Select this checkbox to add the property in the category dedicated to luxury.</span>
						<input type="checkbox" name="add_to_luxury" value="1" <?php echo($property_details[0]['add_to_luxury']=='1'?'checked':''); ?>>
						&nbsp;&nbsp;Add to luxury
					</div>
				</div>
			</div>
			<div class="form-group gallery-env">
                <label class="col-sm-2 control-label" for="description">Property Description</label>
				<div class="col-sm-8 col-xs-4" data-tag="1d">
					<label class="error" for="field" generated="true" style="display:none;font-weight:normal"></label>
					<textarea rows="4" cols="40" id="field" name="description" onKeyUp="countChar(this)" class="form-control required"><?php echo htmlspecialchars($property_details[0]['description']);?></textarea>
					<div  style="float:left;">(<span id="charNum"><?php echo 500-strlen($property_details[0]['description']);?></span> characters left)</div>
				</div>
			</div>
			<div class="form-group" align="center"> 
                <button class="btn btn-lg btn-success" type="submit">Update</button>
            </div>                    
            <?php echo form_close();?>
        </div>
    </div>
	<div class="property-loader-box">
		<div class="msg">
			<div class="img">
				<img src="<?php echo base_url().'assets/images/Pro-Img-Loader.gif';?>">
			</div>
			<div class="txt">Please wait ...<br>Do not change page or click links during the loading.</div>
		</div>
	</div>
</div>
<?php $this->load->view('inc/footer.php'); ?>
<script type="text/javascript">
function get_category(str){
	var cat_parent=0;
	var select_cat="<?php echo get_perticular_field_value('zc_categories','short_code'," and category_id='".$property_details[0]['category_id']."'");?>";
	if(str!=0){
		$.post("<?php echo base_url(); ?>property/getCategoryedit",{
				contract: str,
				cat_parent : cat_parent,
				select_cat:select_cat
		},function(result){
			$("#category").html(result);
			$(".additional_feature").show();
			$(".main_feature").show();
			var str=$("#category").val();
			get_sub_category(str);
			typology_adjustment(str);
			display_things(str);
		});
	}else{
		$(".additional_feature").hide();
		$(".main_feature").hide();
	}	
}
function display_things(str){
	if(str=="ROM"){
		$('#surface_area,#room_no,#tot_floor,#year_of_building,\
			#row7,#bed_no,#prop_status,#Energy_class,#property_kind').hide();
		$('#parking,#row4,#bothroom_no,#kitchen,#heating,\
			#roommates,#occupation,#furnished,#smokers,\
			#pets,#floor,#row6,#add_feature,').show();
		$('#typology,#add_bathroom_no,#add_kitchen,#add_heating,\
			#add_parking,#add_roommates,#add_occupation,\
			#add_furnished,#avail_sp,#pet_val,#smokers_space').addClass('required');
		$('#status_of_property,#energy_efficiency,\
			#add_surface_area,#add_room_no').removeClass('required');
	}
	if(str=="LAND"){
		$('#row7,#row4,#row6,#tot_floor,#year_of_building,#bed_no,\
			#bothroom_no,#kitchen,#parking,#heating,#floor,#furnished,\
			#smokers,#pets,#room_no,#add_feature,#prop_status,#Energy_class').hide();
		$('#property_kind,#surface_area').show();
		$('#typology,#add_surface_area,#avail_sp').addClass('required');		
		$('#status_of_property,#energy_efficiency,#add_room_no,\
			#add_bathroom_no,#add_kitchen,#add_heating,#add_parking,\
			#add_roommates,#add_occupation,#add_furnished,#pet_val,#smokers_space').removeClass('required');
	}
	if(str=="VAC"){
		$('#surface_area,#room_no,#floor,#tot_floor,#year_of_building,\
			#row6,#bed_no,#bothroom_no,#kitchen,#parking,#heating,#furnished,\
			#row7,#row4,#row6,#pets,#add_feature,#prop_status').show();
		$('#smokers,#roommates,#occupation').hide();
		var contract_id=$("#contract").val();
		if(contract_id==1){
			$('#property_kind,#Energy_class').hide();
			$("#energy_efficiency").removeClass('required');
		}else{
			$('#property_kind,#Energy_class').show();
			$("#energy_efficiency").addClass('required');
		}
		$('#typology,#status_of_property,#add_surface_area,#add_room_no,\
			#add_bathroom_no,#add_heating,#add_parking,#add_furnished,\
			#avail_sp,#pet_val').addClass('required');
		$('#add_kitchen,#add_roommates,#add_occupation,#smokers_space').removeClass('required');
	}
	if(str=="RES" || str=="BUS"){
		$('#surface_area,#room_no,#floor,#tot_floor,#year_of_building,\
			#row6,#furnished,#bothroom_no,#parking,#row7,#row4,#row6,\
			#add_feature,#prop_status,#Energy_class,#property_kind').show();
		$('#roommates,#occupation,#bed_no,#furnished,#smokers,#pets').hide();
		$('#typology,#status_of_property,#energy_efficiency,#add_surface_area,\
			#add_room_no,#add_bathroom_no,#add_kitchen,#add_heating,\
			#add_parking,#add_furnished,#avail_sp').addClass('required');
		$('#add_roommates,#add_occupation,#pet_val,#smokers_space').removeClass('required');
	}
}
function get_sub_category(str){
	document.getElementById('sub_category').selectedIndex = 0;
	var select_subcat="<?php echo get_perticular_field_value('zc_categories','short_code'," and category_id='".$property_details[0]['category_id']."'");?>";
	if(str=="BUS"){
		$.post("<?php echo base_url(); ?>property/getSubCategoryedit",{category : str,select_subcat:select_subcat},function(result){
			$("#sub_category").html(result);
			var str=$("#sub_category").val();
			typology_adjustment(str);
			document.getElementById("sub_category_area").style.display="block";
		});
	}else{
		document.getElementById("sub_category_area").style.display="none";
	}	
}
function typology_adjustment(str){
	//alert(str);
	document.getElementById('typology').selectedIndex = 0;
	var select_typology="<?php echo $property_details[0]['typology'];?>";
	if((str!=0)&&(str!="BUS")){
		$.post("<?php echo base_url(); ?>property/getTypologyedit",{
			category : str,
			select_typology:select_typology
		},function(result){
			$("#typology").html(result);
		});
	}
}
var img_id=0;
function readURL(input,img_id){
	var loader="<?php echo base_url();?>assets/images/Pro-Img-Loader.gif";
	if (input.files && input.files[0]){
		var reader = new FileReader();     
		reader.onload = function (e) {
			$('#img_'+img_id).attr('src', e.target.result).width(142).height(147);			
		}
		reader.readAsDataURL(input.files[0]);
	}
}
$("#imgInp1").change(function(){
	var ext = this.value.match(/\.(.+)$/)[1];
	var ext = ext.toLowerCase();
	switch (ext) {
		case 'jpg':
		case 'jpeg':
		case 'png':
		case 'gif':
			readURL(this,1);
			break;
		default:
			alert('Only jpg, jpeg ,png, or gif file can be uploaded.');
			this.value = '';
	}
	//img_id++;
});
$("#imgInp2").change(function(){
	//img_id++;
	var ext = this.value.match(/\.(.+)$/)[1];
	var ext = ext.toLowerCase();
	switch (ext) {
		case 'jpg':
		case 'jpeg':
		case 'png':
		case 'gif':
			readURL(this,2);
			break;
		default:
			alert('Only jpg, jpeg ,png, or gif file can be uploaded.');
			this.value = '';
	}
});
$("#imgInp3").change(function(){
	//img_id++;
	var ext = this.value.match(/\.(.+)$/)[1];
	var ext = ext.toLowerCase();
	switch (ext) {
		case 'jpg':
		case 'jpeg':
		case 'png':
		case 'gif':
			readURL(this,3);
			break;
		default:
			alert('Only jpg, jpeg ,png, or gif file can be uploaded.');
			this.value = '';
	}
});
$("#imgInp4").change(function(){
	//img_id++;
	var ext = this.value.match(/\.(.+)$/)[1];
	var ext = ext.toLowerCase();
	switch (ext) {
		case 'jpg':
		case 'jpeg':
		case 'png':
		case 'gif':
			readURL(this,4);
			break;
		default:
			alert('Only jpg, jpeg ,png, or gif file can be uploaded.');
			this.value = '';
	}
});
$("#imgInp5").change(function(){
	//img_id++;
	var ext = this.value.match(/\.(.+)$/)[1];
	var ext = ext.toLowerCase();
	switch (ext) {
		case 'jpg':
		case 'jpeg':
		case 'png':
		case 'gif':
			readURL(this,5);
			break;
		default:
			alert('Only jpg, jpeg ,png, or gif file can be uploaded.');
			this.value = '';
	}
});
$("#imgInp6").change(function(){
	var ext = this.value.match(/\.(.+)$/)[1];
	var ext = ext.toLowerCase();
	switch (ext) {
		case 'jpg':
		case 'jpeg':
		case 'png':
		case 'gif':
			readURL(this,6);
			break;
		default:
			alert('Only jpg, jpeg ,png, or gif file can be uploaded.');
			this.value = '';
	}
});
$("#imgInp7").change(function(){
	var ext = this.value.match(/\.(.+)$/)[1];
	var ext = ext.toLowerCase();
	switch (ext) {
		case 'jpg':
		case 'jpeg':
		case 'png':
		case 'gif':
			readURL(this,7);
			//$("#remove").show();
			break;
		default:
			alert('Only jpg, jpeg ,png, or gif file can be uploaded.');
			this.value = '';
	}
});
function unchecked_radio(){
	$("#pvt_negotiation").prop("checked",false);
	$("#input_price").addClass('required number');
}
function blank_text(){
	$("#input_price").removeClass('error required number');
	$("#special_err_price").html('');
	$("#input_price").val('');
}
function get_city(id){
	var name=id;
	$.post("<?php echo base_url(); ?>property/city_search_via_id",{
		name: name
	},function(result){
		$('#city').html(result);
	});
}
function countChar(val) {
	var len = val.value.length;
	if (len >= 500) {
		val.value = val.value.substring(0, 500);
		$('#charNum').text(0);
	} else {
		$('#charNum').text(500 - len);
	}
};
function click_upload(){
	$('#upload_csv').show();
	$('#add_newproperty_box').hide();
	$('#msg_box_csv').show();
	$('#msg_box_general').hide();
}
function add_property(){
	$('#upload_csv').hide();
	$('#add_newproperty_box').show();
	$('#msg_box_general').show();
	$('#msg_box_csv').hide();
}
function frmSubmit(submitBtnVal){
	$('#register input[name="btnSubmit"]').val(submitBtnVal);
	document.getElementById("register").submit();
}
function loaderCall(submitBtnVal){
	$("#regboxId").hide();
	$("#form_submit_loading_area").show();
	setTimeout(function(){
		frmSubmit(submitBtnVal);
	}, 5000);
}
$(document).ready(function(){
	$("#register").validate({
		rules: {
			zip: {digits: true},
			url: {youtube: "#url"}
		},messages: {
			zip: {digits: "Please provide a digits only"},
			url: {alphabetsnspace: "Enter valid video url",}
		},submitHandler: function (form){
			$("body").addClass('noperspective');
			$(".property-loader-box").show();
			setTimeout(function(){
				$('#register input[name="btnSubmit"]').val('Submit');
				document.getElementById("register").submit();
			}, 5000);
			return false;
		}
	});
});
$(function(){
	setTimeout(function(){
		$(".success").fadeOut(1500);
	},5000);
});
$('.groupOfCurrencyBox').priceFormat({
    prefix: '',
    centsSeparator: ',',
	thousandsSeparator: '.'
});
function isCurrency(evt, element){
	var charCode = (evt.which) ? evt.which : event.keyCode
	// “-” CHECK MINUS, AND ONLY ONE. &&  “.” CHECK DOT, AND ONLY ONE.
	if((charCode != 44 || $(element).val().indexOf(',') != -1) && (charCode != 46 || $(element).val().indexOf('.') != -1) && (charCode < 48 || charCode > 57))
		//console.log(charCode);
		return false;
	return true;
}
function isNumber(evt, element){
	var charCode = (evt.which) ? evt.which : event.keyCode
	// “-” CHECK MINUS, AND ONLY ONE. &&  “.” CHECK DOT, AND ONLY ONE.
	if((charCode != 45 || $(element).val().indexOf(',') != -1) && (charCode != 46 || $(element).val().indexOf('.') != -1) && (charCode < 48 || charCode > 57))
		return false;
	return true;
} 
function isOnlyNumber(evt, element) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if ((charCode < 48 || charCode > 57))
		return false;
	return true;
}

function proSusModal()
{
	$('#proSusModal').css('display', 'block');
}
function proSusModalClose()
{
	$('#proSusModal').css('display', 'none');
}
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
</script>
