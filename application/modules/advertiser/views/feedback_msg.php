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
<script>
	var bodyTag = document.getElementsByTagName("body")[0];
	bodyTag.className = bodyTag.className.replace("noJS", "hasJS");
</script>
<!------ Header part -------------->
<?php $this->load->view("_include/header"); 

if($this->session->userdata('delete_feedback_message') != '')
{ 
	$succes_msg = $this->session->userdata('delete_feedback_message');
	$this->session->unset_userdata('delete_feedback_message');
}
else
{
	$succes_msg = '';
} ?>
<!------ banner part -------------->
<div class="insidepage_banner">
	<div class="main">
    	<h2><?php echo $this->lang->line('feedback_message_real_estate_for');?> <font style="font-weight:bold;"><?php echo $this->lang->line('feedback_message_jobs');?></font> <?php echo $this->lang->line('feedback_message_and');?> <font style="font-weight:bold;"><?php echo $this->lang->line('feedback_message_housing');?></font></h2>
    </div>
</div>
<!----- login pop up start  ---------------------->
 <?php
 $this->load->view("_include/login_user"); 
 ?>          
<!----- login pop up end ---------------------->

<!------ body part -------------->
<?php 
	if( $this->uri->segment(3) && ($this->uri->segment(3) == "details" ) ) {
		if( $this->uri->segment(2) && is_numeric( $this->uri->segment(2) ) ) {
?>
			<script>
				$(document).ready( function() {
					var msgId = '<?php echo $this->uri->segment(2); ?>';
					click_me(msgId);
				});
			</script>	
<?php 
		}	
	}
