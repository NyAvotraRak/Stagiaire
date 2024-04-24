<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MinistereRequest;
use App\Models\Ministere;
use Illuminate\Http\Request;

class MinistereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.ministeres.index', [
            'ministeres' => Ministere::orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ministere = new Ministere();
        return view('admin.ministeres.form', [
            'ministere' => $ministere
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MinistereRequest $request)
    {
        $ministere = Ministere::create($request->validated());
        return to_route('admin.ministere.index')->with('success', 'Le ministere a bien été crée');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ministere $ministere)
    {
        return view('admin.ministeres.form', [
            'ministere' => $ministere
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MinistereRequest $request, Ministere $ministere)
    {
        $ministere->update($request->validated());
        return to_route('admin.ministere.index')->with('success', 'Le ministere a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ministere $ministere)
    {
        $ministere->delete();
        return to_route('admin.ministere.index')->with('success', 'Le ministere a bien été Supprimé');
    }
}
