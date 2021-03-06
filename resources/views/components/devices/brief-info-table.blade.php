<table id="device-brief-info-table" class="table table-striped table-hover">

    <thead class="thead-dark text-center">
        <tr>
            <th scope="col"></th>
            <th scope="col">{{ __('Inv. №') }}</th>
            <th scope="col">{{ __('Type') }}</th>
            <th scope="col">{{ __('Model') }}</th>
            <th scope="col">{{ __('Hardware') }}</th>
            <th scope="col">{{ __('Software') }}</th>
            <th scope="col">{{ __('Location') }}</th>
            <th scope="col">{{ __('Comment') }}</th>
        </tr>
    </thead>

    <tbody>
        @foreach($devices as $device)
        <x-devices.brief-info-table.row name="device" href="{{ route('devices.edit', ['device' => $device->id]) }}" :device="$device" />
        @endforeach
    </tbody>

</table>

<x-paginator id="device-table-paginator" :paginator="$devices"/>