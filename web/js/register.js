$(document).ready(function() {
    var allSkills = [];
    var count = 0;

    $('.addSkill').click(function(){
        var skill = {
            id: "",
            name: $(".inputSkill").val()
        };
        allSkills.push(skill);
        $(".inputSkill").val("");
        $(".skillsTable tbody").append("<tr class='skills'><td><input type='hidden' value='"+ skill.name +"' name='skills["+ count +"][name]' class='skillName' />"+ skill.name +"</td><td><input type='hidden' value='"+ skill.id +"' name='skills["+ count +"][id]' class='skillId' /><button class='remove square-button mini-button'><span class='icon mif-minus'></span></button></td></tr>");
        count = count + 1;
        console.log(allSkills);
    });

    $("tbody").on('click', ".remove", function(){
        var index = $(this).closest("tr").index()
        allSkills.splice(index, 1);
        $(this).closest('tr').remove();
        console.log(allSkills);
    });

    $(function(){
        $("#datepicker").datepicker({
            minDate:"1980-01-01",
            position: "top",
            locale: 'es',
            format: "yyyy-mm-dd", // set output format
            maxDate: new Date()
        });
    });

    $(function(){
        $('#wizard').wizard({
            stepperClickable: true,
            buttons: {
                cancel: false,
                help: false,
                prior: false,
                next: false,
                finish: false
            }
        });
    });

    $(function() {
        $("#register").on("submit", function(event) {
            event.preventDefault();

            var formData = new FormData(this);
            $.ajax({
                url: Routing.generate('registered'),
                type: 'POST',
                data:  formData,
                mimeType:"multipart/form-data",
                contentType: false,
                cache: false,
                processData:false,
                success: function(data) {
                    alert('success')
                },
                error: function(){
                    alert('error');
                }
            });
        });
    });
});

var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
};



