<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccepteRequest;
use App\Http\Requests\Admin\DemandeRequest;
use App\Models\Demande;
use App\Models\Detail_stage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AccepteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stagiaires = Detail_stage::select('detail_stages.*', 'demandes.*', 'niveaux.*', 'etats.*', 'services.*')
            ->join('demandes', 'detail_stages.demande_id', '=', 'demandes.id')
            ->join('niveaux', 'demandes.niveau_id', '=', 'niveaux.id')
            ->join('etats', 'demandes.etat_id', '=', 'etats.id')
            ->join('services', 'demandes.service_id', '=', 'services.id')
            ->orderBy('detail_stages.created_at', 'desc')
            ->get();
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
        return view('admin.stagiaires.form', [
            'stagiaire' => $stagiaire,
            'demande' => $demande
        ]);
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
        $date_fin = date('Y-m-d', mktime(0, 0, 0, $arrayDate['month'] + $dure, $arrayDate['day'], $arrayDate['year']));
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
