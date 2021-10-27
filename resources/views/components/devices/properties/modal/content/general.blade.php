@props(['device', 'types', 'statuses'])

<form class="mt-3">

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inventory_code">{{ __('Inventory code') }}</label>
            <input type="text" name="inventory_code" class="form-control" id="inventory_code" value="{{ $device->inventory_code }}">
        </div>
        <div class="form-group col-md-6">
            <label for="identification_code">{{ __('Identification code') }}</label>
            <input type="text" name="identification_code" class="form-control" id="identification_code" value="{{ $device->identification_code }}">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="type">{{ __('Type') }}</label>
            <select name="type" class="form-control" id="type">
                @foreach($types as $type)
                <option value="{{ $type->id }}" @if($type->id === $device->type_id) selected @endif >
                    {{ $type->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="model">{{ __('Model') }}</label>
            <input type="text" name="model" class="form-control" id="model" value="{{ $device->model }}">
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group col">
            <label for="model">{{ __('Comment') }}</label>
            <x-textarea name="model" style="min-height: 81px; resize: none;">{{ $device->comment }}</x-textarea>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary">Sign in</button>
</form>