@extends('admin.admin')

@section('title', 'Département')

@section('content')

    <!-- Department Area Starts -->
    <section class="department-area section-padding4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-top text-center">
                        <h2>@yield('title')</h2>
                    </div>
                </div>
                <div class="">
                    <form action="" method="get" class="container d-flex gap-2">
                        <input type="text" placeholder="Nom service" name="nom_service"
                            value="{{ $input['nom_service'] ?? '' }}">
                        <input type="text" placeholder="Mot clef" name="description_service"
                            value="{{ $input['description_service'] ?? '' }}">
                        <button class="btn btn-primary btn-sm flex-grow-0">Rechercher</button>
                    </form>
                </div>
                <div class="col-lg-12">
                    <div class="section-top text-right">
                        <a href="{{ route('admin.service.create') }}" class="genric-btn info-border circle">Ajouter</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    {{-- <div class="department-slider owl-carousel"> --}}
                        <div class="single-slide">
                            @forelse ($services as $service)
                                <div class="slide-img">
                                    <img src="{{ asset('images/finance.jpg') }}" alt="" class="img-fluid">
                                    <div class="hover-state">
                                        <a href="#"><i class=""></i></a>
                                    </div>
                                </div>
                                <div class="single-department item-padding text-center">
                                    <h2>{{ $service->image_service }}</h2>
                                    <h3>{{ $service->nom_service }}</h3>
                                    <p>{{ $service->description_service }}</p>
                                    <a href="{{ route('admin.service.edit', $service) }}"
                                        class="genric-btn info-border circle">Modifier</a>
                                    <form action="{{ route('admin.service.destroy', $service) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="genric-btn info-border circle">Supprimer</button>
                                    </form>
                                </div>
                            @empty
                                <div class="col">
                                    Aucun service ne correspond a votre recherche
                                </div>
                            @endforelse
                        </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </section>
@endsection
