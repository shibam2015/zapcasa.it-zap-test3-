<?php $this->load->view("_include/meta"); ?>
<style>
#idForm .search-fld textarea.error{border:1px solid red;}
#errorMessage{color:red;display:block;padding:5px 0 3px;visibility:hidden;}
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $("#idForm").submit(function(){
			if($('#message').val()=='' || $('#message').val()=='<?php echo $this->lang->line('contactus_fill_the_form_write_your_message'); ?>'){
				$("#errorMessage").css('visibility', 'visible');
				$('#message').focus();
				return false;
			}
		});
		$("#message").on('change keyup paste', function(){
			if($(this).val()=='' || $(this).val()=='<?php echo $this->lang->line('contactus_fill_the_form_write_your_message'); ?>'){
				$("#errorMessage").css('visibility', 'visible');
			}else{
				$("#errorMessage").css('visibility', 'hidden');
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
    $(document).ready(function() {
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
                phone_number: {
                    required: true
                }
            },
            messages: {
                name: "",
                email_id: "",
                message: "",
                phone_number: ""
            }
        });
    });
</script>
</head>
<body class="noJS">
    <script type="text/javascript">
	var bodyTag = document.getElementsByTagName("body")[0];        
	bodyTag.className = bodyTag.className.replace("noJS", "hasJS");        
    </script>
    <!-- Header part -->
    <?php
	$this->load->view("_include/header"); 
	if($this->session->userdata('delete_inbox_message') != ''){
		$succes_msg = $this->session->userdata('delete_inbox_message');        
		$this->session->unset_userdata('delete_inbox_message');        
	}else{
		$succes_msg = '';        
	}
	?>
    <!-- banner part -->
    <div class="insidepage_banner">
        <div class="main">
            <h2><?php echo $this->lang->line('inbox_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('inbox_jobs');?></font> <?php echo $this->lang->line('inbox_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('inbox_housing');?></font></h2>
        </div>
    </div>
    <!-- login pop up start  -->
    <?php $this->load->view("_include/login_user"); ?>          
    <!-- login pop up end -->
    <!-- body part -->
    <div class="main">
        <div id="breadcrumb" class="fk-lbreadbcrumb newvd">
            <span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('inbox_home');?></a></span> 
            > <span><?php echo $this->lang->line('inbox_archive');?></span>
        </div>
        <!-- Inbox -->
        <div>
            <div class="inbox_area">
                <div>
                    <?php  if($succes_msg!='') { ?>
                    <div class="success" id="successDIV" ><?php echo $succes_msg; ?></div>
                    <?php } ?>
                    <?php if($this->session->flashdata('msg') != ''){?>
                    <div class="success" id="successDIV" ><?php echo $this->session->flashdata('msg');?></div>
                    <?php }?>
                </div>
                <div class="clear"></div>
                <div style="float:left; width:100%; height:40px;">
                    <div class="inbox_tabs">
                        <ul>
                            <li>
								<a href="<?php echo base_url();?>property/get_message">
									<?php echo $this->lang->line('inbox_inbox_tabs_inbox');?>
								</a>
							</li>
							<li>
								<a class="active" href="<?php echo base_url();?>property/get_send_message">
									<?php echo $this->lang->line('inbox_archive');?>
								</a>
							</li>
                            <?php
							$archiveSesUid=$this->session->userdata('user_id');
							$archiveSesUserType=get_perticular_field_value('zc_user','user_type'," and user_id='".$archiveSesUid."'");
							if($archiveSesUserType!='1'){
							?>
							<li>
								<a href="<?php echo base_url();?>My_Feedback">
									<?php echo $this->lang->line('inbox_inbox_tabs_my_feedback');?>
								</a>
							</li>
							<?php } ?>
                        </ul>
                    </div>
                    <div class="search_area">
                        <?php
                            $attributes = array('class' => 'add_property_form', 'id' => 'idForm1');
                            echo form_open_multipart('property/msg_search', $attributes);
                        ?> 
                        <input type="text" name="search_fld" class="search-fld" placeholder="<?php echo $this->lang->line('inbox_property_search_a_message');?>"/>
                        <input type="submit" class="search_img" value="" />
                        <?php echo form_close();?>   
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="advertiser_details save_search_width">
                    <div class="inbox_delete_pagination" id="inbox_delete_pagination" style="height:30px;">
                        <?php
                            $msg_tot=count($send_msg_totals);
                            $perMessage = 10;
							$noOfEntry = $msg_tot;
							if($noOfEntry==1){
								$selectAllToPageString = (($this->uri->segment('3') - $perMessage)>0?"/".($this->uri->segment('3')-$perMessage):"");
								$selectSingleToPageString = (($this->uri->segment('3') - $perMessage)>0?"/".($this->uri->segment('3')-$perMessage):"");
							}else{
								$selectAllToPageString = (($this->uri->segment('3') - $perMessage)>0?"/".($this->uri->segment('3')-$perMessage):"");
								$selectSingleToPageString = "/".$this->uri->segment('3');
							}
                            ?>
							<div class="inbox_delete_pagination_lft" style="width:100%; background:#f2f2f2">
                            <input type="hidden" id="inboxes_del_str" value="">
							<input type="hidden" id="selectAllCheckBox" value="">
							<input type="hidden" id="selectAllToPageString" value="<?php echo $selectAllToPageString; ?>">
							<input type="hidden" id="selectSingleToPageString" value="<?php echo $selectSingleToPageString; ?>">
                            <?php
							
                                if(!empty($msg_tot))
                                
                                {
                                
                                ?>
                            <input type="checkbox" name="checkAll" id="checkAll" onClick="checkAllProperty(this);" style="margin:13px 8px 8px 8px" >
                            <label style="margin-left:5px;"><?php echo $this->lang->line('inbox_message_select_all');?></label>
                            <img src="<?php echo base_url();?>assets/images/delete_icon.png" onClick="return delete_bulk_msg();" style="cursor:pointer; padding: 8px; float:right;" title="<?php echo $this->lang->line('inbox_heading_delete_icon_title');?>" />
                            <?php
                                }
                                
                                ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <table width="100%" border="0" cellspacing="3" cellpadding="3"  id="inbox_msg">
                        <tr class="heading">
                            <td width="4%">&nbsp;</td>
                            <td width="49%"><?php echo $this->lang->line('inbox_inbox_message_subject');?></td>
                            <td width="21%"><?php echo $this->lang->line('inbox_inbox_message_to');?></td>
                            <td width="14%"><?php echo $this->lang->line('inbox_inbox_message_date');?></td>
                        </tr>
				<?php
				 
				if(!empty($send_msg_totals)){
					$i=0;					
					foreach($send_msg_totals as $msg){
						if($i%2==0){
							$class='';
							$sub_class="class='odd_row'";
						}else{
							$class="class='odd_row'";
							$sub_class="";
						}
						?>
                        <tr  <?php echo $class;?> >
                            <td style="vertical-align:top;">
								<input type="checkbox" name="check_box[]" id="check_box[]" class="inboxes" onClick="checkArr('inboxes');" value="<?php echo $msg['msg_id'];?>">
							</td>
                            <td>
							<?php
							if($msg['property_id']!='0'){
								?>
                                <span <?php echo($msg['read_status'] == '0'?'style="cursor:pointer;"':'style="cursor:pointer;"'); ?> onClick="return click_me(<?php echo $msg['msg_id'];?>,<?php echo $msg['property_id'];?>,<?php echo $check_user_from[0]['status'];?>,<?php echo $check_user_to[0]['status'];?>);">
									<?php 
										if(strlen(subject_inbox($msg['property_id'])) > 11)
										{
											echo $this->lang->line('inbox_request_for'),":"; echo subject_inbox($msg['property_id']);
										}
										else
										{
											echo $this->lang->line('prop_not_avilable');
										}
									?>
								</span>
                                <?php
							}else{
								if($msg['subject'] == 0){
									$noProMsgSub = get_perticular_field_value('zc_property_message_info','subject',"and subject !='0' and msg_grp_id = '".$msg['msg_grp_id']."' and msg_to_delete != ' '");
								}else{
									$noProMsgSub = $msg['subject'];
								}
								?>
                                <span <?php echo($msg['read_status'] == '0'?'style="cursor:pointer;"':'style="cursor:pointer;"'); ?> onClick="return click_me(<?php echo $msg['msg_id'];?>,<?php echo $msg['property_id'];?>,<?php echo $check_user_from[0]['status'];?>,<?php echo $check_user_to[0]['status'];?>);">
									<?php echo ucfirst($noProMsgSub);?>
								</span>
                                <?php
							}
							?>
                                <p style="color: rgb(164, 164, 164);">
                                    <?php echo ucfirst(substr($msg['message'],0,50)).'...';?> 
                                </p>
                            </td>
                            <td>
							<?php 
                                $user_name = get_field_value("zc_user","first_name, last_name",$where=" AND user_id='".$msg['user_id_to']."'");
                                $fname=$user_name['first_name']?$user_name['first_name']:'';
								$lname=$user_name['last_name']?$user_name['last_name']:'';								
								echo ucfirst($fname." ". $lname);
                                ?>
							</td>
                            <td>
							<?php
							switch(date('m',strtotime($msg['msg_date']))){
								case '01':
									$monthName = $this->lang->line('cal_jan');
									break;
								case '02':
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
							echo date('d',strtotime($msg['msg_date'])).' '.$monthName.' '.date('Y',strtotime($msg['msg_date']));
							?>
							</td>
                        </tr>
                        <?php
						$i++;
					}
				}else{
					?>
                        <tr>
                            <td colspan='4' style="text-align:center;"><?php echo $this->lang->line('inbox_sorry_your_archive_is_empty');?></td>
                        </tr>
					<?php
				}                            
				?>
                    </table>
                    <div class="inbox_delete_pagination_rht">
					<!-- pagenation -->
					<?php if(isset($links)){echo $links; }?>
                    </div>
                    <table id="bbb" style="display:none;">
                        <div style="display:none;" id="reply_msg" >
                            <?php
							echo form_open_multipart('property/msg_reply', array('class' => 'add_property_form', 'id' => 'idForm'));
							if($check_user_to[0]['status']==1){
								$disable='';
							}else{
								$disable='readonly="true"';
							}
							?>
							<label id="errorMessage"><?php echo $this->lang->line('inbox_this_field_is_required');?></label>
                            <div class="search-fld" style="width:98% !important;"> 
                                <textarea rows="3" <?php echo $disable;?> cols="15" class="required" placeholder="<?php echo $this->lang->line('contactus_fill_the_form_write_your_message');?>" name="message" id="message" style="width: 100%; height: 164px; resize:none;"></textarea> 
                            </div>
                            <div>&nbsp;</div>
                            <div style="float:right;">
								<input type="hidden" name="redirect_to" value="get_send_message">
                                <input type="hidden" name="user_id_form" value="<?php echo $this->session->userdata( 'user_id' );?>" >
                                <input type="hidden" id="msg_id" name="msg_id" value="" >
                                <input type="submit" class="searchbt" value="<?php echo $this->lang->line('inbox_button_submit');?>" >
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </table>
                </div>
            </div>
		<?php
		$google_adsence = get_perticular_field_value('zc_settings','meta_value'," and meta_name='google_adsence'");
		if( isset($google_adsence) && ( count($google_adsence) > 0 )){            
		?>
        <div class="google_add_area"><?php echo "<pre>"; print_r($google_adsence); ?></div>
        <?php
		}
		?>
        <div class="clear"></div>
    </div>
    </div>
    <!-- inbox end -->
    </div>
    <!-- footer part -->
    <?php $this->load->view("_include/footer_search");?>
<script type="text/javascript">
	function delete_msg() {
	   var checkedValues = $('input:checkbox:checked').map(function() {
		   return this.value;
	   }).get();
	   if (checkedValues == '') {
		   alert('<?php echo $this->lang->line('inbox_please_select_message_which_you_want_to_delete');?>');
		   return false;
	   } else {
		   ///////ajax posting/////////////////////
		   $.ajax({
			   type: "POST",
			   url: "<?php echo base_url()?>property/delete_msg", // 
			   data: {
				   msg_id: checkedValues
			   },
			   success: function(msg) {
				   location.reload(true);
				   //$("#thanks").html(msg)  
			   },
			   error: function() {
				   alert("<?php echo $this->lang->line('inbox_there_is_something_wrong');?>");
			   }
		   });
	   }
	}
	
	function delete_pmsg(id) {
	   if (confirm("<?php echo $this->lang->line('inbox_are_you_sure_to_delete_the_conversation');?>")) {
		   // your deletion code
		   var cnt = new Array(id);
		   var pageString = "<?php echo $selectSingleToPageString; ?>";
		   $.ajax({
			   type: "POST",
			   url: "<?php echo base_url()?>property/delete_msg_per", // 
			   data: {
				   msg_id: id
			   },
			   success: function(msg) {
				   //alert(msg);
				   // location.reload(true);
				   if(cnt.length == '<?php echo count($send_msg_totals); ?>' && pageString!='')
			   		{
			   			var page = pageString.split("/");
			   			page = page[1]-10;
			   			var str = "/"+page;
			   			document.getElementById("inboxes_del_str").value = "";
						location.href = "<?php echo base_url().'property/get_send_message'; ?>"+str;
						return;
			   		}
				   location.href = "<?php echo base_url().'property/get_send_message'; ?>"+pageString;
			   },
			   error: function() {
				   alert("<?php echo $this->lang->line('inbox_there_is_something_wrong');?>");
				   //alert("failure");
			   }
		   });
	   }
	   return false;
	   //alert(checkedValues);
	}
	
	function click_me(id, prop_id, user_from, user_to) {
		$("#reply_msg").hide();
		if(user_from=='1' && user_to=='1'){
		   var div_id = "#inbox_msg";
		   $.ajax({
			   type: "POST",
			   url: "<?php echo base_url()?>property/msg_details", // 
			   data: {msg_id: id, lang: '<?php echo $_COOKIE['lang']; ?>'}, // <---
			   success: function(msg) {
				   $(div_id).html(msg);
				   $("#msg_id").val(id);
				   $("#reply_msg").show();
				   $('.inbox_delete_pagination_rht').hide();
			   },
			   error: function() {
				   alert("<?php echo $this->lang->line('inbox_there_is_something_wrong');?>");
				   //alert("failure");
			   }
		   });
		   if (prop_id != 0) {
			   $("#inbox_delete_pagination").html("<a class='view_prop' style='float:left;' title='<?php echo $this->lang->line('inbox_back_to_the_list');?>' onClick='window.location.reload();'>&laquo;</a><a class='msg_del' href='javascript:void(0);'><img title='<?php echo $this->lang->line('inbox_heading_delete_icon_title');?>' style='cursor:pointer;' onclick='return delete_pmsg(" + id + ");' src='<?php echo base_url();?>assets/images/delete_icon.png'></a><a class='view_prop' title='<?php echo $this->lang->line('inbox_message_view_property');?>' href='<?php echo base_url();?>property/view_property/" + id + "'><?php echo $this->lang->line('inbox_message_view_property');?></a>");
			   open_reply();
		   } else {
			   $("#inbox_delete_pagination").html("<a class='view_prop' style='float:left;' title='<?php echo $this->lang->line('inbox_back_to_the_list');?>' onClick='window.location.reload();'>&laquo;</a><a class='msg_del'  href='javascript:void(0);'><img title='<?php echo $this->lang->line('inbox_heading_delete_icon_title');?>' style='cursor:pointer;' onclick='return delete_pmsg(" + id + ");' src='<?php echo base_url();?>assets/images/delete_icon.png'></a></a>");
			   open_reply();
		   }
		}	   
	}
	
	function open_reply() {
	   $("#bbb").show();
	}
	
	$(".success").delay(3200).fadeOut(300);
	
	$(document).ready(function(){setTimeout(function(){$("#successDIV").hide();},4000);});
	
	function checkAllProperty(ca) {
	   type = "inboxes";
	   var cboxes = document.getElementById('inbox_msg').getElementsByTagName('input');
	   for (var i = 0; i < cboxes.length; i++) {
		   if (cboxes[i].type == "checkbox") {
			   cboxes[i].checked = ((ca.checked == true) ? true : false);
			   checkArr(type);
		   }
	   }
	}
	
	function checkArr(type){
		$('#selectAllCheckBox').val('');
		var totalchkBox = $("." + type).length;
		arrInput = "inboxes_del_str";
		var list = "";
		var i = 0;
		$("." + type).each(function(e) {
			if ($(this).is(':checked')) {
				if (i == 0) {
					list = list + $(this).attr('value');
				} else {
					list = list + "|" + $(this).attr('value') + "|";
				}
				i++;
				if(i == totalchkBox){
					$('#selectAllCheckBox').val('all');
				}
			}
		});
		document.getElementById(arrInput).value = list;
	}
	
	function delete_bulk_msg() {
	   var arrInputId = $("#inboxes_del_str").val();
	   var cnt = arrInputId.split("|");
	   if (arrInputId == '') {
		   alert("<?php echo $this->lang->line('inbox_please_select_message_which_you_want_to_delete');?>");
	   } else if (confirm("<?php echo $this->lang->line('inbox_are_you_sure_to_delete_the_conversation');?>") == true) {
		   if($('#selectAllCheckBox').val()=='all'){
				var pageString = $('#selectAllToPageString').val();
			}else{
				var pageString = $('#selectSingleToPageString').val();
			}
		   var urlCustom = "<?php echo base_url()?>property/del_bulk_msg";
		   if (arrInputId != "") {
			   $.ajax({
				   type: "GET",
				   url: urlCustom,
				   data:  'datas='+arrInputId+'&type=to',
				   success: function(msg) {
					   //alert(msg);
					   if(cnt.length == '<?php echo count($send_msg_totals); ?>' && pageString!='')
				   		{
				   			var page = pageString.split("/");
				   			page = page[1]-10;
				   			var str = "/"+page;
				   			document.getElementById("inboxes_del_str").value = "";
							location.href = "<?php echo base_url().'property/get_send_message'; ?>"+str;
							return;
				   		}
					   location.href = "<?php echo base_url().'property/get_send_message'; ?>"+pageString;
				   },
				   error: function() {
					   alert("<?php echo $this->lang->line('inbox_there_is_something_wrong');?>");
				   }
			   });
		   }
	   }
	   return false;
	}
</script>
</body>
</html>
