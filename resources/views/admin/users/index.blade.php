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
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-reset">
                                                        <span class="mr-5"><i class="fas fa-trash-alt"
                                                                style="color: rgb(255, 14, 14);">Supprimé</i></span></button>
                                                </form>
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
    </div>
    <!-- /.content-wrapper -->
@endsection
