import Form from "../../../components/form.js";

const MOVEMENT_BUTTON_DELETE = 'button[name=delete-movement]';
const MOVEMENT_FORM_UPDATE = 'form[name=update-movement]';
const MOVEMENT_FORM_DELETE = 'form[name=delete-movement]';

const MOVEMENT_ROW_INPUT = 'tr[name=movement] input';

const MOVEMENT_ACTIONS_INIT = 'div[name=init]';
const MOVEMENT_ACTIONS_EDIT = 'div[name=edit]';
const MOVEMENT_ACTIONS_CONFIRM_DELETE = 'div[name=confirm-delete]';

$(document).on('click', MOVEMENT_BUTTON_DELETE, requireDeleteConfirmation);
$(document).on('submit', MOVEMENT_FORM_UPDATE, updateMovement);
$(document).on('reset', MOVEMENT_FORM_UPDATE, cancelEditMovement);
$(document).on('submit', MOVEMENT_FORM_DELETE, confirmDelete);
$(document).on('reset', MOVEMENT_FORM_DELETE, cancelDeleteConfirmation);
$(document).on('input', MOVEMENT_ROW_INPUT, showEditModeActions);

async function updateMovement(event){
    event.preventDefault();

    let form = event.target;
    let tableRow = $(event.target).closest('tr');
    
    Form.formatWithErrors(tableRow);

    let response = await Form.xhrAction(form);

    if(response.status === 1){
        $(tableRow).replaceWith(response.view);
    }
    else{
        Form.formatWithErrors(tableRow, response.errors);
    }
}

function cancelEditMovement(event){
    let tableRow = $(event.target).closest('tr');
    
    Form.formatWithErrors(tableRow);

    $(tableRow).find(MOVEMENT_ACTIONS_EDIT).attr('hidden', 'hidden');
    $(tableRow).find(MOVEMENT_ACTIONS_INIT).removeAttr('hidden');
}

function requireDeleteConfirmation(){
    let tableRow = $(this).closest('tr');

    $(tableRow).children('td').addClass('align-bottom');

    $(tableRow).find(MOVEMENT_ACTIONS_INIT).attr('hidden', 'hidden');
    $(tableRow).find(MOVEMENT_ACTIONS_CONFIRM_DELETE).removeAttr('hidden');
}

function cancelDeleteConfirmation(){
    let tableRow = $(this).closest('tr');

    $(tableRow).children('td').removeClass('align-bottom');

    $(tableRow).find(MOVEMENT_ACTIONS_CONFIRM_DELETE).attr('hidden', 'hidden');
    $(tableRow).find(MOVEMENT_ACTIONS_INIT).removeAttr('hidden');
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

function showEditModeActions(event){
    let tableRow = $(event.target).closest('tr');

    $(tableRow).find(MOVEMENT_ACTIONS_INIT).attr('hidden', 'hidden');
    $(tableRow).find(MOVEMENT_ACTIONS_EDIT).removeAttr('hidden');
}