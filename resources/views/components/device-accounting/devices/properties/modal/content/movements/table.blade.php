<table id="device-movements-table" class="table table-striped">

    <thead class="text-center">
        <tr>
            <th>{{ __('Date') }}</th>
            <th>{{ __('Location') }}</th>
            <th>{{ __('Comment') }}</th>
        </tr>
    </thead>

    <tbody>
        @foreach($movements as $movement)
        <x-device-accounting.devices.properties.modal.content.movements.table.row name="movement" :movement="$movement" />
        @endforeach
    </tbody>

</table>

{{--
<x-paginator id="device-movements-table-paginator" :paginator="$movements"/>
--}}