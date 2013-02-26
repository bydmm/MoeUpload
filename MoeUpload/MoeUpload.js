$( document ).ready( function() {
	$('.mw-htmlform-field-HTMLTextAreaField').each(function(){
		var self = this;
		if($(this).find("#wpUploadDescription")){
			var html = $(this).find('.mw-input').html();
			html = '<a class="tooggle" href="##" >Cliick</a>' + html;
			$(this).find('.mw-input').html(html);
			$(this).find('.mw-input #wpUploadDescription').hide();
		}
	});
	$('.tooggle').click(function(){
		$('#wpUploadDescription').slideToggle();
	});
} );

