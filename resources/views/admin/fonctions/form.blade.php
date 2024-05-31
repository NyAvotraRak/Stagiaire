@extends('admin.admin')

@section('title', $fonction->exists ? 'Editer un fonction' : 'Créer un fonction')

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
                                <h3 class="card-title">Création d'une fonction</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="vstack gap-5"
                                action="{{ route($fonction->exists ? 'admin.fonction.update' : 'admin.fonction.store', $fonction) }}"
                                method="post">
                                @csrf

                                @method($fonction->exists ? 'put' : 'post')
                                <div class="card-body">
                                    @include('shared.input', [
                                        'name' => 'nom_fonction',
                                        'label' => 'Fonction :',
                                        'placeholder' => '...',
                                        'value' => old('nom_fonction', $fonction->nom_fonction),
                                    ])
                                    {{-- @include('shared.select', [
                                        'name' => 'role',
                                        'label' => 'Role :',
                                        'value' => old('role', $fonction->role),
                                    ]) --}}
                                    <input type="hidden" name="role" value="Utilisateur">
                                    @if ($fonction->exists)
                                        @include('shared.select', [
                                            'name' => 'service_id',
                                            'label' => 'Services :',
                                            'multiple' => false,
                                            'options' => $services,
                                            'selected' => $servicesSelectionnes,
                                        ])
                                    @else
                                        @include('shared.select', [
                                            'name' => 'service_id',
                                            'label' => 'Services :',
                                            'multiple' => true,
                                            'options' => $services,
                                            'selected' => $servicesSelectionnes,
                                        ])
                                    @endif

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-reset">
                                            @if ($fonction->exists)
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
