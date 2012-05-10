$('a').live('click',function(e){
	
	//var m = $(this).attr('ajax').split('/');
	
	if ($(this).hasClass('ajax')) {
		e.preventDefault();	
	}
});
