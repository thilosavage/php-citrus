$(function(){

	$.post(url+'say/hi',function(data){
		setTimeout(function(){
			$('#message').html(data.msg);
		},500);
	},'json');

});