const BUTTON_BACK = '.previous-tab-pane';
const BUTTON_NEXT = '.next-tab-pane';

$(document).on('click', BUTTON_BACK, prevTabBtnClickHandler);
$(document).on('click', BUTTON_NEXT, nextTabBtnClickHandler);

function nextTabBtnClickHandler(){
    let ariaControls = $(this).attr('aria-controls');

    let activeTab = $(ariaControls).children('.active').first();
    let nextTab = $(activeTab).next();

    new bootstrap.Tab(nextTab).show();

    if(!$(nextTab).next().length){
        $(this).prop('disabled', true);
    }

    let prevTabButton = $(this).closest('[role=tabswitcher]').find(BUTTON_BACK);
    $(prevTabButton).prop('disabled', false);
}

function prevTabBtnClickHandler(){
    let ariaControls = $(this).attr('aria-controls');

    let activeTab = $(ariaControls).children('.active').first();
    let prevTab = $(activeTab).prev();

    new bootstrap.Tab(prevTab).show();

    if(!$(prevTab).prev().length){
        $(this).prop('disabled', true);
    }

    let nextTabButton = $(this).closest('[role=tabswitcher]').find(BUTTON_NEXT);
    $(nextTabButton).prop('disabled', false);
}