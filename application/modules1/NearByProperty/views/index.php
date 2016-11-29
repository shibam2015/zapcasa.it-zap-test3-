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
			<th><b>Property Name</b></th>
			<th><b>Property Optional Name</b></th>
			<th><b>Picture</b></th>
			<th><b>Address</b></th>
			<th><b>Created On</b></th>				
			<th><b>Status</b></th>	
			<th><b>Actions</b></th>
		</tr>
	</thead>	
	<tbody>
            <?php if(!empty($property_details)){
                $i=1;
                foreach ($property_details as $results){ ?>
					<tr>			
						<td><?php echo $results['name'];?></td>
						<td><?php echo $results['opt_name'];?></td>
						<td><img id="img_1" src="<?php if( $results['url'] == "" ) { echo base_url().'assets/images/no_proimg.jpg'; } else { echo base_url().'assets/uploads/NearByProperty/'.$results['url']; } ?>" alt="" width="142" height="140" /></td>
						<td>
							<?php 
								if( $results['street_address'] != "" ){ echo $results['street_address'].", <br>"; }
								if( $results['street_no'] != "" ){ echo $results['street_no'].", "; }
								if( $results['city'] != "" ){ echo $results['city'].", <br>"; }
								if( $results['city'] != "" ){ echo $results['zip']; }
							?></td>
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
	                            <a href="'.site_url('/NearByProperty/index_edit_page').'/'.$results['property_details_id'].'/" href="javascript:;" class="btn btn-default btn-sm btn-icon btn-xs" title="Click here to edit">
	                                <i class="entypo-pencil"></i>
	                                Edit
	                            </a>
	                            
	                            <a href="'.site_url('/NearByProperty/statuschange_prop/').'/'.$results['property_details_id'].'/" class="btn btn-info btn-sm btn-icon btn-xs" title="'.$title.'" Onclick="return confirm(\'Are you sure want change status.\')">
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
<?php $this->load->view('inc/footer.php'); ?>