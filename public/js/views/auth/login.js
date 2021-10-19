import Form from "../../components/form.js";

let FORM_ID = '#login-form';

let isValid = false
let form = $(FORM_ID);

$(form).on('submit', async (event) => {
    if(!isValid){
        event.preventDefault();
        isValid = await Form.xhrValidate(form);
        if(isValid){
            $(form).trigger('submit');
        }
    }
})