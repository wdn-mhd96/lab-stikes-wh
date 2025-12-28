
<div

    {{ $attributes->merge([
        'class' => 'fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50 backdrop-blur-md',
    ]) }}
    tabindex="-1"
>
    {{ $slot }}
</div>