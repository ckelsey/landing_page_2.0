/*
 *  Document   : contact.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Contact page
 */

var Ticket = function() {

    return {
        init: function() {
            $('#form-ticket').validate({
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
                    'ticket-name': {
                        required: true,
                        minlength: 2
                    },
                    'ticket-email': {
                        required: true,
                        email: true
                    },
                    'ticket-message': {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {
                    'ticket-name': {
                        required: 'Please let us know your name!',
                        minlength: 'Please let us know your name!'
                    },
                    'ticket-email': 'Please let us know your valid email!',
                    'ticket-message': {
                        required: 'Please let us know how we can assist!',
                        minlength: 'Please let us know how we can assist!'
                    }
                },
                submitHandler: function(theForm) {
                    App.postData('saveTicketInfo.php', $('#form-ticket').serialize(), false, null, 'application/x-www-form-urlencoded')
                    .then(data => {
                        $('#form-ticket').hide();
                        $('<p>Thank you for submitting your information!  We will be in contact soon.</p>').appendTo('#ticketmessage');
                    }).catch(data => {

                    });
                }
            });
        }
    };
}();