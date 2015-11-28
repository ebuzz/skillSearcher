$(document).ready(function () {

    function validateEmail(email) {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,4})(\]?)$/;
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