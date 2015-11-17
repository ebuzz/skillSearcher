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
                        $(me).text(data.total).append("<i class='fa fa-thumbs-o-up'></i>");
                    }
                    else{
                        $(me).removeClass('unlike').addClass('like');
                        $(me).text(data.total).append("<i class='fa fa-thumbs-o-up'></i>");
                    }
                },
                error: function(){
                    alert('error');
                }
            });
        });
    });
});
