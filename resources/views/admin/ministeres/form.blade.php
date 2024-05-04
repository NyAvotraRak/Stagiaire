@extends('admin.admin')

@section('title', $ministere->exists ? 'Editer un ministere' : 'Créer un ministere')

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
                                action="{{ route($ministere->exists ? 'admin.ministere.update' : 'admin.ministere.store', $ministere) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf

                                @method($ministere->exists ? 'put' : 'post')
                                <div class="card-body">
                                    {{-- @include('shared.input', [
                                        'type' => 'file',
                                        'name' => 'image_ministere',
                                        'label' => 'Image :',
                                        'placeholder' => 'image',
                                        'value' => old('image_ministere', $ministere->image_url()),
                                    ]) --}}
                                    <label for="image_ministere">Logo :</label>
                                    <input id="image_ministere" name="image_ministere" type="file" class="form-control"
                                        accept="image/*">
                                    @if ($ministere->image_url())
                                        <img src="{{ $ministere->image_url() }}" alt="Image actuelle" class="mt-2"
                                            style="max-width: 200px;">
                                    @endif
                                    @include('shared.input', [
                                        'name' => 'titre',
                                        'label' => 'Nom :',
                                        'placeholder' => 'Entrer le nom',
                                        'value' => old('titre', $ministere->titre),
                                    ])
                                    @include('shared.input', [
                                        'type' => 'textarea',
                                        'name' => 'description_ministere',
                                        'label' => 'Description :',
                                        'placeholder' => 'desc...',
                                        'value' => old('description_ministere', $ministere->description_ministere),
                                    ])
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <div class="text-center">
                                        <!-- Ajout de la classe "text-center" pour centrer le bouton -->
                                        <button type="submit" class="btn btn-reset">
                                            @if ($ministere->exists)
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
