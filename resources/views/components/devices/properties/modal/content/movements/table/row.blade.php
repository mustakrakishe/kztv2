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
</tr>