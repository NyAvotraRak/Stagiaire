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
            </div>
            @foreach ($stagiaires as $stagiaire)
                <div class="row justify-content-around ">

                    <div class="col-5 my-3 card">
                        <div class="card-body">
                            <div class="mt-3">
                                <div class="">
                                    <div class="row  mt-4">
                                        <div class="col-6">
                                            <div class="doctor-img border-radius-1">
                                                <img src="{{ asset('images/doctor1.jpg') }}" alt="" class="img-fluid">
                                            </div>

                                        </div>
                                        <div class="col information">
                                            <!-- <div class="single-doctor mb-4 mb-lg-0"> -->
                                            <div class="content-area">
                                                <div class="doctor-name text-center">
                                                    @if ($stagiaire->nom_etat == 'Fin')
                                                        <a href="{{ route('admin.attestation.downloadPdfAttestation', ['stagiaire' => $stagiaire->theme, 'stagiaire' => $date_fin->$stagiaire->date_fin]) }}"
                                                            class="genric-btn info-border circle">Attestation</a>
                                                    @endif
                                                    <h3>{{ $stagiaire->nom_demande }}</h3>
                                                    <h4>{{ $stagiaire->prenom_demande }}</h4>
                                                    <h6>{{ $stagiaire->nom_niveau }}</h6>
                                                </div>
                                                <div class="doctor-text text-center">
                                                    <p>{{ $stagiaire->nom_etat }}</p>
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
                                    <h3 class="text-center text-decoration-underline">{{ $stagiaire->theme }}</h3>
                                    <p class="">{{ $stagiaire->description_theme }}</p>
                                    <p><strong>Date debut :</strong> {{ $stagiaire->date_debut }} , <strong>Date fin
                                            :</strong> {{ $stagiaire->date_fin }}</p>
                                    <p><strong>Date actuelle :</strong> {{ now() }}</p>

                                    @if ($stagiaire->date_fin == now())
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
                <hr style="background-color: rgba(211, 211, 211, 0.219);">
            @endforeach

        </div>
    </section>
    <!-- Welcome Area End -->
@endsection
