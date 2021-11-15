<form id="create-movement-form" class="mt-3" action="" method="get">
    <div class="row mb-3">
        <label for="date" class="form-label">{{ __('Date') }}</label>
        <input type="datetime-local" name="date" class="form-control w-auto">
    </div>

    <div class="row mb-3">
        <label for="location" class="form-label">{{ __('Location') }}</label>
        <textarea name="location" class="form-control" style="height: 81px; resize: none; overflow-x: hidden; overflow-y: scroll;"></textarea>
    </div>

    <div class="row">
        <label for="comment" class="form-label">{{ __('Comment') }}</label>
        <textarea name="comment" class="form-control" style="height: 81px; resize: none; overflow-x: hidden; overflow-y: scroll;"></textarea>
    </div>
    
</form>