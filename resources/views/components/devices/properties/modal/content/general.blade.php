@props(['device', 'types', 'statuses'])

<form id="device-update-form" class="mt-3" action="{{ route('devices.update', ['device' => $device->id]) }}" method="post">
    @csrf
    @method('put')

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
            <label for="type_id">{{ __('Type') }}</label>
            <select name="type_id" class="form-control" id="type_id">
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
            <label for="comment">{{ __('Comment') }}</label>
            <x-textarea name="comment" style="min-height: 81px; resize: none;">{{ $device->comment }}</x-textarea>
        </div>
    </div>
    
    <div class="form-row">
        <div class="col col-md-6">
            <div class="form-group row mb-0 mr-0">
                <label for="status_id" class="col-auto col-form-label">{{ __('Status') }}:</label>
                <select name="status_id" class="form-control col" id="status_id">
                    @foreach($statuses as $status)
                    <option value="{{ $status->id }}" @if($status->id === $device->status_id) selected @endif >
                        {{ $status->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col col-md-6 text-right">
            <x-button type="reset" class="btn-secondary">{{ __('actions.reset') }}</x-button>
            <x-button>{{ __('actions.update') }}</x-button>
        </div>
    </div>
    
</form>