<?php $this->load->view('inc/header.php'); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<div class="main-content">
	<div class="row">
		<!-- Profile Info and Notifications -->
		<div class="col-md-6 col-sm-8 clearfix">
			<h3><?php echo $user_infos[0]['user_name'];?></h3>
			<?php
			if($user_infos[0]['user_id']!=''){
			?>
			<h5>
                <a href="<?php echo base_url();?>user/view_message/<?php echo $user_infos[0]['user_id']; ?>" class="btn btn-green btn-icon btn-xs" title="See all messages of this user">
					<i class="entypo-mail"></i>View All Messages
				</a>
                <?php if($user_infos[0]['user_type']!='1'){ ?>
				<a href="<?php echo base_url();?>property/probyuser-<?php echo $user_infos[0]['user_id']; ?>/all" title="See all properties of this user" class="btn btn-black btn-icon btn-xs">
					<i class="fa fa-archive"></i>View All Properties
				</a>
                <?php } ?>
                <a href="<?php echo base_url();?>user/edit_profile/<?php echo $user_infos[0]['user_id']; ?>" class="btn btn-default editbtn btn-sm btn-icon btn-xs" title="Click here to edit">
					<i class="entypo-pencil"></i>Edit user profile
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
    <hr>
    <div class="panel panel-primary">
        <div class="panel-body">
            <div id="message_content">
                <ul>
                    <li><a href="<?php echo site_url('/user/view_message').'/'.$user_infos[0]['user_id']; ?>">Inbox</a></li>
                    <li><a href="<?php echo site_url('/user/feedback').'/'.$user_infos[0]['user_id']; ?>">My Feedback</a></li>
                </ul>
                <?php //echo "<pre>";print_r($this->uri->segment(3));?>
                <?php 	if( $this->uri->segment(2) && $this->uri->segment(2) != "feedback" ) { ?>
                <div id="inbox">
                    <table width="100%" border="0" cellspacing="3" cellpadding="3"  id="inbox_msg">
                        <tr class="heading">
                            <td width="4%">&nbsp;</td>
                            <td width="49%">Subject</td>
                            <td width="21%">From</td>
                            <td width="14%">Date</td>
                        </tr>
                        <?php 
                            if( isset($msg_totals) && ( count($msg_totals) ) > 0 ) {
                            
                            	$i=1;
                            
                            	foreach($msg_totals as $msg) {
                            
                            		if($i%2==0) {
                            
                            			$class='';
                            
                            			$sub_class="class='odd_row'";
                            
                            		} else {
                            
                            			$class="class='odd_row'";
                            
                            			$sub_class="";
                            
                            		}
                            
                            ?>		
                        <tr  <?php echo $class;?> >
                            <td>&nbsp;<?php //echo $i; ?></td>
                            <td>
                                <?php
                                    if($msg['property_id']!='0') {
                                    
                                    ?>
                                <span style="font-weight:bold;cursor:pointer;" onClick="return details_message(<?php echo $msg['msg_id'];?>,<?php echo $msg['property_id'];?>);">Request for: <?php echo subject_inbox($msg['property_id']);?></span>
                                <?php
                                    } else {
                                    
                                    ?>
                                <span style="font-weight:bold;cursor:pointer;" onClick="return details_message(<?php echo $msg['msg_id'];?>,<?php echo $msg['property_id'];?>);">Subject:<?php echo ucfirst($msg['subject']);?></span>
                                <?php
                                    }
                                    
                                    ?>
                                <p style="color: rgb(164, 164, 164);">
                                    <?php echo ucfirst(substr($msg['message'],0,50)).'...';?> 
                                </p>
                            </td>
                            <td><?php echo ucfirst($msg['user_name']);?></td>
                            <td><?php echo date('d/m/Y',strtotime($msg['msg_date']));?></td>
                        </tr>
                        <tr id="msg_det_<?php echo $msg['msg_id'];?>" style="display:none; background-color:#3D8AC1" onClick="return close_me(<?php echo $msg['msg_id'];?>);">
                            <td colspan="4">
                                <span style="color:#FFFFFF">Message Detail: </span><?php echo ucfirst($msg['message']);?><br>
                                <span style="color:#FFFFFF">Email Id: </span><?php echo $msg['email_id'];?><br>
                                <span style="color:#FFFFFF">Phone Number: </span><?php echo $msg['ph_number'];?>
                            </td>
                        </tr>
                        <?php 
                            $i++;
                            
                            }
                            
                            } else {
                            
                            ?>
                        <tr>
                            <td colspan="4" style="font-size: 1.2em; color: #EE3A43; text-align:center; " ><strong>No Message Found!.</strong></td>
                        </tr>
                        <?php 
                            } 
                            
                            ?>
                        <td colspan="4" >
                            <div class="row pagination-inbox" >
                                <div class="col-md-12 col-md-offset-5">
                                    <ul class="pagination">
                                        <?php echo $pagination?>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </table>
                </div>
                <?php } else { ?>
                <div id="inbox">
                    <table width="100%" border="0" cellspacing="3" cellpadding="3"  id="feedback_msg">
                        <tr class="heading">
                            <td width="4%">&nbsp;</td>
                            <td width="49%">Subject</td>
                            <td width="21%">From</td>
                            <td width="14%">Date</td>
                        </tr>
                        <?php 
                            if( count($feedback_totals) > 0 ) {
                            
                            	$i=1;
                            
                            	foreach($feedback_totals as $msg) {
                            
                            		if($i%2==0) {
                            
                            			$class='';
                            
                            			$sub_class="class='odd_row'";
                            
                            		} else {
                            
                            			$class="class='odd_row'";
                            
                            			$sub_class="";
                            
                            		}
                            
                            ?>	
                        <tr  <?php echo $class;?> >
                            <td>&nbsp;<?php //echo $i; ?></td>
                            <td>
                                <span style="font-weight:bold;cursor:pointer;" onClick="return feedback_msg_details(<?php echo $msg['feedback_id'];?>);">Subject:<?php echo ucfirst($msg['feedback_subject']);?></span>     
                                <p style="color: rgb(164, 164, 164);">
                                    <?php echo ucfirst(substr($msg['feedback_msg'],0,50)).'...';?> 
                                </p>
                            </td>
                            <td><?php echo ucfirst($msg['user_name']);?></td>
                            <td><?php echo date('d/m/Y',strtotime($msg['feedback_date']));?></td>
                        </tr>
                        <tr id="msg_det_<?php echo $msg['feedback_id'];?>" style="display:none; background-color:#3D8AC1" onClick="return close_me(<?php echo $msg['feedback_id'];?>);">
                            <td colspan="4">
                                <span style="color:#FFFFFF">Message Detail: </span><?php echo ucfirst($msg['feedback_msg']);?><br>
                                <span style="color:#FFFFFF">Email Id: </span><?php echo $msg['user_email'];?><br>
                                <span style="color:#FFFFFF">User Name: </span><?php echo $msg['user_name'];?>
                            </td>
                        </tr>
                        <?php $i++; } ?>
                        <?php } else { ?>	
                        <tr>
                            <td 
                            <td colspan="4" style="font-size: 1.2em; color: #EE3A43; text-align:center;" ><strong>No Message Found!.</strong></td>
                        </tr>
                        <?php } ?>	
                        <td colspan="4" >
                            <div class="row pagination-feedback">
                                <div class="col-md-12 col-md-offset-5">
                                    <ul class="pagination">
                                        <?php echo $paginationB?>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </table>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('inc/footer.php'); ?>
<script type="text/javascript">
function details_message(id,prop_id) {
	var div_id="#inbox_msg"; 
	$.ajax({    
		type: "POST",    
		url: "<?php echo base_url()?>user/msg_details",    
		data: {msg_id: id },
		// <---    
		success: function(msg){
			$(div_id).html(msg); 
			$("#msg_id").val(id);
		},error: function(){    
			alert("there is something wrong");    
			//alert("failure");    
		}
	});
}    
function feedback_msg_details(id,prop_id) {    
	var div_id="#feedback_msg";    
	$.ajax({
		type: "POST",
		url: "<?php echo base_url()?>user/feedback_details", //     
		data: {msg_id: id }, // <---
		success: function(msg){
			$(div_id).html(msg);
			$("#msg_id").val(id
		},error: function(){
			alert("there is something wrong");
			//alert("failure");
		}
	});
}    
</script>
