class Form {

    static xhrAction(form, hasValidation = false) {
        const spinner = '<span name="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
        const success = '<i name="result" class="fas fa-check"></i>';
        const fail = '<i name="result" class="fas fa-times"></i>';

        let submitter = $(form).find(':submit').first();

        if (!submitter.length) {
            let submitterSelector = '#' + $(form).attr('submitter');
            submitter = $(submitterSelector);
        }

        $(submitter).width($(submitter).width());
        $(submitter).find('[name=result]').remove();
        $(submitter).find('[name=init-content]').hide();
        $(submitter).append(spinner);
        $(submitter).prop('disabled', true);

        if (hasValidation) {
            this.formatWithErrors(form);
        }

        return $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: $(form).serialize(),
            success: (response) => {
                let submitterStatusDelay = 0;

                if (response.status === 1) {
                    $(submitter).find('[name="spinner"]').replaceWith(success);
                } else {
                    $(submitter).find('[name="spinner"]').replaceWith(fail);
                    submitterStatusDelay = 2000;

                    if (hasValidation) {
                        this.formatWithErrors(form, response.errors);
                    }
                }

                setTimeout(() => {
                    $(submitter).find('[name=result]').fadeOut('slow', function (self) {
                        $(submitter).prop('disabled', false);
                        $(this).remove();
                        $(submitter).find('[name=init-content]').fadeIn('slow');
                    });
                }, submitterStatusDelay);
            },
        });
    }

    static formatWithErrors(form, errors = []) {
        $(form).find('.invalid-feedback').remove();
        $(form).find('.is-invalid').removeClass('is-invalid');

        $.each(errors, (fieldName, fieldErrors) => {
            let invalidFeedback = $.parseHTML('<div class="invalid-feedback d-block pl-3" role="alert"></div>');

            fieldErrors.forEach(fieldError => {
                $(invalidFeedback).append('<div>' + fieldError + '</div>');
            });

            let input = $(form).find('[name=' + fieldName + ']');
            $(input).addClass('is-invalid');
            $(input).after(invalidFeedback);
        });
    }

    static reset(formId) {
        $(formId).find('.invalid-feedback').remove();
        $(formId).find('.is-invalid').removeClass('is-invalid');
        $(formId).trigger('reset');
    }
}

export default Form;