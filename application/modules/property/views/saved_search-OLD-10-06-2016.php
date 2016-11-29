<?php $this->load->view("_include/meta"); ?>
<style>
#idForm .search-fld textarea.error {
border:1px solid red;
}



</style>
<script type="text/javascript">
$(document).ready(function() {	
$("#idForm").validate({
				rules: {
					
					message: {
					required: true
					}
				},
				messages: {
					
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

<script type="text/javascript">
$(function(){
	$(window).scroll(function(){
		var scrollTop = $(document).scrollTop();
		//var searchListHeight = $('.searchresult_box').height();
		//$('.topbluebar').html(scrollTop);
		if(scrollTop >= 40 && scrollTop <= 1385){
			$('.map-cont').css({
				position : 'fixed',
				top : '120px',
				width : '32.7%',
			});
		} else {
			$('.map-cont').css({
				position : 'relative',
				top : '1335px',
				width : '100%',
			});
			if(scrollTop < 40){
				$('.map-cont').removeAttr('style');
			}
		}
	});
});
</script>
<script type="text/javascript">

$(document).ready(function()
{
	
	$("#mail_form").validate({
				rules: {
					name: {
					required: true
					},
					email_id: {
					required: true,
					email: true
					},
					message: {
					required: true
					},
					phone_number:{
						required:true
					}
				},
				messages: {
					name: "",
					email_id: "",
					message: "",
					phone_number:""
				}
			});
	
	$("#showcase").awShowcase(
	{
		content_width:			464,
		content_height:			376,
		fit_to_parent:			false,
		auto:					false,
		interval:				3000,
		continuous:				false,
		loading:				true,
		tooltip_width:			200,
		tooltip_icon_width:		32,
		tooltip_icon_height:	32,
		tooltip_offsetx:		18,
		tooltip_offsety:		0,
		arrows:				false,
		buttons:				true,
		btn_numbers:			true,
		keybord_keys:			true,
		mousetrace:				false, /* Trace x and y coordinates for the mouse */
		pauseonover:			true,
		stoponclick:			true,
		transition:				'vslide', /* hslide/vslide/fade */
		transition_delay:		500,
		transition_speed:		500,
		show_caption:			'onhover', /* onload/onhover/show */
		thumbnails:				true,
		thumbnails_position:	'outside-last', /* outside-last/outside-first/inside-last/inside-first */
		thumbnails_direction:	'vertical', /* vertical/horizontal */
		thumbnails_slidex:		0, /* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
		dynamic_height:			false, /* For dynamic height to work in webkit you need to set the width and height of images in the source. Usually works to only set the dimension of the first slide in the showcase. */
		speed_change:			true, /* Set to true to prevent users from swithing more then one slide at once. */
		viewline:				false /* If set to true content_width, thumbnails, transition and dynamic_height will be disabled. As for dynamic height you need to set the width and height of images in the source. */
	});
	
	

});
</script>
<script type="text/javascript">
	$(document).ready(function() {

		$('.fancybox').fancybox();
	});
</script>
</head>

<body class="noJS">
<script>
var bodyTag = document.getElementsByTagName("body")[0];
bodyTag.className = bodyTag.className.replace("noJS", "hasJS");
</script>
<!------ Header part ------------->
<!------ Header part ------------->
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
<!------ banner part ------------->
<div class="insidepage_banner">
	<div class="main">
    	<h2><?php echo $this->lang->line('saved_search_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('saved_search_jobs');?></font> <?php echo $this->lang->line('saved_search_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('saved_search_housing');?></font></h2>
    </div>
</div>
<!----- login pop up start  --------------------->
 <?php
 $this->load->view("_include/login_user"); 
 ?>          
<!----- login pop up end --------------------->

<!------ banner part 
<div class="insidepage_banner">
	<div class="main">
    	<h2>Real Estate for <font style="font-weight:bold;">jobs</font> & <font style="font-weight:bold;">Housing</font></h2>
    </div>
</div>
------------->
<!------ body part ------------->

<div class="main">
	<div id="breadcrumb" class="fk-lbreadbcrumb newvd">
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('saved_search_home');?></a></span> 
        ><span>  <?php echo $this->lang->line('saved_search_header_saved_searches');?></span>
    </div>
    <!--<h2 class="pagetitle">Registration</h2>-->
    <!-- Inbox-->
    <div>
    <ul class="listing-tabs">
        <li><a href="<?php echo base_url();?>property/get_saved_property"><?php echo $this->lang->line('saved_search_listing_tab_saved_properties');?></a></li>
 		<li class="active"><a href="<?php echo base_url();?>property/get_saved_search"><?php echo $this->lang->line('saved_search_listing_tab_saved_searches');?></a></li>
     
        <?php /*?><li><a href="<?php echo base_url();?>users/my_email_alerts">My email alerts</a></li><?php */?>
        <!--<li><a href="#"></a>My preferences</li>
        <li class="delete-tab"><a href="#">Delete account</a></li>-->
    </ul>

    	<div class="inbox_area">
         
			 <?php  if($succes_msg!='') { ?>
		        			<div class="success" id="successDIV" ><?php echo $succes_msg; ?></div>
                            
		  	 <?php } ?>
             
             
              <?php  if($update_msg!='') { ?>
		        			<div class="success" id="updateDIV" ><?php echo $update_msg; ?></div>
                            
		  	 <?php } ?>
           
            <div class="clear"></div>
            
            <div>
              <div class="inbox_tabs">
                <ul>
                   <!-- <li><a class="active" href="<?php //echo base_url();?>property/get_message">Inbox</a></li>-->
<!--                    <li><a href="#">Reply</a></li>
                    <li><a href="#">Search</a></li>
                    <li><a href="javascript:void(0);" onClick="return delete_msg();">Delete</a></li>-->
                </ul>
            </div>
            
            <!--<div class="search_area">
            <?php
                    /*$attributes = array('class' => 'add_property_form', 'id' => 'idForm1');
					echo form_open_multipart('property/msg_search', $attributes);*/
					?> 
            	<input type="text" name="search_fld" class="search-fld" placeholder="Search a message"/>
                <input type="submit" class="search_img" value="" />
             <?php /*echo form_close();*/?>   
            </div>-->
            <div class="clear"></div>
            </div>
            <div class="advertiser_details save_search_width">
              <span style="font-size:12px;">
                  <?php echo $this->lang->line('saved_search_active_the_email_alert_service');?><br />
                  <strong style="font-weight:bold;"><?php echo $this->lang->line('saved_search_active_the_email_alert_service_note');?></strong> <?php echo $this->lang->line('saved_search_active_the_email_alert_service_note_content');?>
					</span><br /><br />
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
							$entryCounter = 1;							$i=1;
							$j=0;														$entryPerPage = 10;
							$noOfEntry = count($saved_lsits);							if($noOfEntry==1){								$toPageString = (($this->uri->segment('3') - $entryPerPage)==0?"":"/".($this->uri->segment('3')));							}else{								$toPageString = "/".$this->uri->segment('3');							}							
							 foreach($saved_lsits as $saved_list){
								  if($j%2==0){
										$class1='';
									}else{
										$class1="class='odd_row'";
									}
									?>						<tr <?php echo $class1;?>>
                        <td><?php echo ($entryCounter + $this->uri->segment('3'));?></td>
                        <td>						<?php						switch(date('m',strtotime($saved_list['saved_date']))){							case '01':								$monthName = $this->lang->line('cal_jan');								break;							case '02':								$monthName = $this->lang->line('cal_feb');								break;							case '03':								$monthName = $this->lang->line('cal_mar');								break;							case '04':								$monthName = $this->lang->line('cal_apr');								break;							case '05':								$monthName = $this->lang->line('cal_may');								break;							case '06':								$monthName = $this->lang->line('cal_jun');								break;							case '07':								$monthName = $this->lang->line('cal_jul');								break;							case '08':								$monthName = $this->lang->line('cal_aug');								break;							case '09':								$monthName = $this->lang->line('cal_sep');								break;							case '10':								$monthName = $this->lang->line('cal_oct');								break;							case '11':								$monthName = $this->lang->line('cal_nov');								break;							case '12':								$monthName = $this->lang->line('cal_dec');								break;									}						echo date('d',strtotime($saved_list['saved_date'])).' '.$monthName.' '.date('Y',strtotime($saved_list['saved_date']));						?>						</td>
                        <td><?php echo  $saved_list['saved_property_name'];?></td>						<td>
                        <?php
							$attributes = array('class' => 'save_search_modify_form', 'id' => 'save_search_modify_form_');
							echo form_open_multipart('property/save_search_modify', $attributes);
							?> 
							<input type="hidden" name="save_search_id"  value="<?php echo $saved_list['saved_id'];?>" />
                        	<div class="mask"><button class="modify" type="submit" ><?php echo $this->lang->line('saved_search_button_modify');?></button></div>
                        <?php echo form_close();?>
                        </td>
                        <td>
							<div class="mask">								<button class="delete __DelSaveSearch" id="<?php echo $saved_list['saved_id'];?>" onClick="return delete_saved(<?php echo $saved_list['saved_id'];?>,'<?php echo $toPageString; ?>');">									<?php echo $this->lang->line('saved_search_button_delete');?>								</button>							</div>						</td>
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
					  		$i++;														$entryCounter++;							
							 }
						?>
							<tr colspan="6"></tr>
						<?php 	 
						}
						else
						{
					  ?>
                      <tr>
                          <td colspan="6" style="text-align:center;"><?php echo $this->lang->line('saved_search_sorry_no_records_found');?></td>
                      </tr>
                      <?php
						}						
					  ?>
 
			</table>			<?php			if(!empty($saved_lsits)){						?>						<div class="row pagination-inbox">							<div class="col-md-12 col-md-offset-5">								<div class="inbox_delete_pagination_rht">									<?php echo $pagination; ?>								</div>							</div>						</div>						<?php						}			?>
                
 </div>
        		
        </div>
        <?php /*
        <div class="google_add_area">
        	<span class="google_ad"><img src="<?php echo base_url();?>asset/images/google_ad_300x250.jpg" width="300" height="250" alt=""></span>
        </div>
        */ ?>
        <?php 
		$google_adsence = get_perticular_field_value('zc_settings','meta_value'," and meta_name='google_adsence'"); 
		if( isset($google_adsence) && ( count($google_adsence) > 0 ) ) {
		?>
			<div class="google_add_area">
			<?php 
				echo "<pre>";
				print_r($google_adsence);
			?>
			</div>
	<?php } ?> 
        <div class="clear"></div>
    </div>
      
</div>

<!--inbox end-->
    
    
	
    </div>

<!------ footer part ------------->

<?php $this->load->view("_include/footer_search");?>
<!------- pagination js ----------------->

<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.paginate.js"></script>
<script type="text/javascript">
$(function() {
	$("#demo5").paginate({
		count 		: 10,
		start 		: 1,
		display     : 7,
		border					: true,
		border_color			: '#fff',
		text_color  			: '#fff',
		background_color    	: 'black',	
		border_hover_color		: '#ccc',
		text_hover_color  		: '#000',
		background_hover_color	: '#fff', 
		images					: false,
		mouse					: 'press',
		onChange     			: function(page){
		$('._current','#paginationdemo').removeClass('_current').hide();
		$('#p'+page).addClass('_current').show();
	}
	});
});

function delete_msg()
{
	var checkedValues = $('input:checkbox:checked').map(function() {
    return this.value;
		}).get();
	//alert(checkedValues);	
	if(checkedValues=='')
	{
		alert('<?php echo $this->lang->line('saved_search_please_select_message_which_you_want_to_delete');?>');
		return false;
	}
	else
	{
		
	///////ajax posting/////////////////////
	 $.ajax({
            type: "POST",
            url: "<?php echo base_url()?>property/delete_msg", // 
            data: {msg_id: checkedValues }, // <---
            success: function(msg){
				 location.reload(true);
                //$("#thanks").html(msg)  
            },
            error: function(){
				alert("<?php echo $this->lang->line('saved_search_there_is_something_wrong');?>");
                //alert("failure");
            }
        });
	}
	
//alert(checkedValues);
}

function click_me(id)
{
	var div_id="#inbox_msg";
	 $.ajax({
            type: "POST",
            url: "<?php echo base_url()?>property/msg_details", // 
            data: {msg_id: id }, // <---
            success: function(msg){
				$(div_id).html(msg); 
				$("#msg_id").val(id);
            },
            error: function(){
				alert("<?php echo $this->lang->line('saved_search_there_is_something_wrong');?>");
                //alert("failure");
            }
        });
		
		
	
	
	$("#inbox_delete_pagination").html("<a href='javascript:void(0);' class='inbox_delete_pagination_lft' onClick='return open_reply();'><img src='<?php echo base_url();?>assets/images/reply.png' title='<?php echo $this->lang->line('saved_search_image_reply');?>'></a><a class='view_prop' href='<?php echo base_url();?>property/view_property/"+id+"'><?php echo $this->lang->line('saved_search_view_property');?></a>");
}

function open_reply()
{
	$("#bbb").show();
}

$(".success").delay(3200).fadeOut(300);

function delete_saved(id,pageString){
	if(confirm("<?php echo $this->lang->line('are_you_sure_text');?>")){
		$.ajax({
			type: "POST",
			url: "<?php echo base_url()?>property/delete_saved_search",
			data: {saved_id: id},
			success: function(msg){	//alert("<?php //echo $this->lang->line('saved_search_delete_message'); ?>");
				location.href = '<?php echo base_url().'property/get_saved_search'; ?>'+pageString;
			},error: function(){
				alert("<?php echo $this->lang->line('saved_search_there_is_something_wrong');?>");
				//alert("failure");
			}
		});
		//delete here
		return true;
	}else{
		return false;
	}
}

function update(value,id)
{
	 $.ajax({
            type: "POST",
            url: "<?php echo base_url()?>property/update_save_rec", // 
            data: {value: value,id:id }, // <---
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
