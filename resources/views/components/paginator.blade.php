@props(['paginator'])

<div {{ $attributes->merge([
    'current-page' => $paginator->currentPage(),
    'path' => $paginator->path(),
    'per-page' => $paginator->perPage()
]) }}>
    {{ $paginator->links() }}
</div>