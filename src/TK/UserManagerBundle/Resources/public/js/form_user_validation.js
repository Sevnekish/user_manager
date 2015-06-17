;$(function(){

    $.validator.addMethod('numRange', function (value, element, range) {
        return value > range[0] && value < range[1];
    });

    jQuery.extend(jQuery.validator.messages, {
        numRange: "Please enter a value between {0} and {1}.",
        required: "This field is required.",
        remote: "Please fix this field.",
        email: "Please enter a valid email address.",
        url: "Please enter a valid URL.",
        date: "Please enter a valid date.",
        dateISO: "Please enter a valid date (ISO).",
        number: "Please enter a valid number.",
        digits: "Please enter only digits.",
        creditcard: "Please enter a valid credit card number.",
        equalTo: "Please enter the same value again.",
        accept: "Please enter a value with a valid extension.",
        maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
        minlength: jQuery.validator.format("Please enter at least {0} characters."),
        rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
        range: jQuery.validator.format("Please enter a value between {0} and {1}."),
        max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
        min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
    });

    $('form').validate({
        rules: {
            'tk_usermanagerbundle_user[firstName]': {
                required: true,
                minlength: 2,
                maxlength: 50,
            },
            'tk_usermanagerbundle_user[lastName]': {
                required: true,
                minlength: 2,
                maxlength: 50,
            },
            'tk_usermanagerbundle_user[age]': {
                required: true,
                number: true,
                numRange: [18, 130],
            },
            'tk_usermanagerbundle_user[email]': {
                required: true,
                email: true,
            },
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });

    var passwordFirst  = $('[name="tk_usermanagerbundle_user[password][first]"]');
    var passwordSecond = $('[name="tk_usermanagerbundle_user[password][second]"]');

    if ($('form#editForm').length > 0) {
        passwordFirst.rules('add', {
        });
        passwordSecond.rules('add', {
            equalTo: "#tk_usermanagerbundle_user_password_first"
        });
    } else {
        passwordFirst.rules('add', {
            required: true,
            minlength: 6,
            maxlength: 100,
        });
        passwordSecond.rules('add', {
            required: true,
            equalTo: "#tk_usermanagerbundle_user_password_first"
        });
    }

    updateAddressRules();
});

function updateAddressRules() {
    $('input.zip').each(function() {
        $(this).rules('add', {
            required: true,
            minlength: 1,
            maxlength: 16,
        });
    });
    $('input.city').each(function() {
        $(this).rules('add', {
            required: true,
            minlength: 2,
            maxlength: 130,
        });
    });
    $('input.address').each(function() {
        $(this).rules('add', {
            required: true,
            minlength: 6,
            maxlength: 130,
        });
    });
}