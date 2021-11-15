import Form from "../../../components/form.js";
import * as Tabswitcher from "../../../components/tabswitcher.js";

const MODAL = '#create-modal';
const TABSWITCHER_BACK = '[role=tabswitcher][direction=prev]';
const TABSWITCHER_NEXT = '[role=tabswitcher][direction=next]';

$(document).on('show.bs.modal', MODAL, createModalShowHandler);
$(document).on('click', TABSWITCHER_BACK, tabswitcherBackClickHandler);
$(document).on('click', TABSWITCHER_NEXT, tabswitcherNextClickHandler);

// handlers

function createModalShowHandler()
{
    initDatetimeInputs();
}

async function tabswitcherBackClickHandler()
{
    Tabswitcher.tabswitcherBackClickHandler(this);
}

async function tabswitcherNextClickHandler()
{
    let form = getCurrentForm();
    let isValid = await validateForm(form);

    if (isValid) {
        Tabswitcher.tabswitcherNextClickHandler(this);
    }
}

// procedures

function getCurrentForm()
{
    let activeTabPanel = $(MODAL).find('[role=tabpanel].active');
    let currentForm = $(activeTabPanel).find('form').first();
    return currentForm;
}

function initDatetimeInputs()
{
    let currentDatetimeJson = new Date().toJSON().slice(0,19);
    $('input[type=datetime-local]').val(currentDatetimeJson);
}

async function validateForm(form)
{
    let hasValidation = true;
    let response = await Form.xhrAction(form, hasValidation);

    return response.status;
}