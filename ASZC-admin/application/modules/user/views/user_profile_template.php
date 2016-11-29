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
				$headerTitle = ucfirst($user_infos[0]['user_name']);
			}else{
				$headerTitle = 'Add new user - Individual';
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
    <div class="panel-body">
        <?php
		$attributes = array('class' => 'form-horizontal form-groups-bordered', 'id' => 'register','role'=>"form");
		if($postingType == 'Edit'){
			echo form_open_multipart('user/update_general_user/'.$this->uri->segment('3'), $attributes);
		}else{
			echo form_open_multipart('user/add_general_user', $attributes);
		}		
		?>
        <!--<form class="form-horizontal form-groups-bordered" role="form">-->
        <div class="form-group">
            <label class="col-sm-3 control-label" for="field-1">First Name</label>
            <div class="col-sm-5">
				<label class="error" for="first_name" generated="true"  style="display:none;"></label>
                <input id="first_name" name="first_name" class="form-control required" maxlength="255" type="text" placeholder="First Name" value="<?php echo $user_infos[0]['first_name'];?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="field-1">Last Name</label>
            <div class="col-sm-5">
				<label class="error" for="last_name" generated="true"></label>
                <input id="last_name" name="last_name" class="form-control required" maxlength="255" type="text" placeholder="Last Name" value="<?php echo $user_infos[0]['last_name'];?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="field-1">Date Of Birth</label>
            <div class="col-sm-3">
                <div class="input-group">
					<label class="error" for="date_of_birth" generated="true"></label>
                    <input type="text" id="date_of_birth" class="form-control required datepicker" name="date_of_birth" value="<?php echo $user_infos[0]['date_of_birth'];?>">
                    <div class="input-group-addon">
                        <a href="#"><i class="entypo-calendar"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="field-1">Gender</label>
            <div class="col-sm-5">
                <input type="radio" name="gender" value="0" <?php if($user_infos[0]['gender']==0){?>checked="checked"<?php }?>>Male
                <input type="radio" name="gender" value="1" <?php if($user_infos[0]['gender']==1){?>checked="checked"<?php }?>>Female
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="field-1">Country</label>
            <div class="col-sm-5">
				<label class="error" for="country" generated="true"></label>
                <select id="country" name="country" class="form-control required">
                    <option value="">Please select your Country</option>
                    <?php
					foreach($countries as $country){
					?>
                    <option value="<?php echo $country['id_countries'];?>" <?php echo($country['id_countries']==$user_infos[0]['country']?'selected':''); ?>>
						<?php echo stripslashes($country['name']); ?>
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
                <input id="city" name="city" class="form-control required" type="text" placeholder="City" value="<?php echo stripslashes($user_infos[0]['city']); ?>"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="field-1">Telephone</label>
            <div class="col-sm-5">
				<label class="error" for="ph_no" id="ph_message" generated="true"></label>
				<span id="spnPhoneStatus1"></span>
                <input id="ph_no" maxlength="15" type="text" min="7" name="contact_ph_no" class="form-control required" type="text" placeholder="Contact Number" value="<?php echo $user_infos[0]['contact_ph_no'];?>">
            </div>
        </div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="field-1">User Name</label>
			<div class="col-sm-5">
				<label class="error" for="username" generated="true"></label>
				<div class="user_msg" id="user_message" style="display:none;"></div>
				<input <?php echo($postingType=='Edit'?'disabled':''); ?> id="username" name="user_name" class="form-control" type="text" placeholder="Username" value="<?php echo $user_infos[0]['user_name'];?>">
			</div>
		</div>
		<?php
		if($postingType == 'Add'){
		?>			
		<div class="form-group">
			<label class="col-sm-3 control-label" for="first_name">User Password</label>
			<div class="col-sm-5">
				<label class="error" for="pass" generated="true"></label>
				<input type="password" name="password" id="pass" tabindex="1" maxlength="255" onfocus='this.type="password"' class="form-control required" type="text" maxlength="25" placeholder="User Password" value="">
			</div>
		</div>
		<?php
		}
		?>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="field-1">Email ID</label>
            <div class="col-sm-5">
				<div class="user_msg" id="email_message" style="display:none;"></div>
				<label class="error" for="email1" generated="true"></label>
                <input id="email1" name="email_id" class="form-control required" type="text" placeholder="Email ID" value="<?php echo $user_infos[0]['email_id'];?>">
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
					<option value="2" <?php echo($user_infos[0]['user_type']==3?'selected':''); ?>>Agency</option>
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
					<span style="display:block;"><?php echo($user_infos[0]['status']==1?'Active':'Inactive'); ?></span>
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
					<option value="english" <?php echo($pref_info[0]['language']==1?'selected':''); ?>>English</option>
					<option value="it" <?php echo($pref_info[0]['language']==2?'selected':''); ?>>Italian</option>
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
        <div class="form-group" align="center"> 
            <button class="btn btn-success" type="submit"><?php echo($postingType=='Edit'?'Update':'Add New'); ?></button>
        </div>
        <?php echo  form_close(); ?>
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
<script>
$(document).ready(function() {	
	$.validator.addMethod("alphabetsnspace", function(value, element) {
        return this.optional(element) || /((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%?._+\"^!-]).{8,20})/.test(value);
	});
	$.validator.addMethod("alphanumeric", function(value, element) {
		return this.optional(element) || /^\w+$/i.test(value);
	});
	$("#register").validate({
		rules: {
			password: {
				required: true,
				alphabetsnspace: true,
				minlength: 8
			},
			pass2: {
				required: true,
				minlength: 8,
				equalTo: "#pass"
			},	
			user_name: {
				required: true,
				alphanumeric: true,
				minlength: 5,
				maxlength: 100
			},
			ph_no: {
				//required: true,
				//alphanumeric: true,                               
				minlength: 7,
				maxlength: 15
			},
		},
		messages: {
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
		}
	});	
});
var categories = [];
$(function() {
	$("#username").blur(function() {
		var user_name=$("#username").val();
		$("#user_message").hide();
		$("#user_message").html("");
		if(user_name == "" || user_name == null ) {
			return false;
		}else if(user_name == "Enter your User Name"){
			return false;
		}  
		$.ajax({
			type:"post",
			url:"<?php echo base_url();?>user/check_user_avail",
			data: { user_name:user_name },
			async: false,
			success:function(data){
				$("#user_message").show();
				if(data==0){
					if($.inArray('username', categories)!==-1){
						categories = jQuery.grep(categories, function(value) {
							return value != 'username';
						});
					}
				}
				else{
					$("#user_message").html("<span style='color:Red;font-weight:normal'>User Name already taken</span>");
					if($.inArray('username', categories)==-1){
						categories.push('username');
					}
				}
				$('input[type="submit"]').removeAttr('disabled');
			}
		});
	});
	$("#email1").blur(function() {
		$("#email_message").hide();
		$("#email_message").html("");
		var email=$("#email1").val();
		var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		if (filter.test(email)) { }else{
			$('#email1').css( "border", "1px solid red" );
			$('#email1').attr("placeholder","Proper Email Address Required");
			$( "#email1").keyup(function() {
				$('#email1').css( "border", "1px #AACA9E solid" );
				$('input[type="submit"]').removeAttr('disabled');
			});
			return false;
		}		
		if(email == "" || email == null ) {
			return false;
		}
		$.ajax({
			type:"post",
			url:"<?php echo base_url();?>user/check_email_avail",
			data: { email:email },
			async: false,
			success:function(data){
				$("#email_message").show();
				if(data==0){ }else{
					$("#email_message").html("<span style='color:Red;font-weight:normal;'>Email already taken</span>");
				}
				$('input[type="submit"]').removeAttr('disabled');
			}
		});
	});	
	$("#ph_no").blur(function(){
		$("#ph_message").hide();
		$("#ph_message").html("");
		var a = $("#ph_no").val();
		if(a.length>6){
			var filter = /^[0-9+]+$/;
			if (filter.test(a)) {
				return true;
			}else{
				$("#ph_message").show();
				$("#ph_message").html("<span style='color:Red;font-weight:normal;'></span>");
				$( "#ph_no").val('');
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
<?php $this->load->view('inc/footer.php'); ?>
