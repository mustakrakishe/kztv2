<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">{{ __('General') }}</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" data-toggle="tab" href="#movements" role="tab" aria-controls="movements">{{ __('Movements') }}</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" data-toggle="tab" href="#hardware" role="tab" aria-controls="hardware">{{ __('Hardware') }}</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" data-toggle="tab" href="#software" role="tab" aria-controls="software">{{ __('Software') }}</a>
  </li>
</ul>

<div class="tab-content">
  <div class="tab-pane fade show active" id="general" role="tabpanel">
      <x-devices.properties.modal.content.general :device="$device" :types="$types"/>
  </div>
  <div class="tab-pane fade" id="movements" role="tabpanel">...</div>
  <div class="tab-pane fade" id="hardware" role="tabpanel">...</div>
</div>