@extends('admin.admin')

@section('title', $etat->exists ? 'Editer un etat' : 'Créer un etat')

@section('content')

    {{-- <div id="formu" class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 my-5">
                <h3>@yield('title') :</h3>
                <br>
                <form class="vstack gap-5"
                    action="{{ route($etat->exists ? 'admin.etat.update' : 'admin.etat.store', $etat) }}" method="post">
                    @csrf

                    @method($etat->exists ? 'put' : 'post')

                    @include('shared.input', [
                        'name' => 'nom_etat',
                        'label' => 'Nom :',
                        'placeholder' => 'Entrer le nom',
                        'value' => $etat->nom_etat,
                    ])
                    <button class="genric-btn info-border circle">
                        @if ($etat->exists)
                            Modifier
                        @else
                            Créer
                        @endif
                    </button>
                </form>
            </div>
        </div>
    </div> --}}
    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Ajout de la classe "justify-content-center" pour centrer horizontalement -->
                <div class="col-lg-8 posts-list">
                    <div class="comment-form">
                        <h4 class="text-center">@yield('title') :</h4>
                        <!-- Ajout de la classe "text-center" pour centrer le titre -->
                        <form class="vstack gap-5"
                            action="{{ route($etat->exists ? 'admin.etat.update' : 'admin.etat.store', $etat) }}"
                            method="post">
                            @csrf

                            @method($etat->exists ? 'put' : 'post')

                            <div class="form-group form-inline">
                                <div class="form-group col-lg-6 col-md-6 name">
                                    @include('shared.input', [
                                        'name' => 'nom_etat',
                                        'placeholder' => 'etat',
                                        'value' => $etat->nom_etat,
                                    ])
                                </div>
                            </div>
                            <div class="text-center"> <!-- Ajout de la classe "text-center" pour centrer le bouton -->
                                <button class="template-btn">
                                    @if ($etat->exists)
                                        Modifier
                                    @else
                                        Créer
                                    @endif
                                </button>
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
