$(document).ready(function () {
    var allSkills = [];
    var count = 0;

    $('.addSkill').click(function () {
        var skill = {
            id: "",
            name: $(".inputSkill").val()
        };
        allSkills.push(skill);
        $(".inputSkill").val("");
        $(".skillsTable tbody").append("<tr class='skills'><td><input type='hidden' value='" + skill.name + "' name='skills[" + count + "][name]' class='skillName' />" + skill.name + "</td><td><input type='hidden' value='" + skill.id + "' name='skills[" + count + "][id]' class='skillId' /><button type='button' class='remove btn btn-default btn-xs'><i class='fa fa-minus'></i></button></td></tr>");
        count = count + 1;
    });

    $("tbody").on('click', ".remove", function () {
        var index = $(this).closest("tr").index()
        allSkills.splice(index, 1);
        $(this).closest('tr').remove();
    });

    $('.btn-file :file').on('change', function (event) {
        var input = $(this).parents('.input-group').find(':text');
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    });

    $(".inputSkill").autocomplete({
        source: function( request, response ) {
            $.ajax({
                url: Routing.generate('ajax_skill'),
                dataType: "json",
                data: {term: request.term},
                success: function(data) {
                    response(data)
                }
            });
        },
        minLength: 1,
        select: function(event, ui) {
            event.preventDefault();
            allSkills.push({name: ui.item.label, id: ui.item.value});
            $(".skillsTable tbody").append("<tr class='skills'><td><input type='hidden' value='" + ui.item.label + "' name='skills[" + count + "][name]' class='skillName' />" + ui.item.label + "</td><td><input type='hidden' value='" + ui.item.value + "' name='skills[" + count + "][id]' class='skillId' /><button type='button' class='remove btn btn-default btn-xs'><i class='fa fa-minus'></i></button></td></tr>");
            count = count + 1;
            $(this).val("");
            return false;
        },
        focus: function( event, ui ) {
            event.preventDefault();
            $(this).val(ui.item.label);
        }
    });

    $('.date').datepicker({
        format: "yyyy-mm-dd",
        startView: 2,
        autoclose: true
    });

});