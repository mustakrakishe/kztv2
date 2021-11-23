<x-context-menu id="contextmenu">
    <x-context-menu.item>
        {{ __('Event') }}

        <x-slot name="submenu">
            <x-context-menu.item name="movement" href="">{{ __('Movement') }}</x-context-menu.item>
            <x-context-menu.item name="hardware">{{ __('Hardware') }}</x-context-menu.item>
            <x-context-menu.item name="software">{{ __('Software') }}</x-context-menu.item>
            <x-context-menu.item name="repair">{{ __('Repair') }}</x-context-menu.item>
        </x-slot>
    </x-context-menu.item>

    <x-context-menu.item name="move" href="{{ route('devices.movements.create', ['device' => '#']) }}">{{ __('Move') }}</x-context-menu.item>
    <x-context-menu.item name="edit" href="{{ route('device-accounts.edit', ['device_account' => '#']) }}">{{ __('actions.edit') }}</x-context-menu.item>
    <x-context-menu.item name="delete" href="{{ route('devices.destroy', ['device' => '#']) }}">{{ __('actions.delete') }}</x-context-menu.item>
</x-context-menu>