class Form{

    static xhrAction(form, hasValidation = false){
        const spinner = '<span name="spinner" class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>';
        const success = '<i class="fas fa-check mr-2"></i>';
        const fail = '<i class="fas fa-times mr-2"></i>';

        let submitter = $(form).find(':submit').first();
        let submitterText = $(submitter).html();
        $(submitter).html(spinner);

        if(hasValidation){
            this.#formatWithErrors(form);
        }

        return $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: $(form).serialize(),
            success: (response) => {
                if(response.status === 1){
                    $(submitter).html(success);
                }
                else{
                    $(submitter).html(fail);

                    if(hasValidation){
                        this.#formatWithErrors(form, response.errors);
                    }
                }
    
                setTimeout(() => {
                    $(submitter).children().hide('slow', function(self){
                        $(submitter).html(submitterText);
                    });
                }, 2000);
            },
        })
    }
    
    static #formatWithErrors(form, errors = []){
        $(form).find('.invalid-feedback').remove();
        $(form).find('.is-invalid').removeClass('is-invalid');

        $.each(errors, (fieldName, fieldErrors) => {
            let ul = $.parseHTML('<ul class="invalid-feedback d-block pl-3" role="alert"></ul>');
            let li = $.parseHTML('<strong style="display: list-item"></strong>');

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