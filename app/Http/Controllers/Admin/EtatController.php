<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EtatRequest;
use App\Models\Etat;
use Illuminate\Http\Request;

class EtatController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index()
    // {
    //     return view('admin.etats.index', [
    //         'etats' => Etat::orderBy('created_at', 'desc')->get()
    //     ]);
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    // //     $etat = new Etat();
    // //     return view('admin.etats.form', [
    // //         'etat' => $etat
    // //     ]);
    // // }

    // // /**
    // //  * Store a newly created resource in storage.
    // //  */
    // // public function store(EtatRequest $request)
    // // {
    // //     $etat = Etat::create($request->validated());
    // //     return to_route('admin.etat.index')->with('success', 'Le etat a bien été crée');
    // // }

    // // /**
    // //  * Show the form for editing the specified resource.
    // //  */
    // // public function edit(Etat $etat)
    // // {
    // //     return view('admin.etats.form', [
    // //         'etat' => $etat
    // //     ]);
    // // }

    // // /**
    // //  * Update the specified resource in storage.
    // //  */
    // // public function update(EtatRequest $request, Etat $etat)
    // // {
    // //     $etat->update($request->validated());
    // //     return to_route('admin.etat.index')->with('success', 'Le etat a bien été modifié');
    // // }

    // // /**
    // //  * Remove the specified resource from storage.
    // //  */
    // // public function destroy(Etat $etat)
    // // {
    // //     $etat->delete();
    // //     return to_route('admin.etat.index')->with('success', 'Le etat a bien été Supprimé');
    // // }
}
