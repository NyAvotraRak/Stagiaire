@extends('admin.admin')

@section('title', 'Etat')

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
                        <a href="{{route('admin.etat.create')}}" class="genric-btn info-border circle">Ajouter</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="department-slider owl-carousel">
                        @foreach ($etats as $etat)
                            <div class="single-slide">
                                {{-- <div class="slide-img">
                                    <img src="{{ asset('images/finance.jpg') }}" alt="" class="img-fluid">
                                    <div class="hover-state">
                                        <a href="#"><i class=""></i></a>
                                    </div>
                                </div> --}}
                                <div class="single-department item-padding text-center">
                                    <h3>{{ $etat->nom_etat }}</h3>
                                    <a href="{{ route('admin.etat.edit', $etat) }}" class="genric-btn info-border circle">Modifier</a>
                                    <form action="{{ route('admin.etat.destroy', $etat) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="genric-btn info-border circle">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
