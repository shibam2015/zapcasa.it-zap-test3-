<?php $this->load->view('inc/header.php'); ?>

<style>

.success { margin-bottom:10px; background-color:#006868; color:#ffea52; border:#CCC solid 1px; text-align:center;}

</style>

<div class="main-content">		

<h3>

	<?php

		if( isset( $title_en) )

		{

			print $title_en;

		}else{

			print "	ZAPCASA | Dashboard";

		}

	?>

</h3>

<hr />

	<?php

		if($this->session->flashdata('success')!='') {

	?>

        	<div class="success"><?php echo $this->session->flashdata('success'); ?></div>

  <?php }?>

			<div class="error" id="error_msg" style="text-align:center;">

				<?php echo $this->session->flashdata('msg_flash');?>

			</div>



			<form method="post" name="nearbyAddCategory_form" action="<?php echo site_url('NearByProperty/n_category_edit');?>" onsubmit="javascript: return category_name_check();" >

			    <input type="hidden" name="cat_id" value="0">

			    <div class="form-group" >

			        <label>Category Name</label>

					<input type="text" name="category_name" id="category_name" class="form-control category-nm" />

				</div>

				<div class="form-group" >

			        <label>Italian Category Name</label>

					<input type="text" name="it_category_name" id="it_category_name" class="form-control category-nm" />

				</div>

				<input type="submit" class="btn btn-primary" name="Submit" value="Submit" >

				<!--<i class="fa fa-save">&nbsp;</i>-->

					

				<a href="javascript:history.back();" class="btn btn-primary">

					<i class="fa fa-backward">&nbsp;</i>

					Back

				</a>

				

			</form>

<script>



function category_name_check() {

	if( $('#category_name').val() == "" || $('#category_name').val() == null ){

		alert("Please Enter Category Name.");

		return false;

	}	else {

		nearbyAddCategory_form.submit();

	}	

}

</script>			

<?php $this->load->view('inc/footer.php'); ?>

