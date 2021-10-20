<tr {{ $attributes }}>
    <td title="{{ $device->status->name }}">
        @switch($device->status_id)
            @case("1")
                <!-- В эксплуатации -->
                <i class="fas fa-check"></i>
                @break

            @case("2")
                <!-- На ремноте -->
                <i class="fas fa-tools"></i>
                @break

            @case("3")
                <!-- Списан -->
                <i class="fas fa-trash-alt"></i>
                @break

            @default
                {{ $status }}
        @endswitch
    </td>
    <x-table.cell>{{ $device->inventory_code }}</x-table.cell>
    <x-table.cell>{{ $device->type->name }}</x-table.cell>
    <x-table.cell>{{ $device->model }}</x-table.cell>
    <x-table.cell>{{ $device->last_hardware?->description }}</x-table.cell>
    <x-table.cell>{{ $device->last_software?->description }}</x-table.cell>
    <x-table.cell>{{ $device->last_movement?->location }}</x-table.cell>
    <x-table.cell>{{ $device->comment }}</x-table.cell>
</tr>