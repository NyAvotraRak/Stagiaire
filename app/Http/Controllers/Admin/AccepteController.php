<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccepteRequest;
use App\Http\Requests\Admin\DemandeRequest;
use App\Http\Requests\Admin\SearchStagiaireRequest;
use App\Models\Demande;
use App\Models\Detail_stage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AccepteController extends Controller
{
    // public function index(SearchStagiaireRequest $request)
    // {
    //     // Récupération de tous les stagiaires avec les informations nécessaires
    //     $stagiairesOriginaux = Detail_stage::select('detail_stages.*', 'demandes.*', 'services.nom_service', 'etats.nom_etat', 'niveaux.nom_niveau')
    //         ->join('demandes', 'detail_stages.demande_id', '=', 'demandes.id')
    //         ->join('services', 'demandes.service_id', '=', 'services.id')
    //         ->join('etats', 'demandes.etat_id', '=', 'etats.id')
    //         ->join('niveaux', 'demandes.niveau_id', '=', 'niveaux.id')
    //         ->whereIn('etats.nom_etat', ['En cours', 'Fin', 'Terminé']);

    //     // Vérifier et mettre à jour l'état à 4 si la date de fin est égale à la date actuelle
    //     $date_now = now()->toDateString(); // Obtenir la date actuelle
    //     $stagiairesOriginaux->where('detail_stages.date_fin', $date_now)
    //         ->update(['demandes.etat_id' => 4]);

    //     // Récupérer les résultats avec les filtres supplémentaires
    //     $stagiaires = clone $stagiairesOriginaux;

    //     // Appliquer les filtres si spécifiés
    //     if ($request->filled('nom_stagiaire')) {
    //         $stagiaires->where('demandes.nom_demande', 'like', '%' . $request->input('nom_stagiaire') . '%');
    //     }

    //     if ($request->filled('prenom_stagiaire')) {
    //         $stagiaires->where('demandes.prenom_demande', 'like', '%' . $request->input('prenom_stagiaire') . '%');
    //     }

    //     if ($request->filled('date_debut')) {
    //         $stagiaires->where('detail_stages.date_debut', '=', $request->input('date_debut'));
    //     }

    //     if ($request->filled('date_fin')) {
    //         $stagiaires->where('detail_stages.date_fin', '=', $request->input('date_fin'));
    //     }

    //     // Trier les résultats par état
    //     $stagiaires->orderBy('etats.id', 'desc');

    //     // Récupérer les résultats finaux
    //     $stagiaires = $stagiaires->get();

    //     // Compter le nombre total de stagiaires
    //     $nombre_stagiaires = $stagiairesOriginaux->count();

    //     // Compter le nombre de stagiaires pour chaque état
    //     $nombre_etat_id_3 = $stagiairesOriginaux->where('etats.id', 3)->count();
    //     $nombre_etat_id_4 = $stagiairesOriginaux->where('etats.id', 4)->count();
    //     $nombre_etat_id_5 = $stagiairesOriginaux->where('etats.id', 5)->count();

    //     // Calculer les pourcentages
    //     $pourcentage_etat_id_3 = $nombre_stagiaires > 0 ? ($nombre_etat_id_3 / $nombre_stagiaires) * 100 : 0;
    //     $pourcentage_etat_id_4 = $nombre_stagiaires > 0 ? ($nombre_etat_id_4 / $nombre_stagiaires) * 100 : 0;
    //     $pourcentage_etat_id_5 = $nombre_stagiaires > 0 ? ($nombre_etat_id_5 / $nombre_stagiaires) * 100 : 0;

    //     // Retourner les données à la vue
    //     return view('admin.stagiaires.index', [
    //         'stagiaires' => $stagiaires,
    //         'nombre_stagiaires' => $nombre_stagiaires,
    //         'nombre_etat_id_3' => $nombre_etat_id_3,
    //         'nombre_etat_id_4' => $nombre_etat_id_4,
    //         'nombre_etat_id_5' => $nombre_etat_id_5,
    //         'pourcentage_etat_id_3' => $pourcentage_etat_id_3,
    //         'pourcentage_etat_id_4' => $pourcentage_etat_id_4,
    //         'pourcentage_etat_id_5' => $pourcentage_etat_id_5
    //     ]);
    // }
    public function index(SearchStagiaireRequest $request)
    {
        // Création de l'objet Carbon pour la date actuelle
        $dateActuelle = Carbon::now()->toDateString();

        // Mise à jour de l'état_id à 4 pour les demandes dont la date de fin est égale à la date actuelle
        // Demande::whereNotIn('etat_id', [6]) // Ajoutez cette ligne pour exclure les demandes avec etat_id 6
        //     ->whereIn('id', function ($query) use ($dateActuelle) {
        //         $query->select('demande_id')
        //             ->from('detail_stages')
        //             ->whereDate('date_fin', $dateActuelle);
        //     })->update(['etat_id' => 4]);
        Demande::whereNotIn('etat_id', [6]) // Exclure les demandes avec etat_id 6
            ->whereIn('id', function ($query) use ($dateActuelle) {
                $query->select('demande_id')
                    ->from('detail_stages')
                    ->whereDate('date_fin', '<=', $dateActuelle); // Condition de date
            })->update(['etat_id' => 4]);

        // Récupération des stagiaires avec les conditions de recherche
        $stagiaires = Detail_stage::select('detail_stages.*', 'demandes.image_demande', 'demandes.nom_demande', 'demandes.prenom_demande', 'demandes.email_demande', 'demandes.cv', 'demandes.lm', 'demandes.autres', 'services.nom_service', 'etats.nom_etat', 'niveaux.nom_niveau')
            ->join('demandes', 'detail_stages.demande_id', '=', 'demandes.id')
            ->join('services', 'demandes.service_id', '=', 'services.id')
            ->join('etats', 'demandes.etat_id', '=', 'etats.id')
            ->join('niveaux', 'demandes.niveau_id', '=', 'niveaux.id')
            ->whereIn('etats.nom_etat', ['En cours', 'Fin', 'Terminé', 'Abondonné']);

        // Filtrage supplémentaire si des paramètres de recherche sont présents
        if ($nom_stagiaire = $request->validated()['nom_stagiaire'] ?? null) {
            $stagiaires->where('nom_demande', 'like', "%{$nom_stagiaire}%");
        }

        if ($prenom_stagiaire = $request->validated()['prenom_stagiaire'] ?? null) {
            $stagiaires->where('prenom_demande', 'like', "%{$prenom_stagiaire}%");
        }

        if ($date_debut = $request->validated()['date_debut'] ?? null) {
            $stagiaires->where('date_debut', '=', $date_debut);
        }

        if ($date_fin = $request->validated()['date_fin'] ?? null) {
            $stagiaires->where('detail_stages.date_fin', '=', $date_fin);
        }

        // Tri des résultats par date de création
        $stagiaires->orderBy('etats.id', 'desc');

        // Récupération des résultats
        $stagiaires = $stagiaires->get();

        // Nombre total de stagiaires
        $nombre_total_stagiaires = $stagiaires->count();

        // Nombre de stagiaires avec etat_id égal à 3
        $nombre_etat_id_3 = Detail_stage::whereHas('demande', function ($query) {
            $query->where('etat_id', 3);
        })->count();

        // Nombre de stagiaires avec etat_id égal à 4
        $nombre_etat_id_4 = Detail_stage::whereHas('demande', function ($query) {
            $query->where('etat_id', 4);
        })->count();

        // Nombre de stagiaires avec etat_id égal à 5
        $nombre_etat_id_5 = Detail_stage::whereHas('demande', function ($query) {
            $query->where('etat_id', 5);
        })->count();

        // Nombre de stagiaires avec etat_id égal à 6
        $nombre_etat_id_6 = Detail_stage::whereHas('demande', function ($query) {
            $query->where('etat_id', 6);
        })->count();


        // Calcul des pourcentages
        $pourcentage_etat_id_3 = $nombre_total_stagiaires > 0 ? ($nombre_etat_id_3 / $nombre_total_stagiaires) * 100 : 0;
        $pourcentage_etat_id_4 = $nombre_total_stagiaires > 0 ? ($nombre_etat_id_4 / $nombre_total_stagiaires) * 100 : 0;
        $pourcentage_etat_id_5 = $nombre_total_stagiaires > 0 ? ($nombre_etat_id_5 / $nombre_total_stagiaires) * 100 : 0;
        $pourcentage_etat_id_6 = $nombre_total_stagiaires > 0 ? ($nombre_etat_id_6 / $nombre_total_stagiaires) * 100 : 0;
        // dd($nombre_etat_id_5);

        // Retour de la vue avec les stagiaires et les statistiques
        // return view('admin.stagiaires.index', [
        //     'stagiaires' => $stagiaires,
        //     'nombre_total_stagiaires' => $nombre_total_stagiaires,
        //     'nombre_etat_id_3' => $nombre_etat_id_3,
        //     'nombre_etat_id_4' => $nombre_etat_id_4,
        //     'nombre_etat_id_5' => $nombre_etat_id_5,
        //     'pourcentage_etat_id_3' => $pourcentage_etat_id_3,
        //     'pourcentage_etat_id_4' => $pourcentage_etat_id_4,
        //     'pourcentage_etat_id_5' => $pourcentage_etat_id_5,
        // ]);
        // dd($nombre_etat_id_5);
        return view('admin.stagiaires.index', [
            'stagiaires' => $stagiaires,
            'nombre_total_stagiaires' => $nombre_total_stagiaires,
            'nombre_etat_id_3' => $nombre_etat_id_3,
            'nombre_etat_id_4' => $nombre_etat_id_4,
            'nombre_etat_id_5' => $nombre_etat_id_5,
            'nombre_etat_id_6' => $nombre_etat_id_6,
            'pourcentage_etat_id_3' => $pourcentage_etat_id_3,
            'pourcentage_etat_id_4' => $pourcentage_etat_id_4,
            'pourcentage_etat_id_5' => $pourcentage_etat_id_5,
            'pourcentage_etat_id_6' => $pourcentage_etat_id_6,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add($demande_id)
    {
        // Récupérer les données de la demande
        $demande = Demande::findOrFail($demande_id);
        $stagiaire = new Detail_stage();

        // Retourner la vue avec les données
        $view = view('admin.stagiaires.form', [
            'stagiaire' => $stagiaire,
            'demande' => $demande
        ]);

        return $view;
    }


    /**
     * Store a newly created resource in storage.
     */
    // public function store(AccepteRequest $request, Demande $demande)
    // {
    //     $theme = $request->input('theme');
    //     $description_theme = $request->input('description_theme');
    //     $date_debut = $request->input('date_debut');
    //     $dure = $request->input('dure');
    //     $arrayDate = date_parse_from_format('Y-m-d', $date_debut);
    //     $date_fin = date('Y-m-d', mktime(0, 0, 0, $arrayDate['month'], $arrayDate['day'] + $dure, $arrayDate['year']));
    //     $demande->update(['etat_id' => 3]);
    //     $stagiaire = new Detail_stage();
    //     $stagiaire->theme = $theme;
    //     $stagiaire->description_theme = $description_theme;
    //     $stagiaire->date_debut = $date_debut;
    //     $stagiaire->date_fin = $date_fin;
    //     $stagiaire->demande_id = $demande->id;
    //     $stagiaire->save();
    //     return to_route('admin.accepte.index', [
    //         'stagiaire' => $stagiaire
    //     ])->with('success', 'Le stagiaire a bien été Enregistré');
    // }

    public function store(AccepteRequest $request, Demande $demande)
    {
        $theme = $request->input('theme');
        $description_theme = $request->input('description_theme');
        $date_debut = $request->input('date_debut');
        $dure = $request->input('dure');

        // Création de l'objet Carbon pour la date de début
        $dateDebutCarbon = Carbon::createFromFormat('Y-m-d', $date_debut);

        // Calcul de la date de fin en ajoutant la durée
        $dateFinCarbon = $dateDebutCarbon->copy()->addDays($dure);

        // Mise à jour de l'état de la demande
        $demande->update(['etat_id' => 3]);

        // Création du stagiaire avec les dates formatées en Carbon
        $stagiaire = new Detail_stage();
        $stagiaire->theme = $theme;
        $stagiaire->description_theme = $description_theme;
        $stagiaire->date_debut = $dateDebutCarbon;
        $stagiaire->date_fin = $dateFinCarbon;
        $stagiaire->demande_id = $demande->id;
        $stagiaire->save();

        // Redirection avec un message de succès
        return redirect()->route('admin.accepte.index')
            ->with('success', 'Le stagiaire a bien été enregistré');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
