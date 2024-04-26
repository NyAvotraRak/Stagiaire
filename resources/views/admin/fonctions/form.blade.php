@extends('admin.admin')

@section('title', $fonction->exists ? 'Editer un fonction' : 'Créer un fonction')

@section('content')
    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Ajout de la classe "justify-content-center" pour centrer horizontalement -->
                <div class="col-lg-8 posts-list">
                    <div class="comment-form">
                        <h4 class="text-center">@yield('title') : </h4>
                        <!-- Ajout de la classe "text-center" pour centrer le titre -->
                        <form class="vstack gap-5"
                            action="{{ route($fonction->exists ? 'admin.fonction.update' : 'admin.fonction.store', $fonction) }}"
                            method="post">
                            @csrf

                            @method($fonction->exists ? 'put' : 'post')
                            <div class="">
                                @include('shared.input', [
                                    'name' => 'nom_fonction',
                                    'label' => 'Nom :',
                                    'placeholder' => 'Entrer le nom',
                                    'value' => old('nom_fonction', $fonction->nom_fonction),
                                ])
                            <br>
                                @include('shared.select', ['name' => 'role', 'label' => 'Role :'])
                            </div>
                            <div class="text-center"> <!-- Ajout de la classe "text-center" pour centrer le bouton -->
                                <button type="submit" class="genric-btn info-border circle margin-top-5">
                                    @if ($fonction->exists)
                                        Modifier
                                    @else
                                        Créer
                                    @endif
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--================Blog Area =================-->
@endsection
