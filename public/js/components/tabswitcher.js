const TABSWITCHER_LIST = '[role=tabswitcherlist]';
const TABSWITCHER_BACK = '[role=tabswitcher][direction=prev]';
const TABSWITCHER_FINISH = '[role=tabswitcher][direction=finish]';
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

    let tabswitcherFinish = $(tabswitcher).closest(TABSWITCHER_LIST).find(TABSWITCHER_FINISH);
    $(tabswitcherFinish).prop('disabled', true);
}

export function tabswitcherNextClickHandler(tabswitcher) {
    let ariaControls = $(tabswitcher).attr('aria-controls');

    let nextTab = getNextTab(ariaControls);
    new bootstrap.Tab(nextTab).show();

    if (isLastTab(nextTab)) {
        $(tabswitcher).prop('disabled', true);

        let tabswitcherFinish = $(tabswitcher).closest(TABSWITCHER_LIST).find(TABSWITCHER_FINISH);
        $(tabswitcherFinish).prop('disabled', false);
    }

    let tabswitcherBack = $(tabswitcher).closest(TABSWITCHER_LIST).find(TABSWITCHER_BACK);
    $(tabswitcherBack).prop('disabled', false);
}

// helpers

export function getActiveTab(ariaControls) {
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

export function isLastTab(tab){
    return $(tab).next().length == 0;
}