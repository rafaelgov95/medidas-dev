/**
 * @author Dominic Watson
 *
 * Functionality for posting ZF2 forms with AJAX and displaying errors etc.
 * Just add data-ajax="1" to the <form>
 */
(function( $ ) {

    $.widget( "app.ajaxZendForms", {

        options: {
        },

        _create: function ()
        {
            var self = this;
            self.setupEvents();
        },

        setupEvents: function ()
        {
            var self = this;

            self.element.on('submit', 'form[data-ajax]', function () {

                var form = $(this),
                    button = form.find('button[type="submit"], input[type="submit"]');

                button.button('loading');

                // Remove old errors as they're re-added again later anyway
                form.find('.errors').remove();
                form.find('.control-group').removeClass('error');

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serializeObject()
                }).always(function (msg) {

                    button.button('reset');

                }).done(function (msg) {

                    if (msg.success === false) {
                        self.fail(form, msg);
                        return false;
                    }

                    /**
                     * For now let's just set the button to green and disabled,
                     * we could eventually return success messages or flashMessages and invoke it here
                     */
                    button.button('complete').prop('disabled', 'disabled');


                }).fail(function (msg) {

                    self.fail(form, msg);

                })

                return false;

            });

        },

        fail: function (form, msg)
        {
            var self = this;

            // Loop through each of the fields
            $.each(msg.errors, function (fieldName, errors) {

                var controlGroup = $('#cgroup-' + fieldName),
                    controls = controlGroup.find('.controls'),
                    errorList = $('<ul class="help-block errors"></ul>');

                controlGroup.addClass('error');
                controls.append(errorList);

                // Loop through each of the errors and append it to the UL list of errors
                $.each(errors, function(errorKey, errorText) {

                    errorList.append('<li>' + errorText + '</li>');

                });

            });

        },



    });

}( jQuery ) );