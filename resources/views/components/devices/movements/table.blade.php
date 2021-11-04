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
        @foreach($movements as $movement)
        <x-devices.movements.table.row :movement="$movement" />
        @endforeach
    </tbody>

</table>

<x-paginator id="movements-table-paginator" :paginator="$movements"/>