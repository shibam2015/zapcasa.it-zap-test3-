<?php $this->load->view('inc/header.php'); ?>
<div class="main-content">		

<h3>View All User</h3>
<hr />
<div class="error" id="error_msg" style="text-align:center;"><?php echo $this->session->flashdata('msg_flash');?></div>

<table class="table table-bordered table-striped datatable" id="table-2" width="100%">
	<thead>
		<tr>			
			<th><b>Username</b></th>				
			<th><b>Full Name</b></th>
			<th><b>User Type</b></th>				
			<th><b>Email</b></th>	
			<th><b>Actions</b></th>
		</tr>
	</thead>	
	<tbody>
            <?php if(!empty($users)){
                $i=0;$popups = NULL;
                foreach ($users as $user){ $i++;?>
		<tr>
			<td><?php echo $user->user_name?></td>				
			<td><?php echo name($user->first_name, $user->last_name)?></td>
			<td>
                            <?php 
                            if($user->user_type == '1')echo 'General';
                            elseif($user->user_type == '2')echo 'Owner';
                            elseif($user->user_type == '3')echo 'Company';
                            ?>
                        </td>
			<td><?php echo $user->email_id?></td>	
                       <?php 
                       if($user->status == '1'){
                           $status = 'enabled';
                           $css_class ="entypo-lock-open";
                           $title = "Click here to disabled";
						   $Login_Status='Enable';
                           
                       }
                       else{
                           $status = 'disabled';
                           $css_class = "entypo-lock";
                           $title = "Click here to enable";
						   $Login_Status='Disable';
                       }
                       echo '<td>
                            <a onclick="jQuery(\'#modal-'.$i.'\').modal(\'show\', {backdrop: \'static\'});" href="javascript:;" class="btn btn-default btn-sm btn-icon btn-xs" title="Click here to edit">
                                <i class="entypo-pencil"></i>
                                Edit
                            </a>
                            
                            <a href="'.site_url('/users/statuschange/').'/'.$user->user_id.'/" class="btn btn-info btn-sm btn-icon btn-xs" title="'.$title.'" Onclick="return confirm(\'Are you sure want change status.\')">
                                <i class="'.$css_class.'"></i>
                                '.$Login_Status.'</a>';?>
                             <a href="<?php echo base_url();?>users/delete_user/<?php echo $user->user_id;?>" class="btn-xs btn-red" onclick="return confirm('Are your sure?')">Delete</a>
                            	
                            
                        </td>
                </tr>
        <?php $popups .= '<div class="modal fade" id="modal-'.$i.'">
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
                    </div>';?>
            <?php }?>
            <?php }else{?>
                    <tr>			
                        <td colspan="6" align="center" height="100"> No records found.</td>
                    </tr>;
            <?php }?>
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
<?php echo $popups?>