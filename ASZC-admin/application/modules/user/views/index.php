<?php $this->load->view('inc/header.php'); ?>
<style type="text/css">
.editbtn{padding-right:18px !important;}
.btn-info.unverified {background-color: #ff9600;color: #000000;}
.btn-info.unverified.btn-icon i{background-color: #cc7800;}
.btn-info.inactive {background-color: #ddbebe;color: #000000;}
.btn-info.inactive.btn-icon i{background-color: #A08282;}
.filterTbl{color: #0859db;display: table;float: left;font-weight: bold;line-height: 26px;margin-bottom: 15px;}
.filterTbl a{display: table-cell;padding: 0 5px;}
.filterTbl a.selected{text-decoration:underline;}
.filterTbl a:first-child{color:#666666;}
.lblReq {color: red;margin: 0 0 0 10px;}
</style>
<div class="main-content">
	<div class="row">
		<!-- Profile Info and Notifications -->
		<div class="col-md-6 col-sm-8 clearfix">
			<h3>View <?php echo ucfirst($type); ?> Users</h3>
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
	<div class="post-message error" id="error_msg" style="text-align:center;">
		<?php echo $this->session->flashdata('msg_flash');?>
	</div>
	<hr/>
	<span class="filterTbl">
		<a <?php echo($activetype=='all'?'class="selected"':''); ?> href="<?php echo base_url().'user/'.$type.'/all'; ?>">
			All (<?php echo $allFilterUser; ?>)
		</a>
		-
		<a <?php echo($activetype=='enabled'?'class="selected"':''); ?> href="<?php echo base_url().'user/'.$type.'/enabled'; ?>">
			Active (<?php echo $enbldFilterUser; ?>)
		</a>
		-
		<a <?php echo($activetype=='disabled'?'class="selected"':''); ?> href="<?php echo base_url().'user/'.$type.'/disabled'; ?>">
			Inactive (<?php echo $dsbldFilterUser; ?>)
		</a>
		-
		<a <?php echo($activetype=='notverified'?'class="selected"':''); ?> href="<?php echo base_url().'user/'.$type.'/notverified'; ?>">
			Not Activated (<?php echo $inactFilterUser; ?>)
		</a>
	</span>
	<span id="search" style="float:right;margin-bottom:15px;">
		<form method="get" action="<?php echo base_url();?>user/user_search/all/all">
			<input type="text" name="search_input" class="search-input" placeholder="UserName, First Name, Last Name, Email, VAT or Social security" style="width:400px" value="<?php echo $search_input; ?>">
			<button type="submit">
				<i class="entypo-search"></i>
			</button>
		</form>
	</span>
	<table class="table table-bordered table-striped datatable" id="table-2" width="100%">
		<thead>
			<tr>
				<th><b>Username</b></th>
				<th><b>Full Name</b></th>
				<th><b>User Type</b></th>
				<th><b>Email</b></th>
				<?php
				if($type!='individual' && $type!='admin'){
				echo(($type=='agency' || $type=='all')?'<th><b>VAT Number</b></th>':'');
				echo(($type=='owner' || $type=='all')?'<th><b>Social security number</b></th>':'');
				}
				?>
				<th <?php echo(($type=='all' || $type=='owner' || $type=='agency')?'style="width:280px;"':''); ?>>
					<b>Actions</b>
				</th>
			</tr>
		</thead>
		<tbody>
	<?php
	$popups1 = NULL;
	$popups2 = NULL;
	if(!empty($users)){
		$page = $this->uri->segment('4');
				
		$pageLink = '/'.$type.'/'.$activetype.($page==''?'':'/'.$page);
		$i=0;            
		foreach ($users as $user){
			$i++;
			if($user->verified == '0'){
				$btn_class = 'unverified';
				$css_class = "entypo-lock-open";
				$title = "Not activated user";
				$Login_Status='Not Activated';
				$tdBG = 'style="background:#FFF5E8;"';
				$Login_Status_Link = 'href="javascript:void(0);"';
			}else{
				if($user->status == '1'){
					$btn_class = '';
					$css_class ="entypo-lock-open";
					$title = "Click here to inactive";
					$Login_Status='Active&nbsp;&nbsp;';
					$tdBG = '';
					$Login_Status_Link = 'data-toggle="modal" data-target="#modal2-'.$i.'" href="javascript:void(0);"';
				}else{
					$btn_class = 'inactive';
					$css_class = "entypo-lock";
					$title = "Click here to active";
					$Login_Status='Inactive';
					$tdBG = 'style="background:#FFEDED;"';
					$Login_Status_Link = 'href="'.site_url('/user/statuschange/').'/'.$user->user_id.$pageLink.'" Onclick="return confirm(\'Are you sure want change status.\')"';
				}
			}				
			?>
			<tr>
				<td <?php echo $tdBG; ?>>
					<?php echo $user->user_name?>
				</td>
				<td <?php echo $tdBG; ?>>
					<?php echo name($user->first_name, $user->last_name)?>
				</td>
				<td <?php echo $tdBG; ?>>
					<?php 
					if($user->user_type == '1')echo 'General';
					elseif($user->user_type == '2')echo 'Owner';
					elseif($user->user_type == '3')echo 'Company';
					elseif($user->user_type == '4')echo 'Admin';
					?>
				</td>
				<td <?php echo $tdBG; ?>><?php echo $user->email_id?></td>
				<?php
				if($type!='individual' && $type!='admin'){
					echo(($type=='agency' || $type=='all')?'<td '.$tdBG.'>'.$user->vat_number.'</td>':'');
					echo(($type=='owner' || $type=='all')?'<td '.$tdBG.'>'.$user->social_secuirity_number.'</td>':'');
				}
				?>
				<td <?php echo $tdBG; ?>>
					<a data-toggle="modal" data-target="#modal1-<?php echo $i; ?>" href="javascript:void(0);" class="btn btn-default editbtn btn-sm btn-icon btn-xs" title="Click here to view">
						<i class="entypo-search"></i>&nbsp;
					</a>
					<?php
					if($user->verified == '1'){
						if($user->user_type == '4'){
						?>
						<a data-toggle="modal" data-target="#modalUpdateAdmin" href="javascript:void(0);" class="btn btn-default editbtn btn-sm btn-icon btn-xs" title="Click here to edit">
							<i class="entypo-pencil"></i>&nbsp;
						</a>
						<?php
						}else{
						?>
						<a href="<?php echo site_url('/user/edit_profile').'/'.$user->user_id; ?>" class="btn btn-default editbtn btn-sm btn-icon btn-xs" title="Click here to edit">
							<i class="entypo-pencil"></i>&nbsp;
						</a>
						<?php
						}
					}
					if($user->user_type != '4'){
					?>
					<a <?php echo $Login_Status_Link; ?> class="btn btn-info <?php echo $btn_class; ?> btn-sm btn-icon btn-xs" title="<?php echo $title; ?>">
						<i class="<?php echo $css_class; ?>"></i><?php echo $Login_Status; ?>
					</a>
					<a href="<?php echo base_url();?>user/delete_user/<?php echo $user->user_id.$pageLink;?>" class="btn btn-red btn-sm btn-icon btn-xs" onclick="return confirm('Are your sure?')">
						<i class="entypo-cancel"></i>Delete
					</a>
					<a href="<?php echo base_url();?>user/view_message/<?php echo $user->user_id;?>" title="See all messages of this user" class="btn btn-green editbtn btn-sm btn-icon btn-xs">
						<i class="entypo-mail"></i>&nbsp;
					</a>
					<?php
					if($user->user_type=='2' || $user->user_type=='3'){
					?>
					<a href="<?php echo base_url();?>property/probyuser-<?php echo $user->user_id;?>/all" title="See all properties of this user" class="btn btn-black editbtn btn-sm btn-icon btn-xs">
						<i class="fa fa-archive" style="width:26px;"></i>&nbsp;
					</a>
					<?php
					}else{
					?>
					<a href="javascript:void(0);" class="btn btn-default disabled editbtn btn-sm btn-icon btn-xs">
						<i style="width:26px;"></i>&nbsp;
					</a>
					<?php
					}
					}					
					?>
				</td>
			</tr>
			<?php
$popups1.= '<div class="modal fade" id="modal1-'.$i.'">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">'.name($user->first_name, $user->last_name).'</h4>
						</div>
						<div class="modal-body">
							<div class="col-md-12">
								<div class="form-group no-margin">
									<label class="control-label" for="field-7">Username</label>
									<input type="text" class="form-control" readonly value="'.$user->user_name.'">
								</div>
							</div>
							<div style="clear:both;padding:5px;"></div>
							<div class="col-md-12">
								<div class="form-group no-margin">
									<label class="control-label" for="field-7">Date Of Birth</label>
									<input type="text" class="form-control" readonly value="'.date('d/m/Y', strtotime($user->date_of_birth)).'">
								</div>
							</div>
							<div style="clear:both;padding:5px;"></div>
							<div class="col-md-12">
								<div class="form-group no-margin">
									<label class="control-label" for="field-7">Gender</label>
									<input type="text" class="form-control" readonly value="'.($user->gender=='0'?'Male':'Female').'">
								</div>
							</div>
							<div style="clear:both;padding:5px;"></div>
							<div class="col-md-12">
								<div class="form-group no-margin">
									<label class="control-label" for="field-7">Registration Date</label>
									<input type="text" class="form-control" readonly value="'.date('d/m/Y', strtotime($user->registered_on)).'">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>            
						</div>
					</div>
				</div>
            </div>';
$popups2.= '<div class="modal fade" id="modal2-'.$i.'">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Blocked User Note : '.name($user->first_name, $user->last_name).'</h4>
						</div>
						<div class="modal-body">
							<form class="BlockedUserFrm" action="" method="post">
								<div class="col-md-12">
									<div class="form-group no-margin">
										<label class="control-label" for="field-7">Username</label>
										<input type="text" class="form-control" readonly value="'.$user->user_name.'">
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
										<input type="hidden" name="type" value="'.$type.'">
										<input type="hidden" name="page" value="'.$page.'">
										<input type="hidden" name="user_id" value="'.$user->user_id.'">
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
            </div>';
		}
	}else{
		?>
        <tr>
            <td colspan="7" align="center" height="100"> No records found.</td>
        </tr>
        <?php
	}
	?>
    </tbody>
</table>
	<div class="row">
		<div class="col-md-12 col-md-offset-5">
			<ul class="pagination">
				<?php echo $pagination?>
			</ul>
		</div>
	</div>
	<!-- Modal 6 (Long Modal)-->
	<?php $this->load->view('inc/footer.php'); ?>
	<?php echo $popups1; ?>
	<?php echo $popups2; ?>
	<script type="text/javascript">
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
