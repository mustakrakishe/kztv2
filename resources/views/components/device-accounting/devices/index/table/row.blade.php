@props(['device'])

<tr {{ $attributes->merge([
    'id' => $device->id,
    'name' => 'device'
]) }}>
    <td title="{{ $device->status->name }}">
        @switch($device->status->id)

            @case(1)
                <!-- Списан -->
                <i class="fas fa-trash-alt"></i>
                @break

            @case(2)
                <!-- На хранении -->
                <i class="fas fa-box-open"></i>
                @break

            @case(3)
                <!-- В эксплуатации -->
                <i class="fas fa-check"></i>
                @break

            @case(4)
                <!-- На ТО -->
                <i class="fas fa-paint-brush"></i>
                @break

            @case(5)
                <!-- На ремонте -->
                <i class="fas fa-tools"></i>
                @break

            @case(6)
                <!-- На модернизации -->
                <i class="fas fa-angle-double-up"></i>
                @break

            @default
                @php
                    $words = explode(' ', $device->status->name);
                    $mainWord = end($words);
                    $firstChar = mb_substr($mainWord, 0, 1);

                    echo mb_strtoupper($firstChar);
                @endphp
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
    <td>{{ $device->latestHardware?->description }}</td>
    <td>{{ $device->latestSoftware?->description }}</td>
    <td>{{ $device->latestMovement?->location }}</td>
    <td>{{ $device->comment }}</td>
</tr>