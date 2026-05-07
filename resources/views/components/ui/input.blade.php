@props([
    'type'        => 'text',
    'name'        => '',
    'label'       => null,
    'placeholder' => '',
    'value'       => '',
    'required'    => false,
    'error'       => null,
])

<div class="flex flex-col gap-1">
    @if($label)
        <label for="{{ $name }}" class="text-sm font-semibold text-slate-700">
            {{ $label }}
            @if($required) <span class="text-red-500">*</span> @endif
        </label>
    @endif

    <input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge([
            'class' => 'w-full px-4 py-2.5 rounded-lg border border-slate-300 text-sm
                        focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500
                        transition ' . ($error ? 'border-red-400' : '')
        ]) }}
    >

    @if($error)
        <p class="text-xs text-red-500 mt-0.5">{{ $error }}</p>
    @endif
</div>