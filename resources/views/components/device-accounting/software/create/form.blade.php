@props(['software' => null])

<form id="create-software-form" class="mt-3" action="{{ route('software.store') }}" method="post">
    @csrf
    
    <input type="hidden" name="device_id" @isset($software->device_id) value="{{ $software->device_id }}" @endisset>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="date" class="form-label">{{ __('Date') }}</label>
            <input type="datetime-local" name="date" class="form-control" value="{{ $software->date }}" step="1">
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

    <div>
        <label for="comment" class="form-label">{{ __('Comment') }}</label>
        <textarea
            name="comment"
            class="form-control"
            style="height: 81px; resize: none; overflow-x: hidden; overflow-y: scroll;"
        >{{ $software->comment }}</textarea>
    </div>

</form>