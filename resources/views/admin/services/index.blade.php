@extends('admin.admin')

@section('title', 'Département')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @if (Auth::user()->fonction->role == 'Administrateur')
                <div class="row-12 d-flex justify-content-start mb-3 ml-3">
                    <div class="section-top text-right">
                        <a href="{{ route('admin.service.create') }}">
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
                                    <h5 class="card-title">Service : {{ $totalServices }}</h5>
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
                                    <input type="text" class="form-control" placeholder="Nom" name="nom_service"
                                        value="{{ request('nom_service') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="mr-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Description"
                                        name="description_service" value="{{ request('description_service') }}">
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
                    @forelse ($services as $service)
                        <div class="col-md-4">
                            <!-- Widget: user widget style 1 -->
                            <div class="card card-widget widget-user">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                @if ($service->image_service)
                                    <div class="widget-user-header text-black"
                                        style="background: url('{{ $service->image_url() }}'); width: 100%; height: 100%;">
                                        <div class="widget-user-header text-black">
                                        </div>
                                    </div>
                                @else
                                    <div class="widget-user-header text-black" style="width: 100%; height: 100%;">

                                        <div class="alert alert-danger alert-dismissible">
                                            <h5><i class="icon fas fa-ban"></i> Aucune photo !</h5>
                                        </div>
                                    </div>
                                @endif
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-12 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">{{ $service->nom_service }}</h5>
                                                <p class="text-justify">{{ $service->description_service }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @if (Auth::user()->fonction->role == 'Administrateur')
                                        <div class="col-sm-12 mt-3 border-top">
                                            <!-- Nouvelle colonne pour les icônes de refus et d'acceptation -->
                                            <div
                                                class="form-group text-center mt-3 d-flex justify-content-between align-items-center">
                                                <div>
                                                    <a href="{{ route('admin.service.edit', $service) }}"
                                                        class="genric-btn info-border circle">
                                                        <span><i class="fas fa-edit" style="color: rgb(106, 128, 252);">
                                                                Editer</i></span>
                                                    </a>
                                                </div>
                                                <div>
                                                    <button class="btn btn-reset mr-2"
                                                        data-service-id="{{ $service->id }}"
                                                        onclick="showConfirmationModal(this)">
                                                        <span class="mr-2"><i class="fas fa-trash-alt"
                                                                style="color: rgb(255, 14, 14);"> Supprimer</i></span>
                                                    </button>
                                                    <form id="delete-form-{{ $service->id }}"
                                                        action="{{ route('admin.service.destroy', $service) }}"
                                                        method="post" style="display: none;">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-danger alert-dismissible">
                            <h5><i class="icon fas fa-ban"></i> Aucun service !</h5>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Confirmation Modal -->
        <div id="confirmation-modal" class="modal" style="display: none;">
            <div class="modal-content" style="background-color: rgba(246, 252, 246, 0)">
                <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card card-widget widget-user">
                                <div class="widget-user-header" style="background-color: rgb(255, 14, 14); color: white;">
                                    <h3>Êtes-vous sûr de vouloir supprimer ce service ?</h3>
                                </div>
                                <div class="card-footer">
                                    <div class="col-sm-12 mt-3 border-top">
                                        <div class="form-group text-center mt-3">
                                            <div>
                                                <button class="btn btn-reset" id="confirm-delete-btn">
                                                    <span class="mr-5"><i class="fas fa-check-circle"
                                                            style="color: rgb(255, 14, 14);"> Oui, Supprimer</i></span>
                                                </button>
                                                <button class="btn btn-reset" onclick="hideConfirmationModal()">
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

        <!-- JavaScript pour la confirmation de suppression -->
        <script>
            let serviceIdToDelete = null;

            function showConfirmationModal(button) {
                serviceIdToDelete = button.getAttribute('data-service-id');
                document.getElementById('confirmation-modal').style.display = 'block';
            }

            function hideConfirmationModal() {
                document.getElementById('confirmation-modal').style.display = 'none';
            }

            document.getElementById('confirm-delete-btn').addEventListener('click', function() {
                if (serviceIdToDelete) {
                    document.getElementById('delete-form-' + serviceIdToDelete).submit();
                }
            });
        </script>
    </div>
    <!-- /.content-wrapper -->
@endsection
