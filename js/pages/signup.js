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

                    if(!agreeAgent || !agreeAssignee) {
                        $('#signup-terms-modal').modal();
                        return false;
                    }

                    App.postData('register.php', JSON.stringify({
                        email: $('#register-email').val(),
                        pass: $('#register-password').val(),
                        fname: $('#register-firstname').val(),
                        lname: $('#register-lastname').val(),
                        terms: $('#register-terms').val(),
                        id: uuidv4()
                    }), true, $('#errorDisp')).then(data => {
                        $('#errorDisp').text('Registration successful...').removeClass('alert-danger hidden').addClass('alert-success');
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

function uuidv4() {
    if(crypto) {
        return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
            (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
        );
    } else {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    }
}