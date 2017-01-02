			<!-- Footer -->
			<footer class="main">
				ZAPCASA &copy; 2014 All Right Reserved</a>
			</footer>
		</div>
		<!-- Chat Histories -->
	</div>
	<!-- Bottom Scripts -->
	<link rel="stylesheet" href="<?=asset_url()?>/css/font-icons/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=asset_url()?>/js/wysihtml5/bootstrap-wysihtml5.css">
	<link rel="stylesheet" href="<?=asset_url()?>/js/codemirror/lib/codemirror.css">
	<link rel="stylesheet" href="<?=asset_url()?>/js/uikit/css/uikit.min.css">
	<link rel="stylesheet" href="<?=asset_url()?>/js/uikit/addons/css/markdownarea.css">
	<link rel="stylesheet" href="<?=asset_url()?>js/jvectormap/jquery-jvectormap-1.2.2.css">
	<link rel="stylesheet" href="<?=asset_url()?>js/rickshaw/rickshaw.min.css">
	<!-- Bottom Scripts -->
	<script src="<?=asset_url()?>js/gsap/main-gsap.js"></script>
	<script src="<?=asset_url()?>js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="<?=asset_url()?>js/bootstrap.js"></script>
	<script src="<?=asset_url()?>js/joinable.js"></script>
	<script src="<?=asset_url()?>js/resizeable.js"></script>
	<script src="<?=asset_url()?>js/neon-api.js"></script>
	<script src="<?=asset_url()?>js/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?=asset_url()?>js/jvectormap/jquery-jvectormap-europe-merc-en.js"></script>
	<script src="<?=asset_url()?>js/jquery.sparkline.min.js"></script>
	<script src="<?=asset_url()?>js/rickshaw/vendor/d3.v3.js"></script>
	<script src="<?=asset_url()?>js/rickshaw/rickshaw.min.js"></script>
	<script src="<?=asset_url()?>js/raphael-min.js"></script>
	<script src="<?=asset_url()?>js/morris.min.js"></script>
	<script src="<?=asset_url()?>js/toastr.js"></script>
	<script src="<?=asset_url()?>js/neon-chat.js"></script>
	<script src="<?=asset_url()?>js/neon-custom.js"></script>
	<script src="<?=asset_url()?>js/neon-demo.js"></script>
	<script src="<?=asset_url()?>js/jquery.validate.min.js"></script>
	<script src="<?=asset_url()?>js/wysihtml5/wysihtml5-0.4.0pre.min.js"></script>
	<script src="<?=asset_url()?>js/wysihtml5/bootstrap-wysihtml5.js"></script>
	<script src="<?=asset_url()?>js/ckeditor/ckeditor.js"></script>
	<script src="<?=asset_url()?>js/ckeditor/config.js"></script>
	<!--<script src="<?=asset_url()?>/js/ckeditor/adapters/jquery.js"></script>-->
	<script src="<?=asset_url()?>js/uikit/js/uikit.min.js"></script>
	<script src="<?=asset_url()?>js/codemirror/lib/codemirror.js"></script>
	<script src="<?=asset_url()?>js/marked.js"></script>
	<script src="<?=asset_url()?>js/uikit/addons/js/markdownarea.min.js"></script>
	<script src="<?=asset_url()?>js/codemirror/mode/markdown/markdown.js"></script>
	<script src="<?=asset_url()?>js/codemirror/addon/mode/overlay.js"></script>
	<script src="<?=asset_url()?>js/codemirror/mode/xml/xml.js"></script>
	<script src="<?=asset_url()?>js/codemirror/mode/gfm/gfm.js"></script>
	<script src="<?=asset_url()?>js/icheck/icheck.min.js"></script>
	<!-- Add Which Type Of User Modal -->
	<div class="modal fade" id="modalAddUser">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add New User</h4>
				</div>
				<div class="modal-body">
					<div class="col-md-4">
						<a href="<?php echo base_url().'user/add_profile/1'; ?>" class="btn btn-orange">Individual</a>						
					</div>
					<div class="col-md-4 text-center">
						<a href="<?php echo base_url().'user/add_profile/2'; ?>" class="btn btn-success">Owner</a>						
					</div>
					<div class="col-md-4 text-right">
						<a href="<?php echo base_url().'user/add_profile/3'; ?>" class="btn btn-info">Agency</a>
					</div>
				</div>
				<br>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>            
				</div>
			</div>
		</div>
	</div>
	<!-- Update Admin Credential Modal -->
	<div class="modal fade" id="modalUpdateAdmin">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Update Admin Information</h4>
				</div>
				<form class="UpdateAdminForm" action="" method="post">
					<?php $adminDetails = get_all_value('zc_user'," AND `user_type`='4'"); ?>
					<div class="modal-body">
						<div class="col-md-12">
							<div class="form-group no-margin">
								<label class="control-label" for="field-7">Username</label>
								<input name="user_name" value="<?php echo stripslashes($adminDetails[0]['user_name']); ?>" type="text" class="form-control">
							</div>
						</div>
						<div style="clear:both;padding:5px;"></div>
						<div class="col-md-12">
							<div class="form-group no-margin">
								<label class="control-label" for="field-7">Password</label>
								<input name="password" type="password" class="form-control">
								<span style="color:red;">If not provided, password will remain same as before</span>
							</div>
						</div>
						<div style="clear:both;padding:5px;"></div>
						<div class="col-md-12">
							<div class="form-group no-margin">
								<label class="control-label" for="field-7">First Name</label>
								<input name="first_name" value="<?php echo stripslashes($adminDetails[0]['first_name']); ?>" type="text" class="form-control">
							</div>
						</div>
						<div style="clear:both;padding:5px;"></div>
						<div class="col-md-12">
							<div class="form-group no-margin">
								<label class="control-label" for="field-7">Last Name</label>
								<input name="last_name" value="<?php echo stripslashes($adminDetails[0]['last_name']); ?>" type="text" class="form-control">
							</div>
						</div>
						<div style="clear:both;padding:5px;"></div>
						<div class="col-md-12">
							<div class="form-group no-margin">
								<label class="control-label" for="field-7">Company Name</label>
								<input name="company_name" value="<?php echo stripslashes($adminDetails[0]['company_name']); ?>" type="text" class="form-control">
							</div>
						</div>
						<div style="clear:both;padding:5px;"></div>					
					</div>
					<br>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<input type="submit" class="btn btn-success pull-right" value="Update">
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	//Do Some Actions / Fetch Ajax Data With Call-Back Function.
	var AjaxCallingFunction = function(AjxParaMetres,JsonData){
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "<?php echo base_url()?>dashboard/update_admin",
			data: AjxParaMetres,
			success: JsonData
		});
	};
	$('.UpdateAdminForm').submit(function(eFrm){
		var AjxParaMetresForUpAdmin='ajaxAction=UpdateAdmin&'+ $('.UpdateAdminForm').serialize();
		var JsonDataListForUpAdmin = function (data){
			var jSon = $.parseJSON(data["json"]);
			alert(jSon.responseText);
			if(jSon.response=='Success'){
				location.reload();
			}
		};
		AjaxCallingFunction(AjxParaMetresForUpAdmin,JsonDataListForUpAdmin);
		eFrm.preventDefault();
	});
	/*
	 *	STRANGE BUG ON ZAPCASA.IT FOR PAGINATION.
	 *	LI is not appearing before & after <a> tag
	 *	So we fix the issue here.
	 *	DON'T REMOVE THIS SCRIPT.
	*/
	if($('.pagination').length){
		var paginationHTML = '';
		$('.pagination a,.pagination strong').each(function(){
			if($(this).is('a[href != "#"]')){
				paginationHTML+='<li><a href="'+$(this).attr('href')+'">'+$(this).html()+'</a></li>';
			}else{
				paginationHTML+='<li class="active"><a href="#">'+$(this).html()+'</a></li>';
			}
		});
		$('.pagination').html(paginationHTML);
	}
	</script>
	<div class="neon-loading-bar progress-is-hidden"><span data-pct="0" style="width: 0px;"></span></div>
	</body>
</html>
