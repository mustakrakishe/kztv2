import Form from "../../../components/form.js";
import * as Tabswitcher from "../../../components/tabswitcher.js";

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
    let deviceStoreResponse = await Form.xhrAction(STORE_DEVICE_FORM);
    
    if (deviceStoreResponse.status === 0) {
        return;
    }

    let deviceIdInput = `<input type="numeric" name="device_id" value="${deviceStoreResponse.device.id}" hidden>`;
    $(STORE_MOVEMENT_FORM).append(deviceIdInput);

    let movementStoreResponse = await Form.xhrAction(STORE_MOVEMENT_FORM);
    
    if (movementStoreResponse.status === 0) {
        return;
    }

    // let hardwareStoreResponse = await Form.xhrAction(STORE_HARDWARE_FORM);
    
    // if (hardwareStoreResponse.status === 0) {
    //     return;
    // }

    // let software = {
    //     description: $(STORE_SOFTWARE_FORM).find('[name=description]').val(),
    //     comment: $(STORE_SOFTWARE_FORM).find('[name=comment]').val(),
    // }

    // if(software.description || software.comment){
    //     let softwareStoreResponse = await Form.xhrAction(STORE_SOFTWARE_FORM);
    
    //     if (softwareStoreResponse.status === 0) {
    //         return;
    //     }
    // }

    $(MODAL).hide();
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