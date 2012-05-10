$('.itemLoadForm').live('click',function(){itemLoadForm($(this).attr('item_id'));});
$('.itemEditSubmit').live('click',function(){itemEditSubmit();});
$('.itemDelete').live('click',function() {itemDelete($(this).attr('item_id'));});
$('#itemname').live('keyup',function(e){if (e.which=='13') itemEditSubmit()});	


var itemLoadForm = function (item_id) {

	lightboxLoading();

	$.post(siteUrl+'item/form/'+item_id,function(data){
		
		lightboxWindow(data);
		$('input').first().focus();
		
	});

}

function itemEditSubmit() {
	
	var fields = toolsGenerateFields('item',$('#itemForm'));
	var error = false;
	
	$.post(siteUrl+'item/submit',fields,function(data){
		if (data.error) {
			$('#itemError').html(data.error);
		}
		else {
			lightboxClose();
			toolsTopMsg(data.success);
			
			if (data.update) {
			
				$('.item[item_id='+data.update+']').html(data.item);
			}
			else {
				
				$('#items').append(data.item);
				
			}
		}
	},'json');
		
}

function itemDelete(item_id) {
	if (confirm("Are you sure you want to delete this item?")) {
		$.post(siteUrl+'item/delete/'+item_id,function(data){
			
			if (data.success) {
				$('.item[item_id='+item_id+']').fadeOut(function(){
					$(this).remove();
				});
				toolsTopMsg(data.success);
			}
			else {
				toolsTopMsg(data.error);
			}
			
		}, 'json');
	}
}