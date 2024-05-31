@extends('admin.admin')

@section('title', 'Tous les Stagiaires')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <section class="content">
                <div class="container-fluid">
                    <!-- Afficher le message de succès -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Succès !</h5>
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- Afficher le message d'erreur -->
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-ban"></i> Erreur !</h5>
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Nombre total du stagiaire : {{ $nombre_total_stagiaires }}</h5>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mx-auto">

                                            <div class="progress-group">
                                                En cours
                                                <span
                                                    class="float-right"><b>{{ $nombre_etat_id_3 }}</b>/{{ $nombre_total_stagiaires }}</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary"
                                                        style="width: {{ $pourcentage_etat_id_3 }}%"></div>
                                                </div>
                                            </div>
                                            <!-- /.progress-group -->
                                            <!-- /.progress-group -->
                                            <div class="progress-group">
                                                <span class="progress-text">Fin</span>
                                                <span
                                                    class="float-right"><b>{{ $nombre_etat_id_4 }}</b>/{{ $nombre_total_stagiaires }}</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-warning"
                                                        style="width: {{ $pourcentage_etat_id_4 }}%"></div>
                                                </div>
                                            </div>
                                            <div class="progress-group">
                                                <span class="progress-text">Terminé</span>
                                                <span
                                                    class="float-right"><b>{{ $nombre_etat_id_5 }}</b>/{{ $nombre_total_stagiaires }}</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-orange"
                                                        style="width: {{ $pourcentage_etat_id_5 }}%"></div>
                                                </div>
                                            </div>
                                            <div class="progress-group">
                                                <span class="progress-text">Abondonné</span>
                                                <span
                                                    class="float-right"><b>{{ $nombre_etat_id_6 }}</b>/{{ $nombre_total_stagiaires }}</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-danger"
                                                        style="width: {{ $pourcentage_etat_id_6 }}%"></div>
                                                </div>
                                            </div>

                                            <!-- /.progress-group -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>

                                <!-- ./card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!--/. container-fluid -->
            </section>
            {{-- <div class="container-fluid"> --}}
            <div class="col-12">
                <div class="">
                    <form action="" method="get" class="d-flex gap-2">
                        <div class="col-2">
                            <div class="mr-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nom" name="nom_stagiaire"
                                        value="{{ request('nom_stagiaire') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="mr-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Prénom" name="prenom_stagiaire"
                                        value="{{ request('prenom_stagiaire') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mr-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class=""></i>Début</span>
                                    </div>
                                    <input type="date" class="form-control" placeholder="date de debut" name="date_debut"
                                        value="{{ request('date_debut') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mr-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i>Fin</span>
                                    </div>
                                    <input type="date" class="form-control" placeholder="date fin" name="date_fin"
                                        value="{{ request('date_fin') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-2 d-flex justify-content-end">
                            <button class="btn btn-reset" type="submit" class="btn btn-primary btn-sm"><span
                                    class="input-group-text"><i class="fas fa-search"></i></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    @forelse ($stagiaires as $stagiaire)
                        <div class="col-md-4">
                            <!-- Widget: user widget style 1 -->
                            <div class="card card-widget widget-user">
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            @if ($stagiaire->image_demande)
                                                <img class="img-circle elevation-2"
                                                    style="width: 100px; height: 100px; object-fit:cover;"
                                                    src="{{ $stagiaire->image_url() }}" alt="User Avatar">
                                            @endif
                                        </div>
                                        <div class="col-sm-8">
                                            <!-- Deuxième colonne de description -->
                                            <div class="description-block">

                                                @if (Auth::user()->fonction->service->nom_service == $stagiaire->nom_service)
                                                    <div class="form-group text-center mt-3">
                                                        @if ($stagiaire->nom_etat == 'En cours')
                                                            <div class="d-flex justify-content-end mr-1">
                                                                <a href="javascript:void(0);"
                                                                    class="genric-btn info-border circle"
                                                                    onclick="showConfirmationModalStagiaire('{{ $stagiaire->theme }}')"
                                                                    id="delete-form-stagiaire-{{ $stagiaire->theme }}">
                                                                    <span><i class="fas fa-times-circle"
                                                                            style="color: rgb(255, 14, 14);"></i></span>
                                                                </a>

                                                            </div>
                                                        @endif
                                                        @if ($stagiaire->nom_etat == 'Fin' && $stagiaire->date_fin != now()->toDateString())
                                                            <a href="{{ route('admin.attestation.downloadPdfAttestation', ['stagiaire' => $stagiaire->theme]) }}"
                                                                class="genric-btn info-border circle">
                                                                <span><i class="fas fa-certificate"
                                                                        style="color: rgb(0, 160, 5);">
                                                                        Attestation </i></span></a>
                                                        @elseif ($stagiaire->nom_etat == 'Terminé' && $stagiaire->date_fin != now()->toDateString())
                                                            <a href="{{ route('admin.attestation.downloadPdfAttestation', ['stagiaire' => $stagiaire->theme]) }}"
                                                                class="genric-btn info-border circle">
                                                                <span><i class="fas fa-copy"
                                                                        style="color: rgb(255, 14, 14);">
                                                                        Duplicata </i></span></a>
                                                        @else
                                                            <div><br></div>
                                                        @endif
                                                    </div>
                                                @endif
                                                <h5 class="description-header">Status : {{ $stagiaire->nom_etat }}</h5>
                                                <div>
                                                    <p>{{ $stagiaire->nom_demande }} {{ $stagiaire->prenom_demande }}</p>
                                                    <p>{{ $stagiaire->nom_niveau }}</p>
                                                    <div class="row">
                                                        <div class="col-sm-4 border-right">
                                                            <!-- Première colonne de description -->
                                                            <div
                                                                class="description-block d-flex align-items-center text-muted">
                                                                <span class="mr-2"><i class="fas fa-file-pdf"
                                                                        style="color: rgb(255, 14, 14);"></i></span>
                                                                @if ($stagiaire->cv)
                                                                    <span>
                                                                        <a href="{{ $stagiaire->cv_url() }}"
                                                                            target="_blank">Cv</a></span>
                                                                @endif
                                                            </div>
                                                            <!-- /.description-block -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-sm-4 border-right">
                                                            <!-- Deuxième colonne de description -->
                                                            <div
                                                                class="description-block d-flex align-items-center text-muted">
                                                                <span class="mr-2"><i class="fas fa-file-pdf"
                                                                        style="color: rgb(255, 14, 14);"></i></span>
                                                                @if ($stagiaire->lm)
                                                                    <span>
                                                                        <a href="{{ $stagiaire->lm_url() }}"
                                                                            target="_blank">Lm</a></span>
                                                                @endif
                                                            </div>
                                                            <!-- /.description-block -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-sm-4">
                                                            <!-- Troisième colonne de description -->
                                                            <div
                                                                class="description-block d-flex align-items-center text-muted">
                                                                <span class="mr-2"><i class="fas fa-file-pdf"
                                                                        style="color: rgb(255, 14, 14);"></i></span>
                                                                @if ($stagiaire->autres)
                                                                    <span>
                                                                        <a href="{{ $stagiaire->autres_url() }}"
                                                                            target="_blank">Autres</a></span>
                                                                @endif
                                                            </div>
                                                            <!-- /.description-block -->
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <!-- Première colonne de description -->
                                                            <div class="description-block d-flex align-items-center">
                                                                <span class="mr-2"><i class="fas fa-envelope"
                                                                        style="color: rgb(0, 160, 5);"></i></span>
                                                                <span class="text-muted text-truncate"
                                                                    style="max-width: calc(100% - 24px);">
                                                                    {{ $stagiaire->email_demande }}</span>
                                                            </div>
                                                            <!-- /.description-block -->
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <p><strong>Service : </strong>{{ $stagiaire->nom_service }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <div class="col-sm-12 mt-3">
                                        <!-- Nouvelle colonne pour les icônes de refus et d'acceptation -->
                                        <div class="form-group text-center">
                                            <div>
                                                <p><strong><i class="fas fa-book" style="color: rgb(0, 153, 255);">
                                                            Theme :</i></strong> {{ $stagiaire->theme }}</p>
                                            </div>
                                            <div class="text-justify">
                                                <p>{{ $stagiaire->description_theme }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-info col-sm-12 mt-3">
                                    <div class="col-sm-12 mt-3">
                                        <!-- Nouvelle colonne pour les icônes de refus et d'acceptation -->
                                        <div class="form-group text-center">
                                            <div>
                                                <p><i class="far fa-calendar"></i><strong> Date début :</strong>
                                                    {{ $stagiaire->date_debut }}
                                                    , <i class="far fa-calendar"></i><strong> Date fin :</strong>
                                                    {{ $stagiaire->date_fin }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->

                            </div>
                            <!-- /.widget-user -->
                        </div>
                        {{-- <hr style="background-color: rgba(211, 211, 211, 0.219);"> --}}
                    @empty
                        <div class="alert alert-danger alert-dismissible">
                            <h5><i class="icon fas fa-ban"></i> Aucune stagiaire !</h5>
                        </div>
                    @endforelse
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button"
            aria-label="Scroll to top">
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>
    <!-- /.content-wrapper -->
    <div id="confirmation-modal" class="modal">
        <div class="modal-content" style="background-color: rgba(246, 252, 246, 0)">
            <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card card-widget widget-user">
                            <div class="widget-user-header" style="background-color: rgb(255, 14, 14); color: white;">
                                <h3 class="">Êtes-vous sûr de vouloir supprimer ce stagiaire ?</h3>
                            </div>
                            <div class="card-footer">
                                <div class="col-sm-12 mt-3 border-top">
                                    <div class="form-group text-center mt-3">
                                        <div>
                                            <button class="btn btn-reset" onclick="deleteItemStagiaire()">
                                                <span class="mr-5"><i class="fas fa-check-circle"
                                                        style="color: rgb(255, 14, 14);">
                                                        Oui, Supprimer
                                                    </i></span>
                                            </button>
                                            <button class="btn btn-reset" onclick="hideConfirmationModalStagiaire()">
                                                <span><i class="fas fa-times-circle" style="color: rgb(0, 160, 5);">
                                                        Annuler</i></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let stagiaireIdToDelete = null;

        function showConfirmationModalStagiaire(stagiaireId) {
            stagiaireIdToDelete = stagiaireId;
            document.getElementById('confirmation-modal').style.display = 'block';
        }

        function hideConfirmationModalStagiaire() {
            document.getElementById('confirmation-modal').style.display = 'none';
        }

        function deleteItemStagiaire() {
            if (stagiaireIdToDelete) {
                // Construisez l'URL avec le stagiaireIdToDelete
                let url = `/admin/abondonné/${stagiaireIdToDelete}`;

                // Créez un formulaire et soumettez-le
                let form = document.createElement('form');
                form.action = url;
                form.method = 'get'; // Ou 'post' si nécessaire

                let csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endsection
