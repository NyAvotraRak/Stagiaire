@php
    $label ??= ucfirst($name);
    $class ??= null;
    $name ??= '';
    $value ??= '';
@endphp
<div @class(['form-group', $class])>
    <p for="{{ $name }}">{{ $label }}</p>
    @if ($name == 'role')
        <select class='form-control @error($name) is-invalid @enderror' name="{{ $name }}" id="{{ $name }}" class="form-control">
            <option value="Administrateur" {{ $value == 'Administrateur' ? 'selected' : '' }}>Administrateur</option>
            <option value="Utilisateur" {{ $value == 'Utilisateur' ? 'selected' : '' }}>Utilisateur</option>
        </select>
    @elseif ($name == 'niveau_id')
        <select class='form-control @error($name) is-invalid @enderror' name="{{ $name }}" id="{{ $name }}">
            @foreach ($niveaux as $k => $v)
                <option value="{{ $k }}">{{ $v }}</option>
            @endforeach
        </select>
    @elseif ($name == 'etat_id')
        <select class='form-control @error($name) is-invalid @enderror' name="{{ $name }}" id="{{ $name }}">
            @foreach ($etats as $k => $v)
                <option value="{{ $k }}">{{ $v }}</option>
            @endforeach
        </select>
    @else
        <select class='form-control @error($name) is-invalid @enderror' name="{{ $name }}" id="{{ $name }}">
            @foreach ($services as $k => $v)
                <option value="{{ $k }}">{{ $v }}</option>
            @endforeach
        </select>
    @endif

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
