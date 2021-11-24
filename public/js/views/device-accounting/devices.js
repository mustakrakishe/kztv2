import * as Textarea from "../../components/textarea.js";
import Form from "../../components/form.js";
import * as Tabswitcher from "../../components/tabswitcher.js";

const CONTEXT_MENU_DELETE = '#contextmenu [name=delete]';
const CONTEXT_MENU_EDIT = '#contextmenu [name=edit]';
const CONTEXT_MENU_MOVE = '#contextmenu [name=move]';
const CREATE_DEVICE_ACCOUNT_MODAL = '#create-device-account-modal';
const CREATE_DEVICE_ACCOUNT_LINK = 'a#create-device-account'
const CREATE_MOVEMENT_MODAL = '#create-movement-modal'
const DEVICE_ROW = 'tr[name=device]';
const DEVICE_TABLE_CONTAINER = '#device-table-container';
const DEVICE_TABLE_PAGINATOR = '#device-table-paginator';
const UPDATE_FORM = '#edit-device-account-modal form';
const DELETE_FORM = 'form#delete';
const GENERAL_TAB_PANEL = '[name=general]'
const PAGINATION_LINK = 'a.page-link';
const PANEL = '[role=tabpanel]';
const SEARCH_FORM = 'form#search-form';
const SEARCH_INPUT = 'input#search-input';
const STORE_DEVICE_ACCOUNT_BUTTON = '#store-device-btn';
const STORE_DEVICE_FORM = '#create-device-form';
const STORE_HARDWARE_FORM = '#create-hardware-form';
const STORE_MOVEMENT_FORM = '#create-movement-form';
const STORE_SOFTWARE_FORM = '#create-software-form';
const TAB_PANEL = '[role=tabpanel]';
const TABSWITCHER_BACK = '[role=tabswitcher][direction=prev]';
const TABSWITCHER_NEXT = '[role=tabswitcher][direction=next]';

// listeners

$(document).on('click', hideContextMenu);
$(document).on('click', CONTEXT_MENU_DELETE, contextMenuDeleteHandler);
$(document).on('click', CONTEXT_MENU_EDIT, contextMenuEditHandler);
$(document).on('click', CONTEXT_MENU_MOVE, contextMenuMoveHandler);
$(document).on('show.bs.modal', CREATE_DEVICE_ACCOUNT_MODAL, createDeviceAccountModalShowHandler);
$(document).on('click', CREATE_DEVICE_ACCOUNT_LINK, createLinkClickHandler);
$(document).on('contextmenu', DEVICE_ROW, deviceRowContextMenuHandler);
$(document).on('submit', UPDATE_FORM, updateFormSubmitHandler);
$(document).on('submit', DELETE_FORM, deleteFormSubmitHandler);
$(document).on('click', PAGINATION_LINK, paginationLinkClickHandler);
$(document).on('input', SEARCH_INPUT, searchDeviceHandler);
$(document).on('click', STORE_DEVICE_ACCOUNT_BUTTON, storeDeviceAccountButtonClickHandler);
$(document).on('submit', STORE_MOVEMENT_FORM, storeMovementFormSubmitHandler);
$(document).on('click', TABSWITCHER_BACK, tabswitcherBackClickHandler);
$(document).on('click', TABSWITCHER_NEXT, tabswitcherNextClickHandler);

// handlers

async function contextMenuDeleteHandler(event) {
    event.preventDefault();

    let link = event.target;
    let url = $(link).attr('href');

    let dialog = $.parseHTML(deleteConfirmationModalHtml);
    $(dialog).find('form').attr('action', url);

    showDialog(dialog);
}

async function contextMenuEditHandler(event) {
    event.preventDefault();

    let link = event.target;

    let response = await $.get($(link).attr('href'));
    
    if (response.status === 1) {
        let editDialog = $.parseHTML(response.view);
        showDialog(editDialog);
    }
}

async function contextMenuMoveHandler(event) {
    event.preventDefault();

    let link = event.target;

    let response = await $.get($(link).attr('href'));

    if (response.status === 1) {
        let moveDialog = $.parseHTML(response.view);
        showDialog(moveDialog);
    }
}

async function createLinkClickHandler(event) {
    event.preventDefault();

    let dialog = $.parseHTML(createDeviceAccountModalHtml);
    showDialog(dialog);
}

function createDeviceAccountModalShowHandler() {
    $( CREATE_DEVICE_ACCOUNT_MODAL).find('input[name=date]').val(currentDatetimeISO());
}

async function deleteFormSubmitHandler(event) {
    event.preventDefault();

    let form = event.target;

    let response = await $.post({
        url: $(form).attr('action'),
        data: $(form).serialize(),
    });

    if (response.status === 1) {
        refreshDeviceTablePage();
    }
}

function deviceRowContextMenuHandler(event) {
    event.preventDefault();
    showContextMenu(event);
}

async function paginationLinkClickHandler(event) {
    event.preventDefault();

    let link = event.target;
    let url = $(link).attr('href');

    let response = await $.get(url);

    if (response.status === 1) {
        let deviceTable = response.view;
        $(DEVICE_TABLE_CONTAINER).html(deviceTable);
    }
}

