$('.docsLoad').live('click',function(){

	var href = $(this).attr('href');
	
	$.post(href,function(data){
		$('#doc').html(data);
	});

});