@extends('admin.admin')

@section('title', 'Accepter une demande')

@section('content')
    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Ajout de la classe "justify-content-center" pour centrer horizontalement -->
                <div class="col-lg-8 posts-list">
                    <div class="comment-form">
                        <div class="form-group">
                            <p><strong>Nom : </strong>{{ $demande->nom_demande }}</p>
                            <p><strong>Prenom : </strong>{{ $demande->prenom_demande }}</p>
                        </div>
                        <h4 class="text-center">@yield('title') : </h4>
                        <!-- Ajout de la classe "text-center" pour centrer le titre -->
                        <form class="vstack gap-2" action="{{ route('admin.accepte.store', $demande) }}" method="post">

                            @csrf
                            <div class="form-group form-inline">
                                <div class="form-group col-lg-6 col-md-6 name">
                                    @include('shared.input', [
                                        'name' => 'theme',
                                        'label' => 'Theme :',
                                        'placeholder' => 'Entrer le theme...',
                                        'value' => old('theme', $stagiaire->theme),
                                    ])
                                </div>
                                <div class="form-group col-lg-6 col-md-6 email">
                                    @include('shared.input', [
                                        'type' => 'date',
                                        'name' => 'date_debut',
                                        'label' => 'Date de debut :',
                                        'value' => old('date_debut', $stagiaire->date_debut),
                                    ])
                                    @include('shared.input', [
                                        'type' => 'nummber',
                                        'name' => 'dure',
                                        'label' => 'Durer en mois :',
                                    ])
                                </div>
                            </div>
                            <div class="form-group">
                                @include('shared.input', [
                                    'type' => 'textarea',
                                    'name' => 'description_theme',
                                    'label' => 'Description :',
                                    'value' => old('description_theme', $stagiaire->description_theme),
                                ])
                            </div>
                            <div class="text-center"> <!-- Ajout de la classe "text-center" pour centrer le bouton -->
                                <button type="submit" class="genric-btn info-border circle margin-top-5">Valider</button>
                                <!-- Modification de l'élément "a" en "button" -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--================Blog Area =================-->
@endsection
