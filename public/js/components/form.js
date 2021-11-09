class Form{

    static xhrAction(form, hasValidation = false){
        const spinner = '<span name="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
        const success = '<i name="result" class="fas fa-check"></i>';
        const fail = '<i name="result" class="fas fa-times"></i>';

        let submitter = $(form).find(':submit').first();
        $(submitter).width($(submitter).width());
        $(submitter).find('[name=result]').remove();
        $(submitter).find('[name=init-content]').hide();
        $(submitter).append(spinner);
        $(submitter).prop('disabled', true);

        if(hasValidation){
            this.formatWithErrors(form);
        }

        return $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: $(form).serialize(),
            success: (response) => {
                if(response.status === 1){
                    $(submitter).find('[name="spinner"]').replaceWith(success);
                }
                else{
                    $(submitter).find('[name="spinner"]').replaceWith(fail);

                    if(hasValidation){
                        this.formatWithErrors(form, response.errors);
                    }
                }
    
                setTimeout(() => {
                    $(submitter).find('[name=result]').fadeOut('slow', function(self){
                        $(submitter).prop('disabled', false);
                        $(this).remove();
                        $(submitter).find('[name=init-content]').fadeIn('slow');
                    });
                }, 2000);
            },
        })
    }
    
    static formatWithErrors(form, errors = []){
        $(form).find('.invalid-feedback').remove();
        $(form).find('.is-invalid').removeClass('is-invalid');

        $.each(errors, (fieldName, fieldErrors) => {
            let ul = $.parseHTML('<ul class="invalid-feedback d-block pl-3" role="alert"></ul>');
            let li = $.parseHTML('<strong class="small" style="display: list-item"></strong>');

            fieldErrors.forEach(fieldError => {
                $(li).html(fieldError);
                $(ul).append(li);
            });

            let input = $(form).find('[name=' + fieldName + ']');
            $(input).addClass('is-invalid');
            $(input).after(ul);
        });
    }

    static reset(formId){
        $(formId).find('.invalid-feedback').remove();
        $(formId).find('.is-invalid').removeClass('is-invalid');
        $(formId).trigger('reset');
    }
}

export default Form;