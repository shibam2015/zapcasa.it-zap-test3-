<?php $this->load->view('inc/header.php'); ?>
<style>
.dashboardlst{list-style:none;}
.dashboardlst li{width:20%;float:left;margin:5px;}
</style>
<div class="main-content">
	<div class="row">
		<!-- Profile Info and Notifications -->
		<div class="col-md-6 col-sm-8 clearfix">
			<h3>Dashboard</h3>
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
	<div class="custom-bs">
		<div class="row">
			<div class="col-sm-6">
				<div class="panel panel-primary">
					<div class="panel-heading">LATEST PROPERTIES (Published)</div>
					<div class="panel-body">
					<?php
					if(!empty($dashboardLatestProperties)){
						foreach($dashboardLatestProperties as $dstPro){
							$name = get_perticular_field_value('zc_contract_types','name'," and contract_id='".$dstPro['contract_id']."'");
							$typology_name = get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$dstPro['typology']."'");
							$city_name = get_perticular_field_value('zc_city','city_name'," and city_id='".$dstPro['city']."'");
							$province_code = get_perticular_field_value('zc_region_master','province_code'," and city='".mysql_real_escape_string($city_name)."'");

							$propMainTitle = $name." For ".stripslashes($typology_name)." in ".$city_name.", ".$province_code;
							
							$propSecondaryTitle = ($dstPro['area']!=''?$area_prop=$dstPro['area'].' - ':'');
							$propSecondaryTitle.= ($dstPro['street_address']!=''?$dstPro['street_address'].',':'');
							$propSecondaryTitle.= ($dstPro['street_no']!=''?$dstPro['street_no'].' - ':'');
							$propSecondaryTitle.= ($dstPro['zip']!=''?$dstPro['zip']:'');
							
							$Typo=get_perticular_field_value('zc_contract_types','name'," and contract_id='".$dstPro['contract_id']."'");
							$refToken = CreateNewRefToken($dstPro['property_id'],$Typo);
							
							$user_preference = get_all_value('zc_user_preference'," and user_id='".$dstPro['property_post_by']."'");
							$first_name = get_perticular_field_value('zc_user','first_name'," and user_id='".$dstPro['property_post_by']."'");
							$last_name=get_perticular_field_value('zc_user','last_name'," and user_id='".$dstPro['property_post_by']."'"); 
							$name = $first_name.' '.$last_name;
							
							$proImg = base_url().'assets/images/no_proimg.jpg';
							$proMainImg = get_perticular_field_value('zc_property_img','file_name'," and img_type='main_image' and property_id='".$dstPro['property_id']."'");
							if($proMainImg!= ''){
								$proImg = frontend_path().'assets/uploads/Property/Property'.$dstPro['property_id'].'/thumb_200_296/'.$proMainImg;
							}
						?>
						<div class="news-box">
							<div class="clearfix news-table">
								<div class="news-img">
									<img src="<?php echo $proImg; ?>">
								</div>
								<div class="news-details">
									<a href="<?php echo base_url().'property/view_property_details/'.$dstPro['property_id']; ?>">
										<h4 style="font-weight:bold;"><?php echo stripslashes($propMainTitle); ?></h4>
									</a>
									<p><?php echo stripslashes($propSecondaryTitle); ?></p>
									<p>Ref.: <?php echo $refToken; ?></p>
								</div>
							</div>
							<div class="publish bg-info">
								<span class="text-primary">
									Published On:
								</span> <?php echo date('d M. Y',strtotime($dstPro['posting_time'])); ?> - 
								<span class="text-primary">By :</span>
								<a href="<?php echo base_url().'user/edit_profile/'.$dstPro['property_post_by'].'/index'; ?>">
									<?php echo $name; ?>
								</a>
							</div>
						</div>
						<?php
						}
					}
					?>
					</div>
					<a href="<?php echo base_url().'property/all/all'; ?>">
						<div class="panel-footer">
							<span class="pull-left">See all properties (<strong><?php echo $dashboardLatestPropertiesTotal; ?></strong>)</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="panel panel-primary">
					<div class="panel-heading">LATEST USERS (Activated)</div>
					<div class="panel-body">
					<?php
					if(!empty($dashboardLatestUsers)){
						foreach($dashboardLatestUsers as $dstUsr){
							//print_r($dstUsr);
							$usrImg = base_url().'assets/images/no_prof.png';
							if($dstUsr['file_1']!= '' && file_exists('./../assets/uploads/thumb_92_82/'.$dstUsr['file_1'])){
								$usrImg = frontend_path().'assets/uploads/thumb_92_82/'.$dstUsr['file_1'];
							}
							
							if($dstUsr['user_type']==1){
								$userType = 'Individual User';
							}elseif($dstUsr['user_type']==2){
								$userType = 'Owner';
							}elseif($dstUsr['user_type']==3){
								$userType = 'Agency';
							}
						?>
						<div class="news-box">
							<div class="clearfix news-table">
								<div class="news-img">
									<img src="<?php echo $usrImg; ?>">
								</div>
								<div class="news-details">
									<h4>
										<span class="text-primary">User Name :</span>
										<a href="<?php echo base_url().'user/edit_profile/'.$dstUsr['user_id'].'/index/'.strtolower($userType); ?>">
											<?php echo stripslashes($dstUsr['user_name']); ?>
										</a>
									</h4>									
									<p><span class="text-primary">Type :</span><?php echo $userType; ?></p>
									<?php
									if($dstUsr['user_type']==3){
									?>
									<p>
										<span class="text-primary">Company Name:</span>
										<?php echo stripslashes($dstUsr['company_name']); ?>
									</p>
									<p>
										<span class="text-primary">Bussiness Name:</span>
										<?php echo stripslashes($dstUsr['business_name']); ?>
									</p>
									<?php
									}else{
									?>
									<p><span class="text-primary">Full Name:</span><?php echo stripslashes($dstUsr['first_name']).' '.stripslashes($dstUsr['last_name']); ?></p>
									<?php
									}
									?>									
								</div>
							</div>
							<div class="publish bg-info">
								<span class="text-primary"> Activated On:</span> <?php echo date('d M. Y',strtotime($dstUsr['activation_on'])); ?>
							</div>
						</div>
						<?php
						}
					}
					?>					
					</div>
					<a href="<?php echo base_url().'user/all/all'; ?>">
						<div class="panel-footer">
							<span class="pull-left">See all users (<strong><?php echo $dashboardLatestUsersTotal; ?></strong>)</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
<?php $this->load->view('inc/footer.php'); ?>
