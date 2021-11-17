const TABSWITCHER_LIST = '[role=tabswitcherlist]';
const TABSWITCHER_BACK = '[role=tabswitcher][direction=prev]';
const TABSWITCHER_NEXT = '[role=tabswitcher][direction=next]';

// handlers

export function tabswitcherBackClickHandler(tabswitcher) {
    let ariaControls = $(tabswitcher).attr('aria-controls');

    let prevTab = getPrevTab(ariaControls);
    new bootstrap.Tab(prevTab).show();

    let isFirstTab = $(prevTab).prev().length == 0;
    if (isFirstTab) {
        $(tabswitcher).prop('disabled', true);
    }

    let tabswitcherNext = $(tabswitcher).closest(TABSWITCHER_LIST).find(TABSWITCHER_NEXT);
    $(tabswitcherNext).prop('disabled', false);
}

export function tabswitcherNextClickHandler(tabswitcher) {
    let ariaControls = $(tabswitcher).attr('aria-controls');

    let nextTab = getNextTab(ariaControls);
    new bootstrap.Tab(nextTab).show();

    let isLastTab = $(nextTab).next().length == 0;
    if (isLastTab) {
        $(tabswitcher).prop('disabled', true);
    }

    let tabswitcherBack = $(tabswitcher).closest(TABSWITCHER_LIST).find(TABSWITCHER_BACK);
    $(tabswitcherBack).prop('disabled', false);
}

// helpers

function getActiveTab(ariaControls) {
    return $(ariaControls).children('.active').first();
}

function getNextTab(ariaControls) {
    let activeTab = getActiveTab(ariaControls);
    return $(activeTab).next();
}

export function getPrevTab(ariaControls) {
    let activeTab = getActiveTab(ariaControls);
    return $(activeTab).prev();
}