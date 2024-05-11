<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FonctionRequest;
use App\Http\Requests\Admin\SearchFonctionRequest;
use App\Models\Fonction;
use App\Models\Service;
use Illuminate\Http\Request;

class FonctionController extends Controller
{
    public function index(SearchFonctionRequest $request)
    {
        // Commencez par une requête Eloquent vide
        $query = Fonction::select('fonctions.*')
            ->orderBy('fonctions.created_at', 'desc');

        // Vérifiez si le nom_demande est présent dans les données validées
        if ($nom_fonction = $request->validated()['nom_fonction'] ?? null) {
            $query->where('nom_fonction', 'like', "%{$nom_fonction}%");
        }

        // Vérifiez si le prenom_demande est présent dans les données validées
        if ($role = $request->validated()['role'] ?? null) {
            $query->where('role', 'like', "%{$role}%");
        }

        // Exécutez la requête et récupérez les résultats
        $fonctions = $query->get();

        return view('admin.fonctions.index', compact('fonctions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fonction = new Fonction();
        $servicesSelectionnes = []; // Initialiser la variable
        return view('admin.fonctions.form', [
            'fonction' => $fonction,
            'services' => Service::pluck('nom_service', 'id'),
            'servicesSelectionnes' => $servicesSelectionnes // Passer la variable à la vue
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(FonctionRequest $request)
    {
        $fonction = Fonction::create($request->validated());
        $fonction->services()->sync($request->validated('services'));
        return to_route('admin.fonction.index')->with('success', 'Le fonction a bien été crée');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fonction $fonction)
    {
        // Récupérer les services liés à cette fonction spécifique
        $servicesSelectionnes = $fonction->exists ? $fonction->services()->pluck('id')->toArray() : [];
        return view('admin.fonctions.form', [
            'fonction' => $fonction,
            'services' => Service::pluck('nom_service', 'id'),
            'servicesSelectionnes' => $servicesSelectionnes
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FonctionRequest $request, Fonction $fonction)
    {
        $fonction->update($request->validated());
        $fonction->services()->sync($request->validated('services'));
        return to_route('admin.fonction.index')->with('success', 'Le fonction a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fonction $fonction)
    {
        $fonction->delete();
        return to_route('admin.fonction.index')->with('success', 'Le fonction a bien été Supprimé');
    }
}
