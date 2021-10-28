__('dialog.delete.message', $device->identification_code, [
    'type' => $device->type->name,
    'model' => $device->model,
    'inventory_code' => $device->inventory_code,
    'identification_code' => $device->identification_code,
])

<form action="{{ route('devices.destroy', ['device' => $device->id]) }}" method="post">
    @csrf
    @method('delete')
</form>