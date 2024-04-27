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
        // Commencez par une requête Eloquent vide
        $query = Detail_stage::select('detail_stages.*', 'demandes.image_demande', 'demandes.nom_demande', 'demandes.prenom_demande', 'demandes.email_demande', 'demandes.cv', 'demandes.lm', 'demandes.autres', 'services.nom_service', 'etats.nom_etat', 'niveaux.nom_niveau')
            ->join('demandes', 'detail_stages.demande_id', '=', 'demandes.id')
            ->join('services', 'demandes.service_id', '=', 'services.id')
            ->join('etats', 'demandes.etat_id', '=', 'etats.id')
            ->join('niveaux', 'demandes.niveau_id', '=', 'niveaux.id')
            ->whereIn('etats.nom_etat', ['En cours', 'Fin', 'Terminé'])
            ->orderBy('demandes.created_at', 'desc');

        // Vérifiez si le nom_demande est présent dans les données validées
        if ($nom_stagiaire = $request->validated()['nom_stagiaire'] ?? null) {
            $query->where('nom_demande', 'like', "%{$nom_stagiaire}%");
        }

        // Vérifiez si le prenom_demande est présent dans les données validées
        if ($prenom_stagiaire = $request->validated()['prenom_stagiaire'] ?? null) {
            $query->where('prenom_demande', 'like', "%{$prenom_stagiaire}%");
        }
        // Vérifiez si le nom_demande est présent dans les données validées
        if ($date_debut = $request->validated()['date_debut'] ?? null) {
            $query->where('date_debut', '=', $date_debut);
        }

        // Vérifiez si le prenom_demande est présent dans les données validées
        if ($date_fin = $request->validated()['date_fin'] ?? null) {
            $query->where('date_fin', '=', $date_fin);
        }

        // Exécutez la requête et récupérez les résultats
        $stagiaires = $query->get();

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
    public function store(AccepteRequest $request, Demande $demande)
    {
        $theme = $request->input('theme');
        $description_theme = $request->input('description_theme');
        $date_debut = $request->input('date_debut');
        $dure = $request->input('dure');
        $arrayDate = date_parse_from_format('Y-m-d', $date_debut);
        $date_fin = date('Y-m-d', mktime(0, 0, 0, $arrayDate['month'], $arrayDate['day'] + $dure, $arrayDate['year']));
        $demande->update(['etat_id' => 3]);
        $stagiaire = new Detail_stage();
        $stagiaire->theme = $theme;
        $stagiaire->description_theme = $description_theme;
        $stagiaire->date_debut = $date_debut;
        $stagiaire->date_fin = $date_fin;
        $stagiaire->demande_id = $demande->id;
        $stagiaire->save();
        return to_route('admin.accepte.index', [
            'stagiaire' => $stagiaire
        ])->with('success', 'Le stagiaire a bien été Enregistré');
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
