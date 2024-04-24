@extends('admin.admin')

@section('title', 'Accepter une demande')

@section('content')

    <h1>@yield('title')</h1>

    <form class="vstack gap-2"
        action="{{route('admin.accepte.store', $demande)}}" method="post">

        @csrf
        <div class="row">
            <p>Nom : {{$demande->nom_demande}}</p>
            <p>Prenom : {{$demande->prenom_demande}}</p>
            {{-- <p>id : {{$demande->id}}</p> --}}
            @include('shared.input', ['name' => 'theme', 'label' => 'Theme :', 'value' => $stagiaire->theme])
            @include('shared.input', ['type' => 'textarea', 'name' => 'description_theme', 'label' => 'Description', 'value' => $stagiaire->description_theme])
            @include('shared.input', ['type' => 'date', 'name' => 'date_debut', 'label' => 'Date de debut', 'value' => $stagiaire->date_debut])
            @include('shared.input', ['type' => 'number', 'name' => 'dure', 'label' => 'Dure'])
        </div>
        <br>
        <div>
            <button class="btn btn-primary">
                    Enregistrer
            </button>
        </div>
        {{-- <input type="hidden" name="{{$stagiaire->demande_id}}" value="{{$demande->id}}"> --}}
        {{-- <input type="hidden" name="{{$demande->etat_id}}" value="3"> --}}
    </form>
@endsection
