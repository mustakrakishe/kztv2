import * as Textarea from "../../components/textarea.js";
import Form from "../../components/form.js";

const CREATE_LINK = 'a#create';

$(document).on('click', CREATE_LINK, createLinkClickHandler);

async function createLinkClickHandler(event) {
    event.preventDefault();

    let link = event.target;
    let url = $(link).attr('href');

    let response = await $.get(url);

    if (response.status === 1) {
        let dialog = response.view;
        showDialog(dialog);
    }
}

// helpers

function showDialog(dialog) {
    $('body').append(dialog);
    $(dialog).modal('show');

    $(dialog).on('hidden.bs.modal', function () {
        $(this).remove();
    });
}