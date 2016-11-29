var ua = window.navigator.userAgent;
var msie = ua.indexOf("MSIE ");
//alert(msie);
$(function() {
	//var input = $(":input:not(input[type=button],input[type=submit],input[type=password])");
	var input = $(":input");
    if(('placeholder' in input)==false) { 
		$('[placeholder]').focus(function() {
			var i = $(this);
			if(i.val() == i.attr('placeholder')) {
				i.val('').removeClass('placeholder');
				if(i.hasClass('password')) {
					i.removeClass('password');
					if(msie<=0)
					this.type='password';
				}			
			}
		}).blur(function() {
			var i = $(this);	
			if(i.val() == '' || i.val() == i.attr('placeholder')) {
				if(this.type=='password') {
					i.addClass('password');
					if(msie<=0)
					this.type='text';
				}
				if(this.type!='submit' && this.type!='button')
				{
					i.addClass('placeholder').val(i.attr('placeholder'));
				}
			}
		}).blur().parents('form').submit(function() {
			$(this).find('[placeholder]').each(function() {
				var i = $(this);
				if(i.val() == i.attr('placeholder'))
					i.val('');
			})
		});
	}
});