@extends('admin.admin')

@section('title', $ministere->exists ? 'Editer un ministere' : 'Créer un ministere')

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
                            action="{{ route($ministere->exists ? 'admin.ministere.update' : 'admin.ministere.store', $ministere) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf

                            @method($ministere->exists ? 'put' : 'post')
                            <div class="form-group form-inline">
                                @include('shared.input', [
                                    'type' => 'file',
                                    'name' => 'image_ministere',
                                    'label' => 'Image :',
                                    'placeholder' => 'image',
                                    'value' => old('image_ministere', $ministere->image_ministere)
                                ])
                                @include('shared.input', [
                                    'name' => 'titre',
                                    'label' => 'Nom :',
                                    'placeholder' => 'Entrer le nom',
                                    'value' => old('titre', $ministere->titre),
                                ])
                                @include('shared.input', [
                                    'type' => 'textarea',
                                    'name' => 'description_ministere',
                                    'label' => 'Description :',
                                    'placeholder' => 'desc...',
                                    'value' => old('description_ministere', $ministere->description_ministere)
                                ])
                            </div>
                            <div class="text-center"> <!-- Ajout de la classe "text-center" pour centrer le bouton -->
                                <button type="submit" class="genric-btn info-border circle margin-top-5">
                                    @if ($ministere->exists)
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
