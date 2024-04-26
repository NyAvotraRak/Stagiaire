@extends('base')

@section('title', $service->nom_service)

@section('content')
    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Ajout de la classe "justify-content-center" pour centrer horizontalement -->
                <div class="col-lg-8 posts-list">
                    <div class="comment-form">
                        <h1>{{ $service->nom_service }}</h1>
                        <h2>{{ $service->description_service }}</h2>

                        <h4 class="text-center">Intéressé par ce service :</h4>
                        <!-- Ajout de la classe "text-center" pour centrer le titre -->
                        <form action="{{ route('acceuil.postule', $demande) }}" method="post" class="vstack gap-3">
                            @csrf
                            <div class="form-group form-inline">
                                <div class="form-group col-lg-6 col-md-6">
                                    @include('shared.input', [
                                        'name' => 'image_demande',
                                        'label' => 'Image :',
                                        'placeholder' => 'Choisir un fichier',
                                        'value' => old('image_demande', $demande->image_demande),
                                    ])
                                    @include('shared.input', [
                                        'name' => 'nom_demande',
                                        'label' => 'Nom :',
                                        'placeholder' => 'Entrer le nom',
                                        'value' => old('nom_demande', $demande->nom_demande),
                                    ])
                                    @include('shared.input', [
                                        'name' => 'prenom_demande',
                                        'label' => 'Prénom :',
                                        'placeholder' => 'Entrer le prénom',
                                        'value' => old('prenom_demande', $demande->prenom_demande),
                                    ])
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    @include('shared.input', [
                                        'name' => 'cv',
                                        'label' => 'CV :',
                                        'placeholder' => 'CV',
                                        'value' => old('cv', $demande->cv),
                                    ])
                                    @include('shared.input', [
                                        'name' => 'lm',
                                        'label' => 'LM :',
                                        'placeholder' => '...',
                                        'value' => old('lm', $demande->lm),
                                    ])
                                    @include('shared.input', [
                                        'name' => 'autres',
                                        'label' => 'Autres :',
                                        'placeholder' => '....',
                                        'value' => old('autres', $demande->autres),
                                    ])
                                </div>
                            </div>
                            <div class="form-group">
                                @include('shared.input', [
                                    'type' => 'email',
                                    'name' => 'email_demande',
                                    'label' => 'Email :',
                                    'placeholder' => 'exemple@gmail.com',
                                    'value' => old('email_demande', $demande->email_demande),
                                ])
                            </div>
                            <div class="form-group">
                                @include('shared.select', [
                                    'name' => 'niveau_id',
                                    'label' => 'Niveau',
                                    'value' => old('niveau_id', $demande->niveau_id),
                                    'options' => $niveaux,
                                ])
                            </div>
                            <input type="hidden" name="etat_id" id="etat_id" value="1">
                            <input type="hidden" name="service_id" id="service_id" value="{{ $service->id }}">
                            <div class="col-lg-12">
                                <div class="section-top text-right text-center"> <!-- Ajout de la classe text-center -->
                                    <button type="submit"
                                        class="genric-btn info-border circle margin-top-5">Ajouter</button>
                                    <!-- Ajout de la classe margin-top-5 -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--================Blog Area =================-->
@endsection
