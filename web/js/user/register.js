$(document).ready(function () {

    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 3500);

    function validateEmail(email) {
        var filter = /[aA-zZ0-9\-\.]+@arkusnexus+\.com$/;
        return !!filter.test(email);
    }

    $("#verifyMail").on('select keyup change select', function () {
        $.ajax({
            url: Routing.generate('verify_mail'),
            data: {term: $(this).val()},
            success: function (data) {
                if (validateEmail($('#verifyMail').val()) == true) {
                    if (data != 'true') {
                        $('#mailIcon').removeClass('glyphicon-remove').addClass('glyphicon-ok');
                        $('#exist').val("");
                    }

                    else {
                        $('#mailIcon').removeClass('glyphicon-ok').addClass('glyphicon-remove');
                        $('#exist').val("true");
                    }
                }
                else {
                    $('#mailIcon').removeClass('glyphicon-ok glyphicon-remove');
                    $('#exist').val("true");
                }
            }
        });
    });
});