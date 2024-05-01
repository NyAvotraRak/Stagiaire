@extends('admin.admin')

@section('title', 'Département')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {{-- <div class="container-fluid"> --}}
            <div class="row-12 d-flex justify-content-start mb-3 ml-3">
                <div class="section-top text-right">
                    <a href="{{ route('admin.service.create') }}">
                        <span><i class="fas fa-plus-circle" style="color: rgb(106, 128, 252);">
                                Nouveau</i>
                        </span></a>
                </div>
            </div>
            <div class="col-12">
                <div class="">
                    <form action="" method="get" class="d-flex gap-2">
                        <div class="col-5">
                            <div class="mr-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nom" name="nom_service"
                                        value="{{ old('nom_service', $input['nom_service'] ?? '') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="mr-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Description"
                                        name="description_service"
                                        value="{{ old('description_service', $input['description_service'] ?? '') }}">
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
            <div class="container-fluid">

                <h3 class="mt-4 mb-4">Nos Services</h3>

                <div class="row justify-content-center">
                    @forelse ($services as $service)
                        <div class="col-md-4">
                            <!-- Widget: user widget style 1 -->
                            <div class="card card-widget widget-user">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                @if ($service->image_service)
                                    <div class="widget-user-header text-black"
                                        style="background: url('{{ $service->image_url() }}'); width: 100%; height: 100%;">
                                        <div class="widget-user-header text-black">
                                            <h5 class="widget-user-desc text-right">
                                                <strong>{{ $service->nom_service }}</strong>
                                            </h5>
                                        </div>
                                    </div>
                                @endif
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-12 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">Desciption : </h5>
                                                <p class="text-justify">{{ $service->description_service }}</p>
                                            </div>
                                            <!-- /.col -->
                                            <!-- Add the bg color to the header using any of the bg-* classes -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-3 border-top">
                                    <!-- Nouvelle colonne pour les icônes de refus et d'acceptation -->
                                    <div
                                        class="form-group text-center mt-3 d-flex justify-content-between align-items-center">
                                        <div>
                                            <a href="{{ route('admin.service.edit', $service) }}"
                                                class="genric-btn info-border circle">
                                                <span><i class="fas fa-edit" style="color: rgb(106, 128, 252);">
                                                        Edité</i>
                                                </span>
                                            </a>
                                        </div>
                                        <div class=""> <!-- Ajout de la classe mx-3 pour l'espace horizontal -->
                                            <form action="{{ route('admin.service.destroy', $service) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-reset">
                                                    <span class="mr-2"><i class="fas fa-trash-alt"
                                                            style="color: rgb(255, 14, 14);"> Supprimé</i></span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                        <!-- /.col -->
                    @empty
                        <div class="row-12">
                            Eo Mafana ah....
                        </div>
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
    <!-- /.content-wrapper -->
@endsection
