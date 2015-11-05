$(document).ready(function(){
    
});

function showCharm(idUser){
    skillHidder();
    showSkillsFromUser(idUser);
}
 
function showSkillsFromUser(idUser){
    var element = "#user-"+idUser;
    console.log(element);
    $(element).show();
}

function skillHidder(){
    $(".user-skills").hide();
    console.log("Funka")
}

