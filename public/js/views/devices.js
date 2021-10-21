import Form from "../components/form.js";

const SEARCH_INOUT = 'input#search-input';
const SEARCH_FORM = 'form#search-form';
const DEVICE_TABLE_CONTAINER = '#device-table-container';

$(SEARCH_INOUT).on('input', searchDeviceHandler);

async function searchDeviceHandler(event){
    event.preventDefault();

    let resultDeviceTable = await Form.xhrAction(SEARCH_FORM);

    $(DEVICE_TABLE_CONTAINER).html(resultDeviceTable);
}