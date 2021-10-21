@extends('layouts.app')

@section('scripts')
    <script defer type="module" src="{{ asset('js\views\devices.js') }}"></script>
@endsection

@section('content')
<h1>{{ __('Devices') }}</h1>
<h2>{{ __('Brief Information') }}</h2>

<form id="search-form" action="{{ route('devices.search') }}" method="get">
    @csrf
    <div class="input-group mb-3">
        <input name="keywords" type="text" class="form-control" placeholder="{{ __('Search by keywords') }}..." aria-label="search" aria-describedby="search-btn">
        <div class="input-group-append">
            <button type="submit" id="search-btn" class="btn btn-outline-secondary" ><i class="fas fa-search"></i></button>
        </div>
    </div>
</form>

<x-devices.brief-info-table :devices="$devices"/>
@endsection