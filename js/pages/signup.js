var Signup = function() {

    return {
        init: function() {
            $('#signup-terms').on('click', (e) => {
                e.preventDefault();
                $('#signup-terms-modal').modal();
            });
            
            $('#register-terms').on('change', () => {
                if($('#register-terms').prop('checked')) {
                    $('#signup-terms-modal').modal();
                }
            });

            $('#form-sign-up').validate({
                errorClass: 'help-block animation-slideDown', 
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
                    'register-firstname': {
                        required: true,
                        minlength: 2
                    },
                    'register-lastname': {
                        required: true,
                        minlength: 2
                    },
                    'register-email': {
                        required: true,
                        email: true
                    },
                    'register-password': {
                        required: true,
                        minlength: 5
                    },
                    'register-password-verify': {
                        required: true,
                        equalTo: '#register-password'
                    },
                    'register-terms': {
                        required: true
                    }
                },
                messages: {
                    'register-firstname': {
                        required: 'Please enter your firstname',
                        minlength: 'Please enter your firstname'
                    },
                    'register-lastname': {
                        required: 'Please enter your last name',
                        minlength: 'Please enter your last name'
                    },
                    'register-email': 'Please enter a valid email address',
                    'register-password': {
                        required: 'Please provide a password',
                        minlength: 'Your password must be at least 5 characters long'
                    },
                    'register-password-verify': {
                        required: 'Please provide a password',
                        minlength: 'Your password must be at least 5 characters long',
                        equalTo: 'Please enter the same password as above'
                    },
                    'register-terms': {
                        required: 'Please accept the terms!'
                    }
                },
                submitHandler: function(form) {
                    const agreeAgent = $('#agent-agree').prop('checked');
                    const agreeAssignee = $('#assignee-agree').prop('checked');

                    if(!agreeAgent || ! agreeAgent) {
                        $('#signup-terms-modal').modal();
                        return false;
                    }
                }
            });
        }
    };
}();