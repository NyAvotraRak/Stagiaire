@extends('admin.admin')

@section('title', 'Fonction')

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
                <div class="col-lg-12">
                    <div class="section-top text-right">
                        <a href="{{route('admin.fonction.create')}}" class="genric-btn info-border circle">Ajouter</a>
                    </div>
                </div>
                <div class="">
                    <form action="" method="get" class="container d-flex gap-2">
                        <input type="text" placeholder="nom fonction" name="nom_fonction"
                            value="{{ $input['nom_fonction'] ?? '' }}">
                        <input type="text" placeholder="role" name="role"
                            value="{{ $input['role'] ?? '' }}">
                        <button class="btn btn-primary btn-sm flex-grow-0">Rechercher</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    {{-- <div class="department-slider owl-carousel"> --}}
                        @forelse ($fonctions as $fonction)
                            <div class="single-slide">
                                <div class="slide-img">
                                    <img src="{{ asset('images/finance.jpg') }}" alt="" class="img-fluid">
                                    <div class="hover-state">
                                        <a href="#"><i class=""></i></a>
                                    </div>
                                </div>
                                <div class="single-department item-padding text-center">
                                    <h3>{{ $fonction->nom_fonction }}</h3>
                                    <p>{{ $fonction->role }}</p>
                                    <a href="{{ route('admin.fonction.edit', $fonction) }}" class="genric-btn info-border circle">Modifier</a>
                                    <form action="{{ route('admin.fonction.destroy', $fonction) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="genric-btn info-border circle">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                            @empty
                                <div class="col">
                                    Aucune fonction ne correspond a votre recherche
                                </div>
                            @endforelse
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </section>
@endsection
