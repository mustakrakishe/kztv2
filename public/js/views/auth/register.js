import Form from "../../components/form.js";

let REGISTER_FORM = 'form#register-form';

let isValid = false

$(REGISTER_FORM).on('submit', async (event) => {
    if(!isValid){
        event.preventDefault();
        isValid = await Form.xhrValidate(REGISTER_FORM);
        if(isValid){
            $(REGISTER_FORM).trigger('submit');
        }
    }
})