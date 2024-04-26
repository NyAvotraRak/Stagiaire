@extends('admin.admin')

@section('title', $niveau->exists ? 'Editer un niveau' : 'Créer un niveau')

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
                            action="{{ route($niveau->exists ? 'admin.niveau.update' : 'admin.niveau.store', $niveau) }}"
                            method="post">
                            @csrf

                            @method($niveau->exists ? 'put' : 'post')
                            <div class="form-group form-inline">

                                @include('shared.input', [
                                    'name' => 'nom_niveau',
                                    'label' => 'Nom :',
                                    'placeholder' => 'Entrer le nom',
                                    'value' => old('nom_niveau', $niveau->nom_niveau),
                                ])
                            </div>
                            <div class="text-center"> <!-- Ajout de la classe "text-center" pour centrer le bouton -->
                                <button type="submit" class="genric-btn info-border circle margin-top-5">
                                    @if ($niveau->exists)
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
