<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#general" role="tab" aria-controls="general" aria-selected="true">{{ __('General') }}</button>
        <button class="nav-link disabled" data-bs-toggle="tab" data-bs-target="#movements" role="tab" aria-controls="movements" aria-selected="false" aria-disabled="true" disabled>{{ __('Movements') }}</button>
        <button class="nav-link disabled" data-bs-toggle="tab" data-bs-target="#hardware" role="tab" aria-controls="hardware" aria-selected="false" aria-disabled="true" disabled>{{ __('Hardware') }}</button>
        <button class="nav-link disabled" data-bs-toggle="tab" data-bs-target="#software" role="tab" aria-controls="software" aria-selected="false" aria-disabled="true" disabled>{{ __('Software') }}</button>
        <button class="nav-link disabled" data-bs-toggle="tab" data-bs-target="#repairs" role="tab" aria-controls="repairs" aria-selected="false" aria-disabled="true" disabled>{{ __('Repairs') }}</button>
    </div>
</nav>

<div class="tab-content">
    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
        <x-device-accounting.devices.properties.modal.content.general :device="$device" :types="$types" />
    </div>
    <div class="tab-pane fade" id="movements" role="tabpanel" aria-labelledby="movements-tab">
        <x-device-accounting.devices.properties.modal.content.movements :movements="$device->movements" />
    </div>
    <div class="tab-pane fade" id="hardware" role="tabpanel" aria-labelledby="hardware-tab">...</div>
    <div class="tab-pane fade" id="software" role="tabpanel" aria-labelledby="software-tab">...</div>
    <div class="tab-pane fade" id="repairs" role="tabpanel" aria-labelledby="repairs-tab">...</div>
</div>