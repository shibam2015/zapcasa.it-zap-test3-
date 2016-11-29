<?php $this->load->view("inc/header");?>
<?php $this->load->view("_include/login_user"); ?> 
<!--popup for save search-->
<?php $this->load->view("_include/saved_search"); ?> 
<?php $this->load->view("_include/information"); ?>
<?php $this->load->view("_include/information_mail"); ?>
<style type="text/css">
div.error{ float: left; color: red; padding-right: .5em;}
label.error{float: left; color: red; padding-right: .5em;}
.block-div{max-width: 500px;margin:0 auto;padding: 20px;border-radius: 4px;border: 1px solid #DDDDDD;}
.block-div hr{height:0;border:none;border-bottom:0px solid #4d4d4d;border-top:1px solid #DDDDDD;margin:10px 0;clear:both;}
.error-img-box{width: 50px;float: left;}
.error-text-box{margin-left: 60px;}
.block-div a{color: #1370b5}
.block-div p{font-size: 16px;}
.block-btn{margin: 15px 0 0;vertical-align: middle;}
.block-btn a{margin: 0;line-height: 0;vertical-align: middle;}
.block-btn img{width: 20px;float: left;margin-right: 10px;}
.blocked_note_learn_moreAnchr{text-decoration:none;outline:none;}
.blocked_note_learn_moreTxt {color: #888888;display: none;font-size: 12px;padding: 10px 25px 0 40px;text-align: justify;}
</style>
<form class="form" id="form_order" method="get" action="<?php echo base_url();?>property/search">
	<div class="main main_searchpage">
		<br><br>
        <div class="block-div">
            <div class="error-img-box">
                <img src="<?php echo base_url();?>assets/images/error.png" width="40">
            </div>
            <div class="error-text-box">
                <h3 style="font-size:18px;color:#ff0000;margin-top:5px;">
					<?php echo $this->lang->line('blocked_sorry_ur_account_is_blocked'); ?>
				</h3>
                <hr>
                <p style="color: #666">
					<?php echo $this->lang->line('blocked_werecommend_that_youdonot_continue_tothis_website'); ?>
				</p>
                <div class="block-btn">
                    <h3 style="font-size:24px">
                        <img src="<?php echo base_url();?>assets/images/success.png" width="20"> 
						<a href="<?php echo base_url();?>">
							<?php echo $this->lang->line('blocked_go_to_home_page_instead'); ?>
						</a>
                        <div style="clear: both"></div>
                    </h3>
                </div>
                <div class="block-btn">
                    <p style="font-size:16px">
                        <img src="<?php echo base_url();?>assets/images/down-arrow.png" width="20"> 
						<a href="javascript:void(0);" class="blocked_note_learn_moreAnchr save_search_poup">
							<?php echo $this->lang->line('blocked_learn_more'); ?>
						</a>
						<div class="blocked_note_learn_moreTxt">
							<?php echo $this->session->userdata('blocked_note'); ?>
						</div>
						<div style="clear: both"></div>
                    </p>
                </div>
            </div>
            <div style="clear: both"></div>
        </div>
	</div>
</form>
<?php $this->load->view("inc/footer");?>
<script>
$('.blocked_note_learn_moreAnchr').click(function(){
	$('.blocked_note_learn_moreTxt').slideToggle();
});
</script>