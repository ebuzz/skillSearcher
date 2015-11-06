$(document).ready(function(e){
    // this won't work alone because it' will show skills on loading!
    //skillHidder();
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

