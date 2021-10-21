@extends('layouts.app')

@section('scripts')
    <script defer type="module" src="{{ asset('js\views\devices.js') }}"></script>
@endsection

@section('content')
<h1>{{ __('Devices') }}</h1>
<h2>{{ __('Brief Information') }}</h2>

<form id="search-form" action="{{ route('devices.search') }}" method="get">
    <input type="hidden" id="page-input" name="page">
    <div class="input-group mb-3">
        <input type="search" id="search-input" name="keywords" class="form-control" placeholder="{{ __('Search by keywords') }}..." aria-label="search" aria-describedby="search-btn">
    </div>
</form>

<div id="device-table-container">
    <x-devices.brief-info-table :devices="$devices"/>
</div>
@endsection