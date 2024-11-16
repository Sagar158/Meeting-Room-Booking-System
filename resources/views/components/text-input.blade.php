<div class="form-group">
    @php
        $extraLabelClass = $extraLabelClass ?? ''; // Ensures $extraLabelClass has a default value if not set
    @endphp

    <label {{ $attributes->merge(['class' => 'block font-medium font-weight-bold text-sm text-gray-700 dark:text-gray-300 '.$extraLabelClass]) }}>
        {{ $placeholder ?? '' }}
    </label>
    <input {{ $disabled ? 'disabled' : '' }} type="{{ $type }}" name="{{ $name }}" {!! $attributes->merge(['class' => 'form-control '. $extraClass]) !!} id="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ $value }}" autocomplete="off">
    @error($name)
        <div class="text text-danger">{{ $message }}</div>
    @enderror
</div>


