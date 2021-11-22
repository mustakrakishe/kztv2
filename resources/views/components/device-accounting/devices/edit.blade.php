<x-modal id="edit-modal" class="modal-lg modal-fullscreen-lg-down">

    <x-slot name="title">{{ __('dialog.edit.header', ['entity' => trans('dialog.entities.device')]) }}</x-slot>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true">{{ __('General info') }}</button>
            <button class="nav-link" id="nav-movement-tab" data-bs-toggle="tab" data-bs-target="#nav-movement" type="button" role="tab" aria-controls="nav-movement" aria-selected="false">{{ __('Location') }}</button>
            <button class="nav-link" id="nav-hardware-tab" data-bs-toggle="tab" data-bs-target="#nav-hardware" type="button" role="tab" aria-controls="nav-hardware" aria-selected="false">{{ __('Hardware') }}</button>
            <button class="nav-link" id="nav-software-tab" data-bs-toggle="tab" data-bs-target="#nav-software" type="button" role="tab" aria-controls="nav-software" aria-selected="false">{{ __('Software') }}</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent" style="height: 390px;">
        <x-tabpanel class="h-100 show active" id="nav-general" aria-labelledby="nav-general-tab">
            <x-device-accounting.devices.edit.general :device="$device" :types="$types"/>
        </x-tabpanel>
        <x-tabpanel class="h-100" id="nav-movement" aria-labelledby="nav-movement-tab">
            <x-device-accounting.devices.edit.movement :movement="$device->last_movement" :statuses="$statuses"/>
        </x-tabpanel>
        <x-tabpanel class="h-100" id="nav-hardware" aria-labelledby="nav-hardware-tab">
            <x-device-accounting.devices.edit.hardware :hardware="$device->last_hardware"/>
        </x-tabpanel>
        <x-tabpanel class="h-100" id="nav-software" aria-labelledby="nav-software-tab">
            @isset($device->last_software)
            <x-device-accounting.software.edit :software="$device->last_software" />
            @else
            <x-device-accounting.software.create :deviceId="$device->id"/>
            @endisset
        </x-tabpanel>
    </div>

</x-modal>