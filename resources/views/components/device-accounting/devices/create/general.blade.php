@props(['types'])

<form id="create-device-form" class="mt-3" action="{{ route('devices.validate') }}" method="get">

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="inventory_code" class="form-label">{{ __('Inventory code') }}</label>
            <input type="text" name="inventory_code" class="form-control" id="inventory_code">
        </div>
        <div class="col-md-6">
            <label for="identification_code" class="form-label">{{ __('Identification code') }}</label>
            <input type="text" name="identification_code" class="form-control" id="identification_code">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="type_id" class="form-label">{{ __('Type') }}</label>
            <select name="type_id" class="form-select" id="type_id">
                @foreach($types as $type)
                <option value="{{ $type->id }}">
                    {{ $type->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="model" class="form-label">{{ __('Model') }}</label>
            <input type="text" name="model" class="form-control" id="model">
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col">
            <label for="comment" class="form-label">{{ __('Comment') }}</label>
            <textarea name="comment" class="form-control" style="height: 132px; resize: none; overflow-x: hidden; overflow-y: scroll;"></textarea>
        </div>
    </div>
    
</form>