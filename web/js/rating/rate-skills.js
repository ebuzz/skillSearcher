$(document).ready(function () {
    $(".rating").click(function (event) {
        event.preventDefault();
        var me = this;
        $.ajax({
            url: Routing.generate('rating'),
            type: 'POST',
            data: {term: $(this).find('input').val()},
            success: function (data) {
                data = $.parseJSON(data);
                if (data.status != 'true') {
                    $(me).removeClass('like').addClass('unlike');
                    $(me).parents().siblings('.vote').find('.badge').html(data.total);
                }
                else {
                    $(me).removeClass('unlike').addClass('like');
                    $(me).parents().siblings('.vote').find('.badge').html(data.total);
                }
            }
        });
    });
});