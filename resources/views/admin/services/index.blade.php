@extends('admin.admin')

@section('title', 'Département')

@section('content')

    <!-- Feature Area Starts -->
    <section class="feature-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-top text-center">
                        <h2>@yield('title')</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="section-top text-right">
                        <a href="{{ route('admin.service.create') }}" class="genric-btn info-border circle">Ajouter</a>
                    </div>
                </div>
            </div>
            <div class="container">
                <form action="" method="get" class="d-flex gap-2">
                    <input type="text" class="form-control" placeholder="Nom" name="nom_service"
                        value="{{ old('nom_service', $input['nom_service'] ?? '') }}">
                    <input type="text" class="form-control" placeholder="Mot cléf" name="description_service"
                        value="{{ old('description_service', $input['description_service'] ?? '') }}">
                    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
                </form>
            </div>
            <div class="row justify-content-center">
                @forelse ($services as $service)
                    <div class="col-lg-3 col-md-6">
                        <div class="single-feature text-center item-padding">
                            @if ($service->image_service)
                                <img src="{{$service->image_url()}}" alt="">
                            @endif
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
                    </div>
                @empty
                    <div class="col">
                        Aucun service ne correspond a votre recherche
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- Feature Area End -->
@endsection
