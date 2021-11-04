<table id="movements-table" class="table table-striped table-hover">

    <thead class="table-dark text-center">
        <tr>
            <th scope="col">{{ __('Date') }}</th>
            <th scope="col">{{ __('Inv. №') }}</th>
            <th scope="col">{{ __('Device') }}</th>
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