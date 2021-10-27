import * as Textarea from "../components/textarea.js";
import Form from "../components/form.js";

const SEARCH_INPUT = 'input#search-input';
const SEARCH_FORM = 'form#search-form';
const DEVICE_TABLE_CONTAINER = '#device-table-container';
const PAGINATION_LINK = 'a.page-link';
const DEVICE_ROW = 'tr[name=device]';
const DEVICE_PROPERTIES_MODAL = '#device-properties-modal';

$(document).on('input', SEARCH_INPUT, searchDeviceHandler);
$(document).on('click', PAGINATION_LINK, switchPaginationPage);
$(document).on('click', DEVICE_ROW, showProperties);

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

async function showProperties(event){
    event.preventDefault();

    let deviceRow = event.currentTarget;
    let url = $(deviceRow).attr('href');
    
    let response = await $.get(url);

    if(response.status === 1){
        let properties = response.view;
        
        $(DEVICE_PROPERTIES_MODAL).find('.modal-body').html(properties);
        $(DEVICE_PROPERTIES_MODAL).modal('show');
    }
}