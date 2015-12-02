$(document).ready(function() {
    var userSkills = [];
    var userTeams = [];
    var userSkillBoxes= [];
    var userTeamBoxes = [];

    $('#dataTables').DataTable( {
        "paging":  true,
        "bFilter": false,
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
            url: Routing.generate('add_user_team'),
            type: 'POST',
            data: {skills: userSkills, userteams: userTeams},
            success: function(data){
                data: $.parseJSON(data);
                // Ops: Usar toaster
                // alert("Usuario agregado a equipo exitosamente.")
            },
            error: function(){
                console.log("error");
            } 
        });
        
        
    });
});

$(".detail").click(function(){
    $(".user-skills").hide();
    var idUser = $(this).attr('idUser');
    var user = "#user-"+idUser;
    $(user).show();
});

$(".close").click(function(){
    $(".user-skills").hide();
});
