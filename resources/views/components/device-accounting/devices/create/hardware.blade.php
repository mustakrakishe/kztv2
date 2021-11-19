<x-tabpanel {{ $attributes }}>
    <form id="create-hardware-form" class="mt-3" action="{{ route('hardware.store') }}" method="post">
        @csrf
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="date" class="form-label">{{ __('Date') }}</label>
                <input type="datetime-local" name="date" class="form-control">
            </div>

            <div class="col-md-6 d-flex align-items-end">
                <div class="form-check mb-2">
                    <input type="checkbox" name="great_mod" class="form-check-input" id="great_mod" checked disabled>
                    <input name="great_mod" type="hidden" value="true"/>
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
            ></textarea>
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
</x-tabpanel>