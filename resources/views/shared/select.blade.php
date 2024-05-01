@php
    $label = $label ?? ucfirst($name);
    $class = $class ?? null;
    $name = $name ?? '';
    $value = $value ?? '';
@endphp
<div class="form-group {{ $class }}">
    <label for="{{ $name }}">{{ $label }}</label>
    <div class="input-group mb-3 @error($name) is-invalid @enderror">
        @if ($name === 'role')
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-chevron-down"></i></span>
            </div>
            <select class="form-control @error($name) is-invalid @enderror" name="{{ $name }}"
                id="{{ $name }}">
                <option value="Administrateur" {{ $value === 'Administrateur' ? 'selected' : '' }}>Administrateur
                </option>
                <option value="Utilisateur" {{ $value === 'Utilisateur' ? 'selected' : '' }}>Utilisateur</option>
            </select>
        @elseif ($name === 'niveau_id')
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-chevron-down"></i></span>
            </div>
            <select class="form-control @error($name) is-invalid @enderror" name="{{ $name }}"
                id="{{ $name }}">
                @foreach ($niveaux as $k => $v)
                    <option value="{{ $k }}" {{ $k === $value ? 'selected' : '' }}>{{ $v }}
                    </option>
                @endforeach
            </select>
        @elseif ($name === 'etat_id')
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-chevron-down"></i></span>
            </div>
            <select class="form-control @error($name) is-invalid @enderror" name="{{ $name }}"
                id="{{ $name }}">
                @foreach ($etats as $k => $v)
                    <option value="{{ $k }}" {{ $k === $value ? 'selected' : '' }}>{{ $v }}
                    </option>
                @endforeach
            </select>
        @else
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-chevron-down"></i></span>
            </div>
            <select class="form-control @error($name) is-invalid @enderror" name="{{ $name }}"
                id="{{ $name }}">
                @foreach ($services as $k => $v)
                    <option value="{{ $k }}" {{ $k === $value ? 'selected' : '' }}>{{ $v }}
                    </option>
                @endforeach
            </select>
        @endif
    </div>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
