$('.lightboxClose, #lightbox').live('click',function(){
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
}