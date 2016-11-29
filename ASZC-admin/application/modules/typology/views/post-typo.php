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
				$headerTitle = "Update ".$typo_infos[0]['name'];
			}else{
				$headerTitle = 'Add New Typology';
			}
			?>
			<h3><?php echo $headerTitle; ?></h3>
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
		$attributes = array('class' => 'form-horizontal form-groups-bordered', 'id' => 'TypoFormID','role'=>"form");
		if($postingType == 'Edit'){
			echo form_open_multipart('typology/update_typology/'.$this->uri->segment('3'), $attributes);
		}else{
			echo form_open_multipart('typology/add_typology', $attributes);
		}
		$category_code_array = array();
		if(!empty($typo_infos)){
			$category_code_array = explode(",",$typo_infos[0]['category_code']);
		}		
		?>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="field-1">Category Type</label>
			<div class="controls col-sm-6">
				<label for="category_code[]" class="error" style="display:none;width:100%;"></label>
				<div class="clearfix"></div>
				<div class="checkbox">
					<label>
						<input class="category_code" type="checkbox" name="category_code[]" value="RES" <?php echo(in_array("RES",$category_code_array)?'checked':''); ?>>
						Residential
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input class="category_code" type="checkbox" name="category_code[]" value="PRO" <?php echo(in_array("PRO",$category_code_array)?'checked':''); ?>>
						Property for business
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input class="category_code" type="checkbox" name="category_code[]" value="BLI" <?php echo(in_array("BLI",$category_code_array)?'checked':''); ?>>
						Business license
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input class="category_code" type="checkbox" name="category_code[]" value="ROM" <?php echo(in_array("ROM",$category_code_array)?'checked':''); ?>>
						Rooms
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input class="category_code" type="checkbox" name="category_code[]" value="LAND" <?php echo(in_array("LAND",$category_code_array)?'checked':''); ?>>
						Land
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input class="category_code" type="checkbox" name="category_code[]" value="VAC" <?php echo(in_array("VAC",$category_code_array)?'checked':''); ?>>
						Vacations
					</label>
				</div>
			</div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label" for="field-1">Typology Name (English)</label>
            <div class="col-sm-5">
				<label class="error" for="name" generated="true"></label>
                <input id="name" name="name" class="form-control required" maxlength="255" type="text" placeholder="Typlogy Name In Englisg" value="<?php echo(!empty($typo_infos)?stripslashes($typo_infos[0]['name']):''); ?>">
            </div>
        </div>
		<div class="form-group">
            <label class="col-sm-3 control-label" for="field-1">Typology Name (Italian)</label>
            <div class="col-sm-5">
				<label class="error" for="name_it" generated="true"></label>
                <input id="name_it" name="name_it" class="form-control required" maxlength="255" type="text" placeholder="Typlogy Name In Italian" value="<?php echo(!empty($typo_infos)?stripslashes($typo_infos[0]['name_it']):''); ?>">
            </div>
        </div>
        <div class="form-group" align="center"> 
            <button class="btn btn-success" type="submit"><?php echo($postingType=='Edit'?'Update':'Add New'); ?></button>
        </div>
        <?php echo  form_close(); ?>
    </div>
</div>
<script>
$(document).ready(function(){
	$.validator.addMethod("alphabetsnspace", function(value, element) {
        return this.optional(element) || /((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%?._+\"^!-]).{8,20})/.test(value);
	});
	$.validator.addMethod("alphanumeric", function(value, element) {
		return this.optional(element) || /^\w+$/i.test(value);
	});
	$("#TypoFormID").validate({
		rules: {
			"category_code[]": {
				required: true,
				minlength: 1
			},name: {
				required: true
			},name_it: {
				required: true
			}
		}
	});	
});
$(function(){
	setTimeout(function(){
		$(".post-message").fadeOut(1500);
	}, 5000);
});
</script>
<?php $this->load->view('inc/footer.php'); ?>
