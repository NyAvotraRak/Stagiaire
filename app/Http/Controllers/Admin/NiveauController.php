<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NiveauRequest;
use App\Http\Requests\Admin\SearchNiveauRequest;
use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NiveauController extends Controller
{
    public function index(SearchNiveauRequest $request)
    {
        $nom_niveau = $request->input('nom_niveau');

        // Récupérer toutes les niveaux avec leurs critères associés, triées par date de création décroissante
        $query = Niveau::orderBy('created_at', 'desc');

        // Vérifiez si le nom_niveau est présent dans les données validées
        if ($nom_niveau = $request->validated()['nom_niveau'] ?? null) {
            $query->where('nom_niveau', 'like', "%{$nom_niveau}%");
        }

        // Exécutez la requête et récupérez les résultats
        $niveaux = $query->get();

        // Compter le nombre total de niveaux
        $totalNiveaux = $niveaux->count();

        // Compter le nombre total de niveaux en tenant compte des critères de recherche
        $filteredNiveaux = Niveau::select('nom_niveau', DB::raw('count(*) as total'))
            ->when($nom_niveau, function ($query, $nom_niveau) {
                return $query->where('nom_niveau', 'like', "%{$nom_niveau}%");
            })
            ->groupBy('nom_niveau')
            ->get();

        // Calculer le pourcentage pour chaque niveau
        foreach ($filteredNiveaux as $niveau) {
            if ($totalNiveaux != 0) {
                $niveau->pourcentage = ($niveau->total / $totalNiveaux) * 100;
            } else {
                $niveau->pourcentage = 0;
            }
        }

        return view('admin.niveaux.index', compact('niveaux', 'nom_niveau', 'totalNiveaux', 'filteredNiveaux'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $niveau = new Niveau();
        return view('admin.niveaux.form', [
            'niveau' => $niveau
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NiveauRequest $request)
    {
        $niveau = Niveau::create($request->validated());
        return to_route('admin.niveau.index')->with('success', 'Le niveau a bien été crée');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Niveau $niveau)
    {
        return view('admin.niveaux.form', [
            'niveau' => $niveau
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NiveauRequest $request, Niveau $niveau)
    {
        // Vérifier si le niveau existe
        if (!$niveau) {
            return back()->with('error', 'Niveau non trouvé');
        }

        // Mettre à jour le niveau
        $niveau->update($request->validated());

        // Redirection avec un message de succès
        return redirect()->route('admin.niveau.index')->with('success', 'Le niveau a bien été modifié');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Niveau $niveau)
    {
        // dd($niveau->id);
        $niveau->delete();
        return to_route('admin.niveau.index')->with('success', 'Le niveau a bien été Supprimé');
    }
}
