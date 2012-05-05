$('.lightboxClose').live('click',function(){
	lightboxClose();
});

function lightboxLoading() {

	$('#lightbox').remove();

	var h = $(window).height();

	$('body').append("<div id='lightbox' style='display: none; position: absolute; top: 0px; left: 0px; background-color: gray; height: "+h+"px; width: 100%'></div>");

	$('#lightbox').css({'opacity':'0', 'display':'inline'}).animate({'opacity':'.8'},50);

}

function lightboxWindow(data) {
	
	var c = $('#lightboxContainer').html();
	
	$('body').append("<div id='lightboxContent' style='position: absolute; left: 50%; top: 20px; z-index: 10'></div>");
	
	var n = $(c).appendTo('#lightboxContent');
	n.html(data);
	
	var w = parseInt($('#lightboxContent').width()) / 2;
	
	$('#lightboxContent').css('margin-left', '-'+w);
	
	
}

function lightboxClose() {
	$('#lightboxContent, #lightbox').remove();
}$('a').live('click',function(e){
	
	//var m = $(this).attr('ajax').split('/');
	
	if ($(this).hasClass('ajax')) {
		e.preventDefault();	
	}
});
$(function(){

	siteUrl = 'http://localhost/citrus/';

});function toolsGenerateFields(name, context) {
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