@extends('layouts.app')

@section('scripts')
    <script defer type="module" src="{{ asset('js\views\device-accounting\movements.js') }}"></script>
@endsection

@section('content')
<h1 class="text-center">{{ __('Devices') }}</h1>
<h2 class="text-center mb-4">{{ __('Movements') }}</h2>


<div class="row my-3">
    <div class="col">
        <form id="search-form" action="{{ route('movements.fetch_data') }}" method="get">
            <input type="hidden" id="page-input" name="page">
            <input type="search" id="search-input" name="search_string" class="form-control" placeholder="{{ __('Search by keywords') }}..." title="{{ __('Enter for search. Esc for reset.') }}">
        </form>
    </div>

    <div class="col-auto text-right">
        <a id="create" class="btn btn-primary" href="{{ route('movements.create') }}">
            <i class="fas fa-plus me-1"></i>
            {{ __('New movement') }}
        </a>
    </div>
</div>

<x-devices.movements.table :movements="$movements"/>

@endsection