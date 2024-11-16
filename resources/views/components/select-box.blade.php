<div class="form-group">
    <label class="font-weight-bold {{ $extraLabelClass }}">{{ $placeholder }}</label>
    <select class="js-example-basic-single w-100 {{ $extraClass }}" data-width="100%" name="{{ $name }}" data-endpoint="{{ $endpoint }}" data-field1-id="{{ $field1 }}" data-field2-id="{{ $field2 }}" {{ $multiple ? 'multiple' : '' }}>
        <option value="">{{ $removeTextSelection ? "" : 'Select ' . $placeholder }}</option>

        @if(!empty($values))
            @foreach($values as $key => $data)
                <option value="{{ $key }}"
                    @if($multiple && is_array($value) && in_array($key, $value))
                        selected
                    @elseif(!$multiple && $key == $value)
                        selected
                    @endif>
                    {{ $data }}
                </option>
            @endforeach
        @endif

        @if(!empty($value) && (is_array($value) && $multiple || !$multiple) && strpos($extraClass, 'ajax-endpoint') !== false)
            @if($multiple)
                @foreach($value as $key => $val)
                    <option value="{{ $val }}" selected>{{ $key }}</option>
                @endforeach
            @else
                <option value="{{ $value }}" selected>{{ $optionText }}</option>
            @endif
        @endif
    </select>

    @error($name)
        <div class="text text-danger">{{ $message }}</div>
    @enderror
</div>
