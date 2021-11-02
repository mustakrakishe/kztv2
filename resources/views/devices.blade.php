@extends('layouts.app')

@section('scripts')
    <script defer type="module" src="{{ asset('js\views\devices.js') }}"></script>
    <script defer type="module" src="{{ asset('js\views\devices\properties\movements.js') }}"></script>
@endsection

@section('content')
<h1 class="text-center">{{ __('Devices') }}</h1>
<h2 class="text-center mb-4">{{ __('Brief Information') }}</h2>

<form id="search-form" action="{{ route('devices.fetch_data') }}" method="get">
    <input type="hidden" id="page-input" name="page">
    <div class="input-group my-3">
        <input type="search" id="search-input" name="search_string" class="form-control" placeholder="{{ __('Search by keywords') }}..." title="{{ __('Enter for search. Esc for reset.') }}">
    </div>
</form>

<div id="device-table-container">
    <x-devices.brief-info-table :devices="$devices"/>
</div>

@auth
<x-devices.properties.modal />
<x-devices.delete.modal />
@endauth
@endsection