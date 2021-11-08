<x-modal id="device-properties-modal" class="modal-lg modal-fullscreen-lg-down">
    <x-slot name="title">{{ __('dialog.edit.header', ['entity' => trans('device')]) }}</x-slot>

    <form id="device-update-form" class="mt-3" action="{{ route('devices.update', ['device' => $device->id]) }}" method="post">
        @csrf
        @method('put')

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="inventory_code" class="form-label">{{ __('Inventory code') }}</label>
                <input type="text" name="inventory_code" class="form-control" id="inventory_code" value="{{ $device->inventory_code }}">
            </div>
            <div class="col-md-6">
                <label for="identification_code" class="form-label">{{ __('Identification code') }}</label>
                <input type="text" name="identification_code" class="form-control" id="identification_code" value="{{ $device->identification_code }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="type_id" class="form-label">{{ __('Type') }}</label>
                <select name="type_id" class="form-control" id="type_id">
                    @foreach($types as $type)
                    <option value="{{ $type->id }}" @if($type->id === $device->type_id) selected @endif >
                        {{ $type->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="model" class="form-label">{{ __('Model') }}</label>
                <input type="text" name="model" class="form-control" id="model" value="{{ $device->model }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="comment" class="form-label">{{ __('Comment') }}</label>
                <x-textarea name="comment" style="min-height: 81px; resize: none;">{{ $device->comment }}</x-textarea>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="row mb-0 mr-0">
                    <label for="status_id" class="col-auto col-form-label">{{ __('Status') }}:</label>
                    <input type="text" name="status_id" class="form-control col" id="status_id" value="{{ $device->status->name }}" disabled>
                    <i class="far fa-question-circle col-auto col-form-label ml-2" title="{{ __('The status is autoupdated as a feedback on you actions (change workplace, sent to repair, etc.).') }}"></i>
                </div>
            </div>

            <div class="col d-flex">
                <div class="ms-auto">
                    <x-button>{{ __('actions.apply') }}</x-button>
                </div>
            </div>
        </div>

    </form>
</x-modal>