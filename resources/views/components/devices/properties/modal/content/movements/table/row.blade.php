@props(['movement'])

<tr {{ $attributes->merge(['style' => 'cursor: pointer;']) }}>
    <td>
        <input type="datetime-local" name="date" class="form-control" value="{{ str_replace(' ', 'T', $movement->date) }}">
    </td>
    <td>
        <input type="text" name="location" class="form-control" value="{{ $movement->location }}">
    </td>
    <td>
        <input type="text" name="comment" class="form-control" value="{{ $movement->comment }}">
    </td>
    <td>
        <x-button class="btn-secondary" style="width: 50px;">
            <i class="fas fa-pen"></i>
        </x-button>
    </td>
    <td class="pl-0">
        <x-button class="btn-danger" style="width: 50px;">
            <i class="fas fa-trash-alt"></i>
        </x-button>
    </td>
</tr>