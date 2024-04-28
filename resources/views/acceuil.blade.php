@extends('base')

@section('title', 'Accueil')

@section('content')
    <!-- Banner Area Starts -->
    <section class="banner-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <h1>Ministere de l'Interieur</h1>
                    <h3>Titre Ministere de l'Interieur</h3>
                    <p>Description du Ministere de l'Interieur</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Department Area Starts -->
    <section class="department-area section-padding4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-top text-center">
                        <h2>Nos services dans la Direction de Système d'Informations</h2>
                        <p>Historiques de la DSI..........</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="department-slider owl-carousel">
                        @foreach ($services as $service)
                            <div class="single-slide">
                                <div class="slide-img">
                                    @if ($service->image_service)
                                        <img style="width: 200px; height: 150px; object-fit:cover;"
                                            src="{{ $service->image_url() }}" alt="">
                                    @endif
                                </div>
                                <div class="single-department item-padding text-center">
                                    <h2>{{ $service->nom_service }}</h2>
                                    <p>{{ $service->description_service }}</p>
                                    <a href="{{ route('acceuil.show', ['slug' => $service->getSlug(), 'service' => $service]) }}"
                                        class="genric-btn info-border circle">Demander un stage</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
