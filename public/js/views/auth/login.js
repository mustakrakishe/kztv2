import Form from "../../components/form.js";

let LOGIN_FORM = 'form#login-form';

let isValid = false

$(LOGIN_FORM).on('submit', async (event) => {
    if(!isValid){
        event.preventDefault();
        isValid = await Form.xhrValidate(LOGIN_FORM);
        if(isValid){
            $(LOGIN_FORM).trigger('submit');
        }
    }
})