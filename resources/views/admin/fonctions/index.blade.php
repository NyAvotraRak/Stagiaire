@extends('admin.admin')

@section('title', 'Fonction')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row-12 d-flex justify-content-start mb-3 ml-3">
                <div class="section-top text-right">
                    <a href="{{ route('admin.fonction.create') }}">
                        <span><i class="fas fa-plus-circle" style="color: rgb(106, 128, 252);"> Nouveau</i></span>
                    </a>
                </div>
            </div>
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
                                        value="{{ old('nom_fonction', $input['nom_fonction'] ?? '') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="mr-5">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="role" name="role"
                                        value="{{ old('role', $input['role'] ?? '') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
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

                <h3 class="mt-4 mb-4">Toutes les fonctions</h3>

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
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <div class="col-sm-12 mt-3 border-top">
                                        <!-- Nouvelle colonne pour les icônes de refus et d'acceptation -->
                                        <div
                                            class="form-group text-center mt-3 d-flex justify-content-between align-items-center">
                                            <div>
                                                <a href="{{ route('admin.fonction.edit', $fonction) }}"
                                                    class="genric-btn info-border circle">
                                                    <span><i class="fas fa-edit" style="color: rgb(106, 128, 252);">
                                                            Edité</i></span>
                                                </a>
                                            </div>
                                            <div class="mx-3">
                                                <button class="btn btn-reset mr-2"
                                                    onclick="showConfirmationModalFonction()">
                                                    <span class="mr-2">
                                                        <i class="fas fa-trash-alt" style="color: rgb(255, 14, 14);">
                                                            Supprimé</i>
                                                    </span>
                                                </button>
                                                <form id="delete-form-fonction"
                                                    action="{{ route('admin.fonction.destroy', $fonction) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                    @empty
                        <div>aiza ze olona ooo</div>
                    @endforelse
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmation-modal-fonction" class="modal">
        <div class="modal-content" style="background-color:rgba(246, 252, 246, 0)">
            <div class="row justify-content-center">
                <!-- /.col -->
                <div class="col-md-4">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header" style="background-color: rgb(255, 14, 14); color: white;">
                            <h3 class="">Êtes-vous sûr de vouloir supprimer cet élément ?</h3>
                        </div>
                        <div class="card-footer">
                            <div class="col-sm-12 mt-3 border-top">
                                <!-- Nouvelle colonne pour les icônes de refus et d'acceptation -->
                                <div class="form-group text-center mt-3">
                                    <div>
                                        <button class="btn btn-reser" onclick="deleteItemFonction()">
                                            <span class="mr-5">
                                                <i class="fas fa-check-circle" style="color: rgb(255, 14, 14);"> Oui,
                                                    Supprimé</i>
                                            </span>
                                        </button>
                                        <button class="btn btn-reser" onclick="hideConfirmationModalFonction()">
                                            <span>
                                                <i class="fas fa-times-circle" style="color: rgb(0, 160, 5);"> Annulé</i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript pour la confirmation de suppression -->
    <script>
        function showConfirmationModalFonction() {
            document.getElementById('confirmation-modal-fonction').style.display = 'block';
        }

        function hideConfirmationModalFonction() {
            document.getElementById('confirmation-modal-fonction').style.display = 'none';
        }

        function deleteItemFonction() {
            document.getElementById('delete-form-fonction').submit();
        }
    </script>
@endsection
