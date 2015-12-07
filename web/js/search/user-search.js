$(document).ready(function() {
    var userSkills = [];
    var userTeams = [];
    var userSkillBoxes= [];
    var userTeamBoxes = [];
    var sideSkill = $(".user-skills");
    var teamCheck = $('.teamCheck');

    $('#dataTables').DataTable( {
        "paging":  true,
        "bFilter": false,
        "info":     false
    });

    teamCheck.change(function() {
        $('.saveTeam').show();
    });

    $('.addUserSkill').click(function(){      
        userSkillBoxes = $('input[name=user-skill]:checked');
        var filler = userSkillBoxes.each(function(){
            var id = $(this).attr('id');
            var userskill = {
                idUserSkill: id
        };
        userSkills.push(userskill);
        });
        userSkillBoxes.prop('checked', false);
    });


    $(".addUserTeam").click(function(){
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
        userTeamBoxes.prop('checked', false);
    });

    $(".saveTeam").click(function(event){
        $.ajax({
            url: Routing.generate('add_user_team'),
            type: 'POST',
            data: {skills: userSkills, userteams: userTeams},
            success: function(data){
                data: $.parseJSON(data);
                $('.user-skills').hide();
                $('.alert-success').show();
                setTimeout(function(){
                    window.location.reload(1);
                }, 1000);
            } 
        });    
    });

    $(".detail").click(function(){
        sideSkill.hide();
        var idUser = $(this).attr('idUser');
        var user = "#user-"+idUser;
        $('.saveTeam').hide();
        teamCheck.each(function(){
            if($(this).is(':disabled')){  
                
            }else{
                $(this).prop('checked',false);
            }
        });
        $(user).show();
    });

    $(".close").click(function(){
        sideSkill.hide();
    });

    /*$(document).bind('click',function(event){
        if(sideSkill.is(':visible') && event.target != sideSkill[0] && jQuery.inArray(sideSkill[0],$(event.target).parents().map(function(){return this}).get()) == -1){ 
            // alert('Oculta la lista');
            sideSkill.hide();
        }
    });*/

});

