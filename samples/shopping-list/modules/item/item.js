$('.itemLoadForm').live('click',function(){itemLoadForm($(this).attr('items_id'));});
$('.itemEditSubmit').live('click',function(){itemEditSubmit();});
$('.itemDelete').live('click',function() {itemDelete($(this).attr('items_id'));});

function itemLoadForm(items_id) {

	lightboxLoading();

	$.post(siteUrl+'item/form/'+items_id,function(data){
		
		lightboxWindow(data);
		
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
			
				$('.item[items_id='+data.update+']').html(data.item);
			}
			else {
				
				$('#items').append(data.item);
				
			}
		}
	},'json');
		
}

function itemDelete(items_id) {
	if (confirm("Are you sure you want to delete this item?")) {
		$.post(siteUrl+'item/delete/'+items_id,function(data){
			
			if (data.success) {
				$('.item[items_id='+items_id+']').fadeOut(function(){
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