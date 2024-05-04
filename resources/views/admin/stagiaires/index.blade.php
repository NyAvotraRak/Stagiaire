@extends('admin.admin')

@section('title', 'Tous les Stagiaires')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            {{-- <div class="container-fluid"> --}}
            <div class="col-12">
                <div class="">
                    <form action="" method="get" class="d-flex gap-2">
                        <div class="col-2">
                            <div class="mr-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nom" name="nom_stagiaire"
                                        value="{{ old('nom_stagiaire', $input['nom_stagiaire'] ?? '') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="mr-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Prénom" name="prenom_stagiaire"
                                        value="{{ old('prenom_stagiaire', $input['prenom_stagiaire'] ?? '') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mr-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class=""></i>Début</span>
                                    </div>
                                    <input type="date" class="form-control" placeholder="date de debut" name="date_debut"
                                        value="{{ old('date_debut', $input['date_debut'] ?? '') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mr-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i>Fin</span>
                                    </div>
                                    <input type="date" class="form-control" placeholder="date fin" name="date_fin"
                                        value="{{ old('date_fin', $input['date_fin'] ?? '') }}">
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
                <div class="row justify-content-center">
                    @forelse ($stagiaires as $stagiaire)
                        <div class="col-md-4">
                            <!-- Widget: user widget style 1 -->
                            <div class="card card-widget widget-user">
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            @if ($stagiaire->image_demande)
                                                <img class="img-circle elevation-2"
                                                    style="width: 100px; height: 100px; object-fit:cover;"
                                                    src="{{ $stagiaire->image_url() }}" alt="User Avatar">
                                            @endif
                                        </div>
                                        <div class="col-sm-8">
                                            <!-- Deuxième colonne de description -->
                                            <div class="description-block">
                                                <div class="form-group text-center mt-3">
                                                    @if ($stagiaire->nom_etat == 'Fin' && $stagiaire->date_fin != now()->toDateString())
                                                        <a href="{{ route('admin.attestation.downloadPdfAttestation', ['stagiaire' => $stagiaire->theme]) }}"
                                                            class="genric-btn info-border circle">
                                                            <span><i class="fas fa-certificate"
                                                                    style="color: rgb(0, 160, 5);">
                                                                    Attestation </i></span></a>
                                                    @elseif ($stagiaire->nom_etat == 'Terminé' && $stagiaire->date_fin != now()->toDateString())
                                                        <a href="{{ route('admin.attestation.downloadPdfAttestation', ['stagiaire' => $stagiaire->theme]) }}"
                                                            class="genric-btn info-border circle">
                                                            <span><i class="fas fa-copy" style="color: rgb(255, 14, 14);">
                                                                    Duplicata </i></span></a>
                                                    @else
                                                        <div><br></div>
                                                    @endif
                                                    {{-- <div>
                                                        <span><i class="fas fa-certificate"
                                                                style="color: rgb(0, 160, 5);">
                                                                Attestation </i></span>
                                                    </div>
                                                    <div>
                                                        <span><i class="fas fa-copy" style="color: rgb(255, 14, 14);">
                                                                Duplicata </i></span>
                                                    </div> --}}
                                                </div>
                                                <h5 class="description-header">Status : {{ $stagiaire->nom_etat }}</h5>
                                                <div>
                                                    <p>{{ $stagiaire->nom_demande }} {{ $stagiaire->prenom_demande }}</p>
                                                    <p>{{ $stagiaire->nom_niveau }}</p>
                                                    <div class="row">
                                                        <div class="col-sm-4 border-right">
                                                            <!-- Première colonne de description -->
                                                            <div
                                                                class="description-block d-flex align-items-center text-muted">
                                                                <span class="mr-2"><i class="fas fa-file-pdf"
                                                                        style="color: rgb(255, 14, 14);"></i></span>
                                                                @if ($stagiaire->cv)
                                                                    <span>
                                                                        <a href="{{ $stagiaire->cv_url() }}"
                                                                            target="_blank">Cv</a></span>
                                                                @endif
                                                            </div>
                                                            <!-- /.description-block -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-sm-4 border-right">
                                                            <!-- Deuxième colonne de description -->
                                                            <div
                                                                class="description-block d-flex align-items-center text-muted">
                                                                <span class="mr-2"><i class="fas fa-file-pdf"
                                                                        style="color: rgb(255, 14, 14);"></i></span>
                                                                @if ($stagiaire->lm)
                                                                    <span>
                                                                        <a href="{{ $stagiaire->lm_url() }}"
                                                                            target="_blank">Lm</a></span>
                                                                @endif
                                                            </div>
                                                            <!-- /.description-block -->
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-sm-4">
                                                            <!-- Troisième colonne de description -->
                                                            <div
                                                                class="description-block d-flex align-items-center text-muted">
                                                                <span class="mr-2"><i class="fas fa-file-pdf"
                                                                        style="color: rgb(255, 14, 14);"></i></span>
                                                                @if ($stagiaire->autres)
                                                                    <span>
                                                                        <a href="{{ $stagiaire->autres_url() }}"
                                                                            target="_blank">Autres</a></span>
                                                                @endif
                                                            </div>
                                                            <!-- /.description-block -->
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <!-- Première colonne de description -->
                                                            <div class="description-block d-flex align-items-center">
                                                                <span class="mr-2"><i class="fas fa-envelope"
                                                                        style="color: rgb(0, 160, 5);"></i></span>
                                                                <span class="text-muted text-truncate"
                                                                    style="max-width: calc(100% - 24px);">
                                                                    {{ $stagiaire->email_demande }}</span>
                                                            </div>
                                                            <!-- /.description-block -->
                                                        </div>
                                                    </div>
                                                    {{-- <div>
                                                        @if ($stagiaire->cv)
                                                            <a href="{{ $stagiaire->cv_url() }}">cv</a>
                                                        @endif
                                                        @if ($stagiaire->lm)
                                                            <a href="{{ $stagiaire->lm_url() }}">lm</a>
                                                        @endif
                                                        @if ($stagiaire->autres)
                                                            <a href="{{ $stagiaire->autres_url() }}">autres</a>
                                                        @endif
                                                        <h7>{{ $stagiaire->email_demande }}</h7>
                                                    </div> --}}
                                                    <div>
                                                        {{ $stagiaire->nom_service }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <div class="col-sm-12 mt-3">
                                        <!-- Nouvelle colonne pour les icônes de refus et d'acceptation -->
                                        <div class="form-group text-center">
                                            <div>
                                                <p><strong><i class="fas fa-book" style="color: rgb(0, 153, 255);">
                                                            Theme :</i></strong> {{ $stagiaire->theme }}</p>
                                            </div>
                                            <div class="text-justify">
                                                <p>{{ $stagiaire->description_theme }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-info col-sm-12 mt-3">
                                    <div class="col-sm-12 mt-3">
                                        <!-- Nouvelle colonne pour les icônes de refus et d'acceptation -->
                                        <div class="form-group text-center">
                                            <div>
                                                <p><i class="far fa-calendar"></i><strong> Date début :</strong>
                                                    {{ $stagiaire->date_debut }}
                                                    , <i class="far fa-calendar"></i><strong> Date fin :</strong>
                                                    {{ $stagiaire->date_fin }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->

                            </div>
                            <!-- /.widget-user -->
                        </div>
                        {{-- <hr style="background-color: rgba(211, 211, 211, 0.219);"> --}}
                    @empty
                        <div class="col">
                            Mafy mafy ny midona aminay eee
                        </div>
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
