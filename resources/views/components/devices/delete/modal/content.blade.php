<h5 class="card-title">
    {{ __('dialog.delete.message', ['entity' => trans('device')]) }}
</h5>

<table class="mx-auto mt-3 card-text">
    @isset($device->inventory_code)
    <tr><td class="px-2">{{ __('Inventory code') }}:</td><td>{{ $device->inventory_code }}</td></tr>
    @endisset

    @isset($device->identification_code)
    <tr><td class="text-right px-2">{{ __('Identification code') }}:</td><td>{{ $device->identification_code }}</td></tr>
    @endisset

    <tr><td class="text-right px-2">{{ __('Type') }}:</td><td>{{ $device->type->name }}</td></tr>

    @isset($device->model)
    <tr><td class="text-right px-2">{{ __('Model') }}:</td><td>{{ $device->model }}</td></tr>
    @endisset
</table>


<form action="{{ route('devices.destroy', ['device' => $device->id]) }}" method="post">
    @csrf
    @method('delete')
</form>