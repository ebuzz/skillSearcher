$(document).ready(function() {
	$(".inputName").focusout(function(){
		var name =	$(this).val();
		var id = $(this).data('idposition');
	    var spanName = $('#spanName-'+ id);
	    var newSpan = spanName.text(name);
	    var inputName = $('#inputName-'+ id);
	    $.ajax({
	        url: Routing.generate('skill_update_ajax'),
	        type: 'POST',
	        data: {name : name, id : id},
	        success: function(data){
	            data: $.parseJSON(data);
	            newSpan.show();
	            inputName.hide();
	        } 
	    });  
	});

	$(".inputName").keydown(function (event){
		if (event.keyCode == 13) {
			var name =	$(this).val();
			var id = $(this).data('idposition');
	        var spanName = $('#spanName-'+ id);
	        var newSpan = spanName.text(name);
	        var inputName = $('#inputName-'+ id);
	        $.ajax({
	            url: Routing.generate('skill_update_ajax'),
	            type: 'POST',
	            data: {name : name, id : id},
	            success: function(data){
	                data: $.parseJSON(data);
	                newSpan.show();
	                inputName.hide();
	            } 
	        });  
	    }  
    });
});