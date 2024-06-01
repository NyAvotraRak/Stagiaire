<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Page Title -->
    <title>Attestation</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <!-- styleko -->
    <link rel="stylesheet" href="{{ asset('dist/css/styleko.css') }}">
    <style>
        /* Ajoutez une classe CSS pour la barre de navigation fixe */
        .navbar-fixed {
            position: fixed;
            top: 0;
            width: 100%;
            /* z-index: 1000; */
            /* Assure que la barre de navigation apparaît au-dessus des autres éléments */
        }

        .centered-div {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            height: 100vh;
            /* Ajustez la hauteur selon vos besoins */
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .content img {
            margin-bottom: 20px;
            /* Espacement entre l'image et la liste */
        }

        /* Ajoutez des tabulations à chaque paragraphe */
        p {
            text-indent: 2em;
            /* Ajustez l'indentation selon vos besoins */
        }

        /* Aligner le texte à droite */
        .text-right {
            text-align: right;
        }
    </style>

</head>

<body>
    <div>
        <div>
            <div>
                <div>
                    <div class="centered-div">
                        <h4><strong>REPOBLIKAN’I MADAGASIKARA
                                <br><strong>Fitiavana – Tanindrazana – Fandrosoana</strong></h4>
                    </div>
                    <div class="centered-div">
                        <div class="content">
                            <div>
                                <div>MINISTERE DE L’INTERIEUR <br> ET DE LA DECENTRALISATION</div>
                                <div>********</div>
                                <div>SECRETARIAT GENERAL</div>
                                <div>*******</div>
                                <div>DIRECTION GENERALE DE L’INTERIEUR</div>
                                <div>*******</div>
                                <div>DIRECTION DES SYSTEMES D’INFORMATION</div>
                            </div>
                        </div>
                    </div>
                    <div class="centered-div">
                        <h2>ATTESTATION DE STAGE</h2>
                    </div>
                    <div>
                        <p>Le Directeur des Systèmes d’Information du Ministère de l’Intérieur, soussigné, atteste par
                            la
                            présente que Monsieur <strong> {{ $stagiaire->demande->nom_demande }}
                                {{ $stagiaire->demande->prenom_demande }}</strong> a effectué un stage de
                            <strong>{{ $differenceMois }}</strong>
                            mois, du
                            <strong>{{ $stagiaire->date_debut }}</strong> au
                            <strong>{{ $stagiaire->date_fin }}</strong> auprès de notre département
                            <strong>{{ $stagiaire->demande->service->nom_service }}</strong>.
                        </p>
                        <p>Ce stage a été réalisé sur le thème suivant :
                            "<strong>{{ $stagiaire->theme }}</strong>". Ce projet consistait en
                            <strong>{{ $stagiaire->description_theme }}</strong>.
                        </p>

                        <p>En foi de quoi, la présente attestation lui est délivrée pour servir et valoir ce que de
                            droit
                        </p>
                    </div>
                    <div class="text-right">Antananarivo, le {{ $dateAujourdHui }}.</div>

                </div>

            </div>
        </div>
    </div>
</body>

</html>
