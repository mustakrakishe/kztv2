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

<table class="table table-striped table-hover">

    <thead class="thead-dark text-center">
        <tr>
            <th scope="col"></th>
            <th scope="col">{{ __('Inv. №') }}</th>
            <th scope="col">{{ __('Type') }}</th>
            <th scope="col">{{ __('Model') }}</th>
            <th scope="col">{{ __('Hardware') }}</th>
            <th scope="col">{{ __('Software') }}</th>
            <th scope="col">{{ __('Location') }}</th>
            <th scope="col">{{ __('Comment') }}</th>
        </tr>
    </thead>

    <tbody>
        @foreach($devices as $device)
        <x-devices.brief-information-table-row :device="$device" />
        @endforeach
    </tbody>

</table>

{{ $devices->links() }}
@endsection