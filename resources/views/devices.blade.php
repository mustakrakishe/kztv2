@extends('layouts.app')

@section('content')
    <h1>{{ __('Devices') }}</h1>
    <h2>{{ __('Brief Information') }}</h2>

    <x-table>
        <x-devices.brief-information-table-row class="text-center font-weight-bold">
            <x-slot name="status"></x-slot>
            <x-slot name="codes">{{ __('Inv. №') }}</x-slot>
            <x-slot name="type">{{ __('Type') }}</x-slot>
            <x-slot name="model">{{ __('Model') }}</x-slot>
            <x-slot name="hardware">{{ __('Hardware') }}</x-slot>
            <x-slot name="software">{{ __('Software') }}</x-slot>
            <x-slot name="location">{{ __('Location') }}</x-slot>
            <x-slot name="comment">{{ __('Comment') }}</x-slot>
        </x-devices.brief-information-table-row>

        @foreach($devices as $device)
        <x-devices.brief-information-table-row :statusName="$device->status->name">
            <x-slot name="status">{{ $device->status_id }}</x-slot>
            <x-slot name="codes">
                {{ $device->inventory_code }}
                @isset($device->identification_code)
                ({{ $device->identification_code }})
                @endisset
            </x-slot>
            <x-slot name="type">{{ $device->type->name }}</x-slot>
            <x-slot name="model">{{ $device->model }}</x-slot>
            <x-slot name="hardware">{{ $device->last_hardware?->description }}</x-slot>
            <x-slot name="software">{{ $device->last_software?->description }}</x-slot>
            <x-slot name="location">{{ $device->last_movement->location }}</x-slot>
            <x-slot name="comment">{{ $device->comment }}</x-slot>
        </x-devices.brief-information-table-row>
        @endforeach
    </x-table>
@endsection