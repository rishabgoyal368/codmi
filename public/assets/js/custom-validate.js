$(document).ready(function() {
    $("#login").validate({
        rules: {
            email: {
                required: true,
            },
            password: {
                required: true,
            }
        },
        messages: {
            password: {
                required: "Please enter password",
            },
            email: {
                required: "Please enter your email address",
            },
        },

        submitHandler: function(form) {
            form.submit();
        }
    });
});