@extends('admin.admin')

@section('title', 'Niveau d\'étude')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row-12 d-flex justify-content-start mb-3 ml-3">
                <div class="section-top text-right">
                    <a href="{{ route('admin.niveau.create') }}">
                        <span><i class="fas fa-plus-circle" style="color: rgb(106, 128, 252);"> Nouveau</i></span>
                    </a>
                </div>
            </div>
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
                                    <h5 class="card-title">Nombre niveau : {{ $totalNiveaux }}</h5>
                                </div>
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
                <form action="" method="get" class="d-flex gap-2">
                    <div class="col-6">
                        <div class="mr-5">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Nom" name="nom_niveau"
                                    value="{{ request('nom_niveau') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <button class="btn btn-reset" type="submit" class="btn btn-primary btn-sm">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </button>
                    </div>
                </form>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="row mt-4 justify-content-center">
                                    @forelse ($niveaux as $niveau)
                                        <div class="col-sm-4 mb-3">
                                            <div class="position-relative p-3"
                                                style="height: 180px; border-radius: 30px; background-color: rgb(240, 239, 239); box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);">
                                                <div class="ribbon-wrapper ribbon-xl">
                                                    <div class="ribbon text-xl"
                                                        style="background-color: rgb(207, 206, 206)">
                                                        {{ $niveau->nom_niveau }}
                                                    </div>
                                                </div><br><br><br>
                                                <div class="col-sm-10 mt-3">
                                                    <div class="form-group text-center mt-3">
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <form id="delete-form-{{ $niveau->id }}"
                                                                action="{{ route('admin.niveau.destroy', $niveau) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                            <a href="{{ route('admin.niveau.edit', $niveau) }}"
                                                                class="genric-btn info-border circle">
                                                                <span><i class="fas fa-edit"
                                                                        style="color: rgb(106, 128, 252);"> Edité</i></span>
                                                            </a>
                                                            <button class="btn btn-reset ml-5"
                                                                onclick="showConfirmationModal('{{ $niveau->id }}')">
                                                                <span class="mr-2">
                                                                    <i class="fas fa-trash-alt"
                                                                        style="color: rgb(255, 14, 14);"> Supprimé</i>
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="alert alert-danger alert-dismissible">
                                            <h5><i class="icon fas fa-ban"></i> Aucun niveau !</h5>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div id="confirmation-modal" class="modal">
        <div class="modal-content" style="background-color: rgba(246, 252, 246, 0)">
            <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card card-widget widget-user">
                            <div class="widget-user-header" style="background-color: rgb(255, 14, 14); color: white;">
                                <h3 class="">Êtes-vous sûr de vouloir supprimer cet élément ?</h3>
                            </div>
                            <div class="card-footer">
                                <div class="col-sm-12 mt-3 border-top">
                                    <div class="form-group text-center mt-3">
                                        <div>
                                            <button class="btn btn-reset" id="confirm-delete-btn">
                                                <span class="mr-5"><i class="fas fa-check-circle"
                                                        style="color: rgb(255, 14, 14);"> Oui, Supprimé</i></span>
                                            </button>
                                            <button class="btn btn-reset" onclick="hideConfirmationModal()">
                                                <span><i class="fas fa-times-circle" style="color: rgb(0, 160, 5);">
                                                        Annulé</i></span>
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
        let niveauIdToDelete = null;

        function showConfirmationModal(niveauId) {
            niveauIdToDelete = niveauId;
            document.getElementById('confirmation-modal').style.display = 'block';
        }

        function hideConfirmationModal() {
            document.getElementById('confirmation-modal').style.display = 'none';
        }

        document.getElementById('confirm-delete-btn').addEventListener('click', function() {
            if (niveauIdToDelete) {
                document.getElementById('delete-form-' + niveauIdToDelete).submit();
            }
        });
    </script>
@endsection
