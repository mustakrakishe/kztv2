@props(['movements'])

<div class="d-flex flex-row-reverse mt-3">
    <x-button class="w-auto">
        <i class="fas fa-plus me-2"></i>
        {{ __('New record') }}
    </x-button>
</div>

<x-device-accounting.devices.properties.modal.content.movements.table :movements="$movements"/>