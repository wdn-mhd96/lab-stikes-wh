<div
    x-data="{ value: @entangle($model).live }"
    x-init="
        new TomSelect($refs.select, {
            allowEmptyOption: true,
            create: false,
            onChange(val) {
                value = val; // Alpine → Livewire
            }
        });
    "
>
    {{-- TomSelect UI --}}
    <select
        x-ref="select"
        class="{{ $classes ?? '' }}"
    >
        <option value="">-- Select --</option>

        @foreach ($options as $item)
            <option value="{{ $item[$valueField] }}">
                {{ $item[$labelField] }}
            </option>
        @endforeach
    </select>

    {{-- THIS IS WHAT LIVEWIRE READS --}}
    <input
        type="hidden"
        wire:model="{{ $model }}"
        x-model="value"
    >
    
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
</div>

