
<div class="card-body">
        <div class="mt-3">
            <div class="">
                <div class="row  mt-4">
                    <div class="col-6">
                        <h1>ATTESTATION</h1>
                    </div>
                    <div class="col information">
                        <!-- <div class="single-doctor mb-4 mb-lg-0"> -->
                        <div class="content-area">
                            <div class="doctor-name text-center">
                                <h3>{{ $stagiaire->demande->nom_demande }}</h3>
                                <h4>{{ $stagiaire->demande->prenom_demande }}</h4>
                                <h6>{{ $stagiaire->demande->niveau->nom_niveau }}</h6>
                            </div>
                            <div class="doctor-text text-center">
                                <p>{{ $stagiaire->demande->etat->nom_etat }}</p>
                                <p>{{ $stagiaire->demande->service->nom_service }}</p>
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
                <p class="pt-3">{{ $stagiaire->description_theme }}</p>
                <p>Subdue whales void god which living don't midst lesser yielding over lights whose.
                    Cattle
                    greater brought sixth fly den dry good tree isn't seed stars were the boring.</p>
                <p><strong>Date debut :</strong> {{ $stagiaire->date_debut }} , <strong>Date fin
                        :</strong> {{ $stagiaire->date_fin }}</p>
            </div>
        </div>
        <hr style="background-color: rgba(211, 211, 211, 0.219);">
</div>
