<div id="toPopup1"> 
	<div class="close1"></div>
	<div id="popup_content1">
		<!--your content start-->
		<p>
			<img src="<?php echo base_url();?>assets/images/character_icon_small.jpg" alt="" style="float:left; padding-right:10px; margin-top:-7px">
			<?php echo $this->lang->line('saved_search_header_name_of_the_saved_search');?>
		</p>
		<span id="main_content_popup_content1" >	
			<div>
				<span><?php echo $this->lang->line('saved_search_field_name_of_the_saved_search');?></span>
				<input type="text" name="saved_property" id="property_name" placeholder="<?php echo $this->lang->line('saved_search_input_field_enter_name_of_saved_search');?>" value="<?php if( isset( $_GET['save_search_name'] ) && ( $_GET['save_search_name'] != '' ) ) { echo $_GET['save_search_name']; } else { echo ''; } ?>">
				<input type="hidden" name="property_name_" id="property_name_" value="<?php if( isset( $_GET['save_search_name'] ) && ( $_GET['save_search_name'] != '' ) ) { echo $_GET['save_search_name']; } else { echo ''; } ?>">
				<input type="hidden" name="save_search_flag" id="save_search_flag" value="<?php if( isset( $_GET['save_search_id'] ) && ( $_GET['save_search_id'] == 0 ) ) { echo 'new_save_search'; } else { echo 'update_save_search'; } ?>" >
			</div>                   		
			<div class="updateing_opt">
			<?php
			if(isset($_GET['save_search_id']) && ($_GET['save_search_id'] != 0)){
				?>
				<input type="submit" name="Save" value="<?php echo $this->lang->line('saved_search_button_save');?>" id="mySubmit">
				<div class="box">
					<p id="modify_search_new_p" style="display:none;" >
						<font style="font-size:12px;"><?php echo $this->lang->line('saved_search_saving');?></font>
						<a href="javascript:void(0);" onclick="javascript: return modify_search(1); " id="modify_search_new">
							<?php echo $this->lang->line('saved_search_want_to_update');?>
						</a>
					</p>
					<p id="modify_search_update_p">
						<font style="font-size:12px;"><?php echo $this->lang->line('saved_search_updating');?></font>
						<a href="javascript:void(0);" onclick="javascript: return modify_search(0); " id="modify_search_update">
							<?php echo $this->lang->line('saved_search_want_to_add_new');?>
						</a>
					</p>
				</div>
				<?php
			}else{				
				?>
				<input type="submit" name="Save" value="<?php echo $this->lang->line('saved_search_button_save');?>" id="mySubmit">
				<?php
			}
			?>	
			</div>
		</span>
	</div>
</div>
<div id="backgroundPopup1"></div>
<style type="text/css">
.updateing_opt .box{float: left; margin: 25px 0 0 20px; width:50%;}
.updateing_opt p{padding: 0px;}
#toPopup1 input[type="button"] {background: url("<?php echo base_url();?>assets/images/searchbt_bg.png") repeat-x scroll 0 0 rgba(0, 0, 0, 0);border: 1px solid #c95d00;border-radius: 4px;color: #ffffff;cursor: pointer;display: block;float: left;font-size: 16px;font-weight: bold;height: 35px;margin-top: 20px;margin-left: 18%;padding: 0 13px;text-transform: uppercase;width: 65%;}
.updateing_opt p a{/*background: none repeat scroll 0 0 #ff8d23;border: 1px solid #ccc;border-radius: 6px;display: block;padding: 5px;*/font-size: 12px;margin-top: -2px;text-align: left !important;color: #ff8d23;text-decoration: underline;}
</style>      
<script type="text/javascript">
function modify_search(str) {
	var property_name = $("#property_name_").val();
	if(	str == 1 ) {
		document.getElementById("property_name").value=property_name;
		document.getElementById("save_search_flag").value="update_save_search";
		document.getElementById("modify_search_new_p").style.display="none";
		document.getElementById("modify_search_update_p").style.display="block";
	} if( str == 0 ) {
		document.getElementById("property_name").value='';
		document.getElementById("save_search_flag").value="new_save_search";
		document.getElementById("modify_search_new_p").style.display="block";
		document.getElementById("modify_search_update_p").style.display="none";
	}	
}	
</script>      