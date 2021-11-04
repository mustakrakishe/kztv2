@props(['movement'])

<tr {{ $attributes->merge(['name' => 'movement', 'style' => 'cursor: pointer;']) }}>
    <td>
        <div>{{ substr($movement->date, 0, 10) }}</div>
        <div>{{ substr($movement->date, 11) }}</div>
    </td>

    <td>
        <div>{{ $movement->device->inventory_code }}</div>
        @isset($movement->device->identification_code)
        <div>({{ $movement->device->identification_code }})</div>
        @endisset
    </td>

    <td>
        {{ $movement->device->type->name }} {{ $movement->device->model }}
    </td>

    <td>
        {{ $movement->location }}
    </td>

    <td>
        {{ $movement->comment }}
    </td>
</tr>