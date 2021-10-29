import Form from "../../../components/form.js";

const MOVEMENT_BUTTON_DELETE = 'button[name=delete-movement]';
const MOVEMENT_FORM_DELETE = 'form[name=delete-movement]';

const MOVEMENT_ACTIONS_INIT = 'div[name=init]';
const MOVEMENT_ACTIONS_CONFIRM_DELETE = 'div[name=confirm-delete]';

$(document).on('click', MOVEMENT_BUTTON_DELETE, requireDeleteConfirmation);
$(document).on('submit', MOVEMENT_FORM_DELETE, confirmDelete);
$(document).on('reset', MOVEMENT_FORM_DELETE, cancelDeleteConfirmation);

function requireDeleteConfirmation(){
    let actionCell = $(this).closest('td');

    $(actionCell).find(MOVEMENT_ACTIONS_INIT).attr('hidden', 'hidden');
    $(actionCell).find(MOVEMENT_ACTIONS_CONFIRM_DELETE).removeAttr('hidden')
}

function cancelDeleteConfirmation(){
    let actionCell = $(this).closest('td');

    $(actionCell).find(MOVEMENT_ACTIONS_CONFIRM_DELETE).attr('hidden', 'hidden');
    $(actionCell).find(MOVEMENT_ACTIONS_INIT).removeAttr('hidden');
}

async function confirmDelete(event){
    event.preventDefault();

    let form = event.target;

    let response = await Form.xhrAction(form);

    if(response.status === 1){
        let currentTableRow = $(form).closest('tr');
        $(currentTableRow).remove();
    }
}