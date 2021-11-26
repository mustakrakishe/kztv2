<form id="movement-edit-form" class="h-100 d-flex flex-column mt-3" action="{{ route('devices.movements.update', ['device' => $movement->device_id, 'movement' => $movement->id]) }}" method="post">
    @csrf
    @method('put')

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="date" class="form-label">{{ __('Date') }}</label>
            <input type="datetime-local" name="date" class="form-control" value="{{ $movement->date }}">
        </div>
        <div class="col-md-6">
            <label for="status_id" class="form-label">{{ __('Status') }}</label>
            <select name="status_id" class="form-select">
                @foreach($statuses as $status)
                <option
                    value="{{ $status->id }}"
                    @if($status->id == $movement->status_id) selected @endif
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
        >{{ $movement->location }}</textarea>
    </div>

    <div class="mb-3">
        <label for="comment" class="form-label">{{ __('Comment') }}</label>
        <textarea
            name="comment"
            class="form-control"
            style="height: 81px; resize: none; overflow-x: hidden; overflow-y: scroll;"
        >{{ $movement->comment }}</textarea>
    </div>

    <div class="ms-auto mt-auto">
        <x-button>{{ __('dialog.actions.apply') }}</x-button>
    </div>

</form>