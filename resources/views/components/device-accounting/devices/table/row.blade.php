@props(['device'])

<tr {{ $attributes->merge([
    'id' => $device->id,
    'name' => 'device'
]) }}>
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
    <td>
        {{ $device->inventory_code }}
        @isset($device->identification_code)
        ({{ $device->identification_code }})
        @endisset
    </td>
    <td>{{ $device->type->name }}</td>
    <td>{{ $device->model }}</td>
    <td>{{ $device->last_hardware?->description }}</td>
    <td>{{ $device->last_software?->description }}</td>
    <td>{{ $device->last_movement?->location }}</td>
    <td>{{ $device->comment }}</td>
</tr>