@php
    $label = $label ?? ucfirst($name);
    $class = $class ?? null;
    $name = $name ?? '';
    $value = $value ?? '';
@endphp
<div class="form-group {{ $class }}">
    <label for="{{ $name }}">{{ $label }}</label>
    <select class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" id="{{ $name }}">
        @if ($name === 'role')
            <option value="Administrateur" {{ $value === 'Administrateur' ? 'selected' : '' }}>Administrateur</option>
            <option value="Utilisateur" {{ $value === 'Utilisateur' ? 'selected' : '' }}>Utilisateur</option>
        @elseif ($name === 'niveau_id')
            @foreach ($niveaux as $k => $v)
                <option value="{{ $k }}" {{ $k === $value ? 'selected' : '' }}>{{ $v }}</option>
            @endforeach
        @elseif ($name === 'etat_id')
            @foreach ($etats as $k => $v)
                <option value="{{ $k }}" {{ $k === $value ? 'selected' : '' }}>{{ $v }}</option>
            @endforeach
        @else
            @foreach ($services as $k => $v)
                <option value="{{ $k }}" {{ $k === $value ? 'selected' : '' }}>{{ $v }}</option>
            @endforeach
        @endif
    </select>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
