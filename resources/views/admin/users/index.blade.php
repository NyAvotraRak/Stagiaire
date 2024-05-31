@extends('admin.admin')

@section('title', 'Tous les utilisateurs')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
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
                                <h5 class="card-title">Utilisateurs : {{ $totalUsers }}</h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mx-auto">
                                        @foreach ($totalUsersByFonction as $fonction => $data)
                                            <div class="progress-group">
                                                {{ $fonction }}
                                                <span
                                                    class="float-right"><b>{{ $data['total'] }}</b>/{{ $totalUsers }}</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary"
                                                        style="width: {{ number_format($data['pourcentage'], 2) }}%"></div>
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
            </div><!-- /.container-fluid -->
            <div class="col-6   ">
                <div class="">
                    <form action="" method="get" class="d-flex gap-2">
                        <div class="col-5">
                            <div class="mr-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nom" name="nom_user"
                                        value="{{ request('nom_user') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="mr-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Prénom" name="prenom_user"
                                        value="{{ request('prenom_user') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="mr-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Role" name="role"
                                        value="{{ request('role') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="mr-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Fonction" name="nom_fonction"
                                        value="{{ request('nom_fonction') }}">
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
            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="row justify-content-center">
                        @forelse ($users as $user)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-7"><br>
                                                <h2 class="lead"><b>{{ $user->nom_user }}</b></h2>
                                                <h3 class="lead"><b>{{ $user->prenom_user }}</b></h3>
                                                <ul class="ml-4 mb-0 fa-ul text-muted"><br>
                                                    <li class="small">
                                                        @if ($user->fonction)
                                                            <span class="fa-li"><i class="fas fa-lg fa-building"
                                                                    style="color: rgb(0, 160, 5);"></i></span>{{ $user->fonction->service->nom_service }}
                                                        @else
                                                            <div class="alert alert-danger alert-dismissible">
                                                                <h5><i class="icon fas fa-ban"></i> Aucun service associé !
                                                                </h5>
                                                            </div>
                                                        @endif
                                                    </li>
                                                    <li class="small">
                                                        @if ($user->fonction)
                                                            <span class="fa-li"><i class="fas fa-briefcase"
                                                                    style="color: rgb(0, 160, 5);"></i></span>{{ $user->fonction->nom_fonction }}
                                                        @else
                                                            <div class="alert alert-danger alert-dismissible">
                                                                <h5><i class="icon fas fa-ban"></i> Aucune fonction
                                                                    assoiciée !</h5>
                                                            </div>
                                                        @endif
                                                    </li>
                                                    <li class="small"><span class="fa-li"><i class="fas fa-envelope"
                                                                style="color: rgb(0, 160, 5);"></i></span>{{ $user->email }}
                                                    </li>
                                                    <li class="small"><span class="fa-li"><i class="fas fa-user"
                                                                style="color: rgb(0, 160, 5);"></i></span>{{ $user->fonction->role }}
                                                    </li>
                                                    <form method="POST"
                                                        action="{{ route('updateValidation', ['id' => $user->id]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        @if ($user->fonction->role == 'Utilisateur')
                                                            <!-- Statut de validation -->
                                                            <li class="small">
                                                                <label class="checkbox-container">
                                                                    <!-- Case à cocher stylisée -->
                                                                    <input type="checkbox" class="valider-user-checkbox"
                                                                        name="valider_user"
                                                                        {{ $user->valider_user ? 'checked' : '' }}>
                                                                    <span class="checkmark"></span>
                                                                    {{ $user->valider_user ? 'Compte validé' : 'Compte non validé' }}
                                                                </label>
                                                            </li>
                                                        @endif
                                                    </form>
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
                                            @if ($user->fonction->role == 'Utilisateur')
                                                <div class="">
                                                    <form id="delete-form-user-{{ $user->id }}"
                                                        action="{{ route('admin.users.destroy', $user) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                    <button class="btn btn-reset"
                                                        onclick="showConfirmationModalUser('{{ $user->id }}')">
                                                        <span class="mr-5"><i class="fas fa-trash-alt"
                                                                style="color: rgb(255, 14, 14);">Supprimer</i></span>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-danger alert-dismissible">
                                <h5><i class="icon fas fa-ban"></i> Aucun Utilisateur !</h5>
                            </div>
                        @endforelse
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
        </section>
        <!-- /.content -->
        <!-- /.content-wrapper -->
        <!-- JavaScript pour la soumission automatique du formulaire -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.valider-user-checkbox').change(function() {
                    $(this).closest('form').submit();
                });
            });
        </script>
    </div>
    <!-- Confirmation Modal -->
    <div id="confirmation-modal" class="modal">
        <div class="modal-content" style="background-color: rgba(246, 252, 246, 0)">
            <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card card-widget widget-user">
                            <div class="widget-user-header" style="background-color: rgb(255, 14, 14); color: white;">
                                <h3 class="">Êtes-vous sûr de vouloir supprimer cet utilisateur ?</h3>
                            </div>
                            <div class="card-footer">
                                <div class="col-sm-12 mt-3 border-top">
                                    <div class="form-group text-center mt-3">
                                        <div>
                                            <button class="btn btn-reser" onclick="deleteItemUser()">
                                                <span class="mr-5">
                                                    <i class="fas fa-check-circle" style="color: rgb(255, 14, 14);"> Oui,
                                                        Supprimer</i>
                                                </span>
                                            </button>
                                            <button class="btn btn-reser" onclick="hideConfirmationModalUser()">
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
        let userIdToDelete = null;

        function showConfirmationModalUser(userId) {
            userIdToDelete = userId;
            document.getElementById('confirmation-modal').style.display = 'block';
        }

        function hideConfirmationModalUser() {
            document.getElementById('confirmation-modal').style.display = 'none';
        }

        function deleteItemUser() {
            if (userIdToDelete) {
                document.getElementById('delete-form-user-' + userIdToDelete).submit();
            }
        }
    </script>
    <!-- /.content-wrapper -->
@endsection
