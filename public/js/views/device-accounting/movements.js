import Form from "../../components/form.js";

const SEARCH_FORM = 'form#search-form';
const SEARCH_INPUT = 'input#search-input';
const TABLE_CONTAINER = '#movement-table-container'

$(document).on('input', SEARCH_INPUT, searchInputInputHandler);

async function searchInputInputHandler(event) {
    event.preventDefault();

    let response = await Form.xhrAction(SEARCH_FORM);

    if (response.status === 1) {
        let resultTable = response.view;
        $(TABLE_CONTAINER).html(resultTable);
    }
}