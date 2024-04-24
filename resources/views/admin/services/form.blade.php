@extends('admin.admin')

@section('title', $service->exists ? 'Editer un service' : 'Créer un service')

@section('content')

    <div id="formu" class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 my-5">
                    {{-- <div id="demande"> --}}
                    <h3>@yield('title') :</h3>
                    <br>
                    <form class="vstack gap-5" action="{{ route($service->exists ? 'admin.service.update' : 'admin.service.store', $service) }}"
                        method="post">
                        @csrf

                        @method($service->exists ? 'put' : 'post')

                        @include('shared.input', ['name' => 'nom_service', 'label' => 'Nom :', 'placeholder' => 'Entrer le nom', 'value' => $service->nom_service])
                        @include('shared.input', ['name' => 'image_service', 'label' => 'Image :', 'placeholder' => 'image', 'value' => $service->image_service])
                        @include('shared.input', ['type' => 'textarea', 'name' => 'description_service', 'label' => 'Description :', 'placeholder' => 'desc...', 'value' => $service->description_service])
                        {{-- @include('shared.input', ['type' => 'file', 'name' => 'image_service', 'placeholder' => 'image', 'label' => 'Image :']) --}}

                        {{-- <p>Nom :
                            <input type="text" name="nom" placeholder="Rakoto" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Rakoto'" required class="single-input">
                        </p>
                        <p>Prenom :
                            <input type="text" name="prenom" placeholder="Hery" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Hery'" required class="single-input">
                        </p>
                        <p>Email :
                            <input type="text" name="email" placeholder="exemple@gmail.com"
                                onfocus="this.placeholder = 'exemple@gmail.com'" onblur="this.placeholder = 'Rakoto'"
                                required class="single-input">
                        </p>
                        <p>Diplome :
                        <div class="form-select">
                            <select id="default-selectko">
                                <option value="1">Cepe</option>
                                <option value="1">Bepc</option>
                                <option value="1">Bacc</option>
                                <option value="1">DTS</option>
                                <option value="1">Licence</option>
                                <option value="1">Master</option>
                            </select>
                        </div>
                        </p>
                        <br>
                        <p>Photo :
                            <input type="file" name="photo" required id="default-selectphoto">
                        </p>
                        <br>
                        <p>Cv :
                            <input type="file" name="cv" required id="default-selectcv">
                        </p>
                        <br>
                        <p>Lettre de motivation :
                            <input type="file" name="lm" required id="default-selectlm">
                        </p>
                        <br>
                        <p>Autre :
                            <input type="file" name="lm" id="default-selectautre">
                        </p> --}}
                        <button class="genric-btn info-border circle">
                            @if ($service->exists)
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
