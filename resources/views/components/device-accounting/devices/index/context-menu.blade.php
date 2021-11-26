<x-context-menu id="device-contextmenu">
    <x-context-menu.item>
        {{ __('Special actions...') }}

        <x-slot name="submenu">
            <x-context-menu.item class="call-dialog" href="{{ route('devices.movements.create', ['device' => '#']) }}">{{ __('New movement') }}</x-context-menu.item>
            <x-context-menu.item class="call-dialog" href="{{ route('devices.hardware.create', ['device' => '#']) }}">{{ __('New hardware') }}</x-context-menu.item>
            <x-context-menu.item class="call-dialog" href="{{ route('devices.software.create', ['device' => '#']) }}">{{ __('New software') }}</x-context-menu.item>
        </x-slot>
    </x-context-menu.item>

    <x-context-menu.item class="call-dialog" href="{{ route('device-accounts.edit', ['device_account' => '#']) }}">{{ __('Edit') }}</x-context-menu.item>
    <x-context-menu.item class="call-dialog" href="{{ route('devices.delete-confirmation', ['device' => '#']) }}">{{ __('Delete') }}</x-context-menu.item>
</x-context-menu>