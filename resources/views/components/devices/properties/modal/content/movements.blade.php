@props(['movements'])

<div class="d-flex mt-3">
    <x-button class="w-auto">
        <i class="fas fa-dolly me-2"></i>
        {{ _('Replace') }}
    </x-button>
</div>

<x-devices.properties.modal.content.movements.table :movements="$movements"/>