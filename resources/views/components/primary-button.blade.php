<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-outline-secondary']) }}>
    {{ $slot }}
</button>
