@extends('admin.admin')

@section('title', 'Niveau d\'étude')

@section('content')
    <!-- Content Wrapper. Contains page content -->
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
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            @foreach ($ministeres as $ministere)
                <div class="card card-solid">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="col-12">
                                    @if ($ministere->image_ministere)
                                        <img src="{{ $ministere->image_url() }}" style="height: 500px; object-fit:cover;"
                                            class="product-image" alt="Product Image">
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <h3 class="my-3">{{ $ministere->titre }}</h3>
                                <p>{{ $ministere->description_ministere }}.</p>
                                <div class="col-12 col-sm-6">
                                    <a href="{{ route('admin.ministere.edit', $ministere) }}" class="template-btn mt-3">
                                        <span><i class="fas fa-edit" style="color: rgb(106, 128, 252);">
                                                Editer </i></span></a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            @endforeach
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
