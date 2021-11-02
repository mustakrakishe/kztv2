<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#general" role="tab" aria-controls="general" aria-selected="true">{{ __('General') }}</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#movements" role="tab" aria-controls="movements" aria-selected="false">{{ __('Movements') }}</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#hardware" role="tab" aria-controls="hardware" aria-selected="false">{{ __('Hardware') }}</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#software" role="tab" aria-controls="software" aria-selected="false">{{ __('Software') }}</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#repairs" role="tab" aria-controls="repairs" aria-selected="false">{{ __('Repairs') }}</button>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
        <x-devices.properties.modal.content.general :device="$device" :types="$types" />
    </div>
    <div class="tab-pane fade" id="movements" role="tabpanel" aria-labelledby="movements-tab">
        <x-devices.properties.modal.content.movements :movements="$device->movements" />
    </div>
    <div class="tab-pane fade" id="hardware" role="tabpanel" aria-labelledby="hardware-tab">...</div>
    <div class="tab-pane fade" id="software" role="tabpanel" aria-labelledby="software-tab">...</div>
    <div class="tab-pane fade" id="repairs" role="tabpanel" aria-labelledby="repairs-tab">...</div>
</div>