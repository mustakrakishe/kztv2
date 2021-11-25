class Form {

    static xhrAction(form, hasValidation = false) {

        let submitter = $(form).find(':submit').first();

        if (!submitter.length) {
            let formId = $(form).attr('id');
            submitter = $(`[type=submit][form=${formId}]`);
        }

        this.showProgresInSubmitter(submitter);

        if (hasValidation) {
            this.formatWithErrors(form);
        }

        return $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: $(form).serialize(),
            success: (response) => {
                let isResultSuccessfull = response.status;
                this.playResultInSubmitter(submitter, isResultSuccessfull);

                if (response.status === 0 && hasValidation) {
                    this.formatWithErrors(form, response.errors);
                }
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

    static showProgresInSubmitter(submitter) {
        const SPINNER = '<span name="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';

        $(submitter).width($(submitter).width());
        $(submitter).find('[name=result]').remove();
        $(submitter).find('[name=init-content]').hide();
        $(submitter).append(SPINNER);
        $(submitter).prop('disabled', true);
    }

    static playResultInSubmitter(submitter, isResultSuccessfull, duration = 750) {
        return new Promise(resolve => {
            const SUCCESS = '<i name="result" class="fas fa-check"></i>';
            const FAIL = '<i name="result" class="fas fa-times"></i>';
    
            let result = isResultSuccessfull ? SUCCESS : FAIL;
    
            $(submitter).find('[name="spinner"]').replaceWith(result);
    
            setTimeout(() => {
                $(submitter).find('[name=result]').fadeOut('slow', function (self) {
                    $(submitter).prop('disabled', false);
                    $(this).remove();
                    $(submitter).find('[name=init-content]').fadeIn('slow');
                    resolve();
                });
            }, duration);
        });
    }
}

export default Form;