/*
 *  Document   : login.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Log In page
 */

var Login = function() {

    return {
        init: function() {
            /* Jquery Validation, Check out more examples and documentation at https://github.com/jzaefferer/jquery-validation */
            /* Log In form - Initialize Validation */
            $('#form-log-in').validate({
                errorClass: 'help-block animation-slideDown', // You can change the animation class for a different entrance animation - check animations page
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    e.parents('.form-group > div').append(error);
                },
                highlight: function(e) {
                    $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                    $(e).closest('.help-block').remove();
                },
                success: function(e) {
                    e.closest('.form-group').removeClass('has-success has-error');
                    e.closest('.help-block').remove();
                },
                rules: {
                    'login-email': {
                        required: true,
                        email: true
                    },
                    'login-password': {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {
                    'login-email': 'Please enter your account\'s email',
                    'login-password': {
                        required: 'Please provide your password',
                        minlength: 'Your password must be at least 5 characters long'
                    }
                },
                submitHandler: function(form) {
                    console.log('here')
                    App.postData('login.php', JSON.stringify({
                        email: $('#login-email').val(),
                        pass: $('#login-password').val()
                    }), true, $('#errorDisp')).then(data => {
                        $('#errorDisp').text('Login successful...').removeClass('alert-danger hidden').addClass('alert-success');
                        let queryStr = 'bptkn=' + data.token;
                        let url = "/clarence/?" + window.btoa(queryStr);
                        window.location.href = url;

                        //probably won't every execute, but just in case...
                        setTimeout(function() {
                            $('#errorDisp').text('').addClass('hidden');
                        }, 4000);
                    }).catch(data => {
                        console.log(data);
                    });
                }
            });
        }
    };
}();