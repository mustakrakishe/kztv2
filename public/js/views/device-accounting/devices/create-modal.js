import Form from "../../../components/form.js";

const MODAL = '#create-modal';
const PANEL = '[role=tabpanel]'
const TAB = '[role=tab]'
const TABSWITCHER_LIST = '[role=tabswitcherlist]';
const TABSWITCHER_NEXT = '[role=tabswitcher].next';

$(document).on('click', TABSWITCHER_NEXT, tabswitcherNextClickHandler);

// $(document).on('click', TAB, tabClickHandler);

// handlers

async function tabswitcherNextClickHandler()
{
    let form = getCurrentForm();
    let isValid = await validateForm(form);

    // if (isValid) {
    //     let ariaControls = $(this).attr('aria-controls');
    
    //     let nextTab = getNextTab(ariaControls);
    //     new bootstrap.Tab(nextTab).show();
    
    //     let isLastTab = $(nextTab).next().length == 0;
    //     if(isLastTab){
    //         $(this).prop('disabled', true);
    //     }
    
    //     let tabswitcherBack = $(this).closest(TABSWITCHER_LIST).find(TABSWITCHER_BACK);
    //     $(tabswitcherBack).prop('disabled', false);
    // }
}

// procedures

function getCurrentForm()
{
    let activeTabPanel = $(MODAL).find('[role=tabpanel]');
    let currentForm = $(activeTabPanel).find('form').first();
    return currentForm;
}

async function validateForm(form)
{
    let hasValidation = true;
    let response = await Form.xhrAction(form, hasValidation);

    return response.status;
}