<form id="hardware-edit-form" class="h-100 d-flex flex-column mt-3" action="{{ route('devices.hardware.update', ['device' => $hardware->device_id, 'hardware' => $hardware->id]) }}" method="post">
    @csrf
    @method('put')
    
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="date" class="form-label">{{ __('Date') }}</label>
            <input type="datetime-local" name="date" class="form-control" step="1" value="{{ $hardware->date }}">
        </div>

        <div class="col-md-6 d-flex align-items-end">
            <div class="form-check mb-2">
                <input
                    type="checkbox"
                    class="form-check-input"
                    id="great_mod_clone"
                    onclick="great_mod.value = this.checked ? 1 : 0;"
                    @if($hardware->great_mod) checked @endif
                >
                <label for="great_mod_clone" class="form-check-label">
                    {{ __('Great modification') }}
                </label>
            </div>
            <input type="hidden" name="great_mod" id="great_mod" value="{{ $hardware->great_mod ? 1 : 0 }}">
        </div>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">{{ __('Description') }}</label>
        <textarea
            name="description"
            class="form-control"
            style="height: 81px; resize: none; overflow-x: hidden; overflow-y: scroll;"
        >{{ $hardware->description }}</textarea>
    </div>

    <div class="mb-3">
        <label for="comment" class="form-label">{{ __('Comment') }}</label>
        <textarea
            name="comment"
            class="form-control"
            style="height: 81px; resize: none; overflow-x: hidden; overflow-y: scroll;"
        >{{ $hardware->comment }}</textarea>
    </div>

    <div class="ms-auto mt-auto">
        <x-button>{{ __('dialog.actions.apply') }}</x-button>
    </div>

</form>