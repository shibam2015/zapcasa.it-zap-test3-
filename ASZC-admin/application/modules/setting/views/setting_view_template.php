<?php $this->load->view('inc/header.php'); ?>





<style>

.success { margin-bottom:10px; background-color:#006868; color:#ffea52; border:#CCC solid 1px; text-align:center;}

</style>

<div class="main-content">		



<h3>View Setting</h3>

<hr />

 		<?php

         if($this->session->flashdata('success')!='')

		 {

		?>

        <div class="success"><?php echo $this->session->flashdata('success'); ?></div>

        <?php }?>

<div class="error" id="error_msg" style="text-align:center;"><?php echo $this->session->flashdata('msg_flash');?></div>

<div class="jumbotron">

	   

       <div class="form-group">

       <label><?php echo $setting_details['0']['meta_title'];?></label>

       <?php

         if($setting_details['0']['settings_id']=='5')

		 {

	   ?>

       <textarea id="meta_value"  style="width: 511px; height: 138px;"><?php echo $setting_details['0']['meta_value'];?></textarea>

       

       <?php

		 }

		 else

		 {

	   ?>

       <input class="form-control" id="meta_value" type="text" value="<?php echo $setting_details['0']['meta_value'];?>">

       </div>

       

       <?php

		 }

	   ?>

       <input type="hidden" id="settings_id" value="<?php echo $setting_details['0']['settings_id'];?>">

       <a href="javascript:void(0);" class="btn btn-primary" id="submit" onclick="ckeditor_form.submit();">

		<i class="fa fa-save">&nbsp;</i>

		Submit

	</a>

	<a href="javascript:history.back();" class="btn btn-primary">

		<i class="fa fa-backward">&nbsp;</i>

		Back

	</a>

       

       

</div>



            </div>



<script>

	$(document).ready(function(){

	 //$("#frm1").validate();	

	 $("#submit").click(function(){

				var meta_value=$('#meta_value').val(); 

				var settings_id=$('#settings_id').val();

				

				 $.ajax({

							type: "POST",

							url: "<?php echo base_url();?>setting/edit_setting",

							data:{meta_value: $.trim($('#meta_value').val()), settings_id: $.trim($('#settings_id').val())},

							async: false,

							success:function(result){

								window.location.href = "<?php echo base_url()?>setting";

								

								}

						   });

				 

				 });

	

		

	});

	</script>



<!-- Modal 6 (Long Modal)-->

<?php $this->load->view('inc/footer.php'); ?>

