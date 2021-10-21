import Form from "../components/form.js";

const SEARCH_INOUT = 'input#search-input';
const PAGE_INOUT = 'input#page-input';
const SEARCH_FORM = 'form#search-form';
const DEVICE_TABLE_CONTAINER = '#device-table-container';
const PAGE_LINKS = 'a.page-link';

$(SEARCH_INOUT).on('input', searchDeviceHandler);
$(document).on('click', PAGE_LINKS, switchPaginationPage);

async function searchDeviceHandler(event){
    event.preventDefault();

    $(PAGE_INOUT).val(1);
    let resultDeviceTable = await Form.xhrAction(SEARCH_FORM);

    $(DEVICE_TABLE_CONTAINER).html(resultDeviceTable);
}

async function switchPaginationPage(event){
    event.preventDefault();

    let link = event.target;
    let page = $(link).attr('href').split('page=')[1];
    $(PAGE_INOUT).val(page);

    let resultDeviceTable = await Form.xhrAction(SEARCH_FORM);

    $(DEVICE_TABLE_CONTAINER).html(resultDeviceTable);
}