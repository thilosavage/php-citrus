function toolsGenerateFields(name, context) {
	var fields = {}
	$('.item-el', context).each(function(){
		var field = $(this).attr('field');
		fields[name+'['+field+']'] = $(this).val();
	});
	return fields;
}

function toolsTopMsg(msg) {
	
	$('#topMsg').remove();
	
	$('body').append("<div id='topMsg' style='position: absolute; background-color: black; color: white; padding: 5px; left: 0px; top: -100px; width: 100%;'>"+msg+"</div>");
	
	$('#topMsg').animate({'top': '0'});
	
	setTimeout(function(){
		$('#topMsg').animate({'top': '-100'});
	},2000);
	
}