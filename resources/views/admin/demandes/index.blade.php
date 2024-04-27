@extends('admin.admin')

@section('title', 'Demandes')

@section('content')
    <!-- Specialist Area Starts -->
    <section class="specialist-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-top text-center">
                        <h2>@yield('title')</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium sapiente nulla voluptatem
                            corporis, mollitia adipisci, perferendis beatae illum dolor quia at a fugit vel, minus quae
                            facilis. Obcaecati, voluptates nemo?</p>
                    </div>
                    <div class="container">
                        <form action="" method="get" class="d-flex gap-2">
                            <input type="text" class="form-control" placeholder="Nom" name="nom_demande"
                                value="{{ old('nom_demande', $input['nom_demande'] ?? '') }}">
                            <input type="text" class="form-control" placeholder="Prénom" name="prenom_demande"
                                value="{{ old('prenom_demande', $input['prenom_demande'] ?? '') }}">
                            <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
                        </form>
                    </div>


                </div>
            </div>
            <div class="row justify-content-center">
                @forelse ($demandes as $demande)
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-doctor mb-4 mb-lg-0">
                            <div class="doctor-img">
                                @if ($demande->image_demande)
                                    <img src="{{ $demande->image_url() }}" alt="">
                                @endif
                            </div>
                            <div class="content-area">
                                <div class="doctor-name text-center">
                                    <p><strong>Status : </strong>{{ $demande->nom_etat }}</p>
                                    <h3>{{ $demande->nom_demande }}</h3>
                                    <h3>{{ $demande->id }}</h3>
                                    <h3>{{ $demande->prenom_demande }}</h3>
                                    <p>{{ $demande->email_demande }}</p>
                                    <p>{{ $demande->image_demande }}</p>
                                    <p>{{ $demande->cv }}</p>
                                    <p>{{ $demande->lm }}</p>
                                    <p>{{ $demande->autres }}</p>
                                    <p>{{ $demande->nom_service }}</p>
                                    <p>{{ $demande->nom_niveau }}</p>
                                    @if (false)
                                        <p>{{ $demande->service_id }}</p>
                                        <p>{{ $demande->etat_id }}</p>
                                        <p>{{ $demande->niveau_id }}</p>
                                    @endif
                                </div>
                                <div class="doctor-text text-center">
                                    <ul class="doctor-icon d-inline-flex">
                                        <li>
                                            @if ($demande->nom_etat == 'En attente')
                                                <form action="{{ route('admin.demande.update', $demande) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('put')
                                                    <button class="genric-btn info-border circle">Entretien</button>
                                                </form>
                                            @else
                                                <a class="genric-btn info-border circle"
                                                    href="{{ route('admin.accepte.add', ['demande_id' => $demande->id]) }}">Accepter</a>
                                            @endif
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.demande.destroy', $demande) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="genric-btn info-border circle">Refuser</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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
    <!-- Specialist Area Starts -->
@endsection
