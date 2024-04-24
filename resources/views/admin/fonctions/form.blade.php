@extends('admin.admin')

@section('title', $fonction->exists ? 'Editer un fonction' : 'Créer un fonction')

@section('content')

    <div id="formu" class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 my-5">
                    {{-- <div id="demande"> --}}
                    <h3>@yield('title') :</h3>
                    <br>
                    <form class="vstack gap-5" action="{{ route($fonction->exists ? 'admin.fonction.update' : 'admin.fonction.store', $fonction) }}"
                        method="post">
                        @csrf

                        @method($fonction->exists ? 'put' : 'post')

                        @include('shared.input', ['name' => 'nom_fonction', 'label' => 'Nom :', 'placeholder' => 'Entrer le nom', 'value' => $fonction->nom_fonction])
                        @include('shared.select', ['name' => 'role', 'label' => "Role :"])
                        <button class="genric-btn info-border circle">
                            @if ($fonction->exists)
                                Modifier
                            @else
                                Créer
                            @endif
                        </button>
                    </form>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
@endsection