async function searchDeviceHandler(event) {
    event.preventDefault();

    let response = await Form.xhrAction(SEARCH_FORM);

    if (response.status === 1) {
        let resultDeviceTable = response.view;
        $(DEVICE_TABLE_CONTAINER).html(resultDeviceTable);
    }
}

async function storeDeviceAccountButtonClickHandler() {
    $(this).prop('disabled', true);

    let deviceStoreResponse = await Form.xhrAction(STORE_DEVICE_FORM);
    
    if (deviceStoreResponse.status !== 1) {
        $(this).prop('disabled',false);
        return;
    }

    let deviceId = deviceStoreResponse.device.id;

    $(STORE_MOVEMENT_FORM).find('[name=device_id]').val(deviceId);
    let movementStoreResponse = await Form.xhrAction(STORE_MOVEMENT_FORM);
    
    if (movementStoreResponse.status !== 1) {
        $(this).prop('disabled',false);
        return;
    }

    $(STORE_HARDWARE_FORM).find('[name=device_id]').val(deviceId);
    let hardwareStoreResponse = await Form.xhrAction(STORE_HARDWARE_FORM);
    
    if (hardwareStoreResponse.status !== 1) {
        $(this).prop('disabled',false);
        return;
    }

    let software = {
        description: $(STORE_SOFTWARE_FORM).find('[name=description]').val(),
        comment: $(STORE_SOFTWARE_FORM).find('[name=comment]').val(),
    }

    if(software.description || software.comment){
        $(STORE_SOFTWARE_FORM).find('[name=device_id]').val(deviceId);
        let softwareStoreResponse = await Form.xhrAction(STORE_SOFTWARE_FORM);
    
        if (softwareStoreResponse.status !== 1) {
            $(this).prop('disabled',false);
            return;
        }
    }
    
    await switchDeviceTablePage(1);

    $( CREATE_DEVICE_ACCOUNT_MODAL).modal('hide');
}

async function storeMovementFormSubmitHandler(event) {
    let modal = $(this).closest('.modal');

    if ($(modal).is(CREATE_MOVEMENT_MODAL)) {
        event.preventDefault();
    
        let hasValidation = true;
        let response = await Form.xhrAction(this, hasValidation);
        
        if (response.status === 1) {
            await switchDeviceTablePage(1);
            $(modal).modal('hide');
        }
    }
}

async function tabswitcherBackClickHandler() {
    $(STORE_DEVICE_ACCOUNT_BUTTON).attr('disabled', true);
    Tabswitcher.tabswitcherBackClickHandler(this);
}

async function tabswitcherNextClickHandler() {
    let form = getModalCurrentForm( CREATE_DEVICE_ACCOUNT_MODAL);
    
    if ($(form).attr('validation')) {
        $(this).attr('disabled', true);
        let isValid = await validateForm(form);
        $(this).attr('disabled', false);

        if (isValid) {
            Tabswitcher.tabswitcherNextClickHandler(this);
        }
    } else {
        Tabswitcher.tabswitcherNextClickHandler(this);
    }
}

async function updateFormSubmitHandler(event) {
    event.preventDefault();

    let hasValidation = true;
    let response = await Form.xhrAction(this, hasValidation);
    
    if (response.status === 1) {
        let currentTabPanel = $(this).closest(TAB_PANEL);
        $(currentTabPanel).html(response.view);

        if ($(currentTabPanel).attr('id') === 'nav-general') {
            switchDeviceTablePage(1);
        } else {
            refreshDeviceTablePage();
        }
    }
}

// procedures

function refreshDeviceTablePage(){
    let currentPage = $(DEVICE_TABLE_PAGINATOR).attr('current-page');
    switchDeviceTablePage(currentPage);
}

function getModalCurrentForm(MODAL) {
    let activeTabPanel = $(MODAL).find(PANEL + '.active');
    let currentForm = $(activeTabPanel).find('form').first();
    return currentForm;
}

async function switchDeviceTablePage(page) {
    let url = $(DEVICE_TABLE_PAGINATOR).attr('path') + '?page=' + page;

    let response = await $.get(url);
    
    if (response.status === 1) {
        let deviceTablePage = response.view;
        $(DEVICE_TABLE_CONTAINER).html(deviceTablePage);
    }
}

async function validateForm(form) {
    Form.formatWithErrors(form);

    let formToValidate = $(form).clone();
    let validationUrl = $(formToValidate).attr('validation');
    $(formToValidate).attr('action', validationUrl);
    $(formToValidate).attr('method', 'get');

    let hasValidation = true;
    let response = await Form.xhrAction(formToValidate, hasValidation);

    if (response.status === 0) {
        Form.formatWithErrors(form, response.errors);
    }

    return response.status;
}

// helpers

function currentDatetimeISO() {
    let datetime = new Date();

    let year = datetime.getFullYear();
    let month = datetime.getMonth() + 1;
    let day = datetime.getDate();
    let date = [year, month, day].join('-');

    let time = datetime.toTimeString().substr(0, 8);

    let datetimeISO = date + 'T' + time;

    return datetimeISO;
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

    $(contextMenu).find('[href]').each((index, link) => {
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