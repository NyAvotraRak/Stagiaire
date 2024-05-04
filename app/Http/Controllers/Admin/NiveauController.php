<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NiveauRequest;
use App\Http\Requests\Admin\SearchNiveauRequest;
use App\Models\Niveau;
use Illuminate\Http\Request;

class NiveauController extends Controller
{
    public function index(SearchNiveauRequest $request)
    {
        // Commencez par une requête Eloquent vide
        $query = Niveau::select('niveaux.*')
            ->orderBy('niveaux.created_at', 'desc');

        // Vérifiez si le nom_demande est présent dans les données validées
        if ($nom_niveau = $request->validated()['nom_niveau'] ?? null) {
            $query->where('nom_niveau', 'like', "%{$nom_niveau}%");
        }

        // Exécutez la requête et récupérez les résultats
        $niveaux = $query->get();

        return view('admin.niveaux.index', compact('niveaux'));
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
        $niveau->delete();
        return to_route('admin.niveau.index')->with('success', 'Le niveau a bien été Supprimé');
    }
}
