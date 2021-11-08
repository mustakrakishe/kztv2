<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary shadow-none']) }}>
    <div name="init-content">
        {{ $slot }}
    </div>
</button>
