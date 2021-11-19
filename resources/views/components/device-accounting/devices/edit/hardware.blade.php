@props(['hardware', 'statuses'])

@php
    $dateISO = str_replace(' ', 'T', $software->date);
@endphp

<x-tabpanel {{ $attributes }}>
    <form id="hardware-update-form" class="h-100 d-flex flex-column mt-3" action="{{ route('hardware.update', ['hardware' => $hardware->id]) }}" method="post">
        @csrf
        @method('put')
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="date" class="form-label">{{ __('Date') }}</label>
                <input type="datetime-local" name="date" class="form-control" value="{{ $dateISO }}">
            </div>

            <div class="col-md-6 d-flex align-items-end">
                <div class="form-check mb-2">
                    <input type="checkbox" name="great_mod" class="form-check-input" id="great_mod" @if($hardware->great_mod) checked @endif>
                    <label for="great_mod" class="form-check-label">
                        {{ __('Great modification') }}
                    </label>
                </div>
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
</x-tabpanel>