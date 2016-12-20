<?php $this->load->view('inc/header.php'); ?>



<style>

.success { margin-bottom:10px; background-color:#006868; color:#ffea52; border:#CCC solid 1px; text-align:center;}

</style>

<div class="main-content">		



<h3>View Property Image</h3>

<div class="row">

<?php

						if(!empty($property_img))

						{

                         foreach($property_img as $property_imgs)

						 {

						?>

                        <div class="col-sm-2 col-xs-4" data-tag="1d">

                        <a class="fancybox" href="<?php echo $this->config->item('img_path');?>assets/uploads/Property/Property<?php echo $property_imgs['property_id']; ?>/thumb_860_482/<?php echo $property_imgs['file_name']; ?>"><img src="<?php echo $this->config->item('img_path');?>assets/uploads/Property/Property<?php echo $property_imgs['property_id']; ?>/<?php echo $property_imgs['file_name']; ?>"></a>

   						 </div>

                        	

                        <?php

						 }

						

                        }

                        ?>

	

</div>



<!-- Modal 6 (Long Modal)-->

<?php $this->load->view('inc/footer.php'); ?>

