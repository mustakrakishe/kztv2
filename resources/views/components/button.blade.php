<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary shadow-none', 'style' => 'min-width: 100px;']) }}>
    <div name="init-content">
        {{ $slot }}
    </div>
</button>
