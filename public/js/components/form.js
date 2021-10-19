class Form{

    static async xhrAction(form, action = null, method = null){
        let ajaxSettings = {};

        ajaxSettings.url = action
            || $(form).attr('action')
            || '#';

        ajaxSettings.method = method
            || $(form).attr('method')
            || 'get';

        if(['post', 'put', 'patch'].includes(ajaxSettings.method)){
            ajaxSettings.data = this.getFormData(form);
        }

        let response = await $.ajax(ajaxSettings);
        return response;
    }
    
    static getFormData(form){        
        let keyValuePairs = $(form).serializeArray();
        let formData = Object.fromEntries(keyValuePairs.map(field => {
            return [field.name, field.value];
        }));

        return formData;
    }
    
    static async xhrValidate(form){
        let isValid = false;
    
        $(form).find('.invalid-feedback').remove();
        $(form).find('.is-invalid').removeClass('is-invalid');
        
        let url = $(form).attr('validation');
        let errors = await this.xhrAction(form, url, 'post');

        if(!errors){
            isValid = true;
        }
        else{
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

        return isValid;
    }

    static reset(formId){
        $(formId).find('.invalid-feedback').remove();
        $(formId).find('.is-invalid').removeClass('is-invalid');
        $(formId).trigger('reset');
    }
}

export default Form;