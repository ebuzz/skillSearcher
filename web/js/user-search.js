$(document).ready(function(){
	var select = $('#search-selector');
	select.change(function(){
		$('#search-form').attr('action', select.val());
	});
});