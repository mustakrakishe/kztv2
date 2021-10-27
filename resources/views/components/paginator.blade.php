@props(['paginator'])

<div {{ $attributes->merge([
    'current-page-url' => $paginator->url($paginator->currentPage()),
    'first-page-url' => $paginator->url(1),
    'per-page' => $paginator->perPage()
]) }}>
    {{ $paginator->links() }}
</div>