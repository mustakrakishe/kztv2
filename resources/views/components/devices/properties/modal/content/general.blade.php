@props(['device', 'types'])

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
                <input type="text" name="status_id" class="form-control col" id="status_id" value="{{ $device->status->name }}" disabled>
                <i class="far fa-question-circle col-form-label ml-2" title="{{ __('The status is autoupdated as a feedback on you actions (change workplace, sent to repair, etc.).') }}"></i>
            </div>
        </div>

        <div class="col-12 col-lg-6 d-flex mt-3 mt-lg-0">
            <x-button id="device-delete-button" type="button" class="btn-danger toggle-modal" data-toggle="modal" data-target="#device-delete-modal" data-dismiss="modal">{{ __('actions.delete') }}</x-button>

            <div class="ml-auto">
                <x-button type="reset" class="btn-secondary">{{ __('actions.reset') }}</x-button>
                <x-button>{{ __('actions.update') }}</x-button>
            </div>
        </div>
    </div>
    
</form>