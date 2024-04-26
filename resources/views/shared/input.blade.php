{{-- @php
    $label ??= ucfirst($name);
    $type ??= 'text';
    $class ??= null;
    $name ??= '';
    $value ??= '';
    $placeholder ??= '';
@endphp
<div @class(["form-group, $class"])></div>
<label for="{{ $name }}">{{ $label }}</label>
@if ($type == 'file')
    <input class='mt-1 block w-full @error($name) is-invalid @enderror' type='{{ $type }}' id='{{ $name }}'
        name='{{ $name }}' placeholder="{{ $placeholder }}" onfocus="this.placeholder = ''"
        onblur="this.placeholder = '{{ $placeholder }}'" value='{{ old($name, $value) }}'>
@elseif ($type == 'email')
    <input class='form-control @error($name) is-invalid @enderror' type='{{ $type }}' id='{{ $name }}'
        name='{{ $name }}' placeholder="{{ $placeholder }}" onfocus="this.placeholder = ''"
        onblur="this.placeholder = '{{ $placeholder }}'" value='{{ old($name, $value) }}'>
@elseif ($type == 'date')
    <input class='form-control @error($name) is-invalid @enderror' type='{{ $type }}' id='{{ $name }}'
        name='{{ $name }}' value='{{ old($name, $value) }}'>
@elseif ($type == 'number')
    <input class='form-control @error($name) is-invalid @enderror' type='{{ $type }}' id='{{ $name }}'
        name='{{ $name }}' value='{{ old($name, $value) }}'>
@elseif ($type == 'textarea')
    <textarea class='form-control @error($name) is-invalid @enderror' type='{{ $type }}' id='{{ $name }}'
        name='{{ $name }}' placeholder="{{ $placeholder }}" onfocus="this.placeholder = ''"
        onblur="this.placeholder = '{{ $placeholder }}'">{{ old($name, $value) }}</textarea>
@else
    <input class='form-control @error($name) is-invalid @enderror' type='{{ $type }}' id='{{ $name }}'
        name='{{ $name }}' placeholder="{{ $placeholder }}" onfocus="this.placeholder = ''"
        onblur="this.placeholder = '{{ $placeholder }}'" value='{{ old($name, $value) }}'>
@endif

@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror --}}
@php
    $label ??= ucfirst($name);
    $type ??= 'text';
    $class ??= null;
    $name ??= '';
    $value ??= '';
    $placeholder ??= '';
@endphp

<div class="form-group {{ $class }}">
    <label for="{{ $name }}">{{ $label }}</label>

    @switch($type)
        @case('file')
            <input class="form-control @error($name) is-invalid @enderror" type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ $placeholder }}'" value="{{ old($name, $value) }}">
            @break
        @case('email')
            <input class='form-control @error($name) is-invalid @enderror' type='{{ $type }}' id='{{ $name }}' name='{{ $name }}' placeholder="{{ $placeholder }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ $placeholder }}'" value='{{ old($name, $value) }}'>
            @break
        @case('date')
            <input class='form-control @error($name) is-invalid @enderror' type='{{ $type }}' id='{{ $name }}' name='{{ $name }}' value='{{ old($name, $value) }}'>
            @break
        @case('number')
            <input class='form-control @error($name) is-invalid @enderror' type='{{ $type }}' id='{{ $name }}' name='{{ $name }}' value='{{ old($name, $value) }}'>
            @break
        @case('textarea')
            <textarea class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ $placeholder }}'">{{ old($name, $value) }}</textarea>
            @break
        @default
            <input class="form-control @error($name) is-invalid @enderror" type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '{{ $placeholder }}'" value="{{ old($name, $value) }}">
            @break
    @endswitch

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

