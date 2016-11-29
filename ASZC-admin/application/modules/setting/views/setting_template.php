<?php $this->load->view('inc/header.php'); ?>

<style>

.success { margin-bottom:10px; background-color:#006868; color:#ffea52; border:#CCC solid 1px; text-align:center;}

</style>

<div class="main-content">		



<h3>All Site Settings</h3>

<hr />

<?php

  //echo '<pre>';print_r($property_detail);die;

?>

 		<?php

         if($this->session->flashdata('success')!='')

		 {

		?>

        <div class="success"><?php echo $this->session->flashdata('success'); ?></div>

        <?php }?>

<div class="error" id="error_msg" style="text-align:center;"><?php echo $this->session->flashdata('msg_flash');?></div>



<table class="table table-bordered table-striped datatable" id="table-2">

	<thead>

		<tr>			

			<th><b>Name</b></th>				

			<th><b>Value</b></th>

			<th><b>Action</b></th>				

		</tr>

	</thead>	

	<tbody>

            <?php if(!empty($setting_details)){

                $i=0;

                foreach ($setting_details as $setting_detail){ $i++;?>

		<tr>

        	<td>

			

			<?php echo $setting_detail['meta_title'];?></td>

        	<td><?php if( $setting_detail['meta_name'] == "google_adsence" ) { echo "<pre>Google Adsence Ebded Code</pre>"; } else { echo $setting_detail['meta_value']; } ?></td>

            <td>

            

           <a class="btn btn-default btn-sm btn-icon icon-left" title="Click here to edit" href="<?php echo base_url();?>setting/view_setting_details/<?php echo $setting_detail['settings_id']; ?>" >

            	<i class="entypo-pencil"></i>View

            </a>

            

			</td>

		</tr>	

            <?php

				}

			 }else{?>

                    <tr>			

                        <td colspan="6" align="center" height="100"> No records found.</td>

                    </tr>

            <?php }?>

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

