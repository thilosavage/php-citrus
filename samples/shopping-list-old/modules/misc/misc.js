/**
 *	JavaScript Main
 *
 * For JavaScript that doesn't belong to a specific module
 *
 */
$(function(){

	siteUrl = '<?php echo CR_URL;?>';

});


$(document).live('keyup',function(e){

	if (27 == e.which) {
		$('.popup').remove();
		lightboxClose();
	}

});