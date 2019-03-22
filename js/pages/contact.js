/*
 *  Document   : contact.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Contact page
 */

var Contact = function() {

    return {
        init: function() {
            $('#form-contact').validate({
                errorClass: 'help-block animation-slideDown', 
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    e.parents('.form-group').append(error);
                },
                highlight: function(e) {
                    $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                    $(e).closest('.help-block').remove();
                },
                success: function(e) {
                    e.closest('.form-group').removeClass('has-success has-error').addClass('has-success');
                    e.closest('.help-block').remove();
                },
                rules: {
                    'contact-name': {
                        required: true,
                        minlength: 2
                    },
                    'contact-email': {
                        required: true,
                        email: true
                    },
                    'contact-message': {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {
                    'contact-name': {
                        required: 'Please let us know your name!',
                        minlength: 'Please let us know your name!'
                    },
                    'contact-email': 'Please let us know your valid email!',
                    'contact-message': {
                        required: 'Please let us know how we can assist!',
                        minlength: 'Please let us know how we can assist!'
                    }
                },
                submitHandler: function(theForm) {
                    App.postData('saveContactInfo.php', $('#form-contact').serialize(), false, null, 'application/x-www-form-urlencoded')
                    .then(data => {

                    }).catch(data => {

                    });
                }
            });
        }
    };
}();