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
    <div class="tab-content" id="nav-tabContent">
        <x-device-accounting.devices.edit.general class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab"/>
        <x-device-accounting.devices.edit.movement class="tab-pane fade" id="nav-movement" role="tabpanel" aria-labelledby="nav-movement-tab"/>
        <x-device-accounting.devices.edit.hardware class="tab-pane fade" id="nav-hardware" role="tabpanel" aria-labelledby="nav-hardware-tab"/>
        <x-device-accounting.devices.edit.software class="tab-pane fade" id="nav-software" role="tabpanel" aria-labelledby="nav-software-tab"/>
    </div>

</x-modal>