$(document).ready(function() {
    $.validator.addMethod("alpha", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
    }, 'Please enter only letters and space');


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

    $("#edit-user").validate({
        rules: {
            email: {
                required: true,
                email: true,
            },
            name: {
                required: true,
                alpha: true,
                maxlength: 30,
            },
            mobile_number: {
                digits: true
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