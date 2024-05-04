@php
    $label ??= ucfirst($name);
    $type ??= 'text';
    $class ??= null;
    $name ??= '';
    $value ??= '';
    $placeholder ??= '';
@endphp

<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>

    @switch($type)
        @case('file')
            <div class="input-group mb-3 @error($name) is-invalid @enderror">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-file"></i></span>
                </div>
                <input class="form-control  {{ $class }} @error($name) is-invalid @enderror" type="{{ $type }}" id="{{ $name }}"
                    name="{{ $name }}" placeholder="{{ $placeholder }}" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = '{{ $placeholder }}'" value="{{ old($name, $value) }}">
            </div>
        @break

        @case('email')
            <div class="input-group mb-3 @error($name) is-invalid @enderror">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
                <input class='form-control @error($name) is-invalid @enderror' type='{{ $type }}'
                    id='{{ $name }}' name='{{ $name }}' placeholder="{{ $placeholder }}"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ $placeholder }}'"
                    value='{{ old($name, $value) }}'>
            </div>
        @break

        @case('date')
            <div class="input-group mb-3 @error($name) is-invalid @enderror">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class=""></i>Date</span>
                </div>
                <input class='form-control @error($name) is-invalid @enderror' type='{{ $type }}'
                    id='{{ $name }}' name='{{ $name }}' value='{{ old($name, $value) }}'>
            </div>
        @break

        @case('number')
            <div class="input-group mb-3 @error($name) is-invalid @enderror">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                </div>
                <input class='form-control @error($name) is-invalid @enderror' type='{{ $type }}'
                    id='{{ $name }}' name='{{ $name }}' value='{{ old($name, $value) }}'>
            </div>
        @break

        @case('textarea')
            <div class="input-group mb-3 @error($name) is-invalid @enderror">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                </div>
                <textarea class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}"
                    placeholder="{{ $placeholder }}" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = '{{ $placeholder }}'">{{ old($name, $value) }}</textarea>
            </div>
        @break

        @default
            <div class="input-group mb-3 @error($name) is-invalid @enderror">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-asterisk"></i></span>
                </div>
                <input class="form-control @error($name) is-invalid @enderror" type="{{ $type }}"
                    id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ $placeholder }}'"
                    value="{{ old($name, $value) }}">
            </div>
        @break
    @endswitch

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
