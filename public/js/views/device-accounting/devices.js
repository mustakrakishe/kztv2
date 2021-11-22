import * as Textarea from "../../components/textarea.js";
import Form from "../../components/form.js";

const CONTEXT_MENU_DELETE = '#contextmenu [name=delete]';
const CONTEXT_MENU_EDIT = '#contextmenu [name=edit]';
const CREATE_LINK = 'a#create'
const DEVICE_ROW = 'tr[name=device]';
const DEVICE_TABLE_CONTAINER = '#device-table-container';
const DEVICE_TABLE_PAGINATOR = '#device-table-paginator';
const UPDATE_FORM = '#edit-modal form';
const DELETE_FORM = 'form#delete';
const PAGINATION_LINK = 'a.page-link';
const SEARCH_FORM = 'form#search-form';
const SEARCH_INPUT = 'input#search-input';
const TAB_PANEL = '[role=tabpanel]';

// listeners

$(document).on('click', hideContextMenu);
$(document).on('click', CONTEXT_MENU_DELETE, contextMenuDeleteHandler);
$(document).on('click', CONTEXT_MENU_EDIT, contextMenuEditHandler);
$(document).on('click', CREATE_LINK, createLinkClickHandler);
$(document).on('contextmenu', DEVICE_ROW, deviceRowContextMenuHandler);
$(document).on('submit', UPDATE_FORM, updateFormSubmitHandler);
$(document).on('submit', DELETE_FORM, deleteFormSubmitHandler);
$(document).on('click', PAGINATION_LINK, switchPaginationPage);
$(document).on('input', SEARCH_INPUT, searchDeviceHandler);

// Handlers

async function contextMenuEditHandler(event) {
    event.preventDefault();

    let link = event.target;

    let response = await $.get($(link).attr('href'));

    if (response.status === 1) {
        let editDialog = $.parseHTML(response.view);
        showDialog(editDialog);
    }
}

async function contextMenuDeleteHandler(event) {
    event.preventDefault();

    let link = event.target;
    let url = $(link).attr('href');

    let dialog = $.parseHTML(deleteConfirmationModalHtml);
    $(dialog).find('form').attr('action', url);

    showDialog(dialog);
}

async function createLinkClickHandler(event) {
    event.preventDefault();

    let dialog = $.parseHTML(createModalHtml);
    showDialog(dialog);
}

async function deleteFormSubmitHandler(event) {
    event.preventDefault();

    let form = event.target;

    let response = await $.post({
        url: $(form).attr('action'),
        data: $(form).serialize(),
    });

    if (response.status === 1) {
        let currentPage = $(DEVICE_TABLE_PAGINATOR).attr('current-page');
        switchDeviceTablePage(currentPage);
    }
}

function deviceRowContextMenuHandler(event){
    event.preventDefault();
    showContextMenu(event);
}

async function searchDeviceHandler(event) {
    event.preventDefault();

    let response = await Form.xhrAction(SEARCH_FORM);

    if (response.status === 1) {
        let resultDeviceTable = response.view;
        $(DEVICE_TABLE_CONTAINER).html(resultDeviceTable);
    }
}

async function updateFormSubmitHandler(event){
    event.preventDefault();

    let hasValidation = true;
    let response = await Form.xhrAction(this, hasValidation);
    
    if (response.status === 1) {
        $(this).closest(TAB_PANEL).html(response.view);
        console.log($(this).closest(TAB_PANEL));
        switchDeviceTablePage(1);
    }
}

// helpers

async function switchPaginationPage(event) {
    event.preventDefault();

    let link = event.target;
    let url = $(link).attr('href');

    let response = await $.get(url);

    if (response.status === 1) {
        let resultDeviceTable = response.view;
        $(DEVICE_TABLE_CONTAINER).html(resultDeviceTable);
    }
}

async function showContextMenu(event) {
    let coordinates = {
        x: event.pageX,
        y: event.pageY,
    };

    hideContextMenu();
    
    let tr = event.currentTarget;
    let deviceId = $(tr).attr('id');

    let contextMenu = $.parseHTML(contextMenuHtml);

    $(contextMenu).children().each((index, link) => {
        let actualUrl = $(link).attr('href').replace('#', deviceId);
        $(link).attr('href', actualUrl);
    });


    $('body').prepend(contextMenu);

    $(contextMenu).parent().css({ position: 'relative' });
    $(contextMenu).css({
        top: coordinates.y,
        left: coordinates.x,
        position: 'absolute'
    });
    $(contextMenu).css('z-index', 3000);
}

function hideContextMenu() {
    $('#contextmenu').remove();
}

function showDialog(dialog) {
    $('body').append(dialog);
    $(dialog).modal('show');

    $(dialog).on('hidden.bs.modal', function () {
        $(this).remove();
    });
}

async function switchDeviceTablePage(page) {
    let url = $(DEVICE_TABLE_PAGINATOR).attr('path');

    let response = await $.get(url, { page });

    if (response.status === 1) {
        let deviceTablePage = response.view;
        $(DEVICE_TABLE_CONTAINER).html(deviceTablePage);
    }
}