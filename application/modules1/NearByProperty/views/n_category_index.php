<?php $this->load->view('inc/header.php'); ?>
<div class="main-content">		

<h3><?php
		if( isset( $title_en) )
		{
			print $title_en;
		}else{
			print "	ZAPCASA | Dashboard";
		}
	?></h3>
<hr />
<div class="error" id="error_msg" style="text-align:center;"><?php echo $this->session->flashdata('msg_flash');?></div>

<table class="table table-bordered table-striped datatable" id="table-2" width="100%">
	<thead>
		<tr>			
			<th><b>Sl No.</b></th>				
			<th><b>Name</b></th>
			<th><b>Created On</b></th>				
			<th><b>Status</b></th>	
			<th><b>Actions</b></th>
		</tr>
	</thead>	
	<tbody>
            <?php if(!empty($result)){
                $i=1;
                foreach ($result as $results){ ?>
					<tr>
						<td><?php echo $i; ?></td>				
						<td><?php echo $results['category_name'];?></td>
						<td><?php echo date( 'd-m-Y' ,$results['created'] );?></td>
						<td><?php if( $results['status'] == 1 ) { echo "Active"; } else { echo "Inactive"; } ?></td>	
                       <?php 
	                       if($results['status']  == '1'){
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
	                            <a href="'.site_url('/NearByProperty/n_category_edit_page').'/'.$results['category_id'].'/" href="javascript:;" class="btn btn-default btn-sm btn-icon btn-xs" title="Click here to edit">
	                                <i class="entypo-pencil"></i>
	                                Edit
	                            </a>
	                            
	                            <a href="'.site_url('/NearByProperty/statuschange/').'/'.$results['category_id'].'/" class="btn btn-info btn-sm btn-icon btn-xs" title="'.$title.'" Onclick="return confirm(\'Are you sure want change status.\')">
	                                <i class="'.$css_class.'"></i>
	                                '.$Login_Status.'</a>';?>
                            
                        </td>
                </tr>	
					</tr>	
            <?php 
            		$i++;
				}
			?>
            <?php }else{?>
                    <tr>			
                        <td colspan="5" align="center" height="100"> No records found.</td>
                    </tr>;
            <?php }?>
	</tbody>
</table>
<div class="row">
    <div class="col-md-12 col-md-offset-5">
            <ul class="pagination">
                <?php //echo $pagination?>
            </ul>
    </div>
</div>
<?php $this->load->view('inc/footer.php'); ?>