const MOVEMENT_DELETE_BUTTON = 'button.delete-movement';

$(document).on('click', MOVEMENT_DELETE_BUTTON, requireDeleteConfirmation);

function requireDeleteConfirmation(){
    console.log(this);
}