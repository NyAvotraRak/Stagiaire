@extends('admin.admin')

@section('title', 'Demandes')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {{-- <div class="container-fluid"> --}}
            <div class="col-12">
                <div class="">
                    <form action="" method="get" class="d-flex gap-2">
                        <div class="col-5">
                            <div class="mr-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nom" name="nom_demande"
                                        value="{{ old('nom_demande', $input['nom_demande'] ?? '') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="mr-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Prénom" name="prenom_demande"
                                        value="{{ old('prenom_demande', $input['prenom_demande'] ?? '') }}">
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
                <h3 class="mt-4 mb-4">Listes des demandes</h3>
                <div class="row justify-content-center">
                    <!-- /.col -->
                    @forelse ($demandes as $demande)
                        <div class="col-md-4">
                            <!-- Widget: user widget style 1 -->
                            <div class="card card-widget widget-user">
                                <div class="description-block">
                                    <h5 class="description-header">Status : {{ $demande->nom_etat }}</h5>
                                </div>
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-info">
                                    <h3 class="widget-user-username">{{ $demande->nom_demande }}
                                        {{ $demande->prenom_demande }}</h3>
                                </div>
                                <div class="widget-user-image">
                                    @if ($demande->image_demande)
                                        <img class="img-circle elevation-2"
                                            style="width: 100px; height: 100px; object-fit:cover;"
                                            src="{{ $demande->image_url() }}" alt="User Avatar">
                                    @endif
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-4 border-right">
                                            <!-- Première colonne de description -->
                                            <div class="description-block d-flex align-items-center text-muted">
                                                <span class="mr-2"><i class="fas fa-file-pdf"
                                                        style="color: rgb(255, 14, 14);"></i></span>
                                                @if ($demande->cv)
                                                    <span>
                                                        <a href="{{ $demande->cv_url() }}" target="_blank">CV</a></span>
                                                @endif
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 border-right">
                                            <!-- Deuxième colonne de description -->
                                            <div class="description-block d-flex align-items-center text-muted">
                                                <span class="mr-2"><i class="fas fa-file-pdf"
                                                        style="color: rgb(255, 14, 14);"></i></span>
                                                @if ($demande->lm)
                                                    <span>
                                                        <a href="{{ $demande->lm_url() }}" target="_blank">LM</a></span>
                                                @endif
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4">
                                            <!-- Troisième colonne de description -->
                                            <div class="description-block d-flex align-items-center text-muted">
                                                <span class="mr-2"><i class="fas fa-file-pdf"
                                                        style="color: rgb(255, 14, 14);"></i></span>
                                                @if ($demande->autres)
                                                    <span>
                                                        <a href="{{ $demande->autres_url() }}"
                                                            target="_blank">Autres</a></span>
                                                @endif
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 border-right">
                                            <!-- Première colonne de description -->
                                            <div class="description-block d-flex align-items-center">
                                                <span class="mr-2"><i class="fas fa-envelope"
                                                        style="color: rgb(0, 160, 5);"></i></span>
                                                <span class="text-muted text-truncate"
                                                    style="max-width: calc(100% - 24px);">
                                                    {{ $demande->email_demande }}</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 border-right">
                                            <!-- Deuxième colonne de description -->
                                            <div class="description-block d-flex align-items-center">
                                                <span class="mr-2"><i class="fas fa-building"
                                                        style="color: rgb(0, 160, 5);"></i></span>
                                                <span class="text-muted">{{ $demande->nom_service }}</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4">
                                            <!-- Troisième colonne de description -->
                                            <div class="description-block d-flex align-items-center">
                                                <span class="mr-2"><i class="fas fa-graduation-cap"
                                                        style="color: rgb(0, 160, 5);"></i></span>
                                                <span class="text-muted">{{ $demande->nom_niveau }}</span>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        @if (false)
                                            <h3>{{ $demande->service_id }}</h3>
                                            <h3>{{ $demande->etat_id }}</h3>
                                            <h3>{{ $demande->niveau_id }}</h3>
                                        @endif
                                    </div>
                                    <div class="col-sm-12 mt-3 border-top">
                                        <div class="form-group text-center mt-3">
                                            <div class="row justify-content-between">
                                                @if ($demande->nom_etat == 'En attente')
                                                    <div class="col">
                                                        <form action="{{ route('admin.demande.update', $demande) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('put')
                                                            <button class="btn btn-reset">
                                                                <span><i class="fas fa-handshake"
                                                                        style="color: rgb(106, 128, 252);"> Entretien</i>
                                                                </span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <div class="col">
                                                        <a
                                                            href="{{ route('admin.accepte.add', ['demande_id' => $demande->id]) }}">
                                                            <span><i class="fas fa-check-circle"
                                                                    style="color: rgb(0, 160, 5);"> Accepté</i></span>
                                                        </a>
                                                    </div>
                                                @endif
                                                <div class="col">
                                                    <form action="{{ route('admin.demande.destroy', $demande) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-reset">
                                                            <span><i class="fas fa-times-circle"
                                                                    style="color: rgb(255, 14, 14);"> Réfusé</i></span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- /.row -->
                                </div>

                            </div>
                            <!-- /.widget-user -->
                        </div>
                    @empty
                        <div>bonjour</div>
                    @endforelse
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button"
            aria-label="Scroll to top">
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>
    <!-- /.content-wrapper -->
@endsection
