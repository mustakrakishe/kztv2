<div {{ $attributes->merge(['id' => 'contextmenu', 'class' => 'list-group shadow']) }}>
  <a href="#" class="list-group-item list-group-item-action list-group-item-light">{{ __('Move') }}</a>
  <a href="#" class="list-group-item list-group-item-action list-group-item-light">{{ __('Change hardware') }}</a>
  <a href="#" class="list-group-item list-group-item-action list-group-item-light">{{ __('Change software') }}</a>
  <a href="#" class="list-group-item list-group-item-action list-group-item-light">{{ __('Send for repair') }}</a>
  <a href="#" class="list-group-item list-group-item-action list-group-item-light">{{ __('actions.delete') }}</a>
  <a name="properties" type="button" class="properies list-group-item list-group-item-action list-group-item-light">{{ __('Properties') }}</a>
</div>