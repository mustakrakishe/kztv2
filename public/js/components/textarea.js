$(document).on('input', 'textarea.autoresizable', function(){
    resize(this);
})

export function resize(textareas){
    $(textareas).each(function(){
        $(this).css({
            'height': $(this).prop('scrollHeight'),
        });
    })
}

export function initSize(textareas){
    $(textareas).each(function(){
        $(this).css({
            'height': $(this).css('min-height'),
        });
    })
}