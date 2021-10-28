import * as Textarea from "../components/textarea.js";
import Form from "../components/form.js";

const SEARCH_INPUT = 'input#search-input';
const SEARCH_FORM = 'form#search-form';
const DEVICE_TABLE_CONTAINER = '#device-table-container';
const PAGINATION_LINK = 'a.page-link';
const DEVICE_ROW = 'tr[name=device]';
const DEVICE_PROPERTIES_MODAL = '#device-properties-modal';
const DEVICE_DELETE_MODAL = '#device-delete-modal';
const DEVICE_UPDATE_FORM = '#device-update-form';
const DEVICE_TABLE_PAGINATOR = '#device-table-paginator';
const DEVICE_DELETE_FORM = '#device-delete-form';

$(document).on('input', SEARCH_INPUT, searchDeviceHandler);
$(document).on('click', PAGINATION_LINK, switchPaginationPage);
$(document).on('click', DEVICE_ROW, editDevice);
$(document).on('submit', DEVICE_UPDATE_FORM, updateDevice);
$(document).on('show.bs.modal shown.bs.modal', '.modal', protectBodyScrolling);
$(document).on('submit', DEVICE_DELETE_FORM, deleteDevice);

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

async function editDevice(event){
    event.preventDefault();

    let deviceRow = event.currentTarget;
    let url = $(deviceRow).attr('href');
    
    let response = await $.get(url);

    if(response.status === 1){
        $(DEVICE_PROPERTIES_MODAL).find('.modal-body').html(response.view_properties);
        $(DEVICE_PROPERTIES_MODAL).modal('show');

        $(DEVICE_DELETE_MODAL).find('.modal-body').html(response.view_delete);
    }
}

async function updateDevice(event){
    event.preventDefault();

    const spinner = '<span name="spinner" class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>';

    let form = event.target;
    let submitter = $(form).find(':submit');
    let submitterText = $(submitter).html();
    let hasValidation = true;

    $(submitter).prepend(spinner);

    let response = await Form.xhrAction(form, hasValidation);

    $(submitter).html(response.message);

    if(response.status === 1){
        let url = $(DEVICE_TABLE_PAGINATOR).attr('first-page-url');
        
        let response = await $.get(url);

        if(response.status === 1){
            let deviceTablePage = response.view;
            $(DEVICE_TABLE_CONTAINER).html(deviceTablePage);
        }
    }

    setTimeout(() => {
        $(submitter).children().hide('slow', function(self){
            $(this).parent().html(submitterText);
        });
    }, 2000);
}

function protectBodyScrolling(){
    $("body").addClass("modal-open");
}

async function deleteDevice(event){
    event.preventDefault();

    let form = event.target;

    let response = await Form.xhrAction(form);

    if(response.status === 1){

    }
}

async function refreshDeviceTable(){
    let url = $(DEVICE_TABLE_PAGINATOR).attr('first-page-url');
        
    let response = await $.get(url);

    if(response.status === 1){
        let deviceTablePage = response.view;
        $(DEVICE_TABLE_CONTAINER).html(deviceTablePage);
    }
}