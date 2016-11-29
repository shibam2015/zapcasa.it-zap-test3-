<div id="toPopup">
    <div class="close"></div>
    <!--<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>-->
    <div id="popup_content">
        <!--your content start-->
        <p><img src="<?php echo base_url();?>assets/images/character_icon_small.jpg" alt="" style="float:left; padding-right:10px; margin-top:-7px"><?php echo $this->lang->line('login_signin_to_your_account');?></p>
        <div id="error"></div>
        <div>
            <span><?php echo $this->lang->line('login_username');?></span>
            <input type="email" name="email" id="email" placeholder="<?php echo $this->lang->line('login_email_id_field');?>">
        </div>
        <div>
            <span><?php echo $this->lang->line('login_password');?></span>
            <input type="password" name="password" id="password" placeholder="<?php echo $this->lang->line('login_password_field');?>">
        </div>
        <div>
            <input type="hidden" id="current_url" name="current_url" value="<?php echo current_url();?>">
            <input type="submit" name="login" value="<?php echo $this->lang->line('login_button_login');?>" id="login"> 
            <a href="<?php echo base_url();?>users/forget_password" class="forgot_pass" title="<?php echo $this->lang->line('login_forgot_password_title');?>"><?php echo $this->lang->line('login_forgot_password');?></a>
        </div>
    </div>
</div>
<div id="backgroundPopup"></div>
<script type="text/javascript">
$(document).ready(function() {
    //$("#frm1").validate();	
    $("#login").click(function(){
        var email = $('#email').val();
        var password = $('#password').val();
        var current_url = $('#current_url').val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>users/login",
            data: {
                email: $.trim($('#email').val()),
                password: $.trim($('#password').val())
            },
            async: false,
            success: function(result) {
                //alert();
                if (result == 'invalid') {
                    var url = "<?php echo base_url().'users/blockedpage';?>";
                    $(location).attr('href',url);
                    //location.reload();
                } else if (result == 1) {
                    //var url = "<?php echo base_url().'users/my_account';?>";
                    <!--var url = "<?php //echo base_url();?>"; -->   
                    //$(location).attr('href', url);
                    location.reload();
                } else {
                    $("#error").html("<span style='color:red'><?php echo $this->lang->line('login_invalid_username');?></span>");
                }
            }
        });
    });
});
$(document).keypress(function(e){
    if (e.which == 13) {
        var email = $('#email').val();
        var password = $('#password').val();
        var current_url = $('#current_url').val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>users/login",
            data: {
                email: $.trim($('#email').val()),
                password: $.trim($('#password').val())
            },
            async: false,
            success: function(result) {
                //alert();
                if (result == 'invalid') {
                    var url = "<?php echo base_url().'users/blockedpage';?>";
                    $(location).attr('href', url);
                } else if (result == 1) {
                    //var url = "<?php echo base_url().'users/my_account';?>";
                    <!--var url = "<?php //echo base_url();?>"; -->   
                    //$(location).attr('href', url);
                    location.reload();
                } else {
                    $("#error").html("<span style='color:red'><?php echo $this->lang->line('login_invalid_username');?></span>");
                }
            }
        });
    }
});
</script>
