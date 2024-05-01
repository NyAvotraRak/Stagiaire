@extends('admin.admin')

@section('title', 'Niveau d\'étude')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {{-- <div class="container-fluid"> --}}
            <div class="row-12 d-flex justify-content-start mb-3 ml-3">
                <div class="section-top text-right">
                    <a href="{{ route('admin.niveau.create') }}">
                        <span><i class="fas fa-plus-circle" style="color: rgb(106, 128, 252);">
                                Nouveau</i>
                        </span></a>
                </div>
            </div>
            <div class="col-12">
                <div class="">
                    <form action="" method="get" class="d-flex gap-2">
                        <div class="col-6">
                            <div class="mr-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nom" name="nom_niveau"
                                        value="{{ old('nom_niveau', $input['nom_niveau'] ?? '') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <button class="btn btn-reset" type="submit" class="btn btn-primary btn-sm"><span
                                    class="input-group-text"><i class="fas fa-search"></i></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row mt-4 justify-content-center">
                                    @forelse ($niveaux as $niveau)
                                        <div class="col-sm-4 mb-3">
                                            <div class="position-relative p-3"
                                                style="height: 180px; border-radius: 30px; background-color: rgb(240, 239, 239); box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);">
                                                <div class="ribbon-wrapper ribbon-xl">
                                                    <div class="ribbon text-xl" style=" background-color: rgb(207, 206, 206)">
                                                        {{ $niveau->nom_niveau }}
                                                    </div>
                                                </div><br><br><br>
                                                <div class="col-sm-10 mt-3">
                                                    <!-- Nouvelle colonne pour les icônes de refus et d'acceptation -->
                                                    <div class="form-group text-center mt-3">
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <form action="{{ route('admin.niveau.destroy', $niveau) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button class="btn btn-reset mr-2">
                                                                    <span class="mr-2"><i class="fas fa-trash-alt"
                                                                            style="color: rgb(255, 14, 14);"></i>
                                                                        Supprimé</span>
                                                                </button>
                                                            </form>
                                                            <a href="{{ route('admin.niveau.edit', $niveau) }}"
                                                                class="genric-btn info-border circle">
                                                                <span><i class="fas fa-edit"
                                                                        style="color: rgb(106, 128, 252);"></i> Edité</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @empty
                                        <div class="col">
                                            <h2>Ambany jerene aingakaingana tena</h2>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
