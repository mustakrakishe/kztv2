@extends('layouts.app')

@section('scripts')
    <script defer type="module" src="{{ asset('js\views\device-accounting\devices.js') }}"></script>
@endsection

@section('content')
<h1 class="text-center">{{ __('Devices') }}</h1>
<h2 class="text-center mb-4">{{ __('Brief info') }}</h2>

<div class="row my-3">
    <div class="col">
        <form id="search-form" action="{{ route('devices.fetch_data') }}" method="get">
            <input type="hidden" id="page-input" name="page">
            <input type="search" id="search-input" name="search_string" class="form-control" placeholder="{{ __('Search by keywords') }}..." title="{{ __('Enter for search. Esc for reset.') }}">
        </form>
    </div>

    <div class="col-auto text-right">
        <a id="create" class="btn btn-primary" href="{{ route('device-accounts.create') }}">
            <i class="fas fa-plus me-1"></i>
            {{ __('New device') }}
        </a>
    </div>
</div>

<div id="device-table-container">
    <x-device-accounting.devices.table :devices="$devices"/>
</div>

<script>
    let contextMenuHtml = `<x-device-accounting.devices.context-menu/>`;
    let deleteConfirmationModalHtml = `<x-device-accounting.devices.delete.confirm/>`;
    let createModalHtml = `<x-device-accounting.device-accounts.create :types="$types" :statuses="$statuses"/>`;
</script>

@endsection