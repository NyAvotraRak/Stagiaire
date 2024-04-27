@extends('admin.admin')

@section('title', 'Tous les utilisateurs')

@section('content')
    <!-- Patient Area Starts -->
    <section class="patient-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-top text-center">
                        <h2>@yield('title')</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non eius doloribus error sit quis veniam
                            laudantium, architecto reprehenderit, temporibus nihil culpa laborum praesentium modi quaerat
                            inventore unde nesciunt nulla delectus.</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach ($users as $user)
                    <div class="col-lg-5">
                        <div class="single-patient mb-4">
                            @if ($user->image_users)
                                <img src="{{ $user->image_url() }}" alt="">
                            @endif
                            <h3>{{ $user->name }}</h3>
                            @if ($user->service)
                                <!-- Vérifie si la relation service est définie -->
                                <h5>{{ $user->service->nom_service }}</h5>
                            @else
                                <p>Aucun service associé</p>
                            @endif
                            @if ($user->fonction)
                                <!-- Vérifie si la relation fonction est définie -->
                                <h5>{{ $user->fonction->nom_fonction }}</h5>
                            @else
                                <p>Aucune fonction associée</p>
                            @endif
                            <p class="pt-3">{{ $user->email }}</p>
                            <div class="text-center"> <!-- Ajout de la classe "text-center" pour centrer le contenu -->
                                <ul class="doctor-icon d-inline-flex">
                                    <!-- Modification de la classe pour afficher les éléments en ligne -->
                                    <li class="mr-3"><a href="{{ route('profile.edit') }}">Gerer mon compte</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </section>
@endsection
