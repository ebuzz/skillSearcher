$(document).ready(function () {

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
                    }

                    else {
                        $('#mailIcon').removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    }
                }
                else {
                    $('#mailIcon').removeClass('glyphicon-ok glyphicon-remove');
                }
            }
        });
    });
});