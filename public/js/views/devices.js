import Form from "../components/form.js";

const SEARCH_INPUT = 'input#search-input';
const SEARCH_FORM = 'form#search-form';
const DEVICE_TABLE_CONTAINER = '#device-table-container';
const PAGINATION_LINKS = 'a.page-link';

$(document).on('input', SEARCH_INPUT, searchDeviceHandler);
$(document).on('click', PAGINATION_LINKS, switchPaginationPage);

async function searchDeviceHandler(event){
    event.preventDefault();

    let response = await Form.xhrAction(SEARCH_FORM);

    if(response.status === 1){
        let resultDeviceTable = response.view;
        $(DEVICE_TABLE_CONTAINER).html(resultDeviceTable);
    }
}

async function switchPaginationPage(event){
    event.preventDefault();

    let link = event.target;
    let url = $(link).attr('href');

    let response = await $.get(url);

    if(response.status === 1){
        let resultDeviceTable = response.view;
        $(DEVICE_TABLE_CONTAINER).html(resultDeviceTable);
    }
}