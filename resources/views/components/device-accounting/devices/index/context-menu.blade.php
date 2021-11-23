<div {{ $attributes->merge(['id' => 'contextmenu', 'class' => 'list-group rounded-0 shadow']) }}>

    <div class="btn-group dropend p-0 list-group-item" id="events-submenu">
        <a class="dropdown-toggle border-0 list-group-item list-group-item-action list-group-item-light" data-bs-toggle="dropdown" aria-expanded="false" onmouseover="new bootstrap.Dropdown(this).show()" onmouseout="new bootstrap.Dropdown(this).hide()">
            {{ __('Events') }}
        </a>

        <div class="dropdown-menu shadow">
            <div class="list-group">
                <a name="edit" href="{{ route('device-accounts.edit', ['device_account' => '#']) }}" class="list-group-item list-group-item-action list-group-item-light">{{ __('actions.edit') }}</a>
                <a name="delete" href="{{ route('devices.destroy', ['device' => '#']) }}" class="list-group-item list-group-item-action list-group-item-light">{{ __('actions.delete') }}</a>
            </div>
        </div>
    </div>


    <a name="edit" href="{{ route('device-accounts.edit', ['device_account' => '#']) }}" class="list-group-item list-group-item-action list-group-item-light">{{ __('actions.edit') }}</a>
    <a name="delete" href="{{ route('devices.destroy', ['device' => '#']) }}" class="list-group-item list-group-item-action list-group-item-light">{{ __('actions.delete') }}</a>
</div>