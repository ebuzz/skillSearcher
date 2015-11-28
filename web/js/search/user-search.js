$(document).ready(function() {
    var userSkills = [];
    var userTeams = [];
    var userSkillBoxes= [];
    var userTeamBoxes = [];

    $('#dataTables').DataTable( {
        "paging":  true,
        "bFilter": false,
        "ordering": false,
        "info":     false
    });

    $('.addUserSkill').click(function(){
        userSkills= [];       
        userSkillBoxes = $('input[name=user-skill]:checked');
        var filler = userSkillBoxes.each(function(){
            var id = $(this).attr('id');
            var userskill = {
                idUserSkill: id
        };
        userSkills.push(userskill);
        });
        console.log(userSkills);
        userSkillBoxes.prop('checked', false);
    });


    $(".addUserTeam").click(function(){
        userTeams = [];
        userTeamBoxes = $('input[name=user-team]:checked');
        var filler = userTeamBoxes.each(function(){
            var idTeam = $(this).attr('idTeam');
            var idUser = $(this).attr('idUser');
            var userteam = {
            idTeam: idTeam,
            idUser: idUser
        };
        userTeams.push(userteam);
        });
        console.log(userTeams);
        userTeamBoxes.prop('checked', false);
    });

    $(".saveTeam").click(function(event){
        $.ajax({
            url: Routing.generate('teami'),
            type: 'POST',
            data: {skills: userSkills, userteams: userTeams},
            success: function(data){
                data: $.parseJSON(data);
            },
            error: function(){
                console.log("error");
            } 
        });
        
        
    });
});

function showCharm(idUser){
    skillHidder();
    showSkillsFromUser(idUser);
}

function showSkillsFromUser(idUser){
    var element = "#user-"+idUser;
    $(element).show();
}

function skillHidder(){
    $(".user-skills").hide();
}

// function addUserSkill(userSkillId){
//     var userSkills = [];
//     var userskill = {
//             id: $("#user-skill-"+userSkillId).val()
//     };
//     userSkills.push(userskill);
//     console.log(userSkills);
// }
