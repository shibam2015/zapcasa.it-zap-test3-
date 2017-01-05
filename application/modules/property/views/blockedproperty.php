<?php $this->load->view("inc/header"); ?>
<?php $this->load->view("_include/login_user"); ?>
<!--popup for save search-->
<?php $this->load->view("_include/saved_search"); ?>
<?php $this->load->view("_include/information"); ?>
<?php $this->load->view("_include/information_mail"); ?>
<style type="text/css">
    div.error {
        float: left;
        color: red;
        padding-right: .5em;
    }

    label.error {
        float: left;
        color: red;
        padding-right: .5em;
    }

    .block-div {
        margin: 0 auto;
        padding: 20px;
        border-radius: 4px;
        border: 1px solid #DDDDDD;
    }

    .block-div hr {
        height: 0;
        border: none;
        border-bottom: 0px solid #4d4d4d;
        border-top: 1px solid #DDDDDD;
        margin: 10px 0;
        clear: both;
    }

    .error-img-box {
        width: 50px;
        float: left;
        margin-top: 55px;
    }

    .error-text-box {
        margin-left: 60px;
    }

    /*.block-div a{color: #1370b5 }*/
    .block-div p {
        font-size: 16px;
    }

    .block-btn {
        margin: 15px 0 0;
        vertical-align: middle;
    }

    .block-btn a {
        margin: 0;
        line-height: 0;
        vertical-align: middle;
        background-color: #ed6b1f;
        color: #fff;
        border: 1px solid #ed6b1f;
        border-radius: 6px;
        padding: 6px;
        text-transform: uppercase;
        ont-size: 16px;
        font-family: 'CenturyGothicBold';
    }

    .block-btn img {
        width: 20px;
        float: left;
        margin-right: 10px;
    }

    .blocked_note_learn_moreAnchr {
        text-decoration: none;
        outline: none;
    }

    .blocked_note_learn_moreTxt {
        color: #888888;
        display: none;
        font-size: 12px;
        padding: 10px 25px 0 40px;
        text-align: justify;
    }
</style>
<form class="form" id="form_order" method="get" action="<?php echo base_url(); ?>property/search">
    <div class="main main_searchpage">
        <br><br>

        <div class="block-div">
            <div class="error-img-box">
                <img src="<?php echo base_url(); ?>assets/images/character/waiting.png">
            </div>
            <div class="error-text-box">
                <div class="block-div">
                    <h3 style="font-size:18px;color:#ed6b1f; font-weight:bold;">
                        <?php echo $this->lang->line('blocked_sorry_ur_property_is_suspended'); ?>
                    </h3>
                </div>

                <p style="color: #666 ;text-align:center; margin-top: 45px;">
                    <?php echo $this->lang->line('blocked_werecommend_that_youdonot_continue_tothis_website_property'); ?>
                </p>

                <p style="color: #666;float:right;margin-right: 57px;">
                    <?php echo $this->lang->line('blocked_werecommend_that_youdonot_continue_tothis_website_property1'); ?>
                </p>

                <div class="block-btn">
                    <h3 style="font-size:16px;text-align: center;margin-top: 70px;">

                        <a href="<?php echo base_url(); ?>Property/property_details/property_list">
                            <?php echo $this->lang->line('blocked_go_to_property_page_instead'); ?>
                        </a>

                        <div style="clear: both"></div>
                    </h3>
                </div>
                <!--<div class="block-btn">
                    <p style="font-size:16px">
                        
						<a href="javascript:void(0);" class="blocked_note_learn_moreAnchr save_search_poup">
							<?php echo $this->lang->line('blocked_learn_more'); ?>
						</a>
						<div class="blocked_note_learn_moreTxt">
							<?php echo $this->session->userdata('blocked_note'); ?>
						</div>
						<div style="clear: both"></div>
                    </p>
                </div>-->
            </div>
            <div style="clear: both"></div>
        </div>
    </div>
</form>
<?php $this->load->view("inc/footer"); ?>
<script>
    $('.blocked_note_learn_moreAnchr').click(function () {
        $('.blocked_note_learn_moreTxt').slideToggle();
    });
</script>