@extends('base')

@section('title', 'Accueil')

@section('content')
    <div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('success') }}
            </div>
        @endif
        <!-- Afficher le message d'erreur -->
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Erreur !</h5>
                {{ session('error') }}
            </div>
        @endif
    </div>
    <section style="padding-top: 7rem;">
        <div class="bg-holder" style="background-image:url(assets/img/hero/hero-bg.svg);">
        </div>
        <!--/.bg-holder-->

        <div class="container">
            <div class="row align-items-center">
                @foreach ($ministeres as $ministere)
                    <div class="col-md-5 col-lg-6 order-0 order-md-1 text-end"><img class="pt-7 pt-md-0 hero-img"
                            src="{{ $ministere->image_url() }}" alt="hero-header" /></div>
                    <div class="col-md-7 col-lg-6 text-md-start text-center py-6">
                        <h1 class="hero-title">
                            {{ $ministere->titre }}</h1>
                        <p class="mb-4 fw-medium">{{ $ministere->description_ministere }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="pt-5 pt-md-9" id="service">

        <div class="container">
            <div class="mb-7 text-center">
                <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Nos services dans la Direction de
                    Système d'Informations</h3>
            </div>
            <div class="row justify-content-center">
                @foreach ($services as $service)
                    <div class="col-lg-3 col-sm-6 mb-6">
                        <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
                            <div class="card-body p-xxl-5 p-4">
                                @if ($service->image_service)
                                    <img style="width: 200px; height: 150px; object-fit:cover;"
                                        src="{{ $service->image_url() }}" alt="">
                                @endif
                                <h4 class="mb-3">{{ $service->nom_service }}</h4>
                                <p class="mb-0 fw-medium">{{ $service->description_service }}</p>
                                <a href="{{ route('acceuil.show', ['slug' => $service->getSlug(), 'service' => $service]) }}"
                                    class="genric-btn info-border circle">
                                    <span><i class="fas fa-check-circle" style="color: rgb(106, 128, 252);"> Postuler</i>
                                    </span></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div><!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->
@endsection
