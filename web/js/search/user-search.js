$(document).ready(function () {
    $('#dataTables').DataTable({
        "paging": true,
        "bFilter": false,
        "info": false
    });
});

function showCharm(idUser) {
    skillHidder();
    showSkillsFromUser(idUser);
}

function showSkillsFromUser(idUser) {
    var element = "#user-" + idUser;
    $(element).show();
}

function skillHidder() {
    $(".user-skills").hide();
}