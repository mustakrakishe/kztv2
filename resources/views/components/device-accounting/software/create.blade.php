@php
    $dateTime = time();
    $dateTimeISO = date('Y-m-d', $dateTime) . 'T' . date('H:i:s', $dateTime);
@endphp

<form id="update-software-form" class="h-100 d-flex flex-column mt-3" action="{{ route('software.store') }}" method="post">
    @csrf

    <input type="hidden" name="device_id" value="{{ $deviceId }}">

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="date" class="form-label">{{ __('Date') }}</label>
            <input type="datetime-local" name="date" class="form-control" value="{{ $dateTimeISO }}">
        </div>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">{{ __('Description') }}</label>
        <textarea
            name="description"
            class="form-control"
            style="height: 81px; resize: none; overflow-x: hidden; overflow-y: scroll;"
        ></textarea>
    </div>

    <div class="mb-3">
        <label for="comment" class="form-label">{{ __('Comment') }}</label>
        <textarea
            name="comment"
            class="form-control"
            style="height: 81px; resize: none; overflow-x: hidden; overflow-y: scroll;"
        ></textarea>
    </div>

    <div class="ms-auto mt-auto">
        <x-button>{{ __('dialog.actions.apply') }}</x-button>
    </div>

</form>