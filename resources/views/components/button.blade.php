@php
    if($attributes->has('class')){
        $classString = $attributes->get('class');
        $issetBtnStyle = !preg_match('/btn-[a-z]+/', $classString);
    }
@endphp

<button {{ $attributes->class([
    'btn-primary' => !preg_match('/btn-[a-z]+/', $attributes->get('class')),
])->merge(['type' => 'submit', 'class' => 'btn shadow-none']) }}>
    {{ $slot }}
</button>
