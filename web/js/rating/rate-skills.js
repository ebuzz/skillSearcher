$(document).ready(function () {
    $(".rating").on('click', function (event) {
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
                    $(me).siblings("label").html(data.total);
                }
                else {
                    $(me).removeClass('unlike').addClass('like');
                    $(me).siblings("label").html(data.total);
                }
            },
            error: function () {
                alert('error');
            }
        });
    });
});