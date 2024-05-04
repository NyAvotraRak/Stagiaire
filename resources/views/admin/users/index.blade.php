@extends('admin.admin')

@section('title', 'Tous les utilisateurs')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tous les Utilisateurs</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="row justify-content-center">
                        @foreach ($users as $user)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-7"><br>
                                                <h2 class="lead"><b>{{ $user->name }}</b></h2>
                                                <ul class="ml-4 mb-0 fa-ul text-muted"><br>
                                                    <li class="small">
                                                        @if ($user->service)
                                                            <span class="fa-li"><i class="fas fa-briefcase"
                                                                    style="color: rgb(0, 160, 5);"></i></span>{{ $user->service->nom_service }}
                                                        @else
                                                            <p>De aona ny fandeany ee</p>
                                                        @endif
                                                    </li>
                                                    <li class="small">
                                                        @if ($user->fonction)
                                                            <span class="fa-li"><i class="fas fa-lg fa-building"
                                                                    style="color: rgb(0, 160, 5);"></i></span>{{ $user->fonction->nom_fonction }}
                                                        @else
                                                            <p>De maninona</p>
                                                        @endif
                                                    </li>
                                                    <li class="small"><span class="fa-li"><i class="fas fa-envelope"
                                                                style="color: rgb(0, 160, 5);"></i></span>{{ $user->email }}
                                                    </li>
                                                    <li class="small"><span class="fa-li"><i class="fas fa-user"
                                                                style="color: rgb(0, 160, 5);"></i></span>{{ $user->fonction->role }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-5 text-center">
                                                @if ($user->image_users)
                                                    <img class="img-circle img-fluid"
                                                        style="width: 200px; height: 150px; object-fit:cover;"
                                                        src="{{ $user->image_url() }}" alt="">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row justify-content-end">
                                            <div class="">
                                                <form id="delete-form-{{ $user->id }}"
                                                    action="{{ route('admin.users.destroy', $user) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                <button class="btn btn-reset"
                                                    onclick="showConfirmationModal('{{ $user->id }}')">
                                                    <span class="mr-5"><i class="fas fa-trash-alt"
                                                            style="color: rgb(255, 14, 14);">Supprimé</i></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>

        </section>
        <!-- /.content -->

        <!-- Modal de confirmation de suppression -->
        <div id="confirmation-modal" class="modal">
            <div class="modal-content" style="background-color:rgba(246, 252, 246, 0)">
                <div class="row justify-content-center">
                    <!-- /.col -->
                    <div class="col-md-4">
                        <!-- Widget: user widget style 1 -->
                        <div class="card card-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header" style="background-color: rgb(255, 14, 14); color: white;">
                                <h3 class="">Êtes-vous sûr de vouloir supprimer cet utilisateur ?</h3>
                            </div>
                            <div class="card-footer">
                                <div class="col-sm-12 mt-3 border-top">
                                    <!-- Nouvelle colonne pour les icônes de refus et d'acceptation -->
                                    <div class="form-group text-center mt-3">
                                        <div>
                                            <button class="btn btn-reser" onclick="deleteItem('{{ $user->id }}')">
                                                <span class="mr-5"><i class="fas fa-check-circle"
                                                        style="color: rgb(255, 14, 14);">Oui, Supprimé</i></span>
                                            </button>

                                            <button class="btn btn-reser" onclick="hideConfirmationModal()">
                                                <span><i class="fas fa-times-circle"
                                                        style="color: rgb(0, 160, 5);">Annulé</i></span>
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
        <!-- /.content-wrapper -->

        <!-- JavaScript pour la confirmation de suppression -->
        <script>
            function showConfirmationModal(userId) {
                document.getElementById('confirmation-modal').style.display = 'block';
                // Mettre à jour l'action du formulaire de suppression avec l'ID de l'utilisateur
                document.getElementById('delete-form-' + userId).action = "{{ route('admin.users.destroy', '') }}" + "/" +
                    userId;
            }

            function hideConfirmationModal() {
                document.getElementById('confirmation-modal').style.display = 'none';
            }

            function deleteItem(userId) {
                document.getElementById('delete-form-' + userId).submit();
            }
        </script>
    </div>
    <!-- /.content-wrapper -->
@endsection
