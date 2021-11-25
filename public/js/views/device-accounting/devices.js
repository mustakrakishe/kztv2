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
const PAGINATION_LINK = 'a.page-link';
const PANEL = '[role=tabpanel]';
const SEARCH_FORM = 'form#search-form';
const SEARCH_INPUT = 'input#search-input';
const STORE_DEVICE_ACCOUNT_BUTTON = '#store-device-account-button';
const STORE_DEVICE_ACCOUNT_FORM = 'form#store-device-account-form';
const STORE_MOVEMENT_FORM = '#create-movement-form';
const TAB_CONTENT = '#v-pills-tabContent';
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
$(document).on('submit', STORE_DEVICE_ACCOUNT_FORM, storeDeviceAccountFormSubmitHandler);
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

async function storeDeviceAccountFormSubmitHandler(event) {
    event.preventDefault();

    Form.showProgresInSubmitter($(STORE_DEVICE_ACCOUNT_BUTTON));
    
    let modalLastForm = getModalCurrentForm(CREATE_DEVICE_ACCOUNT_MODAL);

    const HAS_VALIDATION = true;
    let response = await Form.xhrAction(modalLastForm, HAS_VALIDATION);

    if (response.status === 1) {
        let storeDeviceAccountForm = event.target;

        let data = $(storeDeviceAccountForm).serializeArray();

        $(TAB_CONTENT).find('form').each((index, form) => {
            let formName = $(form).attr('name');
            data.push({
                name: formName,
                value: $(form).serialize(),
            });
        });

        let response = await $.post({
            url: $(storeDeviceAccountForm).attr('action'),
            data: data,
        });

        if (response.status === 1) {
            await switchDeviceTablePage(1);
            $(CREATE_DEVICE_ACCOUNT_MODAL).modal('hide');
        }
    }
    
    let isResultSuccessfull = response.status;
    Form.playResultInSubmitter($(STORE_DEVICE_ACCOUNT_BUTTON), isResultSuccessfull);
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
    let tabswitcherNext = this;
    let form = getModalCurrentForm(CREATE_DEVICE_ACCOUNT_MODAL);
    
    Form.showProgresInSubmitter(tabswitcherNext);

    const HAS_VALIDATION = true;
    let response = await Form.xhrAction(form, HAS_VALIDATION);
    
    let isResulSuccessfull = response.status;
    let duration = 0;
    Form.playResultInSubmitter(tabswitcherNext, isResulSuccessfull, duration);

    if (response.status === 1) {
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