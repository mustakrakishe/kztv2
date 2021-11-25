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
                    <form name="device" class="mt-3" action="{{ route('devices.validate') }}"  method="get">
                        <x-device-accounting.devices.create.form.fields :device="$default->device" :types="$types" />
                    </form>
                </x-tabpanel>

                <x-tabpanel id="v-pills-movement" aria-labelledby="v-pills-movement-tab">
                    <form name="movement" class="mt-3" action="{{ route('devices.movements.validate') }}"  method="get">
                        <x-device-accounting.movements.create.form.fields :movement="$default->movement" :statuses="$statuses" />
                    </form>
                </x-tabpanel>

                <x-tabpanel id="v-pills-hardware" aria-labelledby="v-pills-hardware-tab">
                    <form name="hardware" class="mt-3" action="{{ route('devices.hardware.validate') }}"  method="get">
                        <x-device-accounting.hardware.create.form.fields :hardware="$default->hardware"/>
                    </form>
                </x-tabpanel>

                <x-tabpanel id="v-pills-software" aria-labelledby="v-pills-software-tab">
                    <form name="software" class="mt-3" action="{{ route('devices.software.validate') }}"  method="get">
                        <x-device-accounting.software.create.form.fields :software="$default->software"/>
                    </form>
                </x-tabpanel>
            </div>
        </div>

        <div role="tabswitcherlist" class="d-flex mt-auto justify-content-end">
            <x-button type="button" role="tabswitcher" direction="prev" id="tabswitcher-prev" aria-controls="#v-pills-tab" disabled>{{ __('dialog.actions.back') }}</x-button>
            <x-button type="button" role="tabswitcher" direction="next" id="tabswitcher-next" class="ms-2" aria-controls="#v-pills-tab">{{ __('dialog.actions.next') }}</x-button>
            <form id="store-device-account-form" action="{{ route('device-accounts.store') }}" method="post">
                @csrf
                <x-button role="tabswitcher" direction="finish" id="store-device-account-button" class="ms-2" disabled>{{ __('dialog.actions.finish') }}</x-button>
            </form>
        </div>

</x-modal>