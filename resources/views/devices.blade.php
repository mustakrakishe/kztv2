@extends('layouts.app')

@section('scripts')
    <script defer type="module" src="{{ asset('js\views\devices.js') }}"></script>
@endsection

@section('content')
<h1>{{ __('Devices') }}</h1>
<h2>{{ __('Brief Information') }}</h2>

<form id="search-form" action="{{ route('devices.fetch_data') }}" method="get">
    <input type="hidden" id="page-input" name="page">
    <div class="input-group mb-3">
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