@extends('base')

@section('title', 'Accueil')

@section('content')

    <!-- Department Area Starts -->
    <section class="department-area section-padding4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-top text-center">
                        <h2>Département populaire(Client)aaaa</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="department-slider owl-carousel">
                        @foreach ($services as $service)
                            <div class="single-slide">
                                <div class="slide-img">
                                    <img src="{{ asset('images/finance.jpg') }}" alt="" class="img-fluid">
                                    <div class="hover-state">
                                        <a href="#"><i class=""></i></a>
                                    </div>
                                </div>
                                <div class="single-department item-padding text-center">
                                    <h2>{{ $service->image_service }}</h2>
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
    <!-- Department Area end -->
@endsection
