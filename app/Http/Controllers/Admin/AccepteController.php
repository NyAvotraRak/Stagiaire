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
    public function index(SearchStagiaireRequest $request)
    {
        // Création de l'objet Carbon pour la date actuelle
        $dateActuelle = Carbon::now()->toDateString();

        // Mise à jour de l'état_id à 4 pour les demandes dont la date de fin est égale à la date actuelle
        Demande::whereIn('id', function ($query) use ($dateActuelle) {
            $query->select('demande_id')
                ->from('detail_stages')
                ->whereDate('date_fin', $dateActuelle);
        })->update(['etat_id' => 4]);

        // Récupération des stagiaires avec les conditions de recherche
        $stagiaires = Detail_stage::select('detail_stages.*', 'demandes.image_demande', 'demandes.nom_demande', 'demandes.prenom_demande', 'demandes.email_demande', 'demandes.cv', 'demandes.lm', 'demandes.autres', 'services.nom_service', 'etats.nom_etat', 'niveaux.nom_niveau')
            ->join('demandes', 'detail_stages.demande_id', '=', 'demandes.id')
            ->join('services', 'demandes.service_id', '=', 'services.id')
            ->join('etats', 'demandes.etat_id', '=', 'etats.id')
            ->join('niveaux', 'demandes.niveau_id', '=', 'niveaux.id')
            ->whereIn('etats.nom_etat', ['En cours', 'Fin', 'Terminé']);

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

        // Retour de la vue avec les stagiaires
        return view('admin.stagiaires.index', [
            'stagiaires' => $stagiaires
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
