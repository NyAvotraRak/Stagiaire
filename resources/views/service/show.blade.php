@extends('base')

@section('title', $service->nom_service)

@section('content')
    <h1>{{ $service->nom_service }}</h1>
    <h2>{{ $service->description_service }}</h2>

    <div id="formu">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div id="demande">
                    <h3>Interessé par ce service :</h3>
                    <br>
                    <form action="{{ route('acceuil.postule', $demande) }}" method="post" class="vstack gap-3">
                        @csrf

                        @include('shared.input', [
                            'name' => 'nom_demande',
                            'label' => 'Nom :',
                            'placeholder' => 'Entrer le nom',
                            'value' => $demande->nom_demande,
                        ])
                        @include('shared.input', [
                            'name' => 'prenom_demande',
                            'label' => 'Prenom :',
                            'placeholder' => 'Entrer le prenom',
                            'value' => $demande->prenom_demande,
                        ])
                        @include('shared.input', [
                            'type' => 'email',
                            'name' => 'email_demande',
                            'label' => 'Email :',
                            'placeholder' => 'exemple@gmail.com',
                            'value' => $demande->email_demande,
                        ])
                        @include('shared.input', [
                            'name' => 'image_demande',
                            'label' => 'Image :',
                            'placeholder' => 'image',
                            'value' => $demande->image_demande,
                        ])
                        @include('shared.input', [
                            'name' => 'cv',
                            'label' => 'CV :',
                            'placeholder' => 'CV',
                            'value' => $demande->cv,
                        ])
                        @include('shared.input', [
                            'name' => 'lm',
                            'label' => 'LM :',
                            'placeholder' => '...',
                            'value' => $demande->lm,
                        ])
                        @include('shared.input', [
                            'name' => 'autres',
                            'label' => 'Autres :',
                            'placeholder' => '....',
                            'value' => $demande->autres,
                        ])


                        @include('shared.select', [
                            'name' => 'niveau_id',
                            'label' => 'Niveau',
                            'value' => $demande->niveau_id,
                            'options' => $niveaux,
                        ])
                        <input type="hidden" name="etat_id" id="etat_id" value="1">
                        <input type="hidden" name="service_id" id="service_id" value="{{$service->id}}">

                        <br>
                        <div class="col-lg-12">
                            <div class="section-top text-right">
                                <button type="submit" class="genric-btn info-border circle">Ajouter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