?>
<div class="main">
	<div id="breadcrumb" class="fk-lbreadbcrumb newvd">
    	<span><a href="<?php echo base_url();?>"><?php echo $this->lang->line('feedback_message_home');?></a></span> >
        <span> <?php echo $this->lang->line('feedback_message_my_feedback');?></span>		
    </div>
    <!-- Inbox-->
    <div>
    	<div class="inbox_area">
			<div>
		        <?php  if($succes_msg!='') { ?>
		        			<div class="success" id="successDIV" ><?php echo $succes_msg; ?></div>
                            
		  		 <?php } ?>
	     	</div>  
            <div class="clear"></div>
            
            <div style="float: left; width: 100%; height: 40px;">
            	<div class="inbox_tabs">
                	<ul>
                		<li><a href="<?php echo base_url();?>property/get_message"><?php echo $this->lang->line('feedback_message_inbox');?></a></li>					<li><a href="<?php echo base_url();?>property/get_send_message"><?php echo $this->lang->line('inbox_archive');?></a></li>
                    	<li><a class="active" href="<?php echo base_url();?>My_Feedback"><?php echo $this->lang->line('feedback_message_inbox_tab_my_feedback');?></a></li>
                	</ul>
            	</div>
            	<div class="clear"></div>
            </div>
            
            <div class="advertiser_details save_search_width">
       			<div class="inbox_delete_pagination" id="inbox_delete_pagination" style="height:30px;">
					<?php
					$entryPerPage = 10;
					$msg_tot=count($feedback_lists);
					$noOfEntry = $msg_tot;
					if($noOfEntry==1){
						$selectAllToPageString = (($this->uri->segment('2') - $entryPerPage)>0?"/".($this->uri->segment('2')-$entryPerPage):"");
						$selectSingleToPageString = (($this->uri->segment('2') - $entryPerPage)>0?"/".($this->uri->segment('2')-$entryPerPage):"");
					}else{
						$selectAllToPageString = (($this->uri->segment('2') - $entryPerPage)>0?"/".($this->uri->segment('2')-$entryPerPage):"");
						$selectSingleToPageString = "/".$this->uri->segment('2');
					}
					?>
                	<div class="inbox_delete_pagination_lft" style="width:100%; background:#f2f2f2">
                		<input type="hidden" id="feedbacks_del_str" value="">
						<input type="hidden" id="selectAllCheckBox" value="">
						<input type="hidden" id="selectAllToPageString" value="<?php echo $selectAllToPageString; ?>">
						<input type="hidden" id="selectSingleToPageString" value="<?php echo $selectSingleToPageString; ?>">
						<?php
                      if(!empty($feedback_lists)){
					?>
                    	<input type="checkbox" name="checkAll" id="checkAll" onClick="checkAllProperty(this);" style="margin:13px 8px 8px 8px" >
						<label style="margin-left:5px;"><?php echo $this->lang->line('feedback_message_select_all');?></label>
						<img src="<?php echo base_url();?>assets/images/delete_icon.png" onClick="return delete_bulk_msg();" style="cursor:pointer; padding: 8px; float:right;" title="<?php echo $this->lang->line('feedback_message_delete');?>" />
                     <?php
					  }
					?>
                    </div>
                    
                    <div class="clear"></div>
                </div>
                <table width="100%" border="0" cellspacing="3" cellpadding="3"  id="inbox_msg">
                  <tr class="heading">
					  <td width="4%"> </td>
                    <td width="49%"><?php echo $this->lang->line('feedback_message_inbox_subject');?></td>
                    <td width="21%"><?php echo $this->lang->line('feedback_message_inbox_from');?></td>
                    <td width="14%"><?php echo $this->lang->line('feedback_message_inbox_date');?></td>
                   
                  </tr>
                  <?php
                    if(!empty($feedback_lists)){
					$i=0;
                    foreach($feedback_lists as $msg)
                    {
                        if($i%2==0)
                        {
                            $class='';
                            $sub_class="class='odd_row'";
                        }
                        else
                        {
                            $class="class='odd_row'";
                            $sub_class="";
                        }
                  ?>
                  <tr <?php echo $class;?>>
                    <td style="vertical-align:middle;">
						<input type="checkbox" name="check_box[]" id="check_box[]" value="<?php echo $msg['feedback_id'];?>" class="feedbacks" onClick="checkArr('feedbacks');"></td>
                    <td>
                    <span <?php if($msg['read_status'] == '0'){?>style="font-weight:bold;cursor:pointer;"<?php }else{ ?>style="cursor:pointer;"<?php }?> onClick="return click_me(<?php echo $msg['feedback_id'];?>);"><?php echo ucfirst($msg['feedback_subject']);?></span>
                   
                    <p style="color: rgb(164, 164, 164);">
					<?php echo ucfirst(substr($msg['feedback_msg'],0,50)).'...';?> 
                    </p>
                    </td>
                    <td><?php echo ucfirst($msg['user_name']);?></td>
                    <td>
					<?php
					switch(date('m',strtotime($msg['feedback_date']))){
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
						echo date('d',strtotime($msg['feedback_date'])).' '.$monthName.' '.date('Y',strtotime($msg['feedback_date']));
						?>
						</td>
					</tr>
                  <tr id="msg_det_<?php echo $msg['feedback_id'];?>" style="display:none; background-color:#3D8AC1" onClick="return close_me(<?php echo $msg['feedback_id'];?>);">
                    <td colspan="4">
                    
                    <span style="color:#FFFFFF"><?php echo $this->lang->line('feedback_message_message_details');?>: </span><?php echo ucfirst($msg['message']);?><br>
                    <span style="color:#FFFFFF"><?php echo $this->lang->line('feedback_message_email_id');?>: </span><?php echo $msg['email_id'];?><br>
                    </td>
                  </tr>
                  <?php
                  $i++;
                    }
                    }
                    else
                    {
                  ?>
                  <tr>
                  <td colspan='4' style="text-align:center;"><?php echo $this->lang->line('feedback_message_sorry_your_inbox_is_empty');?></td>
                  </tr>
                  <?php
                    }
                    ?>
                 
                </table>
                <div class="inbox_delete_pagination_rht inbox_pagination">
					<!--pagenation-->
					<?php if(isset($links)){echo $links; }?>
				</div>
 </div>
        		
        </div>
		<?php
		$google_adsence = get_perticular_field_value('zc_settings','meta_value'," and meta_name='google_adsence'");
		if( isset($google_adsence) && ( count($google_adsence) > 0 )){ ?>
        <div class="google_add_area"><?php echo "<pre>"; print_r($google_adsence); ?></div>
        <?php } ?>
        <div class="clear"></div>
    </div>
      
</div>

<!-- inbox end -->
    </div>

<!------ footer part -------------->

<?php $this->load->view("_include/footer_search");?>
<!------- pagination js ------------------>

<script type="text/javascript">
function delete_msg(){
	var checkedValues = $('input:checkbox:checked').map(function() {
		return this.value;
	}).get();
	//alert(checkedValues);	
	if(checkedValues==''){
		alert('<?php echo $this->lang->line('feedback_message_please_select_message_which_you_want_to_delete');?>');
		return false;	}else{		///////ajax posting/////////////////////
		$.ajax({
            type: "POST",
            url: "<?php echo base_url()?>advertiser/delete_feedback", // 
            data: {msg_id: checkedValues }, // <---
            success: function(msg){
				//alert(msg);
				location.reload(true);
				//$("#thanks").html(msg)
            },error: function(){
				alert("<?php echo $this->lang->line('feedback_message_there_is_something_wrong');?>");
                //alert("failure");
            }
        });
	}	//alert(checkedValues);
}
function delete_pmsg(id){
	if (confirm("<?php echo $this->lang->line('feedback_message_are_you_sure_to_delete_the_conversation');?>")== true) {
		var cnt = new Array(id);
		var pageString = "<?php echo $selectSingleToPageString; ?>";
        $.ajax({
            type: "GET",
            url: "<?php echo base_url()?>advertiser/del_bulk_msg",
            data: {dataField:id},
            success: function(msg){
				// location.reload(true);  
			   if(cnt.length == '<?php echo count($send_msg_totals); ?>' && pageString!='')
		   		{
		   			var page = pageString.split("/");
		   			page = page[1]-10;
		   			var str = "/"+page;
		   			document.getElementById("inboxes_del_str").value = "";
					location.href = "<?php echo base_url().'My_Feedback'; ?>" + str;
					return;
		   		}
				location.href = "<?php echo base_url().'My_Feedback'; ?>" + pageString;
            },error: function(e){
				alert("<?php echo $this->lang->line('feedback_message_there_is_something_wrong');?>");
            }
        });
	}
    return false;
}

function click_me(id){
	$('.inbox_delete_pagination_rht').hide();
	var div_id="#inbox_msg";
	$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>advertiser/feedback_details", //
		data: {msg_id: id, lang: '<?php echo $_COOKIE['lang']; ?>'},
		success: function(msg){
			$(div_id).html(msg); 
			$("#msg_id").val(id);
		},error:function(e){
			alert("<?php echo $this->lang->line('feedback_message_there_is_something_wrong');?>");
			//alert("failure");
		}
	});
	if(typeof id != "undefined" && id!=0 ){
		$("#inbox_delete_pagination").html("<a class='view_prop' style='float:left;' title='<?php echo $this->lang->line('inbox_back_to_the_list');?>' onClick='window.location.reload();'>«</a><a class='msg_del' href='javascript:void(0);'><img title='<?php echo $this->lang->line('inbox_heading_delete_icon_title');?>' style='cursor:pointer;' onclick='return delete_pmsg(" + id + ");' src='<?php echo base_url();?>assets/images/delete_icon.png'></a>");
		//open_reply();
	}else{
		$("#inbox_delete_pagination").html("<a class='msg_del'  href='javascript:void(0);'></a>");
		open_reply();
	}
}
/*function open_reply(){
	$("#bbb").show();
}*/
$(".success").delay(3200).fadeOut(300);

