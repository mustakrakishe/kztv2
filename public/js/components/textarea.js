$(document).on('input', 'textarea.autoresizable', function () {
    resize(this);
});

export function resize(textarea) {
    $(textarea).css('height', 'auto');
    $(textarea).css('height', $(textarea).prop('scrollHeight') + 'px');
}

export function initSize(textarea) {
    $(textarea).css('height', $(textarea).css('min-height'));
}