<x-context-menu id="contextmenu">
    <x-context-menu.item>
        {{ __('Special actions...') }}

        <x-slot name="submenu">
            <x-context-menu.item name="movement" href="{{ route('devices.movements.create', ['device' => '#']) }}">{{ __('New movement') }}</x-context-menu.item>
            <x-context-menu.item name="hardware" href="{{ route('devices.hardware.create', ['device' => '#']) }}">{{ __('New hardware') }}</x-context-menu.item>
        </x-slot>
    </x-context-menu.item>

    <x-context-menu.item name="edit" href="{{ route('device-accounts.edit', ['device_account' => '#']) }}">{{ __('Edit') }}</x-context-menu.item>
    <x-context-menu.item name="delete" href="{{ route('devices.destroy', ['device' => '#']) }}">{{ __('Delete') }}</x-context-menu.item>
</x-context-menu>