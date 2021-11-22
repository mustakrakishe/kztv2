import Form from "../../../components/form.js";
import * as Tabswitcher from "../../../components/tabswitcher.js";

const DEVICE_TABLE_CONTAINER = '#device-table-container';
const DEVICE_TABLE_PAGINATOR = '#device-table-paginator';
const MODAL = '#create-modal';
const PANEL = '[role=tabpanel]';
const STORE_BTN = '#store-device-btn';
const STORE_DEVICE_FORM = '#create-device-form';
const STORE_HARDWARE_FORM = '#create-hardware-form';
const STORE_MOVEMENT_FORM = '#create-movement-form';
const STORE_SOFTWARE_FORM = '#create-software-form';
const TABSWITCHER_BACK = '[role=tabswitcher][direction=prev]';
const TABSWITCHER_NEXT = '[role=tabswitcher][direction=next]';

$(document).on('show.bs.modal', MODAL, createModalShowHandler);
$(document).on('click', STORE_BTN, storeBtnClickHandler);
$(document).on('click', TABSWITCHER_BACK, tabswitcherBackClickHandler);
$(document).on('click', TABSWITCHER_NEXT, tabswitcherNextClickHandler);

// handlers

function createModalShowHandler() {
    $(MODAL).find('input[name=date]').val(currentDatetimeISO());
}

async function storeBtnClickHandler() {
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

    $(MODAL).modal('hide');
}

async function tabswitcherBackClickHandler() {
    $(STORE_BTN).attr('disabled', true);
    Tabswitcher.tabswitcherBackClickHandler(this);
}

async function tabswitcherNextClickHandler() {
    let form = getCurrentForm();
    
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

// procedures

function getCurrentForm() {
    let activeTabPanel = $(MODAL).find(PANEL + '.active');
    let currentForm = $(activeTabPanel).find('form').first();
    return currentForm;
}

async function switchDeviceTablePage(page) {
    let url = $(DEVICE_TABLE_PAGINATOR).attr('path');

    let response = await $.get(url, { page });

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