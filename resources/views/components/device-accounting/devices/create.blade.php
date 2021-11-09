<x-modal id="create-modal" class="modal-lg modal-fullscreen-lg-down">
    <x-slot name="title">{{ __('dialog.create.header', ['entity' => trans('dialog.entites.device')]) }}</x-slot>

    <div class="d-flex align-items-start">
        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="width: 180px;">
            <button class="nav-link text-wrap active" id="v-pills-general-tab" data-bs-toggle="pill" data-bs-target="#v-pills-general" type="button" role="tab" aria-controls="v-pills-general" aria-selected="true">{{ __('General info') }}</button>
            <button class="nav-link text-wrap" id="v-pills-location-tab" data-bs-toggle="pill" data-bs-target="#v-pills-location" type="button" role="tab" aria-controls="v-pills-location" aria-selected="false">{{ __('Location') }}</button>
            <button class="nav-link text-wrap" id="v-pills-hardware-tab" data-bs-toggle="pill" data-bs-target="#v-pills-hardware" type="button" role="tab" aria-controls="v-pills-hardware" aria-selected="false">{{ __('Hardware') }}</button>
            <button class="nav-link text-wrap" id="v-pills-software-tab" data-bs-toggle="pill" data-bs-target="#v-pills-software" type="button" role="tab" aria-controls="v-pills-software" aria-selected="false">{{ __('Software') }}</button>
        </div>

        <div class="tab-content border-start px-3" id="v-pills-tabContent" style="height: 400px;">
            <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                <x-device-accounting.devices.create.general />
            </div>
            <div class="tab-pane fade" id="v-pills-location" role="tabpanel" aria-labelledby="v-pills-location-tab">...</div>
            <div class="tab-pane fade" id="v-pills-hardware" role="tabpanel" aria-labelledby="v-pills-hardware-tab">...</div>
            <div class="tab-pane fade" id="v-pills-software" role="tabpanel" aria-labelledby="v-pills-software-tab">...</div>
        </div>
    </div>

    <div role="tabswitcher" class="d-flex mt-auto justify-content-end">
        <x-button class="previous-tab-pane" aria-controls="#v-pills-tab" disabled>{{ __('dialog.actions.back') }}</x-button>
        <x-button class="next-tab-pane ms-2" aria-controls="#v-pills-tab">{{ __('dialog.actions.next') }}</x-button>
        <x-button class="ms-2">{{ __('dialog.actions.finish') }}</x-button>
    </div>

</x-modal>