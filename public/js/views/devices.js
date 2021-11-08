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

const CONTEXT_MENU_DELETE = '#contextmenu [name=delete]';

$(document).on('input', SEARCH_INPUT, searchDeviceHandler);
$(document).on('click', PAGINATION_LINK, switchPaginationPage);
$(document).on('contextmenu', DEVICE_ROW, showContextMenu);
$(document).on('click', hideContextMenu);
$(document).on('submit', DEVICE_UPDATE_FORM, updateDevice);
$(document).on('submit', CONTEXT_MENU_DELETE, contextMenuDeleteHandler);

// Handlers

async function searchDeviceHandler(event){
    event.preventDefault();

    let response = await Form.xhrAction(SEARCH_FORM);

    if(response.status === 1){
        let resultDeviceTable = response.view;
        $(DEVICE_TABLE_CONTAINER).html(resultDeviceTable);
    }
}

async function contextMenuDeleteHandler(event){
    event.preventDefault();

    let link = event.target;
    console.log(link);
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
        $(DEVICE_PROPERTIES_MODAL).find('.modal-body').html(response.view_properties);
        $(DEVICE_PROPERTIES_MODAL).modal('show');

        $(DEVICE_DELETE_MODAL).find('.modal-body').html(response.view_delete);
    }
}

async function showContextMenu(event){
    event.preventDefault();

    let coordinates = {
        x: event.clientX,
        y: event.clientY,
    };

    hideContextMenu();

    let tr = this;
    let deviceId = $(tr).attr('id');
    
    let contextMenu = $.parseHTML(contextMenuHtml);

    $(contextMenu).children().each((index, link) => {
        let actualUrl = $(link).attr('href').replace('#', deviceId);
        $(link).attr('href', actualUrl);
    });
    
    
    $('body').prepend(contextMenu);

    $(contextMenu).parent().css({position: 'relative'});
    $(contextMenu).css({
        top: coordinates.y,
        left: coordinates.x,
        position:'absolute'
    });
    $(contextMenu).css('z-index', 3000);
}

function hideContextMenu(){
    $('#contextmenu').remove();
}

async function updateDevice(event){
    event.preventDefault();

    let form = event.target;
    let hasValidation = true;

    let response = await Form.xhrAction(form, hasValidation);

    if(response.status === 1){
        switchDeviceTablePage(1);
    }
}

async function deleteDevice(event){
    event.preventDefault();

    let form = event.target;

    let response = await Form.xhrAction(form);

    if(response.status === 1){
        $(DEVICE_DELETE_MODAL).modal('hide');

        let currentPage = $(DEVICE_TABLE_PAGINATOR).attr('current-page');
        switchDeviceTablePage(currentPage);
    }
}

async function switchDeviceTablePage(page){
    let url = $(DEVICE_TABLE_PAGINATOR).attr('path');
        
    let response = await $.get(url, {page});

    if(response.status === 1){
        let deviceTablePage = response.view;
        $(DEVICE_TABLE_CONTAINER).html(deviceTablePage);
    }
}