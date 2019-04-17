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
                        required: function(element) {
                            return $("#uiFlag").val() == 0;
                        },
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
                    if($('#uiFlag').val() == 0) {
                        $('#theButton').attr('disabled', true).html('<i class="fa fa-spinner fa-spin" style="font-size:13px"></i> Logging In...');

                        App.postData('login.php', JSON.stringify({
                            email: $('#login-email').val(),
                            pass: $('#login-password').val()
                        }), true, $('#errorDisp')).then(data => {
                            $('#theButton').html('<strong>Logged In</strong>');
                            $('#errorDisp').text('Login successful...').removeClass('alert-danger hidden').addClass('alert-success');
                            let queryStr = 'bptkn=' + data.token;
                            let url = "/clarence/?" + window.btoa(queryStr);
                            window.location.href = url;

                            //probably won't every execute, but just in case...
                            setTimeout(function() {
                                $('#errorDisp').text('').addClass('hidden');
                            }, 4000);
                        }).catch(data => {
                            $('#theButton').attr('disabled', false).html('<i class="fa fa-arrow-right"></i> Login');
                            console.log(data);
                        });
                    } else {
                        App.postData('reset.php', JSON.stringify({
                            email: $('#login-email').val()
                        }), true, $('#errorDisp')).then(data => {
                            $('#errorDisp').text(data.msg).removeClass('alert-danger hidden').addClass('alert-success');
                        }).catch(data => {
                            console.log(data);
                        });
                    }
                }
            });
        },
        toggleUI: function(use) {
            if(use === 'reset') {
                $('.loginUI').addClass('hidden');
                $('.resetUI').removeClass('hidden');
                $('#theButton').text(' Reset Password');
                $('#uiFlag').val('1');
            } else {
                $('.loginUI').removeClass('hidden');
                $('.resetUI').addClass('hidden');
                $('#theButton').text(' Log In');
                $('#uiFlag').val('0');
            }
        }
    };
}();

$('#reset-pass').on('click', (e) => {
    e.preventDefault();
    Login.toggleUI('reset');
});

$('#login-pass').on('click', (e) => {
    e.preventDefault();
    Login.toggleUI('login');
});