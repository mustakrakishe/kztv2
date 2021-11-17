import Form from "../../../components/form.js";
import * as Tabswitcher from "../../../components/tabswitcher.js";

const MODAL = '#create-modal';
const MOVEMENT_PANEL = '#v-pills-movement';
const PANEL = '[role=tabpanel]';
const TABSWITCHER_BACK = '[role=tabswitcher][direction=prev]';
const TABSWITCHER_NEXT = '[role=tabswitcher][direction=next]';

$(document).on('show.bs.modal', MODAL, createModalShowHandler);
$(document).on('click', TABSWITCHER_BACK, tabswitcherBackClickHandler);
$(document).on('click', TABSWITCHER_NEXT, tabswitcherNextClickHandler);

// handlers

function createModalShowHandler()
{
    $(MODAL).find('input[name=date]').val(currentDatetimeISO());
    initMovementPanel();
}

async function tabswitcherBackClickHandler()
{
    Tabswitcher.tabswitcherBackClickHandler(this);
}

async function tabswitcherNextClickHandler()
{
    let form = getCurrentForm();
    console.log(form.length);
    if (form.length) {
        let isValid = await validateForm(form);
    
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

function initMovementPanel() {
    // init date
    

    // init status
    const IN_STORAGE_STATUS_ID = 2;
    $(MOVEMENT_PANEL).find('select[name=status_id]').val(IN_STORAGE_STATUS_ID);

    // init location
    $(MOVEMENT_PANEL).find('textarea[name=location]').val('ЗУ. АСУ. 210');

    // init comment
    $(MOVEMENT_PANEL).find('textarea[name=comment]').val('Новий');
}

async function validateForm(form)
{
    let hasValidation = true;
    let response = await Form.xhrAction(form, hasValidation);

    return response.status;
}

// helpers

function currentDatetimeISO(){
    let datetime = new Date();

    let year = datetime.getFullYear();
    let month = datetime.getMonth() + 1;
    let day = datetime.getDate();
    let date = [year, month, day].join('-');

    let time = datetime.toTimeString().substr(0, 8);

    let datetimeISO = date + 'T' + time;

    return datetimeISO;
}