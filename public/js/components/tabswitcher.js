const TAB = '[role=tab].has-tab-switcher'
const TABSWITCHER_LIST = '[role=tabswitcherlist]';
const TABSWITCHER_BACK = '[role=tabswitcher].back';
const TABSWITCHER_NEXT = '[role=tabswitcher].next';

$(document).on('shown', TAB, switchTabHandler);
$(document).on('click', TABSWITCHER_BACK, tabswitcherBackClickHandler);
$(document).on('click', TABSWITCHER_NEXT, tabswitcherNextClickHandler);

// handlers

function switchTabHandler(event){
    
}

function tabswitcherBackClickHandler(){
    let ariaControls = $(this).attr('aria-controls');

    let prevTab = getPrevTab(ariaControls);
    new bootstrap.Tab(prevTab).show();

    let isFirstTab = $(prevTab).prev().length == 0;
    if(isFirstTab){
        $(this).prop('disabled', true);
    }

    let tabswitcherNext = $(this).closest(TABSWITCHER_LIST).find(TABSWITCHER_NEXT);
    $(tabswitcherNext).prop('disabled', false);
}

function tabswitcherNextClickHandler(){
    let ariaControls = $(this).attr('aria-controls');

    let nextTab = getNextTab(ariaControls);
    new bootstrap.Tab(nextTab).show();

    let isLastTab = $(nextTab).next().length == 0;
    if(isLastTab){
        $(this).prop('disabled', true);
    }

    let tabswitcherBack = $(this).closest(TABSWITCHER_LIST).find(TABSWITCHER_BACK);
    $(tabswitcherBack).prop('disabled', false);
}

// helpers

export function getActiveTab(ariaControls){
    return $(ariaControls).children('.active').first();
}

export function getNextTab(ariaControls){
    let activeTab = getActiveTab(ariaControls);
    return $(activeTab).next();
}

export function getPrevTab(ariaControls){
    let activeTab = getActiveTab(ariaControls);
    return $(activeTab).prev();
}