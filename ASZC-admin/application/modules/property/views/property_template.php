<?php $this->load->view('inc/header.php'); ?>
<style type="text/css">
.success{margin-bottom:10px; background-color:#006868; color:#ffea52; border:#CCC solid 1px; text-align:center;}
.editbtn{padding-right:18px !important;}
.btn-success.suspended {background-color: #ff9600;color: #000000;}
.btn-success.suspended.btn-icon i{background-color: #cc7800;}
.btn-success.inactive {background-color: #ddbebe;color: #000000;}
.btn-success.inactive.btn-icon i{background-color: #A08282;}
.makefeature{background:#90b6ce}
.makefeature i{background:#50809E !important}
.btn-info.inactive {background-color: #ddbebe;color: #000000;}
.btn-info.inactive.btn-icon i{background-color: #A08282;}
.filterTbl{color: #0859db;display: table;float: left;font-weight: bold;line-height: 26px;margin-bottom: 15px;}
.filterTbl a{display: table-cell;padding: 0 5px;}
.filterTbl a.selected{text-decoration:underline;}
.filterTbl a:first-child{color:#666666;}
.lblReq {color: red;margin: 0 0 0 10px;}
.propertyName .img {float: left;width: 100px;}
.propertyName .img img {height: 100px;width: 100px;}
.propertyName .title {float: right;width: 300px;}
.propertyName .title h5 {font-size: 12px;font-weight: bold;margin: 0;}
.propertyName .title h6 {margin: 0;}
.propertyName .title p {color: #999999;margin: 0;}
</style>
<div class="main-content">
	<div class="row">
		<!-- Profile Info and Notifications -->
		<div class="col-md-6 col-sm-8 clearfix">
			<h3><?php echo $pageBlockTitle; ?></h3>
			<?php
			if(isset($user_infos[0]['user_id']) && $user_infos[0]['user_id']!=''){
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
				<a href="<?php echo base_url();?>user/edit_profile/<?php echo $user_infos[0]['user_id']; ?>" style="width:120px;" class="btn btn-default editbtn btn-sm btn-icon btn-xs" title="Click here to edit">
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
    
	<hr/>
	<div class="post-message" style="text-align:center;background:#00a651;color:#FFFFFF;">
		<?php echo $this->session->flashdata('success');?>
	</div>
	<div class="post-message error" id="error_msg" style="text-align:center;">
		<?php echo $this->session->flashdata('msg_flash');?>
	</div>
	<span class="filterTbl">
		<a <?php echo($activetype=='all'?'class="selected"':''); ?> href="<?php echo base_url().'property/'.($type==''?'all':$type).'/all'.($search_property_code!=''?'?search_property_code='.$search_property_code:''); ?>">
			All (<?php echo $allFilterProperty; ?>)
		</a>
		-
		<a <?php echo($activetype=='activepro'?'class="selected"':''); ?> href="<?php echo base_url().'property/'.($type==''?'all':$type).'/activepro'.($search_property_code!=''?'?search_property_code='.$search_property_code:''); ?>">
			Published (<?php echo $activeFilterProperty; ?>)
		</a>
		-
		<a <?php echo($activetype=='inactivepro'?'class="selected"':''); ?> href="<?php echo base_url().'property/'.($type==''?'all':$type).'/inactivepro'.($search_property_code!=''?'?search_property_code='.$search_property_code:''); ?>">
			InActive (<?php echo $inActiveFilterProperty; ?>)
		</a>
		-
		<a <?php echo($activetype=='featured'?'class="selected"':''); ?> href="<?php echo base_url().'property/'.($type==''?'all':$type).'/featured'.($search_property_code!=''?'?search_property_code='.$search_property_code:''); ?>">
			Featured (<?php echo $featuredFilterProperty; ?>)
		</a>
		-
		<a <?php echo($activetype=='suspended'?'class="selected"':''); ?> href="<?php echo base_url().'property/'.($type==''?'all':$type).'/suspended'.($search_property_code!=''?'?search_property_code='.$search_property_code:''); ?>">
			Suspended (<?php echo $suspendedFilterProperty; ?>)
		</a>
	</span>
	<span id="search" style="float:right;margin-bottom:15px;">
		<form method="get" action="<?php echo base_url();?>property/all/all">
			<input type="text" name="search_property_code" class="search-input" placeholder="Search by property ID-Code" style="width:400px" value="<?php echo $search_property_code; ?>">
			<button type="submit">
				<i class="entypo-search"></i>
			</button>
		</form>
	</span>
	<table class="table table-bordered table-striped datatable" id="table-2">
		<thead>
			<tr>
				<th style="width:425px;"><b>Property Name</b></th>
				<th><b>Property ID-Code</b></th>
				<th><b>Property Posted By</b></th>
				<th><b>Action</b></th>
			</tr>
		</thead>
		<tbody>
        <?php
		$popups = NULL;
		if(!empty($property_details)){
            $i=0;            
            foreach ($property_details as $property_detail){
				$i++;
				$property_main_img = get_perticular_field_value('zc_property_img','file_name'," and property_id='".$property_detail['property_id']."' AND img_type='main_image'");
				$propImg = base_url().'assets/images/no_proimg.jpg';
				if($property_main_img!='' && file_exists("../assets/uploads/Property/Property".$property_detail['property_id']."/thumb_200_296/".$property_main_img)){
					$propImg = frontend_path().'assets/uploads/Property/Property'.$property_detail['property_id'].'/thumb_200_296/'.$property_main_img;
				}
				$name=get_perticular_field_value('zc_contract_types','name'," and contract_id='".$property_detail['contract_id']."'");
				$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$property_detail['typology']."'");
				$city_name=get_perticular_field_value('zc_city','city_name'," and city_id='".$property_detail['city']."'");
				$province_code=get_perticular_field_value('zc_region_master','province_code'," and city='".mysql_real_escape_string($city_name)."'");

				$proptitle = $name." For ".stripslashes($typology_name)." in ".$city_name.", ".$province_code;
				
				$propSecTitle = ($property_detail['area']!=''?$property_detail['area'].' - ':'');
				$propSecTitle.= ($property_detail['street_address']!=''?$property_detail['street_address'].', ':'');
				$propSecTitle.= ($property_detail['street_no']!=''?$property_detail['street_no'].' - ':'');
				$propSecTitle.= ($property_detail['zip']!=''?$property_detail['zip']:'');
				
				$property_posted_by = get_perticular_field_value('zc_user','user_name'," and user_id='".$property_detail['property_post_by']."'");
				$propertyRefCode = CreateNewRefToken($property_detail['property_id'],$name);
			?>
			<tr>
				<td class="propertyName">
					<div class="img">
						<img src="<?php echo $propImg; ?>">
					</div>
					<div class="title">
						<h5><?php echo stripslashes($proptitle); ?></h5>
						<h6><?php echo stripslashes($propSecTitle); ?></h6>
						<p><?php echo stripslashes(substr($property_detail['description'],0,90)); ?></p>
						<?php
							if($property_detail['suspention_status'] == '1') {
						?>
						<p style="color:red">Property suspended by advertiser</p>
						<?php
							}
						?>
					</div>
				</td>
				<td><?php echo $propertyRefCode; ?></td>
				<td><?php echo $property_posted_by; ?></td>
				<td>
					<!--
					<a class="btn btn-default editbtn btn-sm btn-icon btn-xs" title="Click here to view" href="<?php //echo base_url();?>property/view_property_details/<?php //echo $property_detail['property_id']; ?>">
						<i class="entypo-search"></i>&nbsp;
					</a>
					-->
					<a class="btn btn-default editbtn btn-sm btn-icon btn-xs" title="Click here to edit" href="<?php echo base_url();?>property/edit_property_details/<?php echo $property_detail['property_id']; ?>">
						<i class="entypo-pencil"></i>&nbsp;
					</a>
					<?php
					$page = $this->uri->segment('4');
					$pageLink = '/'.$type.'/'.$activetype.($page==''?'':'/'.$page);
					if($property_detail['property_status']=='1'){
						$activeStatus ='Drafted&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						$btn_class = "inactive";
						$css_class = "entypo-pause";
						$statusURL = 'href="javascript:void(0);"';
					}
					if($property_detail['property_status']=='2' && $property_detail['property_approval'] == '1'){
						$activeStatus = 'Published&nbsp;&nbsp;&nbsp;';
						$btn_class = "";
						$css_class = "entypo-flash";
						//$statusURL = base_url()."property/status_change/".$property_detail['property_id'].$pageLink;
						$statusURL = 'data-toggle="modal" data-target="#proSusModal-'.$i.'" href="javascript:void(0);"';
					}                    					
					if($property_detail['property_status']=='2' && $property_detail['property_approval']=='0'){
						$activeStatus = 'Inactive';
						$btn_class = "suspended";
						$css_class = "entypo-pause";
						$statusURL = 'href="'.base_url()."property/status_change/".$property_detail['property_id'].$pageLink.'"';
					}
					?>
					<a <?php echo $statusURL;?> class="btn btn-success <?php echo $btn_class; ?> btn-sm btn-icon btn-xs">
						<i class="<?php echo $css_class; ?>"></i><?php echo $activeStatus; ?>
					</a>
					<?php
					$featuredLink = '<a href="'.base_url()."property/make_featured/".$property_detail['property_id'].$pageLink.'" class="btn btn-blue btn-sm btn-icon btn-xs">
										<i class="entypo-back-in-time"></i>Feature&nbsp;&nbsp;
									 </a>';
					$featureStatus = get_perticular_field_value('zc_property_featured','status'," and property_id='".$property_detail['property_id']."'");
					if($featureStatus == 1){
						$todayDate = strtotime(date('Y-m-d'));
						$startDate = get_perticular_field_value('zc_property_featured','start_date'," and property_id='".$property_detail['property_id']."'");
						$expDateLength = get_perticular_field_value('zc_property_featured','number_of_days'," and property_id='".$property_detail['property_id']."'");
						$expireDate = strtotime(date('Y-m-d', strtotime($startDate . " +".$expDateLength." days")));
						if($todayDate < $expireDate){
							$featuredLink = '<a href="'.base_url()."property/".($property_detail['feature_status']==0?'property_feature_resume':'property_feature_suspend')."/".$property_detail['property_id'].$pageLink.'" class="btn btn-'.($property_detail['feature_status']==0?'gold':'red').' btn-sm btn-icon btn-xs">
												<i class="entypo-back-in-time"></i>'.($property_detail['feature_status']==0?'Resume':'Suspend').'
											 </a>';
						}
					}
					echo $featuredLink;
					?>
					<a href="<?php echo base_url();?>property/delete_property/<?php echo $property_detail['property_id'].$pageLink; ?>" class="btn btn-sm btn-icon btn-xs btn-red" onclick="return confirm('Are your sure?')">
						<i class="entypo-cancel"></i>Delete
					</a>
				</td>
			</tr>
        <?php
		$popups.= '<div class="modal fade" id="proSusModal-'.$i.'">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h5 class="modal-title"><strong>'.stripslashes($proptitle).'</strong></h5>
						</div>
						<div class="modal-body">
							<form class="BlockedProFrm" action="" method="post">								
								<div class="col-md-12">
									<div class="form-group no-margin">
										<label class="control-label blcknt" for="field-7">Property Suspended Note</label>
										<textarea name="blocked_note" class="form-control require" rows="5"></textarea>
									</div>
								</div>
								<div style="clear:both;padding:5px;"></div>
								<div class="col-md-12">
									<div class="form-group no-margin">
										<label class="control-label" for="field-7">&nbsp;</label>
										<input type="hidden" name="proid" value="'.$property_detail['property_id'].'">
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
            <td colspan="6" align="center" height="100"> No records found.</td>
        </tr>
        <?php
		}
		?>
    </tbody>
</table>
<div class="row">
    <div class="col-md-12 col-md-offset-5">
        <ul class="pagination">
            <?php echo $pagination;?>
        </ul>
    </div>
</div>
<!-- Modal 6 (Long Modal)-->
<?php $this->load->view('inc/footer.php'); ?>
<?php echo $popups; ?>
<script type="text/javascript">
$('[id^="proSusModal"]').on('shown.bs.modal', function() {
  $(window).scrollTop(0);
})
$('.BlockedProFrm').submit(function(eFrm){
	if($(this).find('textarea[name="blocked_note"]').val()==''){
		$(this).find('.blcknt').append('<span class="lblReq">This field is required.</span>');
		$(this).find('textarea[name="blocked_note"]').focus();
		return false;		
	}else{
		var proid = $(this).find('input[name="proid"]').val();
		var blockednote = $(this).find('textarea[name="blocked_note"]').val();
		$.ajax({
			type: "POST",
			url: "<?php echo base_url()?>property/status_change_ajx",
			data: {proid:proid,blockednote:blockednote},
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
