@props(['statuses'])

<form id="create-movement-form" class="mt-3" action="{{ route('movements.validate') }}" method="get">

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="date" class="form-label">{{ __('Date') }}</label>
            <input type="datetime-local" name="date" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="status_id" class="form-label">{{ __('Status') }}</label>
            <select name="status_id" class="form-select">
                @foreach($statuses as $status)
                <option value="{{ $status->id }}">
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
        >ЗУ. АСУ. 210</textarea>
    </div>

    <div>
        <label for="comment" class="form-label">{{ __('Comment') }}</label>
        <textarea
            name="comment"
            class="form-control"
            style="height: 81px; resize: none; overflow-x: hidden; overflow-y: scroll;"
        ></textarea>
    </div>
    
</form>