@props(['statusName' => ''])

<x-table.row {{ $attributes->merge(['style' => 'min-width: 690px;']) }}>
    <x-table.cell title="{{$statusName}}" style="width: 5%;">
        @switch($status)
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
    </x-table.cell>
    <x-table.cell style="width: 10%;">{{ $codes }}</x-table.cell>
    <x-table.cell style="width: 15%;">{{ $type }}</x-table.cell>
    <x-table.cell style="width: 15%;">{{ $model }}</x-table.cell>
    <x-table.cell style="width: 25%;">{{ $hardware }}</x-table.cell>
    <x-table.cell style="width: 25%;">{{ $software }}</x-table.cell>
    <x-table.cell style="width: 25%;">{{ $location }}</x-table.cell>
    <x-table.cell style="width: 10%;">{{ $comment }}</x-table.cell>
</x-table.row>