import Form from "../../components/form.js";

$(document).on('submit', 'form#register-form', tryRegister);

async function tryRegister(event){
    event.preventDefault();

    let form = event.target;
    
    let response = await Form.xhrAction(form, true);
    
    if(response.status === 1){
        location.reload();
    }
}