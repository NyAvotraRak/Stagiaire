@extends('base')

@section('title', $service->nom_service)

@section('content')
    <div class="container">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Intéressé par ce service? :</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="card card-solid">
                <div class="card-body" style="background-color: rgb(240, 240, 240)">
                    <div class="row">
                        <!-- Nom du service -->
                        <div class="row">
                            <div class="col-lg-12 text-center"> <!-- Ajoutez la classe text-center -->
                                {{-- <div class="row"> --}}
                                <h3 class="my-3">
                                    {{ $service->nom_service }}
                                </h3>
                                {{-- </div> --}}
                            </div>
                            <p>{{ $service->description_service }}</p>
                        </div>

                        <!-- Image du service -->
                        <div class="col-lg-4 mt-4">
                            @if ($service->image_service)
                                <img src="{{ $service->image_url() }}" class="img-circle elevation-2"
                                    style="width: 300px; height: 300px; object-fit:cover;" alt="Product Image">
                            @endif
                        </div>
                        <!-- Formulaire de demande -->
                        <form class="vstack gap-2" action="{{ route('acceuil.postule', $demande) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    @include('shared.input', [
                                        'type' => 'file',
                                        'name' => 'image_demande',
                                        'label' => 'Image :',
                                        'placeholder' => 'Image',
                                        'value' => old('image_demande'),
                                    ])
                                    @include('shared.input', [
                                        'name' => 'nom_demande',
                                        'label' => 'Nom :',
                                        'placeholder' => 'Nom',
                                        'value' => old('nom_demande', $demande->nom_demande),
                                    ])
                                    @include('shared.input', [
                                        'name' => 'prenom_demande',
                                        'label' => 'Prénom :',
                                        'placeholder' => 'Prénom',
                                        'value' => old('prenom_demande', $demande->prenom_demande),
                                    ])
                                    @include('shared.select', [
                                        'name' => 'niveau_id',
                                        'label' => 'Niveau :',
                                        'options' => $niveaux,
                                        'value' => old('niveau_id', $demande->niveau_id),
                                    ])
                                </div>
                                <div class="col-lg-6">
                                    @include('shared.input', [
                                        'type' => 'email',
                                        'name' => 'email_demande',
                                        'label' => 'E-mail :',
                                        'placeholder' => 'exemple@gmail.com',
                                        'value' => old('email_demande', $demande->email_demande),
                                    ])
                                    @include('shared.input', [
                                        'type' => 'file',
                                        'name' => 'cv',
                                        'label' => 'Curriculum Vitae :',
                                        'placeholder' => 'cv',
                                        'value' => old('cv', $demande->cv),
                                    ])
                                    @include('shared.input', [
                                        'type' => 'file',
                                        'name' => 'lm',
                                        'label' => 'Lettre de Motivation :',
                                        'placeholder' => 'lm',
                                        'value' => old('lm', $demande->lm),
                                    ])
                                    @include('shared.input', [
                                        'type' => 'file',
                                        'name' => 'autres',
                                        'label' => 'Autres :',
                                        'placeholder' => 'autres',
                                        'value' => old('autres', $demande->autres),
                                    ])
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-reset">
                                    <span><i class="fas fa-paper-plane" style="color: rgb(106, 128, 252);">
                                            Envoyer</i></span>
                                </button>
                            </div>

                            <input type="hidden" name="service_id" id="service_id" value="{{ $service->id }}">
                            <input type="hidden" name="etat_id" id="etat_id" value="1">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
