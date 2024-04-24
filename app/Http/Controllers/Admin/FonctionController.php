<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FonctionRequest;
use App\Http\Requests\Admin\SearchFonctionRequest;
use App\Models\Fonction;
use Illuminate\Http\Request;

class FonctionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchFonctionRequest $request)
    {
        $query = Fonction::query();
        if($nom_fonction = $request->validated('nom_fonction')){
            $query = $query->where('nom_fonction', 'like', "%{$nom_fonction}%");
        }
        if($role = $request->validated('role')){
            $query = $query->where('role', 'like', "%{$role}%");
        }
        return view('admin.fonctions.index', [
            'fonctions' => $query->get(),
            'input' => $request->validated()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fonction = new Fonction();
        return view('admin.fonctions.form', [
            'fonction' => $fonction
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FonctionRequest $request)
    {
        $fonction = Fonction::create($request->validated());
        return to_route('admin.fonction.index')->with('success', 'Le fonction a bien été crée');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fonction $fonction)
    {
        return view('admin.fonctions.form', [
            'fonction' => $fonction
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FonctionRequest $request, Fonction $fonction)
    {
        $fonction->update($request->validated());
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
