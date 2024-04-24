@extends('admin.admin')

@section('title', 'Demandes')

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
            <div class="row">
                <div class="col-lg-12">
                    <div class="department-slider owl-carousel">
                        @foreach ($demandes as $demande)
                            <div class="single-slide">
                                <div class="slide-img">
                                    <img src="{{ asset('images/finance.jpg') }}" alt="" class="img-fluid">
                                    <div class="hover-state">
                                        <a href="#"><i class=""></i></a>
                                    </div>
                                </div>
                                <div class="single-department item-padding text-center">
                                    <h3>{{ $demande->nom_demande }}</h3>
                                    <h3>{{ $demande->prenom_demande }}</h3>
                                    <h3>{{ $demande->email_demande }}</h3>
                                    <h2>{{ $demande->image_demande }}</h2>
                                    <h3>{{ $demande->cv }}</h3>
                                    <h3>{{ $demande->lm }}</h3>
                                    <h3>{{ $demande->autres }}</h3>
                                    <h3>{{ $demande->nom_service }}</h3>
                                    <h3>{{ $demande->nom_etat }}</h3>
                                    <h3>{{ $demande->nom_niveau }}</h3>

                                    <!-- Masquer les valeurs -->
                                    @if (false)
                                        <p>{{ $demande->service_id }}</p>
                                        <p>{{ $demande->etat_id }}</p>
                                        <p>{{ $demande->niveau_id }}</p>
                                    @endif

                                    @if ($demande->nom_etat == 'En attente')
                                        <form action="{{ route('admin.demande.update', $demande) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <button class="genric-btn info-border circle">Passer un entretien</button>
                                        </form>
                                    @else
                                        <a href="{{route('admin.accepte.add', ['demande_id' => $demande->id])}}" class="genric-btn info-border circle">Accepter</a>
                                    @endif
                                    <form action="{{ route('admin.demande.destroy', $demande) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="genric-btn info-border circle">Refuser</button>
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
