<div {{ $attributes->merge(['id' => 'contextmenu', 'class' => 'list-group shadow']) }}>
  <a name="edit" href="{{ route('device-accounts.edit', ['device_account' => '#']) }}" class="list-group-item list-group-item-action list-group-item-light">{{ __('actions.edit') }}</a>
  <a name="delete" href="{{ route('devices.destroy', ['device' => '#']) }}" class="list-group-item list-group-item-action list-group-item-light">{{ __('actions.delete') }}</a>
</div>