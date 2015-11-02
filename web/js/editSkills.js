$(document).ready(function() {
    var allSkills = [];
    $(".skills").each(function(index) {
        allSkills[index] = {};
        allSkills[index].id = $(this).find(".skillId").val();
        allSkills[index].name = $(this).find(".skillName").val();    
    });

	
    /* Definir en un archivo aparte */
    $('.addSkill').click(function(){   
            var skill = {
                id: "",
                name: $(".inputSkill").val()
            };
        	allSkills.push(skill);
        	$(".inputSkill").val("");	
            $(".skillsTable tr:last").after("<tr class='skills'><td><input type='hidden' value='"+ skill.name +"' name='skills["+ count +"][name]' class='skillName' />"+ skill.name +"</td><td><input type='hidden' value='"+ skill.id +"' name='skills["+ count +"][id]' class='skillId' /><button class='remove button'> X </button></td></tr>");
            count = count + 1;
            console.log(allSkills);
    });

	$("tbody").on('click', ".remove", function(){
        var index = $(this).closest("tr").index()
        /* Eliminamos los valores dentro del array mediante el index y el */
        allSkills.splice(index, 1);
        $(this).closest('tr').remove();        
        console.log(allSkills);
	});

    $(function(){
       $("#datepicker").datepicker({
           minDate:"1980-01-01",
           format: "yyyy-mm-dd",
           locale: 'es',
           maxDate: new Date()
       });
    });
    /* FIN */
});