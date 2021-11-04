@extends('layouts.app')

@section('scripts')
@endsection

@section('content')
<h1 class="text-center">{{ __('Devices') }}</h1>
<h2 class="text-center mb-4">{{ __('Movements') }}</h2>

<form id="search-form" action="{{ route('devices.fetch_data') }}" method="get">
    <input type="hidden" id="page-input" name="page">
    <div class="input-group my-3">
        <input type="search" id="search-input" name="search_string" class="form-control" placeholder="{{ __('Search by keywords') }}..." title="{{ __('Enter for search. Esc for reset.') }}">
    </div>
</form>

<pre>
{{ print_r($movements) }}
</pre>

@endsection