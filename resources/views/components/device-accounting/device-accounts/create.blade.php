<x-modal id="create-device-account-modal" class="modal-lg modal-fullscreen-lg-down">

    <x-slot name="title">{{ __('dialog.create.header', ['entity' => trans('dialog.entities.device')]) }}</x-slot>

    <div class="d-flex align-items-start">
        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="width: 180px;">
            <div class="nav-link text-wrap active" data-bs-target="#v-pills-general" aria-selected="true">{{ __('General info') }}</div>
            <div class="nav-link text-wrap" data-bs-target="#v-pills-movement" aria-selected="false">{{ __('Location') }}</div>
            <div class="nav-link text-wrap" data-bs-target="#v-pills-hardware" aria-selected="false">{{ __('Hardware') }}</div>
            <div class="nav-link text-wrap" data-bs-target="#v-pills-software" aria-selected="false">{{ __('Software') }}</div>
        </div>

        <div class="tab-content border-start ps-3 w-100" id="v-pills-tabContent" style="min-height: 400px;">
            <x-tabpanel class="show active" id="v-pills-general" aria-labelledby="v-pills-general-tab">
                <x-device-accounting.devices.create :types="$types"/>
            </x-tabpanel>

            <x-tabpanel id="v-pills-movement" aria-labelledby="v-pills-movement-tab">
                <x-device-accounting.movements.create.form :statuses="$statuses" :movement="$device->last_movement"/>
            </x-tabpanel>

            <x-tabpanel id="v-pills-hardware" aria-labelledby="v-pills-hardware-tab">
                <x-device-accounting.hardware.create/>
            </x-tabpanel>

            <x-tabpanel id="v-pills-software" aria-labelledby="v-pills-software-tab">
                <x-device-accounting.software.create/>
            </x-tabpanel>
        </div>
    </div>

    <div role="tabswitcherlist" class="d-flex mt-auto justify-content-end">
        <x-button role="tabswitcher" direction="prev" id="tabswitcher-prev" aria-controls="#v-pills-tab" disabled>{{ __('dialog.actions.back') }}</x-button>
        <x-button role="tabswitcher" direction="next" id="tabswitcher-next" class="ms-2" aria-controls="#v-pills-tab">{{ __('dialog.actions.next') }}</x-button>
        <x-button role="tabswitcher" direction="finish" id="store-device-btn" class="ms-2" disabled>{{ __('dialog.actions.finish') }}</x-button>
    </div>

</x-modal>