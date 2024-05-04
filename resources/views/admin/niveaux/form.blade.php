@extends('admin.admin')

@section('title', $niveau->exists ? 'Editer un niveau' : 'Créer un niveau')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Lorem ipsum dolor sit amet.</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="vstack gap-5"
                                action="{{ $niveau->exists ? route('admin.niveau.update', $niveau) : route('admin.niveau.store') }}"
                                method="post" enctype="multipart/form-data">
                                @csrf

                                @method($niveau->exists ? 'put' : 'post')
                                <div class="card-body">
                                    @include('shared.input', [
                                        'name' => 'nom_niveau',
                                        'label' => 'Nom :',
                                        'placeholder' => '...',
                                        'value' => old('nom_niveau', $niveau->nom_niveau),
                                    ])
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <div class="text-center">
                                        <!-- Ajout de la classe "text-center" pour centrer le bouton -->
                                        <button type="submit" class="btn btn-reset">
                                            @if ($niveau->exists)
                                                <span><i class="fas fa-check-circle" style="color: rgb(106, 128, 252);">
                                                        Modifié</i></span>
                                            @else
                                                <span><i class="fas fa-check-circle" style="color: rgb(106, 128, 252);">
                                                        Créé</i></span>
                                            @endif
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
