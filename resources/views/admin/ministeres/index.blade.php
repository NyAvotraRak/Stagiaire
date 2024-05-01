@extends('admin.admin')

@section('title', 'Niveau d\'étude')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Minitère de l'Interieur</h1>
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
                                                Edité </i></span></a>
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
