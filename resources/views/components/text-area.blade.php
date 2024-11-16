<div class="form-group text-area-div" style="{{ $divStyle }}">
    @php
        $extraLabelClass = $extraLabelClass ?? ''; // Ensures $extraLabelClass has a default value if not set
    @endphp
    <label {{ $attributes->merge(['class' => 'block font-medium font-weight-bold text-sm text-gray-700 dark:text-gray-300 '.$extraLabelClass]) }}>
        {{ $placeholder}}
    </label>
    <textarea class="form-control mb-3 tinymceExample" name="{{ $name }}" id="tinymceExample" rows="{{ $rows }}" {{ $required ? "required" : '' }}>{!! $value !!}</textarea>
    @error($name)
        <div class="text text-danger">{{ $message }}</div>
    @enderror
    <div class="error-message text text-danger"></div>
</div>
