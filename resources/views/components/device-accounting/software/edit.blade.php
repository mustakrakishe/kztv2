@php
    $dateTimeISO  = str_replace(' ', 'T', $software->date);
@endphp

<form id="update-software-form" class="h-100 d-flex flex-column mt-3" action="{{ route('software.update', ['software' => $software->id]) }}" method="post">
    @method('put')
    @csrf

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
        >{{ $software->description }}</textarea>
    </div>

    <div class="mb-3">
        <label for="comment" class="form-label">{{ __('Comment') }}</label>
        <textarea
            name="comment"
            class="form-control"
            style="height: 81px; resize: none; overflow-x: hidden; overflow-y: scroll;"
        >{{ $software->comment }}</textarea>
    </div>

    <div class="ms-auto mt-auto">
        <x-button>{{ __('dialog.actions.update') }}</x-button>
    </div>

</form>