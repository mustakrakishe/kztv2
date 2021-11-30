@props(['movement'])

<tr {{ $attributes->merge(['name' => 'movement']) }}>
    
<td width="3%" title="{{ $movement->status->name }}">
        @switch($movement->status->id)

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
                    $words = explode(' ', $movement->status->name);
                    $mainWord = end($words);
                    $firstChar = mb_substr($mainWord, 0, 1);

                    echo mb_strtoupper($firstChar);
                @endphp
        @endswitch
    </td>
    <td width="10%">
        <div>{{ substr($movement->date, 0, 10) }}</div>
        <div>{{ substr($movement->date, 11) }}</div>
    </td>

    <td width="10%">
        <div>{{ $movement->device->inventory_code }}</div>
        @isset($movement->device->identification_code)
        <div>({{ $movement->device->identification_code }})</div>
        @endisset
    </td>

    <td width="20%">
        {{ $movement->device->type->name }} {{ $movement->device->model }}
    </td>

    <td width="30%">
        {{ $movement->location }}
    </td>

    <td>
        {{ $movement->comment }}
    </td>
</tr>