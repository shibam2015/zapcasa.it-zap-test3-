<?php $this->load->view('inc/header.php'); ?>
<div class="main-content">		
	
<br>
<h3>Add New Page</h3>
<hr />
<br>
<form method="post" name="ckeditor_form" action="<?php echo site_url('cms/edit_page/'.$cmspages_id);?>">
	<input type="hidden" name="method" value="post">
	<input type="hidden" name="id" value="<?php echo $cmspages_id?>">

	<div class="form-group" >
            <label>Title Italian</label>
            <input type="text" name="title_it" value="<?php echo $title_it?>" class="form-control" />
            <?php echo form_error('title_it')?>
	</div>
        <div class="form-group" >
            <label>Title In English</label>
            <input type="text" name="title_en" class="form-control" value="<?php echo $title_en?>" />
            <?php echo form_error('title_en')?>
	</div>
	
	<div class="form-group" >
            <label>Content In Italian</label>
		<textarea class="form-control ckeditor" data-stylesheet-url="assets/css/wysihtml5-color.css" name="content_it" style="height:300px;"><?php echo $content_it?></textarea>
	</div>
        <div class="form-group" >
            <label>Content In English</label>
		<textarea class="form-control ckeditor" data-stylesheet-url="assets/css/wysihtml5-color.css" name="content_en" style="height:300px;"><?php echo $content_en?></textarea>
	</div>
        <div class="form-group" >
            <label>Status</label>
            <select name="status" value="1" class="form-control">
                <option value="1">Enable</option>
                <option value="0">Disable</option>
            </select>
	</div>
	<a href="javascript:void(0);" class="btn btn-primary" onclick="ckeditor_form.submit();">
		<i class="fa fa-save">&nbsp;</i>
		Submit
	</a>
	<a href="javascript:history.back();" class="btn btn-primary">
		<i class="fa fa-backward">&nbsp;</i>
		Back
	</a>
	
</form>

<br>
<!-- <a href="javascript:fnClickAddRow();" class="btn btn-primary">
	<i class="entypo-plus"></i>
	Add Row
</a>
 -->

<?php $this->load->view('inc/footer.php'); ?>
