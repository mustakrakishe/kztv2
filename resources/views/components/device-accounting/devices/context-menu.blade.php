<div {{ $attributes->merge(['id' => 'contextmenu', 'class' => 'list-group shadow']) }}>
  <a href="#" class="list-group-item list-group-item-action list-group-item-light">{{ __('Movements') }}</a>
  <a href="#" class="list-group-item list-group-item-action list-group-item-light">{{ __('Hardware') }}</a>
  <a href="#" class="list-group-item list-group-item-action list-group-item-light">{{ __('Software') }}</a>
  <a href="#" class="list-group-item list-group-item-action list-group-item-light">{{ __('Repairs') }}</a>
  <a name="edit" href="{{ route('devices.edit', ['device' => '#']) }}" class="list-group-item list-group-item-action list-group-item-light">{{ __('actions.edit') }}</a>
  <a name="delete" href="{{ route('devices.destroy', ['device' => '#']) }}" class="list-group-item list-group-item-action list-group-item-light">{{ __('actions.delete') }}</a>
</div>