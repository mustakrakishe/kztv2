@props(['statuses'])

@php
    $IN_STORAGE_STATUS_ID = 2;

    $default = new class {};
    $default->status_id = $IN_STORAGE_STATUS_ID;
    $default->location = 'ЗУ. АСУ. 210';
    $default->comment = 'Новий';
@endphp

<x-device-accounting.devices.create-dialog.panel {{ $attributes }}>
    <form id="create-movement-form" class="mt-3" action="{{ route('movements.store') }}" validation="{{ route('movements.validate') }}"  method="post">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="date" class="form-label">{{ __('Date') }}</label>
                <input type="datetime-local" name="date" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="status_id" class="form-label">{{ __('Status') }}</label>
                <select name="status_id" class="form-select">
                    @foreach($statuses as $status)
                    <option
                        value="{{ $status->id }}"
                        @if($status->id == $default->status_id) selected @endif
                    >
                        {{ $status->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">{{ __('Location') }}</label>
            <textarea
                name="location"
                class="form-control"
                style="height: 81px; resize: none; overflow-x: hidden; overflow-y: scroll;"
            >{{ $default->location }}</textarea>
        </div>

        <div>
            <label for="comment" class="form-label">{{ __('Comment') }}</label>
            <textarea
                name="comment"
                class="form-control"
                style="height: 81px; resize: none; overflow-x: hidden; overflow-y: scroll;"
            >{{ $default->comment }}</textarea>
        </div>
        
    </form>
</x-device-accounting.devices.create-dialog.panel>