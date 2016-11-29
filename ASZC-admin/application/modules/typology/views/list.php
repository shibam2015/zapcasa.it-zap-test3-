<?php $this->load->view('inc/header.php'); ?>
<style>
.editbtn{padding-right:18px !important;}
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
			<h3>View All Typologies<?php echo($search_input?' : '.$search_input:''); ?></h3>
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
	<span id="search" style="float:right;margin-bottom:15px;">
		<form method="get" action="<?php echo base_url();?>typology/typologylist">
			<input type="text" name="search_input" class="search-input" placeholder="Category Short Code, Category Name, Topology Name (Eng / It)" style="width:400px" value="<?php echo $search_input; ?>">
			<button type="submit">
				<i class="entypo-search"></i>
			</button>
		</form>
	</span>
	<table class="table table-bordered table-striped datatable" id="table-2" width="100%">
		<thead>
			<tr>
				<th><b>Category Type</b></th>
				<th><b>Typology Name (English)</b></th>
				<th><b>Typology Name (Italian)</b></th>				
				<th><b>Actions</b></th>
			</tr>
		</thead>
		<tbody>
	<?php
	if(!empty($typolist)){
		$page = $this->uri->segment('3');
		$pageLink = ($page==''?'':'/'.$page);
		$i=0;            
		foreach ($typolist as $typo){
			$i++;
			$category_name = get_category_name_list($typo->category_code);
			if($typo->status == 'active'){
				$btn_class = '';
				$css_class ="entypo-lock-open";
				$title = "Click here to inactive";
				$Typo_Status='Active&nbsp;&nbsp;';
				$tdBG = '';
			}else{
				$btn_class = 'inactive';
				$css_class = "entypo-lock";
				$title = "Click here to active";
				$Typo_Status='Inactive';
				$tdBG = 'style="background:#FFEDED;"';
			}
			$NoOfProUsingThisTypo = exisitingProForThisTypology($typo->typology_id);
			if($NoOfProUsingThisTypo>0){
				$title = "No Of Property : ".$NoOfProUsingThisTypo;
				$Typo_Status_Link = 'href="javascript:void(0);" Onclick="return CannotChangeItsStatus();"';
			}else{
				$Typo_Status_Link = 'href="'.site_url('/typology/statuschange/').'/'.$typo->typology_id.$pageLink.'" Onclick="return confirm(\'Are you sure want change status.\')"';
			}
			?>
			<tr>
				<td <?php echo $tdBG; ?>>
					<?php echo stripslashes($category_name); ?>
				</td>
				<td <?php echo $tdBG; ?>>
					<?php echo stripslashes($typo->name); ?>
				</td>
				<td <?php echo $tdBG; ?>>
					<?php echo stripslashes($typo->name_it); ?>
				</td>
				<td <?php echo $tdBG; ?>>
					<a href="<?php echo site_url('/typology/edit_typo').'/'.$typo->typology_id; ?>" class="btn btn-default editbtn btn-sm btn-icon btn-xs" title="Click here to edit">
						<i class="entypo-pencil"></i>&nbsp;
					</a>
					<a <?php echo $Typo_Status_Link; ?> class="btn btn-info <?php echo $btn_class; ?> btn-sm btn-icon btn-xs" title="<?php echo $title; ?>">
						<i class="<?php echo $css_class; ?>"></i><?php echo $Typo_Status; ?>
					</a>
					<!--
					<a href="<?php //echo base_url();?>typology/delete_typo/<?php //echo $typo->typology_id.$pageLink;?>" class="btn btn-red btn-sm btn-icon btn-xs" onclick="return confirm('Are your sure?')">
						<i class="entypo-cancel"></i>Delete
					</a>
					-->
				</td>
			</tr>
			<?php
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
				<?php echo $pagination?>
			</ul>
		</div>
	</div>
	<!-- Modal 6 (Long Modal)-->
	<?php $this->load->view('inc/footer.php'); ?>
	<script type="text/javascript">
	$(function(){
		setTimeout(function(){
			$(".post-message").hide();
		}, 5000);
	});
	function CannotChangeItsStatus(){
		alert('Property exists using this typology.\nSo you cann\'t change its status.');
		return false;
	}
	</script>
