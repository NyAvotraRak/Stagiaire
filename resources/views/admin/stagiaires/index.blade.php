@extends('admin.admin')

@section('title', 'Tous les Stagiaires')

@section('content')
    <!-- Welcome Area Starts -->
    <section class="welcome-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-top text-center">
                        <h2>Stagiaire en cours(Admin)</h2>
                    </div>
                </div>
                <div class="container">
                    <form action="" method="get" class="d-flex gap-2">
                        <input type="text" class="form-control" placeholder="Nom" name="nom_stagiaire"
                            value="{{ old('nom_stagiaire', $input['nom_stagiaire'] ?? '') }}">
                        <input type="text" class="form-control" placeholder="Prénom" name="prenom_stagiaire"
                            value="{{ old('prenom_stagiaire', $input['prenom_stagiaire'] ?? '') }}">
                        <div class="form-group">
                            <label for="date_debut">Date de début</label>
                            <input type="date" class="form-control" id="date_debut" name="date_debut"
                                placeholder="Sélectionnez une date"
                                value="{{ old('date_debut', $input['date_debut'] ?? '') }}">
                        </div>
                        <div class="form-group">
                            <label for="date_fin">Date de fin</label>
                            <input type="date" class="form-control" id="date_fin" name="date_fin"
                                placeholder="Sélectionnez une date" value="{{ old('date_fin', $input['date_fin'] ?? '') }}">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
                    </form>

                </div>
            </div>
            @forelse ($stagiaires as $stagiaire)
                <div class="row justify-content-around ">

                    <div class="col-5 my-3 card">
                        <div class="card-body">
                            <div class="mt-3">
                                <div class="">
                                    <div class="row  mt-4">
                                        <div class="col-6">
                                            <div class="doctor-img border-radius-1">
                                                @if ($stagiaire->image_demande)
                                                    <img src="{{ $stagiaire->image_url() }}" alt="">
                                                @endif
                                            </div>

                                        </div>
                                        <div class="col information">
                                            <!-- <div class="single-doctor mb-4 mb-lg-0"> -->
                                            <div class="content-area">
                                                <div class="doctor-name text-center">
                                                    @if ($stagiaire->nom_etat == 'Fin')
                                                        <a href="{{ route('admin.attestation.downloadPdfAttestation', ['stagiaire_theme' => $stagiaire->theme, 'stagiaire_date_fin' => $stagiaire->date_fin]) }}"
                                                            class="genric-btn info-border circle">Attestation</a>
                                                    @endif
                                                    <h3>Nom : {{ $stagiaire->nom_demande }}</h3>
                                                    <h4>Prenom : {{ $stagiaire->prenom_demande }}</h4>
                                                    <h6>Niveau : {{ $stagiaire->nom_niveau }}</h6>
                                                    <h6>Email : {{ $stagiaire->email_demande }}</h6>
                                                    @if ($stagiaire->cv)
                                                        <img src="{{ $stagiaire->image_url() }}" alt="">
                                                    @endif
                                                    @if ($stagiaire->lm)
                                                        <img src="{{ $stagiaire->image_url() }}" alt="">
                                                    @endif
                                                    @if ($stagiaire->autres)
                                                        <img src="{{ $stagiaire->image_url() }}" alt="">
                                                    @endif
                                                </div>
                                                <div class="doctor-text text-center">
                                                    <p>Status : {{ $stagiaire->nom_etat }}</p>
                                                    <p>Service : {{ $stagiaire->nom_service }}</p>
                                                </div>
                                            </div>
                                            <!-- </div> -->

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <!--<div class="col-lg-7">-->
                            <div id="description" class="col">
                                <!-- <div class="welcome-text mt-5 mt-lg-0"> -->
                                <div class="m-4 text-secondary">
                                    <h3 class="text-center text-decoration-underline">Theme : {{ $stagiaire->theme }}</h3>
                                    <p class="">Description : {{ $stagiaire->description_theme }}</p>
                                    <p><strong>Date debut :</strong> {{ $stagiaire->date_debut }} , <strong>Date fin
                                            :</strong> {{ $stagiaire->date_fin }}</p>
                                    <p><strong>Date actuelle :</strong> {{ now() }}</p>

                                    @if ($stagiaire->date_fin === now())
                                        <?php
                                        // Mise à jour de l'état_id à 4 si la date de fin est égale à la date actuelle
                                        $stagiaire->update(['etat_id' => 4]);
                                        ?>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <hr style="background-color: rgba(211, 211, 211, 0.219);"> --}}
            @empty
                <div class="col">
                    Aucun stagiaire ne correspond a votre recherche
                </div>
            @endforelse

        </div>
    </section>
    <!-- Welcome Area End -->
@endsection
