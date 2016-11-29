<?php $this->load->view('inc/header.php'); ?>

<div class="main-content">		

	



<h3>Manage All CMS Pages</h3>

<hr />

<div class="error" id="error_msg" style="text-align:center;"><?php echo $this->session->flashdata('msg_flash');?></div>

<table class="table table-bordered table-striped datatable" id="table-2">

	<thead>

		<tr>			

			<th><b>Page Name</b></th>

			<th><b>Last Modified Date</b></th>

			<th><b>page URL</b></th>

			<th><b>Actions</b></th>

		</tr>

	</thead>

	

	<tbody>

		<?php

			echo $page_content;

		?>		

	</tbody>

</table>



<!-- <a href="javascript:fnClickAddRow();" class="btn btn-primary">

	<i class="entypo-plus"></i>

	Add Row

</a>

 -->



<?php $this->load->view('inc/footer.php'); ?>

