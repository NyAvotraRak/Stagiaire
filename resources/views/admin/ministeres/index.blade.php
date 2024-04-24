@extends('admin.admin')

@section('title', 'Ministere')

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
                        {{-- <a href="{{route('admin.ministere.create')}}" class="genric-btn info-border circle">Ajouter</a> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="department-slider owl-carousel">
                        @foreach ($ministeres as $ministere)
                            <div class="single-slide">
                                <div class="slide-img">
                                    <img src="{{ asset('images/finance.jpg') }}" alt="" class="img-fluid">
                                    <div class="hover-state">
                                        <a href="#"><i class=""></i></a>
                                    </div>
                                </div>
                                <div class="single-department item-padding text-center">
                                    <h2>{{ $ministere->image_ministere }}</h2>
                                    <h3>{{ $ministere->titre }}</h3>
                                    <p>{{ $ministere->description_ministere }}</p>
                                    <a href="{{ route('admin.ministere.edit', $ministere) }}" class="genric-btn info-border circle">Modifier</a>
                                    {{-- <form action="{{ route('admin.ministere.destroy', $ministere) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="genric-btn info-border circle">Supprimer</button>
                                    </form> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
