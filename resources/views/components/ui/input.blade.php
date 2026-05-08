@props([
    'type'        => 'text',
    'name'        => '',
    'label'       => null,
    'placeholder' => '',
    'value'       => '',
    'required'    => false,
    'error'       => null,
])

@php
    $labelText = $label ?: 'Kolom ini';
@endphp

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
        data-label="{{ $labelText }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge([
            'oninvalid' => "const label = this.getAttribute('data-label') || 'Kolom ini'; let message = ''; if (this.validity.valueMissing) { message = label + ' wajib diisi.'; } else if (this.validity.typeMismatch) { message = 'Format ' + label.toLowerCase() + ' tidak valid.'; } else if (this.validity.patternMismatch) { message = this.getAttribute('data-pattern-message') || ('Format ' + label.toLowerCase() + ' tidak sesuai.'); } else if (this.validity.tooShort) { message = label + ' minimal ' + this.minLength + ' karakter.'; } this.setCustomValidity(message);",
            'oninput' => "this.setCustomValidity('');",
            'class' => 'w-full px-4 py-2.5 rounded-lg border border-slate-300 text-sm
                        focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500
                        transition ' . ($error ? 'border-red-400' : '')
        ]) }}
    >

    @if($error)
        <p class="text-xs text-red-500 mt-0.5">{{ $error }}</p>
    @endif
</div>