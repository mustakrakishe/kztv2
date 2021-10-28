<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary shadow-none', 'style' => 'width: 100px;']) }}>
    {{ $slot }}
</button>
