@extends('admin.admin')

@section('title', 'Niveau d\'étude')

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
            </div>
            <div class="col-lg-12">
                <div class="section-top text-right">
                    <a href="{{ route('admin.niveau.create') }}" class="genric-btn info-border circle">Ajouter</a>
                </div>
            </div>
            <div class="">
                <form action="" method="get" class="container d-flex gap-2">
                    <input type="text" placeholder="Nom niveau" name="nom_niveau"
                        value="{{ $input['nom_niveau'] ?? '' }}">
                    <button class="btn btn-primary btn-sm flex-grow-0">Rechercher</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                {{-- <div class="department-slider owl-carousel"> --}}
                    @forelse ($niveaux as $niveau)
                        <div class="single-slide">
                            {{-- <div class="slide-img">
                                    <img src="{{ asset('images/finance.jpg') }}" alt="" class="img-fluid">
                                    <div class="hover-state">
                                        <a href="#"><i class=""></i></a>
                                    </div>
                                </div> --}}
                            <div class="single-department item-padding text-center">
                                <h3>{{ $niveau->nom_niveau }}</h3>
                                <a href="{{ route('admin.niveau.edit', $niveau) }}"
                                    class="genric-btn info-border circle">Modifier</a>
                                <form action="{{ route('admin.niveau.destroy', $niveau) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="genric-btn info-border circle">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col">
                            Aucun niveau ne correspond a votre recherche
                        </div>
                    @endforelse
                {{-- </div> --}}
            </div>
        </div>
        </div>
    </section>
@endsection
