<?php $this->load->view('inc/header.php'); ?>
<style>
/*jquery error styles */
div.error{ float: left; color: red; padding-right: .5em;}
label.error{float: left; color: red; padding-right: .5em;}
#ssn{text-transform:uppercase}
.email_notification {margin: 0;padding: 0;}
.email_notification li {display: block;list-style: outside none none;margin: 0;padding: 5px 0;position: relative;}
.email_notification span {position: absolute;right: 0;}
.btn-info.inactive {background-color: #ddbebe;color: #000000;}
.btn-info.inactive.btn-icon i{background-color: #A08282;}
</style>
<div class="main-content">
    <div class="row">
		<!-- Profile Info and Notifications -->
		<div class="col-md-6 col-sm-8 clearfix">
			<?php
			if($postingType == 'Edit'){
				$headerTitle = $user_infos[0]['user_name'];
			}else{
				$headerTitle = 'Add new user - Agency';
			}
			?>
			<h3><?php echo $headerTitle; ?></h3>
			<?php
			if($user_infos[0]['user_id']!=''){
			?>
			<h5>
				<a href="<?php echo base_url();?>user/view_message/<?php echo $user_infos[0]['user_id']; ?>" class="btn btn-green btn-icon btn-xs" title="See all messages of this user">
					<i class="entypo-mail"></i>View All Messages
				</a>
				<a href="<?php echo base_url();?>property/probyuser-<?php echo $user_infos[0]['user_id']; ?>/all" title="See all properties of this user" class="btn btn-black btn-icon btn-xs">
					<i class="fa fa-archive"></i>View All Properties
				</a>
				<a <?php echo($user_infos[0]['status']=='1'?'data-toggle="modal" data-target="#modal" href="javascript:void(0);"':'href="'.site_url('/user/statuschangeoneditprofile/').'/'.$user_infos[0]['user_id'].'" Onclick="return confirm(\'Are you sure want change status.\')"'); ?> class="btn btn-info <?php echo($user_infos[0]['status']=='1'?'':'inactive'); ?> btn-sm btn-icon btn-xs" title="<?php echo($user_infos[0]['status']=='1'?'Click here to inactive':'Click here to active'); ?>">
					<i class="<?php echo($user_infos[0]['status']=='1'?'entypo-lock-open':'entypo-lock'); ?>"></i>
					<?php echo($user_infos[0]['status']=='1'?'Active':'InActive'); ?>
				</a>
			</h5>
			<?php
			}
			?>
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
	<div class="post-message" style="text-align:center;background:#00a651;color:#FFFFFF;">
		<?php echo $this->session->flashdata('success');?>
	</div>
    <hr>
    <div class="panel panel-primary">
        <div class="panel-body">
            <?php			
			$attributes = array('class' => 'form-horizontal form-groups-bordered', 'id' => 'register','role'=>"form");
			if($postingType == 'Edit'){
				echo form_open_multipart('user/update_company/'.$this->uri->segment('3'), $attributes);
			}else{
				echo form_open_multipart('user/add_company', $attributes);
			}
			?>
            <h3>Company Information</h3>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="company_name">Company Name</label>
                <div class="col-sm-5">
					<div class="comp_name_msg" id="comp_name_msg_id" style="display:none;"></div>
					<label class="error" for="comp_name" generated="true" style="display:none;"></label>
                    <input id="comp_name" name="company_name" class="form-control required" type="text" maxlength="250" placeholder="Company Name" value="<?php echo $user_infos[0]['company_name'];?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="field-1">Business Name</label>
                <div class="col-sm-5">
					<div class="buss_name_msg" id="buss_name_msg_id" style="display:none;"></div>
					<label class="error" for="buss_name" generated="true" style="display:none;"></label>
                    <input id="buss_name" name="business_name" class="form-control required" type="text" maxlength="250" placeholder="Business Name" value="<?php echo $user_infos[0]['business_name'];?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="field-1">Vat Number</label>
                <div class="col-sm-5">
					<div class="user_msg" id="user_message_vat" style="display:none;"></div>
					<label class="error" for="vat_no" generated="true" style="display:none;"></label>
                    <input id="vat_no" name="vat_number" class="form-control required" type="text" placeholder="Vat Number" maxlength="16" onKeyUp="document.getElementById('user_message_vat').style.display='none'" value="<?php echo $user_infos[0]['vat_number'];?>">
                </div>
            </div>
            <h3>Contact Information</h3>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="field-1">First Name</label>
                <div class="col-sm-5">
					<label class="error" for="first_name" generated="true" style="display:none;"></label>
                    <input id="first_name" name="first_name" class="form-control required" type="text" maxlength="25" placeholder="First Name" value="<?php echo $user_infos[0]['first_name'];?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="field-1">Last Name</label>
                <div class="col-sm-5">
					<label class="error" for="last_name" generated="true" style="display:none;"></label>
                    <input id="last_name" name="last_name" class="form-control required" type="text" maxlength="50" placeholder="Last Name" value="<?php echo $user_infos[0]['last_name'];?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="field-1">Direct Phone Number</label>
                <div class="col-sm-5">
					<label class="error" for="contact_ph_no" id="contact_ph_message" generated="true" style="display:none;"></label>
                    <input id="contact_ph_no" maxlength="15" name="contact_ph_no" class="form-control required" type="text" placeholder="Contact Number" value="<?php echo $user_infos[0]['contact_ph_no'];?>">
                </div>
            </div>
            <h3>Contact Information</h3>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="field-1">Province</label>
                <div class="col-sm-5">
					<label class="error" for="province" generated="true"></label>
                    <select name="province" id="province"  class="form-control required" onChange="return get_city(this.value);">
                        <option value="">Please select your Province</option>
                        <?php
						foreach($provinces as $key=>$val){
							if(!strpos($val, "'")===false){
								$st_name=get_perticular_field_value('zc_region_master','province_code'," and province_name = '".str_replace("'","\''",$val)."' group by province_code");
							}else{
								$st_name=get_perticular_field_value('zc_region_master','province_code'," and province_name = '".$val."' group by province_code");
							}
						?>
                        <option value="<?php echo $val;?>" <?php echo($val==$user_infos[0]['province']?'selected':''); ?>>
							<?php echo stripslashes($val).'-'.$st_name;?>
						</option>
                        <?php
						}
						?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="field-1">City</label>
                <div class="col-sm-5">
					<label class="error" for="city" generated="true"></label>
                    <select name="city" id="city"  class="form-control required">
                        <?php
						foreach($city as $key=>$val){
						?>
                        <option value="<?php echo $val;?>" <?php echo($val==$user_infos[0]['city']?'selected':''); ?>>
							<?php echo stripslashes($val); ?>
						</option>
                        <?php
						}
						?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="field-1">Street Address</label>
                <div class="col-sm-5">
					<label class="error" for="street_address" generated="true" style="display:none;" ></label>
                    <input id="street_address" name="street_address" class="form-control required" maxlength="250" type="text" placeholder="Street Address" value="<?php echo $user_infos[0]['street_address'];?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="field-1">Street No</label>
                <div class="col-sm-5">
					<label class="error" for="street_no" generated="true" style="display:none;" ></label>
                    <input id="street_no" name="street_no" class="form-control required" type="text" maxlength="20" placeholder="Street No" value="<?php echo $user_infos[0]['street_no'];?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="field-1">Zip</label>
                <div class="col-sm-5">
					<label class="error" for="zip" generated="true" style="display:none;" ></label>
                    <input id="zip" name="zip" class="form-control required" type="text" maxlength="15" placeholder="ZIP" value="<?php echo $user_infos[0]['zip'];?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="field-1">Land Line Number</label>
                <div class="col-sm-5">
					<label class="error" for="phone_1" id="ph_message" generated="true"></label>
					<span id="spnPhoneStatus1"></span>
                    <input id="phone_1" name="phone_1" class="form-control required" maxlength="15" type="text" placeholder="Phone 1" value="<?php echo $user_infos[0]['phone_1'];?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="field-1">Mobile</label>
                <div class="col-sm-5">
					<input id="phone_2" name="phone_2" class="form-control" type="text" maxlength="15" placeholder="Phone 2" value="<?php echo $user_infos[0]['phone_2'];?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="field-1">Fax Number</label>
                <div class="col-sm-5">
					<input id="fax_no" name="fax_no" class="form-control" type="text" maxlength="15" placeholder="Fax Number" value="<?php echo $user_infos[0]['fax_no'];?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="field-1">Website</label>
                <div class="col-sm-5">
                    <input id="field-1" name="website" class="form-control" type="text" placeholder="Website" value="<?php echo $user_infos[0]['website'];?>">
                </div>
            </div>
            <h3>Acoount Informations</h3>
			<div class="form-group">
                <label class="col-sm-3 control-label" for="user_name">User Name</label>
                <div class="col-sm-5">
					<label class="error" for="user_name" generated="true" style="display:none;"></label>
					<div id="user_message_uname"  style="display:none;"></div>
                    <input <?php echo($postingType=='Edit'?'disabled':''); ?> id="user_name" name="user_name" maxlength="50" onKeyUp="document.getElementById('user_message_uname').style.display='none'" class="form-control required" type="text" maxlength="25" placeholder="User Name" value="">
                </div>
            </div>
			<?php
			if($postingType == 'Add'){
			?>			
			<div class="form-group">
                <label class="col-sm-3 control-label" for="password">User Password</label>
                <div class="col-sm-5">
					<label class="error" for="pass" generated="true"></label>
                    <input type="password" name="password" id="pass" tabindex="1" maxlength="255" onfocus='this.type="password"' class="form-control required" type="text" maxlength="25" placeholder="User Password" value="">
                </div>
            </div>
			<?php
			}
			?>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="email_id">Email ID</label>
                <div class="col-sm-5">
					<div class="user_msg" id="message" style="display:none;"></div>
					<label class="error" for="email_id" generated="true"></label>
                    <input id="email_id" name="email_id" class="form-control required email" type="text" placeholder="Email ID" value="<?php echo $user_infos[0]['email_id'];?>" onKeyUp="document.getElementById('message').style.display='none'">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="field-1">Description</label>
                <div class="col-sm-5">
                    <textarea style="width: 493px; height: 169px;" name="about_me"><?php echo $user_infos[0]['about_me'];?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="field-1">Image</label>
                <div class="col-sm-5">
					<?php
					if($user_infos[0]['file_1']!='' && file_exists("../assets/uploads/thumb_92_82/".$user_infos[0]['file_1'])){
					?>
					<img src="<?php /*echo $this->config->item('img_path')*/echo frontend_path();?>assets/uploads/thumb_92_82/<?php echo $user_infos[0]['file_1']; ?>">
					<?php
					}else{
					?>
					<img src="<?php /*echo $this->config->item('img_path')*/echo base_url();?>assets/images/no_prof.png">
					<?php
					}
					?>
                    <input type="file" name="user_file_1">		
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="field-1"> Image For Detail Page</label>
                <div class="col-sm-5">
                    <?php
					if($user_infos[0]['file_2']!='' && file_exists("../assets/uploads/thumb_92_82/".$user_infos[0]['file_2'])){
					?>
                    <img src="<?php /*echo $this->config->item('img_path')*/echo frontend_path();?>assets/uploads/thumb_92_82/<?php echo $user_infos[0]['file_2']; ?>">
                    <?php
					}else{
					?>
					<img src="<?php /*echo $this->config->item('img_path')*/echo frontend_path();?>assets/images/no_det.png">
					<?php
					}
					?>
                    <input type="file" name="user_file_2">
                </div>
            </div>
			<?php
			if($postingType=='Edit'){
				$propertyPostingLimit = $user_infos[0]['posting_property_limit'];
			}else{
				$propertyPostingLimit = get_perticular_field_value('zc_settings','meta_value'," and settings_id='3'");
			}
			?>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="field-1">Posting Property Limit</label>
                <div class="col-sm-5">
					<label class="error" for="posting_property_limit" generated="true" style="display:none;"></label>
                    <input id="posting_property_limit" name="posting_property_limit" class="form-control required" type="text" placeholder="Limit Of Property" value="<?php echo $propertyPostingLimit;?>">
                </div>
            </div>
			<?php
			if($postingType=='Edit'){
			?>
			<div class="form-group">
                <label class="col-sm-3 control-label" for="field-1">User Type</label>
                <div class="col-sm-5">
                    <select disabled name="user_type" class="form-control required">
						<option value="1" <?php echo($user_infos[0]['user_type']==1?'selected':''); ?>>Individual User</option>
						<option value="2" <?php echo($user_infos[0]['user_type']==2?'selected':''); ?>>Owner</option>
						<option value="3" <?php echo($user_infos[0]['user_type']==3?'selected':''); ?>>Agency</option>
					</select>
                </div>
            </div>
			<?php
			}
			?>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="field-1">User Status</label>
				<div class="col-sm-5">
					<div style="margin:7px 0 0 0">
						<span style="display:block;">
							<?php echo($user_infos[0]['status']==1?'Active':'Inactive'); ?>
						</span>
						<?php
						if($user_infos[0]['status']!='' && $user_infos[0]['status']==0){
						?>
						<span style="margin:0">
							<strong>Note : </strong>
							<?php echo $user_infos[0]['blocked_note']; ?>
						</span>
						<?php
						}
						?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="field-1">Language setting</label>
				<div class="col-sm-5">
					<select class="form-control" name="language_nm" <?php echo($postingType=='Edit'?'disabled':''); ?>>
						<option value="english" <?php echo($pref_info[0]['language']=='english'?'selected':''); ?>>English</option>
						<option value="it" <?php echo($pref_info[0]['language']=='it'?'selected':''); ?>>Italian</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="field-1">Email Notification Setting</label>
				<div class="col-sm-5">
					<ul class="email_notification">
						<li>
							Send me an email when I receive new messages.
							<span class="badge badge-<?php echo($pref_info[0]['send_me_email']=='1'?'success':'secondary'); ?>">&nbsp;</span>
						</li>
						<li>
							Send me an email when I recieve message replies.
							<span class="badge badge-<?php echo($pref_info[0]['reply_msg']=='1'?'success':'secondary'); ?>">&nbsp;</span>
						</li>
						<li>
							I wish to receive Email alerts.
							<span class="badge badge-<?php echo($pref_info[0]['email_alerts']=='1'?'success':'secondary'); ?>">&nbsp;</span>
						</li>
						<li>
							I wish to receive information and promortional material.
							<span class="badge badge-<?php echo($pref_info[0]['newsletter']=='1'?'success':'secondary'); ?>">&nbsp;</span>
						</li>
					</ul>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label" for="field-1">Privacy Settings</label>
				<div class="col-sm-5">
					<ul class="email_notification">
						<li>
							Make me invisible. (Others will not be able to find and see your page)
							<span class="badge badge-<?php echo($pref_info[0]['invisible']=='1'?'success':'secondary'); ?>">&nbsp;</span>
						</li>
						<li>
							Don't show my address.
							<span class="badge badge-<?php echo($pref_info[0]['my_address_display']=='1'?'success':'secondary'); ?>">&nbsp;</span>
						</li>
						<li>
							Don't show my contact information.
							<span class="badge badge-<?php echo($pref_info[0]['my_contact_info']=='1'?'success':'secondary'); ?>">&nbsp;</span>
						</li>
					</ul>
				</div>
			</div>
            <div class="form-group" align="center"> 
                <button class="btn btn-success" type="submit"><?php echo($postingType=='Edit'?'Update':'Add New'); ?></button>
            </div>
            <?php echo  form_close();?>
        </div>
    </div>
</div>
<div class="modal fade" id="modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Blocked User Note : <?php echo name($user_infos[0]['first_name'], $user_infos[0]['last_name']); ?></h4>
			</div>
			<div class="modal-body">
				<form class="BlockedUserFrm" action="" method="post">
					<div class="col-md-12">
						<div class="form-group no-margin">
							<label class="control-label" for="field-7">Username</label>
							<input type="text" class="form-control" readonly value="<?php echo $user_infos[0]['user_name']; ?>">
						</div>
					</div>
					<div style="clear:both;padding:5px;"></div>
					<div class="col-md-12">
						<div class="form-group no-margin">
							<label class="control-label blcknt" for="field-7">Blocked Note</label>
							<textarea name="blocked_note" class="form-control require" rows="5"></textarea>
						</div>
					</div>
					<div style="clear:both;padding:5px;"></div>
					<div class="col-md-12">
						<div class="form-group no-margin">
							<label class="control-label" for="field-7">&nbsp;</label>
							<input type="hidden" name="type" value="<?php echo $user_infos[0]['user_type']; ?>">
							<input type="hidden" name="page" value="">
							<input type="hidden" name="user_id" value="<?php echo $user_infos[0]['user_id']; ?>">
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
<?php $this->load->view('inc/footer.php'); ?>
<script type="text/javascript">
$(document).ready(function(){
	$.validator.addMethod("alphabetsnspace", function(value, element) {
		 return this.optional(element) || /((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%?"^!-]).{8,20})/.test(value);
	});
	$.validator.addMethod("alphanumeric", function(value, element) {
		return this.optional(element) || /^\w+$/i.test(value);
	});
	$("#register").validate({
		rules: {
			first_name: {
				required: true,
				maxlength: 25
			},last_name:{
				required: true,
				maxlength: 50
			},password: {
				required: true,
				alphabetsnspace: true,
				minlength: 8
			},pass2: {
				required: true,
				minlength: 8,
				equalTo: "#pass"
			},zip: {
				required: true,
				maxlength: 15,
				digits: true
			},contact_ph_no: {
				required: true,
				//phonenumeric: true,
				minlength: 7,
				maxlength: 15			
			},contact_ph_no: {			
				required: true,
				//phonenumeric: true,
				minlength: 7,
				maxlength: 15			
			},phone_1: {			
				required: true,
				//phonenumeric: true,
				minlength: 7,
				maxlength: 15			
			},phone_2: {
				minlength: 7,
				maxlength: 15			
			},fax_no:{			
				minlength: 7,
				maxlength: 15			
			},user_name: {
				required: true,
				alphanumeric: true,
				minlength: 5,
				maxlength: 100
			},vat_number:{
				required: true,
				minlength: 7,
				maxlength: 16
			}
		},messages:{
			password:{
				required:"Please provide a password",
				alphabetsnspace:"Your password must be at least 8 characters long and one capital letter, one number and one symbol like ! ? $ % ^ - @ + _ .",
				minlength:"Your password must be at least 8 characters"
			},pass2:{
				required: "Please provide a password",
				minlength: "Your password must be at least 8 characters",
				equalTo: "Please enter the same password as above"
			},user_name:{
				alphanumeric: "Letters, numbers, and underscores only please.",
			}
		},onfocusout: function (element, event){
			if (element.id === "street_address"){
				this.element(element);
			}else if (element.id === "phone_1"){
				this.element(element);
			}else if (element.id === "user_name"){
				this.element(element);
			}
		}
	});
});
function get_city(id){
	//alert('hello');
	var name=id;
	$.post("<?php echo base_url(); ?>user/city_search", { name: name },function(result){
		//alert(result);
		$('#city').html(result);
	});
}
var categories = [];
$(function() {
	$("#user_name").blur(function() {
		var user_name = $("#user_name").val();
		$("#user_message_uname").hide();
		$("#user_message_uname").html("");
		if (user_name == "" || user_name == null) {
			return false;
		}
		$.ajax({
			type: "post",
			url: "<?php echo base_url();?>user/check_user_avail",
			data: { user_name: user_name },
			async: false,
			success: function(data) {
				$("#user_message_uname").show();
				if (data == 0 && data != "") {
					if($.inArray('user_name', categories)!==-1){
						categories = jQuery.grep(categories, function(value) {
							return value != 'user_name';
						});
					}
				} else {
					if($.inArray('user_name', categories)==-1){
						categories.push('user_name');
					}
					$("#user_message_uname").html("<span style='color:Red;font-weight:normal;'>User Name already taken</span>");
				}
				$('input[type="submit"]').removeAttr('disabled');
			}
		});
	});
	$("#buss_name").blur(function() {
		$("#buss_name_msg_id").hide();
		var buss_name = $("#buss_name").val();
		if (buss_name == "" || buss_name == null) {
			return false;
		}
		$.ajax({
			type: "post",
			url: "<?php echo base_url();?>user/check_bussname_avail",
			data: {
				business_name: buss_name
			},
			async: false,
			success: function(data) {
				$("#buss_name_msg_id").show();
				if (data != '2') {
					if (data == 0) {
						$("#buss_name_msg_id").html("");
					} else {
						$("#buss_name_msg_id").html("<span style='color:Red;font-weight:normal;'>Business Name already taken</span>");
					}
				} else {
					$("#buss_name_msg_id").html("");
				}
				$('input[type="submit"]').removeAttr('disabled');
			}
		});
	});
	$("#vat_no").blur(function() {
		$("#user_message_vat").hide();
		var vat_no = $("#vat_no").val();
		if (vat_no == "" || vat_no == null) {
			return false;
		}
		$.ajax({
			type: "post",
			url: "<?php echo base_url();?>user/check_vat_avail",
			data: {
				vat_no: vat_no
			},
			async: false,
			success: function(data) {
				$("#user_message_vat").show();
				if (data != '2') {
					if (data == 0) {
						$("#user_message_vat").html("");
					} else {
						$("#user_message_vat").html("<span style='color:Red;font-weight:normal;'>VAT Number already taken</span>");
					}
				} else {
					$("#user_message_vat").html("");
				}
				$('input[type="submit"]').removeAttr('disabled');
			}
		});
	});
	$("#email_id").blur(function() {
		var userEmail = $("#email_id").val();
		$("#message").hide();
		$("#message").html("");
		if (userEmail == "" || userEmail == null){
			return false;
		}
		$.ajax({
			type: "post",
			url: "<?php echo base_url();?>user/check_email_avail",
			data: {
				email: userEmail
			},
			async: false,
			success: function(data) {
				$("#message").show();
				if (data == 0) {
					$("#message").html("");
				} else {
					$("#message").html("<span style='color:Red;font-weight:normal;'>Email already taken</span>");
				}
				$('input[type="submit"]').removeAttr('disabled');
			}
		});
	});				
	$("#contact_ph_no").blur(function() {
		$("#contact_ph_message").hide();
		$("#contact_ph_message").html("");
		var a = $("#contact_ph_no").val();
		if (a.length > 6) {
			var filter = /^[0-9+]+$/;
			if (filter.test(a)) {
				return true;
			} else {
				$("#contact_ph_message").show();
				$("#contact_ph_message").html("<span style='color:Red;font-weight:normal;'>This field is required</span>");
				$("#contact_ph_no").val('');
				return false;
			}
			
		}
	});
	$("#phone_1").blur(function() {
		$("#ph_message").hide();
		$("#ph_message").html("");
		var a = $("#phone_1").val();
		if (a.length > 6) {
			var filter = /^[0-9+]+$/;
			if (filter.test(a)) {
				return true;
			} else {
				$("#ph_message").show();
				$("#ph_message").html("<span style='color:Red;font-weight:normal;'>This field is required</span>");
				$("#phone_1").val('');
				return false;
			}
		}
	});
	$("#phone_2").blur(function() {
		$("#ph2_message").hide();
		$("#ph2_message").html("");
		var a = $("#phone_2").val();
		if (a.length > 6) {
			var filter = /^[0-9+]+$/;
			if (filter.test(a)) {
				return true;
			} else {
				$("#ph2_message").show();
				$("#ph2_message").html("<span style='color:Red;font-weight:normal;'></span>");
				$("#phone_2").val('');
				return false;
			}
		}
	});
	$("#fax_no").blur(function() {
		$("#fax_message").hide();
		$("#fax_message").html("");
		var a = $("#fax_no").val();
		if (a.length > 6) {
			var filter = /^[0-9+]+$/;
			if (filter.test(a)) {
				return true;
			} else {
				$("#fax_message").show();
				$("#fax_message").html("<span style='color:Red;font-weight:normal;'></span>");
				$("#fax_no").val('');
				return false;
			}
		}
	});	
});
$('#register').submit(function(){
	if(categories.length>0){
		return false;
	}
});
$(function(){
	setTimeout(function(){
		$(".post-message").fadeOut(1500);
	}, 5000);
});
$('.BlockedUserFrm').submit(function(eFrm){
	if($(this).find('textarea[name="blocked_note"]').val()==''){
		$(this).find('.blcknt').append('<span class="lblReq">This field is required.</span>');
		$(this).find('textarea[name="blocked_note"]').focus();
		return false;		
	}else{
		var type = $(this).find('input[name="type"]').val();
		var page = $(this).find('input[name="page"]').val();
		var userid = $(this).find('input[name="user_id"]').val();
		var blockednote = $(this).find('textarea[name="blocked_note"]').val();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url()?>user/send_blocked_note",
			data: {type:type,page:page,userid:userid,blockednote:blockednote},
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