@extends('admin.admin')

@section('title', 'Fonction')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @if (Auth::user()->fonction->role == 'Administrateur')
                <div class="row-12 d-flex justify-content-start mb-3 ml-3">
                    <div class="section-top text-right">
                        <a href="{{ route('admin.fonction.create') }}">
                            <span><i class="fas fa-plus-circle" style="color: rgb(106, 128, 252);"> Nouveau</i></span>
                        </a>
                    </div>
                </div>
            @endif
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
                                    <h5 class="card-title">Fonction : {{ $totalFonctions }}</h5>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mx-auto">

                                            @foreach ($fonctionsParService as $fonctionParService)
                                                {{ $services->find($fonctionParService->service_id)->nom_service }}
                                                <span
                                                    class="float-right"><b>{{ $fonctionParService->total }}</b>/{{ $totalFonctions }}</span>
                                                <div class="progress-group">
                                                    {{-- {{ $service->nom_service }} --}}
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-primary"
                                                            style="width: {{ $fonctionParService->pourcentage }}%"></div>
                                                    </div>
                                                </div>
                                            @endforeach
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
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nom" name="nom_fonction"
                                        value="{{ request('nom_fonction') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="mr-5">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Role" name="role"
                                        value="{{ request('role') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-reset" type="submit" class="btn btn-primary btn-sm">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row justify-content-center">
                    @forelse ($fonctions as $fonction)
                        <div class="col-md-4">
                            <!-- Widget: user widget style 1 -->
                            <div class="card card-widget widget-user">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-info"><br>
                                    <h3 class="widget-user-username">{{ $fonction->nom_fonction }}</h3>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-12 border-right d-flex justify-content-center">
                                            <div class="description-block d-flex align-items-center text-center">
                                                <span class="mr-2"><i class="fas fa-user"
                                                        style="color: rgb(0, 160, 5);"></i></span>
                                                <span class="text-muted">{{ $fonction->role }}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 border-right d-flex justify-content-center">
                                            <div class="description-block d-flex align-items-center text-center">
                                                <span class="mr-2"><i class="fas fa-building"
                                                        style="color: rgb(0, 160, 5);"></i></span>
                                                <span class="text-muted">{{ $fonction->service->nom_service }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-3 border-top">
                                        <div
                                            class="form-group text-center mt-3 d-flex justify-content-between align-items-center">

                                            @if (Auth::user()->fonction->role == 'Administrateur')
                                                @if ($fonction->role == 'Utilisateur')
                                                    <div>
                                                        <a href="{{ route('admin.fonction.edit', $fonction) }}"
                                                            class="genric-btn info-border circle">
                                                            <span><i class="fas fa-edit" style="color: rgb(106, 128, 252);">
                                                                    Editer</i></span>
                                                        </a>
                                                    </div>
                                                    <div class="mx-3">
                                                        @if ($fonction->role == 'Utilisateur')
                                                            <button class="btn btn-reset mr-2"
                                                                onclick="showConfirmationModalFonction('{{ $fonction->id }}')">
                                                                <span class="mr-2">
                                                                    <i class="fas fa-trash-alt"
                                                                        style="color: rgb(255, 14, 14);">
                                                                        Supprimer</i>
                                                                </span>
                                                            </button>
                                                            <form id="delete-form-fonction-{{ $fonction->id }}"
                                                                action="{{ route('admin.fonction.destroy', $fonction) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-danger alert-dismissible">
                            <h5><i class="icon fas fa-ban"></i> Aucune fonction !</h5>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button"
            aria-label="Scroll to top">
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmation-modal" class="modal">
        <div class="modal-content" style="background-color: rgba(246, 252, 246, 0)">
            <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card card-widget widget-user">
                            <div class="widget-user-header" style="background-color: rgb(255, 14, 14); color: white;">
                                <h3 class="">Êtes-vous sûr de vouloir supprimer cette fonction ?</h3>
                            </div>
                            <div class="card-footer">
                                <div class="col-sm-12 mt-3 border-top">
                                    <div class="form-group text-center mt-3">
                                        <div>
                                            <button class="btn btn-reser" onclick="deleteItemFonction()">
                                                <span class="mr-5">
                                                    <i class="fas fa-check-circle" style="color: rgb(255, 14, 14);"> Oui,
                                                        Supprimer</i>
                                                </span>
                                            </button>
                                            <button class="btn btn-reser" onclick="hideConfirmationModalFonction()">
                                                <span>
                                                    <i class="fas fa-times-circle" style="color: rgb(0, 160, 5);">
                                                        Annuler</i>
                                                </span>
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
        let fonctionIdToDelete = null;

        function showConfirmationModalFonction(fonctionId) {
            fonctionIdToDelete = fonctionId;
            document.getElementById('confirmation-modal').style.display = 'block';
        }

        function hideConfirmationModalFonction() {
            document.getElementById('confirmation-modal').style.display = 'none';
        }

        function deleteItemFonction() {
            if (fonctionIdToDelete) {
                document.getElementById('delete-form-fonction-' + fonctionIdToDelete).submit();
            }
        }
    </script>
@endsection
