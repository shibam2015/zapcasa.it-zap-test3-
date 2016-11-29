<?php $this->load->view("_include/meta"); ?>
<style>
#idForm .search-fld textarea.error{border:1px solid red;}
</style>
<script type="text/javascript">
$(document).ready(function() {
	$("#idForm").validate({
		rules: {
			message: {
				required: true
			}
		},messages: {
			message: ""
		}
	});
	$('#nav li').hover(function() {
		$('ul', this).slideDown(200);
		$(this).children('a:first').addClass("hov");
	}, function() {
		$('ul', this).slideUp(100);
		$(this).children('a:first').removeClass("hov");
	});
});
</script>
</head>
<body class="noJS">
<script>
	var bodyTag = document.getElementsByTagName("body")[0];
	bodyTag.className = bodyTag.className.replace("noJS", "hasJS");
</script>
<!-- Header part -->
<?php $this->load->view("_include/header");

if($this->session->userdata('delete_saved_search_message') != '')
{ 
	$succes_msg = $this->session->userdata('delete_saved_search_message');
	$this->session->unset_userdata('delete_saved_search_message');
}
else
{
	$succes_msg = '';
}

if($this->session->userdata('update_saved_property_message') != '')
{ 
	$update_msg = $this->session->userdata('update_saved_property_message');
	$this->session->unset_userdata('update_saved_property_message');
}
else
{
	$update_msg = '';
}
?>
<!-- banner part -->
<div class="insidepage_banner">
	<div class="main">
    	<h2><?php echo $this->lang->line('saved_search_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('saved_search_jobs');?></font> <?php echo $this->lang->line('saved_search_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('saved_search_housing');?></font></h2>
    </div>
</div>
<!-- login pop up start -->
<?php $this->load->view("_include/login_user"); ?>          
<!-- login pop up end -->
<!-- body part -->
<div class="main">
	<div id="breadcrumb" class="fk-lbreadbcrumb newvd">
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('saved_search_home');?></a></span> 
        ><span> <?php echo $this->lang->line('saved_search_header_saved_searches');?></span>
    </div>
    <!-- Inbox -->
    <div>
    <ul class="listing-tabs">
        <li><a href="<?php echo base_url();?>property/get_saved_property"><?php echo $this->lang->line('saved_search_listing_tab_saved_properties');?></a></li>
 		<li class="active"><a href="<?php echo base_url();?>property/get_saved_search"><?php echo $this->lang->line('saved_search_listing_tab_saved_searches');?></a></li>
    </ul>

    	<div class="inbox_area">
		<?php if($succes_msg!='') { ?>
            <div class="success" id="successDIV" ><?php echo $succes_msg; ?></div>
		<?php } ?>
        <?php if($update_msg!='') { ?>
            <div class="success" id="updateDIV" ><?php echo $update_msg; ?></div>
		<?php } ?>
            <div class="clear"></div>
            
            <div class="advertiser_details save_search_width"><span style="font-size:12px;"><?php echo $this->lang->line('saved_search_active_the_email_alert_service');?><br /><strong style="font-weight:bold;"><?php echo $this->lang->line('saved_search_active_the_email_alert_service_note');?></strong> <?php echo $this->lang->line('saved_search_active_the_email_alert_service_note_content');?></span><br /><br />
				<table width="100%" border="0" cellspacing="3" cellpadding="3">
					<tr class="heading">
					<td width="12%"><?php echo $this->lang->line('saved_search_saved_search_no');?></td>
					<td width="18%"><?php echo $this->lang->line('saved_search_saved_search_date');?></td>
					<td width="54%"><?php echo $this->lang->line('saved_search_saved_search_name');?></td>   
					<td width="8%">&nbsp;</td>
					<td width="8%">&nbsp;</td>
					<td width="8%">&nbsp;</td>
				</tr>
				<?php
				if(!empty($saved_lsits)){
					$entryCounter = 1;
					$i=1;
					$j=0;
					$entryPerPage = 10;
					$noOfEntry = count($saved_lsits);
					if($noOfEntry==1){
						$toPageString = (($this->uri->segment('3') - $entryPerPage)==0?"":"/".($this->uri->segment('3')));
					}else{
						$toPageString = "/".$this->uri->segment('3');
					}
					foreach($saved_lsits as $saved_list){
						if($j%2==0){
							$class1='';
						}else{
							$class1="class='odd_row'";
					} ?>
				<tr <?php echo $class1;?>>
					<td><?php echo ($entryCounter + $this->uri->segment('3'));?></td>
					<td><?php
						switch(date('m',strtotime($saved_list['saved_date']))){
							case '01':
								$monthName = $this->lang->line('cal_jan');
								break;
								$monthName = $this->lang->line('cal_feb');
								break;
							case '03':
								$monthName = $this->lang->line('cal_mar');
								break;
							case '04':
								$monthName = $this->lang->line('cal_apr');
								break;
							case '05':
								$monthName = $this->lang->line('cal_may');
								break;
							case '06':
								$monthName = $this->lang->line('cal_jun');
								break;
							case '07':
								$monthName = $this->lang->line('cal_jul');
								break;
							case '08':
								$monthName = $this->lang->line('cal_aug');
								break;
							case '09':
								$monthName = $this->lang->line('cal_sep');
								break;
							case '10':
								$monthName = $this->lang->line('cal_oct');
								break;
							case '11':
								$monthName = $this->lang->line('cal_nov');
								break;
							case '12':
								$monthName = $this->lang->line('cal_dec');
								break;
						}
						echo date('d',strtotime($saved_list['saved_date'])).' '.$monthName.' '.date('Y',strtotime($saved_list['saved_date']));
					?></td>
					<td><?php echo  $saved_list['saved_property_name'];?></td>
					<td><?php
						$attributes = array('class' => 'save_search_modify_form', 'id' => 'save_search_modify_form_');
						echo form_open_multipart('property/save_search_modify', $attributes);
						?> 
						<input type="hidden" name="save_search_id"  value="<?php echo $saved_list['saved_id'];?>" />
                        <div class="mask"><button class="modify" type="submit" ><?php echo $this->lang->line('saved_search_button_modify');?></button></div>
                        <?php echo form_close();?>
					</td>
					<td>
						<?php if(count($saved_lsits) == 1 && $toPageString != '') { 
							$str = explode("/", $toPageString);													
							if($str[1] == 0)
								$str = '';
							else
							{
								$str = $str[1]-10;
								$str = "/".$str;
							}							
						?>
							<div class="mask"><button class="delete __DelSaveSearch" id="<?php echo $saved_list['saved_id'];?>" onClick="return delete_saved(<?php echo $saved_list['saved_id'];?>,'<?php echo $str; ?>');"><?php echo $this->lang->line('saved_search_button_delete');?></button></div>
						<?php } else { ?>
							<div class="mask"><button class="delete __DelSaveSearch" id="<?php echo $saved_list['saved_id'];?>" onClick="return delete_saved(<?php echo $saved_list['saved_id'];?>,'<?php echo $toPageString; ?>');"><?php echo $this->lang->line('saved_search_button_delete');?></button></div>
						<?php } ?>
					</td>
					<td>
						<select id="rec_<?php echo $saved_list['saved_id'];?>" name="recomendation" style="width:120px;" onChange="return update(this.value,<?php echo $saved_list['saved_id'];?>);">
							<option value="0" <?php if($saved_list['rec_option']=='0'){?>selected<?php }?>><?php echo $this->lang->line('saved_search_recommendation_select');?></option>
							<option value="1" <?php if($saved_list['rec_option']=='1'){?>selected<?php }?>><?php echo $this->lang->line('saved_search_recommendation_daily');?></option>
							<option value="2" <?php if($saved_list['rec_option']=='2'){?>selected<?php }?>><?php echo $this->lang->line('saved_search_recommendation_weekly');?></option>
						</select>
					</td>
				</tr>
                <?php
                $j++;
				$i++;
				$entryCounter++;							
                } ?>
				<tr colspan="6">
                </tr>
                <?php }else{ ?>
				<tr>
					<td colspan="6" style="text-align:center;"><?php echo $this->lang->line('saved_search_sorry_no_records_found');?></td>
				</tr>
				<?php }?>
			</table>
            <?php if(!empty($saved_lsits)){?>
            	<div class="row pagination-inbox">
                	<div class="col-md-12 col-md-offset-5">
                    	<div class="inbox_delete_pagination_rht"><?php echo $pagination; ?></div>
                    </div>
                </div>
            <?php } ?>
            </div>
        		
        </div>
        <?php 
			$google_adsence = get_perticular_field_value('zc_settings','meta_value'," and meta_name='google_adsence'"); 
			if( isset($google_adsence) && ( count($google_adsence) > 0 ) ) {
			?>
		<div class="google_add_area"><?php echo "<pre>"; print_r($google_adsence);?></div>
		<?php } ?> 
        <div class="clear"></div>
    </div>
</div>
<!-- inbox end -->
</div>
<!-- footer part -->
<?php $this->load->view("_include/footer_search");?>
<script type="text/javascript">
function delete_saved(id,pageString){
	if(confirm("<?php echo $this->lang->line('are_you_sure_text');?>")){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url()?>property/delete_saved_search",
			data: {saved_id: id},
			success: function(msg){
				location.href = '<?php echo base_url().'property/get_saved_search'; ?>'+pageString;
			},
			error: function(){
				alert("<?php echo $this->lang->line('saved_search_there_is_something_wrong');?>");
			}
		});
		return true;
	}else{
		return false;
	}
}
function update(value,id){
	$.ajax({
		type: "POST",
 		url: "<?php echo base_url()?>property/update_save_rec",
		data: {value: value,id:id },
		success: function(msg){
			location.reload();
		},
		error: function(){
			alert("failure");
		}
	});
}
$(document).ready(function() {	
	setTimeout(function(){$("#successDIV").hide();},4000);
	setTimeout(function(){$("#updateDIV").hide();},4000);
});
</script>
</body>
</html>
