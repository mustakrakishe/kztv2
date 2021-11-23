@isset($submenu)
<li>
    <div {{ $attributes->merge([
        'class' => 'btn-group dropend p-0 dropdown-item list-group-item-light list-group-item-action',
        'onmouseover' => 'new bootstrap.Dropdown($(this).children("button")).show()',
        'onmouseout' => 'new bootstrap.Dropdown($(this).children("button")).hide()',
    ]) }}>
        <button
            type="button"
            class="dropdown-toggle dropdown-item list-group-item-light list-group-item-action bg-transparent"
            data-bs-toggle="dropdown"
            aria-expanded="false"
        >
            {{ $slot ?? $title }}
        </button>

        <ul class="dropdown-menu shadow">    
            {{ $submenu }}
        </ul>
    </div>
</li>
@else
<li>
    <a {{ $attributes->merge(['class' => 'dropdown-item list-group-item-light list-group-item-action']) }}>{{ $slot ?? $title }}</a>
</li>
@endif

