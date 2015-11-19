$(document).ready(function(e){
    $(function() {
        $(".rating").on('click', function(event) {
            event.preventDefault();
            var me = this;
            $.ajax({
                url: Routing.generate('rating'),
                type: 'POST',
                data:  {term: $(this).val()},
                success: function(data) {
                    data = $.parseJSON(data)
                    if (data.status != 'true'){
                        $(me).removeClass('like').addClass('unlike');
                        $(me).find("span").html(data.total);
                    }
                    else{
                        $(me).removeClass('unlike').addClass('like');
                        $(me).find("span").html(data.total);
                    }
                },
                error: function(){
                    alert('error');
                }
            });
        });
    });
});
