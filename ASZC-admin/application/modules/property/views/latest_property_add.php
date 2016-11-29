<?php $this->load->view('inc/header.php'); ?>

<style>

.success { margin-bottom:10px; background-color:#006868; color:#ffea52; border:#CCC solid 1px; text-align:center;}

</style>

<div class="main-content">		



<h3>View All Properties</h3>

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

			<th><b>Property Name</b></th>
			<th><b>Property Province Code</b></th>			
			<th><b>Property published Date</b></th>
			<th><b>Property Posted By</b></th>

			<th><b>Action</b></th>				

		</tr>

	</thead>	

	<tbody>

            <?php if(!empty($property_details)){

                $i=0;

                foreach ($property_details as $property_detail){ $i++;?>

		<tr>

        	<td><a href="<?php echo base_url();?>property/view_property_details/<?php echo $property_detail['property_id'];?>">

			<?php

            $property_name="";

			if($property_detail['contract_id']==1)

			{

				$contract="Rent";

			}

			if($property_detail['contract_id']==2)

			{

				$contract="Sell";

			}

			$property_name.=$contract;

			$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$property_detail['typology']."'");

			$property_name.='-'.stripslashes($typology_name);

			

			

			?>

			<?php echo $property_name.'-'.$property_detail['city'].'-'.$property_detail['provience'];?></a></td>
			<td><?php echo $property_detail['provience'];?></td>
			<td><?php echo $property_detail['posting_time'];?></td>

        	<td><a href=""><?php echo get_perticular_field_value('zc_user','user_name'," and user_id='".$property_detail['property_post_by']."'");?></a></td>

            <td>

             <a class="btn btn-default btn-sm btn-icon btn-xs" title="Click here to edit" href="<?php echo base_url();?>property/view_property_details/<?php echo $property_detail['property_id']; ?>" >

            	<i class="entypo-pencil"></i>View

            </a>

            <?php

            	if($property_detail['property_status']=='0')

				{

					$note='Active';

					$class="btn-xs btn-blue";

					$url= base_url()."property/status_change/".$property_detail['property_id'];

				}

				if($property_detail['property_status']=='2')

				{

					$note='InActive';

					$class="btn-xs btn-red";

					$url= base_url()."property/status_change/".$property_detail['property_id'];

				}

				if($property_detail['property_status']=='1')

				{

					$note='Save as Draft';

					$class="btn-xs btn-orange";

					$url="javascript:void(0)";

				}

				

			?>

             <a href="<?php echo $url;?>" class="<?php echo $class;?>"><?php echo $note;?></a>

            

           

             <a href="<?php echo base_url();?>property/delete_property/<?php echo $property_detail['property_id'];?>" class="btn-xs btn-red" onclick="return confirm('Are your sure?')">Delete</a>

             

             <a href="<?php echo  base_url()."property/make_featured/".$property_detail['property_id']?>" class="btn-xs btn-blue">Featured</a>

             <?php

               $prop_feature_status=get_perticular_count('zc_property_featured'," and property_id='".$property_detail['property_id']."'");

			   if($prop_feature_status==1 && $property_detail['feature_status']=='1' )

			   {

			 ?>

           <a href="<?php echo  base_url()."property/property_feature_suspend/".$property_detail['property_id']?>" class="btn-xs btn-red">Suspend</a>	

           <?php

			   }

		   ?>

		   

            <?php 

   				if($property_detail['suspention_status']==0) {

		   ?>

               			<a href="<?php echo base_url();?>property/suspend_property/<?php echo $property_detail['property_id'];?>" class="btn-xs btn-red" >Property Suspend</a>

               <?php

				} else {

		   ?>

                		<a href="<?php echo base_url();?>property/resume_property/<?php echo $property_detail['property_id'];?>" class="btn-xs btn-blue" >Property Resume</a>

               <?php

				}

		   ?>

            

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

