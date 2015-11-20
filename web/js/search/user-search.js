$(document).ready(function() {
    $('#dataTables').DataTable( {
        "paging":  true,
        "bFilter": false,
        "ordering": false,
        "info":     false
    } );
} );

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