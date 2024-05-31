@extends('admin.admin')

@section('title', 'Demandes')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {{-- <div class="container-fluid"> --}}
            <!-- Main content -->
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
                                    <h5 class="card-title">Demande : {{ $nombre_demandes }}</h5>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mx-auto">

                                            <div class="progress-group">
                                                En Attente
                                                <span
                                                    class="float-right"><b>{{ $nombre_etat_id_1 }}</b>/{{ $nombre_demandes }}</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary"
                                                        style="width: {{ $pourcentage_etat_id_1 }}%"></div>
                                                </div>
                                            </div>
                                            <!-- /.progress-group -->
                                            <!-- /.progress-group -->
                                            <div class="progress-group">
                                                <span class="progress-text">Entretien</span>
                                                <span
                                                    class="float-right"><b>{{ $nombre_etat_id_2 }}</b>/{{ $nombre_demandes }}</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success"
                                                        style="width: {{ $pourcentage_etat_id_2 }}%"></div>
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
            <!-- /.content -->
            <div class="col-12">
                <div class="">
                    <form action="" method="get" class="d-flex gap-2">
                        <div class="col-5">
                            <div class="mr-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nom" name="nom_demande"
                                        value="{{ request('nom_demande') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="mr-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Prénom" name="prenom_demande"
                                        value="{{ request('prenom_demande') }}">
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
                    <!-- /.col -->
                    @forelse ($demandes as $demande)
                        <div class="col-md-4">
                            <!-- Widget: user widget style 1 -->
                            <div class="card card-widget widget-user">
                                <div class="description-block">
                                    <h5 class="description-header">Status : {{ $demande->nom_etat }}</h5>
                                </div>
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-info">
                                    <h3 class="widget-user-username">{{ $demande->nom_demande }}
                                        {{ $demande->prenom_demande }}</h3>
                                </div>
                                <div class="widget-user-image">
                                    @if ($demande->image_demande)
                                        <img class="img-circle elevation-2"
                                            style="width: 100px; height: 100px; object-fit:cover;"
                                            src="{{ $demande->image_url() }}" alt="User Avatar">
                                    @endif
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-4 border-right">
                                            <!-- Première colonne de description -->
                                            <div class="description-block d-flex align-items-center text-muted">
                                                <span class="mr-2"><i class="fas fa-file-pdf"
                                                        style="color: rgb(255, 14, 14);"></i></span>
                                                @if ($demande->cv)
                                                    <span>
                                                        <a href="{{ $demande->cv_url() }}" target="_blank">CV</a></span>
                                                @endif
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 border-right">
                                            <!-- Deuxième colonne de description -->
                                            <div class="description-block d-flex align-items-center text-muted">
                                                <span class="mr-2"><i class="fas fa-file-pdf"
                                                        style="color: rgb(255, 14, 14);"></i></span>
                                                @if ($demande->lm)
                                                    <span>
                                                        <a href="{{ $demande->lm_url() }}" target="_blank">LM</a></span>
                                                @endif
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4">
                                            <!-- Troisième colonne de description -->
                                            <div class="description-block d-flex align-items-center text-muted">
                                                <span class="mr-2"><i class="fas fa-file-pdf"
                                                        style="color: rgb(255, 14, 14);"></i></span>
                                                @if ($demande->autres)
                                                    <span>
                                                        <a href="{{ $demande->autres_url() }}"
                                                            target="_blank">Autres</a></span>
                                                @endif
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 border-right">
                                            <!-- Première colonne de description -->
                                            <div class="description-block d-flex align-items-center">
                                                <span class="mr-2"><i class="fas fa-envelope"
                                                        style="color: rgb(0, 160, 5);"></i></span>
                                                <span class="text-muted text-truncate"
                                                    style="max-width: calc(100% - 24px);">
                                                    {{ $demande->email_demande }}</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 border-right">
                                            <!-- Deuxième colonne de description -->
                                            <div class="description-block d-flex align-items-center">
                                                <span class="mr-2"><i class="fas fa-building"
                                                        style="color: rgb(0, 160, 5);"></i></span>
                                                <span class="text-muted">{{ $demande->nom_service }}</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4">
                                            <!-- Troisième colonne de description -->
                                            <div class="description-block d-flex align-items-center">
                                                <span class="mr-2"><i class="fas fa-graduation-cap"
                                                        style="color: rgb(0, 160, 5);"></i></span>
                                                <span class="text-muted">{{ $demande->nom_niveau }}</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        @if (false)
                                            <h3>{{ $demande->service_id }}</h3>
                                            <h3>{{ $demande->etat_id }}</h3>
                                            <h3>{{ $demande->niveau_id }}</h3>
                                        @endif
                                    </div>
                                    <div class="col-sm-12 mt-3 border-top">
                                        <div class="form-group text-center mt-3">
                                            <div class="row justify-content-between">
                                                @if ($demande->nom_etat == 'En attente')
                                                    <div class="col">
                                                        <form action="{{ route('admin.demande.update', $demande) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('put')
                                                            <button class="btn btn-reset">
                                                                <span><i class="fas fa-handshake"
                                                                        style="color: rgb(106, 128, 252);"> Entretien</i>
                                                                </span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <div class="col">
                                                        <a
                                                            href="{{ route('admin.accepte.add', ['demande_id' => $demande->id]) }}">
                                                            <span><i class="fas fa-check-circle"
                                                                    style="color: rgb(0, 160, 5);"> Accepter</i></span>
                                                        </a>
                                                    </div>
                                                @endif
                                                <div class="col">
                                                    <form action="{{ route('admin.demande.destroy', $demande) }}"
                                                        id="delete-form-demande-{{ $demande->id }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                    <button class="btn btn-reset"
                                                        onclick="showConfirmationModalDemande('{{ $demande->id }}')">
                                                        <span><i class="fas fa-times-circle"
                                                                style="color: rgb(255, 14, 14);"> Réfuser</i></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- /.row -->
                                </div>

                            </div>
                            <!-- /.widget-user -->
                        </div>
                    @empty
                        <div class="alert alert-danger alert-dismissible">
                            <h5><i class="icon fas fa-ban"></i> Aucune demande !</h5>
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
    <!-- Confirmation Modal -->
    <div id="confirmation-modal" class="modal">
        <div class="modal-content" style="background-color: rgba(246, 252, 246, 0)">
            <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card card-widget widget-user">
                            <div class="widget-user-header" style="background-color: rgb(255, 14, 14); color: white;">
                                <h3 class="">Êtes-vous sûr de vouloir supprimer cette demande ?</h3>
                            </div>
                            <div class="card-footer">
                                <div class="col-sm-12 mt-3 border-top">
                                    <div class="form-group text-center mt-3">
                                        <div>
                                            <button class="btn btn-reset" onclick="deleteItemDemande()">
                                                <span class="mr-5"><i class="fas fa-check-circle"
                                                        style="color: rgb(255, 14, 14);">
                                                        Oui,
                                                        Suprimer</i></span></button>
                                            <button class="btn btn-reser" onclick="hideConfirmationModalDemande()">
                                                <span><i class="fas fa-times-circle" style="color: rgb(0, 160, 5);">
                                                        Annuler
                                                    </i></span></button>
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
        let demandeIdToDelete = null;

        function showConfirmationModalDemande(demandeId) {
            demandeIdToDelete = demandeId;
            document.getElementById('confirmation-modal').style.display = 'block';
        }

        function hideConfirmationModalDemande() {
            document.getElementById('confirmation-modal').style.display = 'none';
        }

        function deleteItemDemande() {
            if (demandeIdToDelete) {
                document.getElementById('delete-form-demande-' + demandeIdToDelete).submit();
            }
        }
    </script>
@endsection
