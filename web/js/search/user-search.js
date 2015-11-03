$(document).ready(function(){
	var select = $('#search-selector');
	select.change(function(){
		$('#search-form').attr('action', select.val());
	});
});

var openCharm = false;
function showCharm(id,idUser){
    skillHidder();
    var ide = "#"+id+"-charm";
    //console.log(ide);
    var  charm = $("#"+id+"-charm").data("charm");
    if (charm.element.data("opened") === true) {
        charm.close();
    } else {
        charm.open();
        showSkillsFromUser(idUser);
    }
 }
 
function showSkillsFromUser(idUser){
    var element = "#user-"+idUser;
    $(element).show();
}

function skillHidder(){
    $(".user-skills").hide();
}

