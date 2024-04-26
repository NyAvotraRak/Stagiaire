@extends('admin.admin')

@section('title', $service->exists ? 'Editer un service' : 'Créer un service')

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
                            action="{{ route($service->exists ? 'admin.service.update' : 'admin.service.store', $service) }}"
                            method="post">
                            @csrf

                            @method($service->exists ? 'put' : 'post')
                            <div class="form-group form-inline">
                                @include('shared.input', [
                                    'name' => 'nom_service',
                                    'label' => 'Nom :',
                                    'placeholder' => 'Entrer le nom',
                                    'value' => old('nom_service', $service->nom_service),
                                ])
                                @include('shared.input', [
                                    'name' => 'image_service',
                                    'label' => 'Image :',
                                    'placeholder' => 'image',
                                    'value' => old('image_service', $service->image_service),
                                ])
                                @include('shared.input', [
                                    'type' => 'textarea',
                                    'name' => 'description_service',
                                    'label' => 'Description :',
                                    'placeholder' => 'desc...',
                                    'value' => old('description_service', $service->description_service),
                                ])
                            </div>
                            <div class="text-center"> <!-- Ajout de la classe "text-center" pour centrer le bouton -->
                                <button type="submit" class="genric-btn info-border circle margin-top-5">
                                    @if ($service->exists)
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
