@if($attributes->has('submenu'))
<li>
    <div {{ $attributes->merge(['class' => 'btn-group dropend p-0 dropdown-item']) }}>
        <button type="button" class="dropdown-toggle dropdown-item list-group-item-light list-group-item-action" data-bs-toggle="dropdown" aria-expanded="false">
            {{ $title }}
        </button>

        <ul class="dropdown-menu">    
            {{ $submenu }}
        </ul>
    </div>
</li>
@else
<li>
    <a {{ $attributes->merge(['class' => 'dropdown-item list-group-item-light list-group-item-action']) }}>{{ $slot ?? $title }}</a>
</li>
@endif