$(document).ready(function(){
	setTimeout(function(){$("#successDIV").hide();},4000);
});

function checkAllProperty(ca) {	type="feedbacks";
	var cboxes=document.getElementById('inbox_msg').getElementsByTagName('input');
	for (var i =0; i < cboxes.length; i++) {
		if(cboxes[i].type == "checkbox"){
			cboxes[i].checked=((ca.checked==true)? true : false);
			checkArr(type);
		}
	}
}

function checkArr(type){
	$('#selectAllCheckBox').val('');
	var totalchkBox = $("." + type).length;
	arrInput = "feedbacks_del_str";
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

function delete_bulk_msg(){
	var arrInputId = $("#feedbacks_del_str").val();
	var cnt = arrInputId.split("|");
	if(arrInputId == ''){
		alert("<?php echo $this->lang->line('feedback_message_please_select_message_which_you_want_to_delete');?>");
	} else if(confirm("<?php echo $this->lang->line('feedback_message_are_you_sure_to_delete_the_conversation');?>") == true){
		if($('#selectAllCheckBox').val()=='all'){
			var pageString = $('#selectAllToPageString').val();
		}else{
			var pageString = $('#selectSingleToPageString').val();
		}
		var urlCustom = "<?php echo base_url()?>advertiser/del_bulk_msg";
		if( arrInputId != "" ) {
			$.ajax({
				type: "GET",
				url: urlCustom,
				data: {dataField: arrInputId },
				success: function(msg){
					if(cnt.length == '<?php echo count($feedback_lists); ?>' && pageString!='')
			   		{
			   			var page = pageString.split("/");
			   			page = page[1]-10;
			   			var str = "/"+page;
			   			document.getElementById("feedbacks_del_str").value = "";
						location.href = "<?php echo base_url().'My_Feedback'; ?>"+str;
						return;
			   		}
					document.getElementById("feedbacks_del_str").value = "";
					location.href = "<?php echo base_url().'My_Feedback'; ?>"+pageString;
				},error: function(){
					alert("<?php echo $this->lang->line('feedback_message_there_is_something_wrong');?>");
				}
			});
		}
	}
	return false;
}
</script>
</body>
</html>
