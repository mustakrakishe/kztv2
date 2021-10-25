class Form{

    static xhrAction(form, hasValidation = false){
        let submit = $(form).find(':submit').first();

        if(hasValidation){
            this.#formatWithErrors(form);
        }

        return $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: $(form).serialize(),
            success: (response) => {
                if(hasValidation && response.status === 0){
                    this.#formatWithErrors(form, response.errors);
                }
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