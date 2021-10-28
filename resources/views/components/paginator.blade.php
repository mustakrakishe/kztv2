@props(['paginator'])

<div {{ $attributes->merge([
    'first-page-url' => $paginator->url(1),
    'per-page' => $paginator->perPage()
]) }}>
    {{ $paginator->links() }}
</div>