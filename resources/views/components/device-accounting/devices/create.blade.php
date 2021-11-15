@props(['types'])

<x-modal id="create-modal" class="modal-lg modal-fullscreen-lg-down">
    <x-slot name="title">{{ __('dialog.create.header', ['entity' => trans('dialog.entities.device')]) }}</x-slot>

    <div class="d-flex align-items-start">
        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="width: 180px;">
            <div class="nav-link text-wrap active" data-bs-target="#v-pills-general" aria-selected="true">{{ __('General info') }}</div>
            <div class="nav-link text-wrap" data-bs-target="#v-pills-movement" aria-selected="false">{{ __('Location') }}</div>
            <div class="nav-link text-wrap" data-bs-target="#v-pills-hardware" aria-selected="false">{{ __('Hardware') }}</div>
            <div class="nav-link text-wrap" data-bs-target="#v-pills-software" aria-selected="false">{{ __('Software') }}</div>
        </div>

        <div class="tab-content border-start ps-3 w-100" id="v-pills-tabContent" style="min-height: 400px;">
            <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                <x-device-accounting.devices.create.general :types="$types"/>
            </div>
            <div class="tab-pane fade" id="v-pills-movement" role="tabpanel" aria-labelledby="v-pills-location-tab">
                <x-device-accounting.devices.create.movement />
            </div>
            <div class="tab-pane fade" id="v-pills-hardware" role="tabpanel" aria-labelledby="v-pills-hardware-tab">...</div>
            <div class="tab-pane fade" id="v-pills-software" role="tabpanel" aria-labelledby="v-pills-software-tab">...</div>
        </div>
    </div>

    <div role="tabswitcherlist" class="d-flex mt-auto justify-content-end">
        <x-button role="tabswitcher" direction="prev" aria-controls="#v-pills-tab" disabled>{{ __('dialog.actions.back') }}</x-button>
        <x-button role="tabswitcher" direction="next" class="ms-2" aria-controls="#v-pills-tab">{{ __('dialog.actions.next') }}</x-button>
        <x-button class="ms-2" disabled>{{ __('dialog.actions.finish') }}</x-button>
    </div>

</x-modal>